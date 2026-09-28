<?php
/* Template Name: 10_料金一覧 */
?>

<?php get_header(); ?>
<section class="price-page pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">PRICE</span><br>
		<h2>料金一覧</h2>
	</div>
	<div class="container box">
		<div class="bg">
			<ul class="list nav nav-tabs" role="tablist">
				<li class="active nav-item" role="presentation">
					<a href="#standard" data-bs-toggle="tab" data-bs-target="#standard" class="nomove nav-link active" role="tab" aria-controls="nav-standard" aria-selected="true">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/price-list01.png" alt="基本コース" width="118" height="22" class="img-fluid d-inline-block" loading="lazy" />
					</a>
				</li>
				<li class="nav-item" role="presentation"><a href="#stay" data-bs-toggle="tab" data-bs-target="#stay" class="nomove nav-link" role="tab" aria-controls="nav-stay" aria-selected="false"><img src="<?php echo get_template_directory_uri(); ?>/src/img/page/price-list02.png?ver=2.0.0" alt="ロングコース" width="118" height="22" class="img-fluid d-inline-block" loading="lazy" /></a></li>
				<li class="nav-item" role="presentation"><a href="#date" data-bs-toggle="tab" data-bs-target="#date" class="nomove nav-link" role="tab" aria-controls="nav-date" aria-selected="false"><img src="<?php echo get_template_directory_uri(); ?>/src/img/page/price-list03.png" alt="デートコース" width="118" height="22" class="img-fluid d-inline-block" loading="lazy" /></a></li>
				<li class="nav-item" role="presentation"><a href="#special" data-bs-toggle="tab" data-bs-target="#special" class="nomove nav-link" role="tab" aria-controls="nav-special" aria-selected="false"><img src="<?php echo get_template_directory_uri(); ?>/src/img/page/price-list04.png" alt="特殊コース" width="118" height="22" class="img-fluid d-inline-block" loading="lazy" /></a></li>
			</ul>
			<div class="tab-content">
				<div id="standard" class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-standard-tab" tabindex="0">
					<h3>基本コース</h3>
					<div class="row g-2 mgt30 mgb35">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>個室</caption>
								<tr>
									<th class="col-6">40分</th>
									<td class="col-6">￥14,000</td>
								</tr>
								<tr>
									<th>60分</th>
									<td>￥16,000</td>
								</tr>
								<tr>
									<th>90分</th>
									<td>￥20,000</td>
								</tr>
								<tr>
									<th>120分</th>
									<td>￥24,000</td>
								</tr>
								<tr>
									<th>180分</th>
									<td>￥29,000</td>
								</tr>
							</table>
							<div class="row g-0 other">
								<div class="col-6 bg_gray white pdl50">延長30分</div>
								<div class="col-6 bg_white red text-end">￥6,000</div>
							</div>
						</div>
						<div class="col-sm-6 spmgt10">
							<table class="table table-striped">
								<caption>出張</caption>
								<tr>
									<th class="col-6">60分</th>
									<td class="col-6">￥16,000</td>
								</tr>
								<tr>
									<th>90分</th>
									<td>￥20,000</td>
								</tr>
								<tr>
									<th>120分</th>
									<td>￥24,000</td>
								</tr>
								<tr>
									<th>180分</th>
									<td>￥29,000</td>
								</tr>
							</table>
							<div class="row g-0 other mgb10">
								<div class="col-6 bg_gray white pdl50">24h貸切</div>
								<div class="col-6 bg_white red text-end">￥80,000</div>
							</div>
							<div class="row g-0 other">
								<div class="col-6 bg_gray white pdl50">延長30分</div>
								<div class="col-6 bg_white red text-end">￥6,000</div>
							</div>
						</div>
					</div>
					<p class="discription">ボーイとゆっくりお話や、エッチをお楽しみいただける<br class="hidden-xs">スタンダードなコースです。</p>
					<p class="text-center bold lh_18 sp_left">
						※個室ご利用の場合、<span class="red">個室利用料は無料です</span>。<br>
						（ただし、個室には限りがございます。）<br>
						※ホテル宿泊代や、交通費等はお客様のご負担となります。<br>
						※片道1時間以上の場所への出張は別途遠方出張料を頂きます。<br>
						※出張コースにつきましてご不明な点は<a href="<?php echo esc_url( home_url( '/' ) ); ?>faq">Q&amp;A</a>をご覧いただくか、当店スタッフにお気軽にお問い合わせ下さい。</p>
					<div class="row g-2 mgt50 spmgt30">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>遠方出張料</caption>
								<tr>
									<th class="col-6">片道1h-1.5h</th>
									<td class="col-6">￥4,000</td>
								</tr>
								<tr>
									<th>片道1.5h-2h</th>
									<td>￥8,000</td>
								</tr>
								<tr>
									<th>片道2h-2.5h</th>
									<td>￥12,000</td>
								</tr>
								<tr>
									<th>以降30分ごと</th>
									<td>￥4,000</td>
								</tr>
							</table>
						</div>
					</div>

				</div>
				<div id="stay" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-stay-tab" tabindex="0">

					<h3>ロングコース</h3>
					<div class="row g-2 mgt30 mgb35">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>出張</caption>
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
								<caption>個室</caption>
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
					<p class="discription">21時から24時までの間で、お好きな開始時間をお選び下さい。</p>
					<p class="text-center bold lh_18 sp_left">※ロングコース及び、貸切コースは<span class="red">6時間前後の睡眠時間</span>を含めたコース設定とさせて頂いております。<br>※全て終了時間は翌朝9:00となります。<br>
					※個室ご利用の場合、<span class="red">個室利用料は無料です</span>。<br>
						（ただし、個室には限りがございます。）<br>
						※ホテル宿泊代や、交通費等はお客様のご負担となります。<br>※片道1時間以上の場所への出張は別途遠方出張料を頂きます。</p>
					<div class="row g-2 mgt50 spmgt30">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>遠方出張料</caption>
								<tr>
									<th class="col-6">片道1h-1.5h</th>
									<td class="col-6">￥4,000</td>
								</tr>
								<tr>
									<th>片道1.5h-2h</th>
									<td>￥8,000</td>
								</tr>
								<tr>
									<th>片道2h-2.5h</th>
									<td>￥12,000</td>
								</tr>
								<tr>
									<th>以降30分ごと</th>
									<td>￥4,000</td>
								</tr>
							</table>
						</div>
					</div>

				</div>
				<div id="date" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-date-tab" tabindex="0">

					<h3>デートコース</h3>
					<div class="row g-2 mgt30 mgb35">
						<div class="col-sm-6">
							<table class="table table-striped">
								<caption>デートコース単独の場合</caption>
								<tbody>
									<tr>
										<th>60分</th>
										<td>￥8,000</td>
									</tr>
									<tr>
										<th>120分</th>
										<td>￥14,000</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-6 spmgt10">
							<table class="table table-striped">
								<caption>他コースと併用の場合</caption>
								<tbody>
									<tr>
										<th>60分</th>
										<td>￥6,000</td>
									</tr>
									<tr>
										<th>120分</th>
										<td>￥12,000</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-6 spmgt10">
							<div class="row g-0 other">
								<div class="col-6 bg_gray white pdl50">延長30分</div>
								<div class="col-6 bg_white red text-end">￥4,000</div>
							</div>
						</div>
					</div>
					<p class="discription">性行為無しのコースです。<br>お好きなボーイと楽しくお食事やカラオケなどを<br class="hidden-xs">お手軽料金でお楽しみいただけます。</p>
					<p class="text-center bold lh_18 sp_left">※ホテル宿泊代や飲食代、交通費等はお客様のご負担となります。</p>

				</div>
				<div id="special" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-special-tab" tabindex="0">

					<h3>特殊コース</h3>
					<div class="row g-2 mgt30 mgb35">
						<div class="col-sm-6 col-sm-offset-3">
							<table class="table table-striped">
								<caption>スワップコース</caption>
								<tr>
									<th class="col-6">90分</th>
									<td class="col-6">￥26,000</td>
								</tr>
								<tr>
									<th>120分</th>
									<td>￥28,000</td>
								</tr>
							</table>
						</div>
					</div>
					<p class="discription">前半・後半で2名のボーイを指名するコースです。<br>90分コースは45分交代で2名、120分コースは60分交代で2名となります。</p>
					<div class="row g-2 mgt30 mgb35">
						<div class="col-sm-6 col-sm-offset-3">
							<table class="table table-striped">
								<caption>オナニー鑑賞コース</caption>
								<tr>
									<th class="col-6">30分</th>
									<td class="col-6">￥8,000</td>
								</tr>
							</table>
						</div>
					</div>
					<p class="discription">ボーイのオナニーをご覧いただけるコースです。<br>普段は見ることのできない、プライベートな姿をお楽しみください。</p>
					<div class="row g-2 mgt30 mgb35">
						<div class="col-sm-6 col-sm-offset-3">
							<table class="table table-striped">
								<caption>3Pコース</caption>
								<tr>
									<td class="text">ボーイ2名分の料金をお支払いください。</td>
								</tr>
							</table>
							<div class="row g-0 option">
								<div class="col-6 bg_gray white matchbox">ボーイ同士の絡み</div>
								<div class="col-6 bg_white red matchbox">+￥4,000</div>
							</div>
						</div>
					</div>
					<p class="discription">お客様1人とボーイ2人の3Pコースとなります。<br>普段なかなかできないプレイをこの機会に是非お楽しみください!!</p>
					<p class="text-center bold lh_18 sp_left">※2名以上のボーイも同時にご指名可能です。お気軽にお問い合わせ下さい。</p>
					<div class="row g-2 mgt30 mgb35">
						<div class="col-sm-6 col-sm-offset-3">
							<table class="table table-striped">
								<caption>ソフトS</caption>
								<tr>
									<td class="text">+￥2,000</td>
								</tr>
							</table>
						</div>
					</div>
					<p class="discription">言葉攻めや軽いスパンキングなど、身体に跡の残らないソフトなプレイとなります。</p>

				</div>
			</div>
		</div>
	</div>
	<div class="container text-center mgt20 visible-xs">
		<div class="roundedbox">
			<div class="fs18 spfs14 bold">
				<p class="mgb10">クレジット払いも可能です</p>
				<?php
					$email      = chance_get_store_email();
					$mail_query = '?subject=クレジットでの支払い&body=' . rawurlencode( get_my_mail_template() );
				if ( $email ) :
					?>
				<a href="mailto:<?php echo esc_attr( $email . $mail_query ); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/src/img/common/credit.jpg?v=2" alt="クレジット" class="img-responsive">
				</a>
				<?php endif; ?>
			</div>
			<p class="fs12 mgb20 spmgb10">※料金は全て税込み価格です。</p>
		</div>
	</div>
