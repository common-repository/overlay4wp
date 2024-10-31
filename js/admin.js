// String.replaceAll(arg0, arg1):String
String.prototype.replaceAll = function(pattern, replacement) {
	return this.split(pattern).join(replacement);
}

// String.trim():String
String.prototype.trim = function() {
	return this.replace(/(^\s+)|(\s+$)/g, "");
}

function insertAfter(ow_node, referenceNode) {
	referenceNode.parentNode.insertBefore(ow_node, referenceNode.nextSibling);
}

function checkOverlay(type) {
	var ow_flag = true;
	if(type == "image") {
		if(document.getElementById("overlay_thumbnail").value.trim() == "") {
			alert("Thumbnail URL is required.");
			ow_flag = false;
		} else if(document.getElementById("overlay_fullsize").value.trim() == "") {
			alert("Fullsize Image URL is required.");
			ow_flag = false;
		}
	}
	return ow_flag;
}

/* image START */
function callOverlayDialog() {
	var ow_panel = document.getElementById("overlay-panel");
	ow_panel.style.height = document.body.scrollHeight + "px";
	ow_panel.style.display = "block";
	if (!window.ActiveXObject) {
		ow_panel.style.position = "fixed";
	}

	var ow_dialog = document.getElementById("overlay-dialog");
	ow_dialog.style.top = "175px";
	ow_dialog.style.left = (document.body.scrollWidth - 500) / 2 + "px";
	ow_dialog.style.display = "block";
	if (!window.ActiveXObject) {
		ow_dialog.style.position = "fixed";
	}

	var ow_activeDialog = document.getElementById("overlay-image-dialog");
	ow_activeDialog.style.visibility = "visible";
	ow_activeDialog.style.display = "block";

	document.getElementById("overlay_thumbnail").value = "";
	document.getElementById("overlay_fullsize").value = "";
	document.getElementById("overlay_description").value = "";
}

function hideOverlayDialog() {
	var ow_panel = document.getElementById("overlay-panel");
	ow_panel.style.display = "none";

	var ow_dialog = document.getElementById("overlay-dialog");
	ow_dialog.style.display = "none";

	var ow_activeDialog = document.getElementById("overlay-image-dialog");
	ow_activeDialog.style.display = "none";
}

function insertOverlay(type) {
	// check input
	var ow_flag = checkOverlay(type);
	if(!ow_flag) {
		return;
	}

	if(type == 'image') {
		var ow_f = document.getElementById('overlay_fullsize').value.trim();
		var ow_t = document.getElementById('overlay_thumbnail').value.trim();
		var ow_d = document.getElementById('overlay_description').value.trim();

		var ow_code = '<a href="' + ow_f + '" title="' + ow_d + '" rel="gallery">';
		ow_code += '<img src="' + ow_t + '" alt="' + ow_d + '" title="Click to enlarge" />';
		ow_code += '</a>';

	}

	ow_insert(ow_code);

	// reset
	if(type == 'image') {
		document.getElementById('overlay_fullsize').value = '';
		document.getElementById('overlay_thumbnail').value = '';
		document.getElementById('overlay_description').value = '';
	}

	// close the dialog
	hideOverlayDialog();
}
/* image END */

/* emoticon START */
function callEmoticonBar() {
	var ow_emoticonButton = document.getElementById("overlay-emoticon");
	var ow_emoticonBar = document.getElementById("overlay-emoticon-bar");
	var ow_emoticonStatus = ow_emoticonBar.style.display;
	if (ow_emoticonStatus == "block") {
		ow_emoticonButton.className = "";
		ow_emoticonBar.style.display = "none";
	} else {
		ow_emoticonButton.className = "overlay-active";
		ow_emoticonBar.style.display = "block";
	}
}
/* emoticon END */

function ow_insert(insertStr) {
	var ow_myField;
	if (document.getElementById('content') && document.getElementById('content').type == 'textarea') {
		ow_myField = document.getElementById('content');
		if (document.getElementById('postdivrich') && typeof tinyMCE != 'undefined' && !document.getElementById('edButtons') && document.getElementById('quicktags').style.display == 'none') {

			// for WordPress 2.5
			var ow_w = window.dialogArguments || opener || parent || top;
			var ow_tinymce = ow_w.tinymce;
			var ow_editor = ow_tinymce.EditorManager.activeEditor;
			ow_editor.execCommand('mceInsertContent', false, insertStr);

			// for WordPress 2.3, delete...
			//tinyMCE.execInstanceCommand('mce_editor_0', 'mceInsertContent', false, insertStr);
			//tinyMCE.selectedInstance.repaint();

			return;
		}
	} else {
		return false;
	}

	if(document.selection) {
		ow_myField.focus();
		ow_sel = document.selection.createRange();
		ow_sel.text = insertStr;
		ow_myField.focus();

	} else if (ow_myField.selectionStart || ow_myField.selectionStart == '0') {
		var ow_startPos = ow_myField.selectionStart;
		var ow_endPos = ow_myField.selectionEnd;
		var ow_cursorPos = ow_startPos;
		ow_myField.value = ow_myField.value.substring(0, ow_startPos)
					  + insertStr
					  + ow_myField.value.substring(ow_endPos, ow_myField.value.length);
		ow_cursorPos += insertStr.length;
		ow_myField.focus();
		ow_myField.selectionStart = ow_cursorPos;
		ow_myField.selectionEnd = ow_cursorPos;

	} else {
		ow_myField.value += insertStr;
		ow_myField.focus();
	}
}