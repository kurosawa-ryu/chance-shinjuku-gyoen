<?php

// ---------------------------------------------
// キャストごとのスケジュールを表示する
// ---------------------------------------------
// function get_week_schedule( $user_id, $view_cnt = 6 ) {
// for ( $i = 0; $i <= $view_cnt; $i++ ) {
// $date_list[] = date( 'Y-m-d', strtotime( '+' . $i . ' day' ) );
// }

// $time_list = get_office_time();
// $result    = get_schedule_list( array( $user_id ), $date_list );
// foreach ( $result as $value ) {
// foreach ( $value as $val ) {
// $start        = $time_list[ $val['start'] ];
// $end          = $time_list[ $val['end'] ];
// $ladywork_txt = ( ! empty( $val['ladywork_txt'] ) ) ? $val['ladywork_txt'] : '';
// $confirm      = ( ! empty( $val['confirm'] ) ) ? $val['confirm'] : 'false';
// if ( 'false' === $confirm ) {
// $return[ $val['date'] ] = '未定' . '<br>　';
// } else {

// if (
// get_option( 'cast_office_start_time' ) === $start
// &&
// get_option( 'cast_office_start_time' ) === $end
// &&
// strpos( $ladywork_txt, '休み' ) === false
// &&
// strpos( $ladywork_txt, '予約満了' ) === false
// &&
// strpos( $ladywork_txt, '大阪勤務' ) === false
// &&
// strpos( $ladywork_txt, '東京勤務' ) === false || '' === $start || '' === $end
// ) {
// $return[$val['date']] = " - ";
// $return[ $val['date'] ] = '未定' . '<br>　';
// } else {
// $return[$val['date']] = $start . " ～ " . $end;
// if ( ! empty( $ladywork_txt ) ) {
// $return[ $val['date'] ] = $start . '-' . $end . '<br>' . $ladywork_txt;
// } else {
// $return[ $val['date'] ] = $start . '-' . $end . '<br>　';
// }
// }
// }
// }
// }
// return $return;
// }

// ---------------------------------------------
// スケジュールを表示する
// ---------------------------------------------


function get_schedule_list( $usr_id_list, $date_list ) {
	$post_name      = array();
	$post_item_data = array();
	foreach ( $usr_id_list as $usr_id ) {
		foreach ( $date_list as $date ) {
			$post_name[]                        = $date . '-' . $usr_id; // 　検索するスラッグの配列を作成
			$post_item_data[ $usr_id ][ $date ] = array( // 返り値のデフォルトを作成
				'date'   => $date,
				'start'  => 1,
				'end'    => 1,
				'usr_id' => $usr_id,
			);
		}
	}
	$args      = array(
		'post_type'              => 'skd',
		'no_found_rows'          => true,
		'cache_results'          => false,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
		'nopaging'               => true,
		'orderby'                => 'meta_value',
		'meta_key'               => 'time',
		'order'                  => 'ASC',
		'post_status'            => 'publish',
		'post_name__in'          => $post_name,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$time      = get_post_meta( get_the_ID(), 'time', true );
			$time_list = explode( ',', $time );
			$tmp       = array(
				'usr_id'       => get_post_meta( get_the_ID(), 'usr_id', true ),
				'date'         => get_post_meta( get_the_ID(), 'date', true ),
				'ladywork_txt' => get_post_meta( get_the_ID(), 'ladywork_txt', true ),
				'confirm'      => get_post_meta( get_the_ID(), 'confirm', true ),
				'start'        => $time_list[0],
				'end'          => $time_list[ count( $time_list ) - 1 ],
			);

			$post_item_data[ $tmp['usr_id'] ][ $tmp['date'] ] = $tmp;
		}
	}
	wp_reset_postdata();
	return $post_item_data;
}

// ---------------------------------------------
// キャストデータを表示する
// ---------------------------------------------
function get_cast_id( $user_id ) {
	$user_data = get_post( $user_id );
	$images    = get_post_meta( $user_id, 'myupload_images', true );
	$thumb_src = ( ! empty( $images[0] ) ) ? wp_get_attachment_thumb_url( $images[0] ) : LW_NO_IMAGE;

	$post_item_data = array(
		'cast_id' => $user_id,
		'title'   => ( ! empty( $user_data ) ) ? $user_data->post_title : '',
		'images'  => $thumb_src,
	);

	return $post_item_data;
}

