<?php
/**
 * 
 * upload page, used by xerte to upload a file
 *
 * @author Patrick Lockley
 * @version 1.0
 * @copyright Copyright (c) 2008,2009 University of Nottingham
 * @package
 */
 
if(strpos($_SERVER['HTTP_COOKIE'],"wordpress_logged_in")!==FALSE&&strpos($_SERVER['HTTP_REFERER'], "/wp-admin/post.php?post=")!==FALSE){

	if(preg_match("/^[A-Za-z0-9\-\_\s,']+\.[A-Za-z][A-Za-z][A-Za-z]$/",$_FILES['Filedata']['name'])){
	
		if(substr($_FILES['Filedata']['name'], strlen($_FILES['Filedata']['name'])-4, 4)!=".php"){

			$dir = getcwd();
			
			if(strpos($dir,"/wp-content/plugins/xerte-online/xertefiles")!==FALSE){

				$prepared_dir = str_replace("/wp-content/plugins/xerte-online/xertefiles","",$dir);
				
			}else if(strpos($dir,"\\wp-content\\plugins\\xerte-online\\xertefiles")!==FALSE){
			
				$prepared_dir = str_replace("\\wp-content\\plugins\\xerte-online\\xertefiles","",$dir);
			
			}		

			$target_dir = $prepared_dir . "/" . str_replace("path=","",str_replace("../","",$_SERVER['QUERY_STRING']));
		
			if(strpos($target_dir,"media/")!==FALSE){
			
				$target_dir = str_replace("media/","",$target_dir);
			
			}
			
			if(is_uploaded_file($_FILES['Filedata']['tmp_name'])){
		
				if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_dir . "/media/" . $_FILES['Filedata']['name'])){

					chmod($target_dir . "/media/" . $_FILES['Filedata']['name'],0755);

				}else{
				
				}
			
			}
		
		}
	
	}

}
