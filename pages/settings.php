<?php
session_start();
include_once '../config.php';

?>

<!DOCTYPE html>
<html lang="en">
<?php
    include_once '../headers.php';
?>
<head>
 
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