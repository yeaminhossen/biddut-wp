<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package biddut
	*/

   $header_topbar_switch = get_theme_mod( 'header_topbar_switch', true );

   // Email id 
   $header_top_email = get_theme_mod( 'header_email', __( 'biddut@support.com', 'biddut' ) );

   // Phone Number
   $header_top_phone = get_theme_mod( 'header_phone', __( '+8801310-069824', 'biddut' ) );

   // Header Address Text
   $header_top_address_text = get_theme_mod( 'header_address', __( '76 San Fransisco Street. New York', 'biddut' ) );

   // Header charity Text
   $header_top_charity_text = get_theme_mod( 'header_top_charity_text', __( 'Connect with our charity', 'biddut' ) );

   // Header Address Link
   $header_top_address_link = get_theme_mod( 'header_address_link', __( '#', 'biddut' ) );


   // header right
   $biddut_header_right = get_theme_mod( 'header_right_switch', false );
   $biddut_header_menu_col = $biddut_header_right ? 'col-xl-8 d-none d-xl-block' : 'col-xl-10 d-none d-xl-block';
   $biddut_menu_position = $biddut_header_right ? 'text-xxl-start' : 'text-xxl-end menu-border-none';

   // header search btn 
   $header_search_switch = get_theme_mod( 'header_search_switch', true );

?>


   <header>
      <div class="tp-header-transparent border-color">
         <?php if($header_topbar_switch) : ?>
         <!-- header top area start -->
         <div class="tp-header-top-area tp-header-top-wrap tp-header-top-space p-relative black-bg">
            <div class="container">
               <div class="row align-items-center">

                  <div class="col-xl-6 col-lg-8 col-md-8 col-sm-6">
                     <div class="tp-header-top-left-box text-center text-md-start">
                        <ul>
                           <?php if($header_top_address_text) : ?>
                           <li>
                              <i class="flaticon-pin"></i>
                              <a href="<?php echo esc_url($header_top_address_link); ?>"><?php echo esc_html($header_top_address_text); ?></a>
                           </li>
                           <?php endif; ?>

                           <?php if($header_top_email) : ?>
                           <li class="d-none d-md-inline-block">
                              <i class="flaticon-mail-1"></i>
                              <a href="mailto:<?php echo esc_html($header_top_email); ?>"><?php echo esc_html($header_top_email); ?></a>
                           </li>
                        <?php endif; ?>
                        </ul>
                     </div>
                  </div>

                  <div class="col-xl-6 col-lg-4 col-md-4 col-sm-6 d-none d-sm-block">
                     <div class="tp-header-top-right-box text-end">
                        <ul>
                           <li>
                              <div class="tp-header-top-right-social">
                                 <?php biddut_header_social_profiles(); ?>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>      
         <!-- header top area end -->
         <?php endif; ?>
   
         <!-- header area start -->
         <div id="header-sticky" class="tp-header-area tp-header-style-2 tp-header-style-3">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                     <div class="tp-header-logo">
                        <?php biddut_header_logo(); ?>
                     </div>
                  </div>
                  <div class="<?php echo esc_attr($biddut_header_menu_col); ?>">
                     <div class="tp-header-main-menu tp-header-menu-border-2 text-end <?php echo esc_attr($biddut_menu_position); ?>">
                        <nav class="tp-main-menu-content">
                           <?php biddut_header_menu(); ?>
                        </nav>
                     </div>
                  </div>
                  <?php if(!empty($biddut_header_right)) : ?>
                  <div class="col-xxl-2 col-xl-2 col-lg-8 col-md-8 col-6">
                     <div class="tp-header-right-box">
                        <div class="tp-header-right-action d-flex align-items-center justify-content-end">
                           <?php if($header_search_switch) : ?>
                           <div class="tp-header-right-icon-action d-none d-lg-block">
                              <div class="tp-header-right-icon d-flex align-items-center">
                                 <button class="search-open-btn"><i class="flaticon-loupe"></i></button>
                                 <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                                 <div class="tp-header-right-shop p-relative">
                                    <a href="<?php echo wc_get_cart_url(); ?>">
                                       <i class="fa-light fa-bag-shopping"></i>
                                       <span id="tp-cart-item" class="cart__count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                                    </a>
                                    <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                                 </div>
                                 <?php endif; ?>
                              </div>
                           </div>
                           <?php endif; ?>
                           <div class="tp-header-bar d-xl-none">
                              <button class="tp-menu-bar"><i class="fa-sharp fa-regular fa-bars-staggered"></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>

                  <?php if(empty($biddut_header_right)) : ?>
                  <div class="col-xxl-2 col-xl-2 col-lg-8 col-md-8 col-6 d-xl-none">
                     <div class="tp-header-right-box">
                        <div class="tp-header-right-action d-flex align-items-center justify-content-end">
                           <div class="tp-header-bar d-xl-none">
                              <button class="tp-menu-bar"><i class="fa-sharp fa-regular fa-bars-staggered"></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>

               </div>
            </div>
         </div>
         <!-- header area end -->
      </div>
   </header>





<!-- header area end -->
<?php get_template_part( 'template-parts/header/header-side-info' ); ?>