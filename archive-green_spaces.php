<?php 
get_header(); 

	$page_class = 'colour_parks';
	$page_id = 'page_parks';

	$terms = get_the_terms($post->ID, 'green' );
// 	$page_title = $terms[0]->name;
// 	$t_name_array = array();
// 	foreach ($terms as $term){
// 		array_push($t_name_array, $term->name);
// 	}
// 	$post_t_name = $t_name_array[0];
	
// 	$t_slug_array = array();
// 	foreach ($terms as $term){
// 		array_push($t_slug_array, $term->slug);
// 	}


	echo '
	<div class="row">
		<h1 class="content_wrap '.$page_class.'">Parks</h1>
	</div>
	';

// 	get_template_part('inc/banner_blog');
	get_template_part('inc/banner');

?>
	<div id="<?php echo $page_id; ?>" role="main" class="page-content">
	
		<div class="breadcrumbs-wrap row">
			<div class="container no-padding">
				<?php custom_breadcrumbs(); ?>
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
			<div class="column_wrapper clearfix">
				<h2 class="page-title blog-title">Green places</h2>

				<div class="col-xs-12 col-sm-9 single_col_wrap">							
					<div class="content_wrap">
						<?php
						//list terms in a given taxonomy
						$taxonomy = 'green';
						$tax_terms = get_terms( $taxonomy, array(
								'orderby'    => 'count',
								'order' => 'DESC',
								'hide_empty' => 1
						) );
								
						echo '
						<section>
							<div class="content_wrap">
								<ul class="category_list_fw">';
								foreach ($tax_terms as $tax_term) {
									echo '<li><a href="'.esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all items in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.' ('.$tax_term->count.')</a></li>';
								}
								echo '
								</ul>
							</div>
						</section>
						';
						?>
					</div>
				</div>
				
				
				<div class="col-xs-12 col-sm-3 single_col_wrap">
<!-- 
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
 -->
				</div>
				
					
				
				
			</div>
		</section>

	</div>
	<?php get_footer(); ?>