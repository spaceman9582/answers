<?php
set_time_limit( 0 );
global  $wpdb;
//require_once (TEMPLATEPATH . '/delete_data.php');

$dummy_image_path = get_template_directory_uri() . '/images/dummy/';
//====================================================================================//
$user_info = array();
$user_meta = array();
$user_data = array();
$user_meta = array(
				'user_twitter'		=> 'http://www.twitter.com/johan',
				'user_photo'		=> $dummy_image_path . '200x200.png',
				'description'		=> 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam',
				'tl_dummy_content'	=> '1',
				);
$user_data = array(
				'user_login'		=> 'johan@gmail.com',
				'user_email'		=> 'johan@gmail.com',
				'user_nicename'		=> 'johan-offer',
				'user_url'			=> 'http://www.johan.com/',
				'display_name'		=> 'Johan',
				'first_name'		=> 'johan',
				);
$user_info[] = array(
				'data'	=> $user_data,
				'meta'	=> $user_meta,
				);
//====================================================================================//
$user_meta = array();
$user_data = array();
$user_meta = array(
				'user_twitter'		=> 'http://www.twitter.com/arora',
				'user_photo'		=> $dummy_image_path . '200x200.png',
				'description'		=> 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam',
				'tl_dummy_content'	=> '1',
				);
$user_data = array(
				'user_login'		=> 'arora@gmail.com',
				'user_email'		=> 'arora@gmail.com',
				'user_nicename'		=> 'arora',
				'user_url'			=> 'http://www.arora.com/',
				'display_name'		=> 'Arora',
				'first_name'		=> 'Arora',
				);
$user_info[] = array(
				'data'	=> $user_data,
				'meta'	=> $user_meta,
				);
//=======================================================================================================//
$user_meta = array();
$user_data = array();
$user_meta = array(
				'user_twitter'		=> 'http://www.twitter.com/harry',
				'user_photo'		=> $dummy_image_path . '200x200.png',
				'description'		=> 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam',
				'tl_dummy_content'	=> '1',
				);
$user_data = array(
				'user_login'		=> 'Harry@gmail.com',
				'user_email'		=> 'Harry@gmail.com',
				'user_nicename'		=> 'harry',
				'user_url'			=> 'http://www.harry.com/',
				'display_name'		=> 'Harry',
				'first_name'		=> 'Harry',
				);
$user_info[] = array(
				'data'	=> $user_data,
				'meta'	=> $user_meta,
				);

//=======================================================================================================//
$user_meta = array();
$user_data = array();
$user_meta = array(
				'user_twitter'		=> 'http://www.twitter.com/joseph',
				'user_photo'		=> $dummy_image_path . '200x200.png',
				'description'		=> 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam',
				'tl_dummy_content'	=> '1',
				);
$user_data = array(
				'user_login'		=> 'joseph@gmail.com',
				'user_email'		=> 'joseph@gmail.com',
				'user_nicename'		=> 'joseph',
				'user_url'			=> 'http://www.joseph.com/',
				'display_name'		=> 'joseph',
				'first_name'		=> 'joseph',
				);
$user_info[] = array(
				'data'	=> $user_data,
				'meta'	=> $user_meta,
				);

//=======================================================================================================//
$user_meta = array();
$user_data = array();
$user_meta = array(
				'user_twitter'		=> 'http://www.twitter.com/rajesh',
				'user_photo'		=> $dummy_image_path . '200x200.png',
				'description'		=> 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam',
				'tl_dummy_content'	=> '1',
				);
$user_data = array(
				'user_login'		=> 'rajesh@gmail.com',
				'user_email'		=> 'rajesh@gmail.com',
				'user_nicename'		=> 'rajesh',
				'user_url'			=> 'http://www.rajesh.com/',
				'display_name'		=> 'rajesh',
				'first_name'		=> 'rajesh',
				);
$user_info[] = array(
				'data'	=> $user_data,
				'meta'	=> $user_meta,
				);

//=======================================================================================================//
$user_meta = array();
$user_data = array();
$user_meta = array(
				'user_twitter'		=> 'http://www.twitter.com/V',
				'user_photo'		=> $dummy_image_path . '200x200.png',
				'description'		=> 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam',
				'tl_dummy_content'	=> '1',
				);
$user_data = array(
				'user_login'		=> 'scott@gmail.com',
				'user_email'		=> 'scott@gmail.com',
				'user_nicename'		=> 'scott',
				'user_url'			=> 'http://www.scott.com/',
				'display_name'		=> 'scott',
				'first_name'		=> 'scott',
				);
$user_info[] = array(
				'data'	=> $user_data,
				'meta'	=> $user_meta,
				);


//=======================================================================================================//
require_once( ABSPATH . 'wp-includes/registration.php' );
$agents_ids_array = insert_users( $user_info );
function insert_users( $user_info ) {
	global $wpdb;
	$user_ids_array = array();
	for ( $u = 0;$u < count( $user_info );$u++ ) {
		if ( ! username_exists( $user_info[ $u ]['data']['user_login'] ) ) {
			$last_user_id = wp_insert_user( $user_info[ $u ]['data'] );
			$user_ids_array[] = $last_user_id;
			$user_meta = $user_info[ $u ]['meta'];
			$user_role['agent'] = 1;
			update_usermeta( $last_user_id, 'wp_capabilities', $user_role );
			foreach ( $user_meta as $key => $val ) {
				update_usermeta( $last_user_id, $key, $val ); // User mata Information Here
			}
		}
	}
	$user_ids = $wpdb->get_var( "SELECT group_concat(user_id) FROM $wpdb->usermeta where meta_key like \"wp_capabilities\" and meta_value like \"%agent%\"" );
	return explode( ',',$user_ids );
}
//====================================================================================//
/////////////// GENERAL SETTINGS START ///////////////
$mysite_general_settings = get_option( 'mysite_general_settings' );
if ( ! $mysite_general_settings || ($mysite_general_settings && count( $mysite_general_settings ) == 0) ) {
	$settingtinfo = array(
						'currency'				=> 'USD',
						'currencysym'			=> '$',
						'site_email'			=> get_option( 'admin_email' ),
						'site_email_name'		=> get_option( 'blogname' ),
						);
	update_option( 'mysite_general_settings',$settingtinfo );
}
/////////////// GENERAL SETTINGS END ///////////////

