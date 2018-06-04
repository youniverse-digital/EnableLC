<?php get_header(); ?>
	<div role="main" class="page-content">
	
		<div class="row">
			<div class="content_wrap">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		
		
		<section class="row">
			<div class="content_wrap clearfix">
			
				<div class="col-xs-12 col-sm-8">
					<h1><?php the_title(); ?></h1>		
					<?php 
					
					if (have_posts()): while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
							<br class="clear" />
						</article>
					<?php 
					endwhile;
					else: 
					?>
					<article>
						<h2><?php _e( 'Sorry, nothing to display.', 'enable' ); ?></h2>
					</article>
					<?php endif; ?>
				</div>
				
				<div class="col-xs-12 col-sm-4">
					<div class="social_feed">
						<h3>Sidebar here?</h3>
					</div>
				</div>
				
			</div>
		</section>
		
	</div>
	
<?php get_footer(); ?>