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
                    <div class="col-lg-12 my-4"><small class="text-secondary pr-2">Jedinstveni broj transporta /</small> <?php echo $transport->tid; ?></div>
                    <div class="col-lg-4">
                        <h5><b>Kompanija</b></h5>
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Kontakt osoba / <br></small>
                                <?php printf("%s %s", $transport->name, $transport->surname) ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Telefon / <br></small>
                                <?php echo $transport->phone; ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Ime kompanije / <br></small>
                                <?php echo $transport->company; ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Adresa kompanije / <br></small>
                                <?php echo $transport->company_address; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5><b>Utovar</b></h5>
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Datum utovara / <br></small>
                                <?php $t = strtotime($transport->loading_date); ?>
                                <?php echo date('d. M Y', $t); ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Zemlja utovara / <br></small>
                                <?php echo getFlag($transport->loading_country); ?>
                                <span class="ml-2"><?php echo countryCode($transport->loading_country); ?></span>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Grad utovara / <br></small>
                                <?php echo $transport->loading_town; ?>
                            </li>
                            
                            <li class="list-group-item border-0 py-1 px-0 mt-4">
                                <small class="text-secondary pr-2">Vozilo / <br></small>
                                <?php echo $transport->vechicle_desc; ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Opis rute / <br></small>
                                <?php echo $transport->route_desc; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5><b>Istovar</b></h5>
                            <ul class="list-group border-0">
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Datum istovara / <br></small>
                                <?php $t = strtotime($transport->unloading_date); ?>
                                <?php echo date('d. M Y', $t); ?>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Zemlja istovara / <br></small>
                                <?php echo getFlag($transport->unloading_country); ?> 
                                <span class="ml-2"><?php echo countryCode($transport->unloading_country); ?></span>
                            </li>
                            <li class="list-group-item border-0 py-1 px-0">
                                <small class="text-secondary pr-2">Grad istovara / <br></small>
                                <?php echo $transport->unloading_town; ?>
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

