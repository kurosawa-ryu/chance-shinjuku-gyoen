<?php
/* Template Name: 01_プライバシーポリシー */
get_header(); ?>
<section class="rules pdb90 sppdb20" id="rules">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">PRIVACY</span><br>
		<h2>プライバシーポリシー</h2>
	</div>

	<div class="container box mgb25 spmgb15">
		<div class="announce_box mgb25 spmgb15">
			<?php $store_name = chance_get_store_name(); ?>
			<p class="fs16 red">当ホームページ（
			<?php
			if ( $store_name ) {
				echo esc_html( $store_name ); }
			?>
			）にお越し頂きありがとう御座います。<br>
			<?php
			if ( $store_name ) {
				echo esc_html( $store_name ); }
			?>
			（以下「当店」といいます）ではお客さまに十分にご満足いただけるサービスを提供する為、個人情報をお預かりしています。<br>
				当店では、お客様に安心してご利用いただけるように、個人情報の取り扱いについて以下の通りプライバシーポリシーを定め、個人情報の保護に努めてまいります。</p>
		</div>

		<h3 class="rule_h3">お預かりする個人情報 </h3>
		<div class="fs16 content mgb25 spmgb15">
			<p>個人情報とは以下に定める内容を指し、当店をご利用いただく際、またはお問い合わせを頂く際に当店が取得またはお尋ねすることがあります。</p>
			<ul>
				<li>・お名前</li>
				<li>・電話番号</li>
				<li>・メールアドレス</li>
				<li>・住所</li>
			</ul>
		</div>
		<h3 class="rule_h3">個人情報の利用目的</h3>
		<div class="fs16 content mgb25 spmgb15">
			<p>当店は、お客様からお預かりした個人情報を以下の目的で利用いたします。</p>
			<ul>
				<li>・サービスご利用のご予約、またご本人様確認の為</li>
				<li>・当店ののサービスに関するお知らせの為</li>
				<li>・サービスの向上を図る為のアンケートやキャンペーンの実施のため</li>
				<li>・お問い合せやご意見等への回答やご連絡の為</li>
			</ul>
		</div>
		<h3 class="rule_h3">個人情報の第三者提供</h3>
		<div class="fs16 content mgb25 spmgb15">
			<p>当グループでは、お預かりした個人情報を第三者へ提供や販売することはありません。</p>
			<p>ただし、下記の場合に限り第三者へ提供する場合があります。</p>

			<ul>
				<li>
					1.裁判所からの正式な手続きによる照会を受けた場合
				</li>
				<li>
					2.警察等の公的機関から法令に基づいた正式な照会を受けた場合
				</li>
				<li>
					3.お客様が法令等に反し、当店または第三者の財産や権利保護の為、当店が必要と判断した場合
				</li>
				<li>
					4.お客様ご本人の同意の上、情報提供が必要と判断した場合
				</li>
			</ul>
		</div>
		<h3 class="rule_h3">個人情報の共同利用</h3>
		<div class="fs16 content mgb25 spmgb15">
			<p>当店は、お客様からお預かりした個人情報を、当店が運営する他の店舗と共同利用することがあります。</p>
		</div>
		<h3 class="rule_h3">個人情報の開示、訂正、削除</h3>
		<div class="fs16 content mgb25 spmgb15">
			<p>お客様ご本人がご自身の個人情報の開示、訂正、削除を希望される場合は、ご本人であることを確認の上、対応させていただきます。</p>
		</div>
		<h3 class="rule_h3">個人情報の取扱いに関するお問い合わせ</h3>
		<div class="fs16 content mgb25 spmgb15">
			<p>個人情報の取扱いに関するお問い合わせは、、下記メールアドレスまでご連絡ください。</p>
			<p>
				<?php
				if ( $store_name ) {
					echo esc_html( $store_name ); }
				?>
				<br>
				<?php
					$email = chance_get_store_email();
				if ( $email ) {
					echo esc_html( $email );
				}
				?>
			</p>
		</div>

		<h3 class="rule_h3">プライバシーポリシーの変更</h3>
		<div class="fs16 content mgb25 spmgb15">
			<p>当店は、プライバシーポリシーを変更する場合があります。変更した場合は、当店のホームページに掲載いたします。</p>
		</div>

		<h3 class="rule_h3">免責</h3>
		<div class="fs16 content mgb25 spmgb15">
			<p>当店のサイトは、外部のサイトへのリンクを含んでいます。当店は、リンク先のサイトにおける個人情報保護や、サイトの内容に関して責任を負いかねます。<br />
				リンク先のサイトにおける個人情報の取り扱いについては、リンク先のサイトのプライバシーポリシーをご確認ください。</p>
		</div>
	</div>
</section>
<?php get_footer(); ?>
