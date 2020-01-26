<?php get_header(); ?>
<?php
if ( $_REQUEST['sort'] == 'alpha' ) {
	$kw = $_REQUEST['kw'];
	if ( $kw == '' ) {$kw = 'a';}
}
$arrAgents = custom_list_authors( '',array(
	'kw' => $kw,
	'sort' => $_REQUEST['sort'],
	'experts' => 1,
) );

?>
<div id="content">

		  <ul id="tab" class="clearfix">
			  <li class="page_item <?php if ( $_REQUEST['sort'] == 'all' || $_REQUEST['sort'] == '' ) {echo 'current_page_item';}?>"><a href="<?php echo get_option( 'siteurl' );?>/?ptype=experts&sort=all"><?php _e( 'All Users' );?></a></li> 
			  <li class="page_item <?php if ( $_REQUEST['sort'] == 'popular' ) {echo 'current_page_item';}?>"><a href="<?php echo get_option( 'siteurl' );?>/?ptype=experts&sort=popular"><?php _e( 'Popular' );?></a></li>
			  <li class="page_item <?php if ( $_REQUEST['sort'] == 'alpha' ) {echo 'current_page_item';}?>"><a href="<?php echo get_option( 'siteurl' );?>/?ptype=experts&sort=alpha">Alphabetical</a></li>
			 </ul>

			 
			 
				 <div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '',' &raquo; ' . __( 'Experts' ) ); } ?></p>
	 </div> <?php if ( $_REQUEST['sort'] == 'alpha' ) {
			?>
			<ul class="alphabetical">
			<li <?php if ( $kw == 'a' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=a">A</a></li>
			<li <?php if ( $kw == 'b' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=b">B</a></li>
			<li <?php if ( $kw == 'c' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=c">C</a></li>
			<li <?php if ( $kw == 'd' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=d">D</a></li>
			<li <?php if ( $kw == 'e' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=e">E</a></li>
			<li <?php if ( $kw == 'f' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=f">F</a></li>
			<li <?php if ( $kw == 'g' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=g">G</a></li>
			<li <?php if ( $kw == 'h' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=h">H</a></li>
			<li <?php if ( $kw == 'i' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=i">I</a></li>
			<li <?php if ( $kw == 'j' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=j">J</a></li>
			<li <?php if ( $kw == 'k' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=k">K</a></li>
			<li <?php if ( $kw == 'l' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=l">L</a></li>
			<li <?php if ( $kw == 'm' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=m">M</a></li>
			<li <?php if ( $kw == 'n' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=n">N</a></li>
		   <li <?php if ( $kw == 'o' ) { echo 'class="current"';}?>> <a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=o">O</a></li>
		   <li <?php if ( $kw == 'p' ) { echo 'class="current"';}?>> <a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=p">P</a></li>
			<li <?php if ( $kw == 'q' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=q">Q</a></li>
			<li <?php if ( $kw == 'r' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=r">R</a></li>
			<li <?php if ( $kw == 's' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=s">S</a></li>
			<li <?php if ( $kw == 't' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=t">T</a></li>
			<li <?php if ( $kw == 'u' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=u">U</a></li>
			<li <?php if ( $kw == 'v' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=v">V</a></li>
			<li <?php if ( $kw == 'w' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=w">W</a></li>
			<li <?php if ( $kw == 'x' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=x">X</a></li>
			<li <?php if ( $kw == 'y' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=y">Y</a></li>
			<li <?php if ( $kw == 'z' ) { echo 'class="current"';}?>><a href="<?php echo get_option( 'siteurl' )?>/?ptype=<?php echo $_REQUEST['ptype']; ?>&sort=alpha&kw=z">Z</a></li>
			</ul>
			<?php }?>

					 <ul class="userlistings">
					<?php
					if ( $_REQUEST['sort'] == 'alpha' ) {
						$kw = sanitize_text_field( $_REQUEST['kw'] );
						if ( $kw == '' ) {$kw = 'a';}
					}
					$totalpost_count = custom_list_authors_count( '',array(
						'kw' => $kw,
						'sort' => $_REQUEST['sort'],
					) );
					if ( count( $arrAgents ) > 0 ) {
						foreach ( $arrAgents as $key => $value ) {
							$userDetail = get_user_meta( $value->ID,'user_address_info' );
					?>
					<li> 
						<?php get_user_profile_pic( $value ->ID,100,100 ); ?>
					  <h3><span class="fl"> <a href="<?php echo get_author_posts_url( $value->ID );?>"><?php echo $value->display_name;?></a> </span>
					  <span class="total_homes">
					   <a href="<?php echo get_author_posts_url( $value->ID );?>">
						<?php _e( 'Listed' );?> 
						<?php echo get_usernumposts_count( $value->ID ); ?> <?php _e( 'Questions &raquo;' );?> </a>

												<?php
												if ( get_user_points( $value->ID ) ) {
													?>
													<?php
													$creditlink = '';
													if ( strstr( get_author_posts_url( $value->ID ),'?' ) ) {
														$creditlink = get_author_posts_url( $value->ID ) . '&points=1';
													} else {
														$creditlink = get_author_posts_url( $value->ID ) . '?points=1';
													}
													?>
													<a href="<?php echo $creditlink;?>">
													<?php
													echo get_user_points( $value->ID ) . __( '  - Votes Received&nbsp;&nbsp;&nbsp;' );
													?>
												  </a>
													<?php
												}
							?>
						  </span>
						  </h3>
						 <p class="agentlinks">
							<?php if ( $value->user_url ) { ?>
					  <span><a href="<?php echo $value->user_url; ?>"><?php _e( "Visit User's Website" );?></a> </span>
						<?php } ?>
						<?php if ( $value -> user_twitter ) { ?>
					  <span><a href="<?php echo $value->user_url; ?>">| <?php _e( 'Twitter' );?></a></span>
						<?php } ?>
						  </p>
						 <p><?php if ( strlen( $value->user_description ) > 170 ) { echo substr( $value->user_description,0,170 ) . ' ...';
} else { echo $value->user_description;}?> </p>

										   <p class="links">
						<a href="#" class="i_email_agent" onclick="document.getElementById('agt_mail_agent_aid').value=<?php echo $value->ID; ?>;document.getElementById('agt_mail_agent_pid').value='';" >
						<?php _e( 'E-mail' );?></a> 
						<?php if ( $value->user_phone ) { ?>
					<span class="phone">  |  <?php _e( 'Phone' );?> : <?php echo $value->user_phone; ?></span> 
					<?php } ?>

										  <span class="fr profile" ><a href="<?php echo get_author_posts_url( $value->ID );?>"  class="" ><?php _e( 'View Profile &raquo;' );?></a></span> </p>
					</li>                   
				<?php
						}// End foreach().
					} else {
					?>
					<p class="ac"><?php _e( 'No User available for this match, name begin with ' );?>"<b><?php echo strtoupper( $kw );?></b>"</p>
				<?php
					}// End if().
				?>	
			 </ul>
	
						<!-- Pagination -->
			  <div class="pagination">
				<?php if ( function_exists( 'wp_pagenavi' ) ) { ?><?php wp_pagenavi(); ?><?php } ?>
			 </div>
		
				</div> <!-- content #end -->

				<div id="sidebar" class="sidebar_spacer" >
			
					   <a href="#" class="b_askquestions" ><?php _e( 'Ask a Question' );?></a>

								<?php dynamic_sidebar( 2 );  ?> 

				
					   </div> <!-- sidebar #end -->

			<?php get_footer(); ?>
