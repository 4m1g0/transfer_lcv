<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Los Caballeros Vengadores : Servidor Privado de WoW : Servidor Gratis de WoW</title>
<meta name="description" content="Servidor Privado de World of Warcraft." />
<meta name="keywords" content="WOW, world of warcraft, gratis, privado, WotLK, realmlist, blizzlike, lista de servidores de wow" />
<meta name="classification" content="Content of Site here" />
<meta name="copyright" content="Copyright 2009 Nache - @ Los Caballeros Vengadores. Producto Registrado. X95248XX-XX" />
<script src="../jquery-1.3.2.min.js" tppabs="http://loscaballerosvengadores.com/js/jquery/jquery-1.3.2.min.js" type="text/javascript" ></script>
<link rel="stylesheet" type="text/css" href="../main.css" tppabs="http://loscaballerosvengadores.com/css/main.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<style type="text/css">
<!--
.test {
	color: #FFF;
}
test2 {
	color: #000;
}
testiend {
	color: #000;
}
#container #main .main_cont .mainmod_big .newsmod .mainmod_core_big .mainmod_text_big center .topmod form table tr td {
	color: #000;
}
.testiando {
	color: #000;
}
-->
</style>
</head>
<body>
<div class="head">
<div class="topmenu">
</div>  <div class="flash_wrapper">
    <div class="logo_flash_holder">
    </div>
  </div>
  <div class="topper">
  </div>
</div>
<div id="container">
  <div id="main">
    <div class="clear"></div>
    <div class="main_cont">
    <div class="mainmod_big">
                          <div class="newsmod">
                          <div class="mainmod_top_big">
                          <div class="mainmod_header_big">
                          <a href="#">Transferencia KoK a LoC</a></div>
                          <div class="mainmod_subheader_big"></div>
                          </div>
                          <div class="mainmod_core_big"><center>Ingresa tus Datos del Servidor.</center>
                          <div class="mainmod_text_big">
                          <center>
<?php
include "config.php";
include "language.php";

if(isset($_POST["exit"]))
{
	session_destroy();
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=. \" />";
}
function test_realm($server, $port)
{
	$s = @fsockopen("$server", $port, $ERROR_NO, $ERROR_STR,(float)0.5);
	if($s){@fclose($s);return true;} else return false;
}
?>
<table width='100%' border='0' cellspacing='1' cellpadding='3' align='center'>
<tr>
		<td align='left'><?php include "language_form.php"; ?></td>
		<td align='right'>
			<form method="POST">
				<input type="hidden" name="exit">
				<button type="button" onclick="this.form.submit();"><?php echo $exit; ?></button>
			</form>
		</td>
	</tr>
</table>
<?php
if (!isset($_SESSION["mk_id"]))
{
?>
<h1 align='center'><?php echo $header ?></h1>
<p align='center' color='red'><?php echo $advise ?></p>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<form action='validar.php' method='post'>
<table border='0' cellspacing='1' cellpadding='3' align='center'>
	<tr>
		<td width='50%'><?php echo $realmname ?></td>
		<td width='50%'>KoK</td>
	</tr>
	<tr>
		<td><?php echo $username ?></td>
		<td>
			<input type='text' name='username' maxlength='30' size='30'/>
		</td>
	</tr>
	<tr>
		<td><?php echo $password ?></td>
		<td>
			<input type='password' name='pass' maxlength='30' size='30'/>
		</td>
	</tr>
	<tr>
		<td colspan='2' align='center'>
			<input type='submit' name='$submit' value='<?php echo $enter ?>'/>
		</td>
	</tr>
</table>
</form>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
<p align="center" style="font-size:12px;">Designed by 4m1g0 (zazu) and dedicated to "Clius" specialy for Los Cabaleros Vengadores.<br /> Specially thanks for the support to Nache "The Master"<br />
<br/><b>Copyright 2008-2010 &copy; <b>Los Caballeros Vengadores.</b></p>
<?php

}
elseif (isset($_SESSION["mk_id"]))
{
if(test_realm($kok, $port) and test_realm($loc, $port2))
{
include "cheks.php";
include "functionstransfer.php";
  $online=check_if_online($realm,$_SESSION["mk_id"]);
  if ($online==0)
  {
    ?><form action='transpase.php' method='post'>
<table border='0' cellspacing='1' cellpadding='3' align='center'>
	<tr>
		<td><?php echo $character_select ?></td>
		<td>
		<select name='charname'>
			<?php
			$chars=select_account_chars_name($_SESSION["mk_id"], $dbkok);
			?>
		</td>
	</tr>
	<tr>
		<td colspan='2' align='center'>
			<input type='submit' name='$acept' value='<?php echo $enter ?>'/>
		</td>
	</tr>
</table>
</form>
<?php
}
else
echo '<p align="center">' .$playeron. '</p>'; 
}
else
echo '<p align="center">' .$serveroff. '</p>';
} 
?>
                          </center>
                          </div>
      <div class="mainmod_bot_big">
      <div class="mainmod_foot_big"></div>
           </div>
          </div>
         <div class="clear2"></div>
        </div>
      </div>
      <div class="clear2"></div>
    </div>
    <div class="clear2"></div>
</div>
<div class="footer">
  	<div class="blizz_icon">
    	<div class="fs">     </div>
        <div class="credits" align="center">
          <p>Copyright ©2009 Los Caballeros Vengadores</p>
          <p>Todos Los Derechos Reservados</p>
        </div>
    </div>
  </div>
</div>
</body>
</html>