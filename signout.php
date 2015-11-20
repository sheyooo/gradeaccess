<?php
include("includes/functions.inc");
session_destroy();
Tools::redirect("signin.php");
?>