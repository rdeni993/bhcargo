<?php namespace App\Controllers;
use CodeIgniter\Controller;

class Profile extends BaseController{

    public function index(){

    }

    public function add_cargo(){

        /**
         * 
         * Data
         * 
         */
        $modelCargoType = model('Cargo_type');
        $modelCargoPackage = model('Cargo_package');
        $statusCode = false;

        /**
         * 
         * Methods
         * 
         */
        if(!logged_in()){ return redirect()->to(site_url('login')); }

        if(@$this->request->getGet('statusCode')){
            $statusCode = $this->request->getGet('statusCode');
        }

        /**
         * 
         * View
         * 
         */
        return view('profile/add_cargo', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'crg_type'      => $modelCargoType->getAll(),
            'crg_package'   => $modelCargoPackage->getAll(),
            'statusCode'   => $statusCode,
            'countryList'   => view('parts/countries'),
            'title'         => MAIN_TITLE
        ]);

    }

    public function add_transport(){

        /**
         * 
         * Data
         * 
         */
        $modelCargoType = model('Cargo_type');
        $modelCargoPackage = model('Cargo_package');
        $statusCode = false;

        /**
         * 
         * Methods
         * 
         */
        if(!logged_in()){ return redirect()->to(site_url('login')); }

        if(@$this->request->getGet('statusCode')){
            $statusCode = $this->request->getGet('statusCode');
        }

        /**
         * 
         * View
         * 
         */
        return view('profile/add_transport', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'crg_type'      => $modelCargoType->getAll(),
            'crg_package'   => $modelCargoPackage->getAll(),
            'countryList'   => view('parts/countries'),
            'statusCode'   => $statusCode,
            'title'         => MAIN_TITLE
        ]);

    }


    public function edit(){

        /**
         * 
         * Data
         * 
         */
        $statusCode = false;
        $userModel = model('Users');
        $cmpTypeModel = model('Cmp_type');
        $session = session();

        /**
         * 
         * Methods
         * 
         */
        if(!logged_in()){ return redirect()->to(site_url('login')); }

        if(@$this->request->getGet('statusCode')){
            $statusCode = $this->request->getGet('statusCode');
        }

        $myData = $session->get('bhCargoData');

        /**
         * 
         * View
         * 
         */
        return view('profile/edit', [
            'header'        => view('meta/header', []),
            'footer'        => view('meta/footer'),
            'nav'           => view('parts/nav'),
            'statusCode'    => $statusCode,
            'myData'        => $userModel->getUserData($myData->id),
            'cmpTypes'      => $cmpTypeModel->getAll(),
            'title'         => MAIN_TITLE
        ]);

    }

    public function save_cargo(){
        if(!logged_in()){ return redirect()->to(site_url('login')); }
        if($this->request->getPost()){
            $mod = model('Cargo');
            if($mod->saveCargo($this->request->getPost())){
                return redirect()->to(site_url('profile/add_cargo?statusCode=200'));
            } else {
                return redirect()->to(site_url('profile/add_cargo?statusCode=404'));
            }
        } else {
            return redirect()->to(site_url('profile/add_cargo?statusCode=404'));
        }
    }

    public function save_transport(){
        if(!logged_in()){ return redirect()->to(site_url('login')); }
        if($this->request->getPost()){
            $mod = model('Transport');
            if($mod->saveTransport($this->request->getPost())){
                return redirect()->to(site_url('profile/add_transport?statusCode=200'));
            } else {
                return redirect()->to(site_url('profile/add_transport?statusCode=404'));
            }
        } else {
            return redirect()->to(site_url('profile/add_transport?statusCode=404'));
        }
    }

    public function editdata(){
        if(!logged_in()){ return redirect()->to(site_url('login')); }
        $session = session();
        $myData = $session->get('bhCargoData');
        if(empty($this->request->getPost())){
            return redirect()->to(site_url('profile/edit?statusCode=404#var_data'));
        } else {    
            $mod = model('Users');
            if($mod->changeVarData($this->request->getPost(), $myData)){
                return redirect()->to(site_url('profile/edit?statusCode=200#var_data'));
            } else {
                return redirect()->to(site_url('profile/edit?statusCode=404#var_data'));
            }
        }
    }

    public function changepassword(){
        if(!logged_in()){ return redirect()->to(site_url('login')); }
        $session = session();
        $myData = $session->get('bhCargoData');
        if(empty($this->request->getPost())){
            return redirect()->to(site_url('profile/edit?statusCode=504#pass_data'));
        } else {    
            $mod = model('Users');
            if($mod->passwordChange($this->request->getPost(), $myData)){
                return redirect()->to(site_url('profile/edit?statusCode=500#pass_data'));
            } else {
                return redirect()->to(site_url('profile/edit?statusCode=504#pass_data'));
            }
        }
    }
}