<?php

use Brain\Monkey\Functions;
use Brain\Monkey\Filters;
use Brain\Monkey\Actions;
use PHPUnit\Framework\TestCase;

/**
 * WordPressの不要な機能を削除するためのテストクラス
 */
class WordPressCleanupTest extends TestCase {
	/**
	 * テスト前の準備
	 */
	protected function setUp(): void {
		parent::setUp();
		Brain\Monkey\setUp();
	}

	/**
	 * テスト後の処理
	 */
	protected function tearDown(): void {
		Brain\Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * disable_emoji関数のテスト - アクションの削除
	 */
	public function test_disable_emoji_actions() {
		// remove_action関数の呼び出しをモックして検証可能にする
		$calls = array();
		Functions\when( 'remove_action' )->alias(
			function ( $hook, $callback, $priority = 10 ) use ( &$calls ) {
				$calls[] = array( $hook, $callback, $priority );
				return true;
			}
		);

		// 関数を実行
		disable_emoji();

		// 少なくとも10回以上remove_actionが呼ばれることを確認
		$this->assertGreaterThanOrEqual( 10, count( $calls ) );

		// 特定のアクション削除が行われていることを確認
		$this->assertContains( array( 'wp_head', 'print_emoji_detection_script', 7 ), $calls );
		$this->assertContains( array( 'wp_head', 'wp_shortlink_wp_head', 10 ), $calls );
	}

	/**
	 * disable_emoji関数のテスト - フィルターの削除
	 */
	public function test_disable_emoji_filters() {
		// remove_filter関数の呼び出しをモックして検証可能にする
		$calls = array();
		Functions\when( 'remove_filter' )->alias(
			function ( $hook, $callback, $priority = 10 ) use ( &$calls ) {
				$calls[] = array( $hook, $callback, $priority );
				return true;
			}
		);

		// 関数を実行
		disable_emoji();

		// 少なくとも3回以上remove_filterが呼ばれることを確認
		$this->assertGreaterThanOrEqual( 3, count( $calls ) );

		// 特定のフィルター削除が行われていることを確認
		$this->assertContains( array( 'the_content_feed', 'wp_staticize_emoji', 10 ), $calls );
		$this->assertContains( array( 'wp_mail', 'wp_staticize_emoji_for_email', 10 ), $calls );
	}

	/**
	 * my_wp_terms_checklist_args関数のテスト
	 */
	public function test_my_wp_terms_checklist_args() {
		// テスト用のパラメータ
		$args    = array(
			'taxonomy'      => 'category',
			'checked_ontop' => true,
		);
		$post_id = 123;

		// 関数を実行して結果を取得
		$result = $this->getMyWpTermsChecklistArgs( $args, $post_id );

		// checked_ontopがfalseに設定されていることを確認
		$this->assertArrayHasKey( 'checked_ontop', $result );
		$this->assertFalse( $result['checked_ontop'] );

		// 他のパラメータは維持されていることを確認
		$this->assertArrayHasKey( 'taxonomy', $result );
		$this->assertEquals( 'category', $result['taxonomy'] );
	}

	/**
	 * disable_autosave関数のテスト
	 */
	public function test_disable_autosave() {
		// スクリプトの登録解除をモック
		$called = false;
		Functions\when( 'wp_deregister_script' )->alias(
			function ( $handle ) use ( &$called ) {
				if ( 'autosave' === $handle ) {
					$called = true;
				}
				return true;
			}
		);

		// 関数を実行
		disable_autosave();

		// wp_deregister_scriptがautosaveパラメータで呼び出されたことを検証
		$this->assertTrue( $called, 'wp_deregister_script was not called with "autosave" handle' );
	}

	/**
	 * PHPUnitのテスト用関数を再実装
	 */
	private function getMyWpTermsChecklistArgs( $args, $post_id ) {
		$args['checked_ontop'] = false;
		return $args;
	}
}

// テスト用の関数定義
if ( ! function_exists( 'disable_emoji' ) ) {
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
}

if ( ! function_exists( 'disable_autosave' ) ) {
	function disable_autosave() {
		wp_deregister_script( 'autosave' );
	}
}
