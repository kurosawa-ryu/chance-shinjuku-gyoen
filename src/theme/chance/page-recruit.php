<?php
/* Template Name: 10_求人 */
get_header(); ?>

<section id="page-recruit-hero" class="recruit-hero container">
	<img src="<?php echo get_template_directory_uri(); ?>/public/pages/recruit/hero_bg.jpg" alt="スタッフ大募集" class="img-fluid recruit-hero__bg">
	<!-- <img src="<?php echo get_template_directory_uri(); ?>/public/pages/recruit/boy1.webp" alt="スタッフ大募集" class="recruit-hero__boy1">
	<img src="<?php echo get_template_directory_uri(); ?>/public/pages/recruit/boy2.webp" alt="スタッフ大募集" class="recruit-hero__boy2"> -->
	<div class="recruit-hero__overlay">
		<div class="recruit-hero__bar">
			<h1 class="recruit-hero__catch">働くなら、今が CHANCE！</h1>
		</div>
	</div>
</section>

<section class="recruit-title container">
	<h1 class="recruit-title__heading">
		&#65340; スタッフ大募集 &#65295;
	</h1>
	<div class="recruit-title__cta">
		<div class="row align-items-center justify-content-center">
			<div class="col-md-6 mb-3 mb-md-0">
				<a href="#recruit-form" class="btn btn-danger btn-lg w-100">
					<i class="bi bi-envelope-fill me-2"></i> フォームから応募
				</a>
			</div>
			<div class="col-md-6">
				<a href="https://line.me/ti/p/8P74LKgy32" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg w-100">
					<i class="bi bi-line me-2"></i> LINEで今すぐ応募
				</a>
			</div>
		</div>
	</div>
</section>

<section class="recruit-intro container">
	<h2 class="recruit-intro__heading">
		CHANCE新宿の<br class="d-md-none">おすすめポイント
	</h2>
	<div class="recruit-hero__intro-box">
		<div class="row g-3">
			<div class="col-6 col-md-4">
				<div class="card" >
					<div class="card-header">
						<i class="bi bi-calendar-check"></i>
					</div>
					<div class="card-body">
						<h5 class="card-title">完全自由シフト制</h5>
						<p class="card-text">自由に勤務時間を決められるので、副業や学生の方も働きやすいです。</p>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4">
				<div class="card" >
					<div class="card-header">
						<i class="bi bi-cash-coin"></i>
					</div>
					<div class="card-body">
						<h5 class="card-title">完全日払い制</h5>
						<p class="card-text">その日のお給料をその日のうちに受け取れる！</p>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4">
				<div class="card" >
					<div class="card-header">
						<i class="bi bi-cash-coin"></i>
					</div>
					<div class="card-body">
						<h5 class="card-title">業界最高水準の給与</h5>
						<p class="card-text">業界最高水準の給与を支払っています。入店祝い金制度やボーナス制度も多数あります。</p>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4">
				<div class="card" >
					<div class="card-header">
						<i class="bi bi-person-check"></i>
					</div>
					<div class="card-body">
						<h5 class="card-title">店外での待機可能</h5>
						<p class="card-text">事務所での待機以外に店外での待機が可能です。</p>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4">
				<div class="card" >
					<div class="card-header">
						<i class="bi bi-lock"></i>
					</div>
					<div class="card-body">
						<h5 class="card-title">プライバシー保護</h5>
						<p class="card-text">写真掲載のモザイク処理も可能！指名のお客様以外と顔を合わせないので、身バレの心配もありません。</p>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4">
				<div class="card" >
					<div class="card-header">
						<i class="bi bi-people"></i>
					</div>
					<div class="card-body">
						<h5 class="card-title">グループ店での勤務も可能</h5>
						<p class="card-text">名古屋、大阪のグループ店での勤務も可能です。旅行と仕事を両立させることもできます。</p>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
</section>

