<?php
/**
 * SKT Healing Touch functions and definitions
 *
 * @package SKT Healing Touch
 */

// Set the word limit of post content 

function healing_touch_content($limit) {
$content = explode(' ', get_the_content(), $limit);
if (count($content)>=$limit) {
array_pop($content);
$content = implode(" ",$content).'...';
} else {
$content = implode(" ",$content);
}	
$content = preg_replace("/<img[^>]+\>/i", " ", $content); 
$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'healing_touch_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function healing_touch_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'healing-touch', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 225,
		'flex-height' => true,
	) );
	add_theme_support( 'custom-header', array( 'header-text' => false ) );
	add_theme_support( 'title-tag' );
	add_image_size('healing-touch-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'healing-touch' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
}
endif; // healing_touch_setup
add_action( 'after_setup_theme', 'healing_touch_setup' );


function healing_touch_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog and Page Sidebar', 'healing-touch' ),
		'description'   => __( 'Appears on blog and page sidebar', 'healing-touch' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Twitter Widget', 'healing-touch' ),
		'description'   => __( 'Appears on footer of the page', 'healing-touch' ),
		'id'            => 'twitter-wid',
		'before_widget' => '<div class="cols">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	
}
add_action( 'widgets_init', 'healing_touch_widgets_init' );


function healing_touch_font_url(){
		$font_url = '';
		
		/* Translators: If there are any character that are
		* not supported by Roboto, translate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on', 'Roboto font:on or off','healing-touch');
		
		/* Translators: If there are any character that are not
		* supported by Oswald, trsnalate this to off, do not
		* translate into your own language.
		*/
		$oswald = _x('on','Oswald:on or off','healing-touch');
		
		/* Translators: If there has any character that are not supported 
		*  by Scada, translate this to off, do not translate
		*  into your own language.
		*/
		$scada = _x('on','Scada:on or off','healing-touch');
		
		if('off' !== $roboto || 'off' !== $oswald){
			$font_family = array();
			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:300,400,600,700,800,900';
			}
			if('off' !== $oswald){
				$font_family[] = 'Oswald:300,400,600,700';
			}
			if('off' !== $scada){
				$font_family[] = 'Scada:300,400,600,700';
			}
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}

function healing_touch_scripts() {
	wp_enqueue_style('healing_touch_font', healing_touch_font_url(), array());
	wp_enqueue_style( 'healing_touch_basic_style', get_stylesheet_uri() );
	wp_enqueue_style( 'healing_touch_nivoslider_style', get_template_directory_uri()."/css/nivo-slider.css" );
	wp_enqueue_style( 'healing_touch_main_style', get_template_directory_uri()."/css/main.css" );		
	wp_enqueue_style( 'healing_touch_base_style', get_template_directory_uri()."/css/style_base.css" );
	wp_enqueue_script( 'healing_touch_nivo_script', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'healing_touch_custom_js', get_template_directory_uri() . '/js/custom.js' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'healing_touch_scripts' );

function healing_touch_ie_stylesheet(){
	global $wp_styles;
	
	/** Load our IE-only stylesheet for all versions of IE.
	*   <!--[if lt IE 9]> ... <![endif]-->
	*
	*  Note: It is also possible to just check and see if the $is_IE global in WordPress is set to true before
	*  calling the wp_enqueue_style() function. If you are trying to load a stylesheet for all browsers
	*  EXCEPT for IE, then you would HAVE to check the $is_IE global since WordPress doesn't have a way to
	*  properly handle non-IE conditional comments.
	*/
	wp_enqueue_style('healing_touch_ie', get_template_directory_uri().'/css/ie.css', array('healing_touch-style'));
	$wp_styles->add_data('healing_touch_ie','conditional','IE');
	}
add_action('wp_enqueue_scripts','healing_touch_ie_stylesheet');


function healing_touch_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $page_format as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	}
}

define('SKT_URL','http://www.sktthemes.net','healing-touch');
define('SKT_THEME_URL','http://www.sktthemes.net/themes','healing-touch');
define('SKT_THEME_URL_DIRECT','http://www.sktthemes.net/shop/skt-medical/','healing-touch');
define('SKT_THEME_DOC','http://sktthemesdemo.net/documentation/skt-healingtouch-doc/','healing-touch');
define('SKT_PRO_THEME_URL','http://www.sktthemes.net/shop/skt-medical/','healing-touch');
define('SKT_THEME_FEATURED_SET_VIDEO_URL','https://www.youtube.com/watch?v=310YGYtGLIM','healing-touch');
define('SKT_LIVE_DEMO','http://www.sktthemes.net/shop/skt-medical/','healing-touch');

function healing_touch_credit(){
		return _ex( 'Design by <a href="'.esc_url(SKT_URL).'" rel="nofollow">SKT Themes</a>', 'healing-touch' );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template for about theme.
 */
require get_template_directory() . '/inc/about-themes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



function healing_touch_custom_blogpost_pagination( $wp_query ){
	$big = 999999999; // need an unlikely integer
	if ( get_query_var('paged') ) { $pageVar = 'paged'; }
	elseif ( get_query_var('page') ) { $pageVar = 'page'; }
	else { $pageVar = 'paged'; }
	$pagin = paginate_links( array(
		'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' 		=> '?'.$pageVar.'=%#%',
		'current' 		=> max( 1, get_query_var($pageVar) ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text'		=> '&laquo; Prev',
		'next_text' 	=> 'Next &raquo;',
		'type'  => 'array'
	) ); 
	if( is_array($pagin) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $pagin as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	} 
}

// get slug by id
function healing_touch_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}

if ( ! function_exists( 'skt_construction_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function healing_touch_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;