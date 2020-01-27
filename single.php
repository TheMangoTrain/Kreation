<?php

/* File: single.php */

use Timber\Timber;

$context         = Timber::get_context();
$context['post'] = Timber::query_post();
$context['projectdate'] = get_field('projectdate');
//$context['project'] = Timber::query_post();
//Timber::render( 'pages/single.twig', $context );
Timber::render( array( 'pages/single-' . $post->post_type . '.twig', 'pages/single.twig' ), $context );

//$context['project'] = Timber::query_post();
//Timber::render( 'pages/single-project.twig', $context );
?>
