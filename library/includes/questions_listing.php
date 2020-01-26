<?php get_header(); ?>
 

		<div id="content">


									<?php if ( is_category() ) { ?>
		<h1  class="page_head" ><?php echo single_cat_title(); ?> </h1>  

		<?php } elseif ( is_day() ) { ?>
		<h1  class="page_head"><?php the_time( 'F jS, Y' ); ?> </h1>

		<?php } elseif ( is_month() ) { ?>
		<h1  class="page_head"><?php the_time( 'F, Y' ); ?> </h1>

		<?php } elseif ( is_year() ) { ?>
		<h1  class="page_head"><?php the_time( 'Y' ); ?> </h1>
		
		<?php } elseif ( is_author() ) { ?>
		<h1  class="page_head"><?php echo $curauth->nickname; ?> </h1>
						
		<?php } elseif ( is_tag() ) { ?>
		<h1  class="page_head"><?php echo single_tag_title( '', true ); ?> </h1>
		
		<?php } ?>

				<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '','' ); } ?></p>
	 </div>

							<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post() ?>
	
					<?php get_question_info_li( $post );	?>
				<?php endwhile; ?>

						   <div class="pagination">
				<?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
				<?php wp_pagenavi(); ?>
				<?php } ?>
			  </div>

							<?php endif; ?>

					
						   </div> <!-- content #end -->

				<div id="sidebar" >
			
						<?php include( TEMPLATEPATH . '/library/includes/ask_question_button.php' );?>

								<?php dynamic_sidebar( 5 );  ?> 

				
					   </div> <!-- sidebar #end -->

	<?php get_footer(); ?>
