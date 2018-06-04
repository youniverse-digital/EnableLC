<?php /* Template Name: Voucher Page */ 
get_header(); 
get_template_part('inc/banner');
?>
	<div role="main" class="page-content">
		<div class="row">
			<div class="content_wrap">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		
		<section class="row">
			<div class="content_wrap">
				<h1 class="page-title"><?php the_title(); ?></h1>		
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
		</section>
	</div>
<?php get_footer(); ?>
