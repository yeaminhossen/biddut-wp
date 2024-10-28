<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$post_cats = get_the_terms(get_the_ID(), 'product_cat');
$post_tags = get_the_terms(get_the_ID(), 'product_tag');
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>


	<div class="product__details-sku product__details-more">
		<p><?php esc_html_e( 'SKU:', 'biddut' ); ?></p>
		<span><?php echo esc_html( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'biddut' ); ?></span>
	</div>

	<?php if(!empty($post_cats)) : ?>
	<div class="product__details-categories product__details-more mb-15">
		<p><?php echo esc_html(_n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'biddut' )); ?></p>
		<?php 
        $html = '';
        foreach($post_cats as $key => $cat) {
           $html .= '<span><a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a></span>, ';
        }
        echo rtrim($html,', '); 
 		?>
	</div>
	<?php endif; ?>

	<?php if(!empty($post_tags)) : ?>
	<div class="product__details-tags mb-15">
		<span><?php echo esc_html(_n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'biddut' )); ?></span>
		<?php 
        $html = '';
        foreach($post_tags as $key => $tag) {
           $html .= '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a> ';
        }
		echo biddut_kses($html);
 		?>
	</div>
	<?php endif; ?>

	

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
