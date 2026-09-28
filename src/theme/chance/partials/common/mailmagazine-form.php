<div class="mailmagazine mgt60 spmgt20" id="mailmagazinBanner">
	<img src="<?php echo get_template_directory_uri(); ?>/src/img/top/mail_magazine_sp.jpg" alt="Q&Aのページにリンク" class=" img-fluid mx-auto mailmagazine__imgsp">
	<img src="<?php echo get_template_directory_uri(); ?>/src/img/top/mail_magazine.jpg" alt="Q&Aのページにリンク" class="img-fluid mx-auto mailmagazine__imgpc">
	<form action="" id="mailmagazinForm" class="mailmagazine__form blast_form_api">
		<label for="email">メールアドレスを入力</label>
		<input type="email" required name="email" class="form-control mailmagazine__email" id="email">
		<input type="submit" id="mailmagazinSubscribe" class="btn mailmagazine__subscribeBtn" name="state" value="登録">
		<input type="submit" id="mailmagazinUnsubscribe" class="btn mailmagazine__unsubscribeBtn" name="state" value="解除">
	</form>
	<p class="mailmagazine__note">登録後info@chance-tokyo.comからメルマガを配信しますので受信できるように設定してください。</p>
</div>
