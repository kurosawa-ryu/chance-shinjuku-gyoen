<section class="pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub"><?php echo strtoupper( $post->post_name ); ?></span><br>
		<h2><?php the_title(); ?></h2>
	</div>
	<div class="container box">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>
