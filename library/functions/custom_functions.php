<?php
// Custom fields for WP write panel
// This code is protected under Creative Commons License: //creativecommons.org/licenses/by-nc-nd/3.0/

//Custom Settings
$pt_metaboxes = array(
		'image' => array(
			'name'      => 'image',
			'default'   => '',
			'label'     => 'Custom Image Location',
			'type'      => 'text',
			'desc'      => "Enter full URL path for image to be used by the Dynamic Image resizer. (including <code>//</code>). Image must be uploaded to your blog or it won't resize due to copyright restrictions of TimThumb script. You also need to Chmod <code>cache</code> folder in theme files to 777 restrictions.",
		),
	);

// Excerpt length

function bm_better_excerpt( $length, $ellipsis ) {
	$text = get_the_content();
	$text = strip_tags( $text );
	$text = substr( $text, 0, $length );
	$text = substr( $text, 0, strrpos( $text, ' ' ) );
	$text = $text . $ellipsis;
	return $text;
}
// Custom fields for WP write panel
// This code is protected under Creative Commons License: //creativecommons.org/licenses/by-nc-nd/3.0/

function ptthemes_meta_box_content() {
	global $post, $pt_metaboxes;
	$output = '';
	$output .= '<div class="pt_metaboxes_table">' . "\n";
	foreach ( $pt_metaboxes as $pt_id => $pt_metabox ) {
		if ( $pt_metabox['type'] == 'text' or $pt_metabox['type'] == 'select' or $pt_metabox['type'] == 'checkbox' or $pt_metabox['type'] == 'textarea' ) {
			$pt_metaboxvalue = get_post_meta( $post->ID,$pt_metabox['name'],true );
		}
		if ( $pt_metaboxvalue == '' || ! isset( $pt_metaboxvalue ) ) {
			$pt_metaboxvalue = $pt_metabox['default'];
		}
		if ( $pt_metabox['type'] == 'text' ) {

						$output .= "\t" . '<div>';
			$output .= "\t\t" . '<br/><p><strong><label for="' . $pt_id . '">' . $pt_metabox['label'] . '</label></strong></p>' . "\n";
			$output .= "\t\t" . '<p><input size="100" class="pt_input_text" type="' . $pt_metabox['type'] . '" value="' . $pt_metaboxvalue . '" name="ptthemes_' . $pt_metabox['name'] . '" id="' . $pt_id . '"/></p>' . "\n";
			$output .= "\t\t" . '<p><span style="font-size:11px">' . $pt_metabox['desc'] . '</span></p>' . "\n";
			$output .= "\t" . '</div>' . "\n";

		} elseif ( $pt_metabox['type'] == 'textarea' ) {

						$output .= "\t" . '<div>';
			$output .= "\t\t" . '<br/><p><strong><label for="' . $pt_id . '">' . $pt_metabox['label'] . '</label></strong></p>' . "\n";
			$output .= "\t\t" . '<p><textarea rows="5" cols="98" class="pt_input_textarea" name="ptthemes_' . $pt_metabox['name'] . '" id="' . $pt_id . '">' . $pt_metaboxvalue . '</textarea></p>' . "\n";
			$output .= "\t\t" . '<p><span style="font-size:11px">' . $pt_metabox['desc'] . '</span></p>' . "\n";
			$output .= "\t" . '</div>' . "\n";

		} elseif ( $pt_metabox['type'] == 'select' ) {

										$output .= "\t" . '<div>';
			$output .= "\t\t" . '<br/><p><strong><label for="' . $pt_id . '">' . $pt_metabox['label'] . '</label></strong></p>' . "\n";
			$output .= "\t\t" . '<p><select class="pt_input_select" id="' . $pt_id . '" name="ptthemes_' . $pt_metabox['name'] . '"></p>' . "\n";
			$output .= '<option>Select a Upload</option>';

							$array = $pt_metabox['options'];

			if ( $array ) {
				foreach ( $array as $id => $option ) {
					$selected = '';
					if ( $pt_metabox['default'] == $option ) {$selected = 'selected="selected"';}
					if ( $pt_metaboxvalue == $option ) {$selected = 'selected="selected"';}
					$output .= '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
				}
			}

							$output .= '</select><p><span style="font-size:11px">' . $pt_metabox['desc'] . '</span></p>' . "\n";
			$output .= "\t" . '</div>' . "\n";
		} elseif ( $pt_metabox['type'] == 'checkbox' ) {
			if ( $pt_metaboxvalue == 'on' ) { $checked = 'checked="checked"';
			} else { $checked = '';}

				$output .= "\t" . '<div>';
			$output .= "\t\t" . '<br/><p><strong><label for="' . $pt_id . '">' . $pt_metabox['label'] . '</label></strong></p>' . "\n";
			$output .= "\t\t" . '<p><input type="checkbox" ' . $checked . ' class="pt_input_checkbox"  id="' . $pt_id . '" name="ptthemes_' . $pt_metabox['name'] . '" /></p>' . "\n";
			$output .= "\t\t" . '<p><span style="font-size:11px">' . $pt_metabox['desc'] . '</span></p>' . "\n";
			$output .= "\t" . '</div>' . "\n";

		}// End if().
	}// End foreach().

		$output .= '</div>' . "\n\n";
	echo $output;
}

function ptthemes_metabox_insert() {
	global $pt_metaboxes;
	global $globals;
	$pID = $_POST['post_ID'];
	$counter = 0;

	foreach ( $pt_metaboxes as $pt_metabox ) { // On Save.. this gets looped in the header response and saves the values submitted
		if ( $pt_metabox['type'] == 'text' or $pt_metabox['type'] == 'select' or $pt_metabox['type'] == 'checkbox' or $pt_metabox['type'] == 'textarea' ) { // Normal Type Things...
			$var = 'ptthemes_' . $pt_metabox['name'];
			if ( isset( $_POST[ $var ] ) ) {
				if ( get_post_meta( $pID, $pt_metabox['name'] ) == '' ) {
					add_post_meta( $pID, $pt_metabox['name'], $_POST[ $var ], true );
				} elseif ( $_POST[ $var ] != get_post_meta( $pID, $pt_metabox['name'], true ) ) {
					update_post_meta( $pID, $pt_metabox['name'], $_POST[ $var ] );
				} elseif ( $_POST[ $var ] == '' ) {
					delete_post_meta( $pID, $pt_metabox['name'], get_post_meta( $pID, $pt_metabox['name'], true ) );
				}
			}
		}
	}
}

function ptthemes_header_inserts() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'template_directory' ) . '/library/functions/admin_style.css" media="screen" />';
}

function ptthemes_meta_box() {
	if ( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'ptthemes-settings',$GLOBALS['themename'] . ' Custom Settings','ptthemes_meta_box_content','post','normal','high' );
	}
}

//add_action('admin_menu', 'ptthemes_meta_box');
//add_action('admin_head', 'ptthemes_header_inserts');
//add_action('save_post', 'ptthemes_metabox_insert');


