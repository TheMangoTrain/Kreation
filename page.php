<?php

 /* File: page.php */

use Timber\Timber;

$context         = Timber::get_context();
$context['post'] = Timber::query_post();


$args = array(
'post_type' => 'project',
'posts_per_page' => -1,
);

$context["projects"] = Timber::get_posts( $args );


//Timber::render( 'pages/page.twig', $context );

Timber::render( array(
    'pages/page-' . $post->id . '.twig',
    'pages/page-' . $post->post_name . '.twig',
    'pages/page.twig'
), $context );





?>
