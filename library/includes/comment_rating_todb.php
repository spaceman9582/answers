<?php
include( 'mysql_connect.inc.php' );
global $wpdb;
$k_id = $wpdb->escape( $_GET['id'] );
$k_action = $wpdb->escape( $_GET['action'] );
//$k_path = $wpdb->escape($_GET['path']);
$k_path = get_template_directory_uri() . '/';
$k_imgIndex = $wpdb->escape( $_GET['imgIndex'] );
$table_name = $wpdb->prefix . 'comment_rating';
$comment_table_name = $wpdb->prefix . 'comments';

if ( $k_id && $k_action && $k_path ) {
	//Check to see if the comment id exists and grab the rating
	$query = $wpdb->prepare( "SELECT * FROM $table_name WHERE ck_comment_id = %d", $k_id );
	$result = $wpdb->query( $query );
	/*mysql_error repalce with mysqli_error*/
	if ( ! $result ) { die( 'error|mysql: ' . mysqli_error() ); }
	if ( ($result) ) {
		$duplicated = 0;  // used as a counter to off set duplicated votes
		// if($row = ($result))
		{
		if ( strstr( $row['ck_ips'], getenv( 'REMOTE_ADDR' ) ) ) {
			// die('error|You have already voted on this item!');
			// Just don't count duplicated votes
			$duplicated = 1;
			$ck_ips = $row['ck_ips'];
		} else {
			$ck_ips = $row['ck_ips'] . ',' . getenv( 'REMOTE_ADDR' ); // IPs are separated by ','
		}
			}

			$total = $row['ck_rating_up'] - $row['ck_rating_down'];
		if ( $k_action == 'add' ) {
			 $rating = $row['ck_rating_up'] + 1 - $duplicated;
			 $direction = 'up';
			 $total = $total + 1 - $duplicated;
		} elseif ( $k_action == 'subtract' ) {
			 $rating = $row['ck_rating_down'] + 1 - $duplicated;
			 $direction = 'down';
			 $total = $total - 1 + $duplicated;
		} else {
			  die( 'error|Try again later' ); //No action given.
		}

		if ( ! $duplicated ) {
			 $query = $wpdb->prepare( "UPDATE `$table_name` SET ck_rating_$direction = '%s', ck_ips = '%s' WHERE ck_comment_id = %d", $rating, $ck_ips, $k_id );
			 $result = $wpdb->query( $query );
			if ( ! $result ) {
				// die('error|query '.$query);
				die( 'error|Query error' );
			}

			 // Now duplicated votes will not
				// if(!mysql_affected_rows())

			 $karma_modified = 0;
			if ( get_option( 'ckrating_karma_type' ) == 'likes' && $k_action == 'add' ) {
				$karma_modified = 1;
				   $karma = $rating;
			}
			if ( get_option( 'ckrating_karma_type' ) == 'dislikes' && $k_action == 'subtract' ) {
				$karma_modified = 1;
				   $karma = $rating;
			}
			if ( get_option( 'ckrating_karma_type' ) == 'both' ) {
				$karma_modified = 1;
				   $karma = $total;
			}

			if ( $karma_modified ) {
				$query = $wpdb->prepare( "UPDATE `$comment_table_name` SET comment_karma = '%s' WHERE comment_ID = %d",$karma, $k_id );
				$result = $wpdb->query( $query );
				if ( ! $result ) { die( 'error|Comment Query error' );
				}
			}
		}
	} else {
		die( 'error|Comment doesnt exist' ); //Comment id not found in db, something wrong ?
	}// End if().
} else {
	die( 'error|Fatal: html format error' );
}// End if().

// Add the + sign,
if ( $total > 0 ) { $total = "+$total"; }

//This sends the data back to the js to process and show on the page
// The dummy field will separate out any potential garbage that
// WP-superCache may attached to the end of the return.
echo("done|$k_id|$rating|$k_path|$direction|$total|$k_imgIndex|dummy");

