<?php namespace App\Controllers;
use CodeIgniter\Controller;

/** /welcome */
class Welcome extends BaseController{
    
    public function index(){
        
        /**
         * 
         * Data
         * 
         */

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
        return view('welcome', [
            'header' => view('meta/header', []),
            'footer' => view('meta/footer'),
            'nav'    => view('parts/nav'),
            'title'  => MAIN_TITLE
        ]);

    }

    public function set_cookie(){
        if(empty($this->request->getGet('cookie_arr'))){ return $this->response->setJSON(['response' => false]); }
        else{
            $cookieData = $this->request->getGet('cookie_arr');
            $cookieSetTime = time();

            if(in_array('basic', $cookieData)){
                set_cookie('bh-cargo-basic-cookie', $cookieSetTime, DEF_MONTH_L);
                echo json_encode(['basic_cookie_status' => 1]);
            }

            if(in_array('ga', $cookieData)){
                set_cookie('bh-cargo-ga-cookie', $cookieSetTime, DEF_MONTH_L);
            }

        }
    }

}