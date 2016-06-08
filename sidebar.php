    <section class="section">
        <h3><?php echo get_the_title($post->post_parent);?></h3>
        <ul>
            <?php $args = array('parent' => $post->post_parent,);
            $pages =  get_pages($args);
            foreach ($pages as $page){echo "<li><a href='". get_permalink($page->ID)."'> ". $page->post_title ."</a></li>";}
            ?>
        </ul>
    </section>

    <div class="section">
        <h3>Rechercher sur le site</h3>
        <?php the_widget( 'WP_Widget_Search'); ?>

        <!--<form action="" method="get">
            <label>
                <input type="text" placeholder="Rechercher sur le site..."/>
                <button type="submit" class="fa fa-search"></button>
            </label>
        </form>-->
    </div>

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