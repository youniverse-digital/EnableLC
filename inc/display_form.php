<?php
	echo '
	<section class="row">
		<div class="content_wrap">
			';
				
			$form_shortcode = get_field('choose_form');
			echo do_shortcode($form_shortcode);
			
			echo '
		</div>
	</section>	
	';								
?>