<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\VendaAvulsa;
use App\ItemVendaAvulsa;
use App\Parcela;
use App\Cliente;
use App\Produto;
use App\Recibo;

class VendaAvulsaController extends Controller{
    //Este método trata o post da Venda Avulsa
    public function postVendaAvulsa(Request $request){
    	//Salvar a venda avulsa	    
    	$cliente = Cliente::find($request->input("nomesClientes"));
        if(isset($cliente)){
    	$venda_avulsa = new VendaAvulsa();
    	$venda_avulsa->desconto = $request->input("desconto");
    	$venda_avulsa->value = $request->input("vlTotal");
        $dt_neg = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dt_neg'))))));
        $venda_avulsa->dt_neg = $dt_neg;
    	$venda_avulsa->cliente_id = $cliente->id;
    	$venda_avulsa->save();
    	//Dentro da venda avulsa salvar cada item da compra
    	$prods = $request->input("prods");
        foreach($prods as $p){
        	$produto = Produto::find($p);
        	$item_venda_avulsa = new ItemVendaAvulsa();
        	$item_venda_avulsa->produto_id = $p;
        	$item_venda_avulsa->descricao_produto = $produto->name;
        	$item_venda_avulsa->venda_avulsa_id = $venda_avulsa->id;
        	$item_venda_avulsa->save(); 
            //Diminuir Posição_estoque do prod_id
            if($produto->controlEstoque == 1){
                $consulta = DB::table('posicao_estoque_atual')->where('produto_id',$produto->id)->get();
                if(count($consulta) > 0){
                    //Inserir informação na cardex
                    DB::table('cardex')->insert([
                        'produto_id'=>$produto->id,
                        'venda_avulsa_id'=>$venda_avulsa->id,
                        'saida'=>1,
                        'saldo_anterior'=>$consulta[0]->quantidade_atual,
                        'saldo_atual'=>($consulta[0]->quantidade_atual - 1),
                        'created_at'=>date('Y-m-d H:i:s')
                    ]); 
                    //Atualizar posição do estoque 
                    DB::table('posicao_estoque_atual')
                    ->updateOrInsert(
                        ['produto_id' => $consulta[0]->produto_id ],
                        ['quantidade_atual' => $consulta[0]->quantidade_atual - 1] 
                    ); 
                }else{ 
                    //Inserir informação na cardex
                    DB::table('cardex')->insert([
                        'produto_id'=>$produto->id,
                        'venda_avulsa_id'=>$venda_avulsa->id,
                        'saida'=>1,
                        'saldo_anterior'=>0,
                        'saldo_atual'=>(-1),
                        'created_at'=>date('Y-m-d H:i:s')
                    ]); 
                    //Atualizar posição do estoque
                    DB::table('posicao_estoque_atual')->insert([
                        'produto_id'=>$produto->id,
                        'quantidade_atual'=>(-1)
                    ]); 
                }  
            } 
        }        
        //Gerar a parcela única da venda avulsa
    	$parcelaVendaAvulsa = new Parcela();
        $parcelaVendaAvulsa->venda_avulsa_id = $venda_avulsa->id;
        $parcelaVendaAvulsa->dt_vencimento = $dt_neg;
    	$parcelaVendaAvulsa->dt_fat = $dt_neg;
    	$parcelaVendaAvulsa->value = $venda_avulsa->value;
    	$parcelaVendaAvulsa->cliente_id = $cliente->id;
    	$parcelaVendaAvulsa->nome_cliente = $cliente->name;
    	$parcelaVendaAvulsa->save(); 
        }
    	return redirect('/clients/'.$cliente->id.'/show');
    }

    //Este método trata o estorno de um item da venda avulsa - com isso toda os outros itens da mesma venda são estornados e a venda_avulsa também, retorna um array com o cod recibo, e parcelas com vinculos à venda para tratar no front sem ter que atualizar a tela
    public function estornarVendaAvulsa($id_venda_avulsa){
        $data = [];
        $venda_avulsa = VendaAvulsa::find($id_venda_avulsa);
        if (isset($venda_avulsa)) {
            //deletar a parcela vinculada à venda_avulsa - é unica 
            $parcela = DB::table('parcelas')->where([
                ['venda_avulsa_id',$venda_avulsa->id],
                ['deleted_at',NULL],
            ])->get();
             
            if (count($parcela)>0) {
                foreach ($parcela as $p) {
                    $parcela = Parcela::find($p->id);
                    $parcela->delete();                
                    array_push($data,$p->id); 
                }  
            }
            //deletar o recibo vinculado à venda_avulsa
            $recibo = DB::table('recibos')->where([
                ['venda_avulsa_id',$venda_avulsa->id],
                ['deleted_at',NULL],
            ])->get();
             
            if (count($recibo)>0) {
                foreach ($recibo as $r) {
                    $re = Recibo::find($r->id);
                    array_push($data,$r->id);     

                    //Verificar se o recibo estornado na venda possui mais itens, e se possuir tornar as parcelas do recibo em aberto novamente
                    $itens = DB::table('item_recibos')->where([
                        ['recibo_id',$re->id],
                        ['deleted_at',NULL],
                    ])->get();
                     
                    if (count($itens)>0) {
                        $parcelas = [];
                        foreach ($itens as $i) { 
                            DB::table('parcelas')
                            ->where('id', $i->parcela_id)
                            ->update(['status' => 'Em aberto']);
                            $parc = Parcela::find($i->parcela_id);
                            array_push($data,$parc);     
                        }   
                    } 
                    array_push($data,$parcelas); 
                    $re->delete();
                }
            }
            $venda_avulsa->delete();
            return $data;
        }     
    }
}