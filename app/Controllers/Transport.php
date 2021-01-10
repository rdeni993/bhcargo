<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Transport extends BaseController{
    
    public function index(){
        /**
         * 
         * Data
         * 
         */
        $transportModel = model('Transport');
        $offset = 0;
        $pageNumber = 1;
        
        /**
         * 
         * Methods
         * 
         */

        if(!logged_in()){ return redirect()->to(site_url('login')); }

        if(@$this->request->getGet('page') && (@$this->request->getGet('page') > 0)){
        
            $offset = ( $this->request->getGet('page') -1 ) * DEF_DB_LIMIT;
            $pageNumber = $this->request->getGet('page');
        }

        $transportData = $transportModel->listTransport($offset);

        /**
         * 
         * View
         * 
         */
        return view('transport', [
            'header' => view('meta/header', []),
            'footer' => view('meta/footer'),
            'nav'    => view('parts/nav'),
            'transport'  => $transportData['data'],
            'transportRows' => ceil($transportData['rows']/DEF_DB_LIMIT),
            'pageNumber' => $pageNumber,
            'title'  => MAIN_TITLE
        ]);
    }

    public function expanded(){
        /**
         * 
         * Data
         * 
         */
        $transportModel = model('Transport');
        
        /**
         * 
         * Methods
         * 
         */
        if(!logged_in()){ return redirect()->to(site_url('login')); }
        if(!user_active()){ return redirect()->to(site_url('dashboard')); }

        if(empty($this->request->getGet('transportID'))){ return redirect()->to(site_url('transport')); }

        /**
         * 
         * View
         * 
         */
        return view('transport_expanded', [
            'header' => view('meta/header', []),
            'footer' => view('meta/footer'),
            'nav'    => view('parts/nav'),
            'transport'  => $transportModel->expandTransport($this->request->getGet('transportID')),
            'title'  => MAIN_TITLE
        ]);
    }

    public function delete(){
        
        if(!logged_in()){ return redirect()->to(site_url('login')); }

        if(empty($this->request->getGet('transportID'))){
            return redirect()->to(site_url('dashboard?_sec=t&statusCode=404'));
        } else {
            $session = session()->get('bhCargoData');
            $transportModel = model('Transport');
            if($transportModel->deleteTransport($session->id, $this->request->getGet('transportID'))){
                return redirect()->to(site_url('dashboard?_sec=t&statusCode=200'));
            } else {
                return redirect()->to(site_url('dashboard?_sec=t&statusCode=404'));
            }
        }
    }

}