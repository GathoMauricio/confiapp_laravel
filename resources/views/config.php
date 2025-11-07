<?php

$basePath = dirname(__DIR__,2);

require $basePath . '/vendor/autoload.php';
$loadResult = require_once $basePath . '/bootstrap/app.php';

if ($loadResult === true) {
    // El archivo se cargó pero no devolvió el objeto $app.
    // Intentamos acceder al contenedor de servicios (Service Container) global.
    // Usamos la función global de Laravel 'app()' si está disponible
    if (function_exists('app')) {
        $app = app(); // Obtiene la instancia del contenedor si ya está cargado
    } else {
        die("Error: El bootstrap cargó pero no se puede obtener la instancia de la aplicación o la función 'app()' no está disponible.");
    }
} else {
    // Si no es 'true', asumimos que $loadResult es el objeto $app si el archivo lo devolvió correctamente.
    $app = $loadResult;
}

// **** COMPROBACIÓN CRÍTICA ****
if (!isset($app) || !is_object($app)) {
    die("Error Crítico: La variable \$app no es un objeto válido después de la carga.");
}
// *****************************
//Ahora que $app es un objeto, podemos hacer 'make'
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// --- ¡Ahora el .env debería ser accesible! ---

$db_host = env('DB_HOST');
$db_user = env('DB_USERNAME');
$db_pass = env('DB_PASSWORD');
$db_database = env('DB_DATABASE');

$dbhost = $db_host;
$dbuser = $db_user;
$dbpass = $db_pass;
$db = $db_database ;
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
