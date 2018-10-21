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
	<div class="site-banner" <?php if( get_the_post_thumbnail_url()) : ?> echo style="background-image: url(<?php the_post_thumbnail_url(); ?>);" <?php endif; ?>>
		<div class="site-banner__content container">
			<h1 class="site-banner__header"><?php bloginfo( 'name' ); ?></h1>
			<?php $description = get_bloginfo( 'description', 'display' ); ?>
			<?php if ( $description || is_customize_preview() ) : ?>
				<p class="site-banner__desc"><?php echo $description; ?></p>
			<?php endif; ?>
		</div>
	</div>
	<?php $quickLinks = post_bkmarks_get_post_links(get_the_ID());
		$attachments = new Attachments( 'attachments' ); 
		$videoGallery = get_post_meta(get_the_ID(), 'VideoGallery', TRUE);
		$videoGallery = strlen($videoGallery) ? explode(',',$videoGallery) : [];
		$imageGallery = get_post_meta(get_the_ID(), 'ImageGallery', TRUE);
		$imageGallery = strlen($imageGallery) ? explode(',',$imageGallery) : [];
		$rightContentExist = count($quickLinks) > 0 || $attachments->exist() || count($videoGallery) > 0 || count($imageGallery) > 0 ;?>
	 <div class="welcome-section">
		<div class="container">
			<div class="content-page">
				<div class="row">
					<div class="<?php echo $rightContentExist ? 'col-sm-7': 'col-sm-12' ?>">
						<h2 class="content-page__header ribbon-header <?php echo $rightContentExist ? 'left': 'left right' ?>"><?php the_title(); ?></h2>
					</div>
				</div>
				<div class="content-page__container two-column-layout">
					<div class="row">
						<div class="<?php echo $rightContentExist ? 'col-sm-8' : 'col-sm-12' ?>">
							<?php if( get_the_post_thumbnail_url()) : ?>
								<img class="card-img-top img-fluid" src="<?php the_post_thumbnail_url('large'); ?>" style="max-height: 400px;margin:10px auto 40px;display: block;width: auto">
							<?php endif; ?>
							<?php			
								the_content();
							?>
							<p class="card-text">
								<small class="text-muted"><?php esc_html_e('Last Modified','ratheme1'); ?>: <?php the_modified_time(get_option( 'date_format' )) ?></small>
							</p>
						</div>
						<?php if($rightContentExist) : ?>
							<div class="col-sm-4">
								<div class="row recent-updates">
									<div class="col-sm-12">
										
										<?php if( count($quickLinks) > 0 ) : ?>
											<div class="events-wrap">
												<h3 class="ribbon-header right">Quick Links</h3>
												<?php foreach($quickLinks as $link): ?>
													<div class="row mx-0">
															<div class="col-sm-12">
																<a href="<?php echo $link->link_url ?>" target="<?php echo $link->link_target ?>">
																	<?php echo $link->link_name ?> <i class="fas fa-angle-double-right"></i>
																</a>
															</div>
														</div> 
												<?php endforeach ?>
											</div>
										<?php endif; ?>
										<?php if( $attachments->exist() ) : ?>
											<div class="events-wrap">
											  	<h3 class="ribbon-header right">Documents</h3>
											    <?php while( $attachments->get() ) : ?>
													<div class="row align-items-center mx-0">
														<div class="col-auto">
															<i class="fas fa-file-<?php echo $attachments->subtype(); ?>"></i>
														</div>
														<div class="col">
															<a href="<?php echo $attachments->url(); ?>">
																<?php echo $attachments->field( 'title' ); ?>
															</a>
														</div>
													</div>
											    <?php endwhile; ?>
											</div>
										<?php endif; ?>
										<?php if( count($videoGallery) > 0 ) : ?>
											<div class="events-wrap">
												<h3 class="ribbon-header right">Video Gallery</h3>
												<?php foreach($videoGallery as $key=>$videoLink): ?>
													<div class="row mx-0">
															<div class="col-sm-12">
																<a href="<?php echo $videoLink ?>" target="_blank">
																	Video <?php echo ($key+1) ?> <i class="fas fa-angle-double-right"></i>
																</a>
															</div>
														</div> 
												<?php endforeach ?>
											</div>
										<?php endif; ?>
										<?php if( count($imageGallery) > 0 ) : ?>
											<div class="events-wrap">
												<h3 class="ribbon-header right">Image Gallery</h3>
												<?php foreach($imageGallery as $key=>$imageLink): ?>
													<div class="row mx-0">
															<div class="col-sm-12">
																<a href="<?php echo $imageLink ?>" target="_blank">
																	Image <?php echo ($key+1) ?> <i class="fas fa-angle-double-right"></i>
																</a>
															</div>
														</div> 
												<?php endforeach ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		</div>
	</div> 
</section>