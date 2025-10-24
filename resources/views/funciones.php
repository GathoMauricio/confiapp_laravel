<?php

ini_set('display_errors', '1');
error_reporting(E_ERROR | E_WARNING);

$GLOBAL_CURRENT_YEAR = "2025"; //actualizar al año
$GLOBAL_SYSTEM_YEAR = $_COOKIE['year_x1'] ?? 2025;
if (isset($_COOKIE['year_x1'])) {
	if ($_COOKIE['year_x1'] == "2016") {
		$GLOBAL_SALARIO = "Salario Mínimo General";
	} elseif ($_COOKIE['year_x1'] == "2017" or $_COOKIE['year_x1'] == "2018" or $_COOKIE['year_x1'] == "2019") {
		$GLOBAL_SALARIO = "UMA (Unidad de Medida Actualizada)";
	} else {
		$GLOBAL_SALARIO = "UMA (Unidad de Medida Actualizada)";
	}
}else{
	$GLOBAL_SALARIO = "UMA (Unidad de Medida Actualizada)";
}


function honorarios($var1)
{
	$cal1 = $var1 * 0.16;
	$cal2 = $var1 + $cal1;
	$cal3 = $cal2;
	$cal4 = $var1 * 0.10;
	$cal5 = $cal1 * 0.666667;
	$cal6 = $cal3 - $cal4 - $cal5;
	$cal7 = $cal6;
	return $cal7;
}


function impuesto_marginal($var1, $var2)
{
	require resource_path('views/config.php');
	mysqli_select_db($conectar, $db);
	$conectar->set_charset("utf8");
	$dias_trabajados_real = $var2;
	$ingresos = $var1;
	$resp24 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var1 desc limit 1");
	$datos24 = mysqli_fetch_array($resp24);
	$cal1 = $ingresos - $datos24['var1'];
	mysqli_free_result($resp24);
	$resp25 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
	$datos25 = mysqli_fetch_array($resp25);
	$cal2 = $cal1 * $datos25['var4'];
	return $cal3 = $cal2 / 100;
	mysqli_free_result($resp25);
}

function inverso($var1, $var2, $var3)
{
	require resource_path('views/config.php');
	mysqli_select_db($conectar, $db);
	$conectar->set_charset("utf8");
	$GLOBAL_SYSTEM_YEAR = $var3;
	$dias_trabajados_real = $var2;
	$ingresos = $var1;
	$resp24 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var1 desc limit 1");
	$datos24 = mysqli_fetch_array($resp24);
	$cal1 = $ingresos - $datos24['var1'];
	mysqli_free_result($resp24);
	$resp25 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
	$datos25 = mysqli_fetch_array($resp25);
	$cal2 = $cal1 * $datos25['var4'];
	$cal3 = $cal2 / 100;
	mysqli_free_result($resp25);
	$resp26 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
	$datos26 = mysqli_fetch_array($resp26);
	$cal4 = $cal3 + $datos26['var3'];
	mysqli_free_result($resp26);
	$resp27 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
	$datos27 = mysqli_fetch_array($resp27);
	$cal5 = $cal4 - $datos27['var3'];
	return abs(round($cal5, 2));
	mysqli_free_result($resp27);
}

function inverso_calculo($ingresos, $valor, $dias_trabajados_real, $marginal)
{
	$i = 0;
	$i = round($ingresos, 2);
	do {
		//echo "<br><b>";
		//echo $i;
		//echo "</b>";
		$i = round($i, 2) + 0.01;
		$i2 = $i - inverso($i, $dias_trabajados_real);
	} while (round($ingresos, 2) >= round($i2, 2));
	return round($i, 2) - 0.01;
}

function sueldos_y_salarios($var1, $var2, $var3)
{
	require resource_path('views/config.php');
	mysqli_select_db($conectar, $db);
	$conectar->set_charset("utf8");
	////////end conecction
	$GLOBAL_SYSTEM_YEAR = $var3;
	$resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR' and var1 between '0' and '$var1' order by var4 desc limit 1");
	$datos1 = mysqli_fetch_array($resp1);
	$limite_inferior = $datos1['var1'];
	$importe_excedente_li = $var1 - $limite_inferior;
	$resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR' and var1 between '0' and '$var1' order by var4 desc limit 1");
	$datos2 = mysqli_fetch_array($resp2);
	$porcentaje_p_aplicarse = $datos2['var4'];
	$c1 = $importe_excedente_li * $porcentaje_p_aplicarse;
	$c2 = $c1 / 100;
	$impuesto_marginal = $c2;
	$resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR' and var1 between '0' and '$var1' order by var4 desc limit 1");
	$datos3 = mysqli_fetch_array($resp3);
	$cuota_fija = $datos3['var3'];
	//tabla subsidio
	$resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and var1 between '0' and '$var1' order by var4 desc limit 1");
	$datos4 = mysqli_fetch_array($resp4);
	$c3 = $datos4['var3'];
	//fin tabla subsidio
	$isr_calculado = $impuesto_marginal + $cuota_fija;

	if ($var2 == 0) {
		$cal5 = $isr_calculado - $c3;
	} else {
		$cal5 = $isr_calculado;
	}

	return $cal5; //falta subsidio para empleo
}

function impuesto_anual($var1, $var2, $var3, $var4, $var5)
{

	require resource_path('views/config.php');
	mysqli_select_db($conectar, $db);
	$conectar->set_charset("utf8");
	////////end conecction

	$ingreso_gravable = $var1;
	$deducciones_autorizadas = $var2;
	$isr_retenido = $var3;
	$subsidio_empleo = $var4;
	$subsidio_total = $var5;

	$fecha = time();

	$ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;

	$resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and var1 between '0' and '$ingreso_gravable_total' order by var4 desc limit 1");
	$datos1 = mysqli_fetch_array($resp1);
	$limite_inferior = $datos1['var1'];

	$importe_excedente_li = $ingreso_gravable_total - $limite_inferior;

	$resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and var1 between '0' and '$ingreso_gravable_total' order by var4 desc limit 1");
	$datos2 = mysqli_fetch_array($resp2);
	$porcentaje_p_aplicarse = $datos2['var4'];

	$impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse) / 100;

	$resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and var1 between '0' and '$ingreso_gravable_total' order by var4 desc limit 1");
	$datos3 = mysqli_fetch_array($resp3);
	$cuota_fija = $datos1['var3'];

	$impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;

	$impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;

	$c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido), 0);
	return $c1;
}
