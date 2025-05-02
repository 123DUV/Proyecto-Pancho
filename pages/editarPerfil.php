<?php
include_once '../config.php';

?>

<!DOCTYPE html>
<html lang="en">
<?php
    include_once '../headers.php';
?>
<head>
 

</head>

<body>

    <div class="container-fluid">
        <!--nav-->
        <div class="row">
            <div class="d-flex  flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                <a href="/pages/perfilPersona" class="d-block p-3 text-white text-decoration-none" title=""
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

                        <li><a class="dropdown-item" href="/pages/settings">Configuración</a></li>
                        <li><a class="dropdown-item" href="/">Inicio</a></li>
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