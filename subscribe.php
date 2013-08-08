<?php

	function validate_subscription_choices ($subtype, $subfor, $subfreq, $subnew, $substart) {
		$subtype_choices = array('cocktails','liquor');
		$subfor_choices = array('me','gift');
		$subfreq_choices = array('3','6','9','12','inf');
		$subnew_choices = array('new','existing');
		$substart_choices = array('starter','no');
		$valid_subscription = in_array($subtype, $subtype_choices) && in_array($subfor, $subfor_choices) && in_array($subfreq, $subfreq_choices) && in_array($subnew, $subnew_choices) && in_array($substart, $substart_choices);

		return $valid_subscription;
	}

	// choices picked for the subscription options...
	$subtype       = !empty($_REQUEST['subtype']) ? strtolower($_REQUEST['subtype']) : 'cocktails'; // subscription type
	$subfor       = !empty($_REQUEST['subfor']) ? strtolower($_REQUEST['subfor']) : 'me'; // who this subscription is for
	$shipto       = !empty($_REQUEST['shipto']) ? strtolower($_REQUEST['shipto']) : ''; // who this subscription is for

	$subfreq       = !empty($_REQUEST['subfreq']) ? strtolower($_REQUEST['subfreq']) : '3'; // subscription frequency
	$subnew       = !empty($_REQUEST['subnew']) ? strtolower($_REQUEST['subnew']) : 'new'; // new or existing subscription
	$substart       = !empty($_REQUEST['substart']) ? strtolower($_REQUEST['substart']) : 'starter'; // starter or not

	// init
	$price_per_term = 0;

	switch ($subtype) {
		case 'cocktails':
		break;
		case 'liquor':
		break;
	}



	switch ($subfreq) {
		case '3':
			$price_per_term = 35;
			$foxy_subscription_frequency = '3m';
		break;
		case '6':
			$price_per_term = 75;
			$foxy_subscription_frequency = '6m';		
		break;
		case '9':
			$price_per_term = 115;
			$foxy_subscription_frequency = '9m';		
		break;
		case '12':
			$price_per_term = 175;
			$foxy_subscription_frequency = '1y';		
		break;		
		case 'inf':
			$price_per_term = 10;
			$foxy_subscription_frequency = '1m';
	}

	// set the foxycart shipto value
	$foxy_shipto = $subfor == 'gift' ? $shipto : '';

	$foxy_product_code = strtoupper($subtype) . '-SUB-' . strtoupper($subfreq);


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
		<div class="large-12 column">
			<h1>Subscribe Today!</h1>
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
					<li><a href="subscribe.php?subtype=cocktails&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;subnew=<?php echo $subnew; ?>&amp;substart=<?php echo $substart; ?>" class="large button expand <?php echo $subtype=='cocktails' ? 'picked' : ''; ?>">Cocktails</a></li>
					<li><a href="subscribe.php?subtype=liquor&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;subnew=<?php echo $subnew; ?>&amp;substart=<?php echo $substart; ?>" class="large button expand <?php echo $subtype=='liquor' ? 'picked' : ''; ?>">Liquor</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="large-2 column">
				<h4>Step 2</h4>
			</div>
			<div class="large-10 column">
				<ul class="small-block-grid-2">
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=me&amp;subfreq=<?php echo $subfreq; ?>&amp;subnew=<?php echo $subnew; ?>&amp;substart=<?php echo $substart; ?>" class="large button expand  <?php echo $subfor=='me' ? 'picked' : ''; ?>">This is for Me </a></li>
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=gift&amp;subfreq=<?php echo $subfreq; ?>&amp;subnew=<?php echo $subnew; ?>&amp;substart=<?php echo $substart; ?>" class="large button expand  <?php echo $subfor=='gift' ? 'picked' : ''; ?>">This is a Gift </a></li>
				</ul>
				Who is this gift for?
				<input type="text" id="shipto" />
			</div>
		</div>

		<div class="row">
			<div class="large-2 column">
				<h4>Step 3</h4>
			</div>
			<div class="large-10 column">
				<ul class="small-block-grid-4">
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=3&amp;subnew=<?php echo $subnew; ?>&amp;substart=<?php echo $substart; ?>" class="large button expand <?php echo $subfreq=='3' ? 'picked' : ''; ?>">3 Months</a></li>
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=6&amp;subnew=<?php echo $subnew; ?>&amp;substart=<?php echo $substart; ?>" class="large button expand <?php echo $subfreq=='6' ? 'picked' : ''; ?>">6 Months</a></li>
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=12&amp;subnew=<?php echo $subnew; ?>&amp;substart=<?php echo $substart; ?>" class="large button expand <?php echo $subfreq=='12' ? 'picked' : ''; ?>">12 Months</a></li>
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=inf&amp;subnew=<?php echo $subnew; ?>&amp;substart=<?php echo $substart; ?>" class="large button expand <?php echo $subfreq=='inf' ? 'picked' : ''; ?>">∞</a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="large-2 column">
				<h4>Step 4</h4>
			</div>
			<div class="large-10 column">
				<ul class="small-block-grid-2">
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;subnew=new&amp;substart=<?php echo $substart; ?>" class="large button expand <?php echo $subnew=='new' ? 'picked' : ''; ?>">New</a></li>
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;subnew=existing&amp;substart=<?php echo $substart; ?>" class="large button expand <?php echo $subnew=='existing' ? 'picked' : ''; ?>">Existing</a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="large-2 column">
				<h4>Step 5</h4>
			</div>
			<div class="large-10 column">
				<ul class="small-block-grid-2">
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;subnew=<?php echo $subnew; ?>&amp;substart=starter" class="large button expand <?php echo $substart=='starter' ? 'picked' : ''; ?>">Starter</a></li>
					<li><a href="subscribe.php?subtype=<?php echo $subtype; ?>&amp;subfor=<?php echo $subfor; ?>&amp;subfreq=<?php echo $subfreq; ?>&amp;subnew=<?php echo $subnew; ?>&amp;substart=no" class="large button expand <?php echo $substart=='no' ? 'picked' : ''; ?>">No</a></li>
				</ul>
			</div>
		</div>	
	</div>

	<div class="row">
		<div class="large-2 column">
		</div>
		<div class="small-12 large-10 column">
			<h2>Price: $<?php echo number_format($price_per_term,2); ?> / <?php echo $foxy_subscription_frequency; ?></h2>
		</div>
	</div>

	<div class="row">
		<div class="large-12 column">

			<?php
				if (validate_subscription_choices($subtype, $subfor, $subfreq, $subnew, $substart)) {
			?>
			<form id="buy-subscription" action="https://bittersandbottles.foxycart.com/cart" method="post" accept-charset="utf-8">
			<input type="hidden" name="name" value="<?php echo ucfirst($subtype); ?> Subscription" />
			<input type="hidden" name="price" value="<?php echo $price_per_term; ?>" />
			<input type="hidden" name="code" value="<?php echo $foxy_product_code; ?>" />
			<input type="hidden" name="sub_frequency" value="<?php echo $foxy_subscription_frequency; ?>" />
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


	<?php include "includes/footer.php"; ?>
</body>
</html>
