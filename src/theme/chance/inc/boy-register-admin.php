<?php
/**
 * 管理画面用：ボーイのログイン情報登録ページ
 */

// 管理画面メニューに追加
function chance_add_boy_register_menu() {
	if ( current_user_can( 'manage_boy_registration' ) || current_user_can( 'manage_options' ) ) {
		add_users_page(
			'ボーイ登録',
			'ボーイ登録',
			'manage_boy_registration',
			'chance_boy_register',
			'chance_render_boy_register_page'
		);
	}
}
add_action( 'admin_menu', 'chance_add_boy_register_menu' );

// 登録ページの表示
function chance_render_boy_register_page() {
	if ( ! ( current_user_can( 'manage_boy_registration' ) || current_user_can( 'manage_options' ) ) ) {
		wp_die( '権限がありません' );
	}

	// メッセージ用
	$message = '';
	$error   = '';

	// 登録処理
	if ( isset( $_POST['boy_name'], $_POST['login_id'], $_POST['password'], $_POST['chance_boy_register_nonce'] ) ) {
		if ( ! wp_verify_nonce( $_POST['chance_boy_register_nonce'], 'chance_boy_register_action' ) ) {
			$error = '不正なリクエストです。';
		} else {
			$boy_id   = intval( $_POST['boy_name'] );
			$login_id = sanitize_user( $_POST['login_id'] );
			$password = $_POST['password'];

			if ( empty( $boy_id ) || empty( $login_id ) || empty( $password ) ) {
				$error = 'すべての項目を入力してください。';
			} else {
				// すでに同じcastIDで登録済みかチェック
				$staff_users        = get_users( array( 'role' => 'staff' ) );
				$already_registered = false;
				foreach ( $staff_users as $user ) {
					if ( get_user_meta( $user->ID, 'staffID', true ) === $boy_id ) {
						$already_registered = true;
						break;
					}
				}
				if ( $already_registered ) {
					$error = 'このボーイはすでに登録されています。';
				} elseif ( username_exists( $login_id ) ) {
					$error = 'このログインIDは既に存在します。';
				} else {
					// ボーイ名取得
					$boy_title = get_the_title( $boy_id );
					$user_id   = wp_insert_user(
						array(
							'user_login' => $login_id,
							'user_pass'  => $password,
							'first_name' => $boy_title,
							'role'       => 'staff', // 必ずstaffロールで登録
						)
					);
					if ( ! is_wp_error( $user_id ) ) {
						update_user_meta( $user_id, 'staffID', $boy_id );

												// 確実なセッション方式のフラッシュメッセージ
						if ( ! session_id() ) {
							session_start();
						}

						$_SESSION['chance_boy_register_flash'] = array(
							'type'      => 'success',
							'message'   => 'ボーイの登録が完了しました！',
							'boy_name'  => $boy_title,
							'login_id'  => $login_id,
							'role'      => 'staff',
							'user_id'   => $user_id,
							'timestamp' => current_time( 'mysql' ),
						);

						// リダイレクト
						wp_redirect(
							add_query_arg(
								array(
									'page'    => 'chance_boy_register',
									'message' => 'success',
								),
								admin_url( 'users.php' )
							)
						);
						exit;
					} else {
						$error = 'ユーザー登録に失敗しました。';
					}
				}
			}
		}
	}

	// cast投稿タイプの日本語投稿を取得（bogo用: 'locale'が'ja'）
	$cast_query = new WP_Query(
		array(
			'post_type'      => 'cast',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
			'lang'           => 'ja', // bogo用
		)
	);
	?>
	<div class="wrap">
		<h1>ボーイのログイン情報登録</h1>
		
		<?php
		// デバッグ情報を表示（開発時のみ）
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			echo '<div class="notice notice-info"><p><strong>DEBUG情報:</strong></p>';
			echo '<p>GET parameters: ' . esc_html( http_build_query( $_GET ) ) . '</p>';
			if ( isset( $_GET['result'] ) ) {
				$debug_key  = sanitize_text_field( $_GET['result'] );
				$debug_data = get_transient( $debug_key );
				echo '<p>Transient data: ' . esc_html( wp_json_encode( $debug_data ) ) . '</p>';
			}
			echo '</div>';
		}
		?>
		
		<?php if ( ! empty( $error ) ) : ?>
			<div class="notice notice-error is-dismissible"><p><?php echo esc_html( $error ); ?></p></div>
		<?php endif; ?>
		<?php
		// セッションからフラッシュメッセージを取得
		if ( ! session_id() ) {
			session_start();
		}

		$flash_message = null;
		if ( isset( $_SESSION['chance_boy_register_flash'] ) ) {
			$flash_message = $_SESSION['chance_boy_register_flash'];
			unset( $_SESSION['chance_boy_register_flash'] ); // 表示後に削除
		}
		?>
		
		<?php if ( isset( $_GET['message'] ) && 'success' === $_GET['message'] ) : ?>
			<?php if ( $flash_message && 'success' === $flash_message['type'] ) : ?>
				<div class="notice notice-success is-dismissible chance-success-message">
					<p><strong>✅ <?php echo esc_html( $flash_message['message'] ); ?></strong></p>
					<div style="margin-top: 12px; padding: 12px; background-color: rgba(0,163,42,0.1); border-radius: 4px;">
						<ul style="margin: 0; padding-left: 20px;">
							<li><strong>ボーイ名：</strong><?php echo esc_html( $flash_message['boy_name'] ); ?></li>
							<li><strong>ログインID：</strong><?php echo esc_html( $flash_message['login_id'] ); ?></li>
							<li><strong>ロール：</strong><?php echo esc_html( $flash_message['role'] ); ?></li>
							<?php if ( isset( $flash_message['user_id'] ) ) : ?>
								<li><strong>ユーザーID：</strong><?php echo esc_html( $flash_message['user_id'] ); ?></li>
							<?php endif; ?>
							<?php if ( isset( $flash_message['timestamp'] ) ) : ?>
								<li><strong>登録時刻：</strong><?php echo esc_html( $flash_message['timestamp'] ); ?></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			<?php else : ?>
				<div class="notice notice-success is-dismissible">
					<p><strong>✅ ボーイの登録が完了しました！</strong></p>
				</div>
			<?php endif; ?>
			
			<style>
				.chance-success-message {
					border-left: 4px solid #00a32a !important;
					animation: slideInDown 0.5s ease-out;
					background-color: #f0f9ff !important;
				}
				.chance-success-message .notice-dismiss:before {
					color: #00a32a;
				}
				@keyframes slideInDown {
					from {
						transform: translateY(-10px);
						opacity: 0;
					}
					to {
						transform: translateY(0);
						opacity: 1;
					}
				}
			</style>
			
			<script>
				jQuery(document).ready(function($) {
					// 15秒後に自動で消す
					setTimeout(function() {
						$('.chance-success-message').fadeOut(600);
					}, 15000);
					
					// クリックで即座に消す
					$('.chance-success-message .notice-dismiss').on('click', function() {
						$(this).parent().fadeOut(300);
					});
				});
			</script>
		<?php endif; ?>
		<form method="post">
			<?php wp_nonce_field( 'chance_boy_register_action', 'chance_boy_register_nonce' ); ?>
			<table class="form-table">
				<tr>
					<th><label for="boy_name">ボーイの名前</label></th>
					<td>
						<select name="boy_name" id="boy_name" class="regular-text" required>
							<option value="">選択してください</option>
							<?php
							if ( $cast_query->have_posts() ) :
								while ( $cast_query->have_posts() ) :
									$cast_query->the_post();
									if ( function_exists( 'bogo_get_post_language' ) ) {
										if ( 'ja' !== bogo_get_post_language( get_the_ID() ) ) {
											continue;
										}
									}
									?>
									<option value="<?php echo esc_attr( get_the_ID() ); ?>"
									<?php
									if ( isset( $_POST['boy_name'] ) && get_the_ID() === $_POST['boy_name'] ) {
										echo 'selected';}
									?>
									>
										<?php echo esc_html( get_the_title() ); ?>
									</option>
									<?php
								endwhile;
							endif;
							wp_reset_postdata();
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th><label for="login_id">ログインID</label></th>
					<td><input type="text" name="login_id" id="login_id" class="regular-text" required value="<?php echo isset( $_POST['login_id'] ) ? esc_attr( $_POST['login_id'] ) : ''; ?>"></td>
				</tr>
				<tr>
					<th><label for="password">パスワード</label></th>
					<td><input type="password" name="password" id="password" class="regular-text" required></td>
				</tr>
			</table>
			<?php submit_button( '登録する' ); ?>
		</form>
	</div>
	<?php
}
