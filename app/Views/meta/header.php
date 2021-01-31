<!DOCTYPE html>
<html>
    <head>
        <!-- Set Title -->
        <title><?php echo MAIN_TITLE; ?></title>

        <!-- Set Meta Charset --> 
        <meta name="author" content="denis_r_home@yahoo.com" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo MAIN_DESCR; ?>" />

        <!-- Load CSS -->
        <link rel="shortcut icon" href="<?php echo base_url('favicon.ico'); ?>">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/bootstrap-reboot.min.css'); ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/bootstrap.min.css'); ?>" type="text/css" />
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/style.css'); ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/fa/css/font-awesome.css'); ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('public/assets/css/mobile.css'); ?>" type="text/css" />

        <!-- Load JS -->
        <script type="text/javascript" src="<?php echo base_url('public/assets/js/jquery.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/assets/js/script.js') ?>"></script>

    </head>
<body>
<!-- Load Page Content -->

<div class="main-loader" id="preloader">
    <img src="<?php echo base_url('public/assets/img/loader.gif'); ?>" alt="pre-loader" />
</div>

<?php 
if(!get_cookie('bh-cargo-basic-cookie') && !isset($_GET['dis'])){
    echo cookie_display(); 
}
?>