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
  <title>Checkout: Bitters + Bottles</title>
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
  _gaq.push(['_trackPageview', '/checkout']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
 
<script type="text/javascript" charset="utf-8">
	function ga_tracker() {
		if (typeof(fc_json.custom_fields['ga']) != "undefined" && jQuery('#fc_payment_method_paypal').is(":checked") == true) {
			_gaq.push(['_trackPageview', '/paypal_payment']);
			// setTimeout('return true;', 250); // TODO
		}
	}
	FC.checkout.overload('validateAndSubmit', 'ga_tracker', null);
</script>

<script type="text/javascript" charset="utf-8">
	//<![CDATA[
	jQuery(document).ready(function() {
 
		/* BEGIN CUSTOM LOCATION LOGIC */
 
		FC.locations.limitCountriesTo("US", "shipping");
		FC.locations.limitStatesTo("US", ["CA","NY"]);
		FC.checkout.requireShippingAddress();
 
		/* END CUSTOM LOCATION LOGIC */
 
		FC.locations.updateFoxyComplete(true);

		/* Change "Future Subscriptions" to "Charged Monthly */
		$('.fc_future_subscriptions label').html('Charged as Shipped Monthly');
		$('tr#fc_cart_foot_subscriptions td.fc_col1').html('Charged as Shipped Monthly');
		$('tr#fc_cart_foot_total td.fc_col1').html('Today&rsquo;s Total <br />Subscriptions will be charged once we ship.');

		/* Business Shipping Recoemmendation */
		$('#fc_shipto_0').before('<p style="margin:10px 0;"><i>We strongly recommend shipping to a business address.</i></p>')

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
<script type="text/javascript" charset="utf-8">
  //<![CDATA[
 
  FC.checkout.config.customShipping = {
    onLoad: true,  // Set to false if you don't want shipping calculated when the checkout loads
    onLocationChange: false, // Set to true if your shipping logic relies on updating whenever the shipping location for the order changes
    onPreSubmit: true // Set to false if you don't want to load shipping if it hasn't already loaded before the user tries to checkout
  };
 
  function customShippingLogic() {
    /* BEGIN CUSTOM SHIPPING LOGIC */
 	//addShippingOption(1, 0, '', 'Standard Delivery');
	//addShippingOption(2, 0, '', 'Local Pickup');
    /* END CUSTOM SHIPPING LOGIC */
  }
 
  //]]>
</script>
 
<script type="text/javascript" charset="utf-8">
  //<![CDATA[
  /* Multiple Flat Rate Shipping Options Logic v2.4 */
 
  jQuery(document).ready(function() {
    jQuery("#fc_custom_shipping_methods_container").on('click', 'input[name=shipping_service]', function(){
      shipping_service_description = jQuery(this).siblings(".fc_shipping_carrier").html();
      shipping_service_description += ((shipping_service_description == "") ? '' : ' ');
      shipping_service_description += jQuery(this).siblings(".fc_shipping_service").html();
      $("#shipping_details").val(shipping_service_description);
      // Launch FoxyCart functionality
      FC.checkout.updatePrice(-1);
    });
 
    if (FC.checkout.config.customShipping.onLoad) {
      runShippingLogic();
    }
 
    if (FC.checkout.config.customShipping.onLocationChange) {
      isValidateAndSubmit = false;
      FC.checkout.overload("updateTaxes", function() { if (!isValidateAndSubmit) { runShippingLogic(); } }, null);
      FC.checkout.overload("validateAndSubmit", function() { isValidateAndSubmit = true; }, function() { isValidateAndSubmit = false });
    }
 
    if (FC.checkout.config.customShipping.onPreSubmit) {
      FC.checkout.overload("validateAndSubmit", function() {if (!jQuery("#shipping_service_id").length) { runShippingLogic(); }}, null);
    }
  });
 
  function runShippingLogic() {
    // Check to see if there are actually shippable products in the current cart before running the custom shipping (0.7.1+ only), or just run it for older carts
    if ((typeof(FC.checkout.config.hasShippableProducts) === "boolean" && FC.checkout.config.hasShippableProducts) || typeof(FC.checkout.config.hasShippableProducts) === "undefined") {
        customShippingLogic();
    }
  }
 
  // example: addShippingOption(1, 4.99, 'PostBox', 'Express Local');
  function addShippingOption(code, cost, carrier, service) {
    if (jQuery("#fc_shipping_methods_inner").length == 0) {
      addCustomShippingContainer();
    }
    carrier = (typeof(carrier) == 'undefined' || carrier == null) ? "" : carrier;
    service = (typeof(service) == 'undefined' || service == null) ? "" : service;
    var newShippingOption = '<label for="shipping_service_' + code + '" class="fc_radio"><input type="radio" class="fc_radio fc_required" value="' + code + '|' + cost + '" id="shipping_service_' + code + '" name="shipping_service" /><span class="fc_shipping_carrier">' + carrier + '</span><span class="fc_shipping_service">' + service + '</span><span class="fc_shipping_cost">' + FC.formatter.currency(cost, true) + '</span></label>';
    jQuery("#fc_shipping_methods_inner").append(newShippingOption);
  }
 
  // example: updateShippingOptionCost(1, 4);
  function updateShippingOptionCost(code, cost) {
    jQuery("input#shipping_service_" + code).val(code + '|' + cost).siblings("span.fc_shipping_cost").html(FC.formatter.currency(cost, true));
    FC.checkout.updatePrice(-1);
  }
 
  // example: removeShippingOption(1);
  function removeShippingOption(code) {
    jQuery("label[for=shipping_service_" + code + "]").remove();
    if (jQuery("#fc_shipping_methods_inner").html() == "") {
      removeCustomShippingContainer();
    }
    FC.checkout.updatePrice(-1);
  }
 
  function addCustomShippingContainer() {
 
jQuery("#fc_custom_shipping_methods_container").html('<h2>Shipping Options</h2><div class="fc_row fc_shipping_methods_container" id="fc_shipping_methods_container"><div class="fc_radio_group_container fc_row fc_shipping_methods" id="fc_shipping_methods"><input type="hidden" value="0" id="shipping_service_id" name="shipping_service_id"><input type="text" style="display:none;" value="" id="shipping_service_description" name="shipping_service_description"><input type="text" value="" id="shipping_details" name="Shipping_Details" style="display:none;" /><div class="fc_shipping_methods_inner" id="fc_shipping_methods_inner"></div><label style="display: none;" class="fc_error" for="fc_shipping_methods">Please select a shipping method.</label></div></div>');
  }
 
  function removeCustomShippingContainer() {
    jQuery("#fc_custom_shipping_methods_container").html("");
    FC.checkout.updatePrice(-1);
  }
  //]]>
</script>
</head>
<body>

	<?php include "includes/header.php"; ?>

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

	<?php include "includes/footer.php"; ?>
</body>
</html>