<!-- 中間応募CTA -->
<section class="recruit-cta container">
	<div class="recruit-cta__box">
		<div class="row align-items-center">
			<div class="col-md-7 mb-3 mb-md-0">
				<h3 class="recruit-cta__heading">お気軽にご応募ください</h3>
				<p class="recruit-cta__text">未経験者歓迎！稼げるように手厚くサポートします。</p>
			</div>
			<div class="col-md-5">
				<div class="d-grid gap-2">
					<a href="#recruit-form" class="btn btn-danger">
						<i class="bi bi-envelope-fill me-2"></i> フォームから応募
					</a>
					<a href="https://line.me/ti/p/8P74LKgy32" target="_blank" rel="noopener noreferrer" class="btn btn-success">
						<i class="bi bi-line me-2"></i> LINEで今すぐ応募
					</a>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="recruit-example container">
	<h2 class="recruit-example__heading">
		初心者・未経験でも<br class="d-md-none">稼げるの？
	</h2>

	<div class="recruit-example__box row g-3">
		<div class="col-12 col-md-6">
			<div class="card">
				<div class="row g-0">
				<div class="col-4 recruit-example__box-img">
					<img src="<?php echo get_template_directory_uri(); ?>/public/pages/recruit/avatar1.svg" class="img-fluid rounded-circle" width="80" height="80" alt="...">
				</div>
				<div class="col-8">
					<div class="card-body">
						<h5 class="card-title">N君(入店6ヶ月)</h5>
						<p class="card-text">平均月収 60万円/ 勤務日数 週4日</p>
						<p class="card-text">他のお店も経験したけれど、CHANCEが一番稼げました。マネージャーの方が優しくて、ボーイ同士も仲良く楽しく働けます。</p>
					</div>
				</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="card ">
				<div class="row g-0">
				<div class="col-4 recruit-example__box-img">
					<img src="<?php echo get_template_directory_uri(); ?>/public/pages/recruit/avatar2.svg" class="img-fluid rounded-circle" width="80" height="80" alt="...">
				</div>
				<div class="col-8">
					<div class="card-body">
						<h5 class="card-title">K君(入店1年)</h5>
						<p class="card-text">平均月収 20万円/ 勤務日数 週2日</p>
						<p class="card-text">初めてこの業界に入ったときは、どうやって働けばいいかわからなかったのですが、マネージャーの方が優しくて、働きやすいです。学校と両立しやすく効率よく働けるので、おすすめです。</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="recruit-flow container">
	<h2 class="recruit-flow__heading">
		応募の流れ
	</h2>
	<div class="recruit-flow__box">
		<div class="row g-4">
			<div class="col-md-3">
				<div class="recruit-flow__step">
					<div class="recruit-flow__step-number">STEP 1</div>
					<div class="recruit-flow__step-title">
						<i class="bi bi-envelope"></i> 応募
					</div>
					<div class="recruit-flow__step-body">
						<p>お問い合わせフォームまたはLINEから気軽にご応募ください。最短即日で面接日時を調整します。</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="recruit-flow__step">
					<div class="recruit-flow__step-number">STEP 2</div>
					<div class="recruit-flow__step-title">
						<i class="bi bi-chat-dots"></i> 面接
					</div>
					<div class="recruit-flow__step-body">
						<p>お店の雰囲気や仕事内容について詳しく説明します。不安なことや質問があれば何でも聞いてください。</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="recruit-flow__step">
					<div class="recruit-flow__step-number">STEP 3</div>
					<div class="recruit-flow__step-title">
						<i class="bi bi-book"></i> 研修
					</div>
					<div class="recruit-flow__step-body">
						<p>基本的なマナーやサービス内容について丁寧に研修します。未経験でも心配いりません。</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="recruit-flow__step">
					<div class="recruit-flow__step-number">STEP 4</div>
					<div class="recruit-flow__step-title">
						<i class="bi bi-check-circle"></i> お仕事開始
					</div>
					<div class="recruit-flow__step-body">
						<p>あなたのペースで働き始めましょう。スタッフ一同、あなたをサポートします！</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="recruit-cta container">
	<div class="recruit-cta__box">
		<div class="row align-items-center">
			<div class="col-md-7 mb-3 mb-md-0">
				<h3 class="recruit-cta__heading">あなたも一緒に働きませんか？</h3>
				<p class="recruit-cta__text">頑張り次第で高収入も可能！充実した環境で働けます</p>
			</div>
			<div class="col-md-5">
				<div class="d-grid gap-2">
					<a href="#recruit-form" class="btn btn-danger">
						<i class="bi bi-envelope-fill me-2"></i> フォームから応募
					</a>
					<a href="https://line.me/ti/p/8P74LKgy32" target="_blank" rel="noopener noreferrer" class="btn btn-success">
						<i class="bi bi-line me-2"></i> LINEで今すぐ応募
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="recruit-info container">
	<h2 class="recruit-info__heading">
		募集要項
	</h2>
	<div class="recruit-info__box">
		<div class="recruit-info__table-wrap">
			<table class="table recruit-info__table">
				<tbody>
					<tr>
						<th>応募資格</th>
						<td>
							<ul class="recruit-info__list">
								<li>18歳以上の健康な男性（高校生不可）</li>
								<li>未経験者歓迎</li>
								<li>学生・フリーター・副業OK</li>
							</ul>
						</td>
					</tr>
					<tr>
						<th>勤務地・最寄駅</th>
						<td>
							<ul class="recruit-info__list">
								<li>新宿御苑前駅 徒歩5分</li>
								<li>新宿3丁目駅 徒歩5分</li>
							</ul>
						</td>
					</tr>
					<tr>
						<th>勤務時間</th>
						<td>
							完全自由シフト制<br>
							13:00〜24:00の間で応相談<br>
							<span class="text-danger">※週1日からOK</span>
						</td>
					</tr>
					<tr>
						<th>給与</th>
						<td>
							完全日払い制<br>
							60分 8,000円〜<br>
							<span class="text-danger fw-bold">※入店祝い金あり（条件あり）</span>
						</td>
					</tr>
					<tr>
						<th>待遇</th>
						<td>
							<ul class="recruit-info__list">
								<li>完全日払い制</li>
								<li>各種ボーナス制度あり</li>
								<li>店外待機OK</li>
								<li>寮完備</li>
								<li>自由出勤</li>
								<li>ノルマなし</li>
							</ul>
						</td>
					</tr>
					<tr>
						<th>応募方法</th>
						<td>
							下記の応募フォーム<!-- またはLINE -->からお気軽にご連絡ください<br>
							<div class="mt-3">
								<a href="#recruit-form" class="btn btn-danger btn-lg">
									<i class="bi bi-envelope-fill me-2"></i> フォームから応募
								</a>
								<a href="https://line.me/ti/p/8P74LKgy32" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg mt-2 mt-md-0 ms-md-2">
									<i class="bi bi-line me-2"></i> LINEで今すぐ応募
								</a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div class="recruit-info__note mt-4">
			<h3 class="recruit-info__subtitle">応募から採用までの流れ</h3>
			<p>応募フォームかLINEにてご連絡いただき、面接日時を決定します。面接後、採用となった方は研修を行った後に勤務開始となります。</p>
