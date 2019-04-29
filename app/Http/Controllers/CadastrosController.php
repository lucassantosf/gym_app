<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class CadastrosController extends Controller
{
    public function indexUser(){
        $users = User::all();
    	return view('cadastros.user',compact('users'));
    }

    public function formUser(){
        return view('cadastros.formUser');
    }
    
    public function postFormUser(Request $request){
        //validacao de campos com 'msgs' personalizadas
        $regras = [
            'name'=>'required|min:5',
            'email'=>'required|email',
            'password'=>'required',
        ];
        $mensagens = [
            'required'=>'O campo :attribute não pode ser vazio',            
            'name.min'=>'É necessário no minimo 5 caracteres no campo nome',
            'email.email'=>'Formato do email não é válido'
        ];
        
        $request->validate($regras,$mensagens);
        
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        try {
            $user->save();
        } catch (Exception $e) {
            
        }

        return redirect('/cadastros/users');
    }

    public function formUserEdit($id){
        $user = User::find($id);
        if(isset($user)){
            return view('cadastros.formUser',compact('user'));        
        }else{
            return redirect('/cadastros/users');
        }
    }

    public function postFormUserEdit(Request $request, $id){
        
        $user = User::find($id);
        
        if(isset($user)){
            //validacao de campos com 'msgs' personalizadas
            $regras = [
                'name'=>'required|min:5',
                'email'=>'required|email',
                'password_new'=>'required',
            ];
            $mensagens = [
                'required'=>'O campo :attribute não pode ser vazio',            
                'name.min'=>'É necessário no minimo 5 caracteres no campo nome',
                'email.email'=>'Formato do email não é válido'
            ];            

            $request->validate($regras,$mensagens); 

            if($request->input('password_new') == 'e99a18c428cb38d5f260853678922e03'){
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->save();
            }else{
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password_new'));
                $user->save();
            }                   
        }            
        
        return redirect('/cadastros/users');
    }

    public function destroyUser($id){
        $user = User::find($id);
        if(isset($user)){
            $user->delete();
        }
        return redirect('/cadastros/users');
    }

}
