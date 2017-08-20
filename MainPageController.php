<?php
require_once('php-comp/MainMenuView.php');
require_once('php-comp/AboutView.php');
require_once('php-comp/WorkView.php');
require_once('php-comp/ContactPageView.php');
require_once('php-comp/AbstractPageView.php');
require_once('php-comp/BodyView.php');

/**
* Controller for all pages except the gallery page.
*/
class MainPageController
{
	const MAIN_PAGE = 0;
	const WORK_PAGE = 1;
	const CONTACT_PAGE = 2;

	private $page = MainPageController::MAIN_PAGE;
	private $content = "";

	function __construct($page)
	{
		if(isset($page)) {
			$this->page = $page;
		}

		switch ($this->page) {
			case MainPageController::MAIN_PAGE:
				$this->content = AboutView::getHTML();
				break;

			case MainPageController::WORK_PAGE:
				$this->content = WorkView::getHTML();
				break;

			case MainPageController::CONTACT_PAGE:
				$this->content = ContactPageView::getHTML();
				break;
			
			default:
				$this->content = AboutView::getHTML();
				break;
		}
	}

	function getHTML() {
		$mainMenu = MainMenuView::getHTML(MainMenuView::NOTHING_ACTIVE);
		$body = BodyView::wrapContent($mainMenu, $this->content);

		return AbstractPageView::getHTML($body);
	}
}
?>