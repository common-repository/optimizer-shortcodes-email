<input
	id="<?php echo esc_attr( $args['label_for'] ); ?>"
	name="<?php echo self::$core_name ?>_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	type="text"
	value="<?php if (!empty($options[self::$core_name . '_' . $args['field_name']])) echo $options[self::$core_name . '_' . $args['field_name']]; ?>"
	placeholder=""
/>
<p class="description">
	<?php esc_html_e( '[optimizer_email]', self::$plugin_prefix ); ?>
</p>
