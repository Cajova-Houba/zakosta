<?php
/**
* Component providing a content of contact page.
*/
class ContactPageView
{
	static function getHTML() {
		return "
			<h2>ZAKOSTA INVEST s.r.o.</h2>
				<p>
					Společnost zapsaná v obchodním rejstříku vedeném Městským soudem v Praze pod sp. zn. C 259153.
				</p>
				<table id=\"contactsTable\" class=\"w3-table w3-text-black\">
					
					<tr>
						<td valign=\"top\">Sídlo: </td>
						<td>Revoluční 1082/8<br>
						    Praha 1<br>
							110 00
						</td>
					</tr>
					
					<tr>
						<td valign=\"top\">IČO: </td>
						<td>051 57 561</td>
					</tr>
					<tr>
						<td valign=\"top\">DIČ: </td>
						<td>CZ051 57 561</td>
					</tr>
					
					<tr>
						<td valign=\"top\">Tel: </td>
						<td>
							+420 731 820 211 <br>
							+420 605 836 282 <br>
						</td>
					</tr>
					
					<tr>
						<td>Email: </td>
						<td>
							<a href=\"mailto:info@zakosta.cz\">info@zakosta.cz</a>
						</td>
					</tr>
				</table>";
	}
}
?>