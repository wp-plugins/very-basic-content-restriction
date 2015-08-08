=== Very basic content restriction ===
Contributors: veganist
Tags: content restriction, restrict, access, restricted access, member only, subscriber only, registration
Requires at least: 3.3
Tested up to: 4.2.4
Stable tag: 1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Restricts access to all content except pages for non authenticated users.

== Description ==

This plugin redirects non authenticated users to a page of your choice or, as per default, to the login page.
Posts, categories, feeds, tags, taxonomies, author pages and search results are restricted to authenticated (connected) users.
Only pages are public. So if you have a homepage defined, then this page will be accessible.

== Installation ==

1. Upload `very-basic-content-restriction` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the redirection link on the options page. If left empty, users will be redirected to your default WP login page.

== Frequently asked questions ==

Q: Can i restrict only some pages and allow others?
A: No, a per page or per category configuration is not possible.

== Changelog ==

= 1.0 =
* Initial release

= 1.1 =
* Added is_archive() to forbidden pages.

= 1.2 =
* Compatibility with WP 3.8

= 1.3 =
* Better sanitization

= 1.4 =
* Simple code improvements
* retrieve wp-login URL automatically, so that this would also work with plugin which modify the default URL
