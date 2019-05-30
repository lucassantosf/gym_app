@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">                
                <div class="card-header">
                    Forma de Pagamento < <a href="/clients/caixaAberto/{{$cliente_id}}" class="link">Voltar</a>                  
                </div>
                <div class="card-body">
                    <form action="/clients/caixaAberto/post" method="POST"> @csrf
                    @if(isset($cliente_id))
                        <input type="hidden" name="cliente_id" value="{{$cliente_id}}">
                        @foreach($parcelas as $p)
                            <input type="hidden" name="parcela[]" value="{{$p}}">
                        @endforeach
                        <input type="hidden" name="valorTotal" value="{{$valorTotal}}">
                    @endif
                    <div class="row">
                        <div class="col-sm-6 col-md-5">
                            <h4>Valor total R$ {{$valorTotal}}</h4>
                        </div>
                        <div class="col-sm-2 col-md-3" style="text-align: right">Data</div>
                        <div class="col-sm-3 col-md-3">
                            <input type="text" id="date" name="date" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="radio" name="formaPagamento" value="dinheiro">Dinheiro<br>
                            <input type="radio" name="formaPagamento" value="cartaoc">Cartão de Crédito<br>
                            <input type="radio" name="formaPagamento" value="cartaod">Cartão de Débito<br>
                            <input type="radio" name="formaPagamento" value="cheque">Cheque<br>
                            <input type="radio" name="formaPagamento" value="transferencia">Transferencia<br>
                        </div>
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
    <script type="text/javascript" src="{{asset('js/components/datepicker.js')}}"> 
    </script>
    <script type="text/javascript" src="{{asset('js/util/date.js')}}"> 
    </script> 
@endsection