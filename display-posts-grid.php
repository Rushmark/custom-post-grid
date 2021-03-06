<?php
/*
Plugin Name: Display Posts Grid
Description: Changes the default behaviour of the Display Posts Plugin to display output in a grid
Version: 0.1
License: GPL
Author: Chris Clarke
Author URI: http://www.chrisclarkewebservices.co.uk
*/


defined( 'ABSPATH' ) || exit;

function dpc_add_styles()
	{
	    // Register the style:
	    wp_register_style( 'dpc-style', plugins_url( '/css/dpc-style.css', __FILE__ ), array(), '20120208', 'all' );

	    // enqueue the style:
	    wp_enqueue_style( 'dpc-style' );
	}
add_action( 'wp_enqueue_scripts', 'dpc_add_styles' );


/**
 * Set Defaults in Display Posts Shortcode
 *
 * @param array $out, the output array of shortcode attributes (after user-defined and defaults have been combined)
 * @param array $pairs, the supported attributes and their defaults
 * @param array $atts, the user defined shortcode attributes
 * @return array $out, modified output
 */
function be_dps_defaults( $out, $pairs, $atts ) {
	$new_defaults = array( 
/*
		'post_type'		=> 'page',
		'post_parent'   => 'current',
		'orderby'		=> 'menu_order',
*/		
		'order'			=> 'ASC',
		'post_title'	=> true,
		'image_size'	=> 'thumbnail',
		'include_excerpt' => false,
// 		'excerpt_dash'	=> false,
/*
		'excerpt_length'=> '40',
		'excerpt_more'	  => " ...Read More",
		'excerpt_more_link' => true,
*/
		'wrapper'			=> 'div',
		
	);
	
	foreach( $new_defaults as $name => $default ) {
		if( array_key_exists( $name, $atts ) )
			$out[$name] = $atts[$name];
		else
			$out[$name] = $default;
	}
	
			$title = '<span class="title">' . get_the_title() . '</span>';
	
	return $out;
	return $title;
}

/** Change order of output and add h2 to header as well as hr at the end of each listing*/

add_filter( 'shortcode_atts_display-posts', 'be_dps_defaults', 10, 3 );

function be_display_posts_move_title( $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class ) {
 
	// Create a new title
	$title = '<a href="' . get_the_permalink() . '"><h2><span class="title">' . get_the_title() . '</span></h2></a>';
	
	// Now let's rebuild the output
	$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $title . $image . $date . $excerpt . $content . '...<hr></' . $inner_wrapper . '>';
 
	// Finally we'll return the modified output
	return $output;
}
add_filter( 'display_posts_shortcode_output', 'be_display_posts_move_title', 10, 9 );

