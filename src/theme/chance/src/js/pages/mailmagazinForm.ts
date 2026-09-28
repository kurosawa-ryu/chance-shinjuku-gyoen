// react form で実装する
// (() => {
// 	$("#mailmagazinForm").on("submit", function (e) {
// 		e.preventDefault();
// 		const email = String($(this).find('[name="email"]').val());

// 		if (
// 			!email.match(
// 				/^[a-zA-Z0-9_+-]+(.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/,
// 			)
// 		) {
// 			alert("メールアドレスが正しくありません");
// 			return false;
// 		}

// 		// 押されたsubmit ボタンのidを取得
// 		const submit_id = e.originalEvent?.submitter.id;
// 		// おされたボタンをクリックできないようにする
// 		e.originalEvent.submitter.disabled = true;
// 		// formをhiddenにする
// 		$("#mailmagazinForm").css("display", "none");
// 		// ローディング画像を表示
// 		$("#mailmagazinForm").after('<p class="mailmagazine__success">送信中</p>');

// 		if (submit_id === "mailmagazinSubscribe") {
// 			jQuery
// 				.ajax({
// 					url: DATA.ajax,
// 					type: "POST",
// 					data: { email: email, action: "subscribe_mailmagazine" },
// 				})
// 				.done((data) => {
// 					if (data == "success") {
// 						$(".mailmagazine__success").remove();
// 						$("#mailmagazinForm").after(
// 							'<p class="mailmagazine__success">メルマガ登録しました。</p>',
// 						);
// 					}
// 					form.reset();
// 				})
// 				.fail((jqXHR) => {
// 					if (jqXHR.responseText.length) {
// 						alert(jqXHR.responseText);
// 					} else {
// 						$(".mailmagazine__success").remove();
// 						$("#mailmagazinForm").affter(
// 							'<p class="mailmagazine__error">登録に失敗しました。時間を置いてもう一度お試しください。</p>',
// 						);
// 					}
// 				});
// 		} else if (submit_id === "mailmagazinUnsubscribe") {
// 			jQuery
// 				.ajax({
// 					url: DATA.ajax,
// 					type: "POST",
// 					data: { email: email, action: "unsubscribe_mailmagazine" },
// 				})
// 				.done((data) => {
// 					if (data == "success") {
// 						$(".mailmagazine__success").remove();
// 						$("#mailmagazinForm").after(
// 							'<p class="mailmagazine__success">メルマガ登録を解除しました。</p>',
// 						);
// 					}
// 					form.reset();
// 				})
// 				.fail((jqXHR) => {
// 					if (jqXHR.responseText.length) {
// 						alert(jqXHR.responseText);
// 					} else {
// 						$(".mailmagazine__success").remove();
// 						$("#mailmagazinForm").affter(
// 							'<p class="mailmagazine__error">登録に失敗しました。時間を置いてもう一度お試しください。</p>',
// 						);
// 					}
// 				});
// 		}
// 		// おされたボタンを活性にする
// 		e.originalEvent.submitter.disabled = false;
// 	});
// })();