// ---------------------------------------------
// キャストデータを表示する
// ---------------------------------------------
function get_cast() {
	$cast_post_type = get_option( 'cast_post_type_plugin_value', 'cast' );

	$args      = array(
		'post_type'              => $cast_post_type,
		'nopaging'               => true,
		'post_status'            => 'publish',
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			error_log( 'post_id' );
			error_log( get_the_ID() );
			error_log( get_post_meta( get_the_ID(), '_locale', true ), );
			$post_item_data[ get_the_date( 'Y-m-d H:i:s' ) ] = get_the_ID();
		}
	}
	wp_reset_postdata();
	error_log( 'post_item_data length' );
	error_log( count( $post_item_data ) );

	error_log( 'post_item_data' );
	error_log( print_r( $post_item_data, true ) );

	return $post_item_data;
}

// ---------------------------------------------
// SKD_ID取得
// ---------------------------------------------
function get_skd_id( $usr_id, $date ) {
	$post_name = $date . '-' . $usr_id;
	$args      = array(
		'post_type'              => 'skd',
		'no_found_rows'          => true,
		'cache_results'          => false,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
		'nopaging'               => true,
		'name'                   => $post_name,
		'fields'                 => 'ids',
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		if ( $the_query->post_count > 1 ) {
			for ( $i = 1; $i < $the_query->post_count; $i++ ) {
				wp_delete_post( $the_query->posts[ $i ], true );
			}
		}
		return $the_query->posts[0];
	} else {
		return;
	}
}

// ---------------------------------------------
// データを登録する
// ---------------------------------------------
function insert_week_data( $data_list ) {
	$confirm     = ( current_user_can( 'staff' ) ) ? 'false' : 'true';
	$insert_data = array();
	foreach ( $data_list['usrA'] as $usr_id => $schedule ) {
		foreach ( $schedule as $day => $time ) {
			$tmp   = array();
			$start = get_time_id( $data_list['usrA'][ $usr_id ][ $day ], $day );
			$end   = get_time_id( $data_list['usrB'][ $usr_id ][ $day ], $day );

			$tmp['usr_id']       = $usr_id;
			$tmp['time']         = implode( ',', range( $start, $end ) );
			$tmp['date']         = $day;
			$tmp['confirm']      = $confirm; // 管理者かどうか
			$tmp['ladywork_txt'] = $data_list['ladywork_txt'][ $usr_id ][ $day ];
			$skd_id              = get_skd_id( $usr_id, $day );
			if ( ! empty( $skd_id ) ) {

				foreach ( $tmp as $key => $value ) {
					$meta = update_post_meta( $skd_id, $key, $value );
				}
			} else {

				$my_post = array(
					'post_author'       => 1,
					'post_date'         => date_i18n( 'Y-m-d H:i:s' ),
					'post_date_gmt'     => date( 'Y-m-d H:i:s' ),
					'post_title'        => $tmp['date'] . ' - ' . $tmp['usr_id'],
					'post_status'       => 'publish',
					'comment_status'    => 'closed',
					'ping_status'       => 'closed',
					'post_name'         => $tmp['date'] . '-' . $tmp['usr_id'],
					'post_modified'     => date( 'Y-m-d H:i:s' ),
					'post_modified_gmt' => date( 'Y-m-d H:i:s' ),
					'post_type'         => 'skd',
				);
				// $insert_id = wp_insert_post( $my_post );
				$insert_id = direct_insert_post( $my_post );

				if ( is_wp_error( $insert_id ) ) {

					$error_string = $insert_id->get_error_message();
					echo '<div id="message" class="error"><p>' . $my_post['post_title'] . ' ' . $error_string . '</p></div>';
					continue;
				} else {

					foreach ( $tmp as $key => $value ) {

						update_post_meta( $insert_id, $key, $value );
					}
				}
			}

			// $insert_data[] = $tmp['usr_id'].'のスケジュール更新に成功しました。';
		}
	}
	return $insert_data;
}

