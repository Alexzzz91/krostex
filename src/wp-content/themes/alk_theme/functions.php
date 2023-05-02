<?php function custom_customize_register( $wp_customize ){
class Alk_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
 
    public function render_content() {
        ?>
        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
    }
}
    function alk_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
}
    if ( class_exists( 'WP_Customize_Panel' ) ):
    
        $wp_customize->add_panel( 'panel_general', array(
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'title' => __( 'Настройка внешнего вида', 'romangie' )
        ));
        
        $wp_customize->add_section( 'alk_general_section' , array(
            'title' => __( 'Общий вид', 'romangie' ),
            'priority' => 30,
            'panel' => 'panel_general'
        ));
    
        /* LOGO */
        $wp_customize->add_setting( 'alk_logo', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
            'label' => __( 'Логотип', 'romangie' ),
            'section' => 'title_tagline',
            'settings' => 'alk_logo',
            'priority' => 1,
        )));
        
        // /* Disable preloader */
        // $wp_customize->add_setting( 'alk_disable_preloader', array(
        //     'sanitize_callback' => 'alk_sanitize_text'
        // ));
        
        // $wp_customize->add_control( 'alk_disable_preloader', array(
        //     'type' => 'checkbox',
        //     'label' => __('Отключить анимацию при загрузке?','romangie'),
        //     'section' => 'alk_general_section',
        //     'priority' => 2,
        // ));


        /* COPYRIGHT */
        $wp_customize->add_setting( 'alk_copyright', array(
            'default' => "© 2016 ООО КРОСТЕКС",
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 'alk_copyright', array(
            'label'    => __( 'Футер(текст в самом низу)', 'romangie' ),
            'section'  => 'alk_general_section',
            'priority'    => 3,
        ));

        $wp_customize->add_setting( 'alk_email_text', array(
            'default' => "<a href='mailto:krostex-betom@gmail.com'><i class='fa fa-envelope' aria-hidden='true'></i>  krostex-betom@gmail.com</a>",
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 'alk_email_text', array(
            'label'    => __( 'Email в футере', 'romangie' ),
            'section'  => 'alk_general_section',
            'priority'    => 3,
        ));        

        /* COPYRIGHT */
        $wp_customize->add_setting( 'alk_textPreloader', array(
            'default' => "Пожалуйста подождите...",
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 'alk_textPreloader', array(
            'label'    => __( 'Текст при загрузке', 'romangie' ),
            'section'  => 'alk_general_section',
            'priority'    => 3,
        ));
       
    endif;
/**
 * Twenty Fourteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfourteen_setup' ) ) :
/**
 * Twenty Fourteen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Twenty Fourteen 1.0
 */

function action_alkadd_form()
{ 
   global $wpdb;      
      $table_name = $wpdb->prefix . "alkcontact_form";

  if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name){
      $sql = "CREATE TABLE " . $table_name . " (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name text,
        email text,
        telefon text,
        message text,
        time DATETIME,
        UNIQUE KEY id (id)
      ) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

  };
    $data = array();
    if (isset($_POST)){
        foreach ($_POST['data'] as $key=>$value){
            $data[$key]=$value;
        }
    }

    $name = $data['name'];
    $email = $data['email'];
    $telefon = $data['telefon'];
    $message = $data['message'];
    $time = date("Y-m-d H:i:s");

    $wpdb->insert(
      ''. $table_name .'',
      array('name' => $name,
            'email' => $email,
            'telefon' => $telefon,
            'message' => $message,
            'time' => $time),
      array()
    );
    $lastid = $wpdb->insert_id;
    $adminEmail = get_option('admin_email');
    $subject = "Заявка №".$lastid." от ".$name."";

    sendSuccessMail($data, $adminEmail, $subject);
    $telLenght = strlen($telefon);
    if ($telLenght > 6){
	    if ($telefon{0} == 7 || $telefon{0} == 8){
	    	$telefon = substr($telefon, 1);
	    	$telefon = '+7'.$telefon;
    	}
    }
    $text = "заявка №". $lastid . " от " . $name . ", телефон:" . $telefon . ', email:' . $email . ', сообщение:' . $message;
    $ch = curl_init("http://sms.ru/sms/send");
	 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
	"api_id"		=>	"5FFEA089-ED36-AE76-4C03-2D978CDF6350",
	"to"			=>	"79045899075",
	"text"		    =>	$text
	));
	$body = curl_exec($ch);

	curl_close($ch);

	//$body=file_get_contents("http://sms.ru/sms/send?api_id=CA284E71-7ECD-32AC-9090-6EABE2CB96EF&to=79507971409&text="'. $text. ' );

    exit();
}

