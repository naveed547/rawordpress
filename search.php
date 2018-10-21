<?php
/**
 * Template part for displaying posts
 * @package WordPress
 * @subpackage Naveed Themes
 * @since 1.0
 * @version 1.4
 */

get_header(); ?>
<section>
	<div class="site-banner">
		<div class="site-banner__content container">
			<h1 class="site-banner__header"><?php bloginfo( 'name' ); ?> -- Search Page</h1>
			<?php get_search_form(); ?>
		</div>
	</div>
	<div class="welcome-section">
		<div class="container">
			<div class="list-page">
				<div class="row">
					<div class="col-sm-7">
						<h2 class="content-page__header ribbon-header left">Search Results</h2>
					</div>
				</div>
				<h2 class="pagetitle">Search Result for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?></h2>
				<div class="list-page__container">
					<?php
						if ( have_posts() ) :
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/list' );

							endwhile; // End of the loop.

							else : ?>

							<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ratheme1' ); ?></p>
							<?php
								get_search_form();

						endif;
					?>
				</div>
				<?php
                    // Previous/next page navigation.
                    /*the_posts_pagination( array(
                        'prev_text'          => __( 'Previous page', 'suraksha-security-guard' ),
                        'next_text'          => __( 'Next page', 'suraksha-security-guard' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'suraksha-security-guard' ) . ' </span>',
                    ) );*/
                    ratheme_pagination();
                ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer();