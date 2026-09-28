<?php
/**
 * 全てのスタッフを取得
 *
 * @return WP_Query 全ての公開中のスタッフのクエリオブジェクト
 */
function get_all_staff() {
	$args  = array(
		'nopaging'               => true,
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
		'post_type'              => 'cast',
		'post_status'            => 'publish',
	);
	$query = new WP_Query( $args );
	return $query;
}

function get_shop_staffs( $shop = 'shinjuku-gyoen' ) {
	$shop_meta_key = 'am-shop';
	if ( 'shinjuku-gyoen' === $shop ) {
		$shop_meta_key = 'am-shop';
	} elseif ( 'nagoya' === $shop ) {
		$shop_meta_key = 'am-shop-nagoya';
	}
	$args  = array(
		'nopaging'               => true,
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
		'post_type'              => 'cast',
		'post_status'            => 'publish',
		'meta_query'             => array(
			array(
				'key'     => $shop_meta_key,
				'value'   => $shop,
				'compare' => '=',
			),
		),
	);
	$query = new WP_Query( $args );
	return $query;
}

/**
 * スタッフのサマリーデータを取得
 *  @param int $cast_id キャストのID
 *
 *  @return array $cast_data キャストのデータ
 */
function get_cast_summary( $cast_id = null ) {
	$cast_id = $cast_id ? $cast_id : get_the_ID();
	$images  = get_post_meta( $cast_id, 'myupload_images', true );
	$image   = CAST_NO_IMAGE;
	if ( $images ) {
		$image = wp_get_attachment_image_src( $images[0], 'cast_thumb_top' )[0];
	}
	$current_post = get_post( $cast_id );

	return array(
		'slug'   => $current_post->post_name,
		'url'    => '/cast/' . $current_post->post_name,
		'name'   => $current_post->post_title,
		'image'  => $image,
		'height' => str_replace( 'cm', '', get_post_meta( $cast_id, 'am-height', true ) ),
		'weight' => str_replace( 'kg', '', get_post_meta( $cast_id, 'am-weight', true ) ),
		'age'    => str_replace( '歳', '', get_post_meta( $cast_id, 'am-age', true ) ),
		'icon'   => get_post_meta( $cast_id, 'am-icon', true ),
		'shop'   => get_post_meta( $cast_id, 'am-shop', true ),
	);
}

function get_cast_summary_en() {
	global $post;
	$cast_id = get_the_ID();
	$images  = get_post_meta( $cast_id, 'myupload_images', true );
	$image   = CAST_NO_IMAGE;
	if ( $images ) {
		$image = wp_get_attachment_image_src( $images[0], 'cast_thumb_top' )[0];
	}
	$slug = $post->post_name;
	return array(
		'slug'   => $slug,
		'url'    => '/en/cast/' . $slug,
		'name'   => get_post_meta( $cast_id, 'am-name-en', true ),
		'image'  => $image,
		'height' => str_replace( 'cm', '', get_post_meta( $cast_id, 'am-height', true ) ),
		'weight' => str_replace( 'kg', '', get_post_meta( $cast_id, 'am-weight', true ) ),
		'age'    => str_replace( '歳', '', get_post_meta( $cast_id, 'am-age', true ) ),
		'icon'   => get_post_meta( $cast_id, 'am-icon', true ),
	);
}
/**
 * スタッフのバッチアイコンを表示
 *  @param string $code
 *
 *  @return void
 */
function boy_batch( $code ) {
	switch ( $code ) {
		case 'new':
			echo '<img src="' . get_template_directory_uri() . '/src/img/top/icon-new.png" alt="新人ボーイ" class="img-fluid position-absolute cast-batch-icon" loading="lazy">';
			break;
		case 'nagoya':
			echo '<img src="' . get_template_directory_uri() . '/src/img/top/icon-nagoya.png" alt="Chance名古屋店所属ボーイ" class="img-fluid position-absolute cast-batch-icon" loading="lazy">';
			break;
		case 'osaka':
			echo '<img src="' . get_template_directory_uri() . '/src/img/top/icon-osaka.png" alt="Chance大阪店所属ボーイ" class="img-fluid position-absolute cast-batch-icon" loading="lazy">';
			break;
		case 'namba':
			echo '<img src="' . get_template_directory_uri() . '/src/img/top/icon-namba.png" alt="Chance難波店所属ボーイ" class="img-fluid position-absolute cast-batch-icon" loading="lazy">';
			break;
		case 'return':
			echo '<img src="' . get_template_directory_uri() . '/src/img/top/icon-return.png" alt="復帰ボーイ" class="img-fluid position-absolute cast-batch-icon" loading="lazy">';
			break;
		case 'update':
			echo '<img src="' . get_template_directory_uri() . '/src/img/top/icon-update.png" alt="画像更新" class="img-fluid position-absolute cast-batch-icon" loading="lazy">';
			break;
	}
}

/**
 * スタッフの出勤情報テキストを取得
 *
 * @param string $start 出勤時間
 * @param string $end   退勤時間
 * @param string $ladywork_txt 出勤情報
 * @return string 出勤情報のテキスト
 */
