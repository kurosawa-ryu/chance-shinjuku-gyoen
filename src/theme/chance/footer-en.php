</main>
	<footer>
		<div class="container">
			<?php $footer_menu = wp_get_nav_menu_items( 'footer_en' ); ?>
			<ul class="nav justify-content-center footer_menu" id="sp_menu">
				<?php if ( ! empty( $footer_menu ) ) : ?>
					<?php foreach ( $footer_menu as $menu ) : ?>
						<li class="nav-item">
							<a href="<?php echo esc_url( $menu->url ); ?>" class="nav-link"><?php echo esc_html( $menu->title ); ?></a>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php
					$store_name = chance_get_store_name();
					$x_id       = chance_get_x_id();
				?>
				<li class="nav-item tw d-md-none"><a href="https://twitter.com/<?php echo esc_attr( $x_id ); ?>" target="_blank"><span><img src="<?php echo get_template_directory_uri(); ?>/src/img/common/side-x.png" alt="<?php echo esc_attr( $store_name ); ?>X公式アカウント" width="200" height="50" class="img-responsive"></span></a></li>
				<li class="nav-item line d-md-none"><a href="https://lin.ee/ZD9aG5O" target="_blank"><span><img src="<?php echo get_template_directory_uri(); ?>/src/img/common/side-line_01.png" alt="アルバイト募集中" width="200" height="62" class="img-responsive"></span></a></li>
			</ul>
			<div class="pd10 text-center bg_lgray row d-md-none">
			</div>
			<div class="row mgt60 spmgt0 sp_footer">
				<div class="col-3 logo matchbox">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/public/common/logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>" width="413" height="184" class="img-responsive d-md-none w-100 h-auto object-fit-contain">
						<img src="<?php echo get_template_directory_uri(); ?>/public/common/logo_dark.webp" alt="<?php echo get_bloginfo( 'name' ); ?>" class="img-responsive d-none d-md-block w-100 h-auto object-fit-contain">
					</a>
				</div>
				<div class="col-md-6 col-8 text-center footer_address matchbox">
					<p class="fs18 spfs11 bold mgb5">Opening Hours&nbsp;13:00&nbsp;~&nbsp;24:00</p>
					<p class="spfs11 mgb5">JR Shinjuku-Gyoemmae Sta. <br>Shinjuku-sanchome Sta. <br>Chitose-gakimae Sta.</p>
					<p class="spfs20 mgb0">
						<?php if ( chance_eneble_phone_number() ) : ?>
							<a href="tel:0353577889">TEL&nbsp;03-5357-7889</a>
						<?php endif; ?>
					</p>
				</div>
				<div class="col-md-3 col-12 spmgt10 credit matchbox text-center d-none d-md-block">
					<div class="innerbox">
				
					</div>
				</div>
			</div>
			<p class="text-center fs16 spfs12 mgt30 spmgt20 mgb0 copyright">
				<a href="/en/rule/">Rules</a>
			</p>
			<div class="chance-group">
				<p class="chance-group__title">CHANCE GROUP</p>
				<ul class="chance-group__list">
					<?php foreach ( CHANCE_SHOP_LIST as $shop ) : ?>
					<li><a href="<?php echo esc_url( $shop['url'] ); ?>" target="_blank"><?php echo esc_html( $shop['name'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<p class="text-center fs16 spfs12 mgb0 copyright">Copyright&nbsp;&copy;&nbsp;<?php echo date_i18n( 'Y' ); ?>&nbsp;CHANCE&nbsp;Shinjuku&nbsp;All&nbsp;Rights&nbsp;Reserved.</p>
		</div>
	</footer>
	</div>
	<ul id="sp_menu_under">
		<li 
		<?php
		if ( is_home() || is_front_page() ) {
				echo ' class="active"';
		}
		?>
			><a href="/en/"><i class="bi bi-house-fill" aria-hidden="true"></i>HOME</a></li>
		<li 
		<?php
		if ( is_page( 'reserved' ) ) {
				echo ' class="active"';
		}
		?>
			><a href="/en/reserved/"><i class="bi bi-envelope-fill" aria-hidden="true"></i>RESERVED</a></li>
		<li 
		<?php
		if ( is_post_type_archive( 'cast' ) ) {
				echo ' class="active"';
		}
		?>
			><a href="/en/cast/"><i class="bi bi-people-fill" aria-hidden="true"></i>ALL&nbsp;STAFF</a></li>
		<li 
		<?php
		if ( is_page( 'price' ) ) {
				echo ' class="active"';
		}
		?>
			><a href="/en/price/"><i class="bi bi-cash-coin" aria-hidden="true"></i>PRICE</a></li>
		<li 
		<?php
		if ( is_page( 'schedule' ) ) {
				echo ' class="active"';
		}
		?>
			><a href="/en/schedule/"><i class="bi bi-calendar-fill" aria-hidden="true"></i>SCHEDULE</a></li>
	</ul>

	<?php wp_footer(); ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQQQ2KKS" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	</body>

</html>
