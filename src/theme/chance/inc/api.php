<?php
// API一覧
// /custom/v2/all-casts : すべての掲載中のキャスト
// /custom/v2/shop-casts　:  新宿店所属の掲載中のキャスト
// /custom/v2/today-cast : 今日出勤のキャストのスケジュール
// /custom/v2/weekly-cast-schedule : 今週のキャストのスケジュール

// キャストのAPI

// 全てのキャストのダイジェストを取得するAPIエンドポイント
add_action( 'rest_api_init', 'register_all_casts_rest_route' );

function register_all_casts_rest_route() {
	register_rest_route(
		'custom/v2',
		'/all-casts',
		array(
			'methods'             => 'GET',
			'permission_callback' => '__return_true',
			'callback'            => 'all_casts_api_handler',
		)
	);
}

function all_casts_api_handler() {
	$casts = get_all_staff();
	$casts = $casts->posts;
	$casts = array_map(
		function ( $cast ) {
			$cast_data = get_cast_summary( $cast->ID );
			return $cast_data;
		},
		$casts
	);
	return $casts;
}

add_action( 'rest_api_init', 'register_shop_casts_rest_route' );

function register_shop_casts_rest_route() {
	register_rest_route(
		'custom/v2',
		'/shop-casts',
		array(
			'methods'             => 'GET',
			'permission_callback' => '__return_true',
			'callback'            => 'shop_casts_api_handler',
		)
	);
}

function shop_casts_api_handler() {
	$casts = get_shop_staffs( 'shinjuku-gyoen' );
	$casts = $casts->posts;
	$casts = array_map(
		function ( $cast ) {
			$cast_data = get_cast_summary( $cast->ID );
			return $cast_data;
		},
		$casts
	);
	return $casts;
}

add_action( 'rest_api_init', 'register_today_cast_rest_route' );

function register_today_cast_rest_route() {
	register_rest_route(
		'custom/v2',
		'/today-cast',
		array(
			'methods'             => 'GET',
			'permission_callback' => '__return_true',
			'callback'            => 'today_cast_schedule_api_handler',
		)
	);
}
function today_cast_schedule_api_handler() {
	$today_schedules = get_daily_schedules( 0 );
	return $today_schedules[0];
}

add_action( 'rest_api_init', 'register_weekly_cast_schedule_rest_route' );

function register_weekly_cast_schedule_rest_route() {
	register_rest_route(
		'custom/v2',
		'/weekly-cast-schedule',
		array(
			'methods'             => 'GET',
			'permission_callback' => '__return_true',
			'callback'            => 'weekly_cast_schedule_api_handler',
		)
	);
}

function weekly_cast_schedule_api_handler() {
	$weekly_schedules = get_daily_schedules();
	return $weekly_schedules;
}
