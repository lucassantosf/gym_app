<?php

Route::get('/', 'LoginController@index') ;

//Direcionamento do Logout
Route::get('logout', 'LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin.dash');

Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('admin.login');

Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::middleware(['auth'])->group(function () {
	// Cadastros
	Route::get('/cadastros/users','CadastrosController@indexUser');
	Route::get('/cadastros/user/{id}/edit','CadastrosController@formUserEdit');
	Route::post('/cadastros/user/{id}/edit','CadastrosController@postFormUserEdit');
	Route::get('/cadastros/user/{id}/delete','CadastrosController@destroyUser');
	Route::get('/cadastros/formUser','CadastrosController@formUser');
	Route::post('/cadastros/formUser','CadastrosController@postFormUser');

	Route::get('/cadastros/plans','CadastrosController@indexPlans');
	Route::get('/cadastros/products','CadastrosController@indexProducts');
	Route::get('/cadastros/modals','ModalidadeController@indexModals');
	Route::get('/cadastros/formModal','ModalidadeController@formModal');
	Route::post('/cadastros/formModal','ModalidadeController@postFormModal');
	Route::get('/cadastros/modal/{id}/edit','ModalidadeController@formModalEdit');
	Route::post('/cadastros/modal/{id}/edit','ModalidadeController@postformModalEdit');
	Route::get('/cadastros/modal/{id}/delete','ModalidadeController@destroyModal');

	Route::get('/cadastros/products','ProdutoController@indexProds');
	Route::get('/cadastros/formProd','ProdutoController@formProd');
	Route::post('/cadastros/formProd','ProdutoController@postformProd');
	Route::get('/cadastros/prod/{id}/edit','ProdutoController@formProdEdit');
	Route::post('/cadastros/prod/{id}/edit','ProdutoController@postformProdEdit');
	Route::get('/cadastros/prod/{id}/delete','ProdutoController@destroyProd');

	Route::get('/cadastros/plans','PlanoController@indexPlans');
	Route::get('/cadastros/formPlan','PlanoController@formPlan');
	Route::post('/cadastros/formPlan','PlanoController@postFormPlan');
	Route::get('/cadastros/plan/{id}/edit','PlanoController@formPlanEdit');
	Route::post('/cadastros/plan/{id}/edit','PlanoController@postformPlanEdit');
	Route::get('/cadastros/plan/{id}/delete','PlanoController@destroyPlan');
	Route::get('/cadastros/plans/{id}/details','PlanoController@detailsPlans');
	Route::post('/cadastros/plans/postConferirNeg','PlanoController@postConferirNeg'); 
	Route::post('/cadastros/plans/postVenda','PlanoController@postVenda');
 
	Route::get('/cadastros/turmas','TurmaController@indexTurmas');
	Route::get('/cadastros/formTurma','TurmaController@formTurma');
	Route::post('/cadastros/formTurma','TurmaController@postFormTurma'); 
	Route::get('/cadastros/turmas/{id}/edit','TurmaController@formTurmaEdit'); 
	Route::get('/cadastros/turmas/{id}/delete','TurmaController@destroyTurma');
	Route::post('/cadastros/turmas/{id}/edit','TurmaController@postformTurmaEdit');
	Route::get('/home/turmas/gestaoturmasview','TurmaController@gestaoTurmasView');
	Route::get('/home/turmas/gestaoturmasview/consultarTurmasFromModalId/{id}','TurmaController@getTurmasFromModalId');
	Route::get('/home/turmas/gestaoturmasview/consultarItensFromTurmaId/{id}','TurmaController@getItensFromTurmaId'); 
 
	// Relatórios
	// Clientes e Incluir Clientes
	Route::get('/clients','ClienteController@indexClients');
	Route::get('/incluir/clients','ClienteController@indexClientsAdd');
	Route::post('/incluir/clients','ClienteController@postClientsAdd');
	Route::post('/incluir/clientsEdit','ClienteController@postClientsEdit');
	Route::get('/clients/{id}/show','ClienteController@showClient');
	Route::get('/clients/novoContrato/{id}','ClienteController@newContract');
	Route::get('/clients/estornarContrato/{id_venda}/{id_pessoa}','ClienteController@estornarContract');

	//Parcelas
	Route::get('/clients/buscarParcelas/{id}','ParcelaController@showParcelasVenda');
	Route::get('/clients/buscarParcelas','ParcelaController@mostrarParcelas');
	Route::get('/clients/buscarParcelasAberto/{nome}','ParcelaController@buscarParcelasAberto');
	Route::get('/clients/pagarParcela/{id}/{hasContrato}','ParcelaController@payParcela');
	Route::get('/clients/pagarParcelaVA/{id}/{hasVenda}','ParcelaController@payParcelaVA'); 
	Route::get('/clients/getRecibo/{id}','ParcelaController@getRecibo');
	Route::get('/clients/estornarRecibo/{id}','ParcelaController@estornarRecibo');
	Route::get('/clients/caixaAberto/{id}','ParcelaController@parcelasEmAberto');
	Route::post('/clients/caixaAberto/pagarParcela','ParcelaController@pagarParcelas');
	Route::post('/clients/caixaAberto/post','ParcelaController@postCaixaAberto'); 

	//Vendas e Vendas Avulsas
	Route::get('/vendas/view','VendaController@returnView');
	Route::post('/vendas/viewPost','VendaAvulsaController@postVendaAvulsa');
	Route::get('/vendas/estornarVendaAvulsa/{id}','VendaAvulsaController@estornarVendaAvulsa');
	Route::get('/vendas/viewWithClient/{id}/{name}','VendaController@returnViewWithClient');
	Route::get('/vendas/searchClientByName/{name}','VendaController@getClientsName');
	Route::get('/vendas/searchProdByName/{name}','VendaController@getProdsName');
});  