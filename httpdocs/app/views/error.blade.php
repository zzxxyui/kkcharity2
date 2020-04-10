<!DOCTYPE html>
    <html>
    <head>
    <title>{{ $title }} </title>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="  user-scalable=yes,width=400 " />
  
    <!-- Bootstrap -->
    {{ HTML::style('static/css/bootstrap.min.css');}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
             {{ HTML::script('static/js/html5shiv.js');}} 
    <![endif]-->
    <!-- Custom Fonts -->
    
    {{ HTML::style('static/css/font-awesome-4.1.0/css/font-awesome.min.css');}}
 
    </head>

<body style="margin:0 auto;">



<?php


echo '				<div class="container ma0 row" style="padding:40px 0 0 0; margin:0 auto;">
		
		<div class="col-lg-10 col-lg-offset-1 text-center mb20">
		<img src="'.url('static/images/logo.png').'" style="float:none;margin:0 auto;" alt="" class="img-responsive ma0" />
		</div>
		<div class="col-lg-8 col-lg-offset-2 text-center mt20  ">
		<h2 class="  m0 text-dred no-tf"   style="font-size:2.5em;" >';?>{{ $title }} <? echo '</h2>
                <div class="myline myline-red animated  fadeInLeft " data-id="1" >&nbsp;</div>
 
 <div class="alert alert-warning text-left">
The page/file cannot be found.<br/>
The page/file you are looking for might have been removed, had its name changed, <br/> or is temporarily unavailable...
</div>
		<p class="col-xs-12 mt20"><a href="'.url('').'" class="btn btn-default">Back 返回</a></p>
		
		</div> 
		</div>
 '; ?>
  
 {{ HTML::script('static/js/jquery-1.11.0.js');}}
 {{ HTML::script('static/js/jquery-migrate-1.0.0.js');}}
 {{ HTML::script('static/js/jquery.easing.min.js');}} 
 {{ HTML::script('static/js/bootstrap.min.js');}}   
    </body>
</html>