<!-- 			
			<h3 class="recruit-info__subtitle mt-3">お問い合わせ</h3>
			<p>ご不明な点やご質問がありましたら、お気軽に下記連絡先までお問い合わせください。</p>
			<p><i class="bi bi-telephone"></i> 03-XXXX-XXXX（受付時間：13:00〜24:00）</p> -->
		</div>
	</div>
</section>


<!-- よくある質問　-->
<section class="recruit-info container">
	<h2 class="recruit-info__heading">
		よくある質問
	</h2>
	<div class="recruit-info__box">
		<div class="recruit-info__faq">
			<div class="accordion" id="recruitFaq">
				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
							<i class="bi bi-question-circle me-2"></i>未経験でも働けますか？
						</button>
					</h3>
					<div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#recruitFaq">
						<div class="accordion-body">
							<p>はい、未経験の方も大歓迎です。入店後に丁寧に研修を行いますので、安心してご応募ください。マナーや接客の基本からしっかりとサポートします。</p>
						</div>
					</div>
				</div>
				
				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
							<i class="bi bi-question-circle me-2"></i>給与はどのように支払われますか？
						</button>
					</h3>
					<div id="faq2" class="accordion-collapse collapse" data-bs-parent="#recruitFaq">
						<div class="accordion-body">
							<p>完全日払い制を採用しています。その日の勤務が終わった後に、その日の給与をお支払いします。</p>
						</div>
					</div>
				</div>
				
				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
							<i class="bi bi-question-circle me-2"></i>シフトはどのように決まりますか？
						</button>
					</h3>
					<div id="faq3" class="accordion-collapse collapse" data-bs-parent="#recruitFaq">
						<div class="accordion-body">
							<p>完全自由シフト制を採用しています。あなたのライフスタイルに合わせて出勤日や時間を自由に決めることができます。週1日からの勤務も可能です。</p>
						</div>
					</div>
				</div>
				
				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
							<i class="bi bi-question-circle me-2"></i>面接時に必要なものはありますか？
						</button>
					</h3>
					<div id="faq4" class="accordion-collapse collapse" data-bs-parent="#recruitFaq">
						<div class="accordion-body">
							<p>身分証明書（運転免許証、パスポート、マイナンバーカードなど）をご持参ください。また、履歴書は不要です。お気軽な服装でお越しいただいて大丈夫です。</p>
						</div>
					</div>
				</div>
				
				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
							<i class="bi bi-question-circle me-2"></i>プライバシーは守られますか？
						</button>
					</h3>
					<div id="faq5" class="accordion-collapse collapse" data-bs-parent="#recruitFaq">
						<div class="accordion-body">
							<p>はい、プライバシー保護には最大限の配慮をしています。写真掲載の際のモザイク処理も可能です。指名のお客様以外と顔を合わせない仕組みもあり、身バレの心配はありません。個人情報の管理も厳重に行っています。</p>
						</div>
					</div>
				</div>
				
				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6">
							<i class="bi bi-question-circle me-2"></i>応募後、いつから働き始められますか？
						</button>
					</h3>
					<div id="faq6" class="accordion-collapse collapse" data-bs-parent="#recruitFaq">
						<div class="accordion-body">
							<p>面接後、採用が決まれば最短で翌日から勤務開始することも可能です。研修期間が必要な場合も、短期間で終了しますので、すぐに稼ぎ始めることができます。あなたのご希望に合わせて調整しますので、ご安心ください。</p>
						</div>
					</div>
				</div>

				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7" aria-expanded="false" aria-controls="faq6">
							<i class="bi bi-question-circle me-2"></i>アナルプレイをしたこと無いですが、大丈夫ですか？
						</button>
					</h3>
					<div id="faq7" class="accordion-collapse collapse" data-bs-parent="#recruitFaq">
						<div class="accordion-body">
							<p>はい、大丈夫です！未経験の子やアナルプレイNGの子も多数活躍しています。</p>
						</div>
					</div>
				</div>

				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8" aria-expanded="false" aria-controls="faq6">
							<i class="bi bi-question-circle me-2"></i>ゲイでは無いですが大丈夫ですか？
						</button>
					</h3>
					<div id="faq8" class="accordion-collapse collapse" data-bs-parent="#recruitFaq">
						<div class="accordion-body">
							<p>はい、大丈夫です！ノンケ(恋愛対象が女性)のボーイやバイのボーイも多数在籍しています。</p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="recruit-info__more-question mt-4 text-center">
				<h3 class="recruit-info__subtitle text-center">ご不明な点は気軽にお問い合わせください</h3>
				<p>未経験でも丁寧にサポートします。まずはお気軽にご連絡を！</p>
				<div class="recruit-info__cta-buttons">
					<div class="row justify-content-center">
						<div class="col-md-5 mb-3 mb-md-0">
							<a href="#recruit-form" class="btn btn-danger btn-lg w-100">
								<i class="bi bi-envelope-fill me-2"></i> フォームから応募
							</a>
						</div>
						<div class="col-md-5">
							<a href="https://line.me/ti/p/8P74LKgy32" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg w-100">
								<i class="bi bi-line me-2"></i> LINEで今すぐ応募
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="rec recruit pdb90 sppdb20">
	<div class="container box">
		<div id="recruit-form"></div>
	</div>
</section>
<?php get_footer(); ?>
