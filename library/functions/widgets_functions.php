<?php

// Register widgetized areas
if ( function_exists( 'register_sidebar' ) ) {
	register_sidebars( 1,array(
		'name' => 'Header Top Advt',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebars( 1,array(
		'name' => 'Home Sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebars( 1,array(
		'name' => 'Inner Page Sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebars( 1,array(
		'name' => 'Ask Question Page Sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebars( 1,array(
		'name' => 'Questions listing Page',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebars( 1,array(
		'name' => 'Blog Page Sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebars( 1,array(
		'name' => 'Top Strip Navigation',
		'before_widget' => '<div id="topmenu" class="menu">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebars( 1,array(
		'name' => 'Header Navigation',
		'before_widget' => '<div id="main-menu" class="menu menu-secondary">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
	) );
}// End if().

// Check for widgets in widget-ready areas //wordpress.org/support/topic/190184?replies=7#post-808787
// Thanks to Chaos Kaizer //blog.kaizeku.com/
function is_sidebar_active( $index = 1 ) {
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-' . $index;

	return (isset( $sidebars[ $key ] ));
}



// =============================== Header Advt ======================================
class headeradvt extends WP_Widget {
	function __construct() {
		//Constructor
		$widget_ops = array(
			'classname' => 'widget Header Advt',
			'description' => 'Header Advt widget',
		);
		parent::__construct( 'widget_headeradvt', 'T &rarr; Header Advt', $widget_ops );
	}
	function widget( $args, $instance ) {
		// prints the widget
		extract( $args, EXTR_SKIP );
		// $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$t1 = empty( $instance['t1'] ) ? '' : apply_filters( 'widget_t1', $instance['t1'] );
		$t2 = empty( $instance['t2'] ) ? '' : apply_filters( 'widget_t2', $instance['t2'] );
		?>


			<?php if ( $t2 <> '' ) { ?>
					<?php echo $t2; ?>
			<?php } ?>




	<?php
	}
	function update( $new_instance, $old_instance ) {
		//save the widget
		$instance = $old_instance;
		// $instance['title'] = strip_tags($new_instance['title']);
		$instance['t1'] = ($new_instance['t1']);
		$instance['t2'] = ($new_instance['t2']);
		return $instance;
	}
	function form( $instance ) {
		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			't1' => '',
			't2' => '',
		) );
		$title = strip_tags( $instance['title'] );
		$t1 = ($instance['t1']);
		$t2 = ($instance['t2']);
?>
	<?php /*?><p><label for="<?php echo $this->get_field_id('t1'); ?>"><?php _e('Title 1');?> <input class="widefat" id="<?php echo $this->get_field_id('t1'); ?>" name="<?php echo $this->get_field_name('t1'); ?>" type="text" value="<?php echo esc_attr($t1); ?>" /></label></p><?php */?>
		<p><label for="<?php echo $this->get_field_id( 't2' ); ?>"><?php _e( 'Header Advt image URL & link here or Google Advt code' );?><textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 't2' ); ?>" name="<?php echo $this->get_field_name( 't2' ); ?>"><?php echo esc_attr( $t2 ); ?></textarea></label></p>
<?php
	}}
register_widget( 'headeradvt' );







// =============================== Text Widget ======================================
class TextWidget extends WP_Widget {
	function __construct() {
		//Constructor
		$widget_ops = array(
			'classname' => 'Text Widget',
			'description' => 'Text us Widget',
		);
		parent::__construct( 'widget_about', 'T &rarr; Text Widget', $widget_ops );
	}
	function widget( $args, $instance ) {
		// prints the widget
		extract( $args, EXTR_SKIP );
		$title = empty( $instance['title'] ) ? '&nbsp;' : apply_filters( 'widget_title', $instance['title'] );
		$desc1 = empty( $instance['desc1'] ) ? '&nbsp;' : apply_filters( 'widget_desc1', $instance['desc1'] );
			?>

			<div class="widget">
			   <h3><?php _e( $title ); ?> </h3>
				<?php if ( $desc1 <> '' ) { ?>
				<?php _e( $desc1 ); ?>
				<?php } ?>

			</div>


		<?php
	}
	function update( $new_instance, $old_instance ) {
		//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc1'] = ($new_instance['desc1']);
		return $instance;
	}
	function form( $instance ) {
		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			't1' => '',
			't2' => '',
			't3' => '',
			'img1' => '',
			'desc1' => '',
		) );
		$title = strip_tags( $instance['title'] );
		$desc1 = ($instance['desc1']);
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title' );?>: <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'desc1' ); ?>"><?php _e( 'Description' );?> <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'desc1' ); ?>" name="<?php echo $this->get_field_name( 'desc1' ); ?>"><?php echo esc_attr( $desc1 ); ?></textarea></label></p>

<?php
	}}
register_widget( 'TextWidget' );