//====================================================================================//
/////////////// TERMS START ///////////////
require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );
$category_array = array( array( 'Blog', 'Sub Category 1', 'Sub Category 2' ),'Questions' );
insert_category( $category_array );
function insert_category( $category_array ) {
	for ( $i = 0;$i < count( $category_array );$i++ ) {
		$parent_catid = 0;
		if ( is_array( $category_array[ $i ] ) ) {
			$cat_name_arr = $category_array[ $i ];
			for ( $j = 0;$j < count( $cat_name_arr );$j++ ) {
				$catname = $cat_name_arr[ $j ];
				$last_catid = wp_create_category( $catname, $parent_catid );
				if ( $j == 0 ) {
					$parent_catid = $last_catid;
				}
			}
		} else {
			$catname = $category_array[ $i ];
			wp_create_category( $catname, $parent_catid );
		}
	}
}
/////////////// TERMS END ///////////////

//====================================================================================//
$post_info = array();
////post start///
$post_meta = array();
$post_meta = array(
					'tl_dummy_content'	=> '1',
				);
$post_info[] = array(
					'post_title'	=> 'Increase your home value',
					'post_content'	=> 'Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. ',
					'post_meta'		=> $post_meta,
					'post_image'	=> $image_array,
					'post_category'	=> array( 'Blog' ),
					'post_tags'		=> array( 'home value','Increase home value' ),
					);
////post end///
////post start///
$post_meta = array();
$post_meta = array(
					'tl_dummy_content'	=> '1',
				);
$post_info[] = array(
					'post_title'	=> 'We are putting our house on the market soon. One agent',
					'post_content'	=> 'Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. ',
					'post_meta'		=> $post_meta,
					'post_image'	=> $image_array,
					'post_category'	=> array( 'Blog' ),
					'post_tags'		=> array(),
					);
////post end///
////post start///
$post_meta = array();
$post_meta = array(
					'tl_dummy_content'	=> '1',
				);
$post_info[] = array(
					'post_title'	=> 'Adventures of Huckleberry Finn',
					'post_content'	=> 'Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. ',
					'post_meta'		=> $post_meta,
					'post_image'	=> $image_array,
					'post_category'	=> array( 'Blog' ),
					'post_tags'		=> array(),
					);
////post end///
////post start///
$post_meta = array();
$post_meta = array(
					'tl_dummy_content'	=> '1',
				);
$post_info[] = array(
					'post_title'	=> 'Real Estate Agents Get Paid Too Much',
					'post_content'	=> 'Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. ',
					'post_meta'		=> $post_meta,
					'post_image'	=> $image_array,
					'post_category'	=> array( 'Blog' ),
					'post_tags'		=> array(),
					);
////post end///
////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '3',
				);
$post_info[] = array(
					'post_title'	=> 'Where do i go to if i need to talk to ebay about a delivery',
					'post_content'	=> 'Help .. So I ordered a makeup kit from eBay and payed it, and iknow this because the $ was taken our of my bank account from eBay so that meant I paid it and all but I checked my messages in eBay and they said my delivery was cancelled because I didntpay it on time And that Im not getting it anymore so I tried sending messages to the seller of the makeup but she doesnot respond back what do I do Is there a # I can call .. Because I already paid for it and Im not going to let eBay take my money like that',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'ebay' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'just tell her and see what happens, but at some point your gonna have to anyways','scott@gmail.com' );
$post_comments [1] = array( 'ust make it sooner rather than later, and show her the ring to','rajesh@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '12',
				);
$post_info[] = array(
					'post_title'	=> 'How do i tell my mother im bi and dating a female',
					'post_content'	=> '1.I am a female dating a female 
2.I need to tell my mom 
3.I have fallen deep for dis girl 
4.could somone help me 
5.I need help and details on how tuh tell my mom',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'dating' ),
					);
////post end///

////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'I ate some food and it all seemed to go away and was just a regular high.','scott@gmail.com' );
$post_comments [1] = array( 't sounds to me like you were hungry too, a similar thing happened to me ','rajesh@gmail.com' );
$post_comments [2] = array( 'you know what it is or not the drugs may have caused a chemical imbalance in your brain that needs to be treated with anti depressants','johan@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '18',
				);
$post_info[] = array(
					'post_title'	=> 'Why is my friend depressed',
					'post_content'	=> 'he is depressed and not talking. and might be suicidal. he keeps talking to himself and talks no to one else.',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'depressed' ),
					);
////post end///


////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '15',
				);
$post_info[] = array(
					'post_title'	=> 'What are some wicked cool or good tattoo ideas',
					'post_content'	=> 'I need some ideas for a tattoo. Quotes, pictures..anything. Even if you have any good ideas on giving yourself one..let me know. Lol and I really like things that mean well, and I really like sunflowers. So if anyone has any brilliant ideas.please',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'tattoo' ),
					);
////post end///


////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '9',
				);
$post_info[] = array(
					'post_title'	=> 'What are some good christian scremo bands',
					'post_content'	=> 'Im looking for some good christian music, and im new to the scremo aspest of christianity but I do like the style of scremoim looking also for any other christian music and bands that are very unknown or are just overlooked.',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'bands' ),
					);
////post end///


////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'Is there going to be alcohol If so, do not drink anything already opened or something that someone else poured for you.','scott@gmail.com' );
$post_comments [1] = array( 'If you choose to drink only drink enough to get a buzz going, but donot get wasted.','rajesh@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '6',
				);
$post_info[] = array(
					'post_title'	=> 'What should i expect at my first major house party',
					'post_content'	=> 'A friend of mine is having a house party in a couple of weeks and im embarressingly nervous. Shes been to them but I havnt and I really need some advice.I am a girl so what should I wear and what should I expect Like theres gunna be guys and I really.',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'house' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'Seeing as its an American holiday','scott@gmail.com' );
$post_comments [1] = array( 'it has no meaning for me at all. I m Canadian.','arora@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '17',
				);
