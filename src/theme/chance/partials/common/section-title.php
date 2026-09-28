<?php
if ( ! isset( $args ) ) {
	return;
}

$ja_title = $args['ja'];
$en_title = $args['en'];
?>

<?php if ( is_ja() ) : ?>
	<div class="mgb90 spmgb20 sectionTitle"><span class="en sectionTitle--sub"><?php echo esc_html( $en_title ); ?></span><br>
		<h2><?php echo esc_html( $ja_title ); ?></h2>
	</div>
<?php else : ?>
	<div class="mgb90 spmgb20 sectionTitle"><h2><span class="en sectionTitle--sub"><?php echo esc_html( $en_title ); ?></span></h2>
	</div>
<?php endif; ?>
