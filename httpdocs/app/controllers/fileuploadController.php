<?php
//include_once('UploadHandler.php');
class fileuploadController extends Controller {
	
	
protected $options;

	public $admin_file='/static/admin/';
	
	
    // PHP File Upload error message codes:
    // http://php.net/manual/en/features.file-upload.errors.php
protected $error_messages = array(
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk',
        8 => 'A PHP extension stopped the file upload',
        'post_max_size' => 'The uploaded file exceeds the post_max_size directive in php.ini',
        'max_file_size' => 'File is too big',
        'min_file_size' => 'File is too small',
        'accept_file_types' => 'Filetype not allowed',
        'max_number_of_files' => 'Maximum number of files exceeded',
        'max_width' => 'Image exceeds maximum width',
        'min_width' => 'Image requires a minimum width',
        'max_height' => 'Image exceeds maximum height',
        'min_height' => 'Image requires a minimum height'
);
// function __construct( $myoption,$options = null, $initialize = true, $error_messages = null) {
 function uploadnow( $myoption,$options = null, $initialize = true, $error_messages = null) {
	 
	 	$this->up_id=$myoption['up_id']; 
		$this->user_id=$myoption['user_id']; 
		$this->upload_tb=$myoption['upload_tb']; 
		$this->tb_val=$myoption['tb_val'];  
	//	$this->key_val=$myoption['key_val']; 
		$this->rename_val=$myoption['rename_val']; 
		$this->folder_val=$myoption['folder_val']; 
		
		$this->sp_field=$myoption['sp_field']; 
		$this->up_type=($myoption['up_type']=='onefile')?'onefile':'manyfile'; 

		$this->max_w=($myoption['max_w']!='')?ceil($myoption['max_w']):1024; 
		$this->max_h=($myoption['max_h']!='')?ceil($myoption['max_h']):768; 

	
		$this->thumbnail=($myoption['thumbnail']!='')?ceil($myoption['thumbnail']):0; 
		
		$this->thumbnail_max_w=($myoption['thumbnail_max_w']!='')?ceil($myoption['thumbnail_max_w']):320; 
		$this->thumbnail_max_h=($myoption['thumbnail_max_h']!='')?ceil($myoption['thumbnail_max_h']):240; 
	
		$this->script_url=$myoption['script_url']; 
		$this->upload_dir=$myoption['upload_dir']; 
		$this->upload_url=$myoption['upload_url']; 
	
 
	
	
  $this->options = array(

            'script_url' => 		$this->script_url.		$this->folder_val.'/',
            'upload_dir' =>  		$this->upload_dir.		$this->folder_val.'/',
            'upload_url' => 		$this->upload_url.		$this->folder_val.'/',
            'user_dirs' => false,
            'mkdir_mode' => 0755,
            'param_name' => 'files',
            // Set the following option to 'POST', if your server does not support
            // DELETE requests. This is a parameter sent to the client:
            'delete_type' => 'DELETE',
            'access_control_allow_origin' => '*',
            'access_control_allow_credentials' => false,
            'access_control_allow_methods' => array(
                'OPTIONS',
                'HEAD',
                'GET',
                'POST',
                'PUT',
                'PATCH',
             //   'DELETE'
            ),
            'access_control_allow_headers' => array(
                'Content-Type',
                'Content-Range',
                'Content-Disposition'
            ),
            // Enable to provide file downloads via GET requests to the PHP script:
            'download_via_php' => false,
            // Defines which files can be displayed inline when downloaded:
           // 'inline_file_types' => '/\.(gif|jpe?g|png)$/i',
            'inline_file_types' =>($myoption['file_types']!='')?$myoption['file_types']:'/\.(gif|jpe?g|png|pdf|flv|doc|docx|mp4)$/i',
            // Defines which files (based on their names) are accepted for upload:
           // 'accept_file_types' => '/.+$/i',
			
          //  'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
            'accept_file_types' => ($myoption['file_types']!='')?$myoption['file_types']:'/\.(gif|jpe?g|png|pdf|flv|doc|docx|mp4)$/i',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => 100*1024*1024,
          //  'max_file_size' => null,
            'min_file_size' => 1,
            // The maximum number of files for the upload directory:
           // 'max_number_of_files' => null,
            'max_number_of_files' => null,
            // Image resolution restrictions:
            'max_width' => null,
            'max_height' => null,
            'min_width' => 1,
            'min_height' => 1,
            // Set the following option to false to enable resumable uploads:
            'discard_aborted_uploads' => true,
            // Set to true to rotate images based on EXIF meta data, if available:
            'orient_image' => false,
            'image_versions' => array(
                // Uncomment the following version to restrict the size of
                // uploaded images:
           
                '' => array(
                    'max_width' => $this->max_w,
                    'max_height' =>$this->max_h,
                    'jpeg_quality' => 100
                ),
         
                // Uncomment the following to create medium sized images:
                /*
                'medium' => array(
                    'max_width' => 800,
                    'max_height' => 600,
                    'jpeg_quality' => 80
                ),
                */
          (($this->thumbnail==1)? 'thumb':'' )=> array(
                    // Uncomment the following to force the max
                    // dimensions and e.g. create square thumbnails:
                    //'crop' => true,
                    'max_width' =>   (($this->thumbnail==1)?   $this->thumbnail_max_w:$this->max_w),
                    'max_height' => 	  (($this->thumbnail==1)?$this->thumbnail_max_h:$this->max_h) 
                )
			
            )
        );
		
		     if ($options) {
            $this->options = array_merge($this->options, $options);
        }
        if ($error_messages) {
            $this->error_messages = array_merge($this->error_messages, $error_messages);
        }
        if ($initialize) {
            $this->initialize();
        }
		
} //__construct


	public	function myurl($val){
		$ssl=0;
		
		if( str_is('*https*',Config::get('gbkey.DOMAIN')) ) {
		$ssl=1;
		}
		
		$url=$val;
		if($ssl==1){
		$url=URL::secure($val);
		}else{
		$url=URL::to($val);
		}
		
		return $url;
		
	}
	
	
   protected function initialize() {
        switch ($this->get_server_var('REQUEST_METHOD')) {
            case 'OPTIONS':
            case 'HEAD':
                $this->head();
                break;
            case 'GET':
                $this->get();
                break;
            case 'PATCH':
            case 'PUT':
            case 'POST':
                $this->post();
                break;
			/*	
            case 'DELETE':
                $this->delete();
                break;
			*/
				
            default:
                $this->header('HTTP/1.1 405 Method Not Allowed');
        }
    }

    protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
        return
            ($https ? 'https://' : 'http://').
            (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
            substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

    protected function get_user_id() {
        @session_start();
        return session_id();
    }

    protected function get_user_path() {
        if ($this->options['user_dirs']) {
            return $this->get_user_id().'/';
        }
        return '';
    }

    protected function get_upload_path($file_name = null, $version = null) {
        $file_name = $file_name ? $file_name : '';
        $version_path = empty($version) ? '' : $version.'/';
        return $this->options['upload_dir'].$this->get_user_path()
            .$version_path.$file_name;
    }

    protected function get_query_separator($url) {
        return strpos($url, '?') === false ? '?' : '&';
    }

    protected function get_download_url($file_name, $version = null) {
        if ($this->options['download_via_php']) {
            $url = $this->options['script_url']
                .$this->get_query_separator($this->options['script_url'])
                .'file='.rawurlencode($file_name);
            if ($version) {
                $url .= '&version='.rawurlencode($version);
            }
            return $url.'&download=1';
        }
        $version_path = empty($version) ? '' : rawurlencode($version).'/';
        return $this->options['upload_url'].$this->get_user_path()
            .$version_path.rawurlencode($file_name);
    }

    protected function set_file_delete_properties($file) {
		$newcbsize = myfunc::imgVirtualResize($this->options['upload_dir'].$file->name,160,  120);	
			
 
        $file->i_w = ceil(round($newcbsize[0]));
        $file->i_h =  ceil(round($newcbsize[1]));
			
		
        $file->delete_url ='';
		/*
        $file->delete_url = $this->options['script_url']
            .$this->get_query_separator($this->options['script_url'])
            .'file='.rawurlencode($file->name).'&postid='.$this->up_id.'&tbval='.$this->tb_val.'&upload_tb='.$this->upload_tb.'&folder_val='.$this->folder_val;
			*/
			
        $file->delete_type = $this->options['delete_type'];
        if ($file->delete_type !== 'DELETE') {
            $file->delete_url .= '&_method=DELETE';
        }
        if ($this->options['access_control_allow_credentials']) {
            $file->delete_with_credentials = true;
        }
    }

    // Fix for overflowing signed 32 bit integers,
    // works for sizes up to 2^32-1 bytes (4 GiB - 1):
    protected function fix_integer_overflow($size) {
        if ($size < 0) {
            $size += 2.0 * (PHP_INT_MAX + 1);
        }
        return $size;
    }

    protected function get_file_size($file_path, $clear_stat_cache = false) {
        if ($clear_stat_cache) {
            @clearstatcache(true, $file_path);
        }
        return $this->fix_integer_overflow(filesize($file_path));

    }

    protected function is_valid_file_object($file_name) {
        $file_path = $this->get_upload_path($file_name);
        if (is_file($file_path) && $file_name[0] !== '.') {
            return true;
        }
        return false;
    }

    protected function get_file_object($file_name) {
        if ($this->is_valid_file_object($file_name)) {
            $file = new stdClass();
            $file->name = $file_name;
            $file->size = $this->get_file_size(
                $this->get_upload_path($file_name)
            );
            $file->url = $this->get_download_url($file->name);
            foreach($this->options['image_versions'] as $version => $options) {
                if (!empty($version)) {
                    if (is_file($this->get_upload_path($file_name, $version))) {
                        $file->{$version.'_url'} = $this->get_download_url(
                            $file->name,
                            $version
                        );
                    }
                }
            }
            $this->set_file_delete_properties($file);
            return $file;
        }
        return null;
    }

    protected function get_file_objects($iteration_method = 'get_file_object') {
        $upload_dir = $this->get_upload_path();
        if (!is_dir($upload_dir)) {
            return array();
        }
        return array_values(array_filter(array_map(
            array($this, $iteration_method),
            scandir($upload_dir)
        )));
    }

    protected function count_file_objects() {
        return count($this->get_file_objects('is_valid_file_object'));
    }

    protected function create_scaled_image($file_name, $version, $options) {
        $file_path = $this->get_upload_path($file_name);
        if (!empty($version)) {
            $version_dir = $this->get_upload_path(null, $version);
            if (!is_dir($version_dir)) {
                mkdir($version_dir, $this->options['mkdir_mode'], true);
            }
            $new_file_path = $version_dir.'/'.$file_name;
        } else {
            $new_file_path = $file_path;
        }
        if (!function_exists('getimagesize')) {
            error_log('Function not found: getimagesize');
            return false;
        }
        list($img_width, $img_height) = @getimagesize($file_path);
        if (!$img_width || !$img_height) {
            return false;
        }
        $max_width = $options['max_width'];
        $max_height = $options['max_height'];
        $scale = min(
            $max_width / $img_width,
            $max_height / $img_height
        );
        if ($scale >= 1) {
            if ($file_path !== $new_file_path) {
                return copy($file_path, $new_file_path);
            }
            return true;
        }
        if (!function_exists('imagecreatetruecolor')) {
            error_log('Function not found: imagecreatetruecolor');
            return false;
        }
        if (empty($options['crop'])) {
            $new_width = $img_width * $scale;
            $new_height = $img_height * $scale;
            $dst_x = 0;
            $dst_y = 0;
            $new_img = @imagecreatetruecolor($new_width, $new_height);
        } else {
            if (($img_width / $img_height) >= ($max_width / $max_height)) {
                $new_width = $img_width / ($img_height / $max_height);
                $new_height = $max_height;
            } else {
                $new_width = $max_width;
                $new_height = $img_height / ($img_width / $max_width);
            }
            $dst_x = 0 - ($new_width - $max_width) / 2;
            $dst_y = 0 - ($new_height - $max_height) / 2;
            $new_img = @imagecreatetruecolor($max_width, $max_height);
        }
        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
            case 'jpg':
            case 'jpeg':
                $src_img = @imagecreatefromjpeg($file_path);
                $write_image = 'imagejpeg';
                $image_quality = isset($options['jpeg_quality']) ?
                    $options['jpeg_quality'] : 100;
                break;
            case 'gif':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                $src_img = @imagecreatefromgif($file_path);
                $write_image = 'imagegif';
                $image_quality = null;
                break;
            case 'png':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                @imagealphablending($new_img, false);
                @imagesavealpha($new_img, true);
                $src_img = @imagecreatefrompng($file_path);
                $write_image = 'imagepng';
                $image_quality = isset($options['png_quality']) ?
                    $options['png_quality'] :10;
                break;
            default:
                $src_img = null;
        }
        $success = $src_img && @imagecopyresampled(
            $new_img,
            $src_img,
            $dst_x,
            $dst_y,
            0,
            0,
            $new_width,
            $new_height,
            $img_width,
            $img_height
        ) && $write_image($new_img, $new_file_path, $image_quality);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }

    protected function get_error_message($error) {
        return array_key_exists($error, $this->error_messages) ?
            $this->error_messages[$error] : $error;
    }

    function get_config_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        switch($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $this->fix_integer_overflow($val);
    }

    protected function validate($uploaded_file, $file, $error, $index) {
        if ($error) {
            $file->error = $this->get_error_message($error);
            return false;
        }
        $content_length = $this->fix_integer_overflow(intval(
            $this->get_server_var('CONTENT_LENGTH')
        ));
        $post_max_size = $this->get_config_bytes(ini_get('post_max_size'));
        if ($post_max_size && ($content_length > $post_max_size)) {
            $file->error = $this->get_error_message('post_max_size');
            return false;
        } 
        if (!preg_match($this->options['accept_file_types'], $file->name)) {
            $file->error = $this->get_error_message('accept_file_types');
            return false;
        }
        if ($uploaded_file && is_uploaded_file($uploaded_file)) {
            $file_size = $this->get_file_size($uploaded_file);
        } else {
            $file_size = $content_length;
        }
        if ($this->options['max_file_size'] && (
                $file_size > $this->options['max_file_size'] ||
                $file->size > $this->options['max_file_size'])
            ) {
            $file->error = $this->get_error_message('max_file_size');
            return false;
        }
        if ($this->options['min_file_size'] &&
            $file_size < $this->options['min_file_size']) {
            $file->error = $this->get_error_message('min_file_size');
            return false;
        }
        if (is_int($this->options['max_number_of_files']) && (
                $this->count_file_objects() >= $this->options['max_number_of_files'])
            ) {
            $file->error = $this->get_error_message('max_number_of_files');
            return false;
        }
        list($img_width, $img_height) = @getimagesize($uploaded_file);
        if (is_int($img_width)) {
            if ($this->options['max_width'] && $img_width > $this->options['max_width']) {
                $file->error = $this->get_error_message('max_width');
                return false;
            }
            if ($this->options['max_height'] && $img_height > $this->options['max_height']) {
                $file->error = $this->get_error_message('max_height');
                return false;
            }
            if ($this->options['min_width'] && $img_width < $this->options['min_width']) {
                $file->error = $this->get_error_message('min_width');
                return false;
            }
            if ($this->options['min_height'] && $img_height < $this->options['min_height']) {
                $file->error = $this->get_error_message('min_height');
                return false;
            }
        }
        return true;
    }

    protected function upcount_name_callback($matches) {
        $index = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        $ext = isset($matches[2]) ? $matches[2] : '';
        return ' ('.$index.')'.$ext;
    }

    protected function upcount_name($name) {
        return preg_replace_callback(
            '/(?:(?: \(([\d]+)\))?(\.[^.]+))?$/',
            array($this, 'upcount_name_callback'),
            $name,
            1
        );
    }

