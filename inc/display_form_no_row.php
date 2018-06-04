<?php
	echo '
	<section class="form_wrapper">
		<div class="content_wrap">
			';
				
			$form_shortcode = get_field('choose_form');

			echo do_shortcode($form_shortcode);
			
			echo '
		</div>
	</section>	
	';								
?>