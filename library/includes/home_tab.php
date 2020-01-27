<?php
$option_value = get_option( 'mysite_general_settings' );
$main_tab_title1 = stripslashes( $option_value['main_tab_title1'] );
$main_tab_title2 = stripslashes( $option_value['main_tab_title2'] );

$home_tabble_info = array(
					'latest'	=> __( $main_tab_title1 ),
//					'popular'	=> __( 'Most Responses' ),
					'unanswered' => __( $main_tab_title2 ),
//					'answers'	=> __( 'Recently Answered' ),
					);
?>
<ul id="tab" class="clearfix">
<?php
$counter = 0;
foreach ( $home_tabble_info as $key => $val ) {
	$counter++;
	if ( (isset( $_REQUEST['ptype'] ) && @$_REQUEST['ptype'] == '') && $counter == 1 ) {
		$_REQUEST['ptype'] = $key;
	}
	if ( ( ! isset( $_REQUEST['ptype'] ) && @$_REQUEST['ptype'] == '') && $counter == 1 ) {
		$_REQUEST['ptype'] = $key;
	}

	if ( get_option( 'show_on_front' ) == 'posts' ) {

		$site_url = get_option( 'siteurl' ) . '/';
	} else {	global $post;
		$site_url = get_permalink( $post->ID );
	}
?>
<li class="page_item <?php if ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == $key ) {echo 'current_page_item';}?>"><a href="<?php echo $site_url;?>?ptype=<?php echo $key;?>"><?php echo $val;?></a></li> 
<?php
}
?>
</ul>
