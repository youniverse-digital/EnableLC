<?php
$area_value = 2;
if (have_rows('selected_panels')){
	$panel_count = 0;
	$panel_fields = get_field_object('selected_panels');
	// $panel_count = (count($panel_fields['value']));
	
	while (have_rows('selected_panels')){ 
		the_row();	
		$panel_position = intval(get_sub_field_object('panel_display_position')['value']);
		if ($panel_position == 2){
			$panel_count ++;
		}
	}
	
	switch ($panel_count){
		case 1:
		$display_class = '';
		$text_class = 'col-xs-12 col-sm-6 col-lg-8';
		$img_class = 'col-xs-12 col-sm-6 col-lg-4';
		break;
	
		case 2:
		$display_class = ' col-sm-6';
		$text_class = 'col-xs-12 col-sm-6 col-lg-8';
		$img_class = 'col-xs-12 col-sm-6 col-lg-4';
		break;
	
		case 3:
		$display_class = ' col-sm-4';
		$text_class = '';
		$img_class = '';
		break;
		
		default:
		$display_class = '';
		$text_class = '';
		$img_class = '';
		
	}
	
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
			
			if ($panel_position == $area_value){
			
				while ($loop->have_posts()){
					$loop->the_post();
				
					$have_image = 0;
					$have_headline = 0;
					$have_text = 0;
				
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
					<div class="single_feature col-xs-12'.$display_class.'">
						<div class="feature-inner">
							<div class="feature_dec clearfix">
							';
							if ($have_image == 1 && $panel_count < 3){
								echo '<div class="'.$text_class.'">';
							}

							echo '<h2>'.get_field('feature_headline').'</h2>'.get_field('feature_text'); 

							if (get_field('feature_link') != '') {
								echo '<a class="feature_link" href="'.get_field('feature_link').'" title="Click for more information">Read more</a>';
							}

							if ($have_image == 1 && $panel_count < 3){
								echo '</div>';
							}
							
							if (!empty($feature_image)){
								echo '
								<div class="'.$img_class.'">
									<img src="'.$feature_image['sizes'][$feature_display_size].'" alt="'.$feature_image['alt'].'" />
								</div>
								';
							}

							echo '
							</div>
						</div>
					</div>
					';
				
					wp_reset_query();
				}
					
			}	
									
		}
		echo '
		</div>
	</section>	
	';
}	
?>