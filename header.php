<?php
	if (is_front_page()){
		$js_homepage = 1;
	} else {
		$js_homepage = 0;
	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
    
    <!-- Bootstrap -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 

		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookies.2.2.0.min.js"></script>
		
    <script>
		var gIsHomepage = <?php echo $js_homepage; ?>;
        var templateUrl = '<?php echo site_url(); ?>';
    </script>
    
		<script src="https://use.typekit.net/aki1dfw.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>   
		
    <style type="text/css">
      .acf-map {
      	width: 100%;
      	height: 400px;
      	border: #ccc solid 1px;
      	margin: 20px 0;
      }

      /* fixes potential theme css conflict */
      .acf-map img {
         max-width: inherit !important;
      }
    </style>

    <?php wp_head(); ?>
    
  </head>
  
  <body <?php body_class(); ?>>
  	<?php include_once("inc/analyticstracking.php") ?>
  	
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=158552637664275";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

    <!-- <div class="feedback-form-container">
			<h2>Feedback form goes here...</h2>
			<a href="#" class="close-form">Close</a>
    </div> -->

    <div class="signup-form-container">
      <div class="inner">
          <?php echo do_shortcode('[contact-form-7 id="2090" title="Subscribe Header Form"]'); ?>
          <a href="#" class="close-form">Close</a>
      </div>
    </div>
    
    <div class="search-container">
        <form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
					<input class="search-input" type="search" name="s" placeholder="<?php _e( 'Enter text', 'html5blank' ); ?>">
					<button class="search-submit" type="submit" role="button"><?php _e( 'Search', 'youniverse' ); ?></button>
					<a href="#" class="close-form">Close</a>
        </form>
    </div>
    
    <div id="site_wrapper" class="container-fluid">
       
			<div id="cookies" class="row">
				<div class="content_wrap">
					<p>We use cookies to ensure that we give you the best experience on our website. This includes cookies from third party social media websites 
					if you visit a page which contains embedded content from social media. Such third party cookies may track your use of the Enable website. Cookie 
					settings can be changed within your browser.
					<span id="cookie_btns"><a id="cookie_continue" href="#" title="I want to continue to use the site">OK</a><a id="cookie_link" href="/privacy-cookies/" title="Find out more about our cookies policy">Find out more</a></span>
					</p>
				</div>
			</div>
  
		<?php get_template_part('inc/menu'); ?>
   