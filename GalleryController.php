<?php
require_once('php-comp/HeaderView.php');
require_once('php-comp/MainMenuView.php');
require_once('php-comp/GalleryPageView.php');
require_once('php-comp/AbstractPageView.php');
require_once('php-comp/BodyView.php');
require_once('php-comp/Errors.php');

/**
* Controller for the gallery page.
*/
class GalleryController
{
	private $content = "";
	private $folder = "";

	function __construct()
	{
		$data = array();
		$order = 1;
		if(isset($_GET['g']) && array_key_exists($_GET['g'], GalleryPageView::getPossibleGalleryViews())) {
			$this->folder = escapechars($_GET["g"]);
			$data['view'] = $this->folder;

			// load images
			$pathToFolder = ImageCaptionView::PHOTO_ROOT_PATH.$this->folder;
			$dirItems = scandir($pathToFolder);
			$data['images'] = array();
			$dirItemCount = count($dirItems);

			// miniature suffix
			$minSuffix = "-min.jpg";
			$minSuffixLen = strlen($minSuffix);

			// fill data
			for ($i = 0; $i < $dirItemCount; $i++) {
				$dirItem = $dirItems[$i];

				// it is expected that every non-dir item is image
				if(!is_dir($pathToFolder."/".$dirItem)) {
					// image can be either image, or miniature
					if(substr($dirItem, -$minSuffixLen) === $minSuffix) {
						// skip miniature
						continue;
					}

					$fp = $pathToFolder."/".$dirItem;
					// substr() is used to remove .jpg suffix from $dirItem so that miniature suffix can be added
					$fpNameMin = substr($dirItem, 0, strlen($dirItem)-4).$minSuffix;
					$fpMin = $pathToFolder."/".$fpNameMin;
					$size = getimagesize($fp);
					$data['images'][] = array(
							"fullPath" => $fp,
							"fileName" => $dirItem,
							"fullPathMiniature" => $fpMin,
							"fileNameMiniature" => $fpNameMin,
							"num" => $order,
							"width" => $size[0],
							"height" => $size[1]
						);
					$order++;
				}
			}

		} else {
			$data['view'] = GalleryPageView::BASE_VIEW;
		}

		$this->content = GalleryPageView::getHTML($data);
	}

	function getHTML() {
		$mainMenu = MainMenuView::getHTML(MainMenuView::NOTHING_ACTIVE);

		$data = [];
		$data["op"] = PageNameResolver::GALLERY_PAGE_NAME;
		$data["g"] = $this->folder;
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