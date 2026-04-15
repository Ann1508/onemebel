<?php
/**
 * monoFlowers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package monoFlowers
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * runs before the init hook. The init hook is too late for some features, such
 * Note that this function is hooked into the after_setup_theme hook, which
 * as indicating support for post thumbnails.
 */
function monoflowers_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on monoFlowers, use a find and replace
		* to change 'monoflowers' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'monoflowers', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'monoflowers' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'monoflowers_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'monoflowers_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function monoflowers_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'monoflowers_content_width', 640 );
}
add_action( 'after_setup_theme', 'monoflowers_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function monoflowers_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'monoflowers' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'monoflowers' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'monoflowers_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function monoflowers_scripts() {
	wp_enqueue_style( 'monoflowers-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'monoflowers-main-style', get_template_directory_uri() . '/scss/main.scss', '1.1', true );

    wp_enqueue_style( 'swiper-style', get_template_directory_uri() . '/assets/libs/Swiper/swiper-bundle.min.css', '1.1', true );
	
    wp_style_add_data( 'monoflowers-style', 'rtl', 'replace' );

	wp_enqueue_script( 'monoflowers-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );


    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', false, null, true );
    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'swiper-script', get_template_directory_uri() . '/assets/libs/Swiper/swiper-bundle.min.js', array(), '1.1', true );

    wp_enqueue_script( 'monoflowers-main-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.1', true );
	
	wp_localize_script( 'monoflowers-main-script', 'ajaxurl', admin_url('admin-ajax.php') );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'monoflowers_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Initializing multiple menus
add_action('after_setup_theme', function () {
	register_nav_menus([
		'main_menu' => 'main_menu',
		'bottom_menu' => 'bottom_menu',
	]);
});


add_filter( 'upload_mimes', 'svg_upload_allow' );
# Adds SVG to the list of files allowed for uploading.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	return $mimes;
}

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
# MIME type correction for SVG files.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	else
		$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

	if( $dosvg ){

		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		else {
			$data['ext'] = $type_and_ext['type'] = false;
		}

	}

	return $data;
}

add_filter( 'wp_prepare_attachment_for_js', 'show_svg_in_media_library' );
# Generates data for displaying SVG as images in the media library.
function show_svg_in_media_library( $response ) {

	if ( $response['mime'] === 'image/svg+xml' ) {
		$response['image'] = [
			'src' => $response['url'],
		];
	}

	return $response;
}


// Delete teg <p> and <br> from the Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');


// Disabling the update of some plugins
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
function filter_plugin_updates( $value ) {
	unset( $value->response['advanced-custom-fields-pro-master/acf.php'] );
	return $value;
}

// ACF Options Page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Настройки сайта',
        'menu_title'    => 'Настройки сайта',
        'menu_slug'     => 'site-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

function onemebel_register_services_cpt() {
    register_post_type('service', [
        'labels' => [
            'name'               => 'Услуги',
            'singular_name'      => 'Услуга',
            'add_new'            => 'Добавить услугу',
            'add_new_item'       => 'Добавить новую услугу',
            'edit_item'          => 'Редактировать услугу',
            'view_item'          => 'Просмотр услуги',
            'all_items'          => 'Все услуги',
            'not_found'          => 'Услуги не найдены',
        ],
        'public'        => true,
        'has_archive'   => true,      
        'menu_icon'     => 'dashicons-hammer',
        'menu_position' => 5,
        'supports'      => ['title', 'thumbnail', 'excerpt', 'page-attributes'],
        'show_in_rest'  => true,
        'rewrite'       => ['slug' => 'uslugi'],
    ]);
}
add_action('init', 'onemebel_register_services_cpt');


// --- Портфолио (работы) ---
function onemebel_register_portfolio_cpt() {
    register_post_type('portfolio', [
        'labels' => [
            'name'          => 'Наши работы',
            'singular_name' => 'Работа',
            'add_new'       => 'Добавить работу',
            'add_new_item'  => 'Добавить новую работу',
            'edit_item'     => 'Редактировать работу',
            'all_items'     => 'Все работы',
            'not_found'     => 'Работы не найдены',
        ],
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-format-gallery',
        'menu_position' => 6,
        'supports'      => ['title', 'thumbnail', 'page-attributes'],
        'show_in_rest'  => true,
        'rewrite'       => ['slug' => 'portfolio'],
    ]);
}
add_action('init', 'onemebel_register_portfolio_cpt');

// --- Отзывы ---
function onemebel_register_reviews_cpt() {
    register_post_type('review', [
        'labels' => [
            'name'          => 'Отзывы',
            'singular_name' => 'Отзыв',
            'add_new'       => 'Добавить отзыв',
            'add_new_item'  => 'Добавить новый отзыв',
            'edit_item'     => 'Редактировать отзыв',
            'all_items'     => 'Все отзывы',
            'not_found'     => 'Отзывы не найдены',
        ],
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-testimonial',
        'menu_position' => 7,
        'supports'      => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'onemebel_register_reviews_cpt');

// --- Прайс-лист ---
function onemebel_register_price_cpt() {
    register_post_type('price_item', [
        'labels' => [
            'name'          => 'Цены',
            'singular_name' => 'Цена',
            'add_new'       => 'Добавить позицию',
            'add_new_item'  => 'Добавить новую позицию',
            'edit_item'     => 'Редактировать позицию',
            'all_items'     => 'Все цены',
            'not_found'     => 'Цены не найдены',
        ],
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-money-alt',
        'menu_position' => 8,
        'supports'      => ['title', 'page-attributes'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'onemebel_register_price_cpt');

// --- Таксономия: Категории портфолио ---
function onemebel_register_portfolio_taxonomy() {
    register_taxonomy('portfolio_category', 'portfolio', [
        'labels' => [
            'name'              => 'Категории работ',
            'singular_name'     => 'Категория',
            'add_new_item'      => 'Добавить категорию',
            'edit_item'         => 'Редактировать категорию',
            'all_items'         => 'Все категории',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'portfolio-cat'],
    ]);
}
add_action('init', 'onemebel_register_portfolio_taxonomy');

// AJAX-обработчики модального окна и фильтров
require get_template_directory() . '/inc/ajax-handlers.php';