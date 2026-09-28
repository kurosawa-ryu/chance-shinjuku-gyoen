<?php
global $post;
$post_id         = $post->ID;
$myupload_images = get_post_meta( $post_id, 'myupload_images', true );
$myupload_li     = '';
if ( ! empty( $myupload_images ) ) {
	foreach ( $myupload_images as $key => $img_id ) {
		$thumb_src = wp_get_attachment_image_src( $img_id, 'thumbnail' );
		if ( empty( $thumb_src[0] ) ) { //画像が存在しない空IDを強制的に取り除く
				delete_post_meta( $post_id, 'myupload_images', $img_id );
		} else {
				$myupload_li .=
				"\t" . '<li class="img" id="img_' . $img_id . '">' . "\n" .
				"\t\t" . '<span class="img_wrap">' . "\n" .
				"\t\t\t" . '<a href="#" class="myupload_images_remove" title="画像を削除する"></a>' . "\n" .
				"\t\t\t" . '<img src="' . $thumb_src[0] . '"/>' . "\n" .
				"\t\t\t" . '<input type="hidden" name="myupload_images[]" value="' . $img_id . '" />' . "\n" .
				"\t\t" . '</span>' . "\n" .
				"\t" . '</li>' . "\n";
		}
	}
}
?>

<div id="myupload_buttons">
	<a id="myupload_media" type="button" class="button" title="画像を追加・変更">アイテム画像の追加・削除</a>
	<input type="submit" name="save" id="save2" class="button" value="更新" />
	<p>ドラッグで好きな順に並べてください。</p>
</div>
<ul id="myupload_images"><?php echo $myupload_li; ?></ul>
<input type="hidden" name="myupload_postmeta_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>" />
