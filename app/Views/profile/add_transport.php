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

                <form action="<?php echo site_url('profile/save_transport'); ?>" method="POST">
                    <div class="row mt-4">

                        <div class="col-lg-12">
                            <?php if($statusCode): ?>
                                <?php if($statusCode == 200): ?>
                                <div class="alert-box box-success">
                                    <div class="box-content">
                                        <h3>Vaš transport je kreiran!</h3>
                                        <p>Vaš transport je dostupan na uvid svim firmama. Želimo Vam sreću u pronalasku tereta i sretan put!
                                        </p>
                                    </div>
                                    <div class="box-footer">
                                        <a href="<?php echo site_url('profile/add_transport'); ?>">Kreiraj novi</a>
                                        <a href="<?php echo site_url('search/quick?_sid=1'); ?>">Potraži teret</a>
                                    </div>
                                </div>
                                <?php elseif($statusCode == 404): ?>
                                <div class="alert-box box-error">
                                    <div class="box-content">
                                        <h3>Vaš transport nije kreiran!</h3>
                                        <p>Pregledajte sva polja koja ste ostavili prazna. Ako ni tada ne možete kreirati stavku obratite se 
                                            našoj tehničkoj službi!
                                        </p>
                                    </div>
                                    <div class="box-footer">
                                        <a href="<?php echo site_url('profile/add_transport'); ?>">Kreiraj novi</a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php else: ?>
                        </div>
                        

                        <div class="col-lg-12">
                            <h5 class="pb-3">Dodaj transport</h5>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label><small class="text-secondary pr-2">Opis vozila /</small></label>
                                <textarea rows="2" name="vechicle_desc" class="form-control no-resize def-cla-input" placeholder="Kamion sa prikolicom do 10 tona"></textarea>
                            </div>
                            <div class="form-group">
                                <label><small class="text-secondary pr-2">Opis rute /</small></label>
                                <textarea rows="2" name="route_desc" class="form-control no-resize def-cla-input" placeholder="Svi planirani gradovi ili zemlje"></textarea>
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

                        <div class="col-lg-12 text-right mt-4">
                            <button class="def-btn">Kreiraj transport</button>
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