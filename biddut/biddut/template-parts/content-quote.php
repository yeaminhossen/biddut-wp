<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package biddut
 */
?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__blockquote pb-10 p-relative d-flex justify-content-between align-items-start' );?>>
    <?php the_content();?>
    <div class="postbox__blockquote-shape d-none d-xl-block">
        <img src="<?php echo esc_url(get_template_directory_uri());?> /assets/img/blog/quote.png" alt="">
     </div>
</article>