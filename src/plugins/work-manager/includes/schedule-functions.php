<?php
/**
 * スケジュール関連の関数
 *
 * @package Work_Manager
 */

/**
 * スタッフの出勤情報テキストを取得
 *
 * @param string $start 出勤時間
 * @param string $end   退勤時間
 * @param string $ladywork_txt 出勤情報
 * @return string 出勤情報のテキスト
 */
function chance_get_schedule_text( $start = '', $end = '', $ladywork_txt = '' ) {
	if ( '休み' === $ladywork_txt ) {
		$text = '休み';
	} elseif ( strpos( $ladywork_txt, '予約満了' ) !== false ) {
		$text = '<span class="red">ご予約満了</span>';
	} elseif ( strpos( $ladywork_txt, '名古屋勤務' ) !== false ) {
		$text = '<span class="sky">名古屋勤務</span>';
	} elseif ( strpos( $ladywork_txt, '大阪勤務' ) !== false ) {
		$text = '<span class="green">大阪勤務</span>';
	} elseif ( strpos( $ladywork_txt, '東京勤務' ) !== false ) {
		$text = '<span class="red">東京勤務</span>';
	} elseif ( strpos( $ladywork_txt, '難波勤務' ) !== false ) {
		$text = '<span class="purple">難波勤務</span>';
	} elseif ( $start === $end && empty( $ladywork_txt ) ) {
		$text = '未定';
	} else {
		$text = '';
		if ( $start !== $end ) {
			$text  = ( ! empty( $start ) ) ? $start : '';
			$text .= ( ! empty( $start ) || ! empty( $end ) ) ? '-' : '';
			$text .= ( ! empty( $end ) ) ? $end : '';
		}
		if ( ! empty( $text ) ) {
			$text .= '<br>';
		}
		if ( ! empty( $ladywork_txt ) ) {
			$text .= nl2br( $ladywork_txt );
		}
	}

	return $text;
}

/**
 * 該当キャストの2週間分の出勤情報を取得
 *
 * @param int|null $cast_id キャストのID。指定しない場合は現在の投稿のIDを使用。
 *
 * @return array 出勤情報の配列。各要素は日付、開始時間、終了時間、出勤情報のテキストを含む連想配列。
 */
