<?php

class frontEndBaseController extends  kkcController {
 


	 
	  
	public	function getdefault(){ 
			
			  
			 switch($this->lang){
 
			
			case 2:
						  
		 $this->form_setting=array(
		
		'mail_subject'=>'聯絡我們',
		
	//	'mail_from'=>'test@in-concept.com',
		
		'title'=>'聯絡我們',
		'subtitle'=>'',
	 
		
		
		'option_list'=>array(
		
 
  		array(
							'tt'=>'<input type="hidden" name="lang_val" value="'.$this->lang.'" />',
							'type'=>'CUSTOM', 
						), 
					
 
 
 
		array(
							'tt'=>'姓名:',
							'type'=>'text',
							'class'=>'form-control fs16',
							'name'=>'app-name',
							'tt_mail'=>true,
							'req'=>'required',
						), 
					
					array(
							'tt'=>'電郵:',
							'type'=>'text',
							'class'=>'form-control email fs16',
							'name'=>'app-email', 
							'req'=>'required',
						),
					
	 
					array(
							'tt'=>'主題:',
							'type'=>'text',
							'class'=>'form-control fs16',
							'name'=>'app-subject',
							'req'=>'required',
						),
 						

							
								
 
		array(
				'tt'=>'信息:',
				'type'=>'textarea',
				'class'=>'form-control fs16 ',
				'name'=>'app-msg', 
				'req'=>'',
			),
			
		
	array(
				'tt'=>'驗證碼:',
				'type'=>'captcha', 
				'name'=>'captcha',
				'class'=>'form-control fs16',
				'req'=>'required',
			), 
 
 
		
	array(
				'tt'=>'提交',
				'type'=>'submit_app', 
				'class'=>' radBtn btn-dred',
				'name'=>'submit', 
				'req'=>'required',
			), 	
		
		)
		
		
		);
		
		
			break;
			
			
			
			
			default:	  
		 $this->form_setting=array(
		
		'mail_subject'=>'Contact Us',
		
	//	'mail_from'=>'test@in-concept.com',
		
		'title'=>'Contact Us',
		'subtitle'=>'',
	 
		
		
		'option_list'=>array(
		
		
  		array(
							'tt'=>'<input type="hidden" name="lang_val" value="'.$this->lang.'" />',
							'type'=>'CUSTOM', 
						), 
					
 
 
 
		  
		array(
							'tt'=>'Name:',
							'type'=>'text',
							'class'=>'form-control fs16',
							'name'=>'app-name',
							'tt_mail'=>true,
							'req'=>'required',
						), 
					
					array(
							'tt'=>'Email:',
							'type'=>'text',
							'class'=>'form-control email fs16',
							'name'=>'app-email', 
							'req'=>'required',
						),
					
					array(
							'tt'=>'Subject:',
							'type'=>'text',
							'class'=>'form-control fs16',
							'name'=>'app-subject',
							'req'=>'required',
						),
 						

 
						
			array(
				'tt'=>'Message:',
				'type'=>'textarea',
				'class'=>'form-control fs16',
				'name'=>'app-msg', 
				'req'=>'required',
			),
	array(
				'tt'=>'Validation Code:',
				'type'=>'captcha', 
				'name'=>'captcha',
				'class'=>'form-control fs16',
				'req'=>'required',
			), 
 
 
		
	array(
				'tt'=>'SUBMIT',
				'type'=>'submit_app', 
				'class'=>' radBtn btn-dred',
				'name'=>'submit', 
				'req'=>'required',
			), 
		
		
		)
		
		
		);
		
			 } //switch
}



	 	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	


	 
	
	
	
	 
}