<?php
/**
 * Front Page Features
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage StoreXmas
 * @since StoreXmas 1.0
 */
/* Frontpage Product Featured Brands */
add_action('storexmas_display_front_page_product_brand','storexmas_frontpage_product_brand');
function storexmas_frontpage_product_brand(){
	$storexmas_settings = storexmas_get_theme_options();
	$storexmas_features_title = $storexmas_settings['storexmas_features_title'];
	$storexmas_features_description = $storexmas_settings['storexmas_features_description'];
	$storexmas_list_product_category	= array();
	for ( $i=1; $i <= $storexmas_settings['storexmas_total_brand_features'] ; $i++ ) {
		if( isset ( $storexmas_settings['storexmas_featured_product_brand_' . $i] ) && $storexmas_settings['storexmas_featured_product_brand_' . $i] !='-' ){

			$storexmas_list_product_category	=	array_merge( $storexmas_list_product_category, array( $storexmas_settings['storexmas_featured_product_brand_' . $i] ) );
		}
	}
	if ( (!empty( $storexmas_list_product_category ) || !empty($storexmas_settings['storexmas_features_title']) || !empty($storexmas_settings['storexmas_features_description'])) && ($storexmas_settings['storexmas_disable_product_brand'] == 0) ) { ?>
			<div class="brand-content-box">
				<div class="wrap">
					<div class="brand-wrap">
					<?php
					if($storexmas_features_title  != '' || $storexmas_features_description != ''){
						echo '<div class="box-header">';
						if($storexmas_features_title  != ''){ ?>
							<h2 class="box-title"><?php echo esc_html($storexmas_features_title );?> </h2>
						<?php }
						if($storexmas_features_description != ''){ ?>
							<p class="box-sub-title"><?php echo esc_html($storexmas_features_description); ?></p>
						<?php }
						echo '</div><!-- end .box-header -->';
					} ?>
					<div class="brand-slider">
						<ul class="slides">
							<?php
								foreach ($storexmas_list_product_category as $category) {
								$category_name = get_term( $category );
								$cat_link = get_category_link( $category );
								$thumbnail_id = get_term_meta( $category, 'thumbnail_id', true );
								$image_attribute =  wp_get_attachment_image_src( $thumbnail_id, 'full' );
									if ( !empty($image_attribute[0]) ) { ?>
									<li>
										<a href="<?php echo esc_url( $cat_link ); ?>" title="<?php echo esc_attr($category_name->name); ?>" target="_blank">
											<img src="<?php echo esc_url( $image_attribute[0] ); ?>" alt="<?php echo esc_attr($category_name->name); ?>" />
										</a>
									</li>
									<?php }
								}; 
								?>
						</ul>
					</div><!-- end .brand-slider -->
				</div><!-- end .brand-wrap -->
			</div><!-- end .wrap -->
		</div><!-- end .brand-content-box -->
	<?php }
wp_reset_postdata();
}

/* Frontpage Product Categories */
add_action('storexmas_display_front_page_product_categories','storexmas_frontpage_product_categories');
function storexmas_frontpage_product_categories(){
	$storexmas_settings = storexmas_get_theme_options();
	$storexmas_categories_features_title = $storexmas_settings['storexmas_categories_features_title'];
	$storexmas_categories_features_description = $storexmas_settings['storexmas_categories_features_description'];
	$storexmas_list_product_category	= array();
	for ( $i=1; $i <= $storexmas_settings['storexmas_total_features'] ; $i++ ) {
		if( isset ( $storexmas_settings['storexmas_featured_category_' . $i] ) && $storexmas_settings['storexmas_featured_category_' . $i] !='-' ){

			$storexmas_list_product_category	=	array_merge( $storexmas_list_product_category, array( $storexmas_settings['storexmas_featured_category_' . $i] ) );
		}
	}
	if ( (!empty( $storexmas_list_product_category ) || !empty($storexmas_settings['storexmas_storexmas_features_title']) || !empty($storexmas_settings['storexmas_storexmas_features_description'])) && ($storexmas_settings['storexmas_disable_product_categories'] == 0) ) { ?>
			<div class="promo-area <?php if($storexmas_settings['storexmas_promo_design_layout'] =='') { echo 'promo-wide-text'; } ?>">
				<div class="promo-wrap">
					<?php
					if($storexmas_categories_features_title  != '' || $storexmas_categories_features_description != ''){
						echo '<div class="box-header">';
						if($storexmas_categories_features_title  != ''){ ?>
							<h2 class="box-title"><?php echo esc_html($storexmas_categories_features_title );?> </h2>
						<?php }
						if($storexmas_categories_features_description != ''){ ?>
							<p class="box-sub-title"><?php echo esc_html($storexmas_categories_features_description); ?></p>
						<?php }
						echo '</div><!-- end .box-header -->';
					} ?>
					<div class="column clearfix">
					<?php

						foreach ($storexmas_list_product_category as $category) {

							$category_name = get_term( $category );
							$cat_link = get_category_link( $category );
							$thumbnail_id = get_term_meta( $category, 'thumbnail_id', true );
							$promo_image_attribute =  wp_get_attachment_image_src( $thumbnail_id, 'full' );
							if (!empty ($category_name)){ ?>
							<div class="three-column">
								<?php if ( !empty($promo_image_attribute[0] )) { ?>
								<div class="promo-img">
								<a class="promo-link" href="<?php echo esc_url( $cat_link ); ?>">
									<img src="<?php echo esc_url( $promo_image_attribute[0] ); ?>" alt="<?php echo esc_attr($category_name->name); ?>" />
									</a>
								</div>
								<?php } ?>
								<div class="promo-all-text">
									<h4><a title="<?php echo esc_attr($category_name->name); ?>" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $category_name->name ); ?></a></h4>
									<p><?php echo category_description($category); ?></p>
								</div>
							</div> <!-- end .three-column -->
						<?php }
					}; ?>
					</div><!-- .end column-->
				</div><!-- end .promo-wrap -->
			</div><!-- end .promo-area -->
		<?php }
	wp_reset_postdata();
}