    protected function get_unique_filename($name, $type, $index, $content_range) {
		  if( file_exists($this->get_upload_path($name))){
			  @unlink($this->get_upload_path($name));
		  }
        while(is_dir($this->get_upload_path($name))) {
            $name = $this->upcount_name($name);
        }
        // Keep an existing filename if this is part of a chunked upload:
        $uploaded_bytes = $this->fix_integer_overflow(intval($content_range[1]));
        while(is_file($this->get_upload_path($name))) {
            if ($uploaded_bytes === $this->get_file_size(
                    $this->get_upload_path($name))) {
                break;
            }
          //  $name = $this->upcount_name($name);
		  if( file_exists($this->get_upload_path($name))){
			  @unlink($this->get_upload_path($name));
		  }
            $name = $name;
        }
        return $name;
    }

    protected function trim_file_name($name, $type, $index, $content_range) {
        // Remove path information and dots around the filename, to prevent uploading
        // into different directories or replacing hidden system files.
        // Also remove control characters and spaces (\x00..\x20) around the filename:
	 	$red_name=$name;
        $name = trim(basename(stripslashes($name)), ".\x00..\x20");
		
	 	$getExt=$ext = strtolower(pathinfo($red_name, PATHINFO_EXTENSION));
      //  $name = md5($name.$index.date('Y-m-d H:i:s:u')).'.'.$getExt;
	  /*
		$this->up_id=$myoption['postid']; 
		$this->user_id=$myoption['user_id']; 
		$this->uptype=$myoption['uptype']; 
		$this->tb_val=$myoption['tb_val']; 
		$this->col_val=$myoption['col_val']; 
		$this->key_val=$myoption['key_val']; 
		$this->rename_val=$myoption['rename_val']; 
		$this->folder_val=$myoption['folder_val']
		*/
		switch($this->rename_val){
		case 'md5':
       $name = md5($name.time()).'.'.$getExt;
	   break;
	   
	   
		case 'nochange':
		 
		if( file_exists($this->options['upload_dir'].$name )){
       $name = md5($name.time()).'.'.$getExt;
		
		}else{
		
       $rename=str_replace('.'.$getExt,'',$name);
       $rename=myfunc::only_az($rename);
	   $rename=(strlen($rename)==0)?md5($name.time()):	   $rename;
	   $name = $rename.'.'.$getExt;
		}
	   
	   break;
 



		default:
		    $name =    $name;
        //$name = $this->post_item_no.'_'.date('Ymd_Hisu').'.'.$getExt;
		}
		
        // Use a timestamp for empty filenames:
        if (!$name) {
            $name = str_replace('.', '-', microtime(true));
        }
		 $name=strtolower( $name);
        // Add missing file extension for known image types:
        if (strpos($name, '.') === false &&
            preg_match('/^image\/(gif|jpe?g|png)/', $type, $matches)) {
            $name .= '.'.$matches[1];
        }
        return $name;
    }

    protected function get_file_name($name, $type, $index, $content_range) {
        return $this->get_unique_filename(
            $this->trim_file_name($name, $type, $index, $content_range),
            $type,
            $index,
            $content_range
        );
    }

    protected function handle_form_data($file, $index) {
        // Handle form data, e.g. $_REQUEST['description'][$index]
    }

    protected function orient_image($file_path) {
        if (!function_exists('exif_read_data')) {
            return false;
        }
        $exif = @exif_read_data($file_path);
        if ($exif === false) {
            return false;
        }
        $orientation = intval(@$exif['Orientation']);
        if (!in_array($orientation, array(3, 6, 8))) {
            return false;
        }
        $image = @imagecreatefromjpeg($file_path);
        switch ($orientation) {
            case 3:
                $image = @imagerotate($image, 180, 0);
                break;
            case 6:
                $image = @imagerotate($image, 270, 0);
                break;
            case 8:
                $image = @imagerotate($image, 90, 0);
                break;
            default:
                return false;
        }
        $success = imagejpeg($image, $file_path);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($image);
        return $success;
    }

    protected function handle_image_file($file_path, $file) {
        if ($this->options['orient_image']) {
            $this->orient_image($file_path);
        }
        $failed_versions = array();
        foreach($this->options['image_versions'] as $version => $options) {
            if ($this->create_scaled_image($file->name, $version, $options)) {
                if (!empty($version)) {
                    $file->{$version.'_url'} = $this->get_download_url(
                        $file->name,
                        $version
                    );
                } else {
                    $file->size = $this->get_file_size($file_path, true);
                }
            } else {
                $failed_versions[] = $version;
            }
        }
        switch (count($failed_versions)) {
            case 0:
                break;
            case 1:
                $file->error = 'Failed to create scaled version: '
                    .$failed_versions[0];
                break;
            default:
                $file->error = 'Failed to create scaled versions: '
                    .implode($failed_versions,', ');
        }
    }
	
	
		public function delete_one_before($thisid,$spfield){
			//$this->conn->debug=1;
 
			$thissql=sprintf(" select 
			id,file_name,old_file_name
			
			from ".DB_START.$this->upload_tb." where id!=%d and  parent_id =%d and tb_val='%s' and sp_field='%s'  order by createDate asc  ",$thisid, $this->up_id, $this->tb_val,$spfield);
			$rs = $this->conn->Execute($thissql);
			$thumb_totalRecord = $rs->RecordCount();
					if($thumb_totalRecord >0 ) {
		
					while (!$rs->EOF) {
					$thisfile=$rs->fields['file_name'];
					$delid=$rs->fields['id'];


     		  	 $file_path = $this->get_upload_path($thisfile);		 
       			 $file_path_tb =str_replace( $file_name,'', $file_path )	.'thumb/'. $thisfile ;
		
		
				@unlink($file_path_tb);
				@unlink($file_path);

				
				$delAct_mb= $this->conn->Execute(sprintf("delete from ".DB_START.$this->upload_tb." where id=%d	 	",$delid) );
								
					$rs->MoveNext();		
					}
					
		}
		


	}
	
	

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
        $file = new stdClass();
		$oldname=$name;
        $file->name = $this->get_file_name($name, $type, $index, $content_range);
        $file->size = $this->fix_integer_overflow(intval($size));
        $file->type = $type;
        if ($this->validate($uploaded_file, $file, $error, $index)) {
            $this->handle_form_data($file, $index);
            $upload_dir = $this->get_upload_path();
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, $this->options['mkdir_mode'], true);
            }
            $file_path = $this->get_upload_path($file->name);
            $append_file = $content_range && is_file($file_path) &&
                $file->size > $this->get_file_size($file_path);
            if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                // multipart/formdata uploads (POST method uploads)
                if ($append_file) {
                    file_put_contents(
                        $file_path,
                        fopen($uploaded_file, 'r'),
                        FILE_APPEND
                    );
                } else {
                    move_uploaded_file($uploaded_file, $file_path);
                }
 
 
 /*---------------------------------------DB-------------------------*/
 
 
 /*
 
 DROP TABLE IF EXISTS `dbkamtin`.`gb_imgfiles`;
CREATE TABLE  `dbkamtin`.`gb_imgfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(10) unsigned NOT NULL DEFAULT '0',
  `tb_val` varchar(255) NOT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `file_name` varchar(255) NOT NULL,
  `old_file_name` varchar(255) NOT NULL,
  `full_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) NOT NULL,
  `createDate` datetime NOT NULL,
  `caption1` varchar(60) NOT NULL,
  `caption2` varchar(60) NOT NULL,
  `caption3` varchar(60) NOT NULL,
  `sp_field` varchar(60) DEFAULT NULL,
  `detail1` text NOT NULL,
  `detail2` text NOT NULL,
  `detail3` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_tb_val` (`tb_val`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
 
 */
 
 /*------------------------Del old ------------------------------*/

if(	$this->up_type	=='onefile'){ 
	$results = DB::table($this->upload_tb	)->where('tb_val',   $this->tb_val)->where('sp_field',  $this->sp_field)->get();	
													
		if (count($results )>0){
		$i=0;
		foreach ($results as $ms) {
								
								if($ms->parent_id==$this->up_id){					
		@unlink($this->upload_dir. $ms->full_path);
		@unlink($this->upload_dir. $ms->thumbnail_path);
													
		DB::table($this->upload_tb)->where('id',   $ms->id)->delete();
								}
		}

		 }
}
 /*------------------------Del old ------------------------------*/
 



 

