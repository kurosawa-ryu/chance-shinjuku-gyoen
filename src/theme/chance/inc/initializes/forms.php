<?php

/**
 * フォームをセットアップ
 *
 * @param string $form_title
 * @param string $form_slug
 * @param string $thanks_title
 * @return void
 */
function ch_wpcf7_setup_chance_form( $form_title, $form_slug, $thanks_title ) {
	$option_name = 'wpcf7_' . $form_slug . '_form_id';

	$additional_headers = "Reply-To: [your-email]\nBcc: sys.os@mz32.dev";
	$form_content       = file_get_contents( get_stylesheet_directory() . "/forms/$form_slug-form.html" );
	$mail1_body         = file_get_contents( get_stylesheet_directory() . "/forms/$form_slug-mail-body.txt" );
	$mail2_body         = file_get_contents( get_stylesheet_directory() . "/forms/$form_slug-mail-thanks-body.txt" );
	$site_host          = parse_url( home_url(), PHP_URL_HOST );
	$shop_email         = 'info@' . $site_host;

	// {site_url} をhome_url()の値に置換
	$form_content = str_replace( '{site_url}', home_url(), $form_content );

	$mail_settings = array(
		'mail'   => array(
			'active'             => true,
			'recipient'          => $shop_email,
			'sender'             => "[your-name] <$shop_email>",
			'subject'            => $form_title,
			'body'               => $mail1_body,
			'additional_headers' => $additional_headers,
			'attachments'        => '',
			'use_html'           => false,
		),
		'mail_2' => array(
			'active'             => true,
			'recipient'          => '[your-email]',
			'sender'             => "chance <$shop_email>",
			'subject'            => $thanks_title,
			'body'               => $mail2_body,
			'additional_headers' => $additional_headers,
			'attachments'        => '',
			'use_html'           => false,
		),
	);

	$form_id = get_option( $option_name );

	if ( $form_id && get_post_status( $form_id ) ) {
		$current_content = get_post_meta( $form_id, '_form', true );

		// {site_url} をhome_url()の値に置換
		$form_content = str_replace( '{site_url}', home_url(), $form_content );
		if ( $current_content !== $form_content ) {
			update_post_meta( $form_id, '_form', $form_content );
		}
		update_post_meta( $form_id, '_mail', $mail_settings['mail'] );
		update_post_meta( $form_id, '_mail_2', $mail_settings['mail_2'] );
	} else {
		$new_form = array(
			'post_title'  => $form_title,
			'post_type'   => 'wpcf7_contact_form',
			'post_status' => 'publish',
		);
		$form_id  = wp_insert_post( $new_form );

		if ( $form_id && ! is_wp_error( $form_id ) ) {
			update_post_meta( $form_id, '_form', $form_content );
			update_post_meta( $form_id, '_mail', $mail_settings['mail'] );
			update_post_meta( $form_id, '_mail_2', $mail_settings['mail_2'] );
			update_option( $option_name, $form_id );
		}
	}
}

/**
 * フォームを表示するショートコードを実行
 *
 * @param string $sulg
 * @param string $title
 * @return void
 */

function ch_wpcf7_custom_form_tag( $sulg, $title ) {
	$option_name = 'wpcf7_' . $sulg . '_form_id';
	$form_id     = get_option( $option_name );
	echo do_shortcode( '[contact-form-7 id="' . $form_id . '" title="' . $title . '"]' );
}

/**
 *  店舗HPに必要なフォームをセットアップ
 *
 * @return void
 */
function ch_wpcf7_setup_all_forms() {
	$form_data = array(
		array(
			'title'        => 'ご予約フォーム',
			'slug'         => 'reserved',
			'thanks_title' => 'ご予約いただきありがとうございます。',
		),
	);
	foreach ( $form_data as $form ) {
		ch_wpcf7_setup_chance_form( $form['title'], $form['slug'], $form['thanks_title'] );
	}
}
