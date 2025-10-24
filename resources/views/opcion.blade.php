<?php
require_once resource_path('views/config.php');
session_save_path('');
session_start();
?>
<!doctype html>
<html>
@include('config')
@include('funciones')
<?
$GLOBAL_SYSTEM_YEAR = $_COOKIE['year_x1'] ?? 2025;
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="https://f177a821ec10.ngrok-free.app">
    <link href="static/mui.min.css" rel="stylesheet" type="text/css" />
    <link href="static/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-1.8.3.js"></script>
    <script src="//cdn.muicss.com/mui-latest/js/mui.min.js"></script>
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="static/script.js"></script>
    <script src="js/accounting.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.2.min.js"></script>

    <script>
        //paste this code under the head tag or in a separate js file.
        // Wait for window load
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
        jQuery.fn.tooltip = function() {
            xOffset = 10;
            yOffset = 0;
            this.each(function() {
                $(this).hover(function(e) {
                        // Cogemos el valor del tag "title"
                        this.t = this.title;
                        // Ponemos el tag "title" del html vacio para que el navegador no
                        // muestre su tooltip estandard
                        this.title = "";
                        // Añadimos una p con el id="tooltip" para mostrar el texto
                        $("body").append("<p id='tooltip'>" + this.t + "</p>");
                        // Lo posicionamos cerca de la posición del ratón
                        $("#tooltip")
                            .css("top", (e.pageY + yOffset) + "px")
                            .css("left", (e.pageX + xOffset) + "px")
                            .fadeIn();
                    },
                    function() {
                        // Funcion que se ejecuta cuando el raton deja de pasar por encima

                        // Volvemos a poner el titulo en el codigo html
                        this.title = this.t;
                        // eliminamos el id tooltip que hemos añadido al pasar por encima
                        $("#tooltip").remove();
                    });

                // Funcion que se ejecuta cuando nos movemos por encima
                // Posiciona el tooltip justo al lado del mouse
                $(this).mousemove(function(e) {
                    $("#tooltip")
                        .css("top", (e.pageY + yOffset) + "px")
                        .css("left", (e.pageX + xOffset) + "px");
                });
            });
            return this;
        };

        $(document).ready(function() {
            $(".tooltip").tooltip();
        });
    </script>
    <style>
        #tooltip {
            position: absolute;
            border: 1px solid #333;
            background: #000000;
            padding: 2px 5px;
            color: #fff;
            display: none;
            font-size: 12px;
            text-align: justify;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            border: none;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }

        .button {
            background-color: #FFC000;
            /* Green */
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            border-radius: 12px;
        }

        /* Paste this css to your style sheet file or under head tag */
        /* This only works with JavaScript,
if it's not present, don't show loader */
        .no-js #loader {
            display: none;
        }

        .js #loader {
            display: block;
            position: absolute;
            left: 100px;
            top: 0;
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(images/loading-ttcredesign.gif) center no-repeat #fff;
        }
    </style>

    <script type='text/javascript'>
        //<![CDATA[
        $(window).load(function() {
            $('input[name="optionsRadios"]').on('change', function() {
                if ($(this).val() == 'update') {

                    //change to "show update"
                    $("#cont").text("Ingreso Gravable");

                } else {

                    $("#cont").text("Ingreso Neto Deseado");
                }
            });
        }); //]]>
    </script>
    <script type='text/javascript'>
        //<![CDATA[
        $(window).load(function() {
            $(document).ready(function() {
                $("#j_donativos").on("keyup", function() {
                    if ($(this).val().trim() == "")
                        $(this).val(0);
                });
            });

        }); //]]>
    </script>
    <script type='text/javascript'>
        //<![CDATA[
        $(window).load(function() {
            $(document).ready(function() {
                $("#j_aportaciones").on("keyup", function() {
                    if ($(this).val().trim() == "")
                        $(this).val(0);
                });
            });

        }); //]]>
    </script>
    <title>Calculadora de Impuestos | www.ConfiApp.com.mx </title>
</head>

