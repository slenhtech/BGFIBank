<?php
/*
  ======================================
    Collection of walker classes
  ======================================
 */

class Walker_Nav_Primary extends Walker_Nav_Menu{
    function start_lvl(&$output, $depth = 0, $args = array()) // ul
    {
        $indent = str_repeat("\t", $depth);
        $submenu = ($depth > 0 ) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu dropdown-menu-large row depth_$depth\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) //li span
    {
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = ($args->walker->has_children) ? 'dropdown dropdown-large' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'menu-item' . $item->ID;
        if( $depth && $args->walker->has_children ){
            $classes[] = 'dropdown-menu dropdown-menu-large';
        }
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="'. esc_attr( $id ) .'"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = ! empty( $item->attr_title ) ? ' title="'. esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="'. esc_attr($item->target) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="'. esc_attr($item->xfn) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="'. esc_attr($item->url) .'"' : '';

        $attributes .= ! ( $args->walker->has_children ) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before .apply_filters('the_title', $item->title, $item->ID . $args->link_after);
        $item_output .= ( $depth == 0 && $args->walker->has_children ) ? '<b class="caret"></b>' : '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}










/*
<ul class="nav navbar-nav">
    <li class="dropdown dropdown-large">
        <a href="<?php echo home_url();?>">Accueil</a>
    </li>
    <li class="dropdown dropdown-large">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nous connaître <b class="caret"></b></a>

        <ul class="dropdown-menu dropdown-menu-large row">
            <li class="col-sm-12">
                <ul>
                    <li><a href="<?php echo  get_permalink(39);?>"><?php echo get_the_title(39);*/?><!--</a></li>
                    <li><a href="#"><?php /*echo get_the_title(48);*/?></a></li>
                    <li><a href="#"><?php /*echo get_the_title(45);*/?></a></li>
                    <li><a href="#"><?php /*echo get_the_title(51);*/?></a></li>
                    <li><a href="#"><?php /*echo get_the_title(113);*/?></a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="dropdown dropdown-large">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">No métiers <b class="caret"></b></a>

        <ul class="dropdown-menu dropdown-menu-large row">
            <li class="col-sm-6">
                <ul>
                    <li class="dropdown-header">Banque Commerciale</li>
                    <li><a href="#">BGFIBank Gabon</a></li>
                    <li><a href="#">BGFIBank Bénin</a></li>
                    <li><a href="#">BGFIBank Sao Tomé et Principe</a></li>
                    <li><a href="#">BGFIBank Congo</a></li>
                    <li><a href="#">BGFIBank Guinée équatoriale</a></li>
                    <li><a href="#">BGFIBank Côte d’Ivoire</a></li>
                    <li><a href="#">BGFIBank Europe</a></li>
                    <li><a href="#">BGFIBank Madagascar</a></li>
                    <li><a href="#">BGFIBank Cameroun</a></li>
                    <li><a href="#">BGFIBank RDC</a></li>
                    <li><a href="#">BGFIBank Sénégal</a></li>
                </ul>
            </li>
            <li class="col-sm-6">
                <ul>
                    <li class="dropdown-header">Banque D’Investissement</li>
                    <li><a href="#">BGFI Bourse</a></li>
                    <li><a href="#">BGFI Capital</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Assurance</li>
                    <li><a href="#">Assinco S.A</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Services financiers spécialisés</li>
                    <li><a href="#">Finatra</a></li>
                    <li><a href="#">LOXIA</a></li>
                    <li><a href="#">Hedenia</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="dropdown dropdown-large relative">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nos engagements RSE <b class="caret"></b></a>

        <ul class="dropdown-menu dropdown-menu-large row">
            <li class="col-xs-6">
                <ul>
                    <li><a href="#"><img src="img/bbs.jpg" class="img-responsive" /></a></li>
                </ul>
            </li>
            <li class="col-xs-6">
                <ul>
                    <li><a href="#"><img src="img/fondation.jpg" class="img-responsive" /></a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="dropdown dropdown-large relative">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nous rejoindre <b class="caret"></b></a>

        <ul class="dropdown-menu dropdown-menu-large row">
            <li class="col-sm-12">
                <ul>
                    <li><a href="#">Notre politique RH</a></li>
                    <li><a href="#">Les collaborateurs dans le monde</a></li>
                    <li><a href="#">Candidature spontanée</a></li>
                    <li><a href="#">Nos offres d'emploi</a></li>
                    <li><a href="#">Nos offres de stage</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="dropdown dropdown-large">
        <a href="<?php /*echo  get_permalink(23);*/?>"><?php /*echo get_the_title(23);*/?></a>
    </li>
</ul>-->