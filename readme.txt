=== Optimizer Shortcodes - Email ===
Contributors: businessoptimizer, rajivlodhia
Tags: email, email address, email shortcode, optimizer shortcodes, business optimizer
Requires at least: 4.7
Tested up to: 6.0
Requires PHP: 7.3
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

A very simple plugin that turns your email address into a shortcode. This plugin provides a field and shortcode for your email address allowing you to use it anywhere on your site. If you ever need to update your email address, you'd just need to change it in one place.

This plugin works together with other Optimizer Shortcodes plugins. Find a list of all our Optimizer Shortcodes plugins [here](https://businessoptimizer.org/collections/plugins).

== Installation ==

1. Copy the `optimizer-shortcodes-email` folder into your `wp-content/plugins` folder
2. Activate the Optimizer Shortcodes - Email plugin via the plugins admin page
3. Set your email address in the new field (`/wp-admin/admin.php?page=optimizer-shortcodes`)

== Usage Instructions ==

After setting your email address in the new settings page (`/wp-admin/admin.php?page=optimizer-shortcodes`), you can use the shortcode [optimizer_email] anywhere on your site to display that email address.
If you need to use the field value in your theme files or template, you can print it with PHP like this:
<?php echo do_shortcode('[optimizer_email]'); ?>

== Credits ==

Plugin built by [Rajiv Lodhia](https://rajivlodhia.com/) for [Business Optimizer](https://businessoptimizer.org/)

== Screenshots ==
1. The new menu page and custom email field

== Changelog ==

= 1.0.0 =
* Initial Release.

= 1.0.1 =
* Tested for WP 6.0+

= 1.0.2 =
* Fixed wrong field name that was breaking the shortcode
