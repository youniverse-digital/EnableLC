<?php
$area_value = 2;
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
		
				$have_image = 0;
				$have_headline = 0;
				$have_text = 0;
				
				if ($panel_position == $area_value){

					$feature_image = get_field('feature_image');
					$feature_display_size = 'large'; 
					if (!empty($feature_image)) {
						$have_image = 1;
					}
		
					if (get_field('feature_headline') != '') {
						$have_headline = 1;
					}

					if (get_field('feature_text') != '') {
						$have_text = 1;
					}

					echo '
					<div class="single_feature">
						<div class="feature-inner">
							<div class="feature_dec nB clearfix">
							';
							if ($have_image == 1){
								echo '<div class="col-xs-12 col-sm-6">';
							}

							echo '<h2>'.get_field('feature_headline').'</h2>'.get_field('feature_text'); 

							if (get_field('feature_link') != '') {
								echo '<a class="feature_link" href="'.get_field('feature_link').'" title="Click for more information">Read more</a>';
							}

							if ($have_image == 1){
								echo '</div>';
							}

							// display image if it exists
							if (!empty($feature_image)){
								echo '
								<div class="col-xs-12 col-sm-6">
									<img src="'.$feature_image['sizes'][$feature_display_size].'" alt="'.$feature_image['alt'].'" />
								</div>';

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