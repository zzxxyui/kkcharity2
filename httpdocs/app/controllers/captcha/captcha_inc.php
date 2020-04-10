<?php session_start(); 
function  show_captcha($path){
$show_captcha='<div style="width:120px; float: left; height: 40px">
      <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="'.$path.'captcha/securimage_show.php?sid='.md5(time()).'" />
        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById(\'siimage\').src = \''.$path.'captcha/securimage_show.php?sid=\' + Math.random(); return false"><img src="'.$path.'captcha/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
</div>';
return $show_captcha;
}
?>