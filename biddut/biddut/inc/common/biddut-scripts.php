<?php

/**
 * biddut_scripts description
 * @return [type] [description]
 */
function biddut_scripts() {

    /**
     * all css files
    */ 

    wp_enqueue_style( 'biddut-fonts', biddut_fonts_url(), array(), '1.0.0' );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', BIDDUT_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', BIDDUT_THEME_CSS_DIR.'bootstrap.css', array() );
    }
    wp_enqueue_style( 'animate', BIDDUT_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'biddut-custom-animation', BIDDUT_THEME_CSS_DIR . 'custom-animation.css', [] );
    wp_enqueue_style( 'flaticon-biddut', BIDDUT_THEME_CSS_DIR . 'flaticon_biddut.css', [] );
    wp_enqueue_style( 'font-awesome-pro', BIDDUT_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'magnific-popup', BIDDUT_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'swiper-bundle', BIDDUT_THEME_CSS_DIR . 'swiper-bundle.css', [] );
    wp_enqueue_style( 'slick', BIDDUT_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'biddut-spacing', BIDDUT_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'biddut-core', BIDDUT_THEME_CSS_DIR . 'biddut-core.css', [], time() );
    wp_enqueue_style( 'biddut-unit', BIDDUT_THEME_CSS_DIR . 'biddut-unit.css', [], time() );
    wp_enqueue_style( 'biddut-custom', BIDDUT_THEME_CSS_DIR . 'biddut-custom.css', [] );
    wp_enqueue_style( 'biddut-style', get_stylesheet_uri() );


    // all js
    wp_enqueue_script( 'waypoints', BIDDUT_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'bootstrap-bundle', BIDDUT_THEME_JS_DIR . 'bootstrap-bundle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jarallax', BIDDUT_THEME_JS_DIR . 'jarallax.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'magnific-popup', BIDDUT_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'nice-select', BIDDUT_THEME_JS_DIR . 'nice-select.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'purecounter', BIDDUT_THEME_JS_DIR . 'purecounter.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'range-slider', BIDDUT_THEME_JS_DIR . 'range-slider.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'slick', BIDDUT_THEME_JS_DIR . 'slick.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'swiper-bundle', BIDDUT_THEME_JS_DIR . 'swiper-bundle.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wow', BIDDUT_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope-pkgd', BIDDUT_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'biddut-main', BIDDUT_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'biddut_scripts' );


/*
Register Fonts
 */
function biddut_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'biddut' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap';
    }
    return $font_url;
}