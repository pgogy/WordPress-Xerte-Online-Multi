<?PHP

add_action("admin_menu", "xerteonlinewordpress_editor_make");
add_action( 'admin_enqueue_scripts', 'xerteonlinemulti_editor_javascript' );

function xerteonlinemulti_editor_javascript($hook) {

	global $post;
	
	if($post->post_type=="xerte_online"){

		if( 'post.php' != $hook )
			return;
		wp_enqueue_script( 'xerteonlinemulti_editor', plugins_url('/js/xerteonlinemulti_editor.js', __FILE__), array('jquery'));
	
	}
	
}


function xerteonlinewordpress_editor_make()
{

	add_meta_box("xerteonlinewordpress_editor", "Xerte Editor", "xerteonlinewordpress_editor", "xerte_online");
	
}

function xerteonlinewordpress_editor(){

	if(network_site_url()!=site_url() . "/"){

		global $post;
		
		$wp_dir = wp_upload_dir();
		
		$post_id = $post->ID;
		
		$path = $wp_dir['basedir'];
		
		$path = substr($path, strpos($path, "wp-content"), strlen($path));
		
		?>
		<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" WIDTH="100%" HEIGHT="600" CODEBASE="http://active.macromedia.com/flash5/cabs/swflash.cab#version=5,0,0,0">
			<PARAM NAME="MOVIE" VALUE="<?PHP echo  plugin_dir_url(__FILE__)  . "xertefiles/wizard.swf"; ?>">
			<PARAM NAME="PLAY" VALUE="true">
			<PARAM NAME="QUALITY" VALUE="best">
			<param name=FlashVars value="multisite_url=<?PHP echo $wp_dir['baseurl']; ?>&wordpress=true&xmlvariable=../<?PHP echo $path; ?>/xerte-online/<?PHP echo $post_id; ?>/preview.xml&rlovariable=../<?PHP echo $path; ?>/xerte-online/<?PHP echo $post_id; ?>/&originalpathvariable=../../wp-content/plugins/xerte-online/xertefiles/template/&template_id=<?PHP echo $post_id; ?>&template_height=600&template_width=800&read_and_write=true&savepath=../wp-content/plugins/xerte-online/xertefiles/save.php&upload_path=../wp-content/plugins/xerte-online/xertefiles/upload.php?path=&preview_path=../wp-content/plugins/xerte-online/xertefiles/file_exists.php&site_url=<?PHP echo network_site_url(); ?>" >
			<EMBED 
				SRC="<?PHP echo plugin_dir_url(__FILE__)  . "xertefiles/wizard.swf"; ?>" 
				WIDTH="100%" 
				HEIGHT="600" 
				PLAY="true" 
				LOOP="true" 
				QUALITY="best" 
				PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"
				FlashVars="multisite_url=<?PHP echo $wp_dir['baseurl']; ?>&wordpress=true&xmlvariable=../<?PHP echo $path; ?>/xerte-online/<?PHP echo $post_id; ?>/preview.xml&rlovariable=../<?PHP echo $path; ?>/xerte-online/<?PHP echo $post_id; ?>/&originalpathvariable=../../wp-content/plugins/xerte-online/xertefiles/template/&template_id=<?PHP echo $post_id; ?>&template_height=600&template_width=800&read_and_write=true&savepath=../wp-content/plugins/xerte-online/xertefiles/save.php&upload_path=../wp-content/plugins/xerte-online/xertefiles/upload.php?path=&preview_path=../wp-content/plugins/xerte-online/xertefiles/file_exists.php&site_url=<?PHP echo network_site_url(); ?>" >
			</EMBED>
		</OBJECT>
		<?PHP 
		
		if($_GET['post']!=""){
		
			echo "<p><strong>Iframe code</strong> : The iframe to embed this piece is &lt;iframe src=\"" . site_url() . "/?xerte_online=" . $post->post_title . "\" width='1020' height='740' /&gt;</p>";
			echo "<p><strong>WordPress Shortcode</strong> : The shortcode to embed this piece is [xerte-online post=\"" . $_GET['post'] . "\"]</p>";
		
		}else{
			
			echo "<h2>Please play your Xerte Learning object at least once before saving the WordPress post - else content can be lost</h2>";
		
			echo "<p>Once a draft has been saved, or the post is published, usage instructions will appear here.</p>";
		
		}
		
	}else{
	
		echo "<p>Only networked sites can use this plugin, it cannot be used on the Admin Dashboard</p>";
	
	}
	
}

?>
