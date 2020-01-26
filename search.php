<?php get_header(); ?>
	<?php if ( is_paged() ) { $is_paged = true;} ?>
  <div id="content">
 
		<?php if ( is_search() ) { ?>
		<h1 class="page_head"><?php _e( 'Search Result -' );?>  <?php printf( __( '%s' ), $s ) ?> </h1>
		<?php } ?>

				<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '','' ); } ?></p>
	 </div>
	<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post() ?>
		
						<?php get_question_info_li( $post );	?>
			<?php endwhile; ?> 
		<?php

			else :
				_e( 'No Question Available' );
				if ( isset( $_POST['search'] ) && $_POST['search'] == 'search' ) {
					echo get_search_param();
				}
			?>
		
			<?php endif; ?>
			 <div class="pagination">
				<?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
				<?php wp_pagenavi(); ?>
				<?php } ?>
			  </div>

				 </div> <!-- content #end -->

				<?php get_sidebar(); ?>  

			<?php get_footer(); ?>
