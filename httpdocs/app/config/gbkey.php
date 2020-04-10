<?php  


require_once('gbkey_base_config.php');

$gbkey_array= array(

    
	'about_partner_onefile' =>array(
	'btn_title'=>'Photo', 
	'btn_subtitle'=>'  ( width:400px, Height:400px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'about_partner_onefile',
	'tb_val'=>'about_partner',
	'folder_val'=>'about',		
	'sp_field'=>'ff_thumb',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>400,
	'max_h'=>400,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>400,
	'thumbnail_max_h'=>400,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
	
	
		'caption'=>array(		),
		'description'=>array(		),
 
		
),	  
	'about_ppl_onefile' =>array(
	'btn_title'=>'Photo', 
	'btn_subtitle'=>'  ( width:400px, Height:400px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'about_ppl_onefile',
	'tb_val'=>'about_ppl',
	'folder_val'=>'about',		
	'sp_field'=>'ff_thumb',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>400,
	'max_h'=>400,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>400,
	'thumbnail_max_h'=>400,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
	
	
		'caption'=>array(		),
		'description'=>array(		),
 
		
),	



  
	'banner1_onefile' =>array(
	'btn_title'=>'Banner PC(EN)', 
	'btn_subtitle'=>'  ( width:1600px, Height:550px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'banner1_onefile',
	'tb_val'=>'banner',
	'folder_val'=>'banner',		
	'sp_field'=>'ff_thumb1',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>1600,
	'max_h'=>1600,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>1600,
	'thumbnail_max_h'=>1600,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
	
	
		'caption'=>array(		),
		'description'=>array(		),
 
		
),	
	
'banner2_onefile' =>array(
	'btn_title'=>'Banner PC(TC)', 
	'btn_subtitle'=>'  ( width:1600px, Height:550px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'banner2_onefile',
	'tb_val'=>'banner',
	'folder_val'=>'banner',		
	'sp_field'=>'ff_thumb2',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>1600,
	'max_h'=>1600,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>1600,
	'thumbnail_max_h'=>1600,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
	
	
		'caption'=>array(		),
		'description'=>array(		),
 
		
),




	'banner_mb1_onefile' =>array(
	'btn_title'=>'Banner Mobile(EN)', 
	'btn_subtitle'=>'  ( width:800px, Height:600px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'banner_mb1_onefile',
	'tb_val'=>'banner',
	'folder_val'=>'banner',		
	'sp_field'=>'ff_thumb_mb1',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>800,
	'max_h'=>800,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>800,
	'thumbnail_max_h'=>800,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
	
	
		'caption'=>array(		),
		'description'=>array(		),
 
		
),	
	
'banner_mb2_onefile' =>array(
	'btn_title'=>'Banner Mobile (TC)', 
	'btn_subtitle'=>'  ( width:800px, Height:600px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'banner_mb2_onefile',
	'tb_val'=>'banner',
	'folder_val'=>'banner',		
	'sp_field'=>'ff_thumb_mb2',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>800,
	'max_h'=>800,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>800,
	'thumbnail_max_h'=>800,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
	
	
		'caption'=>array(		),
		'description'=>array(		),
 
		
),



/*

   'project_img1_onefile' =>array(
	'btn_title'=>'Thumbnail', 
	'btn_subtitle'=>'  ( width:640px, Height:480px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'project_img1_onefile',
	'tb_val'=>'project',
	'folder_val'=>'project',		
	'sp_field'=>'ff_thumb1',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>640,
	'max_h'=>640,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>640,
	'thumbnail_max_h'=>640,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
		'caption'=>array(		),
		'description'=>array(		),
),

*/
 
   'project_slide_manyfile' =>array(
	'btn_title'=>'Slide Image', 
	'btn_subtitle'=>'  ( width:700px, Height:400px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'manyfile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'project_slide_manyfile',
	'tb_val'=>'project',
	'folder_val'=>'project',		
	'sp_field'=>'ff_slide',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>1200,
	'max_h'=>1200,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>1200,
	'thumbnail_max_h'=>1200,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
		'caption'=>array(		 'caption1'=>'YouTube Link' 	),
		'description'=>array(		),
),

 
  
'webdesign_manyfile' =>array(
	'btn_title'=>'Upload Screen', 
	'btn_subtitle'=>' ( width:800px, Height:800px)	  ',
	//'btn_style'=>' width:190px; ',
	
	
	'type'=>'manyfile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'webdesign_manyfile',
	'tb_val'=>'webdesign',
	'folder_val'=>'webdesign',		
	'sp_field'=>'ff_slide',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>800,
	'max_h'=>800,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>800,
	'thumbnail_max_h'=>800,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
	
		'caption'=>array(	),
		
		'description'=>array(		
						/*'detail1'=>'Description(ENG)',
						'detail2'=>'Description(TC)',
						'detail3'=>'Description(TS)',*/
						
						),

),
 
 
  
 

 'project_pr_onefile' =>array(
	'btn_title'=>'Upload File', 
	'btn_subtitle'=>'',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'file',	//file, image
	'table'=>'gb_files',	
	
	'key'=>'project_pr_onefile',
	'tb_val'=>'project_pr',
	'folder_val'=>'project_pr',		
	'sp_field'=>'ff_file',
	
	'rename_val'=>'nochange',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>200,
	'max_h'=>200,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>200,
	'thumbnail_max_h'=>200,
	'file_types'=>'/\.(pdf|zip|exe)$/i',
	
	
		'caption'=>array(		),
		'description'=>array(		),
 
		
),
 

 'project_mi_onefile' =>array(
	'btn_title'=>'Upload File', 
	'btn_subtitle'=>'',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'file',	//file, image
	'table'=>'gb_files',	
	
	'key'=>'project_mi_onefile',
	'tb_val'=>'project_mi',
	'folder_val'=>'project_mi',		
	'sp_field'=>'ff_file',
	
	'rename_val'=>'nochange',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>200,
	'max_h'=>200,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>200,
	'thumbnail_max_h'=>200,
	'file_types'=>'/\.(pdf|zip|exe)$/i',
	
	
		'caption'=>array(		),
		'description'=>array(		),
 
		
),
 
		
		
		
		
'project_oc_onefile' =>array(
	'btn_title'=>'Image', 
	'btn_subtitle'=>'  ( width:600px, Height:600px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'project_oc_onefile',
	'tb_val'=>'project_oc',
	'folder_val'=>'project_oc',		
	'sp_field'=>'ff_thumb',
	
	'rename_val'=>'nochange',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>600,
	'max_h'=>600,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>600,
	'thumbnail_max_h'=>600,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
		'caption'=>array(		),
		'description'=>array(		),
),
	
			
		
'donation_onefile' =>array(
	'btn_title'=>'Donation Image', 
	'btn_subtitle'=>'  ( width:600px, Height:600px)	',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'image',	//file, image
	'table'=>'gb_imgfiles',	
	
	'key'=>'donation_onefile',
	'tb_val'=>'donation',
	'folder_val'=>'donation',		
	'sp_field'=>'ff_thumb',
	
	'rename_val'=>'md5',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>600,
	'max_h'=>600,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>600,
	'thumbnail_max_h'=>600,
	'file_types'=>'/\.(gif|jpe?g|png)$/i',
		'caption'=>array(		),
		'description'=>array(		),
),
		
		
		


 'spfile1_onefile' =>array(
	'btn_title'=>'Proposal Template', 
	'btn_subtitle'=>'',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'file',	//file, image
	'table'=>'gb_files',	
	
	'key'=>'spfile1_onefile',
	'tb_val'=>'submit_file_page',
	'folder_val'=>'proposal',		
	'sp_field'=>'ff_file1',
	
	'rename_val'=>'nochange',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>200,
	'max_h'=>200,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>200,
	'thumbnail_max_h'=>200,
	'file_types'=>'/\.(pdf|zip|doc|docx|exe)$/i',
	
		'caption'=>array(		),
		'description'=>array(		),
		
),
 



 'spfile2_onefile' =>array(
	'btn_title'=>'Application & Funding Guidelines', 
	'btn_subtitle'=>'',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'file',	//file, image
	'table'=>'gb_files',	
	
	'key'=>'spfile2_onefile',
	'tb_val'=>'submit_file_page',
	'folder_val'=>'proposal',		
	'sp_field'=>'ff_file2',
	
	'rename_val'=>'nochange',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>200,
	'max_h'=>200,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>200,
	'thumbnail_max_h'=>200,
	'file_types'=>'/\.(pdf|zip|doc|docx|exe)$/i',
	
		'caption'=>array(		),
		'description'=>array(		),
		
),
 		

 




 'spfile1_zh_onefile' =>array(
	'btn_title'=>'計劃書/申請表格', 
	'btn_subtitle'=>'',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'file',	//file, image
	'table'=>'gb_files',	
	
	'key'=>'spfile1_onefile',
	'tb_val'=>'submit_file_page',
	'folder_val'=>'proposal',		
	'sp_field'=>'ff_file_zh1',
	
	'rename_val'=>'nochange',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>200,
	'max_h'=>200,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>200,
	'thumbnail_max_h'=>200,
	'file_types'=>'/\.(pdf|zip|doc|docx|exe)$/i',
	
		'caption'=>array(		),
		'description'=>array(		),
		
),
 



 'spfile2_zh_onefile' =>array(
	'btn_title'=>'申請及撥款指引', 
	'btn_subtitle'=>'',
	//'btn_style'=>' width:210px; ',
	
	
	'type'=>'onefile',
	'data_type'=>'file',	//file, image
	'table'=>'gb_files',	
	
	'key'=>'spfile2_onefile',
	'tb_val'=>'submit_file_page',
	'folder_val'=>'proposal',		
	'sp_field'=>'ff_file_zh2',
	
	'rename_val'=>'nochange',	
	'script_url'=> ROOT_PATH.'userfile/', 
	'upload_dir'=>	public_path(). '/userfile/', 
	'upload_url'=> ROOT_PATH.'userfile/', 	
	'max_w'=>200,
	'max_h'=>200,		
	'thumbnail'=>0,
	'thumbnail_max_w'=>200,
	'thumbnail_max_h'=>200,
	'file_types'=>'/\.(pdf|zip|doc|docx|exe)$/i',
	
		'caption'=>array(		),
		'description'=>array(		),
		
),
 		



);


		
$merge_gbarray=array_merge(	$base_array, $gbkey_array);

return $merge_gbarray;