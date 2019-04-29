<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public function returnView(){
    	return view('operacao.vendas');
    }

    public function returnViewWithClient($cliente_id,$cliente_name){
    	return view('operacao.vendas',compact('cliente_id','cliente_name'));
    }

    public function getClientsName($name){
        $names = DB::table('clientes')->where('name','LIKE','%'.$name.'%')->orderBy('name')->get();
        return $names;
    }
    
    public function getProdsName($name){
        $names = DB::table('produtos')->where('name','LIKE','%'.$name.'%')->orderBy('name')->get();
        return $names;
    }

}
