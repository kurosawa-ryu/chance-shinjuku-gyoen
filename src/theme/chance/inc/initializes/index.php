<?php

// 認証用トークンの定義
define( 'CH_INITIALIZE_TOKEN', 'chanceinitialize' );

// require_once locate_template('inc/initializes/forms.php');
require_once locate_template( 'inc/initializes/pages.php' );
// require_once locate_template( 'inc/initializes/forms.php' );

function ch_theme_initializes() {
	//   ch_wpcf7_setup_all_forms();
	ch_setup_all_pages();
	// ch_wpcf7_setup_all_forms();
}

// add_action( 'after_switch_theme', 'ch_theme_initializes' );


// 初期化処理を実行するAPIを作成
function ch_initialize_theme() {
	ch_theme_initializes();
	wp_send_json_success( 'Theme initialized successfully' );
}

/**
 * テーマの初期化APIエンドポイント
 *
 * 使用方法:
 * 1. GET https://<your-domain>/wp-json/chance/v1/initialize?token=chanceinitialize
 *
 * 認証:
 * - クエリパラメータにトークンを追加:
 *   ?token=your-secure-token-here
 *
 * レスポンス:
 * - 成功時: {"success": true, "data": "Theme initialized successfully"}
 * - 認証エラー時: {"code": "rest_forbidden", "message": "Invalid token"}
 *
 * 実行内容:
 * - ページの初期設定
 * - その他テーマの初期化処理
 *
 * 注意:
 * - 初期化処理は慎重に実行してください
 * - 既存のデータが上書きされる可能性があります
 * - トークンは安全な場所に保管してください
 */
function ch_register_rest_routes() {
	register_rest_route(
		'chance/v1',
		'/initialize',
		array(
			'methods'             => 'GET',
			'callback'            => 'ch_initialize_theme',
			'permission_callback' => function ( $request ) {
				$token = $request->get_param( 'token' );
				return CH_INITIALIZE_TOKEN === $token;
			},
		)
	);
}

add_action( 'rest_api_init', 'ch_register_rest_routes' );
