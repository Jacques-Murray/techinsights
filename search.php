<?php
/**
 * The template for displaying search results
 *
 * @package TechInsights
 */

get_header(); ?>

<div class="max-w-6xl mx-auto">
    
    <!-- Search Header -->
    <header class="search-header text-center py-12 px-4 mb-12">
        <div class="max-w-3xl mx-auto">
            <div class="flex items-center justify-center gap-2 text-[#0c7ff2] text-sm font-medium mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                </svg>
                <span>Search Results</span>
            </div>
            
            <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-4">
                <?php
                global $wp_query;
                $search_query = get_search_query();
                $total_results = $wp_query->found_posts;
                
                if ($total_results > 0) {
                    echo 'Found ' . $total_results . ' result' . ($total_results !== 1 ? 's' : '');
                } else {
                    echo 'No results found';
                }
                ?>
            </h1>
            
            <?php if (!empty($search_query)): ?>
                <p class="text-[#9cabba] text-lg leading-relaxed mb-8">
                    <?php if ($total_results > 0): ?>
                        Results for "<span class="text-white font-semibold"><?php echo esc_html($search_query); ?></span>"
                    <?php else: ?>
                        We couldn't find anything for "<span class="text-white font-semibold"><?php echo esc_html($search_query); ?></span>"
                    <?php endif; ?>
                </p>
            <?php endif; ?>
            
            <!-- Search Form -->
            <div class="max-w-md mx-auto">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex gap-2">
                    <input type="search" 
                           name="s" 
                           value="<?php echo esc_attr($search_query); ?>" 
                           placeholder="Search articles..." 
                           class="flex-1 px-4 py-3 bg-[#283039] border border-[#3a434f] rounded-lg text-white placeholder-[#9cabba] focus:border-[#0c7ff2] focus:outline-none transition-colors"
                           aria-label="Search">
                    <button type="submit" class="btn-primary px-6">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </header>

    <?php if (have_posts()) : ?>
        <!-- Search Results -->
        <div class="space-y-6 px-4 mb-12">
            <?php while (have_posts()) : the_post(); ?>
                <article class="card">
                    <div class="flex flex-col lg:flex-row gap-6">
                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="lg:w-1/3 flex-shrink-0">
                                <a href="<?php the_permalink(); ?>" class="block w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg relative overflow-hidden group"
                                   style='background-image: url("<?php echo get_the_post_thumbnail_url(); ?>");'>
                                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <div class="text-white text-sm font-medium bg-black/50 px-3 py-1 rounded-full">
                                            Read Article
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Content -->
                        <div class="flex-1 space-y-3">
                            <!-- Meta -->
                            <div class="flex items-center gap-2 text-[#9cabba] text-sm">
                                <span><?php echo get_the_date(); ?></span>
                                <span>&bull;</span>
                                <span><?php the_category(', '); ?></span>
                                <span>&bull;</span>
                                <span>By <?php the_author(); ?></span>
                            </div>
                            
                            <!-- Title -->
                            <h2 class="text-white text-xl font-bold leading-tight">
                                <a href="<?php the_permalink(); ?>" class="hover:text-[#0c7ff2] transition-colors">
                                    <?php 
                                    // Highlight search terms in title
                                    $title = get_the_title();
                                    if (!empty($search_query)) {
                                        $highlighted_title = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<mark class="bg-[#0c7ff2] text-white px-1 rounded">$1</mark>', $title);
                                        echo $highlighted_title;
                                    } else {
                                        echo $title;
                                    }
                                    ?>
                                </a>
                            </h2>
                            
                            <!-- Excerpt -->
                            <p class="text-[#9cabba] leading-relaxed">
                                <?php 
                                $excerpt = get_the_excerpt();
                                if (!empty($search_query)) {
                                    $highlighted_excerpt = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<mark class="bg-[#0c7ff2] text-white px-1 rounded">$1</mark>', $excerpt);
                                    echo $highlighted_excerpt;
                                } else {
                                    echo $excerpt;
                                }
                                ?>
                            </p>
                            
                            <!-- Read More -->
                            <div class="flex items-center justify-between pt-3 border-t border-[#283039]">
                                <a href="<?php the_permalink(); ?>" class="text-[#0c7ff2] hover:text-[#60a5fa] text-sm font-medium transition-colors">
                                    Read Full Article →
                                </a>
                                <div class="flex items-center gap-1 text-[#9cabba] text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                    </svg>
                                    <span><?php echo esc_html(get_post_meta(get_the_ID(), 'reading_time', true) ?: '5 min read'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <nav class="pagination-nav mt-12 px-4" aria-label="Search results navigation">
            <div class="flex justify-center">
                <?php
                echo paginate_links(array(
                    'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256"><path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path></svg> Previous',
                    'next_text' => 'Next <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>',
                    'before_page_number' => '<span class="sr-only">Page </span>',
                    'mid_size' => 2,
                ));
                ?>
            </div>
        </nav>

    <?php else : ?>
        <!-- No Results -->
        <div class="text-center py-12 px-4">
            <div class="max-w-md mx-auto">
                <div class="text-[#9cabba] mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 256 256" class="mx-auto mb-4">
                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                    </svg>
                </div>
                
                <h2 class="text-white text-2xl font-bold mb-4">No Results Found</h2>
                <p class="text-[#9cabba] mb-8 leading-relaxed">
                    Sorry, we couldn't find any articles matching your search. Try different keywords or browse our categories below.
                </p>
                
                <!-- Search Suggestions -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-white font-semibold mb-3">Search Suggestions:</h3>
                        <ul class="text-[#9cabba] text-sm space-y-1">
                            <li>• Check your spelling</li>
                            <li>• Try more general keywords</li>
                            <li>• Use fewer keywords</li>
                            <li>• Browse categories below</li>
                        </ul>
                    </div>
                    
                    <!-- Popular Categories -->
                    <?php
                    $categories = get_categories(array(
                        'orderby' => 'count',
                        'order' => 'DESC',
                        'number' => 5,
                        'hide_empty' => true
                    ));
                    
                    if ($categories): ?>
                        <div>
                            <h3 class="text-white font-semibold mb-3">Popular Categories:</h3>
                            <div class="flex flex-wrap gap-2 justify-center">
                                <?php foreach ($categories as $category): ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                       class="bg-[#283039] hover:bg-[#0c7ff2] text-[#9cabba] hover:text-white px-3 py-2 rounded-lg text-sm transition-colors">
                                        <?php echo esc_html($category->name); ?> (<?php echo $category->count; ?>)
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Recent Posts -->
                    <?php
                    $recent_posts = get_posts(array(
                        'numberposts' => 3,
                        'post_status' => 'publish'
                    ));
                    
                    if ($recent_posts): ?>
                        <div>
                            <h3 class="text-white font-semibold mb-3">Recent Articles:</h3>
                            <div class="space-y-3">
                                <?php foreach ($recent_posts as $recent_post): setup_postdata($recent_post); ?>
                                    <div class="bg-[#283039] rounded-lg p-3 text-left">
                                        <h4 class="text-white font-medium text-sm mb-1">
                                            <a href="<?php the_permalink(); ?>" class="hover:text-[#0c7ff2] transition-colors">
                                                <?php the_title(); ?>
                                            </a>
                                        </h4>
                                        <p class="text-[#9cabba] text-xs"><?php echo get_the_date(); ?></p>
                                    </div>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                        Browse All Articles
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<style>
/* Search result highlighting */
mark {
    background-color: var(--color-primary);
    color: white;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-weight: 500;
}

/* Pagination styles */
.pagination-links {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.pagination-links a,
.pagination-links span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background-color: var(--color-bg-tertiary);
    color: var(--color-text-secondary);
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.pagination-links a:hover {
    background-color: var(--color-primary);
    color: white;
}

.pagination-links .current {
    background-color: var(--color-primary);
    color: white;
}

.pagination-links .dots {
    background-color: transparent;
    color: var(--color-text-secondary);
}
</style>

<?php get_footer(); ?>