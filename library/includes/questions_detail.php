<?php
if ( $_SERVER['HTTP_REFERER'] == '' || ! strstr( $_SERVER['HTTP_REFERER'],$_SERVER['REQUEST_URI'] ) ) {
	$question_viewed_count = get_post_meta( $post->ID,'question_viewed_count',true );
	update_post_meta( $post->ID,'question_viewed_count',$question_viewed_count + 1 );}
?>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/js/ck-karma.js"></script> 
<div id="content">
 

<div class="posts">

<div class="question_list">
		<span class="answers_total">
		<a href="<?php the_permalink(); ?>#commentarea"><?php comments_number( '0', '1', '%' ); ?> </a>   <?php _e( 'Answers' );?>
		</span>
		
		<h1> <?php the_title(); ?></h1>
		<p> <span class="user"><?php _e( 'Asked by' );?>: <strong><?php the_author_posts_link(); ?></strong> </span> 
		<span class="views"><b><?php echo user_post_visit_count( $post->ID );?></b> <?php _e( 'views' );?></span>  
		<?php the_tags( '<span class="ptags">', ', ', '<br /> </span>' ); ?>
		<span class="pcate">  <?php the_category( ', ' ); ?> </span> 
	   </p>
	   </div> <!-- question #end -->
<!--01.28 saijiro	   =============================================-->
		<div class="question-desc">
<!--      restore=====================================================================================================================================-->
<!--            --><?php
//                $meta_arr = get_post_meta(get_the_ID(), '', true);
//                foreach ($meta_arr as $key => $val){
//                    $img_title = get_post_meta( $val[0], '_wp_attached_file');
//                    if($img_title != null){
//
//            ?>
<!--                <img src="--><?php //echo get_option( 'siteurl' ).'/wp-content/uploads/'.$img_title[0];?><!--"  height="120" width="120">-->
<!--            --><?php
//                    }
//                }
//            ?>

<!--       restore=====================================================================================================================================-->
<!--01.28 saijiro	   =============================================-->
		<?php
//            the_content();
        ?>

		</div>

				<?php
				//echo get_usermeta($post->post_author, 'user_phone');
				//echo nl2br(get_usermeta($post->post_author, 'description'));
		?>
	   
</div>

<div id="comments">  <?php comments_template(); ?></div>
		 
</div> <!-- content #end -->

<?php get_sidebar(); ?>
