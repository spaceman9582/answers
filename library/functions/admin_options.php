<?php

$options[] = array(	"type" => "maintabletop");

    /// General Settings
	
	    $options[] = array(	"name" => "General Settings",
						"type" => "heading");
						
		    $options[] = array(	"name" => "Theme Colorscheme",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"desc" => "Please select the CSS colorscheme for your site here.",
					                "id" => $shortname."_alt_stylesheet",
					                "std" => "Select a CSS skin:",
					                "type" => "select",
					                "options" => $alt_stylesheets);
						
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Customize Your Design",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "Use Custom Stylesheet",
						            "desc" => "If you want to make custom design changes using CSS enable and <a href='". $customcssurl . "'>edit custom.css file here</a>.",
						            "id" => $shortname."_customcss",
						            "std" => "false",
						            "type" => "checkbox");	
						
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Favicon",
						        "toggle" => "true",
								"type" => "subheadingtop");

				$options[] = array(	"desc" => "Paste the full URL for your favicon image here if you wish to show it in browsers. <a href='//www.favicon.cc/'>Create one here</a>",
						            "id" => $shortname."_favicon",
						            "std" => "",
						            "type" => "text");	
			
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Header Logo Settings",
						        "toggle" => "true",
								"type" => "subheadingtop");

                $options[] = array(	"desc" => "Paste the full URL to your logo image here. ( logo size width:300px max )",
						            "id" => $shortname."_logo_url",
						            "std" => "",
						            "type" => "file");

				$options[] = array(	"name" => "Choose Site Title over Logo",
				                    "desc" => "This option will overwrite your logo selection above - You can <a href='". $generaloptionsurl . "'>change your settings here</a>",
						            "label" => "Show Site Title + Tagline.",
						            "id" => $shortname."_show_blog_title",
						            "std" => "true",
						            "type" => "checkbox");	

			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Syndication / Feed",
						        "toggle" => "true",
								"type" => "subheadingtop");			
						
			$options[] = array( "desc" => "If you are using a service like Feedburner to manage your RSS feed, enter full URL to your feed into box above. If you'd prefer to use the default WordPress feed, simply leave this box blank.",
			    		            "id" => $shortname."_feedburner_url",
			    		            "std" => "",
			    		            "type" => "text");	
						
			$options[] = array(	"type" => "subheadingbottom");
											 					
		$options[] = array(	"type" => "maintablebreak");
		
		
    /// Navigation Settings												
				
		$options[] = array(	"name" => "Navigation Settings",
						    "type" => "heading");
		
			$options[] = array(	"name" => "Top Strip Navigation",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "Show Header Top Strip navigation bar",
                	                "desc" => "Enter a comma-separated list of the <code>page ID's</code> that you'd like to display in footer (on the right). (ie. <code>1,2,3,4</code>)",
						            "id" => $shortname."_top_strip_pages",
						            "std" => "",
						            "type" => "text");	
						
			$options[] = array(	"type" => "subheadingbottom");
										
				$options[] = array(	"name" => "Exclude Pages from Header Menu",
								"toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"type" => "multihead");
						
				$options = pages_exclude($options);
									
			$options[] = array(	"type" => "subheadingbottom");
			
			
			
			$options[] = array(	"name" => "Hide \"Users Listing\" Link",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "Hide \"Users\" link in header menu?",
						            "desc" => "",
						            "id" => $shortname."_users_link_flag",
						            "std" => "true",
						            "type" => "checkbox");
					
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Hide \"Blog Listing\" Link",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "Hide \"Blog\" link in header menu?",
						            "desc" => "",
						            "id" => $shortname."_blog_link_flag",
						            "std" => "true",
						            "type" => "checkbox");
					
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Breadcrumbs Navigation",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "Show breadcrumbs navigation bar",
						            "desc" => "i.e. Home > Blog > Title - <a href='". $breadcrumbsurl . "'>Change options here</a>",
						            "id" => $shortname."_breadcrumbs",
						            "std" => "true",
						            "type" => "checkbox");	
						
			$options[] = array(	"type" => "subheadingbottom");
			
