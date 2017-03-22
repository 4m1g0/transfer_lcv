<?php  
define('IN_PHPBB', true); // se dice que se usa el phpbb. 
$phpbb_root_path = '../../foro/'; // direccion directa del servidor a tu phpBB 
$phpbb_url_path = 'http://loscaballerosvengadores.com/foro/'; // la url tu phpbb3 
$phpEx = substr(strrchr(__FILE__, '.'), 1); // extension 
include($phpbb_root_path . 'common.' . $phpEx); // se incluye common.php
include($phpbb_root_path . 'config.' . $phpEx); //se incluye para la info de tu base de datos como conexion, etc
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/bbcode.' . $phpEx);
// iniciamos sesion 
$user->session_begin(); 
$auth->acl($user->data); 
$user->setup();
?>