// =============================== Login Widget ======================================
class loginwidget extends WP_Widget {
	function __construct() {
		//Constructor
		$widget_ops = array(
			'classname' => 'Loginbox',
			'description' => 'Loginbox Widget',
		);
		parent::__construct( 'widget_loginwidget', 'T &rarr; Loginbox', $widget_ops );
	}
	function widget( $args, $instance ) {
		// prints the widget
		extract( $args, EXTR_SKIP );
		$title = empty( $instance['title'] ) ? '&nbsp;' : apply_filters( 'widget_title', $instance['title'] );
		$desc1 = empty( $instance['desc1'] ) ? '&nbsp;' : apply_filters( 'widget_desc1', $instance['desc1'] );
			?>

			<div class="widget login_widget">


			<?php
			global $current_user;
			if ( $current_user->ID ) {
			?>
			<h3><?php _e( MY_ACCOUNT_TEXT );?></h3>

			<div class="pro_author">
				<a href="<?php echo get_author_posts_url( $current_user->data->ID );?>"><?php get_user_profile_pic( $current_user->data->ID,42,42 ); ?></a>

				<p> <?php _e( 'Welcome' );?>, <?php echo $current_user->data->display_name;?>. <br />
				<a href="<?php echo get_option( 'siteurl' );?>/?ptype=profile"><?php _e( 'Edit Profile' );?></a>
				| <a href="<?php echo get_option( 'siteurl' );?>/?ptype=login&action=logout"><?php _e( 'Logout' );?></a> </p>
			</div>
				<?php
				if ( get_user_points( $current_user->data->ID ) ) {
					$creditlink = '';
					if ( strstr( get_author_posts_url( $current_user->data->ID ),'?' ) ) {
						$creditlink = get_author_posts_url( $current_user->data->ID ) . '&answered=1';
					} else {
						$creditlink = get_author_posts_url( $current_user->data->ID ) . '?answered=1';
					}
				}
				?>
		  <ul>
			<li><a href="<?php echo get_author_posts_url( $current_user->data->ID );?>"><?php _e( 'Dashboard' );?></a></li>
			 <li><a href="<?php echo get_author_posts_url( $current_user->data->ID );?>"><?php _e( 'Questions Asked' );?> <?php echo '(' . get_usernumposts_count( $current_user->data->ID ) . ')';?></a></li>
			<li><a href="<?php echo get_option( 'siteurl' );?>/?ptype=author_answers&uid=<?php echo $current_user->data->ID;?>"><?php _e( 'Answer Provided' );?><?php echo ' (' . users_comments( $current_user->data->ID ) . ')';?></a></li>
			<li>
			<?php
			$creditlink = '';
			if ( strstr( get_author_posts_url( $current_user->data->ID ),'?' ) ) {
				$creditlink = get_author_posts_url( $current_user->data->ID ) . '&points=1';
			} else {
				$creditlink = get_author_posts_url( $current_user->data->ID ) . '?points=1';
			}
			?>

			<?php
			echo __( 'Received Votes - ' ) . get_user_points( $current_user->data->ID );
			?>

			</li>
		  </ul>
			<?php
			} else {
			?>
			<h3><?php echo $title; ?> </h3>
			<form name="loginform" id="loginform" action="<?php echo get_settings( 'home' ) . '/index.php?ptype=login'; ?>" method="post" >
				   <div class="form_row"><label><?php echo USERNAME_TEXT;?>  <span>*</span></label>  <input name="log" id="user_login1" type="text" class="textfield" /> <span id="user_loginInfo"></span> </div>
				<div class="form_row"><label><?php _e( 'Password' );?>  <span>*</span></label>  <input name="pwd" id="user_pass1" type="password" class="textfield" /><span id="user_passInfo"></span>  </div>

				   <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
				<input type="hidden" name="testcookie" value="1" />

				<input type="submit" name="submit" value="<?php _e( SIGN_IN_BUTTON );?>" class="btn_input_highlight">
			 </form>

			<?php }// End if().
?>
			</div>

		<?php
	}
	function update( $new_instance, $old_instance ) {
		//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc1'] = ($new_instance['desc1']);
		return $instance;
	}
	function form( $instance ) {
		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			't1' => '',
			't2' => '',
			't3' => '',
			'img1' => '',
			'desc1' => '',
		) );
		$title = strip_tags( $instance['title'] );
		$desc1 = ($instance['desc1']);
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title' );?>: <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>

		<?php /*?><p><label for="<?php echo $this->get_field_id('desc1'); ?>">Description <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo esc_attr($desc1); ?></textarea></label></p><?php */?>

<?php
	}}
register_widget( 'loginwidget' );