$options[] = array(	"name" => "Footer Navigation",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "Show breadcrumbs navigation bar",
                	                "desc" => "Enter a comma-separated list of the <code>page ID's</code> that you'd like to display in footer (on the right). (ie. <code>1,2,3,4</code>)",
						            "id" => $shortname."_footerpages",
						            "std" => "",
						            "type" => "text");	
						
			$options[] = array(	"type" => "subheadingbottom");
			
			
		$options[] = array(	"type" => "maintablebreak");
		
		
		
	   
		
	/// Blog Section Settings												
				
		$options[] = array(	"name" => "Blog Section Settings",
						    "type" => "heading");
			
		    $options[] = array(	"name" => "Pick Category for Your Blog Posts",
						        "toggle" => "true",
								"type" => "subheadingtop");
				
				$options[] = array(	"name" => "Select a category for your blog posts",
			    		            "desc" => "Pick a category where your blog posts will be. It is advisable to create category and name it 'blog'. After that put all other blog categories as child categories of 'blog' so you don't need to change categories in posts.",
									"id" => $shortname."_blogcategory",
			    		            "type" => "select",
			    		            "options" => $pn_categories);
						
		    $options[] = array(	"type" => "subheadingbottom");
			
		$options[] = array(	"name" => "Content Display",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "Display Full Post Content",
						            "desc" => "Instead of default Post excerpts display Full Post Content in Blog Section",
						            "id" => $shortname."_postcontent_full",
						            "std" => "false",
						            "type" => "checkbox");	
						
			$options[] = array(	"type" => "subheadingbottom");
		
					
		 $options[] = array(	"type" => "maintablebreak");
			
	/// Question Section Settings												
				
		$options[] = array(	"name" => "Questions Settings ",
						    "type" => "heading");
			
		   $options[] = array(	"name" => "Questions Default Category",
						        "toggle" => "true",
								"type" => "subheadingtop");
				
				$options[] = array(	"name" => "Select default category for Questions",
			    		            "desc" => "Pick a category under which you will add different Questions will be inserted while category selection option is off. It is advisable to create category and name it 'Questions'",
									"id" => $shortname."_questionscategory",
			    		            "type" => "select",
			    		            "options" => $parent_cat_arr);
			
			$options[] = array(	"label" => "Enable <b>Questions Categories</b> selection",
						            "desc" => "Do you wish to enable <b>Questions Categories</b> selection while <b>Submit a Question</b>",
						            "id" => $shortname."_question_cat_selection_flag",
						            "std" => "true",
						            "type" => "checkbox");
		    $options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Select Categories As Questions Categories",
								"toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"type" => "multihead");
						
				$options = category_exclude($options);
					
			
			
			
			$options[] = array(	"type" => "subheadingbottom");
		
		$options[] = array(	"type" => "maintablebottom");
				
