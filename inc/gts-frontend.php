<?php
/**
 * This file displays the testimonials on the front end.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

echo '<div id="gts-testimonials"><div class="wrap">';
echo '<ul class="testimonials-list">';

$loop = new WP_Query( array(
	'post_type' => 'Testimonial',
	'posts_per_page' => -1,
) );

while ( $loop->have_posts() ) : $loop->the_post();

	/**
	 * Opening Markup.
	 */
	function gts_markup_open() {
		echo '<li itemprop="review" itemscope itemtype="http://schema.org/Review">';
	}

	/**
	 * Testimonial Image.
	 */
	function gts_image() {
		if ( has_post_thumbnail() ) {
			echo the_post_thumbnail( 'gts-thumbnail' );
		}
	}

	/**
	 * Testimonial Content.
	 */
	function gts_content() {
		echo '<blockquote itemprop="reviewBody">' . get_the_content() . '</blockquote>';
	}

	/**
	 * Testimonial Title.
	 */
	function gts_title() {
		echo '<h5 itemprop="name">' . get_the_title() . '</h5>';
	}

	/**
	 * Closing Markup.
	 */
	function gts_markup_close() {
		echo '</li>';
	}

	// Add actions to hook.
	add_action( 'gts', 'gts_markup_open' );
	add_action( 'gts', 'gts_image' );
	add_action( 'gts', 'gts_content' );
	add_action( 'gts', 'gts_title' );
	add_action( 'gts', 'gts_markup_close' );

	// Run hook.
	do_action( 'gts' );

endwhile;

wp_reset_postdata();

echo '</ul></div></div>';
