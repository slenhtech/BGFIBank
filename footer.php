<!-- ============================
                 Footer
        ============================== -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-push-2">
                <div class="row">
                    <div class="col-sm-3">
                        <h4>Nous connaître</h4>
                        <?php wp_nav_menu(array(
                            'menu' => 'nous-connaitre',
                            'container' => false,
                            'menu_class' => ''
                        ));?>
                    </div>
                    <div class="col-sm-3">
                        <h4>Nos métiers</h4>
                        <ul>
                            <li><a href="#">Banque commerciale</a></li>
                            <li><a href="#">Banque d'investissement</a></li>
                            <li><a href="#">Services financiers spécilaisés</a></li>
                            <li><a href="#">Assurance</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h4>Nous rejoindre</h4>
                        <?php wp_nav_menu(array(
                            'menu' => 'nous-rejoindre',
                            'container' => false,
                            'menu_class' => ''
                        ));?>
                    </div>
                    <div class="col-sm-3">
                        <h4>Notre actualité</h4>
                        <p>Inscrivez vous à notre newsletter pour etre au courant de  nostre actualité</p>
                        <div class="form-group">
                            <input type="text" placeholder="Votre adresse mail">
                            <button type="submit" class="fa fa-at fa-lg"></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Banque Commerciale</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                    <li><a href="#">BGFIBank Gabon</a></li>
                                    <li><a href="#">BGFIBank Bénin</a></li>
                                    <li><a href="#">BGFIBank Sao Tomé et Principe</a></li>
                                    <li><a href="#">BGFIBank Congo</a></li>
                                    <li><a href="#">BGFIBank Guinée équatoriale</a></li>
                                    <li><a href="#">BGFIBank Côte d’Ivoire</a></li>
                                </ul>
                            </div>

                            <div class="col-sm-6">
                                <ul>
                                    <li><a href="#">BGFIBank Europe</a></li>
                                    <li><a href="#">BGFIBank Madagascar</a></li>
                                    <li><a href="#">BGFIBank Cameroun</a></li>
                                    <li><a href="#">BGFIBank RDC</a></li>
                                    <li><a href="#">BGFIBank Sénégal</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <h4>Banque D’Investissement</h4>
                        <ul>
                            <li><a href="#">BGFI Bourse</a></li>
                            <li><a href="#">BGFI Capital</a></li>
                        </ul>

                        <h4>Assurance</h4>
                        <ul>
                            <li><a href="#">Assinco S.A</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h4>Services financiers spécialisés</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                    <li><a href="#">Finatra</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul>
                                    <li><a href="#">LOXIA</a></li>
                                </ul>
                            </div>
                        </div>

                        <h4>Centre de services partagés</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                    <li><a href="#">BBS</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul>
                                    <li><a href="#">Hedenia</a></li>
                                </ul>
                            </div>
                        </div>

                        <h4>Nos engagements RSE</h4>
                        <ul>
                            <li><a href="#">La Fondation BGFIBank</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-sm-pull-10 logo">
                <img src="<?php echo get_template_directory_uri();?>/img/logo.png" class="img-responsive" alt="Logo">
                <div class="text-center apps">
                    <a href="#" target="_blank" class="fa fa-2x fa-android"></a>
                    <a href="#" target="_blank" class="fa fa-2x fa-apple"></a>
                    <a href="#" target="_blank" class="fa fa-2x fa-windows"></a>
                </div>
            </div>
        </div>

        <div class="copyright">
            <ul class="list-inline">
                <li id="copy">&copy; BGFI 2016</li>
                <li><a href="#">Contacts</a></li>
                <li><a href="#">Mentions Légales</a></li>
                <li><a href="#">Plan du site</a></li>
            </ul>
        </div>
    </div>
</footer>
</div>
<?php wp_footer();?>
</body>
</html>