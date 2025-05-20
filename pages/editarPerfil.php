<?php
session_start();
include_once '../config.php';

?>

<!DOCTYPE html>
<html lang="es">
<?php
include_once '../headers.php';
?>
<link rel="stylesheet" href="../styles.css">

<head>

    <style>
        :root {
            --font-size: clamp(0.8rem, 2.5vw, 1.5rem);
        }

        #dropzone {
            margin: 0 auto;
            /* Centra horizontalmente */
            display: block;
            /* Asegura que el elemento se comporte como un bloque */
            max-width: 400px;
            /* Ajusta el ancho máximo */
            border: 2px dashed #ccc;
            /* Opcional: estilo del borde */
            padding: 20px;
            /* Espaciado interno */
            text-align: center;
            /* Centra el texto dentro del Dropzone */
            background-color: #f9f9f9;
            /* Fondo opcional */
            border-radius: 10px;
            /* Bordes redondeados */
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <!--nav-->
        <div class="row">
            <div class="d-flex  flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                <a href="<?php echo $RUTA_PAGES ?>perfilPersona" class="d-block p-3 text-white text-decoration-none"
                    title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                    <i class="bi bi-c-circle fs-1"></i>
                </a>
                <ul class="nav flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                    <li class="nav-item">
                        <a href="#" onclick="history.go(-1);" class="nav-link py-3 px-2" title=""
                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
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

                        <li><a class="dropdown-item" style="font-size: var(--font-size);"
                                href="<?php echo $RUTA_PAGES ?>settings">Configuración</a></li>
                        <li><a class="dropdown-item" style="font-size: var(--font-size);"
                                href="<?php echo $BASE_URL ?>">Inicio</a></li>
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
                        <div class="clearfix"></div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-secondary btn-sm " onclick="limpiarDrop()"><i class="fas fa-broom" ></i></button>

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
            <h2 style="font-size: var(--font-size); text-align: center;">Modificar Nombre</h2>

            <div class="d-flex justify-content-center">
                <input style="font-size: var(--font-size);" type="text" id="nombre" maxlength="15"
                    class="form-control text-center w-75" disabled>
                <button class="btn btn-light mx-1" style="background-color:rgb(209, 208, 208);" id="modInput"
                    onclick="modificarInput();"><i class="bi bi-pen"></i></button>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-success w-50 mt-2 " style="font-size: var(--font-size);"
                    onclick="modificarNombre();">Guardar</button>
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
        </div>
    </div>
    <!--fin body-->



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Dropzone JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        document.getElementById('nombre').value = "<?php echo $_SESSION['user'] ?>";

        function limpiarDrop() {
            const dropzoneInstance = Dropzone.forElement("#dropzone");
            dropzoneInstance.removeAllFiles(true); // true para limpiar incluso los archivos en subida o error
        }
        function modificarInput() {
            const modInput = document.getElementById('nombre');
            modInput.removeAttribute('disabled')
        }

        Dropzone.options.dropzone = { // camelized version of the `id`
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1,
            dictMaxFilesExceeded: "Solo puedes subir un archivo",
            acceptedFiles: "image/*",
            maxFilesize: 2, // MB
            thumbnailWidth: 90,
            autoProcessQueue: false,
            dictDefaultMessage: "<p style='font-size: clamp(0.8rem, 2.5vw, 1.5rem);''><strong>Foto de perfil</strong>. <br> Arrastra tu archivo aquí o haz clic para seleccionar</p>",
            accept: function (file, done) {
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: `Desea subir el archivo: ${file.name}`,
                    showCancelButton: true,
                    confirmButtonText: 'Subir',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        done();
                        this.processQueue();
                    } else {
                        this.removeAllFiles();
                    }
                })

            },
            success: function (file) {
                enviarImg(file.dataURL);
            }
        };

        function enviarImg(img) {
            console.log(img);
            fetch('<?php echo $BASE_URL ?>api/act-img', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ image: img })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error en la respuesta del servidor: ${response.status}`);
                    }
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Listo',
                            text: 'Imagen de perfil actualizada'
                        }).then((result) => {
                            if (result.isConfirmed) {
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

        function modificarNombre() {
            const nombre = document.getElementById('nombre').value;
            const userA = '<?php echo $_SESSION['user'] ?>';
            fetch(`<?php echo $BASE_URL ?>api/change-name?user=${nombre}&userA=${userA}`, {
                method: 'get',
                header: {
                    "Content-Type": "application/json"
                },

            })
                .then(result => {
                    if (result.status !== 200) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'No se pudo cambiar el nombre, inténtelo de nuevo'
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Listo',
                            text: 'Nombre cambiado correctamente'
                        })
                    }
                    return result.json()
                })
                .then(data => {
                    console.log(data)
                })
        }


    </script>

</body>

</html>