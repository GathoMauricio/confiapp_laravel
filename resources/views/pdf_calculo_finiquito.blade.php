<?php
$fecha_calculo = (new DateTime($modelo->created_at))->format('d/m/Y');
$fecha_ingreso = (new DateTime($modelo->fecha_ingreso))->format('d/m/Y');
$fecha_baja = (new DateTime($modelo->fecha_baja))->format('d/m/Y');

function formatMoney($number) {
    return '$'. number_format((float)$number, 2);
}

function eh($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

?>
<bookmark content="Start of the Document" />
<div>
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
       .header-cell {
            text-align: center;
            background-color: #f0f0f0; /* Color de fondo para cabeceras */
            font-weight: bold;
        }
       .data-label { /* Estilo para etiquetas como "NOMBRE", "RFC" */
            font-weight: normal;
        }
       .data-value { /* Estilo para los datos */
            font-weight: bold;
        }
    </style>
    <br>

    <table border="0">
        <tr>
        <td align="center" width="25%"><img src="./images/logo3.jpg" width="114" height="37" /></td>
        <td align="center" width="75%"><p><b>Calculadora ConfiApp<br>Cálculo de finiquito</b></p></td>
        </tr>
    </table>

    <br>
    <table border="0">
        <tr>
            <td class="data-label" width="25%"><b>Fecha de cálculo: </b></td>
            <td class="data-value" width="75%">{{$fecha_calculo}}</td>
        </tr>
        <tr>
            <td class="data-label" width="25%"><b>Tipo de cálculo: </b></td>
            <td class="data-value" width="75%">{{ eh($modelo->tipo_art == 'A96' ? "ARTÍCULO 96" : "ARTÍCULO 174")}}</td>
        </tr>
        <tr>
            <td class="data-label" width="25%"><b>Realizado para: </b></td>
            <td class="data-value" width="75%">{{ eh($modelo->nombre)}}</td>
        </tr>
    </table>
</div>
<br>
<table border="0">
    <tr>
        <td colspan="4" class="header-cell">DATOS GENERALES</td>
    </tr>
    <tr>
        <td class="data-label" width="25%">CÓDIGO</td>
        <td class="data-value" width="25%">{{ eh($modelo->codigo)}}</td>
        <td width="25%"></td>
        <td width="25%"></td>
    </tr>
    <tr>
        <td class="data-label">NOMBRE</td>
        <td class="data-value">{{eh($modelo->nombre)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">IMSS</td>
        <td class="data-value">{{eh($modelo->imss)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">RFC</td>
        <td class="data-value">{{ eh($modelo->rfc)}} </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">CURP</td>
        <td class="data-value">{{eh($modelo->curp)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">CUOTA DIARIA</td>
        <td class="data-value">{{ formatMoney($modelo->cuota_diaria)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">S.B.C.</td>
        <td class="data-value">{{ formatMoney($modelo->sbc)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">FECHA DE INGRESO</td>
        <td class="data-value">{{$fecha_ingreso}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">FECHA DE BAJA</td>
        <td class="data-value">{{$fecha_baja}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">DIAS AGUINALDO</td>
        <td class="data-value">{{$modelo->dias_aguinaldo}}</td>
        <td class="data-value">{{ formatMoney($modelo->dias_aguinaldo_r)}}</td>
        <td class="data-value">DIAS</td>
    </tr>
    <tr>
        <td class="data-label">DIAS VACACIONES</td>
        <td class="data-value">{{$modelo->dias_vac}}</td>
        <td class="data-value">{{ formatMoney($modelo->dias_vac_r)}}</td>
        <td class="data-value">DIAS</td>
    </tr>
    <tr>
        <td class="data-label">AÑOS CUMPLIDOS</td>
        <td class="data-value">{{$modelo->anios_cumplidos}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="4" class="header-cell">CÁLCULO FINIQUITO</td>
    </tr>
    <tr>
        <td class="data-label">P.P. AGUINALDO</td>
        <td class="data-value">{{ formatMoney($modelo->pp_aguinaldo_r)}}</td>
        <td class="data-value">{{$modelo->pp_aguinaldo}}</td>
        <td class="data-value">DIAS</td>
    </tr>
    <tr>
        <td class="data-label">P.P. VACACIONES</td>
        <td class="data-value">{{ formatMoney($modelo->pp_vacaciones_r)}}</td>
        <td class="data-value">{{$modelo->pp_vacaciones}}</td>
        <td class="data-value">DIAS</td>
    </tr>
    <tr>
        <td class="data-label">P.P. PRIMA VAC</td>
        <td class="data-value">{{ formatMoney($modelo->pp_prima_vac_r)}}</td>
        <td class="data-value">{{$modelo->pp_prima_vac}}%</td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">VACACIONES PENDIENTES A.A.</td>
        <td class="data-value">{{ formatMoney($modelo->vacaciones_pendientes_r)}} </td> <td class="data-value">{{$modelo->vacaciones_pendientes}}</td> <td class="data-value">DIAS</td>
    </tr>
    <tr>
        <td class="data-label">PRIMA VAC PENDIENTES A.A.</td>
        <td class="data-value">{{ formatMoney($modelo->prima_vac_pendiente_r)}}</td> <td class="data-value">{{$modelo->prima_vac_pendiente}}%</td> <td></td>
    </tr>
    <tr>
        <td class="data-label">GRATIFICACIÓN POR SERVICIOS (BONO)</td>
        <td class="data-value">{{ formatMoney($modelo->gratificacion_servicios)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">TOTAL PERCEPCIONES</td>
        <td class="data-value">{{ formatMoney($modelo->total_percepciones)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">ISR RETENIDO POR AGUINALDO</td>
        <td class="data-value">{{ formatMoney($modelo->isr_aguinaldo)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">ISR RETENIDO POR VACACIONES</td>
        <td class="data-value">{{ formatMoney($modelo->isr_vacaciones)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">ISR RETENIDO POR PRIMA VAC</td>
        <td class="data-value">{{ formatMoney($modelo->isr_prima_vac)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">ISR RETENIDO POR BONO ({{ ($modelo->tipo_art == 'A96' ? "ART 96" : "ART 174")}})</td>
        <td class="data-value">{{ formatMoney($modelo->isr_bono)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">TOTAL DEDUCCIONES</td>
        <td class="data-value">{{ formatMoney($modelo->total_deducciones)}}</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td class="data-label">NETO A PAGAR</td>
        <td class="data-value">{{ formatMoney($modelo->neto_pagar)}}</td>
        <td></td>
        <td></td>
    </tr>
</table>
