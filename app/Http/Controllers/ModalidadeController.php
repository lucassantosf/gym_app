<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modalidade;

class ModalidadeController extends Controller{
    //Exibir listagem das modalidades cadastradas
    public function indexModals(){
        $i = 0;        
        $modals = Modalidade::all();
    	return view('cadastros.formModal',compact('i','modals'));
    }

    //Exibir formulário de cadastro para modalidades
    public function formModal(){
        $i = 1;          
        return view('cadastros.formModal',compact('i'));
    }

    //Validar form cadastro e edição de produtos
    public function validateForm(Request $request){
        //validacao de campos com 'msgs' personalizadas
        $regras = [
            'name'=>'required|max:50',
            'value'=>'required', 
            'freq'=>'required', 
        ];
        $mensagens = [
            'required'=>'O campo :attribute não pode ser vazio'
        ]; 
        $request->validate($regras,$mensagens);
    }

    //Método para tratar dados do post do formModal
    public function postFormModal(Request $request){
        $this->validateForm($request);
        $modal = new Modalidade();
        $modal->name = $request->input('name');
        $modal->value = $request->input('value');
        $modal->freq = $request->input('freq');
        $modal->status = $request->input('status') == 'A' ? true : false;
        $modal->controlTurma = $request->input('turma') == 'T' ? true : false;
        $modal->save(); 
        return redirect('/cadastros/modals');
    }   

    //Método para exibir formulário com dados para edição
    public function formModalEdit($id){
        $modal = Modalidade::find($id);
        if(isset($modal)){
            $i = 1;
            return view('cadastros.formModal',compact('modal','i'));        
        }else{
            return redirect('/cadastros/modals');
        }
    }
    
    //Este método trata o post do formModal em edição
    public function postformModalEdit(Request $request, $id){
        $this->validateForm($request);
        $modal = Modalidade::find($id);
        if(isset($modal)){
            $modal->name = $request->input('name');
            $modal->value = $request->input('value');
            $modal->freq = $request->input('freq');
            $modal->status = $request->input('status') == 'A' ? true : false;
            $modal->controlTurma = $request->input('turma') == 'T' ? true : false;
            $modal->save();
        }
        return redirect('/cadastros/modals');
    }

    //Este método irá deletar a modalidade - com uso do softdeletes
    public function destroyModal($id){
        $modal = Modalidade::find($id);
        if(isset($modal)){
            $modal->delete();
        }
        return redirect('/cadastros/modals');
    }
}