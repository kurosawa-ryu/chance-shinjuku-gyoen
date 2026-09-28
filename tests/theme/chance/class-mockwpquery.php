<?php

/**
 * WordPressのWP_Queryクラスのモック
 */
class MockWPQuery {
	/**
	 * クエリ変数
	 *
	 * @var array
	 */
	public $query_vars = array();

	/**
	 * クエリが変更されたかどうか
	 *
	 * @var bool
	 */
	public $modified = false;

	/**
	 * メインクエリかどうか
	 *
	 * @var bool
	 */
	private $is_main_query = false;

	/**
	 * コンストラクタ
	 *
	 * @param bool $is_main メインクエリかどうか
	 */
	public function __construct( $is_main = false ) {
		$this->is_main_query = $is_main;
	}

	/**
	 * メインクエリかどうかを確認
	 *
	 * @return bool メインクエリならtrue
	 */
	public function is_main_query() {
		return $this->is_main_query;
	}

	/**
	 * クエリ変数を設定
	 *
	 * @param array $vars クエリ変数
	 */
	public function set_query_vars( $vars ) {
		$this->query_vars = $vars;
	}
}
