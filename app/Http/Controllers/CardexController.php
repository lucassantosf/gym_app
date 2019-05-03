<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CardexController extends Controller
{	
	//Apenas exibir a tela para consultar cardex
    public function indexCardex(){
    	return view('estoque.cardex');
    }
}
