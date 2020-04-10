<!DOCTYPE html>
    <html>
    <head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
 

    {{ HTML::style('static/admin/css/bootstrap.min.css');}}
    {{ HTML::style('static/admin/css/metisMenu/metisMenu.min.css');}}
    {{ HTML::style('static/admin/css/admin2.css');}}
    {{ HTML::style('static/admin/css/admin_plus.css');}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
             {{ HTML::script('static/admin/js/html5shiv.js');}} 
             {{ HTML::script('static/admin/js/respond.min.js');}} 
    <![endif]-->
    
    
    <!-- Custom Fonts -->
    {{ HTML::style('static/admin/font-awesome-4.5.0/css/font-awesome.min.css');}}
    
    
		
 
<?php echo'<script>
var admin_path="'.ADMIN_PATH.'";
</script>'?>
    
    </head>
    <body>
 

     
    <div id="wrapper">
<!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top " role="navigation" style="margin-bottom: 0;" >
            <div class="navbar-header col-xs-12 p0" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand hidden-xs" href="admin"><span id="logo-img"></span> {{ $admin_title }}</a>
          
            <!-- /.navbar-header -->


  {{ $topbar }}
 

 
<?php
        
		/*
		                <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
						*/
		?> 
  {{ $sidemenu }} 
  </div>
                
 
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper" style="padding-top:60px;">
  {{ $content }}
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
     
 {{ HTML::script('static/admin/js/jquery-1.11.0.js');}} 
 {{ HTML::script('static/admin/js/jquery-migrate-1.0.0.js');}} 
 {{ HTML::script('static/admin/js/bootstrap.min.js');}} 
 {{ HTML::script('static/admin/js/metisMenu/metisMenu.min.js');}} 
  
 {{ HTML::script('static/admin/js/validate/jquery.form.js');}} 
 {{ HTML::script('static/admin/js/validate/jquery.validate.min.js');}} 
 {{ HTML::script('static/admin/js/validate/jquery.validate.plus.js');}} 
 
  {{ $plus_css_js }}
 {{ HTML::script('static/admin/js/admin.js');}} 
 
  

    </body>
</html>