$post_info[] = array(
					'post_title'	=> 'What does memorial day mean to you',
					'post_content'	=> 'what does Memorial day mean to youUse relley good details.and try to be percice on your answer.',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'memorial day' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '21',
				);
$post_info[] = array(
					'post_title'	=> 'What are some good songs',
					'post_content'	=> 'what are some good new songs, it can be rock, punk rock, hip hop, rb but no country!! XD I hate country music bcause I hear it ALL the time.',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'good songs' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'hehe I love this game!okay frist off Words Adam Lamberg Huggy bear Silly Pickle','scott@gmail.com' );
$post_comments [1] = array( 'I love Julia Chulia Sam Pam Katchow Mucho Maturbation THings to draw','rajesh@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '8',
				);
$post_info[] = array(
					'post_title'	=> 'What should i put on these shorts',
					'post_content'	=> 'Okay so let meh start from the beginningk so my 8th grade party is comeing up and I am makeing my own shorts. Now when I say I am makeing my own shorts I mean I am takeing my old shorts and painting what ever I want on them with fabric paint',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( '' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '11',
				);
$post_info[] = array(
					'post_title'	=> 'How do i get rid of a pimple in 24 hours',
					'post_content'	=> 'Well I like this guy andI am afraid he wonot like me because of my acne. I havenot been there in awhile and want to impress him. Donot be like you donot need to impress him and BLAH BLAH BLAH I want how do I get rid of my acne.Thank you',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'pimple' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '24',
				);
$post_info[] = array(
					'post_title'	=> 'What do you guys think',
					'post_content'	=> 'Kay so. Im writing my persuasive essay on whether young girls (like 7 and younger) should or shouldnt compete in beauty pageants. Whats your opinion on the topic And if they do compete what are some pros and cons',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'guys think' ),
					);
////post end///


////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'a nose job is cosmetic surgery this means all of the money comes out of your own pocket the government/medicare doesnt pay for any of it','scott@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '14',
				);
$post_info[] = array(
					'post_title'	=> 'What age do you have to be to get a nose job',
					'post_content'	=> 'I am uncomfortable VERY uncomfortable with my nose and self-conscious what age can I get my nose fixed  or does anyone have any tips on how to make my nose look smaller or something or look smaller from the side  please help thanks',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'job' ),
					);
////post end///


////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '19',
				);
$post_info[] = array(
					'post_title'	=> 'Why cant i get a date',
					'post_content'	=> 'I try my best to ask girls out I flirt with them then I just ruin it I just start saying stupid stuff I need some advice that will help me out',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'date' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'ok well I tried looking for a number on ebay but didnt find anything but here is a link to the help contact center.','scott@gmail.com' );
$post_comments [1] = array( ' you should be able to just type in your problem on that page.','rajesh@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '25',
				);
$post_info[] = array(
					'post_title'	=> 'Where do i go to if i need to talk to ebay about a delivery',
					'post_content'	=> 'Help .. So I ordered a makeup kit from eBay and payed it, and iknow this because the $ was taken our of my bank account from eBay so that meant I paid it and all but I checked my messages in eBay and they said my delivery was cancelled because I didnt pay it on time And thatI am not getting it anymore so I tried sending messages to the seller of the makeup but she doesnot respond back what do I do Is there a I can call  Because I already paid for it and I m not going to let eBay take my money like that',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'ebay' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '7',
				);
$post_info[] = array(
					'post_title'	=> 'Where can i find a good free work out',
					'post_content'	=> 'Where can I find a good work out that will tone me up quick I dont have money for a gym and I dont have time to do weight lifting, so it looks like it will be mostly resistance training but anything for my abs, obliques, thighs and my arms would be',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( '' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'go to aeropostale, hollister, american eagle, abercombie where a lot of bright clothes.','scott@gmail.com' );
$post_comments [1] = array( 'getting a tan might help dont wear black ALL the time maybe once a week but only one black item; ','rajesh@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '16',
				);
$post_info[] = array(
					'post_title'	=> 'How do i go from looking like a emo to a girly girl',
					'post_content'	=> 'How do I change from looking like an emo to looking like a girly girl I have never done any big changes in my life and its time to do this change like right now.',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'girly girl' ),
					);
////post end///




////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'when you do get boobs they will probably catch up with the other girls really fast. so do not stress about your boobs. ','rajesh@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '19',
				);
$post_info[] = array(
					'post_title'	=> 'Why am i created like this, flat and skinny',
					'post_content'	=> 'I am 13 in 8th grade, I have no boobs, I am as skinny as a twig, and to make it worse I am the only one in my grade that has no boobs! What should I do The boys all tease me and I have a low self esteem. My mom says its good but she does not get it I need advice please And please please answer my other question to Thx',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'flat and skinny' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '22',
				);
$post_info[] = array(
					'post_title'	=> 'Why did my dog’s hair fall out when she had puppies ',
					'post_content'	=> 'About a month ago, my dog had three puppies but what I start to I found out she started to loss her a bunch of hair here and there and about a week later she last everything.',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'puppies' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'Well, in regard to the noise, most places have noise ordinances, so you can call the cops every time they are noisy.','scott@gmail.com' );
$post_comments [1] = array( 'Plus, most cities have ordinances about how long you can park a vehicle on the street.','rajesh@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '29',
				);
$post_info[] = array(
					'post_title'	=> 'How do deal with rude inconsiderate neighbors',
					'post_content'	=> 'Moved to a quiet neighborhood, but I got the neighbors from hell. they park in front of my house, then I look in their driveway and no cars parked there, nor in front of their own house, I have a big beautiful front window and all I see is their car.visitors car as any one who visits park in front of my house not theirs, uses his chain saw to cut up his firewood in his driveway and my bedroom is right next to their drive way, any time they let their dogs out they are barking, early morning hours, night etc, try to sleep in, their sons muffler is one of those annoying loud mufflers, wakes me up or the dogs wake me up the list goes on and on I am now sleeping on my couch because both bedrooms are next to their driveway, I donot know what to do I’ve never dealt with this type of annoyance before Help ',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'inconsiderate neighbors' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '26',
				);
