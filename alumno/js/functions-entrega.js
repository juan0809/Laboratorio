console.log("Hola");
document.addEventListener('DOMContentLoaded',function(){
    var formEntrega = document.querySelector('#formEntrega');
        formEntrega.onsubmit = function(e){
        e.preventDefault();

        var  observacion = document.querySelector('#observacion').value;
        var file = document.querySelector('#file').value;
        
        if(observacion.trim() == '' || file == ''){
            swal('Atencion','Todos los campos son obligatorios', 'error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/entrega/ajax-entrega.php';
        var form = new FormData(formEntrega);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                    swal({
                        title: data.msg,
                        type: "success",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: true
                    },function(confirm){
                        if(confirm) {
                                //volver a la pagina anterior
                                window.history.back();
                            }
                        })
                  
                    }else {
                        swal('Atencion',data.msg,'error');

            }
        }
    }
})