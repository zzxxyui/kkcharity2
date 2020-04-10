<?php
$csspath=Config::get('gbkey.admin_path');

?> 
<link rel="stylesheet" type="text/css" href="<?=$csspath?>css/reset.css" media="all" /> 
<link rel="stylesheet" type="text/css" href="<?=$csspath?>css/grid.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=$csspath?>css/layout.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=$csspath?>css/nav.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=$csspath?>css/admin.css" media="all" /> 
<link rel="stylesheet" type="text/css" href="<?=$csspath?>css/master.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=$csspath?>js/ui/jquery-ui-1.10.3.custom.css" />   
<script type="text/javascript" src="<?=$csspath?>js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?=$csspath?>js/jquery.cookie.js"></script>
<?php /*<script type="text/javascript" src="<?=$csspath?>js/jquery-ui.js"></script>*/ ?>
<script type="text/javascript" src="<?=$csspath?>js/jquery-fluid16.js"></script>
<script type="text/javascript" src="<?=$csspath?>js/js.global.js"></script>
<?php if($js_valid==true){ 
echo '<script type="text/javascript" src="'.$csspath.'js/validate/jquery.form.js"></script>
<script type="text/javascript" src="'.$csspath.'js/validate/jquery.validate.min.js"></script> 
<script type="text/javascript" src="'.$csspath.'js/validate/jquery.validate.plus.js"></script>  ';
 
switch($admin_txt['lang']){
case '3':
echo '<script type="text/javascript" src="'.$csspath.'js/validate/messages_cn.js"></script>';
break;
case '2':
echo '<script type="text/javascript" src="'.$csspath.'js/validate/messages_tw.js"></script>';
break;
}
}
echo '<link rel="stylesheet" href="'.$csspath.'js/colorbox/colorbox.css"/>
<script type="text/javascript" src="'.$csspath.'js/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript">
function cbox_deg(){			$(".clbox").colorbox({iframe:true, innerWidth:720, innerHeight:560});			$("a[rel=\'clbox\']").colorbox({transition:"none",rel:"nofollow"});	}
$(document).ready(function(){	cbox_deg();		});
</script>';
?>
<?=$all_page_js?>
<link rel="stylesheet" type="text/css" href="<?=$csspath?>css/css.override.css" />   