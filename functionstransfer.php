<?php
function change_db($db)
{
	global $MySQL_Host, $MySQL_User, $MySQL_Password;
	//connection to server
	$mysql_link = mysql_connect($MySQL_Host, $MySQL_User, $MySQL_Password) or die ("Could not connect.");
	mysql_select_db($db, $mysql_link) or die (mysql_error());
}

function check_if_name_exist($name,$db)
{
	change_db($db);
	$check_exist = "SELECT * FROM `characters` WHERE `name` LIKE '$name'";
	$check=mysql_query($check_exist) or die (mysql_error());
	if (mysql_num_rows($check)==0){
		return 0;
	}
	return 1;
}

function check_if_max_char($id, $db)
{
	change_db($db);

	$check_max = "SELECT count(*) AS 'max' FROM `characters` WHERE `account` = '$id'";
	$check = mysql_query($check_max) or die (mysql_error());
	$row = mysql_fetch_array($check);
	if ($row['max'] < 10)
	{
    	return 0;
	}	
  	else
	{
    	return 1;
	}
}	

function select_char($char_name,$accid,$db)
{
	change_db($db);
	$select_char = "SELECT `GUID`, `account` FROM `characters` WHERE `name` LIKE '$char_name' AND `online` = 0";
	$results=mysql_query($select_char) or die (mysql_error());
	if (mysql_num_rows($results) > 0)
	{
		$row=mysql_fetch_array($results);
		$char_guid=$row['GUID'];
		return $char_guid;
	}
	else
	{
		return 0;
	}
}

function move($char_guid,$fist_db,$second_db)
{
	include "tabs.php";
	change_db($second_db);
	foreach ($tab_characters as $value){
	        $move="INSERT INTO `$value[0]` SELECT * FROM `$fist_db`.`$value[0]` WHERE `$value[1]` = '$char_guid'";
	        mysql_query($move) or die (mysql_error());
	}
	$move="INSERT INTO `pet_spell` SELECT * FROM `$fist_db`.`pet_spell` WHERE `guid` in (SELECT `id` FROM `$fist_db`.`character_pet` WHERE `owner`= '$char_guid')";
	mysql_query($move) or die (mysql_error());
	return 1;
}

function cleanup($db)
{
	change_db($db);
	$clean="DELETE FROM `mail_items` WHERE (mail_id ) NOT IN ( SELECT id FROM `mail` );";
	$results=mysql_query($clean) or die (mysql_error());
}

function select_max_guid($db,$table,$field)
{
	change_db($db);
	$select_max = "SELECT MAX($field) as max_guid FROM $table";
	$results=mysql_query($select_max) or die (mysql_error());
	$row=mysql_fetch_array($results);
	$max_guid=$row['max_guid'];
	return $max_guid;
}

function change_guid_id($dbchange,$dbmax)
{
	include "tabs.php";
	change_db($dbchange);
	$change_guid="ALTER TABLE item_instance DROP PRIMARY KEY";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="ALTER TABLE item_instance ADD `guid_temp` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="ALTER TABLE item_instance ADD `guid_new` INT( 11 ) UNSIGNED NOT NULL FIRST";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="UPDATE item_instance SET `guid_new` = `guid_temp`";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="ALTER TABLE item_instance DROP `guid_temp`";
	mysql_query($change_guid)or die (mysql_error());
	$newguid=select_max_guid($dbmax,item_instance,guid);
	change_db($dbchange);
    	$maxguid=$newguid +60;
    	if(!($maxguid > 0))
		$maxguid=0;
	$change_guid="UPDATE `item_instance` SET `guid_new` = `guid_new` + $maxguid";
	mysql_query($change_guid)or die (mysql_error());
	foreach ($tab_guid_item as $value)
	{
	 		$change_guid="UPDATE $value[0], item_instance SET $value[0].$value[1] = `item_instance`.`guid_new` WHERE $value[0].$value[1] = `item_instance`.guid";
			mysql_query($change_guid) or die (mysql_error());
	}
	$change_guid="update `item_instance` set `guid` = `guid_new`";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="ALTER TABLE `item_instance` DROP guid_new";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="ALTER TABLE `item_instance` ADD PRIMARY KEY (guid)";
	mysql_query($change_guid)or die (mysql_error());
	
	
	$change_guid="ALTER TABLE character_pet DROP PRIMARY KEY";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="ALTER TABLE character_pet ADD `guid_temp` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="ALTER TABLE character_pet ADD `guid_new` INT( 11 ) UNSIGNED NOT NULL FIRST";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="UPDATE character_pet SET `guid_new` = `guid_temp`";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="ALTER TABLE character_pet DROP `guid_temp`";
	mysql_query($change_guid)or die (mysql_error());
	$newguid=select_max_guid($dbmax,character_pet,id);
	change_db($dbchange);
    	$maxguid=$newguid +5;
    	if(!($max_guid > 0))
		$max_guid=0;
	$change_guid="UPDATE `character_pet` SET `guid_new` = `guid_new` + $maxguid";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="UPDATE pet_spell, character_pet SET pet_spell.guid = `character_pet`.`guid_new` WHERE pet_spell.guid = `character_pet`.id";
	mysql_query($change_guid) or die (mysql_error());
	$change_guid="update `character_pet` set `id` = `guid_new`";
	mysql_query($change_guid) or die (mysql_error());
	$change_guid="ALTER TABLE `character_pet` DROP guid_new";
	mysql_query($change_guid)or die (mysql_error());
	$change_guid="ALTER TABLE character_pet ADD PRIMARY KEY (id)";
	mysql_query($change_guid)or die (mysql_error());
		
}

function change_guid($char_guid,$db,$dbmax)
{
    $newguid2=select_max_guid($dbmax,characters,guid);
    $newguid=$newguid2 +2;
  include "tabs.php";
	change_db($db);
	foreach ($tab_characters as $value){
		$change="UPDATE $value[0] SET $value[1]=$newguid WHERE $value[1] = $char_guid";
		mysql_query($change) or die (mysql_error());
	}
 return $newguid;
	
}

function truncate_db($db)
{
	include "tabs.php";
	change_db($db);
	foreach ($tab_characters as $value)
	{
		$truncate="TRUNCATE $value[0]";
		mysql_query($truncate);
	}
	$truncate="TRUNCATE pet_spell";
		mysql_query($truncate);
}

function del_char($char_guid,$db)
{
	change_db($db);
	$delete_char="DELETE FROM `characters` WHERE `guid`=$char_guid";
	mysql_query($delete_char)or die (mysql_error());
}

function clean_after_delete($db)
{
	change_db($db);
	set_time_limit(200);
	$file = fopen("clean_after_delete.sql", 'r');
	while(!feof($file))
	{
		$getquery = trim(fgets($file));
		$clean="$getquery";
		mysql_query($clean);
	}
}
?>