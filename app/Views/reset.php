<!-- Header -->
<?php echo $header; ?>

<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <div class="container web-content" id="mainVueApp">

        <form action="<?php echo site_url('reset/do_reset'); ?>" method="POST">
                <div class="row">
                    <?php if($statusCode): ?>
                    <div class="col-lg-12 py-80">
                    <?php if($statusCode == 200): ?>
                        <div class="alert-box box-success py-80">
                            <div class="box-content">
                                <h3>Vaša je lozinka zamjenjena!</h3>
                                <p>Uspješno ste zamjenili lozinku za Vaš nalog. Sada se možete prijaviti na nalog koristeći nove podatke!</p>
                            </div>
                            <div class="box-footer">
                                <a href="<?php echo site_url('login'); ?>">Prijavi se na nalog</a>
                            </div>
                        </div>
                    <?php elseif($statusCode == 404): ?>
                        <div class="alert-box box-error py-80">
                            <div class="box-content">
                                <h3>Lozinka nije zamjenjena!</h3>
                                <p>Podaci koje ste koristili ne odgovaraju stvarnim podacima korisnika za kojeg mjenjate lozinku! Ako 
                                smatrate da je ovo greška pokušajte ponovo ili kontaktirajte administratora!</p>
                            </div>
                            <div class="box-footer">
                                <a href="<?php echo site_url('reset'); ?>">Pokusaj opet</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    </div>
                    <?php else: ?>
                    <div class="col-lg-6 py-80">

                        <div class="form-group">
                            <label>Tajni kod</label>
                            <input type="text" <?php if(@$_h){ printf("value='%s'", $_h); } ?> name="security_hash" class="def-cla-input py-4 form-control" placeholder="Ukucajte tajni kod" />
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" <?php if(@$_m){ printf("value='%s'", $_m); } ?>  name="email" class="def-cla-input py-4 form-control" placeholder="Elektronska pošta" />
                        </div>

                        <div class="form-group">
                            <label>Nova lozinka</label>
                            <input type="password" name="new_password" class="def-cla-input py-4 form-control" placeholder="Nova lozinka" />
                        </div>

                        <div class="form-group">
                            <label>Ponovi lozinku</label>
                            <input type="password" name="new_password_repeat" class="def-cla-input py-4 form-control"  placeholder="Ponovi lozinku" />
                        </div>

                        <div class="form-group text-right">
                            <button class="def-btn">Resetuj lozinku</button>
                        </div>

                    </div>
                    <?php endif; ?>
                </div>
        </form>
    </div>

</div>
<!-- EOF: Template -->

<!-- Footer -->
<?php echo $footer; ?>