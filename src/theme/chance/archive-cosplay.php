<?php get_header(); ?>
	<section class="cosplay pdb90 sppdb20">
		<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">COSUPLAY</span><br>
			<h2>コスプレ</h2>
		</div>
		<div class="container box">
			<div class="row g-2">

				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) :
						the_post();
						$pay  = get_post_meta( $post->ID, 'cosplay_pay', true );
						$text = get_post_meta( $post->ID, 'cosplay_text', true );
						?>

						<div class="col-sm-3 col-4 mgb20 spmgb10">
							<div class="img_box matchbox">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'cast_thumb_top', array( 'class' => 'img-fluid mx-auto' ) );
								} else {
									echo '<img src="' . get_template_directory_uri() . '/src/img/page/cosplay-no.jpg" alt="画像がありません" width="210" height="260" class="img-fluid mx-auto loading="lazy"">';
								}
								?>
								<h3><?php the_title(); ?></h3>
								<?php
								if ( ! empty( $pay ) ) {
									echo '<p class="red">￥ ' . $pay . '</p>';
								}
								if ( ! empty( $text ) ) {
									echo '<p class="ls_-05">' . $text . '</p>';
								}
								?>
							</div>
						</div>

					<?php endwhile; ?>
				<?php else : ?>
					<p class="col-sm-12 text-center fs30 bold">COMING SOON</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
