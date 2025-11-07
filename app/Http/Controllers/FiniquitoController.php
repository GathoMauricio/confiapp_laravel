<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finiquito;
use Mpdf\Mpdf;
use Exception;
use DateTime;
use Log;

class FiniquitoController extends Controller
{
    // Propiedades para almacenar los datos de entrada
    private string $tipo_art;
    private float $cuotaDiaria;
    private DateTime $fechaIngreso;
    private DateTime $fechaBaja;
    private int $pp_prima_vac;
    private int $vacaciones_pendientes;
    private int $prima_vac_pendiente;
    private float $gratificacion_servicios;

    // Propiedades para configuración y tablas
    private array $jsonIntegracion = [];
    private float $smdf;
    private float $uma;
    private int $topeImss;
    private int $dias_aguinaldo;
    private int $dias_vac;

    // Propiedades calculadas internamente
    private int $diasTrabajados;
    private int $aniosAntiguedad;
    private float $totalAnioTope;
    private float $sbc;
    private int $anioEnCurso;
    private int $dias_anio;
    private float $dias_aguinaldo_r;
    private float $dias_vac_r;
    private float $pp_aguinaldo_r;
    private float $pp_vacaciones_r;
    private float $pp_prima_vac_r;
    private float $vacaciones_pendientes_r;
    private float $prima_vac_pendiente_r;
    private float $total_percepciones;
    private float $isr_aguinaldo;
    private float $isr_vacaciones;
    private float $isr_prima_vac;
    private float $isr_bono;
    private float $total_deducciones;
    private float $neto_pagar;

    public function __construct()
    {
        //Cargar la configuración general (UMA, SMDF, etc.)
        $this->cargarConfiguracion(storage_path('app/data/config.json'));
        //Cargar la tabla de integración desde el JSON
        $this->cargarJsonIntegracion(storage_path('app/data/tabla_integracion.json'));
        //Obtener dias del anio en curso
        $this->anioEnCurso = (int)(date('Y'));
        $this->dias_anio = $this->obtenerDiasDelAnio($this->anioEnCurso);
    }

    public function calcularFiniquito(Request $request)
    {
        $modelo = $this->create([
            'tipo_art' => $request->tipo_art,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'imss' => $request->imss,
            'rfc' => $request->rfc,
            'curp' => $request->curp,
            'cuota_diaria' => $request->cuota_diaria,
            'fecha_ingreso' => $request->fecha_ingreso,
            'fecha_baja' => $request->fecha_baja,
            'vacaciones_pendientes' => $request->vacaciones_pendientes,
            'prima_vac_pendiente' => $request->prima_vac_pendiente,
            'gratificacion_servicios' => $request->gratificacion_servicios
        ]);

        Log::info('Modelo de finiquito calculado:', $modelo->toArray());

        if ($request->expectsJson()) {
            // Si el cliente (Flutter) espera JSON, retorna el modelo como JSON
            return response()->json($modelo);
        }

        return view('calculo_finiquito', compact('modelo'));
    }

