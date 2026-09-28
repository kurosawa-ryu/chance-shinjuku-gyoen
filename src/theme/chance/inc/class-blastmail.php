<?php
/**
 * This file contains the BlastMail class, which provides methods to interact with the BlastMail API.
 * It includes functionalities for managing email contacts, such as creating, updating, deleting,
 * and searching contacts, as well as subscribing and unsubscribing users.
 *
 * @category EmailManagement
 * @package  BlastMailAPI
 * @author   mz32 <info@mz32.dev>
 * @license  MIT License
 * @version  PHP 7.4 or later
 * @link     https://mz32.dev
 */

/**
 * Class BlastMail
 *
 * This class provides methods to interact with the BlastMail API for managing email contacts.
 * It includes functionalities for creating, updating, deleting, and searching email contacts,
 * as well as subscribing and unsubscribing users.
 *
 * @category EmailManagement
 * @package  BlastMailAPI
 * @author   mz32 <info@mz32.dev>
 * @license  MIT License
 * @link     https://mz32.dev
 */
class BlastMail {
	/**
	 * BlastMail API username
	 *
	 * @var string
	 */
	public $username = 'bm79607kp';

	/**
	 * BlastMail API password
	 *
	 * @var string
	 */
	public $password = 'f3hfr2k2';

	/**
	 * BlastMail API key
	 *
	 * @var string
	 */
	public $api_key = '1f2718aba76776f296953d74e4ed2be4';

	/**
	 * Shop name displayed in communications
	 *
	 * @var string
	 */
	public $shopname = 'CHANCE東京・新大久保';

	/**
	 * Shop website URL
	 *
	 * @var string
	 */
	public $shop_url = 'https://chance-shinjuku.jp';

	/**
	 * BlastMail sender email address
	 *
	 * @var string
	 */
	public $blast_email = 'info@chance-tokyo.com';

	/**
	 * Reply-to email address
	 *
	 * @var string
	 */
	public $reply_email = 'info@chacne-shinkuli.jp';

	/**
	 * List of shop locations
	 *
	 * @var array
	 */
	public $shop_list = array( '東京店', '新大久保店' );
	/**
	 * BlastMail API URL
	 *
	 * @var string
	 */
	public $url = 'https://api.bme.jp/rest/1.0/';
	/**
	 * Default content type for API requests
	 *
	 * @var string
	 */
	public $default_content_type = 'application/x-www-form-urlencoded';

	/**
	 * 登録店舗
	 *
	 * @var string
	 */
	public $registered_store_field = 'c20';
	/**
	 * 利用名前
	 *
	 * @var string
	 */
	public $use_store_field = 'c19';
	/**
	 * メールアドレス
	 *
	 * @var string
	 */
	public $email_field = 'c15';

	/**
	 * Constructor for the BlastMail class.
	 * Initializes the class and logs its instantiation.
	 *
	 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
	 * @SuppressWarnings(PHPMD.MethodNamingConventions)
	 */
	public function __construct() {
		error_log( 'BlastMail' );
	}

	/**
	 * ブラストメール トークン取得
	 *
	 * @return string|false The access token if successful, or false on failure.
	 */
	public function get_blast_token() {
		error_log( 'get_blast_token' );
		$data = array(
			'username' => $this->username,
			'password' => $this->password,
			'api_key'  => $this->api_key,
			'f'        => 'json',
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $this->url . 'authenticate/login' );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $data ) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt(
			$ch,
			CURLOPT_HTTPHEADER,
			array(
				'Content-Type: ' . $this->default_content_type,
			)
		);

		$result = curl_exec( $ch );
		curl_close( $ch );

