<?php
/**
 * Plugin Name:  KSAS Research Highlights
 * Plugin URI:   http://krieger.jhu.edu/
 * Description:  Custom post type for Faculty Research Highlights
 * Version:      3.0.0
 * Author:       KSAS Communications
 * Author URI:   mailto:ksasweb@jhu.edu
 * License:      GPL2
 *
 * @package      KSAS Research Highlights
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Research Highlights custom post type.
 *
 * @return void
 */
function ksas_register_post_type() {

	$labels = array(
		'name'               => __( 'Research Highlights', 'ksas' ),
		'singular_name'      => __( 'Research Highlight', 'ksas' ),
		'add_new'            => __( 'Add New', 'ksas' ),
		'add_new_item'       => __( 'Add New Research Highlight', 'ksas' ),
		'edit_item'          => __( 'Edit Research Highlight', 'ksas' ),
		'new_item'           => __( 'New Research Highlight', 'ksas' ),
		'view_item'          => __( 'View Research Highlight', 'ksas' ),
		'view_items'         => __( 'View Research Highlights', 'ksas' ),
		'search_items'       => __( 'Search Research Highlights', 'ksas' ),
		'not_found'          => __( 'No Research Highlights found', 'ksas' ),
		'not_found_in_trash' => __( 'No Research Highlights found in Trash', 'ksas' ),
		'all_items'          => __( 'All Research Highlights', 'ksas' ),
		'archives'           => __( 'Research Highlight Archives', 'ksas' ),
		'attributes'         => __( 'Research Highlight Attributes', 'ksas' ),
		'menu_name'          => __( 'Research Highlights', 'ksas' ),
		'item_published'     => __( 'Research Highlight published.', 'ksas' ),
		'item_updated'       => __( 'Research Highlight updated.', 'ksas' ),
	);

	$args = array(
		'label'               => __( 'Research Highlights', 'ksas' ),
		'description'         => __( 'Faculty scholarly news and research features.', 'ksas' ),
		'labels'              => $labels,

		// Visibility.
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,

		// Capabilities.
		'capability_type'     => 'post',
		'map_meta_cap'        => true,

		// REST API / Gutenberg.
		'show_in_rest'        => true,
		'rest_base'           => 'research-highlights',
		'rest_namespace'      => 'ksas/v1',

		// Rewrite + URLs.
		'rewrite'             => array(
			'slug'       => 'research-highlights',
			'with_front' => false,
			'feeds'      => true,
		),
		'has_archive'         => true,
		'query_var'           => true,

		// Menu.
		'menu_icon'           => 'dashicons-lightbulb',
		'menu_position'       => 20,

		// Features.
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
			'custom-fields',
		),
		'delete_with_user'    => false,
		'can_export'          => true,
	);

	register_post_type( 'research-highlight', $args );
}
add_action( 'init', 'ksas_register_post_type', 1 );


/**
 * Modernized taxonomy.
 */
