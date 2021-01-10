<?php namespace App\Controllers;
use CodeIgniter\Controller;

/** /welcome */
class Register extends BaseController{
    
    public function index(){
        
        /**
         * 
         * Data
         * 
         */
        $cmpTypeModel = model('Cmp_type');
        $statusCode = false;

        if(@$this->request->getGet('errorCode')){
            $statusCode = $this->request->getGet('errorCode');
        }

        /**
         * 
         * Methods
         * 
         */

        // go out if u are logged in
        if(logged_in()){ return redirect()->to(site_url('dashboard')); }

        /**
         * 
         * View
         * 
         */
        return view('register', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'statusCode'    => $statusCode,
            'cmpTypes'      => $cmpTypeModel->getAll(),
            'title'         => MAIN_TITLE
        ]);

    }

    public function do_reg(){

        // go out if u are logged in
        if(logged_in()){ return redirect()->to(site_url('dashboard')); }

        if(!empty($this->request->getPost())){
            $usrModel = model('Users');
            if($usrModel->doRegistration($this->request->getPost())){
                return redirect()->to(site_url('register?errorCode=200'));
            } else {
                return redirect()->to(site_url('register?errorCode=404'));
            }
        } else {
            return redirect()->to(site_url('register?errorCode=404'));
        }
    }

    public function check_email(){

        // go out if u are logged in
        if(logged_in()){ return redirect()->to(site_url('dashboard')); }

        
        if(empty($this->request->getGet('reg_form_email'))){
            return $this->response->setJSON(json_encode(['status' => 404]));
        } else {
            $modUsers = model('Users');
            if($modUsers->checkRegEmail($this->request->getGet('reg_form_email'))){
                return $this->response->setJSON(json_encode(['status' => 200]));
            } else {
                return $this->response->setJSON(json_encode(['status' => 403]));
            }
        }
    }

    public function activate($email, $hash){
        if(@!$email || @!$hash){
            return redirect()->to(site_url('register?errorCode=904'));
        } else{
            $mod = model('Users');
            if($mod->activateAccount(['sec_hash' => $hash, 'email' => $email])){
                return redirect()->to(site_url('register?errorCode=900'));
            } else {
                return redirect()->to(site_url('register?errorCode=904'));
            }
        }
    }

}