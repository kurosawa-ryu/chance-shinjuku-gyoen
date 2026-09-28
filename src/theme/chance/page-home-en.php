<?php /* Template Name: 01_ホーム(en) */ ?>
<?php get_header( 'en' ); ?>
<?php get_template_part( 'partials/header/notice' ); ?>

<section class="top_banner">
	<img src="<?php echo get_template_directory_uri(); ?>/public/common/logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>" width="413" height="184" class="img-fluid mx-auto d-none d-md-block" loading="lazy">
	<?php get_template_part( 'partials/top/banner-carousel' ); ?>
</section>


<?php
$show_today_shift = get_option( 'chance_show_today_shift_on_top', 1 );
if ( $show_today_shift ) :
	?>
	<section class="today_boy">
		<div class="mgb90 spmgb20 sectionTitle"><h2><span class="en sectionTitle--sub">TODAY’S&nbsp;BOY</span></h2>
		</div>
		<div class="container box pdb90 sppdb20">
			<div class="row gx-2 gy-3">
				<?php
				$cast_summaries_with_shift = get_today_staff_en();
				if ( empty( $cast_summaries_with_shift ) ) :
					?>
					<div class="text-center fs26 bold">COMING SOON</div>
					<?php
				else :
					foreach ( $cast_summaries_with_shift as $cast_summary_with_shift ) :
						get_template_part( 'partials/common/cast-card-with-shift-en', null, $cast_summary_with_shift );
					endforeach;
				endif;
				?>
			</div>
			<div class="mgt20 d-md-none w-50 mx-auto">
				<a href="<?php echo esc_url( home_url( '/en/room/' ) ); ?>">
					<img src="<?php echo get_room_banner(); ?>" alt="room" width="370" height="170" class="img-fluid mx-auto" loading="lazy">
				</a>
			</div>
		</div>
	</section>
<?php endif; ?>
<section class="news pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><h2><span class="en sectionTitle--sub">NEWS</span></h2>
	</div>

	<div class="container w_long box">
		<?php
		$news_query = get_top_news();
		?>
		<div class="news_box">
			<?php if ( $news_query->have_posts() ) : ?>
				<?php
				while ( $news_query->have_posts() ) {
					$news_query->the_post();
					get_template_part( 'partials/common/news-item-en' );
				}
				wp_reset_postdata();
				?>
			<?php else : ?>
				<p class="text-center fs26 bold mgb0">COMING SOON</p>
			<?php endif; ?>
		</div>
		<div class="row mgt60 spmgt20">
			<div class="col-6 col-md-4">
				<a href="<?php echo esc_url( home_url( '/en/faq/' ) ); ?>">
					<img src="<?php echo get_faq_banner(); ?>" alt="FAQ" width="370" height="170" class="img-fluid mx-auto" loading="lazy">
				</a>
			</div>
			<div class="col-md-4 d-none d-md-block">
				<a href="<?php echo esc_url( home_url( '/en/room/' ) ); ?>">
					<img src="<?php echo get_room_banner(); ?>" alt="ROOM GUIDE" width="370" height="170" class="img-fluid mx-auto" loading="lazy">
				</a>
			</div>
			<div class="col-6 col-md-4">
				<a href="/cosplay/">
					<img src="<?php echo get_cosplay_banner(); ?>" alt="COSPLAY" width="370" height="170" class="img-fluid mx-auto" loading="lazy">
				</a>
			</div>
		</div>
	</div>
</section>
<?php
// <section class="all_staff pdb90 sppdb20 d-none d-md-block">
// TODO: 動作確認のためSPでもスタッフ一覧を出す
?>

<?php
// ログインしていないときは非表示
if ( chance_enable_cast_info() ) :
	?>

	<section class="all_staff pdb90 sppdb20">
		<div class="mgb90 spmgb20 sectionTitle"><h2><span class="en sectionTitle--sub">ALL STAFF</span></h2>
		</div>

		<div class="container box">
			<div class="row gx-2 gy-3">
				<?php
				$staff_query = get_all_staff();
				if ( ! $staff_query->have_posts() ) {
					echo '<div class="text-center fs20">COMING SOON</div>';
				}
				while ( $staff_query->have_posts() ) {
					$staff_query->the_post();
					$cast_summary = get_cast_summary_en();
					get_template_part( 'partials/common/cast-card-en', null, $cast_summary );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php endif; ?>


<?php get_footer( 'en' ); ?>