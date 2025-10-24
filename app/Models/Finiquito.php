<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finiquito extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'finiquitos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'tipo_art',
        'codigo',
        'nombre',
        'imss',
        'rfc',
        'curp',
        'cuota_diaria',
        'sbc',
        'fecha_ingreso',
        'fecha_baja',
        'dias_aguinaldo',
        'dias_aguinaldo_r',
        'dias_vac',
        'dias_vac_r',
        'anios_cumplidos',
        'pp_aguinaldo',
        'pp_aguinaldo_r',
        'pp_vacaciones',
        'pp_vacaciones_r',
        'pp_prima_vac',
        'pp_prima_vac_r',
        'vacaciones_pendientes',
        'vacaciones_pendientes_r',
        'prima_vac_pendiente',
        'prima_vac_pendiente_r',
        'gratificacion_servicios',
        'total_percepciones',
        'isr_aguinaldo',
        'isr_vacaciones',
        'isr_prima_vac',
        'isr_bono',
        'total_deducciones',
        'neto_pagar'
    ];
}
