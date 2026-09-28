<?php

/**
 * Custom admin functionality.
 *
 * This file contains functions for the admin interface.
 */

// 管理画面にメニュー追加.
add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	if ( ! current_user_can( 'staff' ) ) {
		add_menu_page( 'クッション画像登録', 'クッション画像', 'manage_categories', 'custom-cushion', 'my_plugin_options' );
	}
}

//追加したメニューの内容
function my_plugin_options() {

	// ユーザーが必要な権限を持つか確認する必要がある
	if ( ! current_user_can( 'manage_categories' ) ) {
		wp_die( __( 'このページにアクセスする権限がありません。' ) );
	}

	// フィールドとオプション名の変数
	$opt_name          = 'cushion-img';
	$hidden_field_name = 'mt_submit_hidden';

	// データベースから既存のオプション値を取得
	$opt_val = get_option( $opt_name );

	// ユーザーが何か情報を POST したかどうかを確認
	// POST していれば、隠しフィールドに 'Y' が設定されている
	if ( isset( $_POST[ $hidden_field_name ] ) && 'Y' === $_POST[ $hidden_field_name ] ) {
		// POST されたデータを取得
		$opt_val = $_POST['cushion'];

		// POST された値をデータベースに保存
		update_option( $opt_name, $opt_val );

		echo '<div class="updated"><p><strong>画像を登録しました。</strong></p></div>';
	}

	if ( ! empty( $opt_val ) ) {
		foreach ( (array) $opt_val as $value ) {
			$src     = wp_get_attachment_image_src( $value, 'full', false );
			$w_img[] = '<img src="' . $src[0] . '" alt="" class="img-fluid">';
		}
	} else {
		$w_img = array( '', '' );
	}

	echo <<<__HTML__
<div class="wrap">
	<h2>クッション画像登録</h2>
	<form name="form1" method="post" action="">
	<input type="hidden" name="{$hidden_field_name}" value="Y">
	<div class="pdr15 pdl15 mgt30" style="border-top:solid 1px #ddd;">
		<h3 class="fs18 mgb20">PC用画像<small>（推奨サイズ1920×905）</small></h3>
		<div class="box mgb30">
			<div class="mediaupload" style="max-width:700px">
				<div class="mediaimg select">{$w_img[0]}</div>
				<input type="hidden" name="cushion[pc]" class="value" value="{$opt_val['pc']}">
				<button type="button" class="media">選択</button>
				<button type="button" class="media-clear">クリア</button>
			</div>
		</div>
	</div>
	<div class="pdr15 pdl15 mgt30" style="border-top:solid 1px #ddd;">
		<h3 class="fs18 mgb20">SP用画像<small>（推奨サイズ640×1100）</small></h3>
		<div class="box mgb30">
			<div class="mediaupload" style="max-width:350px">
				<div class="mediaimg select">{$w_img[1]}</div>
				<input type="hidden" name="cushion[sp]" class="value" value="{$opt_val['sp']}">
				<button type="button" class="media">選択</button>
				<button type="button" class="media-clear">クリア</button>
			</div>
		</div>
	</div>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="登録">
	</p>
	</form>
</div>
__HTML__;
}

// 案内バナー画像登録
function info_banners_menu() {
	if ( ! current_user_can( 'staff' ) ) {
		add_menu_page( '案内バナー画像登録', '案内バナー画像', 'manage_categories', 'custom-info_banners', 'info_banners' );
	}
}
add_action( 'admin_menu', 'info_banners_menu' );


