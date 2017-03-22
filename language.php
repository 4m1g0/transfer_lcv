<?php
$langs=array(
"english" => "English",
"spanish" => "Spanish",
);

if(isset($_POST["setlang"]))
	$_SESSION["lang"]=$_POST["setlang"];

if(!isset($_SESSION["lang"]))
	$_SESSION["lang"]=$default_language;
else if(!array_key_exists($_SESSION["lang"],$langs))
	$_SESSION["lang"]=$default_language;

$langfile="language_files/".$_SESSION["lang"].".php";

if(file_exists($langfile))
	require ($langfile);
?>