function get_schedule_text( $start = '', $end = '', $ladywork_txt = '' ) {
	// プラグインの関数が存在する場合はそちらを使用
	if ( function_exists( 'chance_get_schedule_text' ) ) {
		return chance_get_schedule_text( $start, $end, $ladywork_txt );
	}

	// プラグインが無効な場合はエラーログを残す
	error_log( 'Work Managerプラグインが有効化されていません。chance_get_schedule_text関数が見つかりません。' );
	return '';
}
/**
 * スタッフの詳細情報を取得
 *
 * @param int $id スタッフのID
 *
 * @return array スタッフの詳細情報
 */
function get_staff_data( $id = '' ) {
	// プラグインの関数が存在する場合はそちらを使用
	if ( function_exists( 'chance_get_staff_data' ) ) {
		return chance_get_staff_data( $id );
	}

	// プラグインが無効な場合はエラーログを残す
	error_log( 'Work Managerプラグインが有効化されていません。chance_get_staff_data関数が見つかりません。' );
	return array();
}

function get_cast_btns( $cast_data = null ) {
	if ( empty( $cast_data ) ) {
		return;
	}
	$btns = array();
	foreach ( $cast_data['additional_btns'] as $btn_data ) {
		if ( count( $btns ) >= 3 ) {
			break;
		}
		$btn = '';
		switch ( $btn_data ) {
			case 'moza':
				$btn = '<li><a href="mailto:info@chance-shinjuku-gyoen.jp?subject=' . $cast_data['name'] . 'の画像請求" role="button" class="btn btn-red"><i class="bi bi-file-earmark-image" aria-hidden="true"></i><span>画像請求</span></a></li>';
				break;
			case 'mail':
				$btn = '<li><a href="mailto:' . $cast_data['addressMail'] . '" role="button" class="btn btn-red"><i class="bi bi-envelope" aria-hidden="true"></i><span>メールを送る</span></a></li>';
				break;
			case 'twitter':
				$btn = '<li><a href="' . $cast_data['urlTwitter'] . '" role="button" class="btn btn-red"><i class="bi bi-twitter-x" aria-hidden="true"></i><span>公式アカウント</span></a></li>';
				break;
			case 'line':
				$btn = '<li><a href="' . $cast_data['urlLine'] . '" target="_blank" rel="noopener noreferrer" role="button" class="btn btn-green"><i class="bi bi-line" aria-hidden="true"></i><span>' . $cast_data['name'] . 'のLINE</span></a></li>';
				break;
		}
			$btns[] = $btn;
	}

	if ( count( $btns ) < 3 ) {
		$btns[] = '<li><a href="/ank/?boy=' . urlencode( $cast_data['name'] ) . '" role="button" class="btn"><i class="bi bi-chat-left-text" aria-hidden="true"></i><span>アンケート</span></a></li>';
	}
	if ( count( $btns ) < 2 ) {
		$btns[] = '<li><a href="/reserved" role="button" class="btn btn-green"><i class="bi bi-calendar-check" aria-hidden="true"></i><span>予約する</span></a></li>';
	}
	$btns_html = '';
	foreach ( $btns as $btn ) {
		$btns_html .= $btn;
	}
	return $btns_html;
}

function get_cast_btns_en( $cast_data = null ) {
	if ( empty( $cast_data ) ) {
		return;
	}

	$cast_id = $cast_data['id'] ?? get_the_ID();
	$name_en = get_post_meta( $cast_id, 'am-name-en', true );

	$btns = array();
	foreach ( $cast_data['additional_btns'] as $btn_data ) {
		if ( count( $btns ) >= 3 ) {
			break;
		}
		$btn = '';
		switch ( $btn_data ) {
			case 'moza':
				$btn = '<li><a href="mailto:' . esc_attr( sanitize_email( 'info@chance-shinjuku-gyoen.jp' ) ) . '?subject=' . urlencode( $name_en ) . ' image request" role="button" class="btn btn-red"><i class="bi bi-file-earmark-image"></i><span>Request Image</span></a></li>';
				break;
			case 'mail':
				$btn = '<li><a href="mailto:' . esc_attr( sanitize_email( $cast_data['addressMail'] ) ) . '" role="button" class="btn btn-red"><i class="bi bi-envelope"></i><span>Direct Mail</span></a></li>';
				break;
			case 'twitter':
				$btn = '<li><a href="' . esc_url( $cast_data['urlTwitter'] ) . '" role="button" class="btn btn-red"><i class="bi bi-twitter-x"></i><span>Official Account</span></a></li>';
				break;
			case 'line':
				$btn = '<li><a href="' . $cast_data['urlLine'] . '" target="_blank" rel="noopener noreferrer" role="button" class="btn btn-green"><i class="bi bi-line" aria-hidden="true"></i><span>' . $cast_data['name_en'] . '\'s LINE</span></a></li>';
				break;
		}
		$btns[] = $btn;
	}

	if ( count( $btns ) < 3 ) {
		$btns[] = '<li><a href="/ank/?boy=' . urlencode( $name_en ) . '" role="button" class="btn"><i class="bi bi-chat-left-text"></i><span>Survey</span></a></li>';
	}
	if ( count( $btns ) < 2 ) {
		$btns[] = '<li><a href="/en/reserved/?boy=' . urlencode( $name_en ) . '" role="button" class="btn btn-green"><i class="bi bi-calendar-check"></i><span>Reserve</span></a></li>';
	}

	return implode( '', $btns );
}
