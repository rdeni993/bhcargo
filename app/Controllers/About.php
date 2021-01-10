<?php namespace App\Controllers;
use CodeIgniter\Controller;

/** /welcome */
class About extends BaseController{
    
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
        return view('about', [
            'header' => view('meta/header', []),
            'footer' => view('meta/footer'),
            'nav'    => view('parts/nav'),
            'title'  => MAIN_TITLE
        ]);

    }

}