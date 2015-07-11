<?php
/*
Plugin Name: Easy URL Shortcodes (EUS)
Plugin URI: http://kcportfolio.com
Description: Plugin that shows urls, paths, and titles using shortcode for easy and consistent website maintenance.
Author: karencu
Version: 1.0
Author URI: http://kcportfolio.com
*/


 /**
 * Add an admin submenu link under Settings
 */
function eus_add_options_submenu_page() {
     add_submenu_page(
          'options-general.php',          // admin page slug
          __( 'Easy URL Shortcodes (EUS)', 'eus' ), // page title
          __( 'Easy URL Shortcodes (EUS)', 'eus' ), // menu title
          'manage_options',               // capability required to see the page
          'eus_options',                // admin page slug
          'eus_options_page'            // callback function to display the options page
     );
}
add_action( 'admin_menu', 'eus_add_options_submenu_page' );
 
 
/**
 * Register the settings
 */
function eus_register_settings() {
     register_setting(
          'eus_options',  // settings section
          'eus_hide_meta' // setting name
     );
}
add_action( 'admin_init', 'eus_register_settings' );

 
/**
 * Build the options page
 * Displays list of shortcodes and usage
 */
function eus_options_page() {
?>
<div class="wrap">
<h2>Easy URL Shortcodes (EUS)</h2>
<p>List of shortcodes you can use on your post, page and widgets for easy and consistent displaying url of post, pages and media files. As well as displaying sites titles, descriptions and meta data.</p>

<p><b>NOTE:</b> To get post, page, or media <b>ID</b>, you can view it on its editing page URL.</p>
<p>E.g. <i><yoursiteurl>/wp-admin/post.php?post=2&action=edit</i> ID is 2</p>

<table class="form-table">
<tr valign="top">
<th>URL/PATH SHORTCODES</th>
</tr>
<tr valign="top">
<th>SHORTCODE</th>
<th>DESCRIPTION</th>
<th>PARAMETER</th>
<th>USAGE</th>
</tr>
<tr valign="top">
<td>[show_url id='']</td>
<td>Displays specific page or post url</td>
<td>id <i>(required)</i></td>
<td>[show_url id='100']</td>
</tr>
<tr valign="top">
<td>[show_media_url id='']</td>
<td>Displays specific media url</td>
<td>id <i>(required)</i></td>
<td>[show_media_url id='100']</td>
</tr>
<tr valign="top">
<td>[show_theme_url]</td>
<td>Displays current theme url</td>
<td><i>none</i></td>
<td>[show_theme_url]</td>
</tr>
<tr valign="top">
<td>[show_site_url]</td>
<td>Displays current site url</td>
<td><i>none</i></td>
<td>[show_site_url]</td>
</tr>
<tr valign="top">
<td>[show_current_url]</td>
<td>Displays current page url. (it will show the url of page/post being viewed)</td>
<td><i>none</i></td>
<td>[show_current_url]</td>
</tr>
<tr valign="top">
<td>[show_current_parent_url]</td>
<td>Displays current page's parent url. (if the page is the parent it will just show its url)</td>
<td><i>none</i></td>
<td>[show_current_parent_url]</td>
</tr>
<tr valign="top">
<td>[show_stylesheet_url]</td>
<td>Displays css/stylesheet url </td>
<td><i>none</i></td>
<td>[show_stylesheet_url]</td>
</tr>
<tr valign="top">
<td>[show_login_url]</td>
<td>redirect_page login url<br/>Optional: You can set page redirection to home or current page or leave as is. </td>
<td>redirect [values = 'home' or 'current'] <i>(optional)</i></i></td>
<td>[show_login_url redirect_page='home'] or [show_login_url]</td>
</tr>
<tr valign="top">
<td>[show_logout_url]</td>
<td>Displays logout url<br/>Optional: You can set page redirection to home or current page or leave as is. </td>
<td>redirect_page [values = 'home' or 'current'] <i>(optional)</i></i></td>
<td>[show_logout_url redirect_page='home'] or [show_login_url]</td>
</tr>


<tr valign="top">
<th>TITLES/METADATA SHORTCODES</th>
</tr>
<tr valign="top">
<th>SHORTCODE</th>
<th>DESCRIPTION</th>
<th>PARAMETER</th>
<th>USAGE</th>
</tr>
<tr valign="top">
<td>[show_site_title]</td>
<td>Displays site's title.</td>
<td><i>none</i></td>
<td>[show_site_title]</td>
</tr>
<tr valign="top">
<td>[show_site_description]</td>
<td>Displays site's description.</td>
<td><i>none</i></td>
<td>[show_site_description]</td>
</tr>
<tr valign="top">
<td>[show_title]</td>
<td>Displays current page/post's title.</td>
<td><i>none</i></td>
<td>[show_title]</td>
</tr>
<tr valign="top">
<td>[show_parent_title]</td>
<td>Displays current page's parent title.</td>
<td><i>none</i></td>
<td>[show_parent_title]</td>
</tr>

<tr valign="top">
<td>[show_meta]</td>
<td>Displays current page's all Custom Field values.</td>
<td><i>none</i></td>
<td>[show_meta]</td>
</tr>

</table>

<?php

}      

