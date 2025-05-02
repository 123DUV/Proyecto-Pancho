<?php
session_start();

include_once '../config.php';

$con = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASS, $DB_NAME);

if (!$con) {
    die("fallo" . mysqli_connect_error());
}
$imgDefectoPerfil = "../uploads./imgsDefecto./imgPerfilDefecto.jpg";
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
    <?php
    include_once '../headers.php';
    ?>
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
    <!-- pa subir a gitt-->
    <div class="container-fluid">
        <div class="row">
            <div class=" bg-dark ">
                <div class="d-flex  flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                    <a href="/pages/perfilPersona" class="d-block p-3 text-white text-decoration-none" title=""
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


        <div class="text-center ">
            <label for="inputModificado" class="inputFalso">
                <img src="<?php if (empty($imgExtraida)) {
                    echo $imgDefectoPerfil;
                } else {
                    echo $imgExtraida;
                } ?>" class="img-fluid" alt="imagen">
            </label>
            <input type="file" accept="image/*" multiple="true" name="image" class="" id="inputModificado" disabled>
            <div class="text-center mt-2 mb-2">
                <h2>¡Hola, <?php echo $user ?>!</h2>
            </div>
            <div class="text-center">

                <div id="botonEditarPerfil">

                </div>

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




        <script>
            const loged = <?php
            $logeado = $logeado ?? false; echo json_encode($logeado);?>;
            if (loged) {
                editarPerfilBoton();
            }
            function editarPerfilBoton() {
                document.getElementById('botonEditarPerfil').innerHTML = "<button id='botonCrop' class='btn btn-lg border-bottom mt-2 mx-2' onclick='irEditarPerfil();'>Editar foto perfil</button>"
            }
            function irEditarPerfil() {
                window.location.href = "/pages/editarPerfil";
            }
            function irLogin() {
                window.location.href = "/pages/login";
            }
            function volver() {
                window.location.href = "/";
            }
            document.addEventListener('DOMContentLoaded', function () {
                const image = document.getElementById("");
            })

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
            function cerrarSesion() {
                fetch('<?php echo $BASE_URL;?>api.php/logout', {
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