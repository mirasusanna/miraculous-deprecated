<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'has-sidebar';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

/**
 * Determine when sidebar is shown
 */
add_filter('sage/display_sidebar', function ($display) {
    static $display;

    $get_page_template = basename(get_page_template());

    isset($display) || $display = in_array(true, [
        // The sidebar will be displayed if any of the following return true
        is_single(),
        $get_page_template == 'page-with-sidebar.blade.php'
    ]);

    return $display;
});

/**
 * Change name of default page template
 */
add_filter('default_page_template_title', function () {
    return __('Regular page', '@@textdomain');
});

/**
 * Enable only chosen blocks in Gutenberg
 */
add_filter('allowed_block_types', function ($allowed_blocks, $post) {
    // Blocks allowed by default
    $allowed_blocks = array(
        /* Common blocks */
        'core/paragraph',
        'core/image',
        'core/heading',
        'core/gallery',
        'core/list',
        'core/quote',
        //'core/audio',
        //'core/cover',
        'core/file',
        //'core/video',
        /* Formatting */
        //'core/code',
        //'core/freeform',
        'core/html',
        'core/preformatted',
        //'core/pullquote',
        //'core/verse',
        'core/table',
        /* Layout Elements */
        'core/button',
        //'core/text-columns',
        //'core/media-text',
        //'core/more',
        //'core/nextpage',
        'core/spacer',
        'core/separator',
        /* Widgets */
        'core/shortcode',
        //'core/archives',
        //'core/categories',
        //'core/latest-comments',
        //'core/latest-posts',
        //'core/calendar',
        //'core/rss',
        //'core/search',
        //'core/tag-cloud',
        /* Embeds */
        'core/embed',
        'core-embed/twitter',
        'core-embed/youtube',
        'core-embed/facebook',
        'core-embed/instagram',
        //'core-embed/wordpress',
        //'core-embed/soundcloud',
        'core-embed/spotify',
        'core-embed/flickr',
        'core-embed/vimeo',
        //'core-embed/animoto',
        //'core-embed/cloudup',
        //'core-embed/collegehumor',
        //'core-embed/dailymotion',
        //'core-embed/funnyordie',
        //'core-embed/hulu',
        //'core-embed/imgur',
        'core-embed/issuu',
        //'core-embed/kickstarter',
        //'core-embed/meetup-com',
        //'core-embed/mixcloud',
        //'core-embed/photobucket',
        //'core-embed/polldaddy',
        //'core-embed/reddit',
        //'core-embed/reverbnation',
        //'core-embed/screencast',
        //'core-embed/scribd',
        'core-embed/slideshare',
        //'core-embed/smugmug',
        //'core-embed/speaker',
        //'core-embed/ted',
        //'core-embed/tumblr',
        //'core-embed/videopress',
        //'core-embed/wordpress-tv',
    );

    // Additional blocks enabled in Pages
    if ($post->post_type === 'page') {
        array_push(
            $allowed_blocks,
            /* Common blocks */
            'core/cover',
            /* Formatting */
            'core/pullquote',
            /* Layout Elements */
            'core/text-columns',
            'core/media-text',
            // Widgets
            'core/text-columns'
        );
    }

    return $allowed_blocks;
}, 10, 2);
