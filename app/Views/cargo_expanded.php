<!-- Header -->
<?php echo $header; ?>
<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <div class="container web-content">
        <div class="row py-80">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 my-4"><small class="text-secondary pr-2">Jedinstveni broj tereta /</small> <?php echo $cargo->cid; ?></div>
                    <div class="col-lg-4">
                        <h5><b>Kompanija</b></h5>
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Kontakt osoba / <br></small>
                                <?php printf("%s %s", $cargo->name, $cargo->surname) ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Telefon / <br></small>
                                <?php echo $cargo->phone; ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">E-mail / <br></small>
                                <?php echo $cargo->email; ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Ime kompanije / <br></small>
                                <?php echo $cargo->company; ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Adresa kompanije / <br></small>
                                <?php echo $cargo->company_address; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5><b>Utovar</b></h5>
                        <ul class="list-group border-0">

                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Datum utovara / <br></small>
                                <?php $t = strtotime($cargo->loading_date); ?>
                                <?php echo date('d. M Y', $t); ?>
                            </li>

                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Zemlja utovara / <br></small>
                                <?php echo getFlag($cargo->loading_country); ?>
                                <span class="ml-2"><?php echo countryCode($cargo->loading_country); ?></span>
                            </li>

                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Grad utovara / <br></small>
                                <?php echo $cargo->loading_town; ?>
                            </li>
                            
                            <li class="list-group-item border-0 py-1 px-0 mt-4">
                                <small class="text-secondary pr-2">Tip pakovanja / <br></small>
                                <?php echo $cargo->package_type; ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Vrsta robe / <br></small>
                                <?php echo $cargo->cargo_type; ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Veličina pakovanja[m] / <br></small>
                                <?php echo $cargo->cargo_size; ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Težina pakovanja[kg] / <br></small>
                                <?php echo $cargo->cargo_weight; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5><b>Istovar</b></h5>
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Datum istovara / <br></small>
                                <?php $t = strtotime($cargo->unloading_date); ?>
                                <?php echo date('d. M Y', $t); ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Zemlja istovara / <br></small>
                                <?php echo getFlag($cargo->unloading_country); ?>
                                <span class="ml-2"><?php echo countryCode($cargo->unloading_country); ?></span>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Grad istovara / <br></small>
                                <?php echo $cargo->unloading_town; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- EOF: Template -->

<!-- Footer -->
<?php echo $footer; ?>

