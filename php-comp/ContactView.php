<?php
require_once('Errors.php');
require_once('PageNameResolver.php');

/**
* Component displaying small contact window.
*/
class ContactView
{

    /**
     * @param $data ["error"] field containing value from Errors expected. ["op"] expected to contain name (from PageNameResolver) of the old page.
     *              ["g"] for a particular gallery folder if it's displayed ("" if it's not displayed).
     * @return string
     */
	static function getHTML($data)
	{
	    $err = isset($data["error"]) ? escapechars($data["error"]) : Errors::NO_ERR;
	    $op = isset($data["op"]) ? PageNameResolver::checkPageName($data["op"])->pageName() : PageNameResolver::HOME_PAGE_NAME;
        $g = isset($data["g"]) ? escapechars($data["g"]) : "";

		$error = "";
		if ($err == Errors::CONT_FORM_INFO_MISSING) {
			$error = "<br><span class=\"w3-margin-top w3-text-red\">Chybí některé informace.</span>";
		} else if ($err == Errors::RECAPTCHA_FAILED) {
		    $error = "<br><span class=\"w3-margin-top w3-text-red\">ReCaptcha test nevyšel. Zkuste to prosím znovu.</span>";
        }

		/* captcha key provided by google */
		$captchaKey = "6LeQ4TwUAAAAAKJNVjJjo54TZzcb22PugaPVN4sv";

		// if a particular folder is being displayed, add it to the form too
		$galFolderParam = "";
		if($g !== "") {
		    $galFolderParam = "<input type=\"hidden\" name=\"gal-fol\" value=\"$g\">";
        }

		return "
			<!-- small side window next to the main one -->
			<div class=\"w3-third w3-container\">
				<h4>Kontaktuje nás</h4>
				<ul>
					<li><a href=\"mailto:info@zakosta.cz\">info@zakosta.cz</a></li>
					<li>+420 731 820 211</li>
				</ul>
				
				<h4>Rychlý dotaz</h4>
				<form class=\"w3-container\" action=\"index.php?p=sendmail\" method=\"POST\">
				    <input type=\"hidden\" name=\"old-page\" value=\"$op\">
				    $galFolderParam
					<label for=\"email\">Váš email</label>
					<input type=\"email\" class=\"w3-input w3-border-blue\" id=\"email\" name=\"email\">
					<label for=\"subject\">Předmět</label>
					<input type=\"text\" class=\"w3-input w3-border-blue\" id=\"subject\" name=\"subject\">
					<label for=\"message\">Dotaz</label>
					<textarea class=\"w3-input w3-border-blue\" id=\"message\" name=\"message\"></textarea>
					
					$error
					   
					<div class=\"g-recaptcha w3-margin-top\" data-sitekey=\"$captchaKey\"></div>
					
					<input type=\"submit\" class=\"w3-btn w3-blue w3-margin-top w3-right\" value=\"odeslat >\">
				</form>
			</div>
		";
	}
}
?>