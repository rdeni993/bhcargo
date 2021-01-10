<?php 

$userData = false;

if(logged_in()){
    $userData = get_login();
}

?>
<nav class="main-menu">
    <div class="container">
        <a href="<?php echo site_url(); ?>" class="brand">
            <img src="<?php echo base_url(); ?>/public/assets/img/logo.png" alt="logo" />
        </a>
        <ul>
            <li class="nav-menu-item"><a href="<?php echo site_url(); ?>">Početna stranica</a></li>

            <?php if(!logged_in()): ?>
                <!-- Login button only if user is not logged in -->
                <li class="nav-menu-item"><a href="<?php echo site_url('login'); ?>">Prijava</a></li>
            <?php endif; ?>


            <?php if(logged_in()): ?>

            <li>
                <div class="search-box">
                    <form action="<?php echo site_url('search/quick'); ?>" method="POST">
                        <input type="search" class="p-1" name="q" placeholder="Brza pretraga..." />
                        <button><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </li>
            
            <!-- Display Menu only if u are logged in -->
            <li><a href="<?php echo site_url('cargo'); ?>">Pregled tereta</a></li>
            <li><a href="<?php echo site_url('transport'); ?>">Pregled transporta</a></li>                        
                
            <li>
                <!-- USER MENU -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                        <?php echo $userData->name[0] . $userData->surname[0]; ?>
                    </button>

                    <div class="dropdown-menu text-right">
                        <h6 class="dropdown-item text-secondary"><?php echo $userData->name . ' ' . $userData->surname; ?> <i class="fa fa-user-circle-o ml-3"></i></h6>
                        <div class="dropdown-divider"></div>

                        <a href="<?php echo site_url('dashboard?_sec='); ?>c" class="dropdown-item text-uppercase">Moj teret <i class="fa fa-ticket ml-3"></i></a>
                        <a href="<?php echo site_url('dashboard?_sec='); ?>t" class="dropdown-item text-uppercase">Moj transport <i class="fa fa-truck ml-3"></i></a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo site_url('profile/add_cargo'); ?>" class="dropdown-item text-uppercase">Dodaj teret <i class="fa fa-plus ml-3"></i></a>
                        <a href="<?php echo site_url('profile/add_transport'); ?>" class="dropdown-item text-uppercase">Dodaj transport <i class="fa fa-plus ml-3"></i></a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo site_url('dashboard?_sec='); ?>s" class="dropdown-item text-uppercase">Pretraga <i class="fa fa-search ml-3"></i></a>
                        <div class="dropdown-divider"></div>
                        
                        <a href="<?php echo site_url('profile/edit'); ?>" class="dropdown-item text-uppercase">Izmjeni profil <i class="fa fa-pencil ml-3"></i></a>
                        <a href="<?php echo site_url('extend'); ?>" class="dropdown-item text-uppercase">Produži trajanje <i class="fa fa-history ml-3"></i></a>
                        <div class="dropdown-divider mb-0"></div>

                        <?php 
                            $usrDate = strtotime($userData->exp_date);
                            $ago = 0;
                            $expiredDate = $usrDate - time();
                            $expired = true;

                            if($expiredDate > 0){
                                $expired = false;
                                $ago = ($expiredDate) / ( 60 * 60 * 24 );
                            }

                        ?>
                        <p class="dropdown-item text-error text-uppercase my-0 py-2 text-white <?php if($expired > (float)0.0){ echo 'bg-danger'; }else{ echo 'bg-success'; } ?>">
                            Istek naloga<br> 
                            <?php $thisTime = strtotime($userData->exp_date); echo date('d. M Y', $thisTime); ?><br>
                            <?php if(user_active()): ?>
                            <?php 
                                switch($ago){
                                    case ($ago > 0.0 && $ago < 1) : { echo "Istek za manje od 24h"; } break;
                                    case ($ago > 1 && $ago < 2) : { echo "Istek za manje od 48h"; } break;
                                    case ($ago > 1 && $ago < 6) : { echo "Istek ove sedmice"; } break;
                                    case ($ago > 6 && $ago < 30) : { echo "Istek ovog mjeseca"; } break;
                                    case ($ago > 30) : { echo ""; } break;
                                    default : { echo "Nalog je istekao"; }  
                                };
                            
                            ?>
                            <?php endif; ?>
                        </p>

                        <div class="dropdown-divider mt-0"></div>
                        <a href="<?php echo site_url('login/logout'); ?>" class="dropdown-item text-uppercase">Odjavi se <i class="fa fa-sign-out ml-3"></i></a>
                    </div>

                </div>
                <!-- EOF USER MENU -->
                </li>
                <?php endif; ?>

                <?php if(!logged_in()): ?>
                    <li class="nav-menu-item"><a href="<?php echo site_url('register'); ?>">Registriraj se</a></li>
                <?php endif; ?>

                <li class="only-mob-display"><a href="#"><i class="fa fa-bars"></i></a></li>
    
        </ul>
    </div>
