<?php
require_once('php-comp/Errors.php');
require_once('php-comp/recaptchalib.php');
require_once('php-comp/PageNameResolver.php');

/**
* Controller for sending email - sends email and redirects to the same page.
*/
class SendMailController
{
    /**
     * Page to redirect to in case of an error.
     * @var string
     */
	private $origPage = "";

	/*
	 * Secret key for validating recaptcha.
	 */
	private $recaptchaSecret = "6LeQ4TwUAAAAAGL0Cdk7HFIObBqYO0QaiUzZdZ9g";

	function __construct()
	{
	}

	function getHTML() {
        $this->origPage = isset($_POST["old-page"]) ? PageNameResolver::checkPageName($_POST["old-page"])->pageName() : PageNameResolver::HOME_PAGE_NAME;

        // in case of gallery being displayed "g" parameter should also be passed
        $galFolName = isset($_POST["gal-fol"]) ? escapechars($_POST["gal-fol"]) : "";
        $galFolUrlParam = $galFolName !== "" ? "&g=$galFolName" : "";

	    if (!$this->checkEmptyField($_POST["email"]) || !$this->checkEmptyField($_POST["subject"]) || !$this->checkEmptyField($_POST["message"])) {
			header("Location: index.php?p=$this->origPage$galFolUrlParam&err=".Errors::CONT_FORM_INFO_MISSING);
			return "";
		}

		$email = $_POST["email"];
		$subject = $_POST["subject"];
		$message = $_POST["message"];
		$recaptcha = $_POST["g-recaptcha-response"];

        if(!$this->validateRecaptcha($recaptcha)) {
            // send error
            header("Location: index.php?p=$this->origPage$galFolUrlParam&err=".Errors::RECAPTCHA_FAILED);
        } else {
            // send mail
            mail("info@zakosta.cz", "[".$email."] - ".$subject, $message);
            header("Location: index.php?p=$this->origPage$galFolUrlParam");
        }

		return "";
	}

	/*
	 * Validates recaptcha response from user.
	 *
	 * Returns true if the validation is successfull.
	 */
	function validateRecaptcha($recaptchaResponse) {
        $reCaptcha = new ReCaptcha($this->recaptchaSecret);
        $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $recaptchaResponse);

        return $response != null && $response->success;
    }

    /*
     * Returns true if isset($field) and $field !== "".
     */
    function checkEmptyField($field) {
	    return isset($field) && $field !== "" && $field !== '';
    }
}
?>