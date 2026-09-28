<?php
//投稿画像の表示サイズ追加
add_image_size( 'cast_thumb_top', 210, 260, false );
add_image_size( 'cast_thumb', 64, 83, false );
add_image_size( 'single_cast', 400, 600, false );
add_image_size( 'single_cast_thumb', 50, 50, false );
add_image_size( 'newsImg', 64, 64, true );

//コンタクトフォーム　確認用メールアドレス
add_filter( 'wpcf7_validate_email', 'wpcf7_text_validation_filter_extend', 11, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_text_validation_filter_extend', 11, 2 );

/**
 * コンタクトフォームの確認用メールアドレス
 *
 * @param object $result
 * @param object $tag
 * @return object
 */
function wpcf7_text_validation_filter_extend( $result, $tag ) {
	global $my_email_confirm;
	if ( ! class_exists( 'WPCF7_FormTag' ) ) {
		require_once get_template_directory() . '/inc/stub/class-wpcf7-formtag.php';
	}
	$tag   = new WPCF7_FormTag( $tag );
	$name  = $tag->name;
	$value = isset( $_POST[ $name ] ) ? trim( wp_unslash( strtr( (string) $_POST[ $name ], "\n", ' ' ) ) ) : '';
	if ( 'your-email' === $name ) {
		$my_email_confirm = $value;
	}
	if ( 'your-email_confirm' === $name && $my_email_confirm !== $value ) {
		$result->invalidate( $tag, '確認用のメールアドレスが一致していません' );
	}

	return $result;
}

//画像の切り抜き位置指定
/**
 * 画像の切り抜き位置指定
 *
 * @param array $payload
 * @param int $orig_w
 * @param int $orig_h
 * @param int $dest_w
 * @param int $dest_h
 * @param bool $crop
 * @return array|false
 */
function my_awesome_image_resize_dimensions( $payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
	if ( false ) {
		return $payload;
	}
	if ( $crop ) {
		$aspect_ratio = $orig_w / $orig_h;
		$new_w        = min( $dest_w, $orig_w );
		$new_h        = min( $dest_h, $orig_h );
		if ( ! $new_w ) {
			$new_w = intval( $new_h * $aspect_ratio );
		}
		if ( ! $new_h ) {
			$new_h = intval( $new_w / $aspect_ratio );
		}
		$size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );
		$crop_w     = round( $new_w / $size_ratio );
		$crop_h     = round( $new_h / $size_ratio );
		$s_x        = 0;
		$s_y        = 0;
	} else {
		$crop_w              = $orig_w;
		$crop_h              = $orig_h;
		$s_x                 = 0;
		$s_y                 = 0;
		list($new_w, $new_h) = wp_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h );
	}
	if ( $new_w >= $orig_w && $new_h >= $orig_h ) {
		return false;
	}
	return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter( 'image_resize_dimensions', 'my_awesome_image_resize_dimensions', 10, 6 );

/**
 * favicon表示(管理画面)
 *
 * @return void
 */
function admin_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( get_template_directory_uri() . '/assets/favicon.ico' ) . '" />';
}
add_action( 'admin_head', 'admin_favicon' );
/**
 * favicon表示(フロント)
 *
 * @return void
 */
function blog_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( get_template_directory_uri() . '/assets/favicon.ico' ) . '" />';
}
add_action( 'wp_head', 'blog_favicon' );

/**
 * favicon表示(Apple Touch Icon)
 *
 * @return void
 */
function blog_icon() {
	echo '<link rel="apple-touch-icon-precomposed" content="Chance" href="' . esc_url( home_url( '/' ) ) . 'apple-touch-icon.png" />';
}
add_action( 'wp_head', 'blog_icon' );

//カスタム投稿タイプ追加
add_action( 'init', 'pc_slider_init' );
/**
 *  カスタム投稿タイプ追加
 *
 * @return void
 */
