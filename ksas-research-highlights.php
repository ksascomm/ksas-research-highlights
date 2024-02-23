<?php
/**
 *
 * Adds Research Highlights custom post type.
 *
 * @package      Research_Highlights
 * @author       KSAS Communications
 * @license      GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:  KSAS Research Highlights
 * Plugin URI:   http://krieger.jhu.edu/
 * Description:  Custom post type for Faculty Research Highlights
 * Version:      1.0.0
 * Author:       KSAS Communications
 * Author URI:   mailto:ksasweb@jhu.edu
 * License:      GPL2
 */

/**
 * Register a Research Highlights custom post type.
 *
 * @since 1.0.0
 */
function ksas_register_post_type() {
	$args = array(
		'label'               => esc_html__( 'Research Highlights', 'text-domain' ),
		'labels'              => array(
			'menu_name'          => esc_html__( 'Research Highlights', 'your-textdomain' ),
			'name_admin_bar'     => esc_html__( 'Research Highlight', 'your-textdomain' ),
			'add_new'            => esc_html__( 'Add Research Highlight', 'your-textdomain' ),
			'add_new_item'       => esc_html__( 'Add new Research Highlight', 'your-textdomain' ),
			'new_item'           => esc_html__( 'New Research Highlight', 'your-textdomain' ),
			'edit_item'          => esc_html__( 'Edit Research Highlight', 'your-textdomain' ),
			'view_item'          => esc_html__( 'View Research Highlight', 'your-textdomain' ),
			'update_item'        => esc_html__( 'View Research Highlight', 'your-textdomain' ),
			'all_items'          => esc_html__( 'All Research Highlights', 'your-textdomain' ),
			'search_items'       => esc_html__( 'Search Research Highlights', 'your-textdomain' ),
			'parent_item_colon'  => esc_html__( 'Parent Research Highlight', 'your-textdomain' ),
			'not_found'          => esc_html__( 'No Research Highlights found', 'your-textdomain' ),
			'not_found_in_trash' => esc_html__( 'No Research Highlights found in Trash', 'your-textdomain' ),
			'name'               => esc_html__( 'Research Highlights', 'your-textdomain' ),
			'singular_name'      => esc_html__( 'Research Highlight', 'your-textdomain' ),
		),
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array(
			'slug'       => 'research-highlights',
			'with_front' => false,
		),
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-lightbulb',
		'supports'            => array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
			'excerpt',
		),
	);

	register_post_type( 'research-highlight', $args );
}

add_action( 'init', 'ksas_register_post_type' );
/**
 * Register Custom Taxonomy.
 *
 * @since 1.0.0
 */
add_action(
	'init',
	function() {
		register_taxonomy(
			'research-highlight-category',
			array(
				0 => 'research-highlight',
			),
			array(
				'labels'            => array(
					'name'                       => 'Research Highlight Category',
					'singular_name'              => 'Research Highlight Category',
					'menu_name'                  => 'Research Highlight Category',
					'all_items'                  => 'All Research Highlight Categories',
					'edit_item'                  => 'Edit Research Highlight Category',
					'view_item'                  => 'View Research Highlight Category',
					'update_item'                => 'Update Research Highlight Category',
					'add_new_item'               => 'Add New Research Highlight Category',
					'new_item_name'              => 'New Research Highlight Category Name',
					'search_items'               => 'Search Research Highlight Categories',
					'popular_items'              => 'Popular Research Highlight Categories',
					'separate_items_with_commas' => 'Separate research highlight category with commas',
					'add_or_remove_items'        => 'Add or remove research highlight category',
					'choose_from_most_used'      => 'Choose from the most used research highlight category',
					'not_found'                  => 'No research highlight category found',
					'no_terms'                   => 'No research highlight category',
					'items_list_navigation'      => 'Research Highlight Category list navigation',
					'items_list'                 => 'Research Highlight Category list',
					'back_to_items'              => '← Go to research highlight categories',
					'item_link'                  => 'Research Highlight Category Link',
					'item_link_description'      => 'A link to a research highlight category',
				),
				'public'            => true,
				'show_in_menu'      => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'meta_box_cb'       => false,
				'show_ui'           => true,
				'query_var'         => true,
				'hierarchical'      => true,
			)
		);
	}
);

/**
 * Code for ACF Custom Fields.
 *
 * @since 1.0.0
 */
add_action(
	'acf/include_fields',
	function() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group(
			array(
				'key'                   => 'group_65d795f3e2071',
				'title'                 => 'Research Highlights Meta',
				'fields'                => array(
					array(
						'key'               => 'field_65d7aeae58d4b',
						'label'             => 'Research Highlights: Author',
						'name'              => 'research_highlights_author',
						'aria-label'        => '',
						'type'              => 'group',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'layout'            => 'block',
						'sub_fields'        => array(
							array(
								'key'                  => 'field_65d79613cce0a',
								'label'                => 'Author',
								'name'                 => 'author',
								'aria-label'           => '',
								'type'                 => 'post_object',
								'instructions'         => '',
								'required'             => 0,
								'conditional_logic'    => 0,
								'wrapper'              => array(
									'width' => '50',
									'class' => '',
									'id'    => '',
								),
								'post_type'            => array(
									0 => 'people',
								),
								'post_status'          => '',
								'taxonomy'             => '',
								'return_format'        => 'object',
								'multiple'             => 1,
								'allow_null'           => 0,
								'bidirectional'        => 0,
								'ui'                   => 1,
								'bidirectional_target' => array(),
							),
							array(
								'key'               => 'field_65d79b966bff1',
								'label'             => 'External Author',
								'name'              => 'external_author',
								'aria-label'        => '',
								'type'              => 'text',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '50',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'maxlength'         => '',
								'placeholder'       => '',
								'prepend'           => '',
								'append'            => '',
							),
						),
					),
					array(
						'key'               => 'field_65d7af36a7f15',
						'label'             => 'Research Highlights: Publication',
						'name'              => 'research_highlights_publication',
						'aria-label'        => '',
						'type'              => 'group',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'layout'            => 'block',
						'sub_fields'        => array(
							array(
								'key'               => 'field_65d795f4cce09',
								'label'             => 'Publication Name',
								'name'              => 'publication_name',
								'aria-label'        => '',
								'type'              => 'text',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '33',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'maxlength'         => '',
								'placeholder'       => '',
								'prepend'           => '',
								'append'            => '',
							),
							array(
								'key'               => 'field_65d79683cce0b',
								'label'             => 'Publication Year',
								'name'              => 'publication_year',
								'aria-label'        => '',
								'type'              => 'number',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '33',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'min'               => '',
								'max'               => '',
								'placeholder'       => '',
								'step'              => '',
								'prepend'           => '',
								'append'            => '',
							),
							array(
								'key'               => 'field_65d7969ccce0c',
								'label'             => 'Publication Link',
								'name'              => 'publication_link',
								'aria-label'        => '',
								'type'              => 'url',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '33',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'placeholder'       => '',
							),
						),
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'research-highlight',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);
	}
);
