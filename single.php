<?php
/**
 * The template for displaying all single posts
 *
 * @package TechInsights
 */

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-4xl mx-auto'); ?>>
        
        <!-- Article Header -->
        <header class="mb-8">
            <?php
            $post_hero_bg = has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.co/1200x400/111418/9cabba?text=Tech+Insights';
            ?>
            <div class="hero-section relative overflow-hidden rounded-xl mb-6"
                 style='background-image: url("<?php echo esc_url($post_hero_bg); ?>");'>
                <div class="hero-overlay"></div>
                <div class="hero-content text-center">
                    <div class="max-w-3xl mx-auto">
                        <!-- Breadcrumbs -->
                        <nav class="mb-4" aria-label="Breadcrumb">
                            <ol class="flex items-center justify-center gap-2 text-white/70 text-sm">
                                <li><a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors">Home</a></li>
                                <li><span>&gt;</span></li>
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $category = $categories[0];
                                    echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '" class="hover:text-white transition-colors">' . esc_html($category->name) . '</a></li>';
                                    echo '<li><span>&gt;</span></li>';
                                }
                                ?>
                                <li class="text-white" aria-current="page"><?php the_title(); ?></li>
                            </ol>
                        </nav>
                        
                        <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] mb-6">
                            <?php the_title(); ?>
                        </h1>
                        
                        <!-- Article Meta -->
                        <div class="flex flex-wrap items-center justify-center gap-4 text-white/80 text-sm mb-6">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-center bg-cover rounded-full bg-[#283039]"
                                     style='background-image: url("<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'), 32)); ?>");'></div>
                                <span>By <?php the_author_posts_link(); ?></span>
                            </div>
                            <span>&bull;</span>
                            <span><?php echo get_the_date(); ?></span>
                            <span>&bull;</span>
                            <span><?php echo esc_html(get_comments_number()); ?> comments</span>
                            <span>&bull;</span>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                </svg>
                                <span><?php echo esc_html(get_post_meta(get_the_ID(), 'reading_time', true) ?: '5 min read'); ?></span>
                            </div>
                        </div>
                        
                        <!-- Article excerpt/description -->
                        <?php if (has_excerpt()): ?>
                            <p class="text-white/90 text-lg leading-relaxed max-w-2xl mx-auto">
                                <?php the_excerpt(); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Article Actions -->
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                <div class="flex items-center gap-4">
                    <!-- Categories -->
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600 text-sm">Categories:</span>
                        <div class="flex gap-2">
                            <?php the_category(', '); ?>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-2">
                    <!-- Share Button -->
                    <button class="btn-secondary text-sm share-button" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M237.66,106.35l-80-80A8,8,0,0,0,144,32V72.35c-25.94,2.22-54.59,14.92-78.16,34.91-28.38,24.08-46.05,55.11-49.76,87.37a12,12,0,0,0,20.68,9.58c11-11.71,50.14-48.74,107.24-52V192a8,8,0,0,0,13.66,5.65l80-80A8,8,0,0,0,237.66,106.35ZM160,172.69V144a8,8,0,0,0-8-8c-28.08,0-55.43,7.33-81.29,21.8a196.17,196.17,0,0,0-36.57,26.52c5.8-23.84,20.42-46.51,42.05-64.86C99.41,99.77,127.75,88,152,88a8,8,0,0,0,8-8V51.32L220.69,112Z"></path>
                        </svg>
                        Share
                    </button>
                    
                    <!-- Bookmark Button -->
                    <button class="btn-secondary text-sm bookmark-button" data-post-id="<?php the_ID(); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M184,32H72A16,16,0,0,0,56,48V224a8,8,0,0,0,12.24,6.78L128,193.43l59.77,37.35A8,8,0,0,0,200,224V48A16,16,0,0,0,184,32Zm0,177.57-51.77-32.35a8,8,0,0,0-8.46,0L72,209.57V48H184Z"></path>
                        </svg>
                        Save
                    </button>
                </div>
            </div>
        </header>

        <!-- Article Content -->
        <div class="prose-custom prose-lg max-w-none mb-12">
            <?php the_content(); ?>
        </div>
        
        <!-- Tags -->
        <?php if (has_tag()): ?>
            <div class="flex flex-wrap items-center gap-4 p-4 bg-white rounded-lg border border-gray-200 shadow-sm mb-8">
                <span class="text-gray-600 text-sm font-medium">Tags:</span>
                <div class="flex flex-wrap gap-2">
                    <?php
                    $tags = get_the_tags();
                    if ($tags) {
                        foreach ($tags as $tag) {
                            echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="bg-gray-100 hover:bg-blue-600 text-gray-600 hover:text-white px-3 py-1 rounded-full text-sm transition-colors">#' . esc_html($tag->name) . '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Author Bio -->
        <div class="card mb-8">
            <div class="flex items-start gap-4">
                <div class="w-16 h-16 bg-center bg-cover rounded-full bg-gray-200 flex-shrink-0"
                     style='background-image: url("<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'), 64)); ?>");'></div>
                <div class="flex-1">
                    <h3 class="text-gray-900 text-lg font-semibold mb-2">About <?php the_author(); ?></h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-3">
                        <?php
                        $author_description = get_the_author_meta('description');
                        echo $author_description ? esc_html($author_description) : 'This author hasn\'t provided a bio yet.';
                        ?>
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                           class="text-blue-600 hover:text-blue-800 text-sm transition-colors">
                            View all posts by <?php the_author(); ?> →
                        </a>
                        <?php if (get_the_author_meta('user_url')): ?>
                            <a href="<?php echo esc_url(get_the_author_meta('user_url')); ?>"
                               class="text-blue-600 hover:text-blue-800 text-sm transition-colors"
                               target="_blank" rel="noopener noreferrer">
                                Website
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <?php if (comments_open() || get_comments_number()) : ?>
            <div class="card">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>

    </article>
    
    <!-- Related Posts -->
    <?php
    $related_posts = get_posts(array(
        'category__in' => wp_get_post_categories(get_the_ID()),
        'numberposts'  => 3,
        'post__not_in' => array(get_the_ID()),
        'orderby'      => 'rand'
    ));
    
    if ($related_posts): ?>
        <section class="mt-12" aria-labelledby="related-posts-heading">
            <h2 id="related-posts-heading" class="text-gray-900 text-2xl font-bold mb-6">Related Articles</h2>
            <div class="content-grid">
                <?php foreach ($related_posts as $related_post): setup_postdata($related_post); ?>
                    <article class="card group">
                        <a href="<?php the_permalink(); ?>" class="block w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg mb-4 relative overflow-hidden"
                           style='background-image: url("<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.co/400x225/f1f5f9/64748b?text=Related+Post'; ?>");'>
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="text-white text-sm font-medium bg-black/50 px-3 py-1 rounded-full">
                                    Read Article
                                </div>
                            </div>
                        </a>
                        <div class="space-y-3">
                            <div class="flex items-center gap-2 text-gray-500 text-xs">
                                <span><?php echo get_the_date(); ?></span>
                            </div>
                            <h3 class="text-gray-900 text-lg font-semibold leading-tight">
                                <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors"><?php the_title(); ?></a>
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </section>
    <?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
