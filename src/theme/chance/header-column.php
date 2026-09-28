<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-NQQQ2KKS');
	</script>
	<!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-J6MXSK86DS"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'G-J6MXSK86DS');
	</script>

	<?php wp_head(); ?>
</head>

<body ontouchstart="">
	<header class="column-header">
		<div class="wrapper column-header__wrapper">
			<?php $store_name = chance_get_store_name(); ?>
			<a class="column-header__brand d-inline-block" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/src/img/common/logo.webp" alt="<?php echo esc_attr( $store_name ? $store_name : get_bloginfo( 'name' ) ); ?>" width="169" height="48" class="img-fluid" loading="lazy"></a>
		</div>
	</header>

	<main class="<?php echo get_main_class(); ?>">