$options[] = array(	"type" => "maintabletop");


			
 	/// Blog Section Settings												
				
		$options[] = array(	"name" => "Other Settings",
						    "type" => "heading");
			
		  
			$options[] = array(	"name" => "Hide User Email",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "Wish to hide user Email from the site?",
                	                "desc" => "",
						            "id" => $shortname."_user_email_flag",
						            "std" => "",
						            "type" => "checkbox");	
						
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Captcha Settings",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "Wish to disable captcha from the site?",
                	                "desc" => "",
						            "id" => $shortname."_captcha_reg_flag",
						            "std" => "",
						            "type" => "checkbox");	
						
			$options[] = array(	"type" => "subheadingbottom");
			$options[] = array(	"name" => "reCaptcha Settings",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
					$options[] = array(	"label" => "Site Key",
                	                "desc" => "Site Key",
						            "id" => $shortname."_recaptcha_site_key",
						            "type" => "text");
									
				$options[] = array(	"label" => "Secret",
                	                "desc" => "Secret",
						            "id" => $shortname."_recaptcha_secret",
						            "type" => "text");	
					
				$options[] = array(	"label" => "Wish to disable captcha from the site?",
                	                "desc" => "You can selectively enable CAPTCHA security for user registration page and/or add new property page and add the key from <a href='https://www.google.com/recaptcha/admin#list'>here</a>.",
						            "id" => $shortname."_recaptcha_reg_flag",
									"options" => array('User Registration Page','Ask a Question page','Contact Us','All of them','None of them'),
						            "std" => "",
						            "type" => "select");
										
				
									
			$options[] = array(	"type" => "subheadingbottom");

		 $options[] = array(	"type" => "maintablebreak");	

	/// Blog Section Settings												
				
		$options[] = array(	"name" => "CMS page Top content",
						    "type" => "heading");
			
		  
			$options[] = array(	"name" => "Login page top content",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "",
                	                "desc" => "",
						            "id" => $shortname."_logoin_page_content",
						            "std" => "",
						            "type" => "textarea");	
						
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Registration page top content",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "",
                	                "desc" => "",
						            "id" => $shortname."_reg_page_content",
						            "std" => "",
						            "type" => "textarea");	
						
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Ask a Question page top content",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "",
                	                "desc" => "",
						            "id" => $shortname."_askque_page_content",
						            "std" => "",
						            "type" => "textarea");	
						
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Ask a Question Preview page top content",
						        "toggle" => "true",
								"type" => "subheadingtop");
						
				$options[] = array(	"label" => "",
                	                "desc" => "",
						            "id" => $shortname."_askque_preview_page_content",
						            "std" => "",
						            "type" => "textarea");	
						
			$options[] = array(	"type" => "subheadingbottom");
			
			
		 $options[] = array(	"type" => "maintablebreak");
		
	/// Blog Stats and Scripts											
				
		$options[] = array(	"name" => "Stats and Scripts",
						    "type" => "heading");
										
			$options[] = array(	"name" => "Header Scripts",
						        "toggle" => "true",
								"type" => "subheadingtop");	
						
				$options[] = array(	"name" => "Header Scripts",
					                "desc" => "If you need to add scripts to your header (like <a href='//haveamint.com/'>Mint</a> tracking code), do so here.",
					                "id" => $shortname."_scripts_header",
					                "std" => "",
					                "type" => "textarea");
			
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Footer Scripts",
						        "toggle" => "true",
								"type" => "subheadingtop");	
						
				$options[] = array(	"name" => "Footer Scripts",
					                "desc" => "If you need to add scripts to your footer (like <a href='//www.google.com/analytics/'>Google Analytics</a> tracking code), do so here.",
					                "id" => $shortname."_google_analytics",
					                "std" => "",
					                "type" => "textarea");
			
			$options[] = array(	"type" => "subheadingbottom");
						
		$options[] = array(	"type" => "maintablebreak");
		

		
	/// SEO Options
				
		$options[] = array(	"name" => "SEO Options",
						    "type" => "heading");
						
			$options[] = array(	"name" => "Home Page <code>&lt;meta&gt;</code> tags",
						        "toggle" => "true",
								"type" => "subheadingtop");

				$options[] = array(	"name" => "Meta Description",
					                "desc" => "You should use meta descriptions to provide search engines with additional information about topics that appear on your site. This only applies to your home page.",
					                "id" => $shortname."_meta_description",
					                "std" => "",
					                "type" => "textarea");

				$options[] = array(	"name" => "Meta Keywords (comma separated)",
					                "desc" => "Meta keywords are rarely used nowadays but you can still provide search engines with additional information about topics that appear on your site. This only applies to your home page.",
						            "id" => $shortname."_meta_keywords",
						            "std" => "",
						            "type" => "text");
									
				$options[] = array(	"name" => "Meta Author",
					                "desc" => "You should write your <em>full name</em> here but only do so if this blog is writen only by one outhor. This only applies to your home page.",
						            "id" => $shortname."_meta_author",
						            "std" => "",
						            "type" => "text");
						
			$options[] = array(	"type" => "subheadingbottom");
			
			$options[] = array(	"name" => "Add <code>&lt;noindex&gt;</code> tags",
						        "toggle" => "true",
								"type" => "subheadingtop");

				$options[] = array(	"label" => "Add <code>&lt;noindex&gt;</code> to category archives.",
						            "id" => $shortname."_noindex_category",
						            "std" => "true",
						            "type" => "checkbox");
									
				$options[] = array(	"label" => "Add <code>&lt;noindex&gt;</code> to tag archives.",
						            "id" => $shortname."_noindex_tag",
						            "std" => "true",
						            "type" => "checkbox");
				
				$options[] = array(	"label" => "Add <code>&lt;noindex&gt;</code> to author archives.",
						            "id" => $shortname."_noindex_author",
						            "std" => "true",
						            "type" => "checkbox");
									
			    $options[] = array(	"label" => "Add <code>&lt;noindex&gt;</code> to Search Results.",
						            "id" => $shortname."_noindex_search",
						            "std" => "true",
						            "type" => "checkbox");
				
				$options[] = array(	"label" => "Add <code>&lt;noindex&gt;</code> to daily archives.",
						            "id" => $shortname."_noindex_daily",
						            "std" => "true",
						            "type" => "checkbox");
				
				$options[] = array(	"label" => "Add <code>&lt;noindex&gt;</code> to monthly archives.",
						            "id" => $shortname."_noindex_monthly",
						            "std" => "true",
						            "type" => "checkbox");
				
				$options[] = array(	"label" => "Add <code>&lt;noindex&gt;</code> to yearly archives.",
						            "id" => $shortname."_noindex_yearly",
						            "std" => "true",
						            "type" => "checkbox");
				
						
			$options[] = array(	"type" => "subheadingbottom");
			
			
		$options[] = array(	"type" => "maintablebreak");
		
	 
$options[] = array(	"type" => "maintablebottom");

?>