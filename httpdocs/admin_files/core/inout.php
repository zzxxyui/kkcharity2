<?php 

		 

foreach($this->MyConfig['menuList'] as	$mkey=>$ml){
	
	if( $data['action']==$mkey){
		if($this->user_lv>$ml['lv']) exit();
	}

}

	$this->io_default_columns=array();
 $columns = array();
$results= DB::select('SHOW COLUMNS FROM '.DB_START.$this->MyConfig['tableName']);

if (count($results )>0){
$i=1;
$column_name='Field';
foreach ($results as $ms) { 
$columns[] = $ms->$column_name;
}}
 
	$this->io_default_columns=	 $columns;
 if( isset($this->MyConfig['io_colunm_list'])){
	 $columns=$this->MyConfig['io_colunm_list'];
}
 
$this->io_columns=$columns;


if( isset($data['del']) && $data['del']==1){
	
	
	$ghj=DB::table($this->MyConfig['tableName']	)->delete(); 
	
$this->pageJsAndCss.='
<script>
$(document).ready( function() {
	
				 window.location.href="'.ROOT_PATH.'admin?q='.$this->dept_val.'_course&action=list";
})
</script>';

 
}





	$sdf=  '';
	$this_page_content='';
if( isset($data['imp']) && $data['imp']==1){
	
 if( Input::hasFile('ex_file')  ){
	
    $expfile = Input::file('ex_file');
	$sdf = Input::file('ex_file')->getClientOriginalName();
	
	$dir = './static/exceltmp/';
	  
	
set_time_limit(0) ;
include_once './app/controllers/PHPExcel/IOFactory.php';

$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp; //PHPExcel_CachedObjectStorageFactory::cache_to_discISAM ; //
$cacheSettings = array( 'memoryCacheSize' => '32MB');
PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);


try 
{
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load($expfile);

}
catch (Exception $e)
{

 //die('<input type="button" class="btn_input_edit tipsybtn s_dir" title="'.$tip['ls_back'].'"  onclick="javascript:window.location=\'./index.php?core=list\'"  value="can not read this excel file. Click here to back."  />');
}

$imp_msg='';
$imp_insert=0;
$imp_update=0;
/*---------------imp procedd===================*/
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
				$worksheetTitle     = $worksheet->getTitle();
				$highestRow         = $worksheet->getHighestRow(); // e.g. 10
				$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
				$nrColumns = ord($highestColumn) - 64;
				$highestRow =($highestRow >1000)?1000:$highestRow ;
for ($row = 1; $row <= $highestRow; ++ $row) {	

if($row==1){
}else{
	
$one_row=array();	
for ($col = 0; $col < count($this->io_columns); $col ++) {
				 	
			$cl_cname=	$this->io_columns[$col];
			$cl_val_base = $worksheet->getCellByColumnAndRow($col, $row);
			$cl_val= trim($cl_val_base->getValue());		
			$one_row[$cl_cname]=(	$cl_val!='')?	$cl_val:'';
}

$haveVal_c = $worksheet->getCellByColumnAndRow(1, $row);
$haveVal = $haveVal_c->getValue();
$haveVal0_c = $worksheet->getCellByColumnAndRow(0, $row);
$haveVal0 = $haveVal0_c->getValue();

$haveVal2_c = $worksheet->getCellByColumnAndRow(2, $row);
$haveVal2 = $haveVal2_c->getValue();


if( (!empty($haveVal0) || !empty($haveVal) || $haveVal==0 ) && $haveVal2!='' ){
	
	if(ceil($one_row['id'])>0){
	
		$gid = DB::table($this->MyConfig['tableName'])->where('id',ceil($one_row['id']) ) ->update($one_row  );

		$imp_update++;
	}else{
		$ins_row=myfunc::set_insert_row($this->io_default_columns,$one_row ,$this->user_id);
		$gid = DB::table($this->MyConfig['tableName'])->insertGetId($ins_row  );
		$imp_insert++;
	}

}	 // if have vlaue
	
 
	
	
} //id row=1
}// for riw'



} // foreach ($objP
/*---------------imp procedd===================*/

	$this_page_content='
<div class="p1010em row m0 p0 clearfix">
 
	<div class="col-xs-12   m0 p0">
		<h2 class="m0 pull-left" >'.$this->MyConfig['pageName'].' - Import/Export</h2><div class="m0 pull-left"></div>
	</div>
	<div class="col-xs-12  col-sm-6  mt20">
	
 	<p class="alert alert-warning">
	<strong>Result</strong>:<br/>
	'.$imp_msg.'
	Insert:  '.$imp_insert.'<br/>
	Update: '.$imp_update.'
	 
 </p><br/>
	<p class="">	<a class="btn btn-default" href="'.url('admin?q='.$this->MyConfig['tag'].'&action=io').'">Back</a></p>
	
	
	</div>
</div>';






}else{
	$this_page_content='
<div class="p1010em row m0 p0 clearfix">
 
	<div class="col-xs-12   m0 p0">
		<h2 class="m0 pull-left" >'.$this->MyConfig['pageName'].' - Import/Export</h2><div class="m0 pull-left"></div>
	</div>
	<div class="col-xs-12  col-sm-6  mt20"><br/>
	<p class="">	<span class="alert alert-warning">There have no file uploaded.</span></p><br/>
	<p class="">	<a class="btn btn-default" href="'.url('admin?q='.$this->MyConfig['tag'].'&action=io').'">Back</a></p>
	</div>
</div>';

	//$sdf = Input::file('ex_file')->getClientOriginalName();
	

		//Input::file('photo')->move($di, 'asd.xls');
		//$sdf=    $expfile ;
		
}
	
