@extends('layouts.app') 
@section('content')
<div class="container" id="containerMain">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            	<div class="card-header" style="text-align: center">
          			Gestão de turmas
            	</div>
            	<div class="card-body">
            		<div class="form-group row" style="padding-bottom: 10px">
					    <label class="col-sm-2 col-form-label"></label>
					    <label class="col-sm-3 col-form-label">Modalidade</label>
					    @if(isset($modalidades))
						    <select style="margin-top: 5px" class="col-sm-5 form-control form-control-sm" id="selectModal">
							  		<option value="0">...</option> 
								  	@foreach($modalidades as $m)
								  		<option value="{{$m->id}}">{{$m->name}}</option> 
								  	@endforeach
							</select>
						@endif
					</div>            		
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label"></label>
					    <label class="col-sm-3 col-form-label">Turma</label>
					    <select style="margin-top: 5px" class="col-sm-5 form-control form-control-sm" id="selectTurma"> 
						</select> 
					</div>
					<table class="table table-sm table-responsive-sm table-borderless table-striped table-hover" style="font-size: 5" >
						<thead>
						    <tr> 
							    <th>Cod</th>
							    <th>Hora Inicio</th>
							    <th>Hora Fim</th>
							    <th>Ocupação</th>
							    <th>Dom</th>
							    <th>Seg</th>
							    <th>Ter</th>
							    <th>Qua</th>
							    <th>Qui</th>
							    <th>Sex</th>
							    <th>Sáb</th>
						    </tr>
						</thead>
						<tbody id="table_details_turma"> 
						</tbody>
					</table>
            	</div>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('javascript')  
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/operacao/gestaoTurmas.js')}}"></script>  
@endsection