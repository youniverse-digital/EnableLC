<header class="row">
  <div class="">
		<div id="top_bar">
			<div class="content_wrapX clearfix content_wrap wrap_transparent">
		
				<div class="col-xs-12 col-sm-4 clearfix">
					<a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo dirname( get_bloginfo('stylesheet_url') ); ?>/img/enable_logo_nonwhite.png" alt="Enable Leisure and Culture" /></a>
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
	
		
	</div>
</header>