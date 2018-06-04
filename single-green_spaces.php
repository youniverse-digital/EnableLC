<?php
	get_header(); 

	// get the title of the parent page
	//$ancestors = get_ancestors( $post->ID, 'page' ); 
	$parent_page_title = get_cat_name( $post->ID );
// 	$page_class = 'colour_'.substr(strtolower(preg_replace('/[^A-Za-z]/', '', $parent_page_title) ), 0, 8);
// 	$page_id = 'page_'.substr(strtolower(preg_replace('/[^A-Za-z]/', '', $parent_page_title) ), 0, 8);

	$page_class = 'colour_parks';
	$page_id = 'page_parks';

	
	//$GLOBALS['pID'] = $ancestors;
	
		$terms = get_the_terms($post->ID, 'green' );
		$page_title = $terms[0]->name;
		$post_t_name = $page_title;
						

	
	echo '
	<div class="row">
		<h1 class="content_wrap '.$page_class.'">Parks - '.$page_title.'</h1>
	</div>
	';

	get_template_part('inc/banner');

?>

	<div id="<?php echo $page_id; ?>" role="main" class="page-content">
	
		<div class="row">
			<div class="content_wrap">
				<!-- <?php custom_breadcrumbs(); ?> -->
				<?php 
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">You are here: ','</p>');
					} 
				?>
			</div>
		</div>

		<?php // Section menu switching code
			$which_menu = 'parks'; //get_field('service_menu');
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
		
		
		
		<section class="row">
			<div class="content_wrap clearfix">
			
				<div class="col-xs-12 col-sm-9 single_col_wrap">
					<h2><?php the_title(); ?></h2>		
					<?php 
					
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
				
				<div class="col-xs-12 col-sm-3 single_col_wrap">
					<div id="taxonomy_menu">
						<h4>Categories</h4>
            <?php
						//list terms in a given taxonomy
						$taxonomy = 'green';
						$tax_terms = get_terms( $taxonomy, array(
								'orderby'    => 'count',
								'order' => 'DESC',
								'hide_empty' => 1
						) );
				
						echo '<ul class="category_list_sb fw_list">';
							foreach ($tax_terms as $tax_term) {
								$t_name = $tax_term->name;
								$t_class = '';
								if ($t_name == $post_t_name){
									$t_class = 'current_term';
								}
								echo '<li><a class="'.$t_class.'" href="'.esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all items in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.' ('.$tax_term->count.')</a></li>';
							}
						echo '</ul>';
            
           ?>
					</div>
          

        </div>



				</div>
				
			</div>
		</section>
		
		<?php
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