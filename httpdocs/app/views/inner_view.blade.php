<!DOCTYPE html>
    <html>
    <head>
    <title>{{ $page_title }}</title>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
  {{ $meta_data }}
    <!-- Bootstrap -->
    {{ HTML::style('static/css/bootstrap.min.css');}}
    {{ HTML::style('static/css/reset.css');}}
    {{ HTML::style('static/css/layout.css');}}
    {{ HTML::style('static/css/override.css');}} 
    {{ HTML::style('static/css/responsive.css');}} 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
             {{ HTML::script('static/js/html5shiv.js');}} 
    <![endif]-->
    <!-- Custom Fonts -->
    {{ HTML::style('static/css/font-awesome-4.5.0/css/font-awesome.min.css');}}
  {{ $head_css_js }}
    </head>
    <body>
    <div id="main">
{{ $nav }}
{{ $content }}
{{ $footer }}
</div>
{{ HTML::script('static/js/jquery-1.11.0.js');}}
 {{ HTML::script('static/js/jquery-migrate-1.0.0.js');}}
 {{ HTML::script('static/js/jquery.easing.min.js');}}
 {{ HTML::script('static/js/bootstrap.min.js');}} 
 {{ $plus_css_js }}
  {{ HTML::script('static/js/js.myjs.js');}} 
    </body>
</html>