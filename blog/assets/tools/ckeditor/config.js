/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
var path = 'https://blog.lsafglobal.com/assets/tools';
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
    config.filebrowserBrowseUrl = path+'/filemanager/dialog.php?type=2&editor=ckeditor&akey=2063c1608d6e0baf80249c42e2be5804&fldr=';
    config.filebrowserUploadUrl = path+'/filemanager/dialog.php?type=2&editor=ckeditor&akey=2063c1608d6e0baf80249c42e2be5804&fldr=';
    config.filebrowserImageBrowseUrl = path+'/filemanager/dialog.php?type=1&editor=ckeditor&akey=2063c1608d6e0baf80249c42e2be5804&fldr=';
   
   config.allowedContent = true;
        config.autoParagraph = false;
	config.enterMode = CKEDITOR.ENTER_BR // pressing the ENTER Key puts the <br/> tag
        config.shiftEnterMode = CKEDITOR.ENTER_P; //pressing the SHIFT + ENTER Keys puts the <p> tag
	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
