$(document).ready(function() {                 
    //Campos de durações
    $('#add_field').click (function(e) {                
        e.preventDefault();     //prevenir novos clicks                                
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
    $('#add_modal').on("click",function(e) {
        var texto = $("#lista option:selected").text(); 
        var itemSelecionado = $("#lista option:selected").val();
        $('#modalidades').append('<tr>'+
                                  '<td><input type="hidden" name="modals[]" value="'+itemSelecionado+'">'+texto+'</td>'+
                                  '<td><input type="button" class="btn-danger excluir" id="excluir" value="-" onclick="remover(this)"></td>'+             
        '</tr>');
    }); 
}); 
//Remover linhas da tabela de modalidades
function remover(data){
    $(data).parents('tr').remove();
} 