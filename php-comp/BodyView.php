<?php
require_once('ContactView.php');
require_once('FooterView.php');

/**
* Component for embedding html into the body elements.
  Every other component which display something inside the <body> should pass its rendered html to
  this class which will wrap it with <body> tags

*/
class BodyView
{

    /**
     * @param $mainMenu Main menu to be displayed (should be just string).
     * @param $content Content to be wrapped (should be just string).
     * @param $data Additional data (should be array).
     * @return string
     */
	static function wrapContent($mainMenu, $content, $data) {
		return "
			<body class=\"w3-light-grey\">
				<div class=\"w3-main\">
					<div id=\"mainLogo\" class=\"w3-light-grey w3-row\" >
						<img src=\"img/mainLogo.png\" alt=\"zakosta\" height=\"159\" widht=\"957\">
					</div>
					".$mainMenu."
					<!-- this is where the actual content is -->
					<div id=\"body-container\" class=\"w3-row w3-container\">
						<!-- main content window - galery, articles... -->
						<div id=\"mainContent\" class=\"w3-container w3-margin-top w3-twothird\">
							".$content."
						</div>
						".ContactView::getHTML($data)."
					</div>
					".FooterView::getHTML()."
				</div>
			</body>
		";
	}
}
?>