<?php
session_start();
include "config.php";
include "language.php";
mysql_connect($MySQL_Host,$MySQL_User,$MySQL_Password)or die ('Ha fallado la conexi&oacute;n: '.mysql_error());
mysql_select_db("$realm")or die ('Error al seleccionar la Base de Datos: '.mysql_error());
 
function quitar($mensaje)
{
    $nopermitidos = array("'",'\\','<','>',"\",","*",'"');
    $mensaje = str_replace($nopermitidos, "", $mensaje);
    return $mensaje;
}  

function lhash($user,$pass)
{
	$n = strtoupper($user);
	$p = strtoupper($pass);
	return SHA1($n. ":" .$p);
}

echo '<meta http-equiv="refresh" content="2; url=index.php" />';
 
if ($_POST["username"] && $_POST["pass"])
{
    $user = quitar($_POST["username"]);
    $pass = $_POST["pass"];
    $pass_hash = lhash($user, $pass);
 
    $select_pass = "SELECT id FROM account WHERE username LIKE '".$user."' AND sha_pass_hash ='".$pass_hash."'";
    $result = mysql_query($select_pass) or die (mysql_error());

    if ($row = mysql_fetch_array($result))
	{
            $_SESSION['mk_id'] = $row["id"];
            $_SESSION['logged_transfer'] = 1;
            echo '<br /><p align="center">' .$correct. '<br />';
            echo '<a href="index.php">Continuar</a></p>';
	    mysql_free_result($result);
        }
else
{
	echo '<br /><p align="center">' .$wrong. '<br /><a href="index.php">Volver</a></p>';
}
}else
{
        echo '<br /><p align="center">' .$empty. '<br /><a href="index.php">Volver</a></p>';
}

mysql_close();
?>