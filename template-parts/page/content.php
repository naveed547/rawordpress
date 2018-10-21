<?php
/**
 * Template part for displaying posts
 * @package WordPress
 * @subpackage Naveed Themes
 * @since 1.0
 * @version 1.4
 */

?>


<?php
	$page_id = 8;  //Page ID
	$page_data = get_page( $page_id ); 

	//store page title and content in variables
	$page_title = $page_data->post_title; 
	$page_content = apply_filters('the_content', $page_data->post_content);
	$page_url = str_replace('-150x150.png', '.png?w=715', get_the_post_thumbnail_url($page_id,'thumbnail'));
	$page_video = get_post_meta($page_id, 'Video', TRUE);
	$page_short_content = $page_data->post_excerpt;
?>
<!-- <?php print_r($page_data) ?> -->
<h2 class="ribbon-header right"><?php echo $page_title; ?></h2>
<p><?php echo esc_html($page_data->post_excerpt); ?></p>
<div class="row">
<div class="col-sm-12">
	<iframe class="site-video" src="<?php echo $page_video; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div>
<div class="col-sm-12">
	<img class="img-fluid" src="<?php echo $page_url; ?>" alt="ra_at-a-glance">
</div>
</div>