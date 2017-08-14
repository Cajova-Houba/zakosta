<?php
	require_once('MainPageController.php');
	require_once('GalleryController.php');
	require_once('php-comp/utils.php');

	// choose controller
    $page = "";
	if(isset($_GET["p"]) ) {
		$page = escapechars($_GET["p"]);
	}

	switch ($page) {
		case 'home':
			$controller = new MainPageController(MainPageController::MAIN_PAGE);
			break;
		case 'work':
			$controller = new MainPageController(MainPageController::WORK_PAGE);
			break;
		case 'contact':
			$controller = new MainPageController(MainPageController::CONTACT_PAGE);
			break;
		case 'gallery':
			$controller = new GalleryController();
			break;

		default:
			$controller = new MainPageController(MainPageController::MAIN_PAGE);
			break;
	}

	echo $controller->getHTML();

?>
