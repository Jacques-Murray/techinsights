<?php
/**
 * The main template file / homepage.
 *
 * @package TechInsights
 */

get_header();

$sticky_posts = get_option('sticky_posts');
$hero_query_args = array(
    'posts_per_page' => 1,
    'post__in'       => $sticky_posts,
    'ignore_sticky_posts' => 1
);
$hero_query = new WP_Query($hero_query_args);
?>

<?php if (!empty($sticky_posts) && $hero_query->have_posts()) : while ($hero_query->have_posts()) : $hero_query->the_post(); ?>
    <section class="hero-section @container mb-10" aria-label="Featured Article">
        <div class="@[480px]:p-4">
            <?php
            $hero_bg_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.co/1200x600/111418/9cabba?text=Add+Featured+Image';
            ?>
            <div class="hero-section relative overflow-hidden @[480px]:rounded-xl"
                 style='background-image: url("<?php echo esc_url($hero_bg_image); ?>");'>
                <div class="hero-overlay bg-white/80 backdrop-blur-sm"></div>
                <div class="hero-content">
                    <div class="flex flex-col gap-4 text-left max-w-3xl">
                        <div class="flex items-center gap-2 text-[#0c7ff2] text-sm font-medium mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M237.66,117.66l-80,80A8,8,0,0,1,146.34,186.34L201.17,131.57A24,24,0,0,0,184,104H80a8,8,0,0,1,0-16H184a40,40,0,0,1,28.28,68.28L157.66,210.34a8,8,0,1,1-11.32-11.32Z"></path>
                            </svg>
                            <span>Featured Article</span>
                        </div>
                        <h1 class="text-gray-900 text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em]">
                           <a href="<?php the_permalink(); ?>" class="hover:text-[#0c7ff2] transition-colors"><?php the_title(); ?></a>
                        </h1>
                        <div class="text-gray-700 text-base md:text-lg leading-relaxed">
                            <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                        </div>
                        <div class="flex items-center gap-4 text-gray-600 text-sm">
                            <span>By <?php the_author(); ?></span>
                            <span>&bull;</span>
                            <span><?php echo get_the_date(); ?></span>
                            <span>&bull;</span>
                            <span><?php echo esc_html(get_comments_number()); ?> comments</span>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-6">
                        <a href="<?php the_permalink(); ?>" class="btn-primary">
                            Read Full Article
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256" class="ml-2">
                                <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
                            </svg>
                        </a>
                        <button class="btn-secondary share-button" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M237.66,106.35l-80-80A8,8,0,0,0,144,32V72.35c-25.94,2.22-54.59,14.92-78.16,34.91-28.38,24.08-46.05,55.11-49.76,87.37a12,12,0,0,0,20.68,9.58c11-11.71,50.14-48.74,107.24-52V192a8,8,0,0,0,13.66,5.65l80-80A8,8,0,0,0,237.66,106.35ZM160,172.69V144a8,8,0,0,0-8-8c-28.08,0-55.43,7.33-81.29,21.8a196.17,196.17,0,0,0-36.57,26.52c5.8-23.84,20.42-46.51,42.05-64.86C99.41,99.77,127.75,88,152,88a8,8,0,0,0,8-8V51.32L220.69,112Z"></path>
                            </svg>
                            Share
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; wp_reset_postdata(); else: ?>
    <section class="hero-section @container mb-10">
        <div class="@[480px]:p-4">
            <div class="hero-section bg-gradient-to-br from-gray-50 to-gray-100 @[480px]:rounded-xl">
                <div class="hero-overlay bg-gradient-to-br from-[#0c7ff2]/10 to-transparent"></div>
                <div class="hero-content text-center">
                    <div class="max-w-2xl mx-auto">
                        <h1 class="text-gray-900 text-4xl md:text-5xl font-black leading-tight tracking-[-0.033em] mb-4">
                            <?php echo get_theme_mod('hero_title', 'Welcome to ' . get_bloginfo('name')); ?>
                        </h1>
                        <p class="text-gray-700 text-lg leading-relaxed mb-8">
                            <?php echo get_theme_mod('hero_subtitle', 'Discover the latest in technology and innovation with expert insights and analysis.'); ?>
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn-primary">
                                Learn More About Us
                            </a>
                            <a href="#latest-posts" class="btn-secondary">
                                Browse Articles
                            </a>
                        </div>
                        <p class="text-gray-500 text-sm mt-6">To feature a post here, make it "sticky" in the post editor.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- Featured Content Section -->
