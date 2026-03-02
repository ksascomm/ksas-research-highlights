<?php
/**
 * Research Highlights Widget Class
 *
 * @package KSAS_Research_Highlights
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Research Highlights Widget
 */
class Research_Highlights_Widget extends WP_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$widget_options = array(
			'classname'   => 'research-highlight',
			'description' => __( 'Displays Research Highlights at random', 'ksas-research-highlights' ),
		);

		parent::__construct(
			'research-highlight-widget',
			__( 'Research Highlights', 'ksas-research-highlights' ),
			$widget_options
		);
	}

	/**
	 * FRONT-END DISPLAY
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$title    = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$quantity = ! empty( $instance['quantity'] ) ? absint( $instance['quantity'] ) : 3;

		// Use the proper theme wrappers.
		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		$query = new WP_Query(
			array(
				'post_type'      => 'research-highlight',
				'posts_per_page' => $quantity,
				'meta_key'       => 'publication_year', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				'orderby'        => 'meta_value_num',
				'order'          => 'DESC',
				'no_found_rows'  => true, // Performance boost since pagination isn't used.
			)
		);

		if ( $query->have_posts() ) :
			?>
			<div class="container research-listings">
				<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				?>
				<article class="single-highlight">

				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail(
						'large',
						array(
							'class' => 'object-cover lg:object-scale-down w-full h-56 my-0',
							'alt'   => esc_html( get_the_title() ),
						)
					);
				}
				?>

					<div class="flex flex-grow">
						<div class="flex flex-col justify-between px-4 py-6 text">
							<div>
								<h3 class="block">
									<?php
									$link = get_post_meta( get_the_ID(), 'publication_link', true );
									if ( $link ) :
										?>
										<a href="<?php echo esc_url( $link ); ?>" aria-label="<?php echo esc_attr__( 'External link:', 'ksas-research-highlights' ) . ' ' . the_title_attribute( array( 'echo' => false ) ); ?>">
											<?php the_title(); ?>
											<i class="fa-sharp fa-solid fa-square-arrow-up-right" aria-hidden="true"></i>
										</a>
									<?php else : ?>
										<a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr__( 'Link to:', 'ksas-research-highlights' ) . ' ' . the_title_attribute( array( 'echo' => false ) ); ?>">
											<?php the_title(); ?>
										</a>
									<?php endif; ?>
								</h3>

								<?php
								$pub_name = get_post_meta( get_the_ID(), 'publication_name', true );
								$pub_year = get_post_meta( get_the_ID(), 'publication_year', true );

								if ( $pub_name ) :
									?>
									<p class="publication-title">
										<em><?php echo esc_html( $pub_name ); ?></em><?php echo $pub_year ? ', ' . esc_html( $pub_year ) : ''; ?>
									</p>
								<?php endif; ?>

								<p><?php echo esc_html( wp_trim_words( get_the_content(), 38, '...' ) ); ?></p>
							</div>

							<div class="button-group">
								<?php
								$categories = get_the_terms( get_the_ID(), 'research-highlight-category' );
								if ( $categories && ! is_wp_error( $categories ) ) :
									foreach ( $categories as $category ) :
										// Manually construct the URL using the category slug.
										$custom_url = home_url( '/research-areas/' . $category->slug . '/' );
										?>
										<a href="<?php echo esc_url( $custom_url ); ?>" aria-label="<?php echo esc_attr__( 'Click to explore', 'ksas-research-highlights' ) . ' ' . esc_attr( $category->name ) . ' ' . esc_attr__( 'Research', 'ksas-research-highlights' ); ?>" class="button">
											<?php
											/* translators: %s: Category Name */
											printf( esc_html__( 'Explore %s Research', 'ksas-research-highlights' ), esc_html( $category->name ) );
											?>
											&nbsp;<span class="fa-solid fa-circle-chevron-right" aria-hidden="true"></span>
										</a>
										<?php
									endforeach;
								endif;
								?>
							</div>
						</div>
					</div>

				</article>
				<?php
			endwhile;
			?>
				</div>
			</div>
			<?php
		endif;

		wp_reset_postdata();
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * UPDATE WIDGET SETTINGS
	 *
	 * @param array $new_instance New settings.
	 * @param array $old_instance Previous settings.
	 * @return array Sanitized updated settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = sanitize_text_field( $new_instance['title'] );
		$instance['quantity'] = absint( $new_instance['quantity'] );
		return $instance;
	}

	/**
	 * ADMIN FORM
	 *
	 * @param array $instance Current values.
	 * @return void
	 */
	public function form( $instance ) {
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$quantity = isset( $instance['quantity'] ) ? absint( $instance['quantity'] ) : 3;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'ksas-research-highlights' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'quantity' ) ); ?>">
				<?php esc_html_e( 'Number of stories to display:', 'ksas-research-highlights' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'quantity' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'quantity' ) ); ?>" type="number" min="1" value="<?php echo esc_attr( $quantity ); ?>">
		</p>
		<?php
	}
}