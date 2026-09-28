<?php
/**
 * スタッフのカード
 *
 * @param array $cast_summary スタッフのカードの情報
 */

if ( ! isset( $args ) ) {
	return;
}

$name   = esc_html( $args['name'] );
$url    = esc_url( $args['url'] );
$image  = esc_url( $args['image'] );
$height = str_replace( 'cm', '', esc_html( $args['height'] ) );
$weight = str_replace( 'kg', '', esc_html( $args['weight'] ) );
$age    = str_replace( '歳', '', esc_html( $args['age'] ) );
if ( $height && $weight && $age ) {
	$spec_text = $height . 'x' . $weight . 'x' . $age;
} else {
	$spec_text = '';
}

?>
<div class="col-md-3 col-4 d-flex my-1">
	<a href="<?php echo $url; ?>" class="d-flex cast-card">
		<div class="img_box d-grid">
			<img src="<?php echo $image; ?>" 
				alt="<?php echo $name; ?>'s image" 
				width="210" 
				height="260" 
				class="img-fluid mx-auto staff_img" 
				loading="lazy">
			<?php boy_batch( $args['icon'] ); ?>
			<h3><?php echo $name; ?></h3>
			<p><?php echo $spec_text; ?></p>
		</div>
	</a>
</div>
