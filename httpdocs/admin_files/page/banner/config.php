<?php


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true,/* 'list-order'=>1*/)		//edit		insert 	updated	---
	),
	 				array('Rank', "rank", 
													array("RANK","required"), 
													array("SHOW", "60", true, false), 
													array("SHOW", true, true,	array())
											 ),
						
						
array('English'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),
			array(  $this->txt['title'],"title1", 
													array("VAL","required"), 
													array("SHOW", "220", true, false), 
													array("SHOW", true, true,	array()) 
											 ),	
 
			array( 'HyperLink',"linkto1", 
													array("VAL",""), 
													array("SHOW", "220", true, false), 
													array("SHOW", true, true,	array()) 
											 ),	
											   
 
			array( 'Text',"detail1", 
													array("TEXT",""), 
													array("HIDDEN", "220", true, false), 
													array("SHOW", true, true,	array()) 
											 ),	
											 
											 
	array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),

 	array(''.$this->txt['zh_hk'].''  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),
											 
											 
 
			array(  $this->txt['title'].'('.$this->txt['zh_hk'].')',"title2", 
													array("VAL","required"), 
													array("SHOW", "220", true, false), 
													array("SHOW", true, true,	array()) 
											 ),					

			array( 'HyperLink('.$this->txt['zh_hk'].')',"linkto2",
													array("VAL",""), 
													array("SHOW", "220", true, false), 
													array("SHOW", true, true,	array()) 
											 ),			
 
			array( 'Text('.$this->txt['zh_hk'].')',"detail2", 
													array("TEXT",""), 
													array("HIDDEN", "220", true, false), 
													array("SHOW", true, true,	array()) 
											 ),	
											 
 		
 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),

 
					array(  'Text Align',"val_ag", 
													array("SELECT-ARR","required"), 
													array("HIDDEN", "120", false, false), 
													array("SHOW", true, true,	array())
												 ,array(
												  
				
												 'null_start'=>false,
												 'plus_opt'=>' style="width:200px" ',
												 'valArray'=>array(
												 	array('name'=>'0','tt'=>'Left'),
												 	array('name'=>'1','tt'=>'Center'),
												 	array('name'=>'2','tt'=>'Right'),
												 ),
												 				

											//	 'orderby'=>array('rank','asc'),
												 //'list-order'=>3
												 ),
				 ),
				array($this->txt['status']  , "status", 
						array("STATUS","required"), 
						array("SHOW", "60", true, false), 
						array("SHOW", true, true, array()),	
							array(
							'search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }",
							'list-order'=>5,
							
							) 
				),					
						
 


	array( $this->txt['create_date'] , "created_at", 
			array("FIX",""), 
			array("HIDDEN", "160", true, false), 
			array("HIDDEN", true, false, array())
	),
	array( $this->txt['mod_date']  , "updated_at", 
	array("FIX",""), 
	array("SHOW", "160", true, false), 
	array("HIDDEN", true, true, array()) 	,array('list-order'=>6),
	),
	
 

	
		 
												
//	array( "Invoice ID", "status", array("ORDER-ID","required"), array("SHOW", "0", true, false), array("SHOW", false, false, array()) ),

);

 

$mycofig=array(
	'list-order'=>false,
	'lv'=>1,
	'tag'=>'banner',
	'keyfield'=>'id',
	'pageName'=>'Banner',
	'tableName'=>"banner",
	'menuList'=>array(
			'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'banner&action=create', 'title'=>'Create','core'=>'./core/create.php'),
			//'list'=>array('lv'=>1, 			'type'=>'link',	'tag'=>'banner&action=list', 'title'=>'Modify banner'	,'core'=>'./core/list.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'banner&action=list', 'title'=>'Edit'	,'core'=>'./core/edit.php'),
			
			
			'sort'=>array('lv'=>1, 		'type'=>'',	'tag'=>'banner&action=sort', 'title'=>'Sort','core'=>'./core/sort.php',
			'sort_setting'=>array(
					'cat'=>false,
					'sort_type'=>'asc',
				//	 'cat_array'=>$carSelect,
					'main_field'=>'id',
					'col_val'=>array(
					array('name'=>'rank',	'tt'=>$this->txt['rank'],	'width'=>'15%'),
					array('name'=>'title1',	'tt'=>$this->txt['title'],	'width'=>'40%'),
					 array('name'=>'title2',	'tt'=>$this->txt['value'],	'width'=>'40%'),
					)
			
			)
			
			),
			
			'list'=>array('lv'=>1, 		'type'=>'link',	'tag'=>'banner&action=list', 'title'=>'Banner','core'=>'./core/list.php',
			'width'=>'79%',
			'sublink'=> array(
					array('lv'=>1,'href'=>'banner&action=sort', 'title'=>$this->txt['sort']	,'width'=>'17%' 		, 'icon'=>'fa-bars' ),
					array('lv'=>1,'href'=>'banner&action=create', 'title'=>$this->txt['create']	,'width'=>'17%'		, 'icon'=>'fa-plus' ),
				)
			),
			
			
			
	),
  
	'sqlplus_selectadd'=>'	 	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	  ',
	'sqlplus_where'=>'	',
 
	'allValue'=>$fixedField,
	'firstWidth'=>'70',
	'logfield'=>'title1',
	
	
	'orderby'=>'  rank ',
	'orderby_dir'=>' asc  ', 
	 
	'other_function'=>array(
	
	 array('type'=>'onefile','key'=>'banner1_onefile'),
	 array('type'=>'onefile','key'=>'banner2_onefile'),
  
	 array('type'=>'onefile','key'=>'banner_mb1_onefile'),
	 array('type'=>'onefile','key'=>'banner_mb2_onefile'),
 
	
	)
	
	
	 
		
		
 /*
		'seo_val'=>array(
		'seo'=>true,
		'title'=>'Seo banner',
		'master_val'=>true,
		'table'=>DB_START."banner",
		'seo_array'=>$this->seo_array,
		),
 */
);
?>