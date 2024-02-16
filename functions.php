<?php

/**
 * PTPI functions and definitions
 *
 * The short keyword "ptpi" is used as prefix to function names to make them unique.
 *
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function am_setup()
{

	/* Let WordPress manage the document title. */
	add_theme_support('title-tag');

	/* Allow featured image */
	add_theme_support('post-thumbnails');

	/* Allow HTML5 markup */
	add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

	/* Register Navigation Menus */
	register_nav_menus(array(
		'header' => __('Header Menu', 'ptpi'),
	));

	/* Custom image sizes */
	add_image_size( 'thumbnail-story-small', 100, 100, true );
}
add_action('after_setup_theme', 'am_setup');

/**
 * Enqueue scripts and styles
 */
function am_scripts()
{

	/* Google Fonts	*/
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Dosis:400,700,800');

	/* Theme stylesheet */
	wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css');

    wp_enqueue_style('style-custom', get_stylesheet_uri());

	wp_enqueue_script('html5shiv', '//html5shim.googlecode.com/svn/trunk/html5.js', false, null);
	wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');

	wp_enqueue_script('respond', '//oss.maxcdn.com/respond/1.4.2/respond.min.js', false, null);
	wp_script_add_data('respond', 'conditional', 'lt IE 9');

	/* SlickJS */
    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), null, true);

    /* CountUpJS */
	wp_enqueue_script('countup', get_template_directory_uri() . '/assets/js/countup.min.js', array('jquery'), null, true);

 	/* Theme JS */
	wp_enqueue_script('theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'am_scripts');

/**
 * Removes bloat
 * Meta tags, styles, scripts
 */
function am_remove_bloat()
{

	/* Remove emoji support */
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');

	/* Removes Emoji support from TinyMCE */
	add_filter('tiny_mce_plugins', 'am_disable_emoji_tinymce');

	/* Remove WPML generator meta tag */
	global $sitepress;
	remove_action('wp_head', array($sitepress, 'meta_generator_tag'));

	/* Other junk */
	remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
	remove_action('wp_head', 'wp_generator'); // remove wordpress version

	remove_action('wp_head', 'feed_links', 2); // remove rss feed links
	remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links

	remove_action('wp_head', 'index_rel_link'); // remove link to index page
	remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

	remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

	remove_action('wp_head', 'wp_resource_hints', 2);

	remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('template_redirect', 'rest_output_link_header', 11);
}
add_action('init', 'am_remove_bloat');

/**
 * Removes Emoji support form TinyMCE
 *
 * @param  array $plugins Loaded plugins
 * @return array          Plugins list, wpemjoi removeod
 */
function am_disable_emoji_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

/**
 * ACF theme options pages
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	));
}

/**
 * Adds SVG support to WP Media
 *
 * @param  array $mimes Supported mime types
 * @return array
 */
function am_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}
add_filter('upload_mimes', 'am_mime_types');

/**
 * Custom template tags and layout/styling helpers
 */
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Cusotm post type definions
 */
require get_parent_theme_file_path('/inc/custom-post-types/init.php');

/**
 * Theme shortcodes
 */
require get_parent_theme_file_path('/inc/shortcodes.php');

/**
 * Changes ACF JSON directory
 *
 * @param  string $path Default ACF JSON direcotry
 * @return string
 */
function am_acf_json_save_point($path)
{
	return get_stylesheet_directory() . '/inc/acf-json';
}
add_filter('acf/settings/save_json', 'am_acf_json_save_point');

/**
 * Loads ACF JSON
 *
 * @param array $paths ACF JSON directory paths
 * @return array
 */
function am_acf_json_load_point($paths)
{

	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/inc/acf-json';;

	return $paths;
}
add_filter('acf/settings/load_json', 'am_acf_json_load_point');

/**
 * Enqueue admin specific styles
 */
function am_admin_styles()
{
	wp_enqueue_style('ptpi-admin-styles', get_template_directory_uri() . '/assets/css/admin-styles.css');
}
add_action('admin_enqueue_scripts', 'am_admin_styles');

/**
 * Disable srcset output
 */
add_filter('max_srcset_image_width', function () {
	return 1;
});

/**
 * Print head_snippets
 */
function am_print_head_scripts()
{
	if (have_rows('head_snippets', 'option')) {
		while (have_rows('head_snippets', 'option')) {
			the_row();
			the_sub_field('snippet');
		}
	}
}
add_action('wp_head', 'am_print_head_scripts');

/**
 * Print footer_snippets
 */
function am_print_footer_scripts()
{
	if (have_rows('footer_snippets', 'option')) {
		while (have_rows('footer_snippets', 'option')) {
			the_row();
			the_sub_field('snippet');
		}
	}
}
add_action('wp_footer', 'am_print_footer_scripts');

/**
 * Print body_snippets
 */
function am_print_body_scripts()
{
	if (have_rows('body_snippets', 'option')) {
		while (have_rows('body_snippets', 'option')) {
			the_row();
			the_sub_field('snippet');
		}
	}
}
add_action('am_body_start', 'am_print_body_scripts');

/**
 * Render shortcodes in ACF textarea
 */
function acf_textarea_shortcode($value, $post_id, $field)
{
	if (is_admin()) {
		return $value;
	}

	return do_shortcode($value);
}
add_filter('acf/load_value/type=textarea', 'acf_textarea_shortcode', 10, 3);