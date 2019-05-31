@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Inicio card listagem -->
        <div class="col-md-10"> 
            <div class="card"> 
                <div class="card-header" style="text-align: center">
                    Posição Estoque
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped table-borderless table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Produto</th> 
                                <th scope="col">Estoque Atual</th> 
                            </tr> 
                        </thead> 
                        <tbody> 
                            @foreach($posicao as $pos)
                                <tr>
                                    <td>
                                        @foreach($produtos as $p)
                                            @if($p->id == $pos->produto_id)
                                                {{$p->name}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$pos->quantidade_atual}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
        <!-- Fim card listagem --> 
    </div>
</div>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
@endsection 
@section('javascript') 
    <script type="text/javascript" src="{{asset('js/estoque/posicao.js')}}"></script> 
@endsection