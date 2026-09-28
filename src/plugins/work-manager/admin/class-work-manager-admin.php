<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       worldagent.jp
 * @since      1.0.0
 *
 * @package    Work_Manager
 * @subpackage Work_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Work_Manager
 * @subpackage Work_Manager/admin
 * @author     World Agent <test@worldagent.jp>
 */
class Work_Manager_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/work-manager-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {

		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/work-manager-admin.js', array( 'jquery-ui-sortable' ), $this->version, true );
	}

	/**
	 * 管理メニューを追加する
	 */
	public function schedule_menu() {
		add_menu_page(
			'出勤管理システム',
			'出勤管理表',
			'manage_categories',
			'schedule_main_menu',
			array( $this, 'schedule_viewer' ),
			'dashicons-media-document'
		);

		//出勤情報表示(週別)
		add_submenu_page(
			'schedule_main_menu',
			'登録',
			'登録',
			'manage_categories',
			'schedule_sub_menu_3',
			array( $this, 'schedule_edit' )
		);

		// WordPress標準の「設定」メニューに「店舗設定」サブメニューを追加
		if ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) ) {
			add_options_page(
				'店舗設定', // page_title
				'店舗設定', // menu_title
				'manage_categories', // capability
				'work-manager-store-settings', // menu_slug
				array( $this, 'schedule_setting' ) // callback function
			);
		}
	}

	/**
	 * カスタム投稿タイプ
	 */
	public function add_post_type() {
		// キャスト
		$labels = array(
			'name'               => 'キャスト',
			'singular_name'      => 'キャスト',
			'menu_name'          => 'キャスト',
			'add_new_item'       => '新しいキャスト',
			'add_new'            => 'キャスト追加',
			'new_item'           => '一覧ページの「新規追加」ボタンのラベル',
			'edit_item'          => '編集',
			'view_item'          => '編集',
			'search_items'       => 'コラムの検索',
			'not_found'          => '見つかりません。',
			'not_found_in_trash' => 'ゴミ箱にはありません。',
		);
		$args   = array(
			'labels'              => $labels,
			'descriptions'        => 'キャストの概要',
			'hierarchical'        => false,
			'public'              => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		);
		register_post_type( 'cast', $args );

		// ニュース
		$labels['name']          = 'ニュース';
		$labels['singular_name'] = 'ニュース';
		$labels['menu_name']     = 'ニュース';
		$labels['add_new_item']  = '新しいニュース';
		$labels['add_new']       = 'ニュース追加';
		$args['labels']          = $labels;
		$args['descriptions']    = 'ニュースの概要';
		register_post_type( 'news', $args );

		$args = array(
			'labels'              => array(),
			'public'              => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			// 'show_ui' => false,
			// 'show_in_nav_menus' => false,
			// 'show_in_menu' => false,
			'query_var'           => true,
			'capability_type'     => 'post',
			//'has_archive' => true,
			'hierarchical'        => false,
			'menu_position'       => null,
			// 'supports' => array()
			'show_in_rest'        => true,
			'supports'            => array( 'title', 'editor', 'custom-fields' ),
		);
		register_post_type( 'skd', $args );
	}

	/**
	 * カスタムフィールド
	 */
	public function add_custom_inputbox() {
		// オプションが存在しない場合のデフォルト値を 'cast' とする
		$cast_post_type = get_option( 'cast_post_type_plugin_value', 'cast' );
		add_meta_box( 'myupload', 'アイテム画像', array( $this, 'img_upload_postmeta' ), $cast_post_type, 'side', 'low' );
		add_meta_box( 'my_cast_info', 'キャスト情報', array( $this, 'custom_data_postmeta' ), $cast_post_type, 'normal' );

		// オプションが存在しない場合のデフォルト値を 'news' とする
		$news_post_type = get_option( 'news_post_type_plugin_value', 'news' );
		add_meta_box( 'myupload', 'アイテム画像', array( $this, 'img_upload_postmeta' ), $news_post_type, 'side', 'low' );
	}

	/**
	 * 画像アップロードのデータ更新・保存と削除
	 */
	public function save_myupload_postmeta( $post_id ) {
			// nonceがセットされているかどうか確認
		if ( ! isset( $_POST['myupload_postmeta_nonce'] ) ) {
			return;
		}
			// nonceが正しいかどうか検証
		if ( ! wp_verify_nonce( $_POST['myupload_postmeta_nonce'], 'img-upload-postmeta.php' ) ) {
			return;
		}
			// 自動保存の場合はなにもしない
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
			// ユーザー権限の確認
		if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
			/* 安全が確認できたのでデータを保存する */
			$new_images = ( isset( $_POST['myupload_images'] ) ) ? $_POST['myupload_images'] : null; //POSTされたデータ
			$ex_images  = get_post_meta( $post_id, 'myupload_images', true ); //DBのデータ
		if ( $ex_images !== $new_images ) {
			if ( $new_images ) {
					update_post_meta( $post_id, 'myupload_images', $new_images ); // アップデート
			} else {
					delete_post_meta( $post_id, 'myupload_images', $ex_images );
			}
		}
	}

	/**
	 * カスタムフィールドのデータ更新・保存と削除
	 */
	public function save_custom_postdata( $post_id ) {
		if ( isset( $_POST['custom_data'] ) && '1' === $_POST['custom_data_flg'] ) {
			foreach ( $_POST['custom_data'] as $key => $value ) {
				if ( ! empty( $value ) ) {
					update_post_meta( $post_id, $key, $value );
				} else {
					$meta_value = get_post_meta( $post_id, $key, true );
					if ( ! empty( $meta_value ) ) {
						delete_post_meta( $post_id, $key, $meta_value );
					}
				}
			}
		}
	}

	/**
	 * データベースの古いレコードを削除
	 */
	public function delete_old_record() {
		global $wpdb;
		$limit   = strtotime( '-1 year' );
		$results = $wpdb->get_results(
			"
			SELECT ID,post_name
			FROM $wpdb->posts
			WHERE post_type='skd'
			"
		);
		if ( ! empty( $results ) ) {

			foreach ( $results as $result ) {
				$name = $result->post_name;
				$num  = strrpos( $name, '-' );
				$rest = substr( $name, 0, $num );
				if ( strtotime( $rest ) < $limit ) {
					wp_delete_post( $result->ID, true );
				}
			}
		}
		/*$results = $wpdb->get_results(
			"
			SELECT ID
			FROM $wpdb->posts
			WHERE post_type='post'
				OR post_type='revision'
			"
		);
		if( !empty($results) ){

			foreach( $results as $result ){
				wp_delete_post( $result->ID, true );
			}

		}*/
	}

	/**
	 * 管理画面に表示するtemplateを指定
	 */
	public function schedule_viewer() {

		require_once plugin_dir_path( __DIR__ ) . 'admin/partials/schedule-viewer.php';
	}
	public function schedule_edit() {

		require_once plugin_dir_path( __DIR__ ) . 'admin/partials/schedule-edit.php';
	}
	public function schedule_setting() {
		include plugin_dir_path( __FILE__ ) . 'partials/store-settings.php';
	}
	public function img_upload_postmeta() {

		require_once plugin_dir_path( __DIR__ ) . 'admin/partials/img-upload-postmeta.php';
	}
	public function custom_data_postmeta() {

		require_once plugin_dir_path( __DIR__ ) . 'admin/partials/custom-data-postmeta.php';
	}
}
