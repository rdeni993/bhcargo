<?php 


if(!function_exists('logged_in')){
    function logged_in(){
        $session = session();
        return $session->get('bhCargoLogin');
    }
}

if(!function_exists('get_login')){
    function get_login(){
        $session = session();
        return $session->get('bhCargoData');
    }
}

if(!function_exists('user_active')){
    function user_active(){
        $session = session()->get('bhCargoData');
        $currentDate = (float)time();
        $exp = (float)strtotime($session->exp_date);

        return ( $exp > $currentDate ) ? true : false;
    }
}