$post_info[] = array(
					'post_title'	=> 'How long can you be away from home before reported as a runaway',
					'post_content'	=> 'My parents have been mad at me and expect me to just attend school, come straight home and do what they want me to do here. I want to be able to hang out with my friends for atleast a little while then come straight home. I dont want to get in trouble.from the cops again. I am 17 and I would like to know how long I can be away from home before reported as a run away',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( '' ),
					);
////post end///



////post start///
$image_array = array();
$post_meta = array();
$post_comments = array();
$post_comments [0] = array( 'it sounds to me like you were hungry too, a similar thing happened to me ','scott@gmail.com' );

$post_meta = array(
					'tl_dummy_content'	=> '1',
					'question_view_count'	=> '10',
				);
$post_info[] = array(
					'post_title'	=> 'Wordpress Themes Club',
					'post_content'	=> '<p>The Templatic <a href="http://templatic.com/premium-themes-club/">Wordpress Themes Club</a> membership is ideal for any WordPress developer and freelancer that needs access to a wide variety of Wordpress themes. This themes collection saves you hundreds of dollars and also gives you the fantastic deal of allowing you to install any of our themes on unlimited domains.</p><br />

<p>You can see below just a few of our WordPress themes that are included in the club membership.</p><br />

&nbsp;
<p><strong>GeoPlaces</strong> - <a href="http://templatic.com/app-themes/geo-places-city-directory-wordpress-theme">Business Directory Theme</a><br />
The popular business directory theme that lets you have your very own local business listings directory or an international companies pages directory. This elegant and responsive design theme gives you powerful admin features to run a free or paid local business directory or both. GeoPlaces even has its own integrated events section so you not only get a business directory but an events directory too.</p>


<p><strong>Automotive</strong> - <a href="http://templatic.com/cms-themes/automotive-responsive-vehicle-directory">Car Classifieds Theme</a><br />
A responsive auto classifieds theme that gives you the ability of allowing vehicles submission on free or paid listing packages which you decide on the price and duration. This sleek auto classifieds and car directory theme is also WooCommerce compatible so you can even use part of your site to run as a car spares online store. Details</p>


<p><strong>Daily Deal</strong> - <a href="http://templatic.com/app-themes/daily-deal-premium-wordpress-app-theme">Deals Theme</a><br />
A powerful Deals theme for WordPress which lets your visitors buy or sell deals on your deals website. Daily Deal is by far the easiest and cheapest way to create a deals site where you can earn money by creating different deals submission price packages but you can also allow free deal submissions. Details</p>


<p><strong>Events V2</strong> - <a href="http://templatic.com/app-themes/events">Events Directory Theme</a><br />
Launch a successful Events directory portal with this elegant responsive events theme. The theme has many powerful admin features including allowing event organizers to submit events on free or paid payment packages. This theme is simple to setup and you can get your events site up in no time.</p>


<p><strong>NightLife</strong> - <a href="http://templatic.com/cms-themes/nightlife-events-directory-wordpress-theme">Events Directory Theme</a><br />
A beautifully designed events management theme which is responsive and allows you to run an events website. Allow event organizers free or paid event listing submissions and offer online event registrations. Nightlife is feature-packed with all the features you can expect from an events directory theme.</p>


<p><strong>5 Star</strong> - <a href="http://templatic.com/app-themes/5-star-responsive-hotel-theme">Online Hotel Booking and Reservations Theme</a><br />
A well designed hotel booking theme which is ideal for showcasing and promoting a hotel online in style. This responsive design hotel reservation Wordpress theme will surely impress your guests and is also a theme that gives you a lot of powerful features including an advanced online booking system and a booking calendar.</p>


<p><strong>Job Board</strong> - <a href="http://templatic.com/app-themes/job-board">Job Classifieds Theme</a><br />
Start your job classifieds or job board site with this responsive premium jobs board theme. Allow employers to submit job listings for free, paid or both and also allow job seekers to apply for jobs or submit their resumes. Packed with great features you would expect from a premium jobs board theme. Details</p>


<p><strong>TechNews</strong> - <a href="http://templatic.com/magazine-themes/technews-advanced-blog-theme">Blogging and News Theme</a><br />
A news theme that is an ideal solution for your a news blog. An elegant theme which is ideal for news blogs, magazine or newspaper sites. This mobile friendly theme is both responsive and WooCommerce compatible. Impress your visitors with the stylish layout and available color schemes. Details</p>


<p><strong>Real Estate V2</strong> - <a href="http://templatic.com/app-themes/real-estate-wordpress-theme-templatic">Property Classifieds Listings Theme</a><br />
This powerful IDX/MLS compatible real estate classifieds theme is both unique and powerful in the features it provides. With this real estate listings theme for WordPress, you can allow estate agencies and home sellers an opportunity to submit properties to your site. This real estate theme comes with many features including powerful search filter.</p>


<p><strong>e-Commerece</strong> - <a href="http://templatic.com/ecommerce-themes/e-commerce">Online Store Theme</a><br />
A powerful and elegant WooCoomerce compatible e-commerce WordPress theme with many features advanced features. This online store theme offers various modes of product display such as a shopping Cart, digital Shop or catalog mode. This theme for e-commerce offers multiple payment gateways, coupon codes. Details</p>


<br />
<p>See the full collection of the <a href="http://templatic.com/premium-themes-club/">WordPress Themes Club Membership</a></p>',
					'post_meta'		=> $post_meta,
					'post_author'	=> $agents_ids_array[ array_rand( $agents_ids_array ) ],
					'post_image'	=> $image_array,
					'post_comments'	=> $post_comments,
					'post_category'	=> array(),
					'post_tags'		=> array( 'screamo' ),
					);
////post end///




