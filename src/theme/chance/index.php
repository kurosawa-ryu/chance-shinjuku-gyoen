<?php get_header(); ?>
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
		<?php
		get_template_part(
			'partials/common/section-title',
			null,
			array(
				'ja' => '本日の出勤・待機ボーイ',
				'en' => 'TODAY’S&nbsp;BOY',
			)
		);
		?>
		<div class="container box pdb90 sppdb20">
			<div class="row gx-2 gy-3">
				<?php
				$cast_summaries_with_shift = get_today_staff();
				if ( empty( $cast_summaries_with_shift ) ) :
					?>
					<div class="text-center fs26 bold">COMING SOON</div>
					<?php
				else :
					foreach ( $cast_summaries_with_shift as $cast_summary_with_shift ) :
						get_template_part( 'partials/common/cast-card-with-shift', null, $cast_summary_with_shift );
					endforeach;
				endif;
				?>
			</div>
			<div class="mgt20 d-md-none w-50 mx-auto">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>room">
					<img src="<?php echo get_room_banner(); ?>" alt="個室案内のページににリンク" width="370" height="170" class="img-fluid mx-auto" loading="lazy">
				</a>
			</div>
		</div>
	</section>
<?php endif; ?>
<section class="news pdb90 sppdb20">
	<?php
		get_template_part(
			'partials/common/section-title',
			null,
			array(
				'ja' => '新着情報',
				'en' => 'NEWS',
			)
		);
		?>

	<div class="container w_long box">
		<?php
		$news_query = get_top_news();
		?>
		<div class="news_box">
			<?php if ( $news_query->have_posts() ) : ?>
				<?php
				while ( $news_query->have_posts() ) {
					$news_query->the_post();
					get_template_part( 'partials/common/news-item' );
				}
				wp_reset_postdata();
				?>
			<?php else : ?>
				<p class="text-center fs26 bold mgb0">COMING SOON</p>
			<?php endif; ?>
		</div>
		<?php if ( is_ja() && false ) : ?>
			<?php get_template_part( 'partials/common/mailmagazine-form' ); ?>
		<?php endif; ?>
		<div class="row mgt60 spmgt20">
			<div class="col-6 col-md-4">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>faq">
					<img src="<?php echo get_faq_banner(); ?>" alt="よくある質問" width="370" height="170" class="img-fluid mx-auto" loading="lazy">
				</a>
			</div>
			<div class="col-md-4 d-none d-md-block">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>room">
					<img src="<?php echo get_room_banner(); ?>" alt="個室案内" width="370" height="170" class="img-fluid mx-auto" loading="lazy">
				</a>
			</div>
			<div class="col-6 col-md-4">
				<a href="<?php echo get_post_type_archive_link( 'cosplay' ); ?>">
					<img src="<?php echo get_cosplay_banner(); ?>" alt="コスプレ" width="370" height="170" class="img-fluid mx-auto" loading="lazy">
				</a>
			</div>
		</div>
	</div>
</section>
<?php
// <section class="all_staff pdb90 sppdb20 d-none d-md-block">
// TODO: 動作確認のためSPでもスタッフ一覧を出す
?>


<section class="all_staff pdb90 sppdb20">
	<?php
		get_template_part(
			'partials/common/section-title',
			null,
			array(
				'ja' => 'スタッフ一覧',
				'en' => 'ALL STAFF',
			)
		);
		?>

	<div class="container box">
		<div class="row gx-2 gy-3">
			<?php
			$staff_query = get_all_staff();
			if ( ! $staff_query->have_posts() ) {
				echo '<div class="text-center fs20">COMING SOON</div>';
			}
			while ( $staff_query->have_posts() ) {
				$staff_query->the_post();
				$cast_summary = get_cast_summary( get_the_ID() );
				get_template_part( 'partials/common/cast-card', null, $cast_summary );
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>

<section class="recruit-section">
	<?php
	get_template_part(
		'partials/common/section-title',
		null,
		array(
			'ja' => '求人募集',
			'en' => 'RECRUIT',
		)
	);
	?>
</section>

<section id="top-recruit-hero" class="recruit-hero container">	
	<img src="<?php echo get_template_directory_uri(); ?>/public/pages/recruit/hero_bg.jpg" alt="スタッフ大募集" class="img-fluid recruit-hero__bg">
	<div class="recruit-hero__overlay">
		<div class="recruit-hero__bar">
			<h1 class="recruit-hero__catch">働くなら、今が CHANCE！</h1>
		</div>
	</div>

	<div class="recruit-hero__btns d-flex justify-content-center gap-3 p-2">
		<a href="<?php echo esc_url( home_url( '/recruit/#recruit-form' ) ); ?>" class="btn btn-primary text-white rounded animation">
			<i class="bi bi-envelope-fill me-2"></i> 今すぐ応募する
		</a>
		<a href="https://line.me/ti/p/8P74LKgy32" class="btn btn-primary text-white rounded animation2">
			<i class="bi bi-line me-2"></i> LINEから応募する
		</a>
	</div>
</section>

<?php get_footer(); ?>
