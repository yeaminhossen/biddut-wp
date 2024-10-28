<?php
    $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
    $facebook_url = get_the_author_meta( 'biddut_user_facebook_url' );
    $twitter_url = get_the_author_meta( 'biddut_user_twitter_url' );
    $linkedin_url = get_the_author_meta( 'biddut_user_linkedin_url' );
    $instagram_url = get_the_author_meta( 'biddut_user_instagram_url' );
    $author_bio_avatar_size = 136;
    if ( $author_data != '' ):
?>


<div class="postbox__author black-bg d-sm-flex align-items-start white-bg mb-50">
   <div class="postbox__author-thumb">
      <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
         <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object rounded-circle' ] );?>
      </a>
   </div>
   <div class="postbox__author-content">
      <h3 class="postbox__author-title">
         <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><?php echo get_the_author(); ?>
          </a>
      </h3>
      <p><?php the_author_meta( 'description' );?></p>

      <div class="postbox__author-social d-flex align-items-center">
         <?php if(!empty($facebook_url)) : ?>
         <a target="_blank" href="<?php echo esc_url($facebook_url); ?>"><i class="fa-brands fa-facebook-f"></i></a>
         <?php endif; ?>
         <?php if(!empty($instagram_url)) : ?>
         <a target="_blank" href="<?php echo esc_url($instagram_url); ?>"><i class="fa-brands fa-instagram"></i></a>
         <?php endif; ?>
         <?php if(!empty($linkedin_url)) : ?>
         <a target="_blank" href="<?php echo esc_url($linkedin_url); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
         <?php endif; ?>
         <?php if(!empty($twitter_url)) : ?>
         <a target="_blank" href="<?php echo esc_url($twitter_url); ?>"><i class="fa-brands fa-twitter"></i></a>
         <?php endif; ?>
      </div>
   </div>
</div>


<?php endif;?>