<?php
$featured_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'category_name'  => 'featured',
    'post__not_in'   => $sticky_posts
);
$featured_query = new WP_Query($featured_args);
if ($featured_query->have_posts()):
?>
<section class="mb-12" aria-labelledby="featured-heading">
    <div class="flex items-center justify-between mb-6 px-4">
        <h2 id="featured-heading" class="text-gray-900 text-2xl font-bold leading-tight tracking-[-0.015em]">Featured Content</h2>
        <a href="<?php echo esc_url(home_url('/category/featured')); ?>" class="text-[#0c7ff2] hover:text-[#60a5fa] text-sm font-medium transition-colors">
            View All →
        </a>
    </div>
    
    <div class="flex overflow-x-auto [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
        <div class="flex items-stretch p-4 gap-6">
            <?php while ($featured_query->have_posts()): $featured_query->the_post(); ?>
                <article class="card min-w-80 sm:min-w-96 flex-shrink-0">
                    <a href="<?php the_permalink(); ?>" class="block w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg mb-4 relative overflow-hidden group"
                       style='background-image: url("<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.co/400x225/1b2127/9cabba?text=Featured+Image'; ?>");'>
                        <!-- Overlay on hover -->
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="text-white text-sm font-medium bg-black/50 px-3 py-1 rounded-full">
                                Read Article
                            </div>
                        </div>
                        <!-- Featured badge -->
                        <div class="absolute top-3 left-3 bg-[#0c7ff2] text-white text-xs font-bold px-2 py-1 rounded-full">
                            Featured
                        </div>
                    </a>
                    <div class="space-y-3">
                        <div class="flex items-center gap-2 text-gray-500 text-xs">
                            <span><?php echo get_the_date(); ?></span>
                            <span>&bull;</span>
                            <span><?php the_category(', '); ?></span>
                        </div>
                        <h3 class="text-gray-900 text-lg font-semibold leading-tight">
                            <a href="<?php the_permalink(); ?>" class="hover:text-[#0c7ff2] transition-colors"><?php the_title(); ?></a>
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </p>
                        <div class="flex items-center justify-between pt-2">
                            <div class="flex items-center gap-2 text-gray-500 text-xs">
                                <span>By <?php the_author(); ?></span>
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
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Latest Posts Section -->
<section class="mb-12" aria-labelledby="latest-heading" id="latest-posts">
    <div class="flex items-center justify-between mb-6 px-4">
        <h2 id="latest-heading" class="text-gray-900 text-2xl font-bold leading-tight tracking-[-0.015em]">Latest Articles</h2>
        <a href="<?php echo esc_url(home_url('/blog')); ?>" class="text-[#0c7ff2] hover:text-[#60a5fa] text-sm font-medium transition-colors">
            View All →
        </a>
    </div>
    
    <div class="content-grid px-4">
        <?php
        $latest_posts_args = array(
            'post_type' => 'post',
            'posts_per_page' => 6,
            'post__not_in' => $sticky_posts
        );
        $latest_posts_query = new WP_Query($latest_posts_args);
        if ($latest_posts_query->have_posts()): while ($latest_posts_query->have_posts()): $latest_posts_query->the_post();
        ?>
        <article class="card group">
            <a href="<?php the_permalink(); ?>" class="block w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg mb-4 relative overflow-hidden"
               style='background-image: url("<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.co/400x225/1b2127/9cabba?text=Featured+Image'; ?>");'>
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
                    echo '<div class="absolute top-3 left-3 bg-white/90 text-gray-700 text-xs font-medium px-2 py-1 rounded-full backdrop-blur-sm">' . esc_html($category->name) . '</div>';
                }
                ?>
            </a>
            <div class="space-y-3">
                <div class="flex items-center gap-2 text-gray-500 text-xs">
                    <span><?php echo get_the_date(); ?></span>
                    <span>&bull;</span>
                    <span><?php echo esc_html(get_comments_number()); ?> comments</span>
                </div>
                <h3 class="text-gray-900 text-lg font-semibold leading-tight">
                    <a href="<?php the_permalink(); ?>" class="hover:text-[#0c7ff2] transition-colors"><?php the_title(); ?></a>
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-center bg-cover rounded-full bg-gray-200" style='background-image: url("<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'), 24)); ?>");'></div>
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
        <?php endwhile; wp_reset_postdata(); else: ?>
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 256 256" class="mx-auto mb-4">
                        <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
                    </svg>
                </div>
                <h3 class="text-gray-900 text-xl font-semibold mb-2">No Posts Found</h3>
                <p class="text-gray-600 mb-6">There are no published posts yet. Start creating content to see it here.</p>
                <?php if (current_user_can('publish_posts')): ?>
                    <a href="<?php echo admin_url('post-new.php'); ?>" class="btn-primary">
                        Create Your First Post
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Newsletter Section -->
<section class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl mx-4 p-8 md:p-12 text-center mb-12">
    <h2 class="text-gray-900 text-2xl md:text-3xl font-bold mb-4">Stay Updated with Tech Insights</h2>
    <p class="text-gray-700 text-lg mb-8 max-w-2xl mx-auto">
        Get the latest articles, tutorials, and tech news delivered straight to your inbox. No spam, just quality content.
    </p>
    <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto" action="#" method="post">
        <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#0c7ff2] focus:border-[#0c7ff2] focus:outline-none" required>
        <button type="submit" class="bg-[#0c7ff2] text-white hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold transition-colors">
            Subscribe
        </button>
    </form>
    <p class="text-gray-600 text-sm mt-4">Join 1,000+ developers already subscribed</p>
</section>


<?php get_footer(); ?>
