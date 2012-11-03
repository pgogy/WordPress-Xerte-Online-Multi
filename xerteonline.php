<?PHP

	/*
	Plugin Name: Xerte Online 
	Description: Xerte Online Toolkits based in a WordPress site
	Version: 0.32
	Author: pgogy
	Plugin URI: http://www.pgogy.com/code/xerte-online
	Author URI: http://www.pgogy.com
	License: GPL
	*/

	require_once("xerteonline_editor.php");
	require_once("xerteonline_display.php");
	require_once("xerteonline_shortcode.php");
	require_once("xerteonline_custompost.php");
	require_once("xerteonline_posthandling.php");
	require_once("xerteonline_management.php");
	require_once("xerteonline_feed.php");
	
	register_activation_hook( __FILE__, 'xerteonlinemulti_activate' );
	
	register_deactivation_hook( __FILE__ , 'xerteonlinemulti_deactivate');
	
	function xerteonlinemulti_activate(){
	
		global $xerteonline_db_version, $wpdb;
	
		$dir = opendir(getcwd() . "/../../");
		
		$make_languages = true;
		
		while($file = readdir($dir)){
		
			if($file==="languages"){
			
				$make_languages = false;
			
				if(!file_exists(getcwd() . "/../../" . "languages/language-config.xml")){
			
					wp_die("This plugin cannot be installed due a 'languages' folder in the root directory. If you can delete this folder (or rename), please do so then refresh this page");
				
				}
			
			}
		
		}
		
		$dir_activation = plugin_dir_path(__FILE__) . "activation/";
	
		if(!@copy($dir_activation . "resources.swf","../../resources.swf")){
		
			wp_die("Resources.swf did not copy. Please copy " . plugin_dir_path(__FILE__) . "activation/resources.swf to the site root");
		
		}
		
		if(!@copy($dir_activation . "MainPreloader.swf","../../MainPreloader.swf")){
		
			wp_die("MainPreloader.swf did not copy. Please copy " . plugin_dir_path(__FILE__) . "activation/mainpreloader.swf to the site root");
		
		}
		
		if(!@copy($dir_activation . "XMLEngine.swf","../../XMLEngine.swf")){
		
			wp_die("XMLEngine.swf did not copy . Please copy " . plugin_dir_path(__FILE__) . "activation/xmlengine.swf to the site root");
		
		}
		
		if($make_languages){
				
			if(!@mkdir("../../languages")){

				wp_die("MKDIR for the languages folder failed");
			
			}
			
			@chmod("../../languages",0744);
		
		}
		
		$dir = opendir(plugin_dir_path(__FILE__) . "activation/languages/");
		
		while($file = readdir($dir)){
		
			if($file!="."&&$file!=".."){
			
				if(!@copy(plugin_dir_path(__FILE__) . "activation/languages/" . $file, "../../languages/" . $file)){
		
					wp_die($file . " did not copy");
		
				}
				
				@chmod("../languages/" . $file,0744);
			
			}
		
		}		
	
	}
	
	function xerteonlinemulti_deactivate(){
	
		$dir = opendir(getcwd() . "../../languages/");
		
		while($file = readdir($dir)){
		
			if($file!="."&&$file!=".."){
			
				@unlink("../../languages/" . $file);
			
			}
		
		}
		
		@unlink("../../resources.swf");
		
		@unlink("../../MainPreloader.swf");
		
		@unlink("../../XMLEngine.swf");
		
		@rmdir("../../languages/");
	
	}
	
	function xerteonlinemulti_notices(){

		global $wpdb;
		
		$htaccess = file_get_contents(dirname(__FILE__) . "/../../../.htaccess");
		
		if(strpos($htaccess, "RewriteRule ^[_0-9a-zA-Z-]+/(resources.swf)$ $1 [L]")===FALSE){

			echo '<div id="message" class="updated"><p><strong>Notice</strong>.</p><p>You need to add the line below to your .htaccess file for the Xerte Online Plugin to work</p><p>RewriteRule ^[_0-9a-zA-Z-]+/(resources.swf)$ $1 [L]</p></div>';
			
		}

	}
	add_action('admin_notices', 'xerteonlinemulti_notices');

?>