function chance_get_cast_schedule( $cast_id = null ) {
	$cast_id   = $cast_id ? $cast_id : get_the_ID();
	$today     = current_time( 'Y-m-d' );
	$next_week = date( 'Y-m-d', strtotime( '14 days', current_time( 'timestamp' ) ) );
	$search    = array( $today, $next_week );
	$args      = array(
		'post_type'      => 'skd',
		'posts_per_page' => -1,
		'order'          => 'ASC',
		'orderby'        => 'meta_value',
		'meta_query'     => array(
			array(
				'value'   => $search,
				'key'     => 'date',
				'compare' => 'BETWEEN',
				'type'    => 'DATE',
			),
			array(
				'key'   => 'usr_id',
				'value' => $cast_id,
			),
		),
	);
	$query     = new WP_Query( $args );
	$schedule  = array();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$confirm = get_post_meta( get_the_ID(), 'confirm', true );
			$post_id = get_the_ID();
			$date    = get_post_meta( $post_id, 'date', true );
			if ( 'true' === $confirm ) {
				$set_time_list = change_office_time( $date )['list'];
				$post_id       = get_the_ID(); // Fixed to use get_the_ID()
				$time          = get_post_meta( $post_id, 'time', true );
				$time_list     = explode( ',', $time );
				$start         = $time_list[0];
				$end           = $time_list[ count( $time_list ) - 1 ];
				$ladywork_txt  = get_post_meta(
					get_the_ID(),
					'ladywork_txt',
					true
				);

				$schedule[ $date ] = array(
					'time'         => array(
						'start' => ( $start )
							? $set_time_list[ $start ]
							: $set_time_list[1],
						'end'   => ( $end ) ? $set_time_list[ $end ] : $set_time_list[1],
					),
					'ladywork_txt' => $ladywork_txt,
				);
			}
		}
	}
	wp_reset_postdata();
	$result = array();
	//14日分のスケジュールを取得
	for ( $i = 0; $i < 14; $i++ ) {
		$date      = date( 'Y-m-d', strtotime( '+' . $i . ' days', current_time( 'timestamp' ) ) );
		$data_text = ( $date === $today ) ? '本日' : date( 'm/d', strtotime( $date ) ) . ' (' . get_week_data( date( 'Y-m-d', strtotime( $date ) ), 'ja' ) . ')';
		if ( isset( $schedule[ $date ] ) ) {
			$result[] = array(
				'date'         => $data_text,
				'time'         => $schedule[ $date ]['time'],
				'ladywork_txt' => $schedule[ $date ]['ladywork_txt'],
			);
		} else {
			$result[] = array(
				'date'         => $data_text,
				'time'         => array(
					'start' => '12:00',
					'end'   => '12:00',
				),
				'ladywork_txt' => '未定',
			);
		}
	}

	return $result;
}
function chance_get_cast_schedule_en( $cast_id = null ) {
	$cast_id   = $cast_id ? $cast_id : get_the_ID();
	$today     = current_time( 'Y-m-d' );
	$next_week = date( 'Y-m-d', strtotime( '14 days', current_time( 'timestamp' ) ) );
	$search    = array( $today, $next_week );
	$args      = array(
		'post_type'      => 'skd',
		'posts_per_page' => -1,
		'order'          => 'ASC',
		'orderby'        => 'meta_value',
		'meta_query'     => array(
			array(
				'value'   => $search,
				'key'     => 'date',
				'compare' => 'BETWEEN',
				'type'    => 'DATE',
			),
			array(
				'key'   => 'usr_id',
				'value' => $cast_id,
			),
		),
	);
	$query     = new WP_Query( $args );
	$schedule  = array();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$confirm = get_post_meta( get_the_ID(), 'confirm', true );
			$post_id = get_the_ID();
			$date    = get_post_meta( $post_id, 'date', true );
			if ( 'true' === $confirm ) {
				$set_time_list = change_office_time( $date )['list'];
				$post_id       = get_the_ID(); // Fixed to use get_the_ID()
				$time          = get_post_meta( $post_id, 'time', true );
				$time_list     = explode( ',', $time );
				$start         = $time_list[0];
				$end           = $time_list[ count( $time_list ) - 1 ];
				$ladywork_txt  = get_post_meta(
					get_the_ID(),
					'ladywork_txt',
					true
				);

				$schedule[ $date ] = array(
					'time'         => array(
						'start' => ( $start )
							? $set_time_list[ $start ]
							: $set_time_list[1],
						'end'   => ( $end ) ? $set_time_list[ $end ] : $set_time_list[1],
					),
					'ladywork_txt' => $ladywork_txt,
				);
			}
		}
	}
	wp_reset_postdata();
	$result = array();
	//14日分のスケジュールを取得
	for ( $i = 0; $i < 14; $i++ ) {
		$date      = date( 'Y-m-d', strtotime( '+' . $i . ' days', current_time( 'timestamp' ) ) );
		$data_text = ( $date === $today ) ? 'Today' : date( 'm/d', strtotime( $date ) ) . ' (' . get_week_data( date( 'Y-m-d', strtotime( $date ) ), 'en' ) . ')';
		if ( isset( $schedule[ $date ] ) ) {
			switch ( $schedule[ $date ]['ladywork_txt'] ) {
				case '休み':
					$ladywork_txt = 'Rest';
					break;
				case '予約満了':
					$ladywork_txt = 'Full';
					break;
				case '名古屋勤務':
					$ladywork_txt = 'Nagoya';
					break;
				case '大阪勤務':
					$ladywork_txt = 'Osaka';
					break;
				case '東京勤務':
					$ladywork_txt = 'Tokyo';
					break;
				case '難波勤務':
					$ladywork_txt = 'Namba';
					break;
				case '未定':
					$ladywork_txt = 'Not yet';
					break;
				default:
					$ladywork_txt = $schedule[ $date ]['ladywork_txt'];
					break;
			}
			$ladywork_txt = str_replace( '要問', 'Ask', $ladywork_txt );
			$ladywork_txt = str_replace( '前日', 'Ask', $ladywork_txt );
			$ladywork_txt = str_replace( '泊り', 'Stay', $ladywork_txt );

			$result[] = array(
				'date'         => $data_text,
				'time'         => $schedule[ $date ]['time'],
				'ladywork_txt' => $ladywork_txt,
			);
		} else {
			$result[] = array(
				'date'         => $data_text,
				'time'         => array(
					'start' => '12:00',
					'end'   => '12:00',
				),
				'ladywork_txt' => 'Not yet',
			);
		}
	}

	return $result;
}

/**
 * スタッフの詳細情報を取得
 *
 * @param int $id スタッフのID
 *
 * @return array スタッフの詳細情報
 */
