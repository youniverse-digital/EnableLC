<?php get_header(); ?>
	<main role="main" class="container">
		<div class="breadcrumbs-wrap">
			<div class="">
				<?php custom_breadcrumbs(); ?>
			</div>
		</div>
		<section class="page-content">
			<div class="">
				<article id="post-404">
					<h1><?php _e( 'Page not found', 'html5blank' ); ?></h1>
					<p>Ooops, something went wrong</p>
					<p>
						You can <a href="<?php echo home_url(); ?>"><?php _e( 'return home', 'html5blank' ); ?></a> or use the menu to try somewhere else, or hit the back button to use our time travel machine and magically return from whence you came...
					</p>
				</article>
			</div>
		</section>
	</main>
<?php get_footer(); ?>
