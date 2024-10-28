<?php 

   /**
    * Template part for displaying header side information
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package biddut
   */

    $header_side_logo = get_theme_mod( 'header_side_logo', get_template_directory_uri() . '/assets/img/logo/white-logo.png' );

    // Contacts Text 
    $header_side_contacts_label = get_theme_mod( 'header_side_contacts_label', __( 'CONTACT US', 'biddut' ) );
    $header_side_address = get_theme_mod( 'header_side_address', __( 'Melbone st, Australia, Ny 12099', 'biddut' ) );
    $header_side_address_url = get_theme_mod( 'header_side_address_url', __( '#', 'biddut' ) );
    $header_side_address_email = get_theme_mod( 'header_side_address_email', __( 'themepure@gmail.com', 'biddut' ) );
    $header_side_address_phone = get_theme_mod( 'header_side_address_phone', __( '+48 555 223 224', 'biddut' ) );

   // Header Address Link
   $header_side_mailchimp = get_theme_mod( 'header_side_mailchimp');


   //Offcanvas About Us
   $offcanvas_about_us = get_theme_mod( 'header_top_offcanvas_textarea', __( 'Web designing in a powerful way of just not an only professions. We have tendency to believe the idea that smart looking .', 'biddut' ) );

    // footer area links  switch
    $header_side_info_switch = get_theme_mod( 'header_side_info_switch', false );

?>

   <!-- tp-offcanvus-area-start -->
   <div class="tpoffcanvas-area">
      <div class="tpoffcanvas">
         <div class="tpoffcanvas__close-btn">
            <button class="close-btn"><i class="fal fa-times"></i></button>
         </div>
         <?php if($header_side_logo) : ?>
         <div class="tpoffcanvas__logo">
            <a href="<?php echo esc_url( home_url( '/' ) );?>">
                     <img src="<?php echo esc_url($header_side_logo); ?>" alt="<?php echo esc_attr__('Side Logo', 'biddut'); ?>">
            </a>
         </div>
         <?php endif; ?>

         <?php if($header_side_info_switch) : ?>
         <div class="tpoffcanvas__title">
            <p><?php echo esc_html($offcanvas_about_us); ?></p>
         </div>
         <?php endif; ?>

         <div class="tp-main-menu-mobile d-xl-none"></div>

         <?php if($header_side_info_switch) : ?>
         <div class="tpoffcanvas__contact-info">
            <div class="tpoffcanvas__contact-title">
               <h5><?php echo esc_html($header_side_contacts_label); ?></h5>
            </div>
            <ul>
                <?php if($header_side_address) : ?>
               <li>
                  <i class="fa-light fa-location-dot"></i>
                  <a href="<?php echo esc_url($header_side_address_url); ?>" target="_blank"><?php echo esc_html($header_side_address); ?></a>
               </li>
               <?php endif; ?>

               <?php if($header_side_address_email) : ?>
               <li>
                  <i class="fas fa-envelope"></i>
                  <a href="mailto:<?php echo esc_html($header_side_address_email); ?>"><?php echo esc_html($header_side_address_email); ?></a>
               </li>
               <?php endif; ?>

               <?php if($header_side_address_phone) : ?>
               <li>
                  <i class="fal fa-phone-alt"></i>
                  <a href="tel:<?php echo esc_html($header_side_address_phone); ?>"><?php echo esc_html($header_side_address_phone); ?></a>
               </li>
               <?php endif; ?>
            </ul>
         </div>
         

         <?php if(!empty($header_side_mailchimp)) : ?>
         <div class="tpoffcanvas__input">
            <div class="tpoffcanvas__input-title">
               <h4><?php echo esc_html__('Get UPdate','biddut'); ?></h4>
            </div>
            <?php echo do_shortcode($header_side_mailchimp); ?>
         </div>
        <?php else : ?>
            <p><?php echo esc_html('Please set your mailchimp shortcode here','biddut'); ?></p>
        <?php endif; ?>



         <div class="tpoffcanvas__social">
            <div class="social-icon">
               <?php biddut_header_social_profiles(); ?>
            </div>
         </div>
         <?php endif; ?>
      </div>
   </div>
   <div class="body-overlay"></div>
   <!-- tp-offcanvus-area-end -->