function data_db_get() {
	global $wpdb;
	$results = $wpdb->get_results( 'SELECT * FROM wp_options WHERE option_id = 1', OBJECT );
}
// ---------------------------------------------
// データを登録する
// ---------------------------------------------
function insert_data( $data_list ) {
	// データの格納
	$date = $data_list['sdate'];
	$cnt  = count( $data_list['usrA'] );

	foreach ( $data_list['usrA'] as $usr_id => $value ) {
		$tmp   = array();
		$start = get_time_id( $data_list['usrA'][ $usr_id ] );
		$end   = get_time_id( $data_list['usrB'][ $usr_id ] );

		$tmp['usr_id'] = $usr_id;
		$tmp['time']   = implode( ',', range( $start, $end ) );
		$tmp['date']   = $date;

		$skd_id = get_skd_id( $usr_id, $date );
		if ( $skd_id ) {
			// 登録する
			update_post_meta( $skd_id, 'time', $tmp['time'] );
		} else {
			$my_post                = array();
			$my_post['post_title']  = $tmp['date'] . ' - ' . $tmp['usr_id'];
			$my_post['post_type']   = 'skd';
			$my_post['post_status'] = 'publish';
			$my_post['post_author'] = 1;

			$insert_id = wp_insert_post( $my_post );

			if ( $insert_id > 0 ) {
				update_post_meta( $insert_id, 'usr_id', $tmp['usr_id'] );
				update_post_meta( $insert_id, 'time', $tmp['time'] );
				update_post_meta( $insert_id, 'date', $tmp['date'] );
			}
		}
		$insert_data[] = $tmp;
	}
	return $insert_data;
}

// ---------------------------------------------
// IDを吐き出す
// ---------------------------------------------
function get_time_id( $time, $date = null ) {
	if ( null === $date ) {
		$date = date( 'Y-m-d' );
	}

	$timer_list = array_flip( change_office_time( $date )['list'] );

	list($hour, $minute) = explode( ':', $time );

	$hour   = (int) $hour;
	$minute = (int) $minute;
	$month  = (int) date( 'm' );
	$day    = (int) date( 'd' );
	$year   = (int) date( 'Y' );

	$str        = mktime( $hour, $minute, 0, $month, $day, $year );
	$cinderella = mktime( 24, 0, 0, $month, $day, $year );

	$key     = ( $str >= $cinderella ) ? '24' + date( 'H', $str ) . ':' . date( 'i', $str ) : date( 'H:i', $str );
	$time_id = $timer_list[ $key ];

	return $time_id;
}
function get_beginning_week_date( $ymd ) {
	// もし週始まりを日曜日にするなら、「$w + 1」を「$w」にすればいいはずです
	$w = date( 'w', strtotime( $ymd ) ) - 1;
	// pr($w);
	if ( $w < 0 ) {
		$start_day = strtotime( '-6 day', strtotime( $ymd ) );
	} else {
		$start_day = strtotime( "-{$w} day", strtotime( $ymd ) );
	}
	$beginning_week_date =
	date( 'Y-m-d', $start_day );
	// exit;
	return $beginning_week_date;
}
// ---------------------------------------------
// 近日の日付情報を取得する
// ---------------------------------------------
function get_date_list( $date ) {
	$date_list['date']      = '' !== $date ? $date : date( 'Y-m-d' );
	$date_list['next_date'] = date( 'Y-m-d', strtotime( '+1 day', strtotime( $date_list['date'] ) ) );
	$date_list['prev_date'] = date( 'Y-m-d', strtotime( '-1 day', strtotime( $date_list['date'] ) ) );

	return $date_list;
}

// ---------------------------------------------
// １週間の日付情報を取得する
// ---------------------------------------------
function get_week_list( $date = '' ) {
	$date_list['date']            = '' !== $date ? $date : date( 'Y-m-d' );
	$date_list['next_date']       = date( 'Y-m-d', strtotime( '+7 day', strtotime( $date_list['date'] ) ) );
	$date_list['after_next_date'] = date( 'Y-m-d', strtotime( '+14 day', strtotime( $date_list['date'] ) ) );
	$date_list['prev_date']       = date( 'Y-m-d', strtotime( '-7 day', strtotime( $date_list['date'] ) ) );

	return $date_list;
}

