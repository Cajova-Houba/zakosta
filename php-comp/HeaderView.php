<?php
/**
* Class containing the header-
*/
class HeaderView
{

	/**
	* Names of css files to be included. 
	*/
	private static $styles = array(
			"http://www.w3schools.com/lib/w3.css",
			"css/style.css",
			"css/photoswipe.css",
			"css/default-skin.css"
		);

	/**
	* Names of js files to be included.
	*/
	private static $jScripts = array(
			"js/script.js",
			"js/photoswipe.min.js",
			"js/photoswipe-ui-default.min.js",
            "https://www.google.com/recaptcha/api.js?hl=cs"
		);
	
	static function getHTML()
	{
		$css = "<!-- css -->";
		$js = "<!-- js -->";

		foreach (HeaderView::$styles as $style) {
			$css = $css."
				<link rel=\"stylesheet\" type=\"text/css\" href=\"$style\">";
		}

		foreach (HeaderView::$jScripts as $jScript) {
			$js = $js."
				<script src=\"$jScript\"></script>";
		}

		return "
            <head>
				<title>Zakosta</title>
				
				<meta charset=\"UTF-8\">
				
				".$css."

				".$js."
			</head>
		";
	}
}
?>