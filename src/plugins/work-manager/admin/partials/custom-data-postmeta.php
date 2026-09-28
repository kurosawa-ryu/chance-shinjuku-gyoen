<?php
global $post;

$fileds = array(
	'icon'           => 'am-icon',
	'name_en'        => 'am-name-en',
	'shop'           => 'am-shop',
	'height'         => 'am-height',
	'weight'         => 'am-weight',
	'age'            => 'am-age',
	'sexuality'      => 'am-sexuality',
	'size'           => 'am-size',
	'optBUke'        => 'am-optBUke',
	'optBTachi'      => 'am-optBTachi',
	'opt3p4p'        => 'am-opt3p4p',
	'optTachi'       => 'am-optTachi',
	'optSoftSM'      => 'am-optSoftSM',
	'optOna'         => 'am-optOna',
	'mozaBtn'        => 'am-mozaBtn',
	'addressMail'    => 'am-addressMail',
	'urlTwitter'     => 'am-urlTwitter',
	'urlLine'        => 'am-urlLine',
	'commentManager' => 'am-commentManager',
	'reviewBoys'     => 'am-reviewBoys',
);
$data   = array();

$play_options = array( '◎', '○', '△', '×' );

foreach ( $fileds as $key => $value ) {
	$data[ $key ] = get_post_meta( $post->ID, $value, true );
}
?>

<div class="inside">
<input type="hidden" name="custom_data_flg" value="1">
<table class="table table_noborder table_nowrap">
	<tr>
		<th width="145">アイコン</th>
		<td id="icon">
			<?php
				$icon = array(
					''       => 'なし',
					'new'    => 'NEW',
					'update' => 'UPDATE',
					'return' => 'RETURN',
					'nagoya' => '名古屋BOY',
					'osaka'  => '大阪BOY',
					'namba'  => '難波BOY',
				);

				?>
			<select name="custom_data[am-icon]" class="form-control">
				<?php foreach ( $icon as $key => $value ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $data['icon'], $key ); ?>><?php echo esc_html( $value ); ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<th width="145">英語表記名</th>
		<td><input type="text" name="custom_data[am-name-en]" class="form-control" value="<?php echo esc_attr( $data['name_en'] ); ?>" placeholder="例: TARO"></td>
	</tr>
	<tr>
		<th width="145">所属店</th>
		<td id="shop">
			<?php
				$shops = array(
					'chikusa'   => '名古屋',
					'osaka'     => '大阪',
					'namba'     => '難波',
					'shinjuku'  => '東京',
					'shinokubo' => '新大久保',
					'shinjuku-gyoen' => '新宿',
				);
				?>
			<select name="custom_data[am-shop]" class="form-control">
				<option value="">選択してください</option>
				<?php foreach ( $shops as $key => $value ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $data['shop'], $key ); ?>><?php echo esc_html( $value ); ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<th>身長</th>
		<td class="form-inline"><input type="text" name="custom_data[am-height]" class="form-control" value="<?php echo $data['height']; ?>"></td>
	</tr>
	<tr>
		<th>体重</th>
		<td class="form-inline"><input type="text" name="custom_data[am-weight]" class="form-control" value="<?php echo $data['weight']; ?>"></td>
	</tr>
	<tr>
		<th>年齢</th>
		<td class="form-inline"><input type="text" name="custom_data[am-age]" class="form-control" value="<?php echo $data['age']; ?>"></td>
	</tr>
	<tr>
		<th>セクシャリティ</th>
		<td class="form-inline"><input type="text" name="custom_data[am-sexuality]" class="form-control" value="<?php echo $data['sexuality']; ?>"></td>
	</tr>
	<tr>
		<th>Pサイズ</th>
		<td class="form-inline"><input type="text" name="custom_data[am-size]" class="form-control" value="<?php echo $data['size']; ?>"></td>
	</tr>
	<tr>
		<th>スタッフ可能プレイ</th>
		<td class="form-inline">
			<label>バックウケ：
				<select name="custom_data[am-optBUke]" class="form-control">
					<?php foreach ( $play_options as $value ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $data['optBUke'], $value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>&nbsp;
			<label>バックタチ：
				<select name="custom_data[am-optBTachi]" class="form-control">
					<?php foreach ( $play_options as $value ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $data['optBTachi'], $value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>&nbsp;
			<label>3P・4P：
				<select name="custom_data[am-opt3p4p]" class="form-control">
					<?php foreach ( $play_options as $value ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $data['opt3p4p'], $value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>&nbsp;
			<label>ボーイ絡み：
				<select name="custom_data[am-optTachi]" class="form-control">
					<?php foreach ( $play_options as $value ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $data['optTachi'], $value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>&nbsp;
			<label>ソフトSM：
				<select name="custom_data[am-optSoftSM]" class="form-control">
					<?php foreach ( $play_options as $value ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $data['optSoftSM'], $value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>&nbsp;
			<label>オナニー鑑賞：
				<select name="custom_data[am-optOna]" class="form-control">
					<?php foreach ( $play_options as $value ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $data['optOna'], $value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</td>
	</tr>
	<tr>
			<th>モザイクなし画像<br>請求ボタン</th>
			<td>
				<?php
					$moza = array(
						'yes' => 'あり',
						'no'  => 'なし',
					);
					foreach ( $moza as $key => $value ) {
						$checked = ( $data['mozaBtn'] === $key ) ? ' checked' : '';
						echo '<label class="radio-inline"><input type="radio" name="custom_data[am-mozaBtn]" value="' . $key . '"' . $checked . '> ' . $value . '</label>';
					}
					?>
					
			</td>
	</tr>
	<tr>
		<th>メールアドレス</th>
		<td class="form-inline"><input type="text" name="custom_data[am-addressMail]" class="form-control" value="<?php echo $data['addressMail']; ?>"></td>
	</tr>
	<tr>
		<th>ツイッターURL</th>
		<td class="form-inline"><input type="text" name="custom_data[am-urlTwitter]" class="form-control" value="<?php echo $data['urlTwitter']; ?>"></td>
	</tr>
	<tr>
		<th>LINEURL</th>
		<td class="form-inline"><input type="text" name="custom_data[am-urlLine]" class="form-control" value="<?php echo $data['urlLine']; ?>"></td>
	</tr>
	<tr>
		<th>ボーイレビュー</th>
		<td>
			<?php
			// リッチエディター用のnonceフィールド
			wp_nonce_field( 'wm_boy_review_nonce_action', 'wm_boy_review_nonce' );

			// wp_editorでリッチエディターを表示
			wp_editor(
				htmlspecialchars_decode( $data['reviewBoys'] ),
				'am-reviewBoys',
				array(
					'textarea_name' => 'custom_data[am-reviewBoys]',
					'textarea_rows' => 10,
					'media_buttons' => true,
					'teeny'         => false,
					'quicktags'     => true,
				)
			);
			?>
		</td>
	</tr>
</table>
