<?php
 /*
Plugin Name: alk carts
Plugin URI: alk55.ru
Description: alk plugin for krostex
Version: 0.1
Author: alk
Author URI: alk55.ru
License: MIT 
 
	Copyright (c) 2016 

	Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/ 
class alk_carts extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'alk_carts', 'description' => __( "Карточки наименования услуг") );
		parent::__construct( 'alk_carts', _x( 'Карточки наименования услуг', 'Карточки наименования услуг' ), $widget_ops );

        add_action('admin_enqueue_scripts', array($this, 'addCategoty_scripts'));
    }

    public function addCategoty_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script( 'alk_carts-widget-js', plugin_dir_url(__FILE__) .'/js/main.js', array( 'jquery'), 1.0 );  
        wp_enqueue_style('thickbox');

    }
	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) { ?>
        <div id="carts" class="row">
            <h2 class="featurette-heading"><?= $instance['title']; ?></h2>
            <div class="cards">
            <?php foreach ($instance['carts'] as $item) {?>
                <div class="card">
                    <img src="<?=$item['img']?>" alt="<?=$item['name']?>" title="<?=$item['name']?>">
                    <div class="card-title">
                        <a class="toggle-info btn">
                            <span class="left"></span>
                            <span class="right"></span>
                        </a>      
                        <h2><?=$item['name']?><small><?=$item['price']?></small></h2>
                    </div>
                    <div class="card-flap flap1">
                        <div class="card-description"><?=$item['text']?></div>
                        <div class="card-flap flap2">
                            <div class="card-actions">
                                <a class="btn" href="tel:+79045899075">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    +7 (904) 589-90-75 <br>
                                    позвонить
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
            </div>
        </div> 
    <?php
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['carts'] = array();
        
        if(!empty($new_instance['ad_img']) && !empty($new_instance['ad_link'])){
            for($i=0; $i < (count($new_instance['ad_img']) - 1); $i++){
                if(!empty($new_instance['ad_img'][$i]) && !empty($new_instance['ad_link'][$i])){
                    $ad = array();
                    $ad['img'] = esc_url($new_instance['ad_img'][$i]);
                    $ad['name'] = esc_attr($new_instance['ad_name'][$i]);
                    $ad['text'] = $new_instance['ad_text'][$i];
                    $ad['price'] = esc_attr($new_instance['ad_price'][$i]);
                    $ad['link'] = esc_url($new_instance['ad_link'][$i]);
                    $instance['carts'][] = $ad;
                }
            }   
        }
        
        return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title    = isset( $instance['title'] ) ?  $instance['title'] : 'МЫ ПРЕДЛОГАЕМ:';
        $price = 'от 2 700  руб./м3';
		$carts = !empty($instance['carts']) ? $instance['carts'] : array();
?>
       <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Название', 'meks-easy-ads-widget'); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" class="widefat" />
        </p>
        

      <h4><?php _e('Элементы', 'meks-easy-ads-widget'); ?>:</h4>
      <p>
          <ul class="mks_ads_container">
          <?php foreach($carts as $ad) : ?>
            <li style="margin-bottom: 15px;">
                    <label><?php _e('Наименование', 'meks-easy-ads-widget'); ?>:</label>
                    <input type="text" name="<?php echo $this->get_field_name( 'ad_name' ); ?>[]" value="<?php echo $ad['name']; ?>" class="widefat" />
                    <br>
                    <label><?php _e('Стоимость', 'meks-easy-ads-widget'); ?>:</label>
                    <input type="text" name="<?php echo $this->get_field_name( 'ad_price' ); ?>[]" value="<?php echo $ad['price']; ?>" class="widefat" />
                    <br>
                    <label><?php _e('Краткое описние', 'meks-easy-ads-widget'); ?>:</label>
                    <textarea type="text" name="<?php echo $this->get_field_name( 'ad_text' ); ?>[]"  style="width: 100%; min-height:230px;" class="widefat" ><?php echo $ad['text']; ?></textarea>
                    <br>
                    <label><?php _e('Изображение', 'meks-easy-ads-widget'); ?>:</label>
                    <input name="<?php echo $this->get_field_name( 'ad_img' ); ?>[]" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo $ad['img']; ?>" style="margin-bottom: 5px;"/>
                    <input class="upload_image_button button button-primary" type="button" value="Добавить Изображение" />
                    <br>
                    <label><?php _e('Ссылка', 'meks-easy-ads-widget'); ?>:</label>
                    <input type="text" name="<?php echo $this->get_field_name( 'ad_link' ); ?>[]" value="<?php echo $ad['link']; ?>" class="widefat" />
            </li>
          <?php endforeach; ?>
         </ul>
      </p>
      
      <p>
        <a href="#" class="alk_adcart button"><?php _e('Add New', 'meks-easy-ads-widget'); ?></a>
      </p>
      
        <div class="mks_ads_clone" style="display:none">
            <label><?php _e('Заголовок', 'meks-easy-ads-widget'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name( 'ad_name' ); ?>[]" class="widefat" />
            <br>
            <label><?php _e('Стоимость', 'meks-easy-ads-widget'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name( 'ad_price' ); ?>[]" value="<?php echo $price; ?>" class="widefat" />
            <br>
            <label><?php _e('Содержание', 'meks-easy-ads-widget'); ?>:</label>
            <textarea type="text" name="<?php echo $this->get_field_name( 'ad_text' ); ?>[]"  style="width: 100%; min-height:230px;" class="widefat" ><?php echo $ad['text']; ?></textarea>
            <br>
            <label><?php _e('Изображение', 'meks-easy-ads-widget'); ?>:</label>
            <input name="<?php echo $this->get_field_name( 'ad_img' ); ?>[]" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  style="margin-bottom: 5px;"/>
            <input class="upload_image_button button button-primary" type="button" value="Добавить Изображение" />
            <br>
            <label><?php _e('Ссылка', 'meks-easy-ads-widget'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name( 'ad_link' ); ?>[]" class="widefat" />
      </div>
<?php
	}
}

	add_action("widgets_init", function () {
		register_widget("alk_carts");
	});
