<?php
global $wpdb;
global $upload_folder_path;
if ( $_POST ) {
	if ( $_FILES['bulk_upload_csv']['name'] != '' && $_FILES['bulk_upload_csv']['error'] == '0' ) {
		$filename = $_FILES['bulk_upload_csv']['name'];
		$filenamearr = explode( '.',$filename );
		$extensionarr = array( 'csv','CSV' );
		if ( in_array( $filenamearr[ count( $filenamearr ) -1 ],$extensionarr ) ) {
			$destination_path = ABSPATH . $upload_folder_path . 'csv/';
			if ( ! file_exists( $destination_path ) ) {
				mkdir( $destination_path, 0777 );
			}
			$target_path = $destination_path . $filename;
			$csv_target_path = $target_path;
			//$user_path = get_option( 'siteurl' ) ."/wp-content/uploads/csv/".$filename;
			if ( @move_uploaded_file( $_FILES['bulk_upload_csv']['tmp_name'], $target_path ) ) {
				$fd = fopen( $target_path, 'rt' );

				$rowcount = 0;
				$customKeyarray = array();
				while ( ! feof( $fd ) ) {
					$buffer = fgetcsv( $fd, 4096 );
					if ( $rowcount == 0 ) {
						for ( $k = 0;$k < count( $buffer );$k++ ) {
							$customKeyarray[ $k ] = $buffer[ $k ];
						}
					} else {
						$post_title = addslashes( $buffer[0] );
						$post_desc = addslashes( $buffer[1] );
						$post_cat = $buffer[2]; // comma seperated
						if ( $post_title != '' ) {
							$catids_arr = explode( ',',$post_cat );
							$my_post['post_title'] = $post_title;
							$my_post['post_content'] = $post_desc;
							$my_post['post_author'] = 1;
							$my_post['post_status'] = 'publish';
							$my_post['post_category'] = $catids_arr;
							$my_post['tags_input'] = '';
							$last_postid = wp_insert_post( $my_post );

							for ( $c = 3;$c < 16;$c++ ) {
								update_post_meta( $last_postid, $customKeyarray[ $c ], addslashes( $buffer[ $c ] ) );
							}
							$menu_order = 0;
							$image_folder_name = 'property/';
							for ( $i = 16;$i < count( $buffer );$i++ ) {
								if ( $buffer[ $i ] ) {
									$image_name = $buffer[ $i ];
									$menu_order = $i + 1;
									$image_name_arr = explode( '/',$image_name );
									$img_name = $image_name_arr[ count( $image_name_arr ) -1 ];
									$img_name_arr = explode( '.',$img_name );
									$post_img = array();
									$post_img['post_title'] = $img_name_arr[0];
									$post_img['post_status'] = 'attachment';
									$post_img['post_parent'] = $last_postid;
									$post_img['post_type'] = 'attachment';
									$post_img['post_mime_type'] = 'image/jpeg';
									$post_img['menu_order'] = $menu_order;
									$last_postimage_id = wp_insert_post( $post_img );
									update_post_meta( $last_postimage_id, '_wp_attached_file', $image_folder_name . $image_name );
									$post_attach_arr = array(
														'width'	=> 580,
														'height' =>	480,
														'hwstring_small' => "height='150' width='150'",
														'file'	=> $image_folder_name . $image_name,
														);
									wp_update_attachment_metadata( $last_postimage_id, $post_attach_arr );
								}
							}
						}// End if().
					}// End if().
					$rowcount++;
				}// End while().
				echo '<div id=message class=updated><p>csv uploaded successfully</p>';
				$rowcount = $rowcount -2;
				echo "<p><b>Total of $rowcount records inserted</b></p>";
				echo "<p>Please create folder named 'property' and upload/paste the images folder in '" . $upload_folder_path . "' folder </p></div>";
				@unlink( $csv_target_path );
			} else {
				$msg = 'muerror';
			}// End if().
		}// End if().
	} else {
		$msg = 'ferror';
	}// End if().
}// End if().
?>

<form action="<?php echo get_option( 'siteurl' )?>/wp-admin/admin.php?page=bulkupload" method="post" name="bukl_upload_frm" enctype="multipart/form-data">
  <style>
h2 { color:#464646;font-family:Georgia,"Times New Roman","Bitstream Charter",Times,serif;
font-size:24px;
font-size-adjust:none;
font-stretch:normal;
font-style:italic;
font-variant:normal;
font-weight:normal;
line-height:35px;
margin:0;
padding:14px 15px 3px 0;
text-shadow:0 1px 0 #FFFFFF;  }
</style>
  <h2><?php _e( 'Bulk Upload' );?></h2>
  <p><?php _e( 'Have a ' . get_option( 'blogname' ) . ' site somewhere else that you wish to import here? Simply  download <a href="' . get_option( 'siteurl' ) . '/?page=csvdl">sample CSV file</a> and import your data accordingly.</p><p>It is advisable to create category and name it "Properties" and user this Category Id as your "Post Category" in CSV file.</p>' );?>
	<?php if ( $_REQUEST['msg'] == 'exist' ) {?>
  <div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
	<p><?php _e( 'Uploaded successully.' );?></p>
  </div>
	<?php }?>
  <table width="75%" cellpadding="3" cellspacing="3" class="widefat post fixed" >
	<tr>
	  <td width="14%"><?php _e( 'Select CSV file' );?></td>
	  <td width="86%">:
		<input type="file" name="bulk_upload_csv" id="bulk_upload_csv"></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	<td><input type="submit" name="submit" value="<?php _e( 'Submit' );?>" onClick="return check_frm();" class="button-secondary action" >    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>    
	</tr>
	<tr><td></td>
	  <td><?php _e( 'You can download' );?> <a href="<?php echo get_option( 'siteurl' )?>/?page=csvdl"><?php _e( 'sample CSV file' );?></a></td>

			  </tr>
  </table>
</form>
<script>
function check_frm()
{
	if(document.getElementById('bulk_upload_csv').value == '')
	{
		alert("<?php _e( 'Please select csv file to upload' );?>");
		return false;
	}
	return true;
}
</script>
