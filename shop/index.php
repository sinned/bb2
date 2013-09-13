<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Bitters+Bottles</title>
  <?php include "../includes/scripts.php"; ?>

</head>
<body>
	<?php include "../includes/header.php"; ?>
	<div class="row">
		<div class="large-12 column">
			<h1>Shop</h1>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<table class="shop">
				<tr>
					<td>
						<h4>Bulleit Bourbon</h4>
						<img src="<?php echo WEBROOT; ?>img/shop/bulleit-bourbon.jpg" alt="Bulleit Bourbon" />
						<form action="https://bittersandbottles.foxycart.com/cart" method="post">
							<input type="hidden" name="name" value="Bulleit Bourbon" />
							<input type="hidden" name="price" value="25.00" />
							<inpyt type="hidden" name="image" value="http://www.bittersandbottles.com/img/shop/bulleit-bourbon.jpg" />
							<input type="submit" value="Add to Cart" />
						</form>		
					</td>
					<td>
						<h4>Diet Coke</h4>
						<img src="<?php echo WEBROOT; ?>img/shop/diet-coke.jpg" alt="Diet Coke" />
						<form action="https://bittersandbottles.foxycart.com/cart" method="post">
							<input type="hidden" name="name" value="Diet Coke" />
							<inpyt type="hidden" name="image" value="http://www.bittersandbottles.com/img/shop/diet-coke.jpg" />				
							<input type="hidden" name="price" value="1.00" />
							<input type="submit" value="Add to Cart" />
						</form>				
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php include "../includes/footer.php"; ?>
</body>
</html>
