
<!DOCTYPE html>
<html lang="es">

<head>
<?php
    include_once '../headers.php';
?>
    <style>
        .text-justify {
            text-align: justify;
        }

        .modal-backdrop.show:nth-of-type(2) {
            z-index: 1055;
        }

        .modal:nth-of-type(2) {
            z-index: 1060;
        }
    </style>

</head>

<body>
    <?php
    //filtrar url para sacar id de drive
    $arrayId = [];
    $contador = 0;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (empty($_POST['inputName[]'])) {

        } else {


            foreach ($_POST['inputId'] as $campoId) {

                foreach ($_POST['inputName'] as $campoName) {
                    $contador++;

                    $arrayId[] = ["id" => $campoId, "nombre" => $campoName];
                }
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
        $path = "../uploads/";

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
                                    window.location.href = '/';
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


        $rutaGuardado = "../uploads/" . $name;

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
                window.location.href = '/';
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
    <div class="row">
            <div class=" bg-dark ">
                <div class="d-flex  flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                    <a href="/pages/settings" class="d-block p-3 text-white text-decoration-none" title=""
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                        <i class="bi bi-c-circle fs-1"></i>
                    </a>
                    <ul class="nav flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                        <li class="nav-item">
                            <a href="#" onclick="history.go(-1)" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Home">
                                <i class="bi-arrow-left fs-3"></i>
                            </a>
                        </li>

                    </ul>
                    <div class="dropdown">
                        <a href="#"
                            class="d-flex text-white align-items-center justify-content-center p-3  text-decoration-none dropdown-toggle"
                            id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-person-circle h2"></i>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">

                            <li><a class="dropdown-item" href="/pages/settings">Configuración</a></li>
                            <li><a class="dropdown-item" href="/">Inicio</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <form action="/pages/subirImagenes" method="post" enctype="multipart/form-data">
        <div class="w-50" style="margin: 0 auto;">
            <div class="d-flex flex-column" id="agregarInputs">
                <div class="input-group">
                    <input type="text" class="form-control " placeholder="URL imagen" name="inputId[]">
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
    <div class="bottomScroll d-flex justify-content-center align-items-center mt-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Nombres imagenes
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title" id="tituloModalPermisoUsuario"><strong>Titulos</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body py-2">
                        <div id="botones-usuario" class="d-flex justify-content-between mb-3"></div>
                        <table id="tablaXUsuario" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <!--cabecera-->
                                <tr class="text-center" id="headTablePersonArea">
                                    <td class="bg-secondary text-white">
                                        PRINCIPAL
                                    </td>
                                    <td class="bg-secondary text-white">
                                        LOGIN
                                    </td>
                                    <td class="bg-secondary text-white">
                                        REGISTRO
                                    </td>
                                    <td class="bg-secondary text-white">
                                        NOTICIAS
                                    </td>
                                    <td class="bg-secondary text-white">
                                        BLOG
                                    </td>
                                </tr>
                            </thead>
                            <tbody id="contenidoTablaPermisoUsuario">
                                <tr>
                                    <td>
                                        imagenPrincipal.png
                                    </td>
                                    <td>
                                        draw1.svg
                                    </td>
                                    <td>
                                        draw2.svg
                                    </td>
                                    <td>
                                        news1.png
                                    </td>
                                    <td>
                                        video.mp4
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        segundaInicio.png
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        desc-nws-1.png
                                    </td>
                                    <td>
                                        #-img-blg
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        terceraInicio.png
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        desc-nws-2.png
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        imagen-li-#
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <!--anotaciones-->
                        <h5>Notas</h5>
                        
                        
                        <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModall">
                            Imagen-li-#
                        </button>
                        <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModalN">
                            Noticias page
                        </button>
                        <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModalB">
                            #-img-blg
                        </button>
                       
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabell"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabell">imagen-li-#</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <p class="text-justify">
                                El simbolo <strong>"#"</strong> representa un número, pero para no poner
                                imagen-li-1,
                                imagen-li-2, se pone imagen-li-#
                                para hacer referencia a que es un número que el usuario decide.
                                Las imagenes del campo de ofertas estan nombradas por numero,
                                del 1 hasta el número que la persona agregue de imagenes.

                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--noticias-->

        <div class="d-flex justify-content-center align-items-center">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalN" tabindex="-1" aria-labelledby="exampleModalLabelN"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabelN">Noticias page</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <p class="text-justify">
                                En la ventana de noticias antes de las NOTICIAS IMPORTANTES las imagenes son fijas
                                no modificables.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- blog-->

        <div class="d-flex justify-content-center align-items-center">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalB" tabindex="-1" aria-labelledby="exampleModalLabelB"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabelB">#-img-blg</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <p class="text-justify">
                            El simbolo <strong>"#"</strong> representa un número, pero para no poner
                                1-img-blg,
                                2-img-blg, se pone #-img-blg, estas imagenes tienen un limite de 6, solo se pueden agregar 6.
                                
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

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
            window.location.href = "/";
        }
    </script>
</body>

</html>