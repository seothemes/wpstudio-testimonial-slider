<?php

defined( 'WPINC' ) or die;

function wps_carouselle(){

	ob_start();

	echo '<div id="gts-testimonials"><div class="wrap"><ul class="testimonials-list">';

    $loop = new WP_Query( array(
    	'post_type' => 'Testimonial',
    	'posts_per_page' => -1 )
    );

    while ( $loop->have_posts() ) : $loop->the_post();

    echo '<li>';

    if ( has_post_thumbnail() ) {

        echo the_post_thumbnail('gts-thumbnail');

    }

    echo '<blockquote>' . get_the_content() . '</blockquote>';
    echo '<h5>' . get_the_title() . '</h5>';
    echo '</li>';

    endwhile;

    echo '</ul></div></div>';

     wp_reset_query();

     $data = ob_get_clean();

    return $data;

}

add_shortcode( 'gts-slider', 'wps_carouselle' );