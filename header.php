<?php
if ( ! isset( $_SESSION ) ) :
	session_start();
endif;
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head profile="//gmpg.org/xfn/11">
<title>
<?php if ( is_home() ) { ?><?php bloginfo( 'description' ); ?>&nbsp;|&nbsp;<?php bloginfo( 'name' ); ?><?php } ?>
<?php if ( is_search() ) { ?>Search Results&nbsp;|&nbsp;<?php bloginfo( 'name' ); ?><?php } ?>
<?php if ( is_author() ) { ?>Author Archives&nbsp;|&nbsp;<?php bloginfo( 'name' ); ?><?php } ?>
<?php if ( is_single() ) { ?><?php wp_title( '' ); ?><?php } ?>
<?php if ( is_page() ) { ?><?php wp_title( '' ); ?><?php } ?>
<?php if ( is_category() ) { ?><?php single_cat_title(); ?>&nbsp;|&nbsp;<?php bloginfo( 'name' ); ?><?php } ?>
<?php if ( is_month() ) { ?><?php the_time( 'F' ); ?>&nbsp;|&nbsp;<?php bloginfo( 'name' ); ?><?php } ?>
<?php if ( function_exists( 'is_tag' ) ) { if ( is_tag() ) { wp_title( '' ); }
} ?>
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<?php if ( is_home() ) { ?>
<?php if ( get_option( 'ptthemes_meta_description' ) <> '' ) { ?>
<meta name="description" content="<?php echo stripslashes( get_option( 'ptthemes_meta_description' ) ); ?>" />
<?php } ?>
<?php if ( get_option( 'ptthemes_meta_keywords' ) <> '' ) { ?>
<meta name="keywords" content="<?php echo stripslashes( get_option( 'ptthemes_meta_keywords' ) ); ?>" />
<?php } ?>
<?php if ( get_option( 'ptthemes_meta_author' ) <> '' ) { ?>
<meta name="author" content="<?php echo stripslashes( get_option( 'ptthemes_meta_author' ) ); ?>" />
<?php } ?>
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
<?php if ( get_option( 'ptthemes_favicon' ) <> '' ) { ?>
<link rel="shortcut icon" type="image/png" href="<?php echo get_option( 'ptthemes_favicon' ); ?>" />
<?php } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option( 'ptthemes_feedburner_url' ) <> '' ) { echo get_option( 'ptthemes_feedburner_url' );
} else { echo get_bloginfo_rss( 'rss2_url' ); } ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if ( get_option( 'ptthemes_scripts_header' ) <> '' ) { echo stripslashes( get_option( 'ptthemes_scripts_header' ) ); } ?>
<link rel="stylesheet" type="text/css"  href="<?php bloginfo( 'template_directory' ); ?>/library/css/print.css" media="print" />
<link rel="stylesheet" type="text/css"  href="<?php bloginfo( 'template_directory' ); ?>/library/css/menu.css" />
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/js/blogger.js"></script>
<script defer src="<?php bloginfo( 'template_directory' ); ?>/library/js/modernizr.min.js"></script>
<script defer src="<?php bloginfo( 'template_directory' ); ?>/library/js/menu.js"></script>
<?php

wp_enqueue_script( 'jquery' );
if ( is_single() || is_page() ) { wp_enqueue_script( 'comment-reply' );
} ?>

