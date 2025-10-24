<?
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "confiapp";
$conectar = mysqli_connect($dbhost,$dbuser,$dbpass);
if(!$conectar) {
$error = mysqli_connect_error() ;
?>
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center"><tr><td class="fondo_imagen_circ1">&nbsp;</td>
<td class="fondo_color"></td><td class="fondo_imagen_circ2">&nbsp;</td></tr><tr><td class="fondo_color"></td><td class="fondo_color2">
<p class="titulo">Error</p>
<p class="contenido">No se pudo conectar a la base de datos debido a:</p>
<p class="contenido"><b><?=$error?></b></p>
</td><td class="fondo_color"></td></tr><tr><td class="fondo_imagen_circ3">&nbsp;</td>
<td class="fondo_color"></td><td class="fondo_imagen_circ4">&nbsp;</td></tr></table>
<?
exit ;
}
mysqli_select_db($conectar,$db) ;
$conectar->set_charset("utf8");
?>