	$rank_val = DB::table($this->upload_tb)->select(DB::raw('max(rank) as rank'))
					   ->where('parent_id', $this->up_id)
					   ->where('tb_val', $this->tb_val)
					   ->where('sp_field', $this->sp_field)->first();	
					   
				// var_dump(DB::getQueryLog());
				//  var_dump($rank_val->rank );
				  
$rn=((ceil($rank_val->rank)==0)) ?'0':ceil($rank_val->rank)+1;			
$the_ext=myfunc::get_ext($file_path);
$base_tt= str_replace($the_ext,'',$oldname);
$chk=  DB::table($this->upload_tb)->insert(
    array(
	'rank' => 	$rn  ,
	'tb_val' => $this->tb_val,
	'parent_id' => $this->up_id,
	'file_name' => basename($file_path),
	'old_file_name' =>$oldname,
	'full_path' => $this->folder_val.'/'.basename($file_path),
	'thumbnail_path' => (($this->thumbnail==1)?$this->folder_val.'/thumb/'.basename($file_path):''),
	'created_at' =>  date("Y-m-d H:i:s"),
	'updated_at' =>  date("Y-m-d H:i:s"),
	'caption1' => '',
	'caption2' => '',
	'caption3' =>'',
	'detail1' => '',
	'detail2' => '',
	'detail3' => '',
	'sp_field' => (($this->sp_field!='')?$this->sp_field:'')
	)
	
);


	if(!$chk ){
		@unlink($this->upload_dir. $this->folder_val.'/'.basename($file_path));
	 if($this->thumbnail==1) @unlink($this->upload_dir.$this->folder_val.'/thumb/'.basename($file_path));
	 
}
 
	if( $this->sp_field!='')	$this->updateTotal($this->upload_tb,	$this->tb_val,$this->sp_field,$this->up_id);
		
	if($chk && $this->up_type=='onefile'){
//	$this->delete_one_before($this->conn->Insert_ID(),$this->sp_field);
	}
 
 
/*
 	//$rank_val=ceil($this->conn->GetOne(sprintf("  select max(rank) from ".$this->upload_tb." where    parent_id =%d and tb_val='%s' and sp_field='%s'    ",  $this->up_id,$this->tb_val,$this->sp_field)) )+1		;	
	$fields['id'] ='';
	$fields['rank'] =$rank_val;
	$fields['tb_val'] 	=$this->tb_val;
	$fields['parent_id'] 	=$this->up_id;
	$fields['file_name']=basename($file_path);
	$fields['full_path'] = $this->folder_val.'/'.basename($file_path);
	$fields['thumbnail_path'] =($this->thumbnail==1)?$this->folder_val.'/thumb/'.basename($file_path):'';
	//$fields['thumbnail_path'] =($this->thumbnail==1)?$this->folder_val.'/thumb/'.basename($file_path):'';
	$fields['old_file_name'] =  	$oldname ; 
	
	$fields['sp_field'] 	=($this->sp_field!='')?$this->sp_field:'';
	 
	$fields['createDate'] = date("Y-m-d H:i:s");   
			
  
	$inp=$this->conn->AutoExecute(DB_START.$this->upload_tb, $fields,'INSERT');
	
	
	if($inp && $this->up_type=='onefile'){
	$this->delete_one_before($this->conn->Insert_ID(),$this->sp_field);
	}
 
 
 */
 
 
 
 /*---------------------------------------DB-------------------------*/
 
 
 
 
 
 
	
 //	$this->conn->debug=1;
 /*
	$rank_val=ceil($this->conn->GetOne(sprintf("  select max(rank) from ".DB_START.$this->upload_tb." where    parent_id =%d and tb_val='%s' and sp_field='%s'    ",  $this->up_id,$this->tb_val,$this->sp_field)) )+1		;	
	$fields['id'] ='';
	$fields['rank'] =$rank_val;
	$fields['tb_val'] 	=$this->tb_val;
	$fields['parent_id'] 	=$this->up_id;
	$fields['file_name']=basename($file_path);
	$fields['full_path'] = $this->folder_val.'/'.basename($file_path);
	$fields['thumbnail_path'] =($this->thumbnail==1)?$this->folder_val.'/thumb/'.basename($file_path):'';
	//$fields['thumbnail_path'] =($this->thumbnail==1)?$this->folder_val.'/thumb/'.basename($file_path):'';
	$fields['old_file_name'] =  	$oldname ; 
	
	$fields['sp_field'] 	=($this->sp_field!='')?$this->sp_field:'';
	 
	$fields['createDate'] = date("Y-m-d H:i:s");   
			
  
	$inp=$this->conn->AutoExecute(DB_START.$this->upload_tb, $fields,'INSERT');
	
	
	if($inp && $this->setuploadtype=='onefile'){
	$this->delete_one_before($this->conn->Insert_ID(),$this->sp_field);
	}
	
	*/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
            } else {
                // Non-multipart uploads (PUT method support)
                file_put_contents(
                    $file_path,
                    fopen('php://input', 'r'),
                    $append_file ? FILE_APPEND : 0
                );
            }
            $file_size = $this->get_file_size($file_path, $append_file);
            if ($file_size === $file->size) {
                $file->url = $this->get_download_url($file->name);
                list($img_width, $img_height) = @getimagesize($file_path);
                if (is_int($img_width)) {
                    $this->handle_image_file($file_path, $file);
                }
            } else {
                $file->size = $file_size;
                if (!$content_range && $this->options['discard_aborted_uploads']) {
                    @unlink($file_path);
                    $file->error = 'abort';
                }
            }
            $this->set_file_delete_properties($file);
        }
		$file->old_file_name=$oldname ;
        return $file;
    }
