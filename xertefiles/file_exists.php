<?php
	
	$dir = getcwd();
	
	if(strpos($dir,"plugins/xerte-online/xertefiles")!==FALSE){

		$prepared_dir = str_replace("plugins/xerte-online/xertefiles","",$dir);
			
	}else if(strpos($dir,"plugins\\xerte-online\\xertefiles")!==FALSE){
		
		$prepared_dir = str_replace("plugins\\xerte-online\\xertefiles","",$dir);
		
	}
	
	$target_file =  $prepared_dir . str_replace("onli","online/" . $_POST['wordpress_id'] . "/", str_replace("../wp-content/","",$_POST['file_name']));
	
	$file_path = explode("/", $_POST['file_name']);

	$url = $_POST['multisite_url'] . "/xerte-online/" . $_POST['wordpress_id'] . "/media/" . array_pop($file_path);
	
	if(file_exists($target_file)){
	
		print("&return_value=true&wordpress=true&url_for_file=" . $url);

	}else{
	
		print("&return_value=false");
	
	}

