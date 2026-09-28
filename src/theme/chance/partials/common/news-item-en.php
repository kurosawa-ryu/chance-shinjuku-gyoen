<?php
$en_content = get_post_meta( get_the_ID(), 'news_english_content', true );
if ( $en_content ) :
	?>
	<article>
		<div class="row">
			<div class="col-lg-2 col-md-3 col-sm-4 pdt5 sppdt0 clearfix">
				<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
				<span class="cat<?php echo get_news_post_color( get_the_title() ); ?>"><?php the_title(); ?></span>
			</div>
			<div class="col-lg-10 col-md-9 col-sm-8 contents">
				<div class="img_box">
			<?php echo get_news_image( get_the_ID() ); ?>
				</div>
				<div class="text"><?php echo nl2br( $en_content ); ?></div>
			</div>	
		</div>
	</article>
<?php endif; ?>
