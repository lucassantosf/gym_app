<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Plano;
use App\Modalidade;

class RelatorioController extends Controller
{

	public function viewRelatorioClientes(){
		$i = 0;
		$planos = Plano::all();
		$modals = Modalidade::all();
		return view('relatorios.clientes',compact('planos','modals','i'));
	}

	public function searchRelatorioClientes(Request $request){
		$i = 1;
		$raw = ' WHERE ';
		$dateCadStart = $request->input('dateCadStart'); 
		$dateCadEnd = $request->input('dateCadEnd');
		$dateStart = $request->input('dateStart');
		$dateEnd = $request->input('dateEnd');
		$statusAtivoCheck = $request->input('statusAtivoCheck');
		$statusDesCheck = $request->input('statusDesCheck');
		$statusVisCheck = $request->input('statusVisCheck'); 
		$sexoMasc = $request->input('sexoMasc');
		$sexoFem = $request->input('sexoFem');
		//$month1 = $request->input('month1');
		//$month2 = $request->input('month2');
		//$month3 = $request->input('month3');
		//$month4 = $request->input('month4');
		//$month5 = $request->input('month5');
		//$month6 = $request->input('month6');
		//$month7 = $request->input('month7');
		//$month8 = $request->input('month8');
		//$month9 = $request->input('month9');
		//$month10 = $request->input('month10');
		//$month11 = $request->input('month11');
		//$month12 = $request->input('month12'); 
		$plano_id = $request->input('plano_id');  
		 
		$from = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateCadStart'))))));//data negociacao
		
		$to = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateCadEnd'))))));//data negociacao

		$from2 = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateStart'))))));//data negociacao
		
		$to2 = date('Y-m-d',strtotime(date('d-m-Y',strtotime(str_replace('/','-', $request->input('dateEnd'))))));//data negociacao

		if($request->input('dateCadStart') != ''){
			$raw = $raw. " c.created_at >= '".$from."' AND";
		} 
		if($request->input('dateCadEnd') != ''){
			$raw = $raw. " c.created_at <= '".$to."' AND";
		}
		if($request->input('statusAtivoCheck') != ''){
			$raw = $raw. " c.situaçao like '".$statusAtivoCheck."' AND";
		}
		if($request->input('statusDesCheck') != ''){
			$raw = $raw. " c.situaçao like '".$statusDesCheck."' AND";
		}
		if($request->input('statusVisCheck') != ''){
			$raw = $raw. " c.situaçao like '".$statusVisCheck."' AND";
		}
		if($request->input('sexoMasc') != ''){
			$raw = $raw. " c.sexo = ".$sexoMasc." AND";
		}
		if($request->input('sexoFem') != ''){
			$raw = $raw. " c.sexo = ".$sexoFem." AND";
		}
		if($request->input('dateStart') != ''){
			$raw = $raw. " v.dt_inicio between '".$to2."' AND";
		} 
		if($request->input('dateEnd') != ''){
			$raw = $raw. " '".$from2."' ";
		}    
		//atend
		//$raw = $raw . 'SELECT * FROM academia.vendas as v, academia.clientes as c WHERE v.dt_inicio between '2019-05-14' and '2019-05-14' and v.cliente_id = c.id';
		//echo $raw.'<br>';
		//exit();
		$consulta = DB::select(DB::raw("SELECT * FROM academia.vendas as v, academia.clientes as c".$raw));  
		return view('relatorios.clientes',compact('i','consulta'));
	} 
}