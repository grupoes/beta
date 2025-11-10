$(function () {
	$("#titulo").text("Lista de Observaciones en "+empresa);
     $("#table_sistema").DataTable();
});

function observaciones(id){
     $("#titulo").text("Observaciones "+empresa); reload();
     $.post(base_url+"Observaciones/nuevasobservaciones",{'id' : id},function(data){

          $('#cont_sistema').empty().html(data);
     });
}

