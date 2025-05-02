<?php
include_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar perfil</title>
    <link rel="shortcut icon" type="image/svg+xml" href="/app_duv/favicon.svg">

    <!--fuente-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <!--bootstrap y sweetalert-->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--video play-->
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- NProgress -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">

    <!-- Dropzone.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">




</head>

<body>

    <div class="container-fluid">
        <!--nav-->
        <div class="row">
            <div class="d-flex  flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                <a href="/app_duv/pages/perfilPersona" class="d-block p-3 text-white text-decoration-none" title=""
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                    <i class="bi bi-c-circle fs-1"></i>
                </a>
                <ul class="nav flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                    <li class="nav-item">
                        <a href="#" onclick="history.go(-1);" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
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

                        <li><a class="dropdown-item" href="/app_duv/pages/settings">Configuración</a></li>
                        <li><a class="dropdown-item" href="/app_duv/">Inicio</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--fin nav-->
        <!--body-->

        <div class="row mt-5">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title d-flex justify-content-center " style="text-align-last: center;">

                        <button class="btn btn-secondary" onclick="limpiarDrop();"><i class="fas fa-broom"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content mt-2">
                        <form action="editarPerfil.php" id="dropzone" class="dropzone"></form>
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="">
                <h2>Modificar Nombre</h2>
                <input type="text" min="3" maxlength="15" class="form-control">
            </div>
        </div>
    </div>
    <!--fin body-->



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Dropzone JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.dropzone = { // camelized version of the `id`
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1,
            dictMaxFilesExceeded: "Solo puedes subir un archivo",
            maxFilesize: 2, // MB
            thumbnailWidth: 70,
            accept: function (file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                }
                else { done(); }
            },
            dictDefaultMessage: "<strong>Foto de perfil</strong>. <br> Arrastra tu archivo aquí o haz clic para seleccionar",
            success: function (file) {
                enviarImg(file.dataURL);
            }
        };

        function enviarImg(img) {
            console.log(img);
            fetch('<?php echo $BASE_URL?>api.php/act-img', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({image: img})
            })
                .then(response => {
                    if (!response.ok) {
                throw new Error(`Error en la respuesta del servidor: ${response.status}`);
            }
            if(response.ok){
                Swal.fire({
                    icon: 'success',
                    title: 'Listo',
                    text: 'Imagen de perfil actualizada'
                }).then((result)=>{
                    if(result.isConfirmed){
                        location.reload()
                    }
                })
            }
                   return response.json();
                })
                .then(data => {
                    console.log(data)
                })
                .catch(error => {
                    console.log(error)
                })
        }


        function limpiarDrop() {
            Dropzone.forElement("#dropzone").removeAllFiles(false);
        }

    </script>

</body>

</html>