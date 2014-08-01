/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'el';
	// config.uiColor = '#AADC6E';
	config.scayt_autoStartup = true;
	config.scayt_sLang = 'el_GR';
	//CKEDITOR.plugins.load('pgrfilemanager');

	config.toolbar=
    [
        ['Source', '-', 'Preview', '-'],
        ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Print', 'SpellChecker'], //, 'Scayt' 
        ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
        '/',
        ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
        ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['Link', 'Unlink', 'Anchor'],
        ['Image', 'Flash', 'Table', 'HorizontalRule', 'SpecialChar'],
        '/',
        ['Styles', 'Format', 'Templates','Font'],
		['FontSize'],
		[ 'TextColor','BGColor' ] ,
        ['Maximize', 'ShowBlocks']
    ];
	config.height = 450;
    config.width = '100%';
    config.resize_enabled = false; 
	/*CKEDITOR.editorConfig = function( config ) {
	   config.filebrowserBrowseUrl = '/sullogos2/tools/ckfinder/ckfinder.html',
	   config.filebrowserImageBrowseUrl = '/tools/ckfinder/ckfinder.html?type=Images',
	   config.filebrowserFlashBrowseUrl = '/tools/ckfinder/ckfinder.html?type=Flash',
	   config.filebrowserUploadUrl = '/tools/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	   config.filebrowserImageUploadUrl = '/tools/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	   config.filebrowserFlashUploadUrl = '/tools/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	};*/
};
