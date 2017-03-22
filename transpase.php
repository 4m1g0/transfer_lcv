<? 
include("sesiones_foro.php"); 

require_once("../../conf/recaptchalib.php");
//Llaves de la captcha
$captcha_publickey = "6LdLIbsSAAAAAJ54xS2MoUcLwLt934vAYCqRVJ6o";
$captcha_privatekey = "6LdLIbsSAAAAAJZNqo5NTNJW8ZnityvYBExYY-z8";
//por ahora ponemos a null el error de la captcha
$error_captcha = NULL;

if($user->data['is_registered']) 
{ 
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
<link rel="shortcut icon" href="../../images/favicon.ico" />
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
                          <a href="#">KoK a LoC</a></div>
                          <div class="mainmod_subheader_big"></div>
                          </div>
                          <div class="mainmod_core_big"><center>Ingresa tus Datos del Servidor.</center>
                          <div class="mainmod_text_big">
                          <center>
<?php
include "auth.inc.php";
include "config.php";
include "language.php";
include "functionstransfer.php";

change_db($dbtemp);
$check = "SELECT * FROM characters";
$in_use = mysql_query($check) or die (mysql_error());

	if (mysql_num_rows($in_use) > 0)
	{
		echo "<meta http-equiv='refresh' content='4'><br /><p align='center'>".$time."<br /><img src='741cb.gif' alt='Cargando' /></p>";
	}	
	else
	{
		$max_char = check_if_max_char($_SESSION["mk_id"], $dbloc);
	}

	if ($max_char == 1)
	{
		echo "<br /><p align='center'>".$max_characters."<br /> <meta http-equiv='refresh' content='2;url=index.php'>";
    }
	else
	{
		if ($_POST['charname'])
		{		
	   		$_SESSION['charname'] = $_POST['charname'];

			$charname = $_SESSION['charname'];
			$chrarguid = select_char($charname,$_SESSION["mk_id"],$dbkok);
			if ($chrarguid > 0)
			{    
				$clean=truncate_db($dbtemp);
				$movido = move($chrarguid,$dbkok,$dbtemp);

				if ($movido == 1)
				{
					$test2 = cleanup($dbkok);
				    $exist = check_if_name_exist($charname,$dbloc);
					
				    if ($exist == 1)
				    {
						include "functionsrename.php";
						$rename = change_name($charname,$dbtemp);
					}

					$change1 = change_guid($chrarguid,$dbtemp,$dbloc);
					$change = change_guid_id($dbtemp,$dbloc);
					$move = move($change1,$dbtemp,$dbloc); 

					if ($move == 1)
			    	{
						$delete = del_char($chrarguid,$dbkok);
						$delete = truncate_db($dbtemp);
						echo '<div align="center"><p>' .$transfersuccess. '</p><p><a href="index.php">Volver</a></div>';       
					}
				}				
			    else
			    {
					echo '<meta http-equiv="refresh" content="5;url=index.php"><p align="center">ERROR(4)</p>';
				}
			}
			else
		    {
				echo '<meta http-equiv="refresh" content="5;url=index.php"><p align="center">ERROR(3)</p>';
			}
		}
		else
	    {
		 	echo '<meta http-equiv="refresh" content="5;url=index.php"><p align="center">'.$charname . $isonline. '</p>';
		}
	}
?>
                            <p><br />
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
   	  <script type="text/javascript" src="adout.js-p=59607&t=3" tppabs="http://p59607.adskape.ru/adout.js?p=59607&t=3"></script>
        <div class="credits" align="center">
          <p>Copyright ©2010 Los Caballeros Vengadores</p>
          <p>Todos Los Derechos Reservados</p>
        </div>
    </div>
  </div>
</div>
</body>
<script src="http://tweetboard.com/loscave/tb.js" type="text/javascript"></script>
</html>

<?php }else 
{
?>
<html>
<head>
<title>Logueo NO VALIDO</title>
<META HTTP-EQUIV="REFRESH" CONTENT="10;URL=/">
</head>
<body>
Logueo No Valido, <b>Necesitas Estar Logueado en El Foro para Continuar.</b>
</body>
</html> 
<?php
}
?>



