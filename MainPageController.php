<?php
require_once('php-comp/MainMenuView.php');
require_once('php-comp/AboutView.php');
require_once('php-comp/WorkView.php');
require_once('php-comp/ContactPageView.php');
require_once('php-comp/AbstractPageView.php');
require_once('php-comp/BodyView.php');
require_once('php-comp/PageNameResolver.php');

/**
* Controller for all pages except the gallery page.
*/
class MainPageController
{

	private $page = PageNameResolver::HOME_PAGE_NAME;
	private $content = "";

	function __construct($page)
	{
		if(isset($page)) {
			$this->page = $page;
		}

		switch ($this->page) {
			case PageNameResolver::HOME_PAGE_NAME:
				$this->content = AboutView::getHTML();
				break;

			case PageNameResolver::WORK_PAGE_NAME:
				$this->content = WorkView::getHTML();
				break;

			case PageNameResolver::CONTACT_PAGE_NAME:
				$this->content = ContactPageView::getHTML();
				break;
			
			default:
				$this->content = AboutView::getHTML();
				break;
		}
	}

	function getHTML() {
		$mainMenu = MainMenuView::getHTML(MainMenuView::NOTHING_ACTIVE);
		$data = [];
		$data["op"] = $this->page;
		$data["g"] = "";
        if(isset($_GET["err"])) {
            $data["error"] = escapechars($_GET["err"]);
        } else {
            $data["error"] = Errors::NO_ERR;
        }
		$body = BodyView::wrapContent($mainMenu, $this->content, $data);

		return AbstractPageView::getHTML($body);
	}
}
?>