insert_posts( $post_info );
function insert_posts( $post_info ) {
	global $wpdb,$current_user;
	for ( $i = 0;$i < count( $post_info );$i++ ) {
		$post_title = $post_info[ $i ]['post_title'];
		$post_count = $wpdb->get_var( "SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='post' and post_status in ('publish','draft')" );
		if ( ! $post_count ) {
			$post_info_arr = array();
			$catids_arr = array();
			$my_post = array();
			$post_info_arr = $post_info[ $i ];
			if ( $post_info_arr['post_category'] ) {
				for ( $c = 0;$c < count( $post_info_arr['post_category'] );$c++ ) {
					$catids_arr[] = get_cat_ID( $post_info_arr['post_category'][ $c ] );
				}
			} else {
				$catids_arr[] = 1;
			}
			$my_post['post_title'] = $post_info_arr['post_title'];
			$my_post['post_content'] = $post_info_arr['post_content'];
			if ( $post_info_arr['post_author'] ) {
				$my_post['post_author'] = $post_info_arr['post_author'];
			} else {
				$my_post['post_author'] = 1;
			}
			$my_post['post_status'] = 'publish';
			$my_post['post_category'] = $catids_arr;
			$my_post['tags_input'] = $post_info_arr['post_tags'];
			$last_postid = wp_insert_post( $my_post );
			$post_meta = $post_info_arr['post_meta'];
			if ( $post_meta ) {
				foreach ( $post_meta as $mkey => $mval ) {
					update_post_meta( $last_postid, $mkey, $mval );
				}
			}

			$post_image = $post_info_arr['post_image'];
			if ( $post_image ) {
				for ( $m = 0;$m < count( $post_image );$m++ ) {
					$menu_order = $m + 1;
					$image_name_arr = explode( '/',$post_image[ $m ] );
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
					update_post_meta( $last_postimage_id, '_wp_attached_file', $post_image[ $m ] );
					$post_attach_arr = array(
										'width'	=> 580,
										'height' =>	480,
										'hwstring_small' => "height='150' width='150'",
										'file'	=> $post_image[ $m ],
										//"sizes"=> $sizes_info_array,
										);
					wp_update_attachment_metadata( $last_postimage_id, $post_attach_arr );
				}
			}
			$post_comments1 = array();
			$post_comments1  = $post_info_arr['post_comments'];
			if ( $post_comments1 ) {
				for ( $comm = 0;$comm < count( $post_comments1 );$comm++ ) {
					$commentinfo = $post_comments1[ $comm ];
					$author = $commentinfo[1];
					$userinfo_str = $wpdb->get_results( "select ID,user_email,display_name from $wpdb->users where user_login=\"$author\"" );
					foreach ( $userinfo_str as $userinfo_strobj ) {
						$comment_author_email = $userinfo_strobj->user_email;
						$user_ID = $userinfo_strobj->ID;
						$display_name = $userinfo_strobj->display_name;
					}
					$comment_post_ID = $last_postid;
					$comment_author_url = '';
					$comment_content = $commentinfo[0];
					$comment_type = '';
					$comment_parent = 0;
					$comment_date = date( 'Y-m-d H:i:s' );
					//$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');
					//$comment_id = wp_new_comment( $commentdata );
					//          echo "insert into $wpdb->comments (comment_post_ID,comment_author,comment_author_email,comment_author_IP,comment_date,comment_date_gmt,comment_content ,comment_approved,user_id) values ($comment_post_ID,\"$display_name\",\"$comment_author_email\",'',\"$comment_date\",\"$comment_date\",\"$comment_content\",1,$user_ID)";
					$wpdb->query( "insert into $wpdb->comments (comment_post_ID,comment_author,comment_author_email,comment_author_IP,comment_date,comment_date_gmt,comment_content ,comment_approved,user_id) values ($comment_post_ID,\"$display_name\",\"$comment_author_email\",'',\"$comment_date\",\"$comment_date\",\"$comment_content\",1,\"$user_ID\")" );
					$commsount = $wpdb->get_var( "select count(comment_ID) from $wpdb->comments where comment_post_ID=\"$comment_post_ID\"" );
					$wpdb->query( "update $wpdb->posts set comment_count=\"$commsount\" where ID=\"$comment_post_ID\"" );
				}
			}
		}// End if().
	}// End for().
}
//====================================================================================//
/////////////////////////////////////////////////

$pages_array = array( array( 'About', 'Sub Page 1', 'Sub Page 2' ),'Sub Page in 1','Sub Page in 2','Site Map' );
$page_info_arr = array();
$page_info_arr['About'] = '
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.</p>
<p>Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.</p>
';
$page_info_arr['Sub Page 1'] = '
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.</p>
<p>Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.</p>
';
$page_info_arr['Sub Page 2'] = '
<pLorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero. </p>

<P>Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero. </p>

<p>Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero. </p>
';
$page_info_arr['Contact'] = '
<p> Contact Page Small description here Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. </p>
';

$page_info_arr['Sub Page in 1'] = '
<blockquote>The raft drew beyond the middle of the river; the boys pointed her head right, and then lay on their oars.</blockquote>

current drift them out of the range of the island. But they discovered the danger in time, and made shift to avert it. About two o&acute;clock in the morning the raft grounded on the bar two hundred yards above the head of the island, and they waded back and forth until they had landed their freight.
<p style="text-align: center;">Part of the little raft&acute;s belongings consisted of an old sail, and this they spread over a nook in the bushes for a tent to shelter their provisions; but they themselves would sleep in the open air in good weather, as became outlaws.
<ol>
	<li>They built a fire against the side of a great log twenty or thirty</li>
	<li>steps within the sombre depths of the forest, and then cooked some</li>
	<li>bacon in the frying-pan for supper, and used up half of the corn "pone"</li>
	<li>stock they had brought. It seemed glorious sport to be feasting in that</li>
	<li>wild, free way in the virgin forest of an unexplored and uninhabited</li>
	<li>island, far from the haunts of men, and they said they never would</li>
	<li>return to civilization. The climbing fire lit up their faces and threw</li>
	<li>its ruddy glare upon the pillared tree-trunks of their forest temple,</li>
	<li>and upon the varnished foliage and festooning vines.</li>
</ol>
When the last crisp slice of bacon was gone, and the last allowance of corn pone devoured, the boys stretched themselves out on the grass, filled with contentment. They could have found a cooler place, but they would not deny themselves such a romantic feature as the roasting camp-fire.
';
$page_info_arr['Sub Page in 2'] = '
<blockquote>The raft drew beyond the middle of the river; the boys pointed her head right, and then lay on their oars.</blockquote>