$this->page_mainContent=$this_page_content;

}else if( isset($data['exp']) && $data['exp']==1){

 

include_once './app/controllers/PHPExcel.php';
include_once './app/controllers/PHPExcel/IOFactory.php';
	
 
$objPHPExcel = new PHPExcel();


$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(12);//設置單元格寬度
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');//設置當前工作表的名稱
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);



 $cl=0; 
$gg=0; 
foreach($this->io_columns as $tval){
// if($gg>0){
 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($cl,1, $tval);
$cl++;		
//}
$gg++;						
}



$line=2;

$results_val=	 DB::table( $this->MyConfig['tableName'] )->orderBy('id', 'asc')->get();		 
if (count($results_val )>0){

foreach ($results_val as $gx) { 
	$fk=0;
	foreach ($this->io_columns as $cKey) { 
	
	$expval=$gx->$cKey;
	if($cKey=='cs_desc' || $cKey=='cs_detail' || $cKey=='cs_remark') $expval=myfunc::exp_fck($expval);
 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($fk,$line,$expval );
 $fk++;
	}
$line++;
}

}

function removeOld(){

$dir = $_SERVER['DOCUMENT_ROOT'].ROOT_PATH.'static/exceltmp/';

//echo "STARTING<br/>";
if (is_dir($dir)) {
   if ($dh = opendir($dir)) {
      while ($file = readdir($dh)) {
         if(!is_dir($dir.$file)) {
            //if 10 days old, delete
            if (filemtime($dir.$file) < strtotime('-10 minutes')) { 
               //echo "Deleting ".$dir.$file." (old) :";
               //echo "(date->".date('Y-m-d',filemtime($dir.$file)).")<br/>";
               unlink($dir.$file);
            } 
         }
      }
   } else {
      //echo "ERROR. Could not open directory: $dir<br/>";
   }
closedir($dh);
} else {
  // echo "ERROR. Specified path is not a directory: $dir<br/>";
}



} //func

	
	
removeOld();
	
 
$objPHPExcel->setActiveSheetIndex(0);//設置打開excel時顯示哪個工作表

$new_filen=$this->MyConfig['tableName'].'-'.date('Y-m-d_his');
 
$excelName =$new_filen.'.xls';//設置導出excel的文件名 
$excelName_save =md5($new_filen).'.xls';//設置導出excel的文件名 


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$objWriter->save('./static/exceltmp/'.$excelName_save);
// echo $excelName_save;
//  return Response::download('./static/exceltmp/'.$excelName_save,$excelName);
 
 
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
	//header("Content-Type: application/vnd.ms-excel; charset=UTF-8"); 
//	header("Content-Disposition: attachment; filename=".urlencode($excelName));
	header("Content-Disposition: attachment; filename=".$excelName);
 
   echo file_get_contents('./static/exceltmp/'.$excelName_save);
    die();
 

	
}else{



$part_imp=(isset($this->MyConfig['io_no_import']) && $this->MyConfig['io_no_import']==1)?'':'  <div class="col-xs-12  col-sm-6  ">

		 
<div class="well">
Import Excel to Existing Table - <strong class="text-info">'.$this->MyConfig['tableName'].'</strong>


<form action="'.url('admin?q='.$this->MyConfig['tag'].'&action=io&imp=1').'" method="POST"  enctype="multipart/form-data">

<p class="text-center"><input  class="mt10 form-control input-sm" name="ex_file" type="file"/></p>
<p class="text-right m0">&nbsp;<br/>
<input class="btn btn-warning"  type="submit" value="Import"/>
</p>
</form>

</div>

  </div>';
$part_exp=(isset($this->MyConfig['io_no_export']) && $this->MyConfig['io_no_export']==1)?'':' 
  <div class="col-xs-12  col-sm-6  ">

		 
<div class="well">Export Existing Table <strong class="text-info"">'.$this->MyConfig['tableName'].'</strong> to  Excel

<p class="text-right m0">&nbsp;<br/>
<a class="btn btn-info" target="_blank" href="'.url('admin?q='.$this->MyConfig['tag'].'&action=io&exp=1').'">Export</a>
</p>
</div>
  </div>
';
$part_del=(isset($this->MyConfig['io_no_del']) && $this->MyConfig['io_no_del']==1)?'':' 
  <div class="col-xs-12  col-sm-6  " style="float:left; clear:left">
		  
		<div class="well clearfix">
	<p class="pull-left m0 p0 mt5" style="display:inline-block">	Delete All Records.</p> 
	<a class="btn btn-default btn-sm pull-right" target="_blank" id="delAllBtn" data-href="'.url('admin?q='.$this->MyConfig['tag'].'&action=io&del=1').'">Delete</a>
		  </div>

  </div>
  ';



   
  



$this_page_content='


<div class="p1010em row m0 p0 clearfix">
 
<div class="col-xs-12   m0 p0">
  
			<h2 class="m0 pull-left" >'.$this->MyConfig['pageName'].' - Import/Export</h2><div class="m0 pull-left"></div>
</div>
'.$part_imp.'
'.$part_exp.'
'.$part_del.'





</div>


';
$this->pageJsAndCss.='
<script>
$(window).load( function() {
	
				$("#delAllBtn").click(function(){	
				var tgurl=$(this).data("href")		;	
				if( confirm("確認移除?") ){
					window.location.href=tgurl;
				}
				})
})
</script>';

$this->page_mainContent=$this_page_content;
}
	

?>

