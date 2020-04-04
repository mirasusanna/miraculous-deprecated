<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);

    // Text color
    $wp_customize->add_setting('text_color', array(
        'default' => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'text_color', array(
        'section' => 'colors',
        'label' => esc_html__('Text Color', '@@textdomain'),
        'description' => esc_html__('Default text color.', '@@textdomain'),
    )));

    // Heading color
    $wp_customize->add_setting('heading_color', array(
        'default' => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'heading_color', array(
        'section' => 'colors',
        'label' => esc_html__('Heading Color', '@@textdomain'),
        'description' => esc_html__('Default heading color.', '@@textdomain'),
    )));

    // Link color
    $wp_customize->add_setting('link_color', array(
        'default' => '#0000ff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'section' => 'colors',
        'label' => esc_html__('Link Color', '@@textdomain'),
        'description' => esc_html__('Default link color. Make sure it is different enough from text color.', '@@textdomain'),
    )));

    // Link hover color
    $wp_customize->add_setting('link_hover_color', array(
        'default' => '#0000ff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
        'section' => 'colors',
        'label' => esc_html__('Link Hover Color', '@@textdomain'),
        'description' => esc_html__('Hover link color.', '@@textdomain'),
    )));

    // Menu link color
    $wp_customize->add_setting('menu_link_color', array(
        'default' => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'menu_link_color', array(
        'section' => 'colors',
        'label' => esc_html__('Menu Link Color', '@@textdomain'),
        'description' => esc_html__('Color for menu links.', '@@textdomain'),
    )));

    // Menu link hover color
    $wp_customize->add_setting('menu_link_hover_color', array(
        'default' => '#0000ff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'menu_link_hover_color', array(
        'section' => 'colors',
        'label' => esc_html__('Menu Link Color', '@@textdomain'),
        'description' => esc_html__('Color when hovering menu links.', '@@textdomain'),
    )));

    // Primary color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#00ff00',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'section' => 'colors',
        'label' => esc_html__('Primary Color', '@@textdomain'),
        'description' => esc_html__('Add a color to use within the Gutenberg editor color palette.', '@@textdomain'),
    )));

    // Secondary color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#ff0000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'section' => 'colors',
        'label' => esc_html__('Secondary Color', '@@textdomain'),
        'description' => esc_html__('Add a color to use within the Gutenberg editor color palette.', '@@textdomain'),
    )));

    // Accent color
    $wp_customize->add_setting('accent_color', array(
        'default' => '#00ffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'section' => 'colors',
        'label' => esc_html__('Accent Color', '@@textdomain'),
        'description' => esc_html__('Add a color to use within the Gutenberg editor color palette.', '@@textdomain'),
    )));
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});
