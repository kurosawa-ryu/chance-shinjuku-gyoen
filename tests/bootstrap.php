<?php
/**
 * PHPUnit bootstrap file.
 *
 * テスト環境の初期化を行います。
 */

// Composer autoloaderを読み込む
require_once dirname( __DIR__ ) . '/vendor/autoload.php';

// Brain\Monkeyはintegrationテストの場合不要です
// 単体テスト時のみsetUp/tearDownで利用します

// 共通の定数やグローバル設定
define( 'TESTS_ROOT_DIR', dirname( __DIR__ ) . '/tests' );
define( 'PROJECT_ROOT_DIR', dirname( __DIR__ ) );
define( 'THEME_DIR', PROJECT_ROOT_DIR . '/src/theme/chance' );
define( 'PLUGIN_DIR', PROJECT_ROOT_DIR . '/src/plugins/work-manager' );

// WordPressの基本関数をモック
Brain\Monkey\Functions\when( 'plugin_dir_path' )->returnArg();
Brain\Monkey\Functions\when( 'get_template_directory' )->justReturn( dirname( __DIR__ ) . '/src/theme/chance' );

// ファイルの読み込みは各テストファイルで行うようにする
// これにより、テスト間の依存関係が明確になり、テストの独立性が保たれる

// テスト終了時のクリーンアップ用フック
register_shutdown_function(
	function () {
		Brain\Monkey\tearDown();
	}
);
