<?php get_header( 'column' ); ?>
<section class="single pdt40 sppdt20 pdb90 sppdb20">
	<div class=" column-container">
		<?php if ( have_posts() ) : ?>
			<div class="column-head">
				<?php if ( has_category() ) : ?>
					<span class="column-head__category">
						<?php the_category( ', ' ); ?>
					</span>
				<?php endif; ?>

				<h1 class="column-head__title"> <?php the_title(); ?> </h1>

				<div class="column-head__date">
					<time class="single__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><i class="bi bi-clock"></i><?php the_time( 'Y.m.d' ); ?></time>
					<time class="single__update" datetime="<?php the_modified_time( 'Y-m-d' ); ?>"><i class="bi bi-arrow-clockwise"></i><?php the_modified_time( 'Y.m.d' ); ?></time>
				</div>

				<div class="column-head__thumbnail">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php
						the_post_thumbnail(
							'full',
							array(
								'class'   => 'img-fluid',
								'loading' => 'lazy',
							)
						);
						?>
					<?php else : ?>
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/common/ogp.png" alt="<?php the_title(); ?>" class="img-fluid" loading="lazy">
					<?php endif; ?>
				</div>
			</div>

			<div class="column-body">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<!--関連記事-->
		<?php
		$categories   = get_the_category( $post->ID );
		$category_i_d = array();
		foreach ( $categories as $category ) {
			array_push(
				$category_i_d,
				$category
				->cat_ID
			);
		}
		?>
		<?php
		$args  = array(
			'post__not_in'   => array( $post->ID ),
			'posts_per_page' => 6,
			'category__in'   => $category_i_d,
			'orderby'        => 'rand',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) :
			?>
			<div class="column-related">
				<h2 class="column-related__title">おすすめの記事</h2>
				<div class="column-related__list">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<a href="<?php the_permalink(); ?>" class="column-related__item">
							<div class="column-related__thumbnail">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php
									the_post_thumbnail(
										'medium',
										array(
											'class'   => 'img-fluid',
											'loading' => 'lazy',
										)
									);
									?>
								<?php else : ?>
									<img src="<?php echo get_template_directory_uri(); ?>/src/img/common/ogp.png" alt="<?php the_title(); ?>" class="img-fluid" loading="lazy">
								<?php endif; ?>
							</div>
							<div class="column-related__content">
								<h3 class="column-related__content-title"><?php the_title(); ?></h3>
								<time class="column-related__content-date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
							</div>
						</a>
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
