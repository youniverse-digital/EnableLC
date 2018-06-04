<?php /* Template Name: Service subpage with form */ 
	get_header(); 

	// get the title of the parent page
	$ancestors = get_ancestors( $post->ID, 'page' ); 
	$parent_page_title = get_the_title( end( $ancestors ) );
	$page_class = 'colour_'.substr(strtolower(preg_replace('/[^A-Za-z]/', '', $parent_page_title) ), 0, 8);
	$page_id = 'page_'.substr(strtolower(preg_replace('/[^A-Za-z]/', '', $parent_page_title) ), 0, 8);
	
	$GLOBALS['pID'] = $ancestors;
	
	echo '
		<div class="row">
			<h1 class="content_wrap '.$page_class.'">'.$parent_page_title.'</h1>
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
				
		<section class="row">
			<div class="content_wrap">
				<h2><?php the_title(); ?></h2>		
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
		
		<?php
		$contact_form = get_field('show_contact_form');
		if ($contact_form == true){		
			get_template_part('inc/display_form');							
		}
		?>
			

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
