<?php

remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
remove_action('woocommerce_shop_loop_header','woocommerce_product_taxonomy_archive_header',10);
remove_action('woocommerce_before_shop_loop','woocommerce_output_all_notices',10);
remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);

remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);

remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
// product details 
remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);



add_filter( 'woosq_button_position', '__return_false' );

add_filter( 'woosw_button_position_archive', '__return_false' );
add_filter( 'woosw_button_position_single', '__return_false' );

add_filter( 'woosc_button_position_archive', '__return_false' );
add_filter( 'woosc_button_position_single', '__return_false' );



// woocommerce mini cart content
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
   ob_start();
   ?>
   <div class="mini_shopping_cart_box">
       <?php woocommerce_mini_cart(); ?>
   </div>
   <?php $fragments['.mini_shopping_cart_box'] = ob_get_clean();
   return $fragments;
});

// woocommerce mini cart count icon
if ( ! function_exists( 'biddut_header_add_to_cart_fragment' ) ) {
   function biddut_header_add_to_cart_fragment( $fragments ) {
       ob_start();
       ?>
       <span class="cart__count" id="tp-cart-item">
           <?php echo esc_html( WC()->cart->cart_contents_count ); ?>
       </span>
       <?php
       $fragments['#tp-cart-item'] = ob_get_clean();

       return $fragments;
   }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'biddut_header_add_to_cart_fragment' );




// biddut_product_sidebar_filter before
function biddut_product_sidebar_before($output){
   $output = '<div class="tp-shop-widget-product">';

   return $output;
}
add_filter('woocommerce_before_widget_product_list','biddut_product_sidebar_before');
// biddut_product_sidebar_filter after
function biddut_product_sidebar_after($output){
   $output = '</div>';

   return $output;
}
add_filter('woocommerce_after_widget_product_list','biddut_product_sidebar_after');

// biddut_sale_percentage
function biddut_sale_percentage(){
   global $product;
   $output = '';
   $icon = esc_html__("-",'biddut');

   if ( $product->is_on_sale() && $product->is_type( 'variable' ) ) {
      $percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price( 'min' )) * 100);
      $output .= '<div class="product-percentage-badges"><span class="tp-product-details-offer">'. $icon . $percentage.'%</span></div>';

   } elseif( $product->is_on_sale() && $product->get_regular_price()  && !$product->is_type( 'grouped' )) {
      $percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
      $output .= '<div class="product-percentage-badges">';
      $output .= '<span class="tp-product-details-offer">'.$icon . $percentage.'%</span>';
      $output .= '</div>';
   }
   return $output;
}


// biddut_product_details
function biddut_product_details(){
   global $product;
   global $post;
   global $woocommerce;

   $post_cats = get_the_terms(get_the_ID(), 'product_cat');
   $stock_label = $product->get_stock_status() == 'instock' ? 'In Stock' : '';

   ?>
      <div class="tp-shop-details__right-warp mt-0">

            <?php if(!empty($product->get_stock_quantity())) : ?>
            <div class="product__details-stock mb-15">
                  <span><?php echo esc_html($product->get_stock_quantity()); ?> <?php echo esc_html($stock_label); ?></span>
            </div>
            <?php endif; ?>

            <h3 class="tp-shop-details__title-sm"><?php the_title(); ?></h3>
            
            <div class="tp-shop-details__ratting">
               <?php woocommerce_template_single_rating(); ?>
            </div>
            <div class="tp-shop-details__price">
               <span><?php woocommerce_template_single_price(); ?></span>
               <?php if( $product->is_on_sale() && !$product->is_type( 'grouped' ) ) : ?>
               <span class="red-color"><?php echo biddut_sale_percentage(); ?></span>
               <?php endif; ?>   
            </div>
            <div class="tp-shop-details__text-2">
               <?php woocommerce_template_single_excerpt(); ?>
            </div>
            <div class="tp-shop-details__quantity-wrap mb-20 d-flex align-items-center">
               <?php woocommerce_template_single_add_to_cart(); ?>
            </div>
            <div class="tp-shop-details__product-info">
               <?php woocommerce_template_single_meta(); ?>
            </div>

            <div class="product__details-share">
               <?php do_action('biddut_woo_social_share'); ?>
            </div>
      </div>
   <?php
}

