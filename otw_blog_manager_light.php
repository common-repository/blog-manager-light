<?php
/**
 * Plugin Name: Blog Manager Light
 * Plugin URI: http://OTWthemes.com 
 * Description: Blog Manager for WordPress adds tons of blog functionality to your WordPress based website.
 * Author: OTWthemes
 * Version: 1.20
 * Author URI: https://codecanyon.net/user/otwthemes/portfolio?ref=OTWthemes
 */

/**
 * Global Constants that are need for this plugin
 */
 
  // Directory Separator
	if( !defined( 'DS' ) ){
		if( defined( 'DIRECTORY_SEPARATOR' ) && DIRECTORY_SEPARATOR ){
			define( 'DS', DIRECTORY_SEPARATOR );
		}else{
			define( 'DS', '/' );
		}
	}
  // Plugin Folder Name
  if( function_exists( 'plugin_basename' ) ){
	define( 'OTW_BML_PATH', preg_replace( "/\/otw\_blog\_manager\_light\.php$/", '', plugin_basename( __FILE__ ) ) );
  }else{
	define( 'OTW_BML_PATH', 'otw-blog-manager-light' );
  }
  // Full map 
  define( 'OTW_BML_SERVER_PATH', dirname(__FILE__) );
  // Namespace for translation
  define( 'OTW_BML_TRANSLATION', 'otw_bml' );
	
	$otw_bml_plugin_id = 'd6d749403abbe051ec81a7476759426f';
	
	$otw_bml_plugin_url = plugin_dir_url( __FILE__);
	
	$upload_dir = wp_upload_dir();
	
	define( 'SKIN_BML_URL', set_url_scheme( $upload_dir['baseurl'] ).DS.'otwbm'.DS.'skins'.DS );
	define( 'SKIN_BML_PATH', $upload_dir['basedir'].DS.'otwbm'.DS.'skins'.DS );
	define( 'UPLOAD_BML_PATH', $upload_dir['basedir'].DS );
	
	$otw_bm_factory_component = false;
	$otw_bm_factory_object = false;
	$otw_bm_image_component = false;
	$otw_bm_image_object = false;
	$otw_bm_image_profile = false;
	
	//load core component functions
	@include_once( 'include/otw_components/otw_functions/otw_functions.php' );
	
	if( !function_exists( 'otw_register_component' ) ){
		wp_die( 'Please include otw components' );
	}
	
	//register factory component
	otw_register_component( 'otw_factory', dirname( __FILE__ ).'/include/otw_components/otw_factory/', $otw_bml_plugin_url.'include/otw_components/otw_factory/' );

	//register image component
	otw_register_component( 'otw_image', dirname( __FILE__ ).'/include/otw_components/otw_image/', '/include/otw_components/otw_image/' );


