<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetoOrcamento extends Model
{
    use HasFactory;

    protected $fillable = ['id_projeto', 'programa_de_trabalho', 'fonte', 'natureza_da_despesa', 'especificacao', 'valor'];
}
