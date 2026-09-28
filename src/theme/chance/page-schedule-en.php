<?php
/* Template Name: 10_ボーイスケジュール(en) */
?>
<?php get_header( 'en' ); ?>
<?php
$casts_with_shift = get_today_staff_en( get_schedule_page_selected_day() );
?>
<section class="schedule pdb90 sppdb20">
	<h2 class="mgb90 spmgb20 sectionTitle">
		<span class="en sectionTitle--sub">BOY&nbsp;SCHEDULE</span><br>
	</h2>
	<div class="container box">
		<div id="schedule-day" data-active-day="<?php echo get_schedule_page_params(); ?>" data-lang="en"></div>
		<div class="row gx-2 gy-3">
			<?php if ( ! empty( $casts_with_shift ) ) : ?>
				<?php foreach ( $casts_with_shift as $cast_with_shift ) : ?>
					<?php get_template_part( 'partials/common/cast-card-with-shift-en', null, $cast_with_shift ); ?>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="noupdated container">
					<p>COMING SOON</p>
					<p>※The schedule for the following week will be updated every Thursday night.</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php get_footer( 'en' ); ?>
