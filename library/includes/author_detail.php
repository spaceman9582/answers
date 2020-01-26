<div id="content">
               <div class="agent_details_main clearfix">
              
              
              <?php
			  if ( $current_user->data->ID == $curauth->ID ) {
				?>
			  <div class="editProfile"><a href="<?php echo get_option( 'siteurl' );?>/?ptype=profile" ><?php _e( PROFILE_EDIT_TEXT );?> </a> </div>
				<?php } ?>		 

			
								<div class="author_photo"><?php get_user_profile_pic( $curauth->ID,150,150 ); ?></div>

										   <div class="agent_biodata">
	
											 <h3><?php echo $curauth->display_name; ?></h3>
	
											   <p class="agent_links clearfix"> 
							<?php
							if ( $curauth->user_url != '' ) {

								$user_url = $curauth->user_url;
								if ( strstr( $user_url,'//' ) || strstr( $user_url,'https://' ) ) { } else {
									$user_url = '//' . $curauth->user_url;
								}
							}
							?>
							<?php if ( $curauth->user_url ) {?> <a href="<?php echo $user_url; ?>"><?php _e( PRO_WEBSITE_TEXT );?> </a> <?php }?>	
							<?php
							if ( $curauth->user_twitter != '' ) {
								$user_twitter = $curauth->user_twitter;
								if ( strstr( $user_twitter,'//' ) || strstr( $user_twitter,'https://' ) ) { } else {
									$user_twitter = '//' . $curauth->user_twitter;
								}
							}
							?> 					  
							<?php if ( $curauth->user_twitter ) {?> | <a href="<?php echo $user_twitter; ?>"><?php _e( PRO_TWITTER_TEXT );?> </a> <?php }?>
							<?php
							if ( $curauth->user_facebook != '' ) {
								$user_facebook = $curauth->user_facebook;
								if ( strstr( $user_facebook,'//' ) || strstr( $user_facebook,'https://' ) ) { } else {
									$user_facebook = '//' . $curauth->user_facebook;
								}
							}
							?> 	
							<?php if ( $curauth->user_facebook ) {?> | <a href="<?php echo $user_facebook; ?>"><?php _e( 'Facebook' );?> </a> <?php }?> 
							<?php if ( $curauth->user_phone ) {?> | <?php _e( 'Phone' );?>:<?php echo $curauth->user_phone; ?> <?php }?> </p>

												  <p class="propertylistinglinks clearfix"> 
						 <span class="i_agent_others"><a href="<?php echo get_author_posts_url( $curauth->ID );?>"><?php _e( 'Questions Asked' );?> : <b><?php echo $author_totalpost_count;?></b></a></span> 
								<?php
								 $creditlink = '';
								if ( strstr( get_author_posts_url( $curauth->ID ),'?' ) ) {
									$creditlink = get_author_posts_url( $curauth->ID ) . '&answered=1';
								} else {
									$creditlink = get_author_posts_url( $curauth->ID ) . '?answered=1';
								}
								$creditlink = get_option( 'siteurl' ) . '/?ptype=author_answers&uid=' . $curauth->ID;
								?>   
							<span class="answers_provider"><a href="<?php echo $creditlink;?>"><?php _e( 'Answers provided' );?> : <b><?php echo users_comments( $curauth->ID );?> </b></a></span> </a>
							 <span class="earn_point"><?php echo __( 'Received Votes&nbsp;&nbsp;' ) . ': <b>' . get_user_points( $curauth->ID ) . '</b>';?></span>

												  </p>
						 <p> <?php echo stripslashes( nl2br( $curauth->user_description ) ); ?> </p>
					 </div>

							</div>
		
							<p>&nbsp;</p>
				<?php
				$tablink = '';
				$authorlink = get_author_posts_url( $curauth->ID );
				if ( strstr( $authorlink,'?' ) ) {
					$answerlink = $authorlink . '&answered=1';
				} else {
					$answerlink = $authorlink . '?answered=1';
				}
				$answerlink = get_option( 'siteurl' ) . '/?ptype=author_answers&uid=' . $curauth->ID;
				?>  
			  <ul class="user_tab clearfix">
			  <li class="page_item <?php if ( isset( $_GET['ptype'] ) && $_GET['ptype'] != 'author_answers' ) {echo 'current_page_item';}?>"><a href="<?php echo $authorlink;?>"><?php _e( 'Questions Asked' );?></a></li> 
			  <li class="page_item <?php if ( isset( $_GET['ptype'] ) && $_GET['ptype'] == 'author_answers' ) {echo 'current_page_item';}?> "><a href="<?php echo $answerlink;?>"><?php _e( 'Answers Provided' );?></a></li>
			 </ul>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

									<?php get_question_info_li( $post );?>
					<?php endwhile; else : ?>
				 <p><?php
					if ( $_GET['ptype'] == 'author_answers' ) {
						  _e( '<b>Sorry No Answers Provided by ' . $curauth->display_name . '.</b>' );
					} else {
						  _e( '<b>Sorry No Questions Asked by ' . $curauth->display_name . '.</b>' );
					}?> </p> 
		
			<?php endif; ?> 
				
  
								 <div class="pagination">            
				<?php
				if ( have_posts() ) {
					if ( function_exists( 'wp_pagenavi' ) ) { ?><?php wp_pagenavi(); ?><?php }
				}?>
			 </div>   

				
				</div>
