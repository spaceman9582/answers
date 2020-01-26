<?php
/*
Template Name: Archive Page
*/
?>
<?php get_header(); ?>

<div id="content">
 
		<h1 class="page_head"><?php the_title(); ?></h1>
		<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '','' ); } ?></p>
	 </div>
 

						 <ul> 
				<?php query_posts( 'showposts=60' ); ?>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			  <li>
			<div class="archives-time">
				<?php the_time( 'M j Y' ) ?>
			</div>
			<a href="<?php the_permalink() ?>">
			<?php the_title(); ?>
			</a> - <?php echo $post->comment_count ?> </li>
			<?php endwhile;
endif; ?>
			</ul>

		
		  
	  
		</div> <!-- content #end -->

				<?php get_sidebar(); ?>

			<?php get_footer(); ?>