function updateTotal( $updb, $tbname,$spf,$id){
 
	 
 

	$check_total = DB::table($updb)->where('sp_field', $spf)->where('tb_val', $tbname)   ->where('parent_id', $id)->count();
					   
 
 

	$check_img = DB::table($this->upload_tb)->select('file_name')->where('sp_field', $spf)->where('tb_val', $tbname)   ->where('parent_id', $id) 	  ->orderBy('rank', 'asc') ->first();	
					   
					   
//	$check_total=$this->conn->GetOne(sprintf("select count(*) from ".DB_START."gb_files  where sp_field='%s' and tb_val='%s' and parent_id=%d " , $spf, $tbname,$id));
	//$check_img=$this->conn->GetOne(sprintf("select file_name from ".DB_START."gb_files  where sp_field='%s' and tb_val='%s' and parent_id=%d order by rank asc" , $spf, $tbname,$id));
//	 $this->conn->Execute(sprintf("update  %s  SET %s='%s'  WHERE id=%d",DB_START.$tbname,$spf,ceil($check_total).','.$check_img->file_name ,$id));	
	 $sv=	DB::table($tbname) ->where('id', $id)->update(
				array(
				$spf=>ceil($check_total).','.$check_img->file_name 
				)
			);
}
	
	
    protected function readfile($file_path) {
        return readfile($file_path);
    }

    protected function body($str) {
        echo $str;
    }
    
    protected function header($str) {
        header($str);
    }

    protected function get_server_var($id) {
        return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
    }

    protected function generate_response($content, $print_response = true) {
	
        if ($print_response) {
            $json = json_encode($content);
            $redirect = isset($_REQUEST['redirect']) ?
                stripslashes($_REQUEST['redirect']) : null;
            if ($redirect) {
                $this->header('Location: '.sprintf($redirect, rawurlencode($json)));
                return;
            }
            $this->head();
            if ($this->get_server_var('HTTP_CONTENT_RANGE')) {
                $files = isset($content[$this->options['param_name']]) ?
                    $content[$this->options['param_name']] : null;
                if ($files && is_array($files) && is_object($files[0]) && $files[0]->size) {
                    $this->header('Range: 0-'.(
                        $this->fix_integer_overflow(intval($files[0]->size)) - 1
                    ));
                }
            }
            $this->body($json);
        }
        return $content;
    }

    protected function get_version_param() {
        return isset($_GET['version']) ? basename(stripslashes($_GET['version'])) : null;
    }

    protected function get_file_name_param() {
        return isset($_GET['file']) ? basename(stripslashes($_GET['file'])) : null;
    }

    protected function get_file_type($file_path) {
        switch (strtolower(pathinfo($file_path, PATHINFO_EXTENSION))) {
            case 'jpeg':
            case 'jpg':
                return 'image/jpeg';
            case 'png':
                return 'image/png';
            case 'gif':
                return 'image/gif';
            default:
                return '';
        }
    }

    protected function download() {
        if (!$this->options['download_via_php']) {
            $this->header('HTTP/1.1 403 Forbidden');
            return;
        }
        $file_name = $this->get_file_name_param();
        if ($this->is_valid_file_object($file_name)) {
            $file_path = $this->get_upload_path($file_name, $this->get_version_param());
            if (is_file($file_path)) {
                if (!preg_match($this->options['inline_file_types'], $file_name)) {
                    $this->header('Content-Description: File Transfer');
                    $this->header('Content-Type: application/octet-stream');
                    $this->header('Content-Disposition: attachment; filename="'.$file_name.'"');
                    $this->header('Content-Transfer-Encoding: binary');
                } else {
                    // Prevent Internet Explorer from MIME-sniffing the content-type:
                    $this->header('X-Content-Type-Options: nosniff');
                    $this->header('Content-Type: '.$this->get_file_type($file_path));
                    $this->header('Content-Disposition: inline; filename="'.$file_name.'"');
                }
                $this->header('Content-Length: '.$this->get_file_size($file_path));
                $this->header('Last-Modified: '.gmdate('D, d M Y H:i:s T', filemtime($file_path)));
                $this->readfile($file_path);
            }
        }
    }

    protected function send_content_type_header() {
        $this->header('Vary: Accept');
        if (strpos($this->get_server_var('HTTP_ACCEPT'), 'application/json') !== false) {
            $this->header('Content-type: application/json');
        } else {
            $this->header('Content-type: text/plain');
        }
    }

    protected function send_access_control_headers() {
        $this->header('Access-Control-Allow-Origin: '.$this->options['access_control_allow_origin']);
        $this->header('Access-Control-Allow-Credentials: '
            .($this->options['access_control_allow_credentials'] ? 'true' : 'false'));
        $this->header('Access-Control-Allow-Methods: '
            .implode(', ', $this->options['access_control_allow_methods']));
        $this->header('Access-Control-Allow-Headers: '
            .implode(', ', $this->options['access_control_allow_headers']));
    }

    public function head() {
        $this->header('Pragma: no-cache');
        $this->header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->header('Content-Disposition: inline; filename="files.json"');
        // Prevent Internet Explorer from MIME-sniffing the content-type:
        $this->header('X-Content-Type-Options: nosniff');
        if ($this->options['access_control_allow_origin']) {
            $this->send_access_control_headers();
        }
        $this->send_content_type_header();
    }

    public function get($print_response = true) {
		
		 
		/*
        if ($print_response && isset($_GET['download'])) {

            return $this->download();
        }
        $file_name = $this->get_file_name_param();
        if ($file_name) {
            $response = array(
                substr($this->options['param_name'], 0, -1) => $this->get_file_object($file_name)
            );
        } else {
            $response = array(
                $this->options['param_name'] => $this->get_file_objects()
            );
        }
		*/
		$print_response=true;
		
    /*
   
			//$this->conn->debug=1;
			
			$sp_sql=($this->sp_field!='')?sprintf(" and sp_field='%s' ",$this->sp_field):' ';
			$thissql=sprintf(" select 
			file_name,old_file_name
			
			from ".DB_START.$this->upload_tb." where  parent_id =%d and tb_val='%s' %s order by createDate asc", $this->up_id, $this->tb_val,$sp_sql);
			$rs = $this->conn->Execute($thissql);
			$thumb_totalRecord = $rs->RecordCount();
					if($thumb_totalRecord >0 ) {
			$myphotolist=array();			
					while (!$rs->EOF) {
					$thisfile=$rs->fields['file_name'];
					$thisfileName=basename($rs->fields['file_name']);	
				$arrVal = @getimagesize($this->options['upload_dir'].$thisfileName);
				
				 //$tbpath=(	$this->thumbnail==1)?$this->options['upload_url'].'thumbnail/'.$thisfileName:$this->options['upload_url'].$thisfileName;
				 $tbpath=(	$this->thumbnail==1)?$this->options['upload_url'].'thumb/'.$thisfileName:$this->options['upload_url'].$thisfileName;
		 
		 		$imgIcon=array('jpeg','jpg','gif','png');
				$getExt= strtolower(pathinfo($thisfileName, PATHINFO_EXTENSION));
		if(in_array($getExt,$imgIcon)){
			//$this_thumbnail_path=$this->options['upload_url'].'thumbnail/'.$thisfileName;
	 		$this_thumbnail_path= $tbpath;
		}else{
	 		$this_thumbnail_path=ADMIN_PATH.'/img/ico_file.jpg';
		
		}
		
		$newcbsize = myfunc::imgVirtualResize($this->options['upload_dir'].$thisfileName,160,  120);	
        $i_w = ceil(round($newcbsize[0]));
        $i_h =  ceil(round($newcbsize[1]));
		
		
				$myphotolist[]=array(
				"name"=>$thisfileName,
				"old_file_name"=>$rs->fields['old_file_name'],
				
			"size"=> @filesize($this->options['upload_dir'].$thisfileName) ,
			"type"=>$arrVal['mime'],
			"url"=>$this_thumbnail_path,
			"thumbnail_url"=>$this_thumbnail_path,
			"i_w"=>$i_w,
			"i_h"=>$i_h,
			//"delete_url"=>$this->options['script_url']."?file=".$thisfileName,
			
			"delete_url"=>$this->options['script_url']."?file=".$thisfileName.'&postid='.$this->up_id.'&tbval='.$this->tb_val.'&upload_tb='.$this->upload_tb.'&folder_val='.$this->folder_val,
			"delete_type"=>"DELETE"
				
				);		
			
						
								
					$rs->MoveNext();		
					}
					
	  $response = array('files'=>$myphotolist           );
		}else{

	  $response = array(       substr($this->options['param_name'], 0, -1) =>array()            );
		}
	
	
	
	*/
	
	
	
	
	
	
		
        return $this->generate_response($response, $print_response);
    }

    public function post($print_response = true) {
        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
            return $this->delete($print_response);
        }
        $upload = isset($_FILES[$this->options['param_name']]) ?
            $_FILES[$this->options['param_name']] : null;
        // Parse the Content-Disposition header, if available:
        $file_name = $this->get_server_var('HTTP_CONTENT_DISPOSITION') ?
            rawurldecode(preg_replace(
                '/(^[^"]+")|("$)/',
                '',
                $this->get_server_var('HTTP_CONTENT_DISPOSITION')
            )) : null;
        // Parse the Content-Range header, which has the following form:
        // Content-Range: bytes 0-524287/2000000
		if(ceil($this->up_id)==0){
		return false;
		}
        $content_range = $this->get_server_var('HTTP_CONTENT_RANGE') ?
            preg_split('/[^0-9]+/', $this->get_server_var('HTTP_CONTENT_RANGE')) : null;
        $size =  $content_range ? $content_range[3] : null;
        $files = array();
        if ($upload && is_array($upload['tmp_name'])) {
            // param_name is an array identifier like "files[]",
            // $_FILES is a multi-dimensional array:
            foreach ($upload['tmp_name'] as $index => $value) {
                $files[] = $this->handle_file_upload(
                    $upload['tmp_name'][$index],
                    $file_name ? $file_name : $upload['name'][$index],
                    $size ? $size : $upload['size'][$index],
                    $upload['type'][$index],
                    $upload['error'][$index],
                    $index,
                    $content_range
                );
            }
        } else {
            // param_name is a single object identifier like "file",
            // $_FILES is a one-dimensional array:
            $files[] = $this->handle_file_upload(
                isset($upload['tmp_name']) ? $upload['tmp_name'] : null,
                $file_name ? $file_name : (isset($upload['name']) ?
                        $upload['name'] : null),
                $size ? $size : (isset($upload['size']) ?
                        $upload['size'] : $this->get_server_var('CONTENT_LENGTH')),
                isset($upload['type']) ?
                        $upload['type'] : $this->get_server_var('CONTENT_TYPE'),
                isset($upload['error']) ? $upload['error'] : null,
                null,
                $content_range
            );
        }
        return $this->generate_response(
            array($this->options['param_name'] => $files),
            $print_response
        );
    }

    public function delete($print_response = true) {
		/*
        $file_name = $this->get_file_name_param();
        $file_path = $this->get_upload_path($file_name);
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        if ($success) {
            foreach($this->options['image_versions'] as $version => $options) {
                if (!empty($version)) {
					
					 
                    $file = $this->get_upload_path($file_name, $version);
                    if (is_file($file)) {
                        unlink($file);
                    }
				 
					
					//echo $file_name;
                }
            }
        }
		*/
		
		/*
        $file_name = $this->get_file_name_param();
        $file_path = $this->get_upload_path($file_name);
		 
		 $success=false;
 
	$DDfields[$this->col_val]='';
	//$this->conn->debug=1;
	$delAct_mb=$this->conn->AutoExecute($this->tb_val, $DDfields,'UPDATE',sprintf(" %s='%s' ",$this->key_val,$this->up_id));
	
		if(	 $delAct_mb){
			@unlink($file_path);
		 $success=true;
		}else{
		 $success=false;
		}
        return $this->generate_response(array('success' => $success), $print_response);
    }


        $file_name = $this->get_file_name_param();
        $file_path = $this->get_upload_path($file_name);		 
      //  $file_path_tb =str_replace( $file_name,'', $file_path )	.'thumbnail/'. $file_name ;
        $file_path_tb =str_replace( $file_name,'', $file_path )	.'thumb/'. $file_name ;
		
		 $success=false;
	 
	$this->sp_field=$this->conn->GetOne(sprintf("select sp_field from ".DB_START.$this->upload_tb." where file_name='%s' and parent_id=%d	and tb_val='%s'	", $file_name,$this->up_id,$this->tb_val) );
	
	$delAct_mb= $this->conn->Execute(sprintf("delete from ".DB_START.$this->upload_tb." where file_name='%s' and parent_id=%d	and tb_val='%s'	", $file_name,$this->up_id,$this->tb_val) );
		if(	 $delAct_mb){
			@unlink($file_path_tb);
			@unlink($file_path);
		 $success=true;
		}else{
		 $success=false;
		}
		
		
	if($delAct_mb && $this->sp_field!='')	$this->updateTotal($this->tb_val,$this->sp_field,$this->up_id);
		
	
        return $this->generate_response(array('success' => $success), $print_response);*/
    }
	
	
	
	
	
	

