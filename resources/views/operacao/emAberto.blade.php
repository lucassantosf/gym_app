@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header">Caixa em Aberto de {{$cliente->name}} 
                    < <a href="/clients/{{$cliente->id}}/show" class="link">Voltar</a>
                </div>                
                <div class="card-body">
                    <form action="/clients/caixaAberto/pagarParcela" method="POST"> @csrf
                    <input type="hidden" name="cliente_id" value="{{$cliente->id}}">
                    <label class="alert alert-primary">Selecione as parcelas</label><br>
                    <div id="selecionarParcela">
                    @if(isset($parcelas))
                        @foreach($parcelas as $p)
                            
                                <input type="checkbox" class="parcela" name="parcela[]" id="{{$p->id}}" value="{{$p->id}}">
                                    Cod.{{$p->id}}-R$ 
                                <label for="{{$p->id}}">{{$p->value}}</label> <br>
                                                       
                        @endforeach
                    @endif
                    </div>
                    <br>
                    <div id="total"><!-- Incluir valor total -->                        
                    </div>
                </div>
                <div class="card-footer"> 
                    <button type="submit" class="btn btn-sm btn-primary">Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        
        $(document).ready(function() { 
            //Desmarcar todos checkbox - pois no rollback da pagina ficaria marcado
            $('.parcela').prop("checked", false);
            calcularValorTotal(0);
        });

        function calcularValorTotal(valor){
            total = valor;
            $(".parcela").change(function(){
                if($(this).prop("checked") == true){
                    $("#total").html('');                    
                    label = $(this).prop("labels");
                    text = $(label).text();
                    valor = parseFloat(text);
                    total = total + valor;
                    $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
                    $("#total").append('R$');   
                    $("#total").append(total.toFixed(2));   
                                      
                }else{
                    $("#total").html('');                    
                    label = $(this).prop("labels");
                    text = $(label).text();
                    valor = parseFloat(text);
                    total = total - valor;
                    $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
                    $("#total").append('R$');   
                    $("#total").append(total.toFixed(2)); 
                }
            });
        }

    </script>
@endsection


