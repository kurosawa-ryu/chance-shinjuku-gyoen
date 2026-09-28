<?php

/***********************************************************
 * カスタム投稿
 ***********************************************************/
//カスタムフィールドを追加
add_action( 'admin_menu', 'add_mycustom_fields' );
add_action( 'save_post', 'save_mycustom_fields' );

//カスタム投稿タイプでカスタムフィールドを表示
function add_mycustom_fields() {
	add_meta_box( 'my_sectionid', 'コンテンツ', 'cosplay_custom_fields', 'cosplay' );
}

//カスタムフィールドの値をチェック
function save_mycustom_data( $key, $post_id ) {
	if ( isset( $_POST['custom_data'][ $key ] ) ) {
		$data = $_POST['custom_data'][ $key ];
	} else {
		$data = '';
	}

	//-1になると項目が変わったことになるので、項目を更新する
	if ( strcmp( $data, get_post_meta( $post_id, $key, true ) ) !== 0 ) {
		update_post_meta( $post_id, $key, $data );
	} elseif ( '' === $data ) {
		delete_post_meta( $post_id, $key, get_post_meta( $post_id, $key, true ) );
	}
}

//カスタムフィールドの値を保存
function save_mycustom_fields( $post_id ) {
	global $post;
	if ( isset( $_POST['custom_data'] ) && '1' === $_POST['custom_data_flg'] ) {
		foreach ( $_POST['custom_data'] as $key => $value ) {
			if ( is_array( $value ) ) {
				update_post_meta( $post_id, $key, $value );
			} else {
				save_mycustom_data( $key, $post_id );
			}
		}
	}
	if ( is_array( $post ) ) {
		$post = $post[0];
	}
	$extend_edit_field_noncename = filter_input( INPUT_POST, 'extend_edit_field_noncename' );
	if ( $post && isset( $post->ID ) && ! wp_verify_nonce( $extend_edit_field_noncename, plugin_basename( __FILE__ ) ) ) {
		return $post->ID;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
}


// カスタム投稿 コスプレ
add_action( 'init', 'codex_cosplay_init' );
function codex_cosplay_init() {
	$labels = array(
		'name'               => _x( 'コスプレ', 'post type general name' ),
		'singular_name'      => _x( 'コスプレ', 'post type singular name' ),
		'menu_name'          => _x( 'コスプレ', 'admin menu' ),
		'add_new'            => _x( '新規追加', 'cosplay' ),
		'add_new_item'       => __( '新規追加' ),
		'edit_item'          => __( 'コスプレを編集' ),
		'new_item'           => __( 'コスプレ' ),
		'view_item'          => __( 'コスプレを見る' ),
		'all_items'          => __( 'コスプレ一覧' ),
		'search_items'       => __( 'コスプレを探す' ),
		'not_found'          => __( 'コスプレはありません' ),
		'not_found_in_trash' => __( 'コスプレはありません' ),
		'parent_item_colon'  => '',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'sbulletin_ui'       => true,
		'sbulletin_in_menu'  => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_icon'          => 'dashicons-format-image',
		'menu_position'      => 25,
		//'taxonomies'=>array('cosplay_category','cosplay_tag'),
		//'supports' => array( 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats' )
		'supports'           => array( 'title', 'thumbnail' ),
	);
	register_post_type( 'cosplay', $args );
}

// カスタムフィールド コスプレ
function cosplay_custom_fields() {
	global $post;
	if ( is_array( $post ) ) {
		$post = $post[0];
	}
	$pay      = get_post_meta( $post->ID, 'cosplay_pay', true );
	$text     = get_post_meta( $post->ID, 'cosplay_text', true );
	$title_en = get_post_meta( $post->ID, 'cosplay_title_en', true );

	echo '<input type="hidden" name="custom_data_flg" value="1">';
	echo <<<__HTML__
<table class="table table_noborder">
	<tr>
		<th style="width:100px;">英語版タイトル</th>
		<td><input type="text" name="custom_data[cosplay_title_en]" value="{$title_en}" class="form-control"></td>
	</tr>
	<tr>
		<th style="width:70px;">値段</th>
		<td><input type="text" name="custom_data[cosplay_pay]" value="{$pay}" class="form-control"></td>
	</tr>
	<tr>
		<th>コメント</th>
		<td><input type="text" name="custom_data[cosplay_text]" value="{$text}" class="form-control"></td>
	</tr>
</table>
__HTML__;
}


// 下書きのpost_IDを取得
function get_preview_id( $post_id ) {
	global $post;
	$preview_id = 0;
	if ( is_array( $post ) ) {
		$post = $post[0];
	}
	if ( isset( $post ) && $post->ID === $post_id && is_preview() ) {
		$preview = wp_get_post_autosave( $post->ID );
		if ( $preview ) {
			$preview_id = $preview->ID;
		}
	}
	return $preview_id;
}

// プレビュー時、meta情報をプレビュー用のmeta情報に置き換え
function get_preview_postmeta( $meta_value, $post_id, $meta_key, $single ) {
	$preview_id = get_preview_id( $post_id );
	if ( $preview_id ) {
		if ( $post_id !== $preview_id ) {
			$meta_value = get_post_meta( $preview_id, $meta_key, $single );
		}
	}
	return $meta_value;
}
add_filter( 'get_post_metadata', 'get_preview_postmeta', 10, 4 );

// カスタムフィールドテンプレートの送信形式による値を取得してプレビューのmeta情報を書き換え
function save_preview_postmeta( $post_ID ) {
	global $wpdb;

	if ( wp_is_post_revision( $post_ID ) ) {

		if ( ! empty( $_REQUEST['custom_data'] ) && is_array( $_REQUEST['custom_data'] ) ) {
			foreach ( $_REQUEST['custom_data'] as $key => $val ) {
				add_metadata( 'post', $post_ID, $key, maybe_serialize( $val ) );
			}
		}

		do_action( 'save_preview_postmeta', $post_ID );
	}
}
add_action( 'wp_insert_post', 'save_preview_postmeta' );



// メタボックスを追加するアクションフックを定義
add_action( 'add_meta_boxes', 'my_custom_editor_meta_box' );

// メタボックスを追加するコールバック関数
function my_custom_editor_meta_box() {

	// 投稿タイプを'post'に指定してメタボックスを追加
	add_meta_box(
		'my_custom_editor_meta_box', // メタボックスのID
		'マネージャーコメント', // メタボックスのタイトル
		'custom_editor_metabox_callback', // コールバック関数
		'cast', // メタボックスを追加する投稿タイプ
		'normal', // メタボックスの位置（'normal', 'side', 'advanced'のいずれか）
		'default' // メタボックスの優先度（'high', 'core', 'default', 'low'のいずれか）
	);
}

// カスタムエディターを表示するコールバック関数
function custom_editor_metabox_callback( $post ) {
	// メタボックス内のエディターを出力する関数を呼び出す
	wp_nonce_field( basename( __FILE__ ), 'custom_editor_manager_comment' );

	// 現在の値を取得する方法は、投稿のメタデータから行う必要がある
	$current_value = get_post_meta( $post->ID, 'am-commentManager', true );

	// エディターを出力
	wp_editor( htmlspecialchars_decode( $current_value ), 'am-commentManager', $settings = array( 'textarea_rows' => 20 ) );
}


//
function save_custom_product_metabox( $post_id, $post ) {
	// nonceが設定されているかどうかを確認し、nonceが有効かを検証する
	if ( ! isset( $_POST['custom_editor_manager_comment'] ) || ! wp_verify_nonce( $_POST['custom_editor_manager_comment'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// ユーザーの権限を確認
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// データをデータベースに保存
	$new_value = $_POST['am-commentManager'];

	update_post_meta( $post_id, 'am-commentManager', htmlspecialchars_decode( $new_value ) );
}
add_action( 'save_post', 'save_custom_product_metabox', 10, 2 );

// ニュース投稿タイプ用の英語版本文メタボックスを追加
add_action( 'add_meta_boxes', 'news_english_content_meta_box' );

function news_english_content_meta_box() {
	add_meta_box(
		'news_english_content_meta_box',
		'英語版本文',
		'news_english_content_metabox_callback',
		'news',
		'normal',
		'high'
	);
}

// 英語版本文エディターを表示するコールバック関数
function news_english_content_metabox_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'news_english_content_nonce' );

	// 現在の値を取得
	$english_content = get_post_meta( $post->ID, 'news_english_content', true );

	// エディターを出力
	wp_editor(
		htmlspecialchars_decode( $english_content ),
		'news_english_content',
		array(
			'textarea_rows' => 15,
			'media_buttons' => true,
			'textarea_name' => 'news_english_content',
		)
	);
}

// 英語版本文を保存する関数
function save_news_english_content_metabox( $post_id, $post ) {
	// nonceの確認
	if ( ! isset( $_POST['news_english_content_nonce'] ) || ! wp_verify_nonce( $_POST['news_english_content_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// 自動保存時は何もしない
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// 権限の確認
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// newsタイプの投稿のみ処理
	if ( 'news' !== $post->post_type ) {
		return $post_id;
	}

	// データを保存
	if ( isset( $_POST['news_english_content'] ) ) {
		$english_content = $_POST['news_english_content'];
		update_post_meta( $post_id, 'news_english_content', $english_content );
	}
}
add_action( 'save_post', 'save_news_english_content_metabox', 10, 2 );

// キャスト用の英語版コンテンツメタボックスを追加
add_action( 'add_meta_boxes', 'cast_english_content_meta_box' );

function cast_english_content_meta_box() {
	add_meta_box(
		'cast_english_content_meta_box',
		'英語版コンテンツ',
		'cast_english_content_metabox_callback',
		'cast',
		'normal',
		'low'
	);
}

// キャスト英語版コンテンツエディターを表示するコールバック関数
function cast_english_content_metabox_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'cast_english_content_nonce' );

	// 現在の値を取得
	$intro_en           = get_post_meta( $post->ID, 'cast_introduction_en', true );
	$manager_comment_en = get_post_meta( $post->ID, 'cast_manager_comment_en', true );
	$boy_review_en      = get_post_meta( $post->ID, 'cast_boy_review_en', true );
	?>
	<style>
		.cast-english-fields th {
			vertical-align: top;
			padding-top: 10px;
			width: 150px;
		}
		.cast-english-fields td {
			padding-bottom: 20px;
		}
	</style>
	<table class="form-table cast-english-fields">
		<tr>
			<th><label for="cast_introduction_en">自己紹介文（英語版）</label></th>
			<td>
				<?php
				wp_editor(
					htmlspecialchars_decode( $intro_en ),
					'cast_introduction_en',
					array(
						'textarea_rows' => 10,
						'media_buttons' => true,
						'textarea_name' => 'cast_introduction_en',
					)
				);
				?>
			</td>
		</tr>
		<tr>
			<th><label for="cast_manager_comment_en">マネージャーコメント（英語版）</label></th>
			<td>
				<?php
				wp_editor(
					htmlspecialchars_decode( $manager_comment_en ),
					'cast_manager_comment_en',
					array(
						'textarea_rows' => 10,
						'media_buttons' => true,
						'textarea_name' => 'cast_manager_comment_en',
					)
				);
				?>
			</td>
		</tr>
		<tr>
			<th><label for="cast_boy_review_en">ボーイレビュー（英語版）</label></th>
			<td>
				<?php
				wp_editor(
					htmlspecialchars_decode( $boy_review_en ),
					'cast_boy_review_en',
					array(
						'textarea_rows' => 10,
						'media_buttons' => true,
						'textarea_name' => 'cast_boy_review_en',
					)
				);
				?>
			</td>
		</tr>
	</table>
	<?php
}

// キャスト英語版コンテンツを保存する関数
function save_cast_english_content_metabox( $post_id, $post ) {
	// nonceの確認
	if ( ! isset( $_POST['cast_english_content_nonce'] ) || ! wp_verify_nonce( $_POST['cast_english_content_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// 自動保存時は何もしない
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// 権限の確認
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// castタイプの投稿のみ処理
	if ( 'cast' !== $post->post_type ) {
		return $post_id;
	}

	// データを保存
	if ( isset( $_POST['cast_introduction_en'] ) ) {
		update_post_meta( $post_id, 'cast_introduction_en', $_POST['cast_introduction_en'] );
	}
	if ( isset( $_POST['cast_manager_comment_en'] ) ) {
		update_post_meta( $post_id, 'cast_manager_comment_en', $_POST['cast_manager_comment_en'] );
	}
	if ( isset( $_POST['cast_boy_review_en'] ) ) {
		update_post_meta( $post_id, 'cast_boy_review_en', $_POST['cast_boy_review_en'] );
	}
}
add_action( 'save_post', 'save_cast_english_content_metabox', 10, 2 );

// 英語版の対応
function custom_cast_rewrite_rules() {
	// 英語版のリライトルール
	add_rewrite_rule(
		'^en/cast/([^/]+)/?$',
		'index.php?post_type=cast&name=$matches[1]&lang=en',
		'top'
	);

	// 日本語版のリライトルール
	add_rewrite_rule(
		'^cast/([^/]+)/?$',
		'index.php?post_type=cast&name=$matches[1]&lang=ja',
		'top'
	);

	// 英語一覧ページのリライトルール
	add_rewrite_rule(
		'^en/cast/?$',
		'index.php?post_type=cast&lang=en',
		'top'
	);

	// 日本語一覧ページのリライトルール
	add_rewrite_rule(
		'^cast/?$',
		'index.php?post_type=cast&lang=ja',
		'top'
	);
}
	add_action( 'init', 'custom_cast_rewrite_rules' );

	// クエリ変数を追加
function add_lang_query_var( $vars ) {
	$vars[] = 'lang';
	return $vars;
}
	add_filter( 'query_vars', 'add_lang_query_var' );

	// テンプレートの言語に応じた処理
function cast_template_redirect() {
	if ( is_singular( 'cast' ) ) {
		$lang = get_query_var( 'lang' );
		if ( 'en' === $lang ) {
			// 英語版の処理
			load_template( get_template_directory() . '/single-cast-en.php' );
			exit;
		}
	}

	if ( is_post_type_archive( 'cast' ) ) {
		$lang = get_query_var( 'lang' );
		if ( 'en' === $lang ) {
			load_template( get_template_directory() . '/archive-cast-en.php' );
			exit;
		}
	}
}
	add_action( 'template_redirect', 'cast_template_redirect' );
