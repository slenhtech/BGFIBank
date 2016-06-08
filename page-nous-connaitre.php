<?php

/*
 *
 * Template Name: Image latérale
 *
 */
?>
<?php get_header(); ?>

    <!-- ============================
                 article
        ============================== -->
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
            <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <div class="row">
                    <div class="col-sm-9 main">
                        <h1 class="title"><?php echo get_field('article_title');?></h1>
                        <div class="siteMap">
                            <a href="<?php echo home_url();?>">Accueil</a>
                            <?php if ( is_page() && $post->post_parent > 0 ):?>
                            <a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent);?></a>
                            <?php endif; ?>
                            <a href="#"><?php the_title();?></a></div>

                        <div class="row">
                            <div class="col-sm-8">
                                <?php echo the_content();?>
                            </div>
                            <div class="col-sm-4">
                                <?php $bgfi_image_laterale = get_field('image_laterale');?>
                                <img src="<?php echo $bgfi_image_laterale['url'];?>" alt="image" class="img-responsive"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 aside">
                        <?php get_sidebar();?>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>

