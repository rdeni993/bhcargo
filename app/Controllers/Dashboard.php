<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Dashboard extends BaseController{

    public function index(){
        /**
         * 
         * Data
         * 
         */
        $statusCode = false;
        $cargoModel = model('Cargo');
        $transportModel = model('Transport');
        $myData = false;
        $displayCargo = 's';
        $offset = 0;
        $pageNumber = 1;

        /**
         * 
         * Methods
         * 
         */

        // if not logged go out
        if(!logged_in()){ return redirect()->to(site_url('login')); }

        if(@$this->request->getGet('statusCode')){
            $statusCode = $this->request->getGet('statusCode');
        }

        if(@$this->request->getGet('_sec')){
            $displayCargo = $this->request->getGet('_sec');
        }

        if(@$this->request->getGet('page') && (@$this->request->getGet('page') > 0)){
        
            $offset = ( $this->request->getGet('page') -1 ) * DEF_DB_LIMIT;
            $pageNumber = $this->request->getGet('page');
        }

        $myData = get_login();

        /**
         * 
         * View
         * 
         */
        return view('dashboard', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'statusCode'    => $statusCode,
            'cargoData'     => $cargoModel->listMyCargo($myData->id, $offset),
            'pageNumber'    => $pageNumber,
            'transportData' => $transportModel->listMyTransport($myData->id, $offset),
            'display_section' => $displayCargo,
            'countrySelect' => view('parts/countries'),
            'title'         => MAIN_TITLE
        ]);

        }
}