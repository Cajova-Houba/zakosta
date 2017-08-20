<?php
/**
	Class containing main menu.
*/
class MainMenuView
{
	// active menu item
	// NOTHING_ACTIVE is default
	const NOTHING_ACTIVE = -1;
	const ABOUT_ACTIVE = 0;
	const WORK_ACTIVE = 1;
	const GALLERY_ACTIVE = 2;
	const CONTACT_ACTIVE = 3;

	
	/**
		Returns the HTML of the main menu component. Contains also logo.
		$activeMenuItem use one of the provided constants to mark the active menu item. Currently does nothing.
	*/
	static function getHTML($activeMenuItem) {
		return "
			<div id=\"mainMenu\">
				<ul class=\"w3-navbar w3-blue w3-center\">
					<li class=\"menuItem\">
						&nbsp;
					</li>
					
					<li class=\"menuItem\">
						<a href=\"index.php\" class=\"w3-hover-none w3-hover-text-pale-blue\">o nás</a>
					</li>
					
					<li class=\"menuItem\">
						<a href=\"index.php?p=work\" class=\"w3-hover-none w3-hover-text-pale-blue\">realizujeme</a>
					</li>
					
					<li class=\"menuItem\">
						<a href=\"index.php?p=gallery\" class=\"w3-hover-none w3-hover-text-pale-blue\">reference</a>
					</li>
					
					<li class=\"menuItem\">
						<a href=\"index.php?p=contact\" class=\"w3-hover-none w3-hover-text-pale-blue\">kontakt</a>
					</li>
					
					<li class=\"menuItem\">
						&nbsp;
					</li>
				</ul>
			</div>
		";
	}
}
?>