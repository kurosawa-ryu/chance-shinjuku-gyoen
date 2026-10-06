<?php

/**
 * テーマの機能と定義を読み込みます。
 *
 * @category    Theme
 * @package     Chance
 * @author      World agent <info@worldagent.jp>
 * @copyright   2023 World agent
 * @license     GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @version     GIT: 1.0.0
 * @link        http://worldagent.jp/
 * @requires    PHP 7.4
 * @php_version 7.4
 */

define( 'CAST_NO_IMAGE', get_template_directory_uri() . '/public/common/cast_noimage.webp' );

require_once locate_template( 'inc/constants.php' );

/**
 * 必要なファイルをインクルードします。
 *
 * @package Chance
 */
// chance名古屋のfunctions
require_once locate_template( 'inc/functions-default.php' );
// 管理画面のカスタマイズ
require_once locate_template( 'inc/custom-admin.php' );
// 独自関数の設定
require_once locate_template( 'inc/function.php' );
// スタイル・スクリプトの設定
require_once locate_template( 'inc/insert-src.php' );
// カスタム投稿タイプ
require_once locate_template( 'inc/custom-post.php' );
// cast関係の関数
require_once locate_template( 'inc/cast-function.php' );
// news関係の関数
require_once locate_template( 'inc/news-function.php' );
// ページ用の関数
require_once locate_template( 'inc/pages/index.php' );
// SEO設定
require_once locate_template( 'inc/seo.php' );
// API
require_once locate_template( 'inc/api.php' );

// 初期化用関数
require_once locate_template( 'inc/initializes/index.php' );

// 管理画面用：ボーイのログイン情報登録ページ
require_once locate_template( 'inc/boy-register-admin.php' );

// テーマ設定ページ
require_once get_template_directory() . '/inc/theme-settings.php';

/**
 * 管理バーを非表示にします。
 *
 * @return bool 常にfalseを返し、管理バーを非表示にします。
 */
function my_function_admin_bar() {
	return false;
}
add_filter( 'show_admin_bar', 'my_function_admin_bar' );

/**
 * テーマの特定の機能をサポートします。
 *
 * @return void
 */
function original_theme_setup() {
	// コメントフォーム、検索フォーム等をHTML5のマークアップに
	add_theme_support(
		'html5',
		array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
		)
	);
	// タイトルタグ追加
	add_theme_support( 'title-tag' );
	// 投稿キャプチャー画像を追加。
	add_theme_support( 'post-thumbnails' );
	// set_post_thumbnail_size(150, 150, true);
}
add_action( 'after_setup_theme', 'original_theme_setup' );

/**
 * 固定ページの画像パスを相対パスに置き換えます。
 *
 * @param string $arg 置き換えるコンテンツ。
 *
 * @return string 置き換えたコンテンツ。
 */
function replace_image_path( $arg ) {
	$template_directory = get_bloginfo( 'template_directory' );
	$content            = str_replace(
		'"img/',
		'"' . $template_directory . '/img/',
		$arg
	);
	return $content;
}
add_action( 'the_content', 'replace_image_path' );

/**
 * 固定ページのみ自動整形機能を無効化します。
 *
 * @return void
 */
function disable_page_wpautop() {
	if ( is_page() ) {
		remove_filter( 'the_content', 'wpautop' );
	}
}
add_action( 'wp', 'disable_page_wpautop' );

/**
 * 本文からの抜粋機能をカスタマイズします。
 */
// 抜粋字数を指定する
/**
 * Adjusts the excerpt length based on the page type.
 *
 * @param int $length The current excerpt length.
 *
 * @return int The modified excerpt length.
 */