// =============================== subscribe widget ======================================
class subscribewidget extends WP_Widget {
	function __construct() {
		//Constructor
		$widget_ops = array(
			'classname' => 'widget ',
			'Subscribe' => 'widget Subscribe',
		);
		parent::__construct( 'widget_subscribe', 'T &rarr; Subscribe', $widget_ops );
	}
	function widget( $args, $instance ) {
		// prints the widget
		extract( $args, EXTR_SKIP );
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$text = empty( $instance['text'] ) ? '' : apply_filters( 'widget_text', $instance['text'] );
		$id = empty( $instance['id'] ) ? '' : apply_filters( 'widget_id', $instance['id'] );
			?>


					<div class="subscribe">
						<h6><?php _e( $title ); ?></h6>
						<p><?php _e( $text ); ?></p>


						 <form  action="//feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow"  onsubmit="window.open('//feedburner.google.com/fb/a/mailverify?uri=//feeds.feedburner.com/<?php echo $id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
	  <input type="text" class="subscribefieldnow" onFocus="if (this.value == '<?php _e( 'Your Email Address' );?>') {this.value = '';}" onBlur="if (this.value == '') {this.value = '<?php _e( 'Your Email Address' );?>';}" name="email"/>
	  <input type="hidden" value="<?php echo $id; ?>" name="uri"/><input type="hidden" name="loc" value="en_US"/>
	   <input type="submit" value="<?php _e( 'Subscribe' );?>" class="submit" />

	  </form>

					 </div><!-- subscribe end -->


<?php
	}
	function update( $new_instance, $old_instance ) {
		//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = ($new_instance['text']);
		$instance['id'] = ($new_instance['id']);
		return $instance;
	}
	function form( $instance ) {
		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'text' => '',
			'id' => '',
		) );
		$title = strip_tags( $instance['title'] );
		$text = ($instance['text']);
		$id = ($instance['id']);
	?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'text' ); ?>">Description
  <input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'id' ); ?>">Feedburner ID:
  <input class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" type="text" value="<?php echo esc_attr( $id ); ?>" />
  </label>
</p>
<?php
	}}
register_widget( 'subscribewidget' );







 // =============================== Latest Posts Widget (particular category) ======================================
class LatestPostsParticular2 extends WP_Widget {
	function __construct() {

		//Constructor
		$widget_ops = array(
			'classname' => 'widget latest posts',
			'description' => 'List of latest menus in particular category',
		);
		parent::__construct( 'widget_posts', 'T &rarr; Latest Posts', $widget_ops );
	}



	function widget( $args, $instance ) {
		// prints the widget

		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty( $instance['title'] ) ? '&nbsp;' : apply_filters( 'widget_title', $instance['title'] );
		$category = empty( $instance['category'] ) ? '&nbsp;' : apply_filters( 'widget_category', $instance['category'] );
		$post_number = empty( $instance['post_number'] ) ? '&nbsp;' : apply_filters( 'widget_post_number', $instance['post_number'] );
				?>

			<div class="latestnewshome"><h3><?php _e( $title ); ?></h3> <ul>
			<?php
					global $post;
			if ( ! isset( $post_link ) ) :
				$post_link = '';
					endif;
					$latest_menus = get_posts( 'numberposts=' . $post_number . 'postlink=' . $post_link . '&category=' . $category . '' );
			foreach ( $latest_menus as $post ) :
				setup_postdata( $post );
					?>
			 <li class="clearfix">
			<a class="widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?>
				</a>

			</li>
			<?php endforeach; ?>
		<?php

		echo '</ul></div>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {

		//save the widget

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['post_number'] = strip_tags( $new_instance['post_number'] );
		$instance['post_link'] = strip_tags( $new_instance['post_link'] );
		return $instance;

	}



	function form( $instance ) {

		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'category' => '',
			'post_number' => '',
		) );
		$title = strip_tags( $instance['title'] );
		$category = strip_tags( $instance['category'] );
		$post_number = strip_tags( $instance['post_number'] );
		$post_link = strip_tags( @$instance['post_link'] );

?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' );?>:
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Categories (<code>IDs</code> separated by commas)' );?>:
	<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Number of posts' );?>:
	<input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="text" value="<?php echo esc_attr( $post_number ); ?>" />
  </label>
</p>
<?php

	}

}

register_widget( 'LatestPostsParticular2' );





 // =============================== Top Users Widget ======================================
class topuserwidget extends WP_Widget {
	function __construct() {

		//Constructor
		$widget_ops = array(
			'classname' => 'widget Top Users',
			'description' => 'List of Top Users',
		);
		parent::__construct( 'widget_topuserwidget', 'T &rarr; Top Users', $widget_ops );
	}



