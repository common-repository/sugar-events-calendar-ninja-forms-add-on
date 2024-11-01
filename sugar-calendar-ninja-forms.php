<?php 
/* 
 * Plugin name: Sugar Events Calendar Ninja Forms
 * Plugin URI: http://164a.com
 * Description: Easily take event registration by adding forms to your events pages with Ninja Forms.
 * Version: 1.0
 * Author: Studio164a
 * Author URI: http://164a.com
 * Requires at least: 3.5
 * Tested up to: 3.9
 */

/**
 * Load text domain.
 *
 * @since 1.0
 */
function sofa_scnf_load_plugin_textdomain() {
	load_plugin_textdomain( 'sofa-scnf', false, dirname( plugin_basename( SC_PLUGIN_FILE ) ) . '/languages/' );
}

add_action( 'init', 'sofa_scnf_load_plugin_textdomain' );

/**
 * Add the meta box to the event post type.
 * 
 * @return void
 * @since 1.0
 */
function sofa_scnf_add_meta_boxes() {
	add_meta_box(
		'ninja_forms_selector',
		__( 'Append A Ninja Form', 'sofa-scnf'),
		'ninja_forms_inner_custom_box',
		'sc_event',
		'side',
		'low'
	);
}

add_action('add_meta_boxes', 'sofa_scnf_add_meta_boxes');

/**
 * Display form on event page.
 *
 * @since 1.0
 */
function sofa_scnf_show_form($event_id) {
	$form_id = get_post_meta( $event_id, 'ninja_forms_form', true );

	if ( strlen($form) ) {
		ninja_forms_display_form( $form_id );
	}
}

add_action( 'sc_after_event_content', 'sofa_scnf_show_form' );