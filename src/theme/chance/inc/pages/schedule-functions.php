<?php

function get_schedule_page_params() {
	$date_param = intval( $_GET['day_num'] ?? '0' );
	$date_param = ( $date_param < 0 || $date_param > 13 ) ? 0 : $date_param;
	return $date_param;
}
function get_schedule_page_selected_day( $offset = 0 ) {
	$date_param   = get_schedule_page_params();
	$selected_day = date( 'Y-m-d', strtotime( '+' . ( $date_param + $offset ) . ' days', current_time( 'timestamp' ) ) );
	return $selected_day;
}
function get_schedule_page_days( $offset = 0 ) {
	$date_param = get_schedule_page_params();
	$days       = array();
	foreach ( range( 0, 13 ) as $i ) {
		$date   = date( 'm/d', strtotime( '+' . ( $i + $offset ) . ' days', current_time( 'timestamp' ) ) );
		$week   = get_week_data( date( 'Y-m-d', strtotime( '+' . ( $i + $offset ) . ' days', current_time( 'timestamp' ) ) ), 'ja' );
		$days[] = array(
			'date'   => $date,
			'week'   => $week,
			'active' => ( $i === $date_param ) ? 'active' : '',
		);
	}
	return $days;
}
