<?php
$querypost = '';
if ( isset( $_REQUEST['ptype'] ) && ($_REQUEST['ptype'] == 'answers' || $_REQUEST['ptype'] == '') ) {
	$post_arr = array();
	$comment_arry = get_comments( array(
		'number' => 10,
	) );
	for ( $i = 0;$i < count( $comment_arry );$i++ ) {
		$post_id = $comment_arry[ $i ]->comment_post_ID;
		$post_arr[] = $comment_arry[ $i ]->comment_post_ID;
		$comment_content = $comment_arry[ $i ]->comment_content;
		$comment_date = $comment_arry[ $i ]->comment_date;
	}
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'latest' ) {
	$querypost = array(
		'orderby' => 'post_date',
	);
	function filter_where( $where = '' ) {
		$blog_catids = get_blog_cat_postids();
		if ( $blog_catids ) {
			$where .= " AND ID not in ($blog_catids)";
		}
		return $where;
	}
	add_filter( 'posts_where', 'filter_where' );
	query_posts( $query_string );
} else {
	if ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'popular' ) {
		$querypost = array(
			'orderby' => 'comment_count',
		);
		function filter_where( $where = '' ) {
			  $where .= ' AND comment_count!=0';
			  $blog_catids = get_blog_cat_postids();
			if ( $blog_catids ) {
				$where .= " AND ID not in ($blog_catids)";
			}
				return $where;
		}

		add_filter( 'posts_where', 'filter_where' );
		query_posts( $query_string );
	} else {
		function filter_where( $where = '' ) {
			  $where .= ' AND comment_count=0';
			  $blog_catids = get_blog_cat_postids();
			if ( $blog_catids ) {
				$where .= " AND ID not in ($blog_catids)";
			}
				return $where;
		}
		add_filter( 'posts_where', 'filter_where' );
		query_posts( $query_string );
	}
}// End if().

$totalpost_count = 0;
$limit = 1000;
$querypost1 = $querypost;
$querypost1['showposts'] = $limit;
query_posts( $querypost1 );
if ( have_posts() ) {
	while ( have_posts() ) {
		 the_post();
		$totalpost_count++;
	}
}
global $posts_per_page,$paged;
$limit = $posts_per_page;
$querypost['showposts'] = $limit;
$querypost['paged'] = $paged;
query_posts( $querypost );


?>   
 
	<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>



<?php get_question_info_li( $post );	?>
	<?php endwhile; ?>
 
  <div class="pagination">
	<?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
	<?php wp_pagenavi(); ?>
	<?php } ?>
  </div>
 
<?php endif; ?>
