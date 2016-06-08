<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
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
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".main-nav">
                        Menu &nbsp; <i class="fa fa-bars fa-lg"></i>
                    </button>
                </div>

                <div class="collapse navbar-collapse main-nav">
                    <!--<ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="<?php /*echo home_url();*/?>">Accueil</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nous connaître <b class="caret"></b></a>

                            <ul class="dropdown-menu">
                                <li>
                                    <?php /*wp_nav_menu(array(
                                        'menu' => 'nous-connaitre',
                                        'container' => false,
                                        ''
                                    ));*/?>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nos métiers <b class="caret"></b></a>

                            <ul class="dropdown-menu"></ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nos engagements RSE <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php /*wp_nav_menu(array(
                                        'menu' => 'nos-engagements',
                                        'container' => false,
                                    ));*/?>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nous rejoindre <b class="caret"></b></a>

                            <ul class="dropdown-menu">
                                <li>
                                    <ul>
                                        <?php /*wp_nav_menu(array(
                                            'menu' => 'nous-rejoindre',
                                            'container' => false,
                                        ));*/?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-large relative">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nous rejoindre <b class="caret"></b></a>

                            <ul class="dropdown-menu dropdown-menu-large row">
                                <li class="col-sm-12">
                                    <ul>
                                        <?php /*wp_nav_menu(array(
                                            'menu' => 'nous-rejoindre',
                                            'container' => false,
                                        ));*/?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-large">
                            <a href="<?php /*echo  get_permalink(22);*/?>"><?php /*echo get_the_title(22);*/?></a>
                        </li>
                    </ul>-->
                    <?php
                    wp_nav_menu(array(
                        'container' => false,
                        'menu_class' => 'nav navbar-nav',
                        'walker' => new Walker_Nav_Primary()
                    ));
                    ;?>
                </div><!-- /.nav-collapse -->
            </div>
        </div>
    </nav>