	function widget( $args, $instance ) {
		// prints the widget

		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty( $instance['title'] ) ? '&nbsp;' : apply_filters( 'widget_title', $instance['title'] );
		$category = empty( $instance['category'] ) ? '&nbsp;' : apply_filters( 'widget_category', $instance['category'] );
		$post_number = empty( $instance['post_number'] ) ? '&nbsp;' : apply_filters( 'widget_post_number', $instance['post_number'] );
		if ( $post_number <= 0 ) {
			$post_number = 5;
		} ?>

		<h3 class="clearfix"><span class="fl"><?php echo $title; ?></span><span class="fr point"><?php _e( 'Point' ); ?></span></h3>

		<ul class="topusers">
			<?php
			global $wpdb;

			$sql = "select u.display_name,sum(cr.ck_rating_up)-sum(cr.ck_rating_down) as post_count,c.user_id,c.comment_author_email from $wpdb->comments c left join " . $wpdb->prefix . "comment_rating cr on cr.ck_comment_id=c.comment_ID join $wpdb->users u on u.ID=c.user_id where c.comment_approved='1' and c.user_id!=0 group by c.user_id order by post_count desc limit 0,$post_number";

			$result = $wpdb->get_results( $sql );
			if ( $result ) {

				foreach ( $result as $result_obj ) {

					$display_name = $result_obj->display_name;
					$userid = $result_obj->user_id;
					$post_count = $result_obj->post_count;
					if ( ! $post_count ) {
						$post_count = 0;
					}
					?>
					<li class="clearfix">
						<div class="user-details">
							<div class="user-pic">
								<a href="<?php echo get_author_posts_url( $userid );?>">
									<?php get_user_profile_pic( $userid,64,64 ); ?>
								</a>
							</div>

							<div class="user-info">
								<span class="points"><?php echo $post_count;?></span>
								<span class="users">
									<a href="<?php echo get_author_posts_url( $userid );?>"><?php echo $display_name;?></a>
								</span>

								<span class="user-answers">
									<label class="label-col"><?php _e( 'Total Answers' ); ?>:</label><?php echo userCommentCount( $result_obj->comment_author_email );?>
								</span>
							</div>
						</div>

					</li>
					<?php
				}
			} else { ?>

				<li><p><b><?php _e( 'None user got any points' );?></b></p></li>
				<?php
			}// End if().
	?>
		</ul>

		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {

		//save the widget
		 $instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['post_number'] = strip_tags( $new_instance['post_number'] );
		$instance['post_link'] = strip_tags( $new_instance['post_link'] );
		return $instance;

	}



	function form( $instance ) {
		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'category' => '',
			'post_number' => '',
		) );
		$title = strip_tags( $instance['title'] );
		$category = strip_tags( $instance['category'] );
		$post_number = strip_tags( $instance['post_number'] );
		$post_link = strip_tags( @$instance['post_link'] );

?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' );?>:
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
  </label>
</p>

<p>
  <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Number of posts' );?>:
	<input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="text" value="<?php echo esc_attr( $post_number ); ?>" />
  </label>
</p>
<?php

	}

}

register_widget( 'topuserwidget' );







