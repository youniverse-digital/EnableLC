<?php /* Template Name: Main Page */ 
	get_header(); 
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
					<div class="content_wrap">

						<div class="navbar-header service_menu_header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_service" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
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
		<section class="row column_wrapper">
			<div class="content_wrap clearfix">
				<h1 class="page-title"><?php the_title(); ?></h1>
				<div class="col-sm-8">
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
						<?php endif; 
					?>

					<?php
						//display a social feed if selected 
						$twitterfeed = get_field('twitter_feed');
						$facebook_feed = get_field('facebook_feed');
						$position = get_field('side_main');

						if($twitterfeed && $position == 'main'){
							echo '<div class="social_feed main">';
								echo $twitterfeed;
							echo '</div>';
						}

						if($facebook_feed && $position == 'main'){
							echo '<div class="social_feed main">';
								echo $facebook_feed;
							echo '</div>';
						}
					?>
					<?php 
				if(have_rows('add_accordion')){
					$count = 1;
					echo '
					<section class="row">
						<div class="content_wrap">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								';
								while (have_rows('add_accordion') ){
									the_row();
									$count++;
									echo '
									<div class="panel panel-default">
										<div class="panel-heading '.$page_class.'" role="tab" id="heading'.$count.'">
											<h4 class="panel-title">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$count.'" aria-expanded="false" aria-controls="'.$count.'">
													'.get_sub_field('title').'
												</a>
											</h4>
										</div>
										
										<div id="'.$count.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$count.'">
											<div class="panel-body">'.get_sub_field('content').'</div>
										</div>
									</div>';
								}

							echo '
						</div>
					</div>
				</section>
					';
				}
				?>
				</div>
				
				<div class="col-sm-4">
					<?php
						//display a social feed if selected 
						$twitterfeed = get_field('twitter_feed');
						$facebook_feed = get_field('facebook_feed');
						$position = get_field('side_main');

						if($twitterfeed && $position == 'side'){
							echo '<div class="social_feed side">';
								echo $twitterfeed;
							echo '</div>';
						}	

						if($facebook_feed && $position == 'side'){
							echo '<div class="social_feed side">';
								echo $facebook_feed;
							echo '</div>';
						}
					?>
				</div>
				
			</div>
		</section>


			<?php // display any maps
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
		$contact_form = get_field('show_contact_form');
		if ($contact_form == true){		
			get_template_part('inc/display_form');							
		}
		?>
		
	
		<?php // display full-width feature panels if they exist
			if (get_field('fw_feature') || get_field('fw_feature_image')){
				echo '
				<section id="feature_fw" class="row">
					<div class="content_wrap">
						<div class="col-xs-12 feature_wrap">
							<div class="feature-inner clearfix">
							';
								if(get_field('fw_feature')){
									echo '<div class="col-xs-12 col-sm-6">'.get_field('fw_feature').'</div>';
								}
	
								// Keys: [id],[url],[width],[height],[sizes] > [thumbnail]([thumbnail-width],[thumbnail-height]),[medium](..),[large](;;)
								$dr_image = get_field('fw_feature_image');
								$dr_display_size = 'large'; 
								if (!empty($dr_image)){
									echo '
									<div class="col-xs-12 col-sm-6">
										<img class="fw_image" src="'.$dr_image['sizes'][$dr_display_size].'" alt="'.$dr_image['alt'].'" />
										';
										if ($dr_image['caption']){
											echo '<p class="fw_image_caption">'.$dr_image['caption'].'</p>';
										}
										echo '
									</div>
									';
								}
							echo '
							</div>
						</div>
					</div>
				</section>
				';
			}
		?>
	


		<?php // display tabbed panels if they exist
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
		?>



		<?php //display multiple features panels if they exist
			$haveTwoColumnFeature = 0;
			$columnClass = 'col-xs-12 col-sm-4 feature_wrap';

			if(have_rows('features')){
				echo '
				<section id="feature_multi" class="row">
					<div class="content_wrap clearfix">
					';

					// loop through the rows of data
					while (have_rows('features')){ 
						the_row();
						//print_r(get_sub_field_object('use_two_columns'));
						$num_of_cols = intval(get_sub_field_object('use_two_columns')['value']);
						if ($haveTwoColumnFeature == 0 && $num_of_cols == 1){
							$haveTwoColumnFeature = 1;
							$columnClass = 'col-xs-12 col-sm-8 feature_wrap';
						} else {
							$columnClass = 'col-xs-12 col-sm-4 feature_wrap';
						}
						// display a sub field value
						echo '
						<div class="single_feature '.$columnClass.'">
							<div class="feature-inner clearfix">
							';
							// display feature text
							if ($num_of_cols == 1){
								echo '<div class="col-xs-12 col-sm-6">';
							}
			
							echo '<h2>'.get_sub_field('feature_headline').'</h2>'.get_sub_field('feature_text'); 
			
							if (get_sub_field('feature_link') != '') {
								echo '<a href="'.get_sub_field('feature_link').'" title="Click for more information">Read more</a>';
							}

							if ($num_of_cols == 1){
								echo '</div>';
							}
			
							// display image if it exists
							$feature_image = get_sub_field('feature_image');
							$feature_display_size = 'large'; 
							if (!empty($feature_image)){
								if ($num_of_cols == 1){
									echo '<div class="col-xs-12 col-sm-6">';
								}
				
								echo '<img src="'.$feature_image['sizes'][$feature_display_size].'" alt="'.$feature_image['alt'].'" />';

								if ($num_of_cols == 1){
									echo '</div>';
								}

							}
							echo '
							</div>
						</div>
						';
					}
				}
				echo '
				</div>
			</section>	
			';
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
