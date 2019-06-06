<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{   
    //Este método exibe listagem de todos produtos cadastrados
    public function indexProds(){
    	$i = 0 ;
    	$prods = Produto::all();
    	return view('cadastros.formProduct',compact('i','prods'));
    }

    //Este método exibe a view do formulário de cadastro para produtos
    public function formProd(){
    	$i = 1 ;
    	return view('cadastros.formProduct',compact('i'));
    }

    //Validar form cadastro e edição de produtos
    public function validateForm(Request $request){
        //validacao de campos com 'msgs' personalizadas
        $regras = [
            'name'=>'required|max:50',
            'value'=>'required', 
        ];
        $mensagens = [
            'required'=>'O campo :attribute não pode ser vazio'
        ]; 
        $request->validate($regras,$mensagens);
    }

    //Este método trabalha o post do formulário de cadastro para produtos
    public function postformProd(Request $request){
        $this->validateForm($request);
    	$prod = new Produto();
    	$prod->name = $request->input('name');
        $prod->value = $request->input('value');
    	$prod->controlEstoque = $request->input('controlEstoque') == '1' ? true : false;
    	$prod->status = $request->input('status') == 'A' ? true : false;
    	$prod->save();
    	return redirect('/cadastros/products');
    }

    //Este método exibe a view do formulário para edição dos produtos
    public function formProdEdit($id){
    	$prod = Produto::find($id);
    	if(isset($prod)){
    		$i = 1 ;
    		return view('cadastros.formProduct',compact('i','prod'));
    	}
    	return redirect('/cadastros/products');
    }

    //Este método trabalha o post do formulário de edição dos produtos
    public function postformProdEdit(Request $request, $id){
    	$this->validateForm($request);
        $prod = Produto::find($id);
    	if(isset($prod)){
    		$prod->name = $request->input('name');
            $prod->value = $request->input('value');
            $prod->controlEstoque = $request->input('controlEstoque') == '1' ? true : false; 
	    	$prod->status = $request->input('status') == 'A' ? true : false;
	    	$prod->save();
    	}
    	return redirect('/cadastros/products'); 
    }

    //Este método excluir um produto de acordo ao seu ID
    public function destroyProd($id){
    	$prod = Produto::find($id);
    	if(isset($prod)){
    		$prod->delete();
    	}
    	return redirect('/cadastros/products');
    } 
}