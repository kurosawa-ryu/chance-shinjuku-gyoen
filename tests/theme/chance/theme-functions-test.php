<?php

// 単体テスト用
use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;

/**
 * テーマの主要な関数のテストクラス
 */
class ThemeFunctionsTest extends TestCase {

	/**
	 * テスト前の準備
	 */
	protected function setUp(): void {
		parent::setUp();
		Brain\Monkey\setUp();

		// WordPressのグローバル変数をモック
		global $post;
		$post = (object) array(
			'post_parent' => 0,
		);

		// WordPressの関数をモック
		Functions\when( 'is_page' )->justReturn( true );
		Functions\when( 'is_home' )->justReturn( false );
		Functions\when( 'is_front_page' )->justReturn( false );
		Functions\when( 'wp_get_attachment_image_src' )->justReturn( array( 'http://example.com/image.jpg' ) );
		Functions\when( 'get_permalink' )->justReturn( 'http://example.com/cast/1' );
		Functions\when( 'get_post_meta' )->justReturn( '' );
		Functions\when( 'get_the_ID' )->justReturn( 1 );
		Functions\when( 'get_the_title' )->justReturn( 'Test Cast' );
		Functions\when( 'wp_reset_postdata' )->justReturn( null );
		Functions\when( 'wp_get_theme' )->justReturn(
			(object) array(
				'get' => function () {
					return '1.0.0';
				},
			)
		);

		// テーマの関数ファイルを読み込み
		require_once dirname( __DIR__, 3 ) . '/src/theme/chance/inc/function.php';
	}

	/**
	 * テスト後の処理
	 */
	protected function tearDown(): void {
		Brain\Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * デバイス判定のテスト（モバイル）
	 */
	public function test_is_mobile() {
		// iPhoneのUser-Agentをセット
		$_SERVER['HTTP_USER_AGENT'] = 'iPhone';
		$this->assertTrue( is_mobile() );

		// PCのUser-Agentをセット
		$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)';
		$this->assertFalse( is_mobile() );
	}

	/**
	 * ボット判定のテスト
	 */
	public function test_is_bot() {
		// Googleボットのテスト
		$_SERVER['HTTP_USER_AGENT'] = 'Googlebot/2.1';
		$this->assertTrue( is_bot() );

		// 通常のブラウザのテスト
		$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)';
		$this->assertFalse( is_bot() );
	}

	/**
	 * サブページ判定のテスト
	 */
	public function test_is_subpage() {
		global $post;

		// 親ページがある場合
		$post->post_parent = 123;
		$this->assertEquals( 123, is_subpage() );

		// 親ページがない場合
		$post->post_parent = 0;
		$this->assertFalse( is_subpage() );
	}

	/**
	 * メインクラス取得のテスト
	 */
	public function test_get_main_class() {
		// トップページの場合
		Functions\when( 'is_home' )->justReturn( true );
		$this->assertEquals( 'top_main', get_main_class() );

		// サブページの場合
		Functions\when( 'is_home' )->justReturn( false );
		$this->assertEquals( 'sub_main', get_main_class() );
	}

	/**
	 * 週間スケジュール取得のテスト
	 */
	public function test_get_week_schedule() {
		// get_post_metaの戻り値を設定
		Functions\when( 'get_post_meta' )->justReturn(
			array(
				'usr_id'       => 1,
				'date'         => '2024-03-20',
				'ladywork_txt' => 'テスト出勤',
				'confirm'      => 'true',
				'time'         => '1,2,3',
			)
		);

		// スケジュールデータを取得
		$schedule = get_week_schedule( '2024-03-20' );

		// スケジュールデータの構造を検証
		$this->assertIsArray( $schedule );
	}

	/**
	 * キャストの2週間スケジュール取得のテスト
	 */
	public function test_get_cast_2week_schedule() {
		// get_post_metaの戻り値を設定
		Functions\when( 'get_post_meta' )->justReturn(
			array(
				'date'         => '2024-03-20',
				'ladywork_txt' => 'テスト出勤',
				'confirm'      => 'true',
				'time'         => '1,2,3',
			)
		);

		// スケジュールデータを取得
		$schedule = get_cast_2week_schedule( 1 );

		// スケジュールデータの構造を検証
		$this->assertIsArray( $schedule );
	}

	/**
	 * 日別スケジュール取得のテスト
	 */
	public function test_get_daily_schedules() {
		// スケジュールデータを取得
		$schedules = get_daily_schedules();

		// スケジュールデータの構造を検証
		$this->assertIsArray( $schedules );
		$this->assertCount( 14, $schedules ); // 2週間分のデータ
	}

	/**
	 * アセットバージョン取得のテスト
	 */
	public function test_get_asset_version() {
		// 定数が未定義の場合
		if ( ! defined( 'CHANCE_VERSION' ) ) {
			define( 'CHANCE_VERSION', '1.0.0' );
		}

		$this->assertEquals( '1.0.0', get_asset_version() );
	}
}

/**
 * 統合テストの例
 *
 * WP_CLIからテストする場合に使用するアプローチです。
 * 実際のWordPress環境でテストを実行するには、wp-envのテスト環境で実行する必要があります。
 */
// 統合テストを有効にする場合はコメントを外してください
/*
use Yoast\WPTestUtils\BrainMonkey\TestCase as BrainMonkeyTestCase;

class ThemeFunctionsIntegrationTest extends BrainMonkeyTestCase {
	protected function set_up() {
		parent::set_up();
		// テーマの関数ファイルを読み込み
		require_once THEME_DIR . '/inc/function.php';
	}

	public function test_get_asset_version_integration() {
		// 実際のWordPress環境でのテスト
		$version = get_asset_version();
		$this->assertIsString($version);
	}
}
*/
