<?php /* Template Name: Service menu test */ 
	get_header(); 

	// get the title of the parent page
	// $parent_page_title = empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent );
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

	<div id="<?php echo $page_id; ?>" role="main" class="page-content">
	
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
							'link_before' => '<span>',     
							'link_after'  => '</span>',
							'fallback_cb' => false
						));
				
						echo '
						</div>
					</div>
				</section>
				';
			}
		?>
		
		<div class="column_wrapper row">
			<?php 
				if(get_field('alt_title') == ''){
					echo '<h2 class="page-title">'.get_the_title().'</h2>';
				}else {
					$title = get_field('alt_title');
					echo '<h2 class="page-title">'.$title.'</h2>';
				}
			?>	
			
			<div id="column_1" class="col-xs-12 col-sm-9">
				<section>
					<div class="content_wrap">
							
							<?php 
							
// 							echo '<p>parental IDs (global): ';
// 							print_r($GLOBALS['pID']);
// 							echo '</p>';
// 							echo '<p>Page ID: '.$post->ID.'</p>';
							
							if (have_posts()): while (have_posts()) : the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<?php the_content(); ?>
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
				
				<?php //display features panels if they exist
				$show_fp = get_field('dis_ft_pan');
				if ($show_fp == true){
					get_template_part('inc/display_feature_pos_2');
				}	
				

				// Display tabs if they exist
				if (have_rows('tabs')){
					echo '
					<section>
						<div class="content_wrap tabs_wrapper">
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


				<?php // display any maps
				if (have_rows('locations')){		
					echo '
					<section class="map_wrap">
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

				<?php 
					if(have_rows('add_gall')){
						$size = get_field('gall_size');
						while (have_rows('add_gall')) {
							the_row();
							echo '
								<div class="'.$size.'">
									<img src="'.get_sub_field('image').'">
									'.get_sub_field('content').'
								</div>

							';
						}
					}
				?>

				<?php 
					if(have_rows('btn_grid')){
						$size = get_field('grid_size');
						while (have_rows('btn_grid')) {
							the_row();
							echo '
								
									<div class="'.$size.' btn-grid">';

										if(get_sub_field('link') != ''){
											echo '<a href="'.get_sub_field('link').'">';
										}
										
											echo '<img src="'.get_sub_field('image').'">';

										if(get_sub_field('link') != ''){
											echo '</a>';
										}
										
										echo '<div>'.get_sub_field('content').'</div>
									</div>
								
							';
						}
					}
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

					$btm_content = get_field('btm_content');
					if ($btm_content != ''){		
						echo '
						<section class="bottom-content">
							<div class="content_wrap">
								<article>
									'.$btm_content.'
								</article>
							</div>
						</section>
						';
					}
				?>

			</div>
			
			<div id="column_2" class="col-xs-12 col-sm-3">
				<section>
					<div class="content_wrap">
						<?php 
							
							// display menu of child pages
							if (is_page()) {
								$children = '';
								if(count($GLOBALS['pID']) > 1) {
									// $children .= wp_list_pages("title_li=&depth=1&child_of=".$post->ID."&echo=0");
									// $children .= wp_list_pages("title_li=&depth=-1&child_of=".$post->ID."&parent=".$post->ID."&echo=0");
									$children .= wp_list_pages("title_li=&depth=2&child_of=".$post->post_parent."&echo=0");
									$children .= wp_list_pages("title_li=&depth=2&link_before=Back%20to%20&include=".$post->post_parent."&echo=0");
								} else {
									$children .= wp_list_pages("title_li=&depth=1&child_of=".$post->ID."&echo=0");
								}
	
								if ($children) { 
									echo '<ul class="section_page_menu">'.$children.'</ul>';
								}
							}
							
							// other menus
							$page_menu = get_field('display_sub_menu');
							if ($page_menu == true){
								$which_page_menu = get_field('service_sub_menu');
								if ($which_page_menu != ''){
									wp_nav_menu(array(
										'theme_location' => $which_page_menu,
										'menu_class' => 'section_page_menu',
										'container' => 'div',
										'container_class' => 'page_nav',
										'container_id' => 'page_menu',
										'fallback_cb' => false
									));
								}
							}

							$create_menu = get_field('create_menu');

							if ($create_menu == true){
								if(have_rows('add_menu_item')){
									echo '<ul class="section_page_menu">';
									while(have_rows('add_menu_item')){
										the_row();
										echo '
											<li class="'.$page_class.'">
												<a href="'.get_sub_field('pick_item').'">'.get_sub_field('title').'</a>
											</li>
										';
									}
									echo '</ul>';
								}
							}


										
						//display sidebar feature panels if they exist
						$show_fp = get_field('dis_ft_pan');
						if ($show_fp == true){
							get_template_part('inc/display_feature_pos_1');
						}	
						
						// display a contact form if one exists
						$contact_form = get_field('show_contact_form');
						if ($contact_form == true){		
							get_template_part('inc/display_form_no_row');							
						}

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
				</section>
			</div>
		</div>
	</div>
<?php get_footer(); ?>