@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <!-- Inicio card listagem -->
        <div class="col-md-12"> 
            <div class="card"> 
                <div class="card-header" style="text-align: center">
                    Cardex
                </div>
                <div class="card-body">
                	<div class="form-group row"> 
						    <label for="dt_inicio">Periodo</label>
						    <div class="col-sm-2">
						    	<input type="text" class="form-control form-control-sm datepicker" id="dt_inicio"> 
						    </div> 
						    <label for="dt_fim">a</label> 
						    <div class="col-sm-2">
						    	<input type="text" class="form-control form-control-sm datepicker" id="dt_fim">
						    </div>  
                	</div>
                    <div class="form-group row">
                        <label for="dt_inicio">Selecione o produto</label> 
                        <div class="col-sm-3">
                            <select class="form-control form-control-sm" name="prods" id="prods">
                                <option selected></option>
                                @foreach($produtos as $p)
                                    <option value="{{$p->id}}">{{$p->name}}</option>
                                @endforeach                                      
                            </select>   
                        </div> 
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-primary btn-sm" onclick="getSearch()">Consultar</button>
                        </div> 
                    </div> 
                    <table class="table table-responsive-sm table-striped table-borderless table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Data Operação</th> 
                                <th scope="col">Operação</th> 
                                <th scope="col">Entrada</th> 
                                <th scope="col">Saida</th> 
                                <th scope="col">Saldo Anterior</th> 
                                <th scope="col">Saldo Atual</th> 
                            </tr> 
                        </thead> 
                        <tbody id="cardexInfos"> 
                        </tbody>
                    </table>
                </div> 
            </div>
        </div> 
    </div>
</div>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
@endsection 
@section('javascript')  
	<script type="text/javascript" src="{{asset('js/components/datepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/estoque/cardex.js')}}"></script>
@endsection