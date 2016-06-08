
<?php get_header(); ?>

<?php if (have_posts()): ?>
    <!-- ============================
                 article
        ============================== -->
    <div class="article">
        <?php while (have_posts()): the_post(); ?>
        <div class="container">
            <div class="row clearpadding">
                <div class="header<?php if(has_post_thumbnail()){;?>" style="background-image: url('<?php echo the_post_thumbnail_url();?>')" <?php } else{ echo " no-featured-image\"";};?>></div>
            </div>

            <div class="row">
                <div class="col-sm-8 main">

                    <div class="date">
                        <i class="fa fa-clock-o fa-lg"></i> Publié le: <?php the_date();?> à <?php the_time();?>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <?php echo the_content();?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1 aside">
                    <section class="section">
                        <h3>Nous connaître</h3>
                        <ul>
                            <li><a href="article.html">Le mot du PDG</a></li>
                            <li><a href="article.html">BGFIBank en bref</a></li>
                            <li><a href="article.html">La gouvernance</a></li>
                            <li><a href="article.html">La culture d'entreprise</a></li>
                            <li><a href="article.html">Publications</a></li>
                        </ul>
                    </section>

                    <section class="section">
                        <form action="" method="get">
                            <label>
                                <h3>Rechercher sur le site</h3>
                                <input type="text" placeholder="Rechercher sur le site..."/>
                                <button type="submit" class="fa fa-search"></button>
                            </label>
                        </form>
                    </section>

                    <section class="section">
                        <h3>Nos métiers</h3>
                        <ul>
                            <li><a href="#">Banque commerciale</a></li>
                            <li><a href="#">Banque d'investissement</a></li>
                            <li><a href="#">Services financiers spécilaisés</a></li>
                            <li><a href="#">Assurance</a></li>
                        </ul>
                    </section>

                    <section class="section">
                        <h3>Dernière actualité</h3>
                        <div class="thumb row">
                            <div class="col-xs-4 col-md-12 img" style="background-image: url('img/img1.jpg')"></div>
                            <div class="col-xs-8 col-md-12 info">
                                <h4><a href="#">Un exemple de long titre d'articles. Un titre assez long pour voir comment il s'affiche à l'écran</a></h4>
                                <p>Mauris quis sollicitudin dolor. Nulla sodales semper hendrerit. Duis id odio non massa pulvinar venenatis in a libero. Aliquam convallis, erat non pellentesque efficitur, tellus metus condimentum dolor</p>
                            </div>
                        </div>

                        <div class="thumb row">
                            <div class="col-xs-4 col-md-12 img" style="background-image: url('img/img5.jpg')"></div>
                            <div class="col-xs-8 col-md-12 info">
                                <h4><a href="#">Quatrième titre d'article</a></h4>
                                <p>Duis eget porta nunc. Ut sed diam aliquam diam accumsan viverra vestibulum nec tortor. Mauris consequat placerat molestie. Vivamus pulvinar erat vel lorem hendrerit, sed pretium magna accumsan.</p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
<?php get_footer(); ?>