function pc_slider_init() {
	$labels = array(
		'name'               => 'スライダー画像',
		'singular_name'      => 'スライダー画像',
		'add_new'            => '新規追加',
		'add_new_item'       => '追加する',
		'edit_item'          => '編集する',
		'new_item'           => '新しい項目',
		'view_item'          => '表示',
		'search_items'       => '検索',
		'not_found'          => '見つかりません',
		'not_found_in_trash' => 'ゴミ箱はありません',
		'parent_item_colon'  => '',
	);
	$args   = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => 60,
		'has_archive'        => true,
		'menu_icon'          => 'dashicons-editor-code',
		//'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields','revisions','page-attributes','post-formats','trackbacks')
		'supports'           => array( 'title', 'thumbnail' ),
		'show_in_rest'       => true,
	);
	register_post_type( 'slider', $args );
	flush_rewrite_rules( false );
}
//カスタムフィールドを追加
add_action( 'admin_menu', 'add_custom_fields' );
add_action( 'save_post', 'save_custom_fields' );
// 記事ページと固定ページでカスタムフィールドを表示
/**
 * カスタムフィールドを追加
 *
 * @return void
 */
function add_custom_fields() {
	add_meta_box( 'my_sectionid', '詳細設定', 'my_custom_fields', 'slider' );
}
function my_custom_fields() {
	global $post;
	if ( is_array( $post ) ) {
		$post = $post[0];
	}
	$rink = get_post_meta( $post->ID, 'rink', true );
	$alt  = get_post_meta( $post->ID, 'alt', true );
	echo '<label for="rink">リンク先</label> ';
	echo '<input type="text" name="rink" value="' . esc_html( $rink ) . '" size="60" /><br/';
	echo '<label for="rink">altテキスト</label> ';
	echo '<input type="text" name="alt" value="' . esc_html( $alt ) . '" size="60" />';
}
// カスタムフィールドの値を保存
function save_custom_fields( $post_id ) {
	if ( ! empty( $_POST['rink'] ) ) {
		update_post_meta( $post_id, 'rink', $_POST['rink'] );
	} else {
		delete_post_meta( $post_id, 'rink' );
	}
	if ( ! empty( $_POST['alt'] ) ) {
		update_post_meta( $post_id, 'alt', $_POST['alt'] );
	} else {
		delete_post_meta( $post_id, 'alt' );
	}
}


// ユーザープロフィールの項目のカスタマイズ
function my_user_meta( $wb ) {
	//項目の追加
	$wb['staffID'] = 'スタッフ';
	return $wb;
}
add_filter( 'user_contactmethods', 'my_user_meta', 10, 1 );
// フッターWordPressリンクを非表示に
// function custom_admin_footer() {
//  if ( current_user_can( 'manage_boy_registration' ) || current_user_can( 'manage_options' ) ) {
//      echo '<a href="' . esc_url( home_url( '/' ) ) . '/wp-admin/users.php?page=chance_boy_register">ボーイのログイン情報作成</a>';
//  }
// }
// add_filter( 'admin_footer_text', 'custom_admin_footer' );
//「パスワードをお忘れですか ?」と「←○○○へ戻る」を非表示
function login_nav_backtoblog_hide() {
	echo '<style>
		.login #nav,
		.login #backtoblog {
			display: none;
		}
	</style>' . PHP_EOL;
}
add_action( 'login_enqueue_scripts', 'login_nav_backtoblog_hide' );
get_template_part( 'create/create-functions' );

/******
スタッフログイン用管理画面カスタマイズ
 **********************************/
