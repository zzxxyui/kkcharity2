<?php

 


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	
	
	
	
	 
 			
array('Contact Us '  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),				

 		
		
array( "", "----", 
array("TAB-CNT-START",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'cr'=>'news_lang2',
									)
								
								)	
),						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'繁體',
												'key'=>'news_lang2',		
									)
								
								)		//edit		insert 	updated	---
						),
	 
						
						 			
array('<div class="clearfix "><p class="pull-left fs20">Top Text(中)</p> </div> '  , "----", 			array("CUSTOM",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),				

										array(  'short ',"short2", 
													array("CK-TEXT","required"), 
													array("HIDDEN", "340", false, false), 
													array("SHOW", true, true,	array())
											 ),
array('<div class="clearfix " style="padding-top:30px"><p class="pull-left fs20">Address and Contact Information(中)</p> </div> '  , "----", 			array("CUSTOM",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),												 
										array(  'Description ',"detail2", 
													array("CK-TEXT","required"), 
													array("HIDDEN", "340", false, false), 
													array("SHOW", true, true,	array())
											 ),
											 
						array( "", "----", 
								array("TAB-END",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) 		//edit		insert 	updated	---
						),
 
 
	 
						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>'English',
												'key'=>'news_lang1',		
									)
								
								)		//edit		insert 	updated	---
						),

array('<div class="clearfix "><p class="pull-left fs20">Top Text(English)</p> </div> '  , "----", 			array("CUSTOM",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),							
										array(  'short ',"short1", 
													array("CK-TEXT","required"), 
													array("HIDDEN", "340", false, false), 
													array("SHOW", true, true,	array())
											 ),
array('<div class="clearfix " style="padding-top:30px"><p class="pull-left fs20">Address and Contact Information(English)</p> </div> '  , "----", 			array("CUSTOM",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),												 
										array(  'Description ',"detail1", 
													array("CK-TEXT","required"), 
													array("HIDDEN", "340", false, false), 
													array("SHOW", true, true,	array())
											 ),
											 
						array( "", "----", 
								array("TAB-END",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) 		//edit		insert 	updated	---
						),
 

	 
 
	  
 
  
 
						
						
array( "", "----", 
array("TAB-CNT-END",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) 		//edit		insert 	updated	---
),
		
	
array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
 
 
 
 			
 
  		
			
 /*
	array($this->txt['status']  , "status", 
			array("STATUS","required"), 
			array("HIDDEN", "60", true, false), 
			array("HIDDEN", true, true, array()),	
				array('search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }") 
	),*/
	array( "CreateDate", "created_at", 
			array("FIX",""), 
			array("HIDDEN", "110", true, false), 
			array("HIDDEN", true, false, array()) 
	),
	array( $this->txt['mod_date']  , "updated_at", 
	array("FIX",""), 
	array("SHOW", "110", true, false), 
	array("HIDDEN", true, true, array()) 
	),
	
 
	 
		 
												
//	array( "Invoice ID", "status", array("ORDER-ID","required"), array("SHOW", "0", true, false), array("SHOW", false, false, array()) ),

);
  
 
 
 
	
	
$mycofig=array(
	'lv'=>1,
	'tag'=>'page_contact',
	'keyfield'=>'id',
	'pageName'=>'Homepage ',
	'tableName'=>'page_contact', 
	
	
	'menuList'=>array( 
		//	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'page_contact&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'page_contact&action=edit', 'title'=>'Homepage '	,'core'=>'./core/edit.php'),
			/*
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'page_contact&action=list', 'title'=>'page_contactpage Description'	,'core'=>'./core/list.php',
			'width'=>'100%'
			,'sublink'=> array(
					//  array('lv'=>1,'href'=>'page_contact&action=sort', 'title'=>'Sort'	,'width'=>'17%'),
				//	array('lv'=>1,'href'=>'page_contact&action=create', 'title'=>'Create'	,'width'=>'17%'),
				)
			
			),
				*/
 /*
			'sort'=>array('lv'=>1, 		'type'=>'',	'tag'=>'page_contact&action=sort', 'title'=>'sort '	,'core'=>'./core/sort.php',
			'sort_setting'=>array(
					'cat'=>false,
				//	 'cat_array'=>$carSelect,
					'main_field'=>'id',
					'col_val'=>array(
					array('name'=>'rank',	'tt'=>$tval['rank'],	'width'=>'15%'),
					array('name'=>'title1',	'tt'=>$tval['title'],	'width'=>'80%'), 
					)
			)
			),
			*/
			 
	 
			
			
	),
 
	'allValue'=>$fixedField,

	/*'firstWidth'=>'120',*/
	'logfield'=>'id',
	
	
	'orderby'=>'  id ',
	'orderby_dir'=>' asc  ', 
	
'other_function'=>array(
	 array('type'=>'onefile','key'=>'page_contact_bg2_onefile'),
	 array('type'=>'onefile','key'=>'page_contact_bg1_onefile'),
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'page_contact_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>