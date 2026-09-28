<?php
// テーマ設定ページ追加
add_action( 'admin_menu', 'chance_theme_settings_menu' );

function chance_theme_settings_menu() {
	add_options_page(
		'テーマ設定', // ページタイトル
		'テーマ設定', // メニュータイトル
		'manage_options', // 権限
		'chance-theme-settings', // スラッグ
		'chance_theme_settings_page' // コールバック
	);
}

function chance_theme_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( '権限がありません。' );
	}

	// 保存処理
	if ( isset( $_POST['chance_theme_settings_nonce'] ) && wp_verify_nonce( $_POST['chance_theme_settings_nonce'], 'chance_theme_settings_action' ) ) {
		$show_today_shift = isset( $_POST['chance_show_today_shift_on_top'] ) ? 1 : 0;
		update_option( 'chance_show_today_shift_on_top', $show_today_shift );

		$show_cast_info = isset( $_POST['chance_show_cast_info'] ) ? 1 : 0;
		update_option( 'chance_show_cast_info', $show_cast_info );

		$show_phone_number = isset( $_POST['chance_show_phone_number'] ) ? 1 : 0;
		update_option( 'chance_show_phone_number', $show_phone_number );

		echo '<div class="updated notice"><p>設定を保存しました！</p></div>';
	}

	// 現在の値を取得
	$show_today_shift  = get_option( 'chance_show_today_shift_on_top', 1 );
	$show_cast_info    = get_option( 'chance_show_cast_info', 1 );
	$show_phone_number = get_option( 'chance_show_phone_number', 1 );

	echo '<div class="wrap">';
	echo '<h1>テーマ設定</h1>';
	echo '<form method="post">';
	wp_nonce_field( 'chance_theme_settings_action', 'chance_theme_settings_nonce' );
	echo '<table class="form-table">';
	echo '<tr>';
	echo '<th scope="row">トップページに本日の出勤を表示する</th>';
	echo '<td><label><input type="checkbox" name="chance_show_today_shift_on_top" value="1"' . checked( 1, $show_today_shift, false ) . '> 表示する</label></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th scope="row">キャスト情報を公開する</th>';
	echo '<td><label><input type="checkbox" name="chance_show_cast_info" value="1"' . checked( 1, $show_cast_info, false ) . '> 公開する</label></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th scope="row">電話番号を表示する</th>';
	echo '<td><label><input type="checkbox" name="chance_show_phone_number" value="1"' . checked( 1, $show_phone_number, false ) . '> 表示する</label></td>';
	echo '</tr>';
	echo '</table>';
	echo '<p class="submit"><input type="submit" class="button-primary" value="保存"></p>';
	echo '</form>';
	echo '</div>';
}
