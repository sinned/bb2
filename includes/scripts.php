<?php
switch ($_SERVER['SERVER_NAME']) {
	case 'localhost':
		define('WEBROOT', '/bb2/');
	break;
	default:
		define('WEBROOT', '/');
}
?><link href='http://fonts.googleapis.com/css?family=Abel|Antic+Slab' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo WEBROOT; ?>stylesheets/normalize.css" />

<link rel="stylesheet" href="<?php echo WEBROOT; ?>stylesheets/app.css" />
<link rel="stylesheet" href="<?php echo WEBROOT; ?>stylesheets/orbit.css">
<link rel="stylesheet" href="<?php echo WEBROOT; ?>stylesheets/bittersbottles.css" />

<script src="<?php echo WEBROOT; ?>js/vendor/custom.modernizr.js"></script>

<!-- BEGIN FOXYCART FILES -->
<link rel="stylesheet" href="//cdn.foxycart.com/static/scripts/colorbox/1.3.23/style1_fc/colorbox.css?ver=1" type="text/css" media="screen" charset="utf-8" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="//cdn.foxycart.com/bittersandbottles/foxycart.colorbox.js?ver=2" type="text/javascript" charset="utf-8"></script>
<!-- END FOXYCART FILES -->
<script src="<?php echo WEBROOT; ?>js/vendor/jquery.cookie.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo WEBROOT; ?>js/bittersbottles.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo WEBROOT; ?>js/app.js" type="text/javascript" charset="utf-8"></script>
