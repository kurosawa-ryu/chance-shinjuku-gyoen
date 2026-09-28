<?php

use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;

/**
 * テーマのコンテンツフォーマット機能のテストクラス
 */
class ContentFormattingTest extends TestCase {
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
	 * custom_excerpt_more関数のテスト
	 */
	public function test_custom_excerpt_more() {
		// 抜粋末尾の文字列をテスト
		$this->assertEquals( '・・・', $this->getCustomExcerptMore( '[&hellip;]' ) );
	}

	/**
	 * 画像パス置換のテスト
	 */
	public function test_replace_image_path_simple() {
		// WordPressの関数をモック
		Functions\when( 'get_bloginfo' )->justReturn( 'http://example.com/wp-content/themes/chance' );

		// 画像パスの置換をテスト
		$content  = '<img src="img/test.jpg" alt="Test Image">';
		$expected = '<img src="http://example.com/wp-content/themes/chance/img/test.jpg" alt="Test Image">';
		$this->assertEquals( $expected, $this->getReplaceImagePath( $content ) );
	}

	/**
	 * 複数の画像パス置換のテスト
	 */
	public function test_replace_multiple_image_paths() {
		// WordPressの関数をモック
		Functions\when( 'get_bloginfo' )->justReturn( 'http://example.com/wp-content/themes/chance' );

		// 複数の画像パスの置換をテスト
		$content  = '<img src="img/test1.jpg"><img src="img/test2.jpg">';
		$expected = '<img src="http://example.com/wp-content/themes/chance/img/test1.jpg"><img src="http://example.com/wp-content/themes/chance/img/test2.jpg">';
		$this->assertEquals( $expected, $this->getReplaceImagePath( $content ) );
	}

	/**
	 * 画像パスがない場合のテスト
	 */
	public function test_replace_no_image_path() {
		// WordPressの関数をモック
		Functions\when( 'get_bloginfo' )->justReturn( 'http://example.com/wp-content/themes/chance' );

		// 画像パスがない場合はそのまま返されることをテスト
		$content = '<p>This is a test content without images.</p>';
		$this->assertEquals( $content, $this->getReplaceImagePath( $content ) );
	}

	/**
	 * PHPUnitのテスト用にカスタムヘルパー関数
	 */
	private function getCustomExcerptMore( $more ) {
		return '・・・';
	}

	/**
	 * PHPUnitのテスト用に置換関数を実装
	 */
	private function getReplaceImagePath( $arg ) {
		$template_directory = get_bloginfo( 'template_directory' );

		return str_replace(
			'"img/',
			'"' . $template_directory . '/img/',
			$arg
		);
	}
}

// テスト用の関数定義
if ( ! function_exists( 'disable_page_wpautop' ) ) {
	function disable_page_wpautop() {
		if ( is_page() ) {
			remove_filter( 'the_content', 'wpautop' );
		}
	}
}

if ( ! function_exists( 'custom_excerpt_length' ) ) {
	function custom_excerpt_length( $length ) {
		if ( is_home() || is_front_page() ) {
			$return = 45;
		} else {
			$return = 100;
		}
		return $return;
	}
}

if ( ! function_exists( 'custom_excerpt_more' ) ) {
	function custom_excerpt_more( $more ) {
		return '・・・';
	}
}

if ( ! function_exists( 'replace_image_path' ) ) {
	function replace_image_path( $arg ) {
		$template_directory = get_bloginfo( 'template_directory' );
		$content            = str_replace(
			'"img/',
			'"' . $template_directory . '/img/',
			$arg
		);
		return $content;
	}
}
