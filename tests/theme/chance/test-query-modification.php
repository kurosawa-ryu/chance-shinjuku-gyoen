<?php

use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;

/**
 * WordPressのクエリ変更機能のテストクラス
 */
class QueryModificationTest extends TestCase {
	/**
	 * テスト前の準備
	 */
	protected function setUp(): void {
		parent::setUp();
		Brain\Monkey\setUp();

		// テスト用の関数定義
		require_once __DIR__ . '/class-mockwpquery.php';
	}

	/**
	 * テスト後の処理
	 */
	protected function tearDown(): void {
		Brain\Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * 管理画面でのクエリ動作テスト
	 */
	public function test_admin_query() {
		// 管理画面でのアクセスをシミュレート
		Functions\when( 'is_admin' )->justReturn( true );

		// テスト用のWP_Queryオブジェクトを作成
		$query = new MockWPQuery( false );

		// 関数を実行
		my_default_query( $query );

		// 管理画面ではクエリは変更されないことを確認
		$this->assertFalse( $query->modified, 'クエリが管理画面で変更されるべきではありません' );
	}

	/**
	 * メインクエリでない場合のテスト
	 */
	public function test_non_main_query() {
		// 管理画面ではないことをシミュレート
		Functions\when( 'is_admin' )->justReturn( false );

		// テスト用のWP_Queryオブジェクトを作成
		$query = new MockWPQuery( false );

		// 関数を実行
		my_default_query( $query );

		// メインクエリでなければ変更されないことを確認
		$this->assertFalse( $query->modified, 'メインクエリでない場合は変更されるべきではありません' );
	}

	/**
	 * キャストアーカイブページでのクエリ変更テスト
	 */
	public function test_cast_archive_query() {
		// 管理画面ではないことをシミュレート
		Functions\when( 'is_admin' )->justReturn( false );

		// post_type_archiveの結果をモック
		Functions\when( 'is_post_type_archive' )
			->justReturn( true );

		// テスト用のWP_Queryオブジェクトを作成（メインクエリ）
		$query = new MockWPQuery( true );

		// 関数を実行
		my_default_query( $query );

		// クエリが変更されたことを確認
		$this->assertTrue( $query->modified, 'キャストアーカイブページでクエリが変更されていません' );

		// 具体的なクエリパラメータの変更を確認
		$this->assertEquals( true, $query->query_vars['nopaging'], 'nopagingがtrueに設定されていません' );
		$this->assertEquals( 'publish', $query->query_vars['post_status'], 'post_statusがpublishに設定されていません' );
	}

	/**
	 * コスプレアーカイブページでのクエリ変更テスト
	 */
	public function test_cosplay_archive_query() {
		// 管理画面ではないことをシミュレート
		Functions\when( 'is_admin' )->justReturn( false );

		// コスプレアーカイブページのチェックをモック
		Functions\expect( 'is_post_type_archive' )
			->once()
			->with( 'cast' )
			->andReturn( false );

		Functions\expect( 'is_post_type_archive' )
			->once()
			->with( 'cosplay' )
			->andReturn( true );

		// テスト用のWP_Queryオブジェクトを作成（メインクエリ）
		$query = new MockWPQuery( true );

		// 関数を実行
		my_default_query( $query );

		// クエリが変更されたことを確認
		$this->assertTrue( $query->modified, 'コスプレアーカイブページでクエリが変更されていません' );

		// 具体的なクエリパラメータの変更を確認
		$this->assertEquals( true, $query->query_vars['nopaging'], 'nopagingがtrueに設定されていません' );
		$this->assertEquals( 'publish', $query->query_vars['post_status'], 'post_statusがpublishに設定されていません' );
	}

	/**
	 * カテゴリーアーカイブページでのクエリ変更テスト
	 */
	public function test_category_archive_query() {
		// 管理画面ではないことをシミュレート
		Functions\when( 'is_admin' )->justReturn( false );

		// カテゴリーアーカイブページのチェックをモック
		Functions\expect( 'is_post_type_archive' )
			->once()
			->with( 'cast' )
			->andReturn( false );

		Functions\expect( 'is_post_type_archive' )
			->once()
			->with( 'cosplay' )
			->andReturn( false );

		Functions\when( 'is_category' )->justReturn( true );

		// テスト用のWP_Queryオブジェクトを作成（メインクエリ）
		$query = new MockWPQuery( true );

		// 関数を実行
		my_default_query( $query );

		// クエリが変更されたことを確認
		$this->assertTrue( $query->modified, 'カテゴリーアーカイブページでクエリが変更されていません' );

		// 具体的なクエリパラメータの変更を確認
		$this->assertEquals( 10, $query->query_vars['posts_per_page'], 'posts_per_pageが10に設定されていません' );
		$this->assertEquals( 'date', $query->query_vars['orderby'], 'orderbyがdateに設定されていません' );
		$this->assertEquals( 'DESC', $query->query_vars['order'], 'orderがDESCに設定されていません' );
	}

	/**
	 * タグアーカイブページでのクエリ変更テスト
	 */
	public function test_tag_archive_query() {
		// 管理画面ではないことをシミュレート
		Functions\when( 'is_admin' )->justReturn( false );

		// タグアーカイブページのチェックをモック
		Functions\expect( 'is_post_type_archive' )
			->once()
			->with( 'cast' )
			->andReturn( false );

		Functions\expect( 'is_post_type_archive' )
			->once()
			->with( 'cosplay' )
			->andReturn( false );

		Functions\when( 'is_category' )->justReturn( false );
		Functions\when( 'is_tag' )->justReturn( true );

		// テスト用のWP_Queryオブジェクトを作成（メインクエリ）
		$query = new MockWPQuery( true );

		// 関数を実行
		my_default_query( $query );

		// クエリが変更されたことを確認
		$this->assertTrue( $query->modified, 'タグアーカイブページでクエリが変更されていません' );

		// 具体的なクエリパラメータの変更を確認
		$this->assertEquals( 12, $query->query_vars['posts_per_page'], 'posts_per_pageが12に設定されていません' );
		$this->assertEquals( 'modified', $query->query_vars['orderby'], 'orderbyがmodifiedに設定されていません' );
		$this->assertEquals( 'DESC', $query->query_vars['order'], 'orderがDESCに設定されていません' );
	}
}

// テスト用の関数定義
if ( ! function_exists( 'my_default_query' ) ) {
	function my_default_query( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}
		if ( is_post_type_archive( 'cast' ) ) {
			$query->set( 'nopaging', true );
			$query->set( 'post_status', 'publish' );
			return;
		}
		if ( is_post_type_archive( 'cosplay' ) ) {
			$query->set( 'nopaging', true );
			$query->set( 'post_status', 'publish' );
			return;
		}
		if ( is_category() ) {
			$query->set( 'posts_per_page', 10 );
			$query->set( 'orderby', 'date' );
			$query->set( 'order', 'DESC' );
			return;
		}
		if ( is_tag() ) {
			$query->set( 'posts_per_page', 12 );
			$query->set( 'orderby', 'modified' );
			$query->set( 'order', 'DESC' );
			return;
		}
	}
}
