<?php


$fixedField = array (
	
	array( $this->txt['id']	 , "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	array($this->txt['setting']  , "----", 
			array("LG-START","required"), 
			array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
			array("SHOW", false, false, array()) 		//edit		insert 	updated	---
	),

	array($this->txt['rank']   , "rank", 
			array("RANK","required"), 
			array((($this->user_lv==0)?"SHOW":"HIDDEN"), "40", true, false), 
			array((($this->user_lv==0)?"SHOW":"HIDDEN"), true, true,	array())
	 ),
	array($this->txt['title']  , "opt_title", 
			array((($this->user_lv==0)?"VAL":"FIX") ,"required"), 
			array("SHOW", "220", true, false), 
			array("SHOW", 	(($this->user_lv==0)?true:false) , 	(($this->user_lv==0)?true:false) ,	array())
	 ),
	array($this->txt['key']  , "opt_key", 
			array("VAL","required"), 
			array((($this->user_lv==0)?"SHOW":"HIDDEN"), "120", true, false), 
			array((($this->user_lv==0)?"SHOW":"HIDDEN"),	(($this->user_lv==0)?true:false) , 	(($this->user_lv==0)?true:false) ,	array())
	 ),
	array($this->txt['value'] , "opt_value", 
			array("TEXT",""), 
			array("SHOW", "290", true, false), 
			array("SHOW", true, true,	array())
	 ),

/*
	array( "Admin Level", "admin_level", 
			array("ADMIN-LEVEL","required"), 
			array("SHOW", "120", false, false), 
			array("SHOW", true, true,	array()),	
				array('listsql'=>' (select level_name from  '.DB_START."admin_level".' where id=admin_level) as admin_level ' )
	 ),
*/
 
 
	array($this->txt['status']  , "status", 
			array("STATUS","required"), 
			array((($this->user_lv==0)?"SHOW":"HIDDEN"), "60", true, false), 
			array((($this->user_lv==0)?"SHOW":"HIDDEN"), (($this->user_lv==0)?true:false) , 	(($this->user_lv==0)?true:false) ,	array()),
				array('search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }") 
	),
	
	array( "---", "----", 
			array("LG-END","---"), 
			array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
			array("SHOW", false, false, array()) 		//edit		insert 	updated	---
	),
 
 								
//	array( "Invoice ID", "status", array("ORDER-ID","required"), array("SHOW", "0", true, false), array("SHOW", false, false, array()) ),

); 




 



$mycofig=array(
		'userright'=>array(
			'save'=>array(
				'lv'=>1
			)
		),
	'lv'=>1,
	'tag'=>'setting',
	'keyfield'=>'id',
	'pageName'=>$this->txt['admin_setting'],
	'tableName'=>"admin_setting",
	'menuList'=>array(
			'create'=>array('lv'=>0, 		'type'=>'',	'tag'=>'setting&action=create', 'title'=>$this->txt['create_setting']	,'core'=>'./core/create.php'),
			//'list'=>array('lv'=>1, 			'type'=>'link',	'tag'=>'setting&action=list', 'title'=>'Modify setting'	,'core'=>'./core/list.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'setting&action=list', 'title'=>$this->txt['list_setting']	,'core'=>'./core/edit.php'),
			
			
			'sort'=>array('lv'=>0, 		'type'=>'',	'tag'=>'setting&action=sort', 'title'=>$this->txt['sort_setting']	,'core'=>'./core/sort.php',
			'sort_setting'=>array(
					'cat'=>false,
					//'cat_array'=>$carSelect,
					'main_field'=>'id',
					'sort_type'=>'asc',
					'col_val'=>array(
					array('name'=>'rank',	'tt'=>$this->txt['rank'],	'width'=>'10%'),
					array('name'=>'opt_title',	'tt'=>$this->txt['title'],	'width'=>'30%'),
					array('name'=>'opt_value',	'tt'=>$this->txt['value'],	'width'=>'50%'),
					)
			
			)
			
			),
			
			'list'=>array('lv'=>1, 		'type'=>'link',	'tag'=>'setting&action=list', 'title'=>$this->txt['list_setting'],'core'=>'./core/list.php',
			'width'=>(($this->user_lv>0)?'79%':'62%'),
			'sublink'=> array(
					array('lv'=>0,'href'=>'setting&action=sort', 'title'=>$this->txt['sort']	,'width'=>'17%', 'icon'=>'fa-bars' ),
					array('lv'=>0,'href'=>'setting&action=create', 'title'=>$this->txt['create']	,'width'=>'17%', 'icon'=>'fa-plus' ),
				)
			),
			
			
			
	),
 
	'allValue'=>$fixedField,
	'firstWidth'=>'70',
	'logfield'=>'opt_title',
	'delete_lv'=>0,
	
	'orderby'=>' cast(rank as unsigned) ',
	'orderby_dir'=>'	asc ',
	 
);
?>