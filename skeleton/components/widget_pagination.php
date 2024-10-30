<!-- Widget Load More Pagination -->
<?php 
  $uniqueHash = wp_create_nonce("otw_bm_get_posts_nonce"); 
  $listID = $this->listOptions['id'];
  // $paginationPage is set from the otw_blog_manager.php
  ( !isset($paginationPage) )? $page = 2 : $page = $paginationPage;

  $ajaxURL = admin_url( 'admin-ajax.php?action=get_posts&post_id='. $listID .'&nonce='. $uniqueHash .'&page='. $page );
?>
<div class="js-widget-pagination_container">
  <div class="otw_blog_manager-pagination hide">
    <a href="<?php echo esc_attr( $ajaxURL );?>" class="js-pagination-no"><?php echo esc_html( $page );?></a>
  </div>
  <div class="otw_blog_manager-load-more js-widget-otw_blog_manager-load-more">
    <a href="<?php echo esc_attr( $ajaxURL );?>" data-empty="<?php esc_html_e('No more pages to load.', 'otw_bml');?>" data-isotope="true">
      <?php esc_html_e('Load More...', 'otw_bml');?>
    </a>
  </div>
</div>
<!-- End Widget Load More Pagination -->

