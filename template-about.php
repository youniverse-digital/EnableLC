<?php /* Template Name: About Page */ 
get_header(); 
get_template_part('inc/banner');
?>
	<div role="main" class="page-content">
		
		<div class="row">
			<div class="content_wrap">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		
		<section class="row">
			<div class="content_wrap">
				<h1 class="page-title"><?php the_title(); ?></h1>		
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
		</section>
			
		
			<?php // features
				// check if the repeater field has rows of data
				if(have_rows('features')){
					echo '<section class="row features"><div class="content_wrap">';
					// loop through the rows of data
						while (have_rows('features')){ 
							the_row();
							// display a sub field value
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
				
					echo '</div></section>';
				} else {
					// no rows found
				}
			?>
			
		<!-- hey dale, i commmented this out because i think it was just for testing right? -->
		<!-- <section class="row dr_test"> 
			<div class="content_wrap">
			<?php
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
			
			?>
			</div>
		</section>	 -->

		<?php // check if the repeater field has rows of data
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
				
			} else {
				// no rows found
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
