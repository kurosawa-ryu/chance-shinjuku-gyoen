<?php
/**
 * 固定ページを作成または更新する
 *
 * @param string $title
 * @param string $slug
 * @param string $status
 */
function ch_upsert_page( $title, $slug, $status = 'publish' ) {
	// Check if the page already exists
	$existing_page = get_page_by_path( $slug );

	// Page data
	$page_data = array(
		'post_title'   => $title,
		'post_content' => '',
		'post_status'  => $status,
		'post_type'    => 'page',
		'post_name'    => $slug,
	);

	if ( $existing_page ) {
		$page_data['ID'] = $existing_page->ID;
		wp_update_post( $page_data );
	} else {
		wp_insert_post( $page_data );
	}
}

/**
 * HPに必要なすべての固定ページを作成または更新する
 */
function ch_setup_all_pages() {
	$pages = array(
		array(
			'title'  => 'スタッフ一覧',
			'slug'   => 'staff',
			'status' => 'publish',
		),
		array(
			'title'  => '出勤時間一覧',
			'slug'   => 'schedule',
			'status' => 'publish',
		),
		array(
			'title'  => '出勤時間一覧－次週',
			'slug'   => 'schedule-next',
			'status' => 'publish',
		),
		array(
			'title'  => '料金一覧',
			'slug'   => 'price',
			'status' => 'publish',
		),
		array(
			'title'  => '免責事項',
			'slug'   => 'rule',
			'status' => 'publish',
		),
		array(
			'title'  => 'ご予約',
			'slug'   => 'reserved',
			'status' => 'publish',
		),
		array(
			'title'  => 'お客様アンケート',
			'slug'   => 'ank',
			'status' => 'publish',
		),
		array(
			'title'  => '応募フォーム',
			'slug'   => 'recruit',
			'status' => 'publish',
		),
		array(
			'title'  => 'ユーザー登録',
			'slug'   => 'create',
			'status' => 'private',
		),
	);

	foreach ( $pages as $page ) {
		ch_upsert_page( $page['title'], $page['slug'], $page['status'] );
	}
}