<!-- For Menu -->
<?php
if ( is_singular() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
?>
<?php wp_head(); ?>


<?php if ( get_option( 'ptthemes_customcss' ) ) { ?>
<link href="<?php bloginfo( 'template_directory' ); ?>/custom.css" rel="stylesheet" type="text/css">
<?php } ?>
<script type="text/javascript">
function scroll_to_element(id)
{
	jQuery(document).ready(function(){
		jQuery('html, body').animate({
			scrollTop: jQuery("#"+id).offset().top
		}, 2000);
	});
}
</script>
</head>

<body <?php body_class( $class ); ?>>
		<div id="top_strip">
			<div id="top_strip_in" class="clearfix" >
			<?php
			if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'Top Strip Navigation' ) ) {} else {  ?>	
					<?php if ( get_option( 'ptthemes_top_strip_pages' ) <> '' ) { ?>
			
					<div id="topmenu" class="menu">
					 <ul>
						<?php wp_list_pages( 'title_li=&depth=0&include=' . get_option( 'ptthemes_top_strip_pages' ) . '&sort_column=menu_order' ); ?>
					</ul>
					</div>
			<?php }
			}
			   global $current_user;
			if ( $current_user->data->ID ) {
				?>
				<p><?php _e( 'Welcome' );?> <?php echo $current_user->data->display_name;?>.  <a href="<?php echo get_author_posts_url( $current_user->data->ID );?>"><?php _e( 'Dashboard' );?></a> or <a href="<?php echo get_option( 'siteurl' );?>/?ptype=login&action=logout"><?php _e( 'Logout' );?></a></p>
				<?php
			} else {
				?>
				<p><?php _e( 'Welcome Guest' );?>. <a href="<?php echo get_option( 'siteurl' );?>/?ptype=login&page1=sign_in"><?php _e( 'Sign in' );?></a>
				<?php
				if ( get_option( 'users_can_register' ) ) { ?>
					or <a href="<?php echo get_option( 'siteurl' );?>/?ptype=login&page1=sign_up"><?php _e( 'Signup' );?></a></p>
					<?php
				}
			}
				?> 

				
						  </div>
		</div> <!-- top strip #end -->        

		
		<div id="header">
			<div id="header_in" class="clearfix">
	
							<?php if ( get_option( 'ptthemes_show_blog_title' ) ) { ?>

									   <div class="logo">  <div class="blog-title"><a href="<?php echo get_option( 'home' ); ?>/"><?php bloginfo( 'name' ); ?></a> </div>
						<p class="blog-description">
							<?php bloginfo( 'description' ); ?>
						</p> </div>

								<?php } else { ?>

									 <div class="logo"><a href="<?php echo get_option( 'home' ); ?>/"><img src="<?php if ( get_option( 'ptthemes_logo_url' ) <> '' ) { echo get_option( 'ptthemes_logo_url' );
} else { echo get_bloginfo( 'template_directory' ) . '/images/logo.png'; } ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					</div>
					<?php } ?>

				 
				 
								  <div class="header_right">
					<?php dynamic_sidebar( 1 );  ?> 
				 </div>
		
							 <a class="mobile-ask-que" href="<?php echo site_url( '?ptype=ask-a-question' ); ?>"><i class="fa fa-plus-square" aria-hidden="true"></i></a>

			</div>
		</div> <!-- header #end -->

		

		<div id="nav">
			<div id="nav_in">
					<?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'Header Navigation' ) ) {} else {  ?>	
				<div id="main-menu" class="menu menu-secondary">
				<ul>

								<li class="hometab <?php if ( is_home() && ! isset( $_REQUEST['ptype'] ) ) { ?> current_page_item <?php } ?>">
						<a href="<?php echo get_option( 'home' ); ?>/"><?php echo HOME_TEXT; ?></a></li>

													<?php wp_list_pages( 'title_li=&depth=0&exclude=' . get_inc_pages( 'pag_exclude_' ) . '&sort_column=menu_order' ); ?>
						<?php if ( is_user_add_question() ) {?>
						<li class="<?php if ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'ask-a-question' ) { ?> current_page_item <?php } ?>"><a href=" <?php echo get_option( 'siteurl' );?>/?ptype=ask-a-question" ><?php _e( ASK_QUESTION_TEXT );?></a></li>
						<?php }?>
							<?php
							if ( ! get_option( 'ptthemes_users_link_flag' ) ) {
								?>
							   <li class="<?php if ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'users' ) { echo 'current_page_item';} ?>"><a href=" <?php echo get_option( 'siteurl' );?>/?ptype=users"><?php _e( 'Users' );?></a></li>
							<?php }
							global $wpdb;
							$blogcatname = get_option( 'ptthemes_blogcategory' );
							$catid = $wpdb->get_var( "SELECT term_ID FROM $wpdb->terms WHERE name = '$blogcatname'" );
			?>
				<?php if ( ! get_option( 'ptthemes_blog_link_flag' ) && $catid ) { ?>
			 <li <?php if ( is_category() ) { ?> class="current_page_item" <?php } ?>><a href="<?php echo get_option( 'home' );?>/?cat=<?php echo $catid; ?>" title="<?php echo $blogcatname; ?>"><?php echo $blogcatname; ?></a></li>
			<?php } ?>

										   </ul>
		  </div>
				<?php }?>
				<div class="search">
					<form method="get" id="searchform" action="<?php bloginfo( 'url' ); ?>">
						<input type="text" value="Find a Question" name="s" id="s" class="textfield" onfocus="if (this.value == 'Find a Question') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Find a Question';}" />
						<input type="image" class="b_search" src="<?php bloginfo( 'template_url' ); ?>/images/b_search.png" alt="Submit button" />
					</form>
				</div>

							</div> 
		</div> <!-- nav #end -->
	<?php

	if ( isset( $_REQUEST['ptype'] ) && ($_REQUEST['ptype'] == 'ask-a-question' || $_REQUEST['ptype'] == 'users') ) { ?>
		<script type="text/javascript" >
		jQuery.noConflict();
		jQuery(document).ready(function() {
		jQuery('li.menu-item-home').removeClass('current-menu-item');
		jQuery('li.page_item').removeClass('current_page_item');
		});
		</script>
		<?php }
?>     
<div id="wrapper">
