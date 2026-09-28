<?php

/******************************************************
 *
 * 独自関数
 *
 *******************************************************/
// デバイス判定

function is_mobile() {
	$useragents = array(
		'iPhone',          // iPhone
		'iPod',            // iPod touch
		'Android',         // 1.5+ Android
		'dream',           // Pre 1.5 Android
		'CUPCAKE',         // 1.5+ Android
		'webOS',           // Palm Pre Experimental
		'incognito',       // Other iPhone browser
		'webmate',          // Other iPhone browser
	);
	$pattern    = '/' . implode( '|', $useragents ) . '/i';
	return preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );
}
function is_bot() {
	$bot_list = array(
		'Googlebot',
		'Yahoo! Slurp',
		'Mediapartners-Google',
		'msnbot',
		'bingbot',
		'MJ12bot',
		'Ezooms',
		'pirst; MSIE 8.0;',
		'Google Web Preview',
		'ia_archiver',
		'Sogou web spider',
		'Googlebot-Mobile',
		'AhrefsBot',
		'YandexBot',
		'Purebot',
		'Baiduspider',
		'UnwindFetchor',
		'TweetmemeBot',
		'MetaURI',
		'PaperLiBot',
		'Showyoubot',
		'JS-Kit',
		'PostRank',
		'Crowsnest',
		'PycURL',
		'bitlybot',
		'Hatena',
		'facebookexternalhit',
		'NINJA bot',
		'YahooCacheSystem',
		'Twitterbot',
		'bot',
		'Google',
		'google',
	);
	$is_bot   = false;
	foreach ( $bot_list as $bot ) {
		if ( stripos( $_SERVER['HTTP_USER_AGENT'], $bot ) !== false ) {
			$is_bot = true;
			break;
		}
	}
	return $is_bot;
}

//固定ページで親をもっているか判定
function is_subpage() {
	global $post;
	if ( is_array( $post ) ) {
		$post = $post[0];
	}
	if ( is_page() && $post->post_parent ) {
		$parent_i_d = $post->post_parent;
		return $parent_i_d;
	} else {
		return false;
	}
}

// mainタグのクラスを取得する
function get_main_class() {
	if ( is_home() || is_front_page() ) {
		return 'top_main';
	} else {
		return 'sub_main';
	}
}



