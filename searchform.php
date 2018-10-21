<?php
/**
 * Template for displaying search forms in suraksha-security-guard
 *
 * @package WordPress
 * @subpackage Naveed Themes
 * @since 1.0
 * @version 0.3
 */

?>

<?php $unique_id = esc_attr( uniqid( "search-form-" ) ); ?>
<div class="row justify-content-center">
    <div class="col-sm-6">
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="search-content">
				<span class="sr-only"><?php echo esc_attr_x( "Search for:", "label", "ratheme1" ); ?></span>
				<input class="form-control" placeholder="<?php esc_html_e('Search here.....','ratheme1'); ?>" value="<?php echo esc_attr(get_search_query() ); ?>" type="search" name="s" />
				<i class='fa fa-search'></i>
			</div>
		</form>
	</div>
</div>
