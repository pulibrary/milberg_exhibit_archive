<?php
/**
 * The template for displaying search results pages.
 *
 * @package Milberg
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

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

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php milberg_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
