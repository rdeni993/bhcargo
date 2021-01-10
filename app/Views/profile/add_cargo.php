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

                <form action="<?php echo site_url('profile/save_cargo'); ?>" method="POST">
                    <div class="row mt-4">

                        <div class="col-lg-12">
                            <?php if($statusCode): ?>
                                <?php if($statusCode == 200): ?>
                                <div class="alert-box box-success">
                                    <div class="box-content">
                                        <h3>Vaš teret je kreiran!</h3>
                                        <p>Vaš teret je dostupan na uvid svim prevozničkim firmama. Želimo Vam sreću u pronalasku pravog prevoznika za Vašu robu!
                                        </p>
                                    </div>
                                    <div class="box-footer">
                                        <a href="<?php echo site_url('profile/add_cargo'); ?>">Kreiraj novi</a>
                                        <a href="<?php echo site_url('search/quick?_sid=1'); ?>">Potraži transport</a>
                                    </div>
                                </div>
                                <?php elseif($statusCode == 404): ?>
                                <div class="alert-box box-error">
                                    <div class="box-content">
                                        <h3>Vaš teret nije kreiran!</h3>
                                        <p>Pregledajte sva polja koja ste ostavili prazna. Ako ni tada ne možete kreirati stavku obratite se 
                                            našoj tehničkoj službi!
                                        </p>
                                    </div>
                                    <div class="box-footer">
                                        <a href="<?php echo site_url('profile/add_cargo'); ?>">Kreiraj novi</a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php else: ?>
                        </div>
                        
                        <div class="col-lg-12">
                            <h5 class="pb-3">Dodaj teret</h5>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label><small class="text-secondary pr-2">Opis Tereta /</small></label>
                                <textarea rows="4" name="description" class="form-control no-resize def-cla-input" placeholder="Prevoz kutije 10x10"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label><small class="text-secondary pr-2">Datum utovara /</small></label>
                                    <input type="date" class="form-control def-cla-input" name="loading_date" value="<?php echo date('Y-m-d', time()); ?>" />
                                </div>
                                <div class="col-lg-5">
                                    <label><small class="text-secondary pr-2">Grad utovara /</small></label>
                                    <input type="text" class="form-control def-cla-input" placeholder="Ime grada" name="loading_town" />
                                </div>
                                <div class="col-lg-4">
                                    <label><small class="text-secondary pr-2">Zemlja utovara /</small></label>
                                    <select name="loading_country" class="form-control def-cla-input">
                                        <?php echo $countryList; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-3">
                                    <label><small class="text-secondary pr-2">Datum istovara /</small></label>
                                    <input type="date" class="form-control def-cla-input" name="unloading_date" value="<?php echo date('Y-m-d', time()); ?>" />
                                </div>
                                <div class="col-lg-5">
                                    <label><small class="text-secondary pr-2">Grad istovara /</small></label>
                                    <input type="text" class="form-control def-cla-input" placeholder="Ime grada" name="unloading_town" />
                                </div>
                                <div class="col-lg-4">
                                    <label><small class="text-secondary pr-2">Zemlja istovara /</small></label>
                                    <select name="unloading_country" class="form-control def-cla-input">
                                        <?php echo $countryList; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mt-4">
                            <div class="form-group">
                                <label><small class="text-secondary pr-2">Tip tereta /</small></label>
                                <select name="cargo_type" class="form-control def-cla-input">
                                    <?php if($crg_type): ?>
                                        <?php foreach($crg_type as $cargo): ?>
                                            <option value="<?php echo $cargo->id; ?>"><?php echo $cargo->cargo_type; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 mt-4">
                            <div class="form-group">
                                <label><small class="text-secondary pr-2">Tip pakovanja /</small></label>
                                <select name="cargo_package" class="form-control def-cla-input">
                                    <?php if($crg_package): ?>
                                        <?php foreach($crg_package as $cargo): ?>
                                            <option value="<?php echo $cargo->id; ?>"><?php echo $cargo->package_type; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-4">
                            <div class="form-group">
                                <label><small class="text-secondary pr-2">Veličina paketa /</small></label>
                                <input type="text" class="form-control def-cla-input" name="cargo_size" placeholder="10x20x12" />
                            </div>
                        </div>

                        <div class="col-lg-2 mt-4">
                            <div class="form-group">
                                <label><small class="text-secondary pr-2">Težina paketa[kg] /</small></label>
                                <input type="number" step="0.1" class="form-control def-cla-input" name="cargo_weight" placeholder="0.5" />
                            </div>
                        </div>

                        <div class="col-lg-12 text-right">
                            <button class="def-btn">Kreiraj teret</button>
                        </div>

                    <?php endif; ?>

                    </div>
                </form>

            </div>
        </div>

    </div>

</div>
<!-- EOF: Template -->

<!-- Footer -->
<?php echo $footer; ?>