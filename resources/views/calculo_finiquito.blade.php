<?php
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
                <font size="2">Calculo finiquito</font><img src="./images/logo.png" align="right" />
            </div>
        </div>
    </header>
    <div id="content-wrapper">
        <div class="mui--appbar-height"></div>
        <div class="mui-container-fluid">
            <br>
            <table>
                <tr>
                    <td bgcolor="#DFF2F0"><strong>Calculo finiquito
                            <?= $modelo->tipo_art == 'A96' ? 'Artícuo 96' : 'Artículo 174' ?> </strong></td>
                </tr>
            </table>
            <div style="overflow-x:auto;">
                <fieldset>
                    <table>
                        <tr>
                            <td colspan="4" style="text-align:center;">DATOS GENERALES</td>
                        </tr>
                        <tr>
                            <td>CÓDIGO</td>
                            <td style="font-weight:bold;"><?= $modelo->codigo ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>NOMBRE</td>
                            <td style="font-weight:bold;"><?= $modelo->nombre ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>IMSS</td>
                            <td style="font-weight:bold;"><?= $modelo->imss ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>RFC</td>
                            <td style="font-weight:bold;"><?= $modelo->rfc ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>CURP</td>
                            <td style="font-weight:bold;"><?= $modelo->curp ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>CUOTA DIARIA</td>
                            <td style="font-weight:bold;">$<?= $modelo->cuota_diaria ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>S.B.C.</td>
                            <td style="font-weight:bold;">$<?= $modelo->sbc ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>FECHA DE INGRESO</td>
                            <td style="font-weight:bold;"><?= $modelo->fecha_ingreso ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>FECHA DE BAJA</td>
                            <td style="font-weight:bold;"><?= $modelo->fecha_baja ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>DIAS AGUINALDO</td>
                            <td style="font-weight:bold;"><?= $modelo->dias_aguinaldo ?></td>
                            <td style="font-weight:bold;">$<?= $modelo->dias_aguinaldo_r ?></td>
                            <td style="font-weight:bold;">DIAS</td>
                        </tr>
                        <tr>
                            <td>DIAS VACACIONES</td>
                            <td style="font-weight:bold;"><?= $modelo->dias_vac ?></td>
                            <td style="font-weight:bold;">$<?= $modelo->dias_vac_r ?></td>
                            <td style="font-weight:bold;">DIAS</td>
                        </tr>
                        <tr>
                            <td>AÑOS CUMPLIDOS</td>
                            <td style="font-weight:bold;"><?= $modelo->anios_cumplidos ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:center;">CÁLCULO FINIQUITO</td>
                        </tr>
                        <tr>
                            <td>P.P. AGUINALDO</td>
                            <td style="font-weight:bold;">$<?= $modelo->pp_aguinaldo_r ?></td>
                            <td style="font-weight:bold;"><?= $modelo->pp_aguinaldo ?></td>
                            <td style="font-weight:bold;">DIAS</td>
                        </tr>
                        <tr>
                            <td>P.P. VACACIONES</td>
                            <td style="font-weight:bold;">$<?= $modelo->pp_vacaciones_r ?></td>
                            <td style="font-weight:bold;"><?= $modelo->pp_vacaciones ?></td>
                            <td style="font-weight:bold;">DIAS</td>
                        </tr>
                        <tr>
                            <td>P.P. PRIMA VAC</td>
                            <td style="font-weight:bold;">$<?= $modelo->pp_prima_vac_r ?></td>
                            <td style="font-weight:bold;"><?= $modelo->pp_prima_vac ?>%</td>
                            <td style="font-weight:bold;"></td>
                        </tr>
                        <tr>
                            <td>VACACIONES PENDIENTES A.A.</td>
                            <td style="font-weight:bold;">$<?= $modelo->vacaciones_pendientes_r ?></td>
                            <td style="font-weight:bold;"><?= $modelo->vacaciones_pendientes ?></td>
                            <td style="font-weight:bold;">DIAS</td>
                        </tr>
                        <tr>
                            <td>PRIMA VAC PENDIENTES A.A.</td>
                            <td style="font-weight:bold;">$<?= $modelo->prima_vac_pendiente_r ?></td>
                            <td style="font-weight:bold;"><?= $modelo->prima_vac_pendiente ?>%</td>
                            <td style="font-weight:bold;"></td>
                        </tr>
                        <tr>
                            <td>GRATIFICACIÓN POR SERVICIOS (BONO)</td>
                            <td style="font-weight:bold;">$<?= $modelo->gratificacion_servicios ?></td>
                            <td style="font-weight:bold;"></td>
                            <td style="font-weight:bold;"></td>
                        </tr>
                        <tr>
                            <td>TOTAL PERCEPCIONES</td>
                            <td style="font-weight:bold;">$<?= $modelo->total_percepciones ?></td>
                            <td style="font-weight:bold;"></td>
                            <td style="font-weight:bold;"></td>
                        </tr>
                        <tr>
                            <td>ISR RETENIDO POR AGUINALDO</td>
                            <td style="font-weight:bold;">$<?= $modelo->isr_aguinaldo ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>ISR RETENIDO POR VACACIONES</td>
                            <td style="font-weight:bold;">$<?= $modelo->isr_vacaciones ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>ISR RETENIDO POR PRIMA VAC</td>
                            <td style="font-weight:bold;">$<?= $modelo->isr_prima_vac ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>ISR RETENIDO POR BONO (<?= $modelo->tipo_art == 'A96' ? 'ART 96' : 'ART 174' ?>)</td>
                            <td style="font-weight:bold;">$<?= $modelo->isr_bono ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>TOTAL DEDUCCIONES</td>
                            <td style="font-weight:bold;">$<?= $modelo->total_deducciones ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>NETO A PAGAR</td>
                            <td style="font-weight:bold;">$<?= $modelo->neto_pagar ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </fieldset>
            </div>
            <form target="_blank" class="mui-form" method="post" action="{{ route('pdf_calculo_finiquito') }}">
                @csrf
                <input type="hidden" name="finiquito_id" value="<?= $modelo->id ?>">
                <p>
                <div align="center"><button type="submit" class="mui-btn mui-btn--raised">Imprimir cálculo</button>
                </div>
                </p>
            </form>

        </div>
    </div>
</body>

</html>
