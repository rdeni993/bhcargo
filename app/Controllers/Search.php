<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Search extends BaseController{
    public function index(){
        /**
         * 
         * Data
         * 
         */
        $statusCode = false;
        $session = session();
        $cargoModel = model('Cargo');
        $transportModel = model('Transport');
        $sectionType = false;
        $sectionData = false;
        $offset = 0;
        $pageNumber = 1;
        $disablePagination = false;

        /**
         * 
         * Methods
         * 
         */
        
        if(@$this->request->getGet('page') && (@$this->request->getGet('page') > 0)){
        
            $offset = ( $this->request->getGet('page') -1 ) * DEF_DB_LIMIT;
            $pageNumber = $this->request->getGet('page');
        }

        if(empty($this->request->getGet())){ die("Direct Access"); }
        else{
            if($this->request->getGet('_sec') == 'c'){
                $sectionType = $this->request->getGet('_sec');
                $sectionData = $cargoModel->search($this->request->getGet(), $offset);
            } elseif($this->request->getGet('_sec') == 't'){
                $sectionType = $this->request->getGet('_sec');
                $sectionData = $transportModel->search($this->request->getGet(), $offset);
            }
        }
        
        /**
         * 
         * View
         * 
         */
        return view('search',[
            'header'            => view('meta/header', []),
            'footer'            => view('meta/footer', []),
            'nav'               => view('parts/nav'),
            'searchType'        => $sectionType,
            'searchData'        => $sectionData['data'],
            'searchRows'         => ceil($sectionData['rows']/DEF_DB_LIMIT),
            'disablePagination' => $disablePagination,
            'pageNumber'        => $pageNumber,
            'statusCode'    => $statusCode,
            'title'         => MAIN_TITLE
        ]);
    }

    public function quick(){
        /**
         * 
         * Data
         * 
         */
        $statusCode = false;
        $session = session();
        $cargoModel = model('Cargo');
        $transportModel = model('Transport');
        $sectionType = false;
        $sectionData = false;
        $disablePagination = true;

        /**
         * 
         * Methods
         * 
         */


        if(@$this->request->getPost()){
            $postReq = $this->request->getPost('q');
            $searchData = explode("@", $postReq);

            if($searchData[0] == 'teret'){
                $sectionType = 'c';
                $sectionData = $cargoModel->smartSearch($searchData, 0, DEF_DB_LIMIT);
            } else if($searchData[0] == 'transport'){    
                $sectionType = 't';
                $sectionData = $transportModel->smartSearch($searchData, 0, DEF_DB_LIMIT);
            } else{
                $sectionType = 'c';
            }
        }
        elseif(@$this->request->getGet('_sid')){
            $sessionData = session()->get('bhCargoSearch');
            $sessionType = session()->get('bhCargoSearchType');

            if($sessionType == 't'){
                $sectionType = 'c';
                $sectionData = $cargoModel->search($sessionData, 0, DEF_DB_LIMIT);
            } else {
                $sectionType = 't';
                $sectionData = $transportModel->search($sessionData, 0, DEF_DB_LIMIT);
            }
        }
        else {
            die("Wrong access");
        }
        
        /**
         * 
         * View
         * 
         */
        return view('search',[
            'header'            => view('meta/header', []),
            'footer'            => view('meta/footer', []),
            'nav'               => view('parts/nav'),
            'searchType'        => $sectionType,
            'searchData'        => @$sectionData['data'],
            'pageNumber'        => 1,
            'searchRows'        => 1,
            'disablePagination'        => $disablePagination,
            'statusCode'    => $statusCode,
            'title'         => MAIN_TITLE
        ]);
    }
}