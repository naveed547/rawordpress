<?php
/*
 * Template Name: Featured Article
 * Template Post Type: post, page, product
 */

get_header();
while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content-pages', 'page' );

	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
get_footer(); ?>