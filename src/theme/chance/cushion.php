<?php

$target_url = isset( $_GET['redirect'] ) ? $_GET['redirect'] : '';
if ( ! empty( $target_url ) ) {
	$target_url .= ( strpos( $target_url, '?' ) === false ? '?' : '&' ) . 'visited=true';
} else {
	$target_url = '/?visited=true';
}

$opt_val = get_option( 'cushion-img' );
if ( empty( $opt_val ) ) {
	$mv = get_template_directory_uri() . '/src/img/page/cushion/bg.jpg';
	if ( is_mobile() ) {
		$mv = get_template_directory_uri() . '/src/img/page/cushion/bg-sp.jpg';
	}
} else {
	if ( ! empty( $opt_val['pc'] ) ) {
		$src = wp_get_attachment_image_src( $opt_val['pc'], 'full', false );
		$mv  = $src[0];
	} else {
		$mv = get_template_directory_uri() . '/src/img/page/cushion/bg.jpg';
	}
	if ( is_mobile() && ! empty( $opt_val['sp'] ) ) {
		$src = wp_get_attachment_image_src( $opt_val['sp'], 'full', false );
		if ( $src ) {
			$mv = $src[0];
		} else {
			$mv = get_template_directory_uri() . '/src/img/page/cushion/bg.jpg';
		}
	}
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<!-- <meta name="robots" content="noindex,nofollow"> -->
	<title>年齢認証</title>

	<link href="<?php echo get_template_directory_uri(); ?>/assets/cushion.css?ver=2.0.0" rel="stylesheet">
</head>

<body class="cushion">
	<div class="container-fluid" style="background-image:url('<?php echo $mv; ?>')">
		<div class="contents">
			<h1 class="cushion_title">
				CHANCE 新宿
			</h1>
			<ul class="certify">
				<li class="item1">
					<p class="">18歳以上の方</p>
					<a href="<?php echo $target_url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/src/img/page/cushion/enter.png" alt="Enter" width="180" height="53" class="img-fluid" loading="lazy" /></a>
				</li>
				<li class="item2"><img src="<?php echo get_template_directory_uri(); ?>/src/img/page/cushion/mark.png" alt="18歳未満閲覧禁止" width="99" height="96" class="img-fluid mx-auto" loading="lazy" /></li>
				<li class="item3">
					<p class="">18歳未満の方</p>
					<a href="https://www.google.co.jp/"><img src="<?php echo get_template_directory_uri(); ?>/src/img/page/cushion/leave.png" alt="Leave" width="174" height="50" class="img-fluid" loading="lazy" /></a>
				</li>
			</ul>
			<div class="text-center">
				<a href="/en<?php echo $target_url; ?>" class="cushion_en_link">English pages</a>
			</div>
			<p class="text-center">当サイトは男性アダルトとゲイに関する情報が含まれております。<br>
				アダルトコンテンツを含むため、18歳未満の方の入場をお断り致します。<br>
				また、当店は男性を目的としたお店ですので女性のご利用をお断りしております。</p>
			<p class="text-center mgb0">当サイトの画像及び如何なるデータにおきましても、二次利用、再配布等を固く禁じます。</p>
		</div>
	</div>
	<footer class="copyright">
		Copyright&nbsp;&copy;&nbsp;
		<?php echo date( 'Y' ); ?>&nbsp;Chance&nbsp;Shinjuku&nbsp;All&nbsp;Rights&nbsp;Reserved.
	</footer>
</body>

</html>
