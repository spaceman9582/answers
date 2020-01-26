<?php
/*
Template Name: Sitemap Page
*/
?>
<?php get_header(); ?>

<div id="content">
 
		<h1 class="page_head"><?php the_title(); ?></h1>
		<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '','' ); } ?></p>
	 </div>
 

				
				 <h3>Pages :</h3>
			<ul >
				<?php wp_list_pages( 'title_li=' ); ?>
			</ul>

						 <h3>Categories :</h3>
		<ul>
			<?php wp_list_categories( 'title_li=&hierarchical=0&show_count=1' ) ?>
		</ul>

			
		
		 
		
		
				<h3>Monthly Archives :</h3>
		<ul>
			<?php wp_get_archives( 'type=monthly' ); ?>
		</ul>

		
				   <h3>Latest Post :</h3>
				<ul>
					<?php $archive_query = new WP_Query( 'showposts=60' );

					while ( $archive_query->have_posts() ) : $archive_query->the_post(); ?>
				  <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
					<?php the_title(); ?>
					</a>
					<?php comments_number( '0', '1', '%' ); ?>
					</li>
					<?php endwhile; ?>
				</ul>

					   <h3>RSS Feed :</h3>
		<ul>
		  <li><a href="<?php bloginfo( 'rdf_url' ); ?>" title="RDF/RSS 1.0 feed"><acronym title="Resource Description Framework">RDF</acronym>/<acronym title="Really Simple Syndication">RSS</acronym> 1.0 feed</a></li>
		  <li><a href="<?php bloginfo( 'rss_url' ); ?>" title="RSS 0.92 feed"><acronym title="Really Simple Syndication">RSS</acronym> 0.92 feed</a></li>
		  <li><a href="<?php bloginfo( 'rss2_url' ); ?>" title="RSS 2.0 feed"><acronym title="Really Simple Syndication">RSS</acronym> 2.0 feed</a></li>
		  <li><a href="<?php bloginfo( 'atom_url' ); ?>" title="Atom feed">Atom feed</a></li>
		</ul>

		
	   
	 
		
					</div> <!-- content #end -->
		<?php get_sidebar(); ?>  

			<?php get_footer(); ?>
