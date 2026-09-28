<?php
function _my_create() {
	global $create_error;
	global $create_comp;
	if (
		is_page( 'create' )
		&&
		is_user_logged_in()
		&&
		isset( $_POST['_wpnonce'] )
		&&
		wp_verify_nonce( $_POST['_wpnonce'], 'createBrank' )
	) {
		$postdata   = array_map( 'esc_attr', $_POST );
		$first_name = get_the_title( $postdata['staffID'] );
		$staff_i_d  = _get_staff_i_d();
		if ( ! isset( $postdata['userName'] ) || empty( $postdata['userName'] ) ) {
			$create_error[] = 'ログインIDは必ず入力してください';
		}
		if ( ! isset( $postdata['userPwd'] ) || empty( $postdata['userPwd'] ) ) {
			$create_error[] = 'パスワードは必ず入力してください';
		}
		if ( ! isset( $postdata['staffID'] ) || empty( $postdata['staffID'] ) ) {
			$create_error[] = 'ボーイの名前は必ず入力してください';
		}
		if ( in_array( $postdata['staffID'], $staff_i_d, true ) ) {
			$create_error[] = $first_name . 'さんは既に登録されています。<br>ユーザー一覧から編集するか、<br>削除してください';
		}
		//エラーが無かったら投稿を追加
		if ( empty( $create_error ) ) {
			$userdata = array(
				'user_login'    => $postdata['userName'],
				'user_pass'     => $postdata['userPwd'],
				'wp_user_level' => '7',
				'staffID'       => $postdata['staffID'],
				'role'          => 'staff',
				'first_name'    => $first_name,
			);
			$user_id  = wp_insert_user( $userdata );
			//データの挿入に成功していたら移動
			if ( ! is_wp_error( $user_id ) ) {
				$create_comp = $first_name . 'をユーザー登録しました。';
			} else {
				$create_error[] = '同一のログインIDが既に存在します。';
			}
		}
	}
}
add_action( 'template_redirect', '_my_create' );
function _get_staff_i_d() {
	$user_data   = array();
	$staff_users = get_users( array( 'role' => 'staff' ) );
	foreach ( $staff_users as $value ) {
		$user_data[] = get_user_meta( $value->ID, 'staffID', true );
	}
	return $user_data;
}
