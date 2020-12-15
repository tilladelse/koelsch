<?php get_header(); ?>
<div class="page-content" id="page_content">
	<?php  while ( have_posts() ) : the_post();
		the_content();
	endwhile; ?>
</div>
<?php get_footer(); ?>