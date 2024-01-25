<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projeto extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'instituicao_executora',
        'responsavel_ie',
        'instituicao_concedente',
        'responsavel_ic',
        'objeto',
        'meta',
        'gestor',
        'lider',
        'valor',
        'data_inicio',
        'data_termino',
    ];

    public function orcamento(): HasMany
    {
        return $this->hasMany(ProjetoOrcamento::class, 'id_projeto');
    }
}
