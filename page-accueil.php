<?php get_header(); ?>

<!-- ============================
                 carousel
        ============================== -->

<div id="carousel">
    <div class="container">
        <!--<img src="img/band-b.png" alt="band" class="band">-->
        <div class="owl-carousel owl-theme">


            <?php
            $args = array(
                'type' => 'post',
                'posts_per_page' => 4
            );
            $latestPosts = new WP_Query($args);
            ?>

            <?php if ($latestPosts->have_posts()): ?>

                    <?php while ($latestPosts->have_posts()): $latestPosts->the_post(); ?>
                        <div class="slide" style="background-image: url('<?php the_post_thumbnail_url('full')?>')">
                            <div class="content">
                                <h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
                                <div class="exerpt">
                                    <?php the_excerpt();?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>

        </div>
    </div>
</div>

<!-- ============================
         Services
============================== -->
<div class="services">
    <div class="container">
        <div class="firstRow row">
            <div class="col-sm-6">
                <img src="<?php echo get_template_directory_uri();?>/img/band-b.png" alt="band" class="band">
                <div class="content">
                    <a href="#">Banque<br><span>commerciale</span></a>
                    <p>Mauris quis sollicitudin dolor. Nulla sodales semper hendrerit. Duis id odio non massa pulvinar venenatis in a libero.</p>
                </div>
            </div>
            <div class="col-sm-6 text-right">
                <img src="<?php echo get_template_directory_uri();?>/img/map.jpg" alt="Map" class="img-responsive"/>
            </div>
        </div>
        <div class="row secondRow">
            <div class="col-sm-6 service" style="background-image: url('<?php echo get_template_directory_uri();?>/img/img1.jpg')">
                <div class="content">
                    <a href="#">Services financiers <span>spécialisés</span></a>
                    <p>Ut tortor ipsum, elementum in maximus eget, facilisis ut elit. Sed arcu quam, cursus sit amet sagittis vitae</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="service">
                    <div class="content">
                        <a href="#">Banque<br><span>d'Investissement</span></a>
                        <p>Integer dapibus, est et sollicitudin tristique, ex erat consequat eros</p>
                    </div>
                </div>

                <div class="service" style="background-image: url('<?php echo get_template_directory_uri();?>/img/img2.jpg')">
                    <div class="content">
                        <a href="#">Assurance</a>
                        <p>Mauris ullamcorper sem vitae felis pharetra tincidunt. Cras sem libero</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================
         actualité
============================== -->
<div class="actualite">
    <div class="container">
        <div class="owl-carousel owl-theme">
            <div class="slide container">
                <div class="col-sm-6">
                    <iframe width="100%" height="320" src="https://www.youtube.com/embed/56M776du75M?rel=0" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="col-sm-6">
                    <div class="content">
                        <h3>AFRICA CEO FORUM AWARDS 2016 - BGFI Bank</h3>
                        <p>21 mars 2016 à ABIDJAN : Le Groupe BGFIBank, élue Banque Africaine de l'année par AFRICACEO FORUM 2016.</p>
                    </div>
                </div>
            </div>

            <div class="slide container">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="<?php echo get_template_directory_uri();?>/img/rapports.png" class="img-responsive" alt="Rapports">
                    </div>
                    <div class="col-sm-6">
                        <div class="content">
                            <h3>Les Rapports d'Activités et la COP 2015</h3>
                            <p>Mauris quis sollicitudin dolor. Nulla sodales semper hendrerit. Duis id odio non massa pulvinar venenatis in a libero. Aliquam convallis, erat non pellentesque efficitur</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
