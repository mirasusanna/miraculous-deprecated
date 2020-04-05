<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Gutenberg assets
 */
add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_style('sage/gutenberg.css', asset_path('styles/gutenberg.css'), false, null);
});

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Add theme support for logo
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-logo
     */
    add_theme_support('custom-logo', [
        'height' => 150,
        'width' => 150,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => ['site-title', 'site-description'],
    ]);

    add_theme_support('align-wide');

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

/**
 * Add support for custom color palettes in Gutenberg.
 */
add_action('after_setup_theme', function () {
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => esc_html__('Black', '@@textdomain'),
                'slug' => 'black',
                'color' => '#000',
            ),
            array(
                'name'  => esc_html__('Light grey', '@@textdomain'),
                'slug' => 'light_grey',
                'color' => '#f0f0f0',
            ),
            array(
                'name'  => esc_html__('White', '@@textdomain'),
                'slug' => 'white',
                'color' => '#fff'
            ),
            array(
                'name'  => esc_html__('Primary color', '@@textdomain'),
                'slug' => 'primary',
                'color' => esc_html(get_theme_mod('primary', '#00ff00')),
            ),
            array(
                'name'  => esc_html__('Secondary color', '@@textdomain'),
                'slug' => 'secondary_color',
                'color' => esc_html(get_theme_mod('secondary_color', '#ff0000')),
            ),
            array(
                'name'  => esc_html__('Accent color', '@@textdomain'),
                'slug' => 'accent_color',
                'color' => esc_html(get_theme_mod('accent_color', '#00ffff')),
            ),
        )
    );
});

/**
 * Generate styles based on theme customizer for Gutenberg
 */
function generate_custom_editor_css()
{
    // Retrieve the all colors from the Customizer
    $text_color = get_theme_mod('text_color', '#000');
    $heading_color = get_theme_mod('heading_color', '#000');
    $link_color = get_theme_mod('link_color', '#0000ff');

    // Build styles.
    $css  = '';
    $css .= '.block-editor-rich-text__editable a { color: ' . esc_attr($link_color) . '; }';
    $css .= 'p.block-editor-rich-text__editable { color: ' . esc_attr($text_color) . '; }';
    $css .= 'h1.block-editor-rich-text__editable { color: ' . esc_attr($heading_color) . '; }';
    $css .= 'h2.block-editor-rich-text__editable { color: ' . esc_attr($heading_color) . '; }';
    $css .= 'h3.block-editor-rich-text__editable { color: ' . esc_attr($heading_color) . '; }';
    $css .= 'h4.block-editor-rich-text__editable { color: ' . esc_attr($heading_color) . '; }';
    $css .= 'h5.block-editor-rich-text__editable { color: ' . esc_attr($heading_color) . '; }';
    $css .= 'h6.block-editor-rich-text__editable { color: ' . esc_attr($heading_color) . '; }';

    return wp_strip_all_tags($css);
}

/**
 * Enqueue theme styles within Gutenberg.
 */
add_action('enqueue_block_editor_assets', function () {
    // Load the theme styles within Gutenberg.
    wp_enqueue_style('custom_color', get_theme_file_uri('/assets/css/gutenberg.css'), false, '@@pkg.version', 'all');

    // Add custom colors to Gutenberg.
    wp_add_inline_style('custom_color', generate_custom_editor_css());
});

/**
 * Generate styles based on theme customizer for theme
 */
function generate_custom_theme_css()
{
    // Retrieve the all colors from the Customizer
    $text_color = get_theme_mod('text_color', '#000');
    $heading_color = get_theme_mod('heading_color', '#000');
    $link_color = get_theme_mod('link_color', '#0000ff');
    $link_hover_color = get_theme_mod('link_hover_color', '#0000ff');
    $menu_link_color = get_theme_mod('menu_link_color', '#000');
    $menu_link_hover_color = get_theme_mod('menu_link_hover_color', '#0000ff');
    $footer_background_color = get_theme_mod('footer_background_color', '#fafafa');
    $primary = get_theme_mod('primary', '#00ff00');
    $secondary_color = get_theme_mod('secondary_color', '#ff0000');
    $accent_color = get_theme_mod('accent_color', '#00ffff');

    // Custom color settings
    $css  = '';
    $css .= 'p { color: ' . esc_attr($text_color) . '; }';
    $css .= 'h1, h2, h3, h4, h5, h6 { color: ' . esc_attr($heading_color) . '; }';
    $css .= 'main a { color: ' . esc_attr($link_color) . '; }';
    $css .= 'main a:hover { color: ' . esc_attr($link_hover_color) . '; border-color: ' . esc_attr($link_hover_color) . '; }';
    $css .= '.site-footer { background-color: ' . esc_attr($footer_background_color) . '; }';
    $css .= '#menu-main-menu a { color: ' . esc_attr($menu_link_color) . '; }';
    $css .= '#menu-main-menu a:hover { color: ' . esc_attr($menu_link_hover_color) . '; }';

    // Color classes
    $css .= '.has-primary-color { color: ' . esc_attr($primary) . '; }';
    $css .= '.has-primary-border { border-color: ' . esc_attr($primary) . '; }';
    $css .= '.has-primary-background-color { background-color: ' . esc_attr($primary) . '; }';
    $css .= '.has-secondary-color-color { color: ' . esc_attr($secondary_color) . '; }';
    $css .= '.has-secondary-color-background-color { background-color: ' . esc_attr($secondary_color) . '; }';
    $css .= '.has-accent-color-color { color: ' . esc_attr($accent_color) . '; }';
    $css .= '.has-accent-color-background-color { background-color: ' . esc_attr($accent_color) . '; }';

    return wp_strip_all_tags($css);
}

/**
 * Enqueue theme styles.
 */
add_action('wp_enqueue_scripts', function () {
    // Load theme styles.
    wp_enqueue_style('custom_color', get_theme_file_uri('/style.css'), false, '@@pkg.version', 'all');

    // Add custom colors to the front end.
    wp_add_inline_style('custom_color', generate_custom_theme_css());
});