function custom_excerpt_length( $length ) {
	if ( is_home() || is_front_page() ) {
		$return = 45;
	} else {
		$return = 100;
	}
	return $return;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// 本文からの抜粋末尾の文字列を指定する
/**
 * Customizes the string appended to excerpts.
 *
 * @param string $more The current excerpt suffix.
 *
 * @return string The modified excerpt suffix.
 */
function custom_excerpt_more( $more ) {
	return '・・・';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

/**
 * テキストエディタにフォントサイズ変更ボタンを追加します。
 *
 * @param array $editor_buttons 現在のエディタボタンの配列。
 *
 * @return array 更新されたエディタボタンの配列。
 */
function editor_add_buttons( $editor_buttons ) {
	array_push( $editor_buttons, 'fontsizeselect' );
	return $editor_buttons;
}
add_filter( 'mce_buttons', 'editor_add_buttons' );

/**
 * フォントサイズ変更ボタンを％指定に変更します。
 *
 * @param array $settings 現在のTinyMCE設定の配列。
 *
 * @return array 更新された設定の配列。
 */
function customize_tinymce_settings( $settings ) {
	$settings['fontsize_formats'] = '50% 75% 100% 150% 200%';
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'customize_tinymce_settings' );

/**
 * WordPressの不要な記述を削除します。
 *
 * @return void
 */
function disable_emoji() {
	// 特殊記号　画像変換を停止
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	// 短縮URLの表示を停止
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	// 前後の記事URLの表示を停止
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
	// Windows Live Writer とのリンクを停止
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// RSDのリンクを停止
	remove_action( 'wp_head', 'rsd_link' );
}
add_action( 'init', 'disable_emoji' );

/**
 * 投稿画面のカテゴリの順番を変更しないようにします。
 *
 * @param array $args    カテゴリの引数。
 * @param int   $post_id 投稿のID。
 *
 * @return array 更新された引数の配列。
 */
function my_wp_terms_checklist_args( $args, $post_id ) {
	$args['checked_ontop'] = false;
	return $args;
}
add_filter( 'wp_terms_checklist_args', 'my_wp_terms_checklist_args', 10, 2 );

/**
 * クエリのデフォルト動作を変更します。
 *
 * @param WP_Query $query クエリオブジェクト。
 *
 * @return void
 */
function my_default_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( is_post_type_archive( 'cast' ) ) {
		$query->set( 'nopaging', true );
		$query->set( 'post_status', 'publish' );
		return;
	}
	if ( is_post_type_archive( 'cosplay' ) ) {
		$query->set( 'nopaging', true );
		$query->set( 'post_status', 'publish' );
		return;
	}
}
add_action( 'pre_get_posts', 'my_default_query', 1 );

/**
 * 自動保存機能を無効化します。
 *
 * @return void
 */
function disable_autosave() {
	wp_deregister_script( 'autosave' );
}
add_action( 'wp_print_scripts', 'disable_autosave' );

/**
 * セキュリティ関連のカスタマイズを行います。
 */
// WordPressバージョン情報を消す
/**
 * Removes the WordPress version information from the head section.
 *
 * @return void
 */
function remove_wp_version() {
	remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'remove_wp_version' );

// 不要なページを無効化
/**
 * Disables specific pages such as search, author, and attachment pages.
 *
 * @param WP_Query $query The query object.
 *
 * @return void
 */
function remove_page_view( $query ) {
	// 関数名を変更
	if ( ! is_admin() ) {
		if ( is_search() || is_author() || is_attachment() ) {
			$query->set_404();
			status_header( 404 );
			nocache_headers();
		}
	}
}
add_filter( 'parse_query', 'remove_page_view' ); // フィルターフックの関数名も変更

/**
 * クッキーがない場合、クッションページにリダイレクトします。
 *
 * @return void
 */
function cushion_redirect() {

	if ( is_404() ) {

		return true;

	}

	if ( is_bot() ) {
		return true;
	}

	// 通常の記事ページのとき(castページは除く)
	if ( is_single() && ! is_singular( 'cast' ) ) {
		return true;
	}

	// 年齢認証ページは何もしない
	if ( is_page( 'cushion' ) ) {
		return true;
	}

	// getパラメータにvisited=trueがあればクッキー付与する
	if ( isset( $_GET['visited'] ) && 'true' === $_GET['visited'] ) {
		setcookie( 'visited', 'true', time() + 86400, '/' );
		return true;
	}

	// クッキーがあれば更新する
	if ( isset( $_COOKIE['visited'] ) ) {
		setcookie( 'visited', 'true', time() + 86400, '/' );
		return true;
	}

	// 年齢認証ページにリダイレクト
	$current_page = get_permalink();
	$current_page = parse_url( $current_page, PHP_URL_PATH );
	wp_redirect( home_url( '/cushion?redirect=' . $current_page ) );
	exit;
}
add_action( 'template_redirect', 'cushion_redirect' );

/**
 * テーマ有効時に自動で固定ページを作成します。
 *
 * @return void
 */
function auto_create_page() {
	$new_page_args = array(
		// 'blog'=>'BLOG',
		// 'access'=>'アクセス',
		'create'        => 'ユーザー登録',
		'cushion'       => '年齢認証',
		'schedule'      => '出勤時間一覧',
		'schedule-next' => '出勤時間一覧－次週',
		'reserved'      => 'ご予約',
		'recruit'       => '応募フォーム',
		'ank'           => 'お客様アンケート',
		'rule'          => '免責事項',
		'price'         => '料金一覧',
		'room'          => 'お部屋のご案内',
		'privacy'       => 'プライバシーポリシー',
	);

	foreach ( $new_page_args as $slug => $title ) {
		$check    = get_page_by_path( $slug );
		$new_page = array(
			'post_type'   => 'page',
			'post_title'  => $title,
			'post_name'   => $slug,
			'post_status' => 'publish',
			'post_author' => 1,
		);
		if ( empty( $check->ID ) ) {
			$new_page_id = wp_insert_post( $new_page );
		}
	}
}
add_action( 'after_switch_theme', 'auto_create_page' );

require_once locate_template( 'inc/class-blastmail.php' );

// 予約完了メール送信後にメルマガ処理を行う
/**
 * Handles the mail sent event and processes the blast mail subscription.
 *
 * @param array $items  The items related to the mail event.
 * @param array $result The result of the mail event.
 *
 * @return array The modified items.
 */
function mail_sent_blast_mail( $items, $result ) {
	// multiple steps を使っている場合は、hidden でemailとmailmagazineを送信必要がある
	error_log( print_r( $_POST, true ) );

	if ( 'mail_sent' === $items['status'] ) {
		if (
			! empty( $_POST['_wpcf7'] )
			&& '137051' === $_POST['_wpcf7']
			&& ! empty( $_POST['mailmagazine'] )
			&& '希望する' === $_POST['mailmagazine']
		) {
			$blast_mail = new BlastMail();
			$blast_mail->subscribe( $_POST['email'], '新大久保店', '新大久保店', false );
		}
	}
	return $items;
}
add_action( 'wpcf7_ajax_json_echo', 'mail_sent_blast_mail', 10, 2 );

// メルマガ登録用ajaxエンドポイント
/**
 * Handles the subscription to the mail magazine via AJAX.
 *
 * @return void
 */
function subscribe_mailmagazine_ajax() {
	$email = $_POST['email'];
	error_log( 'Subscribe_Mailmagazine_ajax' );
	$blast_mail = new BlastMail();
	$blast_mail->subscribe( $email, '新大久保店', '', true );
	// success
	echo 'success';
	wp_die();
}
add_action( 'wp_ajax_subscribe_mailmagazine', 'subscribe_mailmagazine_ajax' );
add_action( 'wp_ajax_nopriv_subscribe_mailmagazine', 'subscribe_mailmagazine_ajax' );

// メルマガ解除用ajaxエンドポイント
/**
 * Handles the unsubscription from the mail magazine via AJAX.
 *
 * @return void
 */
function unsubscribe_mailmagazine_ajax() {
	$email      = $_POST['email'];
	$blast_mail = new BlastMail();
	$blast_mail->unsubscribe( $email, true );
	echo 'success';
	wp_die();
}
add_action( 'wp_ajax_unsubscribe_mailmagazine', 'unsubscribe_mailmagazine_ajax' );
add_action(
	'wp_ajax_nopriv_unsubscribe_mailmagazine',
	'unsubscribe_mailmagazine_ajax'
);

// REST API の初期化フック
add_action( 'rest_api_init', 'create_api_posts_meta_field' );

/**
 * Registers custom meta fields for REST API endpoints.
 *
 * Adds meta fields for specific post types to the REST API responses.
 *
 * @return void
 */
function create_api_posts_meta_field() {
	register_rest_field(
		'slider', // 投稿タイプ
		'meta_field', // これは任意のキー名
		array(
			'get_callback' => 'get_post_meta_for_api',
			'schema'       => null,
		)
	);
	register_rest_field(
		'cast', // 投稿タイプ
		'meta_field', // これは任意のキー名
		array(
			'get_callback' => 'get_post_meta_for_api',
			'schema'       => null,
		)
	);
	register_rest_field(
		'cast', // 投稿タイプ
		'shift', // これは任意のキー名
		array(
			'get_callback' => 'get_cast_shift_for_api',
			'schema'       => null,
		)
	);
}

// 取得（GET）時のオブジェクトにpostのメタをすべて追加
/**
 * Retrieves all post meta for the given post object.
 *
 * @param array $post_object The post object from the REST API.
 *
 * @return array The post meta data.
 */
function get_post_meta_for_api( $post_object ) {
	$post_id = $post_object['id'];
	return get_post_meta( $post_id );
}

/**
 * Retrieves the shift schedule for a cast member via the REST API.
 *
 * @param array $object The post object from the REST API.
 *
 * @return array|null The cast member's shift schedule or null if unavailable.
 */
function get_cast_shift_for_api( $post_object ) {
	return chance_get_cast_schedule( $post_object['id'] );
}

function get_field( $field_name ) {
	return get_post_meta( get_the_ID(), $field_name, true );
}


// Bogoの言語スイッチャーの国旗を非表示
add_filter( 'bogo_use_flags', 'bogo_use_flags_false' );
function bogo_use_flags_false() {
	return false;
}

add_filter(
	'bogo_language_switcher_links',
	function ( $links ) {
		for ( $i = 0; $i < count( $links ); $i++ ) {
			if ( 'ja' === $links[ $i ]['locale'] ) { //日本語の場合
				$links[ $i ]['title']       = '日本語ページ'; //JPが変更後のテキスト
				$links[ $i ]['native_name'] = '日本語ページ'; //JPが変更後のテキスト
			}
			if ( 'en_US' === $links[ $i ]['locale'] ) { //英語の場合
				$links[ $i ]['title']       = 'English page'; //ENが変更後のテキスト
				$links[ $i ]['native_name'] = 'English page'; //ENが変更後のテキスト
			}
		}
		return $links;
	}
);
// カスタム投稿をbogoに対応させる
function my_localizable_post_types( $localizable ) {
	$localizable[] = 'cast';
	$localizable[] = 'news';
	return $localizable;
}
add_filter( 'bogo_localizable_post_types', 'my_localizable_post_types', 10, 1 );

function is_ja() {
	return 'ja' === get_locale();
}

function is_en() {
	return 'ja' !== get_locale();
}

function text_switcher( $ja, $en ) {
	if ( is_ja() ) {
		return $ja;
	}
	return $en;
}

add_action( 'after_setup_theme', 'register_menu' );
function register_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
}

