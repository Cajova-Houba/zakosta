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
	
	static function wrapContent($mainMenu, $content) {
		return "
			<body class=\"w3-light-grey\">
				<div class=\"w3-main\">
					<div id=\"content-container\">
						<div id=\"mainLogo\" class=\"w3-light-grey\" >
							<img src=\"img/mainLogo.png\" alt=\"zakosta\" height=\"159\" widht=\"957\">
						</div>
						".$mainMenu."
						<div id=\"body-container\">
							<!-- this is where the actual content is -->
							<div id=\"bodyContent-container\" class=\"w3-container\">
								<!-- main content window - galery, articles... -->
								<div id=\"mainContent\" class=\"w3-container w3-margin-top\">
									".$content."
								</div>
								".ContactView::getHTML()."
							</div>
						</div>
					<div>
					".FooterView::getHTML()."
				</div>
			</body>
		";
	}
}
?>