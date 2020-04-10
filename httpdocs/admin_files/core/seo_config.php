<?php 

/* include in admin controller --------  Function:	MYF_seo_setting */


switch($this->type){

case 'all_2lang': 
	$foreach_array=array(
	array('Seo Setting'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),
	
	
		
		
		
array( "", "----", 
array("TAB-CNT-START",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'cr'=>'seo_lang1',
									)
								
								)	
),
						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>$this->txt['eng'],
												'key'=>'seo_lang1',		
									)
								
								)		//edit		insert 	updated	---
						),
					
					
									array( "Website Title" , "web_title1", 
																	array("VAL","  "),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
									array( "H1 Value", "h1_value1", 
																	array("VAL",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Keyword", "keyword1", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Description", "description1", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
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
												'title'=>'繁體',
												'key'=>'seo_lang2',				
									)
								
								)		//edit		insert 	updated	---
						),
					
									array( "Website Title繁體" , "web_title2", 
																	array("VAL","  "),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
									array( "H1 Value繁體", "h1_value2", 
																	array("VAL",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Keyword繁體", "keyword2", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Description繁體", "description2", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
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

);
	
break;
	
	
	
case 'all_3lang': 
	$foreach_array=array(
	array('Seo Setting'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
),
	
	
		
		
		
array( "", "----", 
array("TAB-CNT-START",), 
array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'cr'=>'seo_lang1',
									)
								
								)	
),
						array( "", "----", 
								array("TAB-START",), 
								array("HIDDEN", "0", false, false), 			//list		display  ---	search 	===
								array("SHOW", false, false, array()) ,array(
									'TAB'=>array(
												'title'=>$this->txt['eng'],
												'key'=>'seo_lang1',		
									)
								
								)		//edit		insert 	updated	---
						),
					
					
									array( "Website Title" , "web_title1", 
																	array("VAL","  "),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
									array( "H1 Value", "h1_value1", 
																	array("VAL",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Keyword", "keyword1", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Description", "description1", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
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
												'title'=>'繁體',
												'key'=>'seo_lang2',				
									)
								
								)		//edit		insert 	updated	---
						),
					
									array( "Website Title繁體" , "web_title2", 
																	array("VAL","  "),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
									array( "H1 Value繁體", "h1_value2", 
																	array("VAL",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Keyword繁體", "keyword2", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Description繁體", "description2", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
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
												'title'=>'简体',
												'key'=>'seo_lang3',				
									)
								
								)		//edit		insert 	updated	---
						),
					
									array( "Website Title简体" , "web_title3", 
																	array("VAL","  "),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
									array( "H1 Value简体", "h1_value3", 
																	array("VAL",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Keyword简体", "keyword3", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
									 ),
					
									array( "Meta Description简体", "description3", 
																	array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
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

);
	
break;




	case 'default':
	default:
	$foreach_array=array(
	array('Seo Setting'  , "----", 			array("LG-START",""),array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 	 
	),
		
						array( "Website Title" , "web_title", 
														array("VAL","  "),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
						 ),
						array( "H1 Value", "h1_value", 
														array("VAL",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
						 ),
		
						array( "Meta Keyword", "keyword", 
														array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
						 ),
		
						array( "Meta Description", "description", 
														array("TEXT",""),array('HIDDEN', "0", false, false),array('SHOW', false, false,	array())
						 ),
	array( "---", "----", 			array("LG-END","---"), 			array("HIDDEN", "0", false, false),array("SHOW", false, false, array()) 		),
	 
	);
	 
}


?>