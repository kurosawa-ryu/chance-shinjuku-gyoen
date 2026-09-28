<?php

get_header();
$category = get_the_category();
$cat_slug = $category[0]->category_nicename; //スラッグ取得
//スラッグを大文字に変換
$cat_slug = strtoupper( $cat_slug );

?>
<section class="all_staff pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub"><?php echo ( $cat_slug ); ?></span><br>
		<h2><?php single_cat_title(); ?>の記事一覧</h2>
	</div>
	<div class="container box column-category__box">
		<?php if ( have_posts() ) : ?>
			<div class="column-related__list">
				<?php
				while ( have_posts() ) :
					the_post();
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
		<?php else : ?>
			<div>COMING SOON</div>
		<?php endif; ?>

	</div>
</section>

<?php
get_footer(); ?>
