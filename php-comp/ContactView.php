<?php
/**
* Component displaying small contact window.
*/
class ContactView
{
	
	static function getHTML()
	{
		return "
			<!-- small side window next to the main one -->
			<div class=\"w3-third w3-container\">
				<h4>Kontaktuje nás</h4>
				<ul>
					<li><a href=\"mailto:info@zakosta.cz\">info@zakosta.cz</a></li>
					<li>+420 731 820 211</li>
				</ul>
				
				<h4>Rychlý dotaz</h4>
				<form class=\"w3-container\" action=\"http://zakosta.cz\" method=\"POST\">
					<label for=\"email\">Váš email</label>
					<input type=\"email\" class=\"w3-input w3-border-blue\" id=\"email\">
					<label for=\"subject\">Předmět</label>
					<input type=\"text\" class=\"w3-input w3-border-blue\" id=\"subject\">
					<label for=\"message\">Dotaz</label>
					<textarea class=\"w3-input w3-border-blue\" id=\"message\"></textarea>
					
					<input type=\"submit\" class=\"w3-btn w3-blue w3-margin-top w3-right\" value=\"odeslat >\">
				</form>
			</div>
		";
	}
}
?>