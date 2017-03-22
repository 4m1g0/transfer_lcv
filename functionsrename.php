<?php
function change_name($name,$db)
{ 
  $cadena="abcdefghijklmnopqrstuvwxyz";
$cad = "";
for($i=0;$i<10;$i++) {
$str .= substr($cadena,rand(0,30),1);
}
  $newname= 'Q' . $str;
  	change_db($db);
	$change_name = "UPDATE `characters` SET `at_login`= 1, name= '$newname' WHERE `name` LIKE '$name'";
	mysql_query($change_name) or die (mysql_error());
}
?>