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
                	<div class="form-inline"> 
						    <label for="dt_inicio">Periodo</label>
						    <input type="text" class="form-control" id="dt_inicio">
						 
						    <label for="dt_fim">a</label> 
						    <input type="text" class="form-control" id="dt_fim">
							<button type="button" class="btn btn-primary btn-sm">Consultar</button>
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
                        	<tr>
                        		<td>01/01/2001</td>
                        		<td>Venda</td>
                        		<td>0</td>
                        		<td>1</td>
                        		<td>50</td>
                        		<td>49</td>
                        	</tr> 
                        	<tr>
                        		<td>01/01/2000</td>
                        		<td>Compra</td>
                        		<td>30</td>
                        		<td>0</td>
                        		<td>20</td>
                        		<td>50</td>
                        	</tr>  
                        </tbody>
                    </table>
                </div> 
            </div>
        </div> 
    </div>
</div>
@endsection 
@section('javascript')  
    <script type="text/javascript">
        //Método para DOM quando estiver carregado
        $(document).ready(function() {  
             
        }); 
    </script>
@endsection