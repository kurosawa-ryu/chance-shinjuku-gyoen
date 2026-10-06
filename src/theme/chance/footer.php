</main>
	<footer>
		<div class="container">
			<ul class="nav justify-content-center footer_menu" id="sp_menu">
				<li class="nav-item">
					<a href="/" class="nav-link">ホーム</a>
				</li>
				<li class="nav-item">
					<a href="/cast/" class="nav-link">ボーイ</a>
				</li>
				<li class="nav-item">
					<a href="/price/" class="nav-link">料金</a>
				</li>
				<li class="nav-item">
					<a href="/schedule/" class="nav-link">スケジュール</a>
				</li>
				<li class="nav-item">
					<a href="/reserved/" class="nav-link">予約</a>
				</li>
				<li class="nav-item">
					<a href="/rule/" class="nav-link">免責事項</a>
				</li>
				<li class="nav-item">
					<a href="/group/" class="nav-link">系列店</a>
				</li>
				<li class="nav-item">
					<a href="/en/" class="nav-link">English</a>
				</li>
				<li class="nav-item tw d-md-none"><a href="https://x.com/chance_yoyogi" target="_blank"><span><img src="<?php echo get_template_directory_uri(); ?>/src/img/common/side-x.png" alt="CHANCE新宿 X公式アカウント" width="200" height="50" class="img-responsive"></span></a></li>
				<li class="nav-item line d-md-none"><a href="https://lin.ee/ZD9aG5O" target="_blank"><span><img src="<?php echo get_template_directory_uri(); ?>/src/img/common/side-line_01.png" alt="アルバイト募集中" width="200" height="62" class="img-responsive"></span></a></li>
			</ul>
			<div class="pd10 text-center bg_lgray row d-md-none">
				<?php
					$email      = chance_get_store_email();
					$mail_query = '?subject=クレジットでの支払い&body=' . rawurlencode( get_my_mail_template() );
				?>
				<a href="mailto:<?php echo esc_attr( $email . $mail_query ); ?>" class="d-inline-block">
					<img src="<?php echo get_template_directory_uri(); ?>/src/img/common/credit.jpg?v=2" alt="クレジット" class="img-responsive">
				</a>
			</div>
			<div class="row mgt60 spmgt0 sp_footer">
				<div class="col-3 logo matchbox">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/public/common/logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>" width="413" height="184" class="img-responsive d-md-none w-100 h-auto object-fit-contain">
						<img src="<?php echo get_template_directory_uri(); ?>/public/common/logo_dark.webp" alt="<?php echo get_bloginfo( 'name' ); ?>" class="img-responsive d-none d-md-block w-100 h-auto object-fit-contain">
					</a>
				</div>
				<div class="col-md-6 col-8 text-center footer_address matchbox">
					<p class="fs18 spfs11 bold mgb5">営業時間&nbsp;13:00&nbsp;~&nbsp;24:00</p>
					<p class="spfs11 mgb5">新宿御苑前駅 徒歩5分<br />新宿3丁目駅 徒歩5分</p>
					<p class="spfs20 mgb0">
						<a href="tel:0353577889">TEL&nbsp;03-5357-7889</a>
					</p>
				</div>
				<div class="col-md-3 col-12 spmgt10 credit matchbox text-center d-none d-md-block">
					<div class="innerbox">
						<a href="mailto:info@chance-shinjuku-gyoen.jp" class="d-inline-block">
							<img src="<?php echo get_template_directory_uri(); ?>/public/common/credit.jpg" alt="クレジットカード" width="238" height="48" class="img-fluid">
						</a>
					</div>
				</div>
			</div>
			<p class="text-center fs16 spfs12 mgt30 spmgt20 mgb0 copyright">
				<a href="/rule/">免責事項</a>・<a href="/privacy/">プライバシーポリシー</a>
			</p>
			<div class="chance-group">
				<p class="chance-group__title">CHANCE GROUP</p>
				<ul class="chance-group__list">
					<?php foreach ( CHANCE_SHOP_LIST as $shop ) : ?>
					<li><a href="<?php echo esc_url( $shop['url'] ); ?>" target="_blank"><?php echo esc_html( $shop['name'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<p class="text-center fs16 spfs12 mgb0 copyright">Copyright&nbsp;&copy;&nbsp;<?php echo date_i18n( 'Y' ); ?>&nbsp;CHANCE新宿&nbsp;All&nbsp;Rights&nbsp;Reserved.</p>
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
			><a href="/"><i class="bi bi-house-fill" aria-hidden="true"></i>HOME</a></li>
		<li 
		<?php
		if ( is_page( 'reserved' ) ) {
				echo ' class="active"';
		}
		?>
			><a href="/reserved/"><i class="bi bi-envelope-fill" aria-hidden="true"></i>RESERVED</a></li>
		<li 
		<?php
		if ( is_post_type_archive( 'cast' ) ) {
				echo ' class="active"';
		}
		?>
			><a href="/cast/"><i class="bi bi-people-fill" aria-hidden="true"></i>ALL&nbsp;STAFF</a></li>
		<li 
		<?php
		if ( is_page( 'price' ) ) {
				echo ' class="active"';
		}
		?>
			><a href="/price/"><i class="bi bi-cash-coin" aria-hidden="true"></i>PRICE</a></li>
		<li 
		<?php
		if ( is_page( 'schedule' ) ) {
				echo ' class="active"';
		}
		?>
			><a href="/schedule/"><i class="bi bi-calendar-fill" aria-hidden="true"></i>SCHEDULE</a></li>
	</ul>

	<?php wp_footer(); ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQQQ2KKS" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	</body>

</html>
