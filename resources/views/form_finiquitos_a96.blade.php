<h1>Cálculo finiquito Artículo 96</h1>
<form action="{{ route('calcular_finiquito') }}" method="POST" class="mui-form">
    @csrf
    <input type="hidden" name="tipo_art" value="A96">
    <input type="hidden" name="codigo" value="019403">
    <input type="hidden" name="nombre" value="John Doe">
    <input type="hidden" name="imss" value="965458ASDF">
    <input type="hidden" name="rfc" value="870212SSDFG">
    <input type="hidden" name="curp" value="870212SSDFG2HA">
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <td>Cuota diaria</td>
                <td>
                    <div class="mui-textfield"><input name="cuota_diaria" type="number" placeholder="0.00" step=0.01 value="1000" required></div>
                </td>
            </tr>
            <tr>
                <td>Fecha de ingreso</td>
                <td>
                    <div class="mui-textfield"><input name="fecha_ingreso" type="date" value="2025-01-01"  required></div>
                </td>
            </tr>
            <tr>
                <td>Fecha de baja</td>
                <td>
                    <div class="mui-textfield"><input name="fecha_baja" type="date" value="2025-04-30" required></div>
                </td>
            </tr>
            <tr>
                <td>Vacaciones pendientes (Dias)</td>
                <td>
                    <div class="mui-textfield"><input name="vacaciones_pendientes" type="number" min="0" placeholder="0" value="0" required></div>
                </td>
            </tr>
            <tr>
                <td>Prima Vac pendiente A.A. (%)</td>
                <td>
                    <div class="mui-textfield"><input name="prima_vac_pendiente" type="number" min="0" placeholder="25" value="25" required></div>
                </td>
            </tr>
            <tr>
                <td>Gratificación por servicios (Bono)</td>
                <td>
                    <div class="mui-textfield"><input name="gratificacion_servicios" type="number" placeholder="0.00" value="10000.00" step=0.01 required></div>
                </td>
            </tr>
        </table>
        <p>
        <div align="center">
            <button type="submit" class="button">Siguiente</button>
        </div>
        </p>
    </div>
</form>
