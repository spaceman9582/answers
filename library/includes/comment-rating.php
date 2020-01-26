<?php
global $table_prefix, $wpdb;
// caching database query per comment
$ck_cache = array(
	'ck_ips' => '',
	'ck_comment_id' => 0,
	'ck_rating_up' => 0,
	'ck_rating_down' => 0,
);

$table_name = $table_prefix . 'comment_rating';
if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
	temckrating_install();
}

function temckrating_install() {
	global $table_prefix, $wpdb;

	$table_name = $table_prefix . 'comment_rating';

	$sql = 'DROP TABLE IF EXISTS `' . $table_name . '`';  // drop the existing table
	$wpdb->query( $sql );
	$sql = 'CREATE TABLE `' . $table_name . '` (' //Add table
	  . ' `ck_comment_id` BIGINT(20) NOT NULL, '
	  . ' `ck_ips` text NOT NULL, '
	  . ' `ck_rating_up` INT,'
	  . ' `ck_rating_down` INT'
	  . ' )'
	  . ' ENGINE = myisam;';
	$wpdb->query( $sql );
	$sql = 'ALTER TABLE `' . $table_name . '` ADD INDEX (`ck_comment_id`);';  // add index
	$wpdb->query( $sql );

	// echo "comment_rating tables created";

		   $ck_result = $wpdb->get_results( 'SELECT comment_ID FROM ' . $table_prefix . 'comments' ); //Put all IDs in our new table
	if ( ! empty( $ck_result ) ) {
		foreach ( $ck_result as $ck_row ) {
			$wpdb->query( "INSERT INTO $table_name (ck_comment_id, ck_ips, ck_rating_up, ck_rating_down) VALUES ('" . $ck_row->comment_ID . "', '', 0, 0)" );
		}
	}
}

function temckrating_comment_posted( $ck_comment_id ) {
	global $table_prefix, $wpdb;
	$table_name = $table_prefix . 'comment_rating';
	$wpdb->query( "INSERT INTO $table_name (ck_comment_id, ck_ips, ck_rating_up, ck_rating_down) VALUES ('" . $ck_comment_id . "', '" . getenv( 'REMOTE_ADDR' ) . "', 0, 0)" ); //Adds the new comment ID into our made table, with the users IP
}

// cache DB results to prevent multiple access to DB
function temckrating_get_rating( $comment_id ) {
	global $ck_cache, $table_prefix, $wpdb;

	// return it if the value is in the cache
	if ( $comment_id == $ck_cache['ck_comment_id'] ) { return;
	}

	$table_name = $table_prefix . 'comment_rating';
	$ck_sql = "SELECT ck_ips, ck_rating_up, ck_rating_down FROM `$table_name` WHERE ck_comment_id = $comment_id";
	$ck_result = $wpdb->query( $ck_sql );

	$ck_cache['ck_comment_id'] = $comment_id;
	if ( ! $ck_result ) {
		$ck_cache['ck_ips'] = '';
		$ck_cache['ck_rating_up'] = 0;
		$ck_cache['ck_rating_down'] = 0;
		$wpdb->query( "INSERT INTO $table_name (ck_comment_id, ck_ips, ck_rating_up, ck_rating_down) VALUES ('" . $comment_id . "', '', 0, 0)" );
	} elseif ( ! empty( $ck_result ) ) {
		$ck_cache['ck_ips'] = '';
		$ck_cache['ck_rating_up'] = 0;
		$ck_cache['ck_rating_down'] = 0;
		$wpdb->query( "INSERT INTO $table_name (ck_comment_id, ck_ips, ck_rating_up, ck_rating_down) VALUES ('" . $comment_id . "', '', 0, 0)" );
	} else {
		$ck_cache['ck_ips'] = $ck_row['ck_ips'];
		$ck_cache['ck_rating_up'] = $ck_row['ck_rating_up'];
		$ck_cache['ck_rating_down'] = $ck_row['ck_rating_down'];
	}
}

