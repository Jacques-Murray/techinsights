<?php
/**
 * Tech Insights Theme Functions
 *
 * @package TechInsights
 */

// --- Enqueue Scripts and Styles ---
function techinsights_enqueue_assets() {
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?display=swap&family=Inter:wght@400;500;600;700&family=Noto+Sans:wght@400;500;700;900', array(), null);

    // Enqueue the Tailwind CSS script that includes the container-queries plugin.
    // This is required for the theme's responsive layout to work correctly.
    wp_enqueue_script('tailwindcss', 'https://cdn.tailwindcss.com?plugins=forms,container-queries', array(), null, false);
    
    // Enqueue theme's main stylesheet (contains custom CSS enhancements)
    wp_enqueue_style('techinsights-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    
    // Enqueue custom JavaScript for theme functionality
    wp_enqueue_script('techinsights-script', get_template_directory_uri() . '/js/theme.js', array(), wp_get_theme()->get('Version'), true);
    
    // Localize script for AJAX functionality
    wp_localize_script('techinsights-script', 'techinsights_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('techinsights_nonce'),
        'search_placeholder' => __('Search articles...', 'techinsights')
    ));
}
add_action('wp_enqueue_scripts', 'techinsights_enqueue_assets');


// --- Add Theme Support ---
function techinsights_theme_support() {
    // Adds <title> tag support
    add_theme_support('title-tag');

    // Adds support for featured images (post thumbnails)
    add_theme_support('post-thumbnails');

    // Register Navigation Menu
    register_nav_menus(
        array(
            'primary-menu' => esc_html__('Primary Menu', 'techinsights'),
            'footer-menu'  => esc_html__('Footer Menu', 'techinsights'),
        )
    );
}
add_action('after_setup_theme', 'techinsights_theme_support');


// --- Widget Areas ---
function techinsights_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'techinsights'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'techinsights'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8 p-6 bg-white rounded-lg border border-[#e2e8f0] shadow-sm">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-[#1e293b] text-xl font-bold mb-4">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'techinsights'),
        'id'            => 'footer-widgets',
        'description'   => esc_html__('Add widgets to the footer area.', 'techinsights'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-[#1e293b] text-lg font-semibold mb-3">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'techinsights_widgets_init');


// --- Custom Post Types ---
function techinsights_custom_post_types() {
    // Register Featured Articles post type
    register_post_type('featured_article', array(
        'labels' => array(
            'name' => __('Featured Articles', 'techinsights'),
            'singular_name' => __('Featured Article', 'techinsights'),
            'add_new' => __('Add New Featured Article', 'techinsights'),
            'add_new_item' => __('Add New Featured Article', 'techinsights'),
            'edit_item' => __('Edit Featured Article', 'techinsights'),
            'new_item' => __('New Featured Article', 'techinsights'),
            'view_item' => __('View Featured Article', 'techinsights'),
            'search_items' => __('Search Featured Articles', 'techinsights'),
            'not_found' => __('No featured articles found', 'techinsights'),
            'not_found_in_trash' => __('No featured articles found in trash', 'techinsights'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'author', 'comments'),
        'menu_icon' => 'dashicons-star-filled',
        'show_in_rest' => true,
    ));
}
add_action('init', 'techinsights_custom_post_types');


// --- AJAX Search Functionality ---
function techinsights_ajax_search() {
    check_ajax_referer('techinsights_nonce', 'nonce');
    
    $search_term = sanitize_text_field(wp_unslash($_POST['search_term'] ?? ''));
    
    if (empty($search_term)) {
        wp_die();
    }
    
    $args = array(
        'post_type' => array('post', 'featured_article'),
        'post_status' => 'publish',
        'posts_per_page' => 5,
        's' => $search_term,
    );
    
    $search_query = new WP_Query($args);
    
    if ($search_query->have_posts()) {
        echo '<div class="search-results space-y-4">';
        while ($search_query->have_posts()) {
            $search_query->the_post();
            ?>
            <div class="search-result-item bg-white rounded-lg p-4 hover:bg-[#f8fafc] transition-colors border border-[#e2e8f0]">
                <h3 class="text-[#1e293b] font-semibold mb-2">
                    <a href="<?php the_permalink(); ?>" class="hover:text-[#0c7ff2]"><?php the_title(); ?></a>
                </h3>
                <p class="text-[#64748b] text-sm"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                <div class="text-xs text-[#64748b] mt-2">
                    <?php echo get_the_date(); ?> • <?php the_category(', '); ?>
                </div>
            </div>
            <?php
        }
        echo '</div>';
    } else {
        echo '<div class="text-center text-[#64748b] py-8">No results found for "' . esc_html($search_term) . '"</div>';
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_techinsights_search', 'techinsights_ajax_search');
add_action('wp_ajax_nopriv_techinsights_search', 'techinsights_ajax_search');


// --- Custom Excerpt Length ---
function techinsights_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'techinsights_excerpt_length');


// --- Custom Excerpt More ---
function techinsights_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'techinsights_excerpt_more');


// --- Add Body Classes ---
function techinsights_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'single-post-page';
    }
    
    if (is_home() || is_front_page()) {
        $classes[] = 'home-page';
    }
    
    return $classes;
}
add_filter('body_class', 'techinsights_body_classes');


// --- Customizer Settings ---
function techinsights_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('techinsights_hero', array(
        'title' => __('Hero Section', 'techinsights'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default' => __('Welcome to Tech Insights', 'techinsights'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'techinsights'),
        'section' => 'techinsights_hero',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => __('Discover the latest in technology and innovation', 'techinsights'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'techinsights'),
        'section' => 'techinsights_hero',
        'type' => 'textarea',
    ));
    
    // Social Media Links
    $wp_customize->add_section('techinsights_social', array(
        'title' => __('Social Media', 'techinsights'),
        'priority' => 35,
    ));
    
    $social_platforms = array(
        'twitter' => 'Twitter',
        'linkedin' => 'LinkedIn',
        'github' => 'GitHub',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
    );
    
    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting("social_{$platform}", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control("social_{$platform}", array(
            'label' => $label . ' URL',
            'section' => 'techinsights_social',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'techinsights_customize_register');


/**
 * Custom Nav Walker to apply Tailwind classes to menu items.
 */
class TechInsights_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $is_footer_menu = isset($args->in_footer) && $args->in_footer;

        $classes = $is_footer_menu
            ? 'text-[#64748b] text-base font-normal leading-normal min-w-40'
            : 'text-gray-900 text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors';

        $output .= sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url($item->url),
            esc_attr($classes),
            esc_html($item->title)
        );
    }

    // Prevents wrapping menu in <ul> and <li>
    function end_el( &$output, $item, $depth = 0, $args = null ) { $output .= ""; }
    function start_lvl( &$output, $depth = 0, $args = null ) { $output .= ''; }
    function end_lvl( &$output, $depth = 0, $args = null ) { $output .= ''; }
}
