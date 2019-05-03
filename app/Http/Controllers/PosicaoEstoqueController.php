<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosicaoEstoqueController extends Controller
{	
	//Este método retorna a view da tela posição de estoque
    public function indexPosicaoEstoque(){ 
    	$produtos = DB::table('produtos')->where([ 
            ['controlEstoque',1],
            ['status',1],
            ['deleted_at',NULL],
        ])->get();  
    	$posicao = DB::table('posicao_estoque_atual')->where([
        	['deleted_at',NULL],
        ])->get();
    	return view('estoque.posicao_estoque',compact('produtos','posicao'));
    }
}
