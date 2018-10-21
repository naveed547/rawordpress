<?php
/**
 * Template part for displaying posts
 * @package WordPress
 * @subpackage Naveed Themes
 * @since 1.0
 * @version 1.4
 */

?>
<section>
	<div class="site-banner">
		<div class="site-banner__content container">
			
				<h1 class="site-banner__header"><?php bloginfo( 'name' ); ?></h1>

				<?php $description = get_bloginfo( 'description', 'display' ); ?>
				<?php if ( $description || is_customize_preview() ) : ?>
						<p class="site-banner__desc"><?php echo $description; ?></p>
				<?php endif; ?>
			
			<!-- <div class="site-banner__img">
				<img src="assets/images/ra_content.jpg" />
			</div> -->
			<?php get_template_part( 'template-parts/slider/content' ); ?> 
			<!--  -->
			
		</div>
	</div>
	<div class="welcome-section">
		<div class="container">
			<div class="row top-event-content">
				<div class="col-xs-12 col-sm-6 col-md-5">
					<div class="events-wrap">
						<h3 class="events-wrap__header">Upcoming Events</h3>
						<?php
							$args = array(
							    'post_type' => 'post',
							    'posts_per_page' => 4,
							);

							$loop = new wp_Query($args);
							while($loop->have_posts()) : $loop->the_post();
								get_template_part( 'template-parts/post/content' );
							endwhile;

							wp_reset_query();
						?>
						<!-- <p class="text-center read-more-link"><a href="javascript:void(0)">View All <i class="fas fa-long-arrow-alt-right"></i></a></p> -->
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-7">
					<?php get_template_part( 'template-parts/page/content' ); ?>	
				</div>
			</div>
			<?php get_template_part( 'template-parts/stories' ); ?>
			
		</div>
	</div>
</section>