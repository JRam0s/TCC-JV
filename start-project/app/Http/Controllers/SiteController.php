<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Ganho;
use App\Models\Gasto;
use App\Models\Pagamento;
use App\Models\Meta;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function getCategorias() {
        $data = Categoria::orderBy('nome')->get();
        return view('site.categoria', compact('data'));
    }

    public function getGanhos() {
        $data = Ganho::orderBy('nome')->get();
        return view('site.ganho', compact('data'));
    }

    public function getGastos() {
        $data = Material::orderBy('dt_pagamento')->get();
        return view('site.gasto', compact('data'));
    }
    
    public function getPagamentos() {
        $data = Pagamento::orderBy('nome')->get();
        return view('site.pagamento', compact('data'));
    }
    
    public function getMetas() {
        $data = Meta::orderBy('nome')->get();
        return view('site.meta', compact('data'));
    }
}
