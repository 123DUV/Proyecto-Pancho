<?php
session_start();
include_once '../config.php';

?>

<!DOCTYPE html>
<html lang="es">
<?php include_once '../headers.php' ; ?>
    <link rel="stylesheet" href="../styles.css">

    <head>

        <style>
            a:hover {
                background-color: lightgray;
            }
        </style>
    </head>

    <body>
        <div class="d-fixed top-0">
            <button class="btn btn-lg btn-light m-md-5  m-3"><i class="bi bi-arrow-left"
                    onclick="history.go(-1);"></i></button>
        </div>
        <div class="container-fluid w-75">
            <div class="row d-flex flex-column justify-content-center align-items-center mt-3 rounded"
                style=" font-size: clamp(0.8rem, 2.5vw, 1.5rem);">

                
                <a href="<?php echo $RUTA_PAGES ?>editarPerfil" class="btn btn-light rounded mt-1">Editar Perfil</a>
                <a href="<?php echo $RUTA_PAGES ?>cambiarContra" class="btn btn-light rounded mt-1">Cambiar contraseña</a>
                <a href="#" class="btn btn-light rounded mt-1" onclick="cerrarSesion();">Cerrar sesión</a>
            </div>
        </div>
        <div class="row">
            <h2 class="text-center mt-5">Coming soon...</h2>

        </div>
        <div class="d-flex justify-content-between">

            <img src="<?php echo $BASE_URL ?>uploads/gifs/horse.gif" class="img-responsive" width="50%" height="auto"
                alt="Gif caballo corriendo">

            <img src="<?php echo $BASE_URL ?>uploads/gifs/rain.gif" class="img-responsive" width="50%" height="auto"
                alt="Gif lloviendo">

        </div>
        <script>

            function cerrarSesion() {
                fetch(`<?php echo $BASE_URL ?>api/logout`, {
                    method: 'GET',
                    header: { "Content-Type": "application/json" }
                })
                    .then(result => {
                        if (result.ok) {

                            window.location.href = '<?php echo $BASE_URL ?>'
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error cerrando sesión'
                            })
                        }
                        result.json()
                    })
                    .then(data => console.log(data))
                    .catch(error => console.log(error))
            }

        </script>
    </body>

</html>