    public function create($data)
    {
        //Asignar y validar los datos de entrada
        $this->tipo_art = $data['tipo_art'];
        $this->cuotaDiaria = (float)($data['cuota_diaria'] ?? 0.0);
        $this->vacaciones_pendientes = $data['vacaciones_pendientes'];
        $this->prima_vac_pendiente = $data['prima_vac_pendiente'];
        $this->gratificacion_servicios = $data['gratificacion_servicios'];
        //Usamos objetos DateTime para un manejo de fechas
        $this->fechaIngreso = new DateTime($data['fecha_ingreso']);
        $this->fechaBaja = new DateTime($data['fecha_baja']);
        //Realizar cálculos iniciales
        $this->diasTrabajados = $this->calcularDiasTranscurridos();
        $this->aniosAntiguedad = floor($this->diasTrabajados / 365);
        $this->totalAnioTope = $this->smdf * $this->topeImss;
        $this->sbc = $this->calcularSbc();
        //Calcular dias_aguinaldo_r
        $this->dias_aguinaldo_r = $this->dias_aguinaldo / $this->dias_anio * $this->getFactorAgui();
        //Calcular dias_vac_r
        $this->dias_vac_r = round($this->dias_vac / $this->dias_anio * $this->getFactorDiasVac(), 2);
        //Calcular pp_aguinaldo_r
        $this->pp_aguinaldo_r =  round($this->dias_aguinaldo_r * $this->cuotaDiaria, 2);
        //Calcular pp_vacaciones_r
        $this->pp_vacaciones_r =  round($this->dias_vac_r * $this->cuotaDiaria, 2);
        //Calcular pp_prima_vac
        $this->pp_prima_vac_r = round($this->dias_vac_r * ($this->pp_prima_vac / 100) * $this->cuotaDiaria, 2);
        //Calcular vacaciones_pendientes_r
        $this->vacaciones_pendientes_r = round($this->cuotaDiaria * $this->vacaciones_pendientes);
        //Calcular prima_vac_pendiente_r
        $this->prima_vac_pendiente_r = round($this->vacaciones_pendientes_r * ($this->prima_vac_pendiente / 100), 2);
        //Calcular total_percepciones
        $this->total_percepciones = round($this->pp_aguinaldo_r + $this->pp_vacaciones_r + $this->pp_prima_vac_r + $this->vacaciones_pendientes_r + $this->prima_vac_pendiente_r + $this->gratificacion_servicios, 2);
        //Cargar datos de isr apartir del tipo de calculo
        if ($this->tipo_art == 'A96') {
            $this->cargarDatosIsr(storage_path('app/data/isr_a96.json'));
        } else {
            $this->cargarDatosIsr(storage_path('app/data/isr_a174.json'));
        }
        //Calcular $total_deducciones
        $this->total_deducciones = round($this->isr_aguinaldo + $this->isr_vacaciones + $this->isr_prima_vac + $this->isr_bono, 2);
        //Calcular neto_pagar
        $this->neto_pagar = round($this->total_percepciones - $this->total_deducciones, 2);
        //Se crea el modelo que se conectará con la bd
        $modelo = new Finiquito();
        //Se hace la inserción a la tabla de finiquitos con las variables procesadas y se obtiene la respuesta de la operación
        $modelo = Finiquito::create([
            'tipo_art' => $this->tipo_art,
            'codigo' => $data['codigo'],
            'nombre' => $data['nombre'],
            'imss' => $data['imss'],
            'rfc' => $data['rfc'],
            'curp' => $data['curp'],
            'cuota_diaria' => $data['cuota_diaria'],
            'sbc' => $this->sbc,
            'fecha_ingreso' => $data['fecha_ingreso'],
            'fecha_baja' => $data['fecha_baja'],
            'dias_aguinaldo' => $this->dias_aguinaldo,
            'dias_aguinaldo_r' => $this->dias_aguinaldo_r,
            'dias_vac' => $this->dias_vac,
            'dias_vac_r' => $this->dias_vac_r,
            'anios_cumplidos' => $this->aniosAntiguedad,
            'pp_aguinaldo' => $this->getFactorAgui(),
            'pp_aguinaldo_r' => $this->pp_aguinaldo_r,
            'pp_vacaciones' => $this->getFactorDiasVac(),
            'pp_vacaciones_r' => $this->pp_vacaciones_r,
            'pp_prima_vac' => $this->pp_prima_vac,
            'pp_prima_vac_r' => $this->pp_prima_vac_r,
            'vacaciones_pendientes' => $this->vacaciones_pendientes,
            'vacaciones_pendientes_r' => $this->vacaciones_pendientes_r,
            'prima_vac_pendiente' => $this->prima_vac_pendiente,
            'prima_vac_pendiente_r' => $this->prima_vac_pendiente_r,
            'gratificacion_servicios' => $this->gratificacion_servicios,
            'total_percepciones' => $this->total_percepciones,
            'isr_aguinaldo' => $this->isr_aguinaldo,
            'isr_vacaciones' => $this->isr_vacaciones,
            'isr_prima_vac' => $this->isr_prima_vac,
            'isr_bono' => $this->isr_bono,
            'total_deducciones' => $this->total_deducciones,
            'neto_pagar' => $this->neto_pagar,
        ]);
        return $modelo;
    }

    function find(int $id): ?object
    {
        //Se crea el modelo que se conectara con la bd
        $modelo = new Finiquito();
        //retorna un objeto con las propiedades del modelo finiquito
        return $modelo->get($id);
    }

