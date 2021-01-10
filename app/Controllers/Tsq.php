<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Tsq extends BaseController{
    public function index(){
        bhcargo_email([
            'to' => "denis@localhost",
            'subject' => "Registracija"
        ], create_signup_email());
    }
}