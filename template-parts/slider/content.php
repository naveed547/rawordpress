<?php
/**
 * Template part for displaying posts
 * @package WordPress
 * @subpackage Naveed Themes
 * @since 1.0
 * @version 1.4
 */

?>
<?php $pages = array();
  	for ( $count = 1; $count <= 4; $count++ ) {
        $mod = intval( get_theme_mod( 'control-slug' . $count ));
        if ( 'page-none-selected' != $mod ) {
          $page_id = $mod;  //Page ID
		  $page_data = get_page( $page_id ); 
		  $pages[] = $page_data;
        }
  	}
  	/*if( !empty($pages) ) {
        $args = array(
        	'post_type' => 'pages',
          	'post__in' => $pages
        );
        echo "naveed";
        $query = new WP_Query( $args );
        echo $query->have_posts();
        if ( $query->have_posts() ) {
        	echo "naveed";
      		$i = 1;
      		while ($loopy->have_posts()) : $loopy->the_post(); ?>
		        <div class="item"><?php the_title(); 
		              echo '<br ?>';

		        echo '</div>';      
			endwhile; 
        }
        wp_reset_query();
    }*/
?> 
<div class="row justify-content-center">
	<div class="col-10">
		<div id="racarousel" class="carousel slide" data-ride="carousel">
		    <ol class="carousel-indicators">
		      <?php foreach($pages as $key=>$value): ?>
			      <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $key ?>" class="active"></li>
		      <?php endforeach; ?>
		    </ol>
		    <div class="carousel-inner">
		    	<?php foreach($pages as $key=>$value): ?>
					<div <?php if($key == 0){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
						<img class="img-fluid"  alt="First slide [800x400]" src="<?php echo str_replace('-150x150.jpg', '.jpg?w=900', get_the_post_thumbnail_url($pages[$key]->ID,'thumbnail')) ?>" >
						<div class="carousel-caption d-none d-md-block">
						  <h5><?php echo $pages[$key]->post_title ?></h5>
						  <p><?php echo esc_html($pages[$key]->post_excerpt); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
  		</div>
	</div>
</div>