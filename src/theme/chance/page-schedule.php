<?php
/* Template Name: 10_ボーイスケジュール */
?>
<?php get_header(); ?>

	<?php
	$casts_with_shift = get_today_staff( get_schedule_page_selected_day() );
	?>
	<section class="schedule ">
		<div class=" sectionTitle">
			<span class="en sectionTitle--sub">BOY&nbsp;SCHEDULE</span><br>
			<h2>ボーイスケジュール</h2>
		</div>
		<div class="container box pdb90 sppdb20 pdt90 sppdt20">
			<div id="schedule-day" data-active-day="<?php echo get_schedule_page_params(); ?>" data-lang="<?php echo get_locale(); ?>"></div>
			<div class="row gx-2 gy-3">
				<?php if ( ! empty( $casts_with_shift ) ) : ?>
					<?php foreach ( $casts_with_shift as $cast_with_shift ) : ?>
						<?php get_template_part( 'partials/common/cast-card-with-shift', null, $cast_with_shift ); ?>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="noupdated container roundedbox">
						<p>COMING SOON</p>
						<p>※毎週木曜日の夜に翌週のシフトを更新予定</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>
