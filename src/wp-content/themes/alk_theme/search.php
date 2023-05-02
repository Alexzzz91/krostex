<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
header( 'Location: /', true, 307 ); 
get_header(); ?>

<div id="main-content" class="main-content">

    <!--Carousel
==================================================-->
    <?php dynamic_sidebar( 'slider' ); ?>
    <!-- /.carousel-->
    <!--Marketing messaging and featurettes
==================================================-->
    <!-- Wrap the rest of the page in another container to center all the content.-->

    <div id="o-nas" class="container marketing">
        <div class="row featurette">
            <div class="col-md-12">
                <?php 
                    $posts = get_posts( array(
                    'numberposts'     => 1, // тоже самое что posts_per_page
                    'cat'             => 2,
                    'post_type'       => 'post'
                    ) );
                    foreach($posts as $post){ 
                        setup_postdata($post); ?>
                        <h2 class="featurette-heading"><?= the_title(); ?></h2>
                        <span class="lead"><?php the_content(); ?></span>
                    <?php }
                    wp_reset_postdata();
                ?>
            </div>
        </div>
        <!-- Three columns of text below the carousel-->
        <hr>
        <?php dynamic_sidebar( 'cart-area' ); ?>
        <div class="row featurette">
            <div class="col-md-12">
                <?php 
                    $posts = get_posts( array(
                    'numberposts'     => 1, // тоже самое что posts_per_page
                    'cat'             => 3,
                    'post_type'       => 'post'
                    ) );
                    foreach($posts as $post){ 
                        setup_postdata($post); ?>
                        <h2 class="featurette-heading"><?= the_title(); ?></h2>
                        <span class="lead"><?php the_content(); ?></span>
                    <?php }
                    wp_reset_postdata();
                ?>
            </div>
        </div>
        <!-- /.row-->
        <!-- START THE FEATURETTES-->
        <!-- /END THE FEATURETTES-->
        <!-- FOOTER-->
        <hr>
        <div id="contact" class="contact">
            <div class="container">
                <h3 class="featurette-heading">Оставить заявку</h3>
                <p></p>
                <form id='contact-form' action="/" method="post">
                    <div class="column">
                        <div class="form-group text-field-name-1">
                            <input type="text" placeholder="Ваще Имя *" id="contact-name" name="name" class="text alk-class-input">
                            <div class="messages"></div>
                        </div>
                        <div class="form-group text-field-subject-1">
                            <input type="text" placeholder=" Номер телефона *" name="telefon" class="text alk-class-input">
                            <div class="messages"></div>
                        </div>
                        <div class="form-group text-field-email-1">
                            <input type="text" placeholder="Ваш email" name="email" class="text">
                            <div class="messages"></div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-group text-field-area-">
                            <textarea value="Сообщение:" onfocus="if(this.value == 'Сообщение') this.value='';" onblur="if(this.value == '') this.value='Сообщение';" name="message" placeholder="Сообщение(необязательно)"></textarea>
                            <div class="col-sm-5 messages"></div>
                            <input type="button" id="alk-submit" value="Отправить" class="btn btn-lg btn-primary">
                        </div>
                    </div>
                </form>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div><!-- #main-content -->

<?php
get_footer();
