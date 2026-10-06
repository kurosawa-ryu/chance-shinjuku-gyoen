<?php

/*-------------------------------------------*/
/*  管理画面で使用したいcss・jsを読み込む
/*-------------------------------------------*/
function add_dashboard() {
	add_action( 'admin_enqueue_scripts', 'my_admin_style' );
	add_action( 'admin_enqueue_scripts', 'my_admin_script' );
}
// 管理画面　css
function my_admin_style() {
	global $post;
	if ( is_array( $post ) ) {
		$post = $post[0];
	}
	if ( ! empty( $post ) && $post->post_type ) {
		wp_enqueue_style( 'admin', get_template_directory_uri() . '/assets/admin.css', false, get_asset_version() );
	}
	if ( ! empty( $_GET['page'] ) && 'custom-cushion' === $_GET['page'] ) {
		wp_enqueue_style( 'admin', get_template_directory_uri() . '/assets/admin.css', false, get_asset_version() );
	}
}
// 管理画面　js
function my_admin_script() {
	wp_enqueue_media();
	wp_enqueue_script( 'mediauploader', get_template_directory_uri() . '/src/js/mediauploader.js', array( 'jquery' ), false, true );
}
add_action( 'admin_menu', 'add_dashboard' );

/*-------------------------------------------*/
/*  フロント画面で使用したいcss・jsを読み込む
/*-------------------------------------------*/
function add_front_theme() {
	add_action( 'wp_enqueue_scripts', 'my_front_style' );
	add_action( 'wp_enqueue_scripts', 'my_front_script' );
}
// フロント画面　css
function my_front_style() {

	$dir = get_template_directory_uri() . '/assets/';

	wp_enqueue_style( 'core', $dir . 'style.css', false, get_asset_version() );
}

function add_type_attribute( $tag, $handle, $src ) {
	$target_handler = array( 'app', 'top', 'cast', 'schedule-page', 'reserved', 'survey', 'recruit' );
	if ( ! in_array( $handle, $target_handler, true ) ) {
		return $tag;
	}

	$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	return $tag;
}
add_filter( 'script_loader_tag', 'add_type_attribute', 10, 3 );

// フロント画面　js
function my_front_script() {
	global $post;

	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/app.js', array(), get_asset_version(), true, array( 'type' => 'module' ) );

	//ページごとに個別のjsを読み込む
	// トップページ
	if ( is_front_page() || is_page_template( 'page-home-en.php' ) ) {
		wp_enqueue_script( 'top', get_template_directory_uri() . '/assets/top.js', array(), get_asset_version(), true, array( 'type' => 'module' ) );
	}
	// castページ($post->post_typeがcastの場合)
	if ( is_single() && 'cast' === $post->post_type ) {
		wp_enqueue_script( 'cast', get_template_directory_uri() . '/assets/cast.js', array(), get_asset_version(), true, array( 'type' => 'module' ) );
	}
	// scheduleページ
	if ( is_page( 'schedule' ) ) {
		wp_enqueue_script( 'schedule-page', get_template_directory_uri() . '/assets/schedule.js', array(), get_asset_version(), true, array( 'type' => 'module' ) );
	}
	// reservedページ
	if ( is_page( 'reserved' ) ) {
		wp_enqueue_script( 'reserved', get_template_directory_uri() . '/assets/reserved.js', array(), get_asset_version(), true, array( 'type' => 'module' ) );
	}
	if ( is_page( array( 'ank', 'ank-en' ) ) ) {
		wp_enqueue_script( 'survey', get_template_directory_uri() . '/assets/survey.js', array(), get_asset_version(), true, array( 'type' => 'module' ) );
	}
	// recruitページ
	if ( is_page( 'recruit' ) ) {
		wp_enqueue_script( 'recruit', get_template_directory_uri() . '/assets/recruit.js', array(), get_asset_version(), true, array( 'type' => 'module' ) );
		// Recruit フォーム用のデータを渡す (ノンスを含む)
		wp_localize_script(
			'recruit',
			'recruitData',
			array(
				'nonce'    => wp_create_nonce( 'wp_rest' ),
				'formId'   => (string) get_option( 'wpcf7_recruit_form_id', '110' ),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	wp_localize_script(
		'app', // 'bootstrap',
		'DATA',
		array(
			'template' => get_template_directory_uri() . '/',
			'ajax'     => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'after_setup_theme', 'add_front_theme' );
