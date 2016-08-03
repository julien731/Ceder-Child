<?php
/**
 * Ceder: Content
 */
?>

<?php if ( is_single() ) : ceder_full_page_background(); endif; ?>

<?php if ( !is_single() ): ?>
	<?php $post_page_picker = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('post_page_picker') : ''; ?><?php if ( $post_page_picker === 'grid' ) : ?><div class="<?php if ( function_exists('fw_ext_sidebars_get_current_position') ) : ?><?php $current_position = fw_ext_sidebars_get_current_position();?><?php if ($current_position === 'full') : echo 'col-md-4'; else : echo 'col-md-6'; endif; endif; ?>"><?php endif; ?>
<?php endif; ?>

<?php fw_theme_post_thumbnail(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php // Single post: Category
		$blog_single_category = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_single_category') : '';
		if ( is_single() ) :
			if ($blog_single_category === true) :
				if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && fw_theme_categorized_blog() ) : ?>
					<div class="entry-meta">
						<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'ceder' ) ); ?></span>
					</div>
				<?php endif;
			endif;

		// Archive post: Category
		else:
			$blog_archive_category = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_archive_category') : '';
			if ($blog_archive_category === true) :
				if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && fw_theme_categorized_blog() ) : ?>
					<div class="entry-meta">
						<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'ceder' ) ); ?></span>
					</div>
				<?php endif;
			endif;
		endif; ?>

		<?php // Post title
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<div class="entry-meta">
			<?php // Single post: Date
			if ( 'post' == get_post_type() )
				if ( is_single() ) :
					$blog_single_date = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_single_date') : '';
					if ($blog_single_date === true) :
						fw_theme_posted_on();
					endif;

				// Archive post: Date
				else:
					$blog_archive_date = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_archive_date') : '';
					if ($blog_archive_date === true) :
						fw_theme_posted_on();
					endif;
				endif;
			?>

			<?php 	// Single post: Author
			if ( is_single() ) :
				$blog_single_author_name = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_single_author_name') : '';
				if ($blog_single_author_name === true) :
					fw_theme_posted_by();
				endif;

			// Archive post: Author
			else:
				$blog_archive_author_name = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_archive_author_name') : '';
				if ($blog_archive_author_name === true) :
					fw_theme_posted_by();
				endif;
				?>

				<?php 	// Single post: Comments
				if ( !is_single() ) :
					$blog_archive_comment_amount = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_archive_comment_amount') : '';
					if ($blog_archive_comment_amount === true) : ?>
						<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
							<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'ceder' ), __( '1 Comment', 'ceder' ), __( '% Comments', 'ceder' ) ); ?></span>
						<?php endif; ?>
					<?php endif;
				endif;
			endif;
			edit_post_link( __( 'Edit', 'ceder' ), '<span class="edit-link">', '</span>' );
			?>
		</div>
	</header>

<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
<?php else : ?>
	<div class="entry-content">
		<?php $post_page_picker = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('post_page_picker') : ''; ?>
		<?php
		if ( $post_page_picker === 'grid' ) :
			echo ceder_excerpt($excerpt_characters = 25); ?>
			<a href="<?php echo get_permalink(); ?>" class="fw-btn-main"><?php _e( 'Read more', 'ceder' )?></a>
		<?php else:
			the_excerpt();
			printf( '<a href="%1$s" class="more-link">%2$s</a>', get_permalink( $post->ID ), esc_attr__( 'Read more' ) );
		endif;
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ceder' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
		?>
	</div>
<?php endif; ?>

