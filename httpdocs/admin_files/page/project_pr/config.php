<?php

 


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	
	
	
	
	 
 						

		

array('Press Releases Info'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),									 
 
	 				array('Rank', "rank", 
													array("RANK","required"), 
													array("SHOW", "60", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
 								
						 	 
											 
				array(  'Related Project',"node_id", 
									array("CAT-LEVEL","required"), 
									array("SHOW", "140", false, false), 			//list		display  ---	search 	===
									array("SHOW", true, true, array()) 	,	//edit		insert 	updated	---
									array( 
									'kkc_cat'=>true,
										'cat_setting'=>array(
										'cattb'=>DB_START."project" ,
										'tag'=>'project',
										'isItem'=>true,
										'one_lv'=>false	),
										'listsql'=>'   
										
										  CASE when  t2.parent_id = 0    THEN    t2.title1   ELSE   
									 
										 t2.title1 
								END 	  as node_id  
					
										
										', 
										'search'=>true,
										'search_select_cat'=>DB_START.'project'
										)
							),

				 
array('Date', "setdate", 
													array("DATE","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
), 

 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),				

array('Press Releases Content'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),

	
		
 
				
											array('Title', "title1", 
													array("VAL","required"), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
			 
										 	array( 'Title(繁體)' , "title2", 
													array("VAL",""), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
  

				
											array('External Link', "linkto", 
													array("VAL",""), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
			 
										 	array( 'YouTube Link' , "video_link", 
													array("VAL",""), 
													array("SHOW", "170", true, false), 
													array("SHOW", true, true,	array())
											 ),
 
array('
<div class="form-group clearfix">
<label class="col-sm-3 control-label">Priority:</label>
<div class="col-sm-9 clearfix">
<p class="pull-left mt5">Uploaded File > External Link > YouTube Link</p>
</div>
</div>
 '  , "----", 			array("CUSTOM",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),

  
  
  
 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),				

 /*
	 			 	array( "Url Rewrite", "url_rewrite", 
													array("URL-REWRITE"," urlrewrite"), 
													array('HIDDEN', "220", false, false), 
													array('SHOW', true, true,	array(),),
														
													array(
													'opt'=>array(
																'copy_from'=>'title1'
														)
													)
													
			 ),
	
*/
				
	
			 
	 array($this->txt['status']  , "status", 
			array("STATUS","required"), 
			array("SHOW", "60", true, false), 
			array("SHOW", true, true, array()),	
				array(
				'search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }",
		 
				'option'=>array(
					'array'=>array(
						array('val'=>1,'tt'=>'Enabled'),
						array('val'=>0,'tt'=>'Disabled'),
					),
					'default'=>0,
					)
				
				) 


	),
 
 
 
 					 
					  
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
	'tag'=>'project_pr',
	'keyfield'=>'id',
	'pageName'=>'Press Releases',
	'tableName'=>'project_pr', 
	'tableName_cat'=>'project', 
	
	
	'menuList'=>array( 
	 	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'project_pr&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'project_pr&action=edit', 'title'=>'Edit '	,'core'=>'./core/edit.php'),
		 
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'project_pr&action=list', 'title'=>'Press Releases'	,'core'=>'./core/list.php',
			'width'=>'100%'
			,'sublink'=> array(
					array('lv'=>1,'href'=>'project_pr&action=sort', 'title'=>$this->txt['sort']	,'width'=>'17%' 		, 'icon'=>'fa-bars' ),
					array('lv'=>1,'href'=>'project_pr&action=create', 'title'=>$this->txt['create']	,'width'=>'17%'		, 'icon'=>'fa-plus' ),
				)
			
			),
		 
 
			'sort'=>array('lv'=>1, 		'type'=>'',	'tag'=>'project_pr&action=sort', 'title'=>'Sort','core'=>'./core/sort.php',
			'sort_setting'=>array(
					'cat'=>true,
					'sort_type'=>'desc',
				//	 'cat_array'=>$carSelect,
					'main_field'=>'id',
					'col_val'=>array(
					array('name'=>'rank',	'tt'=>$this->txt['rank'],	'width'=>'15%'),
					 array('name'=>'setdate',	'tt'=>'Date',	'width'=>'10%'),
					array('name'=>'title1',	'tt'=>$this->txt['title'],	'width'=>'60%'),
					)
			
			)
			
			),
			 
	 
			
			
	),
	
	
	
	
		'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'project as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
 
	 
	
	
 
	'allValue'=>$fixedField,

	/*'firstWidth'=>'120',*/
	'logfield'=>'id',
	
	
	'orderby'=>' t1. rank ',
	'orderby_dir'=>' desc  ', 
	
'other_function'=>array(
  array('type'=>'onefile','key'=>'project_pr_onefile'),
	// array('type'=>'onefile','key'=>'project_pr_img2_onefile'),
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'project_pr_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>