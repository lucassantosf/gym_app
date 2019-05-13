<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Plano;
use App\Modalidade;

class RelatorioController extends Controller
{

	public function viewRelatorioClientes(){
		$planos = Plano::all();
		$modals = Modalidade::all();
		return view('relatorios.clientes',compact('planos','modals'));
	}

}