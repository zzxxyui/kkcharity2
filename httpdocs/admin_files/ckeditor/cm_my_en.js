CKEDITOR.editorConfig = function( config )
{
	config.resize_enabled = true;
	//config.removePlugins = 'spellchecker';
	//config.removePlugins = 'scayt'; 
 	 config.language = 'en';
config.extraPlugins = 'font'; 

  config.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;13/13px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px';

	// config.skin = 'kama';
		 config.toolbar_useful =
[  
    ['Source','-','Save','NewPage','Preview','-','Templates'],  
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],  
    ['Cut','Copy','Paste','PasteText','PasteFromWord'],  
	['-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],  
    ['BidiLtr', 'BidiRtl'],  
    ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar'],
    ['Maximize', 'ShowBlocks']  ,  '/',  
    ['Bold','Italic','Underline','Strike'], 
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],  
    ['Styles','Format','Font','FontSize'],  
    ['TextColor','BGColor'],  
    ['Link','Unlink','Anchor'],  
]; 



		 config.toolbar_simple =
[  
    ['Source','-','Save','NewPage','Preview','RemoveFormat'],  
    ['Undo','Redo'],  
    ['Cut','Copy','Paste','PasteText','PasteFromWord'],  
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','-','Subscript','Superscript'],  
    ['BidiLtr', 'BidiRtl'],  
    ['Table','HorizontalRule','Smiley','SpecialChar'],
    ['ShowBlocks']  ,  '/',  
    ['Bold','Italic','Underline','Strike'], 
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],  
    ['Styles','Format','Font','FontSize'],  
    ['TextColor','BGColor'],  
    ['Image','Link','Unlink'],  
]; 


	 
	 //, 'SpellChecker', 'Scayt'
	 	 config.toolbar_allfunc =
[  
    ['Source','-','Save','NewPage','Preview','-','Templates'],  
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],  
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],  
    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],  
   
	['-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],  
    ['BidiLtr', 'BidiRtl'],  
    ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
    ['Maximize', 'ShowBlocks','-','About']  ,  '/',  
    ['Bold','Italic','Underline','Strike'], 
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],  
    ['Styles','Format','Font','FontSize'],  
    ['TextColor','BGColor'],  
    ['Link','Unlink','Anchor'],  
]; 


};
/*
CKEDITOR.replace("editor",
{
    removePlugins: "scayt"
});
*/