// =============================== Dyanmic Sidebar Blockquote widget ======================================
class BlockquoteWidget extends WP_Widget {
	function __construct() {
		//Constructor
		$widget_ops = array(
			'classname' => 'widget Testimonials',
			'description' => 'Testimonials',
		);
		parent::__construct( 'widget_blockquote', 'T &rarr; Testimonials', $widget_ops );
	}
	function widget( $args, $instance ) {
		// prints the widget
		extract( $args, EXTR_SKIP );
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$quote = array();
		$author = array();
		if ( $instance['quote1'] ) {
			$quote[] = empty( $instance['quote1'] ) ? '' : apply_filters( 'widget_quote1', $instance['quote1'] );
			$author[] = empty( $instance['author1'] ) ? '' : apply_filters( 'widget_author1', $instance['author1'] );
		}
		if ( $instance['quote2'] ) {
			$quote[] = empty( $instance['quote2'] ) ? '' : apply_filters( 'widget_quote2', $instance['quote2'] );
			$author[] = empty( $instance['author2'] ) ? '' : apply_filters( 'widget_author2', $instance['author2'] );
		}
		if ( $instance['quote3'] ) {
			$quote[] = empty( $instance['quote3'] ) ? '' : apply_filters( 'widget_quote3', $instance['quote3'] );
			$author[] = empty( $instance['author3'] ) ? '' : apply_filters( 'widget_author3', $instance['author3'] );
		}
		if ( $instance['quote4'] ) {
			$quote[] = empty( $instance['quote4'] ) ? '' : apply_filters( 'widget_quote4', $instance['quote4'] );
			$author[] = empty( $instance['author4'] ) ? '' : apply_filters( 'widget_author4', $instance['author4'] );
		}
		if ( $instance['quote5'] ) {
			$quote[] = empty( $instance['quote5'] ) ? '' : apply_filters( 'widget_quote5', $instance['quote5'] );
			$author[] = empty( $instance['author5'] ) ? '' : apply_filters( 'widget_author5', $instance['author5'] );
		}
		$more = empty( $instance['more'] ) ? '' : apply_filters( 'widget_more', $instance['more'] );
		?>

		<div class="widget">
		<div class="testimonials">

			   <h3><?php _e( $title ); ?></h3>

		<?php
		if ( $quote ) {
			$key = rand( 0,count( $quote ) -1 );
			$quote1 = $quote[ $key ];
			$author1 = $author[ $key ];
			?>
			<blockquote>
					 <p class="endquote">
					<?php _e( $quote1 ); ?></p></blockquote>
					<cite >- <?php echo $author1; ?></cite>
				 </blockquote>
			<?php
		}
		?>

	   </div>
		 </div>





	<?php
	}
	function update( $new_instance, $old_instance ) {
		//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['quote1'] = ($new_instance['quote1']);
		$instance['author1'] = ($new_instance['author1']);
		$instance['quote2'] = ($new_instance['quote2']);
		$instance['author2'] = ($new_instance['author2']);
		$instance['quote3'] = ($new_instance['quote3']);
		$instance['author3'] = ($new_instance['author3']);
		$instance['quote4'] = ($new_instance['quote4']);
		$instance['author4'] = ($new_instance['author4']);
		$instance['quote5'] = ($new_instance['quote5']);
		$instance['author5'] = ($new_instance['author5']);
		$instance['more'] = ($new_instance['more']);
		return $instance;
	}
	function form( $instance ) {
		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'more' => '',
			'quote1' => '',
			'quote2' => '',
			'quote3' => '',
			'quote4' => '',
			'quote5' => '',
			'author1' => '',
			'author2' => '',
			'author3' => '',
			'author4' => '',
			'author5' => '',
		) );
		$title = strip_tags( $instance['title'] );
		$quote1 = ($instance['quote1']);
		$author1 = ($instance['author1']);
		$quote2 = ($instance['quote2']);
		$author2 = ($instance['author2']);
		$quote3 = ($instance['quote3']);
		$author3 = ($instance['author3']);
		$quote4 = ($instance['quote4']);
		$author4 = ($instance['author4']);
		$quote5 = ($instance['quote5']);
		$author5 = ($instance['author5']);
		$more = ($instance['more']);
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title' );?>: <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id( 'quote1' ); ?>"><?php _e( 'Testimonials' );?> 1 <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'quote1' ); ?>" name="<?php echo $this->get_field_name( 'quote1' ); ?>"><?php echo esc_attr( $quote1 ); ?></textarea></label></p>
 <p><label for="<?php echo $this->get_field_id( 'author1' ); ?>"><?php _e( 'Author Name' );?> 1 <input class="widefat" id="<?php echo $this->get_field_id( 'author1' ); ?>" name="<?php echo $this->get_field_name( 'author1' ); ?>" type="text" value="<?php echo esc_attr( $author1 ); ?>" /></label></p>
	 <p><label for="<?php echo $this->get_field_id( 'quote2' ); ?>"><?php _e( 'Testimonials' );?> 2 <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'quote2' ); ?>" name="<?php echo $this->get_field_name( 'quote2' ); ?>"><?php echo esc_attr( $quote2 ); ?></textarea></label></p>
 <p><label for="<?php echo $this->get_field_id( 'author2' ); ?>"><?php _e( 'Author Name' );?> 2 <input class="widefat" id="<?php echo $this->get_field_id( 'author2' ); ?>" name="<?php echo $this->get_field_name( 'author2' ); ?>" type="text" value="<?php echo esc_attr( $author2 ); ?>" /></label></p>
 <p><label for="<?php echo $this->get_field_id( 'quote3' ); ?>"><?php _e( 'Testimonials' );?> 3 <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'quote3' ); ?>" name="<?php echo $this->get_field_name( 'quote3' ); ?>"><?php echo esc_attr( $quote3 ); ?></textarea></label></p>
 <p><label for="<?php echo $this->get_field_id( 'author3' ); ?>"><?php _e( 'Author Name' );?> 3 <input class="widefat" id="<?php echo $this->get_field_id( 'author3' ); ?>" name="<?php echo $this->get_field_name( 'author3' ); ?>" type="text" value="<?php echo esc_attr( $author3 ); ?>" /></label></p>
 <p><label for="<?php echo $this->get_field_id( 'quote4' ); ?>"><?php _e( 'Testimonials' );?> 4 <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'quote4' ); ?>" name="<?php echo $this->get_field_name( 'quote4' ); ?>"><?php echo esc_attr( $quote4 ); ?></textarea></label></p>
 <p><label for="<?php echo $this->get_field_id( 'author4' ); ?>"><?php _e( 'Author Name' );?> 4 <input class="widefat" id="<?php echo $this->get_field_id( 'author4' ); ?>" name="<?php echo $this->get_field_name( 'author4' ); ?>" type="text" value="<?php echo esc_attr( $author4 ); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id( 'quote5' ); ?>"><?php _e( 'Testimonials' );?> 5 <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id( 'quote5' ); ?>" name="<?php echo $this->get_field_name( 'quote5' ); ?>"><?php echo esc_attr( $quote5 ); ?></textarea></label></p>
 <p><label for="<?php echo $this->get_field_id( 'author5' ); ?>"><?php _e( 'Author Name' );?> 5 <input class="widefat" id="<?php echo $this->get_field_id( 'author5' ); ?>" name="<?php echo $this->get_field_name( 'author5' ); ?>" type="text" value="<?php echo esc_attr( $author5 ); ?>" /></label></p>


<?php
	}}
register_widget( 'BlockquoteWidget' );

// =============================== Advt Sidebar 220x105px Widget ======================================
class advtwidget extends WP_Widget {
	function __construct() {
		//Constructor
		$widget_ops = array(
			'classname' => 'widget Sidebar Advt ',
			'description' => 'widget Sidebar Advt width:220x200px',
		);
		parent::__construct( 'widget_advt', 'T &rarr; Sidebar Advt ', $widget_ops );
	}
	function widget( $args, $instance ) {
		// prints the widget
		extract( $args, EXTR_SKIP );
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$advt1 = empty( $instance['advt1'] ) ? '' : apply_filters( 'widget_advt1', $instance['advt1'] );
		$advt_link1 = empty( $instance['advt_link1'] ) ? '' : apply_filters( 'widget_advt_link1', $instance['advt_link1'] );
		$advt2 = empty( $instance['advt2'] ) ? '' : apply_filters( 'widget_advt2', $instance['advt2'] );
		$advt_link2 = empty( $instance['advt_link2'] ) ? '' : apply_filters( 'widget_advt_link2', $instance['advt_link2'] );
			?>
<!--<h3><?php // echo $title; ?> </h3>-->
<div class="sidebanner">
	<?php if ( $advt1 <> '' ) { ?>
  <a href="<?php echo $advt_link1; ?>"><img src="<?php echo $advt1; ?> " alt="" /></a>
	<?php } ?>
  </div>

<?php
	}
	function update( $new_instance, $old_instance ) {
		//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['advt1'] = ($new_instance['advt1']);
		$instance['advt_link1'] = ($new_instance['advt_link1']);
		return $instance;
	}
	function form( $instance ) {
		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'advt1' => '',
			'advt_link1' => '',
			'advt2' => '',
			'advt_link2' => '',
		) );
		$title = strip_tags( $instance['title'] );
		$advt1 = ($instance['advt1']);
		$advt_link1 = ($instance['advt_link1']);
	?>
