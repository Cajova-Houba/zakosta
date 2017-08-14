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
			"css/photoswipe.css"
		);

	/**
	* Names of js files to be included.
	*/
	private static $jScripts = array(
			"js/script.js",
			"js/photoswipe.min.js",
			"js/photoswipe-ui-default.min.js"
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
			<!doctype html>
            <html lang=\"cz\">
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