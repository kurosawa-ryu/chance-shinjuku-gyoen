<?php
/**
 * スタッフのカード (シフト情報付き)
 *
 * @param array $args スタッフのカードの情報
 */

if ( ! isset( $args ) ) {
	return;
}
$name   = esc_html( $args['name'] );
$url    = esc_url( home_url( '/' ) . 'cast/' . $args['slug'] );
$image  = esc_url( $args['image'] );
$height = str_replace( 'cm', '', esc_html( $args['height'] ) );
$weight = str_replace( 'kg', '', esc_html( $args['weight'] ) );
$age    = str_replace( '歳', '', esc_html( $args['age'] ) );
if ( $height && $weight && $age ) {
	$spec_text = $height . 'ｘ' . $weight . 'ｘ' . $age;
} else {
	$spec_text = '';
}
?>
<div class="col-sm-3 col-4 mgb20 spmgb10 d-flex my-1">
	<a href="<?php echo $url; ?>" class="d-flex">
		<div class="img_box d-grid">
			<img src="<?php echo $image; ?>" 
				alt="<?php echo $name; ?>の画像" 
				width="210" 
				height="260" 
				class="img-fluid mx-auto staff_img" 
				loading="lazy">
			<?php boy_batch( $args['icon'] ); ?>
			<h3><?php echo $name; ?></h3>
			<p><?php echo $spec_text; ?></p>
			<div class="time matchbox">
				<span><?php echo $args['towork']; ?></span>
				<?php if ( ! empty( $args['ladywork_txt'] ) ) : ?>
					<span><?php echo esc_html( $args['ladywork_txt'] ); ?></span>
				<?php else : ?>
					<span>　</span>
				<?php endif; ?>
			</div>
		</div>
		
	</a>
</div>
