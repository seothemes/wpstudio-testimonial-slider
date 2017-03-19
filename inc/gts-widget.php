<?php

defined( 'WPINC' ) or die;

add_action( 'widgets_init', 'gts_init_widget' );
function gts_init_widget() {

	register_widget( 'gts_widget' );

}

class gts_widget extends WP_Widget {

	function __construct() {

		parent::__construct(
			'gts_widget',
			__('Testimonials', 'gts-plugin'),
			array( 'description' => __( 'Displays testimonials', 'gts-plugin' ), )
		);

	}

	public function widget( $args, $instance ) {

     	echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

	    include( dirname(__FILE__) . '/gts-frontend.php');

		echo '</div></section>';

	}

	public function form( $instance ) {

		global $title;

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}

		echo '<p>';
		echo '<label for="'. $this->get_field_id( 'title' ) . '">' . _e( 'Title:' ) . '</label>';
		echo '<input class="widefat" id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) .  'type="text" value="' .  esc_attr( $title ) . '">';
		echo '</p>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;

	}
}