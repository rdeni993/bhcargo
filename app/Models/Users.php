<?php namespace App\Models;
use CodeIgniter\Model;

class Users extends Model{

    protected $tb;
    protected $db;
    public function __construct(){$this->db = \Config\Database::connect(); $this->tb = $this->db->table('users');}

    /** User Registration */
    public function doRegistration($reqData){
        if(empty($reqData) || empty($reqData['cmp_type'])){return false;}
        else{

            @$userData = $this->tb->getWhere(['email' => $reqData['email']])->getResult();
            
            if(@$userData){ return false; }

            foreach($reqData as $checkForFail){
                if(empty($checkForFail)){
                    return false;
                }
            }

            $insertQuery = [];
            $insertQuery['name']              = $reqData['name'];
            $insertQuery['surname']           = $reqData['surname'];
            $insertQuery['phone']             = $reqData['phone'];
            $insertQuery['email']             = $reqData['email'];
            $insertQuery['password']          = password_hash($reqData['password'], PASSWORD_BCRYPT);
            $insertQuery['company']           = $reqData['cmp_name'];
            $insertQuery['company_address']   = $reqData['cmp_addr'];
            $insertQuery['company_type']      = $reqData['cmp_type'];

            $insertQuery['security_hash']   = substr(sha1(time()), 0, 16);
            $insertQuery['account_active']  = 0;
            $insertQuery['exp_date']        = date('Y-m-d', time() + (60*60*24*60) );

            //return $this->tb->insert($insertQuery);
            if($this->tb->insert($insertQuery)){
                $reqData['security_hash'] = $insertQuery['security_hash'];
                return bhcargo_email([
                    'to' => $reqData['email'],
                    'subject' => "BH Cargo Registracija"
                ],create_signup_email($reqData));
            } else { return false; }
        }
    }
    
    public function checkRegEmail($email){
        if(empty($email)){ return false; }
        else{ return $this->tb->getWhere(['email' => $email])->getResult(); }
    }

    public function doLogin($reqData){
        if(empty($reqData)){ return false; }
        else{
            @$userData = $this->tb->getWhere(['email' => $reqData['username']])->getResult()[0];
            if(!$userData || !isset($userData)){
                return false;
            }else {
                if(password_verify($reqData['password'], $userData->password) && $userData->account_active == 1){
                    $this->setLoginSession($userData);
                    return true;
                } else{
                    return false;
                }
            }
        }
    }

    public function getUserData($ID){
        return $this->tb->getWhere(['id' => $ID])->getResult()[0];
    }

    public function changeVarData($reqData, $myData){
        if(empty($reqData)){return false;}
        else{
            $expectedData = [
                'phone',
                'company',
                'company_address',
                'company_type'
            ];

            foreach($expectedData as $data){
                if(!$reqData[$data] || empty($reqData[$data])){
                    return false;
                }
            }
            $this->tb->set($reqData);
            $this->tb->where('id', $myData->id);

            return $this->tb->update();
        }
    }

    public function passwordChange($reqData, $myData){
        if(!$reqData){ return false; }
        else{
            if(password_verify($reqData['old_password'], $myData->password)){
                if( $reqData['new_password'] != $reqData['new_repeated_password'] ){
                    return false;
                } else {
                    $this->tb->where('id', $myData->id);
                    $this->tb->set('password', password_hash($reqData['new_password'], PASSWORD_BCRYPT));
                    return $this->tb->update();
                }
            } else {
                return false;
            }
        }
    }

    public function resetPassword($reqData){
        if(empty($reqData)){ return false; }
        else{
            if($reqData['new_password'] != $reqData['new_password_repeat']){ return false; }
            else{
                if(strlen($reqData['new_password']) < 8){ return false; }
                else{
                    if(!$this->userExists($reqData['security_hash'], $reqData['email'])){ return false; }
                    else{
                        $this->tb->where([
                            'email' => $reqData['email'],
                            'security_hash' => $reqData['security_hash']
                        ]);
    
                        $this->tb->set('password', password_hash($reqData['new_password'], PASSWORD_BCRYPT));
                        $this->tb->set('security_hash', substr(sha1(time()), 0, 16));
    
                        return $this->tb->update();
                    }

                }
            }
        }
    }

    public function activateAccount($reqData){
        @$userData = $this->userExists($reqData['sec_hash'], $reqData['email']);
        if(@!$userData){ return false; }
        else{
            $this->tb->set([
                'account_active' => 1
            ]);
            $this->tb->where([
                'id' => $userData[0]->id
            ]);
            return $this->tb->update();
        }
    }

    public function askCode($email){
        if(@!$email){return false;}
        else{
            @$userData = $this->tb->getWhere(['email' => $email])->getResult()[0];
            if(!$userData){return false;}
            else{
                $resetData = [
                    'sec' => $userData->security_hash,
                    'ema' => $userData->email
                ];
                return bhcargo_email([
                    'to' => $userData->email,
                    'subject' => "Resetovanje lozinke"
                ], create_reset_email($resetData));
            }
        }
    }

    public function extendContract($getReq){
        if(empty($getReq)){ return false; }

        $userData = get_login();
        $extendPeriod = false;
        $currentPeriodUs = strtotime($userData->exp_date);
        $currentTime = time();
        $paycheckModel = model("Paycheck");

        $currentPeriod = ( $currentPeriodUs > $currentTime ) ? $currentPeriodUs : $currentTime;

        if($getReq['_v'] == '3' || $getReq['_v'] == 3){ $extendPeriod = DEF_WEEK_L; }
        if($getReq['_v'] == '10' || $getReq['_v'] == 10){ $extendPeriod = DEF_MONTH_L; }
        if($getReq['_v'] == '60' || $getReq['_v'] == 60){ $extendPeriod = DEF_YEAR_L; }

        $newPeriod = $currentPeriod + $extendPeriod;

        if($this->userExists($userData->security_hash, $userData->email)){
            $this->tb->set('users.exp_date', date("Y-m-d", $newPeriod));
            $this->tb->where('users.id', $userData->id);

            $trace = [
                'user' => $userData->id,
                'amount' => (float)$getReq['_v'],
                'date'  => date('Y-m-d', time())
            ];

            $paycheckModel->savePaycheck($trace);

            return $this->tb->update();
        }

        return false;

    }

    /** Private part */
    private function setLoginSession($sessionData){
        $session = session();
        $session->set('bhCargoLogin', true);
        $session->set('bhCargoData', $sessionData);
    }

    private function userExists($sec_hash, $email){
        return $this->tb->getWhere(['security_hash' => $sec_hash, 'email' => $email])->getResult();
    }

}