<?php
/**
 * Customs RSS template for Weekly Digest
 *
 *
 * @package roots
 * @subpackage asgard
 */


/**
 * Feed defaults.
 */
header( 'Content-Type: ' . feed_content_type( 'rss-http' ) . '; charset=' . get_option( 'blog_charset' ), true );
$frequency  = 1;        // Default '1'. The frequency of RSS updates within the update period.
$duration   = 'weekly'; // Default 'hourly'. Accepts 'hourly', 'daily', 'weekly', 'monthly', 'yearly'.
$postlink   = '<br /><a href="' . get_permalink() . '">See the rest of the story at valhallamovement.com</a><br /><br />';
$postimages = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );

// Check for images
if ( $postimages ) {
	// Get featured image
	$postimage = $postimages[0];
} else {
	// Fallback to a default
	$postimage = get_stylesheet_directory_uri() . '/assets/img/valhalla-tree-explosion.jpg';
}


/**
 * Start RSS feed.
 */
echo '<?xml version="1.0" encoding="' . get_option( 'blog_charset' ) . '"?' . '>'; ?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	xmlns:media="http://search.yahoo.com/mrss/"
	<?php do_action( 'rss2_ns' ); ?>
>

  <!-- RSS feed defaults -->
	<channel>
		<title><?php bloginfo_rss( 'name' ); wp_title_rss(); ?></title>
		<link><?php bloginfo_rss( 'url' ) ?></link>
		<description><?php bloginfo_rss( 'description' ) ?></description>
		<lastBuildDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ); ?></lastBuildDate>
		<language><?php bloginfo_rss( 'language' ); ?></language>
		<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', $duration ); ?></sy:updatePeriod>
		<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', $frequency ); ?></sy:updateFrequency>
		<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />

		<!-- Feed Logo (optional) -->
		<image>
			<url><?php echo $postimage ?></url>
			<title><?php bloginfo_rss( 'name' ) ?></title>
			<link><?php bloginfo_rss( 'url' ) ?></link>
		</image>

		<?php do_action( 'rss2_head' ); ?>

		<!-- Start loop -->
		<?php
    $date_query = array(
      'after' => '-1 week'
    );
    $args = array(
			'post_type'			 => array('post','image','video','link'),
      'post_status'    => 'publish',
      'posts_per_page' => 5,
      'order'          => 'DESC',
      'meta_key'       => 'hethens_vote_count',
      'orderby'        => 'meta_value_num date',
      'date_query'     => $date_query
    );
    $media_query = new WP_Query( $args );
    while( $media_query->have_posts()) : $media_query->the_post();
    ?>

			<item>
				<title><?php the_title_rss(); ?></title>
				<link><?php the_permalink_rss(); ?></link>
				<description><?php the_excerpt_rss(); ?></description>
				<guid isPermaLink="false"><?php the_guid(); ?></guid>
				<author><?php echo get_the_author_meta('user_email', $post->post_author) . ' (' . get_the_author_meta('first_name', $post->post_author) . ' ' . get_the_author_meta('last_name', $post->post_author) . ')'; ?></author>
				<media:thumbnail url='<?php echo esc_url( $postimage ); ?>' height='200' width='200' />
				<pubDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true ), false ); ?></pubDate>
				<content:encoded>
					<![CDATA[<?php echo the_excerpt_rss(); echo $postlink; ?>]]>
				</content:encoded>
			</item>

		<?php endwhile; ?>
	</channel>
</rss>
