<?php
/* Template Name: 10_料金一覧(en) */
?>
<?php get_header( 'en' ); ?>
<section class="price-page pdb90 sppdb20">
	<h2 class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">PRICE</span><br>
	</h2>
	<div class="container box">
		<div class="bg">
			<ul class="list nav nav-tabs" role="tablist">
				<li class="active nav-item" role="presentation">
					<a href="#standard" data-bs-toggle="tab" data-bs-target="#standard" class="nomove nav-link active" role="tab" aria-controls="nav-standard" aria-selected="true">
						BASIC
					</a>
				</li>
				<li class="nav-item" role="presentation"><a href="#stay" data-bs-toggle="tab" data-bs-target="#stay" class="nomove nav-link" role="tab" aria-controls="nav-stay" aria-selected="false">LONG</a></li>
				<li class="nav-item" role="presentation"><a href="#date" data-bs-toggle="tab" data-bs-target="#date" class="nomove nav-link" role="tab" aria-controls="nav-date" aria-selected="false">DATE</a></li>
				<li class="nav-item" role="presentation"><a href="#special" data-bs-toggle="tab" data-bs-target="#special" class="nomove nav-link" role="tab" aria-controls="nav-special" aria-selected="false">SPECIAL</a></li>
			</ul>
			<div class="tab-content">
				<div id="standard" class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-standard-tab" tabindex="0">
					<h3>BASIC</h3>
					<div class="row g-0 mgt30 mgb35">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>Private room</caption>
								<tr>
									<th class="col-6">40 minutes</th>
									<td class="col-6">￥14,000</td>
								</tr>
								<tr>
									<th>60 minutes</th>
									<td>￥16,000</td>
								</tr>
								<tr>
									<th>90 minutes</th>
									<td>￥20,000</td>
								</tr>
								<tr>
									<th>120 minutes</th>
									<td>￥24,000</td>
								</tr>
								<tr>
									<th>180 minutes</th>
									<td>￥29,000</td>
								</tr>
							</table>
							<div class="row g-0 other">
								<div class="col-6 bg_gray white pdl50">Extension 30 minutes</div>
								<div class="col-6 bg_white red text-end">￥6,000</div>
							</div>
						</div>
						<div class="col-sm-6 spmgt10">
							<table class="table table-striped">
								<caption>Outcall</caption>
								<tr>
									<th class="col-6">60 minutes</th>
									<td class="col-6">￥16,000</td>
								</tr>
								<tr>
									<th>90 minutes</th>
									<td>￥20,000</td>
								</tr>
								<tr>
									<th>120 minutes</th>
									<td>￥24,000</td>
								</tr>
								<tr>
									<th>180 minutes</th>
									<td>￥29,000</td>
								</tr>
							</table>
							<div class="row g-0 other mgb10">
								<div class="col-6 bg_gray white pdl50">24h exclusive</div>
								<div class="col-6 bg_white red text-end">￥80,000</div>
							</div>
							<div class="row g-0 other">
								<div class="col-6 bg_gray white pdl50">Extension 30 minutes</div>
								<div class="col-6 bg_white red text-end">￥6,000</div>
							</div>
						</div>
					</div>
					<p class="discription">This is a standard course where you can enjoy a leisurely conversation and intimate moments with the boys.<br class="hidden-xs"></p>
					<p class="text-center bold lh_18 sp_left">*Hotel accommodation fees and transportation costs will be borne by the customer.<br>
						*For outcalls to locations more than one hour away, an additional long-distance travel fee will be charged.<br>
						*If you have any questions regarding the outcall course, please refer to our <a href="<?php echo esc_url( home_url( '/' ) ); ?>faq">Q&amp;A</a> or feel free to contact our staff.</p>
					<div class="row g-0 mgt50 spmgt30">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>Long distance travel fee</caption>
								<tr>
									<th class="col-6">1h-1.5h</th>
									<td class="col-6">￥4,000</td>
								</tr>
								<tr>
									<th>1.5h-2h</th>
									<td>￥8,000</td>
								</tr>
								<tr>
									<th>2h-2.5h</th>
									<td>￥12,000</td>
								</tr>
								<tr>
									<th>After 30 minutes</th>
									<td>￥4,000</td>
								</tr>
							</table>
						</div>
					</div>

				</div>
				<div id="stay" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-stay-tab" tabindex="0">

					<h3>LONG</h3>
					<div class="row g-0 mgt30 mgb35">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>Outcall</caption>
								<!-- <thead>
									<tr>
										<th class="col-6">開始時間</th>
										<td class="col-6">料金</td>
									</tr>
								</thead> -->
								<tbody>
									<tr>
										<th>21:00~9:00</th>
										<td>￥32,000</td>
									</tr>
									<tr>
										<th>22:00~9:00</th>
										<td>￥31,000</td>
									</tr>
									<tr>
										<th>23:00~9:00</th>
										<td>￥30,000</td>
									</tr>
									<tr>
										<th>24:00~9:00</th>
										<td>￥29,000</td>
									</tr>
									<!--tr>
										<th>25:00~9:00</th>
										<td>￥28,000</td>
									</tr-->
								</tbody>
							</table>
						</div>
						<div class="col-sm-6 spmgt10">
							<table class="table table-striped">
								<caption>Private room</caption>
								<tbody>
									<tr>
										<th>21:00~9:00</th>
										<td>￥36,000</td>
									</tr>
									<tr>
										<th>22:00~9:00</th>
										<td>￥35,000</td>
									</tr>
									<tr>
										<th>23:00~9:00</th>
										<td>￥34,000</td>
									</tr>
									<tr>
										<th>24:00~9:00</th>
										<td>￥33,000</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<p class="discription">Please choose your preferred start time between 21:00 and 24:00.</p>
					<p class="text-center bold lh_18 sp_left">*The long course and private course are set to include approximately <span class="red">6 hours of sleep time</span>.<br>*All end times will be at 9:00 the following morning.<br>
						*Hotel accommodation fees and transportation costs will be borne by the customer.<br>*A separate long-distance travel fee will be charged for locations more than one hour away.</p>
					<div class="row g-0 mgt50 spmgt30">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>Long distance travel fee</caption>
								<tr>
									<th class="col-6">1h-1.5h</th>
									<td class="col-6">￥4,000</td>
								</tr>
								<tr>
									<th>1.5h-2h</th>
									<td>￥8,000</td>
								</tr>
								<tr>
									<th>2h-2.5h</th>
									<td>￥12,000</td>
								</tr>
								<tr>
									<th>After 30 minutes</th>
									<td>￥4,000</td>
								</tr>
							</table>
						</div>
					</div>

				</div>
				<div id="date" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-date-tab" tabindex="0">

					<h3>DATE</h3>
					<div class="row g-0 mgt30 mgb35">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>Date course only</caption>
								<tbody>
									<tr>
										<th>60 minutes</th>
										<td>￥8,000</td>
									</tr>
									<tr>
										<th>120 minutes</th>
										<td>￥14,000</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-6 spmgt10">
							<table class="table table-striped">
								<caption>With other courses</caption>
								<tbody>
									<tr>
										<th>60 minutes</th>
										<td>￥6,000</td>
									</tr>
									<tr>
										<th>120 minutes</th>
										<td>￥12,000</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-6 spmgt10">
							<div class="row g-0 other">
								<div class="col-6 bg_gray white pdl50">Extension 30 minutes</div>
								<div class="col-6 bg_white red text-end">￥4,000</div>
							</div>
						</div>
					</div>
					<p class="discription">This is a course without sexual activities.<br>You can enjoy meals and karaoke with your favorite boy at an affordable price.<br class="hidden-xs"></p>
					<p class="text-center bold lh_18 sp_left">*Hotel accommodation fees and transportation costs will be borne by the customer.</p>
				</div>
				<div id="special" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-special-tab" tabindex="0">

					<h3>SPECIAL</h3>
					<div class="row g-0 mgt30 mgb35">
						<div class="col-sm-6 col-sm-offset-3">
							<table class="table table-striped">
								<caption>SWAP</caption>
								<tr>
									<th class="col-6">90 minutes</th>
									<td class="col-6">￥26,000</td>
								</tr>
								<tr>
									<th>120 minutes</th>
									<td>￥28,000</td>
								</tr>
							</table>
						</div>
					</div>
					<p class="discription">This course allows you to choose two boys, one for the first half and one for the second half.<br>In the 90-minute course, the boys will switch every 45 minutes, and in the 120-minute course, they will switch every 60 minutes.</p>
					<div class="row g-0 mgt30 mgb35">
						<div class="col-sm-6 col-sm-offset-3">
							<table class="table table-striped">
								<caption> masturbation viewing</caption>
								<tr>
									<th class="col-6">30 minutes</th>
									<td class="col-6">￥8,000</td>
								</tr>
							</table>
						</div>
					</div>
					<p class="discription">This is a course where you can watch the boy's masturbation.<br>Please enjoy a private view that you usually cannot see.</p>
					<div class="row g-0 mgt30 mgb35">
						<div class="col-sm-6 col-sm-offset-3">
							<table class="table table-striped">
								<caption>3P course</caption>
								<tr>
									<td class="text">Please pay for two boys' fees.</td>
								</tr>
							</table>
							<div class="row g-0 option">
								<div class="col-6 bg_gray white matchbox">Interaction between boys</div>
								<div class="col-6 bg_white red matchbox">+￥4,000</div>
							</div>
						</div>
					</div>
					<p class="discription">This is a 3P course with one customer and two boys. <br>Enjoy the play that you usually can't experience on this occasion!</p>
					<p class="text-center bold lh_18 sp_left">*You can also request more than two boys at the same time. Please feel free to contact us.</p>
					<div class="row g-0 mgt30 mgb35">
						<div class="col-sm-6 col-sm-offset-3">
							<table class="table table-striped">
								<caption>Soft S</caption>
								<tr>
									<td class="text">+￥2,000</td>
								</tr>
							</table>
						</div>
					</div>
					<p class="discription">This is a soft play that leaves no marks on the body, including verbal teasing and light spanking.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container text-center mgt20 visible-xs">
		<div class="fs18 spfs14 bold text-center">
			<p class="mgb10">Credit card payment is also available.</p>
			<?php
				$email      = chance_get_store_email();
				$mail_query = '?subject=Credit Card Payment&body=' . rawurlencode( get_my_mail_template( 'en' ) );
			if ( $email ) :
				?>
			<a href="mailto:<?php echo esc_attr( $email . $mail_query ); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/common/credit.jpg?v=2" alt="クレジット" class="img-responsive">
			</a>
			<?php endif; ?>
		</div>
		<p class="fs12 mgb20 spmgb10">*All prices include tax.</p>
	</div>
