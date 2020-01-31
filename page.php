<?php

use Timber\Timber;

$context         = Timber::get_context();
$context['post'] = Timber::query_post();

Timber::render( array(
    'pages/page-' . $post->id . '.twig',
    'pages/page-' . $post->post_name . '.twig',
    'pages/page.twig'
), $context );

?>