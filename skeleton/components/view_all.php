<!-- Blog List More Link -->
<div class="otw-row">
  <div class="otw-twentyfour otw-columns">
    <div class="otw_blog_manager-blog-list-more-link bm_clearfix">
      <?php if( !empty($this->listOptions['blog_list_title']) ) : ?>
      <span class="otw_blog_manager-blog-list-title"><?php echo esc_html( $this->listOptions['blog_list_title'] ); ?></span>
      <?php endif;?>
      
      <?php 
      if( !empty($this->listOptions['view_all_page']) || !empty($this->listOptions['view_all_page_link']) ) : 
        
        ( empty($this->listOptions['view_all_page_text']) )? $view_all_msg = esc_html__('View All', 'otw_bml') : $view_all_msg = $this->listOptions['view_all_page_text'];
        ( !empty($this->listOptions['view_all_page']) )? $page_link = get_page_link($this->listOptions['view_all_page']) : $page_link = $this->listOptions['view_all_page_link'];

      ?>
      <a href="<?php echo esc_attr( $page_link );?>" target="<?php echo esc_attr( $this->listOptions['view_all_target'] );?>" class="otw_blog_manager-view-all"><?php echo esc_html( $view_all_msg ); ?></a>
      <?php endif;?>
    </div>
  </div>
</div>
<!-- End Blog List More Link -->