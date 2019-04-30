<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Compra;
use App\ItemCompra;

class CompraController extends Controller
{	
	//Exibir o histórico de compras lançadas
    public function indexCompras(){
    	$i = 0;
    	$compras = Compra::all();
    	$itens = ItemCompra::all();
    	return view('estoque.compras',compact('i','compras','itens'));
    }

    //Exibir o form para lançar compra
    public function formCompra(){
    	$i = 1;
    	$fornecedores = DB::table('fornecedores')->where([ 
            ['status',1],
            ['deleted_at',NULL]
        ])->get();
        $produtos = DB::table('produtos')->where([ 
            ['controlEstoque',1],
            ['status',1],
            ['deleted_at',NULL]
        ])->get();
    	return view('estoque.compras',compact('i','fornecedores','produtos'));
    }

    //Este método trata o post do formulário da Compra
    public function postFormCompra(Request $request){
    	$compra = new Compra();
    	$compra->fornecedor_id = $request->input('fornecedorSelect');
    	$compra->nota_fiscal = $request->input('numNF');
    	$compra->dt_emissao = $request->input('dt_emissao');
    	$compra->dt_compra = $request->input('dt_compra');
    	$compra->save();  
    	$itens = $request->input('produtos');
    	$qtdProd = $request->input('qtdProd');
    	$vlUniProd = $request->input('vlUniProd');
    	$descontoProd = $request->input('descontoProd');
    	//Para cada item da compra salvar um item
    	for ($i=0; $i < count($itens); $i++) { 
    		$item = new ItemCompra();
    		$item->compra_id = $compra->id; 
    		$item->produto_id = $itens[$i]; 
    		$item->quantidade = $qtdProd[$i]; 
    		$item->valor_unitario = $vlUniProd[$i]; 
    		$item->desconto_total = $descontoProd[$i]; 
    		$item->save(); 
    		//Adicionar a quantidade do item na table posição_estoque
    		//Verificar se na table posição_estoque tem registro do item, 
    		$consulta = DB::table('posicao_estoque_atual')->where('produto_id',$itens[$i])->get();
    		if(count($consulta)>0){
    			//Se tiver atualizar somando a quantidade
    			foreach ($consulta as $c) {
    				DB::table('posicao_estoque_atual')
		            ->where('produto_id', $itens[$i])
		            ->update(['quantidade_atual' => ($c->quantidade_atual + $qtdProd[$i])]); 
    			}
    		}else{
    			//Senão tiver, inserir novo registro com quantidade da compra 
    			DB::table('posicao_estoque_atual')->insert(
				    ['produto_id' => $itens[$i], 'quantidade_atual' => $qtdProd[$i]]
				);
    		} 
    	} 
    	return redirect('/estoque/compras');
    }

    //Este método trata o estorno de uma compra de acordo ao seu ID
    public function destroyCompra($id){
    	$compra = Compra::find($id);
    	if (isset($compra)) {
    		//Consultar os items da compra que esta sendo estornada
    		$consulta = DB::table('item_compras')->where([
    			['compra_id',$compra->id],
    			['deleted_at',NULL],
    		])->get();
    		//Para cada item tratar a remoção da quantidade da table posição_estoque e remover este item
    		foreach ($consulta as $c) {
    			$item = ItemCompra::find($c->id);
    			if (isset($item)) { 
    				//Consultar a posição_estoque do produto e atualizar sua quantidade removendo a quantidade da compra
    				$consulta2 = DB::table('posicao_estoque_atual')->where('produto_id',$item->produto_id)->get();
    				foreach ($consulta2 as $c2) {
    					//Atualizando...
	    				DB::table('posicao_estoque_atual')
			            ->where('produto_id', $item->produto_id)
			            ->update(['quantidade_atual' => ($c2->quantidade_atual - $item->quantidade)]);
    				}
    				//Removendo o item...
    				$item->delete(); 
    			} 
    		}
    		//Removendo a compra...
    		$compra->delete();
    	} 
    }
}