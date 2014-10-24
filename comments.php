<?php
/**
 * comments template
 */
if ( post_password_required() )
	return;
?>

<?php if ( have_comments() ) : ?>
<div id="comments" class="clearfix comments-area">
		<h2 class="comments-title">
			<?php
				printf( _n( 'Only 1 comment left', 'There are %1$s comments left', get_comments_number(), 'zAlive' ),
					number_format_i18n( get_comments_number() ));
			?>
      <?php if ( comments_open() ):?>
      <a class="gotocomment" href="#respond"><?php _ex('Go To Comment', 'go to comment' ,'zAlive'); ?></a>
      <?php endif; ?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'zAlive_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div id="comment-pager" class="navigation comment-pager clearfix" role="navigation">
      <span class="pager_text"><?php _e('Comment Pagination: ','zAlive') ?></span>
      <?php paginate_comments_links(array('prev_text' => __('Previous Page','zAlive'),'next_text' => __('Next Page','zAlive')));?>
		</div>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments alert alert-block"><?php _e( 'Comment is closed.' , 'zAlive' ); ?></p>
		<?php endif; ?>

</div><!-- #comments .comments-area -->
<?php endif; // have_comments() ?>
<?php
/* If there are no comments and comments are closed, let's leave a note.
 * But we only want the note on posts and pages that had comments in the first place.
 */
if ( ! comments_open() && ! get_comments_number() ) : ?>
<div id="comments" class="comments-area">
  <p class="nocomments alert alert-block"><?php _e( 'Comment is closed.' , 'zAlive' ); ?></p>
</div>
<?php endif; ?>
<?php get_template_part( 'reply' ); ?>