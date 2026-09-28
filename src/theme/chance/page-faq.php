<?php
/* Template Name: 10_よくあるご質問 */
?>
<?php get_header(); ?>
<?php
$faq_array = array(
	array(
		'key'      => 'whereIsShop',
		'question' => 'お店はどこにありますか?',
		'answer'   => '当店は無店舗型となっており、ご利用の際は必ずご予約をお願いしております。<br>また、新宿御苑前駅 徒歩 5 分圏内に個室を完備しております。<br>個室の数には限りが御座いますのでお早目のご予約をお勧め致します。<br>ご予約頂いた際に指定場所をお伝えさせて頂きますので、ご予約のお客様は指定場所より当店へお電話下さい。',
	),
	array(
		'key'      => 'howLongForOutcall',
		'question' => '出張コースは何分から可能ですか?',
		'answer'   => '出張コースは60分より承っております。<br>公共交通機関を使い片道1時間を超える出張先へはコース料金、交通費とは別に遠方出張料を頂いております。<br>遠方出張料につきましては料金ページをご確認頂くか、当店スタッフへお気軽にお問い合わせください。',
	),
	array(
		'key'      => 'hotelCheckIn',
		'question' => 'ホテルへのチェックインが予約間近になります',
		'answer'   => 'ホテル出張の際、お客様よりチェックイン連絡を頂いてからボーイを向かわせる形となります。<br>ボーイに先行のご予約が入っていた場合、コース時間短縮等の恐れが御座いますので、お時間に余裕を持ってご予約頂く事をお勧めしております。',
	),
	array(
		'key'      => 'singleRoomCheck',
		'question' => 'ホテル出張で予約した部屋がシングルなんですが大丈夫ですか?',
		'answer'   => '確実なのはダブル、もしくはツインでホテルをご予約頂く事です。<br>こちらで利用履歴のあるホテルについては基本的には向かわせることは出来ますが、万一入室が出来なかった場合コース料金・交通費はお支払い頂く事となります。',
	),
	array(
		'key'      => 'roomConfirmation',
		'question' => '在室確認は絶対に必要ですか?',
		'answer'   => '申し訳御座いません、在室確認は必ずさせて頂いております。',
	),
	array(
		'key'      => 'loveHotelUsage',
		'question' => 'ラブホテルでの利用はできますか',
		'answer'   => '可能で御座います。',
	),
	array(
		'key'      => 'hotelOutsideMeeting',
		'question' => 'ホテル外での待ち合わせは可能ですか?',
		'answer'   => '基本的には可能で御座いますがその際は必ずホテルへの在室確認をさせて頂いた上で向かわせる形となります。',
	),
	array(
		'key'      => 'courseChange',
		'question' => 'コース変更は出来ますか?',
		'answer'   => 'コース変更につきましては開始5分以内でしたら承っております。<br>5分を過ぎますと、正規料金となりますのでご注意ください。',
	),
	array(
		'key'      => 'cancelationPolicy',
		'question' => 'キャンセルは出来ますか？',
		'answer'   => 'コース開始5分以内、もしくはボーイとの接触があった場合にキャンセル料5,000円またはコース内容の変更にて承ります。<br>無断キャンセルの場合、料金を100％請求させて頂きますのでご注意ください。',
	),
	array(
		'key'      => 'paymentLocation',
		'question' => '支払いはどこですればいいですか?',
		'answer'   => 'ご指名頂いたボーイ以外にはお会いすることが御座いませんので、ボーイ本人へ直接お渡し頂く形となります。',
	),
	array(
		'key'      => 'creditCardUsage',
		'question' => 'クレジットカードは利用出来ますか?',
		'answer'   => 'クレジットカードのご利用も可能です。<br>ご希望の場合、事前に決済用URLをメールにてお送りいたします。<br>そちらのURLよりお客様ご自身でご決済頂くかたちとなります。',
	),
	array(
		'key'      => 'privacy',
		'question' => 'お店を利用した事が、他人に知られる事はありませんか?',
		'answer'   => '全てのお客様に安心してご利用頂けるよう当店ではお客様のプライバシー情報につきましては厳重に管理をさせて頂いております。',
	),
	array(
		'key'      => 'playContent',
		'question' => 'プレイ内容を詳しく知りたいのですが?',
		'answer'   => 'キス・フェラ・絡みにつきましては全スタッフ可能で御座います。<br>バックプレイやその他オプションにつきましてはボーイの個人ページに記載が御座います。',
	),
	array(
		'key'      => 'courseStartTime',
		'question' => 'コース時間はいつからスタートですか?',
		'answer'   => 'お客様がボーイとお会いした時点からコーススタートとなります。<br>出張の場合、出張先が最寄り駅より徒歩 10 分以上かかる場合、タクシー代を別途頂きます。<br>また、お客様が駅までお迎えに来ていただける場合、駅で合流した時点からコース時間がスタートとなります。',
	),
)
?>
<section class="faq pdb90 sppdb20" id="qanda">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">Q&amp;A</span><br>
		<h2>よくあるご質問</h2>
	</div>
	<p class="fs-5 text-center">当店に寄せられるよくあるご質問をまとめました。ご利用の際にご参考にしてください。</p>

	<div class="accordion container box" id="faqAccordion">
		<?php foreach ( $faq_array as $faq ) : ?>
			<div class="accordion-item qa_box">
				<h3 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $faq['key']; ?>" aria-expanded="false" aria-controls="<?php echo $faq['key']; ?>">
						<?php echo $faq['question']; ?>
					</button>
				</h3>
				<div id="<?php echo $faq['key']; ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
					<div class="accordion-body">
						<?php echo $faq['answer']; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [
			<?php
			foreach ( $faq_array as $faq ) :
				?>
				{
					"@type": "Question",
					"name": "<?php echo $faq['question']; ?>",
					"acceptedAnswer": {
						"@type": "Answer",
						"text": "<?php echo $faq['answer']; ?>"
					}
				}
				<?php
				if ( end( $faq_array ) !== $faq ) :
					?>
					, <?php endif; ?>
			<?php endforeach; ?>
		]
	}
</script>
<?php get_footer(); ?>
