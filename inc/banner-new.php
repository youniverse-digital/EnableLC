<?php 
	$banner_path = get_stylesheet_directory_uri();
?>

<div id="carousel_wrap" class="new_banner_carousel">
	<div id="" class="slide" data-ride="">
	 	<div class="carousel-inner" role="listbox">
	 		<div class="mobile_hero">
	 			<img src="<?php the_field('mb_hero', 'options'); ?>" alt="">
	 		</div>
	 		<div class="intro_bg">
	 			<img src="<?php echo $banner_path; ?>/img/Hero_Images/banner_intro.png" alt="" class="banner_logo">
	 		</div>
			<div class="animation_track">
				
				<img src="<?php echo $banner_path; ?>/img/Hero_Images/sun.png" alt="" class="sun">
				<img src="<?php echo $banner_path; ?>/img/Hero_Images/clouds.png" alt="" class="clouds clouds-first">
				<img src="<?php echo $banner_path; ?>/img/Hero_Images/clouds.png" alt="" class="clouds clouds-clone">
				<img src="<?php echo $banner_path; ?>/img/Hero_Images/townscape_bg_hills.png" alt="" class="hills hills-first">
				<img src="<?php echo $banner_path; ?>/img/Hero_Images/townscape_bg_hills.png" alt="" class="hills hills-clone">
				<img src="<?php echo $banner_path; ?>/img/Hero_Images/level_4_houses.png" alt="" class="houses houses-first">
				<img src="<?php echo $banner_path; ?>/img/Hero_Images/level_4_houses.png" alt="" class="houses houses-clone">
				
				<!-- <img src="<?php echo $banner_path; ?>/img/Hero_Images/grass.png" alt="" class="grass grass-first">
				<img src="<?php echo $banner_path; ?>/img/Hero_Images/grass.png" alt="" class="grass grass-clone"> -->
				
				
				<!-- <img src="<?php echo $banner_path; ?>/img/tyre_tread_yellow_white.png" alt="" class="tread"> -->
				<!-- <img src="img/Hero_Images/fg_tree.png" alt="" class="fg_tree"> -->
				

				<div class="hero_bg_layer panel_bg">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/townscape_track.png" alt="" class="town_bg">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/velodrome.png" alt="" class="building velodrome">
					<!-- <img src="<?php echo $banner_path; ?>/img/Hero_Images/chimp.png" alt="" class="character chimp"> -->
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/OutdoorCinema.png" alt="" class="building cinema">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/fergus_house.png" alt="" class="building fergus_house">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/Library.png" alt="" class="building library">
					
					
				</div>

				<div class="hero_bg_layer-clone panel_bg">

					<img src="<?php echo $banner_path; ?>/img/Hero_Images/townscape_track.png" alt="" class="town_bg">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/velodrome.png" alt="" class="building velodrome">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/OutdoorCinema.png" alt="" class="building cinema">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/fergus_house.png" alt="" class="building fergus_house">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/Library.png" alt="" class="building library">
					

				</div>


				<img class="fergus_sprite" src="<?php echo $banner_path; ?>/img/Hero_Images/fergus_gif.png" alt="">

				<div class="hero_fg_layer panel_fg">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/fg_grass.png" alt="" class="">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/chimp.png" alt="" class="character chimp">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/minnie.png" alt="" class="character minnie">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/nurse.png" alt="" class="character nurse">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/guy.png" alt="" class="character guy">
					<?php 

						$curr_page_id = get_the_ID();

						if( have_rows('add_cll', 'options') ): 
							while( have_rows('add_cll', 'options') ): the_row(); 
								$cll_img = get_sub_field('cll_image');
								$cll_title = get_sub_field('cll_name');
								$cll_location = get_sub_field('cll_location');
								$user_ID = get_current_user_id();
								$has_collected = get_the_author_meta( $cll_title, $user_ID );


						    	if(!$has_collected){
						    		?>
						    			<div class="collectable" id="<?php echo $cll_location; ?>">
											<a href="#" class="collectable"><img src="<?php echo $cll_img; ?>" alt=""></a> 
										</div>

						    		<?php

						    	} else {
				
						    	}

						   	endwhile; ?>


						<?php endif; ?>
				</div>

				<div class="hero_fg_layer-clone panel_fg">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/fg_grass.png" alt="" class="">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/chimp.png" alt="" class="character chimp">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/minnie.png" alt="" class="character minnie">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/nurse.png" alt="" class="character nurse">
					<img src="<?php echo $banner_path; ?>/img/Hero_Images/guy.png" alt="" class="character guy">
					<?php 

						$curr_page_id = get_the_ID();

						if( have_rows('add_cll', 'options') ): 
							while( have_rows('add_cll', 'options') ): the_row(); 
								$cll_img = get_sub_field('cll_image');
								$cll_title = get_sub_field('cll_name');
								$cll_location = get_sub_field('cll_location');
								$user_ID = get_current_user_id();
								$has_collected = get_the_author_meta( $cll_title, $user_ID );

						    	if(!$has_collected){
						    		?>
						    			<div class="collectable" id="<?php echo $cll_location; ?>">
											<a href="#" class="collectable"><img src="<?php echo $cll_img; ?>" alt=""></a> 
										</div>

						    		<?php

						    	} else {
				
						    	}

						   	endwhile; ?>


						<?php endif; ?>
				</div>


				<?php 

						$curr_page_id = get_the_ID();

						if( have_rows('add_cll', 'options') ): 
							while( have_rows('add_cll', 'options') ): the_row(); 
								$cll_img = get_sub_field('cll_image');
								$cll_title = get_sub_field('cll_name');
								$cll_location = get_sub_field('cll_location');
								$user_ID = get_current_user_id();
								$has_collected = get_the_author_meta( $cll_title, $user_ID );

						    	if(!$has_collected){
						    		?>
										
											<div class="cll_popup_inner <?php echo $cll_location; ?>">
												<p>You found a cool thing called <?php echo $cll_title; ?></p>
												<img src="<?php echo $cll_img; ?>" alt="">
												<a href="<?php echo home_url(); ?>/profile/?tokenname=<?php echo $cll_title; ?>">Add To Collection</a>
											</div>
										

						    		<?php

						    	} else {
				
						    	}

						   	endwhile; ?>


						<?php endif; ?>

				<img src="<?php echo $banner_path; ?>/img/Hero_Images/left_trees.png" alt="" class="fg_trees">
				<img src="<?php echo $banner_path; ?>/img/Hero_Images/fg_trees_right.png" alt="" class="fg_trees right">


				<!-- <div class="bubble hero-popup">
					<a href="#" class="close-popup">X</a>
					<p>Hello, this is my website! Click the arrows to explore my town, where you can click on characters and building, and keep an eye out for the hidden bike bits cos they add up to prizes!</p>
				</div> -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><img src="http://flying.fergus.ydlstaging.co.uk/wordpress/wp-content/themes/flyingfergus/img/ff_banner_arrow_left.png" alt="Previous" /></a>

				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><img src="http://flying.fergus.ydlstaging.co.uk/wordpress/wp-content/themes/flyingfergus/img/ff_banner_arrow_right.png" alt="Next" /></a>
			</div>

			<div class="velodrome-content hero-popup">
				<a href="#" class="close-popup">X</a>
				<h2>This is a building</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="#" class="page-link">View More</a>
			</div>
			<div class="fergus_house-content hero-popup">
				<a href="#" class="close-popup">X</a>
				<h2>This is a building</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="#" class="page-link">View More</a>
			</div>
			<div class="library-content hero-popup">
				<a href="#" class="close-popup">X</a>
				<h2>This is a building</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="#" class="page-link">View More</a>
			</div>
			<div class="chimp-content hero-popup">
				<a href="#" class="close-popup">X</a>
				<h2>This is a character</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="#" class="page-link">View More</a>
			</div>
			<div class="minnie-content hero-popup">
				<a href="#" class="close-popup">X</a>
				<h2>This is a character</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="#" class="page-link">View More</a>
			</div>
			<div class="guy-content hero-popup">
				<a href="#" class="close-popup">X</a>
				<h2>This is a character</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="#" class="page-link">View More</a>
			</div>
			<div class="nurse-content hero-popup">
				<a href="#" class="close-popup">X</a>
				<h2>This is a character</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="#" class="page-link">View More</a>
			</div>
			
			
			<div class="hero-popup cinema-content">
				<div id="clip_container">
					<a href="#" class="close-popup clearfix">X</a>
					<div id="clip">
						<iframe width="100%" height="100%" src="https://www.youtube.com/embed/lGTm16k9Xww?rel=0&amp;showinfo=0&amp;enablejsapi=1" frameborder="0" allowfullscreen=""></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>