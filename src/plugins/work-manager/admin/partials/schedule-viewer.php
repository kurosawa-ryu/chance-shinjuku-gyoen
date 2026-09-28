<?php

$date = ( ! empty( $_GET['sdate'] ) ) ? $_GET['sdate'] : date( 'Y-m-d' );

for ( $i = 0; $i <= 6; $i++ ) {
	$date_list[] = date( 'Y-m-d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) );
}

//出勤データを取得する
$result_data = get_schedule_list( get_cast(), $date_list );
$time_list   = get_office_time();
$date_list   = get_week_list();

// 閲覧者の判定
$staff = ( current_user_can( 'staff' ) ) ? true : false;

?>

<div class="wrap work-schedule">
	<h2 class="page-header">スケジュール一覧</h2>
	<div class="table-responsive">
		<ul class="subsubsub">
			<li class="all">
				<a href="<?php echo get_admin_url(); ?>admin.php?page=schedule_main_menu&sdate=<?php echo $date_list['date']; ?>">≪今週&nbsp;|</a>
			</li>
			<li class="publish">
				<a href="<?php echo get_admin_url(); ?>admin.php?page=schedule_main_menu&sdate=<?php echo $date_list['next_date']; ?>">来週&nbsp;&nbsp;|</a>
			</li>
			<li class="publish">
				<a href="<?php echo get_admin_url(); ?>admin.php?page=schedule_main_menu&sdate=<?php echo $date_list['after_next_date']; ?>">&nbsp;再来週≫</a>
			</li>
			<?php
			if ( ! $staff ) {
				echo '<li class="publish">&nbsp;|&nbsp;確定されていないスケジュールは青色で表示されます</li>';
			}
			?>
		</ul>
		<table class="widefat">
			<thead>
				<tr>
					<th style="width:3%">画像</th>
					<th style="width:9%"><?php echo TITLE_NAME; ?></th>
					<?php
					for ( $i = 0; $i <= 6; $i++ ) {
						$viewday  = date( 'm/d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) );
						$viewweek = get_week_data( date( 'Y-m-d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) ), 'ja' );
						echo '<th style="width:12%">' . $viewday . '　(' . $viewweek . ')</th>';
					}
					?>
					<th style="width: 10%;">操作</th>
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
				<td><img src="<?php echo $thumb_src[0]; ?>" style="max-width: 100%;width:50px;"></td>
				<td><?php echo $cast_data['title']; ?></td>
				<?php
				for ( $i = 0; $i <= 6; $i++ ) {
					$tmp_date   = date( 'Y-m-d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) );
					$time_list  = change_office_time( $tmp_date )['list'];
					$start_time = change_office_time( $tmp_date )['start'];

					$start     = ( ! empty( $time_list[ $value[ $tmp_date ]['start'] ] ) ) ? $time_list[ $value[ $tmp_date ]['start'] ] : '';
					$end       = ( ! empty( $time_list[ $value[ $tmp_date ]['end'] ] ) ) ? $time_list[ $value[ $tmp_date ]['end'] ] : '';
					$color     = ( ! empty( $value[ $tmp_date ]['confirm'] ) && 'false' === $value[ $tmp_date ]['confirm'] ) ? '#00f' : '#f00';
					$row_color = ( ! $staff && '#00f' === $color ) ? ' style="color:#00f;"' : '';

					$ladywork_txt  = ( ! empty( $value[ $tmp_date ]['ladywork_txt'] ) ) ? $value[ $tmp_date ]['ladywork_txt'] : '';
					$ladywork_time = ( $start_time === $start && $start_time === $end || '' === $start || '' === $end ) ? '未定' : $start . '-' . $end;
					if ( strpos( $ladywork_txt, '休み' ) !== false ) {
						$schedule = "<span style='color:" . $color . ";'>休み</span>";
					} elseif ( strpos( $ladywork_txt, '予約満了' ) !== false ) {
						$schedule = "<span style='color:" . $color . ";'>ご予約満了</span>";
					} else {
						$schedule = $ladywork_time;
						if ( ! empty( $ladywork_txt ) ) {
							$schedule .= '<br>' . nl2br( $ladywork_txt );
						}
					}
					echo '<td' . $row_color . '>';
					echo $schedule;

					echo '</td>';
				}
				?>
				<td>
					<?php
					if ( ! $staff ) {
						echo '<a href="' . get_admin_url() . 'admin.php?page=schedule_confirm&usr_id=' . $usr_id . '&sdate=' . $date . '">確定</a>';
					}
					?>
				</td>
			</tr>
				<?php if ( ( $head % 4 ) === 0 ) : ?>
				<tr class="relay">
					<th>画像</th>
					<th><?php echo TITLE_NAME; ?></th>
					<?php
					for ( $i = 0; $i <= 6; $i++ ) {
						$viewday  = date( 'm/d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) );
						$viewweek = get_week_data( date( 'Y-m-d', strtotime( get_beginning_week_date( $date ) . '+' . $i . ' day', strtotime( $date ) ) ), 'ja' );
						echo '<th>' . $viewday . '　(' . $viewweek . ')</th>';
					}
					?>
					<th>操作</th>
				</tr>
			<?php endif; ?>
				<?php
				++$head;
endforeach;
			?>
		</table>
	</div>
</div>