<p>
  <label for="<?php echo $this->get_field_id( 'advt1' ); ?>"><?php _e( 'Advt 1 Image Path (ex.//pt.com/images/banner.jpg)' );?>
  <input class="widefat" id="<?php echo $this->get_field_id( 'advt1' ); ?>" name="<?php echo $this->get_field_name( 'advt1' ); ?>" type="text" value="<?php echo esc_attr( $advt1 ); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'advt_link1' ); ?>"><?php _e( 'Advt 1 link' );?>
  <input class="widefat" id="<?php echo $this->get_field_id( 'advt_link1' ); ?>" name="<?php echo $this->get_field_name( 'advt_link1' ); ?>" type="text" value="<?php echo esc_attr( $advt_link1 ); ?>" />
  </label>
</p>
<?php
	}}
register_widget( 'advtwidget' );




// =============================== Tags Cloud ======================================
class tagswidget extends WP_Widget {
	function __construct() {
		//Constructor
		$widget_ops = array(
			'classname' => 'widget Tag Cloud',
			'description' => 'widget Tag Cloud',
		);
		parent::__construct( 'widget_tags', 'T &rarr; Tag Cloud', $widget_ops );
	}
	function widget( $args, $instance ) {
		// prints the widget
		extract( $args, EXTR_SKIP );
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$advt1 = empty( $instance['advt1'] ) ? '' : apply_filters( 'widget_advt1', $instance['advt1'] );
		$advt_link1 = empty( $instance['advt_link1'] ) ? '' : apply_filters( 'widget_advt_link1', $instance['advt_link1'] );
		$advt2 = empty( $instance['advt2'] ) ? '' : apply_filters( 'widget_advt2', $instance['advt2'] );
		$advt_link2 = empty( $instance['advt_link2'] ) ? '' : apply_filters( 'widget_advt_link2', $instance['advt_link2'] );
			?>

	 <div class="widget tagcloud clearfix"><h3 class="tags"><?php _e( $title ); ?> </h3>

	<?php wp_tag_cloud( 'smallest=10&largest=22' ); ?>

	 </div>

<?php
	}
	function update( $new_instance, $old_instance ) {
		//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['advt1'] = ($new_instance['advt1']);
		$instance['advt_link1'] = ($new_instance['advt_link1']);
		return $instance;
	}
	function form( $instance ) {
		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'advt1' => '',
			'advt_link1' => '',
			'advt2' => '',
			'advt_link2' => '',
		) );
		$title = strip_tags( $instance['title'] );
		$advt1 = ($instance['advt1']);
		$advt_link1 = ($instance['advt_link1']);
	?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' );?>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
  </label>
</p>

<?php
	}}
register_widget( 'tagswidget' );


// =============================== Popular Posts Widget ======================================
class pt_popular_post extends WP_Widget {
	function __construct() {
			/* Constructor */
			$widget_ops = array(
				'classname' => 'special',
				'description' => __( 'Showcase posts from any post type, including those created by you. Featured posts are displayed at the top. Works best in the Homepage - Main Content area.', 'templatic-admin' ),
			);
			parent::__construct( 'pt_popular_post', __( 'T &rarr; Popular Posts', 'templatic' ), $widget_ops );
	}
	public function widget( $args, $instance ) {

		$settings_pop = get_option( 'widget_popularposts' );

		$name = $settings_pop['name'];
		$number = $settings_pop['number'];
		if ( $name <> '' ) { $popname = $name;
		} else { $popname = 'Popular Posts'; }
		if ( $number <> '' ) { $popnumber = $number;
		} else { $popnumber = '10'; }

?>

  <div class="widget popular">

	  <h3 class="hl"><span><?php _e( $popname ); ?></span></h3>

		  <ul>

				<?php
				global $wpdb;
				$now = gmdate( 'Y-m-d H:i:s',time() );
				$lastmonth = gmdate( 'Y-m-d H:i:s',gmmktime( date( 'H' ), date( 'i' ), date( 's' ), date( 'm' ) -12,date( 'd' ),date( 'Y' ) ) );
				$popularposts = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND post_date < '$now' AND post_date > '$lastmonth' AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT $popnumber";
				$posts = $wpdb->get_results( $popularposts );
				$popular = '';
				if ( $posts ) {
					foreach ( $posts as $post ) {
						$post_title = stripslashes( $post->post_title );
						   $guid = get_permalink( $post->ID );

							  $first_post_title = substr( $post_title,0,26 );
				?>
					<li>
						<a href="<?php echo $guid; ?>" title="<?php echo $post_title; ?>"><?php _e( $first_post_title ); ?></a>
						<br style="clear:both" />
					</li>
				<?php }
				} ?>

			</ul>
	</div>
<?php
	}
	public function update( $new_instance, $old_instance ) {

		return $new_instance;
	}
	public function form( $instance ) {
		$settings_pop = get_option( 'widget_popularposts' );

		// check if anything's been sent
		if ( isset( $_POST['update_popular'] ) ) {
			$settings_pop['name'] = strip_tags( stripslashes( $_POST['popular_name'] ) );
			$settings_pop['number'] = strip_tags( stripslashes( $_POST['popular_number'] ) );

			update_option( 'widget_popularposts',$settings_pop );
		}

		echo '<p>
					<label for="popular_name">Title:
					<input id="popular_name" name="popular_name" type="text" class="widefat" value="' . $settings_pop['name'] . '" /></label></p>';
		echo '<p>
					<label for="popular_number">Number of popular posts:
					<input id="popular_number" name="popular_number" type="text" class="widefat" value="' . $settings_pop['number'] . '" /></label></p>';
		echo '<input type="hidden" id="update_popular" name="update_popular" value="1" />';
	}
}
register_widget( 'pt_popular_post' );


/*
 * Create the templatic twiter post widget
 */

// Display Twitter messages
if ( ! class_exists( 'Widget_Twidget' ) ) {
	require_once( 'Oauth/twitteroauth.php' );
	class Widget_Twidget extends WP_Widget {
		function __construct() {
			$this->options = array(
				array(
					'name'	=> 'title',
					'label'	=> __( 'Title', DOMAIN ),
					'type'	=> 'text',
				),
				array(
					'name'	=> 'twitter_username',
					'label'	=> __( 'Twitter Username', DOMAIN ),
					'type'	=> 'text',
				),
				array(
					'name'	=> 'consumer_key',
					'label'	=> __( 'Consumer Key', DOMAIN ),
					'type'	=> 'text',
				),
				array(
					'name'	=> 'consumer_secret',
					'label'	=> __( 'Consumer Secret', DOMAIN ),
					'type'	=> 'text',
				),
				array(
					'name'	=> 'access_token',
					'label'	=> __( 'Access Token', DOMAIN ),
					'type'	=> 'text',
				),
				array(
					'name'	=> 'access_token_secret',
					'label'	=> __( 'Access Token Secret', DOMAIN ),
					'type'	=> 'text',
				),
				array(
					'name'	=> 'twitter_number',
					'label'	=> __( 'Number Of Tweets', DOMAIN ),
					'type'	=> 'text',
				),
				array(
					'name'	=> 'follow_text',
					'label'	=> __( 'Twitter button text <small>(for eg. Follow us, Join me on Twitter, etc.)</small>', DOMAIN ),
					'type'	=> 'text',
				),
			);
			$widget_options = array(
				'classname'		=> 'widget Templatic twitter',
				'description'	=> __( 'Show your latest tweets on your site.','templatic' ),
			);
			parent::__construct( false, __( 'T &rarr; Latest Twitter Feeds','templatic' ), $widget_options );
		}

		function widget( $args, $instance ) {
			extract( $args, EXTR_SKIP );
			$title = ($instance['title']) ? $instance['title'] : 'Latest Tweets';
			$twitter_username = ($instance['twitter_username']) ? $instance['twitter_username'] : '';
			$consumer_key = ($instance['consumer_key']) ? $instance['consumer_key'] : '3';
			$consumer_secret = ($instance['consumer_secret']) ? $instance['consumer_secret'] : '3';
			$access_token = ($instance['access_token']) ? $instance['access_token'] : '3';
			$access_token_secret = ($instance['access_token_secret']) ? $instance['access_token_secret'] : '3';
			$twitter_number = ($instance['twitter_number']) ? $instance['twitter_number'] : '3';
			$follow_text = apply_filters( 'widget_title', $instance['follow_text'] );

			echo $before_widget;
			echo '<div id="twitter" style="margin: auto;" >';
			if ( $title ) {
				echo '<h3 class="i_twitter">' . $title . '</h3>';
			}
			if ( $twitter_username != '' ) {
				templatic_twitter_messages( $instance );
			}
			echo '</div>';
			echo $after_widget;
		}

		/** @see WP_Widget::update */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			foreach ( $this->options as $val ) {
				if ( $val['type'] == 'text' ) {
					$instance[ $val['name'] ] = strip_tags( $new_instance[ $val['name'] ] );
				} elseif ( $val['type'] == 'checkbox' ) {
					$instance[ $val['name'] ] = ($new_instance[ $val['name'] ] == 'on') ? true : false;
				}
			}
			return $instance;
		}
		function form( $instance ) {
			if ( empty( $instance ) ) {
				$instance['title']					= __( 'Latest Tweets', DOMAIN );
				$instance['twitter_username']		= 'templatic';
				$instance['consumer_key']			= '';
				$instance['consumer_secret']		= '';
				$instance['access_token']			= '';
				$instance['access_token_secret']	= '';
				$instance['twitter_number']			= '3';
				$instance['follow_text']			= __( 'Follow Us','templatic' );
			}
			echo '<p><span style="font-size:11px">To use this widget, <a href="https://dev.twitter.com/apps/new" style="text-decoration:none;" target="_blank">create</a> an application or <a href="https://dev.twitter.com/apps" target="_blank" style="text-decoration:none;" >click here</a> if you already have it, and fill required fields below. Need help? Read <a href="//templatic.com/docs/latest-changes-in-twitter-widget-for-all-templatic-themes/" title="Tweeter Widget Guide" target="_blank" style="text-decoration:none;" >Tweeter Guide</a>.</small></p>';
			foreach ( $this->options as $val ) {
				$label = '<label for="' . $this->get_field_id( $val['name'] ) . '">' . $val['label'] . '</label>';
				if ( $val['type'] == 'separator' ) {
					echo '<hr />';
				} elseif ( $val['type'] == 'text' ) {
					echo '<p>' . $label . '<br />';
					echo '<input class="widefat" id="' . $this->get_field_id( $val['name'] ) . '" name="' . $this->get_field_name( $val['name'] ) . '" type="text" value="' . esc_attr( $instance[ $val['name'] ] ) . '" /></p>';
				} elseif ( $val['type'] == 'checkbox' ) {
					$checked = ($instance[ $val['name'] ]) ? 'checked="checked"' : '';
					echo '<input id="' . $this->get_field_id( $val['name'] ) . '" name="' . $this->get_field_name( $val['name'] ) . '" type="checkbox" ' . $checked . ' /> ' . $label . '<br />';
				}
			}
		}
	}
	// Register Widget
	/*add_action( 'widgets_init', create_function( '', 'return register_widget("Widget_Twidget");' ) );*//*PHP7 Compatibility*/
	add_action( 'widgets_init', function(){return register_widget("Widget_Twidget");} );
}// End if().

//Function to convert date to time ago format
//eg.1 day ago, 1 year ago, etc...
function time_elapsed_string( $ptime ) {
	$etime = time() - $ptime;

	if ( $etime < 1 ) {
		return __( '0 seconds','templatic' );
	}

	$a = array(
	12 * 30 * 24 * 60 * 60  => 'year',
				30 * 24 * 60 * 60       => 'month',
				24 * 60 * 60            => 'day',
				60 * 60                 => 'hour',
				60                      => 'minute',
				1                       => 'second',
				);

	foreach ( $a as $secs => $str ) {
		$d = $etime / $secs;
		if ( $d >= 1 ) {
			$r = round( $d );
			return __( $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago','templatic' );
		}
	}
}
//Function to convert date to time ago format

function templatic_twitter_messages( $options ) {
	$twitter_username	 = $options['twitter_username'];
	$consumer_key		 = $options['consumer_key'];
	$consumer_secret	 = $options['consumer_secret'];
	$access_token		 = $options['access_token'];
	$access_token_secret = $options['access_token_secret'];
	$twitter_number		 = $options['twitter_number'];
	$follow_text		 = $options['follow_text'];

	function getConnectionWithAccessToken( $cons_key, $cons_secret, $oauth_token, $oauth_token_secret ) {
		$connection = new TwitterOAuth( $cons_key, $cons_secret, $oauth_token, $oauth_token_secret );
		return $connection;
	}
	$connection = getConnectionWithAccessToken( $consumer_key, $consumer_secret, $access_token, $access_token_secret );
	$tweets = $connection->get( 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $twitter_username . '&count=' . $twitter_number );
	$tweet_errors = (array) $tweets->errors;
	if ( empty( $tweets ) ) {
		_e( 'No public tweets','templatic' );
	} elseif ( ! empty( $tweet_errors ) ) {
		$twitter_error = $tweet_errors;
		$debug = '<br />Error:(' . $twitter_error[0]->code . ')<br/> ' . $twitter_error[0]->message;
		_e( 'Unable to get tweets' . $debug,'templatic' );
	} else {
		echo '<ul id="twitter_update_list" class="templatic_twitter_widget">';
		foreach ( $tweets  as $tweet ) {
			$twitter_timestamp = strtotime( $tweet->created_at );
			$tweet_date = time_elapsed_string( $twitter_timestamp );
			echo '<li>';
				echo parseTweet( $tweet->text );
				echo '<span class="twit_time" style="display: block;">' . $tweet_date . '</span>';
			echo '</li>';
		}
		echo '</ul>';
		if ( $follow_text ) {
			echo "<a href='//www.twitter.com/$twitter_username/' title='$follow_text' class='b_followusontwitter' target='_blank'>$follow_text</a>";
		}
	}
}
if ( ! function_exists( 'parseTweet' ) ) {
	function parseTweet( $text ) {
		$text = preg_replace( '#//[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text ); //Link
		$text = preg_replace( '#@([a-z0-9_]+)#i', '@<a  target="_blank" href="//twitter.com/$1">$1</a>', $text ); //usernames
		$text = preg_replace( '# \#([a-z0-9_-]+)#i', ' #<a target="_blank" href="//search.twitter.com/search?q=%23$1">$1</a>', $text ); //Hashtags
		$text = preg_replace( '#https://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text ); //Links
		return $text;
	}
}
?>
