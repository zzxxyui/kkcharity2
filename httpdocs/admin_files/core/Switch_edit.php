
<?php 
$this->js_us='';
$this->ckedit='';
$this->editJs='';
$this->in_editJs='';
$this->isupdate=false;
$this->js_color=false;

$ckjs=''; 
if($this->have_seosetting){
$valArray = $this->seo_val;
 
 
}else{
	switch($this->MyConfig['tableName']){
	
	case 'users':
	if($this->itemid>0){
		$valArray = DB::table($this->MyConfig['tableName'])->select('id')->where('id', $this->itemid)->where('roles_id','>=', Auth::user()->get()->roles_id)->first();	
			$checlTv=( 	count($valArray )>0	&& $valArray->id!='')?$valArray->id:exit();
			if(	$checlTv=='') exit();
			
		$valArray = DB::table($this->MyConfig['tableName'])->where('id', $this->itemid)->first();	
	}
	break;
	default:
$valArray = DB::table($this->MyConfig['tableName'])->where('id', $this->itemid)->first();	
		}
}
$res='';


foreach($foreach_array as $ff){
	if($ff[4][0]=='SHOW'){
		$reqStar='';
		if ( ! isset($ff[2][1])) { $ff[2][1]= null;}
		if (preg_match("/required/i",$ff[2][1])) {
			$reqStar='<span style="color:red">*</span>';
		}
		
		
if($this->have_seosetting){
		$thisvalue=($this->itemid>0	&& 	isset($valArray[$ff[1]]) 	)?$valArray[$ff[1]]:'';
}else{
		$thisvalue=($this->itemid>0	&& 	property_exists($valArray, $ff[1])	)?$valArray->$ff[1]:'';
}
		
		
		
		if($this->itemid>0){
		$this->isupdate=true;
		}	
		switch($ff[2][0]){
			

		case 'KCP_FILE_PATH':
		//$res.=($isupdate)?'<p><label>'.$ff[0].':'.$reqStar.' </label><br/><strong style="padding:5px 0 5px 0; font-size:14px" >'.$valArray[$ff[1]].'</strong></p>':'';
		$res.='
<div class="form-group">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
   <label class="  control-label" > <a class="btn btn-info btn-sm" href="'.$thisvalue.'" title="'.$thisvalue.'" target="_blank">Open File</a></label> 
    </div>
</div>';
		break;
		
		 
					
			
			
			
		/*------------------KKC----------------*/
		
		
		
case "KKC-LIST":
   $this_key=$ff[2][1]	;
$lk_sort='';
$lk_new='';
 $vl_ccc='<div class="well well-sm m0 mb5 clearfix">
   <div class="col-xs-8">Please create the Project first.</div>
   </div> ';	
   
if($this->isupdate){

	 $lk_sort=url('admin?q='.$this_key.'&action=sort&id='.$valArray->id);
	 $lk_new=url('admin?q='.$this_key.'&action=create#cat_id='.$valArray->id);
	 
 $lk_sort='<a href="'.$lk_sort.'" target="_blank" class="pull-right btn btn-info btn-sm" style="padding:2px 5px 2px 5px;"><i class="fa fa-list"></i> Sort</a>';
 $lk_new='<a href="'.$lk_new.'" target="_blank" class="pull-right btn btn-success btn-sm" style="padding:2px 5px 2px 5px;"><i class="fa fa-plus"></i> Create New</a>';
 
   $vl_ccc=''; 
   	$results = DB::table($ff[2][1]	)->where('node_id',$valArray->id)->orderBy( 'rank','asc')->get();	
	if(count(	$results)>0){
		foreach ($results as $ms) {
		 $lk=url('admin?q='.$this_key.'&action=edit&id='.$ms->id);
		 
		 $stat=($ms->status==1)?'<p class="m0 text-success mt5 pull-right"><strong>Enabled&nbsp;&nbsp;&nbsp;</strong></p>':'<p class="m0 text-danger mt5 pull-right"><strong>Disabled&nbsp;&nbsp;&nbsp;</strong></p>';
   $vl_ccc.='<div class="well well-sm m0 mb5 clearfix"  style="padding:2px 5px 2px 5px;"> 
   <div class="col-xs-8 mt10">'.$ms->rank.'. <a href="'.$lk.'" class="fs14" target="_blank">'.$ms->setdate.' - '.$ms->title1.'</a></div>
 
	   <div class="col-xs-4 text-right  m0 p0 clearfix">
	   <a href="'.$lk.'" target="_blank" class="btn btn-primary pull-right"  style="padding:2px 10px 2px 10px; margin:2px 0 0 0;"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
	   '.	 $stat.' 
	   </div>
   </div> ';


				}

		 } else{
			 $vl_ccc='<div class="well well-sm m0 mb5 clearfix">
   <div class="col-xs-8">No Item.</div>
   </div> ';	
   
			}

} 
		$res.='
		
		<div id="'.myfunc::only_az($ff[0],'_').'" class="panel panel-primary">
<div class="panel-heading clearfix">



<ul class="nav  nav-pills p0">
<li class="pull-left mt5">'.$ff[0].'</li> 
<li  class="pull-right">'. $lk_sort.'</li>
<li class="pull-right">'. $lk_new.'</li>
</ul>
</div>
<div class="panel-body">
    <div class="col-xs-12 m0 p0 clearfix">
		  '.$vl_ccc.'
	</div>
</div>
</div>
		';
		
		$this->in_editJs.=' ';
		
		
		
break;	
	
		
			
			
/*------------------KKC----------------*/
			
			
			
			
/*---------------INCONCET-----------------*/
			
							
case "VAL-SELECTBOX":
  
   

   $vl_opt='<option value="">-----</option>';
   	$results = DB::table($ff[5]['db']	)->orderBy( $ff[5]['orderby'][0],  $ff[5]['orderby'][0])->groupBy($ff[5]['orderby'][0])->get();	
	if(count(	$results)>0){
		foreach ($results as $ms) {
			$ssld=($thisvalue==$ms-> $ff[5]['val'][0])?' selected="selected" ':'';
   $vl_opt.='<option '.$ssld.' value="'.$ms-> $ff[5]['val'][0].'">'.$ms-> $ff[5]['val'][1].'</option>';


				}

		 }
 
		$res.='
		  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-7">
     <input type="text" id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' form-control" value="'.$thisvalue.'" />
    </div>
    <div class="col-sm-2">
	<select id="'.$ff[5]['divid'].'_select" class="form-control"> '.   $vl_opt.'</select>
	</div>
		
  </div>
		';
		
				$this->in_editJs.=' 
				
				$( "#'.$ff[5]["divid"].'_select" ). change(function(){
		var ggx=$(this);
 $( "#'.$ff[5]["divid"].'" ).val( ggx.val() );
		}) ';
		
		
		
	break;		
	

	
			case 'DN_INFO':
		  
 
 
$this->filepath_url=DOMAIN.'userfile/';
$this->filepath_dir=$_SERVER['DOCUMENT_ROOT'].ROOT_PATH.'userfile/';
 
    $this_content='';
 $ppms=	 DB::table( 'donation'  )->where('id', $valArray->donation_id) ->first();		 
if(count($ppms)>0) 
{
$cng_arr=Config::get('gbkey.donation_onefile');

$thumb=''; 
	$ns ='';
	 	if($ppms->ff_thumb!=''){
				 	$thumb_val=explode(',',$ppms->ff_thumb); 						
				 	$thumb_total=ceil($thumb_val[0]);
				  	$thumb_path=$cng_arr['folder_val'].'/'.$thumb_val[1]; 
					// $ww=$cng_arr['max_w'];	
					// $hh=$cng_arr['max_h']; 
					 $ww=320;
					 $hh=400; 
					
					if( file_exists($this->filepath_dir.$thumb_path) && $thumb_total>0){
						$newcbsize = myfunc::imgVirtualResize( $this->filepath_dir.$thumb_path,	$ww,  $hh);	
 
					
						//$ns=' width="'.round($newcbsize[0]).'" height="'.round($newcbsize[1]).'"    ';
						
						 $ns=' class="img-responsive" ' ;
						$thumb='<img src="'. $this->filepath_url.$thumb_path .'" alt="" '.$ns.'/>';
					}
		}
if($thumb=='') $thumb='<img class="img-responsive"  src="'.url('static/images/pj_thumb.jpg') .'" alt=""  />';  
			
   $this_content='


 <div class="col-xs-12">
 
	 
		  <div class="col-xs-4">
		  '.$thumb.'
	  </div>
	  <div class="col-xs-8">

		
		 <table class="table m0" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<th width="200">Title:</th>
			<td>'.$ppms->title1.'</td>
		  </tr>
		  <tr>
			<th width="200">Desc.:</th>
			<td> '.myfunc::exp_fck($ppms->detail1).'</td>
		  </tr>
		  <tr>
			<th>Amount (HK$):</th>
			<td>'.myfunc::num1000($ppms->amount).'</td>
		  </tr>
		  
		  <tr>
			<td class="text-left"> <a class="btn btn-info" target="_blank" href="'.url('en/Donation/'.$ppms->url_rewrite).'">Access(Front End)</a></td>
			<td class="text-right"> <a class="btn btn-info"  target="_blank"  href="'.url('admin?q=donation&action=edit&id='.$ppms->id.'').'">EDIT</a></td>
		  </tr>
		  
		  </table>
  
 	 </div>
</div>
  ';
  
}
   
  
   
 
 
$res.='
<div class=" clearfix">
'.	$this_content.'
     
		
  </div>';
		
break;	
			case 'PPL_INFO':
		  
		$sgtr=''; 		 
	 
						if($valArray->ppl_json!=''){
							
								$jsp=json_decode($valArray->ppl_json,true);
			
					foreach((array)$jsp as $jkey=>$jcal ){
						$sgtr.='
<div class="form-group">
    <label   class="col-sm-3 control-label">'.$jkey .':</label>
    <div class="col-sm-9">
   <label class="  control-label" >  '.nl2br($jcal).'</label>
    </div>
</div> 
						   ';
					
					}
	}
		
$res.='
<div class="form-group clearfix">
'.	$sgtr.'
     
		
  </div>';
		
break;				
					
					
						
			case 'PAYMENT_INFO':
		  
		$sgtr='';
				$jsl='';			 
						if($valArray->paypal_json!=''){
							
								$jsp=json_decode($valArray->paypal_json,true);
						 
		 
					foreach((array)$jsp as $jkey=>$jcal ){
						
						$jVal=(is_array($jcal))?myfunc::Arr2Box($jcal):$jcal;
						
						$jsl.='
							    <div  class="col-xs-12  fs14"> 	<strong style="font-size:14px"> '.$jkey.'</strong> </div  > 
					  <div  class="col-xs-12    "> 	<span style="font-size:14px"> 	 '.$jVal.'</span></div  > 
						   ';
					
					} 
					
					
								$sgtr='    <div class="col-sm-7"><label  class="text-success control-label">SUCCESS</label ></div>
								
			    <label  class="col-sm-3 control-label mt10"> Paypal ID:	</label  > 
			    <div class="col-sm-9">		
				
						<div class="clearfix">
<label  class=" control-label mt10 pull-left">'.$valArray->paypal_id.'	 </label  > 
 


	<button type="button" class="btn btn-primary   pull-right mt10" data-toggle="modal" data-backdrop="false" data-target="#InvCmyModal">
Transaction record
</button>

<!-- Modal -->
<div class="modal fade" id="InvCmyModal" tabindex="-1" role="dialog" aria-labelledby="InvCmyModalLabel"   aria-hidden="true" style="margin-top:60px">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Transaction record</h4>
      </div>
      <div class="modal-body">
 <div class="row" style="overflow:auto; height:500px"> '.	$jsl.'</div>
      </div>
    </div>
  </div>
</div>
	 
								
								
									
				</div>		
								
				</div>		';
				
				
							 $this->in_editJs.='  
							 
 $("#InvCmyModal").on("shown.bs.modal", function (e) {
$("body").removeClass("modal-open");
})

';
 
		}
		
						
		
	 		$res.='
				  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">Payment Type:</label>
'.	$sgtr.'
     
		
  </div>';
		
break;	
case 'INV-LINK':
	if(	$this->isupdate){	
	
	$taglink=DOMAIN.'useful-gadgets/online-payment#?cc='.$valArray->customer_code.'&ic='.$valArray->invoice_code;	
$res.='
		  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':</label>
    <div class="col-sm-9">
	
   <a  class="btn btn-link"  href="'.$taglink.'" target="_blank">'.$taglink.'</a><br/>
   <input value="'.$taglink.'" class="form-control" style="width:300px;"/>
    </div>
  </div>
';
	}else{
$res.='
		  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':</label>
    <div class="col-sm-9">
Please create the item first.
    </div>
  </div>
';
	}
					
break;	
			/*---------------INCONCET-----------------*/
			
			
	
		
			
			
			
	/*------------------------------------------------------RAS--------------------------------------------------------------*/		

		
		
		case 'EMAIL-SLIST':
		$sadk='';
		if($thisvalue!=''){
		$thisvalue=str_replace('"','',$thisvalue);
		$thisvalue=str_replace('[','',$thisvalue);
		$thisvalue=str_replace(']','',$thisvalue);
		$sajson=explode(',',$thisvalue);
 
		foreach($sajson as $hhj){
		
		$sadk.='<div class="btn  btn-success btn-sm mb5 p5" style="margin:0 5px 5px 0;">'.$hhj.'</div>';
		}
		}
		$res.='
		  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
    '.$sadk.'
    </div>
  </div>
		';
		break;
	/*------------------------------------------------------RAS--------------------------------------------------------------*/	
	
	
			
 case 'ADMIN-LEVEL':
		$res.=$this->db_load_admin_level($ff[0],$ff[1],	$thisvalue);
		break;
	
	
	
			
		
				
		case 'APP-JSON':
		$jsonData=json_decode($thisvalue,true);
			
		$getFromValue = (new frontEndController); 
		$fTitle=$getFromValue->form_setting;
		
		$genTitleVal=array();
foreach($fTitle['option_list'] as $jval){
		$genTitleVal[$jval['name']]=$jval;
}
		$jDesc='';
foreach($jsonData as $jval){
		
		$thistitle= 	$genTitleVal[$jval['key']];
		$jDesc.='  <div class="form-group clearfix">
    <label   class="col-sm-3 text-right">'. $thistitle['tt'].':</label>
    <div class="col-xs-9">
 '. $jval['value'].' 
    </div>
	<div class="col-xs-12" style="border-bottom:1px solid #ccc;"></div>
  </div>';
   
}
		
	
		$res.=$jDesc;
		break;
			
			
			
		case 'URL-REWRITE':
		$nochange=(isset($ff[5]['nochange']))?$ff[5]['nochange']:false;
		 $alert_btn='    <a href="#" tabindex="0" class="btn    mypopover p0" data-toggle="popover" data-trigger="hover"  data-content="You use <span class=\'text-bold text-red\'>A-Z</span>,<span class=\'text-bold text-red\'> a-z</span>, <span class=\'text-bold text-red\'>0-9</span>, <span class=\'text-bold text-red\'>-</span> , <span class=\'text-bold text-red\'>_ </span>
				<br/>There are no difference between uppercase and lowercase letters
				<br/>at least 3 character"><i class="fa fa-info-circle fa-lg"></i></a>';
		if($nochange || $this->is_clone){
		$inpVal='<label class="lh25 pt5 m0">'.	$thisvalue.' </label>
		<input type="hidden"  id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' url-rewrite " value="'.	$thisvalue.'" />
		';
		}else{
			 
		$haveopt=(isset($ff[5]['opt']['copy_from']))?$ff[5]['opt']['copy_from']:false;
		if($haveopt!=''){
		$inpVal='
		<div class="row m0 p0 clearfix">
		
		<div class="col-xs-8 p0 m0">
		<input type="text" style="width:100%;" id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' url-rewrite  form-control pull-left" min-length="3" value="'.$thisvalue.'" />
			</div>
			
		<div class="col-xs-4 p0 m0">
		<a  class="btn btn-block btn-warning cpyBtn_'.$ff[1].' pull-left" data-cr="'.	$ff[1].'" data-tag="'.	$haveopt.'" >Copy From Item Title</a>
		</div>
		</div>
		';
		
		$this->in_editJs.=' $( ".cpyBtn_'.$ff[1].'" ). click(function(){
		var ggx=$(this);
		var tgvcal= $("#"+ggx.data("tag")).val();
		
tgvcal=tgvcal.replace(/[^0-9a-zA-Z-_]/g, "-");
		$("#'.$ff[1].'").val(tgvcal);
		}) ';
		
		}else{
		$inpVal='<input type="text" style="width:100%;" id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' url-rewrite  form-control" min-length="3" value="'.$thisvalue.'" />';
		}
		
		}

		$this_id=myfunc::only_az($ff[0]);
if(	$this->isupdate){		
$res.=' <div class="form-group">
    <label   class="col-sm-3 control-label ">'.$ff[0].':'.$reqStar.' ' .$alert_btn.'</label>
    <div class="col-xs-9 clearfix">
	'.$inpVal.'
    </div>
  </div>';
}else{
	
	
$res.=' 
<div class="well">

<div class="row">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.' </label>
    <div class="col-xs-9">
	'.$inpVal.'
<div  style="padding:3px; margin-top:3px;">	You use <span class="text-bold text-red">A-Z</span>,<span class="text-bold text-red"> a-z</span>, <span class="text-bold text-red">0-9</span>, <span class="text-bold text-red">-</span> , <span class="text-bold text-red">_ </span>
				<br/>There are no difference between uppercase and lowercase letters
				<br/>at least 3 character
				<br/><br/>
				For exsample:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.DOMAIN.'<span class="text-red">url-rewrite</span>
				</div>
    </div>
  </div>
  </div>
  
  ';
  
  /*
$res.='<div class="panel panel-primary" id="'.	$this_id.'">
  <div class="panel-heading"><strong>'.$ff[0].':'.$reqStar.'</strong></div>
  <div class="panel-body">
  	<p class="grid_9 p0 m0">'.$inpVal.'</p>
				You use <span class="text-bold text-red">A-Z</span>,<span class="bold red"> a-z</span>, <span class="bold red">0-9</span>, <span class="bold red">-</span> , <span class="bold red">_ </span>
				<br/>There are no difference between uppercase and lowercase letters
				<br/>at least 3 character
					<br/>	<br/>
				For exsample:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.DOMAIN.'<span class="text-red">url-rewrite</span>
				</div>
  
  
		</div>
  ';*/
}
			
		$res.='';
		break;
		
		
							

		case 'RANK':
		$rankval=$thisvalue;
		if( is_numeric($rankval) ){
			$rankval=$rankval;
		}else{ 
			 
 
		$my_results = DB::table($this->MyConfig['tableName']	)->orderBy('rank', 'desc') ->first();	 
				if(count(		$my_results )>0){
					$rankval=ceil($my_results->rank);
						$rankval=$rankval+1;
				}
		}
		$rankval=ceil($rankval);
		$res.='
				  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9"><input type="text" id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' form-control" value="'.$rankval.'" />	
    
    </div>
  </div>
  
   
		';
		break;
		
		
		
		
		
		case 'CLONE':
		$rstr=($thisvalue==0)?'<p class="m0 pt5">-----</p>':'
		<a class="btn btn-default pull-left" href="'.url('admin?q='.$this->MyConfig['tag'].'&action=edit&id='.$thisvalue).'">View Original Item</a>
		';
		/*
		<p class="pull-left">

 <label class="checkbox-inline">  <input type="radio"   name="'.$ff[1].'" checked="checked" value="'.$thisvalue.'"/>&nbsp;&nbsp;Clone Item</label> 
 <label class="checkbox-inline">  <input type="radio"    name="'.$ff[1].'" value="0"/>&nbsp;&nbsp;Not Clone Item</label> 
		</p>
		
		*/
		
		$res.='
		  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':</label>
    <div class="col-sm-9 ">'.$rstr.'    </div>
  </div>
		';
		break;
		
		
		
		
		case 'TEXT':
		$res.='
		  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
     <textarea  id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' form-control" >'.$thisvalue.'</textarea>
    </div>
  </div>
		';
		break;
		
		
		
		
		case 'VAL-PWD':
		$res.='
		  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
     <input type="password" id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' form-control" value="'.$thisvalue.'" />
    </div>
  </div>
		';
		break;
		
		case 'VAL':
		$res.='
		  <div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
     <input type="text" id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' form-control" value="'.$thisvalue.'" />
    </div>
  </div>
		';
		break;
		
		case 'ID':
		$res.='<input type="hidden" name="'.$ff[1].'" id="'.$ff[1].'"  value="'.$thisvalue.'" />';
		break;
		
		
		case 'FIX-NUM':
		//$res.=($isupdate)?'<p><label>'.$ff[0].':'.$reqStar.' </label><br/><strong style="padding:5px 0 5px 0; font-size:14px" >'.$valArray[$ff[1]].'</strong></p>':'';
		$res.=($this->edit_page_type=='edit')?'
<div class="form-group">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
   <label class="  control-label" > '.myfunc::dgVal($thisvalue,2).'</label>
    </div>
</div>':'';
		break;
		
		case 'FIX-TEXT':
		//$res.=($isupdate)?'<p><label>'.$ff[0].':'.$reqStar.' </label><br/><strong style="padding:5px 0 5px 0; font-size:14px" >'.$valArray[$ff[1]].'</strong></p>':'';
		$res.=($this->edit_page_type=='edit')?'
<div class="form-group">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
   <p class="   mt5 mb5 text-left" > '.nl2br($thisvalue).'</p>
    </div>
</div>':'';
		break;
		
		case 'CUSTOM_COUPON':
		
		case 'FIX':
		//'.$reqStar.'
		//$res.=($isupdate)?'<p><label>'.$ff[0].':'.$reqStar.' </label><br/><strong style="padding:5px 0 5px 0; font-size:14px" >'.$valArray[$ff[1]].'</strong></p>':'';
		$res.=($this->edit_page_type=='edit')?'
<div class="form-group">
    <label   class="col-sm-3 control-label">'.$ff[0].':</label>
    <div class="col-sm-9">
   <label class="  control-label" > '.$thisvalue.'</label>
    </div>
</div>':'';
		break;
		
		
		case 'FIX_WITHVAL':
		//$res.=($isupdate)?'<p><label>'.$ff[0].':'.$reqStar.' </label><br/><strong style="padding:5px 0 5px 0; font-size:14px" >'.$valArray[$ff[1]].'</strong></p>':'';
		$res.=($this->edit_page_type=='edit')?'
<div class="form-group">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
   <label class="  control-label" > '.$thisvalue.'</label><input type="hidden" name="'.$ff[1].'" id="'.$ff[1].'"  value="'.$thisvalue.'" />
    </div>
</div>':'';
		break;
		
		 
		
		
				
		case 'CAT-LEVEL':
 
		
		$cr_select_val=(isset($_GET['cat_id']))?ceil($_GET['cat_id']):0;
		$cr_select_val=($thisvalue!='')?$thisvalue:$cr_select_val;
		
		if(	 isset($ff[5]['cat_setting']['limit_lv']) && $ff[5]['cat_setting']['limit_lv']>0){ 
		$this->cate_lv_limit_onoff=true;
		 $this->cate_lv_limit_val=$ff[5]['cat_setting']['limit_lv'];
		 }
		 
		 $this_catVal=$this->Layout_db_cate_level($ff[5]['cat_setting']['cattb'],$ff[0],$ff[1],$thisvalue,$ff[5]['cat_setting']['isItem']	,$ff[5]['cat_setting']['one_lv']	,$reqStar		);
		 if($this->isupdate){
		$this_catVal=' 
	

<div class="col-sm-7">	 '.$this_catVal.'		</div>
<div class="col-sm-2">
 <a class="btn btn-sm btn-success btn-block"  target="_blank" href="'.url('admin?q='.$ff[5]['cat_setting']['tag'].'&action=edit&id='.$thisvalue).'">Access Project</a>
		</div>
		';
		 }else{
		$this_catVal=	' <div class="col-sm-9">'. $this_catVal.'</div>';
		 }
		 
		$res.=	'<div class="form-group">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.' </label>
	 '.$this_catVal.'
		</div>';
		 
if($thisvalue==''){		
$this->pageJsAndCss.='<script type="text/javascript" src="'.url($this->admin_file.'js/jquery.ba-bbq.min.js').'"></script>';
$this->in_editJs.='
 
var cat_id = $.bbq.getState( "cat_id" );
if( parseInt(cat_id)>0){

$("#'.$ff[1].'").val(cat_id);

}
		';
}
		break;			
					
					
					
		
		case 'ADMIN-USER':
		$res.='		  <div class="form-group">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
     <input type="text" id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' form-control urlrewrite" minlength="3" value="'.$thisvalue.'" />
    </div>
    <div class="col-sm-9 pull-right"><div class="alert alert-info" role="alert" style="padding:3px; margin-top:3px;">
	You can use <span class="text-bold text-red">A-Z</span>,<span class="text-bold text-red"> a-z</span>, <span class="text-bold text-red">0-9</span>, <span class="text-bold text-red">-</span> , <span class="text-bold text-red">_ </span>
				<br/>There are no difference between uppercase and lowercase letters
				<br/>at least 3 character
	</div></div>

  </div> ';
		break;
		case 'ADMIN-PASSWORD':
		$password_id=$ff[1];
		$PlusCss=($this->edit_page_type=='create')?' required ':'';
		$res.='
		  <div class="form-group">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
     <input type="password" id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' form-control" value="" />
    </div>    </div>';
		break;
		case 'ADMIN-RE-PASSWORD':
		$res.='
		
		  <div class="form-group">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
     <input type="password" id="'.$ff[1].'" name="'.$ff[1].'" class="'.$ff[2][1].' form-control" equalTo="#'.$password_id.'"  value="" />
    </div>
  </div>';
		break;
		
		
		

		
		
		case 'CUSTOM':	$res.=' <div class="form-group clearfix">
    <label   class="col-sm-12 control-label text-left">'.$ff[0].'</label>
  </div>
  
  
		';		break;
		/*
		case 'CATEGORY':
		$res.=$this->db_load_category_select($ff,$this->MyConfig);
		break;
		*/
		case 'LG-START':	
		
		if(($ff[0]!='')){
		
		$this_id=myfunc::only_az($ff[0]);
		$res.='
<div class="panel panel-primary" id="'.	$this_id.'">
  <div class="panel-heading"><strong>'.$ff[0].'</strong></div>
  <div class="panel-body">';
  $this->form_nav.='<li><a href="#'.	$this_id.'">'.$ff[0].'</a></li>';
		}else{
		$res.='
		<div class="panel panel-default">
  <div class="panel-body">';
  
		}


  
  
  break;
  
  	case 'DATE':
		$this->js_us=true;
		$res.='
		
 <div class="form-group clearfix"  id="'.$ff[1].'_gp">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9 mt5">

 <div id="'.$ff[1].'_div" class="farbtastic_div">
<input type="text" id="'.$ff[1].'" name="'.$ff[1].'" class="form-control '.$ff[2][1].' input-text" value="'.$thisvalue.'" />
 </div>
 
 
    </div>
  </div> 
		';
	//	$this->editJs.=' $( "#'.$ff[1].'" ).datepicker({dateFormat: \'yy-mm-dd\'}); ';
		$this->in_editJs.=' $( "#'.$ff[1].'" ).datepicker({dateFormat: \'yy-mm-dd\'	,	        changeMonth: true,        changeYear: true }); ';
			
		break;
		
  
  case "COLOR":
  
  
			$this->js_color=true;
	 
			$def_color=$thisvalue;
			 
			$res .='	

 <div class="form-group clearfix"  id="'.$ff[1].'_gp">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9 mt5">

 <div id="'.$ff[1].'_div" class="farbtastic_div">
 <input type="text"  id="'.$ff[1].'" name="'.$ff[1].'" type="text" class="required form-control" style="background:0; width:200px;"  value="'.$def_color.'" />

 <div id="'.$ff[1].'_picker" class="farbtastic_contain"></div>
 </div>
 
 
    </div>
  </div>
  
  
  
	 
'; 
		$this->in_editJs.=" 
		
		if( $('#parent_id').val()!=0){
			$('#".$ff[1]."_gp').css({'display':'none'})
		}
		
 	$('#".$ff[1]."_picker').hide();
    $('#".$ff[1]."_picker').farbtastic('#".$ff[1]."',function(){

});
  	$('#".$ff[1]."').focus(function() {
	
	jQuery('<a/>', {  
    id: '#".$ff[1]."_close', 
	'class':' close-button'  ,
   	html: '<span class=\"close-button-btn\" style=\"cursor:pointer\"></span>',
   css:{ height:'25px',width:'25px',display:'block',cursor:'pointer',position:'absolute',top:'-10px',right:'-10px' },
   click: function(){
    $(this).parent().parent().hide();
  }
  
}).appendTo('#".$ff[1]."_picker .farbtastic');

  	$('#".$ff[1]."').blur(function() {
	 var in_val = $(this).val();
	 var in_va_bg = $(this).css('background-color');
	 if(in_val==''){
	 	 $(this).val('#000000');
	 }
	});
	

 		 $('.farbtastic_contain').css('z-index','1');
 		 $('.farbtastic_div').css('z-index','1');
 		 $('#".$ff[1]."_div').css('z-index','100');
 		 $('#".$ff[1]."_picker').css('z-index','100');
 		 $('#".$ff[1]."_picker').show();
    });
	/*
    $('#".$ff[1]."_picker').mouseleave(function() {
			 $('#".$ff[1]."_picker').delay(500).fadeOut();
			$('#".$ff[1]."').delay(500).blur();
    });
	*/
	
";
			break;
			
			
			
				
case "SP-LIST":
	//	if($this->itemid==0){		}else{	
			$this->js_us=true;
				// $this->conn->debug=1;
				$spliast_res_raw=$thisvalue;
				$spliast_res_raw=($spliast_res_raw!='')?explode(',',	$spliast_res_raw):array();
				
				$spliast_res=array();
				foreach($spliast_res_raw as $valraw){
				
				$spliast_res[]=Myfunc::removeQuote($valraw);
				}
	 
				//print_r($spliast_res);
				$thisSetting = $ff[5]['checkbox']; 
		
	if(   $thisSetting['status_yes']==true){
   	$results = DB::table($thisSetting['table'])->where('status','1')->orderBy($thisSetting['orderby'][0], $thisSetting['orderby'][1])->get();	
	}else{
   	$results = DB::table($thisSetting['table'])->orderBy($thisSetting['orderby'][0], $thisSetting['orderby'][1])->get();	
	}
			
 			
							$printForm='';	
							$del_ICON='';						
		if (count($results )>0){
 

				$i=0;
				$ams_val=array();
					$strArr='';

		foreach ($results as $ms) {
			
 
					$ams_id=$ms->$thisSetting['val1'];
					$ams_title=$ms->$thisSetting['val2'];
					$ams_val[]=array(
							'val'=>$ams_id,
							'title'=>$ams_title,
					);
					$del_ICON='<a class="del delBtn  pull-right " style="width:20px; padding:0;"> <i class="fa fa-times fa-lg"></i></a> ';
		//			$selectVal.=(in_array($ams_id,$spliast_res))?'<li class="handle" id="'.$ams_id.'"><span class="del delBtn">&nbsp;X&nbsp;</span>  '.$ams_title.'</li>':'';
					$selectArray['ssp'.$ams_id]=(in_array($ams_id,$spliast_res))?'<li class="handle well well-sm clearfix m0 mb5" id="['.$ams_id.']"><a class="btn btn-link pull-left m0" style="padding:0">'.$ams_title.'</a>'.	$del_ICON.'  </li>':'';
		}
					
					$selectVal='';
					foreach($spliast_res as $gVal){
					$selectVal.=	$selectArray['ssp'.trim($gVal)];
}
					
					$val2Arr=explode(', ',$thisvalue);
					
					
				foreach($ams_val as $val) {		
				$mySelected	=( in_array($val['val'],$val2Arr) )	 ?' checked="checked" ':'';
				$myClass	=( in_array($val['val'],$val2Arr) )	 ?'  btn-primary ':'';
				
				//$all_h=(($thisSetting['height']!='')?$thisSetting['height']:'40px');
				$strArr.='
				
				<div data-id="'.$val['val'].'" title="'.$val['title'].'" class="splist-add btn  btn-info mb5 '.$myClass.'" style=" ;   overflow:hidden; "> 
 
				<a  class="text-white" ><i class="fa fa-plus fa-lg"></i>&nbsp;&nbsp; '.$val['title'].'</a>
			 </div>
			 ';
				}
							$printForm='';
							$printForm .= '
			<input type="hidden" id="'.$ff[1].'_input" name="'.$ff[1].'" class="'.$ff[2][1].'  " value="'.$thisvalue.'" />
<div	id="'.$ff[1].'_sort_all" class="box" >
		<p class="size120">'.$ff[0].'</p>
		<div>
							<div class="row ">
								<div class="col-xs-6 ">
								<ul id="'.$ff[1].'_sort_ul" class="sortUU mylist clearfix nav  ui-sortable">
								'.$selectVal.'
								</ul>
								</div>
								<div class="col-xs-6 well well-sm"  style="overflow:auto; height:260px;">'.$strArr.'</div>
								<div class="clear"></div>
							</div >
</div></div >';
				}
				$res.=	$printForm;
				$this->in_editJs.='


	
jQuery.fn.SPLdelBtn = function() {
$(this).click(function(){
	$(this).parent().remove();
	newAAA()								
})
}


	$("#'.$ff[1].'_sort_all .splist-add").click(function(){
		var asdid=$(this).data("id");
			$(\'<li id="[\'+asdid+\']" class="handle well well-sm clearfix m0 mb5">'.	$del_ICON.' <a class="btn btn-link pull-left m0" style="padding:0">\'+$(this).attr("title")+\'</a></li>\').appendTo("#'.$ff[1].'_sort_ul");
			$(".delBtn").SPLdelBtn();
	newAAA()		
	});
	

	

	function newAAA(){
			var newArray=[];
			$("#'.$ff[1].'_sort_ul li").each(function(){
		
			newArray.push($(this).attr("id"));
			});
			$("#'.$ff[1].'_input").val(newArray.join(","));
	}
	function '.$ff[1].'setSort(){	 
	$("#'.$ff[1].'_sort_ul").sortable({
					create:function ()
					{
					serial = $("#'.$ff[1].'_sort_ul").sortable("toArray");
					$("#'.$ff[1].'_input").attr("value",serial);	 
					},
					update : function ()
					{
					serial = $("#'.$ff[1].'_sort_ul").sortable("toArray");
					$("#'.$ff[1].'_input").attr("value",serial);
					}
	}); 
	}
	$(".delBtn").SPLdelBtn();
  '.$ff[1].'setSort();
  
  
				';
	//	}
	break;	
		
		
		
		
		
		
		
		
		
					
				
case "RADIO-LIST":
 
$var_list= (isset($ff[5]['arr']))?$ff[5]['arr']:exit();
	$printForm ='';
	$i=1;
			foreach($var_list as $eachDefaultName=>$eachDefaultValue) {
				$mySelected = ($eachDefaultValue ==  $thisvalue) ? ' checked="checked" '  : "";
				$printForm .= '
				<div class="pull-left clearfix" >
				<label class="checkbox-inline clearfix">

			  <input  type="radio" id="'.$ff[1].($i+1).'" class="radio pull-left '.$ff[2][1].' " name="'.$ff[1].'" value="'.$eachDefaultValue.'" '.$mySelected.' style="border:0; margin-right:5px;" /> 
		<p class=" pull-left " style="display:inline-block;padding:5px 0 0 5px; margin-right:20px;">'.$eachDefaultName.' </p>
</label>
		 </div>	
				';
				
				$i++;
			}
			
			$res .= '
			
<div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9 clearfix">
	'.	$printForm.'
    </div>
  </div>
  
   
			'; 
			
break;
					
					
				
case "SELECT-TB":
 
$var_tb= (isset($ff[5]['sqlset'][0]))?$ff[5]['sqlset'][0]:'';
$var_key= (isset($ff[5]['sqlset'][1]))?$ff[5]['sqlset'][1]:'';
$var_tt= (isset($ff[5]['sqlset'][2]))?$ff[5]['sqlset'][2]:'';
$var_sort= (isset($ff[5]['orderby'][0]))?$ff[5]['orderby'][0]:'';
$var_dor= (isset($ff[5]['orderby'][1]))?$ff[5]['orderby'][1]:'';
   
$var_ps1= (isset($ff[5]['plus_atb']))?$ff[5]['plus_atb']:'';
$var_ps2= (isset($ff[5]['plus_opt']))?$ff[5]['plus_opt']:''; 
   

   
   	$results = DB::table($var_tb	)->orderBy($var_sort, $var_dor)->get();	
													
		if (count($results )>0){
$i=0;
		if( $ff[5]['null_start']==true){
$set_val[0]='';
$set_opt[0]='';
}
$name = $ff[1];

		foreach ($results as $ms) {
$i++;
									
$set_val[$i]=$ms->$var_key;
$set_opt[$i]=$ms->$var_tt;		


				}

		 }
 
$var_ps1.=' '.$ff[2][1] ;
			$options = $set_opt ;
			$val = $set_val;
			$selected = $thisvalue;
			$res .= '
			
<div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">'.Myfunc::dropdown_sameval( $name, $options,$val, $selected,0 ,$var_ps1 ,$var_ps2).'
    
    </div>
  </div>
  
   
			'; 
			
		/*	
		@unlink($this->upload_dir. $ms->full_path);
		@unlink($this->upload_dir. $ms->thumbnail_path);
		
													
		DB::table($this->upload_tb)->where('id',   $ms->id)->delete();
						*/							

	break;		
			
			
			
					
			
	
		
case "SELECT-ARR":
$i=0;
$set_val=array();
$set_opt=array();

  
$var_ps1= (isset($ff[5]['plus_atb']))?$ff[5]['plus_atb']:'';
$var_ps2= (isset($ff[5]['plus_opt']))?$ff[5]['plus_opt']:''; 


if( $ff[5]['null_start']==true){
$set_val[0]='';
$set_opt[0]='';
$i=1;
}
$name = $ff[1];
foreach($ff[5]['valArray'] as $val){
$set_val[$i]=$val['name'];
$set_opt[$i]=$val['tt'];
$i++;
}
		
			$options = $set_opt ;
			$val = $set_val;
			$selected =$thisvalue;
			$res .= '
			<div class="form-group clearfix">
    <label   class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">'.Myfunc::dropdown_sameval( $name, $options,$val, $selected,0 ,$var_ps1 ,$var_ps2).'
    
    </div>
  </div>
   ' ;

	break;		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
				
  
  		case 'CK-TEXT':
		if(Auth::user()->get()->roles_id <=2	){
		
			$this->ckedit=true;
	 		$ff[5]['ck-type']=(isset($ff[5]['ck-type']))?$ff[5]['ck-type']:'';
			$thisvalue=($this->itemid>0	&& 	property_exists($valArray, $ff[1])	)?$valArray->$ff[1]:'';
			//$cm_my=(LANG==2)?'cm_my_zh.js':'cm_my_en.js';
			$cm_my=$this->ckf_lang;//'cm_my_en.js';
			$res .= '
			 
    <div class="cktext"> ';
			// style=" height:'.($set_fckheight+130).'px; overflow:hidden;" 
			$res .= '<textarea id="'.$ff[1].'" class="withckeditor" name="'.$ff[1].'" >'.	$thisvalue.'</textarea>';
			$res .= '</div>';
			 	
			$ckheight=($ff[5]['ck-type']=='short')?'160':'310';
			
			$ckjs='';	
			$ckjs .= "<script type=\"text/javascript\">			var onoff_".$ff[1]." = 0;";
		//	$ckjs .= "function setckedr_".$ff[1]."(){";
		//	$ckjs .= "if (onoff_".$ff[1]." == 0){ onoff_".$ff[1]." = 1;";
			$ckjs .= "var ".$ff[1]." = CKEDITOR.replace( '".$ff[1]."', { customConfig : '".$cm_my."' ,toolbar:'allfunc', width:'100%',height:'".$ckheight."'} );";
			$ckjs .= "CKFinder.setupCKEditor(".$ff[1].", './admin_files/ckeditor/ckfinder/'); 	";
		//	$ckjs .= "}}";
	$ckjs .= "</script>
			";
			
			$this->editJs.=$ckjs;
			
			
		}else{
					$res .= '
			 
    <div class="cktext"> ';
			// style=" height:'.($set_fckheight+130).'px; overflow:hidden;" 
			$res .= myfunc::exp_fck($thisvalue);
			$res .= '</div>';
		
		}
			
		break;
		
		case 'STATUS':
		  $thisvalue=($this->itemid>0	&& 	property_exists($valArray, $ff[1])	)?$valArray->$ff[1]:'1';
		$val0tt=(isset($ff[5]['val0_tt']))?$ff[5]['val0_tt']:$this->txt['disabled'];
		$val1tt=(isset($ff[5]['val1_tt']))?$ff[5]['val1_tt']:$this->txt['enabled'];
		$input='';				

if(!	isset( $ff[5]['option'])	){
$sv0=($thisvalue==0)?'	checked="checked"	':'';
$sv1=($thisvalue==1 || $thisvalue=='')?'	checked="checked"	':'';;
$input.='<label class="checkbox-inline">  <input type="radio" '.$sv1.'  name="'.$ff[1].'" value="1">&nbsp;&nbsp;'.	$val1tt.'</label>';
$input.='<label class="checkbox-inline">  <input type="radio" '.$sv0.'  name="'.$ff[1].'" value="0">&nbsp;&nbsp;'.	$val0tt.'</label>';
}else{
	foreach($ff[5]['option']['array']  as $opval){	
		$selected='';
		if(		( isset($ff[5]['option']['default'])) && 	$this->itemid==0	){
 
				if(($opval['val'])==$ff[5]['option']['default'])	$selected=' checked="checked" ';
		}else{
				if(($opval['val'])==$thisvalue)	$selected=' checked="checked" ';
		
		}
		if(	$thisvalue!=''){
				if(($opval['val'])==	$thisvalue)	$selected=' checked="checked" ';
		}
		$input.='<label class="checkbox-inline">  <input type="radio" '.$selected.'  name="'.$ff[1].'" value="'.$opval['val'].'">&nbsp;&nbsp;'.$opval['tt'].'</label>';
	}
}


		if($this->is_clone){
				$input='<p class="m0 pt5">CLONE-ITEM  <input type="hidden"  name="'.$ff[1].'" value="0"> </p>';
		}
	$res .= '<div class="form-group">
    <label class="col-sm-3 control-label">'.$ff[0].':'.$reqStar.'</label>
    <div class="col-sm-9">
 		'.$input.'
    </div>
  </div>';
  
		break;
		
		
  
		case 'LG-END':			$res.=' </div></div>';		break;
		case 'ID':
		$res.='<input type="hidden" name="'.$ff[1].'" id="'.$ff[1].'"  value="'.$thisvalue.'" />';
		break;
		
		case 'TAB-CNT-START':
		$res .= '<ul class="nav nav-tabs" role="tablist"></ul>
<div class="tab-content ">
';
			
		break;
			
			
		case 'TAB-START':
		$res .= '<div class="tab-pane "  data-title="'.$ff[5]['TAB']['title'].'"	 id="'.$ff[5]['TAB']['key'].'">	 ';
		break;
		case 'TAB-CNT-END':		
		case 'TAB-END':
		$res .= '</div>';
		break;
		}
		
		
	}
	
	
}
if($this->js_us){
$this->pageJsAndCss.='<script type="text/javascript"  src="'.url($this->admin_file.'js/ui/jquery-ui-1.10.3.custom.min.js').'"></script>';
}

