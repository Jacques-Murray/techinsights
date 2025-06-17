<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package TechInsights
 */

get_header(); ?>

<div class="max-w-4xl mx-auto text-center py-20 px-4">
    
    <!-- 404 Hero -->
    <div class="mb-12">
        <div class="text-[#0c7ff2] mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" viewBox="0 0 256 256" class="mx-auto">
                <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
            </svg>
        </div>
        
        <h1 class="text-8xl md:text-9xl font-black text-gradient mb-4">404</h1>
        <h2 class="text-white text-3xl md:text-4xl font-bold mb-4">Page Not Found</h2>
        <p class="text-[#9cabba] text-lg leading-relaxed max-w-2xl mx-auto mb-8">
            Oops! The page you're looking for seems to have vanished into the digital void.
            It might have been moved, deleted, or perhaps it never existed at all.
        </p>
    </div>

    <!-- Search Form -->
    <div class="mb-12">
        <h3 class="text-white text-xl font-semibold mb-4">Try searching for what you need:</h3>
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="search"
                   name="s"
                   placeholder="Search articles..."
                   class="flex-1 px-4 py-3 bg-[#283039] border border-[#3a434f] rounded-lg text-white placeholder-[#9cabba] focus:border-[#0c7ff2] focus:outline-none transition-colors"
                   aria-label="Search">
            <button type="submit" class="btn-primary px-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256" class="mr-2">
                    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                </svg>
                Search
            </button>
        </form>
    </div>

    <!-- Quick Links -->
    <div class="mb-12">
        <h3 class="text-white text-xl font-semibold mb-6">Or try these helpful links:</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-4xl mx-auto">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="card text-center hover:scale-105 transition-transform">
                <div class="text-[#0c7ff2] mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256" class="mx-auto">
                        <path d="M219.31,108.68l-80-80a16,16,0,0,0-22.62,0l-80,80A15.87,15.87,0,0,0,32,120v96a8,8,0,0,0,8,8h64a8,8,0,0,0,8-8V160h32v56a8,8,0,0,0,8,8h64a8,8,0,0,0,8-8V120A15.87,15.87,0,0,0,219.31,108.68ZM208,208H160V152a8,8,0,0,0-8-8H104a8,8,0,0,0-8,8v56H48V120l80-80,80,80Z"></path>
                    </svg>
                </div>
                <h4 class="text-white font-semibold">Homepage</h4>
                <p class="text-[#9cabba] text-sm">Start fresh from home</p>
            </a>
            
            <a href="<?php echo esc_url(home_url('/about')); ?>" class="card text-center hover:scale-105 transition-transform">
                <div class="text-[#0c7ff2] mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256" class="mx-auto">
                        <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm16-40a8,8,0,0,1-8,8,16,16,0,0,1-16-16V128a8,8,0,0,1,0-16,16,16,0,0,1,16,16v40A8,8,0,0,1,144,176ZM112,84a12,12,0,1,1,12,12A12,12,0,0,1,112,84Z"></path>
                    </svg>
                </div>
                <h4 class="text-white font-semibold">About Us</h4>
                <p class="text-[#9cabba] text-sm">Learn more about us</p>
            </a>
            
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="card text-center hover:scale-105 transition-transform">
                <div class="text-[#0c7ff2] mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256" class="mx-auto">
                        <path d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48ZM203.43,64,128,133.15,52.57,64ZM216,192H40V74.19l82.59,75.71a8,8,0,0,0,10.82,0L216,74.19V192Z"></path>
                    </svg>
                </div>
                <h4 class="text-white font-semibold">Contact</h4>
                <p class="text-[#9cabba] text-sm">Get in touch with us</p>
            </a>
            
            <button class="card text-center hover:scale-105 transition-transform" onclick="history.back()">
                <div class="text-[#0c7ff2] mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256" class="mx-auto">
                        <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
                    </svg>
                </div>
                <h4 class="text-white font-semibold">Go Back</h4>
                <p class="text-[#9cabba] text-sm">Return to previous page</p>
            </button>
        </div>
    </div>

    <!-- Popular Categories -->
    <?php
    $categories = get_categories(array(
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => 6,
        'hide_empty' => true
    ));
    
    if ($categories): ?>
        <div class="mb-12">
            <h3 class="text-white text-xl font-semibold mb-6">Browse Popular Categories:</h3>
            <div class="flex flex-wrap gap-3 justify-center max-w-2xl mx-auto">
                <?php foreach ($categories as $category): ?>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                       class="bg-[#283039] hover:bg-[#0c7ff2] text-[#9cabba] hover:text-white px-4 py-2 rounded-full text-sm font-medium transition-all hover:scale-105">
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
        <div class="mb-12">
            <h3 class="text-white text-xl font-semibold mb-6">Or check out our latest articles:</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <?php foreach ($recent_posts as $recent_post): setup_postdata($recent_post); ?>
                    <article class="card group text-left">
                        <a href="<?php the_permalink(); ?>" class="block w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg mb-4 relative overflow-hidden"
                           style='background-image: url("<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.co/400x225/1b2127/9cabba?text=Recent+Post'; ?>");'>
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="text-white text-sm font-medium bg-black/50 px-3 py-1 rounded-full">
                                    Read Article
                                </div>
                            </div>
                        </a>
                        <div class="space-y-2">
                            <h4 class="text-white font-semibold leading-tight">
                                <a href="<?php the_permalink(); ?>" class="hover:text-[#0c7ff2] transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <p class="text-[#9cabba] text-sm"><?php echo get_the_date(); ?></p>
                        </div>
                    </article>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Final CTA -->
    <div class="text-center">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary text-lg px-8 py-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256" class="mr-2">
                <path d="M219.31,108.68l-80-80a16,16,0,0,0-22.62,0l-80,80A15.87,15.87,0,0,0,32,120v96a8,8,0,0,0,8,8h64a8,8,0,0,0,8-8V160h32v56a8,8,0,0,0,8,8h64a8,8,0,0,0,8-8V120A15.87,15.87,0,0,0,219.31,108.68ZM208,208H160V152a8,8,0,0,0-8-8H104a8,8,0,0,0-8,8v56H48V120l80-80,80,80Z"></path>
            </svg>
            Take Me Home
        </a>
    </div>

</div>

<?php get_footer(); ?>