add_action('woocommerce_single_product_summary','biddut_product_details');




// product add to cart button
function biddut_wooc_add_to_cart( $args = array() ) {
    global $product;

        if ( $product ) {
            $defaults = array(
                'quantity'   => 1,
                'class'      => implode(
                    ' ',
                    array_filter(
                        array(
                            'tp-product-action-btn-2 tp-product-add-cart-btn cart-button icon-btn button',
                            'product_type_' . $product->get_type(),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                        )
                    )
                ),
                'attributes' => array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                ),
            );

            $args = wp_parse_args( $args, $defaults );

            if ( isset( $args['attributes']['aria-label'] ) ) {
                $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
            }
        }


         // check product type 
         if( $product->is_type( 'simple' ) ){
            $btntext = esc_html__("Add to Cart",'biddut');
         } elseif( $product->is_type( 'variable' ) ){
            $btntext = esc_html__("Select Options",'biddut');
         } elseif( $product->is_type( 'external' ) ){
            $btntext = esc_html__("Buy Now",'biddut');
         } elseif( $product->is_type( 'grouped' ) ){
            $btntext = esc_html__("View Products",'biddut');
         }
         else{
            $btntext = esc_html__("Add to Cart",'biddut');
         } 

        echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'cart-button icon-btn button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            '                  <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M3.34706 4.53799L3.85961 10.6239C3.89701 11.0923 4.28036 11.4436 4.74871 11.4436H4.75212H14.0265H14.0282C14.4711 11.4436 14.8493 11.1144 14.9122 10.6774L15.7197 5.11162C15.7384 4.97924 15.7053 4.84687 15.6245 4.73995C15.5446 4.63218 15.4273 4.5626 15.2947 4.54393C15.1171 4.55072 7.74498 4.54054 3.34706 4.53799ZM4.74722 12.7162C3.62777 12.7162 2.68001 11.8438 2.58906 10.728L1.81046 1.4837L0.529505 1.26308C0.181854 1.20198 -0.0501969 0.873587 0.00930333 0.526523C0.0705036 0.17946 0.406255 -0.0462578 0.746256 0.00805037L2.51426 0.313534C2.79901 0.363599 3.01576 0.5995 3.04042 0.888012L3.24017 3.26484C15.3748 3.26993 15.4139 3.27587 15.4726 3.28266C15.946 3.3514 16.3625 3.59833 16.6464 3.97849C16.9303 4.35779 17.0493 4.82535 16.9813 5.29376L16.1747 10.8586C16.0225 11.9177 15.1011 12.7162 14.0301 12.7162H14.0259H4.75402H4.74722Z" fill="currentColor"/>
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6629 7.67446H10.3067C9.95394 7.67446 9.66919 7.38934 9.66919 7.03804C9.66919 6.68673 9.95394 6.40161 10.3067 6.40161H12.6629C13.0148 6.40161 13.3004 6.68673 13.3004 7.03804C13.3004 7.38934 13.0148 7.67446 12.6629 7.67446Z" fill="currentColor"/>
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38171 15.0212C4.63756 15.0212 4.84411 15.2278 4.84411 15.4836C4.84411 15.7395 4.63756 15.9469 4.38171 15.9469C4.12501 15.9469 3.91846 15.7395 3.91846 15.4836C3.91846 15.2278 4.12501 15.0212 4.38171 15.0212Z" fill="currentColor"/>
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38082 15.3091C4.28477 15.3091 4.20657 15.3873 4.20657 15.4833C4.20657 15.6763 4.55592 15.6763 4.55592 15.4833C4.55592 15.3873 4.47687 15.3091 4.38082 15.3091ZM4.38067 16.5815C3.77376 16.5815 3.28076 16.0884 3.28076 15.4826C3.28076 14.8767 3.77376 14.3845 4.38067 14.3845C4.98757 14.3845 5.48142 14.8767 5.48142 15.4826C5.48142 16.0884 4.98757 16.5815 4.38067 16.5815Z" fill="currentColor"/>
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9701 15.0212C14.2259 15.0212 14.4333 15.2278 14.4333 15.4836C14.4333 15.7395 14.2259 15.9469 13.9701 15.9469C13.7134 15.9469 13.5068 15.7395 13.5068 15.4836C13.5068 15.2278 13.7134 15.0212 13.9701 15.0212Z" fill="currentColor"/>
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9692 15.3092C13.874 15.3092 13.7958 15.3874 13.7958 15.4835C13.7966 15.6781 14.1451 15.6764 14.1443 15.4835C14.1443 15.3874 14.0652 15.3092 13.9692 15.3092ZM13.969 16.5815C13.3621 16.5815 12.8691 16.0884 12.8691 15.4826C12.8691 14.8767 13.3621 14.3845 13.969 14.3845C14.5768 14.3845 15.0706 14.8767 15.0706 15.4826C15.0706 16.0884 14.5768 16.5815 13.969 16.5815Z" fill="currentColor"/>
                  </svg> <span class="tp-product-tooltip tp-product-tooltip-right">'.$btntext.'</span>'
        );
}




