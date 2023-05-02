<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

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
                            <input type="text" placeholder="Ваше Имя *" id="contact-name" name="name" class="text alk-class-input">
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
    <div id="map"></div>
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
        <script type="text/javascript">ymaps.ready(init);
            var myMap, 
                myPlacemark;

            function init(){ 
                myMap = new ymaps.Map("map", {
                    center: [54.997594, 73.158946],
                    zoom: 13
                }); 
                
                myPlacemark = new ymaps.Placemark([54.997594, 73.158946], {
                    hintContent: ' Кростекс бетон',
                    balloonContent: 'Омск, 2-я Солнечная ул., 63'
                });
                
                myMap.geoObjects.add(myPlacemark);
                myMap.behaviors.disable('scrollZoom', "multiTouch");
            }
        </script>
</div><!-- #main-content -->
<?php
get_footer();
