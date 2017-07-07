<?php
/**
 * The template used for displaying page content in page.php
 *
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
	<?php if (!is_page('Homepage')) { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'milberg' ),
				'after'  => '</div>',
			) );
		?>

		<?php if (is_page('press')) { ?>
			<?php $posts = get_posts('category_name=pr&orderby=rand&numberposts=5'); foreach($posts as $post) { ?>
			<span class="date"><?php the_date(); ?></span>
			<a href="<?php the_permalink() ?>" target="_parent"><?php the_title(); ?></a>
			<?php } ?>
		<?php } ?>


	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'milberg' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
