<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package 	WordPress
 * @subpackage 	Timber
 * @since 		Timber 0.1
 */

	if (!class_exists('Timber')){
		echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
		return;
	}

	$context = Timber::get_context();
	$context['posts'] = Timber::get_posts();
    $context['pagination'] = Timber::get_pagination();
    $context['adminAjax'] = admin_url('admin-ajax.php');
	$templates = array('index.twig');

	if (is_home()){
        $page = get_option( 'page_for_posts' );
        $context['acf']['corner_flash_colour']['value'] = get_field('corner_flash_colour', $page);

		array_unshift($templates, 'home.twig');
	}
	Timber::render($templates, $context);


