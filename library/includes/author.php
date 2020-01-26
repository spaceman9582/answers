<?php get_header(); ?>
<?php
if ( isset( $_GET['author_name'] ) ) :
	$curauth = get_userdatabylogin( $author_name );
else :
	$curauth = get_userdata( intval( $_REQUEST['uid'] ) );
endif;

?> 
<?php
global $current_user;
$blog_catids = array();
$commentposts = array();
$blog_catids = get_blog_cat_postids();
$userID = $curauth->ID;
if ( $current_user->data->ID == $curauth->ID ) {
	$querypost['post_status'] = 'draft,publish';
}

$commentposts = users_comments_postids( $curauth->ID );
if ( $commentposts ) {
	$author_totalpost_count = count( explode( ',',$commentposts ) );
}
//$author_totalpost_count= get_usernumposts_count($curauth->ID);

$querypost['post__not_in'] = explode( ',',$blog_catids );
$querypost['post__in'] = explode( ',',$commentposts );
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
