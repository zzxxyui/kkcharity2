<?php

class adminBaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	 
	 
	var $user_id=0;	 
	var $user_lv=999;	 
	 
	function __construct() {
		if(Auth::user()->check()){
			
				$this->txt=Config::get('admin_lang_en');
				$this->user_id=Auth::user()->get()->id;
				$this->user_lv=(Auth::user()->get()->roles_id)-1; 
		
		}
		
	}
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


}