    /**
     * Carga el archivo JSON con la tabla de integración.
     */
    private function cargarJsonIntegracion(string $ruta): void
    {
        if (!file_exists($ruta)) {
            throw new Exception("El archivo de integración no existe en la ruta: $ruta");
        }
        $jsonString = file_get_contents($ruta);
        $this->jsonIntegracion = json_decode($jsonString, true); // true para obtener un array asociativo

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error al decodificar el archivo JSON de integración.");
        }
    }

    /**
     * Carga el archivo JSON con valores de configuración.
     */
    private function cargarConfiguracion(string $ruta): void
    {
        if (!file_exists($ruta)) {
            throw new Exception("El archivo de configuración no existe en la ruta: $ruta");
        }
        $jsonString = file_get_contents($ruta);
        $config = json_decode($jsonString, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error al decodificar el archivo JSON de configuración.");
        }

        $this->smdf = (float)($config['SMDF'] ?? 0.0);
        $this->uma = (float)($config['UMA'] ?? 0.0);
        $this->topeImss = (int)($config['TOPE_IMSS'] ?? 0); // Valor por defecto 25 UMAS
        $this->dias_aguinaldo = (int)($config['DIAS_AGUINALDO'] ?? 0);
        $this->dias_vac = (int)($config['DIAS_VACACIONES'] ?? 0);
        $this->pp_prima_vac = (int)($config['PP_PRIMA_VAC'] ?? 0);
    }

    private function cargarDatosIsr($ruta)
    {
        if (!file_exists($ruta)) {
            throw new Exception("El archivo de configuración no existe en la ruta: $ruta");
        }
        $jsonString = file_get_contents($ruta);
        $config = json_decode($jsonString, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error al decodificar el archivo JSON de configuración.");
        }

        $this->isr_aguinaldo = (float)($config['ISR_AGUINALDO'] ?? 0.0);
        $this->isr_vacaciones = (float)($config['ISR_VACACIONES'] ?? 0.0);
        $this->isr_prima_vac = (float)($config['ISR_PRIMA_VAC'] ?? 0.0);
        $this->isr_bono = (float)($config['ISR_BONO'] ?? 0.0);
    }

    /**
     * Calcula el factor de integración basado en los años de antigüedad.
     * El índice 'i' corresponde a los años de antigüedad.
     *
     * @return float El factor de integración.
     */
    private function getFactorIntegracion(): float
    {
        // Asegurarse de que el índice de antigüedad existe en la tabla
        if (!isset($this->jsonIntegracion[$this->aniosAntiguedad])) {
            // Si no existe, podrías tomar el último valor disponible o lanzar un error
            // Aquí tomaremos el último por si la tabla no llega a tantos años
            $objeto = end($this->jsonIntegracion);
        } else {
            $objeto = $this->jsonIntegracion[$this->aniosAntiguedad];
        }

        $primaEnDecimal = (float)$objeto['prima_vac'] / 100;
        $diasVac = (float)$objeto['dias_vac'];
        $agui = (float)$objeto['agui'];

        $integracion = ((($diasVac * $primaEnDecimal) + $agui) / 365) + 1;

        return round($integracion, 5); // Equivalente a toFixed(5)
    }

    /**
     * Calcula el Salario Base de Cotización (SBC).
     *
     * @return float El SBC calculado.
     */
    public function calcularSbc(): float
    {
        $factorIntegracion = $this->getFactorIntegracion();
        $sbcSinTope = $factorIntegracion * $this->cuotaDiaria;

        // Aplicar el tope del IMSS
        if ($sbcSinTope >= $this->totalAnioTope) {
            return $this->totalAnioTope;
        }

        return round($sbcSinTope, 2);
    }

    public function getFactorAgui()
    {
        if (!isset($this->jsonIntegracion[$this->aniosAntiguedad])) {
            $objeto = end($this->jsonIntegracion);
        } else {
            $objeto = $this->jsonIntegracion[$this->aniosAntiguedad];
        }

        $agui = (float)$objeto['agui'];
        return $agui;
    }

    public function getFactorDiasVac()
    {
        if (!isset($this->jsonIntegracion[$this->aniosAntiguedad])) {
            $objeto = end($this->jsonIntegracion);
        } else {
            $objeto = $this->jsonIntegracion[$this->aniosAntiguedad];
        }

        $diasVac = (float)$objeto['dias_vac'];
        return $diasVac;
    }

    /**
     * Calcula los días transcurridos entre dos fechas.
     * El +1 es para incluir el último día en el conteo.
     */
    private function calcularDiasTranscurridos(): int
    {
        $diferencia = $this->fechaBaja->diff($this->fechaIngreso);
        return $diferencia->days + 1;
    }

    /**
     * Devuelve si un año es bisiesto o no.
     */
    private function obtenerDiasDelAnio(int $anio): int
    {
        // 'L' devuelve 1 si es bisiesto, 0 si no.
        $esBisiesto = date('L', mktime(0, 0, 0, 1, 1, $anio));
        return $esBisiesto ? 366 : 365;
    }

    public function pdfCalculoFiniquito(Request $request, $finiquito_id = null)
    {
        ini_set('memory_limit', '512M');
        // Si finiquito_id no viene en la URL, busca en el request body/query
        $idToUse = $finiquito_id ?? $request->input('finiquito_id');

        if (!$idToUse) {
            return response()->json(['error' => 'Finiquito ID es requerido'], 400);
        }

        $modelo = Finiquito::find($idToUse);

        if (!$modelo) {
            return response()->json(['error' => 'Finiquito no encontrado'], 404);
        }


        $html = view('pdf_calculo_finiquito', compact('modelo'))->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 15,
            'margin_right' => 15,
        ]);

        $mpdf->SetHeader('{PAGENO}');
        $mpdf->SetFooter('<table><tr><td width="80%"><div align="center">El presente cálculo deriva de la aplicación de procedimientos establecidos en la ley del ISR y su Reglamento, interpretados matemáticamente con datos capturados por el usuario de la aplicación sin responsabilidad para ConfiApp.<br>Copyright © 2025 Calculadora ConfiApp. Todos los Derechos Reservados.</div></td><td align="center" width="20%"><img src="./images/qr_img.png" width="95" height="94"></td></tr></table>');

        $mpdf->WriteHTML($html);

        // Si el request espera JSON o es de nuestra API, podemos considerar retornar un base64 del PDF
        // Sin embargo, para visualizar directamente, es mejor que el servidor envíe el PDF directamente
        // con el Content-Type adecuado. 'I' ya lo hace.
        return $mpdf->Output('mi-pdf_finiquito_siisarh.pdf', 'I'); // 'I' envía el PDF al navegador
    }
}
