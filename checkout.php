<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Bitters+Bottles</title>
	<link href='http://fonts.googleapis.com/css?family=Cabin:700|Ropa+Sans|Fauna+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://bittersandbottles.foxycart.com/themes/standard/styles.css" type="text/css" media="screen" charset="utf-8" />
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
 
  FC.checkout.config.customShipping = {
    onLoad: true,  // Set to false if you don't want shipping calculated when the checkout loads
    onLocationChange: false, // Set to true if your shipping logic relies on updating whenever the shipping location for the order changes
    onPreSubmit: true // Set to false if you don't want to load shipping if it hasn't already loaded before the user tries to checkout
  };
 
  function customShippingLogic() {
    /* BEGIN CUSTOM SHIPPING LOGIC */
  	addShippingOption(1, 0, '', 'Shipped via USPS/UPS');
  	addShippingOption(2, 0, '', 'Local Pickup');
  	FC.locations.limitCountriesTo(["US"];
  	FC.locations.limitStatesTo("US", ["CA", "NY"], "shipping");
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
	<?php include "includes/footer.php"; ?>
</body>
</html>
