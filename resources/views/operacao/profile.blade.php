@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card"> 
                <div class="card-body">
                    @if(isset($client))
                        <div class="alert alert-primary" role="alert">
                            <h4>{{$client->name}}</h4> 
                            <h5>matricula {{$client->id}} - {{$client->situaçao}}</h5>                            
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" style="">
                                Dados Pessoais
                            </button>
                            <a href="/clients/caixaAberto/{{$client->id}}" class="btn btn-primary btn-sm">Caixa em Aberto</a>
                            <a href="/vendas/viewWithClient/{{$client->id}}/{{$client->name}}" class="btn btn-primary btn-sm">Realizar Vendas</a>
                            <a href="/clients/novoContrato/{{$client->id}}">Novo Contrato</a>
                        </div> 
                        <!-- Modal de edição -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="/incluir/clientsEdit" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$client->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Contato</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Endereço</a>
                                            </li>
                                        </ul>
                                        <input type="hidden" name="id" value="{{$client->id}}">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Nome</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name" id="name" value="{{$client->name}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Data Nascimento</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="dt_born" id="dt_born" value="{{$client->dt_born}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Nome da mãe</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="name_mother" id="name_mother" value="{{$client->name_mother}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Nome do pai</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="name_father" id="name_father" value="{{$client->name_father}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Sexo</label>
                                                    <div class="col-sm-10">
                                                        <select class="custom-select" id="sexo" name="sexo">
                                                            <option @if($client->sexo == 1) selected @endif value="1">Masculino</option>
                                                            <option @if($client->sexo == 2) selected @endif value="2">Feminino</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Estado Civil</label>
                                                    <div class="col-sm-10">
                                                        <select class="custom-select" id="est_civil" name="est_civil">
                                                            <option value="1" @if($client->est_civil == 1) selected @endif>Solteiro</option>
                                                            <option value="2" @if($client->est_civil == 2) selected @endif>Casado</option>
                                                            <option value="3" @if($client->est_civil == 3) selected @endif>Amasiado</option>
                                                            <option value="4" @if($client->est_civil == 4) selected @endif>Viuvo</option>
                                                            <option value="5" @if($client->est_civil == 5) selected @endif>Separado</option>
                                                        </select> 
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Cpf</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="cpf" id="cpf" value="{{$client->cpf}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Rg</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="rg" id="rg" value="{{$client->rg}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">RNE</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="rne" id="rne" value="{{$client->rne}}">
                                                    </div>
                                                </div>  
                                            </div>

                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Fone</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="phone" id="phone" value="{{$client->phone}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="email" id="email" value="{{$client->email}}">
                                                    </div>
                                                </div>  

                                            </div>

                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><br>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Cep &nbsp<button class="btn btn-primary list-inline-item btn-sm" id="consultarCep" onclick="consultar()" type="button">Consultar</button></label>

                                                    
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" name="cep" id="cep" value="{{$client->cep}}">
                                                    </div>
                                                </div>  

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Endereço</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="address" id="address" value="{{$client->address}}">
                                                    </div>
                                                </div>  

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Número</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="number" id="number" value="{{$client->number}}">
                                                    </div>
                                                </div>  

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Complemento</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="comple" id="comple" value="{{$client->comple}}">
                                                    </div>
                                                </div>  

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Bairro</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="neigh" id="neigh" value="{{$client->neigh}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Pais</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="country" id="country" value="{{$client->country}}">
                                                    </div>
                                                </div>  
                                                
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Estado</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="uf" id="uf" value="{{$client->uf}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Cidade</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="city" id="city" value="{{$client->city}}">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills_planos_historico" data-toggle="pill" href="#planos_historico" role="tab" aria-controls="pills-home" aria-selected="true">Planos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#parcelas_historico" role="tab" aria-controls="pills-profile" aria-selected="false">Histórico de Parcelas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#compras_historico" role="tab" aria-controls="pills-profile" aria-selected="false">Histórico de Compras</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#recibos_historico" role="tab" aria-controls="pills-profile" aria-selected="false">Histórico de Pagamentos</a>
                            </li> 
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="planos_historico" role="tabpanel" aria-labelledby="pills_planos_historico">
                                @if(count($vendas)>0) 
                                    @foreach($vendas as $v) 
                                        <div class="alert alert-primary" role="alert">  
                                            {{$v->plano_name}}
                                            <a href="/clients/estornarContrato/{{$v->id}}/{{$v->cliente_id}}" class="btn btn-outline-danger btn-sm" style="float: right;">Estornar</a><br>
                                            Duração do contrato<br>
                                             
                                            <label id="dt_inicio{{$v->id}}">{{$v->dt_inicio}}</label>
                                         
                                            <label id="dt_fim{{$v->id}}" style="float: right">{{$v->dt_fim}}</label> 
                                            <div class="progress"> 
                                                <div class="progress-bar bg-success" role="progressbar"  aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="progressDt{{$v->id}}"></div>
                                            </div> 
                                            Valor Total Plano: R${{$v->value_total}} 
                                        </div>  
                                    @endforeach
                                @else
                                    Sem planos
                                @endif  
                            </div>
                            <div class="tab-pane fade" id="parcelas_historico" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="text-align: center">Cod Parcela</th>
                                            <!--<th scope="col" style="text-align: center">Cod Contrato</th>-->
                                            <th scope="col" style="text-align: center">Valor</th>
                                            <th scope="col" style="text-align: center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                         
                                        @if(isset($parcelas))
                                            @if(count($parcelas)==0)
                                                <tr>
                                                    <td colspan="4" style="text-align: center">Nenhuma parcela</td>
                                                </tr>
                                            @else
                                                @foreach($parcelas as $pa)
                                                    @foreach($pa as $p) 
                                                        <tr>
                                                            <td style="text-align: center">{{$p->id}}</td>
                                                            <!--<td style="text-align: center">{{$p->venda_id}}{{$p->venda_avulsa_id}}</td>-->
                                                            <td style="text-align: center">R${{$p->value}}</td>
                                                            <td style="text-align: center" class="parcela{{$p->id}}">
                                                                @if($p->status == 'Em aberto')
                                                                <a class="border border-1 border-info rounded" id="{{$p->id}}" onclick="pagarParcela({{$p->id}},@if($p->venda_id == NULL) false @else{{$p->venda_id}}@endif,{{$p->venda_avulsa_id}})">{{$p->status}}</a> 
                                                                @else
                                                                <span class="border border-1 border-info rounded">{{$p->status}}</span>
                                                                @endif
                                                            </td> 
                                                        </tr>                                              
                                                    @endforeach 
                                                @endforeach
                                            @endif
                                        @endif     
                                    </tbody>
                                </table> 
                            </div>
                            <div class="tab-pane fade" id="compras_historico" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <table class="table table-hover" id="historicoCompras">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="text-align: center">Descrição produto</th>
                                            <th scope="col" style="text-align: center">Nº Venda Avulsa</th>
                                            <th scope="col" style="text-align: center">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($itens))
                                            @if(count($itens)==0)
                                                <tr>
                                                    <td colspan="3" style="text-align: center">Nenhuma venda realizada</td>
                                                </tr>
                                            @else
                                                @foreach($itens as $i)
                                                    <tr>
                                                        <td style="text-align: center">{{$i->descricao_produto}}</td>
                                                        <td class="linhaVenda{{$i->venda_avulsa_id}}" style="text-align: center">{{$i->venda_avulsa_id}}</td>
                                                        <td style="text-align: center"><button class="btn badge badge-pill badge-danger" onclick="estornarItemVendaAvulsa(this,{{$i->id}},{{$i->venda_avulsa_id}})">Estornar</button></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endif              
                                  </tbody>
                                </table> 
                            </div>
                            <div class="tab-pane fade" id="recibos_historico" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <table class="table table-hover" id="historicoPagamento">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="text-align: center">Nº Recibo</th>
                                            <th scope="col" style="text-align: center">Forma Pagamento</th>
                                            <th scope="col" style="text-align: center">Valor</th>
                                            <th scope="col" style="text-align: center">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($recibos))
                                            @if(count($recibos)==0)
                                                <tr>
                                                    <td colspan="4" class="firtRecibo" style="text-align: center">Nenhum pagamento realizado</td>
                                                </tr>
                                            @else
                                                @foreach($recibos as $r)
                                                    <tr>
                                                        <td style="text-align: center">{{$r->id}}</td>
                                                        <td style="text-align: center">{{$r->formaPagamento}}</td>
                                                        <td style="text-align: center" class="linhaRecibo{{$r->id}}">R${{$r->valorRecibo}}</td>
                                                        <td style="text-align: center">
                                                            <button class="btn badge badge-pill badge-danger" onclick="estornarRecibo(this,{{$r->id}})">Estornar</button>
                                                        </td>
                                                    </tr>
                                                @endforeach 
                                            @endif                                   
                                        @endif                                                  
                                    </tbody>
                                </table> 
                            </div>
                        </div>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script type="text/javascript" src="{{asset('js/operacao/profile.js')}}"></script>
@endsection