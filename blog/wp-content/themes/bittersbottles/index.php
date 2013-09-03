<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Bitters+Bottles</title>
  <?php include "includes/scripts.php"; ?>

</head>
<body>
	<?php include "includes/header.php"; ?>
	<div class="row">
		<div class="large-12 column">
			<?php if ( have_posts() ) : ?>

				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<h3><?php echo the_title(); ?></h3>
					<p><?php echo the_content(); ?></p>

				<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</div>

	<?php include "includes/footer.php"; ?>
</body>
</html>
