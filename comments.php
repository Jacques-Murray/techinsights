<?php
/**
 * The template for displaying comments
 *
 * @package TechInsights
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    
    <?php if (have_comments()) : ?>
        
        <!-- Comments Header -->
        <div class="comments-header mb-8 pb-6 border-b border-[#283039]">
            <h3 class="text-white text-2xl font-bold mb-2">
                <?php
                $comments_number = get_comments_number();
                if ($comments_number == 1) {
                    echo '1 Comment';
                } else {
                    echo $comments_number . ' Comments';
                }
                ?>
            </h3>
            <p class="text-[#9cabba] text-sm">Join the discussion and share your thoughts</p>
        </div>

        <!-- Comments List -->
        <ol class="comment-list space-y-6 mb-8">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
                'callback'    => 'techinsights_comment_callback'
            ));
            ?>
        </ol>

        <!-- Comments Navigation -->
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="comment-navigation mb-8" role="navigation">
                <h4 class="sr-only">Comment navigation</h4>
                <div class="flex justify-between items-center">
                    <div class="nav-previous">
                        <?php previous_comments_link('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256" class="inline mr-2"><path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path></svg>Older Comments'); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_comments_link('Newer Comments<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256" class="inline ml-2"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>'); ?>
                    </div>
                </div>
            </nav>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <div class="no-comments bg-[#1b2127] border border-[#283039] rounded-lg p-6 text-center">
            <div class="text-[#9cabba] mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256" class="mx-auto">
                    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm24-120v48a8,8,0,0,1-16,0V96a8,8,0,0,1,16,0Zm-32,0v48a8,8,0,0,1-16,0V96a8,8,0,0,1,16,0Z"></path>
                </svg>
            </div>
            <p class="text-[#9cabba]">Comments are closed for this article.</p>
        </div>
    <?php endif; ?>

    <?php
    // Comment form
    if (comments_open()) :
        
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        
        $comment_form_args = array(
            'title_reply'         => '<h3 class="text-white text-xl font-bold mb-6">Leave a Reply</h3>',
            'title_reply_to'      => '<h3 class="text-white text-xl font-bold mb-6">Leave a Reply to %s</h3>',
            'cancel_reply_link'   => 'Cancel Reply',
            'label_submit'        => 'Post Comment',
            'submit_button'       => '<button type="submit" class="btn-primary" name="%1$s" id="%2$s">%4$s <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256" class="ml-2"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg></button>',
            'comment_field'       => '<div class="mb-6"><label for="comment" class="block text-white font-medium mb-2">Comment *</label><textarea id="comment" name="comment" rows="6" class="w-full px-4 py-3 bg-[#283039] border border-[#3a434f] rounded-lg text-white placeholder-[#9cabba] focus:border-[#0c7ff2] focus:outline-none transition-colors resize-vertical" placeholder="Share your thoughts..." required></textarea></div>',
            'must_log_in'         => '<div class="must-log-in bg-[#1b2127] border border-[#283039] rounded-lg p-6 text-center mb-6"><p class="text-[#9cabba] mb-4">You must be <a href="' . wp_login_url(apply_filters('the_permalink', get_permalink())) . '" class="text-[#0c7ff2] hover:text-[#60a5fa] transition-colors">logged in</a> to post a comment.</p></div>',
            'logged_in_as'        => '<div class="logged-in-as bg-[#1b2127] border border-[#283039] rounded-lg p-4 mb-6"><p class="text-[#9cabba] text-sm">Logged in as <a href="' . admin_url('profile.php') . '" class="text-[#0c7ff2] hover:text-[#60a5fa] transition-colors">' . $user_identity . '</a>. <a href="' . wp_logout_url(apply_filters('the_permalink', get_permalink())) . '" title="Log out of this account" class="text-[#0c7ff2] hover:text-[#60a5fa] transition-colors">Log out?</a></p></div>',
            'comment_notes_before' => '<div class="comment-notes bg-[#1b2127] border border-[#283039] rounded-lg p-4 mb-6"><p class="text-[#9cabba] text-sm">Your email address will not be published. Required fields are marked <span class="text-[#0c7ff2]">*</span></p></div>',
            'comment_notes_after'  => '',
            'class_form'          => 'comment-form bg-[#1b2127] border border-[#283039] rounded-lg p-6',
            'class_submit'        => 'btn-primary',
            'fields'              => array(
                'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6"><div><label for="author" class="block text-white font-medium mb-2">Name' . ($req ? ' *' : '') . '</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" class="w-full px-4 py-3 bg-[#283039] border border-[#3a434f] rounded-lg text-white placeholder-[#9cabba] focus:border-[#0c7ff2] focus:outline-none transition-colors" placeholder="Your name"' . $aria_req . ' /></div>',
                'email'  => '<div><label for="email" class="block text-white font-medium mb-2">Email' . ($req ? ' *' : '') . '</label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" class="w-full px-4 py-3 bg-[#283039] border border-[#3a434f] rounded-lg text-white placeholder-[#9cabba] focus:border-[#0c7ff2] focus:outline-none transition-colors" placeholder="your@email.com"' . $aria_req . ' /></div></div>',
                'url'    => '<div class="mb-6"><label for="url" class="block text-white font-medium mb-2">Website</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" class="w-full px-4 py-3 bg-[#283039] border border-[#3a434f] rounded-lg text-white placeholder-[#9cabba] focus:border-[#0c7ff2] focus:outline-none transition-colors" placeholder="https://yourwebsite.com" /></div>',
            ),
        );
        
        comment_form($comment_form_args);
        
    endif; ?>

</div>

<?php
// Custom comment callback function
if (!function_exists('techinsights_comment_callback')) {
    function techinsights_comment_callback($comment, $args, $depth) {
            // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class('comment-item bg-[#1b2127] border border-[#283039] rounded-lg p-6 mb-6'); ?> id="comment-<?php comment_ID(); ?>">
            
            <div class="comment-body">
                
                <!-- Comment Header -->
                <div class="comment-header flex items-start gap-4 mb-4">
                    <div class="comment-avatar flex-shrink-0">
                        <?php echo get_avatar($comment, 48, '', '', array('class' => 'rounded-full')); ?>
                    </div>
                    
                    <div class="comment-meta flex-1">
                        <div class="flex items-center gap-3 mb-1">
                            <h4 class="comment-author text-white font-semibold">
                                <?php 
                                $author_url = get_comment_author_url();
                                if (!empty($author_url)) {
                                    echo '<a href="' . esc_url($author_url) . '" class="hover:text-[#0c7ff2] transition-colors" target="_blank" rel="noopener noreferrer">' . get_comment_author() . '</a>';
                                } else {
                                    echo get_comment_author();
                                }
                                ?>
                            </h4>
                            
                            <?php if (get_comment_author_email() === get_the_author_meta('user_email')) : ?>
                                <span class="author-badge bg-[#0c7ff2] text-white text-xs font-bold px-2 py-1 rounded-full">Author</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="comment-metadata text-[#9cabba] text-sm">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php echo get_comment_date() . ' at ' . get_comment_time(); ?>
                            </time>
                            
                            <?php if ($comment->comment_approved == '0') : ?>
                                <span class="comment-awaiting-moderation text-yellow-400 ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 256 256" class="inline mr-1">
                                        <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm16-40a8,8,0,0,1-8,8,16,16,0,0,1-16-16V128a8,8,0,0,1,0-16,16,16,0,0,1,16,16v40A8,8,0,0,1,144,176ZM112,84a12,12,0,1,1,12,12A12,12,0,0,1,112,84Z"></path>
                                    </svg>
                                    Awaiting moderation
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Comment Content -->
                <div class="comment-content prose-custom prose-sm mb-4">
                    <?php comment_text(); ?>
                </div>

                <!-- Comment Actions -->
                <div class="comment-actions flex items-center gap-4">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<div class="reply-link">',
                        'after'     => '</div>',
                        'reply_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 256 256" class="inline mr-1"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>Reply'
                    )));
                    ?>
                    
                    <?php edit_comment_link(
                        '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 256 256" class="inline mr-1"><path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path></svg>Edit',
                        '<div class="edit-link">',
                        '</div>'
                    ); ?>
                </div>
            </div>
        <?php
        // Note: </li> is automatically added by WordPress
    }
}
?>

<style>
/* Comment styling */
.comment-list {
    list-style: none;
    padding-left: 0;
}

.comment-list .children {
    list-style: none;
    margin-left: 2rem;
    margin-top: 1.5rem;
}

.comment-reply-link,
.comment-edit-link {
    color: var(--color-text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.comment-reply-link:hover,
.comment-edit-link:hover {
    color: var(--color-primary);
}

.comment-form {
    margin-top: 2rem;
}

.form-submit {
    margin-bottom: 0;
}

.comment-navigation a {
    color: var(--color-text-secondary);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.comment-navigation a:hover {
    color: var(--color-primary);
}

/* Comment form responsive */
@media (max-width: 768px) {
    .comment-list .children {
        margin-left: 1rem;
    }
    
    .comment-header {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .comment-avatar {
        align-self: flex-start;
    }
}
</style>