if( !function_exists('tp_woo_product_grid') ) {
function tp_woo_product_grid(){ 
    global $product;
    global $post;
    global $woocommerce;
    $categories = get_the_terms( $post->ID, 'product_cat' );
?>

   <div class="tp-product-item-2 mb-40">
      <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img">
         <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
         </a>
         <!-- product action -->
         <div class="tp-product-action-2 tp-product-action-blackStyle">
            <div class="tp-product-action-item-2 d-flex flex-column">
               <?php biddut_wooc_add_to_cart(); ?>
               <?php if ( function_exists( 'woosq_init' ) ) : ?>
               <div type="button" class="tp-product-action-btn-2 tp-product-quick-view-btn">
                  <?php echo do_shortcode('[woosq]'); ?>                                                                       
                  <span class="tp-product-tooltip tp-product-tooltip-right"><?php echo esc_html__('Quick View','biddut'); ?></span>
               </div>
               <?php endif; ?>
               <?php if ( function_exists( 'woosw_init' ) ) : ?>
               <div type="button" class="tp-product-action-btn-2 tp-product-add-to-wishlist-btn">
                  <?php echo do_shortcode('[woosw]'); ?>                                                                              
                  <span class="tp-product-tooltip tp-product-tooltip-right"><?php echo esc_html__('Add To Wishlist','biddut'); ?></span>
               </div>
               <?php endif; ?>
               <?php if ( function_exists( 'woosc_init' ) ) : ?>   
               <div type="button" class="tp-product-action-btn-2 tp-product-add-to-compare-btn">
                  <?php echo do_shortcode('[woosc]'); ?>                                                                           
                  <span class="tp-product-tooltip tp-product-tooltip-right"><?php echo esc_html__('Add To Compare','biddut'); ?></span>
               </div>
               <?php endif; ?>

            </div>
         </div>
      </div>
      <div class="tp-product-content-2 pt-15">
         <?php if ( !empty( $categories ) ): ?>
         <div class="tp-product-tag-2">
         <?php 
            $html = '';
            foreach($categories as $key => $cat) {

               $html .= '<a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>, ';

               if ($key == 1){ 
                  break;
               } 
            }
            echo rtrim($html,', '); 
               
            ?>
         </div>
         <?php endif; ?>
         <h3 class="tp-product-title-2">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
         </h3>
         <div class="tp-product-rating-icon">
            <?php woocommerce_template_loop_rating(); ?>
         </div>
         <div class="tp-product-price-wrapper-2">
         	<?php woocommerce_template_loop_price(); ?>
         </div>
      </div>
   </div>

<?php } 
}

add_action('woocommerce_before_shop_loop_item','tp_woo_product_grid',10);

// woosc_bar_bg_color_default
add_filter( 'woosc_bar_bg_color_default', 'acadia_change_woosc_bar_bg_color' );
function acadia_change_woosc_bar_bg_color( $default_color ) {
    return 'transparent';
}



add_action( 'wp_footer' , 'biddut_custom_quantity_fields_script' );

// custom_quantity_fields_script
function biddut_custom_quantity_fields_script(){
    ?>
    <script type='text/javascript'>
    jQuery( function( $ ) {
        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.tp-cart-plus, .tp-cart-minus', function() {
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.tp-cart-plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
    });
    </script>
    <?php
}