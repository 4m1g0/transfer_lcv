<?php
echo "<form method=\"POST\">
<select name=\"setlang\" onchange=\"this.form.submit();\">";
foreach ($langs as $short =>$alang)
{
	$SELECTED="";
	if($short==$_SESSION["lang"])
		$SELECTED="SELECTED";
	echo "<option $SELECTED value=\"$short\">$alang</option>";
}
echo "</select>
</form>";
?>