</section>
<section class="howto pdb90 sppdb20">
	<h2 class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">HOW&nbsp;TO&nbsp;USE</span><br>
	</h2>
	<div class="container box">
		<div class="bd_red">
			<h3>Flow of the private room course</h3>
			<div class="row g-2 sm-gutters sp-sm-gutters mgt30 spmgt15">
				<div class="col-sm-3 col-6 img_box">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow01.jpg" alt="お電話・メールでご予約" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">1</span>
					</div>
					<p class="fs14 mgb0">Please check our website and make a reservation via phone or email.</p>
				</div>
				<div class="col-sm-3 col-6 img_box">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow02.jpg" alt="指定場所からお電話下さい。" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">2</span>
					</div>
					<p class="fs14 mgb0">Please call us on the day from the specified location you provided during your reservation.</p>
				</div>
				<div class="col-sm-3 col-6 img_box spmgt10">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow03.jpg" alt="個室までご案内" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">3</span>
					</div>
					<p class="fs14 mgb0">We will guide you to the private room via phone from the specified location.</p>
				</div>
				<div class="col-sm-3 col-6 img_box spmgt10">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow04.jpg" alt="ご指名のボーイが直接対応" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">4</span>
					</div>
					<p class="fs14 mgb0">When you ring the intercom of the private room, the boy you requested will assist you directly.</p>
				</div>
			</div>
		</div>
		<div class="bd_red mgt30">
			<h3 class="dark">Flow of the Outcall Course</h3>
			<div class="row g-2 sm-gutters sp-sm-gutters mgt30 spmgt15">
				<div class="col-sm-3 col-6 img_box">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow05.jpg" alt="お電話・メールでご予約" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">1</span>
					</div>
					<p class="fs14 mgb0">Please check our website and make a reservation via phone or email.</p>
				</div>
				<div class="col-sm-3 col-6 img_box">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow06.jpg" alt="ホテルからお電話下さい。" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">2</span>
					</div>
					<p class="fs14 mgb0">Please contact us once you have checked into the hotel.</p>
				</div>
				<div class="col-sm-3 col-6 img_box spmgt10">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow07.jpg" alt="在室確認" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">3</span>
					</div>
					<p class="fs14 mgb0">Once the room is confirmed, we will send the boy to you.</p>
				</div>
				<div class="col-sm-3 col-6 img_box spmgt10">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow08.jpg" alt="ボーイが直接お部屋へ" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">4</span>
					</div>
					<p class="fs14 mgb0">The boy will come directly to your room by the scheduled time.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer( 'en' ); ?>
