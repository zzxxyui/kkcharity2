<?php

$data = Input::all();
$this->itemid=(isset($data['id']))?ceil($data['id']):0;

//$this->itemid=(ceil($_GET['id'])>0)?ceil($_GET['id']):0;	


$this->edit_page_type='edit';
require_once('create.php');
?>