// Display images and rating in comments
function temckrating_display_content() {
	global $ck_cache,$wpdb,$table_prefix;
	$plugin_path = get_template_directory_uri();
	$ck_link = str_replace( '//', '', get_bloginfo( 'wpurl' ) );
	$ck_comment_ID = get_comment_ID();
	$content = '';
	temckrating_get_rating( $ck_comment_ID );
	$comment_ratting_table = $table_prefix . 'comment_rating';
	$total_points = $wpdb->get_var( "select (ck_rating_up-ck_rating_down) from $comment_ratting_table where ck_comment_id=\"$ck_comment_ID\"" );
	if ( $total_points > 0 ) {
		$total_points = '+' . $total_points;
	} elseif ( $total_points < 0 ) {
		$total_points = $total_points;
	} else {
		$total_points = '0';
	}

	$imgIndex = '2_14_';

	if ( strstr( $ck_cache['ck_ips'], getenv( 'REMOTE_ADDR' ) ) ) {
		$imgUp = $imgIndex . 'gray_up.png';
		$imgDown = $imgIndex . 'gray_down.png';
		$imgStyle = 'style="padding: 0px; margin: 0px; border: none;"';
		$onclick_add = '';
		$onclick_sub = '';
	} else {
		$imgUp = $imgIndex . 'up.png';
		$imgDown = $imgIndex . 'down.png';
		if ( get_option( 'ckrating_mouseover' ) == 1 ) {
			// no effect
			$imgStyle = 'style="padding: 0px; border: none; cursor: pointer;"';
		} else { 		 // enlarge
			$imgStyle = 'style="padding: 0px; border: none; cursor: pointer;"';
		}

		$ratingurl = get_option( 'siteurl' ) . '/?ptype=crating';
		$onclick_add = "onclick=\"javascript:ckratingKarma('$ck_comment_ID', 'add', '$ratingurl', '$imgIndex');\" title=\"" . get_option( 'ckrating_up_alt_text' ) . '"';
		$onclick_sub = "onclick=\"javascript:ckratingKarma('$ck_comment_ID', 'subtract', '$ratingurl', '$imgIndex')\" title=\"" . get_option( 'ckrating_down_alt_text' ) . '"';
	}

	$total = $ck_cache['ck_rating_up'] - $ck_cache['ck_rating_down'];
	if ( $total > 0 ) {$total = "+$total";}
	//Use onClick for the image instead, fixes the style link underline problem as well.
	$likesStyle = 'style="' . get_option( 'ckrating_likes_style' ) . ';"';
	$dislikesStyle = 'style="' . get_option( 'ckrating_dislikes_style' ) . ';"';
	// apply ckrating_vote_type
	//$content .='<span class=total_points><span id="karma-'.$ck_comment_ID.'-total" class=bnone>'.$total_points.'</span> <b>'.__('Votes').'</b></span>';
	$content .= '<span id="karma-' . $ck_comment_ID . '-total" class=bnone>' . $total_points . ' <b>' . __( 'Votes' ) . '</b></span>';

	if ( get_option( 'ckrating_vote_type' ) != 'dislikes' ) {
		$content .= " <img $imgStyle class=\"up-thumb\" id=\"up-$ck_comment_ID\" src=\"{$plugin_path}/images/$imgUp\" alt=\"" . __( 'Thumb up' ) . "\" $onclick_add />";
		if ( get_option( 'ckrating_value_display' ) != 'one' ) {
			$content .= " <span id=\"karma-{$ck_comment_ID}-up\" $likesStyle class=up_points>{$ck_cache['ck_rating_up']} <b>Votes</b></span>";
		}
	}
	if ( get_option( 'ckrating_vote_type' ) != 'likes' ) {
		$content .= "&nbsp;<img $imgStyle class=\"down-thumb\" id=\"down-$ck_comment_ID\" src=\"{$plugin_path}/images/$imgDown\" alt=\"" . __( 'Thumb down' ) . "\" $onclick_sub />"; //Phew
		if ( get_option( 'ckrating_value_display' ) != 'one' ) {
			$content .= " <span id=\"karma-{$ck_comment_ID}-down\" $dislikesStyle class=down_points>{$ck_cache['ck_rating_down']} <b>Votes</b></span>";
		}
	}

	$totalStyle = '';
	if ( $total > 0 ) { $totalStyle = $likesStyle;
	} elseif ( $total < 0 ) { $totalStyle = $dislikesStyle;
	}
	if ( get_option( 'ckrating_value_display' ) == 'one' ) {
		$content .= " <span id=\"karma-{$ck_comment_ID}-total\" $totalStyle>{$total} <b>Votes</b></span>";
	}
	if ( get_option( 'ckrating_value_display' ) == 'three' ) {
		$content .= " (<span id=\"karma-{$ck_comment_ID}-total\" $totalStyle>{$total} <b>Votes</b></span>)";
	}

	return array( $content, $ck_cache['ck_rating_up'], $ck_cache['ck_rating_down'] );
}

