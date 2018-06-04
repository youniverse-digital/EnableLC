<h2 class="map-header">Activities to suit <strong>EVERYONE...</strong></h2>				
<!-- <img src="<?php get_field('head_img'); ?>" alt=""> -->
<!-- <h2><?php get_field('head_img'); ?></h2> -->
<div class="row">
	<div class="col-md-8">
		<?php 
			if(have_rows('add_a_hot_spot') && get_field('map_image')){
				echo '
					<div class="map-wrap">
						<div class="map-area">
							<img src="'.get_field('map_image').'" />';
								while (have_rows('add_a_hot_spot')) {
									the_row();

									$left = get_sub_field('x_coordinate');
									$top = get_sub_field('y_coordinate');
									$width = get_sub_field('width');
									$height = get_sub_field('height');
									$rotation = get_sub_field('rotation');
									$id = get_sub_field('id');

									$show_hs = get_sub_field('show_hotspot');
									$classname = '';

									if($show_hs){
										$classname = 'visible';
									}

									echo '
										<div class="hotspot '.$classname.'" style="left: '.$left.'%; top: '.$top.'%; width: '.$width.'%; height: '.$height.'%; transform: rotate('.$rotation.'deg);" data-link="'.$id.'">
										</div>
									';	
								}
				echo '
						</div>
					</div>
				';
			}else if (get_field('map_image')) {
				echo '
					<div class="map-wrap">
						<div class="map-area">
							<img src="'.get_field('map_image').'" />
							<div class="map-overlay"></div>
						</div>';
							if(have_rows('add_rollover')){
								$j = 0;
								while (have_rows('add_rollover')) {
									the_row();
									$j++;
									echo '
										<div class="rollover_'.$j.' rollover_content '.get_sub_field('colour').'">
											'.get_sub_field('rollover_content').'
										</div>
									';
								}
							}
						echo '	
					</div>
				';
			}

			if(have_rows('add_a_hot_spot') && get_field('map_image')){
				echo '
					<div class="map-content">
						<button id="close-map-content">Close</button>
					';
						while (have_rows('add_a_hot_spot')) {
							the_row();
							$id = get_sub_field('id');
							$content = get_sub_field('content');
							echo '
								<div class="hotspot-content" id="'.$id.'">
									'.$content.'
								</div>
							';	
						}
				echo '
					</div>
				';
			}	

		?>
	</div>
	<div class="col-md-4 hotlinks">
		<?php 
			if(have_rows('add_rollover')){
				$i = 0;
				echo '<h3>Roll over the tabs to find out more</h3>';
				while (have_rows('add_rollover')) {
					the_row();
					$i++;
					echo '
						<button class="rollover" id="rollover_'.$i.'">'.get_sub_field('title').'</button>
					';
				}
			}
		?>
		
		<?php 
			if(get_field('extra_activities')){
				echo '<div class="extra-activities">';
				echo get_field('extra_activities');
				echo '</div>';
			}
		?>
	</div>
</div>
<div>
	<a href="<?php echo get_field('map_download'); ?>" class="map-download">Download map</a>
</div>