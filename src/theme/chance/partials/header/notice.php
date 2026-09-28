<?php

$start = strtotime( '2025-01-15 00:00' );
$end   = strtotime( '2025-01-22 00:00' );
$now   = strtotime( date( 'Y-m-d H:i' ) );
if ( $now >= $start && $now < $end ) :
	?>
	<div class="notice">
		<p class="bold">誠に勝手ながら01/21(火)の営業時間は13：00～18：00までとさせて頂きます。<br>
			ご理解の程、何卒宜しくお願い致します。</p>
	</div>
<?php endif; ?>
