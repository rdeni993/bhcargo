<!-- Header -->
<?php echo $header; ?>

<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <div class="container web-content" id="mainVueApp">
        <div class="row py-80">
            <div class="col-lg-12">

            <?php if(@$paymentCode): ?>

                <?php if($paymentCode['_r'] == 's'): ?>
                <div class="alert-box box-success">
                    <div class="box-content">
                        <h3>Trajanje Vašeg naloga je produženo!</h3>
                        <p class="text-secondary">Trajanje vašeg naloga je produženo i ponovo ga možete 
                            koristiti sa svim mogućnostima koje BH Cargo pruža!
                        </p>
                        <p class="text-secondary">Kako bi Vaš nalog ponovo bio aktivan potrebno je da se izlogujete a zatim 
                            ponovo prijavite. Do tada se ovo produženje neće uzimati u obzir!
                        </p>
                        <?php 
                            // 
                            $user = get_login();
                            $exp_date = strtotime($user->exp_date);
                            $currentTime = time();
                            $expTime = ( $exp_date > $currentTime ) ? $exp_date : $currentTime;
                            $addPeriod = false;
                            switch((string)$paymentCode['_v']){
                                case  '3' : { $addPeriod = DEF_WEEK_L; } break;
                                case '10' : { $addPeriod = DEF_MONTH_L; } break;
                                case '60' : { $addPeriod = DEF_YEAR_L; } break;
                            }
                        ?>
                        <p>Novi datum isteka naloga je: <?php echo date("d. M Y", $expTime + $addPeriod); ?> </p>
                        <p><i>Hvala što koristite BH Cargo</i></p>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('login/logout'); ?>">Odjavi se</a>
                        <a href="<?php echo site_url('dashboard'); ?>">Pretraga</a>
                    </div>
                </div>
                <?php else: ?>
                <div class="alert-box box-error">
                    <div class="box-content">
                        <h3>Trajanje Vašeg naloga nije produženo!</h3>
                        <p>Prilikom naplate sa Vašeg računa desila se pogreška! Provjerite stanje na računu 
                        pa pokušajte ponovo!
                        </p>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('dashboard'); ?>">Pretraga</a>
                    </div>
                </div>
                <?php endif; ?>

            <?php else: ?>
            <h4>Desila se pogreška</h4>
            <?php endif; ?>
            
            </div>
        </div>
    </div>

</div>
<!-- EOF: Template -->

<!-- Footer -->
<?php echo $footer; ?>