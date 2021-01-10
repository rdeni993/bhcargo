<!-- Header -->
<?php echo $header; ?>

<?php 

$validUri = false;
parse_str($_SERVER['QUERY_STRING'], $validUri);
unset($validUri['page']);
$rebuildedUri = http_build_query($validUri);


?>
<!-- Template -->
<div class="container-fluid p-0 m-0 def-font">
    <!-- Navigation -->
    <?php echo $nav; ?>
    <!-- EOF: Navigation -->

    <div class="container web-content" id="mainVueApp">
        <div class="row py-80">
            <div class="col-lg-12">
            <?php if($searchType == 'c' || $searchType == 'C'): ?>
            <div class="col-lg-12" id="active_cargo">  
                <h5 class="pb-3">Pretraga tereta</h5>   
                <?php if(!$disablePagination): ?>     
                <div class="def-pagination mb-4">
                    <ul>
                        <?php if($pageNumber > 1): ?>
                        <li><a href="<?php echo site_url('search?' . $rebuildedUri . '&page=' . ($pageNumber-1) ) ?>">Prethodna</a></li>
                        <?php else: ?>
                        <li class="text-secondary">Prethodna</li>
                        <?php endif; ?>
                        <li>
                            <select onchange="changePage()" id="def-pagination">
                                <?php if(@$searchRows): ?>
                                    <?php for($row = 1; $row <= $searchRows; $row++): ?>
                                        <option value="<?php echo $row; ?>" <?php if($pageNumber == $row){ echo "selected"; } ?>> <?php echo $row; ?> </option>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </select>
                        </li>
                        <?php if($pageNumber < $searchRows): ?>
                        <?php 
  

                        ?>
                        <li><a href="<?php echo site_url('search?' . $rebuildedUri . '&page=' . ($pageNumber+1) ) ?>">Sljedeća</a></li>
                        <?php else: ?>
                        <li class="text-secondary">Sljedeća</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <table class="def-table table table-striped mt-4">
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
                        <?php if(@$searchData): ?>
                            <?php foreach($searchData as $c): ?>
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
                                        <img src="<?php echo base_url('public/assets/img/flags/' .$c->loading_country . '.png'); ?>" alt="flag">
                                        <?php echo $c->loading_town; ?>
                                    </td>
                                    <?php $t = strtotime($c->loading_date); ?>
                                    <td><?php echo date('d. M Y', $t);?></td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Istovar /</small></td>
                                    <td>
                                        <img src="<?php echo base_url('public/assets/img/flags/' .$c->unloading_country . '.png'); ?>" alt="flag">
                                        <?php echo $c->unloading_town; ?>
                                    </td>
                                    <?php $t = strtotime($c->unloading_date); ?>
                                    <td><?php echo date('d. M Y', $t);?></td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Tip pakovanja /</small></td>
                                    <td><?php echo $c->package_type; ?></td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Veličina tereta/</small></td>
                                    <td><?php echo $c->cargo_size; ?>m</td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Težina tereta /</small></td>
                                    <td><?php echo $c->cargo_weight; ?>kg</td>
                                    <td>
                                        <?php if(user_active()): ?>
                                            <a class="mr-2" href="<?php echo site_url('cargo/expanded?cargoID=' . $c->cid); ?>"><small>Pogledaj</small></a> 
                                        <?php else: ?>
                                            <span class="text-uppercase text-secondary">Isključeno</span>        
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="9">Nema informacija</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php elseif($searchType == 't' || $searchType == 'T'): ?>
            <div class="col-lg-12" id="active_transport">
                <h5 class="pb-3">Pretraga transporta</h5>
                <?php if(!$disablePagination): ?>     
                <div class="def-pagination mb-4">
                    <ul>
                        <?php if($pageNumber > 1): ?>
                        <li><a href="<?php echo site_url('search?' . $rebuildedUri . '&page=' . ($pageNumber-1) ) ?>">Prethodna</a></li>
                        <?php else: ?>
                        <li class="text-secondary">Prethodna</li>
                        <?php endif; ?>
                        <li>
                            <select onchange="changePage()" id="def-pagination">
                                <?php if(@$searchRows): ?>
                                    <?php for($row = 1; $row <= $searchRows; $row++): ?>
                                        <option value="<?php echo $row; ?>" <?php if($pageNumber == $row){ echo "selected"; } ?>> <?php echo $row; ?> </option>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </select>
                        </li>
                        <?php if($pageNumber < $searchRows): ?>
                        <?php 
  

                        ?>
                        <li><a href="<?php echo site_url('search?' . $rebuildedUri . '&page=' . ($pageNumber+1) ) ?>">Sljedeća</a></li>
                        <?php else: ?>
                        <li class="text-secondary">Sljedeća</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <table class="def-table table table-striped mt-4">
                    <thead>
                        <tr>
                            <th colspan="2"><small class="text-secondary pr-2">Utovar /</small></th>
                            <th colspan="2"><small class="text-secondary pr-2">Istovar /</small></th>
                            <th><small class="text-secondary pr-2">Vozilo /</small></th>
                            <th><small class="text-secondary pr-2">Opcije /</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$searchData): ?>
                            <?php foreach($searchData as $c): ?>
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
                                    <?php $t = strtotime($c->loading_date); ?>
                                    <td><?php echo date('d. M Y', $t);?></td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Istovar /</small></td>
                                    <td><?php echo getFlag($c->unloading_country); ?> <?php echo $c->unloading_town; ?></td>
                                    <?php $t = strtotime($c->unloading_date); ?>
                                    <td><?php echo date('d. M Y', $t);?></td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Vozilo /</small></td>
                                    <td><?php echo $c->vechicle_desc; ?></td>
                                    <td>
                                        <?php if(user_active()): ?>
                                        <a class="mr-2" href="<?php echo site_url('transport/expanded?transportID=' . $c->tid); ?>"><small>Pogledaj</small></a>
                                        <?php else: ?>
                                        <span>ISKLJUČENO</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <td colspan="6">Nema aktivnih podataka!</td>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<!-- EOF: Template -->
<script>
    function changePage(){
        var element = document.getElementById('def-pagination').value;
        var currentUri = window.location.search;
        var posUri = currentUri.indexOf('&page');
        if(posUri > 0){
            var validUri = currentUri.substr(0, posUri);
        } else {
            var validUri = currentUri;
        }
        return window.location.href = validUri + '&page=' + element;
}
</script>

<!-- Footer -->
<?php echo $footer; ?>