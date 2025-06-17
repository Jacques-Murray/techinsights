<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="relative flex size-full min-h-screen flex-col group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e2e8f0] px-4 sm:px-10 py-3 sticky top-0 z-40 bg-white/95 backdrop-blur-sm shadow-sm">
            <div class="flex items-center gap-4 text-gray-900">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-4 header-logo">
                    <div class="size-4">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H6V17.3333V30.6667H24V44H42V30.6667V17.3333H24V4Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <h2 class="text-gray-900 text-lg font-bold leading-tight tracking-[-0.015em]"><?php bloginfo('name'); ?></h2>
                </a>
            </div>

            <div class="hidden md:flex flex-1 justify-end items-center gap-8">
                <nav class="hidden lg:flex items-center gap-9" role="navigation" aria-label="Primary Navigation">
                    <?php
                    if (has_nav_menu('primary-menu')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary-menu',
                            'container'      => false,
                            'items_wrap'     => '%3$s',
                            'walker'         => new TechInsights_Nav_Walker(),
                            'in_footer'      => false,
                        ));
                    }
                    ?>
                </nav>

                <div class="flex gap-2">
                    <button class="search-toggle btn-secondary" aria-label="Open search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                        </svg>
                    </button>
                    <button class="mobile-menu-toggle lg:hidden btn-secondary" aria-label="Open mobile menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"></path>
                        </svg>
                    </button>
                </div>
                
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo get_edit_user_link(); ?>" class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 ring-2 ring-transparent hover:ring-[#0c7ff2] transition-all" style='background-image: url("<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>");' aria-label="User profile"></a>
                <?php else: ?>
                    <a href="<?php echo wp_login_url(); ?>" class="btn-primary text-sm px-4 py-2">Login</a>
                <?php endif; ?>
            </div>
            
            <div class="md:hidden flex items-center gap-2">
                <button class="search-toggle btn-secondary" aria-label="Open search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                    </svg>
                </button>
                <button class="mobile-menu-toggle btn-secondary" aria-label="Open mobile menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"></path>
                    </svg>
                </button>
            </div>
        </header>

        <!-- Mobile Menu -->
        <div class="mobile-menu">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-gray-900 text-xl font-bold"><?php bloginfo('name'); ?></h2>
                <button class="mobile-menu-close btn-secondary" aria-label="Close mobile menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path>
                    </svg>
                </button>
            </div>
            <nav role="navigation" aria-label="Mobile Navigation">
                <?php
                if (has_nav_menu('primary-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary-menu',
                        'container'      => false,
                        'items_wrap'     => '<div class="flex flex-col gap-4">%3$s</div>',
                        'walker'         => new TechInsights_Nav_Walker(),
                        'in_footer'      => false,
                    ));
                }
                ?>
            </nav>
            <?php if (!is_user_logged_in()): ?>
                <div class="mt-8">
                    <a href="<?php echo wp_login_url(); ?>" class="btn-primary w-full text-center">Login</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Search Overlay -->
        <div class="search-overlay">
            <div class="search-form max-w-2xl w-full">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-gray-900 text-2xl font-bold">Search Articles</h2>
                    <button class="search-close btn-secondary" aria-label="Close search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path>
                        </svg>
                    </button>
                </div>
                <input type="text" class="search-input" placeholder="<?php echo esc_attr(get_theme_mod('search_placeholder', 'Search articles...')); ?>" aria-label="Search input">
                <div class="search-results mt-6"></div>
            </div>
        </div>

        <main class="flex flex-1 justify-center py-5 px-4 sm:px-10 lg:px-40">
            <div class="layout-content-container flex flex-col max-w-[960px] w-full">
