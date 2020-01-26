<?php get_header(); ?>

	<?php
	if ( is_category() ) {
		$blogcat = get_cat_id_from_name( get_option( 'ptthemes_blogcategory' ) );
		if ( is_category( $blogcat ) || is_sub_category( $blogcat ) ) {
			require_once( TEMPLATEPATH . '/library/includes/blog_listing.php' );
		} else {
			require_once( TEMPLATEPATH . '/library/includes/questions_listing.php' );
		}
	} else {
		require_once( TEMPLATEPATH . '/library/includes/questions_listing.php' );
	}
	?>
<?php get_footer();