<body>

    <div class="se-pre-con"></div>
    @include('menu')
    <header id="header">
        <div class="mui-appbar mui--appbar-line-height">
            <div class="mui-container-fluid">
                <a
                    class="sidedrawer-toggle mui--visible-xs-inline-block mui--visible-sm-inline-block js-show-sidedrawer">☰</a>
                <a class="sidedrawer-toggle mui--hidden-xs mui--hidden-sm js-hide-sidedrawer">☰</a>
                <? $path = $_SERVER['REQUEST_URI']; ?>
                C. de I.
                <? if ($path == "{{ route('opcion') }}?impuestos=sueldos") {
          echo " | Sueldos y Salarios";
        } ?>
                <? if (isset($_GET['otras'])) {
          echo " | Otras Remuneraciones";
        } ?>
                <? if ($path == "{{ route('opcion') }}?impuestos=sueldos&asimilados=1") {
          echo " | Asimilados a Salarios";
        } ?>
                <? if (isset($_GET['calculo'])) {
          echo " | Honorarios";
        } ?>
                <? if (isset($_GET['impuesto'])) {
          echo " | Impuesto Anual";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=config") {
          echo " | Configuración";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=indice") {
          echo " | Fundamentos Legales";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=buscador") {
          echo " | Fundamentos Legales";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=quienes") {
          echo " | ¿Quiénes Somos?";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=contacto") {
          echo " | Contacto";
        } ?>
                <? if ($path == "{{ route('opcion') }}?pdi=completo") {
          echo " | PDI Completo";
        } ?>
                <? if ($path == "{{ route('opcion') }}?pdi=simulador") {
          echo " | PDI Simulador";
        } ?>
                <? if ($path == "{{ route('opcion') }}?pdi=prestadores") {
          echo " | PDI Prestadores de Servicios";
        } ?>
                <? if ($path == "{{ route('opcion') }}?finiquitos=a96") {
          echo " | Finiquitos Artículo 96";
        } ?>
                <? if ($path == "{{ route('opcion') }}?finiquitos=a174") {
          echo " | Finiquitos Artículo 174";
        } ?>
                <? if ($path == "{{ route('opcion') }}?finiquitos=calc") {
          echo " | Cálculo finiquito";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=tablas") {
          echo " | Tablas de Impuestos Aplicables";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=productos") {
          echo " | Productos";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=faq") {
          echo " | Preguntas Frecuentas (FAQ)";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=recomendar") {
          echo " | Recomiéndanos";
        } ?>
                <? if ($path == "{{ route('opcion') }}?ver=tutoriales") {
          echo " | Tutoriales";
        } ?>
                <img src="./images/logo.png" align="right" />

            </div>
        </div>
    </header>
    <div id="content-wrapper">
        <div class="mui--appbar-height"></div>
        <div class="mui-container-fluid">
            <br>


            <?
      if (isset($_GET['impuestos']) && $_GET['impuestos'] == "sueldos") {
      ?>
            <? if (isset($_GET['asimilados'])) { ?>
            <table>
                <tr>
                    <td bgcolor="#DFF2F0"><strong>
                            <div class="tooltip"
                                title="Algunos contribuyentes ya sean personas físicas o morales, efectúan pagos por ceonceptos asimilados a salarios, ya que las necesidades de la propia empresa, obligan a dicha entidad a efectuar este tipo de pagos por servicios. Hay que recordar que los ingresos asimilados a salarios, son ciertos tipos de ingresos que percibe una persona física, sin ser empleado. es decir no es un trabajador asalariado ya que no reúne algunos de los requisitos para ser considerado como tal, entre otros se encuentran los siguientes: 1.- el asimilado no tiene un horario de trabajo establecido por un patrón. 2.- el asimilado no tiene un puesto definido en la empresa. 3.- el asimilado no tiene un jefe directo en la empresa. 4.- el asimilado no está a disposición de algún patrón en ningún momento, siendo este el requisito fundamental.">
                                Tipo de cálculo<a href="#">-> ?</a></div>
                        </strong>

                        <? } else { ?>
                        <table>
                            <tr>
                                <td bgcolor="#DFF2F0"><strong>
                                        <div class="tooltip"
                                            title="Para efectos del Impuesto sobre la Renta, los salarios son los ingresos que obtienen los trabajadores por la presentación de un servicio personal subordinado, los cuales, además del salario en estricto sentido, incluyen también cualquier prestación que el trabajador obtenga derivado de la relación laboral, tales como la participación de los trabajadores en las utilidades de las empresas y las percepciones recibidas a consecuencia de la terminación laboral. En este contexto, el asalariado es la persona física que percibe salarios y demás prestaciones derivadas de un trabajo personal subordinado a disposición de un empleador.">
                                            Tipo de cálculo<a href="#">-> ?</a></div>
                                    </strong>

                                    <? } ?>
                                </td>
                            </tr>
                        </table>
                        <? if (isset($_GET['asimilados'])) { ?>
                        <form class="mui-form" method="post" action="{{ route('opcion') }}?impuestos=sueldos&fichaid&asimilados">
                            <? } else { ?>
                            <form class="mui-form" method="post" action="{{ route('opcion') }}?impuestos=sueldos&fichaid">
                                <? } ?>

                                <div style="overflow-x:auto;">
                                    <table>
                                        <tr>
                                            <td>

                                                <label class="radio inline">
                                                    <input id="up_radio" type="radio" name="optionsRadios"
                                                        value="update" checked>
                                                    Ordinario
                                                </label>
                                            </td>
                                            <td>
                                                <label class="radio inline">
                                                    <input id="ov_radio" type="radio" name="optionsRadios"
                                                        value="overwritten" disabled>
                                                    Inverso
                                                </label>

                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    <table>
                                        <tr>
                                            <td bgcolor="#DFF2F0"><strong>Datos para el cálculo</strong></td>
                                        </tr>
                                    </table>
                                    <div style="overflow-x:auto;">
                                        <table>
                                            <tr>
                                                <td>Días laborados</td>
                                                <td>
                                                    <div class="mui-textfield"><input name="dias_trabajados"
                                                            type="number"
                                                            value="<? if (isset($_GET['asimilados'])) { ?>30.00<? } ?>"
                                                            required></div>
                                                </td>
                                            </tr>
                                            <? if (isset($_GET['asimilados'])) { ?>

                                            <? } else { ?>
                                            <tr>
                                                <td>Faltas/Incapacidades</td>
                                                <td>
                                                    <div class="mui-textfield"><input name="faltas" type="number"
                                                            placeholder="0" required></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <? } ?>
                                                <td>
                                                    <div id="cont">Ingreso Gravable</div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="ingresos" type="number"
                                                            step=0.01 placeholder="$0.00" required></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    <p>
                                    <div align="center"><button type="submit" class="button">Calcular</button></div>
                                    </p>
                            </form>
                            <?
                    if (isset($_GET['fichaid'])) {
                      $fecha = time();
                      $radio1 = $_POST['optionsRadios'];
                      $flag = $_GET['asimilados'] ?? '';
                      echo $flag;

                      if ($radio1 == "overwritten") {
                        ///////////////////////////////////////////////////////////Comienza inverso////////////////////////////////////////////////////////////////
                        $dias_trabajados = $_POST['dias_trabajados'];
                        $faltas = $_POST['faltas'];
                        $ingresos = $_POST['ingresos'];
                        $dias_trabajados_real = $dias_trabajados - $faltas;
                        $resp1 = mysqli_query($conectar, "select * from tablas_calculo where dias_trabajados='$dias_trabajados_real' and year='$GLOBAL_SYSTEM_YEAR'");
                        $total1 = mysqli_num_rows($resp1);

                        if ($total1 == 0) { ///////////////////////si los datos calculados no existen en las tablas, lo guarda aqui
                          $dias_year = 365;
                          $meses_year = 12;
                          $dias_xmes = round($dias_year / $meses_year, 1);

                          $s1 = 0;
                          $s2 = 0;
                          $s3 = 0;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s1','$s2','$s3','0','1','$GLOBAL_CURRENT_YEAR')");

                          //////////////////////////////////////////////////////////////////////
                          $resp2 = mysqli_query($conectar, "select * from tablas_calculo where id='14'");
                          $datos2 = mysqli_fetch_array($resp2);

                          $op1 = round($datos2['var2'] / $dias_xmes, 2);
                          $op2 = round($op1 * $dias_trabajados_real, 2);
                          $op3 = round($datos2['var3'] / $dias_xmes, 2);
                          $op4 = round($op3 * $dias_trabajados_real, 2);
                          $s4 = $s2 + 0.01;
                          $s5 = $op2;
                          $s6 = $op4;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s4','$s5','$s6','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp2);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp3 = mysqli_query($conectar, "select * from tablas_calculo where id='15'");
                          $datos3 = mysqli_fetch_array($resp3);

                          $op5 = round($datos3['var2'] / $dias_xmes, 2);
                          $op6 = round($op5 * $dias_trabajados_real, 2);
                          $op7 = round($datos3['var3'] / $dias_xmes, 2);
                          $op8 = round($op7 * $dias_trabajados_real, 2);
                          $s7 = $s5 + 0.01;
                          $s8 = $op6;
                          $s9 = $op8;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s7','$s8','$s9','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp3);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp4 = mysqli_query($conectar, "select * from tablas_calculo where id='16'");
                          $datos4 = mysqli_fetch_array($resp4);

                          $op9 = round($datos4['var2'] / $dias_xmes, 2);
                          $op10 = round($op9 * $dias_trabajados_real, 2);
                          $op11 = round($datos4['var3'] / $dias_xmes, 2);
                          $op12 = round($op11 * $dias_trabajados_real, 2);

                          $s10 = $s8 + 0.01;
                          $s11 = $op10;
                          $s12 = $op12;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s10','$s11','$s12','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp4);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp5 = mysqli_query($conectar, "select * from tablas_calculo where id='17'");
                          $datos5 = mysqli_fetch_array($resp5);

                          $op13 = round($datos5['var2'] / $dias_xmes, 2);
                          $op14 = round($op13 * $dias_trabajados_real, 2);
                          $op15 = round($datos5['var3'] / $dias_xmes, 2);
                          $op16 = round($op15 * $dias_trabajados_real, 2);

                          $s13 = $s11 + 0.01;
                          $s14 = $op14;
                          $s15 = $op16;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s13','$s14','$s15','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp5);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp6 = mysqli_query($conectar, "select * from tablas_calculo where id='18'");
                          $datos6 = mysqli_fetch_array($resp6);

                          $op17 = round($datos6['var2'] / $dias_xmes, 2);
                          $op18 = round($op17 * $dias_trabajados_real, 2);
                          $op19 = round($datos6['var3'] / $dias_xmes, 2);
                          $op20 = round($op19 * $dias_trabajados_real, 2);

                          $s16 = $s14 + 0.01;
                          $s17 = $op18;
                          $s18 = $op20;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s16','$s17','$s18','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp6);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp7 = mysqli_query($conectar, "select * from tablas_calculo where id='19'");
                          $datos7 = mysqli_fetch_array($resp7);

                          $op21 = round($datos7['var2'] / $dias_xmes, 2);
                          $op22 = round($op21 * $dias_trabajados_real, 2);
                          $op23 = round($datos7['var3'] / $dias_xmes, 2);
                          $op24 = round($op23 * $dias_trabajados_real, 2);

                          $s19 = $s17 + 0.01;
                          $s20 = $op22;
                          $s21 = $op24;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s19','$s20','$s21','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp7);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp8 = mysqli_query($conectar, "select * from tablas_calculo where id='20'");
                          $datos8 = mysqli_fetch_array($resp8);

                          $op25 = round($datos8['var2'] / $dias_xmes, 2);
                          $op26 = round($op25 * $dias_trabajados_real, 2);
                          $op27 = round($datos8['var3'] / $dias_xmes, 2);
                          $op28 = round($op27 * $dias_trabajados_real, 2);

                          $s22 = $s20 + 0.01;
                          $s23 = $op26;
                          $s24 = $op28;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s22','$s23','$s24','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp8);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp9 = mysqli_query($conectar, "select * from tablas_calculo where id='21'");
                          $datos9 = mysqli_fetch_array($resp9);

                          $op29 = round($datos9['var2'] / $dias_xmes, 2);
                          $op30 = round($op29 * $dias_trabajados_real, 2);
                          $op31 = round($datos9['var3'] / $dias_xmes, 2);
                          $op32 = round($op31 * $dias_trabajados_real, 2);

                          $s25 = $s23 + 0.01;
                          $s26 = $op30;
                          $s27 = $op32;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s25','$s26','$s27','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp9);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp10 = mysqli_query($conectar, "select * from tablas_calculo where id='22'");
                          $datos10 = mysqli_fetch_array($resp10);

                          $op33 = round($datos10['var2'] / $dias_xmes, 2);
                          $op34 = round($op33 * $dias_trabajados_real, 2);
                          $op35 = round($datos10['var3'] / $dias_xmes, 2);
                          $op36 = round($op35 * $dias_trabajados_real, 2);

                          $s28 = $s26 + 0.01;
                          $s29 = $op34;
                          $s30 = $op36;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s28','$s29','$s30','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp10);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp11 = mysqli_query($conectar, "select * from tablas_calculo where id='23'");
                          $datos11 = mysqli_fetch_array($resp11);

                          $op37 = round($datos11['var2'] / $dias_xmes, 2);
                          $op38 = round($op37 * $dias_trabajados_real, 2);
                          $op39 = round($datos11['var3'] / $dias_xmes, 2);
                          $op40 = round($op39 * $dias_trabajados_real, 2);

                          $s31 = $s29 + 0.01;
                          $s32 = $op38;
                          $s33 = $op40;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s31','$s32','$s33','0','1','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp11);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp12 = mysqli_query($conectar, "select * from tablas_calculo where id='24'");
                          $datos12 = mysqli_fetch_array($resp12);

                          $op42 = round("999999999.99", 2);
                          $op43 = round($datos12['var3'] / $dias_xmes, 2);
                          $op44 = round($op43 * $dias_trabajados_real, 2);

                          $s34 = $s32 + 0.01;
                          $s35 = $op42;
                          $s36 = $op44;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s34','9999999.99','$s36','0','1','$GLOBAL_CURRENT_YEAR')")
                            or die(mysqli_error($conectar));
                          mysqli_free_result($resp12);
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////// 22222222222222222222222222222222222222222222222222222222222222222222222222222

                          $s37 = 0;
                          $s38 = 0;
                          $s39 = 0;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s37','$s38','$s39','0.00','2','$GLOBAL_CURRENT_YEAR')");

                          //////////////////////////////////////////////////////////////////////
                          $resp13 = mysqli_query($conectar, "select * from tablas_calculo where id='1229'");
                          $datos13 = mysqli_fetch_array($resp13);

                          $op45 = round($datos13['var2'] / $dias_xmes, 2);
                          $op46 = round($op45 * $dias_trabajados_real, 2);
                          $op47 = round($datos13['var3'] / $dias_xmes, 2);
                          $op48 = round($op47 * $dias_trabajados_real, 2);
                          $s40 = $s38 + 0.01;
                          $s41 = $op46;
                          $s42 = $op48;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s40','$s41','$s42','1.92','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp13);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp14 = mysqli_query($conectar, "select * from tablas_calculo where id='1230'");
                          $datos14 = mysqli_fetch_array($resp14);

                          $op49 = round($datos14['var2'] / $dias_xmes, 2);
                          $op50 = round($op49 * $dias_trabajados_real, 2);
                          $op51 = round($datos14['var3'] / $dias_xmes, 2);
                          $op52 = round($op51 * $dias_trabajados_real, 2);
                          $s43 = $s41 + 0.01;
                          $s44 = $op50;
                          $s45 = $op52;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s43','$s44','$s45','6.40','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp14);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp15 = mysqli_query($conectar, "select * from tablas_calculo where id='1231'");
                          $datos15 = mysqli_fetch_array($resp15);

                          $op53 = round($datos15['var2'] / $dias_xmes, 2);
                          $op54 = round($op53 * $dias_trabajados_real, 2);
                          $op55 = round($datos15['var3'] / $dias_xmes, 2);
                          $op56 = round($op55 * $dias_trabajados_real, 2);

                          $s46 = $s44 + 0.01;
                          $s47 = $op54;
                          $s48 = $op56;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s46','$s47','$s48','10.88','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp15);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp16 = mysqli_query($conectar, "select * from tablas_calculo where id='1232'");
                          $datos16 = mysqli_fetch_array($resp16);

                          $op57 = round($datos16['var2'] / $dias_xmes, 2);
                          $op58 = round($op57 * $dias_trabajados_real, 2);
                          $op59 = round($datos16['var3'] / $dias_xmes, 2);
                          $op60 = round($op59 * $dias_trabajados_real, 2);

                          $s49 = $s47 + 0.01;
                          $s50 = $op58;
                          $s51 = $op60;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s49','$s50','$s51','16.00','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp16);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp17 = mysqli_query($conectar, "select * from tablas_calculo where id='1233'");
                          $datos17 = mysqli_fetch_array($resp17);

                          $op61 = round($datos17['var2'] / $dias_xmes, 2);
                          $op62 = round($op61 * $dias_trabajados_real, 2);
                          $op63 = round($datos17['var3'] / $dias_xmes, 2);
                          $op64 = round($op63 * $dias_trabajados_real, 2);

                          $s52 = $s50 + 0.01;
                          $s53 = $op62;
                          $s54 = $op64;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s52','$s53','$s54','17.92','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp17);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp18 = mysqli_query($conectar, "select * from tablas_calculo where id='1234'");
                          $datos18 = mysqli_fetch_array($resp18);

                          $op65 = round($datos18['var2'] / $dias_xmes, 2);
                          $op66 = round($op65 * $dias_trabajados_real, 2);
                          $op67 = round($datos18['var3'] / $dias_xmes, 2);
                          $op68 = round($op67 * $dias_trabajados_real, 2);

                          $s55 = $s53 + 0.01;
                          $s56 = $op66;
                          $s57 = $op68;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s55','$s56','$s57','21.36','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp18);
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          $resp19 = mysqli_query($conectar, "select * from tablas_calculo where id='1235'");
                          $datos19 = mysqli_fetch_array($resp19);

                          $op69 = round($datos19['var2'] / $dias_xmes, 2);
                          $op70 = round($op69 * $dias_trabajados_real, 2);
                          $op71 = round($datos19['var3'] / $dias_xmes, 2);
                          $op72 = round($op71 * $dias_trabajados_real, 2);

                          $s58 = $s56 + 0.01;
                          $s59 = $op70;
                          $s60 = $op72;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s58','$s59','$s60','23.52','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp19);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp20 = mysqli_query($conectar, "select * from tablas_calculo where id='1236'");
                          $datos20 = mysqli_fetch_array($resp20);

                          $op73 = round($datos20['var2'] / $dias_xmes, 2);
                          $op74 = round($op73 * $dias_trabajados_real, 2);
                          $op75 = round($datos20['var3'] / $dias_xmes, 2);
                          $op76 = round($op75 * $dias_trabajados_real, 2);

                          $s61 = $s59 + 0.01;
                          $s62 = $op74;
                          $s63 = $op76;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s61','$s62','$s63','30.00','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp20);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp21 = mysqli_query($conectar, "select * from tablas_calculo where id='1237'");
                          $datos21 = mysqli_fetch_array($resp21);

                          $op77 = round($datos21['var2'] / $dias_xmes, 2);
                          $op78 = round($op77 * $dias_trabajados_real, 2);
                          $op79 = round($datos21['var3'] / $dias_xmes, 2);
                          $op80 = round($op79 * $dias_trabajados_real, 2);

                          $s64 = $s62 + 0.01;
                          $s65 = $op78;
                          $s66 = $op80;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s64','$s65','$s66','32.00','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp21);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp22 = mysqli_query($conectar, "select * from tablas_calculo where id='1238'");
                          $datos22 = mysqli_fetch_array($resp22);

                          $op81 = round($datos22['var2'] / $dias_xmes, 2);
                          $op82 = round($op81 * $dias_trabajados_real, 2);
                          $op83 = round($datos22['var3'] / $dias_xmes, 2);
                          $op84 = round($op83 * $dias_trabajados_real, 2);

                          $s67 = $s65 + 0.01;
                          $s68 = $op82;
                          $s69 = $op84;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s67','$s68','$s69','34.00','2','$GLOBAL_CURRENT_YEAR')");
                          mysqli_free_result($resp22);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp23 = mysqli_query($conectar, "select * from tablas_calculo where id='1239'");
                          $datos23 = mysqli_fetch_array($resp23);

                          $op85 = round("999999999.99", 2);
                          $op86 = round($datos23['var3'] / $dias_xmes, 2);
                          $op87 = round($op86 * $dias_trabajados_real, 2);

                          $s70 = $s68 + 0.01;
                          $s71 = $op85;
                          $s72 = $op87;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s70','9999999.99','$s72','35.00','2','$GLOBAL_CURRENT_YEAR')")
                            or die(mysqli_error($conectar));
                          mysqli_free_result($resp23);
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////// comienza magia de inverso
                          $valor = inverso($ingresos, $dias_trabajados_real, $GLOBAL_SYSTEM_YEAR);
                          $calculox1 = $ingresos;

                          $var1 = $calculox1 * $valor;
                          $var2 = $calculox1 - $valor;
                          $var3 = $var1 / $var2;
                          $var4 = $var3 + $calculox1;

                          //echo "<br>$calculox1<br>$var1<br>$var2<br>$var3<br>$var4";

                          $i = 0;
                          $i = round($var4, 2);
                          do {
                            //echo "<br><b>$i</b>";
                            $i = round($i, 2) + 0.01;
                            $i2 = $i - inverso($i, $dias_trabajados_real, $GLOBAL_SYSTEM_YEAR);
                          } while (round($ingresos, 2) >= round($i2, 2));

                          $op1 = round($i, 2) - 0.01;
                          //echo "<br><br>";
                          //echo $op1;
                          ///termina magia de inverso
                    ?>
                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>Cálculo de ISR ART 96</strong></td>
                                </tr>
                            </table>
                            <div style="overflow-x:auto;">
                                <table>

                                    <tr>
                                        <td>Días laborados</td>
                                        <td></td>
                                        <td>
                                            <div align="right"><? echo $dias_trabajados; ?></div>
                                        </td>
                                    </tr>

                                    <? if (isset($_GET['asimilados'])) { ?><? } else { ?>

                                    <tr>
                                        <td>Faltas/Incapacidades</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right"><? echo $faltas; ?></div>
                                            <hr>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Días Totales</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right"><? echo $dias_trabajados_real; ?></div><br>
                                        </td>
                                    </tr>

                                    <? } ?>

                                    <tr>
                                        <td><b>Ingreso Gravable</b></td>
                                        <td></td>
                                        <td><b>
                                                <div align="right">$<? echo number_format($op1, 2); ?></div>
                                            </b></td>
                                    </tr>

                                    <tr>
                                        <td>Límite Inferior</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp24 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$op1' order by var1 desc limit 1");
                                  $datos24 = mysqli_fetch_array($resp24);
                                  echo number_format($datos24['var1'], 2);
                                  echo "</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Importe excedente al limite inferior</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal1 = $op1 - $datos24['var1'];
                                  echo number_format($cal1, 2);
                                  mysqli_free_result($resp24);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>(%) para aplicar sobre el excedente</td>
                                        <td><b>x</b></td>
                                        <td>
                                            <div align="right">
                                                <?
                                  $resp25 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$op1' order by var4 desc limit 1");
                                  $datos25 = mysqli_fetch_array($resp25);
                                  echo $datos25['var4'];
                                  echo "%</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto Marginal</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal2 = $cal1 * $datos25['var4'];
                                  $cal3 = $cal2 / 100;
                                  echo number_format(round($cal3, 2), 2);
                                  mysqli_free_result($resp25);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cuota Fija</td>
                                        <td><b>+</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp26 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$op1' order by var4 desc limit 1");
                                  $datos26 = mysqli_fetch_array($resp26);
                                  echo number_format($datos26['var3'], 2);
                                  echo "</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto calculado</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal4 = $cal3 + $datos26['var3'];
                                  echo number_format(round($cal4, 2), 2);
                                  mysqli_free_result($resp26);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Subsidio para el Empleo</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp27 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
                                  $datos27 = mysqli_fetch_array($resp27);
                                  if ($_COOKIE['sub_x1'] == 0) {
                                    echo $datos27['var3'];
                                  } else {
                                    echo "0.00";
                                  }
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <?
                                if ($_COOKIE['sub_x1'] == 0) {
                                  $cal5 = $cal4 - $datos27['var3'];
                                } else {
                                  $cal5 = $cal4;
                                }
                                if ($cal5 > 0) {
                                  echo "<b>ISR DETERMINADO</b>";
                                } else {
                                  echo "<b>SUBSIDIO DETERMINADO</b>";
                                }
                                ?>
                                        </td>
                                        <td><b>=</b></td>
                                        <td>
                                            <?
                                echo "<b><div align=right>$";
                                echo number_format(abs(round($cal5, 2)), 2);
                                echo "</div></b>";
                                echo "<hr>";
                                mysqli_free_result($resp27);
                                ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <?
                          ///////////////////////////////////////////////////////////////////////////////////////////
                        } else { ///pero si si existe, solo lee los datos, ya no los inserta
                          ///////////////////////////////////////////////////////////////////// comienza magia de inverso
                          $valor = inverso($ingresos, $dias_trabajados_real, $GLOBAL_SYSTEM_YEAR);
                          $calculox1 = $ingresos;

                          $var1 = $calculox1 * $valor;
                          $var2 = $calculox1 - $valor;
                          $var3 = $var1 / $var2;
                          $var4 = $var3 + $calculox1;

                          //echo "<br>$calculox1<br>$var1<br>$var2<br>$var3<br>$var4";

                          $i = 0;
                          $i = round($var4, 2);
                          do {
                            //echo "<br><b>$i</b>";
                            $i = round($i, 2) + 0.01;
                            $i2 = $i - inverso($i, $dias_trabajados_real, $GLOBAL_SYSTEM_YEAR);
                          } while (round($ingresos, 2) >= round($i2, 2));

                          $op1 = round($i, 2) - 0.01;
                          //echo "<br><br>";
                          //echo $op1;
                          ///termina magia de inverso
                        ?>
                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>Cálculo de ISR ART 96</strong></td>
                                </tr>
                            </table>
                            <div style="overflow-x:auto;">
                                <table>

                                    <tr>
                                        <td>Días laborados</td>
                                        <td></td>
                                        <td>
                                            <div align="right"><? echo $dias_trabajados; ?></div>
                                        </td>
                                    </tr>
                                    <? if (isset($_GET['asimilados'])) { ?><? } else { ?>
                                    <tr>
                                        <td>Faltas/Incapacidades</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right"><? echo $faltas; ?></div>
                                            <hr>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Días Totales</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right"><? echo $dias_trabajados_real; ?></div><br>
                                        </td>
                                    </tr>
                                    <? } ?>
                                    <tr>
                                        <td><b>Ingreso Gravable</b></td>
                                        <td></td>
                                        <td><b>
                                                <div align="right">$<? echo number_format($op1, 2); ?></div>
                                            </b></td>
                                    </tr>

                                    <tr>
                                        <td>Límite Inferior</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp24 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$op1' order by var1 desc limit 1");
                                  $datos24 = mysqli_fetch_array($resp24);
                                  echo number_format($datos24['var1'], 2);
                                  echo "</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Importe excedente al limite inferior</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal1 = $op1 - $datos24['var1'];
                                  echo number_format($cal1, 2);
                                  mysqli_free_result($resp24);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>(%) para aplicar sobre el excedente</td>
                                        <td><b>x</b></td>
                                        <td>
                                            <div align="right">
                                                <?
                                  $resp25 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$op1' order by var4 desc limit 1");
                                  $datos25 = mysqli_fetch_array($resp25);
                                  echo $datos25['var4'];
                                  echo "%</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto Marginal</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal2 = $cal1 * $datos25['var4'];
                                  $cal3 = $cal2 / 100;
                                  echo number_format(round($cal3, 2), 2);
                                  mysqli_free_result($resp25);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cuota Fija</td>
                                        <td><b>+</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp26 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$op1' order by var4 desc limit 1");
                                  $datos26 = mysqli_fetch_array($resp26);
                                  echo number_format($datos26['var3'], 2);
                                  echo "</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto calculado</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal4 = $cal3 + $datos26['var3'];
                                  echo number_format(round($cal4, 2), 2);
                                  mysqli_free_result($resp26);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Subsidio para el Empleo</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp27 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
                                  $datos27 = mysqli_fetch_array($resp27);
                                  if ($_COOKIE['sub_x1'] == 0) {
                                    echo $datos27['var3'];
                                  } else {
                                    echo "0.00";
                                  }
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <?
                                if ($_COOKIE['sub_x1'] == 0) {
                                  $cal5 = $cal4 - $datos27['var3'];
                                } else {
                                  $cal5 = $cal4;
                                }
                                if ($cal5 > 0) {
                                  echo "<b>ISR DETERMINADO</b>";
                                } else {
                                  echo "<b>SUBSIDIO DETERMINADO</b>";
                                }
                                ?>
                                        </td>
                                        <td><b>=</b></td>
                                        <td>
                                            <?
                                echo "<b><div align=right>$";
                                echo number_format(abs(round($cal5, 2)), 2);
                                echo "</div></b>";
                                echo "<hr>";
                                mysqli_free_result($resp27);
                                ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <?
                        }
                        ///////////////////////////////////////////////////////////Termina Inverso//////////////////////////////////////////////////////////////////
                      } else {

                        $dias_trabajados = $_POST['dias_trabajados'] ?? 0;
                        $faltas = $_POST['faltas'] ?? 0;
                        $ingresos = $_POST['ingresos'] ?? 0.0;
                        $dias_trabajados_real = $dias_trabajados - $faltas;
                        $resp1 = mysqli_query($conectar, "select * from tablas_calculo where dias_trabajados='$dias_trabajados_real' and year='$GLOBAL_SYSTEM_YEAR'");
                        $total1 = mysqli_num_rows($resp1);

                        if ($total1 == 0) { ///////////////////////si los datos calculados no existen en las tablas, lo guarda aqui
                          $dias_year = 365;
                          $meses_year = 12;
                          $dias_xmes = round($dias_year / $meses_year, 1);

                          $s1 = 0;
                          $s2 = 0;
                          $s3 = 0;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s1','$s2','$s3','0','1','$GLOBAL_SYSTEM_YEAR','0')");

                          //////////////////////////////////////////////////////////////////////
                          $resp2 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='1' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos2 = mysqli_fetch_array($resp2);

                          $op1 = round($datos2['var2'] / $dias_xmes, 2);
                          $op2 = round($op1 * $dias_trabajados_real, 2);
                          $op3 = round($datos2['var3'] / $dias_xmes, 2);
                          $op4 = round($op3 * $dias_trabajados_real, 2);
                          $s4 = $s2 + 0.01;
                          $s5 = $op2;
                          $s6 = $op4;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s4','$s5','$s6','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp2);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp3 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='2' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos3 = mysqli_fetch_array($resp3);

                          $op5 = round($datos3['var2'] / $dias_xmes, 2);
                          $op6 = round($op5 * $dias_trabajados_real, 2);
                          $op7 = round($datos3['var3'] / $dias_xmes, 2);
                          $op8 = round($op7 * $dias_trabajados_real, 2);
                          $s7 = $s5 + 0.01;
                          $s8 = $op6;
                          $s9 = $op8;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s7','$s8','$s9','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp3);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp4 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='3' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos4 = mysqli_fetch_array($resp4);

                          $op9 = round($datos4['var2'] / $dias_xmes, 2);
                          $op10 = round($op9 * $dias_trabajados_real, 2);
                          $op11 = round($datos4['var3'] / $dias_xmes, 2);
                          $op12 = round($op11 * $dias_trabajados_real, 2);

                          $s10 = $s8 + 0.01;
                          $s11 = $op10;
                          $s12 = $op12;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s10','$s11','$s12','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp4);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp5 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='4' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos5 = mysqli_fetch_array($resp5);

                          $op13 = round($datos5['var2'] / $dias_xmes, 2);
                          $op14 = round($op13 * $dias_trabajados_real, 2);
                          $op15 = round($datos5['var3'] / $dias_xmes, 2);
                          $op16 = round($op15 * $dias_trabajados_real, 2);

                          $s13 = $s11 + 0.01;
                          $s14 = $op14;
                          $s15 = $op16;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s13','$s14','$s15','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp5);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp6 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='5' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos6 = mysqli_fetch_array($resp6);

                          $op17 = round($datos6['var2'] / $dias_xmes, 2);
                          $op18 = round($op17 * $dias_trabajados_real, 2);
                          $op19 = round($datos6['var3'] / $dias_xmes, 2);
                          $op20 = round($op19 * $dias_trabajados_real, 2);

                          $s16 = $s14 + 0.01;
                          $s17 = $op18;
                          $s18 = $op20;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s16','$s17','$s18','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp6);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp7 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='6' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos7 = mysqli_fetch_array($resp7);

                          $op21 = round($datos7['var2'] / $dias_xmes, 2);
                          $op22 = round($op21 * $dias_trabajados_real, 2);
                          $op23 = round($datos7['var3'] / $dias_xmes, 2);
                          $op24 = round($op23 * $dias_trabajados_real, 2);

                          $s19 = $s17 + 0.01;
                          $s20 = $op22;
                          $s21 = $op24;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s19','$s20','$s21','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp7);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp8 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='7' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos8 = mysqli_fetch_array($resp8);

                          $op25 = round($datos8['var2'] / $dias_xmes, 2);
                          $op26 = round($op25 * $dias_trabajados_real, 2);
                          $op27 = round($datos8['var3'] / $dias_xmes, 2);
                          $op28 = round($op27 * $dias_trabajados_real, 2);

                          $s22 = $s20 + 0.01;
                          $s23 = $op26;
                          $s24 = $op28;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s22','$s23','$s24','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp8);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp9 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='8' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos9 = mysqli_fetch_array($resp9);

                          $op29 = round($datos9['var2'] / $dias_xmes, 2);
                          $op30 = round($op29 * $dias_trabajados_real, 2);
                          $op31 = round($datos9['var3'] / $dias_xmes, 2);
                          $op32 = round($op31 * $dias_trabajados_real, 2);

                          $s25 = $s23 + 0.01;
                          $s26 = $op30;
                          $s27 = $op32;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s25','$s26','$s27','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp9);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp10 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='9' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos10 = mysqli_fetch_array($resp10);

                          $op33 = round($datos10['var2'] / $dias_xmes, 2);
                          $op34 = round($op33 * $dias_trabajados_real, 2);
                          $op35 = round($datos10['var3'] / $dias_xmes, 2);
                          $op36 = round($op35 * $dias_trabajados_real, 2);

                          $s28 = $s26 + 0.01;
                          $s29 = $op34;
                          $s30 = $op36;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s28','$s29','$s30','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp10);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp11 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='10' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos11 = mysqli_fetch_array($resp11);

                          $op37 = round($datos11['var2'] / $dias_xmes, 2);
                          $op38 = round($op37 * $dias_trabajados_real, 2);
                          $op39 = round($datos11['var3'] / $dias_xmes, 2);
                          $op40 = round($op39 * $dias_trabajados_real, 2);

                          $s31 = $s29 + 0.01;
                          $s32 = $op38;
                          $s33 = $op40;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s31','$s32','$s33','0','1','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp11);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp12 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLA SUBSIDIO FIJA' and nivel='11' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos12 = mysqli_fetch_array($resp12);

                          $op42 = round("999999999.99", 2);
                          $op43 = round($datos12['var3'] / $dias_xmes, 2);
                          $op44 = round($op43 * $dias_trabajados_real, 2);

                          $s34 = $s32 + 0.01;
                          $s35 = $op42;
                          $s36 = $op44;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA SUBSIDIO VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s34','9999999.99','$s36','0','1','$GLOBAL_SYSTEM_YEAR','0')")
                            or die(mysqli_error($conectar));
                          mysqli_free_result($resp12);
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////// 22222222222222222222222222222222222222222222222222222222222222222222222222222

                          $s37 = 0;
                          $s38 = 0;
                          $s39 = 0;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s37','$s38','$s39','0.00','2','$GLOBAL_SYSTEM_YEAR','0')");

                          //////////////////////////////////////////////////////////////////////
                          $resp13 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='1' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos13 = mysqli_fetch_array($resp13);

                          $op45 = round($datos13['var2'] / $dias_xmes, 2);
                          $op46 = round($op45 * $dias_trabajados_real, 2);
                          $op47 = round($datos13['var3'] / $dias_xmes, 2);
                          $op48 = round($op47 * $dias_trabajados_real, 2);
                          $s40 = $s38 + 0.01;
                          $s41 = $op46;
                          $s42 = $op48;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s40','$s41','$s42','1.92','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp13);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp14 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='2' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos14 = mysqli_fetch_array($resp14);

                          $op49 = round($datos14['var2'] / $dias_xmes, 2);
                          $op50 = round($op49 * $dias_trabajados_real, 2);
                          $op51 = round($datos14['var3'] / $dias_xmes, 2);
                          $op52 = round($op51 * $dias_trabajados_real, 2);
                          $s43 = $s41 + 0.01;
                          $s44 = $op50;
                          $s45 = $op52;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s43','$s44','$s45','6.40','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp14);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp15 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='3' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos15 = mysqli_fetch_array($resp15);

                          $op53 = round($datos15['var2'] / $dias_xmes, 2);
                          $op54 = round($op53 * $dias_trabajados_real, 2);
                          $op55 = round($datos15['var3'] / $dias_xmes, 2);
                          $op56 = round($op55 * $dias_trabajados_real, 2);

                          $s46 = $s44 + 0.01;
                          $s47 = $op54;
                          $s48 = $op56;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s46','$s47','$s48','10.88','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp15);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp16 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='4' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos16 = mysqli_fetch_array($resp16);

                          $op57 = round($datos16['var2'] / $dias_xmes, 2);
                          $op58 = round($op57 * $dias_trabajados_real, 2);
                          $op59 = round($datos16['var3'] / $dias_xmes, 2);
                          $op60 = round($op59 * $dias_trabajados_real, 2);

                          $s49 = $s47 + 0.01;
                          $s50 = $op58;
                          $s51 = $op60;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s49','$s50','$s51','16.00','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp16);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp17 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='5' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos17 = mysqli_fetch_array($resp17);

                          $op61 = round($datos17['var2'] / $dias_xmes, 2);
                          $op62 = round($op61 * $dias_trabajados_real, 2);
                          $op63 = round($datos17['var3'] / $dias_xmes, 2);
                          $op64 = round($op63 * $dias_trabajados_real, 2);

                          $s52 = $s50 + 0.01;
                          $s53 = $op62;
                          $s54 = $op64;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s52','$s53','$s54','17.92','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp17);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp18 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='6' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos18 = mysqli_fetch_array($resp18);

                          $op65 = round($datos18['var2'] / $dias_xmes, 2);
                          $op66 = round($op65 * $dias_trabajados_real, 2);
                          $op67 = round($datos18['var3'] / $dias_xmes, 2);
                          $op68 = round($op67 * $dias_trabajados_real, 2);

                          $s55 = $s53 + 0.01;
                          $s56 = $op66;
                          $s57 = $op68;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s55','$s56','$s57','21.36','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp18);
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          $resp19 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='7' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos19 = mysqli_fetch_array($resp19);

                          $op69 = round($datos19['var2'] / $dias_xmes, 2);
                          $op70 = round($op69 * $dias_trabajados_real, 2);
                          $op71 = round($datos19['var3'] / $dias_xmes, 2);
                          $op72 = round($op71 * $dias_trabajados_real, 2);

                          $s58 = $s56 + 0.01;
                          $s59 = $op70;
                          $s60 = $op72;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s58','$s59','$s60','23.52','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp19);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp20 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='8' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos20 = mysqli_fetch_array($resp20);

                          $op73 = round($datos20['var2'] / $dias_xmes, 2);
                          $op74 = round($op73 * $dias_trabajados_real, 2);
                          $op75 = round($datos20['var3'] / $dias_xmes, 2);
                          $op76 = round($op75 * $dias_trabajados_real, 2);

                          $s61 = $s59 + 0.01;
                          $s62 = $op74;
                          $s63 = $op76;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s61','$s62','$s63','30.00','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp20);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp21 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='9' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos21 = mysqli_fetch_array($resp21);

                          $op77 = round($datos21['var2'] / $dias_xmes, 2);
                          $op78 = round($op77 * $dias_trabajados_real, 2);
                          $op79 = round($datos21['var3'] / $dias_xmes, 2);
                          $op80 = round($op79 * $dias_trabajados_real, 2);

                          $s64 = $s62 + 0.01;
                          $s65 = $op78;
                          $s66 = $op80;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s64','$s65','$s66','32.00','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp21);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp22 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='10' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos22 = mysqli_fetch_array($resp22);

                          $op81 = round($datos22['var2'] / $dias_xmes, 2);
                          $op82 = round($op81 * $dias_trabajados_real, 2);
                          $op83 = round($datos22['var3'] / $dias_xmes, 2);
                          $op84 = round($op83 * $dias_trabajados_real, 2);

                          $s67 = $s65 + 0.01;
                          $s68 = $op82;
                          $s69 = $op84;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s67','$s68','$s69','34.00','2','$GLOBAL_SYSTEM_YEAR','0')");
                          mysqli_free_result($resp22);
                          /////////////////////////////////////////////////////////////////////
                          //////////////////////////////////////////////////////////////////////
                          $resp23 = mysqli_query($conectar, "select * from tablas_calculo where fecha='0' and nombre_tabla='TABLAS MENSUALES FIJA' and nivel='11' and year='$GLOBAL_SYSTEM_YEAR'");
                          $datos23 = mysqli_fetch_array($resp23);

                          $op85 = round("999999999.99", 2);
                          $op86 = round($datos23['var3'] / $dias_xmes, 2);
                          $op87 = round($op86 * $dias_trabajados_real, 2);

                          $s70 = $s68 + 0.01;
                          $s71 = $op85;
                          $s72 = $op87;
                          mysqli_query($conectar, "insert into tablas_calculo (fecha,nombre_tabla,dias_year,meses_year,dias_xmes,dias_trabajados,var1,var2,var3,var4,flag,year,nivel)
values ('$fecha','TABLA IMPUESTO ISR VARIABLE','$dias_year','$meses_year','$dias_xmes','$dias_trabajados_real','$s70','9999999.99','$s72','35.00','2','$GLOBAL_SYSTEM_YEAR','0')")
                            or die(mysqli_error($conectar));
                          mysqli_free_result($resp23);
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                          /////////////////////////////////////////////////////////////////////
                        ?>
                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>Cálculo de ISR ART 96</strong></td>
                                </tr>
                            </table>
                            <div style="overflow-x:auto;">
                                <table>

                                    <tr>
                                        <td>Días laborados</td>
                                        <td></td>
                                        <td>
                                            <div align="right"><? echo $dias_trabajados; ?></div>
                                        </td>
                                    </tr>
                                    <? if (isset($_GET['asimilados'])) { ?><? } else { ?>
                                    <tr>
                                        <td>Faltas/Incapacidades</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right"><? echo $faltas; ?></div>
                                            <hr>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Días Totales</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right"><? echo $dias_trabajados_real; ?></div><br>
                                        </td>
                                    </tr>
                                    <? } ?>
                                    <tr>
                                        <td><b>Ingreso Gravable</b></td>
                                        <td></td>
                                        <td><b>
                                                <div align="right">$<? echo number_format($ingresos, 2); ?></div>
                                            </b></td>
                                    </tr>

                                    <tr>
                                        <td>Límite Inferior</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp24 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var1 desc limit 1");
                                  $datos24 = mysqli_fetch_array($resp24);
                                  echo number_format($datos24['var1'], 2);
                                  echo "</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Importe excedente al limite inferior</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal1 = $ingresos - $datos24['var1'];
                                  echo number_format($cal1, 2);
                                  mysqli_free_result($resp24);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>(%) para aplicar sobre el excedente</td>
                                        <td><b>x</b></td>
                                        <td>
                                            <div align="right">
                                                <?
                                  $resp25 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
                                  $datos25 = mysqli_fetch_array($resp25);
                                  echo $datos25['var4'];
                                  echo "%</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto Marginal</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal2 = $cal1 * $datos25['var4'];
                                  $cal3 = $cal2 / 100;
                                  echo number_format(round($cal3, 2), 2);
                                  mysqli_free_result($resp25);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cuota Fija</td>
                                        <td><b>+</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp26 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
                                  $datos26 = mysqli_fetch_array($resp26);
                                  echo number_format($datos26['var3'], 2);
                                  echo "</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto calculado</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal4 = $cal3 + $datos26['var3'];
                                  echo number_format(round($cal4, 2), 2);
                                  mysqli_free_result($resp26);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Subsidio para el Empleo</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp27 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' and var1 != 0 order by var3 asc limit 1");

                                  $datos27 = mysqli_fetch_array($resp27);
                                  if ($_COOKIE['sub_x1'] == 0) {
                                    echo $datos27['var3'];
                                  } else {
                                    echo "0.00";
                                  }
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <?
                                if ($_COOKIE['sub_x1'] == 0) {
                                  $cal5 = $cal4 - $datos27['var3'];
                                } else {
                                  $cal5 = $cal4;
                                }
                                if ($cal5 > 0) {
                                  echo "<b>ISR DETERMINADO</b>";
                                } else {
                                  echo "<b>SUBSIDIO DETERMINADO</b>";
                                }
                                ?>
                                        </td>
                                        <td><b>=</b></td>
                                        <td>
                                            <?
                                echo "<b><div align=right>$";
                                echo number_format(abs(round($cal5, 2)), 2);
                                echo "</div></b>";
                                echo "<hr>";
                                mysqli_free_result($resp27);
                                ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <?
                          ///////////////////////////////////////////////////////////////////////////////////////////
                        } else { ///pero si si existe, solo lee los datos, ya no los inserta
                        ?>
                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>Cálculo de ISR ART 96</strong></td>
                                </tr>
                            </table>
                            <div style="overflow-x:auto;">
                                <table>

                                    <tr>
                                        <td>Días laborados</td>
                                        <td></td>
                                        <td>
                                            <div align="right"><? echo $dias_trabajados; ?></div>
                                        </td>
                                    </tr>
                                    <? if (isset($_GET['asimilados'])) { ?><? } else { ?>
                                    <tr>
                                        <td>Faltas/Incapacidades</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right"><? echo $faltas; ?></div>
                                            <hr>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Días Totales</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right"><? echo $dias_trabajados_real; ?></div><br>
                                        </td>
                                    </tr>
                                    <? } ?>
                                    <tr>
                                        <td><b>Ingreso Gravable</b></td>
                                        <td></td>
                                        <td><b>
                                                <div align="right">$<? echo number_format($ingresos, 2); ?></div>
                                            </b></td>
                                    </tr>

                                    <tr>
                                        <td>Límite Inferior</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp24 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var1 desc limit 1");
                                  $datos24 = mysqli_fetch_array($resp24);
                                  echo number_format($datos24['var1'] ?? '0.0', 2);
                                  echo "</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Importe excedente al limite inferior</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal1 = $ingresos - ($datos24['var1'] ?? 0);
                                  echo number_format($cal1, 2);
                                  mysqli_free_result($resp24);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>(%) para aplicar sobre el excedente</td>
                                        <td><b>x</b></td>
                                        <td>
                                            <div align="right">
                                                <?
                                  $resp25 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
                                  $datos25 = mysqli_fetch_array($resp25);
                                  echo $datos25['var4'] ?? '0';
                                  echo "%</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto Marginal</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal2 = $cal1 * ($datos25['var4'] ?? 0);
                                  $cal3 = $cal2 / 100;
                                  echo number_format(round($cal3, 2), 2);
                                  mysqli_free_result($resp25);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cuota Fija</td>
                                        <td><b>+</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp26 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' order by var4 desc limit 1");
                                  $datos26 = mysqli_fetch_array($resp26);
                                  echo number_format($datos26['var3'] ?? '0.0', 2);
                                  echo "</div><br><hr>";
                                  ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto calculado</td>
                                        <td><b>=</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $cal4 = $cal3 + ($datos26['var3'] ?? 0);
                                  echo number_format(round($cal4, 2), 2);
                                  mysqli_free_result($resp26);
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Subsidio para el Empleo</td>
                                        <td><b>-</b></td>
                                        <td>
                                            <div align="right">$
                                                <?
                                  $resp27 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and
dias_trabajados='$dias_trabajados_real' and var1 between '0' and '$ingresos' and var1 != 0 order by var3 asc limit 1");
                                  $datos27 = mysqli_fetch_array($resp27);
                                  if ($_COOKIE['sub_x1'] == 0) {
                                    echo $datos27['var3'];
                                  } else {
                                    echo "0.00";
                                  }
                                  ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <?
                                if ($_COOKIE['sub_x1'] == 0) {
                                  $cal5 = $cal4 - $datos27['var3'];
                                } else {
                                  $cal5 = $cal4;
                                }
                                if ($cal5 > 0) {
                                  echo "<b>ISR DETERMINADO</b>";
                                } else {
                                  echo "<b>SUBSIDIO DETERMINADO</b>";
                                }
                                ?>
                                        </td>
                                        <td><b>=</b></td>
                                        <td>
                                            <?
                                echo "<b><div align=right>$";
                                echo number_format(abs(round($cal5, 2)), 2);
                                echo "</div></b>";
                                echo "<hr>";
                                mysqli_free_result($resp27);
                                ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <?
                        }
                      }
                      ?>
                            <p>
                            <div align="center">
                                <? if (isset($_GET['asimilados'])) {
                          if ($radio1 == "overwritten") {
                        ?>
                                <a href='{{ route('pdf_asimilados_salarios') }}?tipo=<? echo $radio1; ?>&pdf=yes&dias=<? echo $dias_trabajados; ?>&faltas=<? echo $faltas; ?>&ingresos=<? echo $op1; ?>&name=<? echo $_COOKIE['name_x1'];
                                    ?>&var44=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $_COOKIE['year_x1']; ?>'
                                    target='_SEJ'>Imprimir Cálculo</a>
                                <?
                          } else {
                          ?>
                                <a href='{{ route('pdf_asimilados_salarios') }}?tipo=<? echo $radio1; ?>&pdf=yes&dias=<? echo $dias_trabajados; ?>&faltas=<? echo $faltas; ?>&ingresos=<? echo $ingresos; ?>&name=<? echo $_COOKIE['name_x1'];
                                    ?>&var44=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $_COOKIE['year_x1']; ?>'
                                    target='_SEJ'>Imprimir Cálculo</a>
                                <?
                          }
                        } else {
                          if ($radio1 == "overwritten") { ?>
                                <a href='{{ route('pdf_sueldos_y_salarios') }}?tipo=<? echo $radio1; ?>&pdf=yes&dias=<? echo $dias_trabajados; ?>&faltas=<? echo $faltas; ?>&ingresos=<? echo $op1; ?>&name=<? echo $_COOKIE['name_x1'];
                                    ?>&var44=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $_COOKIE['year_x1']; ?>'
                                    target='_SEJ'>Imprimir Cálculo</a>
                                <? } else {
                          ?>
                                <a href='{{ route('pdf_sueldos_y_salarios') }}?tipo=<? echo $radio1; ?>&pdf=yes&dias=<? echo $dias_trabajados; ?>&faltas=<? echo $faltas; ?>&ingresos=<? echo $ingresos; ?>&name=<? echo $_COOKIE['name_x1'];
                                    ?>&var44=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $_COOKIE['year_x1']; ?>'
                                    target='_SEJ'>Imprimir Cálculo</a>

                                <?
                          }
                        } ?>
                                &nbsp;

                                <? if (isset($_GET['asimilados'])) { ?>
                                <form class="mui-form" method="post"
                                    action="{{ route('opcion') }}?impuestos=sueldos2&tablas=<? echo $dias_trabajados_real; ?>&asimilados">
                                    <? } else { ?>
                                    <form target="_blank" class="mui-form" method="post"
                                        action="{{ route('pdf_tablas_sueldos_y_salarios') }}?pdf=yes&dias=<? echo $dias_trabajados_real; ?>&year=<? echo $GLOBAL_SYSTEM_YEAR ?>">
                                        <? } ?>
                                        <input type="hidden" value="<? echo $_POST['optionsRadios'] ?>"
                                            name="optionsRadios" />
                                        <input type="hidden" value="<? echo $_POST['dias_trabajados'] ?>"
                                            name="dias_trabajados" />
                                        <input type="hidden" value="<? echo $_POST['faltas'] ?? '0' ?>" name="faltas" />
                                        <input type="hidden" value="<? echo $_POST['ingresos'] ?? '0.0' ?>"
                                            name="ingresos" />
                                        <button type="submit" class="mui-btn mui-btn--raised">Imprimir
                                            Tablas</button>
                                    </form>
                            </div>
                            </p>

                            <?
                    }
                  }
                  if (isset($_GET['impuestos']) && $_GET['impuestos'] == "sueldos2") {
                    if (isset($_GET['tablas'])) {
                    ?>
                            <? if (isset($_GET['asimilados'])) { ?>
                            <form class="mui-form" method="post"
                                action="{{ route('opcion') }}?impuestos=sueldos&fichaid&asimilados">
                                <? } else { ?>
                                <form class="mui-form" method="post" action="{{ route('opcion') }}?impuestos=sueldos&fichaid">
                                    <? } ?>
                                    <input type="hidden" value="<? echo $_POST['optionsRadios'] ?>"
                                        name="optionsRadios" />
                                    <input type="hidden" value="<? echo $_POST['dias_trabajados'] ?>"
                                        name="dias_trabajados" />
                                    <input type="hidden" value="<? echo $_POST['faltas'] ?>" name="faltas" />
                                    <input type="hidden" value="<? echo $_POST['ingresos'] ?>" name="ingresos" />
                                    <p>
                                    <div align="center"><button type="submit" class="button"><- Regresar</button>
                                    </div>
                                    </p>
                                </form>
                                <?
                          $dias_trabajados_real = $_GET['tablas'];
                          $resp = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and dias_trabajados='$dias_trabajados_real' order by var1 asc limit 12");
                          $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO ISR VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and dias_trabajados='$dias_trabajados_real' order by var1 asc limit 12");
                          $datos2 = mysqli_fetch_array($resp2);
                          ?>
                                <br><br><br>
                                <table border="1">
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
                                        <td>
                                            <div align="center">
                                                <? echo $datos2['dias_year'] ?></div>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <? echo $datos2['meses_year'] ?></div>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <? echo $datos2['dias_xmes'] ?></div>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <? echo $datos2['dias_trabajados'] ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div align="center"><strong>Tabla en base a días de cálculo</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div align="center"><strong>Tabla Impuesto ISR</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            <div align="center"><b>Límite Inferior</b></div>
                                        </td>
                                        <td rowspan="2">
                                            <div align="center"><b>Límite Superior</b></div>
                                        </td>
                                        <td rowspan="2">
                                            <div align="center"><b>Cuota Fija</b></div>
                                        </td>
                                        <td rowspan="2">
                                            <div align="center"><b>% Para aplicarse s/excedente del límite inferior</b>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <?
                            mysqli_free_result($resp2);
                            while ($datos = mysqli_fetch_array($resp)) {
                            ?>
                                    <tr>
                                        <td>
                                            <div align="center">$<? echo number_format($datos['var1'], 2); ?></div>
                                        </td>
                                        <td>
                                            <div align="center">$<? echo number_format($datos['var2'], 2); ?></div>
                                        </td>
                                        <td>
                                            <div align="center">$<? echo number_format($datos['var3'], 2); ?></div>
                                        </td>
                                        <td>
                                            <div align="center"><? echo number_format($datos['var4'], 2); ?>%</div>
                                        </td>

                                    </tr>
                                    <?
                            }
                            mysqli_free_result($resp);
                            ?>
                                </table>
                                <hr><br>
                                <hr>






                                <?
                          $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO VARIABLE' and year='$GLOBAL_SYSTEM_YEAR' and dias_trabajados='$dias_trabajados_real' order by var1 asc limit 12");
                          ?>
                                <table border="1">
                                    <tr>
                                        <td colspan="4">
                                            <div align="center"><strong>Tabla Subsidio</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            <div align="center"><b>Para Ingresos De</b></div>
                                        </td>
                                        <td rowspan="2">
                                            <div align="center"><b>Hasta Ingresos De</b></div>
                                        </td>
                                        <td rowspan="2">
                                            <div align="center"><b>Subsidio al Empleo</b></div>
                                        </td>
                                        <td rowspan="2">

                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <?
                            while ($datos3 = mysqli_fetch_array($resp3)) {
                            ?>
                                    <tr>
                                        <td>
                                            <div align="center">$<? echo number_format($datos3['var1'], 2); ?></div>
                                        </td>
                                        <td>
                                            <div align="center">$<? echo number_format($datos3['var2'], 2); ?></div>
                                        </td>
                                        <td>
                                            <div align="center">$<? echo number_format($datos3['var3'], 2); ?></div>
                                        </td>
                                        <td>

                                        </td>

                                    </tr>
                                    <?
                            }
                            mysqli_free_result($resp3);
                            ?>
                                </table>
                                <hr><br>
                                <hr>




                                <?
                          $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR' order by var1 asc limit 12");
                          ?>
                                <table border="1">
                                    <tr>
                                        <td colspan="4">
                                            <div align="center"><strong>Tablas Mensuales</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div align="center"><strong>Tabla Impuesto ISR</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            <div align="center"><b>Límite Inferior</b></div>
                                        </td>
                                        <td rowspan="2">
                                            <div align="center"><b>Límite Superior</b></div>
                                        </td>
                                        <td rowspan="2">
                                            <div align="center"><b>Cuota Fija</b></div>
                                        </td>
                                        <td rowspan="2">
                                            <div align="center"><b>% Para aplicarse s/excedente del límite inferior</b>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <?
                            while ($datos4 = mysqli_fetch_array($resp4)) {
                            ?>
                                    <tr>
                                        <td>
                                            <div align="center">$<? echo number_format($datos4['var1'], 2); ?></div>
                                        </td>
                                        <td>
                                            <div align="center">$<? echo number_format($datos4['var2'], 2); ?></div>
                                        </td>
                                        <td>
                                            <div align="center">$<? echo number_format($datos4['var3'], 2); ?></div>
                                        </td>
                                        <td>
                                            <div align="center"><? echo number_format($datos4['var4'], 2); ?>%</div>
                                        </td>
                                    </tr>
                                    <?
                            }
                            echo "</table>";
                            mysqli_free_result($resp4);
                            ?>
                                    <hr><br>
                                    <hr>


                                    <?
                            $resp5 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$GLOBAL_SYSTEM_YEAR' order by var1 asc limit 12");
                            ?>
                                    <table border="1">
                                        <tr>
                                            <td colspan="4">
                                                <div align="center"><strong>Tabla Subsidio</strong></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">
                                                <div align="center"><b>Para Ingresos De</b></div>
                                            </td>
                                            <td rowspan="2">
                                                <div align="center"><b>Hasta Ingresos De</b></div>
                                            </td>
                                            <td rowspan="2">
                                                <div align="center"><b>Subsidio al Empleo</b></div>
                                            </td>
                                            <td rowspan="2">

                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                        <?
                              while ($datos5 = mysqli_fetch_array($resp5)) {
                              ?>
                                        <tr>
                                            <td>
                                                <div align="center">$<? echo number_format($datos5['var1'], 2); ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="center">$<? echo number_format($datos5['var2'], 2); ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div align="center">$<? echo number_format($datos5['var3'], 2); ?>
                                                </div>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <?
                              }
                              echo "</table>";
                              ?>
                                        <form target="_blank" class="mui-form" method="post"
                                            action="{{ route('pdf_tablas_sueldos_y_salarios') }}?pdf=yes&dias=<? echo $dias_trabajados_real; ?>&year=<? echo $GLOBAL_SYSTEM_YEAR ?>">
                                            <p>
                                            <div align="center"><button type="submit"
                                                    class="mui-btn mui-btn--raised">Imprimir tablas</button></div>
                                            </p>
                                        </form>
                                        <?
                              mysqli_free_result($resp5);
                              ?>
                                        <hr>
                                        <?
                          }
                        }
                        if (isset($_GET['calculo']) && $_GET['calculo'] == "honorarios") {
                            ?>
                                        <form class="mui-form" method="post"
                                            action="{{ route('opcion') }}?calculo=honorarios&fichaid">

                                            <table>
                                                <tr>
                                                    <td bgcolor="#DFF2F0"><strong>
                                                            <div class="tooltip"
                                                                title="Cuando los contribuyentes presten servicios profesionales a las personas morales, éstas deberán retener, como pago provisional, el monto que resulte de aplicar la tasa del 10% sobre el monto de los pagos que les efectúen, sin deducción alguna, debiendo proporcionar a los contribuyentes constancia de la retención; dichas retenciones deberán enterarse, en su caso, conjuntamente con las señaladas en el artículo 113 de esta ley. El impuesto retenido en los términos de este párrafo será acreditable contra el impuesto a pagar que resulte en los pagos provisionales de conformidad con este artículo 127. Están obligados a efectuar la retención del impuesto que se les traslade, los contribuyentes que se ubiquen en alguno de los siguientes supuestos: reciban servicios personales independientes, o usen o gocen temporalmente bienes, prestados u otorgados por personas físicas, respectivamente. Para el IVA la retención es de dos terceras partes (16% /3 por 2=2 10.67% aprox.)">
                                                                Tipo de cálculo<a href="#">-> ?</a></div>
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table>
                                                <tr>
                                                    <td>
                                                        <label class="radio inline">
                                                            <input id="up_radio" type="radio"
                                                                name="optionsRadios3" value="0" checked>
                                                            Bruto
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="radio inline">
                                                            <input id="ov_radio" type="radio"
                                                                name="optionsRadios3" value="1">
                                                            Neto
                                                        </label>

                                                    </td>
                                                </tr>
                                            </table>
                                            <br>
                                            <br><br>
                                            <table>
                                                <tr>
                                                    <td bgcolor="#DFF2F0"><strong>Datos para el cálculo</strong></td>
                                                </tr>
                                            </table>

                                            <div style="overflow-x:auto;">
                                                <table>
                                                    <tr>
                                                        <td>Importe</td>
                                                        <td>
                                                            <div class="mui-textfield"><input name="monto"
                                                                    type="number" step=0.01 placeholder="$0.00"
                                                                    required></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <br><br>
                                            <p>
                                            <div align="center"><button type="submit"
                                                    class="button">Calcular</button></div>
                                            </p>
                                        </form>
                                        <?

                            if (isset($_GET['fichaid'])) {
                              $radio2 = $_POST['optionsRadios3'];

                              if ($radio2 == 1) {

                                $valor = honorarios($_POST['monto']);

                                $calculox1 = $_POST['monto'];

                                $calculo_x1 = $calculox1 / $valor;
                                $calculo_x2 = $calculo_x1 * $calculox1;

                                if ($calculox1 == 1000) {
                                  $op1 = $calculo_x2 + 0.01;
                                } else {
                                  $op1 = $calculo_x2;
                                }


                                //este es el que se ocupa
                                //echo round($op1,2);
                                //$TEST = round(honorarios($i),2)-0.01;
                                //echo "<br>";
                                //echo round($TEST,2);
                                $cal1 = round($op1 * 0.16, 2);
                                $cal2 = $op1 + $cal1;
                                $cal3 = round($cal2, 2);
                                $cal4 = round($op1 * 0.10, 2);
                                $cal5 = round($cal1 * 0.666667, 2);
                                $cal6 = $cal3 - $cal4 - $cal5;
                                $cal7 = round($cal6, 2);
                            ?>
                                        <table>
                                            <tr>
                                                <td bgcolor="#DFF2F0"><strong>Cálculo de ISR</strong></td>
                                            </tr>
                                        </table>
                                        <div style="overflow-x:auto;">
                                            <table>

                                                <tr>
                                                    <td>Importe</td>
                                                    <td></td>
                                                    <td><? echo number_format($op1, 2); ?></td>
                                                </tr>

                                                <tr>
                                                    <td>IVA (16%)</td>
                                                    <td><b>+</b></td>
                                                    <td><? echo number_format($cal1, 2); ?>
                                                        <hr>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td><b>=</b></td>
                                                    <td><? echo number_format($cal3, 2); ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Retención de ISR (10%)</td>
                                                    <td><b>-</b></td>
                                                    <td><? echo number_format($cal4, 2); ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Retención de IVA (2/3 Partes)</td>
                                                    <td><b>-</b></td>
                                                    <td><? echo number_format($cal5, 2); ?></td>
                                                </tr>

                                                <tr>
                                                    <td><b>Total</b></td>
                                                    <td><b>=</b></td>
                                                    <td><? echo number_format($cal7, 2); ?>
                                                        <hr>
                                                    </td>
                                                </tr>

                                            </table>
                                            <br>
                                            <form target="_blank" class="mui-form" method="post"
                                                action="{{ route('pdf_honorarios') }}?pdf=yes&monto=<? echo round($op1, 2); ?>&tipo=0&name=<? echo $_COOKIE['name_x1']; ?>">
                                                <p>
                                                <div align="center"><button type="submit"
                                                        class="mui-btn mui-btn--raised">Imprimir</button></div>
                                                </p>
                                            </form>
                                            <?
                              } else {

                                $calculox1 = $_POST['monto'];
                                $cal1 = round($calculox1 * 0.16, 2);
                                $cal2 = $calculox1 + $cal1;
                                $cal3 = round($cal2, 2);
                                $cal4 = round($calculox1 * 0.10, 2);
                                $cal5 = round($cal1 * 0.666667, 2);
                                $cal6 = $cal3 - $cal4 - $cal5;
                                $cal7 = round($cal6, 2);
                                ?>
                                            <table>
                                                <tr>
                                                    <td bgcolor="#DFF2F0"><strong>Cálculo de ISR</strong></td>
                                                </tr>
                                            </table>
                                            <div style="overflow-x:auto;">
                                                <table>

                                                    <tr>
                                                        <td>Importe</td>
                                                        <td></td>
                                                        <td><? echo number_format($calculox1, 2); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td>IVA (16%)</td>
                                                        <td><b>+</b></td>
                                                        <td><? echo number_format($cal1, 2); ?>
                                                            <hr>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Subtotal</td>
                                                        <td><b>=</b></td>
                                                        <td><? echo number_format($cal3, 2); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Retención de ISR (10%)</td>
                                                        <td><b>-</b></td>
                                                        <td><? echo number_format($cal4, 2); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Retención de IVA (2/3 Partes)</td>
                                                        <td><b>-</b></td>
                                                        <td><? echo number_format($cal5, 2); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <td><b>=</b></td>
                                                        <td><? echo number_format($cal7, 2); ?>
                                                            <hr>
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>
                                            <br>
                                            <form target="_blank" class="mui-form" method="post"
                                                action="{{ route('pdf_honorarios') }}?pdf=yes&monto=<? echo round($calculox1, 2); ?>&tipo=1&name=<? echo $_COOKIE['name_x1']; ?>">
                                                <p>
                                                <div align="center"><button type="submit"
                                                        class="mui-btn mui-btn--raised">Imprimir</button></div>
                                                </p>
                                            </form>
                                            <?
                              }
                            }
                          }
                          if (isset($_GET['ver']) && $_GET['ver'] == "config") {
                              ?>
                                            <table>
                                                <tr>
                                                    <td bgcolor="#DFF2F0"><strong>Cálculos</strong></td>
                                                </tr>
                                            </table>

                                            <div style="overflow-x:auto;">

                                                <br>
                                                <table>

                                                    <tr>
                                                        <td>Año</td>
                                                        <td>
                                                            <form class="mui-form" method="get"
                                                                action="{{ route('app_config') }}" name="formulario">
                                                                <? //la clase define el tipo de formulario, por eso no aparecen años anteriores por mui-select
                                        ?>
                                                                <div>
                                                                    <select name="year">
                                                                        <?
                                            //en el cambio de año aqui se debe incluir el nuevo año con un elseif y despues modificar app_config.php con el
                                            //valor de la uma del nuevo año
                                            if (isset($_COOKIE['year_x1']) && $_COOKIE['year_x1'] == "2019") {
                                            ?>
                                                                        <option value="2019" selected>2019</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023">2023</option>
                                                                        <option value="2024">2024</option>
                                                                        <option value="2025">2025</option>
                                                                        <?
                                            } elseif (isset($_COOKIE['year_x1']) && $_COOKIE['year_x1'] == "2020") {
                                            ?>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2020" selected>2020</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023">2023</option>
                                                                        <option value="2024">2024</option>
                                                                        <option value="2025">2025</option>
                                                                        <?
                                            } elseif (isset($_COOKIE['year_x1']) && $_COOKIE['year_x1'] == "2021") {
                                            ?>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2021" selected>2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023">2023</option>
                                                                        <option value="2024">2024</option>
                                                                        <option value="2025">2025</option>
                                                                        <?
                                            } elseif (isset($_COOKIE['year_x1']) && $_COOKIE['year_x1'] == "2022") {
                                            ?>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022" selected>2022</option>
                                                                        <option value="2023">2023</option>
                                                                        <option value="2024">2024</option>
                                                                        <option value="2025">2025</option>
                                                                        <?
                                            } elseif (isset($_COOKIE['year_x1']) && $_COOKIE['year_x1'] == "2023") {
                                            ?>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023" selected>2023</option>
                                                                        <option value="2024">2024</option>
                                                                        <option value="2025">2025</option>
                                                                        <?
                                            } elseif (isset($_COOKIE['year_x1']) && $_COOKIE['year_x1'] == "2024") { ?>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023">2023</option>
                                                                        <option value="2024" selected>2024</option>
                                                                        <option value="2025">2025</option>
                                                                        <?
                                            } else { ?>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023">2023</option>
                                                                        <option value="2024">2024</option>
                                                                        <option value="2025" selected>2025</option>
                                                                        <?
                                            }
                                            ?>
                                                                </div>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="tooltip"
                                                                title="ART 99 LISR. IV. Solicitar, en su caso, las constancias y los comprobantes a que se refiere la fracción anterior, a las personas que contraten para prestar servicios subordinados, a más tardar dentro del mes siguiente a aquél en que se inicie la prestación del servicio y cerciorarse que estén inscritos en el Registro Federal de Contribuyentes. Adicionalmente, deberán solicitar a los trabajadores que les comuniquen por escrito antes de que se efectúe el primer pago que les corresponda por la prestación de servicios personales subordinados en el año de calendario de que se trate, si prestan servicios a otro empleador y éste les aplica el subsidio para el empleo, a fin de que ya no se aplique nuevamente.">
                                                                Aplicar subsidio para el Empleo<a href="#">->
                                                                    ?</a></div>
                                                        </td>
                                                        <td>

                                                            <div>
                                                                <select name="sub">

                                                                    <?
                                          if (isset($_COOKIE['sub_x1']) && $_COOKIE['sub_x1'] == "0") {
                                          ?>
                                                                    <option value="0" disabled>Si</option>
                                                                    <option value="1" selected>No</option>
                                                                    <?
                                          } elseif (isset($_COOKIE['sub_x1']) && $_COOKIE['sub_x1'] == "1") {
                                          ?>
                                                                    <option value="0" disabled>Si</option>
                                                                    <option value="1" selected>No</option>
                                                                    <?
                                          } else {
                                          ?>
                                                                    <option value="0" disabled>Si</option>
                                                                    <option value="1" selected>No</option>
                                                                    <?

                                          }
                                          ?>
                                                            </div>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <?php

                                                            if (isset($_COOKIE['year_x1']) && $_COOKIE['year_x1'] == '2016') {
                                                                echo 'Salario Mínimo General';
                                                            } elseif (isset($_COOKIE['year_x1']) && $_COOKIE['year_x1'] == '2017' or isset($_COOKIE['year_x1']) && $_COOKIE['year_x1'] == '2018') {
                                                                echo 'UMA (Unidad de Medida Actualizada)';
                                                            } else {
                                                                echo 'UMA (Unidad de Medida Actualizada)';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $_COOKIE['value_x1'] ?? '' ?></td>
                                                    </tr>

                                                </table>

                                                <br>
                                                <table>
                                                    <tr>
                                                        <td bgcolor="#DFF2F0"><strong>Tu correo electrónico</strong>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div style="overflow-x:auto;">
                                                    <table>

                                                        <tr>
                                                            <td>Correo:</td>
                                                            <td>
                                                                <div class="mui-textfield">
                                                                    <input type="email" name="email"
                                                                        value="<?= $_COOKIE['correo_x1'] ?? '' ?>"
                                                                        required>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                    <br>
                                                    <table>
                                                        <tr>
                                                            <td bgcolor="#DFF2F0"><strong>Versión impresa</strong></td>
                                                        </tr>
                                                    </table>

                                                    <br>Si eres asesor y requieres el cálculo para una persona externa,
                                                    por favor capture el nombre de dicha persona.<br><br>

                                                    <div style="overflow-x:auto;">
                                                        <table>

                                                            <tr>
                                                                <td>Realizado para</td>
                                                                <td>
                                                                    <div class="mui-textfield">
                                                                        <input type="text" name="name"
                                                                            value="<? echo $_COOKIE['name_x1'] ?? '' ?>"
                                                                            required>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        </table><br>
                                                        Esta aplicación web utiliza cookies, al continuar navegando,
                                                        usted acepta y aprueba el uso de las mismas.
                                                        <br>
                                                        <p>
                                                        <div align="center"><button type="submit"
                                                                class="mui-btn mui-btn--danger">Guardar</button></div>
                                                        </p>
                            </form>
        </div>
        <?
                          }
                          if (isset($_GET['ver']) && $_GET['ver'] == "indice") {
                            if (isset($_GET['articulo'])) {
    ?>
        <p><a href=".{{ route('opcion') }}?ver=indice"><- Regresar al índice</a></p>
        <?
                              $resp = mysqli_query($conectar, "select * from articulos where id='$_GET[articulo]'");
                              $datos = mysqli_fetch_array($resp);
                              echo "$datos[titulo_principal]<br>$datos[titulo_articulo]";
                              echo "<br><br>";
                              echo "<div align=left>$datos[texto]</div>";
                              mysqli_free_result($resp);
                            }
    ?>
        <hr>
        <ul>
            <li>1.0 Ley Federal del trabajo</li>
            <ul>
                <li>1.1 Prontuario</li>
                <ul>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=1">1.1.1 Aguinaldo</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=2">1.1.2 Contrato Individual De Trabajo</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=3">1.1.3 Días de Descanso Obligatorio</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=4">1.1.4 Horas Extra</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=5">1.1.5 Jornada de Trabajo</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=6">1.1.6 Ley Laboral, su aplicación e
                            interpretación</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=7">1.1.7 Participación de los Trabajadores en las
                            Utilidades de la Empresa</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=8">1.1.8 Patrón e Intermediario</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=9">1.1.9 Prima Dominical</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=10">1.1.10 Prima Vacacional</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=11">1.1.11 Privilegios Legales del Salario</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=12">1.1.12 Salarios</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=13">1.1.13 Salarios Devengados</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=14">1.1.14 Salarios Mínimos</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=15">1.1.15 Trabajadores, Igualdad y Libertad de
                            Trabajo</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=16">1.1.16 Trabajo de las Mujeres</a></li>
                    <li><a href=".{{ route('opcion') }}?ver=indice&articulo=17">1.1.17 Vacaciones</a></li>
                </ul>
            </ul>
            <li>2.0 Ley del Impuesto Sobre la Renta</li>
            <ul>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=23">2.1 Artículo 93</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=24">2.2 Artículo 94</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=25">2.3 Artículo 95</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=26">2.4 Artículo 96</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=27">2.5 Artículo 97</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=28">2.6 Artículo 98</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=29">2.7 Artículo 99</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=30">2.8 Artículo 106</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=31">2.9 Artículo 150</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=32">2.10 Artículo 151</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=33">2.11 Artículo 152</a></li>
                <li><a href=".{{ route('opcion') }}?ver=indice&articulo=34">2.12 Artículo Décimo</a></li>
            </ul>
            <li><a href=".{{ route('opcion') }}?ver=indice&articulo=19">3.0 Reglamento de la Ley del Impuesto Sobre la Renta</a>
            </li>
            <li><a href=".{{ route('opcion') }}?ver=indice&articulo=20">4.0 Código Fiscal de la Federación</a></li>
            <li><a href=".{{ route('opcion') }}?ver=indice&articulo=21">5.0 Ley del Impuesto al Valor Agregado</a></li>
            <li><a href=".{{ route('opcion') }}?ver=indice&articulo=22">6.0 Reglamento de la Ley del Impuesto al Valor
                    Agregado</a></li>
        </ul>
        <br><br>
        <?
                          }
                          if (isset($_GET['ver']) && $_GET['ver'] == "buscador") {
  ?>
        <strong>Buscador</strong>
        <p align="center">Con esta herramienta puede buscar el o los artículos de su interés, solo escriba una frase o
            palabra clave y el sistema identificará el artículo legal que contiene dicha frase o palabra.
        <form name="formulario" method="post" action="{{ route('opcion') }}?ver=buscador&key">
            <div class="mui-textfield"><input type="text" name="texto" placeholder="...Buscar..." required>
            </div><br>
            <div align="center"><input type="submit" name="enviar" value="Buscar" class="button"></div>
        </form>
        </p>
        <br>
        <?
                            if (isset($_GET['key'])) {
                              echo "<b>Resultados:</b><br><br>";
                              $keyword = strtolower($_POST['texto']);
                              $sql = "SELECT * FROM `articulos` WHERE `texto` LIKE '%$keyword%'";
                              $res = mysqli_query($conectar, $sql);
                              while ($row = mysqli_fetch_array($res)) {
                                $data = $row['texto'];

                                $output = strip_tags(substr($data, max(0, $first_pos - 100), 200 + strlen($keyword)));
                                echo "$output&nbsp;<a href=.{{ route('opcion') }}?ver=indice&articulo=$row[id]>Ver Más en $row[titulo_articulo]</a>&nbsp;<br><hr>";
                              }
                            }
                          }
                          if (isset($_GET['ver']) && $_GET['ver'] == "contacto") {
    ?>
        <table>
            <tr>
                <td bgcolor="#DFF2F0"><strong>Vía telefónica</strong></td>
            </tr>
        </table>
        <div style="overflow-x:auto;">
            <table>
                <tr>
                    <td>Dirección: </td>
                    <td>Ribera de San Cosme 22,<br>Despacho 405,<br>Col.San Rafael,<br>Alcaldía Cuauhtémoc
                        06470,<br>México, CDMX.</td>
                </tr>
                <tr>
                    <td>Teléfono: </td>
                    <td>5555460213</td>
                </tr>
            </table>
        </div>
        <?
                          }
                          if (isset($_GET['ver']) && $_GET['ver'] == "quienes") {
  ?>
        <table>
            <tr>
                <td bgcolor="#DFF2F0"><strong>¿Quiénes somos?</strong></td>
            </tr>
        </table>
        <div style="overflow-x:auto;">
            <table>
                <tr>
                    <td><b>Filosofía </b></td>
                    <td>Nuestra filosofia se basa en una constante capacitación y actualización tanto en aspecto
                        tecnológico como fiscal para dar resultados integrales óptimos a un bajo costo.</td>
                </tr>
                <tr>
                    <td><b>Misión </b></td>
                    <td>Elaborar programas amigables sustentados en Ley para que tú, responsable del área de Nóminas o
                        Recursos Humanos tengas los elementos fiscales aplicados en un proceso integral de la manera más
                        sencilla como lo es el abecedario y contar con el respaldo de especialistas en la materia que le
                        atañe.</td>
                </tr>
                <tr>
                    <td><b>Visión </b></td>
                    <td>Ser los desarrolladores que apoyen en la administración de lo más valioso de su empresa, el Ser
                        Humano, a través de tecnología con una aplicación fiscal justa y equilibrada que dé certeza y
                        credibilidad ante las diferentes instituciones y todos los niveles desde la micro y mediana
                        empresa hasta los grandes corporativos.</td>
                </tr>
                <tr>
                    <td><b>Valores </b></td>
                    <td>Gente cálida, entusiasta, honesta, con enormes deseos de superarse constantemente para brindar
                        un servicio acorde a las necesidades de sus clientes.</td>
                </tr>
            </table>

        </div>
        <?
                          }
                          if (isset($_GET['otras']) && $_GET['otras'] == "remuneraciones") {
  ?>
        <table>
            <tr>
                <td bgcolor="#DFF2F0"><strong>
                        <div class="tooltip"
                            title="El Artículo 174 del Reglamento de la Ley del Impuesto sobre la renta (ISR) establece un procedimiento opcional para los patrones que calculan el impuesto sobre percepciones que se devengan durante el año pero que se entregan en un solo pago como el caso de las gratificaciones anuales o pagos similares. Tal es el caso del aguinaldo. Este procedimiento alterno consiste en 'mensualizar' la percepción anual y aplicarle la tarifa mensual de impuestos, de forma que el periodo de la tarifa de impuesto corresponda con el periodo en que se percibe el ingreso y se evite así hacer retenciones excesivas al trabajador que, aunque le quedaran a favor al final del ejercicio, le afectaría en sus flujos económicos.">
                            Tipo de percepción<a href="#">-> ?</a></div>
                    </strong>

                </td>
            </tr>
        </table>

        <form class="mui-form" method="post" action="{{ route('opcion') }}?otras=remuneraciones&fichaid2">
            <div style="overflow-x:auto;">
                <table>
                    <tr>
                        <td>Aguinaldo</td>
                        <td>
                            <label class="radio inline">
                                <input id="up_radio" type="radio" name="ot_rem" value="1"
                                    <?php if (isset($_POST['ot_rem']) && $_POST['ot_rem'] == 1) {
                                        echo 'checked';
                                    } ?>>
                            </label>
                        </td>
                        <td>Prima Vacacional</td>
                        <td>
                            <label class="radio inline">
                                <input id="up_radio" type="radio" name="ot_rem" value="2"
                                    <?php if (isset($_POST['ot_rem']) && $_POST['ot_rem'] == 2) {
                                        echo 'checked';
                                    } ?>>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>PTU</td>
                        <td>
                            <label class="radio inline">
                                <input id="up_radio" type="radio" name="ot_rem" value="3"
                                    <?php if (isset($_POST['ot_rem']) && $_POST['ot_rem'] == 3) {
                                        echo 'checked';
                                    } ?>>
                            </label>
                        </td>
                        <td>Otras Remuneraciones</td>
                        <td>
                            <label class="radio inline">
                                <input id="up_radio" type="radio" name="ot_rem" value="4"
                                    <?php if (isset($_POST['ot_rem']) && $_POST['ot_rem'] == 4) {
                                        echo 'checked';
                                    } ?>>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Prima Dominical</td>
                        <td>
                            <label class="radio inline">
                                <input id="up_radio" type="radio" name="ot_rem" value="5"
                                    <?php if (isset($_POST['ot_rem']) && $_POST['ot_rem'] == 5) {
                                        echo 'checked';
                                    } ?>>
                            </label>
                        </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td bgcolor="#DFF2F0"><strong>Datos para el cálculo</strong></td>
                    </tr>
                </table>


                <div style="overflow-x:auto;">
                    <table>
                        <tr>
                            <td>Importe</td>
                            <td>
                                <div class="mui-textfield"><input name="importe" type="number" step=0.01
                                        placeholder="<? echo $_POST['importe'] ?? '0' ?>" required></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Cuota Diaria</td>
                            <td>
                                <div class="mui-textfield"><input name="cuota" type="number"
                                        placeholder="<? echo $_POST['cuota'] ?? '0' ?>" required></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <br>
                <p>
                <div align="center"><button type="submit" class="button">Calcular</button></div>
                </p>
        </form>
        <?
                          }
                          if (isset($_GET['fichaid2'])) {

                            $importe = $_POST['importe'];
                            $cuota = $_POST['cuota'];

                            $fecha = time();
                            $uma = $_COOKIE['value_x1'];
                            $radio = $_POST['ot_rem'];

                            if ($radio == 1) { //aguinaldo
                              $dias = 30;
                              $i_e = $dias * $uma;
                              if ($importe > $i_e) {
                                $total_exento = $i_e;
                              } else {
                                $total_exento = $importe;
                              }
                              $t_gravado = $importe - $total_exento;
                            } elseif ($radio == 2) { //prima vacacional
                              $dias = 15;
                              $i_e = $dias * $uma;
                              if ($importe > $i_e) {
                                $total_exento = $i_e;
                              } else {
                                $total_exento = $importe;
                              }
                              $t_gravado = $importe - $total_exento;
                            } elseif ($radio == 3) { //PTU
                              $dias = 15;
                              $i_e = $dias * $uma;
                              if ($importe > $i_e) {
                                $total_exento = $i_e;
                              } else {
                                $total_exento = $importe;
                              }
                              $t_gravado = $importe - $total_exento;
                            } elseif ($radio == 5) { //Dominical
                              $dias = 1;
                              $i_e = $dias * $uma;
                              if ($importe > $i_e) {
                                $total_exento = $i_e;
                              } else {
                                $total_exento = $importe;
                              }
                              $t_gravado = $importe - $total_exento;
                            } else { //otras remuneraciones
                              $dias = 0;
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
                            $vavar = $_COOKIE['sub_x1'];
                            $c1 = $promedio_mensual_gravable + $sueldo_mensual_ordinario;
                            $c2 = sueldos_y_salarios($c1, $vavar, $GLOBAL_SYSTEM_YEAR);
                            $c3 = sueldos_y_salarios($sueldo_mensual_ordinario, $vavar, $GLOBAL_SYSTEM_YEAR);
                            $c4 = $c2 - $c3;
                            $c5 = $c4 / $promedio_mensual_gravable; //tasa_isr
                            $c6 = $c5 * $t_gravado;
                            $c7 = sueldos_y_salarios($c1, $vavar, $GLOBAL_SYSTEM_YEAR);
                            $c8 = sueldos_y_salarios($sueldo_mensual_ordinario, $vavar, $GLOBAL_SYSTEM_YEAR);
                            $c9 = $c4 / $promedio_mensual_gravable;

                            if ($_COOKIE['year_x1'] == "2016") {
                              $GLOBAL_SALARIO = "Salario Mínimo General";
                            } elseif ($_COOKIE['year_x1'] == "2017" or $_COOKIE['year_x1'] == "2018") {
                              $GLOBAL_SALARIO = "UMA (Unidad de Medida Actualizada)";
                            } else {
                              $GLOBAL_SALARIO = "UMA (Unidad de Medida Actualizada)";
                            }

  ?>

        <table>
            <tr>
                <td bgcolor="#DFF2F0"><strong>Cálculo del ISR</strong></td>
            </tr>
        </table>
        <div style="overflow-x:auto;">
            <table>

                <tr>
                    <td>
                        <div class="tooltip"
                            title="El Ingreso Exento para esta prestación es el <? echo $GLOBAL_SALARIO; ?> <? echo $_COOKIE['value_x1']; ?> por 30 días. Por lo tanto el ingreso exento es de $<? echo number_format($total_exento, 2); ?>">
                            Ingreso Exento<a href="#">-> ?</a></div>
                    </td>
                    <td></td>
                    <td>
                        <div align="right">$<? echo number_format($total_exento, 2); ?></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="tooltip"
                            title="Importe $<? echo $importe ?> - Total Exento $<? echo number_format($total_exento, 2); ?> = Ingreso Gravable $<? echo number_format($t_gravado, 2); ?>">
                            Ingreso Gravable<a href="#">-> ?</a></div>
                    </td>
                    <td></td>
                    <td>
                        <div align="right">$<? echo number_format($t_gravado, 2); ?></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="tooltip"
                            title="El Promedio Mensual Gravable (PMG) es el Ingreso Gravable Anual $<? echo number_format($t_gravado, 2); ?> entre 365 por 30.4, por lo tanto el Promedio Mensual Gravable (SMO) es de $<? echo number_format($promedio_mensual_gravable, 2); ?>">
                            Promedio Mensual Gravable (PMG)<a href="#">-> ?</a></div>
                    </td>
                    <td></td>
                    <td>
                        <div align="right">$<? echo number_format($promedio_mensual_gravable, 2); ?></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="tooltip"
                            title="El Sueldo Mensual Ordinario (SMO) <? echo number_format($sueldo_mensual_ordinario, 2); ?> es la Cuota Diaria convertida a mensual <? echo $cuota ?> por 30.4">
                            Sueldo Mensual Ordinario (SMO)<a href="#">-> ?</a></div>
                    </td>
                    <td></td>
                    <td>
                        <div align="right">$<? echo number_format($sueldo_mensual_ordinario, 2); ?></div>
                    </td>
                </tr>

                <tr>
                    <td>ISR s/SMO+PMG</td>
                    <td></td>
                    <td>
                        <div align="right">$<? echo number_format($c7, 2); ?></div>
                    </td>
                </tr>

                <tr>
                    <td>ISR s/SMO</td>
                    <td><b>-</b></td>
                    <td>
                        <div align="right">$<? echo number_format($c8, 2); ?></div>
                        <hr>
                    </td>
                </tr>

                <tr>
                    <td>Diferencia</td>
                    <td><b>=</b></td>
                    <td>
                        <div align="right">$<? echo number_format($c4, 2); ?></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="tooltip"
                            title="La Tasa de ISR a aplicar <? echo number_format($c9 * 100, 2); ?>% es la Diferencia $<? echo number_format($c4, 2); ?> entre el Promedio Mensual Gravable (PMG) $<? echo number_format($promedio_mensual_gravable, 2); ?>">
                            Tasa de ISR a aplicar<a href="#">-> ?</a></div>
                    </td>
                    <td></td>
                    <td>
                        <div align="right"><? echo number_format($c9 * 100, 2); ?>%</div>
                    </td>
                </tr>

                <tr>
                    <td><b>
                            <div class="tooltip"
                                title="Ingreso Gravable $<? echo number_format($t_gravado, 2); ?> por la Tasa de ISR a Aplicar <? echo number_format($c9 * 100, 2); ?>% = Impuesto Determinado <? echo number_format($c6, 2); ?>">
                                <?
                            if ($c6 > 0) {
                              echo "<b>ISR DETERMINADO</b>";
                            } else {
                              echo "<b>SUBSIDIO DETERMINADO</b>";
                            }
                ?>
                                <a href="#">-> ?</a>
                            </div>
                        </b></td>
                    <td><b>=</b></td>
                    <td><b>
                            <div align="right">$<? echo number_format($c6, 2); ?></div>
                        </b>
                        <hr>
                        <hr>
                    </td>
                </tr>

            </table>

            <p>
            <div align="center">
                <?php if ($_POST['ot_rem'] == 1) { ?>
                <form target="_blank" class="mui-form" method="post"
                    action="pdf_aguinaldo.php?x1=<? echo $radio; ?>&pdf=yes&x2=<? echo $importe; ?>&x3=<? echo $cuota; ?>&name=<? echo $_COOKIE['name_x1']; ?>&var44=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $_COOKIE['year_x1']; ?>&uma=<? echo $_COOKIE['value_x1']; ?>">
                    <? } elseif ($_POST['ot_rem'] == 2) { ?>
                    <form target="_blank" class="mui-form" method="post"
                        action="pdf_prima_vacacional.php?x1=<? echo $radio; ?>&pdf=yes&x2=<? echo $importe; ?>&x3=<? echo $cuota; ?>&name=<? echo $_COOKIE['name_x1']; ?>&var44=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $_COOKIE['year_x1']; ?>&uma=<? echo $_COOKIE['value_x1']; ?>">
                        <? } elseif ($_POST['ot_rem'] == 3) { ?>
                        <form target="_blank" class="mui-form" method="post"
                            action="{{'pdf_ptu'}}?x1=<? echo $radio; ?>&pdf=yes&x2=<? echo $importe; ?>&x3=<? echo $cuota; ?>&name=<? echo $_COOKIE['name_x1']; ?>&var44=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $_COOKIE['year_x1']; ?>&uma=<? echo $_COOKIE['value_x1']; ?>">
                            <? } elseif ($_POST['ot_rem'] == 5) {
              ?>
                            <form target="_blank" class="mui-form" method="post"
                                action="pdf_prima_dominical.php?x1=<? echo $radio; ?>&pdf=yes&x2=<? echo $importe; ?>&x3=<? echo $cuota; ?>&name=<? echo $_COOKIE['name_x1']; ?>&var44=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $_COOKIE['year_x1']; ?>&uma=<? echo $_COOKIE['value_x1']; ?>">
                                <?
                            } else { ?>
                                <form target="_blank" class="mui-form" method="post"
                                    action="pdf_otras_remuneraciones.php?x1=<? echo $radio; ?>&pdf=yes&x2=<? echo $importe; ?>&x3=<? echo $cuota; ?>&name=<? echo $_COOKIE['name_x1']; ?>&var44=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $_COOKIE['year_x1']; ?>&uma=<? echo $_COOKIE['value_x1']; ?>">
                                    <? } ?>
                                    <button type="submit" class="mui-btn mui-btn--raised">Imprimir cálculo</button>
                                </form>
                                &nbsp;
                                <form target="_blank" class="mui-form" method="post"
                                    action="{{ route('pdf_tablas_otras_r') }}?tablas=<? echo $sueldo_mensual_ordinario; ?>&var2=<? echo $promedio_mensual_gravable; ?>&var3=<? echo $cuota; ?>&var4=<? echo $_COOKIE['sub_x1']; ?>&year=<? echo $GLOBAL_SYSTEM_YEAR ?>">
                                    <input type="hidden" value="<? echo $_POST['ot_rem'] ?>" name="ot_rem" />
                                    <input type="hidden" value="<? echo $_POST['importe'] ?>" name="importe" />
                                    <input type="hidden" value="<? echo $_POST['cuota'] ?>" name="cuota" />
                                    <button type="submit" class="mui-btn mui-btn--raised">Imprimir Tablas</button>
                                </form>
            </div>
            </p>
            <?

                          }
                          if (isset($_GET['otras']) && $_GET['otras'] == "remuneraciones2") {
                            if (isset($_GET['tablas'])) {

                              $pre_var1 = $_GET['tablas'];
                              $pre_var2 = $_GET['var2'];
                              $pre_var3 = $_GET['var3'];

                              $var1 = $pre_var1 + $pre_var2;

                              $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR'
and var1 between '0' and '$var1' order by var4 desc limit 1");
                              $datos1 = mysqli_fetch_array($resp1);
                              $limite_inferior = $datos1['var1'];
                              $importe_excedente_li = $var1 - $limite_inferior;
                              $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR'
and var1 between '0' and '$var1' order by var4 desc limit 1");
                              $datos2 = mysqli_fetch_array($resp2);
                              $porcentaje_p_aplicarse = $datos2['var4'];
                              $c1 = $importe_excedente_li * $porcentaje_p_aplicarse;
                              $c2 = $c1 / 100;
                              $impuesto_marginal = $c2;
                              $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR'
and var1 between '0' and '$var1' order by var4 desc limit 1");
                              $datos3 = mysqli_fetch_array($resp3);
                              $cuota_fija = $datos3['var3'];
                              //tabla subsidio
                              $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$GLOBAL_SYSTEM_YEAR'
and var1 between '0' and '$var1' order by var4 desc limit 1");
                              $datos4 = mysqli_fetch_array($resp4);
                              if ($_COOKIE['sub_x1'] == 0) {
                                $c3 = $datos4['var3'];
                              } else {
                                $c3 = "0.00";
                              }
                              //fin tabla subsidio
                              $isr_calculado = $impuesto_marginal + $cuota_fija;
                              if ($_COOKIE['sub_x1'] == 0) {
                                $cal5 = $isr_calculado - $c3;
                              } else {
                                $cal5 = $isr_calculado;
                              }
                              $cal5; //falta subsidio para empleo
      ?>
            <form class="mui-form" method="post" action="{{ route('opcion') }}?otras=remuneraciones&fichaid2">
                <input type="hidden" value="<? echo $_POST['ot_rem'] ?>" name="ot_rem" />
                <input type="hidden" value="<? echo $_POST['importe'] ?>" name="importe" />
                <input type="hidden" value="<? echo $_POST['cuota'] ?>" name="cuota" />
                <br><br><br>
                <p>
                <div align="center"><button type="submit" class="button"><- Regresar</button></div>
                </p>
            </form>
            <table>
                <tr>
                    <td bgcolor="#DFF2F0"><strong>Cálculo del ISR sobre SMO + PMG</strong></td>
                </tr>
            </table>
            <div style="overflow-x:auto;">
                <table>

                    <tr>
                        <td>
                            <div class="tooltip"
                                title="SMO $<? echo number_format($pre_var1, 2); ?> + PMG $<? echo number_format($pre_var2, 2); ?> = SMO + PMG $<? echo number_format($var1, 2); ?>">
                                SMO + PMG<a href="#">-> ?</a></div>
                        </td>
                        <td></td>
                        <td>
                            <div align="right">$<? echo number_format($var1, 2); ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td>Límite Inferior</td>
                        <td>-</td>
                        <td>
                            <div align="right">$<? echo number_format($limite_inferior, 2); ?>
                                <hr>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Importe Excedente al Límite Inferior</td>
                        <td>=</td>
                        <td>
                            <div align="right">$<? echo number_format($importe_excedente_li, 2); ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td>(%) para aplicar sobre el Excedente</td>
                        <td>x</td>
                        <td>
                            <div align="right"><? echo number_format($porcentaje_p_aplicarse, 2); ?>%</div>
                            <hr>
                        </td>
                    </tr>

                    <tr>
                        <td>Impuesto Marginal</td>
                        <td>=</td>
                        <td>
                            <div align="right">$<? echo number_format($impuesto_marginal, 2); ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td>Cuota Fija</td>
                        <td>+</td>
                        <td>
                            <div align="right">$<? echo number_format($cuota_fija, 2); ?></div>
                            <hr>
                        </td>
                    </tr>

                    <tr>
                        <td>Impuesto Calculado</td>
                        <td>=</td>
                        <td>
                            <div align="right">$<? echo number_format($isr_calculado, 2); ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td>Subsidio para el Empleo</td>
                        <td>-</td>
                        <td>
                            <div align="right">$<? echo number_format($c3, 2); ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>
                                <?
                              if ($cal5 > 0) {
                                echo "<b>ISR DETERMINADO</b>";
                              } else {
                                echo "<b>SUBSIDIO DETERMINADO</b>";
                              }
                  ?>
                            </b></td>
                        <td><b>=</b></td>
                        <td><b>
                                <div align="right">$<? echo number_format($cal5, 2); ?></div>
                            </b>
                            <hr>
                            <hr>
                        </td>
                    </tr>

                </table>
                <br>
                <table>
                    <tr>
                        <td bgcolor="#DFF2F0"><strong>Cálculo del ISR sobre Sueldo Mensual Ordinario (SMO)</strong>
                        </td>
                    </tr>
                </table>
                <div style="overflow-x:auto;">
                    <table>

                        <tr>

                            <?php
                            mysqli_free_result($resp1);
                            mysqli_free_result($resp2);
                            mysqli_free_result($resp3);
                            mysqli_free_result($resp4);
                            $resp1 = mysqli_query(
                                $conectar,
                                "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR'
                            and var1 between '0' and '$pre_var1' order by var4 desc limit 1",
                            );
                            $datos1 = mysqli_fetch_array($resp1);
                            $limite_inferior = $datos1['var1'];
                            $importe_excedente_li = $pre_var1 - $limite_inferior;
                            $resp2 = mysqli_query(
                                $conectar,
                                "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR'
                            and var1 between '0' and '$pre_var1' order by var4 desc limit 1",
                            );
                            $datos2 = mysqli_fetch_array($resp2);
                            $porcentaje_p_aplicarse = $datos2['var4'];
                            $c1 = $importe_excedente_li * $porcentaje_p_aplicarse;
                            $c2 = $c1 / 100;
                            $impuesto_marginal = $c2;
                            $resp3 = mysqli_query(
                                $conectar,
                                "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR'
                            and var1 between '0' and '$pre_var1' order by var4 desc limit 1",
                            );
                            $datos3 = mysqli_fetch_array($resp3);
                            $cuota_fija = $datos3['var3'];
                            //tabla subsidio
                            $resp4 = mysqli_query(
                                $conectar,
                                "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$GLOBAL_SYSTEM_YEAR'
                            and var1 between '0' and '$pre_var1' order by var4 desc limit 1",
                            );
                            $datos4 = mysqli_fetch_array($resp4);
                            if ($_COOKIE['sub_x1'] == 0) {
                                $c3 = $datos4['var3'];
                            } else {
                                $c3 = '0.00';
                            }
                            //fin tabla subsidio
                            $isr_calculado = $impuesto_marginal + $cuota_fija;
                            if ($_COOKIE['sub_x1'] == 0) {
                                $cal5 = $isr_calculado - $c3;
                            } else {
                                $cal5 = $isr_calculado;
                            }
                            $cal5; //falta subsidio para empleo
                            ?>


                            <td>
                                <div class="tooltip"
                                    title="El Sueldo Mensual Ordinario (SMO) $<? echo number_format($pre_var1, 2); ?> es la cuota diaria convertida a mensual $<? echo number_format($pre_var3, 2); ?> por 30.4">
                                    Sueldo Mensual Ordinario (SMO)<a href="#">-> ?</a></div>
                            </td>
                            <td></td>
                            <td>
                                <div align="right">$<? echo number_format($pre_var1, 2); ?></div>
                            </td>
                        </tr>

                        <tr>
                            <td>Límite Inferior</td>
                            <td>-</td>
                            <td>
                                <div align="right">$<? echo number_format($limite_inferior, 2); ?>
                                    <hr>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Importe Excedente al Límite Inferior</td>
                            <td>=</td>
                            <td>
                                <div align="right">$<? echo number_format($importe_excedente_li, 2); ?></div>
                            </td>
                        </tr>

                        <tr>
                            <td>(%) para aplicar sobre el Excedente</td>
                            <td>x</td>
                            <td>
                                <div align="right"><? echo number_format($porcentaje_p_aplicarse, 2); ?>%</div>
                                <hr>
                            </td>
                        </tr>

                        <tr>
                            <td>Impuesto Marginal</td>
                            <td>=</td>
                            <td>
                                <div align="right">$<? echo number_format($impuesto_marginal, 2); ?></div>
                            </td>
                        </tr>

                        <tr>
                            <td>Cuota Fija</td>
                            <td>+</td>
                            <td>
                                <div align="right">$<? echo number_format($cuota_fija, 2); ?></div>
                                <hr>
                            </td>
                        </tr>

                        <tr>
                            <td>Impuesto Calculado</td>
                            <td>=</td>
                            <td>
                                <div align="right">$<? echo number_format($isr_calculado, 2); ?></div>
                            </td>
                        </tr>

                        <tr>
                            <td>Subsidio para el Empleo</td>
                            <td>-</td>
                            <td>
                                <div align="right">$<? echo number_format($c3, 2); ?></div>
                            </td>
                        </tr>

                        <tr>
                            <td><b>
                                    <?
                              if ($cal5 > 0) {
                                echo "<b>ISR DETERMINADO</b>";
                              } else {
                                echo "<b>SUBSIDIO DETERMINADO</b>";
                              }
                    ?>
                                </b></td>
                            <td><b>=</b></td>
                            <td><b>
                                    <div align="right">$<? echo number_format($cal5, 2); ?></div>
                                </b>
                                <hr>
                                <hr>
                            </td>
                        </tr>
                        <?php
                        mysqli_free_result($resp1);
                        mysqli_free_result($resp2);
                        mysqli_free_result($resp3);
                        mysqli_free_result($resp4);
                        ?>
                    </table>
                    <br>
                    <?
                              $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLAS MENSUALES FIJA' and year='$GLOBAL_SYSTEM_YEAR' order by var1 asc limit 12");
            ?>
                    <table border="1">
                        <tr>
                            <td colspan="4" bgcolor="#DFF2F0">
                                <div align="center"><strong>Tablas Mensuales</strong></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" bgcolor="#DFF2F0">
                                <div align="center"><strong>Tabla Impuesto ISR</strong></div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">
                                <div align="center"><b>Límite Inferior</b></div>
                            </td>
                            <td rowspan="2">
                                <div align="center"><b>Límite Superior</b></div>
                            </td>
                            <td rowspan="2">
                                <div align="center"><b>Cuota Fija</b></div>
                            </td>
                            <td rowspan="2">
                                <div align="center"><b>% Para aplicarse s/excedente del límite inferior</b></div>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                        <?
                              while ($datos4 = mysqli_fetch_array($resp4)) {
              ?>
                        <tr>
                            <td>
                                <div align="center">$<? echo number_format($datos4['var1'], 2); ?></div>
                            </td>
                            <td>
                                <div align="center">$<? echo number_format($datos4['var2'], 2); ?></div>
                            </td>
                            <td>
                                <div align="center">$<? echo number_format($datos4['var3'], 2); ?></div>
                            </td>
                            <td>
                                <div align="center"><? echo number_format($datos4['var4'], 2); ?>%</div>
                            </td>
                        </tr>
                        <?
                              }
                              echo "</table>";
                              mysqli_free_result($resp4);
              ?>
                        <br>

                        <?
                              $resp5 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$GLOBAL_SYSTEM_YEAR' order by var1 asc limit 12");
              ?>
                        <table border="1">
                            <tr>
                                <td colspan="4" bgcolor="#DFF2F0">
                                    <div align="center"><strong>Tabla Subsidio</strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <div align="center"><b>Para Ingresos De</b></div>
                                </td>
                                <td rowspan="2">
                                    <div align="center"><b>Hasta Ingresos De</b></div>
                                </td>
                                <td rowspan="2">
                                    <div align="center"><b>Subsidio al Empleo</b></div>
                                </td>
                                <td rowspan="2">

                                </td>
                            </tr>
                            <tr>
                            </tr>
                            <?
                              while ($datos5 = mysqli_fetch_array($resp5)) {
                ?>
                            <tr>
                                <td>
                                    <div align="center">$<? echo number_format($datos5['var1'], 2); ?></div>
                                </td>
                                <td>
                                    <div align="center">$<? echo number_format($datos5['var2'], 2); ?></div>
                                </td>
                                <td>
                                    <div align="center">$<? echo number_format($datos5['var3'], 2); ?></div>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <?
                              }
                              echo "</table>";
                ?>
                            <?
                            }
                          }
                          if (isset($_GET['impuesto']) && $_GET['impuesto'] == "anual") {
              ?>

                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>
                                            <div class="tooltip"
                                                title="Las personas físicas calcularán el impuesto anual, sumando a los ingresos acumulables obtenidos conforme a los diversos capítulos del Titulo IV de la Ley del Impuesto sobre la Renta, después de efectuar las deducciones autorizadas en cada capítulo y efectuarán asimismo la deducción de los gastos personales y deducciones autorizadas. A la cantidad que se obtenga se le aplicará la tarifa anual.">
                                                Datos para el cálculo<a href="#">-> ?</a></div>
                                        </strong></td>
                                </tr>
                            </table>

                            <form class="mui-form" method="post" action="{{ route('opcion') }}?impuesto=anual&fichaid3">
                                <div style="overflow-x:auto;">
                                    <table>

                                        <tr>
                                            <td>Ingreso Gravable</td>
                                            <td>
                                                <div class="mui-textfield"><input name="ingreso_gravable"
                                                        type="number" step=0.01
                                                        placeholder="<? echo number_format($_POST['ingreso_gravable'] ?? '0.0', 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Deducciones Autorizadas</td>
                                            <td>
                                                <div class="mui-textfield"><input name="deducciones_autorizadas"
                                                        type="number" step=0.01
                                                        placeholder="<? if (isset($_POST['deducciones_autorizadas'])&&$_POST['deducciones_autorizadas'] > 0) {
                                                                                                                                echo number_format($_POST['deducciones_autorizadas'], 2);
                                                                                                                              } else {
                                                                                                                                echo "0.00";
                                                        } ?>"></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>ISR Retenido en el Año</td>
                                            <td>
                                                <div class="mui-textfield"><input name="isr_retenido" type="number"
                                                        step=0.01
                                                        placeholder="<? echo number_format($_POST['isr_retenido'] ?? '0.0', 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Subsidio para el Empleo Pagado</td>
                                            <td>
                                                <div class="mui-textfield"><input name="subsidio_empleo"
                                                        type="number" step=0.01
                                                        placeholder="<? echo number_format($_POST['subsidio_empleo'] ?? '0.0', 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Subsidio Total Aplicado</td>
                                            <td>
                                                <div class="mui-textfield"><input name="subsidio_total"
                                                        type="number" step=0.01
                                                        placeholder="<? echo number_format($_POST['subsidio_total'] ?? '0.0', 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                                <br>
                                <p>
                                <div align="center"><button type="submit" class="button">Calcular</button></div>
                                </p>
                            </form>
                            <?
                          }
                          if (isset($_GET['fichaid3'])) {

                            $ingreso_gravable = $_POST['ingreso_gravable'];
                            $deducciones_autorizadas = $_POST['deducciones_autorizadas'];
                            $isr_retenido = $_POST['isr_retenido'];
                            $subsidio_empleo = $_POST['subsidio_empleo'];
                            $subsidio_total = $_POST['subsidio_total'];

                            $cal_flag = impuesto_anual($ingreso_gravable, 0, $isr_retenido, $subsidio_empleo, $subsidio_total);

                            $fecha = time();

                            $ingreso_gravable_total = (float) $ingreso_gravable - (float) $deducciones_autorizadas;

                            $resp1 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$GLOBAL_SYSTEM_YEAR'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
                            $datos1 = mysqli_fetch_array($resp1);
                            $limite_inferior = $datos1['var1'] ?? 0;

                            $importe_excedente_li = $ingreso_gravable_total - $limite_inferior;

                            $resp2 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$GLOBAL_SYSTEM_YEAR'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
                            $datos2 = mysqli_fetch_array($resp2);
                            $porcentaje_p_aplicarse = $datos2['var4'] ?? 0;

                            $impuesto_marginal = ($importe_excedente_li * ($porcentaje_p_aplicarse / 100)) / 100;

                            $resp3 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$GLOBAL_SYSTEM_YEAR'
and var1 between '0' and '$ingreso_gravable_total' and var1 != 0 order by var4 desc limit 1");
                            $datos3 = mysqli_fetch_array($resp3);
                            $cuota_fija = $datos1['var3'] ?? 0;

                            $impuesto_anual_calculado = $impuesto_marginal + $cuota_fija;

                            $impuesto_anual_total = $impuesto_anual_calculado - $subsidio_total;

                            if (isset($_POST['flag']) && $_POST['flag'] == 1) {
                              $c1 = round(($impuesto_anual_total + $subsidio_empleo - $isr_retenido) - $cal_flag, 0);
                            } else {
                              $c1 = round($impuesto_anual_total + $subsidio_empleo - $isr_retenido, 0);
                            }
            ?>
                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>Cálculo del ISR Q</strong></td>
                                </tr>
                            </table>
                            <div style="overflow-x:auto;">
                                <table>

                                    <tr>
                                        <td>
                                            <div class="tooltip"
                                                title="Ingreso Gravable $<? echo number_format((float)$ingreso_gravable, 2); ?> - Deducciones Autorizadas $<? echo number_format((float)$deducciones_autorizadas, 2); ?> = Ingreso Gravable Total $<? echo number_format((float)$ingreso_gravable_total, 2); ?>">
                                                Ingreso Gravable Total<a href="#">-> ?</a></div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div align="right">
                                                <b>$<? echo number_format($ingreso_gravable_total, 2); ?></b></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Límite Inferior</td>
                                        <td>-</td>
                                        <td>
                                            <div align="right">$<? echo number_format($limite_inferior, 2); ?>
                                                <hr>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Importe Excedente al Límite Inferior</td>
                                        <td>=</td>
                                        <td>
                                            <div align="right">$<? echo number_format($importe_excedente_li, 2); ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>(%) para aplicar sobre el Excedente</td>
                                        <td>x</td>
                                        <td>
                                            <div align="right"><? echo number_format($porcentaje_p_aplicarse, 2); ?>%
                                                <hr>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto Marginal</td>
                                        <td>=</td>
                                        <td>
                                            <div align="right">$<? echo number_format($impuesto_marginal, 2); ?></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cuota Fija</td>
                                        <td>+</td>
                                        <td>
                                            <div align="right">$<? echo number_format($cuota_fija, 2); ?>
                                                <hr>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Impuesto Anual Calculado</td>
                                        <td>=</td>
                                        <td>
                                            <div align="right">
                                                $<? echo number_format($impuesto_anual_calculado, 2); ?></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="tooltip"
                                                title="Impuesto Anual Calculado $<? echo number_format($impuesto_anual_calculado, 2); ?> - Subsidio Total Aplicado $<? echo number_format($subsidio_total, 2); ?> = Impuesto Anual Total $<? echo number_format($impuesto_anual_total, 2); ?>">
                                                Impuesto Anual Total<a href="#">-> ?</a></div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div align="right">$<? echo number_format($impuesto_anual_total, 2); ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b>
                                                <div class="tooltip"
                                                    title="El Impuesto Anual Total $<? echo number_format($impuesto_anual_total, 2); ?> + Subsidio para el Empleo Pagado $<? echo number_format($subsidio_empleo, 2); ?> - ISR Retenido en el año $<? echo number_format($isr_retenido, 2); ?> es igual a <? if ($c1 > 0) {
                                                                                                                                                                                                                                                                                                      echo "<b>
                                                    ISR A CARGO
                                            </b>";
                                            } else {
                                            echo "<b>ISR A FAVOR</b>";
                                            } ?> $<? echo number_format($c1, 2); ?>">
                                            <?
                            if ($c1 > 0) {
                              echo "<b>ISR A CARGO</b>";
                            } else {
                              echo "<b>ISR A FAVOR</b>";
                            }
                          ?>
                                            <a href="#">-> ?</a>
                            </div>
                            </b></td>
                            <td><b>=</b></td>
                            <td><b>
                                    <div align="right">$<? echo number_format(abs($c1), 2); ?></div>
                                </b>
                                <hr>
                                <hr>
                            </td>
                            </tr>

                        </table>

                        <p>
                        <div align="center">
                            <form target="_blank" class="mui-form" method="post"
                                action="{{ route('pdf_impuesto_anual') }}?var1=<? echo $_POST['ingreso_gravable'] ?>&pdf=yes&var2=<? echo $_POST['deducciones_autorizadas'] ?>&var3=<? echo $_POST['isr_retenido'] ?>&var4=<? echo $_POST['subsidio_empleo'] ?>&var5=<? echo $_POST['subsidio_total'] ?>&name=<? echo $_COOKIE['name_x1']; ?>&flag=<? echo $_POST['flag'] ?? 0; ?>&year=<? echo $_COOKIE['year_x1']; ?>">
                                <button type="submit" class="mui-btn mui-btn--raised">Imprimir cálculo</button>
                            </form>
                            &nbsp;
                            <? if (isset($_POST['flag']) && $_POST['flag'] == 1) { ?>
                            <form target="_blank" class="mui-form" method="post"
                                action="{{ route('pdf_pdi_completo_p') }}?var1=<? echo $_POST['ingreso_gravable'] ?>&pdf=yes&var2=<? echo $_POST['deducciones_autorizadas'] ?>&var3=<? echo $_POST['isr_retenido'] ?>&var4=<? echo $_POST['subsidio_empleo'] ?>&var5=<? echo $_POST['subsidio_total'] ?>&name=<? echo $_COOKIE['name_x1']; ?>&flag=<? echo $_POST['flag']; ?>&year=<? echo $GLOBAL_SYSTEM_YEAR ?>">
                                <button type="submit" class="mui-btn mui-btn--raised">Imprimir proyección</button>
                            </form>
                            <? } ?>
                            &nbsp;
                            <form target="_blank" class="mui-form" method="post"
                                action="{{ route('pdf_tablas_ia') }}?year=<? echo $GLOBAL_SYSTEM_YEAR ?>">
                                <input type="hidden" value="<? echo $_POST['ingreso_gravable'] ?>"
                                    name="ingreso_gravable" />
                                <input type="hidden" value="<? echo $_POST['deducciones_autorizadas'] ?>"
                                    name="deducciones_autorizadas" />
                                <input type="hidden" value="<? echo $_POST['isr_retenido'] ?>"
                                    name="isr_retenido" />
                                <input type="hidden" value="<? echo $_POST['subsidio_empleo'] ?>"
                                    name="subsidio_empleo" />
                                <input type="hidden" value="<? echo $_POST['subsidio_total'] ?>"
                                    name="subsidio_total" />
                                <button type="submit" class="mui-btn mui-btn--raised">Imprimir Tabla</button>
                            </form>
                        </div>
                        </p>
                        <?
                            mysqli_free_result($resp1);
                            mysqli_free_result($resp2);
                            mysqli_free_result($resp3);
                          }
                          if (isset($_GET['impuesto2']) && $_GET['impuesto2'] == "anual2") {
              ?>
                        <form target="_blank" class="mui-form" method="post" action="">
                            <input type="hidden" value="<? echo $_POST['ingreso_gravable'] ?>"
                                name="ingreso_gravable" />
                            <input type="hidden" value="<? echo $_POST['deducciones_autorizadas'] ?>"
                                name="deducciones_autorizadas" />
                            <input type="hidden" value="<? echo $_POST['isr_retenido'] ?>" name="isr_retenido" />
                            <input type="hidden" value="<? echo $_POST['subsidio_empleo'] ?>"
                                name="subsidio_empleo" />
                            <input type="hidden" value="<? echo $_POST['subsidio_total'] ?>"
                                name="subsidio_total" />
                            <p>
                            <div align="center"><button type="submit" class="button"><- Regresar</button></div>
                            </p>
                        </form>
                        <?
                            $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' order by var1 asc limit 12");
                ?>
                        <table border="1">
                            <tr>
                                <td colspan="4" bgcolor="#DFF2F0">
                                    <div align="center"><strong>Tablas Anuales 2016</strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" bgcolor="#DFF2F0">
                                    <div align="center"><strong>Tabla Impuesto</strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <div align="center"><b>Límite Inferior</b></div>
                                </td>
                                <td rowspan="2">
                                    <div align="center"><b>Límite Superior</b></div>
                                </td>
                                <td rowspan="2">
                                    <div align="center"><b>Cuota Fija</b></div>
                                </td>
                                <td rowspan="2">
                                    <div align="center"><b>% Para aplicarse s/excedente del límite inferior</b></div>
                                </td>
                            </tr>
                            <tr>
                            </tr>
                            <?
                            while ($datos4 = mysqli_fetch_array($resp4)) {
                  ?>
                            <tr>
                                <td>
                                    <div align="center">$<? echo number_format($datos4['var1'], 2); ?></div>
                                </td>
                                <td>
                                    <div align="center">$<? echo number_format($datos4['var2'], 2); ?></div>
                                </td>
                                <td>
                                    <div align="center">$<? echo number_format($datos4['var3'], 2); ?></div>
                                </td>
                                <td>
                                    <div align="center"><? echo number_format($datos4['var4'], 2); ?>%</div>
                                </td>
                            </tr>
                            <?
                            }
                            echo "</table>";
                            mysqli_free_result($resp4);
                  ?>
                            <br>
                            <?
                          }
                          if (isset($_GET['ver']) && $_GET['ver'] == "recomendar") {

                            if (isset($_GET['enviar'])) {
                              include_once('securimage/securimage.php');
                              $securimage = new Securimage();

                              if ($securimage->check($_POST['captcha_code']) == false) {
                                // the code was incorrect
                                // you should handle the error so that the form processor doesn't continue

                                // or you can use the following code if there is no validation or you do not know how
                                //iPhone/iPad -> <a href=\"\"><img src=\"http://siisarh.com/images/apple.jpg\"></a><br><br>
                                echo "El código de veríficación es incorrecto.<br /><br />";
                                echo "Por favor <a href='javascript:history.go(-1)'>inténtelo de nuevo click aquí</a>";
                                exit;
                              } else {

                                $var1 = $_POST['nombre'];
                                $var2 = $_POST['correo'];
                                $var3 = $_POST['nombre2'];
                                $var4 = $_POST['correo2'];
                                $to      = $var4;
                                $subject = '!Tu amigo ' . $var1 . ' te recomienda esta app!';
                                $message = "<p align=\"center\"><b>Hola $var3<b> ¿Cómo estás?</b><br><br>
Tu amigo $var1 te invita a utilizar la Calculadora de Impuestos de <a href=\"http://www.siisarh.com\">www.SIISARH.com</a><br><br>
Tienes 3 formas de acceder a la aplicación:<br><br>
Vía Web -> <a href=\"http://www.siisarh.com/calculadora\">www.SIISARH.com/Calculadora</a><br>
Android -> <a href=\"https://play.google.com/store/apps/details?id=com.lociamcorp.calculadora&hl=es\"><img src=\"http://siisarh.com/images/android.jpg\"></a><br><br>

¿Tienes dudas? Contáctanos:<br>
<a href=\"mailto:contactos@siisarh.com\">contactos@siisarh.com</a> | 55460213 & 55469353
</p>";

                                $headers = "From: $var2" . "\r\n" .
                                  "Reply-To: $var2" . "\r\n" .
                                  "X-Mailer: PHP/" . phpversion();
                                $headers .= 'MIME-Version: 1.0' . "\r\n";
                                $headers .= "Content-Type: text/html; charset=UTF-8\n";

                                mail($to, $subject, $message, $headers);
                                echo "<b>Su mensaje ha sido enviado, ¡Gracias!</b><br><br>";
                              }
                            }

                ?>
                            <form class="mui-form" method="post" action="{{ route('opcion') }}?ver=recomendar&enviar">
                                <table>
                                    <tr>
                                        <td bgcolor="#DFF2F0"><strong>Vía correo electrónico</strong></td>
                                    </tr>
                                </table>
                                <div style="overflow-x:auto;">
                                    <table>
                                        <tr>
                                            <td>Tu Nombre: </td>
                                            <td>
                                                <div class="mui-textfield"><input name="nombre" type="text"
                                                        required></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tu Correo electrónico: </td>
                                            <td>
                                                <div class="mui-textfield"><input name="correo" type="email"
                                                        placeholder="@" required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Nombre de tu amig@: </td>
                                            <td>
                                                <div class="mui-textfield"><input name="nombre2" type="text"
                                                        required></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Correo electrónico de tu amig@: </td>
                                            <td>
                                                <div class="mui-textfield"><input name="correo2" type="email"
                                                        placeholder="@" required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Verificación: </td>
                                            <td><img id="captcha" src="securimage/securimage_show.php"
                                                    alt="CAPTCHA Image" /><br>
                                                <div class="mui-textfield">
                                                    <input type="text" name="captcha_code" size="10"
                                                        maxlength="6" required />
                                                </div>
                                                <a href="#"
                                                    onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[
                                                    Mostrar otra imágen ]</a>
                                            </td>
                                        </tr>
                                    </table>
                                    <div align="center"><button type="submit"
                                            class="mui-btn mui-btn--raised">Enviar</button></div>
                                </div>
                            </form>

                            <?
                          }
                          if (isset($_GET['pdi']) && $_GET['pdi'] == "completo") {
                ?>
                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>Datos para el cálculo</strong></td>
                                </tr>
                            </table>

                            <form class="mui-form" method="post" action="{{ route('opcion') }}?pdi=completo&fichaid4">
                                <div style="overflow-x:auto;">
                                    <table>

                                        <tr>
                                            <td>Ingreso Total</td>
                                            <td>
                                                <div class="mui-textfield"><input name="ingreso_total" type="number"
                                                        step=0.01
                                                        placeholder="<? echo number_format($_POST['ingreso_total'] ?? '0.0', 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Ingreso Gravable</td>
                                            <td>
                                                <div class="mui-textfield"><input name="ingreso_gravable"
                                                        type="number" step=0.01
                                                        placeholder="<? echo number_format($_POST['ingreso_gravable'] ?? '0.0', 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>ISR Retenido en el Año</td>
                                            <td>
                                                <div class="mui-textfield"><input name="isr_retenido" type="number"
                                                        step=0.01
                                                        placeholder="<? echo number_format($_POST['isr_retenido'] ?? '0.0', 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Subsidio para el Empleo Pagado</td>
                                            <td>
                                                <div class="mui-textfield"><input name="subsidio_empleo"
                                                        type="number" step=0.01
                                                        placeholder="<? echo number_format($_POST['subsidio_empleo'] ?? '0.0', 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Subsidio Total Aplicado</td>
                                            <td>
                                                <div class="mui-textfield"><input name="subsidio_total"
                                                        type="number" step=0.01
                                                        placeholder="<? echo number_format($_POST['subsidio_total'] ?? '0.0', 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                                <? if (isset($_GET['fichaid4'])) { ?>
                                <br>
                                <? } else { ?>
                                <br>
                                <p>
                                <div align="center"><button type="submit" class="button">Siguiente</button></div>
                                </p>
                                <? } ?>

                            </form>
                            <?
                            if (isset($_GET['fichaid4'])) {
                              $porcentaje_15 = $_POST['ingreso_total'] * 0.15;
                              $tope_maximo = $_COOKIE['value_x1'] * 5 * 365;
                              $porcentaje_7 = $_POST['ingreso_total'] * 0.07;
                              $porcentaje_10 = $_POST['ingreso_total'] * 0.10;
                  ?>
                            <script>
                                function doMath() {
                                    var anteojos = parseInt(document.getElementById('j_anteojos').value);
                                    var anteojos_2 = anteojos * 2500;

                                    document.getElementById('j2_anteojos').value = anteojos_2;
                                    document.getElementById("j2_anteojos").style.background = "#C7FEC8";

                                }

                                function doMath2() {
                                    var funeral = parseInt(document.getElementById('j_funeral').value);
                                    var funeral_2 = funeral * 29419.00;

                                    document.getElementById('j2_funeral').value = funeral_2;
                                    document.getElementById("j2_funeral").style.background = "#C7FEC8";
                                }

                                function doMath3() {
                                    var gastos1 = parseInt(document.getElementById('j_gastos1').value);

                                    document.getElementById('qty1').value = gastos1;
                                    document.getElementById("qty1").style.background = "#C7FEC8";
                                }

                                function doMath4() {
                                    var xanteojos = parseInt(document.getElementById('x_anteojos').value);
                                    var anteojos = parseInt(document.getElementById('j_anteojos').value);
                                    var anteojos_2 = anteojos * 2500;
                                    var xanteojos2 = anteojos_2;
                                    if (xanteojos > xanteojos2) {
                                        document.getElementById('qty2').value = xanteojos2;
                                    } else {
                                        document.getElementById('qty2').value = xanteojos;
                                    }
                                    document.getElementById("qty2").style.background = "#C7FEC8";
                                }

                                function doMath5() {
                                    var xgastos = parseInt(document.getElementById('x_gastos').value);
                                    var funeral = parseInt(document.getElementById('j_funeral').value);
                                    var funeral_2 = funeral * 29419.00;
                                    if (xgastos > funeral_2) {
                                        document.getElementById('x2_gastos1').value = funeral_2;
                                    } else {
                                        document.getElementById('x2_gastos1').value = xgastos;
                                    }
                                    document.getElementById("x2_gastos1").style.background = "#C7FEC8";
                                }

                                function doMath6() {
                                    var intereses = parseInt(document.getElementById('j_intereses').value);

                                    document.getElementById('j2_intereses').value = intereses;
                                    document.getElementById("j2_intereses").style.background = "#C7FEC8";
                                }

                                function doMath7() {
                                    var primas = parseInt(document.getElementById('j_primas').value);

                                    document.getElementById('j2_primas').value = primas;
                                    document.getElementById("j2_primas").style.background = "#C7FEC8";
                                }

                                function doMath8() {
                                    var transporte = parseInt(document.getElementById('j_transporte').value);

                                    document.getElementById('j2_transporte').value = transporte;
                                    document.getElementById("j2_transporte").style.background = "#C7FEC8";
                                }

                                function doMath9() {
                                    var local = parseInt(document.getElementById('j_local').value);

                                    document.getElementById('j2_local').value = local;
                                    document.getElementById("j2_local").style.background = "#C7FEC8";
                                }

                                function doMath10() {
                                    var local = parseInt(document.getElementById('j_donativos').value);
                                    var php_var2 = "<?php echo $porcentaje_7; ?>";

                                    if (local > php_var2) {
                                        document.getElementById('j2_donativos').value = php_var2;
                                    } else {
                                        document.getElementById('j2_donativos').value = local;
                                    }

                                    document.getElementById("j2_donativos").style.background = "#C7FEC8";
                                }

                                function doMath11() {
                                    var local = parseInt(document.getElementById('j_aportaciones').value);
                                    var php_var3 = "<?php echo $porcentaje_10; ?>";

                                    if (local > php_var3) {
                                        document.getElementById('j2_aportaciones').value = php_var3;
                                    } else {
                                        document.getElementById('j2_aportaciones').value = local;
                                    }

                                    document.getElementById("j2_aportaciones").style.background = "#C7FEC8";
                                }

                                function doMath12() {
                                    var var1 = parseInt(document.getElementById('j_preescolar').value);
                                    var var2 = var1 * 14200;
                                    document.getElementById('j2_preescolar').value = var2;
                                    document.getElementById("j2_preescolar").style.background = "#C7FEC8";
                                }

                                function doMath13() {
                                    var var1 = parseInt(document.getElementById('j_preescolar').value);
                                    var var2 = var1 * 14200;
                                    var var3 = parseInt(document.getElementById('j_preescolar_2').value);

                                    if (var3 > var2) {
                                        document.getElementById('j2_preescolar2').value = var2;
                                    } else {
                                        document.getElementById('j2_preescolar2').value = var3;
                                    }
                                    document.getElementById("j2_preescolar2").style.background = "#C7FEC8";
                                }

                                function doMath14() {
                                    var var1 = parseInt(document.getElementById('j_primaria').value);
                                    var var2 = var1 * 12900;
                                    document.getElementById('j2_primaria').value = var2;
                                    document.getElementById("j2_primaria").style.background = "#C7FEC8";
                                }

                                function doMath15() {
                                    var var1 = parseInt(document.getElementById('j_primaria').value);
                                    var var2 = var1 * 12900;
                                    var var3 = parseInt(document.getElementById('j_primaria_2').value);

                                    if (var3 > var2) {
                                        document.getElementById('j2_primaria2').value = var2;
                                    } else {
                                        document.getElementById('j2_primaria2').value = var3;
                                    }
                                    document.getElementById("j2_primaria2").style.background = "#C7FEC8";
                                }

                                function doMath16() {
                                    var var1 = parseInt(document.getElementById('j_secundaria').value);
                                    var var2 = var1 * 19900;
                                    document.getElementById('j2_secundaria').value = var2;
                                    document.getElementById("j2_secundaria").style.background = "#C7FEC8";
                                }

                                function doMath17() {
                                    var var1 = parseInt(document.getElementById('j_secundaria').value);
                                    var var2 = var1 * 19900;
                                    var var3 = parseInt(document.getElementById('j_secundaria_2').value);

                                    if (var3 > var2) {
                                        document.getElementById('j2_secundaria2').value = var2;
                                    } else {
                                        document.getElementById('j2_secundaria2').value = var3;
                                    }
                                    document.getElementById("j2_secundaria2").style.background = "#C7FEC8";
                                }

                                function doMath18() {
                                    var var1 = parseInt(document.getElementById('j_profesional').value);
                                    var var2 = var1 * 17100;
                                    document.getElementById('j2_profesional').value = var2;
                                    document.getElementById("j2_profesional").style.background = "#C7FEC8";
                                }

                                function doMath19() {
                                    var var1 = parseInt(document.getElementById('j_profesional').value);
                                    var var2 = var1 * 17100;
                                    var var3 = parseInt(document.getElementById('j_profesional_2').value);

                                    if (var3 > var2) {
                                        document.getElementById('j2_profesional2').value = var2;
                                    } else {
                                        document.getElementById('j2_profesional2').value = var3;
                                    }
                                    document.getElementById("j2_profesional2").style.background = "#C7FEC8";
                                }

                                function doMath20() {
                                    var var1 = parseInt(document.getElementById('j_bachillerato').value);
                                    var var2 = var1 * 24500;
                                    document.getElementById('j2_bachillerato').value = var2;
                                    document.getElementById("j2_bachillerato").style.background = "#C7FEC8";
                                }

                                function doMath21() {
                                    var var1 = parseInt(document.getElementById('j_bachillerato').value);
                                    var var2 = var1 * 24500;
                                    var var3 = parseInt(document.getElementById('j_bachillerato_2').value);

                                    if (var3 > var2) {
                                        document.getElementById('j2_bachillerato2').value = var2;
                                    } else {
                                        document.getElementById('j2_bachillerato2').value = var3;
                                    }
                                    document.getElementById("j2_bachillerato2").style.background = "#C7FEC8";
                                }

                                function findTotal() {
                                    var var3 = 0;
                                    var arr = document.getElementsByName('qty');
                                    var tot = 0;
                                    for (var i = 0; i < arr.length; i++) {
                                        if (parseInt(arr[i].value))
                                            tot += parseInt(arr[i].value);
                                    }
                                    document.getElementById('total').value = tot;
                                    document.getElementById("total").style.background = "#FFE8E9";

                                    var arr2 = document.getElementsByName('qty2');
                                    var tot2 = 0;
                                    for (var i = 0; i < arr2.length; i++) {
                                        if (parseInt(arr2[i].value))
                                            tot2 += parseInt(arr2[i].value);
                                    }
                                    if (isNaN(tot2)) {

                                    } else {
                                        document.getElementById('total3').value = tot2;
                                    }
                                    document.getElementById("total3").style.background = "#FFE8E9";

                                    var php_var1 = "<?php echo $porcentaje_15; ?>";

                                    if (tot > php_var1) {
                                        var var4 = 0;
                                        document.getElementById('total2').value = php_var1;
                                        var var4 = php_var1;
                                    } else {
                                        var var4 = 0;
                                        document.getElementById('total2').value = tot;
                                        var var4 = tot;
                                    }
                                    document.getElementById("total2").style.background = "#FFE8E9";

                                    var var1 = parseInt(document.getElementById('j2_donativos').value);

                                    var var2 = parseInt(document.getElementById('j2_aportaciones').value);

                                    var var3 = parseFloat(var4) + parseFloat(tot2) + parseFloat(var2) + parseFloat(var1);
                                    document.getElementById('total4').value = var3;
                                    document.getElementById("total4").style.background = "#FFE8E9";

                                    if (isNaN(var1) && isNaN(var2)) {
                                        document.getElementById('j2_donativos').value = 0;
                                        document.getElementById('j2_aportaciones').value = 0;
                                    } else if (isNaN(var1)) {
                                        document.getElementById('j2_donativos').value = 0;
                                    } else if (isNaN(var2)) {
                                        document.getElementById('j2_aportaciones').value = 0;
                                    }

                                }
                                window.onload = findTotal;
                            </script>
                            <style type="text/css">
                                input[type=number] {
                                    width: 64px;
                                }
                            </style>
                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>Deducciones Personales</strong></td>
                                </tr>
                            </table>
                            <div style="overflow-x:auto;">
                                <form class="form-horizontal" id="whereEntry" method="post"
                                    action="{{ route('opcion') }}?impuesto=anual&fichaid3">
                                    <fieldset>
                                        <table>
                                            <tr>
                                                <td><b>Ingreso Total</b></td>
                                                <td><b>15%</b></td>
                                                <td><b>Tope Máximo</b></td>
                                            </tr>
                                            <tr>
                                                <td>$<? echo number_format($_POST['ingreso_total'], 2) ?></td>
                                                <td>$<? echo number_format($porcentaje_15, 2) ?></td>
                                                <td>$<? echo number_format($tope_maximo, 2) ?></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <table>

                                            <tr>
                                                <td><b>Art 151 LISR</b></td>
                                                <td><b>Concepto</b></td>
                                                <td><b>Tope Máximo por Concepto / Importe a Deducir</b></td>
                                                <td><b>Número de Beneficiarios / Importe Autorizado</b></td>
                                            </tr>

                                            <tr>
                                                <td>1.- </td>
                                                <td>Gastos médicos, dentales y hospitalarios</td>
                                                <td>Sin Tope</td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="1_gastos"
                                                            type="number" step=0.01 id="j_gastos1"
                                                            onBlur="doMath3(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input type="number"
                                                            id="qty1" name="qty" readonly="true"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>1.1- </td>
                                                <td>Anteojos Graduados</td>
                                                <td>$2,500.00<br>
                                                    <div class="mui-textfield"><input value="2500"
                                                            name="11_anteojos_c" type="number" readonly="true"
                                                            id="j2_anteojos"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input value="1"
                                                            name="11_anteojos_b" type="number" step=0.01
                                                            id="j_anteojos" onBlur="doMath();" required></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="11_anteojos"
                                                            type="number" step=0.01 id="x_anteojos"
                                                            onBlur="doMath4(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input type="number"
                                                            readonly="true" id="qty2" name="qty"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>2.- </td>
                                                <td>Gastos funerarios</td>
                                                <td>$29,419.00<br>
                                                    <div class="mui-textfield"><input value="29419"
                                                            name="2_gastos_c" type="number" readonly="true"
                                                            id="j2_funeral"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input value="1"
                                                            name="2_gastos_b" type="number" step=0.01
                                                            id="j_funeral" onBlur="doMath2();" required></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="2_gastos"
                                                            type="number" step=0.01 id="x_gastos"
                                                            onBlur="doMath5(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input class="price_food"
                                                            name="qty" type="number" readonly="true"
                                                            id="x2_gastos1"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>4.- </td>
                                                <td>Intereses reales por créditos hipotecarios</td>
                                                <td>Sin Tope</td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="4_intereses"
                                                            type="number" step=0.01 id="j_intereses"
                                                            onBlur="doMath6(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input class="price_food"
                                                            name="qty" type="number" readonly="true"
                                                            id="j2_intereses"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>5.- </td>
                                                <td>Primas de seguros de gástos médicos</td>
                                                <td>Sin Tope</td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="5_primas"
                                                            type="number" step=0.01 id="j_primas"
                                                            onBlur="doMath7(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input class="price_food"
                                                            name="qty" type="number" readonly="true"
                                                            id="j2_primas"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>7.- </td>
                                                <td>Gastos de transporte escolar obligatorio</td>
                                                <td>Sin Tope</td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="7_transporte"
                                                            type="number" step=0.01 id="j_transporte"
                                                            onBlur="doMath8(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input class="price_food"
                                                            name="qty" type="number" readonly="true"
                                                            id="j2_transporte"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>8.- </td>
                                                <td>Pagos por impuesto local sobre ingresos por salarios</td>
                                                <td>Sin Tope</td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="8_local"
                                                            type="number" step=0.01 id="j_local"
                                                            onBlur="doMath9(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input class="price_food"
                                                            name="qty" type="number" readonly="true"
                                                            id="j2_local"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Total Deducciones</td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <div class="mui-textfield"><input type="number"
                                                            disabled="disabled" id="total" name="total">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Total autorizado por tope máximo</td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <div class="mui-textfield"><input type="number"
                                                            disabled="disabled" id="total2" name="total">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>Art 151 LISR</b></td>
                                                <td><b>Concepto</b></td>
                                                <td><b>% de deducción</b></td>
                                                <td><b>% tope de deducción</b></td>
                                            </tr>

                                            <tr>
                                                <td>3.-</td>
                                                <td>Donativos</td>
                                                <td>7%</td>
                                                <td>$<? echo number_format($_POST['ingreso_total'], 2) ?> |
                                                    $<? echo number_format($porcentaje_7, 2) ?></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input value="0"
                                                            name="3_donativos" type="number" step=0.01
                                                            id="j_donativos" onBlur="doMath10(); findTotal();">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="qty3"
                                                            type="number" readonly="true" id="j2_donativos">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>6.-</td>
                                                <td>
                                                    <div class="tooltip"
                                                        title="Aportaciones a la subcuenta de aportaciones complementarias de retiro | Aportaciones a la subcuenta de aportaciones voluntarias | Planes personales de retiro">
                                                        Aportaciones -> ?</div>
                                                </td>
                                                <td>10%</td>
                                                <td>$<? echo number_format($_POST['ingreso_total'], 2) ?> |
                                                    $<? echo number_format($porcentaje_10, 2) ?></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input value="0"
                                                            name="6_aportaciones" type="number" step=0.01
                                                            id="j_aportaciones" onBlur="doMath11(); findTotal();">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="qty3"
                                                            type="number" readonly="true" id="j2_aportaciones">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>Art 151 LISR</b></td>
                                                <td><b>Concepto</b></td>
                                                <td><b>Tope Máximo por Concepto / Importe a Deducir</b></td>
                                                <td><b>Número de Beneficiarios / Importe Autorizado</b></td>
                                            </tr>

                                            <tr>
                                                <td>1.-</td>
                                                <td>
                                                    <div class="tooltip"
                                                        title="Artículo 1.14 del ( 112 KB) Decreto  que compila diversos beneficios fiscales y establece medidas de simplificación administrativa publicado en el Diario Oficial de la Federación del 30 de marzo de 2012.">
                                                        Colegiaturas -> ?</div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Preescolar</td>
                                                <td>$14,200.00</td>
                                                <td>
                                                    <div class="mui-textfield"><input value="1"
                                                            name="1_preescolar" type="number" step=0.01
                                                            id="j_preescolar" onBlur="doMath12();" required></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input value="14200"
                                                            type="number" readonly="true" id="j2_preescolar">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="1_preescolar"
                                                            type="number" step=0.01 id="j_preescolar_2"
                                                            onBlur="doMath13(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="qty2"
                                                            type="number" readonly="true" id="j2_preescolar2">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Primaria</td>
                                                <td>$12,900.00</td>
                                                <td>
                                                    <div class="mui-textfield"><input value="1"
                                                            name="1_primaria" type="number" step=0.01
                                                            id="j_primaria" onBlur="doMath14();" required></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input value="12900"
                                                            type="number" readonly="true" id="j2_primaria"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="1_primaria"
                                                            type="number" step=0.01 id="j_primaria_2"
                                                            onBlur="doMath15(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="qty2"
                                                            type="number" readonly="true" id="j2_primaria2">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Secundaria</td>
                                                <td>$19,900.00</td>
                                                <td>
                                                    <div class="mui-textfield"><input value="1"
                                                            name="1_secundaria" type="number" step=0.01
                                                            id="j_secundaria" onBlur="doMath16();" required></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input value="19900"
                                                            type="number" readonly="true" id="j2_secundaria">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="1_secundaria"
                                                            type="number" step=0.01 id="j_secundaria_2"
                                                            onBlur="doMath17(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="qty2"
                                                            type="number" readonly="true" id="j2_secundaria2">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Profesional Técnico</td>
                                                <td>$17,100.00</td>
                                                <td>
                                                    <div class="mui-textfield"><input value="1"
                                                            name="1_profesional" type="number" step=0.01
                                                            id="j_profesional" onBlur="doMath18();" required></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input value="17100"
                                                            type="number" readonly="true" id="j2_profesional">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="1_profesional"
                                                            type="number" step=0.01 id="j_profesional_2"
                                                            onBlur="doMath19(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="qty2"
                                                            type="number" readonly="true" id="j2_profesional2">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Bachillerato o su equivalente</td>
                                                <td>$24,500.00</td>
                                                <td>
                                                    <div class="mui-textfield"><input value="1"
                                                            name="1_bachillerato" type="number" step=0.01
                                                            id="j_bachillerato" onBlur="doMath20();" required></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Importe a deducir: </td>
                                                <td>
                                                    <div class="mui-textfield"><input value="24500"
                                                            type="number" readonly="true" id="j2_bachillerato">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="1_bachillerato"
                                                            type="number" step=0.01 id="j_bachillerato_2"
                                                            onBlur="doMath21(); findTotal();"></div>
                                                </td>
                                                <td>
                                                    <div class="mui-textfield"><input name="qty2"
                                                            type="number" readonly="true" id="j2_bachillerato2">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Total Colegiaturas</td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <div class="mui-textfield"><input type="number"
                                                            disabled="disabled" id="total3" name="total3">
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>Total Global Autorizado</td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <div class="mui-textfield"><input type="number"
                                                            id="total4" name="deducciones_autorizadas" readonly>
                                                    </div>
                                                </td>
                                            </tr>

                                        </table>
                                        <p>
                                        <div align="center"><button type="submit" class="button">Click aquí para
                                                proceder con el cálculo</button></div>
                                        </p>
                                    </fieldset>
                                    <input type="hidden" value="<? echo $_POST['ingreso_gravable'] ?>"
                                        name="ingreso_gravable" />
                                    <input type="hidden" value="<? echo $_POST['isr_retenido'] ?>"
                                        name="isr_retenido" />
                                    <input type="hidden" value="<? echo $_POST['subsidio_empleo'] ?>"
                                        name="subsidio_empleo" />
                                    <input type="hidden" value="<? echo $_POST['subsidio_total'] ?>"
                                        name="subsidio_total" />
                                    <input type="hidden" value="1" name="flag" />
                                </form>
                                <?
                            }
                          }
                          if (isset($_GET['pdi']) && $_GET['pdi'] == "simulador") {
                    ?>
                                <table>
                                    <tr>
                                        <td bgcolor="#DFF2F0"><strong>Datos para el cálculo</strong></td>
                                    </tr>
                                </table>

                                <form class="mui-form" method="post" action="{{ route('opcion') }}?pdi=simulador&fichaid4">
                                    <div style="overflow-x:auto;">
                                        <table>

                                            <tr>
                                                <td>Ingreso Total</td>
                                                <td>
                                                    <div class="mui-textfield"><input name="ingreso_total"
                                                            type="number" step=0.01
                                                            placeholder="<? echo number_format($_POST['ingreso_total'] ?? '0.0', 2) ?>"
                                                            required></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Deducciones Autorizadas</td>
                                                <td>
                                                    <div class="mui-textfield"><input name="deducciones_autorizadas"
                                                            type="number" step=0.01
                                                            placeholder="<? echo number_format($_POST['deducciones_autorizadas'] ?? '0.0', 2) ?>"
                                                            required></div>
                                                </td>
                                            </tr>

                                        </table>
                                        <p>
                                        <div align="center"><button type="submit"
                                                class="button">Siguiente</button></div>
                                        </p>
                                </form>
                            </div>
                            <?
                            if (isset($_GET['fichaid4'])) {
                    ?>
                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>Generar Cálculo</strong></td>
                                </tr>
                            </table>

                            <form target="_blank" class="mui-form" method="post"
                                action="{{ route('pdf_pdi_proyeccion_p') }}?var1=<? echo $_POST['ingreso_total'] ?>&pdf=yes&var2=<? echo $_POST['deducciones_autorizadas'] ?>&var3=0&var4=0&var5=0&name=<? echo $_COOKIE['name_x1']; ?>&flag=<? echo $_POST['flag'] ?? '0'; ?>&year=<? echo $GLOBAL_SYSTEM_YEAR ?>">
                                <p>
                                <div align="center"><button type="submit"
                                        class="mui-btn mui-btn--raised">Imprimir proyección</button></div>
                                </p>
                            </form>

                            <?
                            }
                          }
                          if (isset($_GET['pdi']) && $_GET['pdi'] == "prestadores") {
                    ?>
                            <table>
                                <tr>
                                    <td bgcolor="#DFF2F0"><strong>Datos para el cálculo</strong></td>
                                </tr>
                            </table>

                            <form class="mui-form" method="post" action="{{ route('opcion') }}?pdi=prestadores&fichaid4">
                                <div style="overflow-x:auto;">
                                    <table>

                                        <tr>
                                            <td>Total Ingresos</td>
                                            <td>
                                                <div class="mui-textfield"><input name="total_ingresos"
                                                        type="number" step=0.01
                                                        placeholder="<? echo number_format($_POST['total_ingresos'] ?? 0.00, 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Deducciones Personales</td>
                                            <td>
                                                <div class="mui-textfield"><input name="deducciones_personales"
                                                        type="number" step=0.01
                                                        placeholder="<? echo number_format($_POST['deducciones_personales'] ?? 0.00, 2) ?>"
                                                        required></div>
                                            </td>
                                        </tr>

                                    </table>
                                    <p>
                                    <div align="center"><button type="submit" class="button">Siguiente</button>
                                    </div>
                                    </p>
                            </form>
                </div>
                <?
                            if (isset($_GET['fichaid4'])) {
                              $limite1 = $_POST['total_ingresos'] * 0.15;
                              $limite2 = $_COOKIE['value_x1'] * 5 * 365;
                              $deducciones1 = $_POST['deducciones_personales'];

                              if ($deducciones1 > $limite2) {
                                $lmaximo = $limite2;
                              } else {
                                $lmaximo = $deducciones1;
                              }
              ?>
                <br>
                <table>

                    <tr>
                        <td>Límite Máximo</td>
                        <td>
                            <div class="mui-textfield"><input name="limite_maximo" type="number" step=0.01
                                    readonly="true" placeholder="<? echo number_format($lmaximo, 2) ?>"></div>
                        </td>
                    </tr>

                    <tr>
                        <td>Deducciones Personales Autorizadas</td>
                        <td>
                            <div class="mui-textfield"><input name="deducciones_autorizadas_2" type="number"
                                    step=0.01 readonly="true" placeholder="<? echo number_format($lmaximo, 2) ?>">
                            </div>
                        </td>
                    </tr>

                </table>
                <br>
                <table>
                    <tr>
                        <td bgcolor="#DFF2F0"><strong>Generar Cálculo</strong></td>
                    </tr>
                </table>

                <form target="_blank" class="mui-form" method="post"
                    action="{{ route('pdf_pdi_prestadores_p') }}?var1=<? echo $_POST['total_ingresos'] ?>&pdf=yes&var2=<? echo $lmaximo ?>&var3=0&var4=0&var5=0&name=<? echo $_COOKIE['name_x1']; ?>&flag=<? echo $_POST['flag'] ?? 0; ?>&year=<? echo $GLOBAL_SYSTEM_YEAR ?>">
                    <p>
                    <div align="center"><button type="submit" class="mui-btn mui-btn--raised">Imprimir
                            proyección</button></div>
                    </p>
                </form>
                <?
                }
              }
              ?>
                @if (isset($_GET['finiquitos']) && $_GET['finiquitos'] == 'a96')
                    @include ('form_finiquitos_a96')
                @endif
                @if (isset($_GET['finiquitos']) && $_GET['finiquitos'] == 'a174')
                    @include ('form_finiquitos_a174')
                @endif
                <?php
                if (isset($_GET['finiquitos']) && $_GET['finiquitos'] == 'calc') {
                    //antes de mostrar el calculo realizado se inserta en la BD
                    //apartir de los datos recibidos por método POST
                    require_once 'controllers/FiniquitoController.php';
                    $finiquitoCtrl = new FiniquitoController();
                    $modelo = $finiquitoCtrl->create([
                        'tipo_art' => $_POST['tipo_art'],
                        'codigo' => $_POST['codigo'],
                        'nombre' => $_POST['nombre'],
                        'imss' => $_POST['imss'],
                        'rfc' => $_POST['rfc'],
                        'curp' => $_POST['curp'],
                        'cuota_diaria' => $_POST['cuota_diaria'],
                        'fecha_ingreso' => $_POST['fecha_ingreso'],
                        'fecha_baja' => $_POST['fecha_baja'],
                        'vacaciones_pendientes' => $_POST['vacaciones_pendientes'],
                        'prima_vac_pendiente' => $_POST['prima_vac_pendiente'],
                        'gratificacion_servicios' => $_POST['gratificacion_servicios'],
                    ]);
                    include 'calculo_finiquito.php';
                }
                ?>
                <?
              if (isset($_GET['ver']) && $_GET['ver'] == "faq") {
              ?>
                <table>
                    <tr>
                        <td bgcolor="#DFF2F0"><strong>Preguntas Frecuentes</strong></td>
                    </tr>
                </table>
                <div style="overflow-x:auto;">
                    <table>
                        <tr>
                            <td>
                                <b>1. ¿Porque en la opción de Configuración se debe de elegir entre aplicar o no
                                    Subsidio para el Empleo en los cálculos?</b><br>
                                R: Esta configuración deberá ser modificada por aquellos usuarios que deban de elegir si
                                en su cálculo que realizara, deberá de aplicar el Subsidio para el Empleo o no, debido
                                ya que cuando prestan sus servicios a dos o más empleadores deben de elegir con cual
                                aplicara este beneficio, como lo marca el Art. decimo transitorio de la LISR.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>2. ¿Qué diferencia existe entre un cálculo y otro del Impuesto sobre la
                                    Renta?</b><br>
                                R: Por lo regular a cualquier cálculo de ISR, se aplica el procedimiento basado en el
                                Art. 96 de la LISR, en casos especiales como el pago de remuneraciones anuales, se
                                aplicara el procedimiento basado en el Art. 154 del RLISR y cuando se trata de un
                                cálculo anual, se aplica el procedimiento basado en el Art. 152 de la LISR.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>3. ¿Porque en algunos módulos se tiene que elegir entre tipo de cálculo ordinario e
                                    inverso?</b><br>
                                R: Por lo regular a cualquier cálculo de ISR, se aplica el procedimiento basado en el
                                Art. 96 de la LISR, en casos especiales como el pago de remuneraciones anuales, se
                                aplicara el procedimiento basado en el Art. 154 del RLISR y cuando se trata de un
                                cálculo anual, se aplica el procedimiento basado en el Art. 152 de la LISR.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>4. ¿Qué es un Ingreso Gravable?</b><br>
                                R: Es la base computada para causar un Impuesto, en otras palabras, el Ingreso gravable
                                es la diferencia que resulta de disminuir a los Ingresos netos percibidos, el total de
                                los Gastos permitidos por la Ley según el Art. 1110 de la LISR
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>5. ¿Porque se deben de descontar las faltas / incapacidades en el cálculo?</b><br>
                                R: El cálculo de Impuesto basado en el Art. 96 de la LISR, toma como referencia las
                                tablas mensuales proporcionales a los días reales laborados, por tanto es de suma
                                importancia descontar las faltas e incapacidades para calcular correctamente este
                                impuesto.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>6. ¿Cómo obtengo la conversión de las tablas mensuales a las proporcionales por días
                                    laborados?</b><br>
                                R: Cada uno de los Rangos de las tablas mensuales de las columnas, límite inferior,
                                superior y cuota fija deben de ser divididos entre 30.4 que son los días considerados
                                por el SAT como mensuales y a la cantidad que resulte se multiplicara por los días
                                Reales Laborados para obtener las tablas proporcionales. La columna del porcentaje sobre
                                el excedente no se modifica.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>7. ¿Por qué solo para algunos tipos de percepción existe alguna exención?</b><br>
                                R: La LISR determina en su Art. 93 que tipo de percepciones se encuentran exentas o cual
                                su tope de exención para el cálculo del ISR
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>8. Si calculo el ISR sobre otras remuneraciones ¿Por qué no tengo una parte
                                    exenta?</b><br>
                                R: Este concepto de Otras remuneraciones se considera como ingreso para el trabajador,
                                por lo cual no tiene ninguna parte exenta, como por ejemplo el pago de un bono especial,
                                por lo cual grava al 100% para el cálculo del ISR.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>9. Porque existen conceptos que se calculan con el procedimiento del art. 174 del
                                    RLISR y no con el del Art 96 de la LIRS?</b><br>
                                R: El Artículo 174 del Reglamento de la Ley del Impuesto sobre la Renta (ISR) establece
                                un procedimiento opcional para los patrones que calculan el impuesto sobre percepciones
                                que se devengan durante el año pero que se entregan en un solo pago como el caso de las
                                gratificaciones anuales o pagos similares, para así evitar hacer retenciones excesivas
                                al trabajador por estos conceptos.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>10. ¿Qué tablas debo de ocupar en mi cálculo de ISR por otras remuneraciones, la
                                    mensual o la anual?</b><br>
                                R: Para este concepto se aplica el procedimiento establecido en el Art. 174 del RLISR,
                                este procedimiento alterno consiste en “mensualizar” la percepción anual y aplicarle la
                                tarifa mensual de impuestos, de forma que el período de la tarifa de impuesto
                                corresponda con el período en que se percibe el ingreso. Por tanto el concepto de otras
                                remuneraciones debe de proporcionarse a un importe mensual y aplicar las tablas
                                mensuales.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>11. ¿Cómo obtengo mi importe neto después de haber obtenido mi ISR determinado o mi
                                    Subsidio para el empleo determinado?</b><br>
                                R: Al importe bruto del concepto utilizado en el cálculo de ISR se le restara el importe
                                determinado de ISR o se le sumara el importe determinado de Subsidio para el Empleo para
                                determinar el importe Neto.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>12. ¿Cómo debo de calcular correctamente mi Remuneración Promedio Mensual?</b><br>
                                R: El importe gravable del concepto de remuneración aplicado al cálculo, se dividirá
                                entre los 365 días del año y se multiplicara por 30.4 que es el factor mensual para
                                determinar el promedio mensual de dicha remuneración.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>13. ¿Cómo debo de calcular correctamente mi Sueldo Mensual?</b><br>
                                R: Se tomara solo como base la cuota diaria y se multiplicara por 30.4 que es el factor
                                para determinar el promedio mensual.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>14. ¿Por qué en el cálculo por otras remuneraciones no se aplica el Subsidio para el
                                    empleo?</b><br>
                                R: Realmente debe ser considerado para el cálculo en este procedimiento basado en el
                                Art. 174 del RLISR, pero por practicidad y debido a que la aplicación de este concepto
                                no influye en el resultado final, se omite.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>15. En el cálculo de Impuesto Anual debo capturar un campo que se llama Deducciones
                                    personales, ¿A qué se refiere?</b><br>
                                R: Son todos aquellos gastos y costos que realizan las personas físicas con un objetivo
                                de protección, ya sea de la propia persona física o de sus familiares más cercanos
                                (hijos, padres, cónyuges...). Son aplicables a cualquier persona física para cualquier
                                régimen en el que éstas tributen, pero solamente podrán hacer efectiva su disminución en
                                el momento de calcular su ISR anual, como por ejemplo, Honorarios médicos, dentales y
                                gastos hospitalarios, las Primas por seguros de gastos médicos y gastos funerarios, los
                                Donativos a instituciones autorizadas, los Intereses reales devengados y efectivamente
                                pagados durante el año al que corresponda la declaración, Aportaciones complementarias
                                de retiro, entre otros.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>16. ¿De dónde obtengo las cantidades que me solicita capturar el módulo de Impuesto
                                    Anual?</b><br>
                                R: Dentro de la Constancia de Declaración de Sueldos y Salarios que presenta tú
                                empleador al SAT, del cual te entrega una copia, dentro de su apartado 2 y 6 encontraras
                                la información requerida en este módulo.<br>
                                Ingreso gravable = campo Q1<br>
                                Deducciones Autorizadas = Opcional si se cuenta con ellas.<br>
                                ISR retenido en el año = Campo U1<br>
                                Subsidio para el empleo pagado = Campo c1<br>
                                Subsidio total aplicado = Campo J
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>17. ¿Qué diferencia existe entre ISR por Pagar e ISR a Favor?</b><br>
                                R: Si realizando un ajuste anual de impuesto en tu declaración anual, se determina que
                                en todo el año no se te retuvo el total de impuesto que deberías haber pagado por los
                                ingresos gravables que obtuviste, tendrás un ISR a pagar al fisco por esa diferencia, si
                                por el contrario, se determina que existió un exceso de retención, se te devolverá un
                                ISR a favor.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>18. ¿Existe algún tope para las deducciones personales?</b><br>
                                R: Cada deducción personal puede llegar a tener sus propios topes, pero en general, El
                                monto total de las deducciones personales (excepto donativos y estímulos fiscales) no
                                puede exceder de cinco salarios mínimos generales anuales o de 15% del total de tus
                                ingresos, incluidos los exentos, lo que resulte menor.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>19. ¿Cuál es el tope de Previsión Social que no se toma en cuenta para el cálculo de
                                    Impuesto Anual?</b><br>
                                R: Este límite para previsión social está establecido en el penúltimo párrafo del
                                Artículo 109 de LISR: La exención aplicable a los ingresos obtenidos por concepto de
                                prestaciones de previsión social se limitará cuando la suma de los ingresos por la
                                prestación de servicios personales subordinados o aquellos que reciban, por parte de las
                                sociedades cooperativas, los socios o miembros de las mismas y el monto de la exención
                                exceda de una cantidad a) equivalente a siete veces el salario mínimo general del área
                                geográfica del contribuyente, elevado al año; cuando dicha suma exceda de la cantidad
                                citada, solamente se considerara como ingreso no sujeto al pago del impuesto un monto
                                hasta de b)un salario mínimo general del área geográfica del contribuyente, elevado al
                                año. Esta limitación en ningún caso deberá dar como resultado que la suma de los
                                ingresos por la prestación de servicios personales subordinados o aquellos que reciban,
                                por parte de las sociedades cooperativas, los socios o miembros de las mismas y el
                                importe de la exención, sea inferior a siete veces el salario mínimo general del área
                                geográfica del contribuyente, elevado al año.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>20. ¿Porque en el cálculo de Impuesto Anual, no se utiliza la tabla de Subsidio para
                                    el Empleo?</b><br>
                                R: En el cálculo del impuesto anual, solo se determinara el impuesto causado por los
                                ingresos gravables del trabajador de forma anual, al resultado obtenido se le restara el
                                Subsidio total aplicado, se le sumara el efectivamente pagado y se le restara el ISR
                                retenido para obtener el impuesto anual determinado. Por tanto las tablas del subsidio
                                para el empleo solo aplicaran en los cálculos provisionales.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>21. Si soy una persona física que trabaja por honorarios, ¿siempre me deben de
                                    retener ISR e IVA?</b><br>
                                R: Cuando una persona física del régimen de actividad profesional y empresarial que se
                                dedica a prestar un servicio profesional independiente (LISR Art. 100 Frac. II), es
                                decir, personas cuyas actividades requieren de un título profesional para llevarla a
                                cabo, realizan operaciones con personas morales estas están obligadas a retenerles
                                impuestos de ISR e IVA.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>22. ¿Qué porcentaje de IVA trasladado debo de aplicar a mi recibo de
                                    honorarios?</b><br>
                                R: Con Fundamento en los: Artículos 1, 2, Octavo Transitorio, fracción III de la LIVA y
                                TERCERO de la 3ra. Resolución de Modificaciones a la Resolución Miscelánea Fiscal para
                                2009 publicada en el DOF el 28 de diciembre de 2009, la tasa del IVA será del 16%.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>23. ¿Qué diferencia existe entre Importe Bruto e Importe Neto?</b><br>
                                R: El importe Bruto es la cantidad a cual todavía se le tiene que realizar las
                                retenciones o descuentos que por ley procedan y el importe Neto, será la cantidad total
                                efectivamente pagada al trabajador.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>24. ¿Qué diferencia hay entre IVA trasladado e IVA Retenido?</b><br>
                                R: El IVA trasladado, es el que te cobran en todos tus pagos, El IVA Retenido, es el que
                                te retiene una persona moral cuando le prestas tus servicios como persona física.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>25. ¿Qué diferencia existe entre sueldos y salarios y asimilado a salarios?</b><br>
                                R: En el régimen de sueldos y salarios entran todas las personas que trabajan de manera
                                subordinada, es decir, que el trabajador se pone a disposición del empleador de manera
                                física e intelectual para desarrollar una actividad determinada, mediante el pago de un
                                salario y sometiéndose a una jornada laboral, legalmente establecida. En el caso de
                                asimilados a salarios, este régimen es para aquellas personas físicas que prestan
                                servicios profesionales a personas físicas o morales, pero que optan por tributar en
                                este régimen ya que de esta manera pagarán un solo impuesto, el ISR, como si fueran
                                trabajadores asalariados, es decir, mediante las retenciones que les realicen sus
                                empleadores y en este caso también se ahorrarán la obligación de tener que entregar
                                recibos por honorarios a las personas que les presten los servicios, así como tampoco
                                deberán realizar el cálculo del Impuesto al Valor Agregado (IVA).
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>26. ¿Debo descontar faltas en un cálculo de ISR por asimilado a salarios?</b><br>
                                R: Por lo regular al Trabajar como asimilado a salarios, se pactan cantidades neta
                                mensuales como pago por el servicio, por lo cual, muchas veces no se toma en cuenta los
                                días reales laborados, pero para efectos de un cálculo correcto de retención de ISR,
                                debes considerar los Días Reales.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>27. ¿Cómo imprimo mi cálculo realizado?</b><br>
                                R: Una vez realizado el cálculo elegido, aparecerá en la barra superior derecha un icono
                                de una impresora, con el cual podrás obtener una pre visualización de un Archivo en
                                formato PDF que podrás guardar directamente en tu celular para después imprimir en tu
                                computadora o compartirlo por diferentes aplicaciones.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>28. ¿Cómo comparto el cálculo que acabo de realizar con otra persona?</b><br>
                                R: Una vez que cuentes con el archivo PDF guarda en tu celular del cálculo de ISR
                                realizado, podrás compartirlo desde la carpeta descargas por medio de diferentes
                                aplicaciones como son WhatsApp, Correo electrónico, Bluetooth, Skype, Dropbox entre
                                otras.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>29. ¿Cómo personalizo mi cálculo para entregarlo a otra persona?</b><br>
                                R: En el menú configuración, en la parte de Versión impresa, podrás capturar el nombre
                                de la persona a la cual entregaras el cálculo realizado, para que este personalizado.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>30. ¿Cómo consulto las tablas completas que utilice en mi cálculo?</b><br>
                                R: Una vez realizado el cálculo seleccionado de ISR, en la parte de Desarrollo del
                                cálculo de ISR que aparece en la pantalla de tu celular, se habilitara un icono con la
                                imagen de una tabla de 3x3, en el cual al entrar te mostrara las tablas completas
                                utilizadas en tu cálculo.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>31. ¿Cuentan con algún tipo de ayuda, o soporte para la APP?</b><br>
                                R: Cualquier duda, comentario o sugerencia con respeto al manejo o cálculo de impuesto
                                de nuestra aplicación, podrás compartirla con nosotros por cualquiera de nuestros medios
                                de contacto mencionados en el módulo contacto del menú principal.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>32. ¿Cuántos cálculos puedo realizar con la APP?</b><br>
                                R: No tienes límite de cálculos, podrás realizar cuantos cálculos necesites.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>33. ¿Manejan alguna otra APP o programa?</b><br>
                                R: Te invitamos a visitar nuestro modulo Quienes Somos y Productos del menú principal,
                                para que encuentres toda la variedad de herramientas que ponemos a tu disposición.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>34. ¿Qué significa Proyección con Devolución de Impuestos?</b><br>
                                R: Es una modulo diseñado para apoyar a los usuarios de la APP para poder determinar de
                                una forma clara y sencilla de qué manera podrán obtener los beneficios que la misma Ley
                                de ISR menciona para una correcta Devolución de Impuestos, ya sea de forma completa, en
                                el esquema de una simulación o si eres prestador de servicios y quieres saber cómo se
                                beneficiarían tus clientes por tan solo emitirles una factura o recibo de honorarios que
                                sea deducible.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>35. Si soy prestado de servicios, ¿en qué me beneficia la APP?</b><br>
                                R: Te beneficiara, debido a que con esta herramienta, podrás apoyar a tus clientes en
                                tomar una buena decisión y contratar tus servicios, debido a que si eres una persona que
                                emite facturas o entrega recibos de honorarios por los servicios que presta y estos se
                                encuentran dentro de los que pueden ser deducibles de impuestos, se podrá simular cuanto
                                podrá obtener de beneficio en su ajuste anual y así tener una devolución de Impuestos a
                                su favor.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>36. ¿Todos estamos obligados a realizar una Declaración anual de Impuestos?</b><br>
                                R: No todas las personas físicas registradas en el régimen de sueldos y salarios están
                                obligadas a presentar su declaración anual de impuestos, pero todas pueden optar por
                                presentarla para poder obtener los beneficios de aplicar deducciones personales y así
                                obtener una devolución de impuestos a su favor.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>37. ¿Por qué al inicio de año me quitan más impuesto?</b><br>
                                R: Esto puede depender de varios factores, como por ejemplo, si el SAT cambia las tablas
                                de con las que se calcula el ISR, o por el aumento en el Salario Mínimo General, y los
                                topes de exenciones que esto implica.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>38. Tengo un trabajo en una empresa y trabajo por mi cuenta por honorarios, ¿son
                                    diferentes los cálculos del impuesto?</b><br>
                                R. Si, cada régimen en el que tributas maneja diferentes procesos para cálculo de
                                impuestos.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>39. ¿Si no laboré todo el año en mi empresa, me devolverán impuesto el año
                                    entrante?</b><br>
                                R: Depende de tus ingresos que hayas percibido en el año, así como de las retención que
                                te hayan hecho de ISR, por lo cual te invitamos a realizar un cálculo de tu situación.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>40. Tengo trabajadores de fin de semana ¿Cuál tabla de impuestos les aplico, la
                                    semanal?</b><br>
                                R: Lo más conveniente es aplicar la tabla mensual proporcional a los días reales
                                trabajados.
                            </td>
                        </tr>

                    </table>
                </div>
                <?
                          }
                          if (isset($_GET['ver']) && $_GET['ver'] == "tablas") {
                            $year = $_GET['year'];
            ?>
                <table>
                    <tr>
                        <td bgcolor="#DFF2F0"><strong>Tablas de Impuesto Aplicables</strong></td>
                    </tr>
                </table>
                <br>
                <font size="1">
                    <?
                            $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA IMPUESTO FIJA' and year='$year' order by var1 asc limit 12");
                ?>
                    <table border="1">
                        <tr>
                            <td colspan="4" bgcolor="#DFF2F0">
                                <div align="center"><strong>Tablas Anuales <? echo $_GET['year'] ?></strong></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" bgcolor="#DFF2F0">
                                <div align="center"><strong>Tabla Impuesto</strong></div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">
                                <div align="center"><b>Límite Inferior</b></div>
                            </td>
                            <td rowspan="2">
                                <div align="center"><b>Límite Superior</b></div>
                            </td>
                            <td rowspan="2">
                                <div align="center"><b>Cuota Fija</b></div>
                            </td>
                            <td rowspan="2">
                                <div align="center"><b>% Para aplicarse s/excedente del límite inferior</b></div>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                        <?
                            while ($datos4 = mysqli_fetch_array($resp4)) {
                  ?>
                        <tr>
                            <td>
                                <div align="center">$<? echo number_format($datos4['var1'], 2); ?></div>
                            </td>
                            <td>
                                <div align="center">$<? echo number_format($datos4['var2'], 2); ?></div>
                            </td>
                            <td>
                                <div align="center">$<? echo number_format($datos4['var3'], 2); ?></div>
                            </td>
                            <td>
                                <div align="center"><? echo number_format($datos4['var4'], 2); ?>%</div>
                            </td>
                        </tr>
                        <?
                            }
                            echo "</table>";
                            mysqli_free_result($resp4);
                  ?><br><br>
                        <?
                            $resp4 = mysqli_query($conectar, "select * from tablas_calculo where nombre_tabla='TABLA SUBSIDIO FIJA' and year='$year' order by var1 asc limit 12");
                  ?>
                        <table border="1">
                            <tr>
                                <td colspan="4" bgcolor="#DFF2F0">
                                    <div align="center"><strong>Tabla Subsidio</strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <div align="center"><b>Para ingresos de</b></div>
                                </td>
                                <td rowspan="2">
                                    <div align="center"><b>Hasta ingresos de</b></div>
                                </td>
                                <td rowspan="2">
                                    <div align="center"><b>Subsidio al empleo</b></div>
                                </td>
                                <td rowspan="2">
                                    <div align="center"></div>
                                </td>
                            </tr>
                            <tr>
                            </tr>
                            <?
                            while ($datos4 = mysqli_fetch_array($resp4)) {
                    ?>
                            <tr>
                                <td>
                                    <div align="center">$<? echo number_format($datos4['var1'], 2); ?></div>
                                </td>
                                <td>
                                    <div align="center">$<? echo number_format($datos4['var2'], 2); ?></div>
                                </td>
                                <td>
                                    <div align="center">$<? echo number_format($datos4['var3'], 2); ?></div>
                                </td>
                                <td>
                                    <div align="center"></div>
                                </td>
                            </tr>
                            <?
                            }
                            echo "</table>";
                            mysqli_free_result($resp4);
                    ?><br><br>
                            <?
                            if ($_GET['year'] == "2016") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2016, publicada en el DOF el 12 de Enero de 2016.";
                            } elseif ($_GET['year'] == "2017") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2017, publicada en el DOF el 5 de Enero de 2017.";
                            } elseif ($_GET['year'] == "2018") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2018, publicada en el DOF el 29 de Diciembre de 2017.";
                            } elseif ($_GET['year'] == "2019") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2019, publicada en el DOF el 24 de Diciembre de 2018.";
                            } elseif ($_GET['year'] == "2020") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2020, publicada en el DOF el 9 de Enero de 2020.";
                            } elseif ($_GET['year'] == "2021") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2021, publicada en el DOF el 29 de Diciembre de 2020.";
                            } elseif ($_GET['year'] == "2022") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2022, publicada en el DOF el 27 de Diciembre de 2021.";
                            } elseif ($_GET['year'] == "2023") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2023, publicada en el DOF el 27 de Diciembre de 2022.";
                            } elseif ($_GET['year'] == "2024") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2024, publicada en el DOF el 29 de Diciembre de 2023.";
                            } elseif ($_GET['year'] == "2025") {
                              echo "Actualizada en anexo 8 de la Resolución miscelánea fiscal para 2024, publicada en el DOF el 30 de Diciembre de 2024.";
                            }
                    ?>
                </font>
                <?
                          }
                          if (isset($_GET['ver']) && $_GET['ver'] == "productos") {
            ?>
                <div style="overflow-x:auto;">
                    <table>
                        <tr>
                            <td>
                                <a href="https://confiapp.com.mx/portales/" target="_blank">Portales</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="https://confiapp.com.mx/enlace-reloj-checador/" target="_blank">Enlace
                                    Reloj Checador</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="https://confiapp.com.mx/habilidad-y-adiestramiento/"
                                    target="_blank">Habilidad y Adiestramiento</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="https://confiapp.com.mx/control-presupuestal/" target="_blank">Control
                                    Presupuestal</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="https://confiapp.com.mx/recursos-humanos/" target="_blank">Recursos
                                    Humanos</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="https://confiapp.com.mx/apsi-vepa/" target="_blank">Apsi-Vepa</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="https://confiapp.com.mx/nominatiss-sat/" target="_blank">NOMINATISS-SAR</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <?
                          }
                          if (isset($_GET['ver']) && $_GET['ver'] == "tutoriales") {
            ?>
                <video width="100%" controls>
                    <source src="https://confiapp.com.mx/archivos/CALCULADORASIISARHISR.mp4" type="video/mp4">
                </video>
                <?
                          }
            ?>
            </div>
        </div>

</body>

</html>