function relativeDate( $posted_date ) {

		$tz = 0;    // change this if your web server and weblog are in different timezones
				// see project page for instructions on how to do this

		$month = substr( $posted_date,4,2 );

	if ( $month == '02' ) { // february
		// check for leap year
		$leapYear = isLeapYear( substr( $posted_date,0,4 ) );
		if ( $leapYear ) { $month_in_seconds = 2505600; // leap year
		} else { $month_in_seconds = 2419200;
		}
	} else { // not february
		// check to see if the month has 30/31 days in it
		if ( $month == '04' or
			$month == '06' or
			$month == '09' or
			$month == '11' ) {
			$month_in_seconds = 2592000; // 30 day month
		} else { $month_in_seconds = 2678400; // End if().
		}
	}

	/*
    some parts of this implementation borrowed from:
    //maniacalrage.net/archives/2004/02/relativedatesusing/
	*/

	$in_seconds = strtotime(substr( $posted_date,0,8 ) . ' ' .
				  substr( $posted_date,8,2 ) . ':' .
				  substr( $posted_date,10,2 ) . ':' .
	substr( $posted_date,12,2 ));
	$diff = time() - ($in_seconds + ($tz * 3600));
	$months = floor( $diff / $month_in_seconds );
	$diff -= $months * 2419200;
	$weeks = floor( $diff / 604800 );
	$diff -= $weeks * 604800;
	$days = floor( $diff / 86400 );
	$diff -= $days * 86400;
	$hours = floor( $diff / 3600 );
	$diff -= $hours * 3600;
	$minutes = floor( $diff / 60 );
	$diff -= $minutes * 60;
	$seconds = $diff;

	if ( $months > 0 ) {
		// over a month old, just show date ("Month, Day Year")
		echo '';
		the_time( 'F jS, Y' );
	} else {
		if ( $weeks > 0 ) {
			// weeks and days
			$relative_date .= ($relative_date?', ':'') . $weeks . ' ' . get_option( 'ptthemes_relative_week' ) . '' . ($weeks > 1?'' . get_option( 'ptthemes_relative_s' ) . '':'');
			$relative_date .= $days > 0?($relative_date?', ':'') . $days . ' ' . get_option( 'ptthemes_relative_day' ) . '' . ($days > 1?'' . get_option( 'ptthemes_relative_s' ) . '':''):'';
		} elseif ( $days > 0 ) {
			// days and hours
			$relative_date .= ($relative_date?', ':'') . $days . ' ' . get_option( 'ptthemes_relative_day' ) . '' . ($days > 1?'' . get_option( 'ptthemes_relative_s' ) . '':'');
			$relative_date .= $hours > 0?($relative_date?', ':'') . $hours . ' ' . get_option( 'ptthemes_relative_hour' ) . '' . ($hours > 1?'' . get_option( 'ptthemes_relative_s' ) . '':''):'';
		} elseif ( $hours > 0 ) {
			// hours and minutes
			$relative_date .= ($relative_date?', ':'') . $hours . ' ' . get_option( 'ptthemes_relative_hour' ) . '' . ($hours > 1?'' . get_option( 'ptthemes_relative_s' ) . '':'');
			$relative_date .= $minutes > 0?($relative_date?', ':'') . $minutes . ' ' . get_option( 'ptthemes_relative_minute' ) . '' . ($minutes > 1?'' . get_option( 'ptthemes_relative_s' ) . '':''):'';
		} elseif ( $minutes > 0 ) {
			// minutes only
			$relative_date .= ($relative_date?', ':'') . $minutes . ' ' . get_option( 'ptthemes_relative_minute' ) . '' . ($minutes > 1?'' . get_option( 'ptthemes_relative_s' ) . '':'');
		} else {
			// seconds only
			$relative_date .= ($relative_date?', ':'') . $seconds . ' ' . get_option( 'ptthemes_relative_minute' ) . '' . ($seconds > 1?'' . get_option( 'ptthemes_relative_s' ) . '':'');
		}

				// show relative date and add proper verbiage
		echo '' . get_option( 'ptthemes_relative_posted' ) . ' ' . $relative_date . ' ' . get_option( 'ptthemes_relative_ago' ) . '';
	}

}

function isLeapYear( $year ) {
		return $year % 4 == 0 && ($year % 400 == 0 || $year % 100 != 0);
}

if ( ! function_exists( 'how_long_ago' ) ) {
	function how_long_ago( $timestamp ) {
		$difference = time() - $timestamp;

		if ( $difference >= 60 * 60 * 24 * 365 ) {        // if more than a year ago
			$int = intval( $difference / (60 * 60 * 24 * 365) );
			$s = ($int > 1) ? '' . get_option( 'ptthemes_relative_s' ) . '' : '';
			$r = $int . ' ' . get_option( 'ptthemes_relative_year' ) . '' . $s . ' ' . get_option( 'ptthemes_relative_ago' ) . '';
		} elseif ( $difference >= 60 * 60 * 24 * 7 * 5 ) {  // if more than five weeks ago
			$int = intval( $difference / (60 * 60 * 24 * 30) );
			$s = ($int > 1) ? '' . get_option( 'ptthemes_relative_s' ) . '' : '';
			$r = $int . ' ' . get_option( 'ptthemes_relative_month' ) . '' . $s . ' ' . get_option( 'ptthemes_relative_ago' ) . '';
		} elseif ( $difference >= 60 * 60 * 24 * 7 ) {        // if more than a week ago
			$int = intval( $difference / (60 * 60 * 24 * 7) );
			$s = ($int > 1) ? '' . get_option( 'ptthemes_relative_s' ) . '' : '';
			$r = $int . ' ' . get_option( 'ptthemes_relative_week' ) . '' . $s . ' ' . get_option( 'ptthemes_relative_ago' ) . '';
		} elseif ( $difference >= 60 * 60 * 24 ) {      // if more than a day ago
			$int = intval( $difference / (60 * 60 * 24) );
			$s = ($int > 1) ? '' . get_option( 'ptthemes_relative_s' ) . '' : '';
			$r = $int . ' ' . get_option( 'ptthemes_relative_day' ) . '' . $s . ' ' . get_option( 'ptthemes_relative_ago' ) . '';
		} elseif ( $difference >= 60 * 60 ) {         // if more than an hour ago
			$int = intval( $difference / (60 * 60) );
			$s = ($int > 1) ? '' . get_option( 'ptthemes_relative_s' ) . '' : '';
			$r = $int . ' ' . get_option( 'ptthemes_relative_hour' ) . '' . $s . ' ' . get_option( 'ptthemes_relative_ago' ) . '';
		} elseif ( $difference >= 60 ) {            // if more than a minute ago
			$int = intval( $difference / (60) );
			$s = ($int > 1) ? '' . get_option( 'ptthemes_relative_s' ) . '' : '';
			$r = $int . ' ' . get_option( 'ptthemes_relative_minute' ) . '' . $s . ' ' . get_option( 'ptthemes_relative_ago' ) . '';
		} else {                                // if less than a minute ago
			$r = '' . get_option( 'ptthemes_relative_moments' ) . ' ' . get_option( 'ptthemes_relative_ago' ) . '';
		}

		return $r;
	}
}

