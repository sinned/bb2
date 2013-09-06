<?php get_header(); ?>
<?php if ( have_posts() ) : ?>

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<h3><?php echo the_title(); ?></h3>
		<p><?php echo the_content(); ?></p>

	<?php endwhile; ?>

<?php else : ?>
	<p>No posts to show.</p>
<?php endif; ?>
<?php get_footer(); ?>