// ---------------------------------------------
// 1日の区間を設定する
// ---------------------------------------------
function get_office_time() {
	// デフォルト値を指定
	// list($hour, $minute)     = explode( ':', get_option( 'cast_office_start_time', '09:00' ) );
	// list($e_hour, $e_minute) = explode( ':', get_option( 'cast_office_end_time', '29:00' ) );
	$hour     = '13';
	$minute   = '00';
	$e_hour   = '24';
	$e_minute = '00';
	// 設定が変わる可能性あり
	$hour     = (int) $hour;
	$minute   = (int) $minute;
	$month    = (int) date( 'm' );
	$day      = (int) date( 'd' );
	$year     = (int) date( 'Y' );
	$e_hour   = (int) $e_hour;
	$e_minute = (int) $e_minute;
	$now      = mktime( $hour, $minute, 0, $month, $day, $year );
	$end      = mktime( $e_hour, $e_minute, 0, $month, $day, $year );
	// $fet = $now + (86400);  //１日分
	$fet = $now + ( $end - $now );

	$step          = ( 60 * 60 * 24 ) / 48;     // 30分刻み
	$arr_time      = range( $now, $fet, $step );
	$cnt           = 1;
	$over_time_flg = false;
	foreach ( $arr_time as $value ) {
		$time = date( 'H:i', ( $value ) );
		if ( '00:00' === $time ) {
			$over_time_flg = true;
		}

		// 24時間経過してたら
		if ( $over_time_flg ) {
			$time = ( 24 + (int) date( 'H', $value ) ) . ':' . date( 'i', $value );
		}

		$timer_list[ $cnt ] = $time;
		++$cnt;
	}
	return $timer_list;
}

function get_costom_office_time() {
	// list($hour, $minute)     = explode( ':', '9:00' );
	// list($e_hour, $e_minute) = explode( ':', get_option( 'cast_office_end_time' ) );
	$hour     = '13';
	$minute   = '00';
	$e_hour   = '24';
	$e_minute = '00';
	// 設定が変わる可能性あり
	$hour     = (int) $hour;
	$minute   = (int) $minute;
	$month    = (int) date( 'm' );
	$day      = (int) date( 'd' );
	$year     = (int) date( 'Y' );
	$e_hour   = (int) $e_hour;
	$e_minute = (int) $e_minute;
	$now      = mktime( $hour, $minute, 0, $month, $day, $year );
	$end      = mktime( $e_hour, $e_minute, 0, $month, $day, $year );
	// $fet = $now + (86400);  //１日分
	$fet = $now + ( $end - $now );

	$step     = ( 60 * 60 * 24 ) / 48;     // 30分刻み
	$arr_time = range( $now, $fet, $step );
	$cnt      = 1;
	foreach ( $arr_time as $value ) {
		$time = date( 'H:i', ( $value ) );
		if ( '00:00' === $time ) {
			$over_time_flg = 1;
		}

		// 24時間経過してたら
		if ( isset( $over_time_flg ) && true === $over_time_flg ) {
			$time = ( 24 + (int) date( 'H', $value ) ) . ':' . date( 'i', $value );
		}

		$timer_list[ $cnt ] = $time;
		++$cnt;
	}
	return $timer_list;
}

// ---------------------------------------------
// 1日の区間を日付によって切り替える
// ---------------------------------------------
function change_office_time( $date ) {
	$arr = array( '2018-12-31', '2019-01-01', '2019-01-02' );
	if ( in_array( $date, $arr, true ) ) {
		$list  = get_costom_office_time();
		$start = '13:00';
	} else {
		$list  = get_office_time();
		$start = '13:00';
	}
	return array(
		'list'  => $list,
		'start' => $start,
	);
}

// ---------------------------------------------
// 設定で利用する時間配列
// ---------------------------------------------
function set_office_time_list() {

	$month = (int) date( 'm' );
	$day   = (int) date( 'd' );
	$year  = (int) date( 'Y' );

	$now = mktime( 0, 0, 0, $month, $day, $year );

	$e_hour   = OFFICE_ENDHOUR;
	$e_minute = 0;
	$end      = mktime( $e_hour, $e_minute, 0, $month, $day, $year );

	$fet = $now + ( $end - $now );

	$step     = ( 60 * 60 * 24 ) / 48;     // 30分刻み
	$arr_time = range( $now, $fet, $step );

	$cnt = 1;
	foreach ( $arr_time as $value ) {
		$time = date( 'H:i', ( $value ) );
		if ( $cnt > 48 ) {
			$time = ( 24 + (int) date( 'H', $value ) ) . ':' . date( 'i', $value );
		}
		$timer_list[ $cnt ] = $time;
		++$cnt;
	}
	return $timer_list;
}

