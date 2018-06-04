<?php
	$banner_pID = $GLOBALS['pID'][0];
	
	$banner = get_field('show_banner');
	$banner_count = 0;
	$display_arrows = get_field('show_banner_title');
	$display_arrows = true;
	
	if ($banner == true){
	 
	 if(have_rows('select_slides')){
		 
		 echo '
		 <div id="myCarousel" class="row carousel carousel-fade slide" data-ride="carousel">
			 <div class="carousel-inner" role="listbox">
			 ';
		 
			// display slides here
			 while (have_rows('select_slides')){
				the_row();
				
				$value = get_sub_field( "new_slide" );
				$ID = $value;
				$args = array('p' => $ID, 'post_type' => 'banner');
				$loop = new WP_Query($args);
				
				while ($loop->have_posts()){
					$loop->the_post();
					
					$feature_image = get_field('banner_image');					
					$feature_display_size = 'banner_img'; 
					
					$show_caption = get_field('show_text_panel');
					$show_title = get_field('show_banner_title');
					$banner_text = get_field('banner_text');
					$banner_link_url = get_field('banner_link');
					$banner_link_text = get_field('banner_link_text');
					if ($banner_link_text == ''){
						$banner_link_text = 'Find out more';
					}
					
					echo '
					<div class="item'.($banner_count == 0 ? ' active' : '').'">
						';
						if ($show_caption == false && $banner_link_url != ''){
							echo '<a class="full_banner_btn" href="'.$banner_link_url.'" title="'.$banner_link_text.'">';
						}
						
						echo '<img class="slide_'.$banner_count.'" src="'.$feature_image['sizes'][$feature_display_size].'" alt="'.$feature_image["alt"].'">';
						
						if ($show_caption == false && $banner_link_url != ''){
							echo '</a>';
						}
						
						
						if ($show_caption == true && $banner_link_url != ''){
							//echo get_field('banner_link');
							echo '
							<div class="">
								<div class="carousel-caption no-padding"><div class="col-xs-6 text-side equalheights">
									';
									if ($show_title == true){
										echo '<h2>'.get_the_title().'</h2>';
									}
									
									echo $banner_text;
									
									echo '</div><div class="col-xs-6 logo-side no-padding equalheights">';
									

									if ($banner_link_url != ''){
										echo '<div class="col-xs-12 caption-link"><a class="btn btn-lg btn-primary enable_btn" href="'.$banner_link_url.'" role="button">'.$banner_link_text.'</a></div>';
									}
									echo '</div>
								</div>
							</div>
							';
						}else if($show_caption == true){
							echo '
							<div class="">
								<div class="carousel-caption no-padding"><div class="text-side equalheights">
									';
									if ($show_title == true){
										echo '<h2>'.get_the_title().'</h2>';
									}
									
									echo $banner_text;
									
									echo '</div>
								</div>
							</div>
							';
						}
						echo '
					</div>
					';
					
					$banner_count ++;
					wp_reset_query();
					
				}
				 
			}
			 
			 echo '</div>'; // end of .carousel-inner
		 
			 // display indicator links
		 
			 if ($banner_count >1){
				 echo '<ol class="carousel-indicators">';
				 for ($cx = 0; $cx < $banner_count; $cx ++){
					 echo '<li data-target="#myCarousel" data-slide-to="'.$cx.'" class="'.($cx == 0 ? 'active' : '').'"></li>';
				 }
				 echo '</ol>';
			 }
			 
			 
			 

			 if ($display_arrows && $banner_count > 1){
					echo '
					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
					</a>

					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
					</a>
					';
			 }

			echo '</div>'; // end of #myCarousel
			
		}
	}



?>

