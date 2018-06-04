<?php /* Template Name: Service Page */ 
	get_header(); 
	
	$page_class = 'colour_'.substr(strtolower(preg_replace('/[^A-Za-z]/', '', get_the_title()) ), 0, 8);

	echo '
		<div class="row">
			<h1 class="content_wrap '.$page_class.'">'.get_the_title().'</h1>
		</div>
	';

	get_template_part('inc/banner');
?>

	<div role="main" class="page-content">
	
		<div class="row">
			<div class="content_wrap">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		
		<?php // Section menu switching code
			$which_menu = get_field('service_menu');
			if ($which_menu != ''){
				echo '
				<section class="row">
					<div class="content_wrap '.$page_class.'">

						<div class="navbar-header service_menu_header '.$page_class.'">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_service" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button><span class="menu_label">Service menu</span>
						</div>

						<div id="navbar_service" class="navbar-collapse collapse">
						';
			
						wp_nav_menu(array(
							'theme_location' => $which_menu,
							'container' => 'div',
							'container_class' => 'collapse navbar-collapse',
							'container_id' => 'navbar_service',
							'menu_class' => 'nav navbar-nav section_menu',
							'fallback_cb' => false
						));
				
						echo '
						</div>
					</div>
				</section>
				';
			}
		?>
				
		<section class="row">
			<div class="content_wrap clearfix">
			
				<div class="col-xs-12 col-sm-8 debug_mh">
					<!-- <h1><?php the_title(); ?></h1> -->		
					<?php 
					
					if (have_posts()): while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
							<br class="clear" />
						</article>
					<?php 
					endwhile;
					else: 
					?>
					<article>
						<h2><?php _e( 'Sorry, nothing to display.', 'enable' ); ?></h2>
					</article>
					<?php endif; ?>
				</div>
				
				<div class="col-xs-12 col-sm-4">
					<div class="social_feed debug_mh">
						<h3>Social feed here</h3>
					</div>
				</div>
				
			</div>
		</section>
			

	
		<?php 
			
		// display multiple feature panels ------------------------------------------------
		//wp_reset_query();
		$show_fp = get_field('dis_ft_pan');
		if ($show_fp == true){
			get_template_part('inc/display_features_pos_2_fw');
		}	

		// Display any full-width features ------------------------------------------------
		$show_fp = get_field('dis_ft_pan');
		if ($show_fp == true){
			get_template_part('inc/display_feature_pos_3');
		}

		// display tabbed panels if they exist ------------------------------------------------
		if (have_rows('tabs')){
			echo '
			<section class="row">
				<div class="content_wrap">
				';
				// tabs first
				echo '<ul class="nav nav-tabs" role="tablist">';
					$count = 0;
					// loop through the rows of data
					while (have_rows('tabs') ){
						the_row();
						// display a sub field value
						$tabID = str_replace(' ', '', get_sub_field('tab_label'));
						echo '<li role="presentation" class="'.($count == 0 ? "active" : "").'"><a href="#'.$tabID.'" aria-controls="'.$tabID.'" role="tab" data-toggle="tab">';
						the_sub_field('tab_label');
						echo '</a></li>';
						$count++;
					}
					echo '</ul>';
				
					// tab content second
					echo '<div class="tab-content">';
						$count = 0;
						while (have_rows('tabs')) { 
							the_row();
							// display a sub field value
							$tabID = str_replace(' ', '', get_sub_field('tab_label'));
							echo '<div role="tabpanel" class="tab-pane'.($count == 0 ? " active" : "").'" id="'.$tabID.'">';
							the_sub_field('tab_content'); 
							echo '</div>';
							$count ++;
						}
						echo '
					</div>
				</div>
			</section>	
			';								
		}


		if (have_rows('locations')){		
			echo '
			<section class="row">
				<div class="content_wrap">
				';
				get_template_part('inc/display_map');							
				echo '
				</div>
			</section>
			';
		}
		?>

		<?php

			$btm_content = get_field('btm_content');
			if ($btm_content != ''){		
				echo '
				<section class="row bottom-content">
					<div class="content_wrap clearfix">
						<div class="col-xs-12">
							'.$btm_content.'
						</div>
					</div>
				</section>
				';
			}
		?>
		
	</div>

<?php get_footer(); ?>
