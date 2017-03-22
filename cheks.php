<?php
function check_if_online($db,$id)
{
	change_db($db);
	$query = "SELECT `online` FROM `account` WHERE `id` = '$id'";
	$result=mysql_query($query) or die (mysql_error());
	$row=mysql_fetch_array($result);
	if ($row['online'] == 1)
		return 1;
	return 0;
}
function select_account_chars_name($id, $db)
{
  change_db($db);
  $check_guids = "SELECT `name` FROM `characters` WHERE `account` = '$id'";
  $check=mysql_query($check_guids) or die (mysql_error());
  $i=0;
  array(charname);
  while ($row=mysql_fetch_array($check))
  {
    echo '<option>'. $row['name'] . '</option>';
  }
  return $charname;
}
?>