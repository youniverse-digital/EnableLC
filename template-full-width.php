<?php get_header(); 
/* Template Name: Full Width Page */
?>

		<div role="main" class="container page-content">
		<!-- section -->

		<div class="row">
			<div class="container">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		<section class="row">
			<div class="container">
				<h1><?php the_title(); ?></h1>					
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

							<h2><?php _e( 'Sorry, nothing to display.', 'flying-fergus' ); ?></h2>

						</article>
						<!-- /article -->

					<?php endif; ?>

				
			</div>
		</section>
	</div>

<?php get_footer(); ?>