// メニューを非表示にする
function remove_menus() {
	if ( current_user_can( 'staff' ) ) {
		global $menu;
		$menu = array( $menu[100] );
	}
}
add_action( 'admin_menu', 'remove_menus' );
// ダッシュボードウィジェット非表示
function example_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard'] );
}
add_action( 'wp_dashboard_setup', 'example_remove_dashboard_widgets' );
// 管理バーの項目を非表示
function remove_admin_bar_menu( $wp_admin_bar ) {
	if ( current_user_can( 'staff' ) ) {
		$wp_admin_bar->remove_menu( 'wp-logo' ); // WordPressシンボルマーク
		$wp_admin_bar->remove_menu( 'site-name' ); // サイトタイトル
		$wp_admin_bar->remove_menu( 'updates' ); // アップロード
		$wp_admin_bar->remove_menu( 'comments' ); // コメント
		$wp_admin_bar->remove_menu( 'new-content' ); // マイアカウント
		$wp_admin_bar->remove_menu( 'my-account' ); // マイアカウント
	}
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 70 );
// 管理バーのヘルプメニューを非表示にする
function my_admin_head() {
	if ( current_user_can( 'staff' ) ) {
		echo <<<__HTML__
<style type="text/css">
#contextual-help-link-wrap,
#dashboard-widgets-wrap,
#wp-admin-bar-new-content,
#login>#nav{
	display:none;
}
</style>
__HTML__;
	} elseif ( current_user_can( 'editor' ) ) {
		echo <<<__HTML__
<style type="text/css">
.user-rich-editing-wrap,
.user-admin-color-wrap,
.user-comment-shortcuts-wrap,
.show-admin-bar,
.user-last-name-wrap,
.user-nickname-wrap,
.user-url-wrap,
.user-display-name-wrap,
.user-description-wrap,
.user-profile-picture,
.user-email-wrap,
#your-profile h2,
#your-profile h3,
#your-profile h3+table.form-table{
	display:none;
}
</style>
__HTML__;
	}
}
add_action( 'admin_head', 'my_admin_head' );
// 管理バーにログアウトを追加
function add_new_item_in_admin_bar() {
	if ( current_user_can( 'staff' ) ) {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu(
			array(
				'id'    => 'new_item_in_admin_bar',
				'title' => __( 'ログアウト' ),
				'href'  => wp_logout_url(),
			)
		);
	}
}
add_action( 'wp_before_admin_bar_render', 'add_new_item_in_admin_bar' );
// ログイン後のリダイレクト設定
function redirect_page( $user_login, $user ) {
	if ( user_can( $user->ID, 'staff' ) ) {
		wp_redirect( admin_url() );
		exit();
	}
}
add_action( 'wp_login', 'redirect_page', 99, 2 );

// テーマ有効化時にeditorとstaffから固定ページ編集権限を剥奪
function chance_remove_page_caps_from_non_admin() {
	// editor
	$role = get_role( 'editor' );
	if ( $role ) {
		$role->remove_cap( 'edit_pages' );
		$role->remove_cap( 'edit_others_pages' );
		$role->remove_cap( 'publish_pages' );
		$role->remove_cap( 'delete_pages' );
		$role->remove_cap( 'delete_others_pages' );
		$role->remove_cap( 'delete_published_pages' );
		$role->remove_cap( 'delete_private_pages' );
		$role->remove_cap( 'edit_private_pages' );
		$role->remove_cap( 'read_private_pages' );
		// ユーザー管理をできるように
		$role->add_cap( 'list_users' );
		$role->add_cap( 'edit_users' );
		$role->add_cap( 'delete_users' );
		$role->add_cap( 'create_users' );
		$role->add_cap( 'promote_users' );
		$role->add_cap( 'remove_users' );
		$role->add_cap( 'edit_user' );
		// ボーイ登録機能をできるように
		$role->add_cap( 'manage_boy_registration' );

	}
	// staff
	$role = get_role( 'staff' );
	if ( $role ) {
		$role->remove_cap( 'edit_pages' );
		$role->remove_cap( 'edit_others_pages' );
		$role->remove_cap( 'publish_pages' );
		$role->remove_cap( 'delete_pages' );
		$role->remove_cap( 'delete_others_pages' );
		$role->remove_cap( 'delete_published_pages' );
		$role->remove_cap( 'delete_private_pages' );
		$role->remove_cap( 'edit_private_pages' );
		$role->remove_cap( 'read_private_pages' );
	}
}
add_action( 'after_switch_theme', 'chance_remove_page_caps_from_non_admin' );

// テーマ有効化時にeditorとstaffから設定メニュー編集権限を剥奪
function chance_remove_settings_caps_from_non_admin() {
	// editor
	$role = get_role( 'editor' );
	if ( $role ) {
		$role->remove_cap( 'manage_options' );
	}
	// staff
	$role = get_role( 'staff' );
	if ( $role ) {
		$role->remove_cap( 'manage_options' );
	}
}
add_action( 'after_switch_theme', 'chance_remove_settings_caps_from_non_admin' );

