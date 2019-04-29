<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modalidade;

class ModalidadeController extends Controller
{
    public function indexModals(){
        $i = 0;        
        $modals = Modalidade::all();
    	return view('cadastros.formModal',compact('i','modals'));
    }

    public function formModal(){
        $i = 1;          
        return view('cadastros.formModal',compact('i'));
    }

    public function postFormModal(Request $request){
        $modal = new Modalidade();
        $modal->name = $request->input('name');
        $modal->value = $request->input('value');
        $modal->freq = $request->input('freq');
        $modal->status = $request->input('status') == 'A' ? true : false;
        $modal->controlTurma = $request->input('turma') == 'T' ? true : false;
        $modal->save(); 
        return redirect('/cadastros/modals');
    }   

    public function formModalEdit($id){
        $modal = Modalidade::find($id);
        if(isset($modal)){
            $i = 1;
            return view('cadastros.formModal',compact('modal','i'));        
        }else{
            return redirect('/cadastros/modals');
        }
    }
    
    public function postformModalEdit(Request $request, $id){ 
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

    public function destroyModal($id){
        $modal = Modalidade::find($id);
        if(isset($modal)){
            $modal->delete();
        }
        return redirect('/cadastros/modals');
    }
}
