@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(isset($msg))
            {{$msg}} para &nbsp<a href="/clients/{{$cliente->id}}/show">{{$cliente->name}}</a>
        @else
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="text-align:center">Conferir Negociação do contrato</div>
                <form action="/cadastros/plans/postVenda" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row"> 
                        <label class="form-control center" for="id_cliente" style="text-align:center; margin: 0 auto;">Detalhes</label>
                    </div>
                    <table class="table table-borderles table-responsive-sm">
                      <tbody>
                        <tr>
                          <td>Plano</td>
                          <td>{{$plano_descricao}}</td> 
                        </tr>
                        <tr>
                          <td>Duracao</td>
                          <td id="valor_duracao">
                            <input type="hidden" name="plano_id" value="{{$plano_id}}">
                            <input type="hidden" name="cliente_id" value="{{$cliente_id}}">
                            <input type="hidden" name="duracao" value="{{$duracao}}">{{$duracao}}</td> 
                            @if(isset($itens))
                                @foreach($itens as $i) 
                                <input type="hidden" name="itens[]" value="{{$i}}"> 
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                          <td>Valor do contrato</td>
                          <td id="valor_contrato">R${{$valor_contrato}}                          
                          </td>
                        </tr>
                        <tr>
                            <td>Adicionar desconto</td>
                            <td id="tdDesconto">
                                <input type="button" class=" btn btn-primary btn-sm" id="add_desconto" value="+">
                            </td>
                        </tr> 
                      </tbody> 
                    </table>     
                    <div class="form-row"> 
                        <label class="form-control center" for="id_cliente" style="text-align:center; margin: 0 auto;">Condição de Pagamento
                        </label>
                    </div>         
                    <table class="table table-borderles table-responsive-sm">
                        <tr>
                          <td><input type="radio" value="1" name="condicao" class="condicao">1 Vez</td>
                          <td><input type="radio" value="2" name="condicao" class="condicao">2 Vezes</td> 
                          <td><input type="radio" value="3" name="condicao" class="condicao">3 Vezes</td> 
                          <td><input type="radio" value="4" name="condicao" class="condicao">4 Vezes</td> 
                          <td><input type="radio" value="5" name="condicao" class="condicao">5 Vezes</td> 
                          <td><input type="radio" value="6" name="condicao" class="condicao">6 Vezes</td> 
                        </tr>
                        <tr>
                          <td><input type="radio" value="7" name="condicao" class="condicao">7 Vezes</td>
                          <td><input type="radio" value="8" name="condicao" class="condicao">8 Vezes</td> 
                          <td><input type="radio" value="9" name="condicao" class="condicao">9 Vezes</td> 
                          <td><input type="radio" value="10" name="condicao" class="condicao">10 Vezes</td> 
                          <td><input type="radio" value="11" name="condicao" class="condicao">11 Vezes</td> 
                          <td><input type="radio" value="12" name="condicao" class="condicao">12 Vezes</td> 
                        </tr>
                    </table> 
                    <div id="footer"> 
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Fechar negociação</button>
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
        let toggleDesconto = true;
        let toggleCond = true;
        let desconto_valor = 0;

        $(document).ready(function() {    
            
            $("#add_desconto").click(function(e){
                if(toggleDesconto){
                    $("#tdDesconto").append("<input type='text' name='desconto' id='desconto' style='width:50px;'>");
                    toggleDesconto = false;
                }else{
                    $("#desconto").remove();
                    toggleDesconto = true;
                }               
            });

            $(".condicao").on("click",function(e){
                desconto_valor = $("#desconto").val();

                condi = e.target.attributes.value.value;
                valor = ($("#valor_contrato").text()).replace("R$","");
                if(desconto_valor){
                    valor_contrato = valor - desconto_valor;
                }else{
                    valor_contrato = valor;
                }

                duracao = $("#valor_duracao").text();

                if(toggleCond){
                    $("#footer").html('');
                    $("#footer").append('Valor Mensal : R$ '+'<input type="text" value="'+(valor_contrato/condi).toFixed(2)+'" name="valor_final" >'+ ' X '+ condi);
                    toggleCond = false;
                    valor_contrato = 0;
                }else{
                    $("#footer").html('');
                    $("#footer").append('Valor Mensal : R$ '+'<input type="text" value="'+(valor_contrato/condi).toFixed(2)+'" name="valor_final" >'+ ' X '+ condi);
                    toggleCond = true;
                    valor_contrato = 0;
                }                 
            });            
        });
    </script>
@endsection