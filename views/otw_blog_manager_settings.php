<?php
	global $otw_bml_plugin_id;
	
	$otw_bm_plugin_options = array();
	
	$otw_bm_plugin_options['otw_bm_promotions'] = get_option( $otw_bml_plugin_id.'_dnms' );
	
	if( empty( $otw_bm_plugin_options['otw_bm_promotions'] ) ){
		$otw_bm_plugin_options['otw_bm_promotions'] = 'on';
	}
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2><?php esc_html_e('Blog List Settings', 'otw_bml'); ?></h2>
  <?php
    if( $writableCssError ) {
      $message = esc_html__('The file \''.SKIN_BML_PATH.'custom.css\' is not writable. Please make sure you add read/write permissions to this file.', 'otw_bml');
      echo '<div class="error"><p>'.$message.'</p></div>';
    }

  ?>
	<?php include_once( 'otw_blog_manager_help.php' );?>
	<?php
		if( !empty( otw_get( 'success_css', '' ) ) && otw_get( 'success_css', '' ) == 'true' ) {
			$message = esc_html__('Plugin settings have been updated.', OTW_BML_TRANSLATION);
			echo '<div class="updated"><p>'.$message.'</p></div>';
		}
	?>
	<form name="otw-bm-list-style" method="post" action="" class="validate">
		<div class="otw_bm_sp_settings">
			<table class="form-table">
				<tr>
					<th>
						<label for="otw_bm_promotions"><?php esc_html_e('Show OTW Promotion Messages in my WordPress admin', 'otw_bml'); ?></label>
						<select id="otw_bm_promotions" name="otw_bm_promotions">
							<option value="on" <?php echo ( isset( $otw_bm_plugin_options['otw_bm_promotions'] ) && ( $otw_bm_plugin_options['otw_bm_promotions'] == 'on' ) )? 'selected="selected"':''?>>on(default)</option>
							<option value="off"<?php echo ( isset( $otw_bm_plugin_options['otw_bm_promotions'] ) && ( $otw_bm_plugin_options['otw_bm_promotions'] == 'off' ) )? 'selected="selected"':''?>>off</option>
						</select>
					</th>
				</tr>
			</table>
		</div>
		<p class="description"><?php esc_html_e('Adjust your own CSS for all of your Blog Lists. Please use with caution.', 'otw_bml'); ?></p>
		<textarea name="otw_css" cols="100" rows="35"><?php echo otw_esc_text( $customCss, 'cont' );?></textarea>
		<p class="submit">
			<input type="submit" value="<?php esc_html_e( 'Save', 'otw_bml') ?>" name="submit" class="button button-primary button-hero"/>
		</p>
	</form>

</div>