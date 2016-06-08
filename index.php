<?php get_header(); ?>
    <!-- ============================
                     news carousel
            ============================== -->
    <div class="news_carousel">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="owl-carousel">
                        <?php
                        $args = array(
                            'type' => 'post',
                            'posts_per_page' => 4
                        );
                        $latestPosts = new WP_Query($args);
                        ?>
                        <?php if ($latestPosts->have_posts()): ?>

                            <?php while ($latestPosts->have_posts()): $latestPosts->the_post(); ?>
                           
                                <div class="slide" style="background-image: url('<?php echo the_post_thumbnail_url();?>')">
                                    <h1><?php the_title();?></h1>
                                    <div class="excerpt">
                                        <?php the_excerpt();?>
                                    </div>
                                    <a href="<?php echo the_permalink();?>" class="readmore">En savoir plus</a>
                                </div>
                            <?php endwhile;?>
                        <?php endif;?>
                        <?php wp_reset_postdata();?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="carousel-thumbnails">
                        <?php
                        $args = array(
                            'type' => 'post',
                            'posts_per_page' => 4
                        );
                        $latestPosts = new WP_Query($args);
                        ?>
                        <?php if ($latestPosts->have_posts()): ?>

                            <?php while ($latestPosts->have_posts()): $latestPosts->the_post(); ?>

                                <div class="thumb row">
                                    <div class="col-xs-4 img" style="background-image: url('<?php echo the_post_thumbnail_url()?>')"></div>
                                    <div class="col-xs-8 info">
                                        <h4><a href="<?php echo the_permalink();?>"><?php the_title();?></a></h4>
                                        <div class="excerpt"><?php the_excerpt();?></div>
                                    </div>
                                </div>

                            <?php endwhile;?>
                        <?php endif;?>
                        <?php wp_reset_postdata();?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================
             articles
    ============================== -->
    <div class="actualite_articles">
        <div class="container">
            <!--<h2 class="section-title">Notre actualité</h2>-->
            <div class="row">
                <div class="col-sm-9">
                    <div class="articles row">
                        <?php
                        $args = array(
                            'type' => 'post',
                            'posts_per_page' => 8
                        );
                        $latestPosts = new WP_Query($args);
                        ?>
                        <?php if ($latestPosts->have_posts()): ?>

                            <?php while ($latestPosts->have_posts()): $latestPosts->the_post(); ?>

                                <div class="col-xs-6">
                                    <div class="article picture" style="background-image: url('<?php echo the_post_thumbnail_url()?>')">
                                        <div class="date"><?php the_date();?>, <?php the_time();?></div>
                                        <h3><a href="<?php echo the_permalink();?>"><?php the_title();?></a></h3>
                                    </div>
                                </div>

                            <?php endwhile;?>
                        <?php endif;?>
                        <?php wp_reset_postdata();?>
                    </div>
                </div>
                <div class="col-sm-3 clearPadding hidden-xs">
                    <div class="advert" style="background-image: url('<?php echo get_template_directory_uri();?>/img/bgfimobile.jpg')">
                        <h3>Découvrez l'appication <span>BGFIMobile<span></h3>
                        <p>Avec <span>BGFIMobile</span>, gérez votre banque et portefeuille électronique depuis votre téléphone.</p>
                        <div class="btns">
                            <a href="#" class="download-btn" target="_blank"><img src="<?php echo get_template_directory_uri();?>/img/google-play.png" alt="google-play"></a>
                            <a href="#" class="download-btn" target="_blank"><img src="<?php echo get_template_directory_uri();?>/img/app-store.png" alt="app-store"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>