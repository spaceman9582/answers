<?php get_header(); ?>
<?php
if ( isset( $_GET['author_name'] ) ) :
	$curauth = get_userdatabylogin( $author_name );
else :
	$curauth = get_userdata( intval( $author ) );
endif;
?> 
<?php
global $current_user;
function filter_where( $where = '' ) {
	global $curauth;
	$blog_catids = get_blog_cat_postids();
	if ( $blog_catids ) {
		$where .= " AND ID not in ($blog_catids) ";
		if ( isset( $_GET['answered'] ) && $_GET['answered'] ) {
			$commentposts = users_comments_postids( $curauth->ID );
			$where .= " AND ID in ($commentposts) ";
		}
		if ( isset( $_GET['points'] ) && $_GET['points'] ) {
			$commentposts = users_comments_postids( $curauth->ID );
			$where .= " AND ID in ($commentposts) ";
		}
	}
	return $where;
}

add_filter( 'posts_where', 'filter_where' );
query_posts( $query_string );
if ( isset( $_GET['answered'] ) && $_GET['answered'] ) {
	$querypost['author'] = '';
} else {
	if ( $current_user->data->ID == $curauth->ID ) {
		$userID = $curauth->ID;
		$querypost['author'] = $userID;
		$querypost['post_status'] = 'draft,publish';
	} else {
		$userID = $curauth->ID;
		$querypost['author'] = $userID;
	}
}
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
$author_totalpost_count = get_usernumposts_count( $curauth->ID );

?>
<?php include( TEMPLATEPATH . '/library/includes/author_detail.php' );?> <!-- content #end -->

				<?php get_sidebar(); ?>  
	<?php get_footer(); ?>
