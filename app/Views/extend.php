<!-- Header -->
<?php echo $header; ?>

<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <?php 
    
    $notReady = true;

    if($notReady):
    ?>
    <div class="container web-content" id="mainVueApp">
        <div class="row py-80 paying-site">
            <div class="col-lg-12">
                <h1>Usluga plaćanja još uvijek nije moguća!</h1>
                <p>Ne brinite se za trajanje Vašeg naloga, ukoliko usluga ne bude omogućena do isteka trajanja
                    Istek roka vašeg naloga se produžava automatski!
                </p>
            </div>
        </div>
    </div>

    <?php else: ?>

    <div class="container web-content" id="mainVueApp">
        <div class="row py-80 paying-site">
            <div class="col-lg-4">
                <div class="card mt-3">
                    <div class="card-header bg-white text-primary">
                        <span>
                            <h4>
                                <i class="fa fa-calendar mr-3"></i> Sedmična ponuda
                            </h4>
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="text-secondary"><small>Koristite sve usluge BHCargo servisa 7 dana bez ograničavanja.<br>
                        Usluga namjenjena osobama koje svoje proizvode rijetko šalju poštom ali
                        im je ipak povremeno potrebna pomoć u pronalasku savršenog partnera.</small></p>
                    </div>
                    <div id="week-subs" class="card-footer"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mt-3">
                    <div class="card-header bg-white text-primary">
                        <span>
                            <h4>
                                <i class="fa fa-calendar mr-3"></i> Mjesečna ponuda
                            </h4>
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <p class="text-secondary"><small>
                        Koristite sve usluge BHCargo servisa 30 dana bez ograničavanja.
                        <br>Ukoliko Vam usluge trebaju često a ne želite se vezati za
                        duži period onda je ova usluga odličan izbor za Vas.
                        </small></p>
                    </div>
                    <div class="card-footer" id="month-subs"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mt-3">
                    <div class="card-header bg-white text-primary">
                        <span>
                            <h4 class="text-inline">
                                <i class="fa fa-calendar mr-3"></i> Godišnja pretplata
                            </h4>
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <p class="text-secondary">
                        <small>
                        Koristite sve usluge BHCargo servisa godinu dana bez ograničavanja.
                        <br>Usluga za osobe ili kompanije koje se konstanto bave
                        poslovima transporta ili kojima je transport kontantno neophodan.
                        </small>
                        </p>
                    </div>
                    <div class="card-footer" id="year-subs"></div>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>
<!-- EOF: Template -->


<!-- Footer -->
<?php echo $footer; ?>