<?php
/**
 * Template Name: Contact Template
 *
 * Displays the contact page template.
 *
 * @package Theme Freesia
 * @subpackage StoreXmas
 * @since StoreXmas 1.0
 */
get_header();
	global $storexmas_settings;
	$storexmas_settings = wp_parse_args(  get_option( 'storexmas_theme_options', array() ),  storexmas_get_option_defaults_values() );
	global $storexmas_content_layout;
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'storexmas_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	} ?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<header class="page-header">
			<h1 class="page-title"><?php the_title();?></h1>
			<!-- .page-title -->
			<?php storexmas_breadcrumb(); ?><!-- .breadcrumb -->
		</header><!-- .page-header -->
		<?php
		if( have_posts() ) {
			while( have_posts() ) {
				the_post();
				if('' != get_the_content()) : ?>
		<div class="googlemaps_widget">
			<div class="maps-container">
				<?php if ( is_active_sidebar( 'storexmas_form_for_contact_page' ) ) :
				dynamic_sidebar( 'storexmas_form_for_contact_page' );
			endif;  ?>
			</div>
		</div> <!-- end .googlemaps_widget -->
		<?php endif; ?>
			<div class="entry-content clearfix">
			<?php 
			the_content();
			comments_template();
				}
			}
			else { ?>
			<h2 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'storexmas' ); ?> </h2>
			<?php
			} ?>
			</div> <!-- end #entry-content -->
		</main> <!-- end #main -->
	</div> <!-- #primary -->
	<?php 
	if( 'default' == $layout ) { //Settings from customizer
		if(($storexmas_settings['storexmas_sidebar_layout_options'] != 'nosidebar') && ($storexmas_settings['storexmas_sidebar_layout_options'] != 'fullwidth')){ ?>
	<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Main Sidebar','storexmas');?>">
	<?php }
	}else{ // for page/ post
			if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
	<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Main Sidebar','storexmas');?>">
		<?php }
		}
		if ( is_active_sidebar( 'storexmas_contact_page_sidebar' ) ) :
			dynamic_sidebar( 'storexmas_contact_page_sidebar' );
		endif;?>
		<?php 
		if( 'default' == $layout ) { //Settings from customizer
			if(($storexmas_settings['storexmas_sidebar_layout_options'] != 'nosidebar') && ($storexmas_settings['storexmas_sidebar_layout_options'] != 'fullwidth')): ?>
	</aside><!-- end #secondary -->
	<?php endif;
		}else{ // for page/post
			if(($layout != 'no-sidebar') && ($layout != 'full-width')){
				echo '</aside><!-- end #secondary -->';
			} 
		} ?>
</div><!-- end .wrap -->
<?php
get_footer();