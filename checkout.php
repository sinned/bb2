<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Bitters+Bottles</title>
	<link rel="stylesheet" href="https://bittersandbottles.foxycart.com/themes/standard/styles.css" type="text/css" media="screen" charset="utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Cabin:700|Ropa+Sans|Fauna+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="stylesheets/normalize.css" />
	<link rel="stylesheet" href="stylesheets/app.css">
	<link rel="stylesheet" href="stylesheets/bittersbottles.css">

<!-- BEGIN FOXYCART FILES -->
<link rel="stylesheet" href="//cdn.foxycart.com/static/scripts/colorbox/1.3.23/style1_fc/colorbox.css?ver=1" type="text/css" media="screen" charset="utf-8" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="//cdn.foxycart.com/bittersandbottles/foxycart.colorbox.js?ver=2" type="text/javascript" charset="utf-8"></script>
<!-- END FOXYCART FILES -->

<script type="text/javascript" charset="utf-8">
	//<![CDATA[
	jQuery(document).ready(function() {
 
		/* BEGIN CUSTOM LOCATION LOGIC */
 
		FC.locations.limitCountriesTo("US", "shipping");
		FC.locations.limitStatesTo(["CA", "NY"]);
		FC.checkout.requireShippingAddress();
 
		/* END CUSTOM LOCATION LOGIC */
 
		FC.locations.updateFoxyComplete(true);
	});
	//]]>
</script>
 
<script type="text/javascript" charset="utf-8">
	//<![CDATA[
	// Country/State Helper Functions v1.1
	// Do not modify the following functions
 
	FC.locations.removeCountries = function(countries, locationArrayNames) {
		if (typeof countries == "undefined") { return false }
		if (typeof countries == "string") { countries = [countries]; }
		locationArrayNames = FC.locations.validateLocationArrayNames(locationArrayNames);
 
		for (l in locationArrayNames) {
			var locationArray = FC.locations.getLocationArray(locationArrayNames[l]);
			for (var c in countries) {
				if (typeof locationArray[countries[c]] == "undefined") { break; }
				delete locationArray[countries[c]];
			}
		}
 
		return true;
	}
 
	FC.locations.limitCountriesTo = function(countries, locationArrayNames) {
		if (typeof countries == "undefined") { return false }
		if (typeof countries == "string") { countries = [countries]; }
		locationArrayNames = FC.locations.validateLocationArrayNames(locationArrayNames);
 
		for (l in locationArrayNames) {
			var newLocations = {};
			var locationArray = FC.locations.getLocationArray(locationArrayNames[l]);
			for (var c in countries) {
				if (typeof locationArray[countries[c]] == "undefined") { break; }
				newLocations[countries[c]] = locationArray[countries[c]];
			}
 
			// Prevent the countries being set to nothing
			if (newLocations == {}) { return false; }
 
			if (locationArrayNames[l] == "customer") {
				FC.locations.config.locations = newLocations;
			} else {
				FC.locations.config.shippingLocations = newLocations;
			}
		}
		return true;
	}
 
	FC.locations.removeStates = function(country, states, locationArrayNames) {
		if (typeof country == "undefined" || typeof states == "undefined") { return false }
		if (typeof states == "string") { states = [states]; }
		locationArrayNames = FC.locations.validateLocationArrayNames(locationArrayNames);
 
		for (l in locationArrayNames) {
			var locationArray = FC.locations.getLocationArray(locationArrayNames[l]);
			if (typeof locationArray[country] == "undefined") { return false; }
			for (var s in states) {
				if (typeof locationArray[country].r[states[s]] == "undefined") { break; }
				delete locationArray[country].r[states[s]];
			}
		}
		return true;
	}
 
	FC.locations.limitStatesTo = function(country, states, locationArrayNames) {
		if (typeof country == "undefined" || typeof states == "undefined") { return false }
		if (typeof states == "string") { states = [states]; }
		locationArrayNames = FC.locations.validateLocationArrayNames(locationArrayNames);
 
		for (l in locationArrayNames) {
			var newLocations = {};
			var locationArray = FC.locations.getLocationArray(locationArrayNames[l]);
			if (typeof locationArray[country] == "undefined") { return false; }
			for (var s in states) {
				if (typeof locationArray[country].r[states[s]] == "undefined") { break; }
				newLocations[states[s]] = locationArray[country].r[states[s]];
			}
 
			if (locationArrayNames[l] == "customer") {
				FC.locations.config.locations[country].r = newLocations;
			} else {
				FC.locations.config.shippingLocations[country].r = newLocations;
			}
		}
		return true;
	}
 
	FC.locations.updateFoxyComplete = function(blockErrors) {
		FC.checkout.config.evaluateAjaxRequests = false;
 
		FC.checkout.setAutoComplete("customer_country");
		if (jQuery("#customer_country_name") != "") {
			FC.checkout.validateLocationName("customer_country");
		}
		if (jQuery("#customer_state_name").val() != "") {
			FC.checkout.validateLocationName("customer_state");
		}
		if (blockErrors) {
			FC.checkout.updateErrorDisplay("customer_country_name", false);
			FC.checkout.updateErrorDisplay("customer_state_name", false);
		}
		if (!FC.checkout.config.hasMultiship) {
			FC.checkout.setAutoComplete("shipping_country");
			if (jQuery("#shipping_country_name") != "") {
				FC.checkout.validateLocationName("shipping_country");
			}
			if (jQuery("#shipping_state_name") != "") {
				FC.checkout.validateLocationName("shipping_state");
			}
			if (blockErrors) {
				FC.checkout.updateErrorDisplay("shipping_country_name", false);
				FC.checkout.updateErrorDisplay("shipping_state_name", false);
			}
 
			FC.checkout.config.evaluateAjaxRequests = true;
			FC.checkout.updateShipping(-1);
			FC.checkout.updateTaxes(-1);
		} else {
			for (var i = 0; i < FC.checkout.config.multishipDetails.length; i++) {
				FC.checkout.setAutoComplete("shipto_" + i + "_country");
				if (jQuery("#shipto_" + i + "_country_name") != "") {
					FC.checkout.validateLocationName("shipto_" + i + "_country");
				}
				if (jQuery("#shipto_" + i + "_state_name") != "") {
					FC.checkout.validateLocationName("shipto_" + i + "_state");
				}
				if (blockErrors) {
					FC.checkout.updateErrorDisplay("shipto_" + i + "_country_name", false);
					FC.checkout.updateErrorDisplay("shipto_" + i + "_state_name", false);
				}
			}
 
			FC.checkout.config.evaluateAjaxRequests = true;
			for (var i = 0; i < FC.checkout.config.multishipDetails.length; i++) {
				FC.checkout.updateShipping(i);
				FC.checkout.updateTaxes(i);
			}
		}
	}
 
	FC.locations.getLocationArray = function(locationArrayNames) {
		return (locationArrayNames == "customer") ? FC.locations.config.locations : FC.locations.config.shippingLocations;
	}
 
	FC.locations.validateLocationArrayNames = function(locationArrayNames) {
		if (typeof locationArrayNames == "undefined" || locationArrayNames == "" || locationArrayNames == "both") { locationArrayNames = ["customer", "shipping"]; }
		if (typeof locationArrayNames == "string") { locationArrayNames = [locationArrayNames]; }
		return locationArrayNames;
	}
	//]]>
