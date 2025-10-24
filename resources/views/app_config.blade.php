
<?php
session_save_path('');
session_start();

require_once resource_path('views/config.php');

$var1 = $_GET['year'];
$var2 = $_GET['sub'];
$var3 = $_GET['name'];
$var4 = $_GET['year'];
$var5 = $_GET['email'];

$fecha = time();
$email = $_GET['email'];

setcookie('year_x1',$_GET['year'], time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
setcookie('sub_x1',$_GET['sub'], time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
setcookie('name_x1',$_GET['name'], time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
setcookie('correo_x1',$_GET['email'], time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
//AQUI SE DEBE AGREGAR EL NUEVO AÑO
if($_GET['year'] == 2016){
setcookie('value_x1','73.04', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
} elseif($_GET['year'] == 2017) {
setcookie('value_x1','75.49', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
} elseif($_GET['year'] == 2018) {
setcookie('value_x1','80.60', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
} elseif($_GET['year'] == 2019) {
setcookie('value_x1','84.49', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
} elseif($_GET['year'] == 2020) {
setcookie('value_x1','86.88', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
} elseif($_GET['year'] == 2021) {
setcookie('value_x1','89.62', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
} elseif($_GET['year'] == 2022) {
setcookie('value_x1','96.22', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
} elseif($_GET['year'] == 2023) {
setcookie('value_x1','103.74', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
} elseif($_GET['year'] == 2024) {
setcookie('value_x1','108.57', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
} elseif($_GET['year'] == 2025) {
setcookie('value_x1','113.14', time() + (10 * 365 * 24 * 60 * 60)); // 86400 = 1 day
}


if($email != ""){
$resp = mysqli_query($conectar,"select correo from correos where correo='$email'");
$datos = mysqli_fetch_array($resp);
if(isset($datos['correo']) && $email != $datos['correo']){
mysqli_query($conectar,"insert into correos (fecha,correo) values ('$fecha','$email')") ;

$titulo    = 'Calculadora SIISARH';
$mensaje   = 'Te has registrado exitosamente en la Calculadora SIISARH';
$cabeceras .= 'From: contactos@siisarh.com' . "\r\n";
$cabeceras .= 'Reply-To: contactos@siisarh' . "\r\n" ;
$cabeceras .= 'X-Mailer: PHP/' . phpversion();

mail($email, $titulo, $mensaje, $cabeceras);
}
mysqli_free_result($resp);
}
//incluir con un elseif el nuevo año y el nuevo valor
header("Location: {{ route('app_config2') }}?x1=$var1&x2=$var2&x3=$var3&x4=$var4");

?>
<script>
    window.location = "{{ route('app_config2') }}?x1=$var1&x2=$var2&x3=$var3&x4=$var4";
</script>
