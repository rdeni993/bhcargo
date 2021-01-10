<?php 

if(!function_exists('create_signup_email')){
    function create_signup_email($data){
        return view('mail/signup', $data);
    }
} else { die("create_signup_email already exists"); }

if(!function_exists('create_reset_email')){
    function create_reset_email($data){
        return view('mail/reset', $data);
    }
} else { die("create_signup_email already exists"); }

if(!function_exists('bhcargo_email')){
    function bhcargo_email($senderData, $mailVersion){

        $headers = array();
        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';

        // Additional headers
        $headers[] = 'From: BH Cargo tim <info@bhcargo.com>';

        return mail($senderData['to'], $senderData['subject'], $mailVersion, implode("\r\n", $headers) );
    }
}