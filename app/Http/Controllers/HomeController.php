<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // 
    public function __construct()
    {
        $this->middleware('auth');
        //Robo deve ser executado uma vez ao dia
        $robo = DB::table('automations')->where([ 
            ['created_at',date('Y-m-d')],
        ])->get();  
        if(count($robo) == 0){            
            //Rotina 1 -Inserir no banco que realizou a rotina hoje, e não realizar mais
            DB::table('automations')->insert([
                'inativar_vendas_planos' => true, 
                'inativar_alunos' => true,
                'created_at'=>date('Y-m-d')
            ]);
            //Fim Rotina 1
            //Rotina 2 Inativar as vendas que já vencem no dia anterior à hoje 
            //Selecionar todos os planos que vencem 'hoje'
            $rotina = DB::table('vendas')
            ->where([['dt_fim','<',date('Y-m-d')],['status','Ativo']])->get();
            //Para cada aluno que tiver plano vencendo no dia de hoje, alterar situação para 'desistentes'
            foreach ($rotina as $obj) { 
                DB::table('clientes')->where('id',$obj->cliente_id)->update(['situaçao'=>'Desistente']);
            }
            //Tornar estas vendas como vencidas
            $rotina = DB::table('vendas')
            ->where([['dt_fim','<',date('Y-m-d')],['status','Ativo']])
            ->update(['status' => 'Vencido']);   
            //Fim Rotina 2
        
        }else{
            //Se robo já tiver sido executado não fazer nada

            //Selecionar todos os planos que vencem 'hoje'
            $rotina = DB::table('vendas')
            ->where([['dt_fim','<',date('Y-m-d')],['status','Ativo']])->get();
            //Para cada aluno que vencer no dia de hoje, alterar situação para 'desistentes'
            foreach ($rotina as $obj) { 
                DB::table('clientes')->where('id',$obj->cliente_id)->update(['situaçao'=>'Desistente']);
            }
            //Tornar as vendas como vencidas
            $rotina = DB::table('vendas')
            ->where([['dt_fim','<',date('Y-m-d')],['status','Ativo']])
            ->update(['status' => 'Vencido']);  
        }
        
    } 
    
    //
    public function index()
    {
        return view('home');
    }
}
