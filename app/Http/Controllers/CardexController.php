<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 

class CardexController extends Controller
{	
	//Apenas exibir a tela para consultar cardex
    public function indexCardex(){ 
    	$produtos = DB::table('produtos')->where([ 
            ['controlEstoque',1],
            ['status',1],
            ['deleted_at',NULL]
        ])->get();
    	return view('estoque.cardex',compact('produtos'));
    } 
    //Este método apenas retorna os itens da cardex que estão no intervalo de datas
    public function searchCardex($from,$to,$produto_id){  
		$consulta =	DB::table('cardex')->where('produto_id',$produto_id)->whereBetween('created_at', [$from, $to])->get(); 
		return json_encode($consulta);
    }
}