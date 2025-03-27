<?php
session_start();
// $hostname = 'sql10.freesqldatabase.com';
// $username = 'sql10768775';
// $password = 'C5sPIR9Bbv';
// $dbname = 'sql10768775';
// $tablaPrincipal = 'datos';
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'app-duv';
$tablaPrincipal = 'datos';


$con = mysqli_connect($hostname, $username, $password, $dbname);
if (!$con) {
    die("fallo" . mysqli_connect_error());
}
$imgDefectoPerfil = "./uploads./imgsDefecto./imgPerfilDefecto.jpg";
$user;
$imgExtraida;
$estadoCeIn;

if (isset($_SESSION['user'])) {
    $logeado = true;
    $user = $_SESSION['user'];
    $estadoCeIn = "Cerrar sesión";
} else {
    $logeado = false;
    $user = "Usuario";
    $estadoCeIn = "Iniciar sesión";
}

if ($logeado) {
    $stmt = $con->prepare("SELECT imgPerfil FROM datos WHERE nameUser = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $extraerImg = $resultado->fetch_assoc();
    $imgExtraida = $extraerImg['imgPerfil'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="shortcut icon" type="image/svg+xml" href="/app_duv/favicon.svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/cropperjs"></script>
    <style>
        input[type="file"] {
            display: none;
        }

        .inputFalso {
            background-color: white;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            cursor: pointer;
            color: black;
            margin-top: 15%;
        }

        .inputFalso img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        .inputFalso:hover {
            background-color: rgb(231, 231, 231);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class=" bg-dark ">
                <div
                    class="d-flex  flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                    <a href="/app_duv/perfilPersona" class="d-block p-3 text-white text-decoration-none" title="" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-original-title="Icon-only">
                        <i class="bi bi-c-circle fs-1"></i>
                    </a>
                    <ul
                        class="nav flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                        <li class="nav-item">
                            <a href="/app_duv/" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Home">
                                <i class="bi-house fs-3"></i>
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
                           
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="/app_duv/">Inicio</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form action="">
            <div class="text-center ">
                <label for="inputModificado" class="inputFalso ">
                    <img src="<?php if (empty($imgExtraida)) {
                        echo $imgDefectoPerfil;
                    } else {
                        echo $imgExtraida;
                    } ?>" class="img-fluid" alt="imagen">
                </label>
                <input type="file" accept="image/*" multiple="true" name="image" class="" id="inputModificado" required>
                <div class="text-center mt-2 mb-2">
                    <h2>¡Hola, <?php echo $user ?>!</h2>
                </div>
                <div class="text-center">
                    <button id="botonCrop" class="btn btn-lg border-bottom mt-2 mx-2">Editar foto perfil</button>
                    <button id="botonCeIn" class="btn btn-lg btn-danger mt-2" onclick="<?php

                    if ($logeado === true) {
                        echo "cerrarSesion()";
                    } else {
                        echo "irLogin()";
                    } ?>"> <?php echo $estadoCeIn; ?></button>
                    <!-- <canvas id="previewCanvas"></canvas>  -->
                </div>
                <div id="vistaPrevia">
                </div>
            </div>


        </form>

        <script>
            
            function irLogin() {
                window.location.href = "/app_duv/login";
            }
            function volver() {
                window.location.href = "/app_duv/";
            }
            document.addEventListener('DOMContentLoaded', function () {
                const image = document.getElementById("");
            })

            document.getElementById('inputModificado').addEventListener('change', function (event) {
                let filas = event.target.files;

                let limpiarPrev = document.getElementById('vistaPrevia');
                limpiarPrev.innerHTML = "";

                let urls = [];

                for (let i = 0; i < filas.length; i++) {
                    let url = URL.createObjectURL(filas[i]);
                    urls.push(url);

                    let crearImg = document.createElement("img");
                    crearImg.src = url;
                    crearImg.style.width = '100px';
                    crearImg.style.margin = '5px';
                    crearImg.style.border = 'solid';
                    limpiarPrev.appendChild(crearImg);
                }
                console.log(urls);
            });
            function cerrarSesion() {
                fetch(`http://localhost/app_duv/api.php/logout`, {
                    method: 'GET',
                    header: { "Content-Type": "application/json" }
                })
                    .then(result => {
                        if (result.ok) {

                            window.location.href = '/app_duv/'
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