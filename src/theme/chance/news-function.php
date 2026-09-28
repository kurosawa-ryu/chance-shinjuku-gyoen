<?php
/**
 * ニュースのデータを取得
 *
 * @return WP_Query $query
 */
function get_top_news() {
	$args  = array(
		'posts_per_page'         => 10,
		'post_type'              => 'news',
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	);
	$query = new WP_Query( $args );
	return $query;
}
/**
 * ニュースの色を取得
 *
 * @param string $title ニュースのタイトル
 * @return string ニュースの色
 */
function get_news_post_color( $title ) {
	if ( '入店情報' === $title ) {
		return ' store';
	}
	if ( '更新情報' === $title ) {
		return ' update';
	}
	if ( '出勤情報' === $title ) {
		return ' attend';
	}
	if ( 'アンケート更新' === $title ) {
		return ' ank';
	}
	if ( '画像更新' === $title ) {
		return ' image';
	}
	if ( 'イベント・その他' === $title ) {
		return ' ivent';
	}
	return ' ivent';
}

function get_news_image( $post_id ) {
	$images = get_post_meta( $post_id, 'myupload_images', true );
	if ( ! empty( $images[0] ) ) {
		return wp_get_attachment_image( $images[0], 'newsImg', false, array( 'class' => 'img-fluid mx-auto' ) );
	}
	return '&nbsp;';
}