//指定した日から1週間の全スケジュール取得　ループ前に使用
function get_week_schedule( $day = '' ) {
	if ( empty( $day ) ) {
		$day = date( 'Y-m-d', strtotime( 'now' ) );
	} else {
		$day = date( 'Y-m-d', strtotime( $day ) );
	}
	$week      = date( 'Y-m-d', strtotime( '+13 day', strtotime( $day ) ) );
	$search    = array( $day, $week );
	$args      = array(
		'post_type'              => 'skd',
		'nopaging'               => true,
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
		'order'                  => 'ASC',
		'orderby'                => 'meta_value',
		'meta_query'             => array(
			array(
				'value'   => $search,
				'key'     => 'date',
				'compare' => 'BETWEEN',
				'type'    => 'DATE',
			),
		),
	);
	$the_query = new WP_Query( $args );

	$set_time_list = get_office_time();

	$data = array();

	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$user_id       = get_post_meta( get_the_ID(), 'usr_id', true );
			$date          = get_post_meta( get_the_ID(), 'date', true );
			$set_time_list = change_office_time( $date )['list'];
			$ladywork_txt  = get_post_meta( get_the_ID(), 'ladywork_txt', true );
			$confirm       = get_post_meta( get_the_ID(), 'confirm', true );
			$time          = get_post_meta( get_the_ID(), 'time', true );
			$time_list     = explode( ',', $time );
			$start         = $time_list[0];
			$end           = $time_list[ count( $time_list ) - 1 ];
			if ( ! empty( $confirm ) && 'true' === $confirm ) {

				$data[ $user_id ][ $date ]['start']        = ( $start ) ? $set_time_list[ $start ] : $set_time_list[1];
				$data[ $user_id ][ $date ]['end']          = ( $end ) ? $set_time_list[ $end ] : $set_time_list[1];
				$data[ $user_id ][ $date ]['ladywork_txt'] = $ladywork_txt;
			}

		endwhile;
	endif;
	wp_reset_postdata();
	krsort( $data );

	return $data;
}
// キャストごとの2週間分のスケジュール取得
function get_cast_2week_schedule( $cast_id ) {
	$start_day = date( 'Y-m-d', strtotime( 'now' ) );
	$end_day   = date( 'Y-m-d', strtotime( '+13 day', strtotime( 'now' ) ) );
	$search    = array( $start_day, $end_day );

	$args      = array(
		'post_type'              => 'skd',
		'nopaging'               => true,
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
		'order'                  => 'ASC',
		'orderby'                => 'meta_value',
		'meta_key'               => 'date',
		'meta_query'             => array(
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
	$the_query = new WP_Query( $args );

	$set_time_list = get_office_time();

	$data = array();

	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$date          = get_post_meta( get_the_ID(), 'date', true );
			$set_time_list = change_office_time( $date )['list'];
			$ladywork_txt  = get_post_meta( get_the_ID(), 'ladywork_txt', true );
			$confirm       = get_post_meta( get_the_ID(), 'confirm', true );
			$time          = get_post_meta( get_the_ID(), 'time', true );
			$time_list     = explode( ',', $time );
			$start         = $time_list[0];
			$end           = $time_list[ count( $time_list ) - 1 ];
			if ( ! empty( $confirm ) && 'true' === $confirm ) {
				$data[ $date ]['start']        = ( $start ) ? $set_time_list[ $start ] : $set_time_list[1];
				$data[ $date ]['end']          = ( $end ) ? $set_time_list[ $end ] : $set_time_list[1];
				$data[ $date ]['ladywork_txt'] = $ladywork_txt;
			}
		endwhile;
	endif;
	wp_reset_postdata();

	return $data;
}
// スケジュールページ
function get_daily_schedules( $filter = null ) {
	$schedules   = array( array(), array(), array(), array(), array(), array(), array(), array(), array(), array(), array(), array(), array(), array() );
	$allschedule = get_week_schedule();
	$args        = array(
		'nopaging'               => true,
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
		'post_type'              => 'cast',
		'post_status'            => 'publish',
	);
	$the_query   = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$images = get_post_meta( get_the_ID(), 'myupload_images', true );
			$image  = LW_NO_IMAGE;
			if ( $images ) {
				$image = wp_get_attachment_image_src( $images[0], 'cast_thumb_top' )[0];
			}
			$schedule = ( ! empty( $allschedule[ get_the_ID() ] ) ) ? $allschedule[ get_the_ID() ] : '';
			$name     = get_the_title();
			$height   = str_replace( 'cm', '', get_post_meta( get_the_ID(), 'am-height', true ) );
			$weight   = str_replace( 'kg', '', get_post_meta( get_the_ID(), 'am-weight', true ) );
			$age      = str_replace( '歳', '', get_post_meta( get_the_ID(), 'am-age', true ) );
			$prof     = $height . 'ｘ' . $weight . 'ｘ' . $age;
			// スタッフのページのリンク
			$link = get_permalink();
			for ( $i = 0; $i < 14; $i++ ) {
				$date = date( 'Y-m-d', strtotime( '+' . $i . ' day' ) );
				if ( ! empty( $schedule[ $date ] ) ) {
					$ladywork_txt = $schedule[ $date ]['ladywork_txt'];
					if ( '休み' === $ladywork_txt || ( false !== strpos( $ladywork_txt, '名古屋勤務' ) ) || ( false !== strpos( $ladywork_txt, '大阪勤務' ) ) || ( false !== strpos( $ladywork_txt, '東京勤務' ) ) || ( false !== strpos( $ladywork_txt, '難波勤務' ) ) ) {
						continue;
					}
					$start = $schedule[ $date ]['start'];
					$end   = $schedule[ $date ]['end'];
					if ( $start === $end ) {
						continue;
					}
					$towork            = ( $start === $end ) ? '-' : $start . '～' . $end;
					$schedules[ $i ][] = array(
						'name'         => $name,
						'thumb'        => $image,
						'link'         => $link,
						'prof'         => $prof,
						'ladywork_txt' => $ladywork_txt,
						'start'        => $start,
						'end'          => $end,
						'towork'       => $towork,
						'icon'         => get_post_meta( get_the_ID(), 'am-icon', true ),
					);
				}
			}
		}
	}
	wp_reset_postdata();
	if ( $filter ) {
		return $schedules[ $filter - 1 ];
	}
	return $schedules;
}

// サイトオープンまでの日にち取得
function get_opendate() {
	$open_date = strtotime( '2018-05-01' );
	$today     = strtotime( 'now' );

	$dif = $open_date - $today;

	$count = ( strtotime( date( 'Y-m-d', $dif ) ) - strtotime( '1970-01-01' ) ) / 86400;

	return $count + 1;
}

// メールの本文取得
function get_my_mail_template( $lang = 'ja' ) {
	if ( 'ja' === $lang ) {
		$mail = <<<__TEXT__
●10％が手数料として必要となります●%0d%0a
※ 手数料についてご同意頂けましたら下記項目を全てご入力の上ご返信下さい。%0d%0a
%0a
【お客様本名】%0d%0a
【お電話番号】%0d%0a
【現在予約日】〇月〇日（）〇：〇時～%0d%0a
【コース】個室or出張　〇分コース%0d%0a
【ボーイ】〇君%0d%0a
%0a
ご予約確定後、決済URLをお送りさせて頂きます。%0d%0a
現在ご予約頂いている日時を正確にご入力下さい。%0d%0a
%0a
ご予約確定前の決済は行えません。
__TEXT__;
	} else {
		$mail = <<<__TEXT__
●A 10% fee is required●%0d%0a
If you agree to the fee, please fill out all the items below and reply.%0d%0a
%0a
【Your Full Name】%0d%0a
【Phone Number】%0d%0a
【Current Reservation Date】xx/xx xx:xx～%0d%0a
【Course】Private or Outcall xx-minute course%0d%0a
【Boy】xx-kun%0d%0a
%0a
After confirming your reservation, we will send you the payment URL.%0d%0a
Please enter the date and time you have currently reserved accurately.%0d%0a
%0a
Payment cannot be made before the reservation is confirmed.
__TEXT__;
	}
	return $mail;
}


function get_asset_version() {
	$my_theme = wp_get_theme();
	return $my_theme->get( 'Version' );
}
