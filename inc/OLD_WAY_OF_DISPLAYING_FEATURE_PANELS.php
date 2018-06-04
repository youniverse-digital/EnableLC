		<?php //display multiple features panels if they exist
			$haveTwoColumnFeature = 0;
			$columnClass = 'col-xs-12 col-sm-4 feature_wrap';

			if(have_rows('features')){
				echo '
				<section id="feature_multi" class="row">
					<div class="content_wrap clearfix">
					';

					// loop through the rows of data
					while (have_rows('features')){ 
						the_row();
						//print_r(get_sub_field_object('use_two_columns'));
						$num_of_cols = intval(get_sub_field_object('use_two_columns')['value']);
						if ($haveTwoColumnFeature == 0 && $num_of_cols == 1){
							$haveTwoColumnFeature = 1;
							$columnClass = 'col-xs-12 col-sm-8 feature_wrap';
						} else {
							$columnClass = 'col-xs-12 col-sm-4 feature_wrap';
						}
						// display a sub field value
						echo '
						<div class="single_feature '.$columnClass.'">
							<div class="feature-inner clearfix">
							';
							// display feature text
							if ($num_of_cols == 1){
								echo '<div class="col-xs-12 col-sm-6">';
							}
			
							echo '<h2>'.get_sub_field('feature_headline').'</h2>'.get_sub_field('feature_text'); 
			
							if (get_sub_field('feature_link') != '') {
								echo '<a href="'.get_sub_field('feature_link').'" title="Click for more information">Read more</a>';
							}

							if ($num_of_cols == 1){
								echo '</div>';
							}
			
							// display image if it exists
							$feature_image = get_sub_field('feature_image');
							$feature_display_size = 'large'; 
							if (!empty($feature_image)){
								if ($num_of_cols == 1){
									echo '<div class="col-xs-12 col-sm-6">';
								}
				
								echo '<img src="'.$feature_image['sizes'][$feature_display_size].'" alt="'.$feature_image['alt'].'" />';

								if ($num_of_cols == 1){
									echo '</div>';
								}

							}
							echo '
							</div>
						</div>
						';
					}
				}
				echo '
				</div>
			</section>	
			';
		?>
