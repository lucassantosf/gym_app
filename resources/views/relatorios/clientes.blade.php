@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card"> 
                <div class="card-header">
                    Filtrar Clientes
                </div>
                <div class="card-body"> 
                    <div class="row date_start">
                        <div class="col-sm-2">Data de Cadastro</div>
                        <div class="col-sm-2"><input type="text" id="dataNeg" name="dataNeg" class="form-control form-control-sm"></div>
                        <div class="col-sm-1">a</div>
                        <div class="col-sm-2"><input type="text" id="dataStart" name="dataStart" class="form-control form-control-sm"></div>
                    </div> 
                    <div class="row date_start" style="padding-bottom: 10px;">
                        <div class="col-sm-2">Data de Inicio</div>
                        <div class="col-sm-2"><input type="text" id="dataNeg" name="dataNeg" class="form-control form-control-sm"></div>
                        <div class="col-sm-1">a</div>
                        <div class="col-sm-2"><input type="text" id="dataStart" name="dataStart" class="form-control form-control-sm"></div>
                    </div> 
                    <div class="situacao" style="border-style: solid; border-width: 0.5px 0px 0.5px 0px">
                        <div class="row">
                            <div class="col-sm-2">
                                Situação
                            </div>
                        </div>  
                        <div class="row"> 
                            <div class="col-sm-12">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="statusAtivoCheck" value="">
                                  <label class="form-check-label" for="statusAtivoCheck">Ativo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="statusDesCheck" value="">
                                  <label class="form-check-label" for="statusDesCheck">Desistente</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="statusVisCheck" value="">
                                  <label class="form-check-label" for="statusVisCheck">Visitante</label>
                                </div>
                            </div>  
                        </div>
                    </div> 
                    <div class="sexo" style="border-style: solid; border-width: 0px 0px 0.5px 0px">
                        <div class="row">
                            <div class="col-sm-2">
                                Sexo
                            </div>
                        </div>  
                        <div class="row"> 
                            <div class="col-sm-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sexoMasc" value="">
                                    <label class="form-check-label" for="sexoMasc">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="sexoFem" value="">
                                    <label class="form-check-label" for="sexoFem">Feminino</label>
                                </div> 
                            </div>  
                        </div>
                    </div>
                    <div class="duracao" style="border-style: solid; border-width: 0px 0px 0.5px 0px">
                        <div class="row">
                            <div class="col-sm-2">
                                Duração
                            </div>
                        </div>  
                        <div class="row"> 
                            <div class="col-sm-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month1" value="">
                                    <label class="form-check-label" for="month1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month2" value="">
                                    <label class="form-check-label" for="month2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month3" value="">
                                    <label class="form-check-label" for="month3">3</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month4" value="">
                                    <label class="form-check-label" for="month4">4</label>
                                </div>  
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month5" value="">
                                    <label class="form-check-label" for="month5">5</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month6" value="">
                                    <label class="form-check-label" for="month6">6</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month7" value="">
                                    <label class="form-check-label" for="month7">7</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month8" value="">
                                    <label class="form-check-label" for="month8">8</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month9" value="">
                                    <label class="form-check-label" for="month9">9</label>
                                </div> 
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month9" value="">
                                    <label class="form-check-label" for="month9">9</label>
                                </div> 
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month10" value="">
                                    <label class="form-check-label" for="month10">10</label>
                                </div> 
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month11" value="">
                                    <label class="form-check-label" for="month11">11</label>
                                </div> 
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="month12" value="">
                                    <label class="form-check-label" for="month12">12</label>
                                </div> 
                            </div>  
                        </div>
                    </div> 
                    <div class="planos" style="border-style: solid; border-width: 0px 0px 0.5px 0px">
                        <div class="row">
                            <div class="col-sm-2">
                                Plano
                            </div>
                        </div>  
                        <div class="row" style="padding-bottom: 10px;">  
                            @if(isset($planos))
                                <div class="col-sm-4">
                                    <select class="custom-select custom-select-sm" name="modal_id">
                                        <option selected>Plano</option> 
                                        @foreach($planos as $p)                                    
                                            <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif  
                        </div>
                    </div> 
                    <div class="modalidades" style="border-style: solid; border-width: 0px 0px 0.5px 0px">
                        <div class="row">
                            <div class="col-sm-2">
                                Modal
                            </div>
                        </div>  
                        <div class="row" style="padding-bottom: 10px;"> 
                            <div class="col-sm-12">
                                @if(isset($modals)) 
                                    @foreach($modals as $m)  
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input form-control-sm" type="checkbox" id="month1" value="{{$m->id}}">
                                        <label class="form-check-label" for="month1">{{$m->name}}</label>
                                    </div>                   
                                    @endforeach 
                                @endif
                            </div>  
                        </div>
                    </div> 
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-info">Pesquisar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        //InitFunctions
        $(document).ready(function() {                
            
            $('#dataNeg,#dataStart').datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
            }); 

        }); 
    </script>
@endsection