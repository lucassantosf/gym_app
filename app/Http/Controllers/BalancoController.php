<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Balanco;
use App\ItemBalanco;

class BalancoController extends Controller
{
    //Exibir o histórico de balanços
    public function indexBalancos(){
    	$i = 0;
    	$balancos = Balanco::all(); 
    	$posicao_atual = DB::table('posicao_estoque_atual')->where([
        	['deleted_at',NULL],
        ])->get();
    	return view('estoque.balanco',compact('i','balancos','posicao_atual'));
    }

    //Exibir o form para lançar balanço
    public function formBalanco(){
    	$i = 1; 
        $produtos = DB::table('produtos')->where([ 
            ['controlEstoque',1],
            ['status',1],
            ['deleted_at',NULL]
        ])->get();
        $posicao_atual = DB::table('posicao_estoque_atual')->where([
        	['deleted_at',NULL],
        ])->get();
    	return view('estoque.balanco',compact('i','produtos','posicao_atual'));
    }

    //Este método trata o post do formulário da Balanco
    public function postFormBalanco(Request $request){
    	$balanco = new Balanco(); 
    	$prods_id = $request->input('prods_id'); 
    	$prods_name = $request->input('prods_name'); 
    	$qtdProd = $request->input('qtdProd');
    	$lastSaldo = $request->input('lastSaldo');
    	$diffence = $request->input('diffence'); 
    	//Salvar o Balanço 
    	$balanco->dt_balanco = $request->input('dt_emissao');
    	$balanco->save(); 
    	//Salvar cada item do balanco
    	for ($i=0; $i < count($prods_id); $i++) { 
    		$item = new ItemBalanco();
    		$item->balanco_id = $balanco->id;
    		$item->produto_id = $prods_id[$i];
    		$item->produto_nome = $prods_name[$i];
    		$item->quantidade_balanco = $qtdProd[$i];
    		$item->quantidade_anterior = $lastSaldo[$i];
    		$item->diferenca_balanco = $diffence[$i];
    		$item->save();

    		//Atualizar na posição de estoque a quantidade do item 
    		//Se tiver registro atualizar 
    		$consulta = DB::table('posicao_estoque_atual')->where('produto_id',$prods_id[$i])->get();
    		if(count($consulta)>0){
    			DB::table('posicao_estoque_atual')
			    ->updateOrInsert(
			    	['produto_id' => $prods_id[$i]],
       				['quantidade_atual' => $qtdProd[$i]] 
			    );
    		} 
    	}
    	return redirect('/estoque/balanco');
    }

    //Este método trata o estorno de um balanço de acordo ao seu ID
    public function destroyBalanco($id){
    	//.....
    }
}
