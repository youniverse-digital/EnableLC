<?php 
get_header(); 
get_template_part('inc/banner_blog');
?>
	<div id="" role="main" class="page-content">
		<!-- section -->
		<div class="breadcrumbs-wrap row">
			<div class="container no-padding">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		
		
		<section>
			<div class="column_wrapper row">

				<div class="content_wrap">
				
					<h1 class="page-title blog-title"><?php post_type_archive_title(); ?></h1>
					<p>archive-green_spaces-parks.php</p>


					<div class="col-sm-8">	
					<?php
						$terms = get_terms( 'green', array(
								'orderby'    => 'count',
								'order' => 'DESC',
								'hide_empty' => 1
						) );
						
						foreach( $terms as $term ) {

							$args = array(
									'post_type' => 'green_spaces',
									'green' => $term->slug
							);
							$query = new WP_Query( $args );
 
							echo'<h2>' . $term->name . '</h2>';

							echo '<ul class="taxonomy_list">';

								while ( $query->have_posts() ){
									$query->the_post(); 
									echo '<li id="post-'.get_the_ID().'"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
								}

							echo '</ul>';

							wp_reset_postdata();	
						}					

					?>						
					</div>
					
					<div class="col-sm-4">
						<?php // get_sidebar(); ?>
					</div>
					
					
				</div>
			</div>
		</section>
		
	</div>
	
	<?php get_footer(); ?>