document.addEventListener('DOMContentLoaded',function(){
    var formEvaluacion = document.querySelector('#formEvaluacion');
        formEvaluacion.onsubmit = function(e){
        e.preventDefault();
        var idevaluacion = document.querySelector('#idevaluacion').value;
        var idcontenido = document.querySelector('#idcontenido').value;
        var titulo = document.querySelector('#titulo').value;
        var descripcion = document.querySelector('#descripcion').value;
        var fecha = document.querySelector('#fecha').value;
        var porcentaje = document.querySelector('#porcentaje').value;
        
        if(titulo == '' || descripcion == ''|| fecha == ''|| porcentaje == ''){
            swal('Atencion','Todos los campos son obligatorios', 'error');
            return false;
        }
        //se vañoda que el porcentaje sea un numero y no un string
        if(isNaN(porcentaje)){
            swal('Atencion','El porcentaje debe ser un numero', 'error');
            return false;
        }
        //se valida que el porcentaje sea un numero entre 1 y 100
        if(porcentaje < 1 || porcentaje > 100){
            swal('Atencion','El porcentaje debe ser un numero entre 1 y 100', 'error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/evaluacion/ajax-evaluacion.php';
        var form = new FormData(formEvaluacion);
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
                            if(data.status) {
                                $('#modalEvaluacion').modal('hide');
                                location.reload();
                                formEvaluacion.reset();
                            } else {
                                swal('Atencion',data.msg,'error');
                            }
                        }
                    })
            }
        }
    }
})

function openModalEvaluacion(){
    document.querySelector('#idevaluacion').value = "";
    document.querySelector('#tituloModal').innerHTML = "Nueva Evaluacion";
    document.querySelector('#action').innerHTML = "Guardar";
    document.querySelector('#formEvaluacion').reset();
    $('#modalEvaluacion').modal('show');
}

function editarEvaluacion(id){
    var idevaluacion = id;
    document.querySelector('#tituloModal').innerHTML = 'Actualizar Evaluacion';
    document.querySelector('#action').innerHTML = 'Actualizar';
   
    document.querySelector('#formEvaluacion').reset();
    $('#modalEvaluacion').modal('show');
    
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTPP');
    var url = './models/evaluacion/edit-evaluacion.php?idevaluacion='+ idevaluacion;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
        if(data.status){
            document.querySelector('#idevaluacion').value = data.data.evaluacion_id;
            document.querySelector('#titulo').value = data.data.titulo;
            document.querySelector('#descripcion').value = data.data.descripcion;
            document.querySelector('#fecha').value = data.data.fecha;
            document.querySelector('#porcentaje').value = data.data.porcentaje;

           // $('modalEvaluacion').modal('show');
        } else {
            swal('Atencion',data.msg,'error');
                }
            }
        }
}

function eliminarEvaluacion(id) {
    var idevaluacion = id;
  
    swal({
          title: "Eliminar Evaluacion",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, eliminar",
          cancelButtonText: "No, cancelar",
          closeOnConfirm: false,
          closeOnCancel: true
      },function(confirm){
          if(confirm){
              var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          var url = './models/evaluacion/delet-evaluacion.php';
          request.open('POST',url,true);
          var strData = "idevaluacion="+idevaluacion;
          request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          request.send(strData);
          console.log(request);
          request.onreadystatechange = function(){
              if(request.readyState == 4 && request.status == 200){
                console.log(request.responseText)
                  var data = JSON.parse(request.responseText);
                  if(data.status){
                      location.reload();
                  } else{
                      swal('Atencion',data.msg,'error');
                  }
              }
          }
      }
  })
  }     
  
  
