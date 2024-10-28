<?php 

/**
 * Template part for displaying footer layout three
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package biddut
*/

    $footer_bg_img = get_theme_mod( 'footer_bg_image' );
    $biddut_footer_logo = get_theme_mod( 'biddut_footer_logo' );
    $biddut_footer_top_space = function_exists('tpmeta_field') ? tpmeta_field('biddut_footer_top_space') : '0';
    $biddut_copyright_center = $biddut_footer_logo ? 'col-lg-4 offset-lg-4 col-md-6 text-right' : 'col-lg-12 text-center';
    $biddut_footer_bg_url_from_page = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'biddut_footer_bg_image' ) : '';
    $biddut_footer_bg_color_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'biddut_footer_bg_color' ) : '';
    $footer_bg_color = get_theme_mod( 'footer_bg_color' );
    $footer_copyright_switch = get_theme_mod( 'footer_copyright_switch', true );
    $footer_bottom_copyright_area_switch = get_theme_mod( 'footer_bottom_copyright_area_switch', true );

    $footer_bottom_menu = get_theme_mod( 'footer_bottom_menu', __( '#', 'biddut' ) );
    // bg image
    $bg_img = !empty( $biddut_footer_bg_url_from_page['url'] ) ? $biddut_footer_bg_url_from_page['url'] : $footer_bg_img;

    // bg color
    $bg_color = !empty( $biddut_footer_bg_color_from_page ) ? $biddut_footer_bg_color_from_page : $footer_bg_color;
 


    $footer_social_switch = get_theme_mod( 'footer_social_switch', false );

    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    for ( $num = 1; $num <= $footer_widgets + 1; $num++ ) {
        if ( is_active_sidebar( 'footer-2-' . $num ) ) {
            $footer_columns++;
        }
    }

    switch ( $footer_columns ) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
        $footer_class[3] = 'col-xl-4 col-lg-6';
        break;
    case '5':
        $footer_class[1] = 'col-xl-4 col-lg-4 col-md-6';
        $footer_class[2] = 'col-xl-2 col-lg-4 col-md-6';
        $footer_class[3] = 'col-xl-3 col-lg-4 col-md-6';
        $footer_class[4] = 'col-xl-3 col-lg-6 col-md-6';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;
    }

?>

        <!-- footer area start -->
        <footer class="tp-footer-area z-index-1 p-relative" data-bg-color="#16243E">
            <div class="tp-footer-bg-shape">
               <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/footer/bg-shape.png" alt="">
            </div>
            <?php if ( is_active_sidebar('footer-2-1') OR is_active_sidebar('footer-2-2') OR is_active_sidebar('footer-2-3') OR is_active_sidebar('footer-2-4') ): ?>
            <div class="tp-footer-main-area tp-footer-border pt-80">
               <div class="container">
               <div class="row">
                        <?php
                        if ( $footer_columns < 5 ) {
                        print '<div class="col-xl-4 col-lg-4 col-md-6" >';
                        dynamic_sidebar( 'footer-2-1' );
                        print '</div>';

                        print '<div class="col-xl-2 col-lg-4 col-md-6">';
                        dynamic_sidebar( 'footer-2-2' );
                        print '</div>';

                        print '<div class="col-xl-3 col-lg-4 col-md-6">';
                        dynamic_sidebar( 'footer-2-3' );
                        print '</div>';

                        print '<div class="col-xl-3 col-lg-6 col-md-6">';
                        dynamic_sidebar( 'footer-2-4' );
                        print '</div>';
                        } else {
                            for ( $num = 1; $num <= $footer_columns; $num++ ) {
                                if ( !is_active_sidebar( 'footer-2-' . $num ) ) {
                                    continue;
                                }
                                print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                dynamic_sidebar( 'footer-2-' . $num );
                                print '</div>';
                            }
                        }
                    ?>
                        
                    </div>
               </div>
            </div>
            <?php endif; ?>
            <div class="tp-footer-copyright-area p-relative">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12 col-lg-6">
                        <div class="tp-footer-copyright-inner">
                           <p><?php print biddut_copyright_text(); ?></p>
                        </div>
                     </div>
                     <div class="col-md-12 col-lg-6">
                        <div class="tp-footer-copyright-inner text-lg-end">
                        <?php echo biddut_kses( $footer_bottom_menu ); ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!-- footer area end -->

