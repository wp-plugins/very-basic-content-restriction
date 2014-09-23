<?php
/*
Plugin Name: Very Basic Content Restriction
Plugin URI: http://curlybracket.net/2013/04/16/very-basic-content-restriction/
Description: Restrict access to categories, posts, tags, taxonomies, feeds. Allow only access to pages. If user is not connected, redirect to login page.
Version: 1.4
Author: Ulrike Uhlig
Author URI: http://curlybracket.net
License: GPL2
*/
/*
    Copyright 2012-2014 Ulrike Uhlig (email : u@curlybracket.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
function vbcr_simple_content_restriction() {
    global $wp_query;
    if( !is_user_logged_in() ) {
        if( is_category() || is_archive() || is_single() || is_tax() || is_tag() || is_feed() || is_comment_feed() || is_attachment() || is_search() ) {
            $option_redirect_to = get_option('redirect-to');
			if(empty($option_redirect_to)) {
				// retrieve WP login URL
                $option_redirect_to = wp_login_url();
            }
            $status = "302";
            wp_redirect( $option_redirect_to, $status ); exit;
        }
    }
    ob_flush();
}

function content_restriction_output_buffer() {
	// this is needed for the redirection
    ob_start();
}

add_action('init', 'content_restriction_output_buffer');
add_action('pre_get_posts', 'vbcr_simple_content_restriction');

/**
 * Add options page to settings menu
 */

if ( is_admin() ){ // admin actions
    add_action('admin_menu', 'wp_content_restriction_menu');
}

function wp_content_restriction_menu() {
    add_submenu_page( 'options-general.php', 'Content Restriction', 'Content Restriction', 'manage_options', 'content_restriction_page', 'content_restriction_page_callback' );
    add_action( 'admin_init', 'register_content_restriction_settings' );
}

function content_restriction_page_callback() {
    echo '<div class="wrap">';
    echo '<h2>Content Restriction</h2>';
    echo '<form method="post" action="options.php">';
    echo settings_fields( 'content-restriction-group' );
    echo '<label>Redirect to (absolute URL) <input type="text" name="redirect-to" value="'.get_option('redirect-to').'" /></label>';
    echo '<p>If this field is empty, we will redirect people to the login page of your blog.</p>';
    echo submit_button();
    echo '</form></div>';
}

function register_content_restriction_settings() {
    register_setting( 'content-restriction-group', 'redirect-to', 'vbcr_sanitize' );
}

function vbcr_sanitize($input) {
	$input = esc_url($input);
	return $input;
}
?>