function info_banners() {

	// ユーザーが必要な権限を持つか確認する必要がある
	if ( ! current_user_can( 'manage_categories' ) ) {
		wp_die( __( 'このページにアクセスする権限がありません。' ) );
	}

	// フィールドとオプション名の変数
	$opt_name          = 'info_banner-img';
	$hidden_field_name = 'mt_submit_hidden';

	// データベースから既存のオプション値を取得
	$opt_val = get_option( $opt_name );
	// 文字列をjson形式に変換
	$opt_val = json_decode( $opt_val, true );

	// ユーザーが何か情報を POST したかどうかを確認
	// POST していれば、隠しフィールドに 'Y' が設定されている
	if ( isset( $_POST[ $hidden_field_name ] ) && 'Y' === $_POST[ $hidden_field_name ] ) {
		// POST されたデータを取得
		$opt_val = $_POST['info_banner'];

		// POST された値をデータベースに保存
		update_option( $opt_name, $opt_val );

		echo '<div class="updated"><p><strong>画像を登録しました。</strong></p></div>';
	}

	if ( ! empty( $opt_val ) ) {
		foreach ( (array) $opt_val as $key => $value ) {
			$src     = wp_get_attachment_image_src( $value, 'full', false );
			$w_img[] = '<img src="' . $src[0] . '" alt="" class="img-fluid">';
		}
	} else {
		$w_img = array( '', '' );
	}

	echo <<<__HTML__
<div class="wrap">
	<h2>案内バナー画像登録</h2>
	<form name="form1" method="post" action="">
	<input type="hidden" name="{$hidden_field_name}" value="Y">
	<div class="pdr15 pdl15 mgt30" style="border-top:solid 1px #ddd;">
		<h3 class="fs18 mgb20">よくある質問<small>（推奨サイズ370×170）</small></h3>
		<div class="box mgb30">
			<div class="mediaupload" style="max-width:370px">
				<div class="mediaimg select">{$w_img[0]}</div>
				<input type="hidden" name="info_banner[faq]" class="value" value="{$opt_val['faq']}">
				<button type="button" class="media">選択</button>
				<button type="button" class="media-clear">クリア</button>
			</div>
		</div>
	</div>
	<div class="pdr15 pdl15 mgt30" style="border-top:solid 1px #ddd;">
		<h3 class="fs18 mgb20">個室案内<small>（推奨サイズ370×170）</small></h3>
		<div class="box mgb30">
			<div class="mediaupload" style="max-width:370px">
				<div class="mediaimg select">{$w_img[1]}</div>
				<input type="hidden" name="info_banner[room]" class="value" value="{$opt_val['room']}">
				<button type="button" class="media">選択</button>
				<button type="button" class="media-clear">クリア</button>
			</div>
		</div>
	</div>
	<div class="pdr15 pdl15 mgt30" style="border-top:solid 1px #ddd;">
		<h3 class="fs18 mgb20">コスプレ<small>（推奨サイズ370×170）</small></h3>
		<div class="box mgb30">
			<div class="mediaupload" style="max-width:370px">
				<div class="mediaimg select">{$w_img[2]}</div>
				<input type="hidden" name="info_banner[cosplay]" class="value" value="{$opt_val['cosplay']}">
				<button type="button" class="media">選択</button>
				<button type="button" class="media-clear">クリア</button>
			</div>
		</div>
	</div>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="登録">
	</p>
	</form>
</div>
__HTML__;
}

function get_faq_banner() {
	$opt_val = get_option( 'info_banner-img' );
	if ( is_string( $opt_val ) ) {
		$opt_val = json_decode( $opt_val, true );
	}
	$src = wp_get_attachment_image_src( $opt_val['faq'], 'full', false );
	if ( empty( $src ) ) {
		return get_template_directory_uri() . '/src/img/top/bnr-qa.jpg';
	} else {
		return $src[0];
	}
}

function get_room_banner() {
	$opt_val = get_option( 'info_banner-img' );
	if ( is_string( $opt_val ) ) {
		$opt_val = json_decode( $opt_val, true );
	}
	$src = wp_get_attachment_image_src( $opt_val['room'], 'full', false );
	if ( empty( $src ) ) {
		return get_template_directory_uri() . '/src/img/top/bnr-room.jpg';
	} else {
		return $src[0];
	}
}

function get_cosplay_banner() {
	$opt_val = get_option( 'info_banner-img' );
	if ( is_string( $opt_val ) ) {
		$opt_val = json_decode( $opt_val, true );
	}
	$src = wp_get_attachment_image_src( $opt_val['cosplay'], 'full', false );
	if ( empty( $src ) ) {
		return get_template_directory_uri() . '/src/img/top/bnr-cosplay.jpg';
	} else {
		return $src[0];
	}
}