/*
Plugin Name: WP-PageNavi
Plugin URI: //www.lesterchan.net/portfolio/programming.php
*/
function wp_pagenavi( $before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false ) {

		global $request, $posts_per_page, $wpdb, $paged, $totalpost_count;
	if ( empty( $prelabel ) ) {
		$prelabel  = '<strong>&laquo;</strong>';
	}
	if ( empty( $nxtlabel ) ) {
		$nxtlabel = '<strong>&raquo;</strong>';
	}
	$half_pages_to_show = round( $pages_to_show / 2 );
	if ( ! is_single() ) {
		if ( is_tag() ) {
			preg_match( '#FROM\s(.*)\sGROUP BY#siU', $request, $matches );
		} elseif ( ! is_category() ) {
			preg_match( '#FROM\s(.*)\sORDER BY#siU', $request, $matches );
		} else {
			preg_match( '#FROM\s(.*)\sGROUP BY#siU', $request, $matches );
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var( "SELECT COUNT(DISTINCT ID) FROM $fromwhere" );

	}
	if ( $totalpost_count > 0 ) {
		$numposts = $totalpost_count;
	}
	$max_page = ceil( $numposts / $posts_per_page );
	if ( empty( $paged ) ) {
		$paged = 1;
	}
	if ( $max_page > 1 || $always_show ) {
		echo "$before <div class='Navi'>";
		if ( $paged >= ($pages_to_show -1) ) {
			echo '<a href="' . get_pagenum_link() . '">' . __( '&laquo; First' ) . '</a>';
		}
		previous_posts_link( $prelabel );
		for ( $i = 1; $i <= $pages_to_show; $i++ ) {
			if ( $i >= 1 && $i <= $max_page ) {
				if ( $i == $paged ) {
					echo "<strong class='on'>$i</strong>";
				} else {
					echo ' <a href="' . get_pagenum_link( $i ) . '">' . $i . '</a> ';
				}
			}
		}
		next_posts_link( $nxtlabel, $max_page );
		if ( ($paged + $half_pages_to_show) < ($max_page) && $pages_to_show != $paged ) {
			echo '<a href="' . get_pagenum_link( $max_page ) . '">' . __( 'Last &raquo;' ) . '</a>';
		}
		echo "</div> $after";
	}
}

/// Use Noindex for sections specified in theme admin

function ptthemes_noindex_head() {

	$meta_string = '';
	if ( (is_category() && get_option( 'ptthemes_noindex_category' )) ||
		(is_tag() && get_option( 'ptthemes_noindex_tag' )) ||
		(is_day() && get_option( 'ptthemes_noindex_daily' )) ||
		(is_month() && get_option( 'ptthemes_noindex_monthly' )) ||
		(is_year() && get_option( 'ptthemes_noindex_yearly' )) ||
		(is_author() && get_option( 'ptthemes_noindex_author' )) ||
		(is_search() && get_option( 'ptthemes_noindex_search' )) ) {

		$meta_string .= '<meta name="robots" content="noindex,follow" />';
	}

		echo $meta_string;

}

add_action( 'wp_head', 'ptthemes_noindex_head' );

///////////NEW FUNCTIONS  START//////
function bdw_get_images( $iPostID, $img_size = 'thumb' ) {
	$arrImages =& get_children( 'order=ASC&orderby=menu_order ID&post_type=attachment&post_mime_type=image&post_parent=' . $iPostID );
	//$images =& get_children( 'post_type=attachment&post_mime_type=image' );
	//$videos =& get_children( 'post_type=attachment&post_mime_type=video/mp4' );

		$return_arr = array();
	if ( $arrImages ) {
		foreach ( $arrImages as $key => $val ) {
			$id = $val->ID;
			if ( $img_size == 'large' ) {
				//$return_arr[] = '<img src="'.wp_get_attachment_url($id).'" alt="">';  // THE FULL SIZE IMAGE INSTEAD
				$img_arr = wp_get_attachment_image_src( $id,'full' ); // THE FULL SIZE IMAGE INSTEAD
				$return_arr[] = $img_arr[0];
			} elseif ( $img_size == 'medium' ) {
				//$return_arr[] = '<img src="'.wp_get_attachment_url($id, $size='medium').'" alt="">'; //THE medium SIZE IMAGE INSTEAD
				$img_arr = wp_get_attachment_image_src( $id, 'medium' ); //THE medium SIZE IMAGE INSTEAD
				$return_arr[] = $img_arr[0];
			} elseif ( $img_size == 'thumb' ) {
				//$return_arr[] = '<img src="'.wp_get_attachment_thumb_url($id).'" alt="">'; // Get the thumbnail url for the attachment
				$img_arr = wp_get_attachment_image_src( $id, 'thumbnail' ); // Get the thumbnail url for the attachment
				$return_arr[] = $img_arr[0];

			}
		}
		return $return_arr;
	}
}
function bdw_get_images_with_info( $iPostID, $img_size = 'thumb' ) {
	$arrImages =& get_children( 'order=ASC&orderby=menu_order ID&post_type=attachment&post_mime_type=image&post_parent=' . $iPostID );

		$return_arr = array();
	if ( $arrImages ) {
		foreach ( $arrImages as $key => $val ) {
			$id = $val->ID;
			if ( $img_size == 'large' ) {
				$img_arr = wp_get_attachment_image_src( $id,'full' ); // THE FULL SIZE IMAGE INSTEAD
				$imgarr['id'] = $id;
				$imgarr['file'] = $img_arr[0];
				$return_arr[] = $imgarr;
			} elseif ( $img_size == 'medium' ) {
				$img_arr = wp_get_attachment_image_src( $id, 'medium' ); //THE medium SIZE IMAGE INSTEAD
				$imgarr['id'] = $id;
				$imgarr['file'] = $img_arr[0];
				$return_arr[] = $imgarr;
			} elseif ( $img_size == 'thumb' ) {
				$img_arr = wp_get_attachment_image_src( $id, 'thumbnail' ); // Get the thumbnail url for the attachment
				$imgarr['id'] = $id;
				$imgarr['file'] = $img_arr[0];
				$return_arr[] = $imgarr;

			}
		}
		return $return_arr;
	}
}

function _cat_rows1( $parent = 0, $level = 0, $categories, &$children, $page = 1, $per_page = 20, &$count ) {
	//global $category_array;
	$start = ($page - 1) * $per_page;
	$end = $start + $per_page;
	ob_start();

	foreach ( $categories as $key => $category ) {
		if ( $count >= $end ) {
			break;
		}

		$_GET['s'] = '';
		if ( $category->parent != $parent && empty( $_GET['s'] ) ) {
			continue;
		}

		// If the page starts in a subtree, print the parents.
		if ( $count == $start && $category->parent > 0 ) {
			$my_parents = array();
			$p = $category->parent;
			while ( $p ) {
				$my_parent = get_category( $p );
				$my_parents[] = $my_parent;
				if ( $my_parent->parent == 0 ) {
					break;
				}
				$p = $my_parent->parent;
			}

			$num_parents = count( $my_parents );
			while ( $my_parent = array_pop( $my_parents ) ) {
				$category_array[] = _cat_rows1( $my_parent, $level - $num_parents );
				$num_parents--;
			}
		}

		if ( $count >= $start ) {
			$categoryinfo = array();
			$category = get_category( $category, '', '' );
			$default_cat_id = (int) get_option( 'default_category' );
			$pad = str_repeat( '&#8212; ', max( 0, $level ) );
			$name = ( $name_override ? $name_override : $pad . ' ' . $category->name );
			$categoryinfo['ID'] = $category->term_id;
			$categoryinfo['name'] = $name;
			$category_array[] = $categoryinfo;
		}

		unset( $categories[ $key ] );
		$count++;
		if ( isset( $children[ $category->term_id ] ) ) {
			_cat_rows1( $category->term_id, $level + 1, $categories, $children, $page, $per_page, $count );
		}
	}// End foreach().
	$output = ob_get_contents();
	ob_end_clean();
	return $category_array;
}

function getCategoryList( $parent = 0, $level = 0, $categories = 0, $page = 1, $per_page = 1000 ) {
	$count = 0;
	if ( empty( $categories ) ) {
		$args = array(
			'hide_empty' => 0,
			'orderby' => 'id',
		);

					$categories = get_categories( $args );
		if ( empty( $categories ) ) {
			return false;
		}
	}
	$children = _get_term_hierarchy( 'category' );
	return _cat_rows1( $parent, $level, $categories, $children, $page, $per_page, $count );
}

function get_category_dropdown_options( $parentid = '0', $selectedId = '', $exclude_cat = '', $html_type = 'dropdown' ) {
	$category_array = array();
	$category_array = getCategoryList( $parentid );
	$option_str = '';
	$exclude_catarr = explode( ',',$exclude_cat );
	for ( $i = 0;$i < count( $category_array );$i++ ) {
		if ( ! in_array( $category_array[ $i ]['ID'],$exclude_catarr ) ) {
			$selected = '';
			if ( $html_type == 'dropdown' ) {
				if ( $selectedId == $category_array[ $i ]['ID'] ) {$selected = 'selected';
				};
				$option_str .= '<option value="' . $category_array[ $i ]['ID'] . '" ' . $selected . '>' . $category_array[ $i ]['name'];
				$option_str .= '</option>';
			}
		}
	}
	return $option_str;
}

function get_cat_id_from_name( $catname ) {
	global $wpdb;
	if ( $catname ) {
		return $pn_categories_obj = $wpdb->get_var("SELECT $wpdb->terms.term_id as cat_ID 
                                FROM $wpdb->term_taxonomy,  $wpdb->terms
                                WHERE $wpdb->term_taxonomy.term_id =  $wpdb->terms.term_id AND $wpdb->terms.name like \"$catname\"
                                AND $wpdb->term_taxonomy.taxonomy = 'category'");
	}
}
function in_sub_category( $parentid, $postid ) {
	$catarr = getCategoryList( $parentid );
	if ( $catarr ) {
		foreach ( $catarr as $key => $val ) {
			if ( $val['ID'] != '' ) {
				if ( in_category( $val['ID'],$postid ) ) {
					return true;
				}
			}
		}
	}
	return false;
}
function get_sub_categories( $parentid, $return_type = 'array' ) {
	$cat_arr = array();
	$cat_arr = get_term_children( $parentid ,'category' );
	$cat_arr[] = $parentid;
	if ( $return_type == 'array' ) {
		return $cat_arr;
	} else {
		return implode( ',',$cat_arr );
	}
}
function is_sub_category( $parentid ) {
	$catarr = get_sub_categories( $parentid );
	if ( $catarr ) {
		foreach ( $catarr as $key => $val ) {
			if ( $val != '' ) {
				if ( is_category( $val ) ) {
					return true;
				}
			}
		}
	}
	return false;
}

function get_currency_sym() {
	global $wpdb;
	$option_value = get_option( 'mysite_general_settings' );
	if ( $option_value['currencysym'] ) {
		return stripslashes( $option_value['currencysym'] );
	} else {
		return '$';
	}
}
function get_currency_type() {
	global $wpdb;
	$option_value = get_option( 'mysite_general_settings' );
	if ( $option_value['currency'] ) {
		return stripslashes( $option_value['currency'] );
	} else {
		return 'USD';
	}

}
function get_site_emailId() {
	$generalinfo = get_option( 'mysite_general_settings' );
	if ( $generalinfo['site_email'] ) {
		return $generalinfo['site_email'];
	} else {
		return get_option( 'admin_email' );
	}
}
function get_site_emailName() {
	$generalinfo = get_option( 'mysite_general_settings' );
	if ( $generalinfo['site_email_name'] ) {
		return stripslashes( $generalinfo['site_email_name'] );
	} else {
		return stripslashes( get_option( 'blogname' ) );
	}
}
function get_merchantid() {
	global $wpdb;
	$option_value = get_option( 'mysite_general_settings' );
	return stripslashes( $option_value['merchantid'] );
}
function is_allow_user_register() {
	$generalinfo = get_option( 'mysite_general_settings' );
	if ( $generalinfo['is_allow_user_add'] != '' ) {
		return $generalinfo['is_allow_user_add'];
	} else {
		return 1;
	}
}
function is_user_add_question() {
	$option_value = get_option( 'mysite_general_settings' );
	if ( isset( $option_value['is_user_addquestion'] ) && $option_value['is_user_addquestion'] != '' ) {
		return $option_value['is_user_addquestion'];
	} else {
		return 1;
	}
}
function get_question_fees() {
	$option_value = get_option( 'mysite_general_settings' );
	if ( array_key_exists( 'fees',$option_value ) && $option_value['fees'] ) {
		return stripslashes( $option_value['fees'] );
	} else {
		return '0';
	}

}
function get_property_default_status() {
	$generalinfo = get_option( 'mysite_general_settings' );
	if ( $generalinfo['approve_status'] ) {
		return $generalinfo['approve_status'];
	} else {
		return 'publish';
	}
}


function get_post_info( $pid ) {
	global $wpdb;
	$productinfosql = "select ID,post_title,post_content,post_author from $wpdb->posts where ID=$pid";
	$productinfo = $wpdb->get_results( $productinfosql );
	if ( $productinfo ) {
		foreach ( $productinfo[0] as $key => $val ) {
			$productArray[ $key ] = $val;
		}
	}
	return $productArray;
}
function sendEmail( $fromEmail, $fromEmailName, $toEmail, $toEmailName, $subject, $message, $extra = '' ) {
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

		// Additional headers
	$headers .= 'To: ' . $toEmailName . ' <' . $toEmail . '>' . "\r\n";
	$headers .= 'From: ' . $fromEmailName . ' <' . $fromEmail . '>' . "\r\n";

		// Mail it
	if ( wp_mail( $toEmail, $subject, $message, $headers ) ) {

	} else {
		@mail( $toEmail, $subject, $message, $headers );
	}
}
function get_image_phy_destination_path() {
	global $upload_folder_path;
	$today = getdate();
	if ( $today['month'] == 'January' ) {
		$today['month'] = '01';
	} elseif ( $today['month'] == 'February' ) {
		$today['month'] = '02';
	} elseif ( $today['month'] == 'March' ) {
		$today['month'] = '03';
	} elseif ( $today['month'] == 'April' ) {
		$today['month'] = '04';
	} elseif ( $today['month'] == 'May' ) {
		$today['month'] = '05';
	} elseif ( $today['month'] == 'June' ) {
		$today['month'] = '06';
	} elseif ( $today['month'] == 'July' ) {
		$today['month'] = '07';
	} elseif ( $today['month'] == 'August' ) {
		$today['month'] = '08';
	} elseif ( $today['month'] == 'September' ) {
		$today['month'] = '09';
	} elseif ( $today['month'] == 'October' ) {
		$today['month'] = '10';
	} elseif ( $today['month'] == 'November' ) {
		$today['month'] = '11';
	} elseif ( $today['month'] == 'December' ) {
		$today['month'] = '12';
	}// End if().

		 $destination_path = ABSPATH . $upload_folder_path . $today['year'] . '/';
	if ( ! file_exists( $destination_path ) ) {
		mkdir( $destination_path, 0777 );
	}

			$destination_path = ABSPATH . $upload_folder_path . $today['year'] . '/' . $today['month'] . '/';
	if ( ! file_exists( $destination_path ) ) {
		mkdir( $destination_path, 0777 );
	}
	  return $destination_path;

}

//This function give print the image if uploaded earlier or print avtar
function get_user_profile_pic( $user_id, $height = 100, $width = 100 ) {
	$user_data = get_userdata( intval( $user_id ) );

	if ( $user_data ->user_photo != '' ) {
		$img_data = '<img name="user_photo" class="agent_photo" id="user_photo" src="' . $user_data ->user_photo . '" width="' . $width . '" height="' . $height . '"  />';
	} else {

			$img_data = '<img name="user_photo" class="agent_photo" id="user_photo" src="' . get_bloginfo( 'template_directory' ) . '/images/avatar_post.png" width="' . $width . '" height="' . $height . '"  />';
	}

		echo $img_data;
}

//This function would return paths of folder to which upload the image
function get_image_phy_destination_path_user() {

		 global $upload_folder_path;
	$tmppath = $upload_folder_path;
	$destination_path = ABSPATH . $tmppath . 'users/';
	if ( ! file_exists( $destination_path ) ) {
		$imagepatharr = explode( '/',$tmppath . 'users' );
		$year_path = ABSPATH;
		for ( $i = 0;$i < count( $imagepatharr );$i++ ) {
			if ( $imagepatharr[ $i ] ) {
				$year_path .= $imagepatharr[ $i ] . '/';
				if ( ! file_exists( $year_path ) ) {
					mkdir( $year_path, 0777 );
				}
			}
		}
	}
	  return $destination_path;

}

//
function get_image_rel_destination_path_user() {

		 global $upload_folder_path;
	 $destination_path = get_option( 'siteurl' ) . '/' . $upload_folder_path . 'users/';
	  return $destination_path;

}

function get_image_rel_destination_path() {
	$today = getdate();
	if ( $today['month'] == 'January' ) {
		$today['month'] = '01';
	} elseif ( $today['month'] == 'February' ) {
		$today['month'] = '02';
	} elseif ( $today['month'] == 'March' ) {
		$today['month'] = '03';
	} elseif ( $today['month'] == 'April' ) {
		$today['month'] = '04';
	} elseif ( $today['month'] == 'May' ) {
		$today['month'] = '05';
	} elseif ( $today['month'] == 'June' ) {
		$today['month'] = '06';
	} elseif ( $today['month'] == 'July' ) {
		$today['month'] = '07';
	} elseif ( $today['month'] == 'August' ) {
		$today['month'] = '08';
	} elseif ( $today['month'] == 'September' ) {
		$today['month'] = '09';
	} elseif ( $today['month'] == 'October' ) {
		$today['month'] = '10';
	} elseif ( $today['month'] == 'November' ) {
		$today['month'] = '11';
	} elseif ( $today['month'] == 'December' ) {
		$today['month'] = '12';
	}// End if().
	return $user_path = get_option( 'siteurl' ) . "/$upload_folder_path" . $today['year'] . '/' . $today['month'] . '/';
}
function get_image_tmp_phy_path() {
	global $upload_folder_path;
	return $destination_path = ABSPATH . $upload_folder_path . 'tmp/';
}

function move_original_image_file( $src, $dest ) {
	copy( $src, $dest );
	unlink( $src );
	$dest = explode( '/',$dest );
	$img_name = $dest[ count( $dest ) -1 ];
	$img_name_arr = explode( '.',$img_name );

	$my_post = array();
	$my_post['post_title'] = $img_name_arr[0];
	$my_post['guid'] = get_image_rel_destination_path() . $img_name;
	return $my_post;
}
function get_image_size( $src ) {
	$img = imagecreatefromjpeg( $src );
	if ( ! $img ) {
		echo 'ERROR:could not create image handle ' . $src;
		exit( 0 );
	}
	$width = imageSX( $img );
	$height = imageSY( $img );
	return array(
		'width' => $width,
		'height' => $height,
	);

}
function get_attached_file_meta_path( $imagepath ) {
	$imagepath_arr = explode( '/',$imagepath );
	$imagearr = array();
	for ( $i = 0;$i < count( $imagepath_arr );$i++ ) {
		$imagearr[] = $imagepath_arr[ $i ];
		if ( $imagepath_arr[ $i ] == 'uploads' ) {
			break;
		}
	}
	$imgpath_ini = implode( '/',$imagearr );
	return str_replace( $imgpath_ini . '/','',$imagepath );
}
function image_resize_custom( $src, $dest, $twidth, $theight ) {
	global $image_obj;
	// Get the image and create a thumbnail
	$img_arr = explode( '.',$dest );
	$imgae_ext = strtolower( $img_arr[ count( $img_arr ) -1 ] );
	if ( $imgae_ext == 'jpg' || $imgae_ext == 'jpeg' ) {
		$img = imagecreatefromjpeg( $src );
	} elseif ( $imgae_ext == 'gif' ) {
		$img = imagecreatefromgif( $src );
	} elseif ( $imgae_ext == 'png' ) {
		$img = imagecreatefrompng( $src );
	}

	if ( $img ) {
		$width = imageSX( $img );
		$height = imageSY( $img );

		if ( ! $width || ! $height ) {
			echo 'ERROR:Invalid width or height';
			exit( 0 );
		}

		if ( ($twidth <= 0 || $theight <= 0) ) {
			return false;
		}
			$image_obj->load( $src );
			$image_obj->resize( $twidth,$theight );
			$new_width = $image_obj->getWidth();
			$new_height = $image_obj->getHeight();
			$imgname_sub = '-' . $new_width . 'X' . $new_height . '.' . $imgae_ext;
			$img_arr1 = explode( '.',$dest );
			unset( $img_arr1[ count( $img_arr1 ) -1 ] );
			$dest = implode( '.',$img_arr1 ) . $imgname_sub;
			$image_obj->save( $dest );

			return array(
				'file' => basename( $dest ),
				'width' => $new_width,
				'height' => $new_height,
			);
	} else {
		return array();
	}
}

function get_author_info( $aid ) {
	global $wpdb;
	$infosql = "select * from $wpdb->users where ID=$aid";
	$info = $wpdb->get_results( $infosql );
	if ( $info ) {
		return $info[0];
	}
}
function get_time_difference( $start, $pid ) {
	$alive_days = get_post_meta( $pid,'alive_days',true );
	$end = date( 'Y-m-d',mktime( 0,0,0,date( 'm',strtotime( $start ) ),date( 'd',strtotime( $start ) ) + $alive_days,date( 'Y',strtotime( $start ) ) ) );

		$uts['start']      = strtotime( $start );
	$uts['end']        = strtotime( $end );
	if ( $uts['start'] !== -1 && $uts['end'] !== -1 ) {
		if ( $uts['end'] >= $uts['start'] ) {
			$diff    = $uts['end'] - $uts['start'];
			if ( $days = intval( (floor( $diff / 86400 )) ) ) {
				$diff = $diff % 86400;
			}
			if ( $hours = intval( (floor( $diff / 3600 )) ) ) {
				$diff = $diff % 3600;
			}
			if ( $minutes = intval( (floor( $diff / 60 )) ) ) {
				$diff = $diff % 60;
			}
			$diff    = intval( $diff );
			//return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
			return $days;
		}
	}
	return( false );
}
function is_new_property( $pid ) {
	$newdays = get_option( 'ptthemes_new_properties' );
	if ( $newdays ) {
		global $wpdb;
		$start = $wpdb->get_var( "select post_date from $wpdb->posts where ID=$pid" );
		$end = date( 'Y-m-d H:i:s' );

				$uts['start']      = strtotime( $start );
		$uts['end']        = strtotime( $end );
		if ( $uts['start'] !== -1 && $uts['end'] !== -1 ) {
			if ( $uts['end'] >= $uts['start'] ) {
				$diff    = $uts['end'] - $uts['start'];
				if ( $days = intval( (floor( $diff / 86400 )) ) ) {
					$diff = $diff % 86400;
				}

							//return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
				if ( $days <= $newdays ) {
					echo ' <img src="';
					bloginfo( 'template_directory' );
					echo '/images/i-icon-new.png" alt="" title="" class="new" />';
				}
			}
		}
		return( false );
	}
}
function custom_list_authors_count( $args = '', $params = array() ) {
	global $wpdb;
	$defaults = array(
		'optioncount' => false,
	'exclude_admin' => true,
		'show_fullname' => false,
	'hide_empty' => true,
		'feed' => '',
	'feed_image' => '',
	'feed_type' => '',
	'echo' => true,
		'style' => 'list',
	'html' => true,
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	/** @todo Move select to get_authors(). */

	if ( $params['show_count'] == '-1' ) {

		$limit = '';
	} else {

		$limit = ' limit ' . $startlimit . ',' . $posts_per_page;
	}

	if ( $params['sort'] == 'most' ) {
		$sql = "select count(ID) as user_count from $wpdb->users u left join $wpdb->posts p on p.post_author=u.ID where u.user_login <> 'admin' group by u.ID ";
		$sql .= " order by post_count desc,display_name asc limit $startlimit,$endlimit";
	} else {

		if ( $params['sort'] == 'popular' ) {
			$sql = "select count(u.ID),sum(cr.ck_rating_up)-sum(cr.ck_rating_down) as post_count,c.user_id from $wpdb->comments c left join " . $wpdb->prefix . "comment_rating cr on cr.ck_comment_id=c.comment_ID join $wpdb->users u on u.ID=c.user_id where c.comment_approved='1' and c.user_id!=0 group by c.user_id ";

				  $sql .= ' order by post_count ';

		} else {
			$sql = "SELECT count(ID) as user_count from $wpdb->users " . ($exclude_admin ? "WHERE user_login <> 'admin' " : '');
			if ( $params['kw'] ) {
				$kw = $params['kw'];
				$sql .= " and display_name like \"$kw%\" ";
			}
			$sql .= ' ORDER BY display_name';
		}
	}

	$authors = $wpdb->get_var( $sql );

	if ( $authors ) {
		return $authors;
	} else {
		return '1';
	}
	//return $authors = $wpdb->get_var("SELECT count(ID) as user_count from $wpdb->users " . ($exclude_admin ? "WHERE user_login <> 'admin' " : '') . "ORDER BY display_name");

}
function get_user_points( $userid ) {
	global $wpdb;
	$sql = "select sum(cr.ck_rating_up)-sum(cr.ck_rating_down) as post_count from $wpdb->comments c join " . $wpdb->prefix . "comment_rating cr on cr.ck_comment_id=c.comment_ID where c.comment_approved='1' and c.user_id!=0 and c.user_id=\"$userid\"";
	if ( $wpdb->get_var( $sql ) ) {
		return $uppoints = $wpdb->get_var( $sql );
	} else {
		return '0';
	}
}
function get_user_points_postids( $userid ) {
	global $wpdb;
	$sql = "select group_concat(c.comment_post_ID) as pids from $wpdb->comments c join " . $wpdb->prefix . "comment_rating cr on cr.ck_comment_id=c.comment_ID where c.comment_approved='1' and c.user_id!=0 and c.user_id=\"$userid\"";
	return $wpdb->get_var( $sql );
}
function custom_list_authors( $args = '', $params = array() ) {
	global $wpdb,$posts_per_page, $paged;
	if ( $paged <= 0 ) {
		$paged = 1;
	}
	if ( array_key_exists( 'pagination',$params ) && $params['pagination'] ) {
		$paged = 1;
	}
	if ( array_key_exists( 'show_count',$params ) && $params['show_count'] ) {
		$posts_per_page = $params['show_count'];
	}
	$startlimit = ($paged -1) * $posts_per_page;
	$endlimit = $paged + $posts_per_page;
	$defaults = array(
		'optioncount' => false,
	'exclude_admin' => true,
		'show_fullname' => false,
	'hide_empty' => true,
		'feed' => '',
	'feed_image' => '',
	'feed_type' => '',
	'echo' => true,
		'style' => 'list',
	'html' => true,
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	$return = '';

	if ( $params['show_count'] == '-1' ) {

		$limit = '';
	} else {

		$limit = ' limit ' . $startlimit . ',' . $posts_per_page;
	}
	/** @todo Move select to get_authors(). */
	//if($params['experts'])
	if ( 1 ) {
		if ( $params['sort'] == 'popular' ) {
			$sql = "select u.*,sum(cr.ck_rating_up)-sum(cr.ck_rating_down) as post_count,c.user_id from $wpdb->comments c left join " . $wpdb->prefix . "comment_rating cr on cr.ck_comment_id=c.comment_ID join $wpdb->users u on u.ID=c.user_id where c.comment_approved='1' and c.user_id!=0 group by c.user_id ";

						//  $sql = "select c.user_id as ID,sum(cr.ck_rating_up)-sum(cr.ck_rating_down) as post_count from $wpdb->comments c join wp_comment_rating cr on cr.ck_comment_id=c.comment_ID where c.comment_approved='1' and c.user_id!=0 group by c.user_id";
			$sql .= ' order by post_count desc' . $limit;
		} else {
			//$sql = "SELECT ID, user_nicename from $wpdb->users " . ($exclude_admin ? "WHERE 1 " : '');
			$sql = "SELECT * from $wpdb->users where 1";
			if ( $params['kw'] ) {
				$kw = $params['kw'];
				$sql .= " and display_name like \"$kw%\" ";
			}
			$sql .= ' ORDER BY display_name ' . $limit;
		}
	} else {
		if ( $params['sort'] == 'popular' ) {
			$sql = "select u.ID,count(p.ID) as post_count from $wpdb->users u left join $wpdb->posts p on p.post_author=u.ID where u.user_login <> 'admin' and p.post_status='publish' group by u.ID ";
			$sql .= ' order by post_count desc,display_name asc' . $limit;
		} else {
			$sql = "SELECT ID, user_nicename from $wpdb->users " . ($exclude_admin ? "WHERE user_login <> 'admin' " : '');
			if ( $params['kw'] ) {
				$kw = $params['kw'];
				$sql .= " and display_name like \"$kw%\" ";
			}
			$sql .= ' ORDER BY display_name ' . $limit;
		}
	}// End if().
	$authors = $wpdb->get_results( $sql );
	$return_arr = array();
	foreach ( (array) $authors as $author ) {
		$return_arr[] = $author;
	}
	return $return_arr;
}

function get_payment_optins( $method ) {
	global $wpdb;
	$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_$method'";
	$paymentinfo = $wpdb->get_results( $paymentsql );
	if ( $paymentinfo ) {
		foreach ( $paymentinfo as $paymentinfoObj ) {
			$option_value = unserialize( $paymentinfoObj->option_value );
			$paymentOpts = $option_value['payOpts'];
			$optReturnarr = array();
			for ( $i = 0;$i < count( $paymentOpts );$i++ ) {
				$optReturnarr[ $paymentOpts[ $i ]['fieldname'] ] = $paymentOpts[ $i ]['value'];
			}
			//echo "<pre>";print_r($optReturnarr);
			return $optReturnarr;
		}
	}
}


function get_question_info_li( $post ) {
	global $current_user;
?>
 <div class="question_list">
	<span class="answers_total">
	<a href="<?php the_permalink(); ?>#commentarea"><?php comments_number( '0', '1', '%' ); ?> </a>   <?php _e( 'Answers' );?> 
	</span>

		<h3> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	<p> <span class="user"><?php _e( 'Asked by' );?>: <strong><?php the_author_posts_link(); ?></strong> </span> 
	<span class="views"><b><?php echo user_post_visit_count( $post->ID );?> </b> <?php _e( 'views' );?> </span> 
	<?php the_tags( '<span class="ptags">', ', ', '<br /> </span>' ); ?> 
	<span class="pcate">  <?php the_category( ', ' ); ?> </span>
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
<?php
}
function user_post_visit_count( $pid ) {
	if ( get_post_meta( $pid,'question_viewed_count',true ) ) {
		return get_post_meta( $pid,'question_viewed_count',true );
	} else {
		return '0';
	}
}
function get_property_listing_price( $pid ) {
?>
	<span class="price">
	<?php if ( get_property_price( $pid ) ) {?>
	<b class="sale"> <?php _e( PRO_FOR_TEXT );?> <?php echo get_post_meta( $pid,'property_type',true );?> : </b> <?php echo get_property_price( $pid );?><b> 
	<?php if ( get_post_meta( $pid,'property_type',true ) == 'Rent' ) { echo '/ month';}?> </b>
	<?php }?>
	</span>
<?php
}

function get_usernumposts_count( $userid, $post_status = 'publish' ) {
	global $wpdb,$current_user;
	$sub_cat_sql = '';
	if ( $userid ) {
		if ( $current_user->data->ID == $userid ) {
			$post_status = 'all';
		}
		//$blogcatcatids = get_property_all_cat_ids();
		$propertycat = get_cat_id_from_name( get_option( 'ptthemes_blogcategory' ) );
		$propertycatcatids = get_sub_categories( $propertycat,'string' );
		if ( $propertycatcatids ) {
			$srch_blog_pids = $wpdb->get_var( "SELECT group_concat(tr.object_id) FROM $wpdb->term_taxonomy tt join $wpdb->term_relationships tr on tr.term_taxonomy_id=tt.term_taxonomy_id where tt.term_id in ($propertycatcatids)" );
			if ( $srch_blog_pids ) {
				$sub_cat_sql .= " and p.ID not in ($srch_blog_pids) ";
			}
		}

		$srch_sql = "select count(p.ID) from $wpdb->posts p where  p.post_author=\"$userid\" and p.post_type='post'  $sub_cat_sql";
		if ( $post_status == 'all' ) {
			$srch_sql .= " and p.post_status in ('publish','draft')";
		} elseif ( $post_status == 'publish' ) {
			$srch_sql .= " and p.post_status in ('publish')";
		} elseif ( $post_status == 'draft' ) {
			$srch_sql .= " and p.post_status in ('draft')";
		}

		return $totalpost_count = $wpdb->get_var( $srch_sql );
	}

}

function get_payable_amount_with_coupon( $total_amt, $coupon_code ) {
	$discount_amt = get_discount_amount( $coupon_code,$total_amt );
	if ( $discount_amt > 0 ) {
		return $total_amt -$discount_amt;
	} else {
		return $total_amt;
	}
}
function is_valid_coupon( $coupon ) {
	global $wpdb;
	$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
	$couponinfo = $wpdb->get_results( $couponsql );
	if ( $couponinfo ) {
		foreach ( $couponinfo as $couponinfoObj ) {
			$option_value = unserialize( $couponinfoObj->option_value );
			foreach ( $option_value as $key => $value ) {
				if ( $value['couponcode'] == $coupon ) {
					return true;
				}
			}
		}
	}
	return false;
}
function get_discount_amount( $coupon, $amount ) {
	global $wpdb;
	if ( $coupon != '' && $amount > 0 ) {
		$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
		$couponinfo = $wpdb->get_results( $couponsql );
		if ( $couponinfo ) {
			foreach ( $couponinfo as $couponinfoObj ) {
				$option_value = unserialize( $couponinfoObj->option_value );
				foreach ( $option_value as $key => $value ) {
					if ( $value['couponcode'] == $coupon ) {
						if ( $value['dis_per'] == 'per' ) {
							$discount_amt = ($amount * $value['dis_amt']) / 100;
						} elseif ( $value['dis_per'] == 'amt' ) {
							$discount_amt = $value['dis_amt'];
						}
					}
				}
			}
			return $discount_amt;
		}
	}
	return '0';
}

///////////////////////////////////////////////
function is_allow_ssl() {
	global $wpdb;
	$option_value = get_option( 'mysite_general_settings' );
	if ( array_key_exists( 'is_allow_ssl',$option_value ) && $option_value['is_allow_ssl'] ) {
		return $option_value['is_allow_ssl'];
	} else {
		return '0';
	}

}
function get_ssl_normal_url( $url, $pid = '' ) {
	if ( $pid ) {
		return $url;
	} else {
		if ( is_allow_ssl() ) {
			$url = str_replace( '//','https://',$url );
		}
	}
	return $url;
}

function get_user_nice_name( $fname, $lname = '' ) {
	global $wpdb;
	if ( $lname ) {
		$uname = $fname . '-' . $lname;
	} else {
		$uname = $fname;
	}
	$nicename = strtolower( str_replace( array( "'", '"', '?', '.', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '+', '+', ' ' ),array( '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-' ),$uname ) );
	$nicenamecount = $wpdb->get_var( "select count(user_nicename) from $wpdb->users where user_nicename like \"$nicename\"" );
	if ( $nicenamecount == '0' ) {
		return trim( $nicename );
	} else {
		$lastuid = $wpdb->get_var( "select max(ID) from $wpdb->users" );
		return $nicename . '-' . $lastuid;
	}
}

function get_user_name( $uid ) {
	global $wpdb;
	return $wpdb->get_var( $wpdb->prepare( "select display_name from $wpdb->users where ID= %d",$uid ) );
}

function veryfy_login_and_proced( $posted, $redirecturl = '' ) {
	$secure_cookie = '';
	if ( ! empty( $posted['log'] ) && ! force_ssl_admin() ) {
		$user_name = $posted['log'];
		if ( $user = get_userdatabylogin( $user_name ) ) {
			if ( get_user_option( 'use_ssl', $user->ID ) ) {
				$secure_cookie = true;
				force_ssl_admin( true );
			}
		}
	}
	$user = wp_signon( '', $secure_cookie );
	if ( ! is_wp_error( $user ) ) {
		$current_user = $user;
	} else {
		if ( $redirecturl ) {
			wp_redirect( $redirecturl );
		} else {
			wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=log_err' );
		}
	}
	return $current_user;
}
function register_new_user_question( $user_login, $user_email, $user_pwd = '' ) {
	include_once( ABSPATH . 'wp-includes/registration.php' );
	global $wpdb;
	$errors = new WP_Error();

	$user_login = $user_login;
	$user_email = apply_filters( 'user_registration_email', $user_email );

	// Check the username
	if ( $user_login == '' ) {
		$errors->add( 'empty_username', __( 'ERROR: Please enter a username.' ) );
	} elseif ( ! validate_username( $user_login ) ) {
		$errors->add( 'invalid_username', __( '<strong>ERROR</strong>: This username is invalid.  Please enter a valid username.' ) );
		$user_login = '';
	} elseif ( username_exists( $user_login ) ) {
		$errors->add( 'username_exists', __( '<strong>ERROR</strong>: This username is already registered, please choose another one.' ) );
	}

	// Check the e-mail address
	if ( $user_email == '' ) {
		$errors->add( 'empty_email', __( '<strong>ERROR</strong>: Please type your e-mail address.' ) );
	} elseif ( ! is_email( $user_email ) ) {
		$errors->add( 'invalid_email', __( '<strong>ERROR</strong>: The email address isn&#8217;t correct.' ) );
		$user_email = '';
	} elseif ( email_exists( $user_email ) ) {
		$errors->add( 'email_exists', __( '<strong>ERROR</strong>: This email is already registered, please choose another one.' ) );
	}

	do_action( 'register_post', $user_login, $user_email, $errors );

	$errors = apply_filters( 'registration_errors', $errors );
	if ( $errors->get_error_code() ) {
		return $errors;
	}
}

function users_comments( $userid ) {
	global $wpdb;
	$blog_post_ids = get_blog_cat_postids();
	$comment_author_email = $wpdb->get_var( $wpdb->prepare( "select user_email from $wpdb->users where ID=%d",$userid ) );
	$comment_count = $wpdb->get_var( $wpdb->prepare( "select count(comment_ID) from $wpdb->comments where (user_id= %d or comment_author_email like \"$comment_author_email\")  and comment_approved=1",$userid ) );
	if ( ! $comment_count || $comment_count <= 0 ) { $comment_count = 0;}
	return $comment_count;

}
function users_comments_postids( $userid ) {
	global $wpdb;
	$comment_author_email = $wpdb->get_var( "select user_email from $wpdb->users where ID=\"$userid\"" );
	return $wpdb->get_var( "select group_concat(distinct(comment_post_ID)) from $wpdb->comments where (user_id=\"$userid\" or comment_author_email like \"$comment_author_email\")  and comment_approved=1" );
}

function userCommentCount( $user_email ) {
	global $wpdb;
	$comment_author_email = $user_email;
	//echo "select count(comment_ID) from $wpdb->comments where ( comment_author_email like \"$comment_author_email\" )  and comment_approved=1";
	return $wpdb->get_var( "select count(comment_ID) from $wpdb->comments where ( comment_author_email like \"$comment_author_email\" )  and comment_approved=1" );
}

function get_blog_cat_postids() {
	global $wpdb;
	$blobcat = get_cat_id_from_name( get_option( 'ptthemes_blogcategory' ) );
	$blobcatcatcatids = get_sub_categories( $blobcat,'string' );
	if ( $blobcatcatcatids != '' ) {
		return $srch_blog_pids = $wpdb->get_var( "SELECT group_concat(tr.object_id) FROM $wpdb->term_taxonomy tt join $wpdb->term_relationships tr on tr.term_taxonomy_id=tt.term_taxonomy_id where tt.term_id in ($blobcatcatcatids)" );
	} else {
		return '';
	}

}
function set_question_status( $pid, $status = 'publish' ) {
	if ( $pid ) {
		global $wpdb;
		$wpdb->query( "update $wpdb->posts set post_status=\"$status\" where ID=\"$pid\"" );
	}
}

function get_question_categories( $queston_cat = array() ) {
	$return_str = '';
	if ( get_option( 'ptthemes_question_cat_selection_flag' ) ) {

				$cat_exclude = get_inc_categories( 'cat_exclude_' );
		$cat_exclude_arr = explode( ',',$cat_exclude );
		$cat_arr = array();
		for ( $i = 0;$i < count( $cat_exclude_arr );$i++ ) {
			if ( $cat_exclude_arr[ $i ] ) {
				$cat_arr[] = $cat_exclude_arr[ $i ];
			}
		}
		if ( $cat_arr ) {
			for ( $j = 0;$j < count( $cat_arr );$j++ ) {
				$selected = '';
				if ( $queston_cat ) {
					if ( in_array( $cat_arr[ $j ],$queston_cat ) ) {
						$selected = 'checked';
					}
				} elseif ( $_SESSION['question_info']['queston_cat'] && in_array( $cat_arr[ $j ],$_SESSION['question_info']['queston_cat'] ) ) {
					$selected = 'checked';
				}
				$return_str .= '<li><input type="checkbox" value="' . $cat_arr[ $j ] . '" name="queston_cat[]" ' . $selected . '>' . get_cat_name( $cat_arr[ $j ] ) . '</li>';
			}
		}
	}
	return $return_str;
}
/*tevolution captcha script*/
add_action( 'wp_head','tmpl_captcha_script' );
function tmpl_captcha_script() {
	global $post;
	$pcd = explode( ',',get_option( 'ptthemes_recaptcha_reg_flag' ) );
	/*condition to check whether captcha is enable or not in tevolution general settings*/
	if ( is_array( $pcd ) && ! empty( $pcd ) && (@in_array( 'User Registration Page', $pcd ) || @in_array( 'Ask a Question page', $pcd ) || @in_array( 'Contact Us', $pcd ) || @in_array( 'All of them', $pcd )) ) {
		?>
		<script type="text/javascript">
		  var onloadCallback = function() {
			/* Renders the HTML element with id 'example1' as a reCAPTCHA widget.*/
			/* The id of the reCAPTCHA widget is assigned to 'widgetId1'.*/
			<?php if ( @in_array( 'Contact Us',$pcd ) || in_array( 'All of them',$pcd ) ) { ?>
			if(jQuery('#contact_us').length > 0)
			{
				grecaptcha.render('contact_us', {
					'sitekey' : '<?php echo get_option( 'ptthemes_recaptcha_site_key' ); ?>'
				});
			}
			<?php do_action( 'show_captcha' ); } ?>
			<?php if ( @in_array( 'User Registration Page', $pcd ) || @in_array( 'All of them', $pcd ) ) { ?>

					if(jQuery('#userform_register_cap').length > 0)
			{
				grecaptcha.render('userform_register_cap', {
					'sitekey' : '<?php echo get_option( 'ptthemes_recaptcha_site_key' ); ?>'
				});
			}
			<?php } ?>
			<?php if ( in_array( 'Ask a Question page',$pcd ) || in_array( 'All of them',$pcd ) ) {?>
			if(jQuery('#captcha_div').length > 0)
			{
				if(jQuery('#captcha_div').length > 0)
				{
					grecaptcha.render('captcha_div', {
						'sitekey' : '<?php echo get_option( 'ptthemes_recaptcha_site_key' ); ?>'
					});
				}
			}
			<?php } ?>
			<?php if ( @in_array( 'User Registration Page', $pcd ) || @in_array( 'All of them', $pcd ) ) { ?>
			if(jQuery('#comment_captcha').length > 0)
			{
				var widgetid1 = grecaptcha.render('comment_captcha', {

					'sitekey' : '<?php echo get_option( 'ptthemes_recaptcha_site_key' ); ?>'

				});
				jQuery('#comment_captcha').empty();
				jQuery('[name=user_login_or_not]').on('change',function(e){
					if(jQuery('[name=user_login_or_not]').eq(0).prop('checked')){
						jQuery('#comment_captcha').empty();

					}else if(jQuery('[name=user_login_or_not]').eq(1).prop('checked')){
						grecaptcha.reset();
					}

				
									});
			}
			<?php } ?>
			<?php if ( @in_array( 'User Registration Page', $pcd ) || @in_array( 'All of them', $pcd ) ) { ?>
			if(jQuery('#comment_captcha').length > 0)
			{
				var widgetid1 = grecaptcha.render('comment_captcha', {

					'sitekey' : '<?php echo get_option( 'ptthemes_recaptcha_site_key' ); ?>'

				});
				jQuery('#comment_captcha').empty();
				jQuery('[name=user_login_or_not]').on('change',function(e){
					if(jQuery('[name=user_login_or_not]').eq(0).prop('checked')){
						jQuery('#comment_captcha').empty();

					}else if(jQuery('[name=user_login_or_not]').eq(1).prop('checked')){
						grecaptcha.reset();
					}

				
									});
			}
			<?php } ?>
		  };
		</script>
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
		<?php

	}// End if().
}
/*action to captcha on comment form*/
add_action( 'comment_form', 'templ_show_recaptcha_in_comments' );
/*action to check captcha is wrong, spam the comment*/
add_action( 'preprocess_comment', 'templ_captcha_check_comment' );
function templ_show_recaptcha_in_comments() {
	  global $user_ID;
	  $pcd = explode( ',',get_option( 'ptthemes_recaptcha_reg_flag' ) );
	if ( ( @in_array( 'User Registration Page', $pcd ) || @in_array( 'All of them', $pcd ) ) && $user_ID == '' ) {
		/*submit-button re-ordering */
		add_action( 'wp_footer', 'templ_save_comment_script' );
		$comment_string = <<<COMMENT_FORM
            <div id="recaptcha-submit-btn-area">&nbsp;</div>
            <noscript>
            <style type='text/css'>#submit {display:none;}</style>
            <input name="submit" type="submit" id="submit-alt" tabindex="6"
                value="Submit Comment"/> 
            </noscript>
COMMENT_FORM;

		$use_ssl = (isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on');

		$escaped_error = htmlentities( $_GET['rerror'], ENT_QUOTES );

		echo '<div id="comment_captcha"></div>' . $comment_string;
	}
}
/* this is what does the submit-button re-ordering */
function templ_save_comment_script() {
	$javascript = <<<JS
        <script type="text/javascript">
        var sub = document.getElementById('submit');
        document.getElementById('recaptcha-submit-btn-area').appendChild (sub);
        document.getElementById('submit').tabIndex = 6;
        if ( typeof _recaptcha_wordpress_savedcomment != 'undefined') {
            document.getElementById('comment').value = 
                _recaptcha_wordpress_savedcomment;
        }
        </script>
JS;
	echo $javascript;
}
/*action to check captcha is wrong, spam the comment*/
function templ_captcha_check_comment( $comment_data ) {
	global $user_ID;
	  $pcd = explode( ',',get_option( 'ptthemes_recaptcha_reg_flag' ) );
	if ( ( @in_array( 'User Registration Page', $pcd ) || @in_array( 'All of them', $pcd ) ) && $user_ID == '' ) {
		/* do not check trackbacks/pingbacks*/
		if ( $comment_data['comment_type'] == '' ) {
			/*fetch captcha private key*/
			$privatekey = get_option( 'ptthemes_recaptcha_secret' );
			/*get the response from captcha that the entered captcha is valid or not*/
			$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $privatekey . '&response=' . $_REQUEST['g-recaptcha-response'] . '&remoteip=' . getenv( 'REMOTE_ADDR' ) );
			/*decode the captcha response*/
			$responde_encode = json_decode( $response['body'] );
			/*check the response is valid or not*/
			if ( ! $responde_encode->success ) {
				add_filter('pre_comment_approved',
				/*create_function( '$a', 'return \'spam\';' ));*//*PHP7 Compatibility*/
				function($a){ return 'spam';});
			}
		}
	}
	return $comment_data;
}

/************ captcha on admin registration page *************/
/* for showing captcha on registration page in backend */
add_action( 'init','tmpl_captcha_on_admin_registration' );

function tmpl_captcha_on_admin_registration() {

	$tmpdata = get_option( 'templatic_settings' );
	 $pcd = explode( ',',get_option( 'ptthemes_recaptcha_reg_flag' ) );
	if ( (isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'register') && (@in_array( 'User Registration Page', $pcd ) || @in_array( 'All of them', $pcd )) ) {
		if ( is_multisite() ) {
			add_action( 'signup_extra_fields', 'tmpl_show_recaptcha_in_registration' );
		} else {
			add_action( 'register_form', 'tmpl_show_recaptcha_in_registration' );
		}
	}
}

/* display recaptcha */
function tmpl_show_recaptcha_in_registration( $errors ) {

	/* if it's for wordpress mu, show the errors */
	if ( is_multisite() ) {
		$error = $errors->get_error_message( 'captcha' );
		echo '<label for="verification">Verification:</label>';
		echo ($error ? '<p class="error">' . $error . '</p>' : '');
		echo tmpl_get_recaptcha_html();
	} else {        /* for regular wordpress */
		echo tmpl_get_recaptcha_html();
	}
}

/* html for captcha */
function tmpl_get_recaptcha_html() {
	$tmpdata = get_option( 'templatic_settings' );

		return '<div class="g-recaptcha" data-sitekey="' .
		$tmpdata['site_key'] .
		'" data-theme="' . $tmpdata['comments_theme'] .
		'"></div><script type="text/javascript"' .
		'src="https://www.google.com/recaptcha/api.js?hl=' .
		$tmpdata['recaptcha_language'] .
		'"></script>';
}

/* for captcha varification */
add_action( 'init','tmpl_captcha_varification_admin_registration' );

function tmpl_captcha_varification_admin_registration() {

		$tmpdata = get_option( 'templatic_settings' );
	$display = ( ! empty( $tmpdata['user_verification_page'] )) ? $tmpdata['user_verification_page'] : array();
	if ( (isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'register') && in_array( 'registration',$display ) ) {
		if ( is_multisite() ) {
			add_filter( 'wpmu_validate_user_signup', 'validate_recaptcha_response_wpmu' );
		} else {
			add_filter( 'registration_errors', 'tmpl_validate_recaptcha_response' );
		}
	}
}

/* get response  */
function tmpl_validate_recaptcha_response( $errors ) {

	$tmpdata = get_option( 'templatic_settings' );

	if ( empty( $_POST['g-recaptcha-response'] ) ||
	  $_POST['g-recaptcha-response'] == '' ) {
		$errors->add( 'blank_captcha', __( 'Blank Captcha',DOMAIN ) );
		return $errors;
	}

	/* secret key */
	$secretkey = $tmpdata['secret'];

		/*get the response from captcha that the entered captcha is valid or not*/
	$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretkey . '&response=' . $_REQUEST['g-recaptcha-response'] . '&remoteip=' . getenv( 'REMOTE_ADDR' ) );

		/* get response code */
	$response = json_decode( $response['body'] );

	if ( ! $response->success ) {
		$errors->add( 'captcha_wrong', __( 'Wrong Captcha',DOMAIN ) );
		return $errors;

	}

	return $errors;
}
/************ captcha on admin registration page ends *************/

/* EOF */
?>
