<?php
/* Template Name: 10_予約フォーム(en) */
get_header( 'en' ); ?>
<section class="reserved pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">RESERVED&nbsp;FORM</span><br>
	</div>
	<div class="container roundedbox">
		<p class="text-center">You can make a reservation by phone, LINE, or the reservation form.</p>
		<p class="text-center">For same-day or urgent reservations, please call.</p>
		<p class="text-center">※Reservations made through the reservation form or LINE may take a while to receive a response. (We can respond within 24 hours.)</p>
		<div class="mgb30 d-flex flex-column align-items-center justify-content-center gap-2">
			<div class="d-flex justify-content-center gap-3">
				<a href="tel:0353577889" class="btn btn-red rounded">
					<i class="bi bi-telephone-fill" aria-hidden="true"></i> Reserve by phone
				</a>
				<a href="https://lin.ee/UDXT9p5" target="_blank" rel="noopener noreferrer" class="btn btn-red rounded">
					<i class="bi bi-line" aria-hidden="true"></i> Reserve by LINE
				</a>
			</div>
		</div>
		
		<div id="reserved-form" data-form-id="<?php echo get_option( 'wpcf7_reserved_form_id' ); ?>" data-lang="en"></div>

		<h4 class="text-danger fw-bold mgb10">Notice</h4>
		<div class="mgb30 spmgb15 border border-danger rounded p-3">
			<ul class="list-unstyled mb-0">
				<li class="mb-2">※Reservations made through the reservation form will be automatically sent an email within 5 minutes from the store.</li>
				<li class="mb-2">If you don't receive a response, please note that the reservation cannot be made.</li>
				<li class="mb-2">※Reservations made by email may take a while to receive a response (we can respond within 24 hours).</li>
				<li class="mb-2">For same-day or urgent reservations, please call.</li>
				<li>Please note that if you have not unblocked the domain or have not set up domain-specific reception for "info@chance-shinjuku-gyoen.jp", we may not be able to respond.</li>
			</ul>
		</div>
	</div>
</section>

<?php get_footer( 'en' ); ?>
