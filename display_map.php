<?php // show a map if it exists
$zoom_level = 16;
if( have_rows('locations') ){
	$map_intro = get_field('map_intro');

	if($map_intro != ''){
		echo '<div class="map_intro">'.$map_intro.'</div>';
	}

	echo '<div class="acf-map">';
	while ( have_rows('locations') ){
		the_row();
		$location = get_sub_field('location');
		echo '
		<div class="marker" data-lat="'.$location['lat'].'" data-lng="'.$location['lng'].'" data=zoom="'.$location['zoom'].'">
			<h4>'.get_sub_field('title').'</h4>
			<p class="address">'.$location['address'].'</p>
			<p>'.get_sub_field('description').'</p>
		</div>
		';

	}
	echo '</div>';
}

?>
<script>
	var gMapZoom = <?php echo $zoom_level; ?>;
</script>
