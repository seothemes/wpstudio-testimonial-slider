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
add_action( 'gts', 'gts_markup_open', 2 );
add_action( 'gts', 'gts_image', 4 );
add_action( 'gts', 'gts_content', 6 );
add_action( 'gts', 'gts_title', 8 );
add_action( 'gts', 'gts_markup_close', 10 );

while ( $loop->have_posts() ) : $loop->the_post();

	// Run hook.
	do_action( 'gts' );

endwhile;

wp_reset_postdata();

echo '</ul></div></div>';