The river was not high, so there was not more <a href="http://skeevisarts.com">than a two or three mile current</a>. Hardly a word was
said<strong> during the next three-quarters of</strong> an hour. Now the raft was passing before the distant town. Two or three glimmering lights showed where it lay, peacefully sleeping, beyond the <em>vague vast sweep</em> of star-gemmed water, unconscious of the <span style="text-decoration: underline;">tremendous</span> event that was happening.
<ol>
	<li>They built a fire against the side of a great log twenty or thirty</li>
	<li>steps within the sombre depths of the forest, and then cooked some</li>
	<li>bacon in the frying-pan for supper, and used up half of the corn "pone"</li>
	<li>stock they had brought. It seemed glorious sport to be feasting in that</li>
	<li>wild, free way in the virgin forest of an unexplored and uninhabited</li>
	<li>island, far from the haunts of men, and they said they never would</li>
	<li>return to civilization. The climbing fire lit up their faces and threw</li>
	<li>its ruddy glare upon the pillared tree-trunks of their forest temple,</li>
	<li>and upon the varnished foliage and festooning vines.</li>
</ol>
When the last crisp slice of bacon was gone, and the last allowance of corn pone devoured, the boys stretched themselves out on the grass, filled with contentment. They could have found a cooler place, but they would not deny themselves such a romantic feature as the roasting camp-fire.
';


set_page_info_autorun( $pages_array,$page_info_arr );
function set_page_info_autorun( $pages_array, $page_info_arr_arg ) {
	global $post_author,$wpdb;
	$last_tt_id = 1;
	if ( count( $pages_array ) > 0 ) {
		$page_info_arr = array();
		for ( $p = 0;$p < count( $pages_array );$p++ ) {
			if ( is_array( $pages_array[ $p ] ) ) {
				for ( $i = 0;$i < count( $pages_array[ $p ] );$i++ ) {
					$page_info_arr1 = array();
					$page_info_arr1['post_title'] = $pages_array[ $p ][ $i ];
					$page_info_arr1['post_content'] = $page_info_arr_arg[ $pages_array[ $p ][ $i ] ];
					$page_info_arr1['post_parent'] = $pages_array[ $p ][0];
					$page_info_arr[] = $page_info_arr1;
				}
			} else {
				$page_info_arr1 = array();
				$page_info_arr1['post_title'] = $pages_array[ $p ];
				$page_info_arr1['post_content'] = $page_info_arr_arg[ $pages_array[ $p ] ];
				$page_info_arr1['post_parent'] = '';
				$page_info_arr[] = $page_info_arr1;
			}
		}

		if ( $page_info_arr ) {
			for ( $j = 0;$j < count( $page_info_arr );$j++ ) {
				$post_title = $page_info_arr[ $j ]['post_title'];
				$post_content = addslashes( $page_info_arr[ $j ]['post_content'] );
				$post_parent = $page_info_arr[ $j ]['post_parent'];
				if ( $post_parent != '' ) {
					$post_parent_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts where post_title like \"$post_parent\" and post_type='page'" );
				} else {
					$post_parent_id = 0;
				}
				$post_date = date( 'Y-m-d H:s:i' );
				$post_name = strtolower( str_replace( array( "'", '"', '?', '.', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '+', '+', ' ' ),array( '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-' ),$post_title ) );
				$post_name_count = $wpdb->get_var( "SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='page'" );
				if ( $post_name_count > 0 ) {
					echo '';
				} else {
					$post_sql = "insert into $wpdb->posts (post_author,post_date,post_date_gmt,post_title,post_content,post_name,post_parent,post_type) values (\"$post_author\", \"$post_date\", \"$post_date\",  \"$post_title\", \"$post_content\", \"$post_name\",\"$post_parent_id\",'page')";
					$wpdb->query( $post_sql );
					$last_post_id = $wpdb->get_var( "SELECT max(ID) FROM $wpdb->posts" );
					$guid = get_option( 'siteurl' ) . "/?p=$last_post_id";
					$guid_sql = "update $wpdb->posts set guid=\"$guid\" where ID=\"$last_post_id\"";
					$wpdb->query( $guid_sql );
					$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$last_tt_id\")";
					$wpdb->query( $ter_relation_sql );
					update_post_meta( $last_post_id, 'pt_dummy_content', 1 );
				}
			}
		}
	}// End if().
}
///////////////////////////////////////////////////////////////////////////////////
//====================================================================================//
/////////////// WIDGET SETTINGS START ///////////////
///////////////////////////////////////////////////////////////////////////////////
//====================================================================================//

$adv_info = array();
$adv_info[1] = array(
					't1'			=> '',
					't2'			=> '<a href="http://templatic.com" ><img src="' . $dummy_image_path . 'advt.png" alt="" /> </a>',
					);
$adv_info['_multiwidget'] = '1';
update_option( 'widget_widget_headeradvt',$adv_info );
$adv_info = get_option( 'widget_widget_headeradvt' );
krsort( $adv_info );
foreach ( $adv_info as $key1 => $val1 ) {
	$adv_info_key = $key1;
	if ( is_int( $adv_info_key ) ) {
		break;
	}
}
$sidebars_widgets['sidebar-1'] = array( "widget_headeradvt-$adv_info_key" );
//===============================================================================
$login_info = array();
$login_info[1] = array(
					'title'			=> 'Login',
					);
$login_info['_multiwidget'] = '1';
update_option( 'widget_widget_loginwidget',$login_info );
$login_info = get_option( 'widget_widget_loginwidget' );
krsort( $login_info );
foreach ( $login_info as $key1 => $val1 ) {
	$login_info_key = $key1;
	if ( is_int( $login_info_key ) ) {
		break;
	}
}
$popularposts_info = array();
$popularposts_info = array(
					'name'			=> 'Most Active Questions',
					'number'		=> 5,
					);
update_option( 'widget_popularposts',$popularposts_info );

$tags_info = array();
$tags_info[1] = array(
					'title'			=> 'Tag Clouds',
					'number'		=> 5,
					);
