<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Cargo extends BaseController{
    
    public function index(){
        /**
         * 
         * Data
         * 
         */
        $cargoModel = model('Cargo');
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

        $cargoData = $cargoModel->listCargo($offset);

        /**
         * 
         * View
         * 
         */
        return view('cargo', [
            'header' => view('meta/header', []),
            'footer' => view('meta/footer'),
            'nav'    => view('parts/nav'),
            'cargo'  => $cargoData['data'],
            'cargoRows'  => ceil($cargoData['rows']/DEF_DB_LIMIT),
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
        $cargoModel = model('Cargo');
        
        /**
         * 
         * Methods
         * 
         */
        if(!logged_in()){ return redirect()->to(site_url('login')); }
        if(!user_active()){ return redirect()->to(site_url('dashboard')); }

        if(@!$this->request->getGet('cargoID')){return redirect()->to(site_url('cargo'));}

        /**
         * 
         * View
         * 
         */
        return view('cargo_expanded', [
            'header' => view('meta/header', []),
            'footer' => view('meta/footer'),
            'nav'    => view('parts/nav'),
            'cargo'  => $cargoModel->expandCargo($this->request->getGet('cargoID')),
            'title'  => MAIN_TITLE
        ]);
    }

    public function delete(){
        if(!logged_in()){ return redirect()->to(site_url('login')); }
        
        if(empty($this->request->getGet('cargoID'))){ 
            return redirect()->to(site_url('dashboard?_sec=c&statusCode=404'));
        }
        else{
            $session = session()->get('bhCargoData');
            $cargoModel = model('Cargo');

            if($cargoModel->deleteCargo($session->id, $this->request->getGet('cargoID'))){
                return redirect()->to(site_url('dashboard?_sec=c&statusCode=200'));
            } else{
                return redirect()->to(site_url('dashboard?_sec=c&statusCode=404'));
            }
        }
    }

}