if( !class_exists('OTWBlogManagerLight') ) {

class OTWBlogManagerLight {

  // Query Class Instance
  public $otwBMQuery = null;
  
  // CSS Class Instance
  public $otwCSS = null;

  // Tempalte Dispatcher
  public $otwDispatcher = null;

  public $fontsArray = null;

  // Validation errors array
  public $errors = null;

  // Form data on error
  public $errorData = null;

  /**
   * Initialize plugin
   */
  public function __construct() {
    
    // Create an instance of the OTWBMQuery Class
    $this->otwBMQuery = new OTWBMQuery();

    $this->otwCSS = new OTWCss();

    $this->otwDispatcher = new OTWDispatcher();

    include( 'include' . DS . 'fonts.php' );
    
    $this->fontsArray = json_decode($allFonts);

    // Add Admin Menu only if role is Admin
    if( is_admin() ) {
      
      // Save and redirect are done before any headers are loaded
      $this->saveAction();

      // Add Admin Assets
      add_action( 'admin_init', array($this, 'register_resources') );
      // Add Admin menu
      add_action( 'admin_menu', array($this, 'register_menu') );
      // Add Meta Box 
      add_action( 'add_meta_boxes', array($this, 'bm_meta_boxes'), 10, 2 );
      // Save Meta Box Data
      add_action( 'save_post', array($this, 'bm_save_meta_box') );
      
      add_action( 'wp_ajax_otw_bml_select2_options', array($this, 'get_select2_options') );
      
	//filter for factory messages
	add_filter( 'otwfcr_notice', array( $this, 'factory_message' ) );

    }
    
    add_action('init', array($this, 'load_resources') );
    
    // Load Short Code
    add_shortcode( 'otw-bm-list', array($this, 'bm_list_shortcode') );

    // Include Widgets Functionality
    add_action( 'widgets_init', array($this, 'bm_register_widgets') );

    /**
     * Init Front End template functions
     */

    // Enque template JS and CSS files
    add_action( 'wp_enqueue_scripts', array($this, 'register_fe_resources') );

    // Ajax FE Actions - Load More Pagination
    add_action( 'wp_ajax_get_posts', array($this, 'otw_bm_get_posts') );
    add_action( 'wp_ajax_nopriv_get_posts', array($this, 'otw_bm_get_posts') );
    
    // Ajax FE Social Share
    add_action( 'wp_ajax_social_share', array($this, 'otw_bm_social_share') );
    add_action( 'wp_ajax_nopriv_social_share', array($this, 'otw_bm_social_share') );
  }

  /**
   * Add Menu To WP Backend
   * This menu will be available only for Admin users
   */
  public function register_menu() {

    add_menu_page( 
      esc_html__('Blog Manager Light', OTW_BML_TRANSLATION),  
      esc_html__('Blog Manager Light', OTW_BML_TRANSLATION), 
      'manage_options', 
      'otw-bml', 
      array( $this , 'bml_list' ),
      plugins_url() . DS . OTW_BML_PATH . DS .'assets'. DS .'img'. DS .'menu_icon.png' 
    );

    add_submenu_page( 
      'otw-bml', 
      esc_html__('Blog Manager Lists', OTW_BML_TRANSLATION), 
      esc_html__('Blog Lists', OTW_BML_TRANSLATION), 
      'manage_options', 
      'otw-bml', 
      array( $this , 'bml_list' )
    );

    add_submenu_page( 
      'otw-bml', 
      esc_html__('Blog Manager | Add Lists', OTW_BML_TRANSLATION), 
      esc_html__('Add Lists', OTW_BML_TRANSLATION), 
      'manage_options', 
      'otw-bml-add', 
      array( $this , 'bml_add' )
    );

    add_submenu_page( 
      'otw-bml', 
      esc_html__('Blog Manager | Options', OTW_BML_TRANSLATION), 
      esc_html__('Options', OTW_BML_TRANSLATION), 
      'manage_options', 
      'otw-bml-settings', 
      array( $this , 'bml_settings' )
    );
  }
  
/**
  * Add components
  */
public function load_resources(){
	
	global $otw_bm_image_component, $otw_bm_image_profile, $otw_bm_image_object, $otw_bm_factory_component, $otw_bm_factory_object, $otw_bml_plugin_id;
	
	$otw_bm_factory_component = otw_load_component( 'otw_factory' );
	$otw_bm_factory_object = otw_get_component( $otw_bm_factory_component );
	$otw_bm_factory_object->add_plugin( $otw_bml_plugin_id, __FILE__, array( 'menu_parent' => 'otw-bml', 'lc_name' => esc_html__( 'License Manager', 'otw_bml' ), 'menu_key' => 'otw-bml' ) );
	
	include_once( plugin_dir_path( __FILE__ ).'include/otw_labels/otw_bm_factory_object.labels.php' );
	$otw_bm_factory_object->init();
	
	$otw_bm_image_component = otw_load_component( 'otw_image' );
	$otw_bm_image_object = otw_get_component( $otw_bm_image_component );
	$otw_bm_image_object->init();
	$img_location = wp_upload_dir();
	
	$otw_bm_image_profile = $otw_bm_image_object->add_profile( $img_location['basedir'].'/', $img_location['baseurl'].'/', 'otwbm' );

}

  /**
   * Add Styles and Scripts needed by the Admin interface
   */
  public function register_resources () {
    
	// Get ALL categories to be used in SELECT 2
	$categoriesData     = array();
	$catCount = 0;
	
	// Get ALL tags to be used in SELECT 2
	$tagsData           = array();
	$tagCount           = 0;
	
	// Get ALL users Authors
	$usersData          = array();
	$userCount          = 0;
	
	$pagesData          = array();
	$pageCount          = 0;
	
    // Custom Messages that are required in JS
    // Added here because of translation
    $messages = array(
      'delete_confirm'  => esc_html__('Are you sure you want to delete ', OTW_BML_TRANSLATION),
      'modal_title'     => esc_html__('Select Images', OTW_BML_TRANSLATION),
      'modal_btn'       => esc_html__('Add Image', OTW_BML_TRANSLATION)
    );

    if( !function_exists( 'wp_enqueue_media' ) ) {
      wp_enqueue_media(); //WP 3.5 media uploader
    }
	//check the sskin folder
	$upload_dir = wp_upload_dir();
	
	global $wp_filesystem;
		
	if( otw_init_filesystem() ){
	
		if( isset( $upload_dir['basedir'] ) && $wp_filesystem->is_writable( $upload_dir['basedir'] ) && !$wp_filesystem->is_dir( SKIN_BML_PATH ) ){
			
			if( !$wp_filesystem->is_dir( $upload_dir['basedir'].DS.'otwbm' ) ){
				$wp_filesystem->mkdir( $upload_dir['basedir'].DS.'otwbm' );
			}
			if( $wp_filesystem->is_dir( $upload_dir['basedir'].DS.'otwbm' ) && !$wp_filesystem->is_dir( SKIN_BML_PATH ) ){
				$wp_filesystem->mkdir( SKIN_BML_PATH );
			}
		}
	}
    
    wp_register_script( 
      'otw-admin-colorpicker', 
      plugins_url() . DS . OTW_BML_PATH . DS . 'assets'.DS.'js'.DS.'plugins'.DS.'colorpicker.js', array('jquery') 
    );
    wp_register_script( 
      'otw-admin-select2', 
      plugins_url() . DS . OTW_BML_PATH . DS . 'assets'.DS.'js'.DS.'plugins'.DS.'select2.full.min.js', array('jquery') 
    );

    wp_register_script( 
      'otw-admin-variables', 
      plugins_url() . DS . OTW_BML_PATH . DS . 'assets'.DS.'js'.DS.'otw-admin-bm-variables.js'
    );
    wp_register_script( 
      'otw-admin-functions', 
      plugins_url() . DS . OTW_BML_PATH . DS . 'assets'.DS.'js'.DS.'otw-admin-bm-functions.js'
    );
    wp_register_script( 
      'otw-admin-fonts', 
      plugins_url() . DS . OTW_BML_PATH . DS . 'assets'.DS.'js'.DS.'fonts.js'
    );

    // Custom Scripts + Plugins
    wp_enqueue_script( 'otw-admin-colorpicker' );
    wp_enqueue_script( 'otw-admin-select2' );
    wp_enqueue_script( 'otw-admin-otwpreview' );
    wp_enqueue_script( 'otw-admin-fonts');
    wp_enqueue_script( 'otw-admin-functions');
    wp_enqueue_script( 'otw-admin-variables');

    // Core Scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-draggable' );
    wp_enqueue_script( 'jquery-ui-droppable' );
    wp_enqueue_script( 'jquery-ui-accordion' );
    wp_enqueue_script( 'jquery-ui-sortable' );

    wp_add_inline_script( 'otw-admin-functions', 'var categories = "'.addslashes( json_encode( $categoriesData ) ).'";', 'before' );
    wp_add_inline_script( 'otw-admin-functions', 'var tags = "'.addslashes( json_encode( $tagsData ) ).'";', 'before' );
    wp_add_inline_script( 'otw-admin-functions', 'var users = "'.addslashes( json_encode( $usersData ) ).'";', 'before' );
    wp_add_inline_script( 'otw-admin-functions', 'var pages = "'.addslashes( json_encode( $pagesData ) ).'";', 'before' );
    wp_add_inline_script( 'otw-admin-functions', 'var messages = "'.addslashes( json_encode( $messages ) ).'";', 'before' ) ;
    wp_add_inline_script( 'otw-admin-functions', 'var frontendURL = '.json_encode( plugins_url() . DS . OTW_BML_PATH . DS . 'frontend/' ), 'before' );

    wp_register_style( 
      'otw-admin-color-picker', 
      plugins_url() . DS . OTW_BML_PATH . DS . 'assets'.DS.'css'.DS.'colorpicker.css' 
    );
    wp_register_style( 'otw-admin-bm-default', plugins_url() . DS . OTW_BML_PATH . DS . 'assets'.DS.'css'.DS.'otw-blog-list-default.css' );
    wp_register_style( 'otw-admin-bm-select2', plugins_url() . DS . OTW_BML_PATH . DS . 'assets'.DS.'css'.DS.'select2.min.css' );

    wp_enqueue_style( 'otw-admin-color-picker' );
    wp_enqueue_style( 'otw-admin-bm-default' );
    wp_enqueue_style( 'otw-admin-bm-select2' );

  }

  /**
   * Add Meta Boxes 
   */
  public function bm_meta_boxes () {
    // Add Support for POSTS
    add_meta_box(
      'otw-bm-meta-box', 
      esc_html__('OTW Media Item', OTW_BML_TRANSLATION), 
      array($this, 'otw_blog_manager_media_meta_box'), 
      'post', 
      'normal', 
      'default'
    );
  }

  /**
   * Add Custom HTML Meta Box on POSTS and PAGES 
   */
  public function otw_blog_manager_media_meta_box ( $post ) {

    $otw_bm_meta_data = get_post_meta( $post->ID, 'otw_bm_meta_data', true );
    require_once( 'views'. DS .'otw_blog_manager_meta_box.php' );
  }

  /**
   * Save Meta Box Data
   * @param $post_id - int - Current POST ID beeing edited
   */
  function bm_save_meta_box ( $post_id ) {

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
      return;
    }

    if( !empty( $_POST ) && !empty( otw_post( 'otw-bm-list-media_type', '' )) ) {


      $otw_meta_data = array(
        'media_type'      => otw_post( 'otw-bm-list-media_type', '' ),
        'youtube_url'     => otw_post( 'otw-bm-list-youtube_url', '' ),
        'vimeo_url'       => otw_post( 'otw-bm-list-vimeo_url', '' ),
        'soundcloud_url'  => otw_post( 'otw-bm-list-soundcloud_url', '' ),
        'img_url'         => otw_post( 'otw-bm-list-img_url', '' ),
        'slider_url'      => otw_post( 'otw-bm-list-slider_url', '' )
      );

      /**
       * Add Custom POST Meta Data
       * If POST is found in the DB it will just be ignored and return FALSE
       */

      add_post_meta($post_id, 'otw_bm_meta_data', $otw_meta_data, true);

      // If POST is in the DB update it
      update_post_meta($post_id, 'otw_bm_meta_data', $otw_meta_data);
    }
  }

  /**
   * OTW Blog Manager List Page
   */
  public function bml_list () {
    $action = $_GET;

    // Check if writing permissions
    $writableCssError = $this->check_writing( SKIN_BML_PATH );
    $writableError    = $this->check_writing( UPLOAD_BML_PATH );

    $otw_bm_lists = get_option( 'otw_bm_lists' );

    if( !empty( $action['action'] ) && $action['action'] === 'delete' ) {
      $list_id = otw_get( 'otw-bm-list-id', '' );
      $item = 'otw-bm-list-'.$list_id;
      
      unset( $otw_bm_lists['otw-bm-list'][ $item ] );

      update_option( 'otw_bm_lists', $otw_bm_lists );

    }
    require_once('views' . DS . 'otw_blog_manager_list.php');
  }

  /**
   * OTW Blog Manager Add / Edit Page
   */
  public function bml_add () {

    // Default Values 
    // $content and $widgets
    include( 'include' . DS . 'content.php' );

    // Edit field - used to determin if we are on an edit or add action
    $edit = false;

    // Reload $_POST data on error
    if( !empty( $this->errors ) ) {
      $content = $this->errorData;
    }

    // Edit - Load Values for current list
    if( !empty(otw_get( 'otw-bm-list-id', '' )) ) {
      
      $listID = (int) otw_get( 'otw-bm-list-id', '' );
      $nextID = $listID;
      $edit = true;
      $content = $this->otwBMQuery->getItemById( $listID );
    }

    // Make manipulations to the $content in order to be used in the UI
    if( !empty( $content ) ) {
      // Replace escaping \ in order to display in textarea
      $content['custom_css'] = str_replace('\\', '', $content['custom_css']);

      // Select All functionality, remove all items from the list if Select All is used
      // We use this approach in order not to show any items in the text field if select all is used
      if( !empty( $content['all_categories'] ) ) { $content['categories'] = ''; }
      if( !empty( $content['all_tags'] ) ) { $content['tags'] = ''; }
      if( !empty( $content['all_users'] ) ) { $content['users'] = ''; }

      if( !array_key_exists('select_categories' , $content ) ) { $content['select_categories'] = ''; }
      if( !array_key_exists('select_tags' , $content ) ) { $content['select_tags'] = ''; }
      if( !array_key_exists('select_users' , $content ) ) { $content['select_users'] = ''; }
    }

    require_once('views' . DS . 'otw_blog_manager_add_list.php');
  }

  /**
   * saveAction - Validate form and save + redirect
   * @return void
   */
  public function saveAction() {
  
	global $wp_filesystem;
  
    if( !empty( $_POST ) &&  otw_post( 'submit-otw-bm', false )  ){

      $this->errors = null;

      // Check if Blog List Name is present
      if( empty( otw_post( 'list_name', '' ) ) ) {
        $this->errors['list_name'] = esc_html__('Blog List Name is Required', OTW_BML_TRANSLATION);
      }

      // Check if Blog List Template is present
      if( empty( otw_post( 'template', '' ) ) || otw_post( 'template', '' ) === 0 ) {
        $this->errors['template'] = esc_html__('Please select a Blog List Template', OTW_BML_TRANSLATION);
      }

      //Check Selection of content: Category OR Tag OR Author
      if( 
          ( empty( otw_post( 'categories', '' ) ) && empty( otw_post( 'tags', '' ) ) && empty( otw_post( 'users', '' ) ) ) &&
          ( empty( otw_post( 'all_categories', '' ) ) && empty( otw_post( 'all_tags', '' ) ) && empty( otw_post( 'all_users', '' ) ) )
        ) {
        $this->errors['content'] = esc_html__('Please select a Category or Tag or Author.', OTW_BML_TRANSLATION);
      }

      // Add dates created / modified  to current post
      if( empty( otw_post( 'date_created', '' ) ) && empty( $this->errors ) ) {
        otw_spost( 'date_created', date('Y/m/d') );
        otw_spost( 'date_modified', date('Y/m/d') );
      }

      // Update modified if post is edited
      if( !empty( otw_post( 'id', '' ) ) ) {
        // Inject Date Modified into $_POST
        otw_spost( 'date_modified', date('Y/m/d') );
      }

      /** 
       * If select All functionality is used, adjust the POST
       */
      if( !empty( otw_post( 'all_categories', '' ) ) ) {
        otw_spost( 'categories', otw_post( 'all_categories', '' ) );
      }
      if( !empty( otw_post( 'all_tags', '' ) ) ) {
        otw_spost( 'tags', otw_post( 'all_tags', '' ) );
      }
      if( !empty( otw_post( 'all_users', '' ) ) ) {
        otw_spost( 'users', otw_post( 'all_users', '' ) );
      }
      // Errors have been detected persist data
      if( !empty( $this->errors ) ) {
        $this->errorData = $_POST;
        return null;
      }

      // This is a new list get the ID
      if( empty( otw_post( 'edit', '' ) ) &&  empty( $this->errors ) ) {
        $otw_bm_lists = $this->otwBMQuery->getLists();

        // This is the first list generated
        if( empty( $otw_bm_lists ) ) {
	      otw_spost( 'id', 1 );
        } else {
          otw_spost( 'id', $otw_bm_lists['otw-bm-list']['next_id'] );
        }
        
      }

      // Assign $_POST to variable in order to fill form on error / edit
      $content = $_POST;

      /**
      * Create Custom CSS file for inline styles such as: Title, Meta Items, Excpert, Continue Reading
      */
      $customCssFile = SKIN_BML_PATH . 'otw-bm-list-'.otw_post( 'id', '' ).'-custom.css';

      // Make sure all the older CSS rules are deleted in order for a fresh save
      if( otw_init_filesystem() ){
	    if( $wp_filesystem->exists( $customCssFile ) ) {
	            $wp_filesystem->put_contents( $customCssFile, '');
	    }
      }

      // Write Custom CSS
      $this->otwCSS->writeCSS( str_replace('\\', '', otw_post( 'custom_css', '' )),  $customCssFile );

      $metaStyles = array(
        'font'        => (!empty(otw_post( 'meta_font', '' )))? $this->fontsArray[ otw_post( 'meta_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'meta-color', '' )))? otw_post( 'meta-color', '' ) : '',
        'size'        => (!empty(otw_post( 'meta-font-size', '' )))? otw_post( 'meta-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'meta-font-style', '' )))? otw_post( 'meta-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-meta-wrapper'
      );

      $this->otwCSS->buildCSS( $metaStyles, $customCssFile );

      $metaLinkStyles = array(
        'font'        => (!empty(otw_post( 'meta_font', '' )))? $this->fontsArray[ otw_post( 'meta_font', '' ) ]->text : '',
        'size'        => (!empty(otw_post( 'meta-font-size', '' )))? otw_post( 'meta-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'meta-font-style', '' )))? otw_post( 'meta-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-meta-wrapper a'
      );

      $this->otwCSS->buildCSS( $metaLinkStyles, $customCssFile );

      $metaLabelStyles = array(
        'font'        => (!empty(otw_post( 'meta_font', '' )))? $this->fontsArray[ otw_post( 'meta_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'meta-color', '' )))? otw_post( 'meta-color', '' ) : '',
        'size'        => (!empty(otw_post( 'meta-font-size', '' )))? otw_post( 'meta-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'meta-font-style', '' )))? otw_post( 'meta-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-meta-wrapper .head'
      );

      $this->otwCSS->buildCSS( $metaLabelStyles, $customCssFile );

      $titleNoLinkStyles = array(
        'font'        => (!empty(otw_post( 'title_font', '' )))? $this->fontsArray[ otw_post( 'title_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'title-color', '' )))? otw_post( 'title-color', '' ) : '',
        'size'        => (!empty(otw_post( 'title-font-size', '' )))? otw_post( 'title-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'title-font-style', '' )))? otw_post( 'title-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-title'
      );

      $this->otwCSS->buildCSS( $titleNoLinkStyles, $customCssFile );

      $titleWidgetStyles = array(
        'font'        => (!empty(otw_post( 'title_font', '' )))? $this->fontsArray[ otw_post( 'title_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'title-color', '' )))? otw_post( 'title-color', '' ) : '',
        'size'        => (!empty(otw_post( 'title-font-size', '' )))? otw_post( 'title-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'title-font-style', '' )))? otw_post( 'title-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw-widget-title'
      );

      $this->otwCSS->buildCSS( $titleWidgetStyles, $customCssFile );

      $titleWLinkStyles = array(
        'font'        => (!empty(otw_post( 'title_font', '' )))? $this->fontsArray[ otw_post( 'title_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'title-color', '' )))? otw_post( 'title-color', '' ) : '',
        'size'        => (!empty(otw_post( 'title-font-size', '' )))? otw_post( 'title-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'title-font-style', '' )))? otw_post( 'title-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-title a'
      );

      $this->otwCSS->buildCSS( $titleWLinkStyles, $customCssFile );

      $excpertStyles = array(
        'font'        => (!empty(otw_post( 'excpert_font', '' )))? $this->fontsArray[ otw_post( 'excpert_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'excpert-color', '' )))? otw_post( 'excpert-color', '' ) : '',
        'size'        => (!empty(otw_post( 'excpert-font-size', '' )))? otw_post( 'excpert-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'excpert-font-style', '' )))? otw_post( 'excpert-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-content p'
      );

      $this->otwCSS->buildCSS( $excpertStyles, $customCssFile );

      $excpertWidgetStyles = array(
        'font'        => (!empty(otw_post( 'excpert_font', '' )))? $this->fontsArray[ otw_post( 'excpert_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'excpert-color', '' )))? otw_post( 'excpert-color', '' ) : '',
        'size'        => (!empty(otw_post( 'excpert-font-size', '' )))? otw_post( 'excpert-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'excpert-font-style', '' )))? otw_post( 'excpert-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw-widget-content'
      );

      $this->otwCSS->buildCSS( $excpertWidgetStyles, $customCssFile );

      $linkStyles = array(
        'font'        => (!empty(otw_post( 'read-more_font', '' )))? $this->fontsArray[ otw_post( 'read-more_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'read-more-color', '' )))? otw_post( 'read-more-color', '' ) : '',
        'size'        => (!empty(otw_post( 'read-more-font-size', '' )))? otw_post( 'read-more-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'read-more-font-style', '' )))? otw_post( 'read-more-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-continue-reading'
      );

      $this->otwCSS->buildCSS( $linkStyles, $customCssFile );

      $titleSliderStyles = array(
        'font'        => (!empty(otw_post( 'title_font', '' )))? $this->fontsArray[ otw_post( 'title_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'title-color', '' )))? otw_post( 'title-color', '' ) : '',
        'size'        => (!empty(otw_post( 'title-font-size', '' )))? otw_post( 'title-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'title-font-style', '' )))? otw_post( 'title-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-caption-title a'
      );

      $this->otwCSS->buildCSS( $titleSliderStyles, $customCssFile );

      $excpertSliderStyles = array(
        'font'        => (!empty(otw_post( 'excpert_font', '' )))? $this->fontsArray[ otw_post( 'excpert_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'excpert-color', '' )))? otw_post( 'excpert-color', '' ) : '',
        'size'        => (!empty(otw_post( 'excpert-font-size', '' )))? otw_post( 'excpert-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'excpert-font-style', '' )))? otw_post( 'excpert-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-caption-excpert'
      );

      $this->otwCSS->buildCSS( $excpertSliderStyles, $customCssFile );

      // Get Current Items in the DB
      $otw_bm_list = $this->otwBMQuery->getLists();

      // Create new entry 
      $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ] = $_POST;
      
	//reformat the combo values
	if( isset( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['categories'] ) && is_array( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['categories'] ) ){
	
		if( count( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['categories'] ) ){
			$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['categories'] = implode( ',', $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['categories'] );
		}else{
			$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['categories'] = '';
		}
	}
	if( isset( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['tags'] ) && is_array( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['tags'] ) ){
	
		if( count( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['tags'] ) ){
			$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['tags'] = implode( ',', $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['tags'] );
		}else{
			$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['tags'] = '';
		}
	}
	if( isset( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['users'] ) && is_array( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['users'] ) ){
	
		if( count( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['users'] ) ){
			$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['users'] = implode( ',', $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['users'] );
		}else{
			$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['users'] = '';
		}
	}


      // We setup the next_id value. This will apply to the first save only
      if( empty($otw_bm_list['otw-bm-list']['next_id']) && empty( otw_post( 'edit', '' ) ) ) {
        // We assume this is the first save with ID  1, next ID has to be 2. Count starts from 1 because of short-code
        $otw_bm_list_data['otw-bm-list']['next_id'] = 2;      
      } elseif ( empty( otw_post( 'edit', '' ) ) ) {
        $otw_bm_list['otw-bm-list']['next_id'] = $otw_bm_list['otw-bm-list']['next_id'] + 1;
        $otw_bm_list_data['otw-bm-list']['next_id'] =  $otw_bm_list['otw-bm-list']['next_id'];
      }

      // Merge the 2 arrays
      if ( $otw_bm_list === false || empty( $otw_bm_list ) ) {
        $listData = $otw_bm_list_data;
      } elseif ( !empty($otw_bm_list) ) {
        // Do not remove the 'otw-bm-list' from they array_merge. There is a strange behavior related to this
        $listData['otw-bm-list'] = array_merge( $otw_bm_list['otw-bm-list'], $otw_bm_list_data['otw-bm-list'] );
      }
      // Update
      if( empty($this->errors) ) {
        
        // Get $widget from included file
        include( 'include' . DS . 'content.php' );

        if( in_array( otw_post( 'template', '' ), $widgets) ) {
          // It's a widget
          $listData['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['widget'] = 1;
        } else {
          // It's NOT a Widget
          $listData['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['widget'] = 0;
        }

        update_option( 'otw_bm_lists', $listData );
        
        $this->redirect('admin.php?page=otw-bml-add&action=edit&otw-bm-list-id='.otw_post( 'id', '' ).'&success=true');
        exit;
        
      } // End update

    } // End if (!empty($_POST))
  }

  /**
   * OTW Blog Manager Settings Page
   */
  public function bml_settings () {
  
     global $wp_filesystem;
    $customCss = '';
    $cssPath = SKIN_BML_PATH . 'custom.css';

    // Check if writing permissions
    $writableCssError = $this->check_writing( SKIN_BML_PATH );
    
    // Open File for edit
    if( empty( $_POST ) && !$writableCssError  ) {
        if( otw_init_filesystem() ){
		if( $wp_filesystem->exists( $cssPath ) ){
    			$customCss = $wp_filesystem->get_contents( $cssPath );
	        }else{
    			$customCss = '';
    		}
    	}
        
    }

    // Save File on disk and redirect.
    if( !empty( $_POST ) ) {
      $customCSS = str_replace('\\', '', otw_post( 'otw_css', '' ));
      if( otw_init_filesystem() ){
    	    $wp_filesystem->put_contents( $cssPath, $customCSS );
      }
      
		if( otw_post( 'otw_bm_promotions', false ) && !empty( otw_post( 'otw_bm_promotions', '' ) ) ){
			
			global $otw_bml_factory_object, $otw_bml_plugin_id;
			
			update_option( $otw_bml_plugin_id.'_dnms', otw_post( 'otw_bm_promotions', '' ) );
			
			if( is_object( $otw_bml_factory_object ) ){
				$otw_bml_factory_object->retrive_plungins_data( true );
			}
		}
				

      echo "<script>window.location = 'admin.php?page=otw-bml-settings&success_css=true';</script>";
      die;
    }
    require_once('views' . DS . 'otw_blog_manager_settings.php');
  }

  /**
   * Check Writing Permissions
   */
  public function check_writing( $path ) {
	
	$writableCssError = false;
	
	global $wp_filesystem;
	
	if( otw_init_filesystem() ){
		
		if( !$wp_filesystem->is_writable( $path ) ) {
			$writableCssError = true;
		}
	}
	
	return $writableCssError;
  }



  /*****
    Front End Related Actions
   ****/

  /**
   * Load Lists on the Front End using short code
   * @param $attr - array
   */
  public function bm_list_shortcode( $attr ) {
  
  
    global $wp_filesystem;
    
    $listID = $attr['id'];

    // Get Current Items in the DB
    $otw_bm_options = $this->otwBMQuery->getItemById( $listID );
    
    if( !empty( $otw_bm_options ) ) {

      // Enqueue Custom Styles CSS
      if( otw_init_filesystem() ){
	      if( $wp_filesystem->exists(SKIN_BML_PATH .'otw-bm-list-'.$listID.'-custom.css') ) {
    		    wp_register_style( 'otw-bm-custom-css-'.$listID, SKIN_BML_URL.'otw-bm-list-'.$listID.'-custom.css' );
	            wp_enqueue_style( 'otw-bm-custom-css-'.$listID );
	        }

      }
    
	if( !empty( $otw_bm_options['title_font'] ) ){
		$customFonts = array(
			'title'         => $otw_bm_options['title_font'],
			'meta'          => $otw_bm_options['meta_font'],
			'excpert'       => $otw_bm_options['excpert_font'],
			'continue_read' => $otw_bm_options['read-more_font']
			);
			
		$googleFonts = $this->otwCSS->getGoogleFonts( $customFonts, $this->fontsArray  );
		
		if( !empty( $googleFonts ) ) {
			$httpFonts = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
			$url = $httpFonts.'://fonts.googleapis.com/css?family='.$googleFonts.'&variant=italic:bold';
			wp_enqueue_style('otw-bm-googlefonts',$url, null, null);
		}
	}
      
      // Load $templateOptions - array
      include('include' . DS . 'content.php');

      $currentPage = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      
      if( !preg_match( "/^\d+$/", get_query_var( 'paged' ) ) && preg_match( "/^\d+$/", get_query_var( 'page' ) ) ){
    		$currentPage = ( get_query_var( 'page' ) )?get_query_var( 'page' ):1;
      }

      if( otw_get( 'post_id', false ) && preg_match( "/^\d+$/", otw_get( 'post_id', '' ) ) ){
    	
    		if( otw_get( 'post_id', '' ) != $listID ){
    			$currentPage = 1;
    		}
      }

      $otw_posts_result = $this->otwBMQuery->getPosts( $otw_bm_options, $currentPage );

      return $this->otwDispatcher->generateTemplate( $otw_bm_options, $otw_posts_result, $templateOptions );

    } else {
      $errorMsg = '<p>';
      $errorMsg .= esc_html__('Woops, we have encountered an error. The List you are trying to use can not be found: ', OTW_BML_TRANSLATION);
      $errorMsg .= 'otw-bm-list-'.$attr['id'].'<br/>';
      $errorMsg .= '</p>';

      return $errorMsg;
    }
  }

  /**
   * Load Widget Class
   * Init Widget Class
   */
  public function bm_register_widgets () {
    register_widget( 'OTWBML_Widget' );
  }

  /**
   * Load Resources for FE - CSS and JS
   */
  public function register_fe_resources () {
    $uniqueHash = wp_create_nonce("otw_bm_social_share"); 
    $socialShareLink = admin_url( 'admin-ajax.php?action=social_share&nonce='. $uniqueHash );

    wp_register_script( 
      'otw-bm-flexslider', 
      plugins_url() . DS . OTW_BML_PATH . DS .'frontend'. DS .'js'. DS .'jquery.flexslider.min.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'otw-bm-infinitescroll', 
      plugins_url() . DS . OTW_BML_PATH . DS .'frontend'. DS .'js'. DS .'jquery.infinitescroll.min.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'otw-bm-pixastic', 
      plugins_url() . DS . OTW_BML_PATH . DS .'frontend'. DS .'js'. DS .'pixastic.custom.min.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'otw-bm-fitvid',
      plugins_url() . DS . OTW_BML_PATH . DS .'frontend'. DS .'js'. DS .'jquery.fitvids.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'otw-bm-main-script', 
      plugins_url() . DS . OTW_BML_PATH . DS .'frontend'. DS .'js'. DS .'script.js', 
      array( 'jquery' ), '', true
    );

    // Custom Scripts + Plugins
    wp_enqueue_script( 'otw-bm-flexslider' );
    wp_enqueue_script( 'otw-bm-infinitescroll' );
    wp_enqueue_script( 'otw-bm-pixastic' );
    wp_enqueue_script( 'otw-bm-fitvid' );
    wp_enqueue_script( 'otw-bm-main-script' );

    wp_add_inline_script( 'otw-bm-main-script', 'var socialShareURL = '.json_encode( $socialShareLink ).';', 'before' ); 

    wp_register_style( 
      'otw-bm-default', 
      plugins_url() . DS . OTW_BML_PATH . DS .'frontend'. DS .'css'. DS .'default.css' 
    );
    wp_register_style( 
      'otw-bm-font-awesome', 
      plugins_url() . DS . OTW_BML_PATH . DS .'frontend'. DS .'css'. DS .'font-awesome.min.css' 
    );
    wp_register_style( 
      'otw-bm-bm', 
      plugins_url() . DS . OTW_BML_PATH . DS .'frontend'. DS .'css'. DS .'otw-blog-manager.css' 
    );
    wp_register_style( 
      'otw-bm-grid', 
      plugins_url() . DS . OTW_BML_PATH . DS .'frontend'. DS .'css'. DS .'otw-grid.css' 
    );
    wp_register_style( 
      'otw-bm-custom', 
      SKIN_BML_URL.'custom.css' 
    );

    wp_enqueue_style( 'otw-bm-default' );
    wp_enqueue_style( 'otw-bm-font-awesome' );
    wp_enqueue_style( 'otw-bm-bm' );
    wp_enqueue_style( 'otw-bm-grid' );
    wp_enqueue_style( 'otw-bm-custom' );

  }

  public function otw_bm_get_posts () {
    // Load $templateOptions - array
    include('include' . DS . 'content.php');

    $otw_bm_options = $this->otwBMQuery->getItemById( otw_get( 'post_id', '' ) );
    $otw_bm_results = $this->otwBMQuery->getPosts( $otw_bm_options, otw_get( 'page', '' ) );
    $paginationPageNo = (int) otw_get( 'page', '' ) + 1;

    if( !empty($otw_bm_results->posts) ) {
      echo $this->otwDispatcher->generateTemplate( $otw_bm_options, $otw_bm_results, $templateOptions, true, $paginationPageNo );
    } else {
      echo ' ';  
    }
    exit;
  }

  public function otw_bm_social_share () {
    include( 'social-shares.php' );

    if( otw_post( 'url', false )  && otw_post( 'url', '' ) != '' && filter_var(otw_post( 'url', '' ), FILTER_VALIDATE_URL)){
      $url = otw_post( 'url', '' );
      $otw_social_shares = new otw_social_shares($url);
      
      echo $otw_social_shares->otw_get_shares();
    } else {
      echo json_encode(array('info' => 'error', 'msg' => 'URL is not valid!'));
    }
    exit;
  }
  
	public function redirect( $location ){
		
		header("Location: $location" );
		
		return true;
	}
	
	public function get_select2_options(){
	
		$options = array();
		$options['results'] = array();
		
		$options_type = '';
		$options_limit = 100;
		
		if( otw_post( 'otw_options_type', false ) ){
			$options_type = otw_post( 'otw_options_type', '' );
		}
		
		if( otw_post( 'otw_options_limit', false ) ){
			$options_limit = otw_post( 'otw_options_limit', '' );
		}
		
		switch( $options_type ){
			
			case 'category':
					$args = array();
					$args['hide_empty']      = 0;
					$args['number']          = $options_limit;
					
					if( otw_post( 'otw_options_ids', false ) && strlen( otw_post( 'otw_options_ids', '' ) ) ){
						
						$args['include'] = array();
						$include_items = explode( ',', otw_post( 'otw_options_ids', '' ) );
						
						foreach( $include_items as $i_item ){
							
							if( intval( $i_item ) ){
								$args['include'][] = $i_item;
							}
						}
					}
					
					if( otw_post( 'otw_options_search', false ) && strlen( otw_post( 'otw_options_search', '' ) ) ){
						$args['search'] = urldecode( otw_post( 'otw_options_search', '' ) );
					}
					
					$all_items = get_categories( $args );
					
					if( is_array( $all_items ) && count( $all_items ) ){
						foreach( $all_items as $item ){
							$o_key = count( $options['results'] );
							$options['results'][ $o_key ] = array();
							$options['results'][ $o_key ]['id'] = $item->term_id;
							$options['results'][ $o_key ]['text'] = $item->name;
						}
					}
				break;
			case 'tag':
					$args = array();
					$args['hide_empty']      = 0;
					$args['number']          = $options_limit;
					
					if( otw_post( 'otw_options_ids', false ) && strlen( otw_post( 'otw_options_ids', '' ) ) ){
						
						$args['include'] = array();
						$include_items = explode( ',', otw_post( 'otw_options_ids', '' ) );
						
						foreach( $include_items as $i_item ){
							
							if( intval( $i_item ) ){
								$args['include'][] = $i_item;
							}
						}
					}
					
					if( otw_post( 'otw_options_search', false ) && strlen( otw_post( 'otw_options_search', '' ) ) ){
						$args['search'] = urldecode( otw_post( 'otw_options_search', '' ) );
					}
					
					$all_items = get_tags( $args );
					
					if( is_array( $all_items ) && count( $all_items ) ){
						foreach( $all_items as $item ){
							$o_key = count( $options['results'] );
							$options['results'][ $o_key ] = array();
							$options['results'][ $o_key ]['id'] = $item->term_id;
							$options['results'][ $o_key ]['text'] = $item->name;
						}
					}
				break;
			case 'user':
					$args = array();
					
					if( otw_post( 'otw_options_ids', false ) && strlen( otw_post( 'otw_options_ids', '' ) ) ){
						
						$args['include'] = array();
						$include_items = explode( ',', otw_post( 'otw_options_ids', '' ) );
						
						foreach( $include_items as $i_item ){
							
							if( intval( $i_item ) ){
								$args['include'][] = $i_item;
							}
						}
					}
					
					if( otw_post( 'otw_options_search', false ) && strlen( otw_post( 'otw_options_search', '' ) ) ){
						$args['search'] = '*'.urldecode( otw_post( 'otw_options_search', '' ) ).'*';
					}
					
					$all_items = get_users( $args );
					
					if( is_array( $all_items ) && count( $all_items ) ){
						foreach( $all_items as $item ){
							$o_key = count( $options['results'] );
							$options['results'][ $o_key ] = array();
							$options['results'][ $o_key ]['id'] = $item->ID;
							$options['results'][ $o_key ]['text'] = $item->user_login;
						}
					}
				break;
			case 'page':
					$args = array();
					$args['post_type'] = 'page';
					$args['number']          = $options_limit;
					
					if( otw_post( 'otw_options_ids', false ) && strlen( otw_post( 'otw_options_ids', '' ) ) ){
						
						$args['post__in'] = array();
						$include_items = explode( ',', otw_post( 'otw_options_ids', '' ) );
						
						foreach( $include_items as $i_item ){
							
							if( intval( $i_item ) ){
								$args['post__in'][] = $i_item;
							}
						}
					}
					
					if( otw_post( 'otw_options_search', false ) && strlen( otw_post( 'otw_options_search', '' ) ) ){
						$args['s'] = urldecode( otw_post( 'otw_options_search', '' ) );
					}
					
					$query = new WP_Query( $args );
					$all_items = $query->posts;
					
					if( is_array( $all_items ) && count( $all_items ) ){
						foreach( $all_items as $item ){
							$o_key = count( $options['results'] );
							$options['results'][ $o_key ] = array();
							$options['results'][ $o_key ]['id'] = $item->ID;
							$options['results'][ $o_key ]['text'] = $item->post_title;
						}
					}
				break;
		}
		
		echo json_encode( $options );
		die;
	}
	
	function factory_message( $params ){
		
		global $otw_bml_plugin_id;
		
		if( isset( $params['plugin'] ) && $otw_bml_plugin_id == $params['plugin'] ){
			
			//filter out some messages if need it
		}
		if( isset( $params['message'] ) )
		{
			return $params['message'];
		}
		return $params;
	}

} // End OTWBlogManager Class

} // End IF Class Exists

// DB Query
require_once( 'classes' . DS . 'otw_bm_query.php' );

// Template Dispatcher
require_once( 'classes' . DS . 'otw_dispatcher.php' );

// Custom CSS
require_once( 'classes' . DS . 'otw_css.php' );

// Add Image Crop Functionality
require_once( 'classes' . DS . 'otw_image_crop.php' );

// Register Widgets
require_once( 'classes' . DS . 'otw_blog_manager_widgets.php' );

// Register VC add on
require_once( 'classes' . DS . 'otw_blog_manager_vc_addon.php' );

$otwBlogMangerPlugin = new OTWBlogManagerLight();

?>