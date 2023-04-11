<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio Pilas y Colas</title>
</head>
<?php

    require_once 'includes/header.php';
    require_once '../includes/conexion.php';
    //Se verifica que se haya enviado el id del laboratorio    
    if(!empty($_GET['id']) && !empty($_GET['materia'])) {
        //convertir id en numero para evitar inyección de código
        $id = intval($_GET['id']);
        $materia = intval($_GET['materia']);
        //Se realiza la consulta a la base de datos para obtener el código del laboratorio
        $sql = "SELECT * FROM laboratorios WHERE id = $id AND materia_id= $materia";
        $query = $pdo->prepare($sql);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $titulo=$row['titulo'];
            $descripcion=$row['descripcion'];
            $codigo=$row['codigo'];
        }
        else {
            $titulo="";
            $descripcion="No existe el laboratorio";
            $codigo="";
        }
    }
    else {
        $titulo="";
        $descripcion="No existe el id del laboratorio";
        $codigo="";
    }
?>
  
<body>
<main class="app-content">
  <div class="row">
    <div class="col-md-12 border shadow p-2 bg-info text-white">
        <h3 class="display-4" >Gestion de laboratorios</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>Mis Laboratorios</h4>
      
    </div>
  </div>
    <!-- Traer el código de la bd con php y ponerlo en un textarea oculto -->
    <textarea for="codigo" id="codigo" cols="50" rows="20" hidden><?=$codigo; ?></textarea>

    <!-- Label con la descripcion del laboratorio -->
    <h3 class="display-10" > <label for="titulo"><?=$titulo; ?></label></h3>
    <img src="http://www.oscarblancarteblog.com/wp-content/uploads/2014/08/pilain.png">
    <p for="descripcion" id="descripcion"><?=$descripcion; ?></p>
    
    <!-- Textarea con la respuesta del estudiante -->
    <div style="display: flex;">
        <div>
            <textarea style="flex-direction: row;" name="respuesta" id="respuesta" cols="90" rows="20"></textarea>
        </div>
        
        <!-- Mostrar resultado en un label -->
        <div style="flex-direction: row; text-align:left; background-color: rgba(0,0,200,0.2);" >
            <label for="resultado" id="resultado"></label>
        </div>
    </div>
 
    <button onclick="ejecutar()" id="boton" class="btn btn-primary">Probar código</button>
   
    <script>
        //si label codigo está vacio, deshabilitar el botón
        if(document.getElementById("codigo").innerHTML == ""){
            document.getElementById("boton").disabled = true;
        }
        function ejecutar(){
            //Convertir en arreglo el textarea de respuesta (cada salto de linea es un elemento del arreglo)
            let lineasRespuesta = document.getElementById("respuesta").value.split("\n");
            //Convertir en arreglo código de la bd (cada &br; es un elemento del arreglo)
            let lineasCodigo = document.getElementById("codigo").value.split("\n");
            //Arreglo para guardar los resultados de comparación
            let lineas = [];            
            document.getElementById("resultado").innerHTML = "";
            //comparar los arreglos
            for (let i = 0; i < lineasRespuesta.length; i++) {
                if(lineasRespuesta[i] == lineasCodigo[i]){
                    lineas.push("Correcto");
                    //Mostrar el OK
                    document.getElementById("resultado").innerHTML += "Línea " + (i+1)+ " OK <br>";
                }else{
                    lineas.push("Incorrecto");
                    //Mostrar el error
                    document.getElementById("resultado").innerHTML += "Línea " + (i+1)+ " X <br>";
                }
            }
        }
    </script>
</body>
</html>
<?php
require_once 'includes/footer.php'
?>