<?php
/*
 * Template Name: Landing
 * Description: ...
 */

$context = Timber::get_context();

$post = new TimberPost();
$context['post'] = $post;

if(is_page('homepage')) {
    $context['title'] = get_bloginfo('name');
} else {
    $context['title'] = get_the_title($post->id);
}

if(is_page('services')) {
    foreach (get_terms('type') as $type) {
        $args = array(
            'post_type' => 'services',
            'tax_query' => array(
                array(
                    'taxonomy' => 'type',
                    'field'    => 'slug',
                    'terms'    => $type->name
                )
            )
        );

        $context['services'][$type->name]['title'] = str_replace(' ', '-', $type->name);
        $context['services'][$type->name]['acf'] = get_field_objects($type);
        $context['services'][$type->name]['posts'] = Timber::get_posts($args);
    }
}

Timber::render(array('page-' . $post->post_name . '.twig', 'template-landing.twig'), $context);