<?php

	date_default_timezone_set('America/Los_Angeles');

	function validate_subscription_choices ($subtype, $subfor, $subfreq, $subduration, $substart) {
		$subtype_choices = array('cocktails','spirits');
		$subfor_choices = array('me','gift');
		$subfreq_choices = array('once','monthly');
		$subduration_choices = array('3','6','9','12','inf');
		$substart_choices = array('starter','no');
		$valid_subscription = in_array($subtype, $subtype_choices) 
							&& in_array($subfor, $subfor_choices) 
							&& in_array($subduration, $subduration_choices) 
							&& in_array($subfreq, $subfreq_choices) 
							&& in_array($substart, $substart_choices);

		return $valid_subscription;
	}

	// choices picked for the subscription options...
	$subtype       = !empty($_REQUEST['subtype']) ? strtolower($_REQUEST['subtype']) : 'cocktails'; // subscription type
	$subfor       = !empty($_REQUEST['subfor']) ? strtolower($_REQUEST['subfor']) : 'me'; // who this subscription is for
	$shipto       = !empty($_REQUEST['shipto']) ? strtolower($_REQUEST['shipto']) : ''; // who this subscription is for
	$subfreq       = !empty($_REQUEST['subfreq']) ? strtolower($_REQUEST['subfreq']) : 'monthly'; // how often to bill
	$subduration       = !empty($_REQUEST['subduration']) ? strtolower($_REQUEST['subduration']) : '12'; // how long to subscribe for
	$substart       = !empty($_REQUEST['substart']) ? strtolower($_REQUEST['substart']) : 'starter'; // starter or not

	// init
	$price_per_month = 0;
	$foxy_price = '';
	$foxy_subscription_frequency = '';
	$foxy_sub_startdate = '';
	$foxy_sub_enddate = '';

	switch ($subtype) {
		case 'cocktails':
			$product_name = "Cocktails Subscription";
			$price_per_month = 100;
		break;
		case 'spirits':
			$product_name = "Spirits Subscription";
			$price_per_month = 75;
		break;
	}

	switch($subfreq) {
		case 'once':
			$foxy_price = $price_per_month * $subduration;
			break;
		case 'monthly':
		default:
			$foxy_price = $price_per_month;
			$foxy_subscription_frequency = '1m';
			$foxy_sub_startdate = '15';
			switch ($subduration) {
				case '3':
				case '6':
				case '9':
				case '12':
					$subscription_enddate = strtotime('today +3 months');
					echo 'MOOP' . $subscription_enddate;
					$foxy_sub_enddate = '';
				break;		
				case 'inf':
			}			
	}

	// set the foxycart shipto value
	$foxy_shipto = $subfor == 'gift' ? $shipto : '';

	$foxy_product_code = strtoupper($subtype) . '-SUB-' . strtoupper($subduration);


?><!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Buy Cocktails: Bitters+Bottles</title>

  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/bittersbottles.css">
  
  <script src="js/vendor/custom.modernizr.js"></script>
  <?php include "includes/scripts.php"; ?>
