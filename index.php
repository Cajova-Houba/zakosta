<?php
	require_once('MainPageController.php');
	require_once('GalleryController.php');
	require_once('SendMailController.php');
	require_once('php-comp/utils.php');
	require_once('php-comp/PageNameResolver.php');

	// choose controller
	/* page to be displayed */
    $page = "";
    /* source page (the one user is currently viewing)*/
    $oldPage = "";
	if(isset($_GET["p"]) ) {
		$page = escapechars($_GET["p"]);
	}
	$page = PageNameResolver::checkPageName($page);


	switch ($page->pageName()) {
        case PageNameResolver::HOME_PAGE_NAME:
        case PageNameResolver::WORK_PAGE_NAME:
        case PageNameResolver::CONTACT_PAGE_NAME:
            $controller = new MainPageController($page->pageName());
            break;
		case PageNameResolver::GALLERY_PAGE_NAME:
			$controller = new GalleryController();
			break;
		case PageNameResolver::SENDMAIL_PAGE_NAME:
			$controller = new SendMailController();
			break;

		default:
			$controller = new MainPageController(PageNameResolver::HOME_PAGE_NAME);
			break;
	}

	echo $controller->getHTML();

?>
