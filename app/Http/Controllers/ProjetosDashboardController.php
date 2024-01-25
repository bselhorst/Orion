<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Projeto;

class ProjetosDashboardController extends Controller
{
    public function handleChart()
    {
        $data = Projeto::with('orcamento')->get();
        return view('projeto.dashboard', compact('data'));
    }

    public function json()
    {
        $data = Projeto::with('orcamento')->get();
        return $data;
    }
}