function create_menu_area() {
	register_nav_menu( 'footer_menu', 'フッター表示メニュー' );
}

add_action( 'after_setup_theme', 'create_menu_area' );


function ag_send_mail_smtp( $phpmailer ) {
	//ホスト名にlocalhostが含まれるとき
	if ( isset( $_SERVER['HTTP_HOST'] ) && strpos( $_SERVER['HTTP_HOST'], 'localhost' ) !== false ) {
		/* SMTP有効設定 */
		$phpmailer->isSMTP();
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->Host = 'mail';
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->SMTPAuth = false;
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->Port = '1025';
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->SMTPAuth = false;
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->SMTPDebug = 0;
	} else {
		$phpmailer->isMail();
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->Host = 'chance-yoyogi.jp';
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->SMTPAuth = true;
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->Username = 'info@chance-yoyogi.jp';
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->Password = 'z6xcQuTA9f6Rx9pM';
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->SMTPSecure = 'ssl';
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->Port = 465;
	}
}
add_action( 'phpmailer_init', 'ag_send_mail_smtp' );

/**
 * Contact Form 7の_mail / _mail_2が二重シリアライズされている場合の自動復元
 */
add_filter(
	'wpcf7_contact_form_properties',
	function( $properties, $contact_form ) {
		foreach ( array( 'mail', 'mail_2' ) as $prop ) {
			if ( isset( $properties[ $prop ] ) && is_string( $properties[ $prop ] ) ) {
				$unserialized = maybe_unserialize( $properties[ $prop ] );
				if ( is_array( $unserialized ) ) {
					$properties[ $prop ] = $unserialized;
				}
			}
		}
		return $properties;
	},
	10,
	2
);


