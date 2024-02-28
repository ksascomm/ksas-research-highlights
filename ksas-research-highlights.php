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
 * Version:      2.0.0
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
 * Code for Custom Fields.
 *
 * @since 1.0.0
 */
$research_highlights_5_metabox = array(
	'id'       => 'research_highlights',
	'title'    => 'Research Highlight Information',
	'page'     => array( 'research-highlight' ),
	'context'  => 'normal',
	'priority' => 'default',
	'fields'   => array(

		array(
			'name'        => 'Publication Name',
			'desc'        => '',
			'id'          => 'publication_name',
			'class'       => 'publication_name',
			'type'        => 'text',
			'rich_editor' => 0,
			'max'         => 0,
			'std'         => '',
		),

		array(
			'name'        => 'Publication Date',
			'desc'        => '',
			'id'          => 'publication_year',
			'class'       => 'publication_year',
			'type'        => 'text',
			'rich_editor' => 0,
			'max'         => 0,
			'std'         => '',
		),
		array(
			'name'        => 'Publication Link',
			'desc'        => '',
			'id'          => 'publication_link',
			'class'       => 'publication_link',
			'type'        => 'text',
			'rich_editor' => 0,
			'max'         => 0,
			'std'         => '',
		),
		array(
			'name'        => 'Author',
			'desc'        => '',
			'id'          => 'publication_author',
			'class'       => 'publication_author',
			'type'        => 'select',
			'rich_editor' => 0,
			'max'         => 0,
			'std'         => '',
		),
		array(
			'name'        => 'Other Author',
			'desc'        => '',
			'id'          => 'publication_author_other',
			'class'       => 'publication_author_other',
			'type'        => 'text',
			'rich_editor' => 0,
			'max'         => 0,
			'std'         => '',
		),
	),
);

/* Meta box setup action. */
add_action( 'admin_menu', 'ecpt_add_research_highlights_5_meta_box' );

/**
 * Meta box setup function.
 */
function ecpt_add_research_highlights_5_meta_box() {

	global $research_highlights_5_metabox;

	foreach ( $research_highlights_5_metabox['page'] as $page ) {
		add_meta_box( $research_highlights_5_metabox['id'], $research_highlights_5_metabox['title'], 'ecpt_show_research_highlights_5_box', $page, 'normal', 'default', $research_highlights_5_metabox );
	}
}

/**
 * Function to show meta boxes
 */
function ecpt_show_research_highlights_5_box() {
	global $post;
	global $research_highlights_5_metabox;

	// Use nonce for verification.
	echo '<input type="hidden" name="ecpt_research_highlights_5_meta_box_nonce" value="', wp_create_nonce( basename( __FILE__ ) ), '" />';

	echo '<table class="form-table">';

	foreach ( $research_highlights_5_metabox['fields'] as $field ) {
		// get current post meta data.
		$meta = get_post_meta( $post->ID, $field['id'], true );

		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td class="ecpt_field_type_' . str_replace( ' ', '_', $field['type'] ) . '">';
		switch ( $field['type'] ) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'select':
				$author_select_query = new WP_Query(
					array(
						'post_type'      => 'people',
						'meta_key'       => 'ecpt_people_alpha',
						'tax_query'      => array(
							'relation' => 'OR',
							array(
								'taxonomy' => 'role',
								'field'    => 'slug',
								'terms'    => array( 'adjunct-faculty' ),
							),
							array(
								'taxonomy' => 'role',
								'field'    => 'slug',
								'terms'    => array( 'faculty', 'aa-faculty', 'ae-visiting' ),
							),
						),
						'orderby'        => 'meta_value',
						'order'          => 'ASC',
						'posts_per_page' => '-1',
					)
				);
				$authors             = $author_select_query->get_posts();
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				echo '<option name="no-author" value="no-author" selected="selected"></option>';
				foreach ( $authors as $author ) {
					echo '<option value="' . $author->ID . '"', $meta == $author->ID ? ' selected="selected"' : '', '>', $author->post_title, '</option>';
				}
				echo '</select>';
				break;
			case 'select2':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ( $field['options'] as $option ) {

					echo '<option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;';
				echo $field['desc'];
				break;
		}
		echo '<td>',
			'</tr>';
	}

	echo '</table>';
}

/**
 * Save data from meta box
 */