// ---------------------------------------------
// 何曜日か取得する
// ---------------------------------------------
function get_week_data( $date, $lng = 'en' ) {
	if ( 'en' === $lng ) {
		$week_list = array( 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' );
	} elseif ( 'ja' === $lng ) {
		$week_list = array( '日', '月', '火', '水', '木', '金', '土' );
		// $week_list = array('日曜日','月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日');
	}

	$week = date( 'w', strtotime( $date ) );
	return $week_list[ $week ];
}

// --------------------------------------------------------
// 何日空いているか取得
// --------------------------------------------------------
function get_diff_date( $a, $b ) {
	// 日付をUNIXタイムスタンプに変換
	if ( '0000-00-00' === $a ) {
		$a = date( 'Y-m-d' );
	}

	$time_stamp1 = strtotime( $a );
	$time_stamp2 = strtotime( $b );

	// 何秒離れているかを計算(絶対値)
	$second_diff = abs( $time_stamp2 - $time_stamp1 );

	// 日数に変換
	return $second_diff / ( 60 * 60 * 24 );
}

function get_office_day( $day ) {
	$office_time = OFFICE_SWITCH_TIME;
	$day_        = date( 'G' ) < $office_time ? $day - 1 : $day;
	$day_        = $day_ > 0 ? '+' . $day_ : $day_;
	return $day_ . ' day';
}

// wpdbで直接データベースに保存する。
function direct_insert_post( $data ) {
	global $wpdb;
	$val = array();
	foreach ( $data as $key => $value ) {
		if ( is_float( $value ) ) {
			$val[] = '%f';
		} elseif ( is_int( $value ) ) {
			$val[] = '%d';
		} else {
			$val[] = '%s';
		}
	}
	$res = $wpdb->insert( $wpdb->posts, $data, $val );
	if ( false === $res ) {
		return new WP_Error( 'database error', 'データの保存に失敗しました。' );
	} else {
		$post_ID = $wpdb->insert_id;
		$wpdb->update( $wpdb->posts, array( 'guid' => get_permalink( $post_ID ) ), array( 'ID' => $post_ID ) );
		return $post_ID;
	}
}

// データベースから重複したレコードを削除
function delete_duplication_record() {

	global $wpdb;
	$results = $wpdb->get_results(
		"
		SELECT ID
		FROM $wpdb->posts
		WHERE post_type='skd'
		GROUP BY post_name HAVING COUNT(*) > 1
		"
	);
	if ( ! empty( $results ) ) {
		foreach ( $results as $result ) {
			wp_delete_post( $result->ID, true );
		}
	}
}

// 店舗設定情報を取得する関数群

/**
 * 店舗名を取得する
 *
 * @return string 店舗名
 */
function chance_get_store_name() {
	return get_option( 'work_manager_store_name', '' );
}

/**
 * 電話番号を取得する
 *
 * @return string 電話番号
 */
function chance_get_store_phone() {
	return get_option( 'work_manager_phone', '' );
}

/**
 * メールアドレスを取得する
 *
 * @return string メールアドレス
 */
function chance_get_store_email() {
	return get_option( 'work_manager_email', '' );
}

/**
 * Google Tag Manager ID を取得する
 *
 * @return string GTM ID
 */
function chance_get_gtm_id() {
	return get_option( 'work_manager_gtm_id', '' );
}

/**
 * Clarity Tracking ID を取得する
 *
 * @return string Clarity ID
 */
function chance_get_clarity_id() {
	return get_option( 'work_manager_clarity_id', '' );
}

/**
 * 店舗のX（旧Twitter）IDを取得する
 *
 * @return string X（旧Twitter）ID
 */
function chance_get_x_id() {
	return get_option( 'work_manager_x_id', 'CHANCE_OKUBO' ); // デフォルト値として現在のIDを設定
}

/**
 * 予約満了表示のスタッフを末尾へ並べ替える
 *
 * @param array $users_data 並べ替え対象のユーザーデータ配列
 * @return array 並べ替え後の配列
 */
function reorder_reservation_full_to_end( $users_data ) {
	usort(
		$users_data,
		function ( $a, $b ) {
			$a_full = strpos( $a['ladywork_txt'], '予約満了' ) !== false ? 1 : 0;
			$b_full = strpos( $b['ladywork_txt'], '予約満了' ) !== false ? 1 : 0;
			return $a_full - $b_full;
		}
	);

	return $users_data;
}

/**
 * 本日出勤のスタッフデータを取得
 *
 * @param  string $date 取得する日付。空の場合は現在の日付を使用。
 * @return array        出勤スタッフのデータ配列。
 */
function get_today_staff( $date = '' ) {
	if ( '' === $date ) {
		$date = current_time( 'Y-m-d' );
	}
	$args          = array(
		'nopaging'               => true,
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
		'post_type'              => 'skd',
		'meta_query'             => array(
			'relation' => 'AND',
			array(
				'key'   => 'confirm',
				'value' => 'true',
			),
			array(
				'key'   => 'date',
				'value' => $date,
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '休み',
				'compare' => 'NOT LIKE',
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '名古屋勤務',
				'compare' => 'NOT LIKE',
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '大阪勤務',
				'compare' => 'NOT LIKE',
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '東京勤務',
				'compare' => 'NOT LIKE',
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '難波勤務',
				'compare' => 'NOT LIKE',
			),
		),
		'order'                  => 'ASC',
		'orderby'                => 'menu_order',
	);
	$the_query     = new WP_Query( $args );
	$shift_data    = array();
	$set_time_list = change_office_time( $date )['list'];
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$time      = get_post_meta( get_the_ID(), 'time', true );
			$time_list = explode( ',', $time );
			$start     = $time_list[0];
			$end       = $time_list[ count( $time_list ) - 1 ];
			$start     = ( $start ) ? $set_time_list[ $start ] : $set_time_list[1];
			$end       = ( $end ) ? $set_time_list[ $end ] : $set_time_list[1];
			$ladywork  = get_post_meta( get_the_ID(), 'ladywork_txt', true );
			if ( '1' === $time && '' === $ladywork ) {
				continue;
			}
			$user_id      = get_post_meta( get_the_ID(), 'usr_id', true );
			$shift_data[] = array(
				'id'           => $user_id,
				'ladywork_txt' => $ladywork,
				'start'        => $start,
				'end'          => $end,
				'towork'       => ( $start === $end ) ? '-' : $start . '～' . $end,
			);
		}

		// すべてのcastを取得する
		$args       = array(
			'post_type'   => 'cast',
			'nopaging'    => true,
			'post_status' => 'publish',
			'orderby'     => 'menu_order',
			'order'       => 'ASC',
		);
		$the_query  = new WP_Query( $args );
		$users_data = array();
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$user_id = get_the_ID();

			// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict -- $shift_data 内の ID は WP_Query の結果と型が揃わないケースがあるため
			if ( ! in_array( $user_id, array_column( $shift_data, 'id' ) ) ) {
				continue;
			}
			// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict -- $shift_data 内の ID は WP_Query の結果と型が揃わないケースがあるため
			$shift_data_index = array_search( $user_id, array_column( $shift_data, 'id' ) );
			$user_post        = get_post( $user_id );
			$images           = get_post_meta( $user_id, 'myupload_images', true );
			$image            = CAST_NO_IMAGE;
			if ( $images ) {
				$image = wp_get_attachment_image_src( $images[0], 'cast_thumb_top' )[0];
			}
			$users_data[] = array(
				'id'           => $user_id,
				'start'        => $shift_data[ $shift_data_index ]['start'],
				'end'          => $shift_data[ $shift_data_index ]['end'],
				'towork'       => $shift_data[ $shift_data_index ]['towork'],
				'ladywork_txt' => $shift_data[ $shift_data_index ]['ladywork_txt'],
				'slug'         => $user_post->post_name,
				'name'         => $user_post->post_title,
				'image'        => $image,
				'height'       => get_post_meta( $user_id, 'am-height', true ),
				'weight'       => get_post_meta( $user_id, 'am-weight', true ),
				'age'          => get_post_meta( $user_id, 'am-age', true ),
				'icon'         => get_post_meta( $user_id, 'am-icon', true ),
			);
		}
	} else {
		return array();
	}
	wp_reset_postdata();

	$users_data = reorder_reservation_full_to_end( $users_data );

	return $users_data;
}

