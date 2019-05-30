let now = new Date();

$('#dataNeg,#dateStart,#date').val(this.getDate());  

function getDate(){
    return (now.getDate() +"/"+ (now.getMonth()+1) +"/"+ now.getFullYear());
}