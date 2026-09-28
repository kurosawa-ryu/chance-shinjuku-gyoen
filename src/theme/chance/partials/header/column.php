<header class="column-header">
	<div class="wrapper column-header__wrapper">
		<?php $store_name = chance_get_store_name(); ?>
		<a class="column-header__brand d-inline-block" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/src/img/common/logo.webp" alt="<?php echo esc_attr( $store_name ? $store_name : get_bloginfo( 'name' ) ); ?>" width="169" height="48" class="img-fluid" loading="lazy"></a>
	</div>
</header>
