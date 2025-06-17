<?php
/**
 * The sidebar containing the main widget area
 *
 * @package TechInsights
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar" role="complementary" aria-label="Blog Sidebar">
    <div class="sidebar-inner space-y-8">
        <?php dynamic_sidebar('sidebar-1'); ?>
        
        <!-- Default widgets if no widgets are active -->
        <?php if (!is_active_sidebar('sidebar-1')): ?>
            
            <!-- Search Widget -->
            <section class="widget search-widget">
                <h2 class="widget-title text-white text-xl font-bold mb-4">Search</h2>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
                    <div class="flex gap-2">
                        <input type="search" 
                               name="s" 
                               value="<?php echo esc_attr(get_search_query()); ?>" 
                               placeholder="Search articles..." 
                               class="flex-1 px-4 py-3 bg-[#283039] border border-[#3a434f] rounded-lg text-white placeholder-[#9cabba] focus:border-[#0c7ff2] focus:outline-none transition-colors text-sm"
                               aria-label="Search">
                        <button type="submit" class="btn-primary px-4 py-3 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </section>

            <!-- Recent Posts Widget -->
            <section class="widget recent-posts-widget">
                <h2 class="widget-title text-white text-xl font-bold mb-4">Recent Posts</h2>
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ));
                
                if ($recent_posts): ?>
                    <ul class="recent-posts-list space-y-4">
                        <?php foreach ($recent_posts as $recent_post): ?>
                            <li class="recent-post-item">
                                <article class="flex gap-3">
                                    <?php if (has_post_thumbnail($recent_post['ID'])): ?>
                                        <div class="post-thumbnail w-16 h-16 bg-center bg-cover rounded-lg flex-shrink-0"
                                             style='background-image: url("<?php echo get_the_post_thumbnail_url($recent_post['ID'], 'thumbnail'); ?>");'>
                                        </div>
                                    <?php else: ?>
                                        <div class="post-thumbnail w-16 h-16 bg-[#283039] rounded-lg flex-shrink-0 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256" class="text-[#9cabba]">
                                                <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-content flex-1 min-w-0">
                                        <h3 class="post-title text-white text-sm font-semibold leading-tight mb-1">
                                            <a href="<?php echo get_permalink($recent_post['ID']); ?>" class="hover:text-[#0c7ff2] transition-colors">
                                                <?php echo esc_html($recent_post['post_title']); ?>
                                            </a>
                                        </h3>
                                        <p class="post-date text-[#9cabba] text-xs">
                                            <?php echo get_the_date('', $recent_post['ID']); ?>
                                        </p>
                                    </div>
                                </article>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-[#9cabba] text-sm">No recent posts available.</p>
                <?php endif; ?>
            </section>

            <!-- Categories Widget -->
            <section class="widget categories-widget">
                <h2 class="widget-title text-white text-xl font-bold mb-4">Categories</h2>
                <?php
                $categories = get_categories(array(
                    'orderby' => 'count',
                    'order' => 'DESC',
                    'number' => 8,
                    'hide_empty' => true
                ));
                
                if ($categories): ?>
                    <ul class="categories-list space-y-2">
                        <?php foreach ($categories as $category): ?>
                            <li class="category-item">
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                   class="flex items-center justify-between text-[#9cabba] hover:text-[#0c7ff2] transition-colors py-2 px-3 rounded-lg hover:bg-[#283039]">
                                    <span class="category-name"><?php echo esc_html($category->name); ?></span>
                                    <span class="category-count text-xs bg-[#283039] px-2 py-1 rounded-full">
                                        <?php echo $category->count; ?>
                                    </span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-[#9cabba] text-sm">No categories available.</p>
                <?php endif; ?>
            </section>

            <!-- Tags Widget -->
            <section class="widget tags-widget">
                <h2 class="widget-title text-white text-xl font-bold mb-4">Popular Tags</h2>
                <?php
                $tags = get_tags(array(
                    'orderby' => 'count',
                    'order' => 'DESC',
                    'number' => 15,
                    'hide_empty' => true
                ));
                
                if ($tags): ?>
                    <div class="tags-cloud flex flex-wrap gap-2">
                        <?php foreach ($tags as $tag): ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                               class="tag-link bg-[#283039] hover:bg-[#0c7ff2] text-[#9cabba] hover:text-white px-3 py-1 rounded-full text-sm transition-colors">
                                #<?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-[#9cabba] text-sm">No tags available.</p>
                <?php endif; ?>
            </section>

            <!-- Newsletter Widget -->
            <section class="widget newsletter-widget">
                <div class="bg-gradient-to-br from-[#0c7ff2] to-[#60a5fa] rounded-lg p-6 text-center">
                    <div class="text-white mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256" class="mx-auto">
                            <path d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48ZM203.43,64,128,133.15,52.57,64ZM216,192H40V74.19l82.59,75.71a8,8,0,0,0,10.82,0L216,74.19V192Z"></path>
                        </svg>
                    </div>
                    <h3 class="text-white text-lg font-bold mb-2">Stay Updated</h3>
                    <p class="text-white/90 text-sm mb-4">Get the latest tech insights delivered to your inbox.</p>
                    <form class="newsletter-form" action="#" method="post">
                        <div class="flex flex-col gap-3">
                            <input type="email" 
                                   placeholder="Your email" 
                                   required
                                   class="px-3 py-2 bg-white/20 border border-white/30 rounded text-white placeholder-white/70 focus:bg-white/30 focus:outline-none transition-colors text-sm">
                            <button type="submit" class="bg-white text-[#0c7ff2] hover:bg-gray-100 px-4 py-2 rounded font-semibold text-sm transition-colors">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Archives Widget -->
            <section class="widget archives-widget">
                <h2 class="widget-title text-white text-xl font-bold mb-4">Archives</h2>
                <ul class="archives-list space-y-2">
                    <?php wp_get_archives(array(
                        'type' => 'monthly',
                        'limit' => 6,
                        'format' => 'custom',
                        'before' => '<li class="archive-item"><a href="',
                        'after' => '</a></li>',
                        'show_post_count' => true,
                        'echo' => true
                    )); ?>
                </ul>
            </section>

        <?php endif; ?>
    </div>
</aside>

<style>
/* Sidebar specific styles */
.sidebar {
    background-color: transparent;
}

.widget {
    background-color: var(--color-bg-secondary);
    border: 1px solid var(--color-border);
    border-radius: 0.75rem;
    padding: 1.5rem;
}

.widget-title {
    margin-bottom: 1rem;
    color: var(--color-text-primary);
    font-size: 1.25rem;
    font-weight: 700;
}

.archives-list a {
    display: flex;
    align-items: center;
    justify-content: between;
    color: var(--color-text-secondary);
    text-decoration: none;
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    font-size: 0.875rem;
}

.archives-list a:hover {
    color: var(--color-primary);
    background-color: var(--color-bg-tertiary);
}

.newsletter-form input:focus {
    background-color: rgba(255, 255, 255, 0.3);
}

/* Responsive sidebar */
@media (max-width: 1024px) {
    .sidebar {
        margin-top: 2rem;
    }
    
    .sidebar-inner {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }
}

@media (max-width: 640px) {
    .sidebar-inner {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .widget {
        padding: 1rem;
    }
    
    .recent-post-item .post-thumbnail {
        width: 3rem;
        height: 3rem;
    }
}
</style>