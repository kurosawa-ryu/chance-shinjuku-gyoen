<?php

add_filter('wp_mail', function($args) {
    error_log('=== WP_MAIL CALLED ===');
    error_log(print_r($args, true));
    return $args;
});

add_action('wp_mail_failed', function($error) {
    error_log('=== WP_MAIL_FAILED ===');
    error_log(print_r($error->get_error_messages(), true));
    error_log(print_r($error->get_error_data(), true));
});

add_action('phpmailer_init', function($phpmailer) {
    error_log('=== PHPMAILER INIT ===');
    error_log('Host: ' . $phpmailer->Host);
    error_log('Port: ' . $phpmailer->Port);
    error_log('SMTPAuth: ' . ($phpmailer->SMTPAuth ? 'true' : 'false'));
});
