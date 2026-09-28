(function($) {

		'use strict';
		var custom_uploader;
		$('#myupload_media').click(function(e) {
				e.preventDefault();
				if (custom_uploader) {
						custom_uploader.open();
						return;
				}
				custom_uploader = wp.media({
						title: _wpMediaViewsL10n.mediaLibraryTitle,
						library: {
								type: 'image'
						},
						button: {
								text: '画像を選択'
						},
						multiple: true, // falseのとき画像選択は一つのみ可能
						frame: 'select', // select | post. selectは左のnavを取り除く指定
						editing: false,
				});

				custom_uploader.on('ready', function() {
						// $('select.attachment-filters [value="uploaded"]').attr( 'selected', true ).parent().trigger('change');
						//「この投稿への画像」をデフォルト表示　不要ならコメントアウト
				});
				custom_uploader.on('select', function() {
						var images = custom_uploader.state().get('selection'),
								ex_ul = $('#myupload_images'),
								ex_id = 0,
								array_ids = [];
						if (ex_ul[0]) { //すでに登録されている画像を配列に格納
								ex_ul.children('li').each(function() {
										ex_id = Number($(this).attr('id').slice(4));
										array_ids.push(ex_id);
								});
						}
						images.each(function(file) {
								var new_id = file.toJSON().id;
								console.log(file)
								if (jQuery.inArray(new_id, array_ids) > -1) { //投稿編集画面のリストに重複している場合、削除
										ex_ul.find('li#img_' + new_id).remove();
								}
								ex_ul.append('<li class="img" id=img_' + new_id + '></li>').find('li:last').append(
										'<span class="img_wrap">' +
										'<a href="#" class="myupload_images_remove" title="画像を削除する"></a>' +
										'<img src="' + file.attributes.sizes.thumbnail.url + '" />' +
										'<input type="hidden" name="myupload_images[]" value="' + new_id + '" />' +
										'</span>'
								);
						});
				});
				custom_uploader.open();

		});
		$("#myupload").on('click', '.myupload_images_remove', function(e) {
				e.preventDefault();
				e.stopPropagation();
				var img_obj = $(this).parents('li.img').remove();
		});
		$("#myupload_images").sortable({
				axis: 'y',
				cursor: "move",
				tolerance: "pointer",
				opacity: 0.6
		});
		$(".time1").change(function() {
				var time1_val = $(this).val();
				var time1h = time1_val.indexOf("-");
				var time2 = $(this).nextAll(".time2");
				var time3 = $(this).nextAll(".time3");
				var time2_val = time1_val.substring(0, time1h);
				var time3_val = time1_val.slice(time1h + 1);
				time2.val(time2_val);
				time3.val(time3_val);
		}).change();
		$("#part").click(function() {
				var lengCheck = $(".comp_update:checked");
				if (lengCheck.length) {
						$("#noCheck").css("display", "none");
						$(".comp_update").each(function() {
								var yesCheck = $(this).prop("checked");
								if (yesCheck === false) {
										$(this).parents("tr").find("input").prop("disabled", true);
										$(this).parents("tr").find("textarea").prop("disabled", true);
								}
						});
						$("#compForm").submit();
				} else {
						$("#noCheck").css("display", "block");
				}
		});
		$('#schedule_submit').click(function() {
				$('form').submit();
				$(this).prop('disabled', true);
		});

		$('#icon input[type="checkbox"]').change(function(){
			var check = $(this).prop('checked');
			$('#icon').find('[type="checkbox"]').prop('checked',false);
			if( check==true ){
				$(this).prop('checked',true);
				$('#icon').find('[type="hidden"]').val($(this).val());
			}else{
				$('#icon').find('[type="hidden"]').val('');
			}
		});

		$('#store input[type="checkbox"]').change(function() {
				var check = $(this).prop('checked');
				$('#store').find('[type="checkbox"]').prop('checked', false);
				if (check == true) {
						$(this).prop('checked', true);
						$('#store').find('[type="hidden"]').val($(this).val());
				} else {
						$('#store').find('[type="hidden"]').val('');
				}
		});

})(jQuery);