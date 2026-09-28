<?php

if ( is_page( 'cushion' ) ) {
	require_once locate_template( 'cushion.php' );
	exit;
}
if ( is_page( 'create' ) ) {
	require_once locate_template( 'create/create.php' );
	exit;
}

get_header();

$folder = 'page/';

$slug = $post->post_name;

$parent = is_subpage();

if ( ! empty( $parent ) ) {
	$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
	foreach ( $ancestors as $ancestor ) {
		$parent_slug = get_post( $ancestor )->post_name;
		$folder     .= $parent_slug . '/';
	}
}

$file = $folder . $slug;



if ( locate_template( $file . '.php' ) === '' ) {

	$file = $folder . 'default';
}

get_template_part( $file );

get_footer();
