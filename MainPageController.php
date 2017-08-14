<?php
require_once('php-comp/HeaderView.php');
require_once('php-comp/MainMenuView.php');
require_once('php-comp/FooterView.php');
require_once('php-comp/AboutView.php');
require_once('php-comp/WorkView.php');
require_once('php-comp/ContactPageView.php');

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
		$header = HeaderView::getHTML();
		$mainMenu = MainMenuView::getHTML(MainMenuView::NOTHING_ACTIVE);
		$footer = FooterView::getHTML();

		return $header.$mainMenu.$this->content.$footer;
	}
}
?>