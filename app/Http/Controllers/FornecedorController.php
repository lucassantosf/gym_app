<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{	
	//Este método exibe view da listagem de todos os fornecedores
    public function indexFornecedores(){
    	$i=0;
    	$forns = DB::table('fornecedores')->where('deleted_at',NULL)->get();
    	return view('cadastros.formFornecedor',compact('i','forns'));
    }

    //Este método exibe view do formulário de cadastro para um fornecedor
    public function formFornecedor(){
    	$i=1;
    	return view('cadastros.formFornecedor',compact('i'));
    }

    //Este método trata o post do form de cadastro de um fornecedor
    public function postFormFornecedor(Request $request){
    	DB::table('fornecedores')->insert([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'status'=>$request->input('status') == 'A' ? true : false,
        ]);    
    	return redirect('/cadastros/fornecedores');
    }

    //Este método exibe a view do formulário de edição com os dados de um fornecedor de acordo à seu ID
    public function formFornecedorEdit($id){
    	$i=2;
    	$fornecedor = DB::table('fornecedores')->where([
    		['id',$id],
    		['deleted_at',NULL],
    	])->get(); 
    	return view('cadastros.formFornecedor',compact('i','fornecedor'));
    }

    //Este método trata o post do form de edição de um fornecedor 
    public function postFormFornecedorEdit(Request $request, $id){
    	DB::table('fornecedores')
            ->where('id', $id)
            ->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'status'=>$request->input('status') == 'A' ? true : false,
        ]);
    	return redirect('/cadastros/fornecedores');
    }

    //Este método preenche a coluna deleted_at de um fornecedor de acordo à seu ID
    public function destroyFornecedor($id){
    	DB::table('fornecedores')
            ->where('id', $id)
            ->update([
            'deleted_at'=>date('Y-m-d H:i:s'), 
        ]);
    	return redirect('/cadastros/fornecedores');
    }
}