	<footer class="enable-footer row">
	
		<div class="footer-inner">
			<img src="<?php echo dirname( get_bloginfo('stylesheet_url') ); ?>/style/img/enable_logo_220.png" alt="Enable Leisure and Culture" />

			<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-menu',
					'menu_id' => 'footer_menu',
					'menu_class' => 'clearfix',
					'fallback_cb' => false
				));
			?>
			


			

			<div class="col-sm-6">
				<ul class="social_footer_list">
					<?php
						if(have_rows('add_a_link', 'options')){
							while (have_rows('add_a_link', 'options')) {
								the_row();
								$link = get_sub_field('link');
								$image = get_sub_field('image');
								$newtab = get_sub_field('new_tab');
								$title = get_sub_field('title');
								$name = get_sub_field('text');

								if($newtab == 1){
									$newtab = '_blank';
								}else {
									$newtab = "_self";
								}

								echo '
									<li><a class="sm_tw sm_icon" href="'.$link.'" target="'.$newtab.'" title="'.$title.'" style="background-image: url('.$image.');">'.$name.'</a></li>
								';

							}
						}
					?>
				</ul>
			</div>
			<div class="col-sm-6">
				<p class="copyright">Enriching lives and strengthening communities through leisure and culture (registered charity no. 1172345) &copy;&nbsp;enable&nbsp;<?php echo date("Y"); ?></p>
			</div>
			<div class="clearfix"></div>
		</div>
		
	</footer>
	
	</div> <!-- End of site_wrapper -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script> 
		<script src="<?php echo get_template_directory_uri(); ?>/js/lib/jquery.matchHeight-min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/acf_maps.js"></script> 

 
		<script>
			// Variables --------------------------------------------------------------------

			var pUI_Over = "mouseenter";
			var pUI_Out = "mouseleave";
			var pUI_Action = "click";
			
			var gIconMenuOpen = 0;
			var gOpenMenu ='';

			// Functions --------------------------------------------------------------------

			// Mobile device check --------------------------------------------------
			function mIsMobileDevice(){
				if (navigator && navigator.userAgent && navigator.userAgent != null){
					var strUserAgent = navigator.userAgent.toLowerCase();
					var arrMatches = strUserAgent.match(/(iphone|ipod|ipad|android|webOS)/);
					if (arrMatches){
						return true;
					}
				} 
				return false;
			}
			
			// Icon menu controls
			function mCheckIconMenu(vWhichMenu){
				if (gIconMenuOpen == 1){ // close any open menu
					if (vWhichMenu == gOpenMenu){
						mCloseIconMenu();
					} else {
						jQuery('div#' + gOpenMenu).slideToggle(500).promise().done(function(){
							gIconMenuOpen = 0;
							gOpenMenu = '';
							mOpenIconMenu(vWhichMenu);
						});
					}
				} else { // open the requested menu
					mOpenIconMenu(vWhichMenu);
				}
			}

			function mOpenIconMenu(vWhichMenu){
				gIconMenuOpen = 1;
				gOpenMenu = vWhichMenu;
				jQuery('div#' + vWhichMenu).slideToggle(500);
			}

			function mCloseIconMenu(){
				if (gIconMenuOpen == 1){
					jQuery('div#' + gOpenMenu).slideToggle(500);
					gIconMenuOpen = 0;
					gOpenMenu = '';
				}

			}

			// Document ready --------------------------------------------------------------------
			
			jQuery(document).ready(function() {

				jQuery('.carousel').carousel({
					interval: 9000
				})
				

				if (mIsMobileDevice()){
					pUI_Over = "touchstart";
					pUI_Out = "touchend";
					pUI_Action = "tap";
				}
					
				
				jQuery('div.feature-inner').matchHeight();
				jQuery('#menu-services-menu li').matchHeight({
				    byRow: false
				    
				});


				// code to sort the icon menu vertical centering 
				jQuery('.homepage-service-menu #menu-services-menu li a span').each(function(){
					var parentHeight = (parseInt(jQuery(this).parent('a').height())* 0.5);
					var thisHeight  = (parseInt(jQuery(this).height()* 0.5));
					var spacer = (parentHeight - thisHeight);
					jQuery(this).css('padding-top', spacer);
				});

				jQuery('.icon_menu_hide#icon_service_menu').addClass('offscreen');

				jQuery('.icon_menu_hide#icon_service_menu li a span').each(function(){
					var parentHeight = (parseInt(jQuery(this).parent('a').height())* 0.5);
					var thisHeight  = (parseInt(jQuery(this).height()* 0.5));
					var spacer = (parentHeight - thisHeight);
					jQuery(this).css('padding-top', spacer);
				});

				jQuery('.icon_menu_hide#icon_service_menu').removeClass('offscreen');
				// end code to sort the icon menu vertical centering


				jQuery('.carousel-caption .equalheights').matchHeight({
				    byRow: false   
				});

				jQuery('.recent-post').matchHeight({
				    byRow: true   
				});

				jQuery('.eq-h-header').matchHeight();
				jQuery('.section_menu li a').matchHeight({byRow: false});

				


				jQuery('#menu-about-us-menu li a').matchHeight();
				jQuery('.debug_mh').matchHeight();
				

				// jQuery("body").on(pUI_Action, "li.fas_menu a", function(e) {
				// 	e.preventDefault();
				// 	console.log('clicked');
				// 	var vTarget;
				// 	if (gIsHomepage == 1){
				// 		// mCloseIconMenu();
				// 		vTarget = jQuery('div#icon_service_menu');
				// 		jQuery("html, body").animate({ scrollTop: vTarget.offset().top }, 1000);
				// 	} else {
				// 		vTarget = jQuery(this).parent().parent().parent().parent().attr('id');
				// 		mCheckIconMenu('icon_service_menu');
				// 	}
				// });
				// 
				jQuery("li.fas_menu a").click(function(e) {
					e.preventDefault();
					//console.log('clicked2');
					var vTarget;
					if (gIsHomepage == 1){
						// mCloseIconMenu();
						vTarget = jQuery('div#icon_service_menu');
						jQuery("html, body").animate({ scrollTop: vTarget.offset().top }, 1000);
					} else {
						vTarget = jQuery(this).parent().parent().parent().parent().attr('id');
						mCheckIconMenu('icon_service_menu');
					}
				});

				jQuery("body").on(pUI_Action, "li.au_menu a", function(e) {
					e.preventDefault();
					mCheckIconMenu('icon_about_us_menu');
				});

				// Fireworks TicketScript JS went here - removed by DR 04-11-2016 @ 17:50

				
			});
		</script>
    
    
  </body>
  
</html>

