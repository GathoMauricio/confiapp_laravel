<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'opcion',
        'pdf_tablas_sueldos_y_salarios',
        'pdf_ptu',
        'pdf_tablas_otras_r',
        'pdf_asimilados_salarios',
        'pdf_honorarios',
        'pdf_impuesto_anual',
        'pdf_tablas_ia',
        'pdf_pdi_completo_p',
        'pdf_pdi_proyeccion_p',
        'pdf_pdi_prestadores_p',
        'contacto',
        'recomienda',
    ];
}