// Display images and rating for widget on sidebar
function temckrating_display_sidebar( $ck_comment_ID ) {
	global $ck_cache;
	$plugin_path = get_bloginfo( 'wpurl' ) . '/wp-content/plugins/comment-rating';
	$ck_link = str_replace( '//', '', get_bloginfo( 'wpurl' ) );
	$content = '';
	temckrating_get_rating( $ck_comment_ID );

	$imgIndex = get_option( 'ckrating_image_index' ) . '_' . get_option( 'ckrating_image_size' ) . '_';
	$imgUp = $imgIndex . 'up.png';
	$imgDown = $imgIndex . 'down.png';
	$imgStyle = 'style="padding: 0px; border: none;"';
	$onclick_add = '';
	$onclick_sub = '';

	$total = $ck_cache['ck_rating_up'] - $ck_cache['ck_rating_down'];
	if ( $total > 0 ) { $total = "+$total";
	}
	//Use onClick for the image instead, fixes the style link underline problem as well.

	$likesStyle = 'style="' . get_option( 'ckrating_likes_style' ) . ';"';
	$dislikesStyle = 'style="' . get_option( 'ckrating_dislikes_style' ) . ';"';
	// Use ckrating_karma_type to determine the image shape
	if ( get_option( 'ckrating_karma_type' ) != 'dislikes' ) {
		$content .= "&nbsp;<img $imgStyle src=\"{$plugin_path}/images/$imgUp\" alt=\"" . __( 'Thumb up' ) . "\" $onclick_add />";
		if ( get_option( 'ckrating_value_display' ) != 'one' ) {
			$content .= "&nbsp;<span $likesStyle>{$ck_cache['ck_rating_up']}</span>";
		}
	}
	if ( get_option( 'ckrating_karma_type' ) != 'likes' ) {
		$content .= "&nbsp;<img $imgStyle src=\"{$plugin_path}/images/$imgDown\" alt=\"" . __( 'Thumb down' ) . "\" $onclick_sub />"; //Phew
		if ( get_option( 'ckrating_value_display' ) != 'one' ) {
			$content .= "&nbsp;<span $dislikesStyle>{$ck_cache['ck_rating_down']}</span>";
		}
	}

	$totalStyle = '';
	if ( $total > 0 ) { $totalStyle = $likesStyle;
	} elseif ( $total < 0 ) { $totalStyle = $dislikesStyle;
	}
	if ( get_option( 'ckrating_value_display' ) == 'one' ) {
		$content .= "&nbsp;<span id=\"karma-{$ck_comment_ID}-total\" $totalStyle>{$total} <b>Votes</b></span>";
	}
	if ( get_option( 'ckrating_value_display' ) == 'three' ) {
		$content .= "&nbsp;(<span id=\"karma-{$ck_comment_ID}-total\" $totalStyle>{$total} <b>Votes</b></span>)";
	}

	return $content;
}

function temckrating_display_filter( $text ) {
	$ck_comment_ID = get_comment_ID();
	$ck_comment = get_comment( $ck_comment_ID );
	$ck_comment_author = $ck_comment->comment_author;
	$ck_author_name = get_the_author();

	/*if (get_option('ckrating_admin_off') == 'yes' &&
       ($ck_author_name == $ck_comment_author || $ck_comment_author == 'admin')
      )
      return $text;*/

	$arr = temckrating_display_content();

	// $content is the modifed comment text.
	$text = $arr[0];
	$content = $text;
	// No auto insertion of images and ratings
	return '<p>' . $arr[0] . '</p>';
}

function temckrating_display_karma() {
	$arr = temckrating_display_content();
	// print $arr[0];
}


function temckrating_add_highlight_style() {
	if ( get_option( 'ckrating_inline_style_off' ) == 'yes' ) { return;
	}

	echo '
<!-- Comment Rating plugin Version: ' . COMMENTRATING_VERSION . ' by Bob King, //wealthynetizen.com/, dynamic comment voting & styling. --> 
<style type="text/css" media="screen">
   .ckrating_highly_rated {' . get_option( 'ckrating_styleComment' ) . ';}
   .ckrating_poorly_rated {' . get_option( 'ckrating_hide_style' ) . ';}
   .ckrating_hotly_debated {' . get_option( 'ckrating_style_debated' ) . ';}
</style>

';
}

function temckrating_comment_class( $classes, $class, $comment_id, $page_id ) {
	// Don't style the comment box
	if ( get_option( 'ckrating_style_comment_box' ) == 'no' ) { return $classes;
	}

	global $ck_cache;
	//get the comment object, in case $comment_id is not passed.
	$ck_comment_ID = get_comment_ID();
	temckrating_get_rating( $ck_comment_ID );

	if ( ( (int) $ck_cache['ck_rating_up'] - (int) $ck_cache['ck_rating_down'])
			  >= (int) get_option( 'ckrating_goodRate' ) ) {
		//add comment highlighting class
		$classes[] = 'ckrating_highly_rated';
	} elseif ( ( (int) $ck_cache['ck_rating_down'] - (int) $ck_cache['ck_rating_up'])
			>= (int) get_option( 'ckrating_negative' ) ) {
		//add hiding comment class
		$classes[] = 'ckrating_poorly_rated';
	} elseif ( ( (int) $ck_cache['ck_rating_down'] + (int) $ck_cache['ck_rating_up'])
			>= (int) get_option( 'ckrating_debated' ) ) {
		$classes[] = 'ckrating_hotly_debated';
	}

		//send the array back
	return $classes;
}


