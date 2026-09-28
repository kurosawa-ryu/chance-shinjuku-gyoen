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
$url    = '/en/cast/' . $args['slug'];
$image  = esc_url( $args['image'] );
$height = str_replace( 'cm', '', esc_html( $args['height'] ) );
$weight = str_replace( 'kg', '', esc_html( $args['weight'] ) );
$age    = str_replace( '歳', '', esc_html( $args['age'] ) );
if ( $height && $weight && $age ) {
	$spec_text = $height . 'x' . $weight . 'x' . $age;
} else {
	$spec_text = '';
}

$ladywork_raw  = trim( $args['ladywork_txt'] ?? '' );
$ladywork_text = '';

$has_stay = ( strpos( $ladywork_raw, '泊' ) !== false );
$has_ask  = (
	strpos( $ladywork_raw, '要問' ) !== false ||
	strpos( $ladywork_raw, '前日' ) !== false
);

if ( strpos( $ladywork_raw, '予約満了' ) !== false ) {
	$ladywork_text = 'full';

} elseif ( $has_stay && $has_ask ) {
	$ladywork_text = 'stay〇 ask';

} elseif ( $has_stay ) {
	$ladywork_text = 'stay〇';

} elseif ( $has_ask ) {
	$ladywork_text = 'ask';

} else {
	$ladywork_text = esc_html( $ladywork_raw );
}
?>
<div class="col-sm-3 col-4 mgb20 spmgb10 d-flex my-1">
	<a href="<?php echo $url; ?>" class="d-flex">
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
			<div class="time matchbox">
				<span><?php echo esc_html( $args['towork'] ); ?></span>
				<span>
					<?php
					if ( ! empty( $ladywork_text ) ) {
						echo wp_kses_post( $ladywork_text );
					} else {
						echo '　';
					}
					?>
				</span>
			</div>
		</div>
		
	</a>
</div>
