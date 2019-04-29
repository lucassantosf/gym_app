<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Parcela;
use App\Cliente;
use App\Recibo;
use App\ItemRecibo;

class ParcelaController extends Controller
{
    public function showParcelasVenda($id){
        $parcelas = DB::table('parcelas')->where('venda_id',$id)->get();
        return json_encode($parcelas);
    }

    //Este método retorna apenas a view do Caixa em aberto
    public function mostrarParcelas(){         
    	return view('operacao.emAbertoPrincipal');
    }

    //Esta função é utilizada na tela Caixa em Aberto quando tem o cliente individual, mostra todas parcelas em aberto de um aluno
    public function parcelasEmAberto($id){
    	$cliente = Cliente::find($id);
    	if (isset($cliente)) {
    		$parcelas = DB::table('parcelas')->where([
    			['status','Em aberto'],
                ['cliente_id',$id],
                ['deleted_at',NULL],
    		])->get(); 

    	}
    	return view('operacao.emAberto',compact('cliente','parcelas'));
    }

    //Este método retorna um json com os dados de um recibo apartir da parcela_id
    public function getRecibo($parcela_id){
        $parcela = DB::table('item_recibos')->where([
            ['parcela_id',$parcela_id],
        ])->get();
        foreach ($parcela as $p) {
            $recibo = Recibo::find($p->recibo_id);
        }
        return json_encode($recibo);
    }

    //Este recibo deleta um recibo aparte do recibo_id, e deleta os itens, e parcela do item torna em aberto para pagar novamente
    public function estornarRecibo($recibo_id){
        $recibo = Recibo::find($recibo_id);
        $parcelas = [];
        if(isset($recibo)){
            $ir = DB::table('item_recibos')->where([
            ['recibo_id',$recibo->id],
            ['deleted_at',NULL],
            ])->get();        
            foreach ($ir as $i) {
                //Buscar a parcela e tornar Em aberto
                DB::table('parcelas')
                    ->where('id', $i->parcela_id)
                    ->update(['status' => 'Em aberto']);
                //Deletar o item
                $item = ItemRecibo::find($i->id);
                if (isset($item)) {
                    $item->delete();
                }   
                $p = Parcela::find($i->parcela_id);
                array_push($parcelas, $p);            
            }
            //Deletar o recibo
            $recibo->delete();
        }else{
            return redirect('/clients');
        }
        return json_encode($parcelas);
    } 

    //Esta função paga uma parcela individualmente e gera um recibo em dinheiro
    public function payParcela($id,$venda_id,$isVA=false){
    	$parcela = Parcela::find($id);
    	if (isset($parcela)) {
    		$parcela->status = 'Pago';
    		$parcela->save();            
    	}
        //Gerar o recibo - obs:venda_id->table recibo é null
        $recibo = new Recibo();
        $recibo->cliente_id = $parcela->cliente_id;
        $recibo->formaPagamento = 'dinheiro';
        $recibo->valorRecibo = $parcela->value; 
        //Aqui diferencia se a parcela paga é VA ou plano       
        if(!$isVA) {
            $recibo->venda_id = $venda_id;
            $recibo->venda_avulsa_id = NULL;
        }else{
            $recibo->venda_id = NULL;
            $recibo->venda_avulsa_id = $venda_id;
        }
        $recibo->save();
        //Gerar o item do recibo
        $itemRecibo = new ItemRecibo();
        $itemRecibo->recibo_id = $recibo->id;
        $itemRecibo->parcela_id = $parcela->id;
        $itemRecibo->value = $parcela->value;
        $itemRecibo->save();
    } 

    //Este método paga também uma parcela mas manda as informações para o método payParcela processar
    public function payParcelaVA($id,$venda_avulsa_id){ 
        $this->payParcela($id,$venda_avulsa_id,true);
    }
    
    //Este método serve de intermediário apenas para receber os dados vindos do post do caixa em aberto e escolher a forma de pagamento
    public function pagarParcelas(Request $request){
    	$cliente_id = $request->input("cliente_id");        
        $parcelas =	$request->input("parcela");
        $valorTotal = $request->input("valorTotal");        
    	return view('operacao.formaPagamentoCaixaAberto',compact('cliente_id','parcelas','valorTotal'));
    }

    //Esta função trata o post do caixa em aberto, salva o recibo e altera status da parcela
    public function postCaixaAberto(Request $request){
        //Trabalha o post do caixa em aberto apos selecionar a forma de pagamento
        //gera primeiro o recibo e salva 
        $recibo = new Recibo();
        $recibo->cliente_id = $request->input("cliente_id");
        $recibo->formaPagamento = $request->input("formaPagamento");
        $recibo->valorRecibo = $request->input("valorTotal");
        
        //com o recibo salvo trabalhar em cada parcela para gerar os itens do recibo
        $parcelas = $request->input("parcela");  
        foreach($parcelas as $p){
            DB::table('parcelas')
                ->where('id', $p)
                ->update(['status' => 'Pago']);
            $parcela = Parcela::find($p);
            $recibo->venda_id = $parcela->venda_id;
            $recibo->venda_avulsa_id = $parcela->venda_avulsa_id;
        }
        $recibo->save();        
        //Gerar os itens do recibo
        foreach($parcelas as $p){
            $itemRecibo = new ItemRecibo();  
            $itemRecibo->recibo_id = $recibo->id;
            $itemRecibo->parcela_id = $p;
            $itemRecibo->value = $parcela->value;
            $itemRecibo->save();
        }
        return redirect('/clients/'.$recibo->cliente_id.'/show');
    }

    //Buscar parcelas em aberto pelo nome, utilizado na tela Caixa em Aberto
    public function buscarParcelasAberto($nome){
        $parcelas = [];
        $consulta1 = DB::table('parcelas')->where([
            ['nome_cliente','like','%'.$nome.'%'],
            ['status','Em aberto'],
            ['deleted_at',NULL],
            ])->get(); 
        array_push($parcelas, $consulta1);       
        return json_encode($parcelas);
    }

}
