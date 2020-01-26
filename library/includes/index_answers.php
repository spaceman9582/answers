<?php
global $wpdb;
$post_arr = array();
$blogcatcatids = get_blog_cat_postids();
$commentsql = "select * from $wpdb->comments where comment_approved =1 ";
if ( $blogcatcatids ) {
	$commentsql .= " and comment_post_ID  not in ($blogcatcatids) ";
}
$commentsql .= ' order by comment_date desc limit 10';
$comment_arry1 = $wpdb->get_results( $commentsql );
?>
  
<?php
foreach ( $comment_arry1 as $comment_arry ) {
	global $post;
	$post_id = $comment_arry->comment_post_ID;
	$comment_ID = $comment_arry->comment_ID;
	$comment_content = $comment_arry->comment_content;
	if ( strlen( $comment_content ) > 200 ) {
		$comment_content = substr( $comment_content,0,200 ) . '...';
	}
	$comment_date = $comment_arry->comment_date;
	$comment_author = $comment_arry->comment_author;
	$post_data = get_posts( array(
		'include' => array( $post_id ),
	) );
	$post = $post_data[0];
	$user_id = $comment_arry->user_id;
?>
<div class="question_list">
	<span class="answers_total">
	<a href="<?php the_permalink(); ?>#commentarea"><?php comments_number( '0', '1', '%' ); ?> </a>   <?php _e( 'Answers' );?> 
	</span>

		<h3> <a href="<?php the_permalink() ?>#comment-<?php echo $comment_ID;?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	<p><?php echo $comment_content;?></p>
	<p> <span class="user"><?php _e( 'Answered by' );?>: <a href="<?php echo get_option( 'siteurl' )?>/?ptype=author_answers&uid=<?php echo $user_id;?>"><strong><?php echo $comment_author; ?></strong></a> </span> 
	<span class="views"><b><?php echo user_post_visit_count( $post->ID );?> </b> <?php _e( 'views' );?> </span> 
	<?php the_tags( '<span class="ptags">', ', ', '<br /> </span>' ); ?> 
   </p>
	<?php if ( $post->post_author == $current_user->data->ID ) {?>
	<span class="status"><?php if ( $post->post_status == 'publish' ) { _e( $post->post_status . 'ed' );
} else { _e( $post->post_status );}?></span> 
	<?php if ( $post->post_status == 'draft' ) {?>
	<span class="renew"><a href="<?php echo get_option( 'siteurl' )?>/?ptype=ask-a-question&qid=<?php echo $post->ID;?>&renew=1"><?php _e( 'Renew' ); ?></a></span> 
	<?php }?>
	<span class="edit"><a href="<?php echo get_option( 'siteurl' )?>/?ptype=ask-a-question&qid=<?php echo $post->ID;?>"><?php _e( 'Edit' ); ?></a></span> 
	<span class="delete"><a href="<?php echo get_option( 'siteurl' )?>/?ptype=preview&delete=1&qid=<?php echo $post->ID;?>"><?php _e( 'Delete' );?></a></span> 
	<?php }?>
 </div> <!-- question #end -->	
<?php }// End foreach().
?>

	   
 <div class="pagination">
	<?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
	<?php //wp_pagenavi(); ?>
	<?php } ?>
  </div>
