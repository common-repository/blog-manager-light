<!-- Post Comments -->
<div class="otw_blog_manager-blog-comment">
  <?php if( !$this->listOptions['meta_icons'] ) : ?>
  <span class="head"><?php esc_html_e('Comments:', 'otw_bml');?></span>
  <?php else: ?>
  <span class="head"><i class="icon-comments"></i></span>
  <?php endif; ?>
  <a href="<?php echo esc_attr( get_comments_link($post->ID) );?>" title="<?php esc_html_e('Comment on ', 'otw_bml'); echo $post->post_title;?>"><?php echo esc_html( $post->comment_count );?></a>
</div>
<!-- END Post Comments -->