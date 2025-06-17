<?php
/**
 * The template for displaying archive pages
 *
 * @package TechInsights
 */

get_header(); ?>

<div class="max-w-6xl mx-auto">
    
    <!-- Archive Header -->
    <header class="archive-header text-center py-12 px-4 mb-12">
        <div class="max-w-3xl mx-auto">
            <?php if (is_category()): ?>
                <div class="flex items-center justify-center gap-2 text-[#0c7ff2] text-sm font-medium mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M216,64H168a8,8,0,0,1-8-8V40a16,16,0,0,0-16-16H112A16,16,0,0,0,96,40V56a8,8,0,0,1-8,8H40A16,16,0,0,0,24,80V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V80A16,16,0,0,0,216,64ZM112,40h32V56H112Zm104,160H40V80H88a8,8,0,0,0,8-8V64h56v8a8,8,0,0,0,8,8h56Z"></path>
                    </svg>
                    <span>Category</span>
                </div>
                <h1 class="text-gray-900 text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-4">
                    <?php single_cat_title(); ?>
                </h1>
                <?php if (category_description()): ?>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        <?php echo category_description(); ?>
                    </p>
                <?php endif; ?>
            <?php elseif (is_tag()): ?>
                <div class="flex items-center justify-center gap-2 text-[#0c7ff2] text-sm font-medium mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M243.31,136,144,36.69A15.86,15.86,0,0,0,132.69,32H40a8,8,0,0,0-8,8v92.69A15.86,15.86,0,0,0,36.69,144L136,243.31a16,16,0,0,0,22.63,0l84.68-84.68a16,16,0,0,0,0-22.63Zm-96,96L48,132.69V48h84.69L232,147.31ZM96,84A12,12,0,1,1,84,72,12,12,0,0,1,96,84Z"></path>
                    </svg>
                    <span>Tag</span>
                </div>
                <h1 class="text-gray-900 text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-4">
                    #<?php single_tag_title(); ?>
                </h1>
                <?php if (tag_description()): ?>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        <?php echo tag_description(); ?>
                    </p>
                <?php endif; ?>
            <?php elseif (is_author()): ?>
                <div class="flex items-center justify-center gap-2 text-[#0c7ff2] text-sm font-medium mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path>
                    </svg>
                    <span>Author</span>
                </div>
                <div class="flex items-center justify-center gap-4 mb-6">
                    <div class="w-16 h-16 bg-center bg-cover rounded-full bg-gray-200"
                         style='background-image: url("<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'), 64)); ?>");'></div>
                    <div>
                        <h1 class="text-gray-900 text-2xl md:text-3xl font-black leading-tight tracking-[-0.033em]">
                            <?php the_author(); ?>
                        </h1>
                        <p class="text-gray-600 text-sm"><?php echo count_user_posts(get_the_author_meta('ID')); ?> articles published</p>
                    </div>
                </div>
                <?php if (get_the_author_meta('description')): ?>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        <?php the_author_meta('description'); ?>
                    </p>
                <?php endif; ?>
            <?php elseif (is_date()): ?>
                <div class="flex items-center justify-center gap-2 text-[#0c7ff2] text-sm font-medium mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Z"></path>
                    </svg>
                    <span>Archive</span>
                </div>
                <h1 class="text-gray-900 text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-4">
                    <?php
                    if (is_year()) {
                        echo 'Articles from ' . get_query_var('year');
                    } elseif (is_month()) {
                        echo 'Articles from ' . get_query_var('monthnum') . '/' . get_query_var('year');
                    } elseif (is_day()) {
                        echo 'Articles from ' . get_query_var('day') . '/' . get_query_var('monthnum') . '/' . get_query_var('year');
                    }
                    ?>
                </h1>
            <?php else: ?>
                <h1 class="text-gray-900 text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-4">
                    <?php the_archive_title(); ?>
                </h1>
                <?php if (the_archive_description()): ?>
                    <div class="text-gray-600 text-lg leading-relaxed">
                        <?php the_archive_description(); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <!-- Post count -->
            <div class="mt-6 text-gray-500 text-sm">
                <?php
                global $wp_query;
                $total_posts = $wp_query->found_posts;
                if ($total_posts == 1) {
                    echo '1 article found';
                } else {
                    echo $total_posts . ' articles found';
                }
                ?>
            </div>
        </div>
    </header>

    <!-- Archive Content -->
    <div class="content-grid px-4">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="card group">
                <a href="<?php the_permalink(); ?>" class="block w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg mb-4 relative overflow-hidden"
                   style='background-image: url("<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.co/400x225/f1f5f9/64748b?text=Featured+Image'; ?>");'>
                    <!-- Hover overlay -->
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <div class="text-white text-sm font-medium bg-black/50 px-3 py-1 rounded-full">
                            Read Article
                        </div>
                    </div>
                    <!-- Category badge -->
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        $category = $categories[0];
                        echo '<div class="absolute top-3 left-3 bg-gray-900 text-white text-xs font-medium px-2 py-1 rounded-full">' . esc_html($category->name) . '</div>';
                    }
                    ?>
                </a>
                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-gray-500 text-xs">
                        <span><?php echo get_the_date(); ?></span>
                        <span>&bull;</span>
                        <span><?php echo esc_html(get_comments_number()); ?> comments</span>
                    </div>
                    <h2 class="text-gray-900 text-lg font-semibold leading-tight">
                        <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors"><?php the_title(); ?></a>
                    </h2>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                    </p>
                    <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-center bg-cover rounded-full bg-gray-200"
                                 style='background-image: url("<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'), 24)); ?>");'></div>
                            <span class="text-gray-500 text-xs">By <?php the_author(); ?></span>
                        </div>
                        <div class="flex items-center gap-1 text-gray-500 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                            </svg>
                            <span><?php echo esc_html(get_post_meta(get_the_ID(), 'reading_time', true) ?: '5 min read'); ?></span>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile; else: ?>
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 256 256" class="mx-auto mb-4">
                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                    </svg>
                </div>
                <h3 class="text-gray-900 text-xl font-semibold mb-2">No Articles Found</h3>
                <p class="text-gray-600 mb-6">We couldn't find any articles matching your criteria.</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                    Browse All Articles
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (have_posts()): ?>
        <nav class="pagination-nav mt-12 px-4" aria-label="Archive navigation">
            <div class="flex justify-center">
                <?php
                echo paginate_links(array(
                    'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256"><path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path></svg> Previous',
                    'next_text' => 'Next <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>',
                    'before_page_number' => '<span class="sr-only">Page </span>',
                    'mid_size' => 2,
                    'class' => 'pagination-links'
                ));
                ?>
            </div>
        </nav>
    <?php endif; ?>

</div>

<?php get_footer(); ?>