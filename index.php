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
				<div class="content_wrap">
					<h1 class="page-title blog-title"></h1>

					<div class="col-sm-8">							
						<?php
							if ( 'page' == get_option('show_on_front') && get_option('page_for_posts') && is_home() ) : the_post();
								$page_for_posts_id = get_option('page_for_posts');
								setup_postdata(get_page($page_for_posts_id));
							?>
								<div id="post-<?php the_ID(); ?>" class="blogpage-content">
									<div class="entry-content">
										<?php the_content(); ?>
									</div>
								</div>
							<?php
								rewind_posts();
							endif;
						?>

						<?php 
							query_posts( array(
							     'posts_per_page' => 10,
							     'post_type' => 'post',
							     'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
							     'cat' => '-32'
							)); 
						?>
						
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
					<div class="col-xs-12">
						<?php

							$btm_content = get_field('btm_content', get_option('page_for_posts'));
							if ($btm_content != ''){		
								echo '
								<section class="bottom-content">
									<div class="content_wrap">
										<article>
											'.$btm_content.'
										</article>
									</div>
								</section>
								';
							}
						?>
						<?php 
							if(have_rows('add_accordion', get_option('page_for_posts'))){
								$count = 1;
								echo '
								<section class="row">
									<div class="content_wrap">
										<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
											';
											while (have_rows('add_accordion', get_option('page_for_posts')) ){
												the_row();
												$count++;
												echo '
												<div class="panel panel-default">
													<div class="panel-heading '.$page_class.'" role="tab" id="heading'.$count.'">
														<h4 class="panel-title">
															<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$count.'" aria-expanded="false" aria-controls="'.$count.'">
																'.get_sub_field('title').'
															</a>
														</h4>
													</div>
													
													<div id="'.$count.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$count.'">
														<div class="panel-body">'.get_sub_field('content').'</div>
													</div>
												</div>';
											}

										echo '
									</div>
								</div>
							</section>
								';
							}
							?>
					</div>
				</div>
			</div>
		</section>
		<!-- /section -->
	</div>
<?php get_footer(); ?>