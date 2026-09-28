<?php get_header( 'en' ); ?>
<div id="cast_root" data-cast-id="<?php echo $post->ID; ?>"></div>
<section class="single pdt40 sppdt20 pdb90 sppdb20">
	<div class="container box">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				$data = get_staff_data( $post->ID );
				$name = get_post_meta( $post->ID, 'am-name-en', true );
				$age  = str_replace( '歳', ' yo', get_post_meta( $post->ID, 'am-age', true ) );
				switch ( get_post_meta( $post->ID, 'am-sexuality', true ) ) {
					case 'ゲイ':
						$sexuality = 'gay';
						break;
					case 'バイ':
						$sexuality = 'bi';
						break;
					case 'ノンケ':
						$sexuality = 'straight';
						break;
					default:
						$sexuality = '';
				}
				?>
				<div class="cast__grid">
					<div class="cast_name">
						<h2 class="cast_name__title"><?php echo $name; ?></h2>
						<a href="/en/reserved/?boy=<?php echo urlencode( $name ); ?>" class="btn btn-red">Reserve this boy</a>
					</div>

					<div class="staff_slider_box" id="staff_slider_box" data-images="<?php echo esc_attr( json_encode( $data['images'] ) ); ?>" data-thumbnail="<?php echo esc_attr( json_encode( $data['thumbnail'] ) ); ?>">
					</div>

					<div class="card card-red profile">
						<div class="card-heading">Profile</div>
						<div class="card-body">
							<table>

							</table>
							<ul class="flex mgb0">
								<li><span>Height</span><?php echo $data['height']; ?></li>
								<li><span>Weight</span><?php echo $data['weight']; ?></li>
								<li><span>Age</span><?php echo $age; ?></li>
								<li><span>SEX</span><?php echo $sexuality; ?></li>
								<li><span>Cock</span><?php echo $data['size']; ?></li>
							</ul>
						</div>
					</div>

					<div class="playlist">
						<div class="card card-red">
							<div class="card-heading clearfix"><span class="d-block text-start float-start">PLAY LIST</span><span class="d-block text-end float-end fs12 spfs12">◎…good 〇…possible △…challenging ×…impossible</span></div>
							<div class="card-body">
								<ul class="flex mgb0">
									<li class="card card-xs">
										<div class="card-heading">bottom</div>
										<div class="card-body"><span class="red"><?php echo $data['optBUke']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">top</div>
										<div class="card-body"><span class="red"><?php echo $data['optBTachi']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">3P・4P</div>
										<div class="card-body"><span class="red"><?php echo $data['opt3p4p']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">boy's play</div>
										<div class="card-body"><span class="red"><?php echo $data['optTachi']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">soft s</div>
										<div class="card-body"><span class="red"><?php echo $data['optSoftSM']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">viewing fap</div>
										<div class="card-body"><span class="red"><?php echo $data['optOna']; ?></span></div>
									</li>
								</ul>
							</div>
						</div>
						<ul class="btn_box">
							<?php echo get_cast_btns_en( $data ); ?>
						</ul>
					</div>

					<div class="card week schedule">
						<div class="card-heading">Schedule</div>
						<div class="card-body">
							<?php $schedule_data = chance_get_cast_schedule_en( $post->ID ); ?>
							<div id="cast_schedule" data-schedule="<?php echo esc_attr( json_encode( $schedule_data ) ); ?>" data-lang="en"></div>
						</div>
					</div>

					<div class="accordion_card comment">
						<?php if ( ! empty( $data['commentManager_en'] ) ) : ?>
								<div class="card">
									<a href="#" class="card-heading nomove d-md-block d-none"><span>Manager's comment</span></a>
									<button class="card-heading nomove d-md-none w-100 border-0 bg-transparent text-start" type="button" data-bs-toggle="collapse" data-bs-target="#managerComment" aria-expanded="false" aria-controls="managerComment">
										<span>Manager's comment</span>
										<i class="bi bi-chevron-down" aria-hidden="true"></i>
									</button>
									<div id="managerComment" class="card-body overflow-y-scroll collapse d-md-block"><?php echo nl2br( $data['commentManager_en'] ); ?></div>
							</div>

						<?php endif; ?>

						<?php if ( get_the_content() ) : ?>
								<div class="card">
									<a href="#" class="card-heading nomove d-md-block d-none"><span>Boy's comment</span></a>
									<button class="card-heading nomove d-md-none w-100 border-0 bg-transparent text-start" type="button" data-bs-toggle="collapse" data-bs-target="#boyComment" aria-expanded="false" aria-controls="boyComment">
										<span>Boy's comment</span>
										<i class="bi bi-chevron-down" aria-hidden="true"></i>
									</button>
									<div id="boyComment" class="card-body overflow-y-scroll collapse d-md-block"><?php echo nl2br( $data['introduction_en'] ); ?></div>
								</div>
						<?php endif; ?>
						<?php if ( ! empty( $data['reviewBoys_en'] ) ) : ?> 
							<div class="card">
								<a href="#" class="card-heading nomove d-md-block d-none"><span>Boy's review</span></a>
								<button class="card-heading nomove d-md-none w-100 border-0 bg-transparent text-start" type="button" data-bs-toggle="collapse" data-bs-target="#boyReview" aria-expanded="false" aria-controls="boyReview">
									<span>Boy's review</span>
									<i class="bi bi-chevron-down" aria-hidden="true"></i>
								</button>
								<div id="boyReview" class="card-body overflow-y-scroll collapse d-md-block"><?php echo nl2br( $data['reviewBoys_en'] ); ?></div>
							</div>
						<?php endif; ?>
					</div>
				<?php
		endwhile;
		endif;
		?>
	</div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
	var targets = document.getElementsByClassName('collapse');
	function adjustShowClass() {
		if (window.innerWidth >= 768) { // md breakpoint = 768px (Bootstrapの標準)
			for (var i = 0; i < targets.length; i++) {
				targets[i].classList.add('show');
			}
		} else {
			for (var i = 0; i < targets.length; i++) {
				targets[i].classList.remove('show');
			}
		}
	}

	// 初期ロード時に実行
	adjustShowClass();

	// リサイズ時にも実行
	window.addEventListener('resize', adjustShowClass);
});
</script>
<?php get_footer( 'en' ); ?>
