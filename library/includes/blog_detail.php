<div id="content">
 			
            
                <div id="post-<?php the_ID(); ?>" class="posts">

				
								 <h1 class="page_head"><?php the_title(); ?></h1>
				<div class="breadcrumbs">
					<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '','' ); } ?></p>
				 </div>

				
				
				
				
				 
				  
									<div class="post_right"> 
					  <div class="post_left clearfix">
					<span> Posted by  <?php the_author_posts_link(); ?> </span>
				   <span> on <?php the_time( 'F j, Y' ) ?> </span> 
					<span> | <a href="<?php the_permalink(); ?>#commentarea"><?php comments_number( '0 Comments', '1 Comments', '% Comments' ); ?></a> </span>
					<?php /*?><span>  <?php _e(CATEGORY_TEXT);?> : <?php the_category(" &amp;"); ?> </span>
                    <?php the_tags('<span> Tags : ', ', ', '<br /> </span>'); ?> <?php */?>
				  </div>

											<?php the_content(); ?>
					 </div> 
					 
											
				</div><!--/post-->

				
									<div class="single_post_advt">
						<?php if ( get_option( 'ptthemes_single_post_advt' ) != '' ) { ?>
							<?php echo stripslashes( get_option( 'ptthemes_single_post_advt' ) );  ?>
							<?php } ?>
					</div>

				
			  <div id="comments">  <?php comments_template(); ?></div>

		
				
				   </div> <!-- content #end -->
 
 
	 <div id="sidebar" class="">
		
					<?php include( TEMPLATEPATH . '/library/includes/ask_question_button.php' );?>

						<?php dynamic_sidebar( 6 );  ?>

				 </div>
 
 
</div>
