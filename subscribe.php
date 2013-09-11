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
	$subtype       = !empty($_REQUEST['subtype']) ? strtolower($_REQUEST['subtype']) : ''; // subscription type
	$subfor       = !empty($_REQUEST['subfor']) ? strtolower($_REQUEST['subfor']) : ''; // who this subscription is for
	$shipto       = !empty($_REQUEST['shipto']) ? strtolower($_REQUEST['shipto']) : ''; // who this subscription is for
	$subfreq       = !empty($_REQUEST['subfreq']) ? strtolower($_REQUEST['subfreq']) : ''; // how often to bill
	$subduration       = !empty($_REQUEST['subduration']) ? strtolower($_REQUEST['subduration']) : ''; // how long to subscribe for
	$substart       = !empty($_REQUEST['substart']) ? strtolower($_REQUEST['substart']) : ''; // starter or not

	// init
	$price_per_month = 0;
	$foxy_price = '';
	$foxy_subscription_frequency = '';
	$foxy_sub_startdate = '';
	$foxy_sub_enddate = '';

	switch ($subtype) {
		case 'cocktails':
			$product_title = "Cocktails";
			$product_description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus quis nunc ut hendrerit. Integer sit amet mauris fringilla tellus scelerisque aliquet ac egestas metus. Fusce dignissim molestie turpis, non venenatis elit iaculis et. Nulla at faucibus neque, quis ornare arcu. Fusce elementum ligula est, bibendum porta tellus lacinia ut. Mauris venenatis arcu et vestibulum auctor. Nulla elementum enim non mi faucibus pretium. Cras ultrices commodo rutrum. Nullam nec sapien scelerisque, condimentum mi at, commodo sapien.";
			$right_img_url = "/img/cocktails_right.jpg";
			$product_name = $subfreq == 'monthly' ? "Monthly Cocktails Subscription, $subduration months" : "Prepaid Cocktails Subscription, $subduration months";
			$price_per_month = 95;
		break;
		case 'spirits':
			$product_title = "Spirits";	
			$product_description = "Build your home bar<br />Receive, sip, and discover a rare spirit every month<br />Let us be your spirit guide";
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

			// figure out subscription start
			$today = strtotime("now");

			// if it's after the 10th, then start it next month.
			$dayofmonth_today = date('j', $today);
			if ($dayofmonth_today > 10) {
				$next_month = strtotime("now +1month");
				$subscription_starttimestring = date("F ", $next_month) . date("10, Y", $today);
			} else {
				$subscription_starttimestring = date("F 10, Y", $today);
			}

			$subscription_starttimestamp = strtotime($subscription_starttimestring);


			$foxy_sub_startdate = '10';
			switch ($subduration) {
				case '3':
				case '6':
				case '9':
				case '12':
					$monthend = $subduration - 1; // subtract 1 from the months to get the right month to end in.
					$subscription_endtimestamp = strtotime("$subscription_starttimestamp +$monthend months");
					$foxy_sub_enddate = date('Ym16', $subscription_endtimestamp);
				break;		
				case 'inf':
			}			
	}

	// set the foxycart shipto value
	$foxy_shipto = $subfor == 'gift' ? $shipto : '';
	$foxy_product_code = strtoupper($subtype) . '-' . strtoupper($subfreq) . '-' . strtoupper($subduration);


