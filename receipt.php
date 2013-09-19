<?php
$notcheckout = false; // hide zepto. zepto was causing JS errors in Foxy
switch ($_SERVER['SERVER_NAME']) {
	case 'localhost':
		define('WEBROOT', '/bb2/');
	break;
	default:
		define('WEBROOT', '/');
}
?><!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Receipt: Bitters + Bottles</title>
	<link rel="stylesheet" href="https://bittersandbottles.foxycart.com/themes/standard/styles.css" type="text/css" media="screen" charset="utf-8" />
<link href='http://fonts.googleapis.com/css?family=Abel|Antic+Slab' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo WEBROOT; ?>stylesheets/normalize.css" />

<link rel="stylesheet" href="<?php echo WEBROOT; ?>stylesheets/app.css" />
<link rel="stylesheet" href="<?php echo WEBROOT; ?>stylesheets/orbit.css">
<link rel="stylesheet" href="<?php echo WEBROOT; ?>stylesheets/bittersbottles.css" />

<!-- BEGIN FOXYCART FILES -->
<link rel="stylesheet" href="//cdn.foxycart.com/static/scripts/colorbox/1.3.23/style1_fc/colorbox.css?ver=1" type="text/css" media="screen" charset="utf-8" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="//cdn.foxycart.com/bittersandbottles/foxycart.colorbox.js?ver=2" type="text/javascript" charset="utf-8"></script>
<!-- END FOXYCART FILES -->
<script type="text/javascript" charset="utf-8">
	if (window.location.hash.search(/utma/) == -1 && typeof(fc_json.custom_fields['ga']) != "undefined") {
		if (fc_json.custom_fields['ga'].length > 0) {
			window.location.hash = fc_json.custom_fields['ga'].replace( /\&amp;/g, '&' );
		}
	}
</script>
<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40569793-2']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_setAllowAnchor', true]);
  _gaq.push(['_trackPageview', '/receipt']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
 
^^receipt_only_begin^^
^^analytics_google_ga_async^^
^^receipt_only_end^^
</head>
<body>

	<?php include "includes/header.php"; ?>

	<div class="row">
		<div class="large-12 column">
			<p>Thank you for your purchase.  
				<br />
				A confirmation has been sent to your email. If you have any questions please feel free to email info@bittersandbottles.com  </p>
		</div>
	</div>

	<div class="row">
		<div class="large-12 column">
			^^cart^^
			^^receipt^^	
		</div>
	</div>

	<?php include "includes/footer.php"; ?>
</body>
</html>
