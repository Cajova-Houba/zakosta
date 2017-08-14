<?php

require_once('utils.php');
require_once('PhotoswipeView.php');

/**
 * Component for displaying image preview with caption.
 */
class ImageCaptionView {

	const PHOTO_ROOT_PATH = "img/fotky/";

	/**
	 * HTML of the element which will display clickable image with caption, which will lead to a gallery folder.
	 * $folder is expected to be one of GalleryPageView constants and will be used in url pointing to that gallery.
	 * $titleImage is name of the image which will be displayed as a clickable thumbnail.
	 */
	static function getHTML($folder, $titleImage, $width) {
		$rnd = $titleImage.rand();
		$caption = GalleryPageView::getFolderHeader($folder);
		return "
			<div class=\"w3-display-container w3-text-black w3-xlarge\" onMouseOver=\"addOpacity('".$rnd."')\" onMouseOut=\"removeOpacity('".$rnd."')\">
				<a href=\"index.php?p=gallery&g=".escapechars($folder)."\">
				<img src=\"".ImageCaptionView::PHOTO_ROOT_PATH.$folder."/".$titleImage."\" alt=\"".$caption."\" class=\"w3-opacity-max \" style=\"max-width:".$width."px;max-height:".$width."px;\" id=\"".$rnd."\">
				<div class=\"w3-display-middle w3-container\">".$caption."</div>
				</a>
			</div>
		";
	}
}


/**
 * Component for displaying the content of the gallery page.
*/
class GalleryPageView {
	
	// possible views
	// displays base gallery folders overview
	const BASE_VIEW = 'base';
	const BALKONY_VIEW = 'balkony';
	const BETONOVANI_VIEW = 'betonovani';
	const BRANY_VIEW = 'brany';
	const MRIZE_VIEW = 'mrize';
	const OSTATNI_VIEW = 'ostatni';
	const PERGOLY_VIEW = 'pergoly';
	const PLOTY_VIEW = 'ploty';
	const POKLOPY_VIEW = 'poklopy';
	const PRISTRESKY_VIEW = 'pristresky';
	const ROSTY_VIEW = 'rosty';
	const SCHODY_VIEW = 'schody';
	const SLOUPKY_VIEW = 'sloupky';
	const SOLARNI_SPRCHY_VIEW = 'solarni-sprchy';
	const VRATA_VIEW = 'vrata';
	const ZABRADLI_VIEW = 'zabradli';
	const ZAHRADNI_NABYTEK_VIEW = 'zahradni-nabytek';

	/**
	 * Returns array with possible views as keys and their headers as values.
	 */
	static function getPossibleGalleryViews() {
		return array(
			GalleryPageView::BALKONY_VIEW => "Balkóny",
			GalleryPageView::BETONOVANI_VIEW => "Betonování",
			GalleryPageView::BRANY_VIEW => "Brány" ,
			GalleryPageView::MRIZE_VIEW => "Mříže",
			GalleryPageView::OSTATNI_VIEW => "Ostatní",
			GalleryPageView::PERGOLY_VIEW => "Pergoly",
			GalleryPageView::PLOTY_VIEW => "Ploty",
			GalleryPageView::POKLOPY_VIEW => "Poklopy",
			GalleryPageView::PRISTRESKY_VIEW => "Přístřěšky",
			GalleryPageView::ROSTY_VIEW => "Rošty",
			GalleryPageView::SCHODY_VIEW => "Schody",
			GalleryPageView::SLOUPKY_VIEW => "Sloupky",
			GalleryPageView::SOLARNI_SPRCHY_VIEW => "Solární sprchy",
			GalleryPageView::VRATA_VIEW => "Vrata",
			GalleryPageView::ZABRADLI_VIEW => "Zábradlí",
			GalleryPageView::ZAHRADNI_NABYTEK_VIEW => "Zahradní nábytek"
			);
	}

	/**
	 * Returns a correct header for a folder.
	 * $folder Name of the folder. Is expected to be already checked that it is from getPossibleGalleryViews() array.
	 */
	static function getFolderHeader($folder) {
		$headers = GalleryPageView::getPossibleGalleryViews();

		return $headers[$folder];
	}

 	/**
 	 * Returns the HTML of gallery component.
 	 * $data is expected to contain ["view"] and ["images"]. Each element of ["images"] array is expected to contain ["fullPath"] index which 
 	 * contains full path to the image, ["fileName"] which contains file name of the image, ["width"] and ["height"] with size of actual image. 
 	 * 
 	 * If detailed view is being displayed, each element in
 	 * ["images"] should also contain ["previus"], ["next"] with arrays containing file names of previous / next images and ["num"] which is a 
 	 * number of current image.
 	 */
	static function getHTML($data) {
		$view = $data["view"];
		if(!isset($view) || !array_key_exists($view, GalleryPageView::getPossibleGalleryViews())) {
			$view = GalleryPageView::BASE_VIEW;
		}

		if($view == GalleryPageView::BASE_VIEW) {
			return GalleryPageView::getBaseView();
		} else {
			return GalleryPageView::getFolderView($data);
		}

	}