function ksas_register_research_highlight_tax() {

	$labels = array(
		'name'          => __( 'Research Highlight Categories', 'ksas' ),
		'singular_name' => __( 'Research Highlight Category', 'ksas' ),
		'search_items'  => __( 'Search Categories', 'ksas' ),
		'all_items'     => __( 'All Categories', 'ksas' ),
		'edit_item'     => __( 'Edit Category', 'ksas' ),
		'update_item'   => __( 'Update Category', 'ksas' ),
		'add_new_item'  => __( 'Add New Category', 'ksas' ),
		'new_item_name' => __( 'New Category Name', 'ksas' ),
		'menu_name'     => __( 'Research Highlight Categories', 'ksas' ),
	);

	$args = array(
		'hierarchical'       => true,
		'labels'             => $labels,
		'show_ui'            => true,
		'show_admin_column'  => true,

		'public'             => true,
		'publicly_queryable' => true,

		// Editing features.
		'show_in_quick_edit' => true,
		'show_in_rest'       => true,
		'rest_base'          => 'research-highlight-categories',

		'rewrite'            => array(
			'slug'         => 'research-highlights/category',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'research-highlight-category', array( 'research-highlight' ), $args );
}
add_action( 'init', 'ksas_register_research_highlight_tax', 1 );



/**
 * ------------------------------------------
 * Modern Meta Box: Research Highlight Fields
 * ------------------------------------------
 */
function ksas_rh_get_meta_fields() {
	return array(
		array(
			'label' => __( 'Journal Name', 'ksas' ),
			'id'    => 'publication_name',
			'type'  => 'text',
		),
		array(
			'label' => __( 'Publication Date', 'ksas' ),
			'id'    => 'publication_year',
			'type'  => 'text',
		),
		array(
			'label' => __( 'Publication Link', 'ksas' ),
			'id'    => 'publication_link',
			'type'  => 'text',
		),
		array(
			'label' => __( 'Author', 'ksas' ),
			'id'    => 'publication_author',
			'type'  => 'select_people',
		),
		array(
			'label' => __( 'Other Author', 'ksas' ),
			'id'    => 'publication_author_other',
			'type'  => 'text',
		),
	);
}

/**
 * Register meta box.
 */
function ksas_rh_add_meta_box() {
	add_meta_box(
		'ksas_rh_meta',
		__( 'Research Highlight Information', 'ksas' ),
		'ksas_rh_render_meta_box',
		'research-highlight',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'ksas_rh_add_meta_box' );

/**
 * Render meta box contents.
 *
 * @param WP_Post $post The current post object.
 * @return void
 */
function ksas_rh_render_meta_box( $post ) {

	wp_nonce_field( 'ksas_rh_save_meta', 'ksas_rh_meta_nonce' );
	$fields = ksas_rh_get_meta_fields();

	echo '<table class="form-table"><tbody>';

	foreach ( $fields as $field ) {

		$value = get_post_meta( $post->ID, $field['id'], true );
		$value = is_string( $value ) ? $value : '';

		echo '<tr>';
		echo '<th><label for="' . esc_attr( $field['id'] ) . '">' . esc_html( $field['label'] ) . '</label></th>';
		echo '<td>';

		switch ( $field['type'] ) {

			case 'text':
				printf(
					/* translators: 1: field ID, 2: field value */
					'<input type="text" id="%1$s" name="%1$s" value="%2$s" class="regular-text" />',
					esc_attr( $field['id'] ),
					esc_attr( $value )
				);
				break;

			case 'select_people':
				$authors = new WP_Query(
					array(
						'post_type'      => 'people',
						'orderby'        => 'title',
						'order'          => 'ASC',
						'posts_per_page' => -1,
						'no_found_rows'  => true,
					)
				);

				echo '<select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['id'] ) . '">';
				echo '<option value="">' . esc_html__( 'No Author', 'ksas' ) . '</option>';

				foreach ( $authors->posts as $author ) {
					printf(
						/* translators: 1: author ID, 2: selected attribute, 3: author title */
						'<option value="%1$s" %2$s>%3$s</option>',
						esc_attr( $author->ID ),
						selected( $value, $author->ID, false ),
						esc_html( $author->post_title )
					);
				}
				echo '</select>';
				break;
		}

		echo '</td>';
		echo '</tr>';
	}

	echo '</tbody></table>';
}

/**
 * Save meta box fields.
 *
 * @param int $post_id Post ID being saved.
 * @return void
 */
function ksas_rh_save_meta( $post_id ) {

	// Nonce check.
	if ( ! isset( $_POST['ksas_rh_meta_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['ksas_rh_meta_nonce'] ) ), 'ksas_rh_save_meta' ) ) {
		return;
	}

	// Autosave / permissions check.
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = ksas_rh_get_meta_fields();

	foreach ( $fields as $field ) {

		$key = $field['id'];

		if ( ! isset( $_POST[ $key ] ) ) {
			delete_post_meta( $post_id, $key );
			continue;
		}

		// Unsplash/unslash incoming data before sanitization.
		// Use filter_input to safely retrieve the POST value instead of directly accessing $_POST.
		$raw = wp_unslash( filter_input( INPUT_POST, $key, FILTER_UNSAFE_RAW ) ?? '' );

		// Text fields.
		if ( 'text' === $field['type'] ) {
			$val = sanitize_text_field( $raw );
		} elseif ( 'select_people' === $field['type'] ) {
			// People dropdown.
			$val = absint( $raw );
		} else {
			$val = sanitize_text_field( $raw_val );
		}

		update_post_meta( $post_id, $key, $val );
	}
}
add_action( 'save_post_research-highlight', 'ksas_rh_save_meta' );

/**
 * Load Widget Class.
 */
$ksas_rh_widget_path = plugin_dir_path( __FILE__ ) . 'includes/class-research-highlights-widget.php';
if ( file_exists( $ksas_rh_widget_path ) ) {
	require_once $ksas_rh_widget_path;
}
/**
 * Register widget
 */
add_action( 'widgets_init', 'ksas_rh_register_widget' );

/**
 * Register the Research Highlights widget.
 *
 * @return void
 */
function ksas_rh_register_widget() {
	if ( class_exists( 'Research_Highlights_Widget' ) ) {
		register_widget( 'Research_Highlights_Widget' );
	}
}
add_action( 'widgets_init', 'ksas_rh_register_widget' );
