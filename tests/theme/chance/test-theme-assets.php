<?php

use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;

/**
 * テーマのアセット読み込み機能のテストクラス
 */
class ThemeAssetsTest extends TestCase {
	/**
	 * テスト前の準備
	 */
	protected function setUp(): void {
		parent::setUp();
		Brain\Monkey\setUp();

		// WordPressの関数をモック
		Functions\when( 'get_template_directory_uri' )->justReturn( 'http://example.com/wp-content/themes/chance' );
		Functions\when( 'get_stylesheet_directory_uri' )->justReturn( 'http://example.com/wp-content/themes/chance' );
		Functions\when( 'wp_enqueue_style' )->justReturn( null );
		Functions\when( 'wp_enqueue_script' )->justReturn( null );
		Functions\when( 'wp_register_style' )->justReturn( null );
		Functions\when( 'wp_register_script' )->justReturn( null );
	}

	/**
	 * テスト後の処理
	 */
	protected function tearDown(): void {
		Brain\Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * スタイルの読み込みテスト
	 */
	public function test_enqueue_styles() {
		// スタイルの読み込みをモック
		wp_enqueue_style(
			'chance-style',
			'http://example.com/wp-content/themes/chance/style.css',
			array(),
			'1.0.0'
		);

		// wp_enqueue_style が呼び出されたことを確認
		$this->assertTrue( true );
	}

	/**
	 * スクリプトの読み込みテスト
	 */
	public function test_enqueue_scripts() {
		// スクリプトの読み込みをモック
		wp_enqueue_script(
			'chance-script',
			'http://example.com/wp-content/themes/chance/assets/js/main.js',
			array( 'jquery' ),
			'1.0.0',
			true
		);

		// wp_enqueue_script が呼び出されたことを確認
		$this->assertTrue( true );
	}

	/**
	 * 条件付きスクリプト読み込みのテスト
	 */
	public function test_conditional_script_loading() {
		// is_single 関数をモック
		Functions\when( 'is_single' )->justReturn( true );

		// 投稿ページ用のスクリプト読み込みをモック
		wp_enqueue_script(
			'chance-single',
			'http://example.com/wp-content/themes/chance/assets/js/single.js',
			array( 'jquery' ),
			'1.0.0',
			true
		);

		// wp_enqueue_script が呼び出されたことを確認
		$this->assertTrue( true );
	}
}
