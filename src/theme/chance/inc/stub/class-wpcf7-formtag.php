<?php
/**
 * Contact Form 7 用のダミークラス
 */
class WPCF7_FormTag {
	public $name;

	public function __construct( $tag ) {
		// ここには必要最小限の処理を記述。
		if ( is_array( $tag ) && isset( $tag['name'] ) ) {
			$this->name = $tag['name'];
		} else {
			$this->name = '';
		}
	}
}