$tags_info['_multiwidget'] = '1';
update_option( 'widget_widget_tags',$tags_info );
$tags_info = get_option( 'widget_widget_tags' );
krsort( $tags_info );
foreach ( $tags_info as $key1 => $val1 ) {
	$tags_key = $key1;
	if ( is_int( $tags_key ) ) {
		break;
	}
}

$topuser_info = array();
$topuser_info[1] = array(
					'title'			=> 'Top Users',
					'post_number'	=> 5,
					);
$topuser_info['_multiwidget'] = '1';
update_option( 'widget_widget_topuserwidget',$topuser_info );
$topuser_info = get_option( 'widget_widget_topuserwidget' );
krsort( $topuser_info );
foreach ( $topuser_info as $key1 => $val1 ) {
	$topuser_key = $key1;
	if ( is_int( $topuser_key ) ) {
		break;
	}
}

$sidebars_widgets['sidebar-2'] = array( "widget_loginwidget-$login_info_key",'pt-popular-posts',"widget_tags-$tags_key","widget_topuserwidget-$topuser_key" );
//===============================================================================
$login_info = array();
$login_info = get_option( 'widget_widget_loginwidget' );
$login_info[] = array(
					'title'			=> 'Login',
					);
$login_info['_multiwidget'] = '1';
update_option( 'widget_widget_loginwidget',$login_info );
$login_info = get_option( 'widget_widget_loginwidget' );
krsort( $login_info );
foreach ( $login_info as $key1 => $val1 ) {
	$login_info_key = $key1;
	if ( is_int( $login_info_key ) ) {
		break;
	}
}

$post_info = array();
$post_info[1] = array(
					'title'			=> 'Latest Questions',
					'category'		=> '1',
					'post_number'	=> '5',
					);
$post_info['_multiwidget'] = '1';
update_option( 'widget_widget_posts',$post_info );
$post_info = get_option( 'widget_widget_posts' );
krsort( $post_info );
foreach ( $post_info as $key1 => $val1 ) {
	$post_info_key = $key1;
	if ( is_int( $post_info_key ) ) {
		break;
	}
}
$blockquote = array();
$blockquote[1] = array(
					'title'				=> 'Testimonials',
					'quote1'			=> 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,',
					'author1'			=> 'Roma',
					'quote2'			=> 'erat nulla fermentum diam Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam,',
					'author2'			=> 'Robbin',
					'quote3'			=> 'Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam. Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum ,',
					'author3'			=> 'John',
					'quote4'			=> 'Lorem ipsum dolor sit amet, consectetuer, erat nulla fermentum diam,',
					'author4'			=> 'Stiven',
					'quote5'			=> 'justo convallis luctus rutrum, erat nulla fermentum diam,',
					'author5'			=> 'Smith',
					'more'			=> '',
					);
$blockquote ['_multiwidget'] = '1';
update_option( 'widget_widget_blockquote',$blockquote );
$blockquote  = get_option( 'widget_widget_blockquote' );
krsort( $blockquote );
foreach ( $blockquote  as $key1 => $val1 ) {
	$blockquote_key = $key1;
	if ( is_int( $blockquote_key ) ) {
		break;
	}
}
$tags_info = array();
$tags_info = get_option( 'widget_widget_tags' );
$tags_info[] = array(
					'title'			=> 'Tag Clouds',
					);
$tags_info['_multiwidget'] = '1';
update_option( 'widget_widget_tags',$tags_info );
$tags_info = get_option( 'widget_widget_tags' );
krsort( $tags_info );
foreach ( $tags_info as $key1 => $val1 ) {
	$tags_key = $key1;
	if ( is_int( $tags_key ) ) {
		break;
	}
}$sidebars_widgets['sidebar-3'] = array( "widget_loginwidget-$post_info_key","widget_posts-$post_info_key","widget_blockquote-$blockquote_key","widget_tags-$tags_key" );
//===============================================================================
$login_info = array();
$login_info = get_option( 'widget_widget_loginwidget' );
$login_info[] = array(
					'title'			=> 'Login',
					);
$login_info['_multiwidget'] = '1';
update_option( 'widget_widget_loginwidget',$login_info );
$login_info = get_option( 'widget_widget_loginwidget' );
krsort( $login_info );
foreach ( $login_info as $key1 => $val1 ) {
	$login_info_key = $key1;
	if ( is_int( $login_info_key ) ) {
		break;
	}
}
$about_info = array();
$about_info[1] = array(
					'title'			=> 'Payment Info',
					'desc1'			=> '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. </p>',
					);
$about_info['_multiwidget'] = '1';
update_option( 'widget_widget_about',$about_info );
$about_info = get_option( 'widget_widget_about' );
krsort( $about_info );
foreach ( $about_info as $key1 => $val1 ) {
	$about_info_key = $key1;
	if ( is_int( $about_info_key ) ) {
		break;
	}
}
$about_info1 = array();
$about_info1 = get_option( 'widget_widget_about' );
$about_info1[] = array(
					'title'			=> 'Need More Help?',
					'desc1'			=> '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam.  </p>',
					);
$about_info1['_multiwidget'] = '1';
update_option( 'widget_widget_about',$about_info1 );
$about_info1 = get_option( 'widget_widget_about' );
krsort( $about_info1 );
foreach ( $about_info1 as $key1 => $val1 ) {
	$about_info1_key = $key1;
	if ( is_int( $about_info1_key ) ) {
		break;
	}
}
$sidebars_widgets['sidebar-4'] = array( "widget_loginwidget-$login_info_key","widget_about-$about_info_key","widget_about-$about_info" );
//=====================================================================================================
$post_info = array();
$post_info = get_option( 'widget_widget_posts' );
$post_info[] = array(
					'title'			=> 'Latest Questions',
					'category'		=> '1',
					'post_number'	=> '5',
					);
$post_info['_multiwidget'] = '1';
update_option( 'widget_widget_posts',$post_info );
$post_info = get_option( 'widget_widget_posts' );
krsort( $post_info );
foreach ( $post_info as $key1 => $val1 ) {
	$post_info_key = $key1;
	if ( is_int( $post_info_key ) ) {
		break;
	}
}
$topuser_info = array();
$topuser_info = get_option( 'widget_widget_topuserwidget' );
$topuser_info[] = array(
					'title'			=> 'Top Users',
					'post_number'	=> 5,
					);
