<?php
$popupId = !empty($_GET['post']) ? (int)$_GET['post'] : 0;
$editorModeJs = htmlentities('text/javascript');
$editorModeCss = htmlentities('text/css');

$defaultData = ConfigDataHelper::defaultData();
$jsDefaultData = $defaultData['customEditorContent']['js'];
$cssDefaultData = $defaultData['customEditorContent']['css'];

$savedData = get_post_meta($popupId , 'sg_popup_scripts', true);
?>

<div class="sgpb-wrapper sgpb-customJsOrCss">
	<p class="sgpb-customJsOrCss_text"><?php _e('This section is for adding custom codes (CSS or JS) for the popup, it requires some coding knowledge', SG_POPUP_TEXT_DOMAIN);?>.</p>
	<p class="sgpb-customJsOrCss_text"><?php _e('You may use your custom codes for extra actions connected to the popup opening (before, after, etc.) in the fields below', SG_POPUP_TEXT_DOMAIN);?>.</p>
	<!-- editor buttons -->
	<div class="sgpb-tabs sgpb-margin-y-30">
		<span class="sgpb-tab-link sgpb-tab-active sgpb-tab-1" onclick="SGPBBackend.prototype.changeTab(1)">JS</span>
		<span class="sgpb-tab-link sgpb-tab-2" onclick="SGPBBackend.prototype.changeTab(2)">CSS</span>
	</div>

	<div class="sgpb-editor sgpb-tabs-content">
		<!-- JS editor content -->
		<div id="sgpb-editor-options-tab-content-wrapper-1" class="sgpb-editor-options-tab-content-wrapper sgpb-padding-right-40 sgpb-margin-y-20" style="display: block;">
			<?php
				foreach ($jsDefaultData['description'] as $text) { ?>
					<p><?php echo $text; ?></p>
				<?php }
			?>

			<?php foreach ($jsDefaultData['helperText'] as $key => $value) {?>
					<div class="formItem"><span class="formItem__title"><?php echo $value; ?></span>
						<textarea   class="wp-editor-area formItem__textarea sgpb-margin-top-20"
									data-attr-event="<?php echo $key; ?>"
									placeholder=" #... type your code"
									mode="<?php echo $editorModeJs; ?>"
									name="sgpb-<?php echo $key; ?>"><?php
									if (!empty($savedData['js']['sgpb-'.$key])) {
											echo $savedData['js']['sgpb-'.$key];
										}
									?></textarea>
					</div>
			<?php } ?>
		</div>

		<!-- CSS editor content -->
		<div id="sgpb-editor-options-tab-content-wrapper-2" class="sgpb-editor-options-tab-content-wrapper sgpb-padding-right-40 sgpb-margin-y-20" style="display: none;">
			<?php
				foreach ($cssDefaultData['description'] as $text) { ?>
					<div><?php echo $text; ?></div>
			<?php } ?>

			<?php foreach ($cssDefaultData['helperText'] as $key => $value) {?>
					<div class="formItem"><span class="formItem__title"><?php echo $value; ?></span></div>
			<?php } ?>

			<textarea class="wp-editor-area editor-content sgpb-editor-content-css formItem__textarea sgpb-margin-top-20"
				placeholder=" #... type your code"
				mode="<?php echo $editorModeCss; ?>"
				name="sgpb-css-editor"><?php
				if (isset($savedData['css'])) {
					echo $savedData['css'];
				}?></textarea>
		</div>
	</div>
</div>
