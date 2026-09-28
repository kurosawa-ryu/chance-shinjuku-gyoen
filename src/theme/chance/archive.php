<?php get_header( 'column' ); ?>
<section class="all_staff pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">ALL&nbsp;STAFF</span><br>
		<h2><?php the_archive_title(); ?></h2>
	</div>
	<div class="container box">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<article class="schedule_box clearfix">
					<div class="col-2 matchbox">
						<a href="<?php the_permalink(); ?>" class="bd_green d-block">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( array( 200, 200 ), array( 'class' => 'img-fluid mx-auto' ) );
							}
							?>
						</a>
					</div>
					<div class="col-10 matchbox">
						<h3 class="double_title green d-inline-block fs18 pdr10 mgb15"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="contents">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</article>

			<?php endwhile; ?>
		<?php else : ?>
			<div>COMING SOON</div>
		<?php endif; ?>

	</div>
</section>
<?php get_footer(); ?>
