 <?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package biddut
 */

$gallery_images = function_exists('tpmeta_gallery_field')? tpmeta_gallery_field('biddut_post_gallery') : '';

$biddut_social_share_switch = get_theme_mod( 'biddut_social_share_switch', false );
$tag_col_number= $biddut_social_share_switch ? "col-xl-5 col-lg-6 col-md-6" : "col-12";
if ( is_single() ): ?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item transition-3 format-gallery' );?>>
      <?php if ( !empty( $gallery_images ) ): ?>
      <div class="postbox__thumb">
         <div class="postbox__thumb-slider p-relative">
               <div class="swiper-container postbox__thumb-slider-active">
                  <div class="swiper-wrapper">
                    <?php foreach ( $gallery_images as $key => $image ): ?>
                     <div class="swiper-slide">
                           <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_url($image['alt']); ?>">
                     </div>
                     <?php endforeach;?>
                  </div>
               </div>
               <div class="postbox__slider-arrow-wrap d-none d-sm-block">
                  <button class="postbox-arrow-next">
                     <i class="fa-sharp fa-regular fa-arrow-left"></i>
                  </button>
                  <button class="postbox-arrow-prev">                                                
                     <i class="fa-sharp fa-regular fa-arrow-right"></i>                                            
                  </button>
               </div>
         </div>
      </div>
      <?php endif; ?>

    <div class="postbox__content mb-70">
       <div class="postbox__meta-box pb-5 d-flex justify-content-between align-items-center">
         <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
       </div>

       <h3 class="postbox__title pb-5"><?php the_title(); ?></h3>

       <div class="postbox__text">
          
          <?php the_content(); ?>

          <?php if(has_tag()) : ?>
          <div class="postbox__thumb m-img p-relative">
             <div class="postbox__details-share-wrapper">
                <div class="row">
                   <div class="<?php echo esc_attr($tag_col_number); ?>">
                      <div class="postbox__details-tag tagcloud">
                        <span><?php echo esc_html__('Tag:','biddut'); ?></span>
                        <?php
                            $tags = get_the_tags(); // Assuming you are within the loop
                            if ($tags) {
                                
                                foreach ($tags as $tag) {
                                    echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                }
                            }
                        ?>
                      </div>
                   </div>
                    <?php if(function_exists('biddut_blog_social_share') && !empty($biddut_social_share_switch)) : ?>
                   <div class="col-xl-7 col-lg-6 col-md-6">
                      <div class="postbox__details-share text-lg-end">
                         <?php biddut_blog_social_share(); ?>
                      </div>
                   </div>
                    <?php endif; ?>
                </div>
             </div>
          </div>
          <?php endif; ?>
       </div>
    </div>
</article>  


<?php else: 
    $categories = get_the_terms( $post->ID, 'category' );    
    $biddut_blog_cat = get_theme_mod( 'biddut_blog_cat', false );
?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-image mb-50 transition-3 format-gallery' );?>>

  <?php if ( !empty( $gallery_images ) ): ?>
  <div class="postbox__thumb">
     <div class="postbox__thumb-slider p-relative">
           <div class="swiper-container postbox__thumb-slider-active">
              <div class="swiper-wrapper">
                <?php foreach ( $gallery_images as $key => $image ): ?>
                 <div class="swiper-slide">
                       <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_url($image['alt']); ?>">
                 </div>
                 <?php endforeach;?>
              </div>
           </div>
           <div class="postbox__slider-arrow-wrap d-none d-sm-block">
              <button class="postbox-arrow-next">
                 <i class="fa-sharp fa-regular fa-arrow-left"></i>
              </button>
              <button class="postbox-arrow-prev">                                                
                 <i class="fa-sharp fa-regular fa-arrow-right"></i>                                            
              </button>
           </div>
     </div>
  </div>
  <?php endif; ?>

  <div class="postbox__content">

      <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

     <h3 class="postbox__title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
     </h3>

     <div class="postbox__text">
           <?php the_excerpt(); ?>     
      </div> 

    <!-- blog btn -->
    <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>

  </div>
</article>

<?php
endif;?>