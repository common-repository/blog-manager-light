<?php 
/**
 * Crop Images on the Fly
 * Create an unique Image Name for cropped images.
 * If cropped image is on the server return the existing one
 */
class OTWBMLImageCrop {

  /**
   * Image extensions accepted for resize
   */
  private $imgTypes = array("gif", "jpeg", "jpg", "png", "wbmp"); // used to determine image type

  /**
   * Image Paths used for resize
   * $imgBaseDir: /var/www/folder/wp-content/uploads
   * $imgBaseUrl: http://example.com/wp-content/uploads
   */
  private $imgBaseDir = ''; 
  private $imgBaseUrl = '';

  /**
   * Cache folder
   * This folder will be created within the $imgPath
   * In the default case this is going to result in: wp-content/uploads/cache/
   */
  private $cacheFolder = 'cache';

  /**
   * Image filename sent for resize;
   * $filename = abstract_image_name.jpg - actual image name
   * $ext = .jpg - actual image extension
   * $baseDir = /var/www/folder/wp-content/uploads/2014/03/  - actual image folder upload location
   */
  private $filename = '';
  private $ext = '';
  private $baseDir = '';
  private $currentImage = '';


  /**
   * Constructor
   * We will check if the cache folder is writtable.
   */
  public function __construct() {
  
     global $wp_filesystem;
     
    // Large Image may require more memory for crop
    ini_set('memory_limit', '128M');

    $imgPaths = wp_upload_dir();

    $this->imgBaseUrl = $imgPaths['baseurl'].'/';
    $this->imgBaseDir = $imgPaths['basedir'].'/';
     
    if( !otw_init_filesystem() || !$wp_filesystem->is_writable( $this->imgBaseDir ) ) {
      // If Uploads directory is NOT writtable, throw exception
      throw new Exception('Folder:'. $this->imgBaseDir .' is not writtable. Make sure you have read/write permissions.');
      return;

    } elseif( !$wp_filesystem->exists( $this->imgBaseDir.$this->cacheFolder ) ) {
      // If Uploads directory is writtable, create cache folder
      $wp_filesystem->mkdir( $this->imgBaseDir.$this->cacheFolder );
    }

  }

  /**
   * Resize Images and save them into the cache folder
   * @param $imgData string - current image path
   * @param $resizeWidth int - new image width
   * @param $resizeHeight int - new image height
   * @param $crop boolean - crop image, or just resize
   * @return string - cropped image url
   */
  public function resize( $imgData, $resizeWidth, $resizeHeight, $crop = false, $white_spaces = true, $background = false ){
	
	global $otw_bm_image_object, $otw_bm_image_profile;
	
	return set_url_scheme( $otw_bm_image_object->resize( $otw_bm_image_profile, $imgData, $resizeWidth, $resizeHeight, $crop , false, $white_spaces, $background ) );
  } 
  
  public function embed_resize( $html, $resizeWidth, $resizeHeight, $crop = false ){
	
	global $otw_bm_image_object, $otw_bm_image_profile;
	
	return $otw_bm_image_object->embed_resize( $otw_bm_image_profile, $html, $resizeWidth, $resizeHeight, $crop );
  }
	
   /**
   * Create cache directory.
   * @param $directory string - Cache directory
   * @return cache folder path
   */
  public function cacheDir ( $directory ) {
    global $wp_filesystem;
    $baseDirectory = $this->imgBaseDir.$this->cacheFolder.'/'.$directory;

    if( otw_init_filesystem() ){

	if ( !$wp_filesystem->exists($baseDirectory) ) {
		$wp_filesystem->mkdir( $baseDirectory );
	}
    }

    return $baseDirectory;

  }


}
?>