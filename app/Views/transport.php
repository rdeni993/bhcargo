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
            </div>
            <div class="col-lg-12 my-4">
                <h5 class="pb-3">Aktivni transport</h5>
                <div class="def-pagination">
                    <ul>
                        <?php if($pageNumber > 1): ?>
                        <li><a href="<?php echo site_url('transport?page=' . ($pageNumber - 1) ); ?>">Prethodna</a></li>
                        <?php else: ?>
                        <li class="text-secondary">Prethodna</li>
                        <?php endif; ?>
                        <li>
                            <select onchange="changePage()" id="def-pagination">
                                <?php if(@$transportRows): ?>
                                    <?php for($row = 1; $row <= $transportRows; $row++): ?>
                                        <option value="<?php echo $row; ?>" <?php if($pageNumber == $row){ echo "selected"; } ?>> <?php echo $row; ?> </option>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </select>
                        </li>
                        <?php if($pageNumber < $transportRows): ?>
                        <li><a href="<?php echo site_url('transport?page=' . ($pageNumber + 1) ); ?>">Sljedeća</a></li>
                        <?php else: ?>
                        <li class="text-secondary">Sljedeća</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <table class="table table-striped def-table mt-4">
                    <thead>
                        <tr>
                            <th colspan="2"><small class="text-secondary pr-2">Utovar /</small></th>
                            <th colspan="2"><small class="text-secondary pr-2">Istovar /</small></th>
                            <th><small class="text-secondary pr-2">Vozilo /</small></th>
                            <th><small class="text-secondary pr-2">Opcije /</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$transport): ?>
                            <?php foreach($transport as $c): ?>
                                <tr>
                                    <td class="only-mob">
                                        <?php if($c->loading_date == date('Y-m-d', time())): ?>
                                            <i title="Ponuda završava do kraja dana" class="fa fa-eercast text-warning mr-3"></i>
                                        <?php elseif($c->loading_date > date('Y-m-d', time())): ?>
                                            <i title="Ponuda je aktivna" class="fa fa-eercast text-success mr-3"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Utovar /</small></td>
                                    <td>
                                        <?php if($c->loading_date == date('Y-m-d', time())): ?>
                                            <i title="Ponuda završava do kraja dana" class="fa fa-eercast text-warning mr-3 only-desktop"></i>
                                        <?php elseif($c->loading_date > date('Y-m-d', time())): ?>
                                            <i title="Ponuda je aktivna" class="fa fa-eercast text-success mr-3 only-desktop"></i>
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
                                    <td class="only-mob bg-light"><small class="text-secondary pr-2">Vozilo /</small></td>
                                    <td><?php echo $c->vechicle_desc; ?></td>

                                    <td>
                                        <?php if(user_active()): ?>
                                        <a href="<?php echo site_url('transport/expanded?transportID=' . $c->id); ?>"><small>Pogledaj</small></a>
                                        <?php else: ?>
                                        <span class="text-uppercase text-secondary">Isključeno</span>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6">Nema informacija</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- EOF: Template -->
<script>
    function changePage(){
        var element = document.getElementById('def-pagination').value;
        return window.location.href = baseUrl('transport?page=' + element);
}
</script>


<!-- Footer -->
<?php echo $footer; ?>