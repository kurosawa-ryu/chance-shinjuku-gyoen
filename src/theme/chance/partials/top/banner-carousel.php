<?php
$args      = array(
	'post_type'      => 'slider',
	'post_status'    => 'publish',
	'posts_per_page' => 20,
);
$the_query = new WP_Query( $args );
// jsonに変換
$json = array();
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$json[] = array(
			'title' => get_post_meta( $post->ID, 'alt', true ),
			'link'  => get_post_meta( $post->ID, 'rink', true ),
			'image' => get_the_post_thumbnail_url( get_the_ID(), 'full' ),
		);
	endwhile;
	wp_reset_postdata();
endif;
?>
<div id="top_slider" data-slider="<?php echo esc_attr( json_encode( $json ) ); ?>"></div>