/**
 * URL/PATH display Functions
 */
 
function EUS_show_url($atts,$content=null){
	extract( shortcode_atts( array(
		'id' => '',
	), $atts ) );
	foreach((array)$id as $f){
		$con =  get_permalink($f);
	}
	return $con;
}
add_shortcode("show_url","EUS_show_url");

function EUS_show_media_url($atts,$content=null){
	extract( shortcode_atts( array(
		'id' => '',
	), $atts ) );
	foreach((array)$id as $f){
		$media_att = wp_get_attachment_image_src( $f );
	}
	return $media_att;
}
add_shortcode("show_media_url","EUS_show_media_url");


function EUS_show_theme_url() { return esc_url(get_bloginfo('template_directory')); }
add_shortcode('show_theme_url','EUS_show_theme_url');

function EUS_show_site_url() { return esc_url(site_url()); }
add_shortcode('show_site_url','EUS_show_site_url');

function EUS_show_current_url() { return esc_url(get_permalink()); }
add_shortcode('show_current_url','EUS_show_current_url');

function EUS_show_current_parent_url() { global $post; return esc_url(get_permalink($post->post_parent)); }
add_shortcode('show_current_parent_url','EUS_show_current_parent_url');	

function EUS_show_stylesheet_url() { return esc_url(get_bloginfo ('stylesheet_url')); }
add_shortcode('show_stylesheet_url','EUS_show_stylesheet_url');


function EUS_show_login_url($atts,$content=null){
	$login_att = '';
	extract( shortcode_atts( array(
		'redirect_page' => '',
	), $atts ) );
	foreach((array)$redirect_page as $f){
		if($f == '' ){ $login_att = wp_login_url(); }
		else if($f == 'home' ){ $login_att = wp_login_url(home_url()); }
		else if($f == 'current' ){ $login_att = wp_login_url(get_permalink()); }
		else {$login_att = wp_login_url();}
	}
	return $login_att;
}
add_shortcode("show_login_url","EUS_show_login_url");


function EUS_show_logout_url($atts,$content=null){
	$logout_att = '';
	extract( shortcode_atts( array(
		'redirect_page' => '',
	), $atts ) );
	foreach((array)$redirect_page as $f){
		if($f == '' ){ $logout_att = wp_login_url(); }
		else if($f == 'home' ){ $logout_att = wp_login_url(home_url()); }
		else if($f == 'current' ){ $logout_att = wp_login_url(get_permalink()); }
		else {$logout_att = wp_login_url();}
	}
	return $logout_att;
}
add_shortcode("show_logout_url","EUS_show_logout_url");




/**
 * Titles, descriptions, and meta data display Functions
 */
 
function EUS_show_page_title() { return esc_attr(get_the_title()); }
add_shortcode('show_title','EUS_show_page_title');

function EUS_show_parent_title() { global $post; return esc_attr(get_the_title($post->post_parent)); }
add_shortcode('show_parent_title','EUS_show_parent_title');

function EUS_show_the_meta() { return esc_attr(the_meta()); }
add_shortcode('show_meta','EUS_show_the_meta');

function EUS_show_site_title() { return esc_attr(get_bloginfo ('name')); }
add_shortcode('show_site_title','EUS_show_site_title');

function EUS_show_site_description() { return esc_html(get_bloginfo ('description')); }
add_shortcode('show_site_description','EUS_show_site_description');




?>