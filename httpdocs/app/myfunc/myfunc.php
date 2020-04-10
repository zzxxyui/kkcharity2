<?php


class Myfunc{
	
	public	static function is_ssl($val){
		return ( str_is('*https*',Config::get('gbkey.DOMAIN')) ) ?true:false;
		
	}
	
	
	public	static function set_url($val){
		$t1=0;
		$t2=0;
		if(  str_is('*https*',$val )) {
		$t1++;
		}
		
		if(  str_is('*http*',$val )) {
		$t2++;
		}
		return ($t1>0||$t2>0)?$val:'http://'.$val;
	}
	
   public static function spchacter2($str,$nofck=false){
$str_arr=array("&ldquo;","&rdquo;","&quot;","&rsquo;");
if($nofck==true){
$str = htmlspecialchars($str,ENT_QUOTES);
}
	  
  foreach ($str_arr as $item) {
   if(preg_match('/'.($item).'/i',$str)){

	   $repto=($item=='&rsquo;')?'&#39;':'&#34;';
	   
         $str = preg_replace('/'.($item).'/',$repto,$str);
    }
  }

  
return $str;
}
   public static function r_amp($str){	return  str_replace(' & ',' &amp; ',$str);  }
   public static function exp_fck($str){
return Myfunc::spchacter2(	Myfunc::r_amp(html_entity_decode($str,ENT_QUOTES,'UTF-8'),false	));
}

   public static function zh_date($date){
	return  date('m',strtotime($date)).'月'.date('d',strtotime($date)).'日';

   }


   public static function dropdown_sameval( $name, array $options, array $val, $selected=null ,$setvalue,$plus='',$plus2='')
{
    /*** begin the select ***/
    $dropdown = '<select name="'.$name.'" class="form-control '.$plus.'" '.$plus2.' id="'.$name.'" >'."\n";
	$setvalue=$setvalue;
    $selected = $selected;
    /*** loop over the options ***/
    foreach( $options as $key=>$option )
    {
        /*** assign a selected value ***/
        $select = $selected==$val[$key] ? ' selected="selected" ' : '';

        /*** add each option to the dropdown ***/
		$showvaluse= ($setvalue!=1)?$val[$key]:$key;
        $dropdown .= '<option value="'.$showvaluse.'"'.$select.'>'.$option.'</option>'."\n";
    }

    /*** close the select ***/
    $dropdown .= '</select>'."\n";

    /*** and return the completed dropdown ***/
    return $dropdown;
}

public static function generatecode($length = 10){   
		$password="";   
		$chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";   
		srand((double)microtime()*1000000);   
		for ($i=0; $i<$length; $i++)   {      
			$password = $password . substr ($chars, rand() % strlen($chars), 1);   
		}   
		return $password;
}
   public static function getRealIpAddr($type='')
{ 
	
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'].':'.myfunc::generatecode(4);
    }
 
    return $ip;
}
   public static function getIp_user()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

   public static function zerofill ($num, $zerofill = 6)
{
	return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
}


   public static  function removeQuote($str){
return  preg_replace("/[^0-9\,?!]/",'',$str);
}
	
   public static  function only_az($str,$sym='_'){
return  preg_replace("/[^A-Za-z0-9?!]/",$sym,$str);
}
	
   public static  function only_az2($str,$sym='_'){
return  preg_replace("/[^A-Za-z0-9\-\_?!]/",$sym,$str);
}
	
   public static function removebreak($str){
$str = str_replace("\r", "", $str);
$str = str_replace("\n", "", $str);
$str = str_replace("\t", "", $str);
return $str;
}
	
   public static	function dgVal($str,$gg=4){
	$sv= round($str, $gg);
  return sprintf('%01.'.$gg.'f',$sv);
}

   public static	function num1000($str,$plk=2){
 return  number_format($str, $plk, ".", ","); 
}
   public static  function get_ext($from_file) {
		$ext = strtolower(strrchr($from_file,"."));
		return $ext;
	}
	
   public static  function imgVirtualResize ($path, $maxwidth, $maxheight) {
	$changeflag = "";
	$changedvalue = "";
	$width = "";
	$height = "";
	
	if($path != "" && file_exists($path)) {
		$img = @getimagesize($path);
		if($img[0] <= $maxwidth && $img[1] <= $maxheight) {
			$width = $img[0];
			$height = $img[1];
		} else {
			if ($img[1] >= $maxheight) {
				$height = "$maxheight";
				$width = $height * ($maxwidth / $maxheight);
				$changeflag = 1;
			}
			if ( $img[0] >= $maxwidth || $width >= $maxwidth) {
				$width = $maxwidth;
				if($changeflag){
					$changedvalue = $width/$img[0]*$img[1];
					$height = $changedvalue;		
				}
				if ($height > $maxheight) {
					$width = $maxheight/$changedvalue*$maxwidth;
					$height = $maxheight;
				}	
			} elseif($img[0] != $img[1] && $img[1] <= $maxheight) {
				$width = $img[0] / ($img[1] / $maxheight);
			}
			if($height == "" && $width!="") {
				$height = $width * $img[1] / $img[0];
			}
		}
		$newsize = array($width, $height);
		return $newsize;
	} else return 0;
}
// Image virtual proportional resize function - ===============================================

