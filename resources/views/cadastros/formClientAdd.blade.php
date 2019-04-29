@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Incluir clientes</div>
                
                <div class="card-body">
                    <form action="/incluir/clients" method="POST" id="formClient">
                        @csrf
                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Dados Pessoais" class="form-control center" style="text-align:center; margin: 0 auto;">
                            </div>
                        </fieldset><br>
                        
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name">Nome*</label>
                                <input type="text" id="name" name="name" class="form-control" ></input>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="dt_born">Data de nascimento</label>
                                <input type="text" id="dt_born" name="dt_born" class="form-control" placeholder="00/00/0000"> 
                            </div>
                        </div>
 
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name_mother">Nome da mãe ou responsável</label>
                                <input type="text" id="name_mother" name="name_mother" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name_father">Nome do pai ou responsável</label>
                                <input type="text" id="name_father" name="name_father" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="sexo">Sexo</label>
                                <select class="custom-select" id="sexo" name="sexo">
                                    <option selected></option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Feminino</option>
                                </select> 
                            </div>
                        </div>
                         
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="estado_civil">Estado civil</label>
                                <select class="custom-select" id="est_civil" name="est_civil">
                                    <option selected></option>
                                    <option value="1">Solteiro</option>
                                    <option value="2">Casado</option>
                                    <option value="3">Amasiado</option>
                                    <option value="4">Viuvo</option>
                                    <option value="5">Separado</option>
                                </select> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cpf">CPF*</label>
                                <input type="text" id="cpf" name="cpf" class="form-control" placeholder="000.000.000-00"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="rg">RG</label>
                                <input type="text" id="rg" name="rg" class="form-control" placeholder="00.000.000-0"> 
                            </div>
                        </div>                         

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="RNE">RNE</label>
                                <input type="text" id="rne" name="rne" class="form-control"> 
                            </div>
                        </div> 
                        
                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Contato" class="form-control center" style="text-align:center; margin: 0 auto;">
                            </div>
                        </fieldset><br>
                        
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="phone">Tel.*</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="(00)0 0000-0000"> 
                            </div>
                        </div> 

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="email">Email*</label>
                                <input type="email" id="email" name="email" class="form-control"> 
                            </div>
                        </div> 

                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Endereço" class="form-control center" style="text-align:center; margin: 0 auto;">
                            </div>
                        </fieldset><br>

                        <div class="form-group row col-md-4">
                            <label for="cep">CEP</label>
                            <div class="form-group row">
                                <div class="col-md-10">
                                    <input type="text" id="cep" name="cep" class="form-control" placeholder="00000-000">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-info list-inline-item" id="consultarCep" onclick="consultar()" type="button">Consultar</button>
                                </div>
                            </div>   
                        </div> 

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address">Endereço</label>
                                <input type="text" id="address" name="address" class="form-control"> 
                            </div>
                        </div> 

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="number">Número</label>
                                <input type="text" id="number" name="number" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="compl">Complemento</label>
                                <input type="text" id="comple" name="comple" class="form-control"> 
                            </div>
                        </div> 
                        
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="neigh">Bairro</label>
                                <input type="text" id="neigh" name="neigh" class="form-control"> 
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="country">Pais</label>
                                <input type="text" id="country" name="country" class="form-control"> 
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="uf">Estado</label>
                                <input type="text" id="uf" name="uf" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="city">Cidade</label>
                                <input type="text" id="city" name="city" class="form-control"> 
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-info" type="submit">Salvar</button>
                    </form>
                </div>

                @if($errors->any())
                    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
                    <script type="text/javascript">
                        let c = 0;
                        function countErrors(i){
                            c += i;
                            if(c==1){
                                $("#myModal").modal('show');
                            }
                        } 
                    </script>
                    <div class="modal" tabindex="-1" role="dialog" id="myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        @foreach($errors->all() as $error)
                                            <script type="text/javascript">
                                                this.countErrors(1);
                                            </script>
                                            <div class="alert alert-danger" role="alert">
                                                <input type="hidden" name="errors[]">{{$error}}</p>
                                            </div>
                                        @endforeach
                                </div>                              
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {    
            $("#dt_born").mask('00/00/0000', {reverse: true});
            $("#cpf").mask('000.000.000-00', {reverse: true});
            $("#rg").mask('00.000.000-0', {reverse: true});
            $("#phone").mask('(00)0 0000-0000', {reverse: true});
            $("#cep").mask('00000-000', {reverse: true});
        });

        function consultar(){
            cep = $('#cep').val();
            cep = cep.replace('-','');
            if(cep.length < 8) return false;
            if (cep != "" || cep.length >= 8) {
                $.getJSON("https://viacep.com.br/ws/"+cep+"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#address").val(dados.logradouro);
                    $("#compl").val(dados.complemento);
                    $("#neigh").val(dados.bairro);
                    $("#city").val(dados.localidade);
                    $("#country").val('Brasil');
                    $("#uf").val(dados.uf);
                }//end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        $("#cep").val('');
                        alert("CEP não encontrado.");
                    }
                });
            }else{
                alert('Cep em branco!');
            }
        }
    </script>
@endsection