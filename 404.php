<?php get_header(); ?>


<div id="content">
 
		<h1 class="page_head">404 Error Page</h1>
		<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '','' ); } ?></p>
	 </div>

	
				   <div class="pagespot">

			<div class="post archive-spot">
										
											<h2><?php if ( get_option( 'ptthemes_404error_name' ) ) {echo get_option( 'ptthemes_404error_name' );
} else { esc_html_e( 'Oops! Something went wrong.', 'answers' );}?></h2>
				
				<div class="cat-spot"><p><?php if ( get_option( 'ptthemes_404solution_name' ) ) {echo get_option( 'ptthemes_404solution_name' );
} else { esc_html_e( 'It looks like nothing was found.No Question Available?', 'answers' ); }?></p></div>

				<div class="fix"></div>
						
			</div><!--/post-->  

		</div><!--/pagespot -->
		

				  </div> <!-- content #end -->

				<?php get_sidebar(); ?>

		
			<?php get_footer(); ?>
