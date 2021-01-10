<!-- Header -->
<?php echo $header; ?>

<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <div class="container web-content" id="mainVueApp">

        <form action="<?php echo site_url('login/do_login'); ?>" method="POST">
                <div class="row">
                    <div class="col-lg-6 py-80">
                        <h4 class="pb-3">Prijavi se</h4>

                        <div class="row">
                            <div class="col-lg-12 pt-3">
                                <div class="form-group">
                                    <input type="text" class="def-cla-input py-4 form-control" name="username" placeholder="Elektronska pošta" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="password" class="def-cla-input py-4 form-control" name="password" placeholder="Lozinka" />
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button class="def-btn">Prijavi se</button><br>
                                <a class="forget-pass" href="<?php echo site_url('reset'); ?>">Zaboravio/la sam lozinku</a>
                            </div>
                            <div class="col-lg-12">
                                <?php if($statusCode == 404): ?>
                                    <small class="text-error">Podaci ne odgovaraju nijednom korisniku!</small>
                                    <small class="text-error">U slučaju da se prvi puta prijavljujete razmislite da li ste 
                                    potvrdili vaš nalog iz Vašeg e-maila!</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>

</div>
<!-- EOF: Template -->

<!-- Footer -->
<?php echo $footer; ?>