<?PHP

function xerteonlinewordpressmulti_custom_post_type_template($single_template) {

     global $post;

     if ($post->post_type == 'xerte_online') {
	 
          $single_template = dirname( __FILE__ ) . '/xertepage.php';
     }
	 
     return $single_template;
	 
}

add_filter( "single_template", "xerteonlinewordpressmulti_custom_post_type_template" ) ;

function xerteonlinewordpressmulti_display($content)
{

	global $post;

	if($post->post_type=="xerte_online"){
	
		$string_for_flash_xml = "wp-content/uploads/xerte-online/" . $post->ID . "/data.xml?time=" . time();

		$string_for_flash = "wp-content/uploads/xerte-online/" . $post->ID . "/";

		?>
		<script type="text/javascript">
		function enableTTS(){
		  if (navigator.appName.indexOf("Microsoft") != -1){
			VoiceObj = new ActiveXObject("Sapi.SpVoice");
		  }
		}
		function openWindow(params){
		  window.open(params.url,'xerte_window',"status=0,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollbars=0,left=" + String((screen.width / 2) - (params.width / 2)) + ",top=" + String((screen.height / 2) - (params.height / 2)) + ",height=" + params.height + ",width=" + params.width);
		}

		function makePopUp(params)
		{
			//kill any existing popups
			var popup = document.getElementById("popup");
			var parent = document.getElementById("popup_parent");
			
			if (popup != null)
			{
				parent.removeChild(popup);
			}

			//make the div and style it
			var create_div = document.createElement("DIV");
			create_div.id = params.id;
			create_div.style.position = "absolute";
			create_div.style.background = params.bgColour;
			if (params.borderColour != "none") {
				create_div.style.border = "1px solid " + params.borderColour;
			}
			
			var stageW = params.width;
			var stageH = params.height;
			var divNum = Number(params.id.substring(5, params.id.length));
			if (params.screenSize == "full screen" || params.screenSize == "fill window" || (params.width == 1600 && params.height == 1200)) {		
				if (document.body && document.body.offsetWidth) {
					stageW = document.body.offsetWidth;
					stageH = document.body.offsetHeight;
				}
				if (document.compatMode=='CSS1Compat' && document.documentElement && document.documentElement.offsetWidth ) {
					stageW = document.documentElement.offsetWidth;
					stageH = document.documentElement.offsetHeight;
				}
				if (window.innerWidth && window.innerHeight) {
					stageW = window.innerWidth;
					stageH = window.innerHeight;
				}
				
				if (params.screenSize == "full screen" && stageH / stageW != 0.75) {
					var ratio = stageH / stageW;
					if (ratio > 0.75) {
						stageH = stageW * 0.75;
					} else {
						stageW = stageH / 0.75;
					}
				}
				
			}
			
			var divW = stageW / 100 * params.calcW;
			var divH = stageH / 100 * params.calcH;
			var divX = stageW - ((divW + (stageW / 100 * params.calcX) ) * (divNum + 1));
			var divY = stageH / 100 * params.calcY;
			
			create_div.style.width = divW + "px";
			create_div.style.height = divH + "px";
			create_div.style.left = divX + "px";
			create_div.style.top = divY + "px";
			
			if (params.type == 'div'){
				create_div.innerHTML = params.src;
			} else {
				var iframe_create_div = document.createElement("IFRAME");
				iframe_create_div.src = params.src;
				if (params.type == 'jmol') {
					iframe_create_div.src += ';width=' + divW + ';height=' + divH;
				}
				iframe_create_div.style.height = divH + "px";
				iframe_create_div.style.width = divW + "px";	
				iframe_create_div.frameBorder='no';
				create_div.appendChild(iframe_create_div);
			}

			//finally append the div
			parent.appendChild(create_div);
		}
		function killPopUp()
		{
			var parent = document.getElementById("popup_parent");
			if ( parent.hasChildNodes() )
			{
				while ( parent.childNodes.length >= 1 )
				{
					parent.removeChild( parent.firstChild );       
				} 
			}
		}

		</script>
		<SCRIPT LANGUAGE=JavaScript1.1>
		<!--
		var MM_contentVersion = 6;

		var plugin = (navigator.mimeTypes && navigator.mimeTypes["application/x-shockwave-flash"]) ? navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin : 0;
		if ( plugin ) {
				var words = navigator.plugins["Shockwave Flash"].description.split(" ");
				for (var i = 0; i < words.length; ++i)
				{
				if (isNaN(parseInt(words[i])))
				continue;
				var MM_PluginVersion = words[i]; 
				}
			var MM_FlashCanPlay = MM_PluginVersion >= MM_contentVersion;
		}
		else if (navigator.userAgent && navigator.userAgent.indexOf("MSIE")>=0 
		   && (navigator.appVersion.indexOf("Win") != -1)) {
			document.write('<SCR' + 'IPT LANGUAGE=VBScript\> \n'); //FS hide this from IE4.5 Mac by splitting the tag
			document.write('on error resume next \n');
			document.write('MM_FlashCanPlay = ( IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash." & MM_contentVersion)))\n');
			document.write('</SCR' + 'IPT\> \n');
		}
		if (! MM_FlashCanPlay ) {
			document.write("You don't have Adobe Flash installed. Please visit <a href=\"http://get.adobe.com/flashplayer/?promoid=BUIGP\">The Adobe Website</a> to download it.");
		}
		//-->

		</SCRIPT>
		<script type="text/javascript" src = "wp-content/plugins/xerte-online/xertefiles/rloObject.js"></script>
		
		<div style="float:left; position:relative;">

		<script type="text/javascript" language="JavaScript">
		
		<?PHP
		
		echo "myRLO = new rloObject('800','600',
									'wp-content/plugins/xerte-online/xertefiles/template/Nottingham.rlt',
									'$string_for_flash', 
									'$string_for_flash_xml', 
									'" . site_url() . "')";

		?>
		
		</script></div><div id="popup_parent"></div><?PHP
	
	}else{
	
		return $content;
	
	}

}

?>