<?php get_header(); ?>
<main class="error-page">
	<div class="container">
		<section class="error-404 not-found pdb90 sppdb50">
			<div class="error-header text-center mgb40 spmgb30">
				<h1 class="page-title"><span class="en">ERROR 404</span></h1>
				<h2 class="subtitle mgb20">ページが見つかりませんでした</h2>
			</div>
			<div class="error-content text-center mgb50 spmgb30">
				<p class="mgb20">お探しのページは移動または削除された可能性があります。</p>				
				<div class="error-buttons d-flex justify-content-center gap-4 flex-wrap mgb50">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
						<i class="bi bi-house-door-fill me-2"></i>トップページに戻る
					</a>
					<a href="<?php echo esc_url( home_url( '/cast/' ) ); ?>" class="btn btn-secondary">
						<i class="bi bi-people-fill me-2"></i>ボーイ一覧を見る
					</a>
				</div>
			</div>
		</section>
	</div>
</main>
<?php get_footer(); ?>
