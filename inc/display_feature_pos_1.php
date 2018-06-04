<?php // show single colum features
$area_value = 1;
if (have_rows('selected_panels')){

	echo '
	<section id="feature_multi">
		<div class="content_wrap clearfix">
		';

		// loop through the rows of data
		while (have_rows('selected_panels')){ 
			the_row();
			
			$panel_position = intval(get_sub_field_object('panel_display_position')['value']);
	
			$value = get_sub_field( "new_panel" );
			$ID = $value;
			$args = array('p' => $ID, 'post_type' => 'feature_panels');
			$loop = new WP_Query($args);
			// $count = $loop->post_count;
	
			while ($loop->have_posts()){
				$loop->the_post();
		
				if ($panel_position == $area_value){

					$feature_image = get_field('feature_image');
					$feature_display_size = 'large';
				
					$have_link = 0; 
					$feature_link = '';
					$external_link = get_field('feature_link');
					$internal_link = get_field('post_link');
					
					if ($external_link != ''){
						$feature_link = $external_link;
					} else {
						if ($internal_link != ''){
							$feature_link = get_permalink($internal_link);
						}
					}
		
					echo '
					<div class="single_feature">
						<div class="feature-inner">
							<div class="feature_dec nB clearfix">
								<h2>'.get_field('feature_headline').'</h2>'.get_field('feature_text'); 

								if (!empty($feature_image)){
									echo '<img src="'.$feature_image['sizes'][$feature_display_size].'" alt="'.$feature_image['alt'].'" />';
								}

								if ($feature_link != '') {
									echo '<a class="feature_link" href="'.$feature_link.'" title="Click for more information">Find out more</a>';
								}

								echo '
							</div>
						</div>
					</div>
					';
				}
		
				wp_reset_query();
			}		
							
		}
		echo '
		</div>
	</section>	
	';
}	
?>