public function doUpload()
{

	if(	Auth::user()->check() && Auth::user()->get()->roles_id<=2){
	
$data = Input::all();
if($data['up_id']=='')exit;
if($data['up_type']=='')exit;
$cng_arr=Config::get('gbkey.'.$data['up_type']);

$myoption=array(
'user_id'=>Auth::user()->get()->id,
'up_type'=>$cng_arr['type']	,
'up_id'=>ceil($data['up_id'])	,

'upload_tb'=>$cng_arr['table']		, 
'tb_val'=>$cng_arr['tb_val']	,
 
'rename_val'=>$cng_arr['rename_val']	,
'folder_val'=>$cng_arr['folder_val'],
'max_w'=>$cng_arr['max_w']	,
'max_h'=>$cng_arr['max_h']	,
'sp_field'=>$cng_arr['sp_field']	,

'thumbnail'=>$cng_arr['thumbnail'],
'thumbnail_max_w'=>$cng_arr['thumbnail_max_w'],
'thumbnail_max_h'=>$cng_arr['thumbnail_max_h'],



'script_url'=>$cng_arr['script_url'],
'upload_dir'=>$cng_arr['upload_dir'],
'upload_url'=>$cng_arr['upload_url'],



'file_types'=>$cng_arr['file_types'],
);

return $this->uploadnow($myoption);

 }else{
	 return 'login required';
	}
} 




 public function get_upload_box(){
	
	if(	Auth::user()->check() && Auth::user()->get()->roles_id<=2){
 
//       '.$plusVal.'
$data = Input::all();
$pv1=($data['up_id']!='')?'<input type="hidden" name="up_id" value="'.$data['up_id'].'"/>':'';
$pv2=($data['up_type']!='')?'<input type="hidden"  name="up_type"  value="'.$data['up_type'].'"/>':'';		



$cng_arr=Config::get('gbkey.'.$data['up_type']);
  

/*


                <input type="checkbox" class="toggle">
				
				
				
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>delete</span>
                </button>
	<dd  class="dd-buttonset">
            <button class="btn btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields=\'{"withCredentials":true}\'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>delete</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </dd>
		
		
*/
$is_mutli=($cng_arr['type']=='onefile')?'':' multiple';

$upinc_content=' 
						 
<form id="fileupload" method="POST" enctype="multipart/form-data" > 
'.$pv1.'
'.$pv2.'
        <div class="row fileupload-buttonbar "  style="width:100%;">
        <div class="col-xs-6">
			
                <span class="btn btn-success fileinput-button">
                    <i class="fa fa-file lg"></i>                    <span>Select File</span>                    <input size="20" type="file" name="files[]" '.$is_mutli.'>
                </span>
         
                <button type="reset" class="btn btn-warning cancel">
                                <i class="fa  fa-minus lg"></i>                   <span>Cancel</span>                </button>
           		<button type="button" class="btn btn-danger clearbtn ">
                       <i class="fa fa-trash-o lg"></i>                      <span>Clear</span>                </button>

                <span class="fileupload-loading"></span>
        </div>
			
        <div class="col-xs-6 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
       <div id="fld_cont" class="files clearfix" data-toggle="modal-gallery" data-target="#modal-gallery"></div> 
</form>
     
	 
	 
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <dl class="template-upload fade">
        <dd  class="dd-preview">
            <p class="preview"></p>
        </dd>
        <dd  class="dd-name">
            {% if (file.error) { %}
                <div><span class="label label-important">Error</span> {%=file.error%}</div>
            {% } %}
        </dd>
        <dd  class="dd-size">
            <p class="size">{%=o.formatFileSize(file.size)%}</p>
            {% if (!o.files.error) { %}
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            {% } %}
        </dd>
        <dd  class="dd-buttonset">
            {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" style="display:none"> 
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel" style="line-height:0.5em"> Cancel
                </button>
            {% } %}
        </dd>
    </dl>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <dl class="template-download fade">
        <dd  class="dd-preview">
            <span class="preview">
                {% if (file.url) { %}
                	{% if (file.i_w>0 && file.i_h>0) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" target="_blank" class="clbox p_center" rel="clbox"><img   width="{%=file.i_w%}" height="{%=file.i_h%}" src="{%=file.url%}"></a>
					{%  }else{	%}
                    <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" target="_blank" class="clbox p_center" rel="clbox"><img  src="'.$this->myurl($this->admin_file.'images/ico_file.jpg').'"/></a>
               		 {% } %}
					
                {% } %}
            </span>
        </dd>
        <dd  class="dd-name">
            {%=file.old_file_name%}
            {% if (file.error) { %}
                <div><span class="label label-important">Error</span> {%=file.error%}</div>
            {% } %}
        </dd>
        <dd  class="dd-size down">
            <span class="size ">{%=o.formatFileSize(file.size)%}</span>
        </dd>

    </dl>
{% } %}
</script>';	
	
return $upinc_content;
 }


 
}


