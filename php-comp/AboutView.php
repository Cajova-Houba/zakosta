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
		<p>
			Vítáme Vás na našich stránkách.
			<p>
				Společnost ZAKOSTA INVEST s.r.o. vznikla v roce 2016, ale na trhu působíme jako živnostníci již od roku 1996. 
			</p>
			<p>
				Hlavní činností ZAKOSTA INVEST s.r.o. je zakázková kovovýroba a drobné stavební práce. Více se dočtete v části <a href=\"index.php?p=work\" class=\"w3-hover-none w3-hover-text-blue\">realizujeme</a>.
			</p>
			<p>
				Naše zkušenosti jsou více než 20-ti leté a hnacím motorem je pro nás především spokojený zákazník a kvalitně a v řádném termínu odvedená práce. V <a href=\"index.php?p=gallery\" class=\"w3-hover-none w3-hover-text-blue\">galerii</a> naleznete přehled naších dokončených projektů.
			</p>
			<p>
				 V případě zájmu, nás kontaktujte, rádi Vám zpracujeme cenovou nabídku zdarma.
			</p>
		</p>";
	}
}
?>