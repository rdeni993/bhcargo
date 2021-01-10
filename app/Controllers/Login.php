<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Login extends BaseController{
    
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

        // Go out if you are not logged in
        if(logged_in()){ return redirect()->to(site_url('dashboard')); }

        /**
         * 
         * View
         * 
         */
        return view('login', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'statusCode'    => $statusCode,
            'title'         => MAIN_TITLE
        ]);

    }

    public function do_login(){

        /** prevent double login */
        if(logged_in()){ return redirect()->to(site_url('dashboard')); }

        if($this->request->getPost()){
            $mod = model('Users');
            if($mod->doLogin($this->request->getPost())){
                return redirect()->to(site_url('dashboard'));
            }else{
                return redirect()->to(site_url('login?errorCode=404'));
            }
        } else{
            return redirect()->to(site_url('login?errorCode=404'));
        }
    }

    public function logout(){
        $session = session();
        $session->set('bhCargoLogin', false);
        $session->set('bhCargoData', false);
        $session->destroy();
        return redirect()->to(site_url('login'));
    }

}