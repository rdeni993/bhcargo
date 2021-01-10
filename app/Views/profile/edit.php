<!-- Header -->
<?php echo $header; ?>

<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <div class="container web-content" id="mainVueApp">

                <div class="row">
                    <div class="col-lg-12 py-80">
                        <h4 class="pb-3">Uredi profil</h4>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <h5 class="my-4">Stalni podaci</h5>
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">Ime /</small></label>
                                    <input type="text" class="def-input" value="<?php echo $myData->name; ?>" disabled/>
                                </div>
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">Prezime /</small></label>
                                    <input type="text" class="def-input" value="<?php echo $myData->surname; ?>" disabled />
                                </div>
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">E-pošta /</small></label>
                                    <input type="text" class="def-input" value="<?php echo $myData->email; ?>" disabled />
                                </div>
                            </div>
                            <div class="col-lg-12" id="var_data">
                                <h5 class="my-4">Promjenjivi podaci</h5>
                                <form method="POST" action="<?php echo site_url('profile/editdata'); ?>">
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">Broj telefona /</small></label>
                                    <input type="text" name="phone" class="def-input" value="<?php echo $myData->phone; ?>" />
                                </div>
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">Naziv kompanije /</small></label>
                                    <input type="text" name="company" class="def-input" value="<?php echo $myData->company; ?>" />
                                </div>
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">Tip kompanije /</small></label>
                                    <select name="company_type" class="def-input">
                                    <?php if($cmpTypes): ?>
                                        <?php foreach($cmpTypes as $cmpType): ?>
                                            <option value="<?php echo $cmpType->id; ?>" <?php if($myData->company_type == $cmpType->id){ echo "selected"; } ?>><?php echo $cmpType->company_type; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">Adresa kompanije /</small></label>
                                    <input type="text" name="company_address" class="def-input" value="<?php echo $myData->company_address; ?>" />
                                </div>
                                <?php if($statusCode): ?>
                                    <?php if($statusCode == 200): ?>
                                        <p class="text-success"><i class="fa fa-check"></i> Podaci su promjenjeni</p>
                                    <?php elseif($statusCode == 404): ?>
                                        <p class="text-error"><i class="fa fa-warning"></i> Desila se pogreška</p>
                                    <?php endif; ?> 
                                <?php endif; ?>
                                <div class="form-group">
                                    <button class="def-agree-btn">Izmjeni podatke</button>
                                </div>
                                </form>
                            </div>
                            <div class="col-lg-12" id="pass_data">
                                <h5 class="my-4">Izmjeni lozinku</h5>
                                <form action="<?php echo site_url('profile/changepassword'); ?>" method="POST">
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">Stara lozinka /</small></label>
                                    <input type="password" class="def-input" name="old_password" placeholder="****" />
                                </div>
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">Nova lozinka /</small></label>
                                    <input type="password" class="def-input" name="new_password" placeholder="****"  />
                                </div>
                                <div class="form-group">
                                    <label><small class="text-secondary pr-2">Ponovi novu lozinku /</small></label>
                                    <input type="password" class="def-input" name="new_repeated_password" placeholder="****"  />
                                </div>
                                <?php if($statusCode): ?>
                                    <?php if($statusCode == 500): ?>
                                        <p class="text-success"><i class="fa fa-check"></i> Lozinka je izmjenjena</p>
                                    <?php elseif($statusCode == 504): ?>
                                        <p class="text-error"><i class="fa fa-warning"></i> Desila se pogreška</p>
                                    <?php endif; ?> 
                                <?php endif; ?>
                                <div class="form-group">
                                    <button class="def-agree-btn">Promjeni lozinku</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

</div>
<!-- EOF: Template -->

<!-- Footer -->
<?php echo $footer; ?>