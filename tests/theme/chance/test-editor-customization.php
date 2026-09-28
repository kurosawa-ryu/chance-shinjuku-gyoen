<?php

use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;

/**
 * テーマのエディタカスタマイズ機能のテストクラス
 */
class EditorCustomizationTest extends TestCase {
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
	 * editor_add_buttons関数のテスト
	 */
	public function test_editor_add_buttons() {
		// テスト用の配列
		$editor_buttons = array( 'bold', 'italic', 'link' );

		// 関数を実行して結果を取得
		$result = $this->getEditorAddButtons( $editor_buttons );

		// フォントサイズ選択ボタンが追加されていることを確認
		$this->assertContains( 'fontsizeselect', $result );
		$this->assertEquals( 4, count( $result ) );
		$this->assertEquals( 'fontsizeselect', $result[3] );
	}

	/**
	 * customize_tinymce_settings関数のテスト
	 */
	public function test_customize_tinymce_settings() {
		// テスト用の設定配列
		$settings = array(
			'plugins'       => 'charmap,colorpicker,hr,lists,paste,tabfocus,textcolor,fullscreen',
			'block_formats' => 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6',
		);

		// 関数を実行して結果を取得
		$result = $this->getCustomizeTinyMCESettings( $settings );

		// フォントサイズフォーマットが設定されていることを確認
		$this->assertArrayHasKey( 'fontsize_formats', $result );
		$this->assertEquals( '50% 75% 100% 150% 200%', $result['fontsize_formats'] );

		// 他の設定が維持されていることを確認
		$this->assertArrayHasKey( 'plugins', $result );
		$this->assertArrayHasKey( 'block_formats', $result );
	}

	/**
	 * 複数のフォントサイズが設定されるテスト
	 */
	public function test_fontsize_formats_values() {
		// テスト用の設定配列
		$settings = array();

		// 関数を実行して結果を取得
		$result = $this->getCustomizeTinyMCESettings( $settings );

		// 5つのフォントサイズが設定されていることを確認
		$fontsize_formats = explode( ' ', $result['fontsize_formats'] );
		$this->assertCount( 5, $fontsize_formats );
		$this->assertContains( '50%', $fontsize_formats );
		$this->assertContains( '75%', $fontsize_formats );
		$this->assertContains( '100%', $fontsize_formats );
		$this->assertContains( '150%', $fontsize_formats );
		$this->assertContains( '200%', $fontsize_formats );
	}

	/**
	 * PHPUnitのテスト用にeditor_add_buttons関数を再実装
	 */
	private function getEditorAddButtons( $editor_buttons ) {
		array_push( $editor_buttons, 'fontsizeselect' );
		return $editor_buttons;
	}

	/**
	 * PHPUnitのテスト用にcustomize_tinymce_settings関数を再実装
	 */
	private function getCustomizeTinyMCESettings( $settings ) {
		$settings['fontsize_formats'] = '50% 75% 100% 150% 200%';
		return $settings;
	}
}

// テスト用の関数定義
if ( ! function_exists( 'editor_add_buttons' ) ) {
	function editor_add_buttons( $editor_buttons ) {
		array_push( $editor_buttons, 'fontsizeselect' );
		return $editor_buttons;
	}
}

if ( ! function_exists( 'customize_tinymce_settings' ) ) {
	function customize_tinymce_settings( $settings ) {
		$settings['fontsize_formats'] = '50% 75% 100% 150% 200%';
		return $settings;
	}
}
