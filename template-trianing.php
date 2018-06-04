<?php /* Template Name: Training Videos */ 
get_header(); 
?>
	<div role="main" class="page-content">
		
		<div class="row">
			<div class="content_wrap">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>

		<div class="column_wrapper row">
			<?php 
				echo '<h2 class="page-title">'.get_the_title().'</h2>';
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
				if( have_rows('add_a_video') ){
				     // loop through the rows of data
				     echo '
						<section class="row">
							<div class="content_wrap">
								<div class="col-xs-12">
							';
								    while ( have_rows('add_a_video') ) {
								    	the_row();	
								    	$video_link = get_sub_field('video');
								    	$video_title = get_sub_field('title');
								    	echo '
								    		<div class="col-sm-6">
								    			<video width="100%" height="auto" controls>
												  <source src="'.$video_link.'" type="video/mp4">
												  
												Your browser does not support the video tag.
												</video>
												<p class="">'.$video_title.'</p>
								    		</div>
								    	';
								    }

				    echo '
								</div>
							</div>
						</section>	
						';

				}else {
					
				}

			?>

		

		</div>
	</div>
	
<?php get_footer(); ?>
