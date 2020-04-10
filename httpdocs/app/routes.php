<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/*-----------For multi Langauge ----------*/
/*
	$languages = array('en','zh-hk');
	$locale = Request::segment(1);
	if(in_array($locale, $languages)){
		App::setLocale($locale);
	}else{
		$locale = 'en';
	}



	Route::group(array('prefix' => $locale), function()
	{
Route::get('/', array('uses' => 'frontEndController@showHome'));
Route::get('/{p}', array('uses' => 'frontEndController@showInner'))->where('p', '[A-Za-z0-9]+');


	});
*/
/*-----------For multi Langauge ----------*/
 

/*-----------For one Langauge ----------*/


/*-----------For one Langauge ----------*/


 
 	$languages = array('en','zh');
	$locale = Request::segment(1);
	if(in_array($locale, $languages)){
		App::setLocale($locale);
	}else{
		$locale = 'en';
	
	}
	
	
		Route::group(array('prefix' => $locale), function()
	{
Route::get('/', array('uses' => 'frontEndController@showHome'));
 

//Route::get('/{p}', array('uses' => 'frontEndController@switchPage'))->where('p', '[A-Za-z0-9]+');
Route::get('/{p?}/{p2?}/{p3?}', array('uses' => 'frontEndController@switchPage'))->where('p', '[A-Za-z0-9\-\_]+')->where('p2', '[A-Za-z0-9\-\_]+')->where('p3', '[A-Za-z0-9\-\_]+');


	});
	

/*----------------------------------ADMIN----------------------------------------*/
 
			 
if(Auth::user()->check()){
						Route::get(ADMIN_PATH, array('uses' => 'adminController@showAdmin'));
						Route::post(ADMIN_PATH.'/process', array('uses' => 'adminController@doAction'));
						 
			
				
				
Route::post('userfile/myfileupload_caption_save', array('uses' => 'fileuploadController@saveCaption'));
Route::post('userfile/myfileupload_caption', array('uses' => 'fileuploadController@loadCaption'));
Route::post('userfile/myfileupload_sort', array('uses' => 'fileuploadController@savesort'));
Route::post('userfile/myfileupload_delmany', array('uses' => 'fileuploadController@delmany'));
Route::post('userfile/myfileupload_delone', array('uses' => 'fileuploadController@delone'));
Route::post('userfile/myfileupload_list', array('uses' => 'fileuploadController@getList'));
Route::post('userfile/myfileupload', array('uses' => 'fileuploadController@doUpload'));
Route::post('userfile/uploadbox', array('uses' => 'fileuploadController@get_upload_box'));

}else{
		Route::post(ADMIN_PATH.'/process', array('uses' => 'adminController@doAction_needlogin'));
	
		Route::get(ADMIN_PATH, array('uses' => 'adminController@showLogin'));
		
		//Route::post('admin/login', array('uses' => 'adminController@doLogin'));
}
Route::get(ADMIN_PATH.'/logout', array('uses' => 'adminController@doLogout'));


Route::post(ADMIN_PATH.'/login', array('uses' => 'adminController@doLogin'));
 
Route::post('oimgUpload', array('uses' => 'frontEndController@doOimgUpload'));
 /*
Route::post('payform', array('uses' => 'frontEndController@payform'));
Route::post('startPayment', array('uses' => 'frontEndController@startPayment'));
*/

 
Route::post('process', array('uses' => 'frontEndController@doAction'));
Route::post('process/contactus', array('uses' => 'sformController@appSubmit_cs'));

Route::get('process/captchaImg', array('uses' => 'captchaController@captchaImg'));
Route::get('process/captchaCheck', array('uses' => 'sformController@captchaCheck'));
Route::get('process/captchaImg2', array('uses' => 'captchaController@captchaImg2'));
Route::get('process/captchaCheck2', array('uses' => 'sformController@captchaCheck2'));
 


//Route::get('/{p}', array('uses' => 'frontEndController@defaultLang'));
Route::get('/', array('uses' => 'frontEndController@defaultLang'));


 /*
Route::get("/draft", function() {
    ob_start();
    require("./draft/index.php");
    return ob_get_clean();
});

*/


/*
App::error(function(Exception  $exception)
{
    Log::error($exception);

    return   Redirect::to('404');	 
	
//	Redirect::action('frontEndController@notFoundPage');
});
*/

/*-----------For multi Langauge ----------*/
/*
 Route::get('/{lg?}', function($lg = null)
{
     return Redirect::to('/en', 301); 
});*/

/*-----------For multi Langauge ----------*/



 