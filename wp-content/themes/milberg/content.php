<?php
/**
 * @package Milberg
 */
?>

<aside>
	<div id="search_form">
	<form method="get" id="searchform" action="<?php bloginfo('home');?>">
	<div class="headersearchcontainleft">
	<input type="text" value="<?php echo wp_specialchars($s,1);?>" name="s" size="14" maxlength="50" width="100" />
	</div>
	<div class="headersearchcontainright">
	<input type="image" src="<?php bloginfo('template_directory'); ?>/search_button.gif" value="<?php echo wp_specialchars($s,1);?>" />
	</div>
	</form>
	</div>

	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle"><?php _e( 'Menu', 'milberg' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav><!-- #site-navigation -->

	<div class="latest">
		<h2><?php _e( 'Latest News', 'my-text-domain' ); ?></h2>
		<span class="metalink"><a href="http://milberg.princeton.edu/feedinfo/" title="RSS Feed information" class="feedlink"><img src="<?php bloginfo('template_directory'); ?>/feed_rss.gif" alt="RSS feed"></a></span>

		<?php // Get RSS Feed(s)
		include_once( ABSPATH . WPINC . '/feed.php' );

		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( 'http://milberg.princeton.edu/feed' );

		if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly

		    // Figure out how many total items there are, but limit it to 5. 
		    $maxitems = $rss->get_item_quantity( 3 ); 

		    // Build an array of all the items, starting with element 0 (first element).
		    $rss_items = $rss->get_items( 0, $maxitems );

		endif;
		?>

		<ul class="latest-news">
		    <?php if ( $maxitems == 0 ) : ?>
		        <li><?php _e( 'No items', 'my-text-domain' ); ?></li>
		    <?php else : ?>
		        <?php // Loop through each feed item and display each item as a hyperlink. ?>
		        <?php foreach ( $rss_items as $item ) : ?>
		            <li>
		                <a href="<?php echo esc_url( $item->get_permalink() ); ?>"
		                    title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>">
		                    <?php echo esc_html( $item->get_title() ); ?>
		                </a>
		            </li>
		        <?php endforeach; ?>
		    <?php endif; ?>
		</ul>
	</div>
</aside>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php milberg_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'milberg' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'milberg' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'milberg' ) );
				if ( $categories_list && milberg_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'milberg' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'milberg' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'milberg' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'milberg' ), __( '1 Comment', 'milberg' ), __( '% Comments', 'milberg' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'milberg' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->