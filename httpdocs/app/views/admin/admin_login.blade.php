<div class="container">

<h2>Login <small>(Admin)</small></h2>

<div class="row">

  <div class="col-md-3">&nbsp;</div>
  <div class="col-md-6">
	{{ Form::open(array( 'method'=>'POST' , 'id'=>'infoform'	, 'role'=>'form' ,'class'=>'form-horizontal'	,'onsubmit'=>'return false'  )) }}
          <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" name="username" class="form-control required" id="inputEmail3" placeholder="Username">
                    </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password"  class="form-control required" id="inputPassword3" placeholder="Password">
            </div>
          </div>
          

 
<?php /*
          <div class="form-group">
            <div class="col-sm-10 pull-right">  
             @foreach ($errors->all() as $error)
          <div class="text-left"><div class="alert alert-danger mb5"><i class="fa fa-exclamation-circle "></i>&nbsp;{{ $error }}</div></div>
        
        @endforeach
        @if (Session::has('result'))
            <div class="text-left"><div class="alert alert-danger  mb5"><i class="fa fa-exclamation-circle "></i>&nbsp;{{ Session::get('result'); }}</div></div>
        @endif
            
             </div>
          </div>
          */ ?>
          <div class="form-group"><p class="text-center" id="error_ct"></p>          </div>
                      <div class="form-group">
                        
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-default">Login</button>
                                </div>
                      </div> 


           

	{{ Form::close() }}
    </div>
 
     
  <div class="col-md-3">&nbsp;</div>
</div>
</div>

