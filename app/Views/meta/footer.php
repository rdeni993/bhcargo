<!-- EOF Content -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 brand mt-4">
                <img src="<?php echo base_url(); ?>/public/assets/img/logo.png" alt="logo" />
            </div>
            <div class="col-lg-8 footer-main-menu mt-4">
                <ul class="">
                    <li><a href="<?php echo site_url('about'); ?>">O nama</a></li>
                    <li><a href="<?php echo site_url('about#services') ?>">Usluge</a></li>
                    <li><a href="<?php echo site_url('welcome#site-prices'); ?>">Cijene</a></li>
                    
                    <li><a href="<?php echo site_url('register'); ?>">Registriraj se</a></li>
                    <li><a href="<?php echo site_url('login'); ?>">Prijavi se</a></li>
                </ul>
            </div>
            <div class="col-lg-4 social-menu mt-4">
                <ul class="">
                    <li><a href="#"><img src="<?php echo base_url(); ?>/public/assets/img/facebook.png" alt="fb"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>/public/assets/img/linkedin.png" alt="ln"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>/public/assets/img/twitter.png" alt="tw"></a></li>
                </ul>
            </div>
            <div class="col-lg-6 mt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Tehnicka sluzba</h4>
                        <a href="mailto:info@bhcargo.com">Pošalji E-mail</a>
                    </div>
                    <div class="col-lg-6">
                        <h4>Podrška korisnicima</h4>
                        <a href="mailto:support@bhcargo.com">Pošalji E-mail</a>
                    </div>
                    <div class="col-lg-12">
                        Navedeni linkovi otvaraju Vašu već podešenu email aplikaciju!
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-4 copyright text-right text-secondary">
                <p>Copyright &copy; 2021</p>
                <p>Sva prava su zadržana i svako neovlašteno korištenje servisa je strogo zabranjeno!</p>
                <small>Designed by: denis_r_home@yahoo.com</small>
            </div>
        </div>
    </div>
</div>

<!-- Remove Preloader -->
<script>
    $(document).ready(function(){ $("#preloader").fadeOut(); });
</script>  
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration : 800,
        once : true
    });
</script>

</body>
</html>