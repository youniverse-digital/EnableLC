<?php get_header(); ?>
	<main role="main">
		<!-- section -->
		<div class="breadcrumbs-wrap">
			<div class="container">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		<!-- section -->
		<section>
			<h1><?php _e( 'Tag Archive: ', 'youniverse' ); echo single_tag_title('', false); ?></h1>
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
						</a>
					<?php endif; ?>
					<!-- /post thumbnail -->

					<!-- post title -->
					<h2>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h2>
					<!-- /post title -->

					<!-- post details -->
					<span class="date">
						<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
							<?php the_date(); ?> <?php the_time(); ?>
						</time>
					</span>
					<span class="author"><?php _e( 'Published by', 'youniverse' ); ?> <?php the_author_posts_link(); ?></span>
					<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'youniverse' ), __( '1 Comment', 'youniverse' ), __( '% Comments', 'youniverse' )); ?></span>
					<!-- /post details -->

					<?php the_excerpt(); ?>
				</article>
				<!-- /article -->
			<?php endwhile; ?>
			<?php else: ?>
				<!-- article -->
				<article>
					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
				</article>
				<!-- /article -->
			<?php endif; ?>
			<?php get_template_part('pagination'); ?>
		</section>
		<!-- /section -->
	</main>
<?php get_footer(); ?>