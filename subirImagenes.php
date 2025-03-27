
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagenes </title>
    <link rel="shortcut icon" type="image/svg+xml" href="/app_duv/favicon.svg">
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
   

</head>

<body>
    <?php
    //filtrar url para sacar id de drive
    $arrayId = [];
    $contador = 0;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        foreach ($_POST['inputId'] as $campoId) {
        
            foreach($_POST['inputName'] as $campoName){
                $contador++;
                
            $arrayId[] = ["id" => $campoId, "nombre" => $campoName];
            }
        }
        // print_r($arrayId);
    }

    foreach ($arrayId as $img) {
      
        actualizarImg($img['nombre']);
        descargarImg($img["id"], $img["nombre"]);
    }

    function actualizarImg($nameImg)
    {
        $path = "./uploads/";

        if (is_dir($path)) {
            if ($dh = opendir($path)) {
                while (($file = readdir($dh)) !== false) {


                    if ($file == $nameImg) {
                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Listo',
                                text: 'Imagen $file actualizada correctamente'
                            }).then((result)=>{
                                if(result.isConfirmed){
                                    window.location.href = '/app_duv/';
                                }
                            })
                        </script>";
                    }
                }
                closedir($dh);
            }
        }
        
    }

    function descargarImg($id, $name)
    {
        $urlRecortada = parse_url($id, PHP_URL_PATH);
        $parteUrlRecortada = substr($urlRecortada, 8, 33);
        // echo "url recortada" . $parteUrlRecortada;

        $urlDrive = "https://drive.google.com/uc?export=download&id=$parteUrlRecortada";
 

        $rutaGuardado = "./uploads/" . $name;

        $imagen = file_get_contents($urlDrive);
        if ($imagen) {
            file_put_contents($rutaGuardado, $imagen);
            // echo "Imagen descargada: $rutaGuardado<br>";
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Listo',
                text: 'Descarga exitosa'
            }).then((result)=>{
            if(result.isConfirmed){
                window.location.href = '/app_duv/';
            }   
        });
            </script>";
        } else {
            echo "Error al descargar $name<br>";
        }
    }


    ?>
    <div class="m-5">
        <button class="btn btn-secondary" onclick="volver();"><i class="bi bi-arrow-left"></i> Volver</button>
    </div>
    <form action="/app_duv/subirImagenes" method="post" enctype="multipart/form-data">
        <div class="w-50" style="margin: 0 auto;">
            <div class="d-flex flex-column" id="agregarInputs">
                <div class="input-group">
                    <input type="text" class="form-control " placeholder="Id imagen" name="inputId[]">
                    <div class="input-group-append">
                        <button class="btn btn-secondary " type="button" id="botonAgregar"><i
                                class="bi bi-plus"></i></button>
                    </div>
                </div>
                <div class="mb-2 mt-2">
               <input type="text" class="form-control " placeholder="Nombre imagen" name="inputName[]">
               </div>

            </div>
            <button type="submit" class="btn btn-secondary mt-2">Upload <i class="bi bi-cloud-arrow-up"></i></button>

        </div>
        <div>

        </div>


        </div>





    </form>
    <!--script agregar inputs y borrar -->
    <script>
        var contador = 0;
        document.getElementById("botonAgregar").addEventListener("click", function () {
            const divInputG = document.createElement("div");
            const divBtn = document.createElement("div");
            const crearInput = document.createElement("input");
            const crearInput2 = document.createElement("input");
            const crearBtnEliminar = document.createElement("button");
            const divAgregarInputs = document.getElementById("agregarInputs");
            const crearIconoEliminar = document.createElement("i");
            const crearDiv2 = document.createElement("div");

            divInputG.className = "input-group mb-2";
            divBtn.className = "input-group-append";
            crearBtnEliminar.className = "btn btn-secondary e";
            crearBtnEliminar.type = "button";
            // crearBtnEliminar.textContent =""
            crearBtnEliminar.style.backgroundColor = "red";
            crearIconoEliminar.className = "bi bi-dash-lg"


            crearInput.type = "text";
            crearInput.className = " form-control ";
            crearInput.placeholder = "Id imagen";
            crearInput.name = "inputId[]";
            crearInput.id = contador;

            crearInput2.type = "text";
            crearInput2.className = " form-control ";
            crearInput2.placeholder = "Nombre imagen";
            crearInput2.name = "inputName[]";
            crearInput2.id = contador;

            crearDiv2.classList = " mt-2";

            divAgregarInputs.appendChild(divInputG);
            divInputG.appendChild(crearInput);
            divInputG.appendChild(divBtn);
            divBtn.appendChild(crearBtnEliminar);
            crearBtnEliminar.appendChild(crearIconoEliminar);
            crearDiv2.appendChild(crearInput2);
            divInputG.appendChild(crearDiv2);
            contador++;
            console.log(contador);
        });

        document.getElementById("agregarInputs").addEventListener('click', function (event) {
            let target = event.target;

            while (target && !target.classList.contains("e")) {
                target = target.parentNode;
            }
            if (target) {
                target.parentNode.parentNode.remove();
                console.log(target.parentNode.parentNode);
            }
        });





    </script>
    <!-- script subir imagenes normal-->
    <script>
        //traer solo una vista previa

        // document.getElementById('inputModificado').addEventListener("change", function () {
        //     let archivo = this.files.length > 0 ? Array.from(this.files).map(file => file.name).join(" + ") : "Ningun archivo seleccionado";
        //     $inputfalso = document.querySelector(".inputFalso");
        //     $inputfalso.textContent = archivo;
        // });

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

        // document.getElementById('inputModificado').addEventListener('change', function (event) {
        //     let filas = event.target.files;

        //     let limpiarPrev = document.getElementById('vistaPrevia');
        //     limpiarPrev.innerHTML = "";

        //     let urls = [];

        //     for (let i = 0; i < filas.length; i++) {
        //         let url = URL.createObjectURL(filas[i]);
        //         urls.push(url);

        //         let crearImg = document.createElement("img");
        //         crearImg.src = url;
        //         crearImg.style.width = '100px';
        //         crearImg.style.margin = '5px';
        //         crearImg.style.border = 'solid';
        //         limpiarPrev.appendChild(crearImg);
        //     }
        //     console.log(urls);
        // });

        function volver() {
            window.location.href = "/app_duv/";
        }
    </script>
</body>

</html>