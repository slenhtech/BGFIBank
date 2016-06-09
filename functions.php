<?php
/*
  ======================================
    Include scripts
  ======================================
 */

function bgfi_script_enqueue(){
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(),'3.3.5', 'all');
    wp_enqueue_style('OwlCarousel', get_template_directory_uri().'/plugins/owl.carousel/assets/owl.carousel.min.css', array(),'4.5.0', 'all');
    wp_enqueue_style('OwlCarouselTheme', get_template_directory_uri().'/plugins/owl.carousel/assets/owl.theme.default.css', array(),'4.5.0', 'all');
    wp_enqueue_style('NimbusFont', get_template_directory_uri().'/fonts/nimbus/nimbus.css', array(),'1.0.0', 'all');
    wp_enqueue_style('UsenetFont', get_template_directory_uri().'/fonts/usenet/usenet.css', array(),'1.0.0', 'all');
    wp_enqueue_style('LatoFont', get_template_directory_uri().'/fonts/lato/stylesheet.css', array(),'1.0.0', 'all');
    wp_enqueue_style('Animate.css', get_template_directory_uri().'/css/animate.css', array(),'1.0.0', 'all');
    wp_enqueue_style('customstyle', get_template_directory_uri().'/fonts/fontawesome/css/font-awesome.min.css', array(),'1.0.0', 'all');
    wp_enqueue_style('BGFIStyle', get_template_directory_uri().'/css/bgfi.css', array(),'1.0.0', 'all');
    wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery.js', array(), '1.12.1', true);
    wp_enqueue_script('Owlcarousel', get_template_directory_uri().'/plugins/owl.carousel/owl.carousel.min.js', array(), '1.0.0', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array(), '3.3.5', true);
    wp_enqueue_script('BGFIScript', get_template_directory_uri().'/js/bgfi.js', array(), '3.3.5', true);
}
add_action('wp_enqueue_scripts','bgfi_script_enqueue');


/*
  ======================================
    Activate menus
  ======================================
 */

function bgfi_theme_setup(){
    add_theme_support('menus');

    register_nav_menu('primary','Menu principal');
    register_nav_menu('nous-connaitre','Nous connaître');
    register_nav_menu('nos-actualites','Nos actualités');
    register_nav_menu('nous-rejoindre','Nos rejoindre');
    register_nav_menu('vous-etes','Vous êtes');
    register_nav_menu('reseaux-sociaux','Réseaux sociaux');
}
add_action('init','bgfi_theme_setup');


/*
  ======================================
    Sidebar functions
  ======================================
 */
function bgfi_widget_setup(){
    register_sidebar(
        array(
            'name' => 'Sidebar',
            'id' => 'sidebar-1',
            'class' => 'custom',
            'description' => 'Menu standard',
            'before_widget' => '<section id="%1$s" class="widget %2$s section">',
            'after_widget' => '</section>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
}
add_action('init','bgfi_widget_setup');



/*
  ======================================
    Theme support functions
  ======================================
 */

//To add custom background to the appearance panel
add_theme_support('custom-background');
//To add custom header to the appearance panel
add_theme_support('custom-header');
//To add featured image to the post options
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('service','image','video'));

/*
  ======================================
    Custom post type
  ======================================
 */

function bgfi_carousel_post_type(){
    $labels = array(
        'name' => 'Carousel',
        'singular_name' => 'Slide',
        'add_new' => 'Ajouter un slide',
        'all_items' => 'Tous les slides',
        'add_new_item' => 'Ajouter un slide',
        'edit_item' => 'Modifier slide',
        'new_item' => 'Nouveau slide',
        'featured_image ' => 'Image',
        'view_item' => 'Voir le slide',
        'search_item' => 'Rechercher un slide',
        'not_found' => 'Aucun slide trouve',
        'not_found_in_trash' => 'Aucun slide trouvé dans la corbeille',
        'parent_item_colon' => 'Slide parent'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'pubicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'slides'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => array(
            'title',
            'thumbnail',
        ),
        'menu_position' => 5,
        'exclude_from_search' => false
    );
    register_post_type('carousel', $args);
}
add_action('init','bgfi_carousel_post_type');

/*
  ======================================
    Custom walker Class
  ======================================
 */
class Walker_Nav_Primary extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth)
    {
        $indent = str_repeat("\t", $depth);
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $classes[] = ($args->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;
        if( $depth && $args->has_children ){
            $classes[] = 'dropdown-submenu';
        }

        $class_names = join('', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args));
        $class_names = ' class="' . esc_attr( $id ) . '""';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = ! empty( $item->attr_title ) ?  ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

        $attributes .= ( $args->walker->has_children ) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= ( $depth == 0 && $args->walker->has_children ) ? '<b class="caret"></b></a>' : '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }
}