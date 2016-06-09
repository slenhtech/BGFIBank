<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Le Groupe BGFIBank est la première banque d'Afrique Centrale et fait partie du premier tiers des banques africaines les plus importante. Le groupe est implanté dans 10 pays de la zone CEMAC, 2 pays de la zone UEMAO, dans l'Océan Indien et l'Europe." />
    <meta property="og:url"  content="http://www.bgfi.com" />
    <meta property="og:type" content="business.business" />
    <meta property="og:title" content="BGFIBank" />
    <meta property="og:description" content="Le Groupe BGFIBank est la première banque d'Afrique Centrale et fait partie du premier tiers des banques africaines les plus importante. Le groupe est implanté dans 10 pays de la zone CEMAC, 2 pays de la zone UEMAO, dans l'Océan Indien et l'Europe." />
    <title>Bienvenue sur BGFI Bank</title>
    <?php wp_head(); ?>
</head>
<body>
<div class="content">
    <!-- ============================
             header
    ============================== -->
    <header>
        <div class="container">
            <div class="top-nav row">
                <div class="col-sm-4 col-xs-4 left">
                    <a href="<?php echo home_url();?>" class="logo"><img src="<?php echo get_template_directory_uri();?>/img/logo.png" height="80" alt="Logo BGFI"/></a>
                </div> <!-- end of logo BGFI -->

                <div class="col-sm-8 col-xs-8 right">
                    <div class="socialNetworks hidden-xs">
                        <?php
                        $menu_name = "reseaux sociaux";
                        $nav_menu = wp_get_nav_menu_items($menu_name);
                        foreach ($nav_menu as $item):?>
                        <a href="<?php echo $item->url;?>" target="_blank" class="fa fa-<?php echo $item->post_name;?> fa-lg"></a>
                        <?php endforeach;
                        ?>
                    </div> <!-- end of social networks -->
                    <div class="countrySwitcher dropdown">
                        <button class="dropdown-toggle" data-toggle="dropdown">Gabon</button>
                        <div class="dropdown-menu" id="countryList">
                            <div class="row">
                                <ul class="col-sm-6">
                                    <li>Gabon</li>
                                    <li>Bénin</li>
                                    <li>Sao Tomé et Principe</li>
                                    <li>Congo</li>
                                    <li>Guinée équatoriale</li>
                                    <li>Côte d’Ivoire</li>
                                    <li>Europe</li>
                                    <li>Madagascar</li>
                                    <li>Cameroun</li>
                                    <li>RDC</li>
                                    <li>Sénégal</li>
                                </ul>
                            </div>

                        </div>
                    </div> <!-- end of country switcher -->
                    <div class="bgfiOnlineLink">
                        <a href="http://www.bgfionline.com/" >BGFIOnline <small>Accès direct à vos comptes</small></a>
                    </div>
                </div><!-- end of right -->
            </div>
        </div>
    </header>
    <!-- ============================
             Nav menu
    ============================== -->

    <nav class="nav">
        <div class="container">
            <div class="navbar navbar-static">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#dropdown">
                        Menu &nbsp; <i class="fa fa-bars fa-lg"></i>
                    </button>
                </div>
                <!--<div class="collapse navbar-collapse js-navbar-collapse">
                <?php /*wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'nav navbar-nav',
                    'walker' => new Walker_Nav_Primary()
                ));*/?>
                </div>-->
                <div class="collapse navbar-collapse" id="dropdown">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'nav navbar-nav',
                        /*'walker' => new Walker_Nav_Primary()*/
                    ));?>
                    <!--<ul class="nav navbar-nav">
                        <li><a href="<?php /*home_url();*/?>"><i class="fa fa-home fa-lg"></i> &nbsp; Accueil</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nous connaître<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                
                            </ul>
                        </li>
                    </ul>-->
                </div>
            </div>
        </div>
    </nav>