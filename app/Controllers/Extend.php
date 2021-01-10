<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Extend extends BaseController{
    public function index(){
        
        /**
         * 
         * Data
         * 
         */
        $statusCode = false;
        $paymentCode = false;

        if(@$this->request->getGet('errorCode')){
            $statusCode = $this->request->getGet('errorCode');
        }

        if(@$this->request->getGet('_r')){
            $paymentCode = $this->request->getGet();
        }

        /**
         * 
         * Methods
         * 
         */

        // Go out if you are not logged in
        if(!logged_in()){ return redirect()->to(site_url('login')); }

        /**
         * 
         * View
         * 
         */
        return view('extend', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'statusCode'    => $statusCode,
            'paymentCode'   => $paymentCode,
            'title'         => MAIN_TITLE
        ]);

    }

    public function extend_contract(){
        if(empty($this->request->getGet('_r'))){ 
            return redirect()->to(site_url('extend/extended?_r=f'));
        }
        else{
            $userModel = model('Users');
            if($userModel->extendContract($this->request->getGet())){ 
                $info = $this->request->getGet();
                return redirect()->to(site_url('extend/extended?_r=' . $info['_r'] . '&_v=' . $info['_v']));
            }
            return redirect()->to(site_url('extend/extended?_r=f'));
        }
    }

    public function extended(){
        
        /**
         * 
         * Data
         * 
         */
        $statusCode = false;
        $paymentCode = false;

        if(@$this->request->getGet('errorCode')){
            $statusCode = $this->request->getGet('errorCode');
        }

        if(@$this->request->getGet('_r')){
            $paymentCode = $this->request->getGet();
        }

        /**
         * 
         * Methods
         * 
         */

        // Go out if you are not logged in
        if(!logged_in()){ return redirect()->to(site_url('login')); }

        /**
         * 
         * View
         * 
         */
        return view('extend_respond', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'statusCode'    => $statusCode,
            'paymentCode'   => $paymentCode,
            'title'         => MAIN_TITLE
        ]);

    }
}