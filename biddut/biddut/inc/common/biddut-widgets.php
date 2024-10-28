<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function biddut_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_layout_2_switch', false );
    $footer_style_3_switch = get_theme_mod( 'footer_layout_3_switch', false );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'biddut' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="sidebar__widget mb-30 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="sidebar__widget-title">',
        'after_title'   => '</h3>',
    ] );    

    /**
     * Product sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Product Sidebar', 'biddut' ),
        'id'            => 'product-sidebar',
        'before_widget' => '<div id="%1$s" class="tp-shop-widget mb-50 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-shop-widget-title">',
        'after_title'   => '</h3>',
    ] );

    /**
     * blog sidebar
     */
    if(class_exists("TP_Core")) :
    register_sidebar( [
        'name'          => esc_html__( 'Services Sidebar', 'biddut' ),
        'id'            => 'services-sidebar',
        'before_widget' => '<div id="%1$s" class="tp-service-details-widget mb-30 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="tp-service-details-title">',
        'after_title'   => '</h4>',
    ] );
    endif;


    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );



    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'biddut' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer Column %1$s', 'biddut' ), $num ),
            'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-50 footer-cols-'.$num.' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="tp-footer-title">',
            'after_title'   => '</h4>',
        ] );
    }

    // footer 2
    if ( $footer_style_2_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'biddut' ), $num ),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'biddut' ), $num ),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-col-'.$num.' mb-50 %2$s"> <div class="tp-footer-widget-content">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h3 class="tp-footer-widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }    
  
    // footer 3
    if ( $footer_style_3_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'biddut' ), $num ),
                'id'            => 'footer-3-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'biddut' ), $num ),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-3-col-'.$num.' mb-50 %2$s"> <div class="tp-footer-widget-content">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h3 class="tp-footer-widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }    
}
add_action( 'widgets_init', 'biddut_widgets_init' );