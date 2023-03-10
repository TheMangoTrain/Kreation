<?php

use Timber\Timber;

$context         = Timber::get_context();
$context['post'] = Timber::query_post();

$args = array(
    'post_type' => 'project',
    'posts_per_page' => -1,
    'orderby'   => 'menu_order', // "menu_order" defined by 3rd party plugin drag order plugin
    'order'     => 'ASC'
);  

// Re: get_posts & Timber, see this thread: https://github.com/timber/timber/issues/1957#issuecomment-571328209
$context["projects"] = Timber::get_posts( $args );

Timber::render( array(
    'pages/page-' . $post->id . '.twig',
    'pages/page-' . $post->post_name . '.twig',
    'pages/page.twig'
), $context );

?>