<?php // Tags and social share
$tags = get_the_tags();
if (!empty($tags)) { ?>
	<?php $blog_single_social_share = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_single_social_share') : '';
	$blog_single_tags = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_single_tags') : '';
	if ( is_single() ) { ?>
		<?php if ( $blog_single_tags or $blog_single_social_share === true ) :
			echo '<div class="single-post-meta-bottom clearfix">';
		endif; ?>

		<?php if ( $blog_single_tags && $blog_single_social_share === true ) :
			echo '<div class="col-md-9">';
		endif; ?>

		<?php if ( $blog_single_tags && $blog_single_social_share === true ) : ?>
			<?php the_tags('<footer class="entry-meta tal"><span class="tag-links">', '', '</span></footer>'); ?>
		<?php endif; ?>

		<?php if ( $blog_single_tags === true && $blog_single_social_share === false ) : ?>
			<?php the_tags('<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>'); ?>
		<?php endif; ?>

		<?php if ( $blog_single_tags && $blog_single_social_share === true ) :
			echo '</div>';
		endif; ?>

		<?php if ( $blog_single_tags && $blog_single_social_share === true ) :
			echo '<div class="col-md-3 mml-40">';
		endif;  ?>

		<?php if ( $blog_single_tags === true && $blog_single_social_share === true ) : ?>
			<?php echo ceder_social_share(); ?>
		<?php endif;  ?>

		<?php if ( $blog_single_tags && $blog_single_social_share === true ) :
			echo '</div>';
		endif; 	?>

		<?php if ( $blog_single_tags === false && $blog_single_social_share === true ) : ?>
			<?php
			echo '<div class="col-md-12 aligncenter textaligncenter">';
			echo ceder_social_share();
			echo '</div>'; ?>
		<?php endif;  ?>

		<?php if ( $blog_single_tags or $blog_single_social_share === true ) :
			echo '</div><!-- .single-post-meta-bottom -->';
		endif; ?>

	<?php }

	else {
		$blog_archive_social_share = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_archive_social_share') : '';
		$blog_archive_tags = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_archive_tags') : '';
		?>
		<?php if ( $blog_archive_tags or $blog_archive_social_share === true ) :
			echo '<div class="list-post-meta-bottom clearfix">';
		endif; ?>

		<?php if ( $blog_archive_tags && $blog_archive_social_share === true ) :
			echo '<div class="col-md-9">';
		endif; ?>

		<?php if ( $blog_archive_tags && $blog_archive_social_share === true ) : ?>
			<?php the_tags('<footer class="entry-meta tal"><span class="tag-links">', ', ', '</span></footer>'); ?>
		<?php endif; ?>

		<?php if ( $blog_archive_tags === true && $blog_archive_social_share === false ) : ?>
			<?php the_tags('<footer class="entry-meta tal"><span class="tag-links">', ', ', '</span></footer>'); ?>
		<?php endif; ?>

		<?php if ( $blog_archive_tags && $blog_archive_social_share === true ) :
			echo '</div>';
		endif; ?>

		<?php if ( $blog_archive_tags && $blog_archive_social_share === true ) :
			echo '<div class="col-md-3 mml-40">';
		endif;  ?>

		<?php if ( $blog_archive_tags === true && $blog_archive_social_share === true ) : ?>
			<?php echo ceder_social_share(); ?>
		<?php endif;  ?>

		<?php if ( $blog_archive_tags && $blog_archive_social_share === true ) :
			echo '</div>';
		endif; 	?>

		<?php if ( $blog_archive_tags === false && $blog_archive_social_share === true ) : ?>
			<?php
			echo '<div class="col-md-12 aligncenter textaligncenter mml-40">';
			echo ceder_social_share();
			echo '</div>'; ?>
		<?php endif;  ?>

		<?php if ( $blog_archive_tags or $blog_archive_social_share === true ) :
			echo '</div><!-- .list-post-meta-bottom -->';
		endif; ?>
	<?php }

}
else { ?>
	<?php $blog_single_social_share = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_single_social_share') : '';
	$blog_archive_social_share = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_archive_social_share') : '';
	if ( is_single() ) { ?>
		<?php if ( $blog_single_social_share === true ) : ?>
			<?php
			echo '<div class="single-post-meta-bottom clearfix">';
			echo '<div class="col-md-12 aligncenter textaligncenter">';
			echo ceder_social_share();
			echo '</div>';
			echo '</div>'; ?>
		<?php endif;
	}
	else { ?>
		<?php if ( $blog_archive_social_share === true ) : ?>
			<?php
			echo '<div class="list-post-meta-bottom clearfix">';
			echo '<div class="col-md-12 aligncenter textaligncenter mml-40">';
			echo ceder_social_share();
			echo '</div>';
			echo '</div>'; ?>
		<?php endif;
	}
}
?>

<?php if ( !is_single() ): ?>
	<?php $post_page_picker = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('post_page_picker') : ''; ?><?php if ( $post_page_picker === 'grid' ) : ?></div><?php endif; ?>
<?php endif; ?>

<?php // About the author
$blog_single_about_the_author = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_single_about_the_author') : '';
if ( $blog_single_about_the_author === true ) : ?>
	<?php ceder_about_the_author(); ?>
<?php endif; ?>

	</article>

<?php // Related posts
$blog_single_related_posts = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_single_related_posts') : '';
if ( $blog_single_related_posts === true ) : ?>
	<?php echo ceder_related_posts(); ?>
<?php endif; ?>

<?php //Comments
if ( is_single()) : ?>
	<div class="comments">
		<?php
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() ) :
			comments_template();
		endif;
		?>
	</div>
<?php endif; ?>