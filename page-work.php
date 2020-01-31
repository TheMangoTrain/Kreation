<?php

use Timber\Timber;

$context         = Timber::get_context();
$context['post'] = Timber::query_post();

// Assemble the query for Projects

    $args = array(
        'post_type' => 'project',
        'posts_per_page' => -1,
        'orderby'   => 'menu_order', // "menu_order" defined by 3rd party plugin drag order plugin
        'order'     => 'ASC'
    );  

    // Option 1: The more "Timber" way, which was recommended for a long while
    //$context['projects']      = new \Timber\PostQuery( $args );

    // Option 2: using get_posts, which as of late 2019 has fresh/new significance within Timber
    // See: https://github.com/timber/timber/issues/1957#issuecomment-571328209
    $context["projects"] = Timber::get_posts( $args );

Timber::render( array(
    'pages/page-' . $post->id . '.twig',
    'pages/page-' . $post->post_name . '.twig',
    'pages/page.twig'
), $context );

?>