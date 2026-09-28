<section class="reserved pdb90 sppdb20">
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub">RESERVED&nbsp;FORM</span><br>
		<h2>RESERVED</h2>
	</div>
	<div class="container box">
		<p class="mgb30 spmgb15">
			If you are satisfied with the following information, please click the “Submit” button.<br>
			If there is an error in the content, please click the “Back” button to correct it.
		</p>
		<div class="bd_red mgt60 spmgt30">
			<?php if ( function_exists( 'get_field' ) && get_field( 'form_id' ) ) : ?>
				<?php echo do_shortcode( '[contact-form-7 id="' . get_field( 'form_id' ) . '" title="予約フォーム"]' ); ?>
			<?php else : ?>
				<p class="mgb30 spmgb15">New reservations are being suspended.</p>
			<?php endif; ?>
			<?php if ( false ) : ?>
				<!-- contact form 7 で埋め込むため非表示 -->
				<table class="table">
					<tr>
						<th class="relative">名前(仮名でも可)<span class="red po-r">※必須</span></th>
						<td>[text* your-name class:form-control class:input-w1 akismet:author]</td>
					</tr>
					<tr>
						<th class="relative">メールアドレス<span class="red po-r">※必須</span></th>
						<td>[email* email class:form-control class:input-w2 akismet:author_email]</td>
					</tr>
					<tr>
						<th class="relative">メールアドレス<br class="hidden-xs">(再度入力)<span class="red po-r">※必須</span></th>
						<td>[email* email_confirm class:form-control class:input-w2]</td>
					</tr>
					<tr>
						<th class="relative">電話番号</th>
						<td>[tel tel class:form-control class:input-w1]</td>
					</tr>
					<tr>
						<th class="relative">日時<span class="red po-r">※必須</span></th>
						<td>[select* day-month "1月" "2月" "3月" "4月" "5月" "6月" "7月" "8月" "9月" "10月" "11月" "12月"]&nbsp;[select* day-day "1日" "2日" "3日" "4日" "5日" "6日" "7日" "8日" "9日" "10日" "11日" "12日" "13日" "14日" "15日" "16日" "17日" "18日" "19日" "20日" "21日" "22日" "23日" "24日" "25日" "26日" "27日" "28日" "29日" "30日" "31日"]&nbsp;&nbsp;[select* day-hour "13時" "14時" "15時" "16時" "17時" "18時" "19時" "20時" "21時" "22時" "23時" "24時"]&nbsp;[select* day-minute "00分" "15分" "30分" "45分"]</td>
					</tr>
					<tr>
						<th class="relative">ご希望のコース<span class="red po-r">※必須</span></th>
						<td>[select* course-1 id:course1 "個室" "出張" "デートのみ"]&nbsp;[select* course-2 id:course2 class:mgb10 class:spmgb0 "60分" "90分" "120分" "180分" "ロング21:00～9:00" "ロング22:00～9:00" "ロング23:00～9:00" "ロング24:00～9:00" "3P60分" "3P90分" "3P120分" "個室スワップ90分" "個室スワップ120分" "オナニー鑑賞30分"]<br>その他コース・備考等<br>[text remarks class:form-control class:input-w2]</td>
					</tr>
					<tr id="none">
						<th>デートをご希望の方</th>
						<td>[select date "特になし" "デート60分" "デート120分"]</td>
					</tr>
					<tr>
						<th class="relative">ご希望のボーイ<span class="red po-r">※必須</span></th>
						<td>[text* boy class:form-control class:input-w1]</td>
					</tr>
					<tr>
						<th class="relative">今回のボーイの指名経験<span class="red po-r">※必須</span></th>
						<td>[radio boy-choice use_label_element default:1 "初指名" "以前に指名経験あり"]</td>
					</tr>
					<tr>
						<th class="relative">当店のご利用経験<span class="red po-r">※必須</span></th>
						<td>[radio store-use use_label_element default:1 "無し" "有り"]</td>
					</tr>
					<tr>
						<th class="relative">割引チケット<span class="red po-r">※必須</span></th>
						<td>[radio ticket use_label_element default:1 "無し" "有り"]</td>
					</tr>
					<tr>
						<th>アナルプレイについて</th>
						<td>[select a-about "特に無し" "ボーイのバックウケ" "ボーイのバックタチ"]</td>
					</tr>
					<tr>
						<th>出張の場合の最寄り駅<br class="hidden-xs">ホテル名</th>
						<td>[text station-hotel class:form-control class:input-w2]</td>
					</tr>
					<tr>
						<th>プレイでのご要望<br class="hidden-xs">ご質問・お問合せ</th>
						<td>[textarea comment class:text-box]</td>
					</tr>
				</table>
				<p class="wpcf7c-elm-step2 confirmbox mgb10 bg-info">こちらの内容で予約します。お間違いなければ進むボタンを押して下さい。</p>
				<div class="text-center clearfix">
					<input type="reset" class="btn btn-black wpcf7c-elm-step1" value="リセット">[submit class:btn class:btn-red "進む"]
				</div>
				[multistep multistep-148 first_step skip_save "/reserved-confirm"]
			<?php endif; ?>
		</div>


	</div>
</section>
