<?php
/* Template Name: 10_予約フォーム */
get_header(); ?>
<section class="reserved pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">RESERVED&nbsp;FORM</span><br>
		<h2>予約フォーム</h2>
	</div>
	<div class="container roundedbox">
		<p class="text-center">ご予約は、お電話以外でも、公式LINE、予約フォームより受け付けております。</p>
		<p class="text-center">当日やお急ぎのご予約の方は、お電話にてご予約ください。</p>
		<p class="text-center">※予約フォーム、LINEでのご予約は、返信まで多少お時間を要する場合がございます。<br>(24時間以内には返信可能でございます)</p>
		<div class="mgb30 d-flex flex-column align-items-center justify-content-center gap-2">
			<div class="d-flex justify-content-center gap-3">
				<a href="tel:0353577889" class="btn btn-red rounded">
					<i class="bi bi-telephone-fill" aria-hidden="true"></i> 電話でのご予約
				</a>
				<a href="https://lin.ee/UDXT9p5" target="_blank" rel="noopener noreferrer" class="btn btn-red rounded">
					<i class="bi bi-line" aria-hidden="true"></i> LINEでのご予約
				</a>
			</div>
		</div>
		
		<div id="reserved-form" data-form-id="<?php echo get_option( 'wpcf7_reserved_form_id' ); ?>"></div>

		<h4 class="text-danger fw-bold mgb10">注意事項</h4>
		<div class="mgb30 spmgb15 border border-danger rounded p-3">
			<ul class="list-unstyled mb-0">
				<li class="mb-2">※予約フォームからご予約頂きますと、当店から自動返信にて5分以内にメールをお送りしております。</li>
				<li class="mb-2">返信がない場合は、予約としてお取りできておりませんので、ご了承ください。</li>
				<li class="mb-2">※メールでのご予約は返信まで多少お時間(24時間以内には返信可能でございます)がかかりますので、</li>
				<li class="mb-2">当日ご予約の方や、お急ぎのご予約の方は、お電話にてご予約ください。</li>
				<li>ドメイン拒否を解除、または「info@chance-shinjuku-gyoen.jp」をドメイン指定受信して頂かないとご返信することができかねます。</li>
			</ul>
		</div>
	</div>
</section>

<?php get_footer(); ?>
