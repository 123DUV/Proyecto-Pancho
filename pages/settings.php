<?php
session_start();
include_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <link rel="shortcut icon" type="image/svg+xml" href="/favicon.svg">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <style>
        a:hover {
            background-color: lightgray;
        }
    </style>
</head>

<body>
    <div class="d-fixed top-0">
        <button class="btn btn-lg btn-light m-md-5  m-3"><i class="bi bi-arrow-left" onclick="history.go(-1);"></i></button>
    </div>
    <div class="container-fluid w-50">
        <div class="row d-flex flex-column justify-content-center align-items-center mt-3 rounded"
            style="background-color: #E3F5FA">

            <a href="/pages/editarPerfil" class="btn btn-light rounded">Editar Perfil</a>
            <a href="#" class="btn btn-light rounded" onclick="cerrarSesion();">Cerrar sesión</a>

        </div>
    </div>
    <div class="row">
        <h2 class="text-center mt-5">Coming soon...</h2>

    </div>
    <div class="d-flex justify-content-between">
       
            <img src="/uploads/gifs/horse.gif" class="img-responsive" width="50%" height="auto"
                alt="Gif perrito corriendo">
       
        <img src="/uploads/gifs/rain.gif" class="img-responsive" width="50%" height="auto"
        alt="Gif perrito corriendo">
        
    </div>
    <script>
        function cerrarSesion() {
            fetch(`<?php echo $BASE_URL ?>api.php/logout`, {
                method: 'GET',
                header: { "Content-Type": "application/json" }
            })
                .then(result => {
                    if (result.ok) {

                        window.location.href = '/'
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