// Image actual proportional resize function + ===============================================
   public static  function imgActualResize($Dir,$Image,$NewDir,$NewImage,$MaxWidth,$MaxHeight,$Quality) {
  list($ImageWidth,$ImageHeight,$TypeCode)=getimagesize($Dir."/".$Image);
  $ImageType=($TypeCode==1?"gif":($TypeCode==2?"jpeg":
             ($TypeCode==3?"png":FALSE)));
 if(!is_dir($NewDir)){	mkdir( $NewDir, 0777);}
  $CreateFunction="imagecreatefrom".$ImageType;
  $OutputFunction="image".$ImageType;
  if ($ImageType) {
   $Ratio=($ImageHeight/$ImageWidth);
   $ImageSource=$CreateFunction($Dir."/".$Image);
   if ($ImageWidth > $MaxWidth || $ImageHeight > $MaxHeight) {
     if ($ImageWidth > $MaxWidth) {
         $ResizedWidth=$MaxWidth;
         $ResizedHeight=$ResizedWidth*$Ratio;
     }
     else {
       $ResizedWidth=$ImageWidth;
       $ResizedHeight=$ImageHeight;
     }        
     if ($ResizedHeight > $MaxHeight) {
       $ResizedHeight=$MaxHeight;
       $ResizedWidth=$ResizedHeight/$Ratio;
     }      
     $ResizedImage=imagecreatetruecolor($ResizedWidth,$ResizedHeight);
     imagecopyresampled($ResizedImage,$ImageSource,0,0,0,0,$ResizedWidth,$ResizedHeight,$ImageWidth,$ImageHeight);


   } 
   else {
     $ResizedWidth=$ImageWidth;
     $ResizedHeight=$ImageHeight;      
     $ResizedImage=$ImageSource;
   }    
   $OutputFunction($ResizedImage,$NewDir."/".$NewImage,$Quality);
   return true;
  }    
  else
   return false;
}




  public static function objectToArray($d) {
$array = json_decode(json_encode($d), true);
return $array ;
}
 
 
 
   
 
  
  public static  function strip_only($str, $tags, $stripContent = false) {
    $content = '';
    if(!is_array($tags)) {
        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
        if(end($tags) == '') array_pop($tags);
    }
    foreach($tags as $tag) {
        if ($stripContent)
             $content = '(.+</'.$tag.'[^>]*>|)';
         $str = preg_replace('#</?'.$tag.'[^>]*>'.$content.'#is', '', $str);
    }
	
    return $str;
}

  public static function strip_content($str, $tags, $stripContent = false) {
    $content = '';
    if(!is_array($tags)) {
        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
        if(end($tags) == '') array_pop($tags);
    }
    foreach($tags as $tag) {
        if ($stripContent)
             $content = '(.+</'.$tag.'[^>]*>|)';
         $str = preg_replace('#</?'.$tag.'[^>]*>'.nl2br($content).'#is', '', $str);
    }
	
    return $str;
}

  
    public static  function baseval($str,$blank='---') {
		 
		return ($str!='')?$str:$blank;
	}

  
 public static  function set_insert_row($og_row,$ins_row,$uid){
$res=array();
		
foreach ($ins_row as $mk=>$mv) { 
$res[$mk] = $mv;
} 
if( in_array("updated_by", $og_row)  ) $res['updated_by']= $uid;
if( in_array("updated_at", $og_row)  ) $res['updated_at']= date("Y-m-d H:i:s");
if( in_array("created_at", $og_row)  ) $res['created_at']= date("Y-m-d H:i:s");
return $res;
}



 
public static  function isValidInetAddress($data, $strict = false) 
{ 

if(preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $data)){
return true;
}else{
return false;
}
  
  
}


public static  function Arr2Box($add ) {
	$str='';
		foreach((array)$add  as $KK=>$VV){
			 
			
						$str.=(is_array($VV)) ?Myfunc::Arr2Box($VV):'
						
						<div  class="col-xs-12 m0 p0 clearfix"> 
								<div  class="col-xs-5    fs16"> 	<strong style="font-size:12px"> '.$KK.'</strong> </div  > 
							  <div  class="col-xs-7  fs16 "> <span style="font-size:12px;  word-wrap: break-word;">		 '.$VV.'</span></div  >
					  </div  >
					   ';
		}
		 
return 	'<div class="well well-sm m0 m5 p0 p5 col-xs-12 m0 p0 mb20 clearfix" style="padding:10px">
'.$str.'
</div>';
}
 
 


 
} //class
 
 

 
 
 
 
 
 
?>