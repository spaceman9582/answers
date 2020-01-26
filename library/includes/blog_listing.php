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
	  
					
		
		   
		
		
			<?php

			if ( isset( $_GET['author_name'] ) ) :
				$curauth = get_userdatabylogin( $author_name );
		else :
			$curauth = get_userdata( intval( $author ) );
		endif;

	?>

<?php if ( is_paged() ) { $is_paged = true;} ?>
	<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post() ?>
	
			<div id="post-<?php the_ID(); ?>" class="posts">
			   <div class="post_right">   

								<div class="post_top clearfix">
				 <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				  </div> 
				 <div class="post_left clearfix">
					<span> Posted by  <?php the_author_posts_link(); ?> </span>
				   <span> on <?php the_time( 'F j, Y' ) ?> </span> 
					<span> | <a href="<?php the_permalink(); ?>#commentarea"><?php comments_number( '0 Comments', '1 Comments', '% Comments' ); ?></a> </span>
					<?php /*?><span>  <?php _e(CATEGORY_TEXT);?> : <?php the_category(" &amp;"); ?> </span>
                    <?php the_tags('<span> Tags : ', ', ', '<br /> </span>'); ?> <?php */?>
				  </div>

								
					<?php if ( ( get_post_meta( $post->ID,'image', true ) ) && (get_option( 'ptthemes_timthumb_all' )) ) { ?>
						<?php
						$img_size = bdw_get_images_with_info( $post->ID,'listing-thumb' );
						$post_images = $img_size[0]['file'];
					?>
					<a title="Link to <?php the_title(); ?>" href="<?php the_permalink() ?>"><img src="<?php echo $post_images; ?>" alt="<?php the_title(); ?>" class="fll" style="margin-right:10px; margin-bottom:10px" /></a>          	
												
				<?php } ?>
					
				<?php if ( get_option( 'ptthemes_postcontent_full' ) ) { ?> 
				
					<?php the_content(); ?>
				
				<?php } else { ?>
				
					<?php the_excerpt(); ?>
					
				<?php } ?>
			
			 
					</div>					
			</div><!--/post-->                            
	
		<?php endwhile; ?>
		
		<div class="pagination">
				<?php if ( function_exists( 'wp_pagenavi' ) ) { ?><?php wp_pagenavi(); ?><?php } ?>
		 </div>
		
			<?php endif; ?>
				
		  </div> <!-- content #end -->
		 
 
 <div id="sidebar">
		<?php include( TEMPLATEPATH . '/library/includes/ask_question_button.php' );?>

				<?php dynamic_sidebar( 6 );  ?> 
 </div>
 
<?php get_footer(); ?>
