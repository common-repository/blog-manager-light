<?php
	$writableCssError = $this->check_writing( SKIN_BML_PATH );
	
	$selectOptionData = array(
		array( 'value' => 0, 'text'	=> '------' ),
		array( 'value' => '1-column', 'text' => esc_html__('Grid - Blog 1 Column', OTW_BML_TRANSLATION) ),
		array( 'value' => '4-column', 'text' => esc_html__('Grid - Blog 4 Columns', OTW_BML_TRANSLATION) ),
		array( 'value' => '1-column-lft-img', 'text' => esc_html__('Image Left - Blog 1 Column', OTW_BML_TRANSLATION) ),
		array( 'value' => 'widget-lft', 'text' => esc_html__('Widget Style - Image Left', OTW_BML_TRANSLATION) ),
		array( 'value' => 'timeline', 'text' => esc_html__('Timeline', OTW_BML_TRANSLATION) ),
		array( 'value' => 'slider', 'text' => esc_html__('Slider', OTW_BML_TRANSLATION) ),
		array( 'value' => '3-column-carousel', 'text' => esc_html__('Carousel - 3 Columns', OTW_BML_TRANSLATION) )
	);

	$selectPaginationData = array(
		array( 'value' => '0', 'text' => esc_html__('None (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => 'pagination', 'text' => esc_html__('Standard Pagination', OTW_BML_TRANSLATION) )
	);	

	$selectSocialData = array(
		array( 'value' => '0', 'text' => esc_html__('None (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => 'share_icons', 'text' => esc_html__('Share Icons', OTW_BML_TRANSLATION) ),
		array( 'value' => 'share_btn_small', 'text' => esc_html__('Share Buttons Small', OTW_BML_TRANSLATION) ),
		array( 'value' => 'share_btn_large', 'text' => esc_html__('Share Buttons Large', OTW_BML_TRANSLATION) ),
		array( 'value' => 'like_buttons', 'text' => esc_html__('Like Buttons', OTW_BML_TRANSLATION) ),
	);	

	$selectOrderData = array(
		array( 'value' => 'date_desc', 'text' => esc_html__('Latest Created (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => 'date_asc', 'text' => esc_html__('Oldest Created', OTW_BML_TRANSLATION) ),
		array( 'value' => 'modified_desc', 'text' => esc_html__('Latest Modified', OTW_BML_TRANSLATION) ),
		array( 'value' => 'modified_asc', 'text' => esc_html__('Oldest Modified', OTW_BML_TRANSLATION) ),
		array( 'value' => 'title_asc', 'text' => esc_html__('Alphabetically: A-Z', OTW_BML_TRANSLATION) ),
		array( 'value' => 'title_desc', 'text' => esc_html__('Alphabetically: Z-A', OTW_BML_TRANSLATION) ),
	);

	$selectHoverData = array(
		array( 'value' => 'hover-none', 'text' => esc_html__('None', OTW_BML_TRANSLATION) ),
		array( 'value' => 'hover-style-1-full', 'text' => esc_html__('Full (default)', OTW_BML_TRANSLATION) )
	);

	$selectIconData = array(
		array( 'value' => 0, 'text' => esc_html__('None (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-expand', 'text' => esc_html__('Icon Expand', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-youtube-play', 'text' => esc_html__('Icon YouTube Play', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-file', 'text' => esc_html__('Icon File', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-book', 'text' => esc_html__('Icon Book', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-check-sign', 'text' => esc_html__('Icon Check Sign', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-comments', 'text' => esc_html__('Icon Comments', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-ok-sign', 'text' => esc_html__('Icon OK Sign', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-zoom-in', 'text' => esc_html__('Icon Zoom In', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-thumbs-up-alt', 'text' => esc_html__('Icon Thumbs Up Alt', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-plus-sign', 'text' => esc_html__('Icon Plus Sign', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-cloud', 'text' => esc_html__('Icon Cloud', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-chevron-sign-right', 'text' => esc_html__('Icon Chevron Sign Right', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-hand-right', 'text' => esc_html__('Icon Hand Right', OTW_BML_TRANSLATION) ),
		array( 'value' => 'icon-fullscreen', 'text' => esc_html__('Icon Fullscreen', OTW_BML_TRANSLATION) ),
	);
	
	$selectLinkData = array(
		array( 'value' => 'single', 'text' => esc_html__('Single Post (default)', OTW_BML_TRANSLATION) )
	);

	$selectMetaData = array(
		array( 'value' => 'horizontal', 'text' => esc_html__('Horizontal (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => 'vertical', 'text' => esc_html__('Vertical', OTW_BML_TRANSLATION) ),
	);

	$selectSliderAlignmentData = array(
		array( 'value' => 'left', 'text' => esc_html__('Left (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => 'center', 'text' => esc_html__('Center', OTW_BML_TRANSLATION) ),
		array( 'value' => 'right', 'text' => esc_html__('Right', OTW_BML_TRANSLATION) ),
	);

	$selectMosaicData = array(
		array( 'value' => 'full', 'text' => esc_html__('Full Content on Hover (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => 'slide', 'text' => esc_html__('Slide Content on Hover', OTW_BML_TRANSLATION) ),
	);

	$selectFontSizeData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => '8', 'text' => '8px' ),
		array( 'value' => '10', 'text' => '10px' ),
		array( 'value' => '12', 'text' => '12px' ),
		array( 'value' => '14', 'text' => '14px' ),
		array( 'value' => '16', 'text' => '16px' ),
		array( 'value' => '18', 'text' => '18px' ),
		array( 'value' => '20', 'text' => '20px' ),
		array( 'value' => '22', 'text' => '22px' ),
		array( 'value' => '24', 'text' => '24px' ),
		array( 'value' => '26', 'text' => '26px' ),
		array( 'value' => '28', 'text' => '28px' ),
		array( 'value' => '30', 'text' => '30px' ),
		array( 'value' => '32', 'text' => '32px' ),
		array( 'value' => '34', 'text' => '34px' ),
		array( 'value' => '36', 'text' => '36px' ),
		array( 'value' => '38', 'text' => '38px' ),
		array( 'value' => '40', 'text' => '40px' ),
	);

	$selectFontStyleData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => 'regular', 'text' => esc_html__('Regular', OTW_BML_TRANSLATION) ),
		array( 'value' => 'bold', 'text' => esc_html__('Bold', OTW_BML_TRANSLATION) ),
		array( 'value' => 'italic', 'text' => esc_html__('Italic', OTW_BML_TRANSLATION) ),
		array( 'value' => 'bold_italic', 'text' => esc_html__('Bold and Italic', OTW_BML_TRANSLATION) ),
	);

	$selectViewTargetData = array(
		array( 'value' => '_self', 'text' => esc_html__('Same Window / Tab (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => '_blank', 'text' => esc_html__('New Window / Tab', OTW_BML_TRANSLATION) ),
	);

	$selectCategoryTagRelation = array(
		array( 'value' => 'OR', 'text' => esc_html__('categories OR tags (default)', OTW_BML_TRANSLATION) ),
		array( 'value' => 'AND', 'text' => esc_html__('categories AND tags', OTW_BML_TRANSLATION) )
	);
	
	$js_template_options = array();
	
	if( isset( $templateOptions ) && is_array( $templateOptions ) ){
		
		foreach( $templateOptions as $t_option ){
			$js_template_options[ $t_option['name'] ] = $t_option;
		}
	}
?>


<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2>
		<?php
			if( empty($this->errors) && !empty($content['list_name']) ) {
				echo __( 'Edit Blog List', OTW_BML_TRANSLATION ); 	
			} else {
				echo __( 'Create New Blog List', OTW_BML_TRANSLATION );
			}
		?>
		<a class="add-new-h2" href="admin.php?page=otw-bml"><?php esc_html_e('Back', OTW_BML_TRANSLATION);?></a>
	</h2>
	<?php include_once( 'otw_blog_manager_help.php' );?>
	<?php
		if( $writableCssError ) {
			$message = esc_html__('The folder \''.SKIN_BML_PATH.'\' is not writable. Please make sure you add read/write permissions to this folder.', 'otw_bml');
			 echo '<div class="error"><p>'.$message.'</p></div>';
		}
	?>
	<?php
	if( !empty( otw_get( 'success', '' ) ) && otw_get( 'success', '' ) == 'true' ) {
			$message = esc_html__('Item was saved.', OTW_BML_TRANSLATION);
			echo '<div class="updated"><p>'.$message.'</p></div>';
	}
	?>
	<form name="otw-bm-list" method="post" action="" class="validate">

		<input type="hidden" name="id" value="<?php echo esc_attr( $nextID );?>" />
		<input type="hidden" name="edit" value="<?php echo esc_attr( $edit );?>" />
		<input type="hidden" name="date_created" value="<?php echo esc_attr( $content['date_created'] );?>" />
		<input type="hidden" name="user_id" value="<?php echo esc_attr( get_current_user_id() );?>" />

		<?php
			if( !empty($this->errors) ){
				$errorMsg = esc_html__('Oops! Please check form for errors.', OTW_BML_TRANSLATION);
				echo '<div class="error"><p>'.$errorMsg.'</p></div>';
			}
		?>
		<script type="text/javascript">
		<?php
			
			echo 'var js_template_options='.json_encode( $js_template_options ).';'
		?>
		</script>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="list_name" class="required"><?php esc_html_e('Blog List Name', OTW_BML_TRANSLATION);?></label></th>
					<td>
						<input type="text" name="list_name" id="list_name" size="53" value="<?php echo esc_attr( $content['list_name'] );?>" />
						<p class="description"><?php esc_html_e( 'Note: The List Name is going to be used ONLY for the admin as a reference.', OTW_BML_TRANSLATION);?></p>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['list_name']) )? $errorMessage = $this->errors['list_name'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>				
				<tr valign="top">
					<th scope="row"><label for="template" class="required"><?php esc_html_e('Choose Template', OTW_BML_TRANSLATION);?></label></th>
					<td>
						<select id="template" name="template" class="js-template-style">
						<?php 
						foreach( $selectOptionData as $optionData ): 
							$selected = '';
							if( $optionData['value'] === $content['template'] ) {
								$selected = 'selected="selected"';
							}
							echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
							
						endforeach;
						?>
						</select>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['template']) )? $errorMessage = $this->errors['template'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="categories"><?php esc_html_e('Categories:', OTW_BML_TRANSLATION);?></label>
					</th>
					<td>
						<?php 
								$categoriesCount 	= wp_count_terms( 'category', array( 'number' => '', 'hide_empty' => false  ) );
								$categoriesStatus = 'otw-admin-hidden';
								$categoriesAll 		= '';
								$categoriesInput 	= '';
								if( !empty($content['select_categories']) ) {
									$categoriesStatus = '';
									$categoriesAll = 'checked="checked"';
									$categoriesInput = 'disabled="disabled"';
								}
						?>
						<select name="categories[]" id="categories" class="js-categories" multiple="multiple" data-value="<?php echo esc_attr( $content['categories'] );?>" <?php echo $categoriesInput ?>></select><br />
						- OR - <br/>
						<input type="hidden" name="all_categories" class="js-categories-select" value="<?php echo esc_attr( $content['all_categories'] );?>" />
						<input type="checkbox" name="select_categories" value="1" data-size="<?php echo esc_attr( $categoriesCount );?>"  class="js-select-categories" id="select_all_categories" data-section="categories" <?php echo $categoriesAll;?> />
						<label for="select_all_categories">
							<?php esc_html_e('Select All', OTW_BML_TRANSLATION);?>
							<span class="js-categories-count <?php echo $categoriesStatus; ?>">
								(
								<span class="js-categories-counter"><?php echo esc_html( $categoriesCount );?></span>
								<?php esc_html_e(' categories selected', OTW_BML_TRANSLATION);?>
								)
							</span>
						</label>
						<p class="description"><?php esc_html_e( 'Choose categories to include posts from those categories in your list or use the Select all checkbox to include posts from all categories.', OTW_BML_TRANSLATION);?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="tags"><?php esc_html_e('Tags:', OTW_BML_TRANSLATION);?></label>
					</th>
					<td>
						<?php 
								$tagsCount 	= wp_count_terms( 'post_tag', array( 'number' => '', 'hide_empty' => false  ) );
								$tagsStatus = 'otw-admin-hidden';
								$tagsAll 		= '';
								$tagsInput 	= '';
								if( !empty($content['select_tags']) ) {
									$tagsStatus = '';
									$tagsAll = 'checked="checked"';
									$tagsInput = 'disabled="disabled"';
								}
						?>
						<select name="tags[]" id="tags" class="js-tags" multiple="multiple" data-value="<?php echo esc_attr( $content['tags'] );?>" <?php echo $tagsInput;?>></select><br />
						- OR - <br/>
						<input type="hidden" name="all_tags" class="js-tags-select" value="<?php echo esc_attr( $content['all_tags'] );?>" />
						<input type="checkbox" name="select_tags" value="1" data-size="<?php echo esc_attr( $tagsCount );?>" class="js-select-tags" id="select_all_tags" data-section="tags" <?php echo $tagsAll;?>/>
						<label for="select_all_tags">
							<?php esc_html_e('Select All', OTW_BML_TRANSLATION); ?>
							<span class="js-tags-count <?php echo $tagsStatus;?>">
								(
								<span class="js-tags-counter"><?php echo esc_html( $tagsCount );?></span>
								<?php esc_html_e(' tags selected', OTW_BML_TRANSLATION);?>
								)
							</span>
						</label>
						<p class="description"><?php esc_html_e( 'Choose tags to include posts from those tags in your list or use the Select all checkbox to include posts from all tags.', OTW_BML_TRANSLATION);?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="authors"><?php esc_html_e('Post Author:', OTW_BML_TRANSLATION);?></label>
					</th>
					<td>
						<?php 
								$count_users = count_users();
								$usersCount = $count_users['total_users'];
								$usersStatus = 'otw-admin-hidden';
								$usersAll 		= '';
								$usersInput 	= '';
								if( !empty($content['select_users']) ) {
									$usersCount = count( explode( ',', $content['all_users']) );
									$usersStatus = '';
									$usersAll = 'checked="checked"';
									$usersInput = 'disabled="disabled"';
								}
						?>
						<select name="users[]" id="users" class="js-users" multiple="multiple" data-value="<?php echo esc_attr( $content['users'] );?>" <?php echo $usersInput ?>></select><br />
						- OR - <br/>
						<input type="hidden" name="all_users" class="js-users-select" value="<?php echo esc_attr( $content['all_users'] );?>" />
						<input type="checkbox" name="select_users" value="1" data-size="<?php echo esc_attr( $usersCount ); ?>" class="js-select-users" id="select_all_users" data-section="users" <?php echo $usersAll;?>/>
						<label for="select_all_users">
							<?php esc_html_e('Select All', OTW_BML_TRANSLATION); ?>
							<span class="js-users-count <?php echo $usersStatus; ?>">
								(
								<span class="js-users-counter"><?php echo esc_html( $usersCount ); ?></span>
								<?php esc_html_e(' authors selected', OTW_BML_TRANSLATION);?>
								)
							</span>
						</label>
						<p class="description"><?php esc_html_e( 'Choose authors to include posts from those authors in your list or use the Select all checkbox to include posts from all authors.', OTW_BML_TRANSLATION);?></p>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['content']) )? $errorMessage = $this->errors['content'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>

			</tbody>
		</table>

		<div class="accordion-container">
			<ul class="outer-border">
				
				<!-- List Elements and Order -->
				<li class="control-section accordion-section  add-page top">
					<h3 class="accordion-section-title hndl" tabindex="0" title="<?php esc_html_e('List Elements and Order', OTW_BML_TRANSLATION);?>"><?php esc_html_e('List Elements and Order', OTW_BML_TRANSLATION);?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th scope="row">
											<label for="meta_order"><?php esc_html_e('Blog List Items', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<div class="active_elements">
												<h3><?php esc_html_e('Active Elements', OTW_BML_TRANSLATION);?></h3>
												<input type="hidden" name="blog-items" class="js-blog-items" value="<?php echo ( !empty( $content['blog-items'] ) )?$content['blog-items']:'';?>"/>
												<ul id="meta-active" class="b-bl-box js-bl-active">
												</ul>
											</div>
											<div class="inactive_elements">
												<h3><?php esc_html_e('Inactive Elements', OTW_BML_TRANSLATION);?></h3>
												<ul id="meta-inactive" class="b-bl-box js-bl-inactive">
													<li data-item="main" data-value="media" class="b-bl-items js-bl--item"><?php esc_html_e('Media', OTW_BML_TRANSLATION);?></li>
													<li data-item="main" data-value="title" class="b-bl-items js-bl--item"><?php esc_html_e('Title', OTW_BML_TRANSLATION);?></li>
													<li data-item="main" data-value="meta" class="b-bl-items js-bl--item"><?php esc_html_e('Meta', OTW_BML_TRANSLATION);?></li>
													<li data-item="main" data-value="description" class="b-bl-items js-bl--item"><?php esc_html_e('Description / Excerpt', OTW_BML_TRANSLATION);?></li>
													<li data-item="main" data-value="continue-reading" class="b-bl-items js-bl--item"><?php esc_html_e('Continue Reading', OTW_BML_TRANSLATION);?></li>
												</ul>
											</div>
											<p class="description">
												<?php esc_html_e('Drag & drop the items that you\'d like to show in the Active Elements area on the left. Arrange them however you want to see them in your list.', OTW_BML_TRANSLATION);?>
											</p>
											<p class="description">
												<?php esc_html_e('The setting will not affect the following templates: Slider, Carousel, Widget Style, Carousel Widget', OTW_BML_TRANSLATION); ?>
											</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="show-pagination"><?php esc_html_e('Show Pagination', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											
										<select id="show-pagination" name="show-pagination">
											<?php 
											foreach( $selectPaginationData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['show-pagination'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description">
												<?php esc_html_e('Choose pagination type for your template.', OTW_BML_TRANSLATION); ?><br/>
												<strong><?php esc_html_e('Note:', OTW_BML_TRANSLATION);?></strong><br/>
												<?php esc_html_e('Widget Style templates support only Load More Pagination.', OTW_BML_TRANSLATION); ?><br/>
												<?php esc_html_e('Slider templates do not support pagination.', OTW_BML_TRANSLATION); ?><br/>
												<?php esc_html_e('Timeline template will have the Infinite Scroll by default.', OTW_BML_TRANSLATION); ?>
											</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="show-delimiter"><?php esc_html_e('Show Delimiter', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-delimiter'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-delimiter" id="show-delimiter-no" value="0" <?php echo $no;?> /> 
											<label for="show-delimiter-no"><?php esc_html_e('No (default)', OTW_BML_TRANSLATION);?></label>

											<input type="radio" name="show-delimiter" id="show-delimiter-yes" value="1" <?php echo $yes;?> /> 
											<label for="show-delimiter-yes"><?php esc_html_e('Yes', OTW_BML_TRANSLATION);?></label>
											<p class="description"><?php esc_html_e('Enable 1px line after post.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END List Elements and Order -->

				<!-- Post Order and Limits -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="1" title="<?php esc_html_e('Posts Order and Limits', OTW_BML_TRANSLATION);?>"><?php esc_html_e('Posts Order and Limits', OTW_BML_TRANSLATION);?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="posts_limit"><?php esc_html_e('Number of Posts in the List:', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<input type="text" name="posts_limit" id="posts_limit" value="<?php echo esc_attr( $content['posts_limit'] );?>" />
											<p class="description"><?php esc_html_e('Please leave empty for all posts.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="posts_limit_skip"><?php esc_html_e('Number of Posts to Skip:', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<input type="text" name="posts_limit_skip" id="posts_limit_skip" value="<?php echo esc_attr( $content['posts_limit_skip'] );?>" />
											<p class="description"><?php esc_html_e('By default this field is empty which means no posts will be skipped.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="posts_limit_page"><?php esc_html_e('Number of Posts per Page:', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<input type="text" name="posts_limit_page" id="posts_limit_page" value="<?php echo esc_attr( $content['posts_limit_page'] );?>" />
											<p class="description"><?php esc_html_e('Show pagination should be ebabled in the section above in order for this option to work.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="posts_order"><?php esc_html_e('Order of Posts:', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<select name="posts_order" id="posts_order">
											<?php 
											foreach( $selectOrderData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['posts_order'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description"><?php esc_html_e('Choose the order of the posts in the list. Timeline Template will ignore this selection and use Latest Created.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END Post Order and Limits -->

				<!-- Settings -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="2" title="<?php esc_html_e('Settings', OTW_BML_TRANSLATION);?>"><?php esc_html_e('Settings', OTW_BML_TRANSLATION);?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="excerpt_length"><?php esc_html_e('Excerpt Length:', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<input type="text" name="excerpt_length" id="excerpt_length" value="<?php echo ( !empty( $content['excerpt_length'] )? $content['excerpt_length']: '' );?>" size="53"/>
											<p class="description"><?php esc_html_e('Excerpt is pulled from excerpt field for each post. If excerpt fields is empty excerpt is pulled from the text area (the post editor). If Excerpt length is empty or 0 this means pull the entire text.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="image_link"><?php esc_html_e('Click on Image Links to?', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<select name="image_link" id="image_link">
											<?php 
											foreach( $selectLinkData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['image_link'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>									
											<p class="description"><?php esc_html_e('Choose where a click on the image links to.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="title_link"><?php esc_html_e('Click on Title Links to?', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<select name="title_link" id="title_link">
											<?php 
											foreach( $selectLinkData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['title_link'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>									
											<p class="description"><?php esc_html_e('Choose where a click on the title links to.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="image_hover"><?php esc_html_e('Hover Effect', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<select name="image_hover" id="image_hover">
											<?php 
											foreach( $selectHoverData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['image_hover'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>									
											<p class="description"><?php esc_html_e('Choose the hover for the images in the posts list.', OTW_BML_TRANSLATION);?></p>
											<p class="description">
												<?php esc_html_e('The setting will not affect the following templates since they have their own specific hovers: Slider, Carousel.', OTW_BML_TRANSLATION); ?> 
											</p>
											<p class="description">
												<?php esc_html_e('Widget Templates support only Full and None hover options.', OTW_BML_TRANSLATION); ?> 
											</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_width"><?php esc_html_e('Thumbnail Width', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_width']) )? $thumbWidth = '' : $thumbWidth = $content['thumb_width']; ?>
											<input type="text" name="thumb_width" id="thumb_width" size="3" value="<?php echo esc_attr( $thumbWidth );?>" />
											<p class="description"><?php esc_html_e('The width for your thumbnails in px. If left empty the default value will be used. Default value for the selected template is: ', OTW_BML_TRANSLATION);?><span class="default_thumb_width"></span></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_height"><?php esc_html_e('Thumbnail Height', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_height']) )? $thumbHeight = '' : $thumbHeight = $content['thumb_height']; ?>
											<input type="text" name="thumb_height" id="thumb_height" size="3" value="<?php echo esc_attr( $thumbHeight );?>" />
											<p class="description"><?php esc_html_e('The height for your thumbnails in px. If left empty the default value will be used. Default value for the selected template is: ', OTW_BML_TRANSLATION);?><span class="default_thumb_height"></span></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_crop"><?php esc_html_e('Thumnail Crop', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_crop']) )? $thumbCrop = '' : $thumbCrop = $content['thumb_crop']; ?>
											<select name="thumb_crop" id="thumb_crop">
												<option value="center_center" <?php echo ( $thumbCrop == 'center_center' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop center-center (default)', OTW_BML_TRANSLATION);?></option>
												<option value="center_left" <?php echo ( $thumbCrop == 'center_left' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop center-left', OTW_BML_TRANSLATION);?></option>
												<option value="center_right" <?php echo ( $thumbCrop == 'center_right' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop center-right', OTW_BML_TRANSLATION);?></option>
												<option value="top_center" <?php echo ( $thumbCrop == 'top_center' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop top-center', OTW_BML_TRANSLATION);?></option>
												<option value="top_left" <?php echo ( $thumbCrop == 'top_left' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop top-left', OTW_BML_TRANSLATION);?></option>
												<option value="top_right" <?php echo ( $thumbCrop == 'top_right' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop top-right', OTW_BML_TRANSLATION);?></option>
												<option value="bottom_center" <?php echo ( $thumbCrop == 'bottom_center' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop bottom-center', OTW_BML_TRANSLATION);?></option>
												<option value="bottom_left" <?php echo ( $thumbCrop == 'bottom_left' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop bottom-left', OTW_BML_TRANSLATION);?></option>
												<option value="botom_right" <?php echo ( $thumbCrop == 'bottom_right' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop bottom-right', OTW_BML_TRANSLATION);?></option>
												<option value="no" <?php echo ( $thumbCrop == 'no' )?'selected="selected"':'';?> ><?php esc_html_e( 'No cropping, resize only', OTW_BML_TRANSLATION);?></option>
											</select>
											<p class="description"><?php esc_html_e('Crop or just resize the thumbnail.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="white_spaces"><?php esc_html_e('Small Images', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<?php ( empty($content['white_spaces']) )? $whiteSpaces = 'yes' : $whiteSpaces = $content['white_spaces']; ?>
											<select name="white_spaces" id="white_spaces">
												<option value="yes" <?php echo ( $whiteSpaces != 'no' )?'selected="selected"':'';?> ><?php esc_html_e( 'Add background (default)', OTW_BML_TRANSLATION);?></option>
												<option value="no" <?php echo ( $whiteSpaces == 'no' )?'selected="selected"':'';?> ><?php esc_html_e( 'Don\'t add background', OTW_BML_TRANSLATION);?></option>
											</select>
											<p class="description"><?php esc_html_e('This option will affect only images which original size is smaller than the desired size.<br />\'Add background\' will add background to complete the image size to the desired image size. \'Don\'t add background\' will not add background and it will leave the images as they originally are.', OTW_BML_TRANSLATION);?></p>
										</td>
									</tr>
									<tr valign="top" id="white_spaces_color_container">
										<th scope="row">
											<label for="white_spaces_color"><?php esc_html_e('Image Background Color:', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<?php
												if( empty( $content['white_spaces_color'] ) ){
													$content['white_spaces_color'] = '#FFFFFF';
												}
											?>
											<div class="otw-bm-color-picker">
												<div class="js-color-picker-icon js-color-picker">
													<div class="js-color-container" style="background-color: <?php echo $content['white_spaces_color'];?>;"></div>
												</div>
												<input type="text" name="white_spaces_color" class="js-color-picker-value" value="<?php echo esc_attr( $content['white_spaces_color'] );?>"/>
											</div>
											<!-- END Excpert Font Color -->
											<p class="description"><?php esc_html_e('The extra background color to complete the image to the desired size.', OTW_BML_TRANSLATION); ?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END Settings -->


				<!-- Style Tab -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="4" title="<?php esc_html_e('Styles', OTW_BML_TRANSLATION);?>"><?php esc_html_e('Styles', OTW_BML_TRANSLATION);?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="blog_list_title"><?php esc_html_e('Custom CSS:', OTW_BML_TRANSLATION);?></label>
										</th>
										<td>
											<textarea name="custom_css" cols="70" rows="10"><?php echo str_replace('\\', '', $content['custom_css']);?></textarea>
										</td>
									</tr>

								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
			</ul><!-- .outer-border -->
			
		</div>

		<p class="submit">
			<input type="submit" value="<?php esc_html_e( 'Save', OTW_BML_TRANSLATION) ?>" name="submit-otw-bm" class="button button-primary button-hero"/>
		</p>

	</form>

<div class="live_preview js-preview"></div>