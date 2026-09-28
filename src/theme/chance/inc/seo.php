<?php

/******************************************************
 *
 * SEO関連
 *
 *******************************************************/
//hreflang設置
function hreflang_tag() {
	$page_url_get = ( empty( $_SERVER['HTTPS'] ) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$search_url   = array( 'index.php' );
	$page_ok_url  = str_replace( $search_url, '', $page_url_get );

	echo '<link rel="alternate" hreflang="ja-jp" href="' . $page_ok_url . '">' . "\n";
	echo '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo( 'name' ) . ' RSS Feed" href="' . get_bloginfo( 'rss2_url' ) . '">' . "\n";
	echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '">' . "\n";
	echo '<link rel="canonical" href="' . $page_ok_url . '">' . "\n";
}
add_action( 'wp_head', 'hreflang_tag', 5 );

//title 設定
function change_title( $return_value ) {

	if ( is_home() || is_front_page() ) {
		$return_value['title'] = 'CHANCE新宿｜新宿・新宿御苑・新宿3丁目のゲイ風俗・売り専';
		unset( $return_value['tagline'] );
	}

	return $return_value;

}
add_filter( 'document_title_parts', 'change_title', 10, 1 );

// タイトルの区切り線を変更
function custom_title_separator( $sep ) {
	$sep = ' | ';
	return $sep;
}
add_filter( 'document_title_separator', 'custom_title_separator', 10, 1 );

//meta 設定
function description_tag() {
	global $post;
	if ( is_array( $post ) ) {
		$post = $post[0];
	}
	$asd = ( ! empty( $post->ID ) ) ? get_post_meta( $post->ID, '_aioseop_description', true ) : '';
	$ask = ( ! empty( $post->ID ) ) ? get_post_meta( $post->ID, '_aioseop_keywords', true ) : '';
	$rel = "\n";
	if ( empty( $asd ) ) {
		$description = get_bloginfo( 'description' );
		$rel        .= '<meta name="description" content="' . $description . '">' . "\n";
	}
	if ( empty( $ask ) ) {
		$keyword = '東京,売り専,ウリセン,チャンス,chance,出張ホスト,ゲイ,高収入,イケメン';
		$rel    .= '<meta name="keywords" content="' . $keyword . '">' . "\n";
	}
	echo $rel;
}
add_action( 'wp_head', 'description_tag' );

// 不要なページを作成しない
add_filter( 'news_rewrite_rules', '__return_empty_array' );
add_filter( 'cosplay_rewrite_rules', '__return_empty_array' );

function json_ld_markup() {
	$page_url   = ( empty( $_SERVER['HTTPS'] ) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$search_url = array( 'index.php' );
	$page_url   = str_replace( $search_url, '', $page_url );
	$host       = ( empty( $_SERVER['HTTPS'] ) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'];

	// organizationで総合ページを記載して関連性を明示する
	$organization = array(
		'@context' => 'http://schema.org',
		'@type'    => 'Organization',
		'name'     => 'Chanceグループ',
		'url'      => 'https://chance-all.jp/',
		'image'    => ' https://chance-all.jp/wp-content/themes/chance/src/img/common/logo.png',
	);
	echo '<script type="application/ld+json">' . json_encode( $organization ) . '</script>';

	$website = array(
		'@context'      => 'http://schema.org',
		'@type'         => 'WebSite',
		'@id'           => $host,
		'url'           => $host,
		'name'          => get_bloginfo( 'name' ),
		'alternateName' => 'CHANCE新宿',
		'image'         => get_template_directory_uri() . '/src/img/common/ogp.png',
		'description'   => get_bloginfo( 'description' ),
		'publisher'     => array(
			'@context' => 'http://schema.org',
			'@type'    => 'Organization',
			'@id'      => 'https://chance-all.jp/',
			'name'     => 'Chanceグループ',
			'url'      => 'https://chance-all.jp/',
			'image'    => ' https://chance-all.jp/wp-content/themes/chance/src/img/common/logo.png',
		),
	);
	echo '<script type="application/ld+json">' . json_encode( $website ) . '</script>';

	$business = array(
		'@context'                  => 'http://schema.org',
		'@type'                     => 'LocalBusiness',
		'name'                      => 'CHANCE新宿',
		'url'                       => $host,
		'image'                     => get_template_directory_uri() . '/src/img/common/ogp.png',
		'address'                   => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => '新宿2丁目',
			'addressLocality' => '新宿区',
			'addressRegion'   => '東京都',
			'postalCode'      => '',
			'addressCountry'  => 'JP',
		),
		'telephone'                 => chance_get_store_phone(),
		'openingHoursSpecification' => array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ),
			'opens'     => '13:00',
			'closes'    => '24:00',
		),
	);
	echo '<script type="application/ld+json">' . json_encode( $business ) . '</script>';
}
add_action( 'wp_footer', 'json_ld_markup', 100 );


/**********************
OGP設定
 *********************/
function my_meta_ogp() {
	if ( is_front_page() || is_home() || is_singular() ) {

		/*初期設定*/

		// 画像 （アイキャッチ画像が無い時に使用する代替画像URL）
		$ogp_image = get_template_directory_uri() . '/src/img/common/ogp.png';
		// Twitterのアカウント名 (@xxx)
		$x_id         = chance_get_x_id();
		$twitter_site = '@' . $x_id;
		// Twitterカードの種類（summary_large_image または summary を指定）
		$twitter_card = 'summary_large_image';
		// Facebook APP ID
		$facebook_app_id = '';

		/*初期設定 ここまで*/

		global $post;
		$ogp_title       = '';
		$ogp_description = '';
		$ogp_url         = '';
		$html            = '';
		if ( is_singular() ) {
			// 記事＆固定ページ
			setup_postdata( $post );
			$ogp_title       = $post->post_title;
			$ogp_description = mb_substr( get_the_excerpt(), 0, 100 );
			$ogp_url         = get_permalink();
			wp_reset_postdata();
		} elseif ( is_front_page() || is_home() ) {
			// トップページ
			$ogp_title       = get_bloginfo( 'name' );
			$ogp_description = get_bloginfo( 'description' );
			$ogp_url         = home_url();
		}

		// og:type
		$ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';

		// og:image
		if ( is_singular() && has_post_thumbnail() ) {
			$ps_thumb  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$ogp_image = $ps_thumb[0];
		}

		// 出力するOGPタグをまとめる
		$html  = "\n";
		$html .= '<meta property="og:title" content="' . esc_attr( $ogp_title ) . '">' . "\n";
		$html .= '<meta property="og:description" content="' . esc_attr( $ogp_description ) . '">' . "\n";
		$html .= '<meta property="og:type" content="' . $ogp_type . '">' . "\n";
		$html .= '<meta property="og:url" content="' . esc_url( $ogp_url ) . '">' . "\n";
		$html .= '<meta property="og:image" content="' . esc_url( $ogp_image ) . '">' . "\n";
		$html .= '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
		$html .= '<meta name="twitter:card" content="' . $twitter_card . '">' . "\n";
		$html .= '<meta name="twitter:site" content="' . $twitter_site . '">' . "\n";
		$html .= '<meta property="og:locale" content="ja_JP">' . "\n";

		if ( '' !== $facebook_app_id ) {
			$html .= '<meta property="fb:app_id" content="' . $facebook_app_id . '">' . "\n";
		}

		echo $html;
	}
}
// headタグ内にOGPを出力する
add_action( 'wp_head', 'my_meta_ogp' );
