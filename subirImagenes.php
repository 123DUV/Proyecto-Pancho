<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagenes </title>
    <link rel="icon" type="image/png" href="./img/icono-form.jpg">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="./styles.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        input[type="file"]{
            display: none;
        }
        .inputFalso{
            background-color: white;
            border-color: rebeccapurple;
            border-radius: 15px;
            padding: 15%;
            width: 100%;
            cursor: pointer;
            background-color:rgb(163, 163, 163);
            color: black;
            margin-top: 25%;
        }
        .inputFalso:hover{
            background-color:rgb(97, 96, 97);

        }
       .botonSubir{
        background-color: white;
        border-color: rebeccapurple;
        border-radius: 15px;
        padding: 2%;
        width: auto;
        margin: 5%;
       }
       .botonSubir:hover{
        background-color:rgb(255, 211, 249);
       }
    </style>
</head>
<body>
    <?php 
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $arrayImages=$_FILES['images'];

            if(count($arrayImages)> 0){
                foreach($arrayImages['name'] as $key => $name){
                    $tmp_name = $arrayImages['tmp_name'][$key];
                    if(move_uploaded_file($tmp_name, "uploads/".$name)){
                        echo "<script>
                        Swal.fire({
                            icon: 'info',
                            title : 'Exito',
                            text: 'Imagen subida correctamente'
                        }).then((result)=>{
                            if(result.isConfirmed){
                            window.location.href='/'
                            }
                        });
                        </script>";
                    }else{
                        echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title : 'Error',
                            text: 'Imagen no subida'
                        });
                        </script>";
                    }
                   }
            }
           
        }else{
            
        }
    ?>
    <div class="m-5">
             <button class="btn btn-secondary" onclick="volver();"><i class="bi bi-arrow-left"></i> Volver</button>
        </div>
        <form action="/subirImagenes" method="post" enctype="multipart/form-data">
            <div class="text-center col-md-6 col-sm-6 col-6" style="margin: 0 auto;">
                <label for="inputModificado" class="inputFalso overflow-hidden ">Cargar Imagen</label>
            <input type="file" accept="image/*" multiple="true" name="images[]" class="" id="inputModificado" required>
          <div id="vistaPrevia">

          </div>
            <button type="submit" class="botonSubir">Upload <i class="bi bi-cloud-arrow-up"></i></button>
            
        </div>
        

          


        </form>
        <script>
            //traer solo una vista previa

            document.getElementById('inputModificado').addEventListener("change", function(){
                let archivo = this.files.length > 0 ? Array.from(this.files).map(file=>file.name).join(" + "): "Ningun archivo seleccionado";
                $inputfalso = document.querySelector(".inputFalso");
                $inputfalso.textContent = archivo;
            });

            // const $imagenElegida = document.querySelector("#inputModificado");
            // $imagenPre =  document.querySelector("#vistaPrevia");

            // $imagenElegida.addEventListener("change", function(){
            //     const archivos =$imagenElegida.files;
            //     if(!archivos || !archivos.length){
            //         $imagenPre.src="";
            //         return;
            //     }
                
            //     const primerArchivo = archivos[0];
            //     const url = URL.createObjectURL(primerArchivo);
            //     $imagenPre.src=url;
            // });

            //traer varias

            document.getElementById('inputModificado').addEventListener('change', function(event){
                let filas = event.target.files;

                let limpiarPrev = document.getElementById('vistaPrevia');
                limpiarPrev.innerHTML = "";

                let urls=[];

                for(let i=0; i<filas.length;i++){
                    let url = URL.createObjectURL(filas[i]);
                    urls.push(url);
        
                    let crearImg = document.createElement("img");
                    crearImg.src= url;
                    crearImg.style.width = '100px';
                    crearImg.style.margin = '5px';
                    crearImg.style.border = 'solid';
                    limpiarPrev.appendChild(crearImg);
                }
                console.log(urls);
            });

            function volver(){
                window.location.href = "/";
            }
        </script>
    </body>
</html>