<?php get_header(); 
get_template_part('inc/banner_blog');
?>
	<div id="" role="main" class="page-content">
		<!-- section -->
		<div class="breadcrumbs-wrap row">
			<div class="container no-padding">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		
		<section>
			<div class="column_wrapper row">
				<?php 
					if(get_field('alt_title') == ''){
						//echo '<h2 class="page-title">'.get_the_title().'</h2>';
					}else {
						//$title = get_field('alt_title');
						//echo '<h2 class="page-title">'.$title.'</h2>';
					}
				?>	
				<div class="content_wrap">
					<h1 class="page-title blog-title">Archives (archive.php)</h1>

					<div class="col-sm-8">							
						
						<?php if (have_posts()): while (have_posts()) : the_post(); ?>
							<div class="col-xs-12 no-padding blog-post">
								<!-- article -->
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="col-sm-3 no-padding">
										<!-- post thumbnail -->
										<?php 
											if ( has_post_thumbnail()) { // Check if thumbnail exists ?>
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
													<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
												</a>
										<?php 
											}else { 
										?>
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
													<img src="http://placehold.it/120x120">
												</a>
										<?php 
											}
										?>
										<!-- /post thumbnail -->
									</div>
									<div class="col-sm-9">
										<!-- post title -->
										<h2 class="post-title">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										</h2>
										<!-- /post title -->
										<!-- post details -->
										<span class="date">
											<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
												<?php the_date(); ?> <?php the_time(); ?>
											</time>
										</span>
										<!-- <span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
										<span class="comments clearfix"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'youniverse' ), __( '1 Comment', 'youniverse' ), __( '% Comments', 'youniverse' )); ?></span> -->
										<!-- /post details -->
										<?php the_excerpt(); // Build your custom callback length in functions.php ?>
									</div>
								</article>
								<!-- /article -->
							</div>
						<?php endwhile; ?>
						<?php else: ?>
							<!-- article -->
							<article>
								<h2><?php _e( 'Sorry, nothing to display.', 'youniverse' ); ?></h2>
							</article>
							<!-- /article -->
						<?php endif; ?>
						<?php get_template_part('pagination'); ?>
					</div>
					<div class="col-sm-4">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</section>
		<!-- /section -->
	</div>
<?php get_footer(); ?>