function chance_get_staff_data( $id = '' ) {
	if ( empty( $id ) ) {
		return;
	}

	// グローバル変数に依存せず、$idを使用する
	$post = get_post( $id );

	if ( ! $post ) {
		return array();
	}

	$imageids   = get_post_meta( $post->ID, 'myupload_images', true );
	$main_image = defined( 'CAST_NO_IMAGE' ) ? CAST_NO_IMAGE : LW_NO_IMAGE;
	if ( is_array( $imageids ) && ! empty( $imageids ) ) {
		$main_image = wp_get_attachment_image_src( $imageids[0], 'single_cast' )[0];
	}

	$images          = array();
	$thumbnail_image = array();
	if ( is_array( $imageids ) && 1 < count( $imageids ) ) {
		$imageids = array_slice( $imageids, 1 );
		foreach ( $imageids as $id ) {
			$images[]          = wp_get_attachment_image_src( $id, 'single_cast' )[0];
			$thumbnail_image[] = wp_get_attachment_image_src( $id, 'single_cast_thumb' )[0];
		}
	}
	if ( empty( $images ) ) {
		$images = array( defined( 'CAST_NO_IMAGE' ) ? CAST_NO_IMAGE : LW_NO_IMAGE );
	}
	if ( empty( $thumbnail_image ) ) {
		$thumbnail_image = array( defined( 'CAST_NO_IMAGE' ) ? CAST_NO_IMAGE : LW_NO_IMAGE );
	}
	$moza            = get_post_meta( $post->ID, 'am-mozaBtn', true );
	$mail            = get_post_meta( $post->ID, 'am-addressMail', true );
	$twitter         = get_post_meta( $post->ID, 'am-urlTwitter', true );
	$line            = get_post_meta( $post->ID, 'am-urlLine', true );
	$additional_btns = array(
		'moza'    => ( 'no' !== $moza ) ? $moza : '',
		'mail'    => $mail,
		'twitter' => $twitter,
		'line'    => $line,
	);
	$additional_btns = array_keys( array_filter( $additional_btns ) );
	// additional_btnsの数が３つ以上の場合は、最初の3つを取得
	if ( count( $additional_btns ) > 3 ) {
		$additional_btns = array_slice( $additional_btns, 0, 3 );
	}

	$data = array(
		'name'              => get_the_title(), // スタッフの名前
		'name_en'           => get_post_meta( $post->ID, 'am-name-en', true ), // 英語表記名
		// アイコン
		'icon'              => get_post_meta( $post->ID, 'am-icon', true ),

		// プロフィール
		'height'            => get_post_meta( $post->ID, 'am-height', true ), // 身長
		'weight'            => get_post_meta( $post->ID, 'am-weight', true ), //体重
		'age'               => get_post_meta( $post->ID, 'am-age', true ), //年齢
		'sexuality'         => get_post_meta( $post->ID, 'am-sexuality', true ), //セクシャリティ
		'size'              => get_post_meta( $post->ID, 'am-size', true ), //Pサイズ

		// プレイ内容
		'optBUke'           => get_post_meta( $post->ID, 'am-optBUke', true ), //バックウケ
		'optBTachi'         => get_post_meta( $post->ID, 'am-optBTachi', true ), //バックタチ
		'opt3p4p'           => get_post_meta( $post->ID, 'am-opt3p4p', true ), //3P・4P
		'optTachi'          => get_post_meta( $post->ID, 'am-optTachi', true ), //ボーイ絡み
		'optSoftSM'         => get_post_meta( $post->ID, 'am-optSoftSM', true ), //ソフトSM
		'optOna'            => get_post_meta( $post->ID, 'am-optOna', true ), //オナニー鑑賞

		// ボタン
		'mozaBtn'           => $moza, //モザイクなし画像
		'addressMail'       => $mail, //メールアドレス
		'urlTwitter'        => $twitter, //ツイッターURL
		'urlLine'           => $line, //LINE
		'additional_btns'   => $additional_btns,

		// コメント
		'commentManager'    => get_post_meta( $post->ID, 'am-commentManager', true ), //マネージャーコメント
		'reviewBoys'        => get_post_meta( $post->ID, 'am-reviewBoys', true ), //ボーイレビュー

		// 英語版コンテンツ
		'introduction_en'   => get_post_meta( $post->ID, 'cast_introduction_en', true ), //自己紹介文（英語版）
		'commentManager_en' => get_post_meta( $post->ID, 'cast_manager_comment_en', true ), //マネージャーコメント（英語版）
		'reviewBoys_en'     => get_post_meta( $post->ID, 'cast_boy_review_en', true ), //ボーイレビュー（英語版）

		// スタッフの画像
		'images'            => $images, // スタッフの画像
		'thumbnail'         => $thumbnail_image, // スタッフの画像サムネイル
		'main_image'        => $main_image, // スタッフのメイン画像
	);

	return $data;
}
