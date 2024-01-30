<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjetoOrcamento extends Model
{
    use HasFactory;

    protected $fillable = ['id_projeto', 'programa_de_trabalho', 'fonte', 'natureza_da_despesa', 'especificacao', 'valor'];

    public function projeto(): BelongsTo
    {
        return $this->belongsTo(Projeto::class, 'id_projeto');
    }

    public function despesa(): HasMany
    {
        return $this->hasMany(ProjetoOrcamentoDespesa::class, 'id_orcamento');
    }
}
