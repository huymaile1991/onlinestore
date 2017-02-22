<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Reviewer
 */

if ( ! function_exists( 'reviewer_comment' ) ) :
/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function reviewer_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'reviewer' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'reviewer' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div><!-- .comment-author -->

			<header class="comment-meta">
				<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'reviewer' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'reviewer' ); ?></p>
				<?php endif; ?>

				<div class="comment-tools">
					<?php edit_comment_link( esc_html__( 'Edit', 'reviewer' ), '<span class="edit-link">', '</span>' ); ?>

					<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">',
							'after'     => '</span>',
						) ) );
					?>
				</div><!-- .comment-tools -->
			</header><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for reviewer_comment()

if ( ! function_exists( 'reviewer_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * Create your own reviewer_excerpt_more() function to override in a child theme.
 *
 * @since Reviewer 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function reviewer_excerpt_more() {
	$link = sprintf( '<span class="read-more-span"><a href="%1$s" class="more-link">%2$s <span class="genericon genericon-next"></span></a></span>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'reviewer' ), esc_html( get_the_title( get_the_ID() ) ) )
	);
	return '&hellip; ' . $link;
}
add_filter( 'excerpt_more', 'reviewer_excerpt_more' );
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function reviewer_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'reviewer_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'reviewer_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so reviewer_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so reviewer_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in reviewer_categorized_blog.
 */
function reviewer_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'reviewer_categories' );
}
add_action( 'edit_category', 'reviewer_category_transient_flusher' );
add_action( 'save_post',     'reviewer_category_transient_flusher' );

if ( ! function_exists( 'reviewer_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Reviewer 1.0.9
 */
function reviewer_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}
endif;

/**
 * Registers the custom meta fields using the Meta Box plugin.
 *
 * Does nothing if the plugin is not activated.
 *
 * @since Reviewer 1.1.0
 */

add_filter( 'rwmb_meta_boxes', 'reviewer_register_meta_boxes' );

function reviewer_register_meta_boxes( $meta_boxes ) {
    $prefix = 'product-';

    // 1st meta box
    $meta_boxes[] = array(
        'id'         => 'personal',
        'title'      => esc_html__( 'Custom Meta Fields', 'reviewer' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => esc_html__( 'Product Profile', 'reviewer' ),
                'id'    => $prefix . 'profile',
                'type'  => 'textarea',
                'std'   => '',
                'class' => 'custom-class',
                'clone' => true,
            ),

            array(
                'name'  => esc_html__( 'Product Rating', 'reviewer' ),
                'desc'  => esc_html__( 'Ex: 87 points', 'reviewer' ),
                'id'    => $prefix . 'rating',
                'type'  => 'text',
                'std'   => '',
                'class' => 'custom-class',
                'clone' => true,
            ),

            array(
                'name'  => esc_html__( 'Product Price', 'reviewer' ),
                'desc'  => esc_html__( 'Ex: $19.95', 'reviewer' ),
                'id'    => $prefix . 'price',
                'type'  => 'text',
                'std'   => '',
                'class' => 'custom-class',
                'clone' => true,
            ),
        )
    );

    return $meta_boxes;
}