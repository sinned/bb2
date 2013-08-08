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
	$substart       = !empty($_REQUEST['substart']) ? strtolower($_REQUEST['substart']) : 'yes'; // starter or not

	// init
	$price_per_month = 0;
	$foxy_price = '';
	$foxy_subscription_frequency = '';
	$foxy_sub_startdate = '';
	$foxy_sub_enddate = '';

	switch ($subtype) {
		case 'cocktails':
			$product_title = "Cocktails Subscription";
			$product_description = "Cocktails are the best!";
			$right_img_url = "/img/cocktails_right.jpg";
			$product_name = $subfreq == 'monthly' ? "Monthly Cocktails Subscription, $subduration months" : "Prepaid Cocktails Subscription, $subduration months";
			$price_per_month = 100;
		break;
		case 'spirits':
			$product_title = "Spirits Subscription";	
			$product_description = "Spirits are the best!";
			$right_img_url = "/img/spirits_right.jpg";			
			$product_name = $subfreq == 'monthly' ? "Monthly Spirits Subscription, $subduration months" : "Prepaid Spirits Subscription, $subduration months";
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
					$monthend = $subduration - 1; // subtract 1 from the months to get the right month to end in.
					$subscription_endtimestamp = strtotime("today +$monthend months");
					$foxy_sub_enddate = date('Ym16', $subscription_endtimestamp);
				break;		
				case 'inf':
			}			
	}

	// set the foxycart shipto value
	$foxy_shipto = $subfor == 'gift' ? $shipto : '';
	$foxy_product_code = strtoupper($subtype) . '-' . strtoupper($subfreq) . '-' . strtoupper($subduration);


?><!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Buy Cocktails: Bitters+Bottles</title>
  <?php include "includes/scripts.php"; ?>

  <script type="text/javascript">
  	var price_per_month = <?php echo $price_per_month; ?>;
  	var subscription_type = '<?php echo $subtype; ?>';
  	var product_code = '<?php echo $foxy_product_code; ?>';
	$(document).ready(function() {
  	    bb.subscription.init();
  	});

  </script>
</head>
<body>
	<?php include "includes/header.php"; ?>


	<div class="row">
		<div class="large-8 small-12 column">
			<div class="row">
				<div class="large-12 column">
					<h1><?php echo $product_title; ?></h1>
					<p><?php echo $product_description; ?></p>
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
							<h5>What is the name of the recipient?</h5>
							<input type="text" value='Giftee'/>
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
							<li><a id='subduration_inf' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=inf&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $subduration=='inf' ? 'picked' : ''; ?> <?php echo $subfreq=='once' ? 'disabled' : ''; ?>">∞</a></li>
						</ul>
					</div>
				</div>

				<div class="row">
					<div class="large-3 column">
						<h4>Include Starter Kit?</h4>
					</div>
					<div class="large-9 column">
						<ul class="small-block-grid-2">
							<li><a id='substart_yes' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=yes&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $substart=='yes' ? 'picked' : ''; ?>">Yes</a></li>
							<li><a id='substart_no' href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=no&amp;shipto=<?php echo $shipto; ?>" class="large button expand <?php echo $substart=='no' ? 'picked' : ''; ?>">No</a></li>
						</ul>
					</div>
				</div>	
			</div>

			<div class="row">
				<div class="large-2 column">
					<h3>Price:</h3>
				</div>
				<div class="small-12 large-10 column price_description">
					<h3 id='price_desc'>
					<?php if ($subfreq == 'once') { ?>
						$<?php echo number_format($foxy_price,2); ?>
					<?php } else { ?>
						$<?php echo number_format($price_per_month,2); ?> / month <?php echo $subduration == 'inf' ? 'until you cancel' : 'for ' .$subduration. ' months'; ?> 
					<?php } ?>
					</h3>
					<h3 id="starter_price" class='<?php echo $substart == 'yes' ? '' : 'hide'; ?>'>
						$20 for the starter kit
					</h3>
				</div>
			</div>

			<div class="row">
				<div class="large-12 column">
					<form id="buy-subscription" action="https://bittersandbottles.foxycart.com/cart" method="post" accept-charset="utf-8">
					<input type="hidden" name="name" value="<?php echo $product_name; ?>" />
					<input type="hidden" name="category" value="SUBSCRIPTION" />
					<input type="hidden" name="price" value="<?php echo $foxy_price; ?>" />
					<input type="hidden" name="code" value="<?php echo $foxy_product_code; ?>" />
					<input type="hidden" name="sub_frequency" value="<?php echo $foxy_subscription_frequency; ?>" />
					<input type="hidden" name="sub_startdate" value="<?php echo $foxy_sub_startdate; ?>" />
					<input type="hidden" name="sub_enddate" value="<?php echo $foxy_sub_enddate; ?>" />
					<input type="hidden" name="shipto" value="<?php echo $foxy_shipto; ?>" />
					<input type="hidden" name="empty" value="true" />
					</form>				
					<a id="subscribe-process" href="#" class='button large expand success'>Buy Subscription</a>

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
