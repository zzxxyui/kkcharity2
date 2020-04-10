<?php  
 

return array(

array('lv'=>'1',	'type'=>'title',		'title'=>'WebSite',),

array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'banner',
	'path'=>'page/banner/config.php',
), 
array(
	'lv'=>'1',
	'type'=>'one_page',
	'tag'=>'about',
	'path'=>'page/about/config.php', 
	'link'=>'?q=about&action=edit&id=1',
	'title'=>'Homepage (About Us)',
),

 
array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'about_ppl',
	'path'=>'page/about_ppl/config.php',
), 

 
array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'about_partner',
	'path'=>'page/about_partner/config.php',
), 

array(
	'lv'=>'1',
	'type'=>'one_page',
	'tag'=>'onepage',
	'path'=>'page/onepage/config.php', 
	'link'=>'?q=onepage&action=edit&id=1',
	'title'=>'Privacy policy',
),
array(
	'lv'=>'1',
	'type'=>'one_page',
	'tag'=>'onepage',
	'path'=>'page/onepage/config.php', 
	'link'=>'?q=onepage&action=edit&id=2',
	'title'=>'Disclaimer',
),
array('lv'=>'1',	'type'=>'title-end'),


array('lv'=>'1',	'type'=>'title',		'title'=>'Project',),
 
array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'project',
	'path'=>'page/project/config.php',
), 
array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'project_news',
	'path'=>'page/project_news/config.php',
),

array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'project_oc',
	'path'=>'page/project_oc/config.php',
),
array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'project_pr',
	'path'=>'page/project_pr/config.php',
),


array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'project_mi',
	'path'=>'page/project_mi/config.php',
),



/*
array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'donation',
	'path'=>'page/donation/config.php',
),
*/


  

array('lv'=>'1',	'type'=>'title-end'),

array('lv'=>'1',	'type'=>'title',		'title'=>'Submit A Proposal',),
array(
	'lv'=>'1',
	'type'=>'one_page',
	'tag'=>'submit_file_page',
	'path'=>'page/submit_file_page/config.php', 
	'link'=>'?q=submit_file_page&action=edit&id=1',
	'title'=>'Submit A Proposal(File Upload)',
),

array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'submit_file',
	'path'=>'page/submit_file/config.php',
),

array('lv'=>'1',	'type'=>'title-end'),
 

array('lv'=>'2',	'type'=>'title',		'title'=>'Email Record',),
array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'submit_nl',
	'path'=>'page/submit_nl/config.php',
),


array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'contact',
	'path'=>'page/contact/config.php',
),





array('lv'=>'1',	'type'=>'title-end'),
/*
 
array('lv'=>'2',	'type'=>'title',		'title'=>'Payment',),
 

array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'payment_record',
	'path'=>'page/payment_record/config.php',
),


array('lv'=>'1',	'type'=>'title-end'),
*/

  
array('lv'=>'1',	'type'=>'title',		'title'=>'Admin Setting'),
 
 
 

array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'setting',
	'path'=>'page/setting/config.php',
),
  
array(
	'lv'=>'1',
	'type'=>'page',
	'tag'=>'madmin',
	'path'=>'page/madmin/config.php',
),

 
array('lv'=>'1',	'type'=>'title-end'),
 



//array('lv'=>'1',	'type'=>'custom','value'=>'<p>&nbsp;</p>'),

/*
array('lv'=>'1',	'type'=>'title',		'title'=>'Other',),
array('lv'=>'1',	'type'=>'ui-start',),
array('lv'=>'1',	'type'=>'custom','value'=>'<li>-----------------</li>'),
array('lv'=>'1',	'type'=>'ui-end',),
*/



);