</head>
<body>
	<?php include "includes/header.php"; ?>


	<div class="row">
		<div class="large-8 small-12 column">
			<div class="row">
				<div class="large-12 column">
					<h1><?php echo $product_name; ?></h1>
					<p>Text here</p>
				</div>
			</div>

			<div class="subscription-choices">
				<div class="row">
					<div class="large-2 column">
						<h4>Step 1</h4>
					</div>
					<div class="large-10 column">
						<ul class="small-block-grid-2">
							<li><a id='subfor_me' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=me&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="large button expand  <?php echo $subfor=='me' ? 'picked' : ''; ?>">This is for Me </a></li>
							<li><a id='subfor_gift' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=gift&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="large button expand  <?php echo $subfor=='gift' ? 'picked' : ''; ?>">This is a Gift </a></li>
						</ul>
						<div id='whofor' class='<?php echo $subfor=='gift' ? '' : 'hide'; ?>'>
							<h5>Who is this gift for?</h5>
							<input type="text" value='<?php echo $shipto; ?>'/>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="large-2 column">
						<h4>Step 2</h4>
					</div>
					<div class="large-10 column">
						<ul class="small-block-grid-2">
							<li><a id='subfreq_monthly' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=monthly&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $subfreq=='monthly' ? 'picked' : ''; ?>">Monthly</a></li>
							<li><a id='subfreq_once' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=once&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $subfreq=='once' ? 'picked' : ''; ?>">Pay Once</a></li>
						</ul>
					</div>
				</div>		

				<div class="row">
					<div class="large-2 column">
						<h4>Step 3</h4>
					</div>
					<div class="large-10 column">
						<ul class="small-block-grid-4">
							<li><a id='subduration_3' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=3&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $subduration=='3' ? 'picked' : ''; ?>">3 Months</a></li>
							<li><a id='subduration_6' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=6&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $subduration=='6' ? 'picked' : ''; ?>">6 Months</a></li>
							<li><a id='subduration_12' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=12&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $subduration=='12' ? 'picked' : ''; ?>">12 Months</a></li>
							<li><a id='subduration_inf' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=inf&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $subduration=='inf' ? 'picked' : ''; ?>">∞</a></li>
						</ul>
					</div>
				</div>

				<div class="row">
					<div class="large-2 column">
						<h4>Step 4</h4>
					</div>
					<div class="large-10 column">
						<ul class="small-block-grid-2">
							<li><a id='substart_starter' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=starter&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $substart=='starter' ? 'picked' : ''; ?>">Starter</a></li>
							<li><a id='substart_no' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=no&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $substart=='no' ? 'picked' : ''; ?>">No</a></li>
						</ul>
					</div>
				</div>	
			</div>

			<div class="row">
				<div class="large-2 column">
				</div>
				<div class="small-12 large-10 column">
					<h3>Price:
					<?php if ($subfreq == 'once') { ?>
						$<?php echo number_format($foxy_price,2); ?>
					<?php } else { ?>
						$<?php echo number_format($price_per_month,2); ?> / month <?php echo $subduration == 'inf' ? 'until you cancel' : 'for ' .$subduration. ' months'; ?> 
					<?php } ?>
					</h3>
				</div>
			</div>

			<div class="row">
				<div class="large-12 column">

					<?php
						if (validate_subscription_choices($subtype, $subfor, $subfreq, $subduration, $substart)) {
					?>
					<form id="buy-subscription" action="https://bittersandbottles.foxycart.com/cart" method="post" accept-charset="utf-8">
					<input type="hidden" name="name" value="<?php echo $product_name; ?>" />
					<input type="hidden" name="category" value="SUBSCRIPTION" />
					<input type="hidden" name="price" value="<?php echo $foxy_price; ?>" />
					<input type="hidden" name="code" value="<?php echo $foxy_product_code; ?>" />

					<?php if ($subfreq == 'monthly') { ?>
					<input type="hidden" name="sub_frequency" value="<?php echo $foxy_subscription_frequency; ?>" />
					<input type="hidden" name="sub_startdate" value="<?php echo $foxy_sub_startdate; ?>" />
					<input type="hidden" name="sub_enddate" value="<?php echo $foxy_sub_enddate; ?>" />
					<?php } ?>

					<input type="hidden" name="shipto" value="<?php echo $foxy_shipto; ?>" />

					<input type="submit" name="Buy Subscription" value="Buy Subscription" class="expand large button success submit" />
					</form>				
					<?php
						} else {
					?>
					<button class="button large expand disabled">Buy Subscription</button>
					<?php
						}
					?>			

				</div>	
			</div>
		</div>
		<div class="large-4 hide-for-small column">
			<h5 style='background:#eee;height:100%;text-align:center;'>IMAGE HERE</h5>
		</div>
	</div>	


	<?php include "includes/footer.php"; ?>
</body>
</html>