public function saveCaption(){
	

	if(	Auth::user()->check() && Auth::user()->get()->roles_id<=2){
		 $data = Input::all();
		$cid=($data['cid']!='')?$data['cid']:exit;
		$pv2=($data['up_type']!='')?$data['up_type']:exit;
		
		$cng_arr=Config::get('gbkey.'.$pv2);
		
		$udarray=array();
		
			foreach($cng_arr['caption'] as $ckey=>$cval){
						$udarray[$ckey]=$data[$ckey];
			};
			foreach($cng_arr['description'] as $ckey=>$cval){
						$udarray[$ckey]=$data[$ckey];
			};
		
	if(count($udarray)>0){	
	$sv=	DB::table($cng_arr['table'])->where('id',$cid)->update(
	$udarray
		);
	}

		 return Response::json('success', 200);;
		
		
		
	 }
		
}
public function loadCaption(){


	if(	Auth::user()->check() && Auth::user()->get()->roles_id<=2){
		 $data = Input::all();
		$cid=($data['id']!='')?$data['id']:exit;
		$pv2=($data['up_type']!='')?$data['up_type']:exit;
		$cng_arr=Config::get('gbkey.'.$pv2);
		$str='';
			$results = DB::table($cng_arr['table']	)
													->where('id',   $cid)
													->first();	
												//	print_r(		$results );
 	
												
				$basc_val='
				 
<div class="form-group clearfix">
	<label class="col-sm-3 control-label">
	File:
	</label>
	<div class="col-sm-9">
		'.	$results->old_file_name.'
	</div>
</div>
<div class="form-group clearfix">
	<label class="col-sm-3 control-label">
	Storage Path:
	</label>
	<div class="col-sm-9">
	 <a  href="'.$cng_arr['upload_url'].$results->full_path.'" target="_blank">Click Here</a>
	</div>
</div>

				';									
		 if($cng_arr['caption']){
				$str=''; 
			foreach($cng_arr['caption'] as $ckey=>$cval){
			$str.=' 
			
<div class="form-group clearfix">
	<label class="col-sm-3 control-label">
	Caption -'.$cval.'
	</label>
	<div class="col-sm-9">
		<input class="form-control" name="'.$ckey.'" value="'.$results->$ckey.'"/>
	</div>
</div>
 ';

			
			}
		}
		
		 if($cng_arr['description']){ 
			foreach($cng_arr['description'] as $ckey=>$cval){
			$str.=' 			
<div class="form-group clearfix">
	<label class="col-sm-3 control-label">
	Caption -'.$cval.'
	</label>
	<div class="col-sm-9">
	 <textarea class="form-control"  name="'.$ckey.'" >'.$results->$ckey.'</textarea>
	</div>
</div>
 ';

			
			}
		}	
		
		$show_save=($str!='')?'		<p class="text-center "><a class="new_item save_cap_btn btn btn-success" style="color:#fff">Save</a></p>':'';
			return '
			<div class="container-fluid">
  <div class="row">
			<form class="cp" onsubmit="return false" method="post"> '.$basc_val.	$str.' </form>
			'.	$show_save.'
  </div>
</div>';
	 }

}
public function savesort(){
	
	if(	Auth::user()->check() && Auth::user()->get()->roles_id<=2){
		 $data = Input::all();
		$sort_list=($data['sort_list']!='')?$data['sort_list']:exit;
		$pv2=($data['up_type']!='')?$data['up_type']:exit;
		$cng_arr=Config::get('gbkey.'.$pv2);

		$sort_arr=explode(',',$sort_list);

		$this_pid_gg=DB::table($cng_arr['table'])->select('parent_id')->where('id',ceil(	$sort_arr[0]))->first();
		$this_pid=	$this_pid_gg->parent_id;
		$i=ceil(
		DB::table($cng_arr['table']	) -> where('tb_val',$cng_arr['tb_val'])-> where('sp_field',$cng_arr['sp_field'])->where('parent_id',$this_pid)->count() 
		);
		
		
		$sort_arr=explode(',',$sort_list);
		$sort_arr=array_reverse($sort_arr);
		$this_pid=0;
		$this_topfile='';
		foreach((array)$sort_arr as $aval){
		DB::table($cng_arr['table'])->where('id',$aval)->update(array('rank' => $i));
		
		if($this_pid==0){
		
				$getPval=DB::table($cng_arr['table'])->where('id',$aval)->first();
				$this_pid=	$getPval->parent_id;
		}
		$i--;
		}
		
 
 		$this->updateSpfield($cng_arr,$this_pid);
 
		
		 return Response::json('success', 200);
	 }

}

public function updateSpfield($cng_arr,$this_pid)
{
			$this_topfile='';
			$tfv=DB::table($cng_arr['table']	) -> where('tb_val',$cng_arr['tb_val'])-> where('sp_field',$cng_arr['sp_field'])->where('parent_id',$this_pid)->orderBy('rank', 'asc')->first();
			
			$upd_total=0;
			if($tfv!=null){
			$this_topfile=$tfv->file_name;
			
			$upd_total=DB::table($cng_arr['table']	) -> where('tb_val',$cng_arr['tb_val'])-> where('sp_field',$cng_arr['sp_field'])->where('parent_id',$this_pid)->count();
			}
			
			$spval=(	$upd_total>0)?$upd_total.','.$this_topfile:'';
			$isok=	DB::table($cng_arr['tb_val']) ->where('id', $this_pid)->update(
				array($cng_arr['sp_field']=>$spval)		);
}
public function delmany()
{

	if(	Auth::user()->check() && Auth::user()->get()->roles_id<=2){
		 $data = Input::all();
		$del_list=($data['del_list']!='')?$data['del_list']:exit;
		$pv2=($data['up_type']!='')?$data['up_type']:exit;
		$cng_arr=Config::get('gbkey.'.$pv2);
		 
		 $del_array=explode(',',$del_list);
$myoption=array(
'table'=>$cng_arr['table']		, 
'tb_val'=>$cng_arr['tb_val']	,
'folder_val'=>$cng_arr['folder_val'],
'sp_field'=>$cng_arr['sp_field']	,
'upload_dir'=>$cng_arr['upload_dir'],
);

		$this_pid=0;
													$results = DB::table($cng_arr['table']	)
													->whereIn('id',   $del_array)
													->where('tb_val',   $cng_arr['tb_val'])
													->where('sp_field',   $cng_arr['sp_field'])
													->get();	
													
		if (count($results )>0){
		$i=0;
		foreach ($results as $ms) {
													
															
		if($this_pid==0){
				$getPval=DB::table($cng_arr['table'])->where('id', $ms->id)->first();
				$this_pid=	$getPval->parent_id;
		}
		
		
													@unlink($cng_arr['upload_dir']. $ms->full_path);
													@unlink($cng_arr['upload_dir']. $ms->thumbnail_path);
													
													DB::table($cng_arr['table']	)
													->where('id',   $ms->id)
													->delete();
													
		}}
		
 
 		$this->updateSpfield($cng_arr,$this_pid);
		
		
		 return Response::json('success', 200);
	 }

}

public function delone()
{
	
	if(	Auth::user()->check() && Auth::user()->get()->roles_id<=2){
		 $data = Input::all();
		$del_id=($data['del_id']!='')?$data['del_id']:exit;
		$pv2=($data['up_type']!='')?$data['up_type']:exit;
		$cng_arr=Config::get('gbkey.'.$pv2);
		 
$myoption=array(
'table'=>$cng_arr['table']		, 
'tb_val'=>$cng_arr['tb_val']	,
'folder_val'=>$cng_arr['folder_val'],
'sp_field'=>$cng_arr['sp_field']	,
'upload_dir'=>$cng_arr['upload_dir'],
);
		$results = DB::table($cng_arr['table']	)
		->where('id',   $del_id)
		->where('tb_val',   $cng_arr['tb_val'])
		->where('sp_field',   $cng_arr['sp_field'])
		->first();	
if(ceil($results->id)>0){
		
		$this_pid=$results->parent_id;
		
		@unlink($cng_arr['upload_dir']. $results->full_path);
		@unlink($cng_arr['upload_dir']. $results->thumbnail_path);
		
		DB::table($cng_arr['table']	)
		->where('id',   $del_id)
		->delete();
		
 		$this->updateSpfield($cng_arr,$this_pid);
		
		 return Response::json('success', 200);
}

	 }
}

