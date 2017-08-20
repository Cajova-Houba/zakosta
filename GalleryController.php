<?php
require_once('php-comp/HeaderView.php');
require_once('php-comp/MainMenuView.php');
require_once('php-comp/GalleryPageView.php');
require_once('php-comp/AbstractPageView.php');
require_once('php-comp/BodyView.php');

/**
* Controller for the gallery page.
*/
class GalleryController
{
	private $content = "";

	function __construct()
	{
		$data = array();
		$order = 1;
		if(isset($_GET['g']) && array_key_exists($_GET['g'], GalleryPageView::getPossibleGalleryViews())) {
			$folder = escapechars($_GET["g"]);
			$data['view'] = $folder;

			// load images
			$pathToFolder = ImageCaptionView::PHOTO_ROOT_PATH.$folder;
			$dirItems = scandir($pathToFolder);
			$data['images'] = array();
			$dirItemCount = count($dirItems);

			// if the detailed view is being displayed, this array will contain file names
			// of images which will be displayed as previous / next thumbnails
			// size of this array should be 3 with detaled image on index 1 (0-based indexing)
			$thumbnails = array(null,null,null);
			for ($i = 0; $i < $dirItemCount; $i++) {
				$dirItem = $dirItems[$i];
				$tCount = count($thumbnails);

				// add current item ino the middle of thumbnails array
				$thumbnails[1] = $dirItem;
				if ($i < $dirItemCount - 1) {
					// add next item 
					$thumbnails[2] = $dirItems[$i+1];
				}

				// it is expected that every non-dir item is image
				if(!is_dir($pathToFolder."/".$dirItem)) {
					$fp = $pathToFolder."/".$dirItem;
					$size = getimagesize($fp);
					$data['images'][] = array(
							"fullPath" => $fp,
							"fileName" => $dirItem,
							"num" => $order,
							"width" => $size[0],
							"height" => $size[1]
						);
					$order++;
				}

				// shift array with thumbnails to left
				$thumbnails[0] = $thumbnails[1];
				$thumbnails[1] = $thumbnails[2];
				$thumbnails[2] = null;
			}

		} else {
			$data['view'] = GalleryPageView::BASE_VIEW;
		}

		$this->content = GalleryPageView::getHTML($data);
	}

	function getHTML() {
		$mainMenu = MainMenuView::getHTML(MainMenuView::NOTHING_ACTIVE);
		$body = BodyView::wrapContent($mainMenu, $this->content);

		return AbstractPageView::getHTML($body);
	}
}

?>