</section>
<section class="howto pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">HOW&nbsp;TO&nbsp;USE</span><br>
		<h2>ご利用方法</h2>
	</div>
	<div class="container box">
		<div class="roundedbox">
			<h3>個室コースの流れ</h3>
			<div class="row g-2 sm-gutters sp-sm-gutters mgt30 spmgt15">
				<div class="col-sm-3 col-6 img_box">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow01.jpg" alt="お電話・メールでご予約" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">1</span>
					</div>
					<p class="fs14 mgb0">ホームページを見てお電話・メールにてご予約下さい。</p>
				</div>
				<div class="col-sm-3 col-6 img_box">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow02.jpg" alt="指定場所からお電話下さい。" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">2</span>
					</div>
					<p class="fs14 mgb0">ご予約の際お伝えした指定場所から当日お電話下さい。</p>
				</div>
				<div class="col-sm-3 col-6 img_box spmgt10">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow03.jpg" alt="個室までご案内" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">3</span>
					</div>
					<p class="fs14 mgb0">指定場所よりお電話にて個室までご案内させて頂きます。</p>
				</div>
				<div class="col-sm-3 col-6 img_box spmgt10">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow04.jpg" alt="ご指名のボーイが直接対応" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">4</span>
					</div>
					<p class="fs14 mgb0">個室のインターホンを鳴らして頂くと、ご指名のボーイが直接対応させて頂きます。</p>
				</div>
			</div>
		</div>
		<div class="roundedbox mgt30">
			<h3 class="dark">出張コースの流れ</h3>
			<div class="row g-2 sm-gutters sp-sm-gutters mgt30 spmgt15">
				<div class="col-sm-3 col-6 img_box">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow05.jpg" alt="お電話・メールでご予約" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">1</span>
					</div>
					<p class="fs14 mgb0">ホームページを見てお電話・メールにてご予約下さい。</p>
				</div>
				<div class="col-sm-3 col-6 img_box">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow06.jpg" alt="ホテルからお電話下さい。" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">2</span>
					</div>
					<p class="fs14 mgb0">ホテルへチェックインされましたら当店へご連絡下さい。</p>
				</div>
				<div class="col-sm-3 col-6 img_box spmgt10">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow07.jpg" alt="在室確認" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">3</span>
					</div>
					<p class="fs14 mgb0">在室確認が出来次第、ボーイを向かわせる形になります。</p>
				</div>
				<div class="col-sm-3 col-6 img_box spmgt10">
					<div class="position-relative mgb10">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/page/howto-flow08.jpg" alt="ボーイが直接お部屋へ" width="195" height="150" class="img-fluid" loading="lazy" />
						<span class="num">4</span>
					</div>
					<p class="fs14 mgb0">ボーイがお時間までに直接お部屋へお伺いいたします。</p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
