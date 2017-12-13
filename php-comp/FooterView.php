<?php
/**
	Class containing the footer component.
*/
class FooterView {

	function getHTML() {
		return "
			<footer id=\"footer\" class=\"w3-border-blue w3-topbar w3-container\">
				<ul class=\"w3-center w3-text-blue\">
					<li class=\"footerItem\"><b>&copy; ZAKOSTA INVEST s.r.o. 2017 </b></li>
					
					<li class=\"footerItem\"><a href=\"www.zakosta.cz\">zakosta.cz</a> </li>
				
					<li class=\"footerItem\">email: <a href=\"mailto:info@zakosta.cz\">info@zakosta.cz</a></li>
					
					<li class=\"footerItem\">tel: <b>+420 731 820 211</b></li>
				</ul>
			</footer>
		";
	}
}
?>