	/**
	 * Returns a HTML with images in a folder.
	 * 
	 * $folder Name of the folder to be displayed. Is expected to be already checked that it is in getPossibleGalleryViews() array.
	 */
	private static function getFolderView($data) {
		$folder = escapechars($data["view"]);
		$header = GalleryPageView::getFolderHeader($folder);
		$images = $data["images"];
		$imageHTML = "";
		$width = 130;
		$imgBaseUrl = $_SERVER['HTTP_HOST'];

		$lineCnt = 0;

		// create table content
		foreach($images as $image) {
			$fp = $image["fullPath"];
			$fn = $image["fileName"];
			$size = $image["width"]."x".$image["height"];
			if(($lineCnt % 4)  == 0) {
				$imageHTML = $imageHTML." <tr>
				";
			}
			$imageHTML = $imageHTML."
					<td>
						<figure data-size=\"".$size."\" data-index=\"".$lineCnt."\" onClick=\"onThumbnailsClick()\" data-source=\"".$fp."\" class=\"zakosta-gallery-item\">
							<!--<a href=\"index.php?p=gallery&g=".$folder."&detail=".$fn."\">-->
								<img src=\"".$fp."\" style=\"max-width:".$width."px;max-height:".$width."px;\">
							<!--</a>-->
						</figure>
					</td>
			";
			$lineCnt++;

			// add new tr tag after every 4 images
			if(($lineCnt % 4) == 0 || ($lineCnt == count($images))) {
				$imageHTML = $imageHTML."</tr>
				";
			}
		}

		return "
			<div id=\"body-container\">
			<!-- this is where the actual content is -->
			<div id=\"bodyContent-container\" class=\"w3-container\">
			
				<!-- main content window - galery, articles... -->
				<div id=\"mainContent\" class=\"w3-container w3-margin-top\">
					<h2>Galerie - ".$header."</h2>
						<div class=\"zakosta-gallery\">
							<table id=\"galeryTable\">
							".$imageHTML."
							</table>
						</div>
						".PhotoswipeView::getHTML()."
				</div>".
				ContactView::getHTML()
			."</div>
		</div>
		";
	}

	/**
	 * Displays folder content with one image detailed.
	 */
	// TODO: Modify this function so it uses "next" and "previous" arrays from $data
	//		 Use row with colspan to display detail of image 
	private static function getDetailView($data) {
		// todo: image not found
		$folder = $data["view"];
		$header = GalleryPageView::getFolderHeader($folder);
		$images = $data["images"];
		$imageHTML = "";
		$width = 130;

		// create slideshow
		foreach($images as $image) {
			$fp = $image["fullPath"];
			$fn = $image["fileName"];

			$imageHTML = $imageHTML."
				<img class=\"gallerySlides\" src=\"".$fp."\" style=\"width:".$width."\">";
		}

		// add buttons to controll the slideshow
		$imageHTML = $imageHTML."
				<button class=\"w3-button w3-black w3-display-left\" onClick=\"plusDivs(-1)\">&#10094;</button>
				<button class=\"w3-button w3-black w3-display-right\" onclick=\"plusDivs(1)\">&#10095;</button>
				";

		return "
			<div id=\"body-container\">
			<!-- this is where the actual content is -->
			<div id=\"bodyContent-container\" class=\"w3-container\">
			
				<!-- main content window - galery, articles... -->
				<div id=\"mainContent\" class=\"w3-container w3-margin-top\">
					<h2>Galerie - ".$header."</h2>
						<div class=\"w3-content w3-display-container\">
							".$imageHTML."
						</div>
				</div>".
				ContactView::getHTML()
			."</div>
		</div>
		";
	}


	/**
	 * Returns a HTML of a folder overview. File names of title images have to be set manualy in this method.
	 */
	private static function getBaseView() {
		$width = 130;
		return "
			<div id=\"body-container\">
			<!-- this is where the actual content is -->
			<div id=\"bodyContent-container\" class=\"w3-container\">
			
				<!-- main content window - galery, articles... -->
				<div id=\"mainContent\" class=\"w3-container w3-margin-top\">
					<h2>Galerie - reference</h2>
						<p>
						Prohlédněte si naše ukončené projekty.
						</p>
						
						<table id=\"galeryTable\">
							<tr>
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::BALKONY_VIEW,"Obraz0098.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::BETONOVANI_VIEW,"11102012678.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::BRANY_VIEW,"DSCN3485.JPG",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::MRIZE_VIEW,"DSCN3660.JPG",$width)."
								</td>
							</tr>
							
							<tr>
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::PERGOLY_VIEW,"DSC00640.JPG",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::PLOTY_VIEW,"20150701_172528.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::POKLOPY_VIEW,"Obraz0253.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::PRISTRESKY_VIEW,"DSC_0670.jpg",$width)."
								</td>
							</tr>
							
							<tr>
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::ROSTY_VIEW,"20151021_133754.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::SCHODY_VIEW,"foto 021.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::SLOUPKY_VIEW,"20170425_112049.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::SOLARNI_SPRCHY_VIEW,"20160522_122227.jpg",$width)."
								</td>
							</tr>
							
							<tr>
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::VRATA_VIEW,"20150312_142921.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::ZABRADLI_VIEW,"20151004_134545.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::ZAHRADNI_NABYTEK_VIEW,"DSC_0609.jpg",$width)."
								</td>
								
								<td>
									".ImageCaptionView::getHTML(GalleryPageView::OSTATNI_VIEW,"DSCN3484.JPG",$width)."
								</td>
							</tr>
						</table>
				</div>".
				ContactView::getHTML()
			."</div>
		</div>
		";
	}
}
?>