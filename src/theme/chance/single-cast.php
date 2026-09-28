<?php
if ( is_en() ) {
	get_template_part( '/en/single-cast' );
	exit;
}
?>
<?php get_header(); ?>
<div id="cast_root" data-cast-id="<?php echo $post->ID; ?>"></div>
	<section class="single pdt40 sppdt20 pdb90 sppdb20">
		<div class="container box">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				$data = get_staff_data( $post->ID );
				?>
				<div class="cast__grid">
					<div class="cast_name">
						<h2 class="cast_name__title"><?php the_title(); ?></h2>
						<a href="<?php echo esc_url( home_url( '/reserved/?boy=' . urlencode( get_the_title() ) ) ); ?>" class="btn btn-red"><span class="d-inline d-md-none d-lg-inline">このボーイを</span>予約する</span></a>
					</div>

					<div class="staff_slider_box" id="staff_slider_box" data-images="<?php echo esc_attr( json_encode( $data['images'] ) ); ?>" data-thumbnail="<?php echo esc_attr( json_encode( $data['thumbnail'] ) ); ?>">
					</div>
					
					<div class="card card-red profile">
						<div class="card-heading">プロフィール</div>
						<div class="card-body">
							<table>
								
							</table>
							<ul class="flex mgb0">
								<li><span>身長</span><?php echo $data['height']; ?></li>
								<li><span>体重</span><?php echo $data['weight']; ?></li>
								<li><span>年齢</span><?php echo $data['age']; ?></li>
								<li><span>SEX</span><?php echo $data['sexuality']; ?></li>
								<li><span>Pサイズ</span><?php echo $data['size']; ?></li>
							</ul>
						</div>
					</div>

					<div class="playlist">
						<div class="card card-red">
							<div class="card-heading clearfix"><span class="d-block text-start float-start">PLAY LIST</span><span class="d-block text-end float-end fs12 spfs12">◎…得意 〇…可能 △…挑戦中 ×…不可能</span></div>
							<div class="card-body">
								<ul class="flex mgb0">
									<li class="card card-xs">
										<div class="card-heading">バックウケ</div>
										<div class="card-body"><span class="red"><?php echo $data['optBUke']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">バックタチ</div>
										<div class="card-body"><span class="red"><?php echo $data['optBTachi']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">3P・4P</div>
										<div class="card-body"><span class="red"><?php echo $data['opt3p4p']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">ボーイ絡み</div>
										<div class="card-body"><span class="red"><?php echo $data['optTachi']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">ソフトS</div>
										<div class="card-body"><span class="red"><?php echo $data['optSoftSM']; ?></span></div>
									</li>
									<li class="card card-xs">
										<div class="card-heading">オナニー鑑賞</div>
										<div class="card-body"><span class="red"><?php echo $data['optOna']; ?></span></div>
									</li>
								</ul>
							</div>
						</div>
						<ul class="btn_box">
							<?php echo get_cast_btns( $data ); ?>
						</ul>
					</div>

					<div class="card week schedule">
						<div class="card-heading">出勤情報</div>
						<div class="card-body">
							<?php $schedule_data = chance_get_cast_schedule( $post->ID ); ?>
							<div id="cast_schedule" data-schedule="<?php echo esc_attr( json_encode( $schedule_data ) ); ?>"></div>
						</div>
					</div>

					<div class="accordion_card comment">
						<div class="card">
							<a href="#" class="card-heading nomove d-md-block d-none"><span>マネージャーからの一言</span></a>
							<button class="card-heading nomove d-md-none w-100 border-0 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#managerComment" aria-expanded="false" aria-controls="managerComment">
								<span>マネージャーからの一言</span>
								<i class="bi bi-chevron-down" aria-hidden="true"></i>
							</button>
							<div id="managerComment" class="card-body overflow-y-scroll collapse d-md-block">
							<?php if ( ! empty( $data['commentManager'] ) ) : ?>
								<?php echo nl2br( $data['commentManager'] ); ?>
							<?php else : ?>
								<p class="text-center">掲載準備中</p>
							<?php endif; ?>
							</div>
						</div>
						<div class="card">
							<a href="#" class="card-heading nomove d-md-block d-none"><span>ボーイから一言</span></a>
							<button class="card-heading nomove d-md-none w-100 border-0 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#boyComment" aria-expanded="false" aria-controls="boyComment">
								<span>ボーイから一言</span>
								<i class="bi bi-chevron-down" aria-hidden="true"></i>
							</button>
							<div id="boyComment" class="card-body overflow-y-scroll collapse d-md-block">
								<?php if ( get_the_content() ) : ?>
									<?php the_content(); ?>
								<?php else : ?>
									<p class="text-center">掲載準備中</p>
								<?php endif; ?>
							</div>
						</div>
						<div class="card">
							<a href="#" class="card-heading nomove d-md-block d-none"><span>ボーイレビュー</span></a>
							<button class="card-heading nomove d-md-none w-100 border-0 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#boyReview" aria-expanded="false" aria-controls="boyReview">
								<span>ボーイレビュー</span>
								<i class="bi bi-chevron-down" aria-hidden="true"></i>
							</button>
							<div id="boyReview" class="card-body overflow-y-scroll collapse d-md-block">
								<?php if ( ! empty( $data['reviewBoys'] ) ) : ?>
									<?php echo nl2br( $data['reviewBoys'] ); ?>
								<?php else : ?>
									<p class="text-center">ボーイレビュー募集中</p>
								<?php endif; ?>
							</div>
						</div>
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

<?php get_footer(); ?>