/**
 * @param array $data passed to message template
 * @param string $to email to send
 * @param string $subject subject of message
 */

function sendSuccessMail(array $data, $to, $subject)
{
    $message = '';
    $headers = 'From: webmaster@krostext.com' . "\r\n" .
        'Reply-To: webmaster@krostext.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    foreach ($data as $key => $value) {
    	        switch ($key) {
          case 'name':
            $message .= 'Имя : ' . $value . "\r\n";
            break;
          case 'telefon':
            $message .= 'Телефон : ' . $value . "\r\n";
            break;
          case 'message':
            $message .= 'Сообщение : ' . $value . "\r\n";
            break;
          default:
            $message .= $key . ': ' . $value . "\r\n";
            break;
        }
    }
    mail($to, $subject, $message, $headers);
}
 
add_action('wp_ajax_action_alkadd_form', 'action_alkadd_form');
add_action('wp_ajax_nopriv_action_alkadd_form', 'action_alkadd_form');


function twentyfourteen_setup() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'telefon'   => __( 'Top header telefon menu', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'twentyfourteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'twentyfourteen_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'twentyfourteen_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function twentyfourteen_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Twenty Fourteen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'twentyfourteen_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function twentyfourteen_has_featured_posts() {
	return ! is_paged() && (bool) twentyfourteen_get_featured_posts();
}

/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Слайдер', 'twentyfourteen' ),
		'id'            => 'slider',
		'description'   => __( 'Слайдер', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Услуги и товары', 'twentyfourteen' ),
		'id'            => 'cart-area',
		'description'   => __( 'Карточки с наименованием товаров', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'twentyfourteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );

/**
 * Register Lato Google font for Twenty Fourteen.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return string
 */
function twentyfourteen_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'twentyfourteen' ) ) {
		$query_args = array(
			'family' => urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $font_url;
}


/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_scripts() {
	// Add Lato font, used in the main stylesheet.
	//wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
	wp_enqueue_style( 'RobotoFonts', '//fonts.googleapis.com/css?family=Roboto:700,400&subset=latin,cyrillic', array());
	// Add Genericons font, used in the main stylesheet.
	
	wp_enqueue_style( 'alertifycore', get_template_directory_uri() . '/css/alertify.core.css', array(), '3.0.3' );
	
	wp_enqueue_style( 'alertifybootstrap', get_template_directory_uri() . '/css/alertify.bootstrap.css', array(), '3.0.3' );

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array() );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array() );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style' ), '20131205' );
	wp_style_add_data( 'twentyfourteen-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfourteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-custom.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'underscore', get_template_directory_uri() . '/js/underscore.min.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'alertify', get_template_directory_uri() . '/js/alertify.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'validatejs', get_template_directory_uri() . '/js/validate.min.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'alkscript', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150315', true );

	wp_localize_script( 'alkscript', 'PJS', array(
	    'ajax_url' => admin_url( 'admin-ajax.php' ), 
	));

	wp_enqueue_script( 'ie-emulation-modes', get_template_directory_uri() . '/assets/ie-emulation-modes-warning.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'holder', get_template_directory_uri() . '/assets/holder.min.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'bootstrapjs', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '20150315', true );
}
	wp_enqueue_script( 'ie10-viewport', get_template_directory_uri() . '/assets/ie10-viewport-bug-workaround.js', array( 'jquery' ), '20150315', true );

add_action( 'wp_enqueue_scripts', 'twentyfourteen_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );

if ( ! function_exists( 'twentyfourteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'twentyfourteen_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'twentyfourteen' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );





// function true_search_turn_off( $q, $e = true ) {
// 	if ( is_search() ) {
// 		$q->is_search = false;
// 		$q->query_vars[s] = false;
// 		$q->query[s] = false;	
// 		if ( $e == true ){
// 			// вешаем страницу с ошибкой 404
// 			$q->is_404 = true;
// 		}
// 	}
// }
 
// add_action( 'parse_query', 'true_search_turn_off' );
// add_filter( 'get_search_form', create_function( '$a', "return null;" ) );


// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}
