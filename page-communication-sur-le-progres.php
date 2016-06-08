<?php

/*
 *
 * Template Name: La communication sur le progrès
 *
 */
?>

<?php get_header(); ?>

<div class="article">

    <div class="container">
        <?php
        $args = array(
            'post_type' => 'carousel'
        );
        $slides = new WP_Query($args);
        ?>
        <?php if ($slides->have_posts()): ?>
            <div id="product-carousel" class="carousel hidden-xs">
                <div class="owl-carousel owl-theme">
                    <?php while ($slides->have_posts()): $slides->the_post(); ?>
                        <div class="owl-item">
                            <img src="<?php echo the_post_thumbnail_url();?>" class="img-responsive" alt="image">
                        </div>
                    <?php endwhile;?>
                </div>
            </div>
        <?php endif;?>
        <?php wp_reset_postdata();?>

        <div class="row">
            <div class="col-sm-8 main">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): the_post(); ?>
                        <h1 class="title"><?php echo get_field('article_title');?></h1>
                        <div class="sitemap">
                            <a href="<?php echo home_url();?>">accueil</a>
                            <?php if ( is_page() && $post->post_parent > 0 ):?>
                                <a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent);?></a>
                            <?php endif; ?>
                            <a href="#"><?php the_title();?></a>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <?php echo the_content();?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

                <div class="row grid">
                    <?php
                    echo do_shortcode('[downloads template="bgfi" category="communication-sur-le-progres" before="<div>" after="</div>"]');
                    ?>
                </div>
            </div>



            <div class="col-sm-3 col-sm-offset-1 aside">
                <?php get_sidebar();?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

