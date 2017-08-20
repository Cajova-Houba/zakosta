<?php
require_once('ContactView.php');

/**
* Component providing a content of About page.
*/
class AboutView
{
	
	static function getHTML()
	{
		return "
			<h2>Stránky ve výstavbě</h2>
			<p>
				Dobrý den,
				<p>
					omlouváme se, ale webové stránky jsou momentálně ve výstavbě.
					V případě zájmu se na nás můžete obrátit prostřednictvím emailu <a href=\"mailto:info@zakosta.cz\">info@zakosta.cz</a>,
					nebo na telefonním čísle <b>+420 731 820 211</b>.
				</p>
				
				Děkujeme za pochopení.
			</p>";
	}
}
?>