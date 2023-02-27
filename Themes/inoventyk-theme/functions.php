<?php

/**
 * Theme functions and definitions
 *
 * @package InoventykTheme
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
add_action('wp_enqueue_scripts', 'inoventyk_theme_enqueue_styles');
function inoventyk_theme_enqueue_styles()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
