<!-- Header -->
<?php echo $header; ?>

<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <div class="container web-content" id="mainVueApp">

        <form action="<?php echo site_url('reset/ask_code'); ?>" method="POST">
                <div class="row">
                    <?php if($statusCode): ?>
                    <div class="col-lg-12 py-80">
                    <?php if($statusCode == 200): ?>
                        <div class="alert-box box-success py-80">
                            <div class="box-content">
                                <h3>Poslali smo Vam E-mail!</h3>
                                <p>Upustvo kako da vratite pristup Vašem nalogu Vam je poslat na e-mail adresu koju ste 
                                upisali!</p>
                            </div>
                            <div class="box-footer">
                                <a href="<?php echo site_url('reset/reset'); ?>">Imam podatke</a>
                            </div>
                        </div>
                    <?php elseif($statusCode == 404): ?>
                        <div class="alert-box box-error py-80">
                            <div class="box-content">
                                <h3>Dogodila se pogreška!</h3>
                            </div>
                            <div class="box-footer">
                                <a href="<?php echo site_url('reset'); ?>">Pokusaj opet</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    </div>
                    <?php else: ?>
                    <div class="col-lg-6 py-80">
                        <div>
                        <p>E-mail sa upustvoM kako da vratite Vaš nalog će Vam biti poslat na E-mail adresu! </p>
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" class="def-cla-input py-4 form-control" placeholder="Elektronska pošta" />
                        </div>

                        <div class="form-group text-right">
                            <button class="def-btn">Pošalji kod</button>
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