public function getList()
{

	if(	Auth::user()->check() && Auth::user()->get()->roles_id<=2){
//       '.$plusVal.'
$data = Input::all();
$pv1=($data['up_id']!='')?$data['up_id']:exit;
$pv2=($data['up_type']!='')?$data['up_type']:exit;
 

$cng_arr=Config::get('gbkey.'.$pv2);

$myoption=array(
'key'=>$cng_arr['key']	,
'up_type'=>$cng_arr['type']	,
'up_id'=>ceil($data['up_id'])	,
'table'=>$cng_arr['table']		, 
'tb_val'=>$cng_arr['tb_val']	,
 
'rename_val'=>$cng_arr['rename_val']	,
'folder_val'=>$cng_arr['folder_val'],
'max_w'=>$cng_arr['max_w']	,
'max_h'=>$cng_arr['max_h']	,
'sp_field'=>$cng_arr['sp_field']	,

'thumbnail'=>$cng_arr['thumbnail'],
'thumbnail_max_w'=>$cng_arr['thumbnail_max_w'],
'thumbnail_max_h'=>$cng_arr['thumbnail_max_h'],

'script_url'=>$cng_arr['script_url'],
'upload_dir'=>$cng_arr['upload_dir'],
'upload_url'=>$cng_arr['upload_url'],

);
		$results = DB::table($cng_arr['table']	)
		->where('parent_id',   $pv1)
		->where('tb_val',   $cng_arr['tb_val'])
		->where('sp_field',   $cng_arr['sp_field'])
		  ->orderBy('rank', 'asc')
		->get();
		$strval='';
	

		//var_dump(DB::getQueryLog());
		if (count($results )>0){
		$i=0;
		foreach ($results as $ms) {
			
			$tglink='	target="_blank" href="'.$myoption['upload_url'].$ms->full_path.'" ';
			
			$plus_title='';
	if(isset(	 $cng_arr['caption'])){
	foreach(	 $cng_arr['caption'] as $cKey=>$cVal){
		if( isset($cKey)){
			$plus_title.='<span>'.$cVal.': '.$ms->$cKey.'</span><br/>';
		}
	}
	
	}
	
			if($cng_arr['data_type']=='image'){
 	 			
				$ww=($cng_arr['thumbnail']==1)?$ms->thumbnail_path:$ms->full_path;
				
			 		$set_w=($cng_arr['type']=='onefile')?600:160;
			 		$set_h=($cng_arr['type']=='onefile')?400:120;
					$sizegg=myfunc::imgVirtualResize($myoption['upload_dir'].	$ww,$set_w,  $set_h);
				
					 $cgg1='<a class="thumbnail imgcnt m0" '.$tglink.'	 style="width:'.ceil($sizegg[0]).'px"><img src="'.$myoption['upload_url'].	$ww.'" height="'.ceil($sizegg[1]).'"	 width="'.ceil($sizegg[0]).'"	/></a> '  ;
						 $cgg2=' <a class="imglink btn btn-btn-l m0" '.$tglink.'>'. $ms->old_file_name.'</a>'  ;
			
				}else{
					
					
					 $cgg1='<div class="well mt10">'.	$plus_title.'<a class="filelink btn  btn-btn-l m0" '.$tglink.'>  <i class="fa fa-upload lg"></i> '. $ms->old_file_name.'</a></div> ';
					 $cgg2='';
			}		
			
		 $set_w=60;
		 $ccg2_th=(	trim( $cgg2)!=''	)?'   <th>		<div class="link-cnt2">'.$cgg2.' </div></th> ':'';
			$strval.=($cng_arr['type']=='manyfile')?'<li id="'.$ms->id.'" class="  clearfix">
<table class="table m0" border="0" cellspacing="0" cellpadding="0" style="background:#fff;"><thead>
  <tr>
    <th width="20">		<label class="chbbtn"><input type="checkbox" class="del_item" name="ditem[]" value="'.$ms->id.'"  /></label>	</th>
    <th width="160">  <div class="btn-group btn-group-justified"> 
  <div class="btn-group">
    <button type="button" class="btn btn-info infobtn"	data-fid="'.$ms->id.'"><i class="fa fa-gear lg"></i> Edit</button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-danger delbtn"	data-fid="'.$ms->id.'" data-opt="'.$myoption['key'].'"	 data-tgid="#'.$ms->id.'"><i class="fa  fa-minus-circle lg"></i> Del</button>
  </div>
</div>	</th>
    <th width="'.	$set_w.'">		<div class="link-cnt1">'.$cgg1.' </div></th>
    '.$ccg2_th.'
    <th width="40">   <a class="handle btn btn-default "	id="'.$ms->id.'" title="Drag & Drop"><i class="fa fa-bars lg"></i>  Sort</a></th>
  </tr></thead>
</table>

 
					 </li>':'
					 
					 
					 <li id="'.$ms->id.'" class="  clearfix">
					 	<div class="btn-cnt">
<div class="btn-group btn-group-justified" style="margin:0 auto">
  <div class="btn-group">
    <button type="button" class="btn btn-info infobtn"	data-fid="'.$ms->id.'"><i class="fa fa-gear lg"></i> Edit</button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-danger delbtn"	data-fid="'.$ms->id.'" data-opt="'.$myoption['key'].'"	 data-tgid="#'.$ms->id.'"><i class="fa fa-minus-circle lg"></i> Del</button>
  </div>
</div>
					</div> 
					 <div class="link-cnt"  style="margin:0 auto">'.$cgg1.' </div>
					 <div class="link-cnt"  style="margin:0 auto">'.$cgg2.' </div>
					 
					 
					  </li>
					 ';
					
				 
						
 
			$i++; 
		}
		
			
			$str= ($cng_arr['type']=='manyfile')?'
 
<table class="table m0" border="0" cellspacing="0" cellpadding="0"><thead>
  <tr>
    <th width="20"><input type="checkbox" id="qfc_all" /></th>
    <th> <a id="delall" class="btn btn-danger" data-opt="'.$myoption['key'].'"><i class="fa fa-trash-o lg"></i> Delete Selected</a></th>
    <th class="text-right" colspan="3"><input type="hidden" id="setsort_input"/><a class="btn btn-info"  id="sortall"><i class="fa fa-save lg"></i> Save Sort</a></th>
  </tr></thead>
</table>
 
<ul class="up-flist" id="setsort">'.$strval.'</ul>':'</div><ul class="up-flist" id="setsort">'.$strval.'</ul>';;



		}else{
			$str= '<p class="result">No Result</p>';
		}
		
		return '<div class="upload-cnf">

		</div> '.$str;
		
		
 }//check



}
/**
 * @Route("/admin/media/upload/process", name="upload_media")
 */
public function doUploadnouse()
{
    $request = $this->get('request');
    $files = $request->files;
	
	 
$myFile =path('public'). "testFile.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "Bobby Bopper\n";
fwrite($fh, $stringData);
$stringData = "Tracy Tanner\n";
fwrite($fh, $stringData);
fclose($fh);

    // configuration values
    $directory =  path('public').'uploads/'.sha1(time());
print_r($files);
    // $file will be an instance of Symfony\Component\HttpFoundation\File\UploadedFile
    foreach ($files as $uploadedFile) {
        // name the resulting file
        $name = $uploadedFile['tmp_name'];//...
        $file = $uploadedFile->move($directory, $name);

        // do something with the actual file
        $this->doSomething($file);
    }
return print_r($files);
    // return data to the frontend
 //   return Response::json('success', 200);
}


 
}

/*

public function doUpload(){
		 
		 $input = Input::all();
		$rules = array(
		    'file' => 'image|max:3000',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::make($validation->errors->first(), 400);
		}

		$file = Input::file('file');
print($file);
        $extension = File::extension($file['name']);
        $directory = path('public').'uploads/'.sha1(time());
        $filename = sha1(time().time()).".{$extension}";

        $upload_success = Input::upload('file', $directory, $filename);

        if( $upload_success ) {
        	return Response::json('success', 200);
        } else {
        	return Response::json('error', 400);
        }
		
		
		}
}

*/