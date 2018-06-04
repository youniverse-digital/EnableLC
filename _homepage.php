<?php /* Template Name: Home Page */
	get_header(); 
	get_template_part('inc/banner');
?>

	<div role="main" class="page-content">
	
		<div class="row">
			<div class="content_wrap">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		
		
		<div id="icon_service_menu" class="row">
			<div class="content_wrap homepage-service-menu">				
				<?php 
					// Add service menu to home page
					if (is_front_page()){
						$front_page_value = 'true';
						wp_nav_menu(array(
							'theme_location' => 'find_service',
							'container' => 'div',
							'container_class' => 'service_icon_wrapper clearfix',
							'menu_class' => 'icon_menu clearfix',
							'link_before' => '<span>',     
							'link_after'  => '</span>',
							'fallback_cb' => false
						));
					} else {
						$front_page_value = 'false';
					}
				?>
			</div>
		</div>
		
		<section id="homepage_intro" class="row">
			<div class="content_wrap">
					<?php 
						if($post->post_content != "") {
							if (have_posts()){
								while (have_posts()){
									the_post();
									?>
										<article id="post-<?php the_ID(); ?>" class="clearfix">
											<?php the_content(); ?>
										</article>
									<?php 

								}
							}
						}
					?>
			</div>
		</section>
		
		
		
		
		<section class="row">
			<div class="content_wrap container no-padding news-events">
				<div id="twitter">
					<script type="text/javascript">(function(){var ticker=document.createElement('script');ticker.type='text/javascript';ticker.async=true;ticker.src='//twitcker.com/ticker/enableLC.js?count=22&background=019FE9&tweet=ffffff&open=true&hide-logo=true&appearance=typewriter&container=own-container&own-container=twitter';(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(ticker);})();</script>
				</div>	
				<h2>News &amp; Events</h2>
				<?php 
					if(have_rows('add_ft_news')){
						while(have_rows('add_ft_news')){
							the_row();
							$post_object = get_sub_field('chse_news_item');
							$post = $post_object;
							setup_postdata( $post ); 
							?>
							<div class="col-sm-4 no-padding recent-post equalheights">
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<h3 class="eq-h-header"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt();  ?>
									<p class="enable_btn_wrap"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="enable_btn">Read more</a></p>
								</article>
							</div>
							<?php wp_reset_postdata();
							
						}
					}
				?>	
			</div>
		</section>
		
		
		<?php
		// display multiple feature panels
		if (have_rows('add_ft')){
			echo '
			<section id="feature_multi" class="features">
				<div class="content_wrap clearfix">
				';
				while (have_rows('add_ft')){
					the_row();
			
					$ft_img = get_sub_field('ft_img');
					$ft_link = get_sub_field('ft_link');
					$ft_size = get_sub_field('ft_size');
			
					switch ($ft_size){
						case 'third':
						$ft_class = 'col-sm-4';
						break;
				
						case 'half':
						$ft_class = 'col-sm-6';
						break;
				
						case 'full':
						$ft_class = 'col-sm-12';
						break;
				
						default:
						$ft_class = 'col-sm-12';
				
					}
			
					echo '<div class="'.$ft_class.' feature"><a href="'.$ft_link.'"><img src="'.$ft_img.'" /></a></div>';

				}
				echo '
				</div>
			</section>	
			';
		}
		
		// Display a map
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
		
		
	</div>
<?php get_footer(); ?>