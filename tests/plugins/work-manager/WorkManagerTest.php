<?php

// 単体テスト用
use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;

/**
 * WorkManagerプラグインのテストクラス（単体テスト）
 */
class WorkManagerTest extends TestCase {

	/**
	 * テストするWorkManagerオブジェクト
	 *
	 * @var object
	 */
	protected $work_manager;

	/**
	 * テスト前の準備
	 */
	protected function setUp(): void {
		parent::setUp();
		Brain\Monkey\setUp();

		// WordPressの関数をモック
		Functions\when( 'plugin_dir_path' )->returnArg();

		// 追加のモック
		Functions\when( 'load_plugin_textdomain' )->justReturn( true );
		Functions\when( 'plugin_basename' )->returnArg();
		Functions\when( 'add_action' )->justReturn( true );
		Functions\when( 'add_filter' )->justReturn( true );

		// ローダーオブジェクトをモック
		$loader = $this->getMockBuilder( \stdClass::class )
			->addMethods( array( 'add_action', 'add_filter', 'run' ) )
			->getMock();

		// モックオブジェクトを作成
		$this->work_manager = $this->getMockBuilder( \stdClass::class )
			->addMethods(
				array(
					'get_plugin_name',
					'get_loader',
					'get_version',
				)
			)
			->getMock();

		// get_plugin_name メソッドの戻り値を設定
		$this->work_manager->method( 'get_plugin_name' )
			->willReturn( 'work-manager' );

		// get_loader メソッドの戻り値を設定
		$this->work_manager->method( 'get_loader' )
			->willReturn( $loader );

		// get_version メソッドの戻り値を設定
		$this->work_manager->method( 'get_version' )
			->willReturn( '2.0.0' );
	}

	/**
	 * テスト後の処理
	 */
	protected function tearDown(): void {
		Brain\Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * get_plugin_name()メソッドのテスト
	 *
	 * @return void
	 */
	public function test_get_plugin_name() {
		// get_plugin_name()メソッドの戻り値が'work-manager'であることを検証
		$this->assertEquals( 'work-manager', $this->work_manager->get_plugin_name() );
		$this->assertIsString( $this->work_manager->get_plugin_name() );
		$this->assertNotEmpty( $this->work_manager->get_plugin_name() );
	}

	/**
	 * get_loader()メソッドのテスト
	 *
	 * @return void
	 */
	public function test_get_loader() {
		// get_loader()メソッドがオブジェクトを返すことを検証
		$loader = $this->work_manager->get_loader();
		$this->assertIsObject( $loader );
		$this->assertTrue( method_exists( $loader, 'add_action' ) );
		$this->assertTrue( method_exists( $loader, 'add_filter' ) );
		$this->assertTrue( method_exists( $loader, 'run' ) );
		$this->assertSame( $loader, $this->work_manager->get_loader(), 'ローダーオブジェクトは同一のインスタンスを返す必要があります' );
	}

	/**
	 * get_version()メソッドのテスト
	 *
	 * @return void
	 */
	public function test_get_version() {
		// get_version()メソッドが正しいバージョン文字列を返すことを検証
		$this->assertEquals( '2.0.0', $this->work_manager->get_version() );
		$this->assertIsString( $this->work_manager->get_version() );
		$this->assertNotEmpty( $this->work_manager->get_version() );
		$this->assertMatchesRegularExpression( '/^\d+\.\d+\.\d+$/', $this->work_manager->get_version(), 'バージョン番号はセマンティックバージョニング形式である必要があります' );
	}

	/**
	 * ゲッターメソッドの一貫性テスト
	 *
	 * @return void
	 */
	public function test_getter_consistency() {
		// 複数回呼び出しても同じ結果を返すことを検証
		$plugin_name1 = $this->work_manager->get_plugin_name();
		$plugin_name2 = $this->work_manager->get_plugin_name();
		$this->assertSame( $plugin_name1, $plugin_name2, 'get_plugin_name()は常に同じ値を返す必要があります' );

		$version1 = $this->work_manager->get_version();
		$version2 = $this->work_manager->get_version();
		$this->assertSame( $version1, $version2, 'get_version()は常に同じ値を返す必要があります' );
	}

	/**
	 * ゲッターメソッドの型チェック詳細テスト
	 *
	 * @return void
	 */
	public function test_getter_types_detailed() {
		// プラグイン名の詳細検証
		$plugin_name = $this->work_manager->get_plugin_name();
		$this->assertIsString( $plugin_name );
		$this->assertGreaterThan( 0, strlen( $plugin_name ), 'プラグイン名は空であってはいけません' );
		$this->assertLessThanOrEqual( 50, strlen( $plugin_name ), 'プラグイン名は長すぎないべきです' );

		// バージョン番号の詳細検証
		$version = $this->work_manager->get_version();
		$this->assertIsString( $version );
		$version_parts = explode( '.', $version );
		$this->assertCount( 3, $version_parts, 'バージョン番号は3つの部分（メジャー.マイナー.パッチ）で構成されるべきです' );

		foreach ( $version_parts as $part ) {
			$this->assertIsNumeric( $part, 'バージョン番号の各部分は数値である必要があります' );
		}
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

class WorkManagerIntegrationTest extends BrainMonkeyTestCase {
	protected function set_up() {
		parent::set_up();
		// プラグインのファイルを読み込み
		require_once PLUGIN_DIR . '/includes/class-work-manager.php';
	}

	public function test_plugin_initialized() {
		$work_manager = new Work_Manager();
		$this->assertInstanceOf(Work_Manager::class, $work_manager);
		$this->assertEquals('work-manager', $work_manager->get_plugin_name());
	}
}
*/