// administrator以外はBogoの言語設定メニューを非表示
function chance_hide_bogo_menu_for_non_admin( $wp_admin_bar ) {
	if ( ! current_user_can( 'administrator' ) ) {
		remove_menu_page( 'bogo' );
		remove_menu_page( 'wpcf7' );
		remove_menu_page( 'edit.php' ); // 投稿
		remove_menu_page( 'edit.php?post_type=page' ); // 固定ページ
		remove_menu_page( 'edit-comments.php' ); // コメント
		remove_menu_page( 'themes.php' ); // 外観
		remove_menu_page( 'plugins.php' ); // プラグイン
		remove_menu_page( 'tools.php' ); // ツール
		remove_menu_page( 'options-general.php' ); // 設定
	}
}
add_action( 'admin_menu', 'chance_hide_bogo_menu_for_non_admin', 99 );

function remove_admin_bar_menus( $wp_admin_bar ) {
	$wp_admin_bar->remove_menu( 'wp-logo' ); // ロゴ
	$wp_admin_bar->remove_menu( 'about' ); // ロゴ > WordPressについて
	$wp_admin_bar->remove_menu( 'wporg' ); // ロゴ > WordPress.org
	$wp_admin_bar->remove_menu( 'documentation' ); // ロゴ > ドキュメンテーション
	$wp_admin_bar->remove_menu( 'support-forums' ); // ロゴ > サポート
	$wp_admin_bar->remove_menu( 'feedback' ); // ロゴ > フィードバック
	// $wp_admin_bar->remove_menu( 'site-name' ); // サイト名
	// $wp_admin_bar->remove_menu( 'view-site' ); // サイト名 > サイトを表示
	$wp_admin_bar->remove_menu( 'themes' ); // サイト名 > テーマ
	$wp_admin_bar->remove_menu( 'widgets' ); // サイト名 > ウィジェット
	$wp_admin_bar->remove_menu( 'menus' ); // サイト名 > メニュー
	$wp_admin_bar->remove_menu( 'customize' ); // カスタマイズ
	$wp_admin_bar->remove_menu( 'updates' ); // 更新
	$wp_admin_bar->remove_menu( 'comments' ); // コメント
	$wp_admin_bar->remove_menu( 'new-content' ); // 新規
	$wp_admin_bar->remove_menu( 'new-post' ); // 新規 > 投稿
	$wp_admin_bar->remove_menu( 'new-media' ); // 新規 > メディア
	$wp_admin_bar->remove_menu( 'new-page' ); // 新規 > 固定
	$wp_admin_bar->remove_menu( 'new-user' ); // 新規 > ユーザー
	$wp_admin_bar->remove_menu( 'edit' ); // 投稿・固定ページを編集
	// $wp_admin_bar->remove_menu( 'my-account' ); // こんにちは、[ユーザー名]さん
	// $wp_admin_bar->remove_menu( 'user-info' ); // こんにちは、[ユーザー名]さん > [ユーザー名]
	// $wp_admin_bar->remove_menu( 'edit-profile' ); // こんにちは、[ユーザー名]さん > プロフィールを編集
	$wp_admin_bar->remove_menu( 'logout' ); // こんにちは、[ユーザー名]さん > ログアウト
	$wp_admin_bar->remove_menu( 'search' ); // 検索
}
	add_action( 'admin_bar_menu', 'remove_admin_bar_menus', 99 );

/**
 * ログイン画面のロゴを独自画像に変更する（logo.webp固定）
 *
 * @return void
 */
function chance_custom_login_logo() {
	$logo_url = get_template_directory_uri() . '/public/common/logo.png';
	echo '<style>
		.login h1 a {
			background-image: url(' . esc_url( $logo_url ) . ') !important;
			background-size: contain !important;
			width: 320px !important;
			height: 120px !important;
		}
		.login .privacy-policy-page-link,
		.login #language-switcher,
		.login .language-switcher {
			display: none !important;
		}
	</style>';
}
add_action( 'login_enqueue_scripts', 'chance_custom_login_logo' );
