<?php
if ( is_en() ) {
	get_template_part( '/en/archive-cast' );
	exit;
}
?>

<?php get_header(); ?>
<section class="all_staff pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">ALL&nbsp;STAFF</span><br>
		<h2>スタッフ一覧</h2>
	</div>
	<div class="container box">
		<div class="row gx-2 gy-3 align-items-stretch">
			<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
					$cast_summary = get_cast_summary( get_the_ID() );
					?>
					<?php get_template_part( 'partials/common/cast-card', null, $cast_summary ); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<p class="text-center fs30 bold">COMING SOON</p>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