</nav>

<!-- Mobile part -->
<nav class="mobile-main-menu only-mob">
    <div class="brand">
        <a href="<?php echo site_url(); ?>">
            <img src="<?php echo base_url(); ?>/public/assets/img/logo.png" alt="logo" />
        </a>
    </div>
    <div class="menu">
        <button id="basic-main-menu-activator"><i class="fa fa-bars"></i></button>
        <?php if(logged_in()): ?>
            <button id="profile-main-menu-activator"><i class="fa fa-user"></i></button>
        <?php endif; ?>
    </div>
</nav>

<div class="main-menu-list" id="basic-main-menu">
        <ul>
            <li><a href="<?php echo site_url(); ?>">Početna stranica</a></li>
            <?php if(logged_in()): ?>
                <li><a href="<?php echo site_url('cargo'); ?>">Pregled tereta</a></li>
                <li><a href="<?php echo site_url('transport'); ?>">Pregled transporta</a></li>
            <?php else: ?>
                <li><a href="<?php echo site_url('login'); ?>">Prijavi se</a></li>
                <li><a href="<?php echo site_url('register'); ?>">Registriraj se</a></li>
            <?php endif; ?>
        </ul>
</div>

<div class="main-menu-list" id="profile-main-menu">
        <ul>
            <?php if(logged_in()): ?>
            <li><a href="<?php echo site_url('dashboard?_sec='); ?>c"><i class="fa fa-ticket mr-3"></i> Moj teret</a></li>
            <li class="border-bottom pb-3"><a href="<?php echo site_url('dashboard?_sec='); ?>t"><i class="fa fa-truck mr-3"></i> Moj transport</a></li>
            <li class="pt-3"><a href="<?php echo site_url('profile/add_cargo'); ?>"><i class="fa fa-plus mr-3"></i> Dodaj teret</a></li>
            <li class="border-bottom pb-3"><a href="<?php echo site_url('profile/add_transport'); ?>"><i class="fa fa-plus mr-3"></i> Dodaj transport</a></li>
            <li class="border-bottom py-3"><a href="<?php echo site_url('dashboard?_sec='); ?>s"><i class="fa fa-search mr-3"></i> Pretraga</a></li>
            <li class="pt-3"><a href="<?php echo site_url('profile/edit'); ?>"><i class="fa fa-pencil mr-3"></i> Izmjeni profil</a></li>
            <?php $expirationDate = strtotime($userData->exp_date); ?>
            <li class="border-bottom py-3"><a href="<?php echo site_url('extend'); ?>"><i class="fa fa-history mr-3"></i> Produži trajanje <small>[Ativan do: <?php echo date('d. M Y', $expirationDate); ?>]</small></a></li>
            <li><a href="<?php echo site_url('login/logout'); ?>"><i class="fa fa-sign-out mr-3"></i> Odjavi se</a></li>
            <?php endif; ?>
        </ul>
</div>