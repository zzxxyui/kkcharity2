<?php
$prefix=Config::get('database.connections.mysql.prefix');
$fixedField = array (
	
	array($this->txt['id'] , "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,		//edit		insert 	updated	---,,
			array('list-hidden'=>true
			 ,'list-order'=>1
			)
		 
	),
 	array('Account Information' , "----", 
			array("LG-START","required"), 
			array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
			array("SHOW", false, false, array()) 		//edit		insert 	updated	---
	),
	
 
	
	
	array( $this->txt['display_name']   , "name", 
			array("VAL","required"), 
			array("SHOW", "120", true, false), 
			array("SHOW", true, true,	array()),
			array('list-order'=>2)
	 ),
	 
	
	
	array( 'Email'  , "email", 
			array("VAL","email"), 
			array("SHOW", "120", true, false), 
			array("SHOW", true, true,	array()),
			array('list-order'=>3)
	 ),
	 
	 array($this->txt['status']  , "status", 
			array("STATUS","required"), 
			array("SHOW", "60", true, false), 
			array("SHOW", true, true, array()),	
				array(
				'search'=>"   stype: 'select', searchoptions:{ sopt:['eq'], value: ':ALL;1:".$this->txt['enabled'] .";0:".$this->txt['disabled'] ."' }",
				'list-order'=>6
				,
				'option'=>array(
					'array'=>array(
						array('val'=>1,'tt'=>'Enabled'),
						array('val'=>0,'tt'=>'Disabled'),
					),
					'default'=>0,
					)
				
				) 


	),
	array( $this->txt['create_date'] , "created_at", 
			array("FIX",""), 
			array("SHOW", "160", true, false), 
			array("SHOW", true, false, array()) ,
			array(	'list-order'=>7)
	),
	array( $this->txt['mod_date']  , "updated_at", 
	array("FIX",""), 
	array("HIDDEN", "160", true, false), 
	array("SHOW", true, true, array()) 
	),
	
	
 
	array( "---", "----", 
			array("LG-END","---"), 
			array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
			array("SHOW", false, false, array()) 		//edit		insert 	updated	---
	),
	
	array( $this->txt['login_info'] ,  "----", 
			array("LG-START","required"), 
			array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
			array("SHOW", false, false, array()) 		//edit		insert 	updated	---
	),
	array( $this->txt['admin_lv']   , "roles_id", 
			array("ADMIN-LEVEL","required"), 
			array("SHOW", "120", false, false), 
			array("SHOW", true, true,	array()),	
				array('listsql'=>' (select name from  '.$prefix.'roles  where id=roles_id) as roles_id ',
				'list-order'=>4)
	 ),
	 
	 
	 


	array( $this->txt['username']  , "username", 
			array("ADMIN-USER","required"), 
			array("SHOW", "180", true, false), 
			array("SHOW", true, true, array()) ,
			array(	'list-order'=>5)
	),
	array( $this->txt['password']  , "password", 
			array("ADMIN-PASSWORD",""), 
			array("HIDDEN", "0", true, false), 
			array("SHOW", true, true, array()) 
	),
	array( $this->txt['cpassword']  , "re-password", 
			array("ADMIN-RE-PASSWORD",""), 
			array("HIDDEN", "0", true, false), 
			array("SHOW", false, false, array()) 
	),


	
	array( "---", "----", 
			array("LG-END","---"), 
			array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
			array("SHOW", false, false, array()) 		//edit		insert 	updated	---
	),
	
	
	 

);
 
$mycofig=array(


	'lv'=>1,
	'tag'=>'madmin',
	'keyfield'=>'id',
	'pageName'=>'User management',
	'tableName'=>"users",
	'menuList'=>array(
			'create'=>array('lv'=>1, 	'type'=>'',	'tag'=>'madmin&action=create', 'title'=>$this->txt['create']	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 	'type'=>'',	 'title'=>$this->txt['edit_admin']		,'core'=>'./core/edit.php'),
			 
			'list'=>array('lv'=>1, 		'type'=>'link',	'tag'=>'madmin&action=list', 'title'=>'User/Admin'		,'core'=>'./core/list.php',
			'width'=>'79%'
			,'sublink'=> array( 
					array('lv'=>1,'href'=>'madmin&action=create', 'title'=>$this->txt['create']	, 'icon'=>'fa-plus' ),
				)
			),
			
	),
 
	'list-order'=>true,
	
'sqlplus_selectadd'=>'',
 'sqlplus_select'=>'',
 'sqlplus_table'=>'',
 'sqlplus_where'=>'',
 'sql_plus'=>'',
 'orderby'=>'',
 'orderby_dir'=>'',
	
	'firstWidth'=>'70',
	'allValue'=>$fixedField,
	'logfield'=>'username',
	
	
	
);
?>