<?php

if($this->user_lv>$this->MyConfig['lv']){
exit;
}




$this->itemid=0;

$inn_page_title=$this->MyConfig['pageName'].' <small>('.$this->title.')</small>';		


$this_page_content='


<div class="row">
  <div class="col-xs-12   ">
	  <div class="p1010em clearfix">
		<h2 class="m0 pull-left" >'.$inn_page_title.'</h2>
	</div>
  </div>
  <div class="col-xs-12   ">
					<div id="loadCatDiv"></div>
  </div>
</div>';





function Cat_AJAX_valideform($acttg,$itemid,$tt){
//require_once('page/'.$this->keyName.'/creatEdit_config.php');	
$str='<script type="text/javascript">';
$str.="
 
function updateSortAjax(pid, str,didvar){
	
	$('#sortINfo').addDxloader('Loading...');
	$.ajax({
 	 url: 'admin/process',
    type : 'POST',
   dataType :'json',
    data :{'tag':'".$acttg."','action':'load_mcat_goSort','pid':pid,'sortval':str},
	success: function(jdata){
			loadCatFunc();
			$('#sortINfo').reDxloader();
			
			didvar.dialog('close');

	}
	})
	
	
}
jQuery.fn.sortMcat = function() {
$(this).click(function(){
	
		var cName=$(this).parent().find('span').text();
		var pid=$(this).data('pid');

		var didvar=$( '<div id=\"sortINfo\">Loading...</div>').dialog({
																				title:'".$tt."',
																			//	'z-index':30000,
																				//resizable:false,
																				draggable:true,
																				autoOpen: true,
																				modal: true, width:'720px',position:['center',150], 
																				open: function(){
																					
	$.ajax({
 	 url: 'admin/process',
    type : 'POST',
   // dataType :'json',
    data :{'fld':'".$acttg."','action':'load_sort_mcat','id':pid},
	success: function(jdata){
			$('#sortINfo').html(jdata);
					$('#sortable').sortable({
					create:function ()
					{
					serial = $('#sortable').sortable('toArray');
					$('#sorting').attr('value',serial);
					},
					update : function ()
					{
					serial = $('#sortable').sortable('toArray');
					$('#sorting').attr('value',serial);
					
					}
					});

			$('#upcateSort').click(function(){
					updateSortAjax(pid,	$('#sorting').val() ,didvar);
			})
	}
	})																				 
		



																					
																				 },
																				close: function(ev, ui) {
																					
																				$(this).remove(); 
																				/*	$(this).close();*/
																					return false;
																				 }
																			})
																			
																			
})											


}
jQuery.fn.delMcat = function() {
$(this).click(function(){
			var crid=$(this).data('mid');
			var crName=$(this).find('span').html();
			var answer = confirm('Delete?');
			if (answer){
				$.ajax({
 				 url: 'admin/process',
				type : 'POST',
			    dataType :'json',
				data :{'tag':'".$acttg."','action':'db_delete_mcat','cid':crid},
					success: function(jdata){
						var checkRes=parseInt(jdata.success);
						if(checkRes==1){
							if(crid=='".$itemid."'){
								//alert(crName+' - deleted.');
								window.location.href='?q=".$acttg."&action=modify';
							}else{
							//	alert(crName+' - deleted.');
								loadCatFunc();
							}
						}else{
							alert(jdata.msg);
						}
					}
				})
			
			}
})											

}
function loadCatFunc(){
	$('#loadCatDiv').addDxloader('Loading...');
	$.ajax({
 	 url: 'admin/process',
    type : 'POST',
   // dataType :'json',
    data :{'fld':'".$acttg."','action':'load_mcat','id':".$itemid."},
	success: function(jdata){
		
			$('#loadCatDiv').html(jdata);
			
		 
			$('.del').delMcat();
			$('.sort').sortMcat();
			$('#loadCatDiv').reDxloader();

	}
	})
}

$(document).ready( function() {
loadCatFunc(); 
});
";
$str.='</script>';
return $str;
}



//$this->pageJsAndCss.=$this->AJAX_valideform($this->MyConfig['tag']);
$this->pageJsAndCss.='<link rel="stylesheet" type="text/css" href="'.$this->myurl($this->admin_file.'js/ui/jquery-ui-1.10.3.custom.css').'" />   
<script type="text/javascript"  src="'.$this->myurl($this->admin_file.'js/ui/jquery-ui-1.10.3.custom.min.js').'	"></script> ';

$this->pageJsAndCss.=Cat_AJAX_valideform($this->MyConfig['tag'],$this->itemid,$this->txt['sort_cat']);
//$this->page_mainMenu= $this->Layout_SideMenu($this->inc_list);

$this->page_mainContent=$this_page_content;/*
require_once('page/inc_baseFrame.php');
$this->this_page_body=$this_page_body;
require_once('page/inc_admin_home.php');
$this->pageJsAndCss.=$this->last_pageJsAndCss;*/
?>