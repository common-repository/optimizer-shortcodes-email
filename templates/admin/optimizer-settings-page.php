<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="post">
		<?php
		// output security fields for the registered setting "bospb"
		settings_fields( self::$core_name );
		// output setting sections and their fields
		// (sections are registered for "bospb", each field is registered to a specific section)
		do_settings_sections( self::$core_name );
		// output save settings button
		submit_button( 'Save Settings' );
		?>
	</form>
</div>
