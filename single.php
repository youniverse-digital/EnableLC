<?php get_header(); ?>
	<main role="main">
		<!-- section -->
		<div class="breadcrumbs-wrap">
			<div class="container no-padding">
				<?php //custom_breadcrumbs(); ?>
			</div>
		</div>
		<!-- section -->
		<section class="page-content">
			<div class="column_wrapper row">
				<div class="content_wrap">
					<?php 
						if(get_field('alt_title') == ''){
							echo '<h2 class="page-title">'.get_the_title().'</h2>';
						}else {
							$title = get_field('alt_title');
							echo '<h2 class="page-title">'.$title.'</h2>';
						}
					?>	
					<div class="col-sm-8 nopad-left-lg lg-r-pad">
						<?php if (have_posts()): while (have_posts()) : the_post(); ?>
							<!-- post title -->
							<?php 
								//echo '<h1 class="page-title">'. get_the_title().'</h1>';
							?>
							<!-- /post title -->
							<!-- article -->
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php the_content(); ?>		
								<!-- post details -->
								<p class="date">
									<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
										<?php the_date(); ?> <?php the_time(); ?>
									</time>
								</p>
								<p class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></p>		
							</article>
							
							<!-- <span class="comments clearfix"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'youniverse' ), __( '1 Comment', 'youniverse' ), __( '% Comments', 'youniverse' )); ?></span>  -->
							<!-- /post details -->
							<!-- /article -->					
						<?php endwhile; ?>
						<?php else: ?>
							<!-- article -->
							<article>
								<h1><?php _e( 'Sorry, nothing to display.', 'youniverse' ); ?></h1>
							</article>
							<!-- /article -->
						<?php endif; ?>
					</div>
					<div class="col-sm-4 sidebar nopad-right-lg">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</section>
		<!-- /section -->
	</main>
<?php get_footer(); ?>