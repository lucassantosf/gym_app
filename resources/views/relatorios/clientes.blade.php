@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                @if($i==0) 
                    <div class="card-header">
                        <h5>Filtrar Clientes</h5> 
                    </div>
                    <div class="card-body"> 
                        <form action="/relatorios/clients/search" method="GET">
                        <div class="row date_start">
                            <div class="col-sm-2">Data de Cadastro</div>
                            <div class="col-sm-2"><input type="text" id="dateCadStart" name="dateCadStart" class="form-control form-control-sm"></div>
                            <div class="col-sm-1">a</div>
                            <div class="col-sm-2"><input type="text" id="dateCadEnd" name="dateCadEnd" class="form-control form-control-sm"></div>
                        </div> 
                        <div class="row date_start" style="padding-bottom: 10px;">
                            <div class="col-sm-2">Data de Inicio</div>
                            <div class="col-sm-2"><input type="text" id="dateStart" name="dateStart" class="form-control form-control-sm"></div>
                            <div class="col-sm-1">a</div>
                            <div class="col-sm-2"><input type="text" id="dateEnd" name="dateEnd" class="form-control form-control-sm"></div>
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
                                        <input class="form-check-input" type="checkbox" id="statusAtivoCheck" name="statusAtivoCheck" value="Ativo">
                                        <label class="form-check-label" for="statusAtivoCheck">Ativo</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="statusDesCheck"  name="statusDesCheck" value="Desistente">
                                        <label class="form-check-label" for="statusDesCheck">Desistente</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="statusVisCheck"  name="statusVisCheck" value="Visitante">
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
                                        <input class="form-check-input" type="checkbox" id="sexoMasc" name="sexoMasc" value="1">
                                        <label class="form-check-label" for="sexoMasc">Masculino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="sexoFem" name="sexoFem" value="2">
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
                                        <input class="form-check-input" type="checkbox" id="month1" name="month1" value="1">
                                        <label class="form-check-label" for="month1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month2" name="month2" value="2">
                                        <label class="form-check-label" for="month2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month3" name="month3" value="3">
                                        <label class="form-check-label" for="month3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month4" name="month4" value="4">
                                        <label class="form-check-label" for="month4">4</label>
                                    </div>  
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month5" name="month5" value="5">
                                        <label class="form-check-label" for="month5">5</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month6" name="month6" value="6">
                                        <label class="form-check-label" for="month6">6</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month7" name="month7" value="7">
                                        <label class="form-check-label" for="month7">7</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month8" name="month8" value="8">
                                        <label class="form-check-label" for="month8">8</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month9" name="month9" value="9">
                                        <label class="form-check-label" for="month9">9</label>
                                    </div>  
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month10" name="month10" value="10">
                                        <label class="form-check-label" for="month10">10</label>
                                    </div> 
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month11" name="month11" value="11">
                                        <label class="form-check-label" for="month11">11</label>
                                    </div> 
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="month12" name="month12" value="12">
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
                                        <select class="custom-select custom-select-sm" name="plano_id">
                                            <option selected></option> 
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
                                            <input class="form-check-input form-control-sm" type="checkbox" id="modal[]" name="modal[]" value="{{$m->id}}">
                                            <label class="form-check-label">{{$m->name}}</label>
                                        </div>                   
                                        @endforeach 
                                    @endif
                                </div>  
                            </div>
                        </div> 
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-info" type="submit">Pesquisar</button>
                        </form>
                    </div>
                @else
                    <div class="card-header">
                        Filtrar Clientes < <a href="/relatorios/clients">Voltar</a>
                    </div>
                    <div class="card-body"> 
                            <table class="table table-sm table-responsive">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Fone</th>
                                        <th>Email</th>
                                        <th>Sexo</th>
                                        <th>Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($consulta as $obj)
                                    <tr>
                                        <td>{{$obj->name}}</td>
                                        <td>{{$obj->phone}}</td>
                                        <td>{{$obj->email}}</td>
                                        <td>{{$obj->sexo}}</td>
                                        <td>{{$obj->situaçao}}</td>
                                    </tr> 
                                @endforeach
                                </tbody>
                            </table> 
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
@endsection
@section('javascript') 
    <script type="text/javascript" src="{{asset('js/components/datepicker.js')}}"></script>  
@endsection