function ecpt_research_highlights_5_save( $post_id ) {
	global $post;
	global $research_highlights_5_metabox;

	/* Verify the nonce before proceeding. \*/
	if ( ! isset( $_POST['ecpt_research_highlights_5_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['ecpt_research_highlights_5_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	/* Check Autosave. \*/
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	/* Get the post type object. \*/
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. \*/
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	foreach ( $research_highlights_5_metabox['fields'] as $field ) {

		$old = get_post_meta( $post_id, $field['id'], true );
		$new = $_POST[ $field['id'] ];

		if ( $new && $new != $old ) {
			if ( $field['type'] == 'date' ) {
				$new = ecpt_format_date( $new );
				update_post_meta( $post_id, $field['id'], $new );
			} else {
				if ( is_string( $new ) ) {
					$new = $new;
				}
				update_post_meta( $post_id, $field['id'], $new );

			}
		} elseif ( '' == $new && $old ) {
			delete_post_meta( $post_id, $field['id'], $old );
		}
	}
}
add_action( 'save_post', 'ecpt_research_highlights_5_save' );

/*
 *
 * Research Highlights Widget
 *
 */
add_action( 'widgets_init', 'ksas_load_research_highlights_widget' );

/** Register Widget */
function ksas_load_research_highlights_widget() {
	register_widget( 'Research_Highlights_Widget' );
}

/** Set up the widget in the WP Admin area so that it has it's own unique identifier and a title and description. */
class Research_Highlights_Widget extends WP_Widget {
	/** The first parameter passed to parent::__construct() is a string representing the id of this widget */
	public function __construct() {
		$widget_options  = array(
			'classname'   => 'research-highlight',
			'description' => __( 'Displays Research Highlights at random', 'research-highlight' ),
		);
		$control_options = array(
			'width'   => 300,
			'height'  => 350,
			'id_base' => 'research-highlight-widget',
		);
		parent::__construct( 'research-highlight-widget', __( 'Research Highlights', 'research-highlight' ), $widget_options, $control_options );
	}

	/** Widget Display */
	public function widget( $args, $instance ) {
		/* Our variables from the widget settings. */
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$quantity = $instance['quantity'];
		echo $args['before_widget'];

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		$research_highlights_widget_query = new WP_Query(
			array(
				'post_type'      => 'research-highlight',
				'posts_per_page' => $quantity,
				'orderby'        => 'rand',
			)
		);
		if ( $research_highlights_widget_query->have_posts() ) : ?>
		<div class="book-listings">
			<?php
			while ( $research_highlights_widget_query->have_posts() ) :
				$research_highlights_widget_query->the_post();
				global $post;
				?>
				<article class="grid-x" aria-labelledby="book-<?php the_ID(); ?>">
					<div class="cell">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'large', array( 'alt' => esc_html( get_the_title() ) ) );  }
					?>
					<h5>
					<?php
					if ( get_post_meta( $post->ID, 'publication_link', true ) ) :
						?>
						<a href="<?php echo esc_url( get_post_meta( $post->ID, 'publication_link', true ) ); ?>" id="book-<?php the_ID(); ?>"><?php the_title(); ?> <i class="fa-sharp fa-solid fa-square-arrow-up-right"></i></a>
						<?php else : ?>
						<a href="<?php the_permalink(); ?>" id="book-<?php the_ID(); ?>"><?php the_title(); ?><span class="link"></span></a>
						<?php endif; ?>
					</h5>
					<ul>
					<?php
					if ( get_post_meta( $post->ID, 'publication_name', true ) ) :
						?>
						<li><?php echo esc_html( get_post_meta( $post->ID, 'publication_name', true ) ); ?>, <?php echo esc_html( get_post_meta( $post->ID, 'publication_year', true ) ); ?></li>
					<?php endif; ?>
					<?php
					$faculty_post_id = get_post_meta( $post->ID, 'publication_author', true );
					if ( get_post_meta( $post->ID, 'publication_author', true ) ) :
						?>
						<li>
						<?php echo esc_html( get_the_title( $faculty_post_id ) ); ?>
						<?php if ( get_post_meta( $post->ID, 'publication_author_other', true ) ) : ?>
							and <?php echo esc_html( get_post_meta( $post->ID, 'publication_author_other', true ) ); ?>
						<?php endif; ?>
						</li>
					<?php endif; ?>
					</ul>
					<p>
						<?php echo wp_trim_words( get_the_excerpt(), 45, '...' ); ?>
					</p>
					</div>
				</article>
				<?php
		endwhile;
			?>
		</div>
			<?php
		endif;
		echo $args['after_widget'];
	}

	/** Update/Save the widget settings. */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title']    = wp_strip_all_tags( $new_instance['title'] );
		$instance['quantity'] = wp_strip_all_tags( $new_instance['quantity'] );
		return $instance;
	}

	/** Widget Options */
	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title'    => __( 'Research Highlights', 'research-highlight' ),
			'quantity' => __( '3', 'research-highlight' ),
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'hybrid' ); ?></label>
			<input id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>" style="width:100%;" />
		</p>

		<!-- Number of Stories: Text Input -->
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'quantity' ) ); ?>"><?php esc_html_e( 'Number of stories to display:', 'research-highlight' ); ?></label>
			<input id="<?php echo esc_html( $this->get_field_id( 'quantity' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'quantity' ) ); ?>" value="<?php echo esc_html( $instance['quantity'] ); ?>" style="width:100%;" />
		</p>

		<?php
	}
}

?>