if($this->js_color){
$this->pageJsAndCss.='<script type="text/javascript" src="'.url($this->admin_file.'js/colorpicker/farbtastic.js').'"></script>
<link rel="stylesheet" href="'.url($this->admin_file.'js/colorpicker/farbtastic.css').'" type="text/css" />
';
}

if($this->ckedit){
$ckjs='<script type="text/javascript" src="'.url($this->admin_path.'ckeditor/ckeditor.js').'"	 ></script>
<script type="text/javascript" src="'.url($this->admin_path.'ckeditor/ckfinder/ckfinder.js').'" ></script>';
}

$this->pageJsAndCss.='<link rel="stylesheet" type="text/css" href="'.url($this->admin_file.'js/chosen/chosen.min.css').'" />  
<script type="text/javascript" src="'.url($this->admin_file.'js/chosen/chosen.jquery.min.js').'"></script> ';
 

  
  

$this->pageJsAndCss.=$ckjs;

$this->pageJsAndCss.=$this->editJs;
$this->pageJsAndCss.='<script type="text/javascript"> $(document).ready( function() { '.$this->in_editJs.' }); </script>';
$this->pageJsAndCss.='<script type="text/javascript"> $(document).ready( function() {
	
 if( $(".chosen").length>0){
$(".chosen").chosen({});
 }
 
$("#vforms").	tabSetup();

 }); </script>';


?>