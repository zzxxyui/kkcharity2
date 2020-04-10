$(document).ready( function() {
	

var scrollPosition = 0
function RefreshGridData() {
    scrollPosition = Sygrid.closest(".ui-jqgrid-bdiv").scrollTop()
	Sygrid.trigger("reloadGrid");
}
/*
	function QuickEdit(id){		
	
$.ajax({
 	 url: "./process/ajax_action.php",
    type : 'POST',
	dataType :'json',
    data :{'action':'load_quickedit','fld': ajax_pageKey,'tagid':id },
	success: function(jdata){
			//Sygrid.trigger("reloadGrid")
		 RefreshGridData();
	 }
})

																	
	}	
*/
function getbox_h(){
var hh=($(window).height()-310);
hh=(hh<300)?300:hh;
return hh;
}	 				
function countBtnWW(cname){	
	$(cname).each(function(){ 
		var ggx=$(this);
		var Ax= ggx.find('a');
		Ax.css({width:  (ggx.width()/Ax.length)-5}); 
	})			
}
var Sygrid=jQuery("#c_inv").jqGrid({ 

url:admin_path+'/process', 
datatype: "json",
 mtype:'POST',
postData: {
    action:ajax_pageAction,
    key:ajax_pageKey
},

colNames:mysetup_ctitle,
colModel:mysetup_cmodel,
width: $('#page-wrapper').width(),
	 rowNum:(!mysetup_paging)?1000000:50, height:getbox_h(), rowList:[50,100,1000], 
	 pager: '#p_inv', 
	 sortname: mysetup_sortname,
	 shrinkToFit :true,
	  viewrecords: true,
	sortorder:mysetup_sortorder,
	 caption:"---" ,  
	toppager:true,
		 ondblClickRow: function(ids, ri, ci) { 

			
			
        },
		 onSelectRow: function(ids) {  
 
        },
		loadComplete: function (){   
			Sygrid.closest(".ui-jqgrid-bdiv").scrollTop(scrollPosition);
			
			resizeJqGridWidth('c_inv');
			
			countBtnWW('div.btnCnt');
			
			$('#c_inv tr').each(function(){
			var fdsp=$(this).find(".sprows");
			if(fdsp.length>0){
				if($(this).find(".ret").length>0){
					$(this).find('td').css({background:'#bbbbbb'	})
				}
				if($(this).find(".pik").length>0){
					$(this).find('td').css({background:'#FFDD00'	})
				}
			}
			})

},
		searchGrid:{	/*	sopt:['cn','bw','eq','ne','lt','gt','ew']*/		},
	 	loadonce: (!mysetup_paging)?true:false,
	//	footerrow : true,
	//	 userDataOnFooter : true,
		  altRows : true
}); 
jQuery("#c_inv").jqGrid('navGrid','#p_inv',{add:false,edit:false,del:false,search:false,refresh:true,pgbuttons:false,cloneToTop:true},{}, {}, {}, {/*multipleSearch:true,sopt:['cn','bw','eq','ne','lt','gt','ew'],showQuery: true*/} );

/*
jQuery("#c_inv").jqGrid('navButtonAdd','c_inv_toppager_left',{ caption: "Columns", title: "Reorder Columns", onClickButton : function (){ 
jQuery("#c_inv").jqGrid('columnChooser', {
  done : function (perm) {
      if (perm) {
          this.jqGrid("remapColumns", perm, true);
			resizeJqGridWidth('c_inv')
      } else {
      }
   }
});

 } });
*/
 
$(".ui-jqgrid-titlebar").hide()
if(!mysetup_paging){
$("#c_inv_toppager_center").hide();
$("#p_inv_center").hide();

}

 jQuery("#c_inv").jqGrid('filterToolbar',{defaultSearch:"cn",stringResult: true,searchOnEnter : true});
 /*
 jQuery("#c_inv").jqGrid('navButtonAdd', 'c_inv_toppager_left', { caption: "Export Excel",
		onClickButton: function() {
				var exptt=thistitle;
				if(mysetup_paging){		exptt+='_'+$('#p_inv_right').text()+'_';	}	
				expXls('#c_inv',exptt,'Remaining-order');
			}
});
*/ 
$(' #p_inv').hide();
 
 
 
 
$("td a.CloneBtn").live('click',function(){
 var thisid=$(this).data('id');
 var thistitle=$(this).data('title');
 var thismsg='<div id="clmsg"><p> Are you sure clone this item? <br/><strong>"'+thistitle+'"</strong></p><a id="startclone" class="btn btn-info">Confirm</a></div> ';
 
 			var aftmsg=' <div class="modal-content">      <div class="modal-header">';
      aftmsg+='  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          aftmsg+='  <h4 class="modal-title text-center" id="myModalLabel">'+thismsg+'</h4>';
        aftmsg+='  </div>    </div>';
		$("body").append( $('<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  <div class="modal-dialog"> '+aftmsg+'    </div></div>'));


$('#startclone').click(function(){

	$('#clmsg').addDxloader('Loading');
	
	
	$.ajax({
 	 url: admin_path+"/process",
    type : 'POST',
	dataType :'json',
    data :{'action':'clone_item','fld': ajax_pageKey,'tagid':thisid },
	success: function(jdata){
			//Sygrid.trigger("reloadGrid")
			$('#clmsg').empty().html(jdata.msg);
		 RefreshGridData();
	 }
})
	
	
	
	
})

		$("#myModal").modal({	backdrop:false}	);
	 
		$("#myModal").on("hidden.bs.modal", function () {
		 
		   $(this).remove();
		})
	
});


$("td a.ListDelBtn").live('click',function(){
var opt=$(this).data('option');
var qs=confirm("Confirm Delete?")
if (qs)
{
$('#forms').addDxloader('Loading');
$.ajax({
 	 url: admin_path+'/process',
    type : 'POST',
    dataType :'json',
    data :{'action':'delone','fld':opt.key,'id':opt.id},
	success: function(jdata){
		var chc=parseInt(jdata.success)
		RefreshGridData();
		
		var thisbg=(chc==1)?'#ffffff':'#ff0000';
		var thisTxt=(chc==1)?'#444444':'#ffffff';
		$('#forms').reDxloader(); 
		var aftmsg=' <div class="modal-content">      <div class="modal-header" style="background:'+thisbg+'">';
      aftmsg+='  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
          aftmsg+='  <h4 class="modal-title text-center" id="myModalLabel" >'+jdata.msg+'</h4>';
        aftmsg+='  </div>    </div>';
		$("body").append( $('<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  <div class="modal-dialog" style="color:'+thisTxt+'"> '+aftmsg+'    </div></div>'));

		$("#myModal").modal({	backdrop:false}	);
		
		if(chc==1){
		setTimeout(function(){	$("#myModal").modal("hide");		}, 1000);
		}
		
		$("#myModal").on("hidden.bs.modal", function () {
		 
		   $(this).remove();
		})

		/*
		var tgaa=$('#forms .lodingDiv p.msg');
		tgaa.css('background','#fff');
		var closeBtn=$('<a class=\"minbutton\">Close</a>').click(function(){ $('#forms').reDxloader(); });
		tgaa.html(jdata.msg+'<br/><br/>').append(closeBtn);
		if(chc==1){	 
		
		RefreshGridData();
			}
			*/
			
	 }
})
}



})
	
 
 function resizeJqGridWidth(grid_id)
{

				$(window).bind('resize', function() {
				var div_id='page-wrapper';
					//$('#' + grid_id).setGridWidth($('#' + div_id).width()-40, false); //Resized to new width as per window
					$('#' + grid_id).setGridWidth($('#' + div_id).width(), false); //Resized to new width as per window
				 	//$('#' + grid_id).setGridHeight($('#' + div_id).height(), false); //Resized to new width as per window
				 }).trigger('resize');
	
}
	
 
 
 
 
 
})
 