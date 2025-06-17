<?php
/**
 * The template for displaying the footer
 *
 * @package TechInsights
 */
?>

            </div><!-- .layout-content-container -->
        </main><!-- main -->

        <footer class="flex justify-center mt-auto pt-10 bg-gray-50 border-t border-gray-200">
            <div class="flex max-w-[960px] w-full flex-1 flex-col">
                
                <!-- Footer Content -->
                <div class="flex flex-col lg:flex-row gap-8 px-5 py-10 @container">
                    
                    <!-- Brand Section -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="size-6">
                                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H6V17.3333V30.6667H24V44H42V30.6667V17.3333H24V4Z" fill="currentColor" class="text-[#0c7ff2]"></path>
                                </svg>
                            </div>
                            <h3 class="text-gray-900 text-xl font-bold"><?php bloginfo('name'); ?></h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 max-w-md">
                            <?php
                            $description = get_bloginfo('description');
                            echo $description ? esc_html($description) : 'Discover the latest in technology and innovation with expert insights and analysis.';
                            ?>
                        </p>
                        
                        <!-- Newsletter Signup -->
                        <div class="mb-6">
                            <h4 class="text-gray-900 font-semibold mb-3">Stay Updated</h4>
                            <form class="flex gap-2 max-w-sm" action="#" method="post">
                                <input type="email" placeholder="Your email" class="flex-1 px-3 py-2 bg-white border border-gray-300 rounded text-gray-900 text-sm placeholder-gray-500 focus:border-[#0c7ff2] focus:outline-none">
                                <button type="submit" class="btn-primary text-sm px-4 py-2">Subscribe</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="flex-1">
                        <h4 class="text-gray-900 font-semibold mb-4">Quick Links</h4>
                        <nav class="flex flex-col gap-3" role="navigation" aria-label="Footer Navigation">
                            <?php
                            if (has_nav_menu('footer-menu')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'footer-menu',
                                    'container'      => false,
                                    'items_wrap'     => '%3$s',
                                    'walker'         => new TechInsights_Nav_Walker(),
                                    'in_footer'      => true,
                                ));
                            } else {
                                // Default links if no menu is set
                                ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-gray-600 hover:text-[#0c7ff2] transition-colors">Home</a>
                                <a href="<?php echo esc_url(home_url('/about')); ?>" class="text-gray-600 hover:text-[#0c7ff2] transition-colors">About</a>
                                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="text-gray-600 hover:text-[#0c7ff2] transition-colors">Contact</a>
                                <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="text-gray-600 hover:text-[#0c7ff2] transition-colors">Privacy Policy</a>
                                <?php
                            }
                            ?>
                        </nav>
                    </div>
                    
                    <!-- Social Media & Contact -->
                    <div class="flex-1">
                        <h4 class="text-gray-900 font-semibold mb-4">Connect With Us</h4>
                        <div class="flex flex-wrap gap-3 mb-6 footer-social-links">
                            <?php
                            $social_links = array(
                                'twitter' => array(
                                    'url' => get_theme_mod('social_twitter', ''),
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256"><path d="M247.39,68.94A8,8,0,0,0,240,64H209.57A48.66,48.66,0,0,0,168.1,40a46.91,46.91,0,0,0-33.75,13.7A47.9,47.9,0,0,0,120,88v6.09C79.74,83.47,46.81,50.72,46.46,50.37a8,8,0,0,0-13.65,4.92c-4.31,47.79,9.57,79.77,22,98.18a110.93,110.93,0,0,0,21.88,24.2c-15.23,17.53-39.21,26.74-39.47,26.84a8,8,0,0,0-3.85,11.93c.75,1.12,3.75,5.05,11.08,8.72C53.51,229.7,65.48,232,80,232c70.67,0,129.72-54.42,135.75-124.44l29.91-29.9A8,8,0,0,0,247.39,68.94Zm-45,29.41a8,8,0,0,0-2.32,5.14C196,166.58,143.28,216,80,216c-10.56,0-18-1.4-23.22-3.08,11.51-6.25,27.56-17,37.88-32.48A8,8,0,0,0,92,169.08c-.47-.27-43.91-26.34-44-96,16,13,45.25,33.17,78.67,38.79A8,8,0,0,0,136,104V88a32,32,0,0,1,9.6-22.92A30.94,30.94,0,0,1,167.9,56c12.66.16,24.49,7.88,29.44,19.21A8,8,0,0,0,204.67,80h16Z"></path></svg>',
                                    'label' => 'Twitter'
                                ),
                                'linkedin' => array(
                                    'url' => get_theme_mod('social_linkedin', ''),
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256"><path d="M216,24H40A16,16,0,0,0,24,40V216a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V40A16,16,0,0,0,216,24Zm0,192H40V40H216V216ZM96,112v64a8,8,0,0,1-16,0V112a8,8,0,0,1,16,0Zm88,28v36a8,8,0,0,1-16,0V140a20,20,0,0,0-40,0v36a8,8,0,0,1-16,0V112a8,8,0,0,1,15.79-1.78A36,36,0,0,1,184,140ZM100,84A12,12,0,1,1,88,72,12,12,0,0,1,100,84Z"></path></svg>',
                                    'label' => 'LinkedIn'
                                ),
                                'github' => array(
                                    'url' => get_theme_mod('social_github', ''),
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256"><path d="M208.31,75.68A59.78,59.78,0,0,0,202.93,28,8,8,0,0,0,196,24a59.75,59.75,0,0,0-48,24H124A59.75,59.75,0,0,0,76,24a8,8,0,0,0-6.93,4,59.78,59.78,0,0,0-5.38,47.68A58.14,58.14,0,0,0,56,104v8a56.06,56.06,0,0,0,48.44,55.47A39.8,39.8,0,0,0,96,192v8H72a24,24,0,0,1-24-24A40,40,0,0,0,8,136a8,8,0,0,0,0,16,24,24,0,0,1,24,24,40,40,0,0,0,40,40H96v16a8,8,0,0,0,16,0V192a24,24,0,0,1,48,0v40a8,8,0,0,0,16,0V192a39.8,39.8,0,0,0-8.44-24.53A56.06,56.06,0,0,0,216,112v-8A58.14,58.14,0,0,0,208.31,75.68ZM200,112a40,40,0,0,1-40,40H112a40,40,0,0,1-40-40v-8a41.74,41.74,0,0,1,6.9-22.48A8,8,0,0,0,80,73.83a43.81,43.81,0,0,1,.79-33.58,43.88,43.88,0,0,1,32.32,20.06A8,8,0,0,0,119.82,64h32.35a8,8,0,0,0,6.74-3.69,43.87,43.87,0,0,1,32.32-20.06A43.81,43.81,0,0,1,192,73.83a8.09,8.09,0,0,0,1,7.65A41.72,41.72,0,0,1,200,104Z"></path></svg>',
                                    'label' => 'GitHub'
                                ),
                                'facebook' => array(
                                    'url' => get_theme_mod('social_facebook', ''),
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm8,191.63V152h24a8,8,0,0,0,0-16H136V112a16,16,0,0,1,16-16h16a8,8,0,0,0,0-16H152a32,32,0,0,0-32,32v24H96a8,8,0,0,0,0,16h24v63.63a88,88,0,1,1,16,0Z"></path></svg>',
                                    'label' => 'Facebook'
                                ),
                                'instagram' => array(
                                    'url' => get_theme_mod('social_instagram', ''),
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256"><path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z"></path></svg>',
                                    'label' => 'Instagram'
                                )
                            );
                            
                            foreach ($social_links as $platform => $data) {
                                if (!empty($data['url'])) {
                                    echo '<a href="' . esc_url($data['url']) . '" class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 hover:bg-[#0c7ff2] text-gray-600 hover:text-white rounded-lg transition-all duration-300" aria-label="' . esc_attr($data['label']) . '" target="_blank" rel="noopener noreferrer">';
                                    echo $data['icon'];
                                    echo '</a>';
                                }
                            }
                            
                            // If no social links are set, show default ones
                            if (empty(array_filter(array_map(function($link) { return get_theme_mod('social_' . $link, ''); }, array_keys($social_links))))) {
                                echo '<a href="#" class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 hover:bg-[#0c7ff2] text-gray-600 hover:text-white rounded-lg transition-all duration-300" aria-label="Twitter">' . $social_links['twitter']['icon'] . '</a>';
                                echo '<a href="#" class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 hover:bg-[#0c7ff2] text-gray-600 hover:text-white rounded-lg transition-all duration-300" aria-label="LinkedIn">' . $social_links['linkedin']['icon'] . '</a>';
                            }
                            ?>
                        </div>
                        
                        <!-- Contact Info -->
                        <div class="text-gray-600 text-sm space-y-2">
                            <p>Email: info@<?php echo esc_html(str_replace(['http://', 'https://'], '', home_url())); ?></p>
                            <p>Built with WordPress & TechInsights Theme</p>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Bottom -->
                <div class="border-t border-gray-200 px-5 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-gray-600 text-sm">
                        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                        <div class="flex gap-6">
                            <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="hover:text-[#0c7ff2] transition-colors">Privacy Policy</a>
                            <a href="<?php echo esc_url(home_url('/terms-of-service')); ?>" class="hover:text-[#0c7ff2] transition-colors">Terms of Service</a>
                            <a href="<?php echo esc_url(home_url('/sitemap')); ?>" class="hover:text-[#0c7ff2] transition-colors">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div><!-- .layout-container -->
</div><!-- .design-root -->

<?php wp_footer(); ?>
</body>
</html>
