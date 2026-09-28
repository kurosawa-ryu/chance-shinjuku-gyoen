<aside id="side_nav">
	<nav class="gnav ">
		<div class="nav sp-menu sp_icon float-start d-md-none">
			<button class="navbar-toggler sp-menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
				<i class="bi bi-list"></i>
			</button>
			<div class="offcanvas offcanvas-start sp-menu" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
				<div class="offcanvas-header">
					<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
					<ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
						<?php $footer_menu = wp_get_nav_menu_items( is_ja() ? 'side-menu' : 'side-menu-en' ); ?>
						<?php foreach ( $footer_menu as $menu ) : ?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo esc_url( $menu->url ); ?>"><?php echo esc_html( $menu->title ); ?></a>
							</li>
						<?php endforeach; ?>
							
					</ul>
					<!-- <div class="d-flex justify-content-center mt-3 gap-3 flex-wrap">
						<a href="#" class="d-block">
							<img src="https://placehold.jp/300x50.png" alt="バナー" width="300" height="50" class="img-fluid">
						</a>
						<a href="#" class="d-block">
							<img src="https://placehold.jp/300x50.png" alt="バナー" width="300" height="50" class="img-fluid">
						</a>
					</div> -->
				</div>
			</div>
		</div>
		<div class="sp_icon float-end d-md-none">
			<?php if ( chance_eneble_phone_number() ) : ?>
				<a href="tel:0300000000"><i class="bi bi-telephone-fill sp_phone_icon" aria-hidden="true"></i></a>
			<?php endif; ?>
		</div>
		<h1 class="grid_1 text-center"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="d-inline-block"><img src="<?php echo get_template_directory_uri(); ?>/public/common/logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>" width="169" height="48" class="img-fluid" loading="lazy"></a></h1>
		<div class="grid_2 pdr10 pdl10 gnav_list">
			<ul class="fs16">
				<?php $footer_menu = wp_get_nav_menu_items( is_ja() ? 'side-menu' : 'side-menu-en' ); ?>
				<?php foreach ( $footer_menu as $menu ) : ?>
					<li >
						<a href="<?php echo esc_url( $menu->url ); ?>"><?php echo esc_html( $menu->title ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php if ( chance_eneble_phone_number() ) : ?>
			<div class="grid_4 header-phone"><a href="tel:0353577889" class="fs16"><span class="d-block gray clearfix"><i class="bi bi-phone fs24 float-start" aria-hidden="true"></i>03-5357-7889</span></a></div>
			<div class="grid_5 mail"><a href="mailto:info@chance-shinjuku-gyoen.jp" class="fs16"><span class="d-block gray clearfix"><i class="bi bi-envelope fs24 float-start" aria-hidden="true"></i>info@chance-shinjuku-gyoen.jp</span></a></div>
		<?php endif; ?>
		<div class="grid_6 address"><span class="d-block gray clearfix"><i class="bi bi-geo-alt-fill fs30 float-start" aria-hidden="true"></i><?php echo is_ja() ? '新宿御苑前駅 徒歩5分<br />新宿3丁目駅 徒歩5分	' : 'Shinjuku-Gyoemmae Sta. <br>Shinjuku-sanchome Sta.'; ?></span></div>
		<div class="grid_7">
			<div class="open-close__title">
				<div>OPEN</div>
				<div></div>
				<div>CLOSE</div>
			</div>
			<div class="open-close__body">
				<div>13:00</div>
				<div>~</div>
				<div>24:00</div>
			</div>
		</div>
		<?php
			$store_name = chance_get_store_name();
			$x_id       = chance_get_x_id();
		?>
		<?php
		// ログインしていないときは非表示
		if ( is_user_logged_in() ) :
			?>
			<div class="grid_8 tw"><a href="https://twitter.com/<?php echo esc_attr( $x_id ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/src/img/common/side-x.png" alt="<?php echo esc_attr( $store_name ); ?>X公式アカウント" width="200" height="50" class="img-fluid" loading="lazy"></a></div>
			<div class="grid_9 line"><a href="https://lin.ee/UDXT9p5" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/src/img/common/side-line_01.png" alt="アルバイト募集中" width="200" height="62" class="img-fluid" loading="lazy"></a></div>
		<?php endif; ?>
	</nav>
</aside>

