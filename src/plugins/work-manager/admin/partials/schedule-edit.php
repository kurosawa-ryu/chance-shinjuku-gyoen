<?php

set_time_limit( 0 );

if ( isset( $_POST['save'] ) && '1' === $_POST['save'] ) {
	$a   = insert_week_data( $_POST );
	$mes = '<div id="message" class="updated below-h2"><p>登録しました。</p></div>';
}

$date = isset( $_GET['sdate'] ) ? $_GET['sdate'] : date( 'Y-m-d' );

for ( $i = 0; $i <= 6; $i++ ) {
	$date_list[] = date( 'Y-m-d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) );
}

//出勤データを取得する
$result_data = get_schedule_list( get_cast(), $date_list );

$timer_list = get_office_time();
$date_list  = get_week_list();

// 閲覧者の判定
$staff = ( current_user_can( 'staff' ) ) ? true : false;
delete_duplication_record();

?>

<div class="wrap work-schedule">
	<h2 class="page-header">出勤管理</h2>
	<?php
	if ( isset( $mes ) ) {
		echo $mes; }
	?>
	<div class="table-responsive">
		<ul class="subsubsub">
			<li class="all">
				<a href="<?php echo get_admin_url(); ?>admin.php?page=schedule_sub_menu_3&sdate=<?php echo $date_list['date']; ?>">≪今週&nbsp;|</a>
			</li>
			<li class="publish">
				<a href="<?php echo get_admin_url(); ?>admin.php?page=schedule_sub_menu_3&sdate=<?php echo $date_list['next_date']; ?>">来週&nbsp;&nbsp;|</a>
			</li>
			<li class="publish">
				<a href="<?php echo get_admin_url(); ?>admin.php?page=schedule_sub_menu_3&sdate=<?php echo $date_list['after_next_date']; ?>">&nbsp;再来週≫</a>
			</li>
			<li class="publish">時間を入力する際、数字形式でお願いします。<br class="visible-xs">例）13:00-15:00</li>
			<?php
			if ( ! $staff ) {
				echo '<li class="publish">&nbsp;|&nbsp;確定されていないスケジュールは青色で表示されます</li>';
			}
			?>
		</ul>
		<form action="<?php echo get_admin_url(); ?>admin.php?page=schedule_sub_menu_3&sdate=<?php echo $date; ?>" method="post" id="compForm">
			<input type="hidden" name="save" value="1">
			<table class="widefat
			<?php
			if ( $staff ) {
				echo ' res_table';}
			?>
			">
				<thead>
					<tr>
						<?php
						if ( ! $staff ) {
							echo '<th style="width:3%;"></th>';
						}
						?>
						<th style="width:3%">画像</th>
						<th style="width:9%"><?php echo TITLE_NAME; ?></th>
						<?php
						for ( $i = 0; $i <= 6; $i++ ) {
							$viewday  = date( 'm/d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) );
							$viewweek = get_week_data( date( 'Y-m-d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) ), 'ja' );
							echo '<th style="width:12%">' . $viewday . '　(' . $viewweek . ')</th>';
						}
						?>
					</tr>
				</thead>
				<tbody>
				<?php
				if ( $staff ) {
					$login_user     = wp_get_current_user();
					$cast_data_list = array( get_user_meta( $login_user->ID, 'staffID', true ) );
				} else {
					$cast_data_list = get_cast();
				}

					$head = 1;
				foreach ( $cast_data_list as $usr_id ) :
					$value     = $result_data[ $usr_id ];
					$cast_data = get_cast_id( $usr_id );

					//サムネイルを取得する
					$images    = get_post_meta( $usr_id, 'myupload_images', true );
					$thumb_src = wp_get_attachment_image_src( $images[0], 'thumbnail' );
					if ( ! isset( $thumb_src[0] ) ) {
						$thumb_src[0] = LW_NO_IMAGE;
					}
					?>
					<tr>
					<?php
					if ( ! $staff ) {
						echo '<td><input type="checkbox" class="comp_update"></td>';
					}
					?>
						<td><img src="<?php echo $thumb_src[0]; ?>" style="max-width: 100%; width:50px;"></td>
						<td><?php echo $cast_data['title']; ?></td>
						<?php
						for ( $i = 0; $i <= 6; $i++ ) {
							$tmp_date   = date( 'Y-m-d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) );
							$timer_list = change_office_time( $tmp_date )['list'];
							$start_time = change_office_time( $tmp_date )['start'];

							$start = ( ! empty( $timer_list[ $value[ $tmp_date ]['start'] ] ) ) ? $timer_list[ $value[ $tmp_date ]['start'] ] : $start_time;
							$end   = ( ! empty( $timer_list[ $value[ $tmp_date ]['end'] ] ) ) ? $timer_list[ $value[ $tmp_date ]['end'] ] : $start_time;

							$confirm      = ( isset( $value[ $tmp_date ]['confirm'] ) && 'false' === $value[ $tmp_date ]['confirm'] ) ? ' class="false"' : '';
							$editday      = date( 'Y-m-d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) );
							$ladywork_txt = ( ! empty( $value[ $tmp_date ]['ladywork_txt'] ) ) ? $value[ $tmp_date ]['ladywork_txt'] : '';
							echo '<td' . $confirm . '><fieldset>';
							echo '<input type="text" class="time1" value="' . $start . '-' . $end . '" size="10">';
							echo '<input type="hidden" class="time2" name="usrA[' . $usr_id . '][' . $editday . ']" id="usrA' . $usr_id . '" value="">';
							echo '<input type="hidden" class="time3" name="usrB[' . $usr_id . '][' . $editday . ']" id="usrB' . $usr_id . '" value="">';
							echo '</fieldset><fieldset><textarea name="ladywork_txt[' . $usr_id . '][' . $editday . ']" value="" rows="1">' . $ladywork_txt . '</textarea>';
							echo '</fieldset></td>';
						}
						?>
					</tr>
					<?php if ( ( $head % 4 ) === 0 ) : ?>
					<tr class="bd_gray">
						<?php
						if ( ! $staff ) {
							echo '<th></th>';
						}
						?>
						<th>画像</th>
						<th><?php echo TITLE_NAME; ?></th>
						<?php
						for ( $i = 0; $i <= 6; $i++ ) {
							$viewday  = date( 'm/d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) );
							$viewweek = get_week_data( date( 'Y-m-d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) ), 'ja' );
							echo '<th>' . $viewday . '　(' . $viewweek . ')</th>';
						}
						?>
					</tr>
				<?php endif; ?>
					<?php
					++$head;
endforeach;
				?>
				</tbody>
			</table>
			<p class="submit">
			<?php if ( $staff ) : ?>
				<button type="submit" class="button-primary">保存</button>
			<?php else : ?>
				<button type ="button" id="part" class="btn-success">チェックのみ更新</button>&nbsp;&nbsp;
				<button type="submit" class="button-primary" id="schedule_submit">全て更新</button>
				<span id="noCheck" style="color:#f00;display:none;">チェックがありません</span>
			<?php endif; ?>
			</p>
		</form>
	</div>
</div>
