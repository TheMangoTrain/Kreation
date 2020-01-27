<?php

use Timber\Timber;

$context         = Timber::get_context();
$context['post'] = Timber::query_post();
$context['projectdate'] = get_field('projectdate');

Timber::render( array( 'pages/single-' . $post->post_type . '.twig', 'pages/single.twig' ), $context );

?>