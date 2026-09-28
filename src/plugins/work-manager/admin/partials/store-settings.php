<?php
if ( isset( $_POST['mt_submit_hidden'] ) && 'Y' === $_POST['mt_submit_hidden'] ) {
	//営業時間
	update_option( 'cast_office_start_time', sanitize_text_field( $_POST['cast_office_start_time'] ) );
	update_option( 'cast_office_end_time', sanitize_text_field( $_POST['cast_office_end_time'] ) );

	//テキスト入力が許可するかどうか
	// update_option( 'cast_txt_view_flg', isset( $_POST['cast_txt_view_flg'] ) ? absint( $_POST['cast_txt_view_flg'] ) : 0 );

	// 店舗名
	update_option( 'work_manager_store_name', isset( $_POST['work_manager_store_name'] ) ? sanitize_text_field( $_POST['work_manager_store_name'] ) : '' );

	// 電話番号
	update_option( 'work_manager_phone', isset( $_POST['work_manager_phone'] ) ? sanitize_text_field( $_POST['work_manager_phone'] ) : '' );

	// メールアドレス
	update_option( 'work_manager_email', isset( $_POST['work_manager_email'] ) ? sanitize_email( $_POST['work_manager_email'] ) : '' );

	// GTM ID
	update_option( 'work_manager_gtm_id', isset( $_POST['work_manager_gtm_id'] ) ? sanitize_text_field( $_POST['work_manager_gtm_id'] ) : '' );

	// Clarity ID
	update_option( 'work_manager_clarity_id', isset( $_POST['work_manager_clarity_id'] ) ? sanitize_text_field( $_POST['work_manager_clarity_id'] ) : '' );

	// X（旧Twitter）ID
	update_option( 'work_manager_x_id', isset( $_POST['work_manager_x_id'] ) ? sanitize_text_field( $_POST['work_manager_x_id'] ) : '' );
}

// //営業時間を取得する
$start_time = get_option( 'cast_office_start_time' );
$end_time   = get_option( 'cast_office_end_time' );

// //営業時間を設定する
// $timer_list = set_office_time_list();

// $cast_txt_flg  = get_option( 'cast_txt_view_flg' );

// 店舗設定情報を取得
$store_name = get_option( 'work_manager_store_name' );
$phone      = get_option( 'work_manager_phone' );
$email      = get_option( 'work_manager_email' );

// GTM ID と Clarity ID を取得
$gtm_id     = get_option( 'work_manager_gtm_id' );
$clarity_id = get_option( 'work_manager_clarity_id' );

// X（旧Twitter）ID を取得
$x_id = get_option( 'work_manager_x_id', 'CHANCE_OKUBO' );
?>

<div class="wrap">
	<h2 class="page-header">店舗設定</h2>
	<form action="" method="post">
		<input type="hidden" name="mt_submit_hidden" value="Y">
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="work_manager_store_name">店舗名</label></th>
					<td>
						<input type="text" id="work_manager_store_name" name="work_manager_store_name" value="<?php echo esc_attr( $store_name ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th><label for="work_manager_phone">電話番号</label></th>
					<td>
						<input type="tel" id="work_manager_phone" name="work_manager_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th><label for="work_manager_email">メールアドレス</label></th>
					<td>
						<input type="email" id="work_manager_email" name="work_manager_email" value="<?php echo esc_attr( $email ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th><label for="cast_office_start_time">営業時間開始</label></th>
					<td>
						<input type="text" id="cast_office_start_time" name="cast_office_start_time" value="<?php echo esc_attr( $start_time ); ?>" class="regular-text" placeholder="例: 09:00" />
						<p class="description">24時間表記。例: 09:00</p>
					</td>
				</tr>
				<tr>
					<th><label for="cast_office_end_time">営業時間終了</label></th>
					<td>
						<input type="text" id="cast_office_end_time" name="cast_office_end_time" value="<?php echo esc_attr( $end_time ); ?>" class="regular-text" placeholder="例: 29:00" />
						<p class="description">翌日深夜の場合は29:00のように記載</p>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<th><label for="work_manager_gtm_id">Google Tag Manager ID</label></th>
					<td>
						<input type="text" id="work_manager_gtm_id" name="work_manager_gtm_id" value="<?php echo esc_attr( $gtm_id ); ?>" class="regular-text" />
						<p class="description">例: GTM-XXXXXXX</p>
					</td>
				</tr>
				<tr>
					<th><label for="work_manager_clarity_id">Clarity Tracking ID</label></th>
					<td>
						<input type="text" id="work_manager_clarity_id" name="work_manager_clarity_id" value="<?php echo esc_attr( $clarity_id ); ?>" class="regular-text" />
						<p class="description">Clarity プロジェクト ID を入力してください。</p>
					</td>
				</tr>
				<tr>
					<th><label for="work_manager_x_id">X（旧Twitter）ID</label></th>
					<td>
						<input type="text" id="work_manager_x_id" name="work_manager_x_id" value="<?php echo esc_attr( $x_id ); ?>" class="regular-text" />
						<p class="description">例: CHANCE_OKUBO（先頭の@は不要です）</p>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><button type="submit" class="button-primary">保存</button></p>
	</form>
</div>
