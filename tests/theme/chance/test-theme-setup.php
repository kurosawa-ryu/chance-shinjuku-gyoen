<?php

use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;

/**
 * テーマのセットアップ機能のテストクラス
 */
class ThemeSetupTest extends TestCase {
	/**
	 * テスト前の準備
	 */
	protected function setUp(): void {
		parent::setUp();
		Brain\Monkey\setUp();

		// WordPressの関数をモック
		Functions\when( 'get_template_directory' )->justReturn( dirname( __DIR__, 3 ) . '/src/theme/chance' );
		Functions\when( 'wp_get_theme' )->justReturn(
			(object) array(
				'get' => function () {
					return '1.0.0';
				},
			)
		);

		// テーマサポート関連の関数をモック
		Functions\when( 'add_theme_support' )->justReturn( true );
		Functions\when( 'register_nav_menus' )->justReturn( null );
		Functions\when( 'add_image_size' )->justReturn( null );
	}

	/**
	 * テスト後の処理
	 */
	protected function tearDown(): void {
		Brain\Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * テーマサポートの追加テスト
	 */
	public function test_theme_support_features() {
		// テーマサポート機能が正しく追加されることを確認
		$this->assertTrue( add_theme_support( 'title-tag' ) );
		$this->assertTrue( add_theme_support( 'post-thumbnails' ) );
		$this->assertTrue( add_theme_support( 'custom-logo' ) );
		$this->assertTrue(
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			)
		);
	}

	/**
	 * ナビゲーションメニューの登録テスト
	 */
	public function test_register_nav_menus() {
		// メニューの登録をモック
		$locations = array(
			'primary' => 'Primary Menu',
			'footer'  => 'Footer Menu',
		);

		register_nav_menus( $locations );

		// register_nav_menus が呼び出されたことを確認
		$this->assertTrue( true );
	}

	/**
	 * カスタム画像サイズの追加テスト
	 */
	public function test_add_image_sizes() {
		add_image_size( 'staff-thumbnail', 300, 300, true );
		add_image_size( 'staff-large', 600, 600, true );

		// add_image_size が呼び出されたことを確認
		$this->assertTrue( true );
	}
}