</script>

</head>
<body>
	<div class="row">
		<div class="large-12 column">
			<div class="contain-to-grid fixed">
				<nav class="top-bar">
				  <ul class="title-area">
				    <!-- Title Area -->
				    <li class="name"><h1><a href="index.php">Bitters+Bottles </a></h1>
				    </li>
				    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				    <li class="toggle-topbar"><a href="#"><span>Menu</span></a></li>
				  </ul>

				  <section class="top-bar-section">
				    <ul class="right">				
						<li class="divider"></li>    	
						<li><a href="subscribe.php?subtype=cocktails">Cocktails</a></li>
						<li class="divider"></li>    	
						<li><a href="subscribe.php?subtype=spirits">Spirits</a></li>
						<li class="divider"></li>    	
						<li><a href="http://bittersandbottles.wordpress.com/">Blog</a></li>
						<li class="divider"></li>    	
						<li><a href="http://bittersandbottles.wordpress.com/faq/">FAQ</a></li>
						<li class="divider"></li>    	
						<li><a href="http://bittersandbottles.wordpress.com/contact-us/">Contact Us</a></li>
					</ul>
				  </section>
				</nav>		
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			^^cart^^
			^^checkout^^
			^^custom_begin^^
			<div id="fc_custom_shipping_methods_container">
			</div>
			^^custom_end^^			
		</div>
	</div>

	<div class="row">
		<div class="large-12 column">
			<hr />
      <ul class="inline-list">
        <li><a href="http://bittersandbottles.wordpress.com/faq/">About Us</a></li>
        <li><a href="http://bittersandbottles.wordpress.com/terms/">Terms of Service</a></li>
        <li><a href="http://bittersandbottles.wordpress.com/privacy/">Privacy</a></li>
        <li class="right hide-for-small">Prepared for life.</li>
      <ul>
		</div>
	</div>

  <!-- <script src="js/vendor/zepto.js"></script>  -->
  <script src="js/foundation.min.js"></script>

  
  <script>
    $(document).foundation();
  </script>
</body>
</html>
