<!-- Widget Title -->
<?php  
  $titleLink = $this->getLink($widgetPost, 'title'); 
  if( !empty( $titleLink ) ) :
?>
  <h3><a href="<?php echo esc_attr( $titleLink );?>" class="otw-widget-title"><?php echo esc_html( $widgetPost->post_title );?></a></h3>
<?php else: ?>
  <h3 class="otw-widget-title"><?php echo esc_html( $widgetPost->post_title );?></h3>
<?php endif; ?>
<!-- End Widget Title -->