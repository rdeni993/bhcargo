<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Reset extends BaseController{

    public function index(){
        
        /**
         * 
         * Data
         * 
         */
        $statusCode = false;

        if(@$this->request->getGet('errorCode')){
            $statusCode = $this->request->getGet('errorCode');
        }

        /**
         * 
         * Methods
         * 
         */

        /**
         * 
         * View
         * 
         */
        return view('ask_code', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'statusCode'    => $statusCode,
            'title'         => MAIN_TITLE
        ]);

    }
    
    public function reset(){
        
        /**
         * 
         * Data
         * 
         */
        $statusCode = false;
        $userEmail = false;
        $userHash = false;

        if(@$this->request->getGet('errorCode')){
            $statusCode = $this->request->getGet('errorCode');
        }

        if(@$this->request->getGet('_m')){
            $userEmail = $this->request->getGet('_m');
        }   
        if(@$this->request->getGet('_h')){
            $userHash = $this->request->getGet('_h');
        }


        /**
         * 
         * Methods
         * 
         */

        /**
         * 
         * View
         * 
         */
        return view('reset', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'statusCode'    => $statusCode,
            '_m'            => $userEmail,
            '_h'            => $userHash,
            'title'         => MAIN_TITLE
        ]);

    }

    public function do_reset(){
        if(empty($this->request->getPost())){
            return redirect()->to(site_url('reset?errorCode=404'));
        } else {
            $mod = model('Users');
            if( $mod->resetPassword($this->request->getPost()) ){
                return redirect()->to(site_url('reset/reset?errorCode=200'));
            } else {
                return redirect()->to(site_url('reset/reset?errorCode=404'));
            }
        }
    }

    public function ask_code(){
        if(empty($this->request->getPost('email'))){
            return redirect()->to(site_url('reset/reset?errorCode=404'));
        }
        else {
            $mod = model('Users');
            if($mod->askCode($this->request->getPost('email'))){
                return redirect()->to(site_url('reset?errorCode=200'));
            } else {
                return redirect()->to(site_url('reset?errorCode=404'));
            }
        }
    }

}