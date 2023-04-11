$('#tablealumnos').DataTable();
var tablealumnos;

document.addEventListener('DOMContentLoaded',function(){
    tablealumnos = $('#tablealumnos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": "./models/alumnos/table_alumnos.php",
            "dataSrc":""
        },
        "columns": [
            {"data":"acciones"},
            {"data":"alumno_id"},
            {"data":"nombre_alumno"},
            {"data":"apellido"},
            {"data":"cedula"},
            {"data":"correo"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });

    var formAlumno = document.querySelector('#formAlumno');
    formAlumno.onsubmit = function(e) {
        e.preventDefault();

        var idalumno = document.querySelector('#idalumno').value;
        var nombre = document.querySelector('#nombre').value;
        var apellido = document.querySelector('#apellido').value;
        var cedula = document.querySelector('#cedula').value;
        var clave = document.querySelector('#clave').value;
        var correo = document.querySelector('#correo').value;
        var estado = document.querySelector('#listEstado').value;

        if(nombre == '' || apellido == '' || cedula == '' ||  correo == '') {
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumnos/ajax-alumnos.php';
        var form = new FormData(formAlumno);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalAlumno').modal('hide');
                    formAlumno.reset();
                    swal('Alumno',data.msg,'success');
                    tablealumnos.ajax.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }
})

function openModalAlumno() {
    document.querySelector('#idalumno').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Alumno';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAlumno').reset();
    $('#modalAlumno').modal('show');
}

function editarAlumno(id) {
    var idalumno = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Alumno';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumnos/edit-alumno.php?idalumno='+idalumno;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idalumno').value = data.data.alumno_id;
                    document.querySelector('#nombre').value = data.data.nombre_alumno;
                    document.querySelector('#apellido').value = data.data.apellido;
                    document.querySelector('#cedula').value = data.data.cedula;
                    document.querySelector('#correo').value = data.data.correo;
                    document.querySelector('#listEstado').value = data.data.estado;

                    $('#modalAlumno').modal('show');
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
}

function eliminarAlumno(id) {
    var idalumno = id;

    swal({
        title: "Eliminar Alumno",
        text: "Realmente desea eliminar el alumno?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    },function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/alumnos/delet-alumno.php';
            request.open('POST',url,true);
            var strData = "idalumno="+idalumno;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal('Eliminar',data.msg,'success');
                        tablealumnos.ajax.reload();
                    } else {
                        swal('Atencion',data.msg,'error');
                    }
                }
            }
        }
    })
}