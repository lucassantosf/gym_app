$(document).ready(function() {    
    $("#formUser").submit(function() {
        let password = $("#password").val();
        let password_confirm = $("#password_confirm").val();
        let password_new = $("#password_new").val();
        let password_confirm_new = $("#password_confirm_new").val();
        if(password != password_confirm || password_new != password_confirm_new){
            alert('Os campos de senha e confirmação não conferem');
            return false;
        }               
    });
});