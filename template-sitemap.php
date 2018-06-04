<?php /* Template Name: Sitemap Page */ 
get_header(); 
get_template_part('inc/banner');
?>

	<div role="main" class="page-content">
		
		<div class="row">
			<div class="content_wrap">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		<div class="column_wrapper row">
			<section class="">
				<div class="content_wrap clearfix">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<div class="col-xs-12 full-width-col">
											
						<?php if (have_posts()): while (have_posts()) : the_post(); ?>
							<!-- article -->
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php the_content(); ?>
								<br class="clear">
							</article>
							<!-- /article -->
							<?php endwhile; ?>
							<?php else: ?>
							<!-- article -->
							<article>
								<h2><?php _e( 'Sorry, nothing to display.', 'youniverse' ); ?></h2>
							</article>
							<!-- /article -->
						<?php endif; ?>	

						<?php get_template_part('/inc/sitemap'); ?>
					</div>		
				</div>
			</section>
		</div>
	</div>
<?php get_footer(); ?>
