<?php
// Check if comments are allowed
if (comments_open()) :
    ?>
    <div id="comments" class="comments-area">
        <?php
        // Display the comments list
        if (have_comments()) :
            ?>
            <h2 class="postbox__comment-title">
                <?php
                $comment_count = get_comments_number();
                echo esc_html($comment_count) . ' ' . _n('Comment', 'Comments', $comment_count, 'biddut');
                ?>
            </h2>

            <ul class="postbox__comment mb-95">
                <?php
                wp_list_comments(array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'callback' => 'custom_comment_list'
                ));
                ?>
            </ul>

            <?php
            // Display comment pagination if needed
            the_comments_pagination(array(
                'prev_text' => esc_html__('Previous', 'biddut'),
                'next_text' => esc_html__('Next', 'biddut'),
            ));
        endif;
        
        if ( is_user_logged_in() ) {
            $cl = 'loginformuser';
        } else {
            $cl = '';
        }

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');

        $fields = array(
            'author' => '<div class="row"><div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6"><div  class="tp-contact-form-input-box"><input type="text" name="author" id="author" placeholder="' . esc_attr__('Name*', 'biddut') . '" value="' . esc_attr($commenter['comment_author']) . '" ' . ($req ? 'required' : '') . '></div>
         </div>',
            'email' => '<div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
            <div class="tp-contact-form-input-box">
               <input type="email" name="email" id="email" placeholder="' . esc_attr__('Email', 'biddut') . '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($req ? 'required' : '') . '>
            </div>
         </div>',
            'url' => '<div class="col-xxl-4 col-xl-4 col-lg-12">
            <div class="tp-contact-form-input-box">
               <input type="text" name="url" id="url" placeholder="' . esc_attr__('Website', 'biddut') . '" value="' . esc_attr($commenter['comment_author_url']) . '">
            </div>
         </div></div>',
        );


        $defaults = [
            'fields'             => $fields,
            'comment_field' => '<div class="col-xxl-12 ' . $cl . '">
                    <div class="tp-contact-form-input-box">
                       <textarea id="comment" name="comment" placeholder="' . esc_attr__('Your Comment Here...', 'biddut') . '" required></textarea>
                    </div>
                </div>
            ',
            'submit_button' => '<div class="col-xxl-12">
                                    <div class="postbox__comment-btn">
                                       <button type="submit" class="tp-btn"><span>' . esc_html__('Submit Comment', 'biddut') . '</span></button>
                                    </div>
                                </div>',

            'cookies' => '<div class="col-xxl-12">
                <div class="postbox__comment-agree d-flex align-items-start mb-25">' .
                '<input class="e-check-input" type="checkbox" id="e-agree" name="wp-comment-agree" value="1" checked>' .
                '<label class="e-check-label" for="e-agree">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'biddut') . '</label></div>
            </div>'
        ];
        // Display the comment form
        comment_form($defaults);
        ?>
    </div><!-- .comments-area -->
<?php endif; ?>


<?php

// custom_comment_list
function custom_comment_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
        // Display pingbacks and trackbacks differently if needed
        ?>
        <li class="pingback">
            <p><?php esc_html_e('Pingback:', 'biddut'); ?> <?php comment_author_link(); ?></p>
        </li>
        <?php
    } else {
        // Display regular comments
        ?>
        <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">
                <div class="postbox__comment-box d-sm-flex align-items-start">
                    <div class="postbox__comment-info">
                        <div class="postbox__comment-avater">
                            <?php echo get_avatar($comment, 80); ?>
                        </div>
                    </div>
                    <div class="postbox__comment-text ">
                        <div class="postbox__comment-name">
                            <span class="post-meta"> <?php comment_date(); ?></span>
                            <h5><?php comment_author(); ?></h5>
                        </div>
                        <?php if ($comment->comment_approved == '0') : ?>
                            <p><?php esc_html_e('Your comment is awaiting moderation.', 'biddut'); ?></p>
                        <?php endif; ?>
                        <?php comment_text(); ?>
                        <div class="postbox__comment-reply">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </div>
                    </div>
                </div>
        <?php
    }
}
