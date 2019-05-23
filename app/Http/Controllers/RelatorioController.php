<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cliente;
use App\Plano;
use App\Modalidade;

class RelatorioController extends Controller
{
	//Este método exibe apenas a view do relatório de clientes
	public function viewRelatorioClientes(){
		$i = 0;
		$planos = Plano::all();
		$modals = Modalidade::all();
		return view('relatorios.clientes',compact('planos','modals','i'));
	}

	//Este método pesquisa com uma unica string na tabela de clientes e vendas_planos a situação da carteira de clientes -> este relatório pesquisa por dt_cadastro, dt_inicio, situação, sexo, duracao, plano, modalidade
	public function searchRelatorioClientes(Request $request){
		$i = 1;
		$raw = ' WHERE ';
		$raw2 = ' ';
		$raw3 = ' ';
		$raw4 = ' ';
		$raw5 = ' ';
		$dateCadStart = $request->input('dateCadStart'); 
		$dateCadEnd = $request->input('dateCadEnd');
		$dateStart = $request->input('dateStart');
		$dateEnd = $request->input('dateEnd');
		$statusAtivoCheck = $request->input('statusAtivoCheck');
		$statusDesCheck = $request->input('statusDesCheck');
		$statusVisCheck = $request->input('statusVisCheck'); 
		$sexoMasc = $request->input('sexoMasc');
		$sexoFem = $request->input('sexoFem');
		$month1 = $request->input('month1');
		$month2 = $request->input('month2');
		$month3 = $request->input('month3');
		$month4 = $request->input('month4');
		$month5 = $request->input('month5');
		$month6 = $request->input('month6');
		$month7 = $request->input('month7');
		$month8 = $request->input('month8');
		$month9 = $request->input('month9');
		$month10 = $request->input('month10');
		$month11 = $request->input('month11');
		$month12 = $request->input('month12'); 
		$plano_id = $request->input('plano_id');
		$modals = $request->input('modal');  
		$from = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateCadStart'))))));//data negociacao
		
		$to = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateCadEnd'))))));//data negociacao

		$to2 = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateStart'))))));//data negociacao
		
		$from2 = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateEnd'))))));//data negociacao
		//Campos Data Cadastro		
		if($request->input('dateCadStart') != '' && $request->input('dateCadEnd') != ''){
			$raw = $raw. " c.created_at between '".$from." 00:00:00' AND '".$to." 23:59:59' AND";
		}else if($request->input('dateCadStart') != ''){
			$raw = $raw. " c.created_at >= '".$from." 00:00:00' AND";
		}else if($request->input('dateCadEnd') != ''){
			$raw = $raw. " c.created_at <= '".$to." 23:59:59' AND";
		}
		//Campos Data Inicio plano
		if($request->input('dateStart') != '' && $request->input('dateEnd') != ''){
			$raw = $raw. " v.dt_inicio between '".$to2." 00:00:00' AND '".$from2." 23:59:59' AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}else if($request->input('dateStart') != ''){
			$raw = $raw. " v.dt_inicio >= '".$from2." 00:00:00' AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';

		}else if($request->input('dateEnd') != ''){
			$raw = $raw. " v.dt_inicio <= '".$to2." 23:59:59' AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, '; 
		} 
		//Situações
		if($request->input('statusAtivoCheck') != ''){
			$raw = $raw. " c.situaçao like '".$statusAtivoCheck."'  AND";
		}
		if($request->input('statusDesCheck') != ''){
			$raw = $raw. " c.situaçao like '".$statusDesCheck."'  AND";
		}
		if($request->input('statusVisCheck') != ''){
			$raw = $raw. " c.situaçao like '".$statusVisCheck."'  AND";
		}
		//Sexo
		if($request->input('sexoMasc') != '' && $request->input('sexoFem') != ''){
			$raw = $raw. " c.sexo = ".$sexoMasc."  OR c.sexo =".$sexoFem."  AND"; 
		}else if($request->input('sexoMasc') != ''){
			$raw = $raw. " c.sexo = ".$sexoMasc."  AND";
		}else if($request->input('sexoFem') != ''){
			$raw = $raw. " c.sexo = ".$sexoFem." AND";
		} 
		//Plano
		if($plano_id){
			$raw = $raw. " v.plano_id = ".$plano_id." AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, '; 
		}
		//Duraçoes
		if($month1){
			$raw = $raw.' v.duracao = '.$month1."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month2){
			$raw = $raw.' v.duracao = '.$month2."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month3){
			$raw = $raw.' v.duracao = '.$month3."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month4){
			$raw = $raw.' v.duracao = '.$month4."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month5){
			$raw = $raw.' v.duracao = '.$month5."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month6){
			$raw = $raw.' v.duracao = '.$month6."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month7){
			$raw = $raw.' v.duracao = '.$month7."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month8){
			$raw = $raw.' v.duracao = '.$month8."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month9){
			$raw = $raw.' v.duracao = '.$month9."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month10){
			$raw = $raw.' v.duracao = '.$month10."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}
		if($month11){
			$raw = $raw.' v.duracao = '.$month11."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		}if($month12){
			$raw = $raw.' v.duracao = '.$month12."  AND";
			$raw2 = ' AND c.id = v.cliente_id';
			$raw3 = ' academia.vendas as v, ';
		} 
		if($modals){
			$raw4 = ' AND c.id = i.cliente_id';
			$raw5 = ' academia.modalidades_negociadas_planos as i, ';
			foreach ($modals as $m) { 
				$raw = $raw.' i.modal_id = '.$m."  AND"; 
			}
		} 
		//ao final
		$raw = $raw . ' c.id > 0';   
		$consulta = DB::select(DB::raw("SELECT * FROM ".$raw3.$raw5." academia.clientes as c".$raw.$raw2.$raw4));  
		//echo "SELECT * FROM ".$raw3.$raw5." academia.clientes as c".$raw.$raw2.$raw4.'<br>';
		//exit();
		return view('relatorios.clientes',compact('i','consulta'));
	}

	//Este método exibe apenas a view do relatório de faturamento
	public function viewRelatorioFaturamento(){
		$i = 0; 
		return view('relatorios.faturamento',compact('i'));
	} 

	//Este método consulta por um período quanto foi vendido de vendas_planos e vendas_avulas
	public function searchRelatorioFaturamento(Request $request){ 
		$i = 1;
		$data = []; 
		$dateStart = $request->input('dateStart');
		$dateEnd = $request->input('dateEnd');
		//Validar se datas estão vazias
		if(!$dateStart && !$dateEnd){ 
			$msg = 'Informar pelo menos uma data para consulta!';
			return view('relatorios.faturamento',compact('i','msg'));
		}
		$checkPlan = $request->input('checkPlan');
		$checkVenda = $request->input('checkVenda');
		//Converter as datas para consultas
		$from = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateStart'))))));
		$to = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateEnd')))))); 
		if(($checkPlan && $checkVenda) || (!$checkPlan && !$checkVenda)) {  
			if($dateStart && $dateEnd){  
				array_push($data , $this->consultar_vendas_planos($from,$to)); 
				array_push($data , $this->consultar_vendas_avulsas($from,$to)); 
			}else if($dateStart){
				array_push($data , $this->consultar_vendas_planos($from,NULL));  
				array_push($data , $this->consultar_vendas_avulsas($from,NULL));  
			}else if($dateEnd){
				array_push($data , $this->consultar_vendas_planos(NULL,$to));  
				array_push($data , $this->consultar_vendas_avulsas(NULL,$to));  
			} 
		}else if($checkPlan){ 
			if($dateStart && $dateEnd){  
				array_push($data , $this->consultar_vendas_planos($from,$to)); 
			}else if($dateStart){
				array_push($data , $this->consultar_vendas_planos($from,NULL));   
			}else if($dateEnd){
				array_push($data , $this->consultar_vendas_planos(NULL,$to));   
			}  
		}else if($checkVenda){  
			array_push($data, NULL);
			if($dateStart && $dateEnd){   
				array_push($data , $this->consultar_vendas_avulsas($from,$to)); 
			}else if($dateStart){   
				array_push($data , $this->consultar_vendas_avulsas($from,NULL));  
			}else if($dateEnd){  
				array_push($data , $this->consultar_vendas_avulsas(NULL,$to));  
			} 
		} 
		$clientes = Cliente::all();
		//Se tiver indice 1 em $data pesquisar os itens de vendas_avulsas e adicionar neste array
		if(isset($data[1])){
			foreach ($data[1] as $obj) {
				$query = DB::table('item_venda_avulsas')->where([ 
		            ['venda_avulsa_id',$obj->id],
		            ['deleted_at',NULL],
		        ])->get();
		        if (isset($query)) {
		            foreach ($query as $q) {
						array_push($data , $q); 
			        }
		    	}
			}
		}
		return view('relatorios.faturamento',compact('i','data','clientes'));
	}

	//Este método apenas consulta por um perido as vendas_planos - auxilia o método searchRelatorioFaturamento
	private function consultar_vendas_planos($from = NULL,$to = NULL){  
		$consulta = DB::select(DB::raw("SELECT * FROM academia.vendas WHERE ".$this->getRaw($from,$to)));
		return $consulta;
	}

	//Este método apenas consulta por um perido as vendas_avulsas - auxilia o método searchRelatorioFaturamento
	private function consultar_vendas_avulsas($from = NULL,$to = NULL){  
		$consulta = DB::select(DB::raw("SELECT * FROM academia.venda_avulsas WHERE ".$this->getRaw($from,$to))); 
		return $consulta;
	}

	//Este método auxilia criar string da query para os métodos consultar_vendas_avulsas e consultar_vendas_planos, searchRelatorioReceita, 
	private function getRaw($from = NULL,$to = NULL){
		$raw = ' ';
		if($from!=NULL && $to!=NULL){  
			$raw = $raw . " dt_neg between '".$from." 00:00:00' AND '".$to." 23:59:59' ";
		}else if($from!=NULL){ 
			$raw = $raw . " dt_neg >= '".$from." 00:00:00'";
		}else if($to!=NULL){ 
			$raw = $raw . " dt_neg <= '".$to." 23:59:59'"; 
		}
		return $raw;
	}

	//Este método exibe apenas a view do relatório de receita
	public function viewRelatorioReceita(){
		$i = 0; 
		return view('relatorios.receita',compact('i'));
	} 

	//Este método faz o tratamento do request do form Receita
	public function searchRelatorioReceita(Request $request){ 
		$i = 1;
		$raw = [];
		$data = [];
		$dateStart = $request->input('dateStart');
		$dateEnd = $request->input('dateEnd');
		$checkDin = $request->input('checkDin');
		$checkCC = $request->input('checkCC');
		$checkCD = $request->input('checkCD');
		$checkCh = $request->input('checkCh');
		$checkT = $request->input('checkT');
		//Validar se datas estão vazias
		if(!$dateStart && !$dateEnd){ 
			$msg = 'Informar pelo menos uma data para consulta!';
			return view('relatorios.receita',compact('i','msg'));
		}
		$from = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateStart'))))));
		$to = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateEnd'))))));  
		//Validar forma de pagamento selecionada e adicionar string em array para enviar ao método
		if($checkDin){ 
			array_push($raw, " formaPagamento like 'dinheiro' "); 
		}
		if($checkCC){ 
			array_push($raw, " formaPagamento like 'cartaoc' ");  
		}
		if($checkCD){
			array_push($raw, " formaPagamento like 'cartaod' ");  
		}
		if($checkCh){
			array_push($raw, " formaPagamento like 'cheque' ");  
		}
		if($checkT){
			array_push($raw, " formaPagamento like 'transferencia' "); 
		}
		//De acordo à data da consulta, informar ao método que faz a consulta
		if($dateStart && $dateEnd){  
			array_push($data , $this->consultar_recibos($from,$to,$raw));  
		}else if($dateStart){
			array_push($data , $this->consultar_recibos($from,NULL,$raw));   
		}else if($dateEnd){
			array_push($data , $this->consultar_recibos(NULL,$to,$raw));    
		} 
		$clientes = Cliente::all();
		return view('relatorios.receita',compact('i','data','clientes'));
	}

	//Este método auxilia a criação da query para consultar recibos, e faz a consulta retornando os dados
	private function consultar_recibos($from = NULL,$to = NULL,$raw){
		$query = '';
		if(count($raw) != 0){
			$query = ' AND ';
		}
		for($x=0; $x<count($raw); $x++) {
			$query = $query . $raw[$x];
			if($x != (count($raw) - 1) ){  
				$query = $query . ' OR ';
			}
		}
		$consulta = DB::select(DB::raw("SELECT * FROM academia.recibos WHERE ".$this->getRaw($from,$to).$query)); 
		return $consulta;
	}

	//Este método exibe apenas a view do relatório de parcelas
	public function viewRelatorioParcelas(){
		$i = 0; 
		$planos = Plano::all();
		return view('relatorios.parcelas',compact('i','planos'));
	} 

	//Este método
	public function searchRelatorioParcelas(Request $request){ 
		$i = 1;
		$rawD = [];
		$rawP = [];
		//Inicializar elementos
		$dateStart = $request->input('dateStart');
		$dateEnd = $request->input('dateEnd');
		$filterDate = $request->input('filterDate');
		$filterSit = $request->input('filterSit');
		//$filterPlan = $request->input('filterPlan');
		$from = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateStart'))))));
		$to = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateEnd'))))));  
		
		//Se validou existencia de datas ....
		if($filterDate == 1) { array_push($rawD, 'dt_vencimento');}
		else if($filterDate == 2) { array_push($rawD, 'dt_pagamento');}
		else if($filterDate == 3) { array_push($rawD, 'dt_fat');}
		if($filterSit == 1) { array_push($rawP, " status like 'Pago' ");}
		else if($filterSit == 2) { array_push($rawP, " status like 'Em aberto' ");}
 		
 		//Validar se datas estão vazias
		if(!$dateStart && !$dateEnd){ 
			$msg = 'Informar pelo menos uma data para consulta!';
			return view('relatorios.parcelas',compact('i','msg'));
		}
		if($dateStart && $dateEnd){
			$data = $this->consultar_parcelas($from,$to,$rawD,$rawP);
		}else if($dateStart){
			$data = $this->consultar_parcelas($from,NULL,$rawD,$rawP); 
		}else{ 
			$data = $this->consultar_parcelas(NULL,$to,$rawD,$rawP); 
		} 
	}

	//Este método auxilia a criação da query para consultar parcelas, e faz a consulta retornando os dados
	private function consultar_parcelas($from = NULL,$to = NULL,$rawD,$rawP){
		$query = '';
		if(count($rawP) != 0){
			$query = ' AND ';
		}
		for($x=0; $x<count($rawP); $x++) {
			$query = $query . $rawP[$x];
			if($x != (count($rawP) - 1) ){  
				$query = $query . ' OR ';
			}
		}
		echo "SELECT * FROM academia.parcelas WHERE ".$this->getRawParcela($from,$to,$rawD).$query;
		exit();
		//$consulta = DB::select(DB::raw("SELECT * FROM academia.parcelas WHERE ".$this->getRaw($from,$to,$rawD).$query));
		return $consulta;
	}

	private function getRawParcela($from = NULL,$to = NULL,$rawD){
		$raw = $rawD[0];
		if($from!=NULL && $to!=NULL){  
			$raw = $raw . " between '".$from." 00:00:00' AND '".$to." 23:59:59' ";
		}else if($from!=NULL){ 
			$raw = $raw . "  >= '".$from." 00:00:00'";
		}else if($to!=NULL){ 
			$raw = $raw . "  <= '".$to." 23:59:59'"; 
		}
		return $raw;
	}
}