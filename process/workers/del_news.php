<?php

require_once("../../includes/functions.inc");

if($id = Tools::valueGet("guid")){
	$news = new Newsletter($id);

	$news->delete($school->getID());
}
Tools::redirect("../../news_letter.php");

?>