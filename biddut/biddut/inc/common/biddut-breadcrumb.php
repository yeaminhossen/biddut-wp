<?php
/**
 * Breadcrumbs for biddut theme.
 *
 * @package     biddut
 * @author      Theme_Pure
 * @copyright   Copyright (c) 2022, Theme_Pure
 * @link        https://www.weblearnbd.net
 * @since       biddut 1.0.0
 */



function biddut_breadcrumb_func() {
    global $post;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','biddut'));
        $breadcrumb_class = 'home_front_page';
    }
    elseif ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','biddut'));
        $breadcrumb_show = 0;
    }
    elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $title = get_the_title( get_option( 'page_for_posts') );
        }
    }
    elseif ( is_single() && 'post' == get_post_type() ) {
      $title = get_the_title();
    } 
    elseif ( is_single() && 'product' == get_post_type() ) {
        $title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'biddut' ) );
    } 
    elseif ( is_single() && 'courses' == get_post_type() ) {
      $title = esc_html__( 'Course Details', 'biddut' );
    } 
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'biddut' ) . get_search_query();
    } 
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'biddut' );
    } 
    elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } 
    else {
        $title = get_the_title();
    }
 


    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) { 
        $_id = $post->ID;
    } 
    elseif ( function_exists("is_shop") AND is_shop()  ) { 
        $_id = wc_get_page_id('shop');
    } 
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
    }

    $is_breadcrumb = function_exists('tpmeta_field')? tpmeta_field('biddut_check_bredcrumb') : 'on';

    $con1 = $is_breadcrumb && ($is_breadcrumb== 'on') && $breadcrumb_show == 1;

    $con_main = is_404() ? is_404() : $con1;
    
      if (  $con_main ) {
        $bg_img_from_page = function_exists('tpmeta_image_field')? tpmeta_image_field('biddut_breadcrumb_bg') : '';

        $hide_bg_img = function_exists('tpmeta_field')? tpmeta_field('biddut_check_bredcrumb_img') : 'on';

        // get_theme_mod
        $bg_img = get_theme_mod( 'breadcrumb_image' );
        $breadcrumb_padding = get_theme_mod( 'breadcrumb_padding' );
        $breadcrumb_bg_color = get_theme_mod( 'breadcrumb_bg_color', '#16243E' );
        $breadcrumb_shape_switch = get_theme_mod( 'breadcrumb_shape_switch', 'on' );

        if ( $hide_bg_img == 'off' ) {
            $bg_main_img = '';
        }else{  
            $bg_main_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
        }

        $breadcrumb_sub_title_page = function_exists('tpmeta_field')? tpmeta_field('biddut_breadcrumb_sub_title') : '';
        $breadcrumb_sub_title_kirki = get_theme_mod( 'breadcrumb_sub_title' );

        $breadcrumb_sub_title_main = !empty( $breadcrumb_sub_title_page ) ? $breadcrumb_sub_title_page : $breadcrumb_sub_title_kirki;
        
        ?>


      <div class="breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix" data-background="<?php echo esc_url($bg_main_img); ?>">
         <div class="container">
            <div class="row">
               <div class="col-xxl-12">
                  <div class="breadcrumb__content z-index text-center">
                     <div class="breadcrumb__section-title-box mb-20">
                        <h3 class="breadcrumb__title"><?php echo biddut_kses( $title ); ?></h3>
                     </div>
                     <?php if(function_exists('bcn_display')) : ?>
                     <div class="breadcrumb__list">
                        <?php bcn_display(); ?>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>

<?php
      }
}

add_action( 'biddut_before_main_content', 'biddut_breadcrumb_func' );

// biddut_search_form
function biddut_search_form() {

     $biddut_search_logo = get_template_directory_uri() . '/assets/img/logo/white-logo.png';
     $biddut_search_logo_url = get_theme_mod( 'header_search_logo', $biddut_search_logo );

    ?>

   <div class="search__popup">
      <div class="container">
         <div class="row">
            <div class="col-xxl-12">
               <div class="search__wrapper">
                  <div class="search__top d-flex justify-content-between align-items-center">
                    <?php if(!empty($biddut_search_logo_url)) : ?>
                     <div class="search__logo">
                        <a href="<?php print esc_url( home_url( '/' ) );?>">
                            <img src="<?php echo esc_url($biddut_search_logo_url); ?>" alt="<?php print esc_attr__( 'Search logo', 'biddut' );?>">
                        </a>
                     </div>
                    <?php endif; ?>

                     <div class="search__close">
                        <button type="button" class="search__close-btn search-close-btn">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>                                 
                        </button>
                     </div>
                  </div>
                  <div class="search__form">
                     <form action="<?php print esc_url( home_url( '/' ) );?>">
                        <div class="search__input">
                           <input class="search-input-field" name="s" type="text" value="<?php echo esc_attr( get_search_query() )?>" placeholder="<?php echo esc_attr__('Type here to search...','biddut'); ?>">
                           <span class="search-focus-border"></span>
                           <button type="submit">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg> 
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


<?php
}
add_action( 'biddut_before_main_content', 'biddut_search_form' );