function get_today_staff_en( $date = '' ) {
	if ( '' === $date ) {
		$date = current_time( 'Y-m-d' );
	}
	$args          = array(
		'nopaging'               => true,
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
		'post_type'              => 'skd',
		'meta_query'             => array(
			'relation' => 'AND',
			array(
				'key'   => 'confirm',
				'value' => 'true',
			),
			array(
				'key'   => 'date',
				'value' => $date,
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '休み',
				'compare' => 'NOT LIKE',
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '名古屋勤務',
				'compare' => 'NOT LIKE',
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '大阪勤務',
				'compare' => 'NOT LIKE',
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '東京勤務',
				'compare' => 'NOT LIKE',
			),
			array(
				'key'     => 'ladywork_txt',
				'value'   => '難波勤務',
				'compare' => 'NOT LIKE',
			),
		),
		'order'                  => 'ASC',
		'orderby'                => 'menu_order',
	);
	$the_query     = new WP_Query( $args );
	$shift_data    = array();
	$set_time_list = change_office_time( $date )['list'];
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$time      = get_post_meta( get_the_ID(), 'time', true );
			$time_list = explode( ',', $time );
			$start     = $time_list[0];
			$end       = $time_list[ count( $time_list ) - 1 ];
			$start     = ( $start ) ? $set_time_list[ $start ] : $set_time_list[1];
			$end       = ( $end ) ? $set_time_list[ $end ] : $set_time_list[1];
			$ladywork  = get_post_meta( get_the_ID(), 'ladywork_txt', true );
			if ( '1' === $time && '' === $ladywork ) {
				continue;
			}
			$user_id      = get_post_meta( get_the_ID(), 'usr_id', true );
			$shift_data[] = array(
				'id'           => $user_id,
				'ladywork_txt' => $ladywork,
				'start'        => $start,
				'end'          => $end,
				'towork'       => ( $start === $end ) ? '-' : $start . '～' . $end,
			);
		}

		// すべてのcastを取得する
		$args       = array(
			'post_type'   => 'cast',
			'nopaging'    => true,
			'post_status' => 'publish',
			'orderby'     => 'menu_order',
			'order'       => 'ASC',
		);
		$the_query  = new WP_Query( $args );
		$users_data = array();
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$user_id = get_the_ID();

			// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict -- $shift_data 内の ID は WP_Query の結果と型が揃わないケースがあるため
			if ( ! in_array( $user_id, array_column( $shift_data, 'id' ) ) ) {
				continue;
			}
			// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict -- $shift_data 内の ID は WP_Query の結果と型が揃わないケースがあるため
			$shift_data_index = array_search( $user_id, array_column( $shift_data, 'id' ) );
			$user_post        = get_post( $user_id );
			$images           = get_post_meta( $user_id, 'myupload_images', true );
			$image            = CAST_NO_IMAGE;
			if ( $images ) {
				$image = wp_get_attachment_image_src( $images[0], 'cast_thumb_top' )[0];
			}
			$users_data[] = array(
				'id'           => $user_id,
				'start'        => $shift_data[ $shift_data_index ]['start'],
				'end'          => $shift_data[ $shift_data_index ]['end'],
				'towork'       => $shift_data[ $shift_data_index ]['towork'],
				'ladywork_txt' => $shift_data[ $shift_data_index ]['ladywork_txt'],
				'slug'         => $user_post->post_name,
				'name'         => get_post_meta( $user_id, 'am-name-en', true ),
				'image'        => $image,
				'height'       => get_post_meta( $user_id, 'am-height', true ),
				'weight'       => get_post_meta( $user_id, 'am-weight', true ),
				'age'          => get_post_meta( $user_id, 'am-age', true ),
				'icon'         => get_post_meta( $user_id, 'am-icon', true ),
			);
		}
	} else {
		return array();
	}
	wp_reset_postdata();

	$users_data = reorder_reservation_full_to_end( $users_data );

	return $users_data;
}
