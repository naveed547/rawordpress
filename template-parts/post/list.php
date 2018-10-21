<div class="row align-items-center">
	<?php if( get_the_post_thumbnail_url()) : ?>
		<div class="col-sm-4">
			<img class="card-img-top" src="<?php the_post_thumbnail_url(); ?>" style="height: 200px; width: 100%; margin:10px auto 40px;display: block;">	
		</div>
	<?php endif; ?>
	<div class="col-sm">
		<h4 class="card-title"<b><?php the_title(); ?></b></h4>
		<p class="card-text"><?php esc_html_e(the_excerpt()); ?></p>
		<p class="read-more-link">
	      <a href="<?php echo esc_url( get_permalink() );?>" title="<?php esc_attr_e( 'READ MORE', 'ratheme1'); ?>">
	        <?php esc_html_e('READ MORE','ratheme1'); ?> <i class="fas fa-arrow-circle-right" "></i>
	      </a>
	    <p>
		<p class="card-text"><small><?php esc_html_e('Last Modified','ratheme1'); ?>: <?php the_modified_time(get_option( 'date_format' )) ?></small></p>
	</div>	
</div>