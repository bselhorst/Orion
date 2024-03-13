<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjetoOrcamentoDespesa extends Model
{
    use HasFactory;

    protected $fillable = ['id_orcamento', 'id_aux_cept', 'descricao', 'unidade', 'quantidade', 'valor_unitario'];

    public function orcamento(): BelongsTo
    {
        return $this->belongsTo(ProjetoOrcamento::class);
    }
}
