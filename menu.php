<header class="row">
  <div class="content_wrap">
		<div id="top_bar">
			<div class="content_wrapX clearfix">
		
				<div class="col-xs-12 col-sm-4 clearfix">
					<a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo dirname( get_bloginfo('stylesheet_url') ); ?>/style/img/enable_logo_220.png" alt="Enable Leisure and Culture" /></a>
				</div>
			
				<div class="col-xs-12 col-sm-8 clearfix">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'access-menu',
						'menu_id' => 'accessibility_menu',
						'menu_class' => 'clearfix',

						'fallback_cb' => false
					));
					?>
				</div>

			
			</div>
		</div>
	
		<nav class="navbar navbar-default">
			<div class="content_wrapX">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
		
				<div id="navbar" class="navbar-collapse collapse">
				<?php
					wp_nav_menu( array(
						'menu'              => 'primary',
						'theme_location'    => 'primary',
						'depth'             => 2,
						'container'         => 'div',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'navbar',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						'walker'            => new wp_bootstrap_navwalker())
					);
				?>
				</div>
			</div>
		</nav>
	
		<?php 
			// Add service menu if not on home page home page
			if (!is_front_page()){
				echo '
				<div id="icon_service_menu" class="row icon_menu icon_menu_hide">
					<div class="content_wrapX">				
						';
						wp_nav_menu(array(
							'theme_location' => 'find_service',
							'container' => 'div',
							'container_class' => 'service_icon_wrapper clearfix',
							'menu_class' => 'icon_menu clearfix',
							'link_before' => '<span>',     
							'link_after'  => '</span>',
							'fallback_cb' => false
						));
						echo '
					</div>
				</div>
				';
			}
		
			echo '
			<div id="icon_about_us_menu" class="row icon_menu icon_menu_hide">
				<div class="content_wrapX">				
					';
					wp_nav_menu(array(
						'theme_location' => 'about_us',
						'container' => 'div',
						'container_class' => 'about_us_icon_wrapper clearfix',
						'menu_class' => 'clearfix',
						'fallback_cb' => false
					));
					echo '
				</div>
			</div>
			';
		?>
	</div>
</header>