$topuser_info['_multiwidget'] = '1';
update_option( 'widget_widget_topuserwidget',$topuser_info );
$topuser_info = get_option( 'widget_widget_topuserwidget' );
krsort( $topuser_info );
foreach ( $topuser_info as $key1 => $val1 ) {
	$topuser_key = $key1;
	if ( is_int( $topuser_key ) ) {
		break;
	}
}

$tags_info = array();
$tags_info = get_option( 'widget_widget_tags' );
$tags_info[] = array(
					'title'			=> 'Tag Clouds',
					);
$tags_info['_multiwidget'] = '1';
update_option( 'widget_widget_tags',$tags_info );
$tags_info = get_option( 'widget_widget_tags' );
krsort( $tags_info );
foreach ( $tags_info as $key1 => $val1 ) {
	$tags_key = $key1;
	if ( is_int( $tags_key ) ) {
		break;
	}
}
$sidebars_widgets['sidebar-5'] = array( "widget_posts-$post_info_key","widget_topuserwidget-$topuser_key","widget_tags-$tags_key" );
//=====================================================================================================
$post_info = array();
$post_info = get_option( 'widget_widget_posts' );
$post_info[] = array(
					'title'			=> 'Latest Questions',
					'category'		=> '1',
					'post_number'	=> '5',
					);
$post_info['_multiwidget'] = '1';
update_option( 'widget_widget_posts',$post_info );
$post_info = get_option( 'widget_widget_posts' );
krsort( $post_info );
foreach ( $post_info as $key1 => $val1 ) {
	$post_info_key = $key1;
	if ( is_int( $post_info_key ) ) {
		break;
	}
}
$cat_info = array();
$cat_info = get_option( 'widget_categories' );
$cat_info[1] = array(
					'title'			=> 'Categories',
					'count'			=> '0',
					'hierarchical'	=> '0',
					'dropdown'	=> '0',
					);
$cat_info['_multiwidget'] = '1';
update_option( 'widget_categories',$cat_info );
$cat_info = get_option( 'widget_categories' );
krsort( $cat_info );
foreach ( $cat_info as $key1 => $val1 ) {
	$cat_info_key = $key1;
	if ( is_int( $cat_info_key ) ) {
		break;
	}
}
$archive_info = array();
$archive_info = get_option( 'widget_archives' );
$archive_info[] = array(
					'title'			=> 'Archives ',
					'count'			=> '0',
					'dropdown'	=> '0',
					);
$archive_info['_multiwidget'] = '1';
update_option( 'widget_archives',$archive_info );
$archive_info = get_option( 'widget_archives' );
krsort( $archive_info );
foreach ( $archive_info as $key1 => $val1 ) {
	$archive_info_key = $key1;
	if ( is_int( $archive_info_key ) ) {
		break;
	}
}
$subscribe = array();
$subscribe[1] = array(
					'title'			=> 'Subscribe Now',
					'text'	=> 'Stay updated with all our latest news enter your e-mail address here',
					);
$subscribe['_multiwidget'] = '1';
update_option( 'widget_widget_subscribe',$subscribe );
$subscribe = get_option( 'widget_widget_subscribe' );
krsort( $subscribe );
foreach ( $subscribe as $key1 => $val1 ) {
	$subscribe_key = $key1;
	if ( is_int( $subscribe_key ) ) {
		break;
	}
}
$sidebars_widgets['sidebar-6'] = array( "categories-$cat_info_key","widget_posts-$post_info_key","archives-$archive_info_key","widget_subscribe-$subscribe_key" );
//===============================================================================
//////////////////////////////////////////////////////
update_option( 'sidebars_widgets',$sidebars_widgets );  //save widget iformations
/////////////// WIDGET SETTINGS END ///////////////

//====================================================================================//
/////////////// Design Settings START ///////////////
update_option( 'ptthemes_alt_stylesheet','1-default.css' );
update_option( 'ptthemes_sidebar_left','right' );
update_option( 'ptthemes_feedburner_url','http://feeds2.feedburner.com/templatic' );
$pages = $wpdb->get_var( "select group_concat(ID) from $wpdb->posts where post_type ='page' and post_title in ('About','Sub Page 1','Sub Page 2','Sub Page in 1','Sub Page in 2','Site Map')" );
update_option( 'ptthemes_top_strip_pages',$pages );
update_option( 'ptthemes_breadcrumbs','true' );
update_option( 'ptthemes_user_email_flag','false' );
update_option( 'ptthemes_blogcategory','Blog' );
update_option( 'ptthemes_questionscategory','Uncategorized' );
$pages = $wpdb->get_var( "select group_concat(ID) from $wpdb->posts where post_type ='page' and post_title in ('Sub Page in 1','Sub Page in 2')" );
$pages_arr = explode( ',',$pages );
for ( $i = 0;$i < count( $pages_arr );$i++ ) {
	update_option( 'pag_exclude_' . $pages_arr[ $i ],'true' );
}

update_option( 'ptthemes_logoin_page_content','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus.</p>' );
update_option( 'ptthemes_reg_page_content','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus.</p>' );
update_option( 'ptthemes_askque_page_content','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. ' );
update_option( 'ptthemes_askque_preview_page_content','<B>Your Question Preview</B>' );
/////////////// Design Settings END ///////////////


/* ======================== CODE TO ADD RESIZED IMAGES ======================= */
regenerate_all_attachment_sizes();

function regenerate_all_attachment_sizes() {
	$args = array(
		'post_type' => 'attachment',
		'numberposts' => 100,
		'post_status' => 'attachment',
	);
	$attachments = get_posts( $args );
	if ( $attachments ) {
		foreach ( $attachments as $post ) {
			$file = get_attached_file( $post->ID );
			wp_update_attachment_metadata( $post->ID, wp_generate_attachment_metadata( $post->ID, $file ) );
		}
	}
}


