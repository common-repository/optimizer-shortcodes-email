<?php
/**
 * Plugin Name:       Optimizer Shortcodes - Email
 * Plugin URI:        https://businessoptimizer.org/collections/plugins
 * Description:       Provides a simple text field for an email address that can be used throughout the site with a shortcode.
 * Version:           1.0.2
 * Requires at least: 5
 * Requires PHP:      7.3
 * Author:            Business Optimizer
 * Author URI:        https://businessoptimizer.org/
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       optimizer_email
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Optimizer_Email {

	/**
	 * Static property to hold our singleton instance
	 */
	static $instance = false;

	static $core_name = 'optimizer_shortcodes';

	// This should be the same as the text domain.
	static $plugin_prefix = 'optimizer_email';

	private function __construct() {
		register_activation_hook( __FILE__, [ $this, 'activation' ] );
		register_deactivation_hook( __FILE__, [ $this, 'deactivation' ] );
		register_uninstall_hook( __FILE__, [ $this,'uninstall' ] );

		add_action( 'admin_init', [ $this, 'settings_init' ] );
		add_action( 'admin_menu', [ $this, 'optimizer_shortcodes_options_page' ] );

		add_shortcode( 'optimizer_email', [ $this, 'shortcode_handling' ] );
	}

	public static function getInstance() {
		if ( !self::$instance )
			self::$instance = new self;
		return self::$instance;
	}

	public function activation() {
		// Nothing here yet.
	}

	public function deactivation() {
		wp_cache_flush();
	}

	public function uninstall() {
		wp_cache_flush();
	}

	public function settings_init() {
		// Register our new core new settings.
		register_setting( self::$core_name, self::$core_name . '_options' );

		// Register our new core new section.
		add_settings_section(
			self::$core_name . '_section_developers',
			'',
			[ $this, 'section_developers_callback' ],
			self::$core_name
		);

		// Register a new field in our core section, inside the "optimizer_shortcodes" page.
		$field_name = 'field_email';
		add_settings_field(
			self::$core_name . '_' . $field_name, // As of WP 4.6 this value is used only internally.
			// Use $args' label_for to populate the id inside the callback.
			__( 'Email Address', self::$plugin_prefix ),
			[$this, 'optimizer_plugin_base_' . $field_name . '_callback'],
			self::$core_name,
			self::$core_name . '_section_developers',
			array(
				'label_for'         => self::$core_name . '_' . $field_name,
				'class'             => self::$core_name . '_row ' . self::$plugin_prefix . '_row',
				'field_name'        => $field_name,
			)
		);
	}

	public function section_developers_callback( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Use the shortcode on your site and update it\'s content here.', self::$plugin_prefix ); ?></p>
		<p><?php echo __( 'Use the following code if you want to use the shortcode in your templates. This works for any shortcode.', self::$plugin_prefix ); ?><br><code>echo do_shortcode('[optimizer_phone_number]');</code></p>
		<?php
	}

	function optimizer_plugin_base_field_email_callback( $args ) {
		// Get the value of the setting we've registered with register_setting()
		$options = get_option( self::$core_name . '_options' );
		include_once plugin_dir_path( __FILE__ ) . 'templates/admin/fields/field-email.php';
	}

	/**
	 * Add the top level menu page.
	 */
	function optimizer_shortcodes_options_page() {
		if ( empty( menu_page_url( 'optimizer-shortcodes', false ) ) ) {
			add_menu_page(
				'Optimizer Shortcodes',
				'Optimizer Shortcodes',
				'manage_options',
				'optimizer-shortcodes',
				[ $this, 'optimizer_options_page_html' ],
				'',
				59
			);
		}
	}

	/**
	 * Top level menu callback function
	 */
	function optimizer_options_page_html() {
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// check if the user have submitted the settings
		// WordPress will add the "settings-updated" $_GET parameter to the url
		if ( isset( $_GET[ 'settings-updated' ] ) ) {
			// add settings saved message with the class of "updated"
			add_settings_error( self::$plugin_prefix . '_messages', self::$plugin_prefix . '_message', __( 'Settings saved.', self::$plugin_prefix ), 'updated' );
		}

		// show error/update messages
		settings_errors( self::$plugin_prefix . '_messages' );

		include_once plugin_dir_path( __FILE__ ) . 'templates/admin/optimizer-settings-page.php';
	}

	function shortcode_handling( $atts, $content, $tag ) {
		$option = get_option( self::$core_name . '_options' );
		if ( !empty( $option ) && !empty( $option[ self::$core_name . '_field_email' ] ) ) {
			$content = $option[ self::$core_name . '_field_email' ];
		}

		return $content;
	}
}

// Instantiate our class.
$Optimizer_Email = Optimizer_Email::getInstance();
