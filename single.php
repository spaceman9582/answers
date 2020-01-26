<?php get_header(); ?>
<?php
$blob_posts_arr = explode( ',',get_blog_cat_postids() );
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		if ( in_array( $post->ID,$blob_posts_arr ) ) {
			require_once( TEMPLATEPATH . '/library/includes/blog_detail.php' );
		} else {
			require_once( TEMPLATEPATH . '/library/includes/questions_detail.php' );
		}
		break;
	}
}
?>
<?php get_footer();
