<?php

require_once('BodyView.php');
require_once('HeaderView.php');

/**
* Creates a template for an abstract page and fills it with actual content.
*/
class AbstractPageView
{
	
	static function getHTML($body) {
		return "
			<!doctype html>
            <html lang=\"cz\">
            ".HeaderView::getHTML()."
            ".$body."
			</html>
		";
	}
}
?>