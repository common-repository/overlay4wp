<?php
/*
Plugin Name: Overlay4WP
Plugin URI: http://wordpress.org/extend/plugins/overlay4wp/
Description: This plugin allows you easily to make <a href="http://flowplayer.org/tools/demos/overlay/gallery.html">Overlay gallery</a> popups on WordPress.Modify on <a href="http://wordpress.org/extend/plugins/highslide4wp/">Highslide4WP</a>.
Version: 1.0.3
Overlay Version: tools.overlay 1.1.2 + Overlay Gallery plugin + tools.overlay "Apple Effect" 1.0.1
Author: bolo
Author URI: http://imbolo.com/
*/

/** l10n */
load_plugin_textdomain('overlay4wp', "/wp-content/plugins/overlay4wp/languages/");

function overlay_head_admin() {
	if (function_exists('wp_list_comments')) {
		print('<link rel="stylesheet" href="'.get_bloginfo('wpurl').'/wp-content/plugins/overlay4wp/css/admin_27.css" type="text/css" />');
	} else {
		print('<link rel="stylesheet" href="'.get_bloginfo('wpurl').'/wp-content/plugins/overlay4wp/css/admin_26.css" type="text/css" />');
	}
	print('
<script type="text/javascript" src="'.get_bloginfo('wpurl').'/wp-content/plugins/overlay4wp/js/admin.js"></script>
<script type="text/javascript" src="'.get_bloginfo('wpurl').'/index.php?ow_action=overlay_js"></script>
	');
}

function overlay_js() {

	if (isset($_GET['ow_action']) && $_GET['ow_action'] == 'overlay_js') {
		header("Content-type: text/javascript");

		/* image START */
		$overlay_image = '<div class="overlay-box">';
		$overlay_image .= '<div class="caption">' . __('Overlay Image', 'overlay4wp') . '</div>';
		$overlay_image .= '<a class="close" href="javascript:void(0);" onclick="hideOverlayDialog();"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/overlay4wp/images/tb-close.png" alt="Cancel" /></a>';
		$overlay_image .= '<div class="content">';
		$overlay_image .= '<div>';
		$overlay_image .= '<label class="overlay-label">' . __('Thumbnail URL: (required)', 'overlay4wp') . '</label>';
		$overlay_image .= '<input id="overlay_thumbnail" class="overlay-textfield" type="text" />';
		$overlay_image .= '</div>';
		$overlay_image .= '<div>';
		$overlay_image .= '<label class="overlay-label">' . __('Fullsize URL: (required)', 'overlay4wp') . '</label>';
		$overlay_image .= '<input id="overlay_fullsize" class="overlay-textfield" type="text" />';
		$overlay_image .= '</div>';
		$overlay_image .= '<div>';
		$overlay_image .= '<label class="overlay-label">' . __('Description:', 'overlay4wp') . '</label>';
		$overlay_image .= '<textarea id="overlay_description" class="overlay-textfield" row="" col=""></textarea>';
		$overlay_image .= '<div class="bottom">';
		$overlay_image .= '<div class="buttons">';
		$overlay_image .= '<a class="button" href="javascript:void(0);" onclick="insertOverlay(\'image\');" title="Insert image with Overlay">' . __('Insert image', 'overlay4wp') . '</a>';
		$overlay_image .= '</div>';
		$overlay_image .= '<div style="clear:both;"></div>';
		$overlay_image .= '</div>';
		$overlay_image .= '<div style="clear:both;"></div>';
		$overlay_image .= '</div>';
		$overlay_image .= '<div style="clear:both;"></div>';
		$overlay_image .= '</div>';
		$overlay_image .= '</div>';
		/* image END */

		$overlay_admin = '<iframe id="overlay-panel" frameborder="0" src="'.get_bloginfo('wpurl').'/wp-content/plugins/overlay4wp/css/cushion.html"></iframe>';
		$overlay_admin .= '<div id="overlay-dialog">';
		$overlay_admin .= '<div id="overlay-image-dialog">'.$overlay_image.'</div>';
		$overlay_admin .= '</div>';
?>

function loadoverlay_26() {
	if((document.getElementById('postdiv') || document.getElementById('postdivrich')) && document.getElementById('wphead')) {

		var ow_overlayDiv = document.createElement('div');
		ow_overlayDiv.id = 'wp-overlay';
		var ow_node = document.getElementById('wphead');

		ow_overlayDiv.innerHTML = '<?php print(str_replace("'", "\'", $overlay_admin)); ?>';
		ow_node.parentNode.insertBefore(ow_overlayDiv, ow_node);

		var ow_mediaToolbar = document.getElementById('editor-toolbar');
		var ow_mediaButtons = document.getElementById('media-buttons');

		if(ow_mediaToolbar) {
			ow_mediaToolbar.className = 'overlay-<?php print(str_replace("'", "\'", $current_color)); ?>';

			// image
			var ow_image = document.createElement('a');
			var ow_imageIcon = document.createElement('img');
			ow_imageIcon.src = '<?php print(get_bloginfo('wpurl')); ?>/wp-content/plugins/overlay4wp/images/image-x-generic.gif';
			ow_imageIcon.alt = 'Image';
			ow_image.id = 'overlay-image';
			ow_image.href = 'javascript:void(0)';
			ow_image.onclick = callOverlayDialog;
			ow_image.title = 'Insert image with Overlay';
			ow_image.appendChild(ow_imageIcon);
			insertAfter(ow_image, ow_mediaButtons);

			// title
			var ow_title = document.createElement('div');
			var ow_titleText = document.createTextNode('Overlay4WP:');
			ow_title.id = 'overlay-title';
			ow_title.appendChild(ow_titleText);
			insertAfter(ow_title, ow_image);

		}

	} else {
		return;
	}
}

function loadoverlay_27() {
	if((document.getElementById('postdiv') || document.getElementById('postdivrich')) && document.getElementById('wphead')) {

		var ow_overlayDiv = document.createElement('div');
		ow_overlayDiv.id = 'wp-overlay';
		var ow_node = document.getElementById('wphead');

		ow_overlayDiv.innerHTML = '<?php print(str_replace("'", "\'", $overlay_admin)); ?>';
		ow_node.parentNode.insertBefore(ow_overlayDiv, ow_node);

		var ow_postStatus = document.getElementById('post-status-info');

		if(ow_postStatus) {

			// overlay box
			var ow_overlayBox = document.createElement('div');
			ow_overlayBox.id = 'overlay-box';
			insertAfter(ow_overlayBox, ow_postStatus);

			// fixed box
			var ow_fixedBox = document.createElement('div');
			ow_fixedBox.style.clear = 'both';
			insertAfter(ow_fixedBox, ow_overlayBox);

			// title
			var ow_title = document.createElement('div');
			var ow_titleText = document.createTextNode('Overlay4WP ');
			ow_title.id = 'overlay-title';
			ow_title.appendChild(ow_titleText);
			ow_overlayBox.appendChild(ow_title);

			// image
			var ow_image = document.createElement('a');
			var ow_imageIcon = document.createElement('img');
			ow_imageIcon.src = '<?php print(get_bloginfo('wpurl')); ?>/wp-content/plugins/overlay4wp/images/image-x-generic.gif';
			ow_imageIcon.alt = 'Image';
			ow_image.id = 'overlay-image';
			ow_image.href = 'javascript:void(0)';
			ow_image.onclick = callOverlayDialog;
			ow_image.title = 'Insert image with Overlay';
			ow_image.appendChild(ow_imageIcon);
			ow_overlayBox.appendChild(ow_image);

			// fixed box
			var ow_fixedBox = document.createElement('div');
			ow_fixedBox.style.clear = 'both';
			insertAfter(ow_fixedBox, ow_emoticon);

		}

	} else {
		return;
	}
}

function loadoverlay() {
<?php if (function_exists('wp_list_comments')) : ?>
	loadoverlay_27();
<?php else : ?>
	loadoverlay_26();
<?php endif; ?>
}

if (document.addEventListener) {
	document.addEventListener("DOMContentLoaded", loadoverlay, false);

} else if (/MSIE/i.test(navigator.userAgent)) {
	document.write('<script id="__ie_onload_for_overlay4wp" defer src="javascript:void(0);"></script>');
	var ow_script = document.getElementById("__ie_onload_for_overlay4wp");
	ow_script.onreadystatechange = function() {
		if (this.readyState == 'complete') {
			loadoverlay();
		}
	}

} else if (/WebKit/i.test(navigator.userAgent)) {
	var ow_timer = setInterval( function() {
		if (/loaded|complete/.test(document.readyState)) {
			clearInterval(ow_timer);
			loadoverlay();
		}
	}, 10);

} else {
	window.onload = function(e) {
		loadoverlay();
	}
}

<?php
		die();
	}
}

add_action('init', 'overlay_js');
add_action('admin_head', 'overlay_head_admin');

// -- options START ------------------------------------------------------------

class overlay4WPOptions {

	function getOptions() {
		$options = get_option('overlay4WP_options');
		if (!is_array($options)) {
			$options['js_type'] = '';
			$options['jquery_url'] = '';
			$options['switch_speed'] = '500';
			$options['ow_bgc'] = '#CCCCCC';
			update_option('overlay4WP_options', $options);
		}
		return $options;
	}

	function add() {
		if(isset($_POST['overlay4WP_save'])) {
			$options = overlay4WPOptions::getOptions();

			$options['js_type'] = $_POST['js_type'];
			$options['jquery_url'] = stripslashes($_POST['jquery_url']);
			$options['switch_speed'] = stripslashes($_POST['switch_speed']);
			$options['ow_bgc'] = stripslashes($_POST['ow_bgc']);

			update_option('overlay4WP_options', $options);

		} else {
			overlay4WPOptions::getOptions();
		}

		add_options_page(__('Overlay4WP', 'overlay4wp'), __('Overlay4WP', 'overlay4wp'), 10, basename(__FILE__), array('overlay4WPOptions', 'display'));
	}

	function display() {
		$options = overlay4WPOptions::getOptions();
?>

<form action="#" method="post" enctype="multipart/form-data" name="wp_recentcomments_form">
	<div class="wrap">
		<h2><?php _e('Overlay4WP Options', 'overlay4wp'); ?></h2>

<table class="form-table">
	<tr>
		<th scope="row"><big><?php _e('JavaScript Library', 'overlay4wp'); ?></big></th>
		<td>
			<label style="margin-right:20px;">
				<input name="js_type" type="radio" value="normal" <?php if($options['js_type'] != 'custom_jquery' && $options['js_type'] != 'wp_jquery') echo "checked='checked'"; ?> />
				<?php _e('Use normal JavaScript library that is supported by this plugin.', 'overlay4wp'); ?>
			</label><br />
			<label>
				<input name="js_type" type="radio" value="wp_jquery" <?php if($options['js_type'] == 'wp_jquery') echo "checked='checked'"; ?> />
				<?php _e('Use jQuery library that is supported by WordPress.', 'overlay4wp'); ?>
			</label><br />
			<label>
				<input name="js_type" type="radio" value="custom_jquery" <?php if($options['js_type'] == 'custom_jquery') echo "checked='checked'"; ?> />
				 <?php _e('Custom jQuery.', 'overlay4wp'); ?>
			</label>
			<label>
				<?php _e('Please input the URL of jQuery:', 'overlay4wp'); ?>
				<input type="text" name="jquery_url" class="code" size="40" value="<?php echo($options['jquery_url']); ?>" />
			</label>
		</td>
	</tr>
	<tr>
		<th scope="row"><big><?php _e('Effect Setting', 'overlay4wp'); ?></big><br/><small><?php _e('Set your own effect when clicked', 'overlay4wp'); ?></small></th>
		<td>
		<?php _e('Images switch speed.', 'overlay4wp'); ?><br/>
			<label>
				<input name="switch_speed" type="radio" value="200" <?php if($options['switch_speed'] == '200') echo "checked='checked'"; ?> />
				<?php _e('Slow', 'overlay4wp'); ?>
			</label>
			<label>
				<input name="switch_speed" type="radio" value="500" <?php if($options['switch_speed'] == '500') echo "checked='checked'"; ?> />
				 <?php _e('Medium', 'overlay4wp'); ?>
			</label>
			<label>
				<input name="switch_speed" type="radio" value="800" <?php if($options['switch_speed'] == '800') echo "checked='checked'"; ?> />
				 <?php _e('Fast', 'overlay4wp'); ?>
			</label><br/>
			<label>
				 <?php _e('Background colour.Example:#CCCCCC', 'overlay4wp'); ?>
				<input name="ow_bgc" type="text" value="<?php echo($options['ow_bgc']); ?>" maxlength="7" />
			</label>
		</td>
	</tr>
</table>

		<p class="submit">
			<input class="button-primary" type="submit" name="overlay4WP_save" value="<?php _e('Save Changes', 'overlay4wp'); ?>" />
		</p>
	</div>
</form>

<!-- donation -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<div class="wrap" style="background:#E3E3E3; margin-bottom:1em;">

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">Twitter</th>
					<td>
						Follow <a href="http://twitter.com/bolo123/" target="_blank">bolo123</a> on Twitter.
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Donation</th>
					<td>
						If you find my work useful and you want to encourage the development of more free resources, you can do it by donating...
						<br />
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="9310317">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/zh_XC/i/scr/pixel.gif" width="1" height="1">
</form>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
</form>

<?php
	}
}

add_action('admin_menu', array('overlay4WPOptions', 'add'));

// -- options END ------------------------------------------------------------

// -- print START ------------------------------------------------------------

/**
 * 打印样式和脚本代码
 */
function overlay4WP_header() {
	$css_url = get_bloginfo("wpurl") . '/wp-content/plugins/overlay4wp/css/overlay4wp.css';
	if ( file_exists(TEMPLATEPATH . "/overlay4wp.css") ){
		$css_url = get_bloginfo("template_url") . "/overlay4wp.css";
	}

	$options = get_option('overlay4WP_options');

	$script_header = '';
	if($options['js_type'] == 'normal') {
		$script_header = '<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/overlay4wp/js/jquery.min.js"></script>';
	} else if($options['js_type'] == 'custom_jquery' && $options['jquery_url'] != '') {
		$script_header = '<script type="text/javascript" src="' . $options['jquery_url'] . '"></script>';
	} else {
		$script_header = '';
	}

	echo "\n" . '<!-- START of script generated by overlay4WP -->';
	echo "\n" . '<link rel="stylesheet" href="' . $css_url . '" type="text/css" media="screen" />';
	echo "\n" . $script_header;
	echo "\n" . '<!-- END of script generated by overlay4WP -->' . "\n";
}
add_action('wp_head', 'overlay4WP_header');

function overlay4WP_add_wp_jquery() {
	wp_enqueue_script('jquery');
}
$options = get_option('overlay4WP_options');
if($options['js_type'] == 'wp_jquery') {
	add_action ('wp_print_scripts', 'overlay4WP_add_wp_jquery');
}

function overlay_gallery_div() { ?>
	<!-- overlay element -->
	<div id="gallery" class="simple_overlay">
		<!-- "previous image" action -->
		<a class="ow_prev">
			<?php _e('prev', 'overlay4wp'); ?>
		</a>
		<!-- "next image" action -->
		<a class="ow_next">
			<?php _e('next', 'overlay4wp'); ?>
		</a>
		<!-- image information -->
		<div class="ow_info">
		</div>
	<?php
		echo '<!-- load indicator (animated gif) -->' . "\n";
		echo '	<img class="ow_progress" src="' . get_bloginfo("wpurl") . '/wp-content/plugins/overlay4wp/images/loading.gif" alt="loading"/>' . "\n";
	echo '	</div>';
}

add_action('get_footer','overlay_gallery_div');

function overlay4WP_footer() {
	$options = get_option('overlay4WP_options');
	$post_location =  $options['post_location'];
	$g_speed = $options['switch_speed'];
	$script_footer = "\n" . '<!-- overlay4WP effect START -->';
	$script_footer .= "\n" . '<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/overlay4wp/js/overlay.min.js?ver=1.1.2"></script>';
	$script_footer .= "\n" . '<script type="text/javascript">';
	$script_footer .= "\n" . 'jQuery(function() {';
	$script_footer .= "\n" . 'jQuery("a[rel*=\'gallery\']").overlay({';
	$script_footer .= "\n" . 'target: "#gallery",';
	if ($options['ow_bgc'] != '') {
		$script_footer .= "\n" . 'expose: "' . $options['ow_bgc'] . '",';
	}
	$script_footer .= "\n" . '}).gallery({';
	$script_footer .= "\n" . 'speed: ' . $g_speed;
	$script_footer .= "\n" . '});';
	$script_footer .= "\n" . '});';
	$script_footer .= "\n" . '</script>';
	$script_footer .= "\n" . '<!-- overlay4WP effect END -->' . "\n";

	echo $script_footer;
}
add_action('wp_footer', 'overlay4WP_footer');
// -- print END ------------------------------------------------------------

?>
