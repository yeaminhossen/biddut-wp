<?php

/**
 * biddut functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package biddut
 */

if ( !function_exists( 'biddut_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function biddut_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on biddut, use a find and replace
         * to change 'biddut' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'biddut', get_template_directory() . '/languages' );

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
        register_nav_menus( [
            'main-menu' => esc_html__( 'Main Menu', 'biddut' ),
        ] );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'biddut_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ] ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        //Enable custom header
        add_theme_support( 'custom-header' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote',
        ] );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        remove_theme_support( 'widgets-block-editor' );
        
        // Add support for woocommerce.
        add_theme_support('woocommerce');

        // Remove woocommerce defauly styles
        add_filter( 'woocommerce_enqueue_styles', '__return_false' );

        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );

        if ( function_exists( 'register_block_style' ) ) {
                register_block_style(
                    'core/quote',
                    array(
                        'name'         => 'blue-quote',
                        'label'        => __( 'Blue Quote', 'biddut' ),
                        'is_default'   => true,
                        'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
                    )
                );
            }
        }
        endif;

        if (function_exists('register_block_pattern')) {
            register_block_pattern(
                'biddut/custom-pattern',
                array(
                    'title'       => __('Custom Pattern', 'biddut'),
                    'description' => _x('A custom block pattern for Liko theme', 'Block pattern description', 'biddut'),
                    'content'     => "<!-- wp:paragraph --><p>" . __('Hello World', 'biddut') . "</p><!-- /wp:paragraph -->",
                )
            );
        }

        add_editor_style( 'custom-editor-style.css' );

add_action( 'after_setup_theme', 'biddut_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function biddut_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'biddut_content_width', 640 );
}
add_action( 'after_setup_theme', 'biddut_content_width', 0 );



/**
 * Enqueue scripts and styles.
 */

define( 'BIDDUT_THEME_DIR', get_template_directory() );
define( 'BIDDUT_THEME_URI', get_template_directory_uri() );
define( 'BIDDUT_THEME_CSS_DIR', BIDDUT_THEME_URI . '/assets/css/' );
define( 'BIDDUT_THEME_JS_DIR', BIDDUT_THEME_URI . '/assets/js/' );
define( 'BIDDUT_THEME_INC', BIDDUT_THEME_DIR . '/inc/' );



// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Implement the Custom Header feature.
 */
require BIDDUT_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require BIDDUT_THEME_INC . 'template-functions.php';

/**
 * Custom template helper function for this theme.
 */
require BIDDUT_THEME_INC . 'template-helper.php';

/**
 * initialize kirki customizer class.
 */
if ( class_exists( 'Kirki' ) ) {
    include_once BIDDUT_THEME_INC . 'kirki-customizer.php';
}
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require BIDDUT_THEME_INC . 'jetpack.php';
}

/**
 * include biddut functions file
 */
require_once BIDDUT_THEME_INC . 'class-navwalker.php';
require_once BIDDUT_THEME_INC . 'class-tgm-plugin-activation.php';
require_once BIDDUT_THEME_INC . 'add_plugin.php';
require_once BIDDUT_THEME_INC . '/common/biddut-breadcrumb.php';
require_once BIDDUT_THEME_INC . '/common/biddut-scripts.php';
require_once BIDDUT_THEME_INC . '/common/biddut-widgets.php';
if ( function_exists('tpmeta_kick')) {
    require_once BIDDUT_THEME_INC . 'tp-metabox.php';
}

if ( class_exists( 'WooCommerce' ) ) {
    require_once BIDDUT_THEME_INC . '/woocommerce/tp-woo.php';
}

/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter( 'the_content', 'biddut_shortcode_extra_content_remove' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function biddut_shortcode_extra_content_remove( $content ) {

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr( $content, $array );

}



// biddut_search_filter_form
if ( !function_exists( 'biddut_search_form_filter' ) ) {
function biddut_search_form_filter( $form ) {
    $form = '<div class="sidebar__widget-content">
               <div class="sidebar__search">
                     <form action="' . home_url( '/' ) . '">
                        <div class="sidebar__search-input-2">
                           <input type="text" name="s" placeholder="' . __( 'Search for:','biddut' ) . '" value="' . get_search_query() . '">
                           <button type="submit"><i class="far fa-search"></i></button>
                        </div>
                     </form>
               </div>
            </div>
    ';

        return $form;
    }
}
add_filter( 'get_search_form', 'biddut_search_form_filter' );



// biddut_admin_custom_scripts
function biddut_admin_custom_scripts() {
    wp_enqueue_media();
    wp_enqueue_style( 'customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css',array());
    wp_enqueue_script( 'biddut-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'biddut-admin-custom' );
}