		if ( empty( $result ) ) {
			return false;
		} else {
			$result = json_decode( $result, true );
			return $result['accessToken'];
		}
	}

	/**
	 * Creates a new contact in the BlastMail system.
	 *
	 * @param string $email            The email address of the contact.
	 * @param string $registered_store The store where the contact is registered (optional).
	 * @param string $use_store        The store where the contact is using services (optional).
	 *
	 * @return string|false The response from the API if successful, or false on failure.
	 */
	public function create( $email, $registered_store = '', $use_store = '' ) {
		if ( empty( $email ) ) {
			return false;
		}

		$token = $this->get_blast_token();

		$data = array(
			'access_token'                => $token,
			$this->email_field            => $email,
			$this->use_store_field        => $use_store, // 利用店舗
			$this->registered_store_field => $registered_store, // 登録店舗
			'status'                      => '配信中',
			'f'                           => 'json',
		);

		$header = array(
			'Content-Type: ' . $this->default_content_type,
		);

		$data     = http_build_query( $data, '', '&' );
		$header[] = 'Content-Length: ' . strlen( $data );

		$context = array(
			'http' => array(
				'method' => 'POST',
				'header' => implode( "\r\n", $header ),
			),
		);

		$context['http']['content'] = $data;

		return @file_get_contents( $this->url . 'contact/detail/create', false, stream_context_create( $context ) );
	}

	// ブラストメール 検索
	/**
	 * Searches for a contact in the BlastMail system by email.
	 *
	 * @param string $email The email address of the contact to search for.
	 *
	 * @return array|false The contact details if found, or false if not found.
	 */
	public function find( $email ) {
		if ( empty( $email ) ) {
			return false;
		}

		$token = $this->get_blast_token();

		$data = array(
			'access_token' => $token,
			'email'        => $email,
			'f'            => 'json',
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $this->url . 'contact/detail/search?' . http_build_query( $data ) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt(
			$ch,
			CURLOPT_HTTPHEADER,
			array(
				'Content-Type: ' . $this->default_content_type,
			)
		);

		$result = curl_exec( $ch );
		curl_close( $ch );

		if ( empty( $result ) ) {
			return false;
		} else {
			return json_decode( $result, true );
		}
	}

	/**
	 * Updates an existing contact in the BlastMail system.
	 *
	 * @param string $contact_id       The ID of the contact to update.
	 * @param string $email            The email address of the contact.
	 * @param string $registered_store The store where the contact is registered (optional).
	 * @param string $use_store        The store where the contact is using services (optional).
	 * @param string $status           The status of the contact (default: "配信中").
	 *
	 * @return bool True if the update was successful, false otherwise.
	 */
	public function update( $contact_id, $email, $registered_store = '', $use_store = '', $status = '配信中' ) {
		if ( empty( $contact_id ) || empty( $email ) ) {
			return false;
		}

		$token = $this->get_blast_token();

		$data = array(
			'access_token'                => $token,
			'contactID'                   => $contact_id,
			$this->email_field            => $email,
			$this->use_store_field        => $use_store, // 利用店舗
			$this->registered_store_field => $registered_store, // 登録店舗
			'status'                      => $status,
			'format'                      => 'json',
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $this->url . 'contact/detail/update' );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $data ) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt(
			$ch,
			CURLOPT_HTTPHEADER,
			array(
				'Content-Type: ' . $this->default_content_type,
			)
		);

		$result = curl_exec( $ch );
		curl_close( $ch );

		if ( empty( $result ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Deletes a contact in the BlastMail system by setting their status to "削除" (deletion).
	 *
	 * @param string $email The email address of the contact to delete.
	 *
	 * @return bool True if the deletion was successful, false otherwise.
	 */
	public function delete( $email ) {
		if ( empty( $email ) ) {
			return false;
		}

		$user_data = $this->find( $email );
		if ( empty( $user_data ) ) {
			return false;
		}

		$token = $this->get_blast_token();

		$data = array(
			'access_token' => $token,
			'contactID'    => $user_data['contactID'],
			'status'       => '削除',
			'format'       => 'json',
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $this->url . 'contact/detail/update' );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $data ) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt(
			$ch,
			CURLOPT_HTTPHEADER,
			array(
				'Content-Type: ' . $this->default_content_type,
			)
		);

		$result = curl_exec( $ch );
		curl_close( $ch );

		if ( empty( $result ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Subscribes an email address to the BlastMail system.
	 *
	 * This function checks if the email already exists in the system. If not, it creates a new contact.
	 * If the email exists, it updates the existing contact with the provided store information.
	 *
	 * @param string $email            The email address to subscribe.
	 * @param string $registered_store The store where the contact is registered (optional).
	 * @param string $use_store        The store where the contact is using services (optional).
	 * @param bool   $send_mail        Whether to send a confirmation email (default: false).
	 *
	 * @return bool True if the subscription was successful, false otherwise.
	 */
	public function subscribe( $email, $registered_store = '', $use_store = '', $send_mail = false ) {
		if ( empty( $email ) ) {
			return false;
		}
		$user_data = $this->find( $email );
		if ( empty( $user_data ) ) {
			$result = $this->create( $email, $registered_store, $use_store );
			if ( $result ) {
				return true;
			}
		} else {
			$current_registered_store = explode( ',', $user_data[ $this->registered_store_field ] );
			if ( ! empty( $registered_store ) ) {
				$current_registered_store[] = $registered_store;
				$current_registered_store   = array_unique( $current_registered_store );
				$current_registered_store   = array_filter( $current_registered_store, 'strlen' );
				$current_registered_store   = array_intersect( $this->shop_list, $current_registered_store );
				error_log( print_r( $current_registered_store, true ) );
				$registered_store = implode( ',', $current_registered_store );
			}

			$current_use_store = explode( ',', $user_data[ $this->use_store_field ] );
			if ( ! empty( $use_store ) ) {
				$current_use_store[] = $use_store;
				$current_use_store   = array_unique( $current_use_store );
				$current_use_store   = array_filter( $current_use_store, 'strlen' );
				// $this->shop_listの順に並び替え
				$current_use_store = array_intersect( $this->shop_list, $current_use_store );
				error_log( print_r( $current_use_store, true ) );
				$use_store = implode( ',', $current_use_store );
			}

			$result = $this->update( $user_data['contactID'], $email, $registered_store, $use_store );
			if ( $result ) {
				return true;
			}
		}
	}

	/**
	 * Unsubscribes an email address from the BlastMail system.
	 *
	 * This function checks if the email exists in the system and then deletes the contact
	 * by setting their status to "削除" (deletion).
	 *
	 * @param string $email     The email address to unsubscribe.
	 * @param bool   $send_mail Whether to send a confirmation email (default: false).
	 *
	 * @return bool True if the unsubscription was successful, false otherwise.
	 */
	public function unsubscribe( $email, $send_mail = false ) {
		if ( empty( $email ) ) {
			return false;
		}
		$user_data = $this->find( $email );
		if ( empty( $user_data ) ) {
			return false;
		} else {
			$result = $this->delete( $email );
			if ( $result ) {
				return true;
			}
		}
	}
}
