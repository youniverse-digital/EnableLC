<?php /* Template Name: About - Subpage Page */ 
get_header(); 
get_template_part('inc/banner');
?>
	<div role="main" class="page-content">
		
		<div class="row">
			<div class="content_wrap">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>

		<div class="column_wrapper row">
			<?php 
				if(!get_field('hide_heading')){
					if(get_field('alt_title') == ''){
						echo '<h2 class="page-title">'.get_the_title().'</h2>';
					}else {
						$title = get_field('alt_title');
						echo '<h2 class="page-title">'.$title.'</h2>';
					}
				}
			?>		

			<section class="">
				<div class="content_wrap clearfix">
					<div class="col-xs-12">

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
								<h2><?php _e( 'Sorry, nothing to display.', 'Enable' ); ?></h2>
							</article>
						<?php endif; ?>	
					</div>
				</div>
			</section>



			<?php

				// check if the flexible content field has rows of data
				if( have_rows('add_a_block') ){
				     // loop through the rows of data
				     echo '
						<section class="row">
							<div class="content_wrap">
								<div class="col-xs-12">
							';
								    while ( have_rows('add_a_block') ) {
								    	the_row();	

								        if( get_row_layout() == 'text_left_image_right' ){
								        	echo '<div class="col-xs-12 alternating-cols"><div class="col-sm-8">';
									        	$content = get_sub_field('content');
									        	echo $content;
									        echo '</div><div class="col-sm-4">';
									        	$image = get_sub_field('image');
									        	echo '<img src="'.$image['sizes']['large'].'" class="alignright">'; 
									        echo '</div>';
									        echo '</div>';							        	

								        }else if( get_row_layout() == 'text_right_image_left' ){
								        	echo '<div class="col-xs-12 alternating-cols"><div class="col-sm-4">';
									        	$image = get_sub_field('image');
									        	echo '<img src="'.$image['sizes']['large'].'">'; 
									        echo '</div><div class="col-sm-8">';
									        	$content = get_sub_field('content');
									        	echo $content;
									        echo '</div>';
									        echo '</div>';	
								        	
								        }else if ( get_row_layout() == 'full_width_content'){
								        	echo '<div class="col-xs-12 full-width-col">';
									        	$content = get_sub_field('content');
									        	echo $content;
									        echo '</div>';	
								        }
								    }

				    echo '
								</div>
							</div>
						</section>	
						';

				}else {
					
				}

			?>

			<?php 
				if(have_rows('btn_grid')){
					echo '
						<section class="row">
							<div class="content_wrap">
								<div class="col-xs-12 full-width-col">
							';

							$size = get_field('grid_size');
							while (have_rows('btn_grid')) {
								the_row();
								echo '
									<a href="'.get_sub_field('link').'">
										<div class="'.$size.' btn-grid">
											<img src="'.get_sub_field('image').'">
											<div>'.get_sub_field('content').'</div>
										</div>
									</a>
								';
							}
					echo '
								</div>
							</div>
						</section>	
						';
				}
			?>

			
			<?php // feature panels
				// check if the repeater field has rows of data
				if(have_rows('features')){
					echo '
					<section class="features">
						<div class="content_wrap">
							<div class="col-xs-12">
						';
							while (have_rows('features')){ 
								the_row();
								?>
								<div class="col-md-4">
									<a href="<?php the_sub_field('feature_link'); ?>">
									<?php 
									$Fimage = get_sub_field('feature_icon');
									if($Fimage){
										echo '<img src="'. $Fimage .'" alt="">';
									}
									?>
									<h2><?php the_sub_field('feature_text'); ?></h2></a>
								</div>
							<?php
						}
						echo '
							</div>
						</div>
					</section>	
					';
				} else {
					// no rows found
				}
			?>
		
			<?php // DR features (!)
			if(get_field('dr_01') || get_field('about_us_image')){
				echo '
				<section class="dr_test">
					<div class="content_wrap">
						<div class="col-xs-12">
					';
					
						if(get_field('dr_01')){
							echo '<p>' . get_field('dr_01') . '</p>';
						}
			
						// Keys: [id],[url],[width],[height],[sizes] > [thumbnail]([thumbnail-width],[thumbnail-height]),[medium](..),[large](;;)
						$dr_image = get_field('about_us_image');
						$dr_display_size = 'large'; 
						if (!empty($dr_image)){
							echo '<img src="'.$dr_image['sizes'][$dr_display_size].'" alt="'.$dr_image['alt'].'" />';
						}
			
						if ($dr_image['caption']){
							echo '<p>Caption: '.$dr_image['caption'].'</p>';
						}
			
						if ($dr_image['description']){
							echo '<p>Description: '.$dr_image['description'].'</p>';
						}
			
						if ($dr_image['title']){
							echo '<p>Title: '.$dr_image['title'].'</p>';
						}
						
					echo '
						</div>
					</div>
				</section>	
				';
			}
			?>
		
		<?php // check if the repeater field has rows of data
			if (have_rows('tabs')){
				echo '
				<section class="">
					<div class="content_wrap">
						<div class="col-xs-12">
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
					</div>
				</section>	
				';								
				
			} else {
				// no rows found
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
							    	<div class="panel-heading" role="tab" id="heading'.$count.'">
							    	  <h4 class="panel-title">
							        	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$count.'" aria-expanded="false" aria-controls="'.$count.'">
								          '.get_sub_field('title').'
								        </a>
								      </h4>
								    </div>
								    <div id="'.$count.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$count.'">
							      		<div class="panel-body">
								        	'.get_sub_field('content').'
								      	</div>
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
	</div>
	
<?php get_footer(); ?>
