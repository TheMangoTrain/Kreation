<?php

/* File: index.php */

use Timber\Timber;

global $paged;
if ( ! isset( $paged ) || ! $paged ) {
    $paged = 1;
}
$context = Timber::get_context();
$args    = [
    'post_type'      => 'post',
    'posts_per_page' => 10,
    'paged'          => $paged,
];
$context['posts']      = new \Timber\PostQuery( $args );
$templates             = [
    'pages/posts.twig',
    'pages/index.twig',
];

Timber::render( $templates, $context );

?>
