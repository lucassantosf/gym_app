$(document).ready(function() {  

    verifyRowModals();

    //Campos de durações
    $('#add_field').click (function(e) {                
        e.preventDefault();//prevenir novos clicks                                
        $('#duracoes').append('<div class="col-sm-1">\
                <input type="text"  class="form-control" name="duracao[]">\
                <button href="#" class="btn btn-danger btn-sm remover_campo">-</button>\
            </div>');       
    }); 
    // Remover o div de durações
    $('#duracoes').on("click",".remover_campo",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();          
    }); 
    //Adicionar modalidade na tabela de cadastro
    $('#add_modal').on("click",function(e) { 
        var texto = $("#lista option:selected").text(); 
        var itemSelecionado = $("#lista option:selected").val(); 
        $('#modalidades').append(
            '<tr>'+
                '<td><input type="hidden" name="modals[]" value="'+itemSelecionado+'">'+texto+'</td>'+
                '<td><input type="button" class="btn-danger excluir" id="excluir" value="-" onclick="remover(this,'+itemSelecionado+')"></td>'+             
            '</tr>');
        //Remover a modalidade do select
        $("#lista option:selected").remove();
        verifyRowModals();
    }); 
    //Impedir submit vazio
    $("#formPlan,#formPlanEdit").submit(function(e) {  
        let name = $("#name").val(); 
        if($("#name").val() == ''){
            e.preventDefault();
            alert('Descrição do plano vazio!');      
            return false;
        }
        let duracoes = $("input[name='duracao[]']"); 
        if(duracoes.length == 0){
            alert('Informe alguma duração');
            return false;
        }else{
            duracoes.each(function() {
            var value = $(this).val();   
                if(value>12 || value==0){
                    e.preventDefault();
                    alert('Durações inválidas!');
                    return false;
                } 
            }); 
        }  
        let modals = $("input[name='modals[]']"); 
        if(modals.length == 0){
            alert('Selecione alguma modalidade');
            return false;
        }   
    });
    //Somente numeros nas divs duracoes
    $('.duracoes').keyup(function() {
        $(this).val(this.value.replace(/\D/g, ''));
    }); 
}); 
//Remover linhas da tabela de modalidades
function remover(data,id){
    texto = $(data).parents('tr').text(); 
    $(data).parents('tr').remove();
    //Adicionar a modalidade no select
    $("#lista").append('<option value="'+id+'">'+texto+'</option>');
    verifyRowModals();
}  
//Verificar contagem de linhas em tabela modalidades
function verifyRowModals(){
    let counter = $("#lista option").length;
    if(counter == 0){ 
        //Desabilitar botao add_modal
        $('#add_modal').attr('disabled', 'disabled');
    }else{
        //Habilitar botao add_modal
        $('#add_modal').removeAttr('disabled');
    }
} 