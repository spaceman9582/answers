 </div> <!-- wrapper #end --> 
    
    <div id="footer">
    	<div id="footer_in">
      		
            <div class="fleft">
            <p> &copy; <?php echo date( 'Y' ); ?> <?php bloginfo(); ?>  All right reserved.</p>

				<?php if ( get_option( 'ptthemes_footerpages' ) <> '' ) { ?>
			<ul>
			<?php wp_list_pages( 'title_li=&depth=0&include=' . get_option( 'ptthemes_footerpages' ) . '&sort_column=menu_order' ); ?>
			</ul>
		<?php } ?>	

				</div>

				 <p class="author"> <span class="designby">Appointment WordPress theme </span>  <span class="templatic"> <a href="https://templatic.com/cms-themes/" alt="wordpress themes" title="Wordpress themes" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/images/templatic-wordpress-themes.png" alt="wordpress themes"></a>  </span></p>								

		 </div>
	</div><!--footer end-->
 
 
	 <script type="text/javascript">
function addToFavorite(property_id,action)
{
	 //alert(property_id);
	<?php
	global $current_user;
	if ( $current_user->data->ID == '' ) {
	?>
	window.location.href="<?php echo get_option( 'siteurl' ); ?>/?page=login&amp;page1=sign_in";
	<?php
	} else {
	?>
	var fav_url; 
	if(action == 'add')
	{
		fav_url = '<?php echo get_option( 'siteurl' ); ?>/index.php?page=favorite&amp;action=add&amp;pid='+property_id;
	}
	else
	{
		fav_url = '<?php echo get_option( 'siteurl' ); ?>/index.php?page=favorite&amp;action=remove&amp;pid='+property_id;
	}
	$.ajax({	
		url: fav_url ,
		type: 'GET',
		dataType: 'html',
		timeout: 9000,
		error: function(){
			alert('Error loading agent favorite property.');
		},
		success: function(html){	
		<?php
		if ( isset( $_REQUEST['list'] ) && $_REQUEST['list'] == 'favourite' ) { ?>
			document.getElementById('list_property_'+property_id).style.display='none';	
			<?php
		}
		?>	
			document.getElementById('favorite_property_'+property_id).innerHTML=html;								
		}
	});
	return false;
	<?php }// End if().
	?>
}
</script>	
	<?php wp_footer(); ?><?php if ( get_option( 'ptthemes_google_analytics' ) <> '' ) { echo stripslashes( get_option( 'ptthemes_google_analytics' ) ); } ?>
</body>
</html>		
