<?php /* Template Name: Home Page */
	get_header(); 
	get_template_part('inc/banner');
?>

	<div role="main" class="page-content">
	
		<div class="row">
			<div class="content_wrap wrap_breadcrumbs">
				<div class="content_wrap">
					<?php custom_breadcrumbs(); ?>
				</div>
			</div>
		</div>

		
		
		
		<div id="icon_service_menu" class="row">
			<div class="content_wrap homepage-service-menu icon_wrap service_wrap">				
				<div class="service service-arts">
					<div class="service-title">
						Arts
					</div>
					<div class="service-inner">
						<div class="service-content">
							<p>A wide range of arts and crafts is right there on your doorstep for you to enjoy.<p>

							<a href="/arts-AOH" class="service-btn">Find out more</a>
						</div>
					</div>
				</div>
				<div class="service service-bereavement">
					<div class="service-title">
						Bereavement
					</div>
					<div class="service-inner">
						<div class="service-content">
							<p>Enable Bereavement manages two crematoria, three busy cemeteries and two closed cemeteries.<p>

							<a href="/bereavement/about" class="service-btn">Find out more</a>
						</div>
					</div>
				</div>
				<div class="service service-events">
					<div class="service-title">
						Events
					</div>
					<div class="service-inner">
						<div class="service-content">
							<p>The Events Team creates and hosts excellent and imaginative events in one of London's most loved and visited parks.<p>

							<a href="/events/about" class="service-btn">Find out more</a>
						</div>
					</div>
				</div>
				<div class="service service-filming">
					<div class="service-title">
						Filming
					</div>
					<div class="service-inner">
						<div class="service-content">
							<p>The Enable Film Office team offers a one-stop service for all your filming needs in Wandsworth.<p>

							<a href="/filming/about" class="service-btn">Find out more</a>
						</div>
					</div>
				</div>
				<div class="service service-ls">
					<div class="service-title">
						Leisure and sport
					</div>
					<div class="service-inner">
						<div class="service-content">
							<p>At Enable Leisure and Sport we believe everyone should have the chance to lead a healthy and active lifestyle.<p>

							<a href="/els" class="service-btn">Find out more</a>
						</div>
					</div>
				</div>
				<div class="service service-parks">
					<div class="service-title">
						Parks
					</div>
					<div class="service-inner">
						<div class="service-content">
							<p>Enable Parks manages and develops parks and deals with general queries  on behalf of Wandsworth Council.<p>

							<a href="/parks/about" class="service-btn">Find out more</a>
						</div>
					</div>
				</div>
				<div class="service service-halls">
					<div class="service-title">
						Public Halls
					</div>
					<div class="service-inner">
						<div class="service-content">
							<p>Our aim is to provide affordable, quality venues with staff to supervise both private and public events.<p>

							<a href="/public-halls/about" class="service-btn">Find out more</a>
						</div>
					</div>
				</div>
				<div class="service service-putney">
					<div class="service-title">
						Putney School of Art and Design
					</div>
					<div class="service-inner">
						<div class="service-content">
							<p>Putney School of Art and Design was originally founded in 1883, and has been in Oxford Road, Putney since 1895.<p>

							<a href="/psad/about" class="service-btn">Find out more</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<section class="row">
			<div class="content_wrap container-fluid no-padding news-events twitter_wrap">
				<div id="twitter">
					<!-- <script type="text/javascript">(function(){var ticker=document.createElement('script');ticker.type='text/javascript';ticker.async=true;ticker.src='//twitcker.com/ticker/enableLC.js?count=22&background=019FE9&tweet=ffffff&open=true&hide-logo=true&appearance=typewriter&container=own-container&own-container=twitter';(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(ticker);})();</script> -->
					<?php //echo do_shortcode('[mgl_twitter username="enablelc"]'); ?>

					<div class="sidebar-widget homepage-twitter">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
					</div>	
				</div>	
					
			</div>
		</section>
		
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
				<div class="content_wrap map_wrap">
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