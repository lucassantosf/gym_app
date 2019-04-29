<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Turma;
use App\ItemTurma;
use App\Modalidade;

class TurmaController extends Controller
{	
	//Retornar apenas a view com listagem das turmas
    public function indexTurmas(){
    	$i = 0;
    	$turmas = Turma::all();
    	$modalidades = Modalidade::all();
    	return view('cadastros.formTurma',compact('i','turmas','modalidades'));
    }

    //Retornar a view do cadastro da turma com o furmulário
    public function formTurma(){
    	$i = 1;
    	$modalidades = DB::table('modalidades')->where([
                ['controlTurma',1],
                ['deleted_at',NULL],
        ])->get();
    	return view('cadastros.formTurma',compact('i','modalidades'));
    }

    //Tratar o post da Form da Turma
    public function postFormTurma(Request $request){ 
    	$turma = new Turma();
    	$turma->name = $request->input('descricao_turma'); 
    	$turma->modal_id = $request->input('modal_id');
    	$turma->status = $request->input('status') == 'A' ? true : false;
    	$turma->save(); 
    	$horariosInicio = $request->input('horarioInicio');
    	$horariosFim = $request->input('horarioFim');
    	$qtdTurma = $request->input('qtdTurma');
    	$diaSemana = $request->input('diaSemana'); 
    	for($i = 0 ; $i < count($horariosInicio) ; $i++){
    		$ItemTurma = new ItemTurma();
    		$ItemTurma->hora_inicio = $horariosInicio[$i];
    		$ItemTurma->hora_fim = $horariosFim[$i];
            $ItemTurma->capacidade = $qtdTurma[$i];
    		$ItemTurma->vagas_livres = $qtdTurma[$i];
    		$ItemTurma->dia_semana  = $diaSemana[$i]; 
            $ItemTurma->turma_id = $turma->id;
    		$ItemTurma->modal_id = $turma->modal_id;
    		$ItemTurma->save(); 
    	}
    	return redirect('/cadastros/turmas');
    }

    //ste método exibe os dados de uma turma em especifico, apenas utilizado para quando a turma for editada
    public function formTurmaEdit($id){
    	$i = 2;
    	$turma = Turma::find($id);
    	$modalidades = Modalidade::all();
    	$itens_turma = DB::table('item_turmas')->where([
                ['turma_id',$turma->id],
                ['deleted_at',NULL],
        ])->get();
    	return view('cadastros.formTurma',compact('i','turma','modalidades','itens_turma'));
    }

    //Tratar o post do formulário de edição da turma
    public function postformTurmaEdit(Request $request, $id){
    	$turma = Turma::find($id);
    	if (isset($turma)) {
    		//1-Editar os detalhes da turma
    		$turma->name = $request->input('descricao_turma_edit'); 
	    	$turma->modal_id = $request->input('modal_id_edit');
	    	$turma->status = $request->input('status_edit') == 'A' ? true : false;
	    	$turma->save();
	    	//1-Fim editar detalhes
	    	 
	    	//2-Editar os itens do array lista 1
	    	$horariosInicio_edit = $request->input('horarioInicio_edit');
    		$horariosFim_edit = $request->input('horarioFim_edit');
    		$qtdTurma_edit = $request->input('qtdTurma_edit');
    		$diaSemana_edit = $request->input('diaSemana_edit'); 
	    	$lista1 = $request->input('lista1');
	    	if (isset($lista1)) {	    	
		    	for($x=0; $x < count($lista1); $x++) {
		    		$item_turmas = ItemTurma::find($lista1[$x]);
		    		if (isset($item_turmas)) {
		    			$item_turmas->hora_inicio = $horariosInicio_edit[$x];
			    		$item_turmas->hora_fim = $horariosFim_edit[$x];
			    		$item_turmas->capacidade = $qtdTurma_edit[$x];
			    		$item_turmas->dia_semana  = $diaSemana_edit[$x]; 
                        $item_turmas->modal_id = $turma->modal_id; 
			    		$item_turmas->save();
		    		}
		    	}
	    	}
	    	//2-Fim editar itens
	    	
	    	//3-Verificar se os itens do banco estão no post do array1 - senão estiver apagar
	    	$itens_turma = DB::table('item_turmas')->where([
                ['turma_id',$turma->id],
                ['deleted_at',NULL],
        	])->get();
	    	foreach ($itens_turma as $i) {
	    		if(!in_array($i->id,$lista1)){
	    			$item = ItemTurma::find($i->id);
	    			$item->delete();
	    		} 
	    	} 
	    	//3-Fim verificar itens
	    	
	    	//4-Salvar os itens do array lista 2
	    	$horariosInicio = $request->input('horarioInicio');
    		$horariosFim = $request->input('horarioFim');
    		$qtdTurma = $request->input('qtdTurma');
    		$diaSemana = $request->input('diaSemana'); 
	    	if (isset($horariosInicio)) {
  				for($i = 0 ; $i < count($horariosInicio) ; $i++){
		    		$ItemTurma = new ItemTurma();
		    		$ItemTurma->hora_inicio = $horariosInicio[$i];
		    		$ItemTurma->hora_fim = $horariosFim[$i];
		    		$ItemTurma->capacidade = $qtdTurma[$i];
		    		$ItemTurma->dia_semana  = $diaSemana[$i]; 
		    		$ItemTurma->turma_id = $turma->id;
                    $ItemTurma->modal_id = $turma->modal_id; 
		    		$ItemTurma->save();
	    		}
  			} 
	    	//4-Fim salvar itens do array lista 2
	    	
    	}
    	return redirect("/cadastros/turmas");
    }

    //Método para tratar a exclusão da turma, mas há softdeletes
    public function destroyTurma($id){
    	$turma = Turma::find($id);
        if($turma){
            try{
                $turma->delete();
            }catch(Exception $e){
                return redirect('/cadastros/turmas');
            }
        }
        return redirect('/cadastros/turmas');
    } 

    //Retornar View da Gestão de Turmas
    public function gestaoTurmasView(){
        $modalidades = DB::table('modalidades')->where([
                ['controlTurma',1],
                ['deleted_at',NULL],
        ])->get();
        return view('operacao.gestaoTurmas',compact('modalidades'));
    }

    //Este método serve para consultar quais turmas estão relacionadas à modalidade pesquisada, de acordo ao id da modalidade - utilizado na tela Gestão de Turmas
    public function getTurmasFromModalId($id){
        $turmas = DB::table('turmas')->where([
                ['modal_id',$id],
                ['deleted_at',NULL],
        ])->get(); 
        return json_encode($turmas);
    }

    //Este método serve para consultar itens de uma turma de acordo ao id selecionado - utilizado na tela Gestão de Turmas
    public function getItensFromTurmaId($id){
        $dados = [];
        $alunos = [];
        $itens = DB::table('item_turmas')->where([
                ['turma_id',$id],
                ['deleted_at',NULL],
        ])->get(); 
        array_push($dados, $itens);
        foreach ($itens as $i) {
            $alunos_consulta_em_turma = DB::table('alunos_em_turmas')->where([
                    ['item_turma_id',$i->id], 
            ])->get(); 
            array_push($alunos, $alunos_consulta_em_turma);
        }
        array_push($dados, $alunos); 
        return json_encode($dados);
    }

}	