// 予約フォームのメール１の本文をok

// function reserve_mail_body( $components, WPCF7_ContactForm $form, WPCF7_Mail $mail ) {
//  if ( 6 === $form->id() ) {
//      $submission         = WPCF7_Submission::get_instance();
//      $posted_data        = $submission ? $submission->get_posted_data() : array();
//      $customer_name      = isset( $posted_data['customerName'] ) ? $posted_data['your-name'] : 'お客様';
//      $components['body'] = '予約が完了しました。' . $customer_name;
//  }
//  return $components;
// }
// add_filter( 'wpcf7_mail_components', 'reserve_mail_body', 10, 3 );

/**
 * キャスト情報の表示設定
 *
 * @return bool
 */
function chance_enable_cast_info() {

	$show_cast_info = get_option( 'chance_show_cast_info', 1 );
	return 1 === ( (int) $show_cast_info );
}

function chance_eneble_phone_number() {
	$show_phone_number = get_option( 'chance_show_phone_number', 1 );
	return 1 === ( (int) $show_phone_number );
}

/**
 * staffロールにシフト管理に必要な権限を追加
 */
function add_staff_capabilities() {
	$role = get_role( 'staff' );
	if ( $role ) {
		$role->add_cap( 'manage_categories' );
		$role->add_cap( 'read' );
		$role->add_cap( 'edit_posts' );
	}
}
add_action( 'init', 'add_staff_capabilities' );
