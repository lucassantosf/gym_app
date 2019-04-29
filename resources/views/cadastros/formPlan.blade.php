@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Exibir todos os planos -->
        @if($i==0)
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header">Planos 
                        <a style="float: right" href="/cadastros/formPlan" class="btn btn-outline-info btn-sm">Cadastrar</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Descrição</th>
                                    <th>Duraçoes</th>
                                    <th>Modalidades</th>
                                    <th scope="col" colspan="2">Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plans as $p)
                                <tr>
                                    <th>{{$p->id}}</th>
                                    <td>{{$p->name}}</td>
                                    <td>
                                    @foreach($duracoes as $d)                        
                                        @if($d->plano_id == $p->id)
                                            <span class="badge badge-dark">{{$d->duracao}}</span>
                                        @endif                        
                                    @endforeach
                                    </td>
                                    <td>
                                    @foreach($mp_id as $mp)
                                        @foreach($modals as $m)
                                            @if($mp->plano_id == $p->id && $mp->modal_id == $m->id)
                                                <span class="badge badge-dark">{{$m->name}}</span>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    </td>
                                    <td>
                                        @if($p->status == 1) 
                                            Ativo
                                        @else 
                                            Inativo
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/cadastros/plan/{{$p->id}}/edit" class="btn btn-sm btn-info">Editar</a>
                                        <a href="/cadastros/plan/{{$p->id}}/delete" class="btn btn-sm  btn-danger">Apagar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        @endif
        <!-- Form para cadastro-->
        @if($i==1)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cadastro de Planos</div>
                    <div class="card-body">
                        <form action="/cadastros/formPlan" method="POST">
                            @csrf
                            <div class="form-row">
                                <label class="col-sm-3">Descrição</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" placeholder="Descrição">
                                </div>
                            </div>
                            <br>
                            <div class="form-row" id="duracoes">  
                                <label class="col-sm-3">Durações</label>                              
                                <div class="col-sm-1">  
                                    <input type="button" class="form-control btn btn-primary btn-sm" id="add_field" value="+">
                                </div>
                                <div class="col-sm-1">              
                                    <input type="text" class="form-control" name="duracao[]" >
                                </div>          
                            </div>
                            <br>
                            <div class="form-row input-group mb-3">       
                                <div class="col-sm-3">Modalidades</div>
                                <div class="col-sm-9">                                
                                    <div class="input-group-prepend">                             
                                        <select class="custom-select" name="lista" id="lista">
                                            <option selected></option>
                                            @foreach($modals as $m)
                                                <option value="{{$m->id}}">{{$m->name}}</option>
                                            @endforeach                                      
                                        </select>                                
                                        <input type="button" id="add_modal" class="btn btn-primary btn-sm" value="+">
                                    </div>                                
                                </div>
                            </div>
                            <div class="form-row input-group mb-3"> 
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <table class="table" id="modalidades">
                                        <tbody>
                                            <!-- Modalidades adicionadas dinamicamente -->
                                        </tbody>
                                    </table>                             
                                </div>
                            </div>
                            <div class="form-group row">                            
                                <div class="col-sm-3">Ativo</div>
                                <div class="col-sm-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="A">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">      
                        <button class="btn btn-primary btn-sm" type="submit">Cadastrar</button>
                        <a href="/cadastros/plans" class="btn btn-sm btn-danger">Cancelar</a>
                        </form>              
                    </div>

                </div>
            </div>
        @endif
        <!-- Form para editar o plano-->
        @if($i==2)
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastro de Planos</div>
                    <div class="card-body">
                       
                        <form action="/cadastros/plan/{{$plan->id}}/edit" method="POST">
                            @csrf
                            <div class="form-row">
                                <label class="col-sm-3">Descrição</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" value="{{$plan->name}}">
                                </div>
                            </div>
                            <br>
                            
                            <div class="form-row" id="duracoes">      

                                <label class="col-sm-3">Durações</label>
                                                    
                                <div class="col-sm-1">  
                                    <input type="button" class="form-control btn btn-primary btn-sm" id="add_field" value="+">
                                </div>
                                @if(isset($duracoes))
                                    @foreach($duracoes as $d)                        
                                    <div class="col-sm-1">              
                                        <input type="text" class="form-control" name="duracao[]" value="{{$d->duracao}}">
                                        <button href="#" class="btn btn-danger btn-sm remover_campo">-</button>
                                    </div>                                                        
                                    @endforeach  
                                @endif  
                            </div>                        
                            <br>
                            <div class="form-row input-group mb-3">       
                                <div class="col-sm-3">Modalidades</div>
                                <div class="col-sm-9">                                
                                    <div class="input-group-prepend">
                                        <select class="custom-select" name="lista" id="lista">
                                            <option selected></option>
                                            @foreach($modals as $m)
                                                <option value="{{$m->id}}">{{$m->name}}</option>
                                            @endforeach                                      
                                        </select>                                
                                        <input type="button" id="add_modal" class="btn btn-primary btn-sm" value="+">
                                    </div>                                
                                </div>    
                            </div>
                            <div class="form-row input-group mb-3"> 
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <table class="table" id="modalidades">
                                        <tbody>  
                                            @foreach($modals as $m)
                                                @if(isset($mt))                                                
                                                    @foreach($mt as $ma)
                                                        
                                                        @if($ma->modal_id == $m->id)
                                                        <tr>
                                                            <td><input type="hidden" name="modals[]" value="{{$m->id}}">{{$m->name}}</td>
                                                            <td><input type="button" class="btn-danger excluir" id="excluir" value="-" onclick="remover(this)"></td>
                                                        </tr> 
                                                        @endif
                                                    @endforeach
                                                @endif  
                                            @endforeach
                                        </tbody>
                                    </table>                             
                                </div>
                            </div>

                            <div class="form-group row">                            
                                <div class="col-sm-3">Ativo</div>
                                <div class="col-sm-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="A" @if($plan->status == 1) checked @endif>
                                    </div>
                                </div>
                            </div>
                                        
                    </div>
                    <div class="card-footer">      
                        <button class="btn btn-primary btn-sm" type="submit">Editar</button>
                        </form>              
                    </div>

                </div>
            </div>
        @endif
    </div>
</div>
@endsection
@section('javascript')   
    <script type="text/javascript">
        $(document).ready(function() {  
                                                      
            //Campos de durações
            $('#add_field').click (function(e) {                
                e.preventDefault();     //prevenir novos clicks                                
                $('#duracoes').append('<div class="col-sm-1">\
                        <input type="text"  class="form-control" name="duracao[]">\
                        <button href="#" class="btn btn-danger btn-sm remover_campo">-</button>\
                    </div>');       
            });

            // Remover o div de durações
            $('#duracoes').on("click",".remover_campo",function(e) {
                e.preventDefault();
                $(this).parent('div').remove();          
            });
            
            $('#add_modal').on("click",function(e) {
                var texto = $("#lista option:selected").text(); 
                var itemSelecionado = $("#lista option:selected").val();
                $('#modalidades').append('<tr>'+
                                          '<td><input type="hidden" name="modals[]" value="'+itemSelecionado+'">'+texto+'</td>'+
                                          '<td><input type="button" class="btn-danger excluir" id="excluir" value="-" onclick="remover(this)"></td>'+             
                '</tr>');
            });                      

        });

        //Remover linhas da tabela de modalidades
        function remover(data){
            $(data).parents('tr').remove();
        }
        
    </script>
@endsection 