<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<h3><?php echo the_title(); ?></h3>
		<p><?php echo the_content(); ?></p>

		<nav class="nav-single">
			<span class="nav-previous left"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
			<span class="nav-next right"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
		</nav><!-- .nav-single -->

	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>