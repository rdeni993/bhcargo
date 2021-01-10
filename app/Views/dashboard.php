<!-- Header -->
<?php echo $header; ?>

<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <div class="container web-content" id="mainVueApp">
        <div class="row py-80">
            <?php if($display_section == 'c' || $display_section == 'C'): ?>
            <div class="col-lg-12" id="active_cargo">
                <table class="def-table table table-striped">
                    <h5>Aktivni teret</h5>
                    <div class="def-pagination my-4">
                        <?php $cargoRows = ceil($cargoData['rows'] / DEF_DB_LIMIT); ?>
                        <ul>
                            <?php if($pageNumber > 1): ?>
                            <li><a href="<?php echo site_url('dashboard?_sec=c&page=' . ($pageNumber - 1) ); ?>">Prethodna</a></li>
                            <?php else: ?>
                            <li class="text-secondary">Prethodna</li>
                            <?php endif; ?>
                            <li>
                                <select onchange="changeCargoPage()" id="def-pagination">
                                    <?php if(@$cargoRows): ?>
                                        <?php for($row = 1; $row <= $cargoRows; $row++): ?>
                                            <option value="<?php echo $row; ?>" <?php if($pageNumber == $row){ echo "selected"; } ?>> <?php echo $row; ?> </option>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </select>
                            </li>
                            <?php if($pageNumber < $cargoRows): ?>
                            <li><a href="<?php echo site_url('dashboard?_sec=c&page=' . ($pageNumber + 1) ); ?>">Sljedeća</a></li>
                            <?php else: ?>
                            <li class="text-secondary">Sljedeća</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <thead>
                        <tr>
                            <th colspan="2"><small class="text-secondary pr-2">Utovar /</small></th>
                            <th colspan="2"><small class="text-secondary pr-2">Istovar /</small></th>
                            <th><small class="text-secondary pr-2">Tip pakovanja /</small></th>
                            <th><small class="text-secondary pr-2">Veličina /</small></th>
                            <th><small class="text-secondary pr-2">Težina /</small></th>
                            <th><small class="text-secondary pr-2">Opcije /</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$cargoData['data']): ?>
                            <?php foreach($cargoData['data'] as $c): ?>

                                <tr>
                                    <td class="only-mob">                                        
                                        <?php if($c->loading_date == date('Y-m-d', time())): ?>
                                            <i title="Ponuda završava do kraja dana" class="fa fa-eercast text-warning mr-3"></i>
                                        <?php elseif($c->loading_date > date('Y-m-d', time())): ?>
                                            <i title="Ponuda aktivna" class="fa fa-eercast text-success mr-3"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Utovar /</small></td>
                                    <td>
                                        <?php if($c->loading_date == date('Y-m-d', time())): ?>
                                            <i title="Ponuda završava do kraja dana" class="fa fa-eercast text-warning mr-3 only-desktop"></i>
                                        <?php elseif($c->loading_date > date('Y-m-d', time())): ?>
                                            <i title="Ponuda aktivna" class="fa fa-eercast text-success mr-3 only-desktop"></i>
                                        <?php endif; ?>
                                        <?php echo getFlag($c->loading_country); ?>
                                        <?php echo $c->loading_town; ?>
                                    </td>
                                    <?php $t = strtotime($c->loading_date); ?>
                                    <td><?php echo date('d. M Y', $t);?></td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Istovar /</small></td>
                                    <td>
                                        <?php echo getFlag($c->unloading_country); ?>
                                        <?php echo $c->unloading_town; ?>
                                    </td>
                                    <?php $t = strtotime($c->unloading_date); ?>
                                    <td><?php echo date('d. M Y', $t);?></td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Tip pakovanja /</small></td>
                                    <td><?php echo $c->package_type; ?></td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Veličina /</small></td>
                                    <td><?php echo $c->cargo_size; ?>m</td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Težina /</small></td>
                                    <td><?php echo $c->cargo_weight; ?>kg</td>
                                    <td>
                                        <a class="mr-2" href="<?php echo site_url('cargo/expanded?cargoID=' . $c->id); ?>"><small>Pogledaj</small></a>
                                        <a class="border-left pl-2" onclick="return window.confirm('Da li sigurni?');" href="<?php echo site_url('cargo/delete?cargoID=' . $c->id); ?>"><small>Obrisi</small></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php elseif($display_section == 't' || $display_section == 'T'): ?>
            <div class="col-lg-12" id="active_transport">
                <table class="def-table table table-striped">
                    <h5 class="">Moj aktivni transport</h5>

                    <div class="def-pagination my-4">
                        <?php $cargoRows = ceil($transportData['rows'] / DEF_DB_LIMIT); ?>
                        <ul>
                            <?php if($pageNumber > 1): ?>
                            <li><a href="<?php echo site_url('dashboard?_sec=t&page=' . ($pageNumber - 1) ); ?>">Prethodna</a></li>
                            <?php else: ?>
                            <li class="text-secondary">Prethodna</li>
                            <?php endif; ?>
                            <li>
                                <select onchange="changeTransportPage()" id="def-pagination">
                                    <?php if(@$cargoRows): ?>
                                        <?php for($row = 1; $row <= $cargoRows; $row++): ?>
                                            <option value="<?php echo $row; ?>" <?php if($pageNumber == $row){ echo "selected"; } ?>> <?php echo $row; ?> </option>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </select>
                            </li>
                            <?php if($pageNumber < $cargoRows): ?>
                            <li><a href="<?php echo site_url('dashboard?_sec=t&page=' . ($pageNumber + 1) ); ?>">Sljedeća</a></li>
                            <?php else: ?>
                            <li class="text-secondary">Sljedeća</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <thead>
                        <tr>
                            <th colspan="2"><small class="text-secondary pr-2">Utovar /</small></th>
                            <th colspan="2"><small class="text-secondary pr-2">Istovar /</small></th>
                            <th><small class="text-secondary pr-2">Vozilo /</small></th>
                            <th><small class="text-secondary pr-2">Opcije /</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$transportData['data']): ?>
                            <?php foreach($transportData['data'] as $c): ?>
                                <tr>
                                    <td class="only-mob">
                                        <?php if($c->loading_date == date('Y-m-d', time())): ?>
                                            <i title="Ponuda završava do kraja dana" class="fa fa-eercast text-warning mr-3"></i>
                                        <?php elseif($c->loading_date > date('Y-m-d', time())): ?>
                                            <i title="Ponuda aktivna" class="fa fa-eercast text-success mr-3"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Utovar /</small></td>
                                    <td>
                                       <?php if($c->loading_date == date('Y-m-d', time())): ?>
                                            <i title="Ponuda završava do kraja dana" class="fa fa-eercast text-warning mr-3 only-desktop"></i>
                                        <?php elseif($c->loading_date > date('Y-m-d', time())): ?>
                                            <i title="Ponuda aktivna" class="fa fa-eercast text-success mr-3 only-desktop"></i>
                                        <?php endif; ?>
                                        <?php echo getFlag($c->loading_country); ?> <?php echo $c->loading_town; ?>
 
                                    </td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Istovar /</small></td>
                                    <?php $t = strtotime($c->loading_date); ?>
                                    <td><?php echo date('d. M Y', $t);?></td>
                                    <td><?php echo getFlag($c->unloading_country); ?> <?php echo $c->unloading_town; ?></td>
                                    <?php $t = strtotime($c->unloading_date); ?>
                                    <td><?php echo date('d. M Y', $t);?></td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Vozilo /</small></td>
                                    <td><?php echo $c->vechicle_desc; ?></td>
                                    <td>
                                        <a class="mr-2" href="<?php echo site_url('transport/expanded?transportID=' . $c->id); ?>"><small>Pogledaj</small></a>
                                        <a class="border-left pl-2" onclick="return window.confirm('Da li ste sigurni?');"  href="<?php echo site_url('transport/delete?transportID=' . $c->id); ?>"><small>Obrisi</small></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php elseif($display_section == 's' || $display_section == 'S'): ?>
            <div class="col-lg-12" id="filters">
                <h5>Potraži</h5>
                <form action="<?php echo site_url('search'); ?>" method="GET">
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label><small class="text-secondary pr-2">Tip pretrage /</small></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="_sec" value="c" checked>
                                    <label class="form-check-label" for="inlineRadio1">Teret</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="_sec" value="t">
                                    <label class="form-check-label" for="inlineRadio2">Transport</label>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label><small class="text-secondary pr-2">Zemlja Utovara /</small></label>
                            <select name="loading_country" class="form-control def-cla-input">
                                <?php echo $countrySelect; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label><small class="text-secondary pr-2">Grad Utovara /</small></label>
                            <input type="text" name="loading_town" placeholder="Grad Utovara" class="form-control def-cla-input" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label><small class="text-secondary pr-2">Datum Utovara /</small></label>
                            <input type="date" name="loading_date" class="form-control def-cla-input" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label><small class="text-secondary pr-2">Zemlja Istovara /</small></label>
                            <select name="unloading_country" class="form-control def-cla-input">
                                <?php echo $countrySelect; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label><small class="text-secondary pr-2">Grad Istovara /</small></label>
                            <input type="text" name="unloading_town" placeholder="Grad Istovara" class="form-control def-cla-input" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label><small class="text-secondary pr-2">Datum Istovara/</small></label>
                            <input type="date" name="unloading_date" class="form-control def-cla-input" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group text-right">
                            <button class="def-agree-btn">Potraži</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<!-- EOF: Template -->
<script>

    function changeCargoPage(){
        var element = document.getElementById('def-pagination').value;
        return window.location.href = baseUrl('dashboard?_sec=c&page=' + element);
    }
    function changeTransportPage(){
        var element = document.getElementById('def-pagination').value;
        return window.location.href = baseUrl('dashboard?_sec=t&page=' + element);
    }

</script>

<!-- Footer -->
<?php echo $footer; ?>