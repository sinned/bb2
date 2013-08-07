<?php
	// choices picked for the subscription options...
	$s1       = !empty($_REQUEST['s1']) ? strtolower($_REQUEST['s1']) : '';
	$s2       = !empty($_REQUEST['s2']) ? strtolower($_REQUEST['s2']) : '';
	$s3       = !empty($_REQUEST['s3']) ? strtolower($_REQUEST['s3']) : '';
	$s4       = !empty($_REQUEST['s4']) ? strtolower($_REQUEST['s4']) : '';
	$s5       = !empty($_REQUEST['s5']) ? strtolower($_REQUEST['s5']) : '';


?><!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Buy Cocktails: Bitters+Bottles</title>

  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/bittersbottles.css">
  
  <script src="js/vendor/custom.modernizr.js"></script>

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
					<li><a href="subscribe.php?s1=cocktails&amp;s2=<?php echo $s2; ?>&amp;s3=<?php echo $s3; ?>&amp;s4=<?php echo $s4; ?>&amp;s5=<?php echo $s5; ?>" class="large button expand <?php echo $s1=='cocktails' ? 'picked' : ''; ?>">Cocktails</a></li>
					<li><a href="subscribe.php?s1=liquor&amp;s2=<?php echo $s2; ?>&amp;s3=<?php echo $s3; ?>&amp;s4=<?php echo $s4; ?>&amp;s5=<?php echo $s5; ?>" class="large button expand <?php echo $s1=='liquor' ? 'picked' : ''; ?>">Liquor</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="large-2 column">
				<h4>Step 2</h4>
			</div>
			<div class="large-10 column">
				<ul class="small-block-grid-2">
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=me&amp;s3=<?php echo $s3; ?>&amp;s4=<?php echo $s4; ?>&amp;s5=<?php echo $s5; ?>" class="large button expand  <?php echo $s2=='me' ? 'picked' : ''; ?>">This is for Me </a></li>
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=gift&amp;s3=<?php echo $s3; ?>&amp;s4=<?php echo $s4; ?>&amp;s5=<?php echo $s5; ?>" class="large button expand  <?php echo $s2=='gift' ? 'picked' : ''; ?>">This is a Gift </a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="large-2 column">
				<h4>Step 3</h4>
			</div>
			<div class="large-10 column">
				<ul class="small-block-grid-4">
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=<?php echo $s2; ?>&amp;s3=3&amp;s4=<?php echo $s4; ?>&amp;s5=<?php echo $s5; ?>" class="large button expand <?php echo $s3=='3' ? 'picked' : ''; ?>">3 Months</a></li>
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=<?php echo $s2; ?>&amp;s3=6&amp;s4=<?php echo $s4; ?>&amp;s5=<?php echo $s5; ?>" class="large button expand <?php echo $s3=='6' ? 'picked' : ''; ?>">6 Months</a></li>
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=<?php echo $s2; ?>&amp;s3=12&amp;s4=<?php echo $s4; ?>&amp;s5=<?php echo $s5; ?>" class="large button expand <?php echo $s3=='12' ? 'picked' : ''; ?>">12 Months</a></li>
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=<?php echo $s2; ?>&amp;s3=inf&amp;s4=<?php echo $s4; ?>&amp;s5=<?php echo $s5; ?>" class="large button expand <?php echo $s3=='inf' ? 'picked' : ''; ?>">∞</a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="large-2 column">
				<h4>Step 4</h4>
			</div>
			<div class="large-10 column">
				<ul class="small-block-grid-2">
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=<?php echo $s2; ?>&amp;s3=<?php echo $s3; ?>&amp;s4=new&amp;s5=<?php echo $s5; ?>" class="large button expand <?php echo $s4=='new' ? 'picked' : ''; ?>">New</a></li>
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=<?php echo $s2; ?>&amp;s3=<?php echo $s3; ?>&amp;s4=existing&amp;s5=<?php echo $s5; ?>" class="large button expand <?php echo $s4=='existing' ? 'picked' : ''; ?>">Existing</a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="large-2 column">
				<h4>Step 5</h4>
			</div>
			<div class="large-10 column">
				<ul class="small-block-grid-2">
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=<?php echo $s2; ?>&amp;s3=<?php echo $s3; ?>&amp;s4=<?php echo $s4; ?>&amp;s5=starter" class="large button expand <?php echo $s5=='starter' ? 'picked' : ''; ?>">Starter</a></li>
					<li><a href="subscribe.php?s1=<?php echo $s1; ?>&amp;s2=<?php echo $s2; ?>&amp;s3=<?php echo $s3; ?>&amp;s4=<?php echo $s4; ?>&amp;s5=no" class="large button expand <?php echo $s5=='no' ? 'picked' : ''; ?>">No</a></li>
				</ul>
			</div>
		</div>	
	</div>

	<div class="row">
		<a href="#" class="large button success expand">Buy Subscription</a>
	</div>


	<?php include "includes/footer.php"; ?>
</body>
</html>
