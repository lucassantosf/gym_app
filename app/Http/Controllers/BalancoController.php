<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Balanco;
use App\ItemBalanco;

class BalancoController extends Controller
{
    //Exibir o histórico de balanços
    public function indexBalancos($i = 0){
    	$balancos = Balanco::all();
        $prods_consulta = [];
    	$posicao_atual = [];

    	$produtos = DB::table('produtos')->where([ 
            ['controlEstoque',1],
            ['status',1],
            ['deleted_at',NULL]
        ])->get();  
    	$consulta = DB::table('posicao_estoque_atual')->where([
        	['deleted_at',NULL],
        ])->get(); 
       	foreach ($consulta as $c) {
       		array_push($prods_consulta, $c->produto_id);
       		array_push($posicao_atual, ['produto_id'=>$c->produto_id,'quantidade_atual'=>$c->quantidade_atual]);
       	} 
       	foreach ($produtos as $p) {
       		if (!in_array($p->id, $prods_consulta)) {  
       			array_push($posicao_atual, ['produto_id'=>$p->id,'quantidade_atual'=>0]); 
			}
       	}
    	return view('estoque.balanco',compact('i','balancos','produtos','posicao_atual'));
    }

    //Exibir o form para lançar balanço
    public function formBalanco(){

        return $this->indexBalancos(1);
    }

    //Este método trata o post do formulário da Balanco
    public function postFormBalanco(Request $request){
    	$balanco = new Balanco(); 
    	$prods_id = $request->input('prods_id'); 
    	$prods_name = $request->input('prods_name'); 
    	$qtdProd = $request->input('qtdProd');
    	$lastSaldo = $request->input('lastSaldo');
    	$diffence = $request->input('diffence');  
    	$balanco->dt_balanco = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-',$request->input('dt_emissao'))))));
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
    		//Processos cardex
            $consulta = DB::table('posicao_estoque_atual')->where('produto_id',$prods_id[$i])->get();
            if(count($consulta)>0){
                //Se tiver posição
                DB::table('cardex')->insert([
                    'produto_id'=>$prods_id[$i],
                    'balanco_id'=>$balanco->id,
                    'entrada'=>$qtdProd[$i],
                    'saldo_anterior'=>$consulta[0]->quantidade_atual,
                    'saldo_atual'=>$qtdProd[$i],
                    'created_at'=>date('Y-m-d H:i:s')
                ]);  
            }else{
                //Senão tiver posição
                DB::table('cardex')->insert([
                    'produto_id'=>$prods_id[$i],
                    'balanco_id'=>$balanco->id,
                    'entrada'=>$qtdProd[$i],
                    'saldo_anterior'=>0,
                    'saldo_atual'=>$qtdProd[$i],
                    'created_at'=>date('Y-m-d H:i:s')
                ]); 
            } 
            //Atualizar na posição de estoque a quantidade do item 
    		//Se tiver registro atualizar senão inserir um novo
            DB::table('posicao_estoque_atual')
			    ->updateOrInsert(
			    	['produto_id' => $prods_id[$i]],
       				['quantidade_atual' => $qtdProd[$i]] 
			); 
    	}
    	return redirect('/estoque/balanco');
    }

    //Este método trata o estorno de um balanço de acordo ao seu ID
    public function destroyBalanco($id){
    	//.....
    }
}
