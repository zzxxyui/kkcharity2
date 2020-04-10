<?php

 


$fixedField = array (
	
	array( "ID", "id", 
			array("ID"), 
			array("SHOW", "50", true, false), 			//list		display  ---	search 	===
			array("SHOW", true, false, array()) ,array('list-hidden'=>true)		//edit		insert 	updated	---
	),
	
	
	

array('Payment Info'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),		


array(  'Payment Status ',"payment_status", 
													array("FIX",""), 
													array("SHOW", "90", false, false), 
													array("SHOW", true, true,	array())
											 ),
array(  'Transaction id ',"paypal_json", 
													array("PAYMENT_INFO",""), 
													array("HIDDEN", "90", false, false), 
													array("SHOW", true, true,	array())
											 ),


array(  'Transaction id ',"paypal_tid", 
													array("FIX",""), 
													array("SHOW", "90", true, true), 
													array("SHOW", true, true,	array())
											 ),


array(  'Amount ',"amount", 
													array("FIX",""), 
													array("SHOW", "90", true, true), 
													array("SHOW", true, true,	array())
											 ),


array(  'Shipping Fee ',"amount_ship", 
													array("FIX",""), 
													array("SHOW", "90", true, true), 
													array("SHOW", true, true,	array())
											 ),




array(  'Total Amount ',"total_amount", 
													array("FIX",""), 
													array("SHOW", "90", true, true), 
													array("SHOW", true, true,	array())
											 ),




							 
 
 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),	
 
 
	

array('User Info'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),		


				array(  'Email ',"ppl_email", 
													array("FIX",""), 
													array("SHOW", "80", true, true), 
													array("HIDDEN", true, true,	array())
											 ),
				array(  'Surname ',"ppl_sname", 
													array("FIX",""), 
													array("SHOW", "40", true, true), 
													array("HIDDEN", true, true,	array())
											 ),
				array(  'Given Name ',"ppl_gname", 
													array("FIX",""), 
													array("SHOW", "40", true, true), 
													array("HIDDEN", true, true,	array())
											 ),
											 
				array(  'ppl json  ',"ppl_json", 
													array("PPL_INFO",""), 
													array("HIDDEN", "90", false, false), 
													array("SHOW", true, true,	array())
											 ),
											 

											 
  

							 
 
 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),							


array('Donation'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 ),		
 
 
 											 
				array(  ' ',"donation_id", 
													array("DN_INFO",""), 
													array("HIDDEN", "90", false, false), 
													array("SHOW", true, true,	array())
											 ),
											 
 array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),		
 
 
 
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

		'userright'=>array(
			'save'=>array(
				'lv'=>-1
			),
			'delete'=>array(
				'lv'=>-1
			)
		),
		
		
	'lv'=>1,
	'tag'=>'payment_record',
	'keyfield'=>'id',
	'pageName'=>'Payment Record ',
	'tableName'=>'payment_record', 
	
	
	'menuList'=>array( 
		//	'create'=>array('lv'=>1, 		'type'=>'',	'tag'=>'payment_record&action=create', 'title'=>'Create'	,'core'=>'./core/create.php'),
			'edit'=>array('lv'=>1, 		'type'=>'',	'tag'=>'payment_record&action=edit', 'title'=>'Payment Record '	,'core'=>'./core/edit.php'),
		 
			'list'=>array('lv'=>1, 		
			'type'=>'link',	'tag'=>'payment_record&action=list', 'title'=>'Payment Record'	,'core'=>'./core/list.php',
			'width'=>'100%'
			,'sublink'=> array(
					//  array('lv'=>1,'href'=>'payment_record&action=sort', 'title'=>'Sort'	,'width'=>'17%'),
				//	array('lv'=>1,'href'=>'payment_record&action=create', 'title'=>'Create'	,'width'=>'17%'),
				)
			
			),
 
 
			 
	 
			
			
	),
 
	'allValue'=>$fixedField,

 'firstWidth'=>'40', 
	'logfield'=>'id',
	
	
	'orderby'=>'  id ',
	'orderby_dir'=>' desc  ', 
	
'other_function'=>array( 
)
	
	
	 
 
 /*
	'sqlplus_selectadd'=>'	t1.	',
	'sqlplus_select'=>' ',
	'sqlplus_table'=>'	as t1 left join '.DB_START.'payment_record_cat as t2 on( t1.node_id=t2.id) ',
	'sqlplus_where'=>'	',
	 
	*/
	
	
	
);
?>