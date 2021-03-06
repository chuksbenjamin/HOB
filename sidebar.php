<?php
/**
 * The sidebar containing the main Sidebar area.
 *
 * @package Theme Freesia
 * @subpackage StoreXmas
 * @since StoreXmas 1.0
 */
	$storexmas_settings = storexmas_get_theme_options();
	global $storexmas_content_layout;
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'storexmas_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}

if( 'default' == $layout ) { //Settings from customizer
	if(($storexmas_settings['storexmas_sidebar_layout_options'] != 'nosidebar') && ($storexmas_settings['storexmas_sidebar_layout_options'] != 'fullwidth')){ ?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Main Sidebar','storexmas');?>">
<?php }
}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Main Sidebar','storexmas');?>">
  <?php }
	}?>
  <?php 
	if( 'default' == $layout ) { //Settings from customizer
		if(($storexmas_settings['storexmas_sidebar_layout_options'] != 'nosidebar') && ($storexmas_settings['storexmas_sidebar_layout_options'] != 'fullwidth')): ?>
  <?php dynamic_sidebar( 'storexmas_main_sidebar' ); ?>
</aside><!-- end #secondary -->
<?php endif;
	}else{ // for page/post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){
			dynamic_sidebar( 'storexmas_main_sidebar' );
			echo '</aside><!-- end #secondary -->';
		}
	}