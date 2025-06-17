<?php
/**
 * The template for displaying all pages
 *
 * @package TechInsights
 */

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="page-<?php the_ID(); ?>" <?php post_class('max-w-4xl mx-auto'); ?>>
        
        <!-- Page Header -->
        <header class="text-center py-12 px-4">
            <!-- Breadcrumbs -->
            <nav class="mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center justify-center gap-2 text-gray-500 text-sm">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-blue-600 transition-colors">Home</a></li>
                    <li><span>&gt;</span></li>
                    <li class="text-gray-900" aria-current="page"><?php the_title(); ?></li>
                </ol>
            </nav>
            
            <h1 class="text-gray-900 text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-4">
                <?php the_title(); ?>
            </h1>
            
            <?php if (has_excerpt()): ?>
                <p class="text-gray-600 text-lg leading-relaxed max-w-2xl mx-auto">
                    <?php the_excerpt(); ?>
                </p>
            <?php endif; ?>
        </header>

        <!-- Page Content -->
        <div class="prose-custom prose-lg max-w-none mb-12 px-4">
            <?php
            // Check if the page has a featured image
            if (has_post_thumbnail()): ?>
                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl mb-8"
                     style='background-image: url("<?php echo get_the_post_thumbnail_url(); ?>");'>
                </div>
            <?php endif; ?>
            
            <?php the_content(); ?>
            
            <?php
            // If the page has child pages, display them
            $child_pages = get_pages(array(
                'parent' => get_the_ID(),
                'sort_column' => 'menu_order'
            ));
            
            if ($child_pages): ?>
                <div class="mt-12 p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
                    <h2 class="text-gray-900 text-xl font-bold mb-4">Related Pages</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php foreach ($child_pages as $child_page): ?>
                            <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors">
                                <h3 class="text-gray-900 font-semibold mb-2">
                                    <a href="<?php echo get_permalink($child_page->ID); ?>" class="hover:text-blue-600 transition-colors">
                                        <?php echo get_the_title($child_page->ID); ?>
                                    </a>
                                </h3>
                                <?php if ($child_page->post_excerpt): ?>
                                    <p class="text-gray-600 text-sm"><?php echo esc_html($child_page->post_excerpt); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Page Navigation -->
            <?php
            wp_link_pages(array(
                'before' => '<nav class="page-navigation mt-8"><p class="text-gray-900 font-semibold mb-4">Pages:</p><div class="flex flex-wrap gap-2">',
                'after'  => '</div></nav>',
                'link_before' => '<span class="bg-gray-100 hover:bg-blue-600 text-gray-700 hover:text-white px-3 py-2 rounded transition-colors">',
                'link_after'  => '</span>',
                'pagelink' => '%',
                'separator' => ' ',
            ));
            ?>
        </div>
        
        <!-- Page Meta Information -->
        <?php if (is_user_logged_in() && current_user_can('edit_pages')): ?>
            <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200 shadow-sm mb-8">
                <div class="text-gray-600 text-sm">
                    <span>Last updated: <?php echo get_the_modified_date(); ?></span>
                </div>
                <a href="<?php echo get_edit_post_link(); ?>" class="text-blue-600 hover:text-blue-800 text-sm transition-colors">
                    Edit Page
                </a>
            </div>
        <?php endif; ?>
        
        <!-- Contact Form for Contact Page -->
        <?php if (is_page('contact')): ?>
            <div class="card mb-8">
                <h2 class="text-gray-900 text-2xl font-bold mb-6">Get In Touch</h2>
                <form class="space-y-6" action="#" method="post">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="contact-name" class="block text-gray-900 font-medium mb-2">Name *</label>
                            <input type="text" id="contact-name" name="contact-name" required
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:border-blue-600 focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label for="contact-email" class="block text-gray-900 font-medium mb-2">Email *</label>
                            <input type="email" id="contact-email" name="contact-email" required
                                   class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:border-blue-600 focus:outline-none transition-colors">
                        </div>
                    </div>
                    <div>
                        <label for="contact-subject" class="block text-gray-900 font-medium mb-2">Subject</label>
                        <input type="text" id="contact-subject" name="contact-subject"
                               class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:border-blue-600 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label for="contact-message" class="block text-gray-900 font-medium mb-2">Message *</label>
                        <textarea id="contact-message" name="contact-message" rows="5" required
                                  class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:border-blue-600 focus:outline-none transition-colors resize-vertical"></textarea>
                    </div>
                    <button type="submit" class="btn-primary">
                        Send Message
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256" class="ml-2">
                            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        <?php endif; ?>

        <!-- Comments (if enabled for pages) -->
        <?php if (comments_open() || get_comments_number()) : ?>
            <div class="card">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>

    </article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