?><!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Buy <?php echo $product_title; ?>: Bitters+Bottles</title>
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
				<div class="large-12 column subscribe-top">
					<h1><?php echo $product_title; ?></h1>
					<p>
						<?php echo $product_description; ?>
						<br />
						$<?php echo $price_per_month; ?> / month
					</p>
				</div>
			</div>

			<div class="show-subscription-choices">
				<div class="row">
					<div class="large-12 small=12 column text-center">
						<h3>Ready to buy?</h3>
						<button class="button success">Get Started Now.</button>
					</div>
				</div>
			</div>

			<div class="subscription-choices hide">
				<div class="row">
					<div class="large-12 column text-center" />
						<h3>Please make your selections:</h3>
						<br />
					</div>
				</div>

				<div class="row">
					<div class="large-1 column hide-for-small ">
						<h4>1</h4>
					</div>
					<div class="large-11 small-12 column">
						<ul class="small-block-grid-2">
							<li><a id='subfor_me' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=me&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="choice1 medium secondary button expand  <?php echo $subfor=='me' ? 'picked' : ''; ?>">This is for Me </a></li>
							<li><a id='subfor_gift' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=gift&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="choice1 medium secondary button expand  <?php echo $subfor=='gift' ? 'picked' : ''; ?>">This is a Gift </a></li>
						</ul>
						<div id='whofor' class='<?php echo $subfor=='gift' ? '' : 'hide'; ?>'>
							<h5>What is the name of the recipient?</h5>
							<input type="text" value='' placeholder='Lucky Recipient&rsquo;s Name' />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="large-1 column hide-for-small">
						<h4>2</h4>
					</div>
					<div class="large-11 small-12 column">
						<ul class="small-block-grid-2">
							<li><a id='subfreq_monthly' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=monthly&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="choice2 medium secondary button expand <?php echo $subfreq=='monthly' ? 'picked' : ''; ?>">Monthly</a></li>
							<li><a id='subfreq_once' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=once&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="choice2 medium secondary button expand <?php echo $subfreq=='once' ? 'picked' : ''; ?>">Pay Once</a></li>
						</ul>
					</div>
				</div>		

				<div class="row">
					<div class="large-1 column hide-for-small">
						<h4>3</h4>
					</div>
					<div class="large-11 small-12 column">
						<ul class="small-block-grid-4 months">
							<li><a id='subduration_3' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=3&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="choice3 medium secondary button expand <?php echo $subduration=='3' ? 'picked' : ''; ?>">3 Months</a></li>
							<li><a id='subduration_6' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=6&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="choice3 medium secondary button expand <?php echo $subduration=='6' ? 'picked' : ''; ?>">6 Months</a></li>
							<li><a id='subduration_12' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=12&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="choice3 medium secondary button expand <?php echo $subduration=='12' ? 'picked' : ''; ?>">12 Months</a></li>
							<li><a id='subduration_inf' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=inf&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=<?php echo $substart; ?>&amp;shipto=<?php echo $shipto; ?>" class="choice3 medium secondary button expand <?php echo $subduration=='inf' ? 'picked' : ''; ?> <?php echo $subfreq=='once' ? 'disabled' : ''; ?>">∞</a></li>
						</ul>
					</div>
				</div>

				<div class="row">
					<div class="large-1 column hide-for-small">
						<h4>4</h4>
					</div>
					<div class="large-11 small-12 column">
						<ul class="small-block-grid-2">
							<li><a id='substart_yes' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=yes&amp;shipto=<?php echo $shipto; ?>" class="choice4 medium secondary button expand <?php echo $substart=='yes' ? 'picked' : ''; ?>">I need bar tools.</a></li>
							<li><a id='substart_no' href="<?php echo WEBROOT; ?>subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subduration=<?php echo $subduration; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;substart=no&amp;shipto=<?php echo $shipto; ?>" class="choice4 medium secondary button expand <?php echo $substart=='no' ? 'picked' : ''; ?>">I don't need bar tools.</a></li>
						</ul>
					</div>
				</div>	

				<div class="row">
					<div class="large-2 column">
						<p>Price:</p>
					</div>
					<div class="large-10 column price_description">
						<p id='price_desc'>
						<?php if ($subfreq == 'once') { ?>
							$<?php echo number_format($foxy_price,2); ?>
						<?php } elseif ($subfreq == 'monthly') { ?>
							$<?php echo number_format($price_per_month,2); ?> / month 
							<?php if ($subduration == 'inf' || is_numeric($subduration)) { ?>
								<?php echo $subduration == 'inf' ? 'until you cancel' : 'for ' .$subduration. ' months'; ?> 
							<?php } ?>
						<?php } else { ?>
							TBD, depending on your selections.
						<?php } ?>
						</p>
						<p id="starter_price" class='<?php echo $substart == 'yes' ? '' : 'hide'; ?>'>
							$20 for the barware caboodle in the first shipment
						</p>
					</div>
				</div>
				<div class="row">
					<div class="large-2 column">
							<p>
								Ships:
							</p>
					</div>
					<div class="large-10 column price_description">
						<p>
							2nd week of <?php echo date('F', strtotime($subscription_starttimestring)); ?>
						</p>
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
						<!-- <input type="hidden" name="empty" value="true" /> -->
						</form>				
						<a id="subscribe-process" href="#" class='button large expand'>Add to Cart</a>

					</div>	
				</div>
			</div>

		</div>


		<div class="large-4 hide-for-small column">
			<h5 class='sidebar-<?php echo $subtype; ?>'></h5>
		</div>
	</div>	


	<?php include "includes/footer.php"; ?>
</body>
</html>
