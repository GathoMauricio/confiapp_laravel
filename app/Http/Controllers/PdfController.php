<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;

class PdfController extends Controller
{
    public function pdfPdiPrestadoresP()
    {
        require resource_path('views/config.php');


        $YEAR_PDF = $_GET['year'];
        function detectar_isr($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            //$impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse)/100;
            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'];
            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;
            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;
            $c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido), 0);
            return $impuesto_anual_total;
        }

        function impuesto_anual2($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            //$impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse)/100;
            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'];
            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;
            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;
            $c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido), 0);
            return $c1;
        }

        function impuesto_anual($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            //$impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse)/100;
            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'];
            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;
            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;

            $cal_flag = impuesto_anual2($ingreso_gravable, 0, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);

            $c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido) - $cal_flag, 0);

            return $c1;
        }

        function nivel_tabla($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $c1 = $datos1['nivel'];
            return $c1;
        }

        if (isset($_GET['var1']) and isset($_GET['var2']) and isset($_GET['var3']) and isset($_GET['var4']) and isset($_GET['var5'])) {

            $ingreso_gravable = $_GET['var1'];
            $deducciones_autorizadas = $_GET['var2'];
            $isr_retenido = round(detectar_isr($ingreso_gravable, 0, 0, 0, 0, $YEAR_PDF), 0);
            $subsidio_empleo = $_GET['var4'];
            $subsidio_total = $_GET['var5'];
            //
            $nivel_tabla_1 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_2 = $ingreso_gravable * 0.02;
            $nivel_tabla_2 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_2, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_3 = $ingreso_gravable * 0.04;
            $nivel_tabla_3 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_3, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_4 = $ingreso_gravable * 0.06;
            $nivel_tabla_4 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_4, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_5 = $ingreso_gravable * 0.08;
            $nivel_tabla_5 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_5, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_6 = $ingreso_gravable * 0.10;
            $nivel_tabla_6 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_6, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_7 = $ingreso_gravable * 0.15;
            $nivel_tabla_7 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_7, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            //este
            //
            $ajuste_anual_1_f = impuesto_anual2($ingreso_gravable, 0, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $ajuste_anual_1 = $ajuste_anual_1_f * -1;
            $ajuste_anual_11 = $ajuste_anual_1_f;

            $impuesto_anual_real_cajuste_1 = $ajuste_anual_1 - $isr_retenido;

            //
            $importe_devolucion_1_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_1 = $importe_devolucion_1_f;
            $importe_devolucion_2_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_2, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_2 = $importe_devolucion_2_f;
            $importe_devolucion_3_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_3, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_3 = $importe_devolucion_3_f;
            $importe_devolucion_4_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_4, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_4 = $importe_devolucion_4_f;
            $importe_devolucion_5_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_5, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_5 = $importe_devolucion_5_f;
            $importe_devolucion_6_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_6, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_6 = $importe_devolucion_6_f;
            $importe_devolucion_7_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_7, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_7 = $importe_devolucion_7_f;
            //este
            //
            $total_devoluciones_1 = ($importe_devolucion_1 + $ajuste_anual_11);
            $total_devoluciones_2 = ($importe_devolucion_2 + $ajuste_anual_11);
            $total_devoluciones_3 = ($importe_devolucion_3 + $ajuste_anual_11);
            $total_devoluciones_4 = ($importe_devolucion_4 + $ajuste_anual_11);
            $total_devoluciones_5 = ($importe_devolucion_5 + $ajuste_anual_11);
            $total_devoluciones_6 = ($importe_devolucion_6 + $ajuste_anual_11);
            $total_devoluciones_7 = ($importe_devolucion_7 + $ajuste_anual_11);
            //este
            //
            //
            $porcentaje_devoluciones_p_1 = number_format(($importe_devolucion_1 / ($deducciones_autorizadas + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_2 = number_format(($importe_devolucion_2 / ($deducciones_autorizadas_2 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_3 = number_format(($importe_devolucion_3 / ($deducciones_autorizadas_3 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_4 = number_format(($importe_devolucion_4 / ($deducciones_autorizadas_4 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_5 = number_format(($importe_devolucion_5 / ($deducciones_autorizadas_5 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_6 = number_format(($importe_devolucion_6 / ($deducciones_autorizadas_6 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_7 = number_format(($importe_devolucion_7 / ($deducciones_autorizadas_7 + 0.0000001)) * 100, 2);
            //este
            //
            $porcentaje_reduccion_impuestos_1 = abs(number_format(($importe_devolucion_1 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_2 = abs(number_format(($importe_devolucion_2 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_3 = abs(number_format(($importe_devolucion_3 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_4 = abs(number_format(($importe_devolucion_4 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_5 = abs(number_format(($importe_devolucion_5 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_6 = abs(number_format(($importe_devolucion_6 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_7 = abs(number_format(($importe_devolucion_7 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            //este
            //
            $impuesto_real_pagado_1_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_1);
            $impuesto_real_pagado_1_porce = 100 - $porcentaje_reduccion_impuestos_1;
            $impuesto_real_pagado_2_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_2);
            $impuesto_real_pagado_2_porce = 100 - $porcentaje_reduccion_impuestos_2;
            $impuesto_real_pagado_3_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_3);
            $impuesto_real_pagado_3_porce = 100 - $porcentaje_reduccion_impuestos_3;
            $impuesto_real_pagado_4_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_4);
            $impuesto_real_pagado_4_porce = 100 - $porcentaje_reduccion_impuestos_4;
            $impuesto_real_pagado_5_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_5);
            $impuesto_real_pagado_5_porce = 100 - $porcentaje_reduccion_impuestos_5;
            $impuesto_real_pagado_6_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_6);
            $impuesto_real_pagado_6_porce = 100 - $porcentaje_reduccion_impuestos_6;
            $impuesto_real_pagado_7_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_7);
            $impuesto_real_pagado_7_porce = 100 - $porcentaje_reduccion_impuestos_7;
            //este
            //
            date_default_timezone_set("America/Mexico_City");
            $impresion_fecha = date("Y-m-d h:i:sa");
            $usuario_global = $_GET['name'];
            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>
<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Ajuste Anual PDI Proyección</font></b></p></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td><b>Fecha de cálculo: </b></td>
<td>' . $impresion_fecha . '</td>
</tr>
<tr>
<td><b>Realizado para: </b></td>
<td>' . $usuario_global . '</td>
</tr>
</table>
<br>
<table border="0"><tr><td><strong>Datos para el cálculo</strong></td></tr></table>
<div style="overflow-x:auto;">
  <table>
<tr>
<td width="70%">Ingreso Total</td>
<td width="15%"></td>
<td width="15%" align="right">' . number_format($ingreso_gravable, 2) . '</td>
</tr>
<tr>
<td width="70%">Deducciones Autorizadas</td>
<td width="15%"></td>
<td width="15%" align="right">' . number_format($deducciones_autorizadas, 2) . '</td>
</tr>
</table>
<br>
<table>
<tr>
<td align="center"><b>%</b></td>
<td align="center"><b>Nivel</b></td>
<td align="center"><b>Ingresos Desde</b></td>
<td align="center"><b>Ingresos Hasta</b></td>
<td align="center"><b>Retención de ISR</b></td>
<td align="center"><b>Ajuste Anual</b></td>
<td align="center"><b>Impuesto anual real con ajuste</b></td>
<td align="center"><b>Total deducciones autorizadas con tope</b></td>
<td align="center"><b>Importe Devolución</b></td>
<td align="center"><b>Total Devoluciones</b></td>
<td align="center"><b>Porcentaje devoluciones personales</b></td>
<td align="center"><b>Porcentaje de reducción de impuestos</b></td>
<td align="center"><b>Impuesto real pagado después de devoluciones $</b></td>
<td align="center"><b>Impuesto real pagado después de devoluciones %</b></td>
</tr>

<tr>
<td>Manual</td>
<td>' . $nivel_tabla_1 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_1), 2) . '</td>
<td>' . number_format($total_devoluciones_1, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_1) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_1 . '%</td>
<td>' . number_format($impuesto_real_pagado_1_money, 2) . '</td>
<td>' . $impuesto_real_pagado_1_porce . '%</td>
</tr>

<tr>
<td>2%</td>
<td>' . $nivel_tabla_2 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_2, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_2), 2) . '</td>
<td>' . number_format($total_devoluciones_2, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_2) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_2 . '%</td>
<td>' . number_format($impuesto_real_pagado_2_money, 2) . '</td>
<td>' . $impuesto_real_pagado_2_porce . '%</td>
</tr>

<tr>
<td>4%</td>
<td>' . $nivel_tabla_3 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_3, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_3), 2) . '</td>
<td>' . number_format($total_devoluciones_3, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_3) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_3 . '%</td>
<td>' . number_format($impuesto_real_pagado_3_money, 2) . '</td>
<td>' . $impuesto_real_pagado_3_porce . '%</td>
</tr>

<tr>
<td>6%</td>
<td>' . $nivel_tabla_4 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_4, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_4), 2) . '</td>
<td>' . number_format($total_devoluciones_4, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_4) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_4 . '%</td>
<td>' . number_format($impuesto_real_pagado_4_money, 2) . '</td>
<td>' . $impuesto_real_pagado_4_porce . '%</td>
</tr>

<tr>
<td>8%</td>
<td>' . $nivel_tabla_5 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_5, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_5), 2) . '</td>
<td>' . number_format($total_devoluciones_5, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_5) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_5 . '%</td>
<td>' . number_format($impuesto_real_pagado_5_money, 2) . '</td>
<td>' . $impuesto_real_pagado_5_porce . '%</td>
</tr>

<tr>
<td>10%</td>
<td>' . $nivel_tabla_6 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_6, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_6), 2) . '</td>
<td>' . number_format($total_devoluciones_6, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_6) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_6 . '%</td>
<td>' . number_format($impuesto_real_pagado_6_money, 2) . '</td>
<td>' . $impuesto_real_pagado_6_porce . '%</td>
</tr>

<tr>
<td>15%</td>
<td>' . $nivel_tabla_7 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_7, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_7), 2) . '</td>
<td>' . number_format($total_devoluciones_7, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_7) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_7 . '%</td>
<td>' . number_format($impuesto_real_pagado_7_money, 2) . '</td>
<td>' . $impuesto_real_pagado_7_porce . '%</td>
</tr>

 </table>

</div>';

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('pdf_pdi_prestadores.pdf', 'I');
        }
    }
    public function pdfPdiProyeccionP()
    {
        require resource_path('views/config.php');

        $YEAR_PDF = $_GET['year'];
        function detectar_isr($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            //$impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse)/100;
            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'];
            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;
            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;
            $c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido), 0);
            return $impuesto_anual_total;
        }

        function impuesto_anual2($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            //$impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse)/100;
            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'];
            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;
            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;
            $c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido), 0);
            return $c1;
        }

        function impuesto_anual($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'] ?? 0;
            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'] ?? 0;
            //$impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse)/100;
            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'] ?? 0;
            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;
            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;

            $cal_flag = impuesto_anual2($ingreso_gravable, 0, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);

            $c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido) - $cal_flag, 0);

            return $c1;
        }

        function nivel_tabla($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'] ?? 0;
            $c1 = $datos1['nivel'] ?? 0;
            return $c1;
        }

        if (isset($_GET['var1']) and isset($_GET['var2']) and isset($_GET['var3']) and isset($_GET['var4']) and isset($_GET['var5'])) {

            $ingreso_gravable = $_GET['var1'];
            $deducciones_autorizadas = $_GET['var2'];
            $isr_retenido = number_format(detectar_isr($ingreso_gravable, 0, 0, 0, 0, $YEAR_PDF), 0);
            $subsidio_empleo = $_GET['var4'];
            $subsidio_total = $_GET['var5'];
            //
            $nivel_tabla_1 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_2 = $ingreso_gravable * 0.02;
            $nivel_tabla_2 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_2, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_3 = $ingreso_gravable * 0.04;
            $nivel_tabla_3 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_3, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_4 = $ingreso_gravable * 0.06;
            $nivel_tabla_4 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_4, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_5 = $ingreso_gravable * 0.08;
            $nivel_tabla_5 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_5, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_6 = $ingreso_gravable * 0.10;
            $nivel_tabla_6 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_6, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_7 = $ingreso_gravable * 0.15;
            $nivel_tabla_7 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_7, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            //este
            //
            $ajuste_anual_1_f = impuesto_anual2($ingreso_gravable, 0, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $ajuste_anual_1 = $ajuste_anual_1_f * -1;
            $ajuste_anual_11 = $ajuste_anual_1_f;

            $impuesto_anual_real_cajuste_1 = $ajuste_anual_1 - $isr_retenido;

            //
            $importe_devolucion_1_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_1 = $importe_devolucion_1_f;
            $importe_devolucion_2_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_2, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_2 = $importe_devolucion_2_f;
            $importe_devolucion_3_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_3, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_3 = $importe_devolucion_3_f;
            $importe_devolucion_4_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_4, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_4 = $importe_devolucion_4_f;
            $importe_devolucion_5_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_5, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_5 = $importe_devolucion_5_f;
            $importe_devolucion_6_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_6, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_6 = $importe_devolucion_6_f;
            $importe_devolucion_7_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_7, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_7 = $importe_devolucion_7_f;
            //este
            //
            $total_devoluciones_1 = ($importe_devolucion_1 + $ajuste_anual_11);
            $total_devoluciones_2 = ($importe_devolucion_2 + $ajuste_anual_11);
            $total_devoluciones_3 = ($importe_devolucion_3 + $ajuste_anual_11);
            $total_devoluciones_4 = ($importe_devolucion_4 + $ajuste_anual_11);
            $total_devoluciones_5 = ($importe_devolucion_5 + $ajuste_anual_11);
            $total_devoluciones_6 = ($importe_devolucion_6 + $ajuste_anual_11);
            $total_devoluciones_7 = ($importe_devolucion_7 + $ajuste_anual_11);
            //este
            //
            //
            $porcentaje_devoluciones_p_1 = number_format(($importe_devolucion_1 / ($deducciones_autorizadas + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_2 = number_format(($importe_devolucion_2 / ($deducciones_autorizadas_2 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_3 = number_format(($importe_devolucion_3 / ($deducciones_autorizadas_3 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_4 = number_format(($importe_devolucion_4 / ($deducciones_autorizadas_4 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_5 = number_format(($importe_devolucion_5 / ($deducciones_autorizadas_5 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_6 = number_format(($importe_devolucion_6 / ($deducciones_autorizadas_6 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_7 = number_format(($importe_devolucion_7 / ($deducciones_autorizadas_7 + 0.0000001)) * 100, 2);
            //este
            //
            $porcentaje_reduccion_impuestos_1 = abs(number_format(($importe_devolucion_1 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_2 = abs(number_format(($importe_devolucion_2 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_3 = abs(number_format(($importe_devolucion_3 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_4 = abs(number_format(($importe_devolucion_4 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_5 = abs(number_format(($importe_devolucion_5 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_6 = abs(number_format(($importe_devolucion_6 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            $porcentaje_reduccion_impuestos_7 = abs(number_format(($importe_devolucion_7 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2));
            //este
            //
            $impuesto_real_pagado_1_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_1);
            $impuesto_real_pagado_1_porce = 100 - $porcentaje_reduccion_impuestos_1;
            $impuesto_real_pagado_2_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_2);
            $impuesto_real_pagado_2_porce = 100 - $porcentaje_reduccion_impuestos_2;
            $impuesto_real_pagado_3_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_3);
            $impuesto_real_pagado_3_porce = 100 - $porcentaje_reduccion_impuestos_3;
            $impuesto_real_pagado_4_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_4);
            $impuesto_real_pagado_4_porce = 100 - $porcentaje_reduccion_impuestos_4;
            $impuesto_real_pagado_5_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_5);
            $impuesto_real_pagado_5_porce = 100 - $porcentaje_reduccion_impuestos_5;
            $impuesto_real_pagado_6_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_6);
            $impuesto_real_pagado_6_porce = 100 - $porcentaje_reduccion_impuestos_6;
            $impuesto_real_pagado_7_money = abs($impuesto_anual_real_cajuste_1) - abs($importe_devolucion_7);
            $impuesto_real_pagado_7_porce = 100 - $porcentaje_reduccion_impuestos_7;
            //este
            //
            date_default_timezone_set("America/Mexico_City");
            $impresion_fecha = date("Y-m-d h:i:sa");
            $usuario_global = $_GET['name'];
            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>
<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Ajuste Anual PDI Proyección</font></b></p></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td><b>Fecha de cálculo: </b></td>
<td>' . $impresion_fecha . '</td>
</tr>
<tr>
<td><b>Realizado para: </b></td>
<td>' . $usuario_global . '</td>
</tr>
</table>
<br>
<table border="0"><tr><td><strong>Datos para el cálculo</strong></td></tr></table>
<div style="overflow-x:auto;">
  <table>
<tr>
<td width="70%">Ingreso Total</td>
<td width="15%"></td>
<td width="15%" align="right">' . number_format($ingreso_gravable, 2) . '</td>
</tr>
<tr>
<td width="70%">Deducciones Autorizadas</td>
<td width="15%"></td>
<td width="15%" align="right">' . number_format($deducciones_autorizadas, 2) . '</td>
</tr>
</table>
<br>
<table>
<tr>
<td align="center"><b>%</b></td>
<td align="center"><b>Nivel</b></td>
<td align="center"><b>Ingresos Desde</b></td>
<td align="center"><b>Ingresos Hasta</b></td>
<td align="center"><b>Retención de ISR</b></td>
<td align="center"><b>Ajuste Anual</b></td>
<td align="center"><b>Impuesto anual real con ajuste</b></td>
<td align="center"><b>Total deducciones autorizadas con tope</b></td>
<td align="center"><b>Importe Devolución</b></td>
<td align="center"><b>Total Devoluciones</b></td>
<td align="center"><b>Porcentaje devoluciones personales</b></td>
<td align="center"><b>Porcentaje de reducción de impuestos</b></td>
<td align="center"><b>Impuesto real pagado después de devoluciones $</b></td>
<td align="center"><b>Impuesto real pagado después de devoluciones %</b></td>
</tr>

<tr>
<td>Manual</td>
<td>' . $nivel_tabla_1 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_1), 2) . '</td>
<td>' . number_format($total_devoluciones_1, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_1) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_1 . '%</td>
<td>' . number_format($impuesto_real_pagado_1_money, 2) . '</td>
<td>' . $impuesto_real_pagado_1_porce . '%</td>
</tr>

<tr>
<td>2%</td>
<td>' . $nivel_tabla_2 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_2, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_2), 2) . '</td>
<td>' . number_format($total_devoluciones_2, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_2) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_2 . '%</td>
<td>' . number_format($impuesto_real_pagado_2_money, 2) . '</td>
<td>' . $impuesto_real_pagado_2_porce . '%</td>
</tr>

<tr>
<td>4%</td>
<td>' . $nivel_tabla_3 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_3, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_3), 2) . '</td>
<td>' . number_format($total_devoluciones_3, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_3) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_3 . '%</td>
<td>' . number_format($impuesto_real_pagado_3_money, 2) . '</td>
<td>' . $impuesto_real_pagado_3_porce . '%</td>
</tr>

<tr>
<td>6%</td>
<td>' . $nivel_tabla_4 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_4, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_4), 2) . '</td>
<td>' . number_format($total_devoluciones_4, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_4) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_4 . '%</td>
<td>' . number_format($impuesto_real_pagado_4_money, 2) . '</td>
<td>' . $impuesto_real_pagado_4_porce . '%</td>
</tr>

<tr>
<td>8%</td>
<td>' . $nivel_tabla_5 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_5, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_5), 2) . '</td>
<td>' . number_format($total_devoluciones_5, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_5) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_5 . '%</td>
<td>' . number_format($impuesto_real_pagado_5_money, 2) . '</td>
<td>' . $impuesto_real_pagado_5_porce . '%</td>
</tr>

<tr>
<td>10%</td>
<td>' . $nivel_tabla_6 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_6, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_6), 2) . '</td>
<td>' . number_format($total_devoluciones_6, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_6) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_6 . '%</td>
<td>' . number_format($impuesto_real_pagado_6_money, 2) . '</td>
<td>' . $impuesto_real_pagado_6_porce . '%</td>
</tr>

<tr>
<td>15%</td>
<td>' . $nivel_tabla_7 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>0.00</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_7, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_7), 2) . '</td>
<td>' . number_format($total_devoluciones_7, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_7) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_7 . '%</td>
<td>' . number_format($impuesto_real_pagado_7_money, 2) . '</td>
<td>' . $impuesto_real_pagado_7_porce . '%</td>
</tr>

 </table>

</div>';

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('pdf_pdi_completo_proyeccion.pdf', 'I');
        }
    }

    public function pdfPdiCompletoP()
    {
        require resource_path('views/config.php');


        $YEAR_PDF = $_GET['year'];
        function impuesto_anual2($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');

            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            //$impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse)/100;
            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'];
            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;
            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;
            $c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido), 0);
            return $c1;
        }

        function impuesto_anual($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            mysqli_select_db($conectar, $db);
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = (float)$ingreso_gravable - (float)$deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            //$impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse)/100;
            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'];
            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;
            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;

            $cal_flag = impuesto_anual2($ingreso_gravable, 0, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);

            $c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido) - $cal_flag, 0);

            return $c1;
        }

        function nivel_tabla($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            $conectar->set_charset("utf8");
            ////////end conecction
            $YEAR_PDF = $var6;
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;
            $fecha = time();
            $ingreso_gravable_total = (float)$ingreso_gravable - (float)$deducciones_autorizadas;
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $c1 = $datos1['nivel'];
            return $c1;
        }

        if (isset($_GET['var1']) and isset($_GET['var2']) and isset($_GET['var3']) and isset($_GET['var4']) and isset($_GET['var5'])) {

            $ingreso_gravable = $_GET['var1'];
            $deducciones_autorizadas = $_GET['var2'];
            $isr_retenido = $_GET['var3'];
            $subsidio_empleo = $_GET['var4'];
            $subsidio_total = $_GET['var5'];
            //
            $nivel_tabla_1 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_2 = $ingreso_gravable * 0.02;
            $nivel_tabla_2 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_2, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_3 = $ingreso_gravable * 0.04;
            $nivel_tabla_3 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_3, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_4 = $ingreso_gravable * 0.06;
            $nivel_tabla_4 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_4, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_5 = $ingreso_gravable * 0.08;
            $nivel_tabla_5 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_5, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_6 = $ingreso_gravable * 0.10;
            $nivel_tabla_6 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_6, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $deducciones_autorizadas_7 = $ingreso_gravable * 0.15;
            $nivel_tabla_7 = nivel_tabla($ingreso_gravable, $deducciones_autorizadas_7, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            //este
            //
            $ajuste_anual_1_f = impuesto_anual2($ingreso_gravable, 0, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $ajuste_anual_1 = $ajuste_anual_1_f * -1;
            $ajuste_anual_11 = $ajuste_anual_1_f;

            $impuesto_anual_real_cajuste_1 = $ajuste_anual_1 - $isr_retenido;

            //
            $importe_devolucion_1_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_1 = $importe_devolucion_1_f;
            $importe_devolucion_2_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_2, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_2 = $importe_devolucion_2_f;
            $importe_devolucion_3_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_3, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_3 = $importe_devolucion_3_f;
            $importe_devolucion_4_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_4, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_4 = $importe_devolucion_4_f;
            $importe_devolucion_5_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_5, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_5 = $importe_devolucion_5_f;
            $importe_devolucion_6_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_6, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_6 = $importe_devolucion_6_f;
            $importe_devolucion_7_f = impuesto_anual($ingreso_gravable, $deducciones_autorizadas_7, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);
            $importe_devolucion_7 = $importe_devolucion_7_f;
            //este
            //
            $total_devoluciones_1 = ($importe_devolucion_1 + $ajuste_anual_11) * -1;
            $total_devoluciones_2 = ($importe_devolucion_2 + $ajuste_anual_11) * -1;
            $total_devoluciones_3 = ($importe_devolucion_3 + $ajuste_anual_11) * -1;
            $total_devoluciones_4 = ($importe_devolucion_4 + $ajuste_anual_11) * -1;
            $total_devoluciones_5 = ($importe_devolucion_5 + $ajuste_anual_11) * -1;
            $total_devoluciones_6 = ($importe_devolucion_6 + $ajuste_anual_11) * -1;
            $total_devoluciones_7 = ($importe_devolucion_7 + $ajuste_anual_11) * -1;
            //este
            //
            //
            $porcentaje_devoluciones_p_1 = number_format(((float)$importe_devolucion_1 / ((float)$deducciones_autorizadas + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_2 = number_format(($importe_devolucion_2 / ($deducciones_autorizadas_2 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_3 = number_format(($importe_devolucion_3 / ($deducciones_autorizadas_3 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_4 = number_format(($importe_devolucion_4 / ($deducciones_autorizadas_4 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_5 = number_format(($importe_devolucion_5 / ($deducciones_autorizadas_5 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_6 = number_format(($importe_devolucion_6 / ($deducciones_autorizadas_6 + 0.0000001)) * 100, 2);
            $porcentaje_devoluciones_p_7 = number_format(($importe_devolucion_7 / ($deducciones_autorizadas_7 + 0.0000001)) * 100, 2);
            //este
            //
            $porcentaje_reduccion_impuestos_1 = number_format(($importe_devolucion_1 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2);
            $porcentaje_reduccion_impuestos_2 = number_format(($importe_devolucion_2 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2);
            $porcentaje_reduccion_impuestos_3 = number_format(($importe_devolucion_3 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2);
            $porcentaje_reduccion_impuestos_4 = number_format(($importe_devolucion_4 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2);
            $porcentaje_reduccion_impuestos_5 = number_format(($importe_devolucion_5 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2);
            $porcentaje_reduccion_impuestos_6 = number_format(($importe_devolucion_6 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2);
            $porcentaje_reduccion_impuestos_7 = number_format(($importe_devolucion_7 / ($impuesto_anual_real_cajuste_1 + 0.0000001)) * 100, 2);
            //este
            //
            $impuesto_real_pagado_1_money = $importe_devolucion_1 - $impuesto_anual_real_cajuste_1;
            $impuesto_real_pagado_1_porce = 100 - $porcentaje_reduccion_impuestos_1;
            $impuesto_real_pagado_2_money = $importe_devolucion_2 - $impuesto_anual_real_cajuste_1;
            $impuesto_real_pagado_2_porce = 100 - $porcentaje_reduccion_impuestos_2;
            $impuesto_real_pagado_3_money = $importe_devolucion_3 - $impuesto_anual_real_cajuste_1;
            $impuesto_real_pagado_3_porce = 100 - $porcentaje_reduccion_impuestos_3;
            $impuesto_real_pagado_4_money = $importe_devolucion_4 - $impuesto_anual_real_cajuste_1;
            $impuesto_real_pagado_4_porce = 100 - $porcentaje_reduccion_impuestos_4;
            $impuesto_real_pagado_5_money = $importe_devolucion_5 - $impuesto_anual_real_cajuste_1;
            $impuesto_real_pagado_5_porce = 100 - $porcentaje_reduccion_impuestos_5;
            $impuesto_real_pagado_6_money = $importe_devolucion_6 - $impuesto_anual_real_cajuste_1;
            $impuesto_real_pagado_6_porce = 100 - $porcentaje_reduccion_impuestos_6;
            $impuesto_real_pagado_7_money = $importe_devolucion_7 - $impuesto_anual_real_cajuste_1;
            $impuesto_real_pagado_7_porce = 100 - $porcentaje_reduccion_impuestos_7;
            //este
            //
            date_default_timezone_set("America/Mexico_City");
            $impresion_fecha = date("Y-m-d h:i:sa");
            $usuario_global = $_GET['name'];
            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>
<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Ajuste Anual PDI Completo</font></b></p></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td><b>Fecha de cálculo: </b></td>
<td>' . $impresion_fecha . '</td>
</tr>
<tr>
<td><b>Realizado para: </b></td>
<td>' . $usuario_global . '</td>
</tr>
</table>
<br>
<table>
<tr>
<td align="center"><b>%</b></td>
<td align="center"><b>Nivel</b></td>
<td align="center"><b>Ingresos Desde</b></td>
<td align="center"><b>Ingresos Hasta</b></td>
<td align="center"><b>Retención de ISR</b></td>
<td align="center"><b>Ajuste Anual</b></td>
<td align="center"><b>Impuesto anual real con ajuste</b></td>
<td align="center"><b>Total deducciones autorizadas con tope</b></td>
<td align="center"><b>Importe Devolución</b></td>
<td align="center"><b>Total Devoluciones</b></td>
<td align="center"><b>Porcentaje devoluciones personales</b></td>
<td align="center"><b>Porcentaje de reducción de impuestos</b></td>
<td align="center"><b>Impuesto real pagado después de devoluciones $</b></td>
<td align="center"><b>Impuesto real pagado después de devoluciones %</b></td>
</tr>

<tr>
<td>Manual</td>
<td>' . $nivel_tabla_1 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>' . number_format($ajuste_anual_1, 2) . '</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format((float)$deducciones_autorizadas, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_1), 2) . '</td>
<td>' . number_format($total_devoluciones_1, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_1) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_1 . '%</td>
<td>' . number_format($impuesto_real_pagado_1_money, 2) . '</td>
<td>' . $impuesto_real_pagado_1_porce . '%</td>
</tr>

<tr>
<td>2%</td>
<td>' . $nivel_tabla_2 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>' . number_format($ajuste_anual_1, 2) . '</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_2, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_2), 2) . '</td>
<td>' . number_format($total_devoluciones_2, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_2) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_2 . '%</td>
<td>' . number_format($impuesto_real_pagado_2_money, 2) . '</td>
<td>' . $impuesto_real_pagado_2_porce . '%</td>
</tr>

<tr>
<td>4%</td>
<td>' . $nivel_tabla_3 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>' . number_format($ajuste_anual_1, 2) . '</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_3, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_3), 2) . '</td>
<td>' . number_format($total_devoluciones_3, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_3) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_3 . '%</td>
<td>' . number_format($impuesto_real_pagado_3_money, 2) . '</td>
<td>' . $impuesto_real_pagado_3_porce . '%</td>
</tr>

<tr>
<td>6%</td>
<td>' . $nivel_tabla_4 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>' . number_format($ajuste_anual_1, 2) . '</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_4, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_4), 2) . '</td>
<td>' . number_format($total_devoluciones_4, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_4) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_4 . '%</td>
<td>' . number_format($impuesto_real_pagado_4_money, 2) . '</td>
<td>' . $impuesto_real_pagado_4_porce . '%</td>
</tr>

<tr>
<td>8%</td>
<td>' . $nivel_tabla_5 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>' . number_format($ajuste_anual_1, 2) . '</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_5, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_5), 2) . '</td>
<td>' . number_format($total_devoluciones_5, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_5) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_5 . '%</td>
<td>' . number_format($impuesto_real_pagado_5_money, 2) . '</td>
<td>' . $impuesto_real_pagado_5_porce . '%</td>
</tr>

<tr>
<td>10%</td>
<td>' . $nivel_tabla_6 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>' . number_format($ajuste_anual_1, 2) . '</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_6, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_6), 2) . '</td>
<td>' . number_format($total_devoluciones_6, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_6) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_6 . '%</td>
<td>' . number_format($impuesto_real_pagado_6_money, 2) . '</td>
<td>' . $impuesto_real_pagado_6_porce . '%</td>
</tr>

<tr>
<td>15%</td>
<td>' . $nivel_tabla_7 . '</td>
<td>0.00</td>
<td>' . number_format($ingreso_gravable, 2) . '</td>
<td>' . number_format($isr_retenido, 2) . '</td>
<td>' . number_format($ajuste_anual_1, 2) . '</td>
<td>' . number_format(abs($impuesto_anual_real_cajuste_1), 2) . '</td>
<td>' . number_format($deducciones_autorizadas_7, 2) . '</td>
<td>' . number_format(abs($importe_devolucion_7), 2) . '</td>
<td>' . number_format($total_devoluciones_7, 2) . '</td>
<td>' . abs($porcentaje_devoluciones_p_7) . '%</td>
<td>' . $porcentaje_reduccion_impuestos_7 . '%</td>
<td>' . number_format($impuesto_real_pagado_7_money, 2) . '</td>
<td>' . $impuesto_real_pagado_7_porce . '%</td>
</tr>

 </table>

</div>';

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('pdf_pdi_completo_proyeccion.pdf', 'I');
        }
    }
    public function pdfTablasIa()
    {
        require resource_path('views/config.php');


        $YEAR_PDF = $_GET['year'];
        $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF' order by var1 asc limit 12");
        $c = 0;
        while ($datos4 = mysqli_fetch_array($resp4)) {
            $c = $c + 1;
            $com3[$c][1] = number_format($datos4['var1'], 2);
            $com3[$c][2] = number_format($datos4['var2'], 2);
            $com3[$c][3] = number_format($datos4['var3'], 2);
            $com3[$c][4] = number_format($datos4['var4'], 2);
        }

        $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>

<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Tablas de Impuestos</font></b></p></td>
</tr>
</table>
<br>


  <table border="0" width="60%">
 <tr>
  <td colspan="4" align="center">
<div align="center"><strong>Tabla Impuesto ISR</strong></div>
  </td>
 </tr>
  <tr>
  <td>
<div align="center" width="25%"><b>Límite Inferior</b></div>
  </td>
  <td>
<div align="center" width="25%"><b>Límite Superior</b></div>
  </td>
  <td>
<div align="center" width="25%"><b>Cuota Fija</b></div>
  </td>
  <td>
<div align="center" width="25%"><b>% Para aplicarse s/excedente del límite inferior</b></div>
  </td>
 </tr>

 <tr>
  <td>
<div align="center">$' . $com3[1][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[1][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[1][3] . '</div>
  </td>
<td align="center">
' . $com3[1][4] . '%
  </td>
 </tr>

  <tr>
  <td>
<div align="center">$' . $com3[2][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[2][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[2][3] . '</div>
  </td>
<td align="center">
' . $com3[2][4] . '%
  </td>
 </tr>

   <tr>
  <td>
<div align="center">$' . $com3[3][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[3][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[3][3] . '</div>
  </td>
<td align="center">
' . $com3[3][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[4][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[4][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[4][3] . '</div>
  </td>
<td align="center">
' . $com3[4][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[5][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[5][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[5][3] . '</div>
  </td>
<td align="center">
' . $com3[5][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[6][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[6][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[6][3] . '</div>
  </td>
<td align="center">
' . $com3[6][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[7][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[7][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[7][3] . '</div>
  </td>
<td align="center">
' . $com3[7][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[8][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[8][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[8][3] . '</div>
  </td>
<td align="center">
' . $com3[8][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[9][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[9][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[9][3] . '</div>
  </td>
<td align="center">
' . $com3[9][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[10][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[10][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[10][3] . '</div>
  </td>
<td align="center">
' . $com3[10][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[11][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[11][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[11][3] . '</div>
  </td>
<td align="center">
' . $com3[11][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[12][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[12][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[12][3] . '</div>
  </td>
<td align="center">
' . $com3[12][4] . '%
  </td>
 </tr>
</table>


</div>';

        $mpdf = new mPDF();
        $mpdf->SetHeader('{PAGENO}');
        $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
        $mpdf->WriteHTML($html);
        $mpdf->Output('pdf_tablas_sueldos_y_salarios_siisarh.pdf', 'I');
    }

    public function pdfImpuestoAnual()
    {
        require resource_path('views/config.php');
        function impuesto_anual($var1, $var2, $var3, $var4, $var5, $var6)
        {
            require resource_path('views/config.php');
            $YEAR_PDF = $_GET['year'];
            $ingreso_gravable = $var1;
            $deducciones_autorizadas = $var2;
            $isr_retenido = $var3;
            $subsidio_empleo = $var4;
            $subsidio_total = $var5;

            $fecha = time();

            $ingreso_gravable_total = $ingreso_gravable - $deducciones_autorizadas;

            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];

            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;

            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];

            $impuesto_marginal = ($importe_excedente_li * $porcentaje_p_aplicarse) / 100;

            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'];

            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;

            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;

            $c1 = round(abs($impuesto_anual_total + $subsidio_empleo - $isr_retenido), 0);
            return $c1;
        }

        if (isset($_GET['var1']) and isset($_GET['var2']) and isset($_GET['var3']) and isset($_GET['var4']) and isset($_GET['var5'])) {
            $YEAR_PDF = $_GET['year'];
            if ($_GET['year'] == 2016) { //Actualizado 21 Febrero 2022: se agregaron las leyendas de todos los años
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2016, publicada en el DOF el 12 de Enero de 2016.";
            } elseif ($_GET['year'] == 2017) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2017, publicada en el DOF el 5 de Enero de 2017.";
            } elseif ($_GET['year'] == 2018) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2018, publicada en el DOF el 29 de Diciembre de 2017.";
            } elseif ($_GET['year'] == 2019) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2019, publicada en el DOF el 24 de Diciembre de 2018.";
            } elseif ($_GET['year'] == 2020) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2020, publicada en el DOF el 9 de Enero de 2020.";
            } elseif ($_GET['year'] == 2021) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2021, publicada en el DOF el 29 de Diciembre de 2020.";
            } elseif ($_GET['year'] == 2022) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2022, publicada en el DOF el 27 de Diciembre de 2021.";
            } elseif ($_GET['year'] == 2023) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2023, publicada en el DOF el 27 de Diciembre de 2022.";
            } elseif ($_GET['year'] == 2024) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2024, publicada en el DOF el 29 de Diciembre de 2023.";
            } elseif ($_GET['year'] == 2025) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2025, publicada en el DOF el 30 de Diciembre de 2024.";
            }


            $impresion_fecha = date("Y-m-d h:i:sa");
            $tipo_calculo = "Impuesto Anual";
            $usuario_global = $_GET['name'];

            $ingreso_gravable = $_GET['var1'];
            $deducciones_autorizadas = $_GET['var2'];
            $isr_retenido = $_GET['var3'];
            $subsidio_empleo = $_GET['var4'];
            $subsidio_total = $_GET['var5'];

            $ingreso_gravable_total = (float)$ingreso_gravable - (float)$deducciones_autorizadas;

            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'] ?? 0;

            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;

            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'] ?? 0;

            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100; //se agrega elk segundo /100

            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$ingreso_gravable_total' order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos1['var3'] ?? 0;

            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;

            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;

            $cal_flag = impuesto_anual($ingreso_gravable, 0, $isr_retenido, $subsidio_empleo, $subsidio_total, $YEAR_PDF);

            if ($_GET['flag'] == 1) {
                $c1 = round(($impuesto_anual_total + $subsidio_empleo - $isr_retenido) - $cal_flag, 0);
            } else {
                $c1 = round(($impuesto_anual_total + $subsidio_empleo - $isr_retenido), 0);
            }




            if ($c1 > 0) {
                $bar1 = "ISR A CARGO";
            } else {
                $bar1 = "ISR A FAVOR";
            }

            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>
<br>

<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Cálculo de ISR del Impuesto Anual<br>Artículo 152 de la Ley del ISR</font></b></p></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td width="20%"><b>Fecha de cálculo: </b></td>
<td width="80%">' . $impresion_fecha . '</td>
</tr>
<tr>
<td width="20%"><b>Tipo de cálculo: </b></td>
<td width="80%">' . $tipo_calculo . '</td>
</tr>
<tr>
<td width="20%"><b>Realizado para: </b></td>
<td width="80%">' . $usuario_global . '</td>
</tr>
</table>
<br>
<div align="justify"><font size="2">
Art. 152 Las personas físicas calcularán el impuesto del ejercicio sumando, a los ingresos obtenidos conforme a los Capítulos I, III, IV, V, VI, VIII y IX de este Título,
después de efectuar las deducciones autorizadas en dichos capítulos, la utilidad gravable determinada conforme a las Secciones I o II del Capítulo II de este Título,
al resultado obtenido se le disminuirá, en su caso, las deducciones a que se refiere el artículo 151 de esta Ley. A la cantidad que se obtenga se le aplicará la
siguiente:
</font></div>


<br>
<table border="0"><tr><td><strong>Datos para el cálculo</strong></td></tr></table>
<div style="overflow-x:auto;">
  <table>
<tr>
<td width="70%">Nota: Esta Información es capturada de su Constancia de Declaración Informativa de Sueldos y Salarios. (Forma 37)</td>
<td width="15%"></td>
<td width="15%"></td>
</tr>

<tr>
<td>Ingreso Gravable</td>
<td></td>
<td align="right">$' . number_format($ingreso_gravable, 2) . '</td>
</tr>

<tr>
<td>Deducciones Autorizadas</td>
<td><b>-</b></td>
<td align="right">$' . number_format((float)$deducciones_autorizadas, 2) . '<hr></td>
</tr>

<tr>
<td>ISR Retenido en el Año</td>
<td><b>=</b></td>
<td align="right">$' . number_format($isr_retenido, 2) . '<hr></td>
</tr>

<tr>
<td>Subsidio para el Empleo Pagado</td>
<td><b>=</b></td>
<td align="right">$' . number_format($subsidio_empleo, 2) . '<hr></td>
</tr>

<tr>
<td>Subsidio para el Empleo Total Aplicado</td>
<td><b>=</b></td>
<td align="right">$' . number_format($subsidio_total, 2) . '<hr></td>
</tr>

</table>
<br>
<table border="0"><tr><td><strong>Desarrollo del Cálculo del ISR:</strong></td></tr></table>
<div style="overflow-x:auto;">
  <table>
<tr>
<td width="70%">Ingreso Gravable Total ( Ingreso Gravable - Deducciones Autorizadas ) | $' . number_format($ingreso_gravable ?? 0, 2) . ' - $' . number_format($deducciones_autorizadas2 ?? 0) . '</td>
<td width="15%"><b>=</b></td>
<td width="15%" align="right">$' . number_format($ingreso_gravable_total, 2) . '</td>
</tr>

<tr>
<td>Límite Inferior</td>
<td><b>-</b></td>
<td align="right">$' . number_format($limite_inferior, 2) . '<hr></td>
</tr>

<tr>
<td>Importe Excedente al Límite Inferior</td>
<td><b>=</b></td>
<td align="right">$' . number_format($importe_excedente_li, 2) . '</div></td>
</tr>

<tr>
<td>(%) para aplicar sobre excedente</td>
<td><b>x</b></td>
<td align="right">' . number_format($porcentaje_p_aplicarse, 2) . '%<hr></td>
</tr>

<tr>
<td>Impuesto Marginal</td>
<td><b>=</b></td>
<td align="right">$' . number_format($impuesto_marginal, 2) . '</td>
</tr>

<tr>
<td>Cuota fija</td>
<td><b>+</b></td>
<td align="right">$' . number_format($cuota_fija, 2) . '<hr></td>
</tr>

<tr>
<td>Impuesto Calculado</td>
<td><b>=</b></td>
<td align="right">$' . number_format($impuesto_anual_calculado, 2) . '</td>
</tr>

<tr>
<td>Impuesto Anual Total ( Impuesto Calculado - Subsidio para el Empleo total Aplicado ) | $' . number_format($impuesto_anual_calculado, 2) . ' - $' . number_format($subsidio_total, 2) . '</td>
<td><b>=</b></td>
<td align="right">$' . number_format($impuesto_anual_total, 2) . '<hr></td>
</tr>

<tr>
<td><b>' . $bar1 . ' (Imp. Anual Total + Sub p/Empleo Pagado - ISR Ret. en el Año) | $' . number_format($impuesto_anual_total, 2) . ' + $' . number_format($subsidio_empleo, 2) . ' - $' . number_format($isr_retenido, 2) . '</b></td>
<td><b>=</b></td>
<td align="right">$' . number_format(abs($c1), 2) . '<hr></td>
</tr>

</table>
<br><br><br><br><br><br><br><br>
<table width="100%" summary="" border="0">
<tr>
<td align="center"><b>Tablas de impuestos utilizadas</b></td>
</tr>
</table>

<table width="100%" summary="" border="0">
<tr>
<td width="50%" valign="top">
Tabla de ISR Anual<br>
Art. 152 LISR*
<table width="100%" summary="" border="0">
<tr>
<td>Límite inferior: </td>
<td align="right">' . number_format($datos1['var1'] ?? 0, 2) . '</td>
</tr>
<tr>
<td>Límite Superior: </td>
<td align="right">' . number_format($datos1['var2'] ?? 0, 2) . '</td>
</tr>
<tr>
<td>% Sobre Exc. L.I.: </td>
<td align="right">' . number_format($datos1['var4'] ?? 0, 2) . '</td>
</tr>
<tr>
<td>Cuota Fija</td>
<td align="right">' . number_format($datos1['var3'] ?? 0, 2) . '</td>
</tr>
</table>


</td>
</tr>
</table>

<br>

<font size="1">' . $leyenda . '</font>
<br><br>
<font size="1">* Calculo realizado sin tomar en cuenta el tope de Previsión Social.</font>
<br><br>
<table>
  <tr>
  <td valign="top"><font size="2">Fundamentos legales: </font></td>
  <td valign="top">
<font size="2">
Ley del Impuesto Sobre la Renta Art. 96, 97, 98, 99, 150, 151 y 152<br>
Código Fiscal de la Federación Art. 17-A
</font>
  </td>
  </tr>
  </table>


</div>';

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('pdf_impuesto_anual_siisarh.pdf', 'I');
        }
    }
    public function pdfHonorarios()
    {
        require resource_path('views/config.php');

        if (isset($_GET['pdf']) and isset($_GET['monto']) and isset($_GET['tipo'])) {

            date_default_timezone_set("America/Mexico_City");

            $impresion_fecha = date("Y-m-d h:i:sa");

            if ($_GET['tipo'] == 0) {
                $tipo_calculo = "Neto";
            } else {
                $tipo_calculo = "Bruto";
            }

            $usuario_global = $_GET['name'];

            $calculox1 = $_GET['monto'];



            $cal1 = round($calculox1 * 0.16, 2);
            $cal2 = $calculox1 + $cal1;

            $cal3 = round($cal2, 2);


            $cal4 = round($calculox1 * 0.10, 2);
            $cal5 = round($cal1 * 0.666667, 2);
            $cal6 = $cal3 - $cal4 - $cal5;
            $cal7 = round($cal6, 2);

            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>
<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Cálculo de ISR por HONORARIOS<br>Artículo 106 de la Ley del ISR</font></b></p></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td width="20%"><b>Fecha de cálculo: </b></td>
<td width="80%">' . $impresion_fecha . '</td>
</tr>
<tr>
<td width="20%"><b>Tipo de cálculo: </b></td>
<td width="80%">' . $tipo_calculo . '</td>
</tr>
<tr>
<td width="20%"><b>Realizado para: </b></td>
<td width="80%">' . $usuario_global . '</td>
</tr>
</table>
<br>
<div align="justify"><font size="2">
Art. 106. Ultimo Párrafo: Cuando los contribuyentes presten servicios profesionales a las personas morales, éstas deberán retener, como pago provisional, el monto
que resulte de aplicar la tasa del 10% sobre el monto de los
pagos que les efectúen, sin deducción alguna, debiendo proporcionar a los contribuyentes comprobante fiscal y constancia de la retención las cuales deberán
enterarse, en su caso, conjuntamente con las señaladas en el artículo 96 de esta Ley. El impuesto retenido en los términos de este párrafo será acreditable contra el
impuesto a pagar que resulte en los pagos provisionales de conformidad con este artículo.
</font></div>
<br>
<table border="0"><tr><td><strong>Datos para el cálculo</strong></td></tr></table>
<div style="overflow-x:auto;">
  <table>
<tr>
<td width="70%">Importe ' . $tipo_calculo . '</td>
<td width="15%"></td>
<td width="15%" align="right">' . number_format($calculox1, 2) . '</td>
</tr>
</table>
<br><br>
<table border="0"><tr><td><strong>Desarrollo del Cálculo del ISR:</strong></td></tr></table>
<div style="overflow-x:auto;">
  <table>

<tr>
<td width="70%">IVA Trasladado (Importe Bruto x 16%) | $' . number_format($calculox1, 2) . ' x 16%</td>
<td width="15%"><b>+</b></td>
<td width="15%" align="right">' . number_format($cal1, 2) . '<hr></td>
</tr>

<tr>
<td>Subtotal</td>
<td><b>=</b></td>
<td align="right">' . number_format($cal3, 2) . '</td>
</tr>

<tr>
<td>Retención de ISR (Importe Bruto x 10%) | $' . number_format($calculox1, 2) . ' x 10%</td>
<td><b>-</b></td>
<td align="right">' . number_format($cal4, 2) . '</td>
</tr>

<tr>
<td>IVA Retenido 2/3 partes (IVA Trasladado / 3 x 2) | $' . number_format($cal1, 2) . ' / 3x2</td>
<td><b>-</b></td>
<td align="right">' . number_format($cal5, 2) . '</td>
</tr>

<tr>
<td><b>Total</b></td>
<td><b>=</b></td>
<td align="right">' . number_format($cal7, 2) . '<hr></td>
</tr>

</table>
<br><br><br><br><br><br>
  <table>
  <tr>
  <td valign="top"><font size="2">Fundamentos legales: </font></td>
  <td valign="top">
<font size="2">
Ley del Impuesto Sobre la Renta Art. 106 Ultimo párrafo<br>
Ley del Impuesto al Valor Agregado Art 1, 2, y 8vo Transitorio, fracción III.<br>
Reglamento de la Ley del Impuesto al Valor Agregado Art. 3<br>
Código Fiscal de la Federación Art. 17-A</font>
  </td>
  </tr>
  </table>

</div>';

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('pdf_honorarios(' . $tipo_calculo . ')_siisarh.pdf', 'I');
        }
    }
    public function pdfAsimiladosSalarios()
    {
        require resource_path('views/config.php');


        if (isset($_GET['tipo']) and isset($_GET['pdf']) and isset($_GET['dias']) and isset($_GET['faltas']) and isset($_GET['ingresos'])) {
            $GLOBAL_SYSTEM_YEAR = $_COOKIE['year_x1'];
            if ($_GET['year'] == 2016) { //Actualizado 21 Febrero 2022: se agregaron las leyendas de todos los años
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2016, publicada en el DOF el 12 de Enero de 2016.";
            } elseif ($_GET['year'] == 2017) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2017, publicada en el DOF el 5 de Enero de 2017.";
            } elseif ($_GET['year'] == 2018) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2018, publicada en el DOF el 29 de Diciembre de 2017.";
            } elseif ($_GET['year'] == 2019) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2019, publicada en el DOF el 24 de Diciembre de 2018.";
            } elseif ($_GET['year'] == 2020) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2020, publicada en el DOF el 9 de Enero de 2020.";
            } elseif ($_GET['year'] == 2021) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2021, publicada en el DOF el 29 de Diciembre de 2020.";
            } elseif ($_GET['year'] == 2022) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2022, publicada en el DOF el 27 de Diciembre de 2021.";
            } elseif ($_GET['year'] == 2023) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2023, publicada en el DOF el 27 de Diciembre de 2022.";
            } elseif ($_GET['year'] == 2024) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2024, publicada en el DOF el 29 de Diciembre de 2023.";
            } elseif ($_GET['year'] == 2025) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2025, publicada en el DOF el 30 de Diciembre de 2024.";
            }

            date_default_timezone_set("America/Mexico_City");

            $impresion_fecha = date("Y-m-d h:i:sa");

            if ($_GET['tipo'] == "overwritten") {
                $tipo_calculo = "Inverso";
            } else {
                $tipo_calculo = "Ordinario";
            }

            $usuario_global = $_GET['name'];

            $dias = $_GET['dias'];
            $faltas = $_GET['faltas'];
            $ingresos = $_GET['ingresos'];
            $total1 = $dias - $faltas;

            $resp24 = mysqli_query($conectar, "select * from tablas_calculo where year='$GLOBAL_SYSTEM_YEAR' and nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and
dias_trabajados='$total1' and var1 between '0' and '$ingresos' order by var1 desc limit 1");
            $datos24 = mysqli_fetch_array($resp24);

            $cal1 = $ingresos - $datos24['var1'];

            $resp25 = mysqli_query($conectar, "select * from tablas_calculo where year='$GLOBAL_SYSTEM_YEAR' and nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and
dias_trabajados='$total1' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
            $datos25 = mysqli_fetch_array($resp25);

            $cal2 = $cal1 * $datos25['var4'];
            $cal3 = $cal2 / 100;

            $resp26 = mysqli_query($conectar, "select * from tablas_calculo where year='$GLOBAL_SYSTEM_YEAR' and nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and
dias_trabajados='$total1' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
            $datos26 = mysqli_fetch_array($resp26);

            $cal4 = $cal3 + $datos26['var3'];

            $resp27 = mysqli_query($conectar, "select * from tablas_calculo where year='$GLOBAL_SYSTEM_YEAR' and nombre_tabla='TABLA SUBSIDIO VARIABLE' and
dias_trabajados='$total1' and var1 between '0' and '$ingresos' and var1 != 0 order by var3 asc limit 1");
            $datos27 = mysqli_fetch_array($resp27);

            if ($_GET['var44'] == 0) {
                $valx_1 = $datos27['var3'];
            } else {
                $valx_1 = "0.00";
            }

            if ($_GET['var44'] == 0) {
                $cal5 = $cal4 - $datos27['var3'];
            } else {
                $cal5 = $cal4;
            }
            if ($cal5 > 0) {
                $valx_2 = "<b>ISR DETERMINADO</b>";
            } else {
                $valx_2 = "<b>SUBSIDIO DETERMINADO</b>";
            }

            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>
<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Cálculo de ISR por Asimilados a Salarios<br>Artículo 96 de la Ley del ISR</font></b></p></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td><b>Fecha de cálculo: </b></td>
<td>' . $impresion_fecha . '</td>
</tr>
<tr>
<td><b>Tipo de cálculo: </b></td>
<td>' . $tipo_calculo . '</td>
</tr>
<tr>
<td><b>Realizado para: </b></td>
<td>' . $usuario_global . '</td>
</tr>
</table>
<br>
<div align="justify"><font size="2">Artículo 96: Quienes hagan pago por los conceptos a que se refiere este capítulo están oblgados a efectuar retenciones y enteros mensuales que tendrán el carácter de pagos provisionales a cuenta del impuesto anual. No se efectuará retención a las personas que en el mes únicamente perciban un salario mínimo general correspondiente al área geográfica del contribuyente. La retención se calculará aplicando a la totalidad de los ingresos obtenidos en un mes de calendario, la siguiente:</font></div>
<br>

<table width="100%" summary="" border="0">
<tr>
<td align="center"><b>Datos para el cálculo</b></td>
</tr>
</table>

<table width="100%" summary="" border="0">
<tr>
<td>Días Laborados: </td>
<td></td>
<td align="right">' . $dias . '</td>
</tr>
<tr>
<td><b>Ingresos Gravable: </b></td>
<td></td>
<td align="right"><b>$' . number_format($ingresos, 2) . '</b></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center"><b>Desarrollo del Cálculo del ISR</b></td>
</tr>
</table>

<table width="100%" summary="" border="0">

<tr>
<td>Límite Inferior</td>
<td><b>-</b></td>
<td align="right">
' . number_format($datos24['var1'], 2) . '
<br><hr>
</td>
</tr>

<tr>
<td>Importe excedente al limite inferior</td>
<td><b>=</b></td>
<td align="right">
' . number_format($cal1, 2) . '
</td>
</tr>

<tr>
<td>(%) para aplicar sobre el excedente</td>
<td><b>x</b></td>
<td align="right">
' . $datos25['var4'] . '
<br><hr>
</td>
</tr>

<tr>
<td>Impuesto Marginal</td>
<td><b>=</b></td>
<td align="right">
' . number_format(round($cal3, 2), 2) . '
</td>
</tr>

<tr>
<td>Cuota Fija</td>
<td><b>+</b></td>
<td align="right">
' . number_format($datos26['var3'], 2) . '
<br><hr>
</td>
</tr>

<tr>
<td>Impuesto calculado</td>
<td><b>=</b></td>
<td align="right">
' . number_format(round($cal4, 2), 2) . '
</td>
</tr>

<tr>
<td>Subsidio para el Empleo</td>
<td><b>-</b></td>
<td align="right">
' . $valx_1 . '
</td>
</tr>

<tr>
<td align="right">
' . $valx_2 . '
</td>
<td><b>=</b></td>
<td align="right">
<b>' . number_format(abs(round($cal5, 2)), 2) . '
</b>
<hr>
</td>
</tr>
</table>

<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center"><b>Tablas de impuestos utilizadas</b></td>
</tr>
</table>

<table width="100%" summary="" border="0">
<tr>
<td width="50%" valign="top">
(1) Tabla de ISR Mensual, proporcional a Días Laborados Reales<br>
Art. 96 LISR*<br>

<table width="100%" summary="" border="0">
<tr>
<td>Límite inferior: </td>
<td align="right">' . number_format($datos24['var1'], 2) . '</td>
</tr>
<tr>
<td>Límite Superior: </td>
<td align="right">' . number_format($datos24['var2'], 2) . '</td>
</tr>
<tr>
<td>% Sobre Exc. L.I.: </td>
<td align="right">' . number_format($datos24['var4'], 2) . '</td>
</tr>
<tr>
<td>Cuota Fija</td>
<td align="right">' . number_format($datos24['var3'], 2) . '</td>
</tr>
</table>


</td>
<td width="50%" valign="top">


Tabla de Subsidio Mensual, proporcional a Días Laborados Reales<br>
Art. 10 Transitorio de la LISR, Subsidio para el empleo*<br>

<table width="100%" summary="" border="0">
<tr>
<td>Límite inferior: </td>
<td align="right">' . number_format($datos27['var1'], 2) . '</td>
</tr>
<tr>
<td>Límite Superior: </td>
<td align="right">' . number_format($datos27['var2'], 2) . '</td>
</tr>
<tr>
<td>Subsidio para el empleo: </td>
<td align="right">' . number_format($datos27['var3'], 2) . '</td>
</tr>
</table>


</td>
</tr>
</table>
<br>
<div align="justify"><font size="1">' . $leyenda . '<br><br>
Fundamentos Legales: Ley del Impuesto Sobre la Renta Art. 93, 94, 95, 96 y 10mo Transitorio<br>Código Fiscal de la Federación Art. 17-A
</font></div>
</div>';

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('pdf_asimilados_salarios(' . $tipo_calculo . ')_siisarh.pdf', 'I');
        }
    }
    public function pdfTablasOtrasR()
    {
        require resource_path('views/config.php');

        if (isset($_GET['tablas']) and isset($_GET['var2']) and isset($_GET['var3']) and isset($_GET['var4'])) {

            $pre_var1 = $_GET['tablas'];
            $pre_var2 = $_GET['var2'];
            $pre_var3 = $_GET['var3'];
            $YEAR_PDF = $_GET['year'];
            $var1 = $pre_var1 + $pre_var2;

            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li1 = $var1 - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            $c1 = $importe_excedente_li1 * $porcentaje_p_aplicarse;
            $c2 = $c1 / 100;
            $impuesto_marginal1 = $c2;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos3['var3'];
            //tabla subsidio
            $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
            $datos4 = mysqli_fetch_array($resp4);
            if ($_GET['var4'] == 0) {
                $c31 = $datos4['var3'];
            } else {
                $c31 = "0.00";
            }
            //fin tabla subsidio
            $isr_calculado1 = $impuesto_marginal1 + $cuota_fija;
            if ($_GET['var4'] == 0) {
                $cal51 = $isr_calculado1 - $c31;
            } else {
                $cal51 = $isr_calculado1;
            }
            $cal51; //falta subsidio para empleo

            if ($cal51 > 0) {
                $bar1 = "<b>ISR DETERMINADO</b>";
            } else {
                $bar1 = "<b>SUBSIDIO DETERMINADO</b>";
            }

            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$pre_var1' order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li2 = $pre_var1 - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$pre_var1' order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            $c1 = $importe_excedente_li2 * $porcentaje_p_aplicarse;
            $c2 = $c1 / 100;
            $impuesto_marginal2 = $c2;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$pre_var1' order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos3['var3'];
            //tabla subsidio
            $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$pre_var1' order by var4 desc limit 1");
            $datos4 = mysqli_fetch_array($resp4);
            if ($_GET['var4'] == 0) {
                $c32 = $datos4['var3'];
            } else {
                $c32 = "0.00";
            }
            //fin tabla subsidio
            $isr_calculado2 = $impuesto_marginal2 + $cuota_fija;
            if ($_GET['var4'] == 0) {
                $cal52 = $isr_calculado2 - $c32;
            } else {
                $cal52 = $isr_calculado2;
            }
            $cal52; //falta subsidio para empleo

            if ($cal52 > 0) {
                $bar2 = "<b>ISR DETERMINADO</b>";
            } else {
                $bar2 = "<b>SUBSIDIO DETERMINADO</b>";
            }

            $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF' order by var1 asc limit 12");
            $c = 0;
            while ($datos4 = mysqli_fetch_array($resp4)) {
                $c = $c + 1;
                $com3[$c][1] = number_format($datos4['var1'], 2);
                $com3[$c][2] = number_format($datos4['var2'], 2);
                $com3[$c][3] = number_format($datos4['var3'], 2);
                $com3[$c][4] = number_format($datos4['var4'], 2);
            }


            $resp5 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$YEAR_PDF' order by var1 asc limit 12");
            $d = 0;
            while ($datos5 = mysqli_fetch_array($resp5)) {
                $d = $d + 1;
                $com4[$d][1] = number_format($datos5['var1'], 2);
                $com4[$d][2] = number_format($datos5['var2'], 2);
                $com4[$d][3] = number_format($datos5['var3'], 2);
                $com4[$d][4] = number_format($datos5['var4'], 2);
            }

            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>

<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Tablas de cálculo para Otras Remuneraciones</font></b></p></td>
</tr>
</table>
<br>

 <table border="0" width="100%">
 <tr>
 <td width="50%" valign="top">
  <table border="0">
 <tr>
  <td colspan="4" align="center">

  <table>

  <tr><td><strong>Cálculo del ISR sobre SMO + PMG</strong></td></tr>

<tr>
<td>SMO + PMG <font size="1"><i>(' . number_format($pre_var1, 2) . ' + PMG $' . number_format($pre_var2, 2) . ' = SMO + PMG $' . number_format($var1, 2) . ')</i></font></td>
<td></td>
<td><div align="right">$' . number_format($var1, 2) . '</div></td>
</tr>

<tr>
<td>Límite Inferior</td>
<td>-</td>
<td><div align="right">$' . number_format($limite_inferior, 2) . '<hr></div></td>
</tr>

<tr>
<td>Importe Excedente al Límite Inferior</td>
<td>=</td>
<td><div align="right">$' . number_format($importe_excedente_li1, 2) . '</div></td>
</tr>

<tr>
<td>(%) para aplicar sobre el Excedente</td>
<td>x</td>
<td><div align="right">' . number_format($porcentaje_p_aplicarse, 2) . '%</div><hr></td>
</tr>

<tr>
<td>Impuesto Marginal</td>
<td>=</td>
<td><div align="right">$' . number_format($impuesto_marginal1, 2) . '</div></td>
</tr>

<tr>
<td>Cuota Fija</td>
<td>+</td>
<td><div align="right">$' . number_format($cuota_fija, 2) . '</div><hr></td>
</tr>

<tr>
<td>Impuesto Calculado</td>
<td>=</td>
<td><div align="right">$' . number_format($isr_calculado1, 2) . '</div></td>
</tr>

<tr>
<td>Subsidio para el Empleo</td>
<td>-</td>
<td><div align="right">$' . number_format($c31, 2) . '</div></td>
</tr>

<tr>
<td><b>
' . $bar1 . '
</b></td>
<td><b>=</b></td>
<td><b><div align="right">$' . number_format($cal51, 2) . '</div></b></td>
</tr>

</table>
<br><br>
  <table border="0">
 <tr>
  <td colspan="4" align="center">
<div align="center"><strong>Tabla Impuesto ISR</strong></div>
  </td>
 </tr>
  <tr>
  <td>
<div align="center"><b>Límite Inferior</b></div>
  </td>
  <td>
<div align="center"><b>Límite Superior</b></div>
  </td>
  <td>
<div align="center"><b>Cuota Fija</b></div>
  </td>
  <td>
<div align="center"><b>% Para aplicarse s/excedente del límite inferior</b></div>
  </td>
 </tr>

 <tr>
  <td>
<div align="center">$' . $com3[1][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[1][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[1][3] . '</div>
  </td>
<td align="right">
' . $com3[1][4] . '%
  </td>
 </tr>

  <tr>
  <td>
<div align="center">$' . $com3[2][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[2][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[2][3] . '</div>
  </td>
<td align="right">
' . $com3[2][4] . '%
  </td>
 </tr>

   <tr>
  <td>
<div align="center">$' . $com3[3][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[3][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[3][3] . '</div>
  </td>
<td align="right">
' . $com3[3][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[4][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[4][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[4][3] . '</div>
  </td>
<td align="right">
' . $com3[4][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[5][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[5][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[5][3] . '</div>
  </td>
<td align="right">
' . $com3[5][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[6][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[6][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[6][3] . '</div>
  </td>
<td align="right">
' . $com3[6][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[7][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[7][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[7][3] . '</div>
  </td>
<td align="right">
' . $com3[7][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[8][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[8][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[8][3] . '</div>
  </td>
<td align="right">
' . $com3[8][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[9][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[9][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[9][3] . '</div>
  </td>
<td align="right">
' . $com3[9][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[10][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[10][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[10][3] . '</div>
  </td>
<td align="right">
' . $com3[10][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[11][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[11][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[11][3] . '</div>
  </td>
<td align="right">
' . $com3[11][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[12][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[12][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[12][3] . '</div>
  </td>
<td align="right">
' . $com3[12][4] . '%
  </td>
 </tr>
</table>

 </td>
 <td width="50%" valign="top">

  <table>

 <tr><td><strong>Cálculo del ISR sobre Sueldo Mensual Ordinario (SMO)</strong></td></tr>

<tr>

<td>Sueldo Mensual Ordinario (SMO) <font size="1"><i>(El Sueldo Mensual Ordinario (SMO) $' . number_format($pre_var1, 2) . ' es la cuota diaria convertida a mensual $' . number_format($pre_var3, 2) . ' por 30.4)</i></font></td>
<td></td>
<td><div align="right">$' . number_format($pre_var1, 2) . '</div></td>
</tr>

<tr>
<td>Límite Inferior</td>
<td>-</td>
<td><div align="right">$' . number_format($limite_inferior, 2) . '<hr></div></td>
</tr>

<tr>
<td>Importe Excedente al Límite Inferior</td>
<td>=</td>
<td><div align="right">$' . number_format($importe_excedente_li2, 2) . '</div></td>
</tr>

<tr>
<td>(%) para aplicar sobre el Excedente</td>
<td>x</td>
<td><div align="right">' . number_format($porcentaje_p_aplicarse, 2) . '%</div><hr></td>
</tr>

<tr>
<td>Impuesto Marginal</td>
<td>=</td>
<td><div align="right">$' . number_format($impuesto_marginal2, 2) . '</div></td>
</tr>

<tr>
<td>Cuota Fija</td>
<td>+</td>
<td><div align="right">$' . number_format($cuota_fija, 2) . '</div><hr></td>
</tr>

<tr>
<td>Impuesto Calculado</td>
<td>=</td>
<td><div align="right">$' . number_format($isr_calculado2, 2) . '</div></td>
</tr>

<tr>
<td>Subsidio para el Empleo</td>
<td>-</td>
<td><div align="right">$' . number_format($c32, 2) . '</div></td>
</tr>

<tr>
<td><b>
' . $bar2 . '
</b></td>
<td><b>=</b></td>
<td><b><div align="right">$' . number_format($cal52, 2) . '</div></b></td>
</tr>

</table>
<br>
  <table border="0">
 <tr>
  <td colspan="4" align="center">
<div align="center"><strong>Tabla Subsidio</strong></div>
  </td>
 </tr>
 <tr>
  <td>
<div align="center"><b>Para Ingresos De</b></div>
  </td>
  <td>
<div align="center"><b>Hasta Ingresos De</b></div>
  </td>
  <td>
<div align="center"><b>Subsidio al Empleo</b></div>
  </td>
  <td>

  </td>
 </tr>


 <tr>
  <td>
<div align="center">$' . $com4[1][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[1][2] . '</div>
  </td>
<td align="right">
$' . $com4[1][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

  <tr>
  <td>
<div align="center">$' . $com4[2][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[2][2] . '</div>
  </td>
<td align="right">
$' . $com4[2][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

   <tr>
  <td>
<div align="center">$' . $com4[3][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[3][2] . '</div>
  </td>
<td align="right">
$' . $com4[3][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[4][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[4][2] . '</div>
  </td>
<td align="right">
$' . $com4[4][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[5][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[5][2] . '</div>
  </td>
<td align="right">
$' . $com4[5][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[6][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[6][2] . '</div>
  </td>
<td align="right">
$' . $com4[6][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[7][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[7][2] . '</div>
  </td>
<td align="right">
$' . $com4[7][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[8][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[8][2] . '</div>
  </td>
<td align="right">
$' . $com4[8][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[9][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[9][2] . '</div>
  </td>
<td align="right">
$' . $com4[9][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[10][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[10][2] . '</div>
  </td>
<td align="right">
$' . $com4[10][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[11][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[11][2] . '</div>
  </td>
<td align="right">
$' . $com4[11][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[12][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[12][2] . '</div>
  </td>
<td align="right">
$' . $com4[12][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

</table>


 </td>
 </tr>
 </table>

 </td></tr></table>

</div>';

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('pdf_tablas_sueldos_y_salarios_siisarh.pdf', 'I');
        }
    }
    public function pdfPtu()
    {
        require resource_path('views/config.php');

        if (isset($_GET['x1']) and isset($_GET['x2']) and isset($_GET['x3'])) {

            if ($_GET['year'] == 2016) { //Actualizado 21 Febrero 2022: se agregaron las leyendas de todos los años
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2016, publicada en el DOF el 12 de Enero de 2016.";
            } elseif ($_GET['year'] == 2017) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2017, publicada en el DOF el 5 de Enero de 2017.";
            } elseif ($_GET['year'] == 2018) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2018, publicada en el DOF el 29 de Diciembre de 2017.";
            } elseif ($_GET['year'] == 2019) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2019, publicada en el DOF el 24 de Diciembre de 2018.";
            } elseif ($_GET['year'] == 2020) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2020, publicada en el DOF el 9 de Enero de 2020.";
            } elseif ($_GET['year'] == 2021) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2021, publicada en el DOF el 29 de Diciembre de 2020.";
            } elseif ($_GET['year'] == 2022) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2022, publicada en el DOF el 27 de Diciembre de 2021.";
            } elseif ($_GET['year'] == 2023) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2023, publicada en el DOF el 27 de Diciembre de 2022.";
            } elseif ($_GET['year'] == 2024) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2024, publicada en el DOF el 29 de Diciembre de 2023.";
            } elseif ($_GET['year'] == 2025) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2025, publicada en el DOF el 30 de Diciembre de 2024.";
            }
            $YEAR_PDF = $_GET['year'];
            function sueldos_y_salarios($var1, $var2)
            {
                require resource_path('views/config.php');
                $conectar->set_charset("utf8");

                $YEAR_PDF = $var2;
                $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
                $datos1 = mysqli_fetch_array($resp1);
                $limite_inferior = $datos1['var1'];
                $importe_excedente_li = $var1 - $limite_inferior;
                $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
                $datos2 = mysqli_fetch_array($resp2);
                $porcentaje_p_aplicarse = $datos2['var4'];
                $c1 = $importe_excedente_li * $porcentaje_p_aplicarse;
                $c2 = $c1 / 100;
                $impuesto_marginal = $c2;
                $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
                $datos3 = mysqli_fetch_array($resp3);
                $cuota_fija = $datos3['var3'];
                //tabla subsidio
                $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA'
and var1 between '0' and '$var1' order by var4 desc limit 1");
                $datos4 = mysqli_fetch_array($resp4);
                if ($_GET['var44'] == 0) {
                    $c3 = $datos4['var3'];
                } else {
                    $c3 = "0.00";
                }
                //fin tabla subsidio
                $isr_calculado = $impuesto_marginal + $cuota_fija;
                if ($_GET['var44'] == 0) {
                    $cal5 = $isr_calculado - $c3;
                } else {
                    $cal5 = $isr_calculado;
                }
                return $cal5; //falta subsidio para empleo
            }

            date_default_timezone_set("America/Mexico_City");

            $impresion_fecha = date("Y-m-d h:i:sa");

            if ($_GET['x1'] == 3) {
                $tipo_calculo = "Participación de los Trabajadores en las Utilidades";
            }

            $usuario_global = $_GET['name'];

            $cuota = $_GET['x3'];
            $importe = $_GET['x2'];

            $uma = $_GET['uma'];

            if ($_GET['x1'] == 3) { //aguinaldo
                $dias = 15;
                $i_e = $dias * $uma;
                if ($importe > $i_e) {
                    $total_exento = $i_e;
                } else {
                    $total_exento = $importe;
                }
                $t_gravado = $importe - $total_exento;
            }

            if ($t_gravado / 365 * 30.4 <= 0) {
                $promedio_mensual_gravable = 0.0001;
            } else {
                $promedio_mensual_gravable = $t_gravado / 365 * 30.4;
            }

            $sueldo_mensual_ordinario = $cuota * 30.4;
            $c1 = $promedio_mensual_gravable + $sueldo_mensual_ordinario;
            $c2 = sueldos_y_salarios($c1, $YEAR_PDF);
            $c3 = sueldos_y_salarios($sueldo_mensual_ordinario, $YEAR_PDF);
            $c4 = $c2 - $c3;
            $c5 = $c4 / $promedio_mensual_gravable; //tasa_isr
            $c6 = $c5 * $t_gravado;
            $c7 = sueldos_y_salarios($c1, $YEAR_PDF);
            $c8 = sueldos_y_salarios($sueldo_mensual_ordinario, $YEAR_PDF);
            $c9 = $c4 / $promedio_mensual_gravable;

            $bar1 = $sueldo_mensual_ordinario + $promedio_mensual_gravable;


            if ($c6 > 0) {
                $bar2 = "ISR DETERMINADO";
            } else {
                $bar2 = "SUBSIDIO DETERMINADO";
            }


            $pre_var1 = $sueldo_mensual_ordinario;
            $pre_var2 = $promedio_mensual_gravable;
            $pre_var3 = $cuota;

            $var1 = $pre_var1 + $pre_var2;
            ////////////////////////////////////////////////////////////////////////////////////////////////1
            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
            $datos1 = mysqli_fetch_array($resp1);
            $limite_inferior = $datos1['var1'];
            $importe_excedente_li = $var1 - $limite_inferior;
            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
            $datos2 = mysqli_fetch_array($resp2);
            $porcentaje_p_aplicarse = $datos2['var4'];
            $c1 = $importe_excedente_li * $porcentaje_p_aplicarse;
            $c2 = $c1 / 100;
            $impuesto_marginal = $c2;
            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$var1' order by var4 desc limit 1");
            $datos3 = mysqli_fetch_array($resp3);
            $cuota_fija = $datos3['var3'];
            //tabla subsidio
            $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$YEAR_PDF'
and var1 != '0' and var1 between '0' and '$var1' order by var4 desc limit 1");
            $datos4 = mysqli_fetch_array($resp4);
            if ($_GET['var44'] == 0) {
                $c3 = $datos4['var3'];
            } else {
                $c3 = "0.00";
            }
            //fin tabla subsidio
            $isr_calculado = $impuesto_marginal + $cuota_fija;
            if ($_GET['var44'] == 0) {
                $cal5 = $isr_calculado - $c3;
            } else {
                $cal5 = $isr_calculado;
            }
            $cal5; //falta subsidio para empleo
            /////////////////////////////////////////////////////////////////////////////////////////////////////1
            /////////////////////////////////////////////////////////////////////////////////////////////////////2
            $resp12 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$pre_var1' order by var4 desc limit 1");
            $datos12 = mysqli_fetch_array($resp12);
            $limite_inferior2 = $datos12['var1'];
            $importe_excedente_li2 = $pre_var1 - $limite_inferior2;
            $resp22 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$pre_var1' order by var4 desc limit 1");
            $datos22 = mysqli_fetch_array($resp22);
            $porcentaje_p_aplicarse2 = $datos22['var4'];
            $c12 = $importe_excedente_li2 * $porcentaje_p_aplicarse2;
            $c22 = $c12 / 100;
            $impuesto_marginal2 = $c22;
            $resp32 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF'
and var1 between '0' and '$pre_var1' order by var4 desc limit 1");
            $datos32 = mysqli_fetch_array($resp32);
            $cuota_fija2 = $datos32['var3'];
            //tabla subsidio
            $resp42 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$YEAR_PDF'
and var1 != '0' and var1 between '0' and '$pre_var1' order by var4 desc limit 1");
            $datos42 = mysqli_fetch_array($resp42);
            if ($_GET['var44'] == 0) {
                $c32 = $datos42['var3'];
            } else {
                $c32 = "0.00";
            }
            //fin tabla subsidio
            $isr_calculado2 = $impuesto_marginal2 + $cuota_fija2;
            if ($_GET['var44'] == 0) {
                $cal52 = $isr_calculado2 - $c32;
            } else {
                $cal52 = $isr_calculado2;
            }
            $cal52; //falta subsidio para empleo
            /////////////////////////////////////////////////////////////////////////////////////////////////////////2
            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>
<br>

<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Cálculo de ISR por Otras Remuneraciones<br>Artículo 174 del Reglamento de la Ley del ISR</font></b></p></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td width="20%"><b>Fecha de cálculo: </b></td>
<td width="80%">' . $impresion_fecha . '</td>
</tr>
<tr>
<td width="20%"><b>Tipo de cálculo: </b></td>
<td width="80%">' . $tipo_calculo . '</td>
</tr>
<tr>
<td width="20%"><b>Realizado para: </b></td>
<td width="80%">' . $usuario_global . '</td>
</tr>
</table>
<br>
<div align="justify"><font size="2">
RISR ART. 174: Tratándose de las remuneraciones por concepto de gratificación anual, participación de utilidades, primas dominicales y vacacionales a que se
refiere el artículo 96 de la Ley, la persona que haga dichos pagos podrá optar por retener el Impuesto que corresponda conforme a lo siguiente:
</font></div>


<br>
<table border="0"><tr><td><strong>Datos para el cálculo</strong></td></tr></table>
<div style="overflow-x:auto;">
  <table>
<tr>
<td width="70%">Cuota Diaria</td>
<td width="15%"></td>
<td width="15%" align="right">$' . number_format($cuota, 2) . '</td>
</tr>

<tr>
<td>Importe de la Percepción</td>
<td></td>
<td align="right">$' . number_format($importe, 2) . '</td>
</tr>

<tr>
<td>Ingreso Exento (Tope Máximo = 15 días de S.M.G. ($' . $uma . ') Art. 93 LISR Fracc. XIV)</td>
<td><b>-</b></td>
<td align="right">$' . number_format($total_exento, 2) . '<hr></td>
</tr>

<tr>
<td>Ingreso Gravable</td>
<td><b>=</b></td>
<td align="right">$' . number_format($t_gravado, 2) . '<hr></td>
</tr>

</table>



<table border="0"><tr><td><strong>Desarrollo del Cálculo del ISR</strong></td></tr></table>
<div style="overflow-x:auto;">
  <table>
<tr>
<td width="70%">Fracc I. La remuneración de que se trate se dividirá entre 365 y el resultado se multiplicará por 30.4 Comentario: Se debe considerar solo la
parte gravable.</td>
<td width="15%"></td>
<td width="15%"></td>
</tr>

<tr>
<td>Importe Fracc I ( Ingreso Gravable / 365 x 30.4) | $' . number_format($t_gravado, 2) . ' / 365 X 30.40</td>
<td><b>=</b></td>
<td align="right">$' . number_format($promedio_mensual_gravable, 2) . '</td>
</tr>

<tr>
<td>Fracc II. A la cantidad que se obtenga conforme a la fracción anterior, se le adicionará el ingreso ordinario por la prestación de un servicio
personal subordinado que perciba el trabajador en forma regular en el mes de que se trate y al resultado se le aplicará el procedimiento
establecido en el artículo 96 de la Ley;</td>
<td></td>
<td></td>
</tr>

<tr>
<td>Sueldo Mensual ( Cuota Diaria X 30.4) | $' . number_format($cuota, 2) . ' x 30.40</td>
<td><b>=</b></td>
<td align="right">$' . number_format($sueldo_mensual_ordinario, 2) . '</td>
</tr>

<tr>
<td>Sueldo Mensual + Importe de la Fracc I | $' . number_format($sueldo_mensual_ordinario, 2) . ' + $' . number_format($promedio_mensual_gravable, 2) . '</td>
<td>=</td>
<td align="right">$' . number_format($bar1, 2) . '<hr></td>
</tr>

<tr>
<td>Aplicación de Art. 96 LISR en la Fracc II (Sueldo Mensual + Remuneración Promedio Mensual)</td>
<td></td>
<td align="right">$' . number_format($c7, 2) . '</td>
</tr>

<tr>
<td>Fracc III. El Impuesto que se obtenga conforme a la fracción anterior se disminuirá con el Impuesto que correspondería al ingreso ordinario
por la prestación de un servicio personal subordinado a que se refiere dicha fracción, calculando este último sin considerar las demás
remuneraciones mencionadas en este artículo;</td>
<td></td>
<td></td>
</tr>

<tr>
<td>Sueldo Mensual ( Cuota Diaria X 30.4) | $' . number_format($cuota, 2) . ' x 30.40</td>
<td><b>=</b></td>
<td align="right">$' . number_format($sueldo_mensual_ordinario, 2) . '</td>
</tr>

<tr>
<td>Aplicación de Art. 96 LISR en la Fracc III (Sueldo Mensual)</td>
<td></td>
<td align="right">$' . number_format($c8, 2) . '</td>
</tr>

<tr>
<td>Diferencia (Importe ISR Fracc II - Importe ISR Fracc III) | $' . number_format($c7, 2) . ' - $' . number_format($c8, 2) . '</td>
<td><b>=</b></td>
<td align="right">$' . number_format($c4, 2) . '<hr></td>
</tr>

<tr>
<td>Fracc IV. El Impuesto a retener será el que resulte de aplicar a las remuneraciones a que se refiere este artículo, sin deducción alguna, la
tasa a que se refiere la fracción siguiente, y</td>
<td></td>
<td></td>
</tr>

<tr>
<td>' . $bar2 . ' | $' . number_format($t_gravado, 2) . ' x ' . number_format($c9 * 100, 2) . '%</td>
<td><b>=</b></td>
<td align="right">$' . number_format($c6, 2) . ' *<hr></td>
</tr>

<tr>
<td>Fracc V. La tasa a que se refiere la fracción anterior, se calculará dividiendo el Impuesto que se determine en términos de la fracción III de
este artículo entre la cantidad que resulte conforme a la fracción I de dicho artículo. El cociente se multiplicará por cien y el producto se
expresará en por ciento.</td>
<td></td>
<td></td>
</tr>

<tr>
<td>Tasa a Aplicar (Diferencia / Importe Fracc I) | $' . number_format($c4, 2) . ' / $' . number_format($promedio_mensual_gravable, 2) . '</td>
<td><b>=</b></td>
<td align="right">' . number_format($c9 * 100, 2) . '%<hr></td>
</tr>

</table>
<font size="1">
* El impuesto determinado, será el importe que hay que restar a nuestro cantidad total de la remuneración considerada<br>para obtener nuestro importe neto
</font>
<br><br><br><br><br><br><br><br>
 <table border="0"><tr><td><strong>Desglose de cálculos previos:</strong></td></tr></table>
<div style="overflow-x:auto;">
  <table>
<tr>
<td width="70%"><b>Aplicación de Art. 96 LISR en la Fracc II (Sueldo Mensual + Remuneración Promedio Mensual) (1)</b></td>
<td width="15%"></td>
<td width="15%"></td>
</tr>

<tr>
<td>Base Gravable</td>
<td></td>
<td align="right">$' . number_format($var1, 2) . '</td>
</tr>

<tr>
<td>Límite Inferior</td>
<td><b>-</b></td>
<td align="right">$' . number_format($limite_inferior, 2) . '<hr></td>
</tr>

<tr>
<td>Importe Excedente al Límite Inferior</td>
<td><b>=</b></td>
<td align="right">$' . number_format($importe_excedente_li, 2) . '</td>
</tr>

<tr>
<td>(%) para aplicar sobre excedente</td>
<td><b>x</b></td>
<td align="right">' . number_format($porcentaje_p_aplicarse, 2) . '%<hr></td>
</tr>

<tr>
<td>Impuesto Marginal</td>
<td><b>=</b></td>
<td align="right">$' . number_format($impuesto_marginal, 2) . '</td>
</tr>

<tr>
<td>Cuota fija</td>
<td><b>+</b></td>
<td align="right">$' . number_format($cuota_fija, 2) . '<hr></td>
</tr>

<tr>
<td>Impuesto Calculado</td>
<td><b>=</b></td>
<td align="right">$' . number_format($isr_calculado, 2) . '</td>
</tr>

<tr>
<td>Subsidio para el Empleo (Solo calculado, NO Aplicado) (2)</td>
<td></td>
<td align="right">$' . number_format($datos4['var3'], 2) . '</td>
</tr>

<tr>
<td><b>Impuesto Determinado Fracc II</b></td>
<td></td>
<td align="right"><b>$' . number_format($isr_calculado, 2) . '</b><hr></td>
</tr>
<tr>
<td><b>Aplicación de Art. 96 LISR en la Fracc III (Sueldo Mensual) (3)</b></td>
<td></td>
<td></td>
</tr>

<tr>
<td>Base Gravable</td>
<td></td>
<td align="right">$' . number_format($pre_var1, 2) . '</td>
</tr>

<tr>
<td>Límite Inferior</td>
<td><b>-</b></td>
<td align="right">$' . number_format($limite_inferior2, 2) . '<hr></td>
</tr>

<tr>
<td>Importe Excedente al Límite Inferior</td>
<td><b>=</b></td>
<td align="right">$' . number_format($importe_excedente_li2, 2) . '</td>
</tr>

<tr>
<td>(%) para aplicar sobre excedente</td>
<td><b>x</b></td>
<td align="right">' . number_format($porcentaje_p_aplicarse2, 2) . '%<hr></td>
</tr>

<tr>
<td>Impuesto Marginal</td>
<td><b>=</b></td>
<td align="right">$' . number_format($impuesto_marginal2, 2) . '</td>
</tr>

<tr>
<td>Cuota fija</td>
<td><b>+</b></td>
<td align="right">$' . number_format($cuota_fija2, 2) . '<hr></td>
</tr>

<tr>
<td>Impuesto Calculado</td>
<td><b>=</b></td>
<td align="right">$' . number_format($isr_calculado2, 2) . '</td>
</tr>

<tr>
<td>Subsidio para el Empleo (Solo calculado, NO Aplicado) (4)</td>
<td></td>
<td align="right">$' . number_format($datos42['var3'], 2) . '</td>
</tr>

<tr>
<td><b>Impuesto Determinado Fracc II</b></td>
<td></td>
<td align="right"><b>$' . number_format($isr_calculado2, 2) . '</b><hr></td>
</tr>

</table>
<br>

<table width="100%" summary="" border="0">
<tr>
<td align="center"><b>Tablas de impuestos utilizadas</b></td>
</tr>
</table>

<table width="100%" summary="" border="0">
<tr>
<td width="50%" valign="top">
( 1 ) Tabla Mensual de ISR utilizada en Aplicación de Art. 96 Fracc. II<br>
Art. 96 LISR*
<table width="100%" summary="" border="0">
<tr>
<td>Límite inferior: </td>
<td align="right">' . number_format($datos1['var1'], 2) . '</td>
</tr>
<tr>
<td>Límite Superior: </td>
<td align="right">' . number_format($datos1['var2'], 2) . '</td>
</tr>
<tr>
<td>% Sobre Exc. L.I.: </td>
<td align="right">' . number_format($datos1['var4'], 2) . '</td>
</tr>
<tr>
<td>Cuota Fija</td>
<td align="right">' . number_format($datos1['var3'], 2) . '</td>
</tr>
</table>


</td>
<td width="50%" valign="top">
( 3 ) Tabla Mensual de ISR utilizada en Aplicación de Art. 96 Fracc. III<br>
Art. 96 LISR*
<table width="100%" summary="" border="0">
<tr>
<td>Límite inferior: </td>
<td align="right">' . number_format($datos12['var1'], 2) . '</td>
</tr>
<tr>
<td>Límite Superior: </td>
<td align="right">' . number_format($datos12['var2'], 2) . '</td>
</tr>
<tr>
<td>% Sobre Exc. L.I.: </td>
<td align="right">' . number_format($datos12['var4'], 2) . '</td>
</tr>
<tr>
<td>Cuota Fija</td>
<td align="right">' . number_format($datos12['var3'], 2) . '</td>
</tr>
</table>





</td>
</tr>
</table>

<table width="100%" summary="" border="0">
<tr>
<td width="50%" valign="top">
( 2 ) Tabla Mensual de SUBSIDIO utilizada en Aplicación de Art. 96 Fracc. II<br>
Art. 10 Transitorio de la LISR, Subsidio para el Empleo*
<table width="100%" summary="" border="0">
<tr>
<td>Límite inferior: </td>
<td align="right">' . number_format($datos4['var1'], 2) . '</td>
</tr>
<tr>
<td>Límite Superior: </td>
<td align="right">' . number_format($datos4['var2'], 2) . '</td>
</tr>
<tr>
<td>Subsidio para el empleo: </td>
<td align="right">' . number_format($datos4['var3'], 2) . '</td>
</tr>
</table>


</td>
<td width="50%" valign="top">
( 4 ) Tabla Mensual de SUBSIDIO utilizada en Aplicación de Art. 96 Fracc. III<br>
Art. 10 Transitorio de la LISR, Subsidio para el Empleo*
<table width="100%" summary="" border="0">
<tr>
<td>Límite inferior: </td>
<td align="right">' . number_format($datos42['var1'], 2) . '</td>
</tr>
<tr>
<td>Límite Superior: </td>
<td align="right">' . number_format($datos42['var2'], 2) . '</td>
</tr>
<tr>
<td>Subsidio para el empleo: </td>
<td align="right">' . number_format($datos42['var3'], 2) . '</td>
</tr>
</table>

</td></tr></table>

 <br>
<font size="1">' . $leyenda . '</font>
 <br><br>

  <table>
  <tr>
  <td valign="top"><font size="2">Fundamentos legales: </font></td>
  <td valign="top">
<font size="1">
Ley del Impuesto Sobre la Renta Art. 93, 96 y 10mo Transitorio<br>
Reglamento de la Ley del Impuesto Sobre la Renta Art. 174<br>
Código Fiscal de la Federación Art. 17-A
</font>
  </td>
  </tr>
  </table>
</div>';

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('pdf_ptu_siisarh.pdf', 'I');
        }
        mysqli_free_result($resp);
    }

    public function pdfTablaSueldosSalarios()
    {
        require_once resource_path('views/config.php');

        if (isset($_GET['pdf']) and isset($_GET['dias'])) {

            $dias = $_GET['dias'];
            $YEAR_PDF = $_GET['year'];
            $resp = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and dias_trabajados='$dias' and year='$YEAR_PDF' order by var1 asc limit 12");
            $datos = mysqli_fetch_array($resp);

            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and dias_trabajados='$dias' and year='$YEAR_PDF' order by var1 asc limit 12");
            $a = 0;
            while ($datos2 = mysqli_fetch_array($resp2)) {
                $a = $a + 1;
                $com1[$a][1] = number_format($datos2['var1'], 2);
                $com1[$a][2] = number_format($datos2['var2'], 2);
                $com1[$a][3] = number_format($datos2['var3'], 2);
                $com1[$a][4] = number_format($datos2['var4'], 2);
            }
            mysqli_free_result($resp2);

            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$YEAR_PDF' order by var1 asc limit 12");
            $b = 0;
            while ($datos3 = mysqli_fetch_array($resp3)) {
                $b = $b + 1;
                $com2[$b][1] = number_format($datos3['var1'], 2);
                $com2[$b][2] = number_format($datos3['var2'], 2);
                $com2[$b][3] = number_format($datos3['var3'], 2);
                $com2[$b][4] = number_format($datos3['var4'], 2);
            }
            mysqli_free_result($resp3);

            $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO VARIABLE' and dias_trabajados='$dias' and year='$YEAR_PDF' order by var1 asc limit 12");
            $c = 0;
            while ($datos4 = mysqli_fetch_array($resp4)) {
                $c = $c + 1;
                $com3[$c][1] = number_format($datos4['var1'], 2);
                $com3[$c][2] = number_format($datos4['var2'], 2);
                $com3[$c][3] = number_format($datos4['var3'], 2);
                $com3[$c][4] = number_format($datos4['var4'], 2);
            }
            mysqli_free_result($resp4);

            $resp5 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$YEAR_PDF' order by var1 asc limit 12");
            $d = 0;
            while ($datos5 = mysqli_fetch_array($resp5)) {
                $d = $d + 1;
                $com4[$d][1] = number_format($datos5['var1'], 2);
                $com4[$d][2] = number_format($datos5['var2'], 2);
                $com4[$d][3] = number_format($datos5['var3'], 2);
                $com4[$d][4] = number_format($datos5['var4'], 2);
            }
            mysqli_free_result($resp5);

            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>
<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Cálculo de ISR por Sueldos y Salarios<br>Artículo 96 de la Ley del ISR</font></b></p></td>
</tr>
</table>
<br>

<table border="0">
 <tr>
  <td>
<div align="center"><b>Días x año</b></div>
  </td>
  <td>
<div align="center"><b>Meses x año</b></div>
  </td>
  <td>
<div align="center"><b>Días x mes</b></div>
  </td>
  <td>
<div align="center"><b>Días trabajados</b></div>
  </td>
 </tr>
 <tr>
  <td><div align="center">
' . $datos['dias_year'] . '</div>
  </td>
  <td><div align="center">
' . $datos['meses_year'] . '</div>
  </td>
  <td><div align="center">
' . $datos['dias_xmes'] . '</div>
  </td>
  <td><div align="center">
' . $datos['dias_trabajados'] . '</div>
  </td>
 </tr>
 </table>

 <br>

 <table border="0" width="100%">
 <tr>
 <td width="50%" valign="top">
  <table border="0">
 <tr>
  <td colspan="4" align="center">
<div align="center"><strong>Tabla en base a días de cálculo</strong></div>
  </td>
 </tr>
 <tr>
 <td colspan="4" align="center">
<div align="center"><strong>Tabla Impuesto ISR</strong></div>
  </td>
 </tr>
  <tr>
  <td>
<div align="center"><b>Límite Inferior</b></div>
  </td>
  <td>
<div align="center"><b>Límite Superior</b></div>
  </td>
  <td>
<div align="center"><b>Cuota Fija</b></div>
  </td>
  <td>
<div align="center"><b>% Para aplicarse s/excedente del límite inferior</b></div>
  </td>
 </tr>

 <tr>
  <td>
<div align="center">$' . $com1[1][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[1][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[1][3] . '</div>
  </td>
<td align="right">
' . $com1[1][4] . '%
</td>
 </tr>

  <tr>
  <td>
<div align="center">$' . $com1[2][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[2][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[2][3] . '</div>
  </td>
<td align="right">
' . $com1[2][4] . '%
</td>
 </tr>

   <tr>
  <td>
<div align="center">$' . $com1[3][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[3][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[3][3] . '</div>
  </td>
<td align="right">
' . $com1[3][4] . '%
</td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com1[4][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[4][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[4][3] . '</div>
  </td>
<td align="right">
' . $com1[4][4] . '%
</td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com1[5][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[5][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[5][3] . '</div>
  </td>
<td align="right">
' . $com1[5][4] . '%
</td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com1[6][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[6][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[6][3] . '</div>
  </td>
<td align="right">
' . $com1[6][4] . '%
</td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com1[7][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[7][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[7][3] . '</div>
  </td>
<td align="right">
' . $com1[7][4] . '%
</td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com1[8][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[8][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[8][3] . '</div>
  </td>
<td align="right">
' . $com1[8][4] . '%
</td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com1[9][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[9][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[9][3] . '</div>
  </td>
<td align="right">
' . $com1[9][4] . '%
</td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com1[10][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[10][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[10][3] . '</div>
  </td>
<td align="right">
' . $com1[10][4] . '%
</td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com1[11][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[11][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[11][3] . '</div>
  </td>
<td align="right">
' . $com1[11][4] . '%
</td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com1[12][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[12][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com1[12][3] . '</div>
  </td>
<td align="right">
' . $com1[12][4] . '%
</td>
 </tr>

</table>
<br><br>
  <table border="0">
 <tr>
  <td colspan="4" align="center">
<div align="center"><strong>Tabla Subsidio</strong></div>
  </td>
 </tr>
 <tr>
  <td>
<div align="center"><b>Para Ingresos De</b></div>
  </td>
  <td>
<div align="center"><b>Hasta Ingresos De</b></div>
  </td>
  <td>
<div align="center"><b>Subsidio al Empleo</b></div>
  </td>
  <td>

  </td>
 </tr>


 <tr>
  <td>
<div align="center">$' . $com3[1][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[1][2] . '</div>
  </td>
<td align="right">
' . $com3[1][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

  <tr>
  <td>
<div align="center">$' . $com3[2][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[2][2] . '</div>
  </td>
<td align="right">
' . $com3[2][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

   <tr>
  <td>
<div align="center">$' . $com3[3][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[3][2] . '</div>
  </td>
<td align="right">
' . $com3[3][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[4][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[4][2] . '</div>
  </td>
<td align="right">
' . $com3[4][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[5][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[5][2] . '</div>
  </td>
<td align="right">
' . $com3[5][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[6][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[6][2] . '</div>
  </td>
<td align="right">
' . $com3[6][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[7][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[7][2] . '</div>
  </td>
<td align="right">
' . $com3[7][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[8][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[8][2] . '</div>
  </td>
<td align="right">
' . $com3[8][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[9][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[9][2] . '</div>
  </td>
<td align="right">
' . $com3[9][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[10][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[10][2] . '</div>
  </td>
<td align="right">
' . $com3[10][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[11][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[11][2] . '</div>
  </td>
<td align="right">
' . $com3[11][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com3[12][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com3[12][2] . '</div>
  </td>
<td align="right">
' . $com3[12][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

</table>
 </td>
 <td width="50%" valign="top">
   <table border="0">
 <tr>
  <td colspan="4" align="center">
<div align="center"><strong>Tablas Mensuales</strong></div>
  </td>
 </tr>
 <tr>
 <td colspan="4" align="center">
<div align="center"><strong>Tabla Impuesto ISR</strong></div>
  </td>
 </tr>
  <tr>
  <td>
<div align="center"><b>Límite Inferior</b></div>
  </td>
  <td>
<div align="center"><b>Límite Superior</b></div>
  </td>
  <td>
<div align="center"><b>Cuota Fija</b></div>
  </td>
  <td>
<div align="center"><b>% Para aplicarse s/excedente del límite inferior</b></div>
  </td>
 </tr>

 <tr>
  <td>
<div align="center">$' . $com2[1][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[1][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[1][3] . '</div>
  </td>
<td align="right">
' . $com2[1][4] . '%
  </td>
 </tr>

  <tr>
  <td>
<div align="center">$' . $com2[2][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[2][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[2][3] . '</div>
  </td>
<td align="right">
' . $com2[2][4] . '%
  </td>
 </tr>

   <tr>
  <td>
<div align="center">$' . $com2[3][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[3][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[3][3] . '</div>
  </td>
<td align="right">
' . $com2[3][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com2[4][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[4][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[4][3] . '</div>
  </td>
<td align="right">
' . $com2[4][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com2[5][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[5][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[5][3] . '</div>
  </td>
<td align="right">
' . $com2[5][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com2[6][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[6][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[6][3] . '</div>
  </td>
<td align="right">
' . $com2[6][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com2[7][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[7][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[7][3] . '</div>
  </td>
<td align="right">
' . $com2[7][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com2[8][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[8][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[8][3] . '</div>
  </td>
<td align="right">
' . $com2[8][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com2[9][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[9][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[9][3] . '</div>
  </td>
<td align="right">
' . $com2[9][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com2[10][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[10][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[10][3] . '</div>
  </td>
<td align="right">
' . $com2[10][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com2[11][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[11][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[11][3] . '</div>
  </td>
<td align="right">
' . $com2[11][4] . '%
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com2[12][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[12][2] . '</div>
  </td>
  <td>
<div align="center">$' . $com2[12][3] . '</div>
  </td>
<td align="right">
' . $com2[12][4] . '%
  </td>
 </tr>

</table>
<br><br>
  <table border="0">
 <tr>
  <td colspan="4" align="center">
<div align="center"><strong>Tabla Subsidio</strong></div>
  </td>
 </tr>
 <tr>
  <td>
<div align="center"><b>Para Ingresos De</b></div>
  </td>
  <td>
<div align="center"><b>Hasta Ingresos De</b></div>
  </td>
  <td>
<div align="center"><b>Subsidio al Empleo</b></div>
  </td>
  <td>

  </td>
 </tr>


 <tr>
  <td>
<div align="center">$' . $com4[1][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[1][2] . '</div>
  </td>
<td align="right">
$' . $com4[1][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

  <tr>
  <td>
<div align="center">$' . $com4[2][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[2][2] . '</div>
  </td>
<td align="right">
$' . $com4[2][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

   <tr>
  <td>
<div align="center">$' . $com4[3][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[3][2] . '</div>
  </td>
<td align="right">
$' . $com4[3][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[4][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[4][2] . '</div>
  </td>
<td align="right">
$' . $com4[4][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[5][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[5][2] . '</div>
  </td>
<td align="right">
$' . $com4[5][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[6][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[6][2] . '</div>
  </td>
<td align="right">
$' . $com4[6][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[7][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[7][2] . '</div>
  </td>
<td align="right">
$' . $com4[7][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[8][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[8][2] . '</div>
  </td>
<td align="right">
$' . $com4[8][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[9][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[9][2] . '</div>
  </td>
<td align="right">
$' . $com4[9][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[10][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[10][2] . '</div>
  </td>
<td align="right">
$' . $com4[10][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[11][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[11][2] . '</div>
  </td>
<td align="right">
$' . $com4[11][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

    <tr>
  <td>
<div align="center">$' . $com4[12][1] . '</div>
  </td>
  <td>
<div align="center">$' . $com4[12][2] . '</div>
  </td>
<td align="right">
$' . $com4[12][3] . '
  </td>
  <td>
<div align="center"></div>
  </td>
 </tr>

</table>
 </td>
 </tr>
 </table>




</div>';

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('pdf_tablas_sueldos_y_salarios_siisarh.pdf', 'I');
        }
    }
    public function pdfSueldosSalarios()
    {
        require_once resource_path('views/config.php');
        if (isset($_GET['tipo']) and isset($_GET['pdf']) and isset($_GET['dias']) and isset($_GET['faltas']) and isset($_GET['ingresos'])) {

            if ($_GET['year'] == 2016) { //Actualizado 21 Febrero 2022: se agregaron las leyendas de todos los años
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2016, publicada en el DOF el 12 de Enero de 2016.";
            } elseif ($_GET['year'] == 2017) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2017, publicada en el DOF el 5 de Enero de 2017.";
            } elseif ($_GET['year'] == 2018) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2018, publicada en el DOF el 29 de Diciembre de 2017.";
            } elseif ($_GET['year'] == 2019) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2019, publicada en el DOF el 24 de Diciembre de 2018.";
            } elseif ($_GET['year'] == 2020) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2020, publicada en el DOF el 9 de Enero de 2020.";
            } elseif ($_GET['year'] == 2021) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2021, publicada en el DOF el 29 de Diciembre de 2020.";
            } elseif ($_GET['year'] == 2022) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2022, publicada en el DOF el 27 de Diciembre de 2021.";
            } elseif ($_GET['year'] == 2023) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2023, publicada en el DOF el 27 de Diciembre de 2022.";
            } elseif ($_GET['year'] == 2024) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2024, publicada en el DOF el 29 de Diciembre de 2023.";
            } elseif ($_GET['year'] == 2025) {
                $leyenda = "*Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2025, publicada en el DOF el 30 de Diciembre de 2024.";
            }

            date_default_timezone_set("America/Mexico_City");

            $impresion_fecha = date("Y-m-d h:i:sa");

            if ($_GET['tipo'] == "overwritten") {
                $tipo_calculo = "Inverso";
            } else {
                $tipo_calculo = "Ordinario";
            }

            $usuario_global = $_GET['name'];
            $YEAR_PDF = $_GET['year'];
            $dias = $_GET['dias'];
            $faltas = $_GET['faltas'];
            $ingresos = $_GET['ingresos'];
            $total1 = $dias - $faltas;

            $resp24 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$YEAR_PDF' and
dias_trabajados='$total1' and var1 between '0' and '$ingresos' and var1 != 0 order by var1 desc limit 1"); //Actualizado 21 Febrero 2022:  se agrego var!= 0
            $datos24 = mysqli_fetch_array($resp24);

            $cal1 = $ingresos - $datos24['var1'];

            $resp25 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$YEAR_PDF' and
dias_trabajados='$total1' and var1 between '0' and '$ingresos' and var1 != 0 order by var4 desc limit 1"); //Actualizado 21 Febrero 2022:  se agrego var!= 0
            $datos25 = mysqli_fetch_array($resp25);

            $cal2 = $cal1 * $datos25['var4'];
            $cal3 = $cal2 / 100;

            $resp26 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$YEAR_PDF' and
dias_trabajados='$total1' and var1 between '0' and '$ingresos' and var1 != 0 order by var4 desc limit 1"); //Actualizado 21 Febrero 2022:  se agrego var!= 0
            $datos26 = mysqli_fetch_array($resp26);

            $cal4 = $cal3 + $datos26['var3'];

            $resp27 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO VARIABLE' and year='$YEAR_PDF' and
dias_trabajados='$total1' and var1 between '0' and '$ingresos' and var1 != 0 order by var3 asc limit 1"); //Actualizado 21 Febrero 2022:  se agrego var!= 0 y se cambio de var2 a var3 asc
            $datos27 = mysqli_fetch_array($resp27);

            if ($_GET['var44'] == 0) {
                $valx_1 = $datos27['var3'];
            } else {
                $valx_1 = "0.00";
            }

            if ($_GET['var44'] == 0) {
                $cal5 = $cal4 - $datos27['var3'];
            } else {
                $cal5 = $cal4;
            }
            if ($cal5 > 0) {
                $valx_2 = "<b>ISR DETERMINADO</b>";
            } else {
                $valx_2 = "<b>SUBSIDIO DETERMINADO</b>";
            }

            $html = '<bookmark content="Start of the Document" /><div>
	<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 3.5px;
	font-size: xx-small;
}

tr:nth-child(even){background-color: #f2f2f2}


</style>
<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
<td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Cálculo de ISR por Sueldos y Salarios<br>Artículo 96 de la Ley del ISR</font></b></p></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td><b>Fecha de cálculo: </b></td>
<td>' . $impresion_fecha . '</td>
</tr>
<tr>
<td><b>Tipo de cálculo: </b></td>
<td>' . $tipo_calculo . '</td>
</tr>
<tr>
<td><b>Realizado para: </b></td>
<td>' . $usuario_global . '</td>
</tr>
</table>
<br>
<div align="justify"><font size="2">Artículo 96: Quienes hagan pago por los conceptos a que se refiere este capítulo están oblgados a efectuar retenciones y enteros mensuales que tendrán el carácter de pagos provisionales a cuenta del impuesto anual. No se efectuará retención a las personas que en el mes únicamente perciban un salario mínimo general correspondiente al área geográfica del contribuyente. La retención se calculará aplicando a la totalidad de los ingresos obtenidos en un mes de calendario, la siguiente:</font></div>
<br>

<table width="100%" summary="" border="0">
<tr>
<td align="center"><b>Datos para el cálculo</b></td>
</tr>
</table>

<table width="100%" summary="" border="0">
<tr>
<td>Días Laborados: </td>
<td></td>
<td align="right">' . $dias . '</td>
</tr>
<tr>
<td>Faltas/Incapacidades: </td>
<td><b>-</b></td>
<td align="right">' . $faltas . '<hr></hr></td>
</tr>
<tr>
<td><b>Días Laborados Reales (1): </b></td>
<td><b>=</b></td>
<td align="right">' . $total1 . '<hr></td>
</tr>
</table>
<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center"><b>Desarrollo del Cálculo del ISR</b></td>
</tr>
</table>

<table width="100%" summary="" border="0">
<tr>
<td><b>Ingreso Gravable: </b></td>
<td></td>
<td align="right"><b>$' . number_format($ingresos, 2) . '</b></td>
</tr>
<tr>
<td>Límite Inferior</td>
<td><b>-</b></td>
<td align="right">
' . number_format($datos24['var1'], 2) . '
<br><hr>
</td>
</tr>

<tr>
<td>Importe excedente al limite inferior</td>
<td><b>=</b></td>
<td align="right">
' . number_format($cal1, 2) . '
</td>
</tr>

<tr>
<td>(%) para aplicar sobre el excedente</td>
<td><b>x</b></td>
<td align="right">
' . $datos25['var4'] . '
<br><hr>
</td>
</tr>

<tr>
<td>Impuesto Marginal</td>
<td><b>=</b></td>
<td align="right">
' . number_format(round($cal3, 2), 2) . '
</td>
</tr>

<tr>
<td>Cuota Fija</td>
<td><b>+</b></td>
<td align="right">
' . number_format($datos26['var3'], 2) . '
<br><hr>
</td>
</tr>

<tr>
<td>Impuesto calculado</td>
<td><b>=</b></td>
<td align="right">
' . number_format(round($cal4, 2), 2) . '
</td>
</tr>

<tr>
<td>Subsidio para el Empleo</td>
<td><b>-</b></td>
<td align="right">
' . $valx_1 . '
</td>
</tr>

<tr>
<td align="right">
' . $valx_2 . '
</td>
<td><b>=</b></td>
<td align="right">
<b>' . number_format(abs(round($cal5, 2)), 2) . '
</b>
<hr>
</td>
</tr>
</table>

<br>
<table width="100%" summary="" border="0">
<tr>
<td align="center"><b>Tablas de impuestos utilizadas</b></td>
</tr>
</table>

<table width="100%" summary="" border="0">
<tr>
<td width="50%" valign="top">
(1) Tabla de ISR Mensual, proporcional a Días Laborados Reales<br>
Art. 96 LISR*<br>

<table width="100%" summary="" border="0">
<tr>
<td>Límite inferior: </td>
<td align="right">' . number_format($datos24['var1'], 2) . '</td>
</tr>
<tr>
<td>Límite Superior: </td>
<td align="right">' . number_format($datos24['var2'], 2) . '</td>
</tr>
<tr>
<td>% Sobre Exc. L.I.: </td>
<td align="right">' . number_format($datos24['var4'], 2) . '</td>
</tr>
<tr>
<td>Cuota Fija</td>
<td align="right">' . number_format($datos24['var3'], 2) . '</td>
</tr>
</table>


</td>
<td width="50%" valign="top">


Tabla de Subsidio Mensual, proporcional a Días Laborados Reales<br>
Art. 10 Transitorio de la LISR, Subsidio para el empleo*<br>

<table width="100%" summary="" border="0">
<tr>
<td>Límite inferior: </td>
<td align="right">' . number_format($datos27['var1'], 2) . '</td>
</tr>
<tr>
<td>Límite Superior: </td>
<td align="right">' . number_format($datos27['var2'], 2) . '</td>
</tr>
<tr>
<td>Subsidio para el empleo: </td>
<td align="right">' . number_format($datos27['var3'], 2) . '</td>
</tr>
</table>


</td>
</tr>
</table>
<br>
<div align="justify"><font size="1">' . $leyenda . '<br><br>
Fundamentos Legales: Ley del Impuesto Sobre la Renta Art. 93, 94, 95, 96 y 10mo Transitorio Código Fiscal de la Federación Art. 17-A
</font></div>
</div>'; //Actualizado 21 Febrero 2022:  se quito un BR para que quedara sibre la linea

            $mpdf = new mPDF();
            $mpdf->SetHeader('{PAGENO}');
            $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');
            $mpdf->WriteHTML($html); //Actualizado 21 Febrero 2022:  se actualizó cop
            $mpdf->Output('pdf_sueldos_y_salarios(' . $tipo_calculo . ')_siisarh.pdf', 'I');
        }
    }
}
