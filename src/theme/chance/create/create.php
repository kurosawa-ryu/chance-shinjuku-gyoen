<?php

/**
 * Template Name: 登録フォーム
 */
function create_result() {
	global $create_error;
	global $create_comp;
	if ( ! empty( $create_error ) ) {
		echo '<span id="createError" class="red">';
		echo implode( '<br />', $create_error );
		echo '</span>';
	} elseif ( ! empty( $create_comp ) ) {
		echo '<span id="createComp">' . $create_comp . '</span>';
	}
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="robots" content="noindex,nofollow">
	<title>ユーザー登録</title>
	<link href="<?php echo get_template_directory_uri(); ?>/assets/create.css" rel="stylesheet">

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
	<style>
		.navbar {
			border-radius: 0;
			margin-bottom: 50px;
		}

		.w480 {
			max-width: 510px;
		}
	</style>
</head>

<body>

	<?php
	if ( is_user_logged_in() ) :
		$user       = wp_get_current_user();
		$login_name = $user->user_login;
		if ( in_array( 'administrator', $user->roles, true ) || in_array( 'editer', $user->roles, true ) || 'owner' === $login_name || 'chance' === $login_name ) :
			?>
			<nav class="navbar navbar-inverse">
				<div class="container">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo esc_url( home_url( '/wp-admin/' ) ); ?>">管理画面へ戻る</a></li>
						<li><a href="<?php echo esc_url( home_url( '/wp-admin/' ) ); ?>users.php">ユーザー一覧へ</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-login.php?action=logout&_wpnonce=94cc95f985"><span class="bi bi-box-arrow-right"></span> Logout</a></li>
					</ul>
				</div>
			</nav>

			<div class="container w480">

				<div class="modal fade" id="createModal" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"></h4>
							</div>
							<div class="modal-body">
								<p><?php create_result(); ?></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

				<form action="<?php the_permalink(); ?>" method="post" 　autocomplete="off" id="customerValid">
					<input type="password" name="dummypass" style="visibility:hidden;display:block;height:0;">
					<?php wp_nonce_field( 'createBrank' ); ?>
					<div class="form-group">
						<label for="staffID">ボーイの名前:</label>
						<select class="form-control validate[required]" name="staffID" 　id="staffID">
							<option value="" disabled selected hidden></option>
							<?php
							$the_query = new WP_Query( 'posts_per_page=-1&post_type=cast' );
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									echo '<option value="' . $post->ID . '">' . get_the_title() . '</option>';
								}
							}
							wp_reset_postdata();
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="userName">ログインID:</label>
						<input type="text" name="userName" class="form-control validate[required,custom[onlyLetterSp]]" id="userName" style="ime-mode:disabled;">
					</div>
					<div class="form-group">
						<label for="userPwd">パスワード:</label>
						<input type="password" name="userPwd" class="form-control validate[required,custom[onlyLetterNumber]]" id="userPwd" style="ime-mode:disabled;">
					</div>
					<button type="submit" class="btn btn-default">登録する</button>
				</form>
			</div>
		<?php else : ?>
			<div class="container w480">
				<p class="text-center mgt100">権限がありません</p>
				<p class="text-center"><a href="<?php echo esc_url( home_url( '/wp-admin/' ) ); ?>">管理画面に戻る</a></p>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<div class="container w480">
			<p class="text-center mgt100"><a href="<?php echo wp_login_url( get_permalink() ); ?>">ログイン</a>してください。</p>
		</div>
	<?php endif; ?>
	<script src="<?php echo get_template_directory_uri(); ?>/src/js/jquery-1.12.4.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/src/js/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/src/js/jquery.matchHeight.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/src/js/jquery.validationEngine.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/src/js/jquery.validationEngine-ja.js"></script>
	<script>
		(function($) {
			$('.matchbox').matchHeight();
			$('.matchcontents').matchHeight();

			$("#customerValid").validationEngine('attach', {
				promptPosition: "topRight"
			});
			if ($("#createError").length) {
				$('h4.modal-title').text('登録できませんでした');
				$("#createModal").modal("show");
			} else if ($("#createComp").length) {
				$('h4.modal-title').text('登録完了');
				$("#createModal").modal("show");
			}
		})(jQuery);
	</script>
</body>

</html>
