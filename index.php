<?php
$lifetime = 60 * 60 * 24 * 30;
session_set_cookie_params($lifetime);
ini_set("session.gc_maxlifetime", $lifetime);
ini_set("session.cookie_lifetime", $lifetime);
session_start();

include_once 'config.php';
include_once './headers.php';

$con = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASS, $DB_NAME);

if (!$con) {
    die("fallo" . mysqli_connect_error());
}
$imgDefectoPerfil = "./uploads./imgsDefecto./imgPerfilDefecto.jpg";
$imgExtraida;
$user;
$mostrarSubir = false;
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if ($_SESSION['user'] === "admin") {
    $mostrarSubir = true;
} else {
    $mostrarSubir = false;
}

if ($_SESSION['user'] === "admin") {
    $admin = true;
} else if ($_SESSION['user'] === "") {
    $admin = false;
}

if (isset($_SESSION['user'])) {
    $logedIn = true;
    $user = $_SESSION['user'];
} else {
    $logedIn = false;
}
if ($logedIn) {
    $stmt = $con->prepare("SELECT imgPerfil FROM datos WHERE nameUser = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $extraerImg = $resultado->fetch_assoc();
    $imgExtraida = $extraerImg['imgPerfil'];
}

$nameGlobal = $_SESSION['user'];
$saludo;
$hora;
date_default_timezone_set("America/Bogota");
$fecha = date('Y-m-d H:i:s');
$fechaComparacion = date('Y-m-d 12:00:00');

if (empty($nameGlobal) || $nameGlobal === null) {
    if ($fecha < $fechaComparacion) {
        $saludo = 'Buen dia';
        $hora = 'Buen dia';
    } else {
        $saludo = 'Buena tarde';
        $hora = 'Buena tarde';
    }
} else {
    $saludo = 'Bienvenido/a ' . $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html lang="es">


<head>
    <link rel="stylesheet" href="./styles.css">

    <style>
    body {
        position: relative;
    }

    .goup {
        background: rgb(221, 221, 221);
        bottom: 0px;
        display: block;
        height: 50px;
        position: fixed;
        right: 0px;
        width: 50px;
    }

    .full-lados {
        margin: 0 !important;
        padding: 0 !important;
        width: 100vw !important;
        display: block;
    }

    .gradient {
        background: #FFFFFF;
        background: linear-gradient(0deg, rgba(255, 255, 255, 1) 85%, rgba(142, 227, 250, 1) 100%);
    }

    .gradient-nav {
        background: rgb(210, 247, 255);
        background: linear-gradient(0deg, rgba(210, 247, 255, 1) 25%, rgba(113, 224, 254, 1) 100%);
    }

    .gradient-arriba {
        background: #8EE3FA;
        background: linear-gradient(0deg, rgba(142, 227, 250, 1) 59%, rgba(255, 255, 255, 1) 88%);
    }

    .shadow {
        box-shadow: rgba(27, 31, 35, 0.04) 0px 1px 0px, rgba(255, 255, 255, 0.25) 0px 1px 0px inset;
    }

    .contenedor-lightbox {
        max-width: 800px;
        margin: 5% auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-sizing: border-box;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.4);
    }

    .text-centerr {
        text-align: center;
        margin-bottom: 1em;
    }

    /* Color of the links BEFORE scroll */
    .navbar-scroll .nav-link,
    .navbar-scroll .navbar-toggler-icon,
    .navbar-scroll .navbar-brand {
        color: #262626;
    }

    /* Color of the navbar BEFORE scroll */
    .navbar-scroll {
        background-color: rgb(252, 252, 252);
    }

    /* Color of the links AFTER scroll */
    .navbar-scrolled .nav-link,
    .navbar-scrolled .navbar-toggler-icon,
    .navbar-scroll .navbar-brand {
        color: #262626;
    }

    /* Color of the navbar AFTER scroll */
    .navbar-scrolled {
        background-color: #fff;
    }

    /* An optional height of the navbar AFTER scroll */
    .navbar.navbar-scroll.navbar-scrolled {
        padding-top: auto;
        padding-bottom: auto;
    }

    .navbar-brand {
        font-size: unset;
        height: 3.5rem;
    }

    /* lightbox */

    .lightbox-gallery {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }

    .lightbox-gallery div>img {
        max-width: 100%;
        display: block;
    }

    .lightbox-gallery div {
        margin: 10px;
        flex-basis: 180px;
    }

    @media only screen and (max-width: 480px) {
        .lightbox-gallery {
            flex-direction: column;
            align-items: center;
        }

        .lightbox>div {
            margin-bottom: 10px;
        }
    }

    /*Lighbox CSS*/

    .lightbox {
        display: none;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 20;

        justify-content: center;
        align-items: center;
        padding-top: 30px;
        box-sizing: border-box;
    }

    .lightbox img {
        max-width: 80%;
        max-height: 80%;
        display: block;
        margin: auto;
        border-radius: 10px;
    }

    .lightbox .caption {
        margin: 15px auto;
        text-align: center;
        font-size: 1em;
        line-height: 1.5;
        font-weight: 700;
        color: #eee;
    }

    .icono-perfil {
        width: 30px;
        height: 30px;
        object-fit: cover;
        border-radius: 50%;
        /* Hace la imagen redonda */
    }

    @media (max-width: 1350px) {
        .navbar-expand-xl .navbar-collapse {
            display: none !important;
        }

        .navbar-expand-xl .navbar-toggler {
            display: block !important;
        }
    }
    </style>

</head>

<body class="gradient" style=" color: var(--body-color);">

    <script>
    var logedIn = <?php echo json_encode($logedIn); ?>;
    var jefe = <?php echo json_encode($admin); ?>;
    </script>
    <div class="container-fluid ">
        <button class="goup btn btn-light"><i class="bi bi-arrow-up"></i></button>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-xl navbar-scroll shadow-0 rounded gradient-nav">
            <div class="container" id="top">
                <div class="d-flex justify-content-center align-items-center">
                    <i class="bi bi-cart3 fs-3" id="irArriba"></i>
                    <p class="m-3" style="font-family: var(--fuente);color: black; font-size: clamp(0.8rem, 2.5vw, 1.5rem);"><?php echo $saludo ?>
                    </p>
                </div>
                <a class="navbar-brand" href="#!"></a>
                <button class="navbar-toggler  border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">

                    <img src="<?php if (empty($imgExtraida)) {
                        echo $imgDefectoPerfil;
                    } else {
                        echo $imgExtraida;
                    } ?>" class="img-fluid icono-perfil" width="100%" height="auto" alt="imagen">
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <div id="inicioSesion">
                                <a class="nav-link text-nowrap" style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);"
                                    id="hide" href="<?php echo $RUTA_PAGES ?>login">Iniciar sesión</a>
                            </div>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded " id="closeR" href="<?php echo $RUTA_PAGES ?>registro"
                                style="font-family: var(--fuente); font-size: clamp(0.8rem, 2.5vw, 1.5rem);" class="text-center ">Registrate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);"
                                href="<?php echo $RUTA_PAGES ?>blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);"
                                href="<?php echo $BASE_URL ?>#oferts">Ofertas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);"
                                href="<?php echo $BASE_URL ?>#contact">Contactame</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);"
                                href="<?php echo $RUTA_PAGES ?>news">Noticias</a>
                        </li>

                        <li class="nav-item <?php echo $mostrarSubir ? '' : 'd-none'; ?>">

                            <a class="nav-link" style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);"
                                href="<?php echo $RUTA_PAGES ?>subirImagenes">subirImagenes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);"
                                href="<?php echo $RUTA_PAGES ?>perfilPersona">Perfil</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="closeS" style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);"
                                class="btn btn-light text-nowrap" onclick="cerrarSesion();">Cerrar sesión</a>
                        </li>








                    </ul>
                </div>
            </div>
        </nav>
        <!-- Fin Navbar -->
        <div class="row d-flex ">
            <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center text-center"
                style="margin-top: 5%; margin-bottom: 5%;">
                <h4 style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Controlcoser</h4>
                <p style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Adquiere o repara tu
                    maquina de coser</p>
                <!-- <img src="./uploads/imagenPrincipal.png" loading="lazy" alt="imagen-principal" class="rounded"
                width="100%"> -->
            </div>


            <div class="col-md-6 col-sm-12 d-flex justify-content-center">

                <img src="./uploads/imagenPrincipal.png" alt="imagen-principal" class="rounded" width="100%">
            </div>
        </div>
        <div class="row d-flex text-center pt-5 " style="font-family: var(--fuente);">
            <div class="col-md-4 align-self-center block">
                <i class="bi bi-facebook " style="color: #3b5998; font-size: 10vw;"
                    onclick="window.location.href='https://www.facebook.com/controlcoser/'"></i>
                <p><a href="https://www.facebook.com/controlcoser/"
                        style="text-decoration: none; color:inherit;font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Facebook</a>
                </p>
            </div>
            <div class="col-md-4 align-self-start block">
                <i class="bi bi-whatsapp " style="color:#25d366; font-size: 10vw; text-decoration: inherit"
                    onclick="window.location.href='https://wa.me/3128616610?text=Hola, quiero solicitar má información acerca de tus servicios'"></i>
                <p><a href='https://wa.me/3128616610?text=Hola, quiero solicitar más información acerca de tus servicios'
                        style="text-decoration: none; color:inherit;font-size: clamp(0.8rem, 2.5vw, 1.5rem);">WhatsApp</a>
                </p>
            </div>
            <div class="col-md-4 align-self-center block">
                <i class="bi bi-instagram " style="color: #e1308c; font-size: 10vw;"
                    onclick="window.location.href='https://www.instagram.com/controlcoser?igsh=YzljYTk10Dg3Zg=='"></i>
                <p><a href="https://www.instagram.com/controlcoser?igsh=YzljYTk10Dg3Zg=="
                        style="text-decoration: none; color:inherit;font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Instagram</a>
                </p>
            </div>
        </div>
        <div class="row inline-block reverse-order pt-5 ">
            <div class="col-md-6 col-sm-12 d-flex justify-content-center ">
                <img src="./uploads/segundaInicio.png" alt="segunda-imagen-principal" class="rounded" width="100%">
            </div>
            <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center text-center"
                style="margin-top: 5%; margin-bottom: 5%;">
                <h4 style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Calidad precio</h4>
                <p style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Maquinas que tienen una
                    calidad y precio justo</p>

            </div>



        </div>
        <div class="row  pt-5 " id="oferts">
            <div class="contenedor-lightbox gradient-arriba ">
                <h2 class="text-center" style="font-family: var(--fuente);font-size: clamp(0.8rem, 2.5vw, 1.5rem);">
                    Próximamente</h2>
                <div class="<?php if ($mostrarSubir) {
                    echo "d-block  flex-row justify-content-end ";
                } else {
                    echo "d-none ";
                } ?>" id="btnLight">
                    <button class="btn" style="background-color: #01E7F9;" id="btnAdd">+</button>

                    <button class="btn " onclick="eliminarCajas();" id="delete"
                        style="background-color:rgb(253, 67, 67);">-</button>

                    <button class="btn" id="save"
                        style="background-color: #25d366;font-size: clamp(0.8rem, 2.5vw, 1.5rem);" onclick="">
                        Guardar
                    </button>

                </div>
                <div class="lightbox-gallery" id="cajaLight">

                </div>

            </div>
        </div>
        <!--modal texto imagenes-->
        <div class="modal fade" tabindex="-1" id="modalText" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Título del modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" id="inputAlt" placeholder="Escriba aquí">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" id="guardarAlt" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <div class="row  pt-5" style="background-color:#1F3A52;color:#EEEEEE;" id="contact">
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-telephone fs-5"></i>
                <button class="btn" data-clipboard-text="3128616610"><i class="bi bi-copy"
                        style="color:#EEEEEE"></i></button>

                <p style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);">3128616610
                </p>

            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-envelope-at fs-5"></i>
                <button class="btn" data-clipboard-text="bedoyafabio4@gmail.com"><i class="bi bi-copy"
                        style="color:#EEEEEE"></i></button>

                <p><a href="https://mail.google.com/mail/?view=cm&fs=1&to=bedoyafabio4@gmail.com&su=<?php echo $hora ?>&body="
                        style="text-decoration: none; color:inherit;font-size: clamp(0.8rem, 2.5vw, 1.5rem);">bedoyafabio4@gmail.com</a>
                </p>
            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-geo-alt fs-5"></i>
                <button class="btn"
                    data-clipboard-text="ZONA FRANCA INTERNACIONAL DE PEREIRA USUARIO OPERADOR, PEREIRA, RISARALDA"><i
                        class="bi bi-copy" style="color:#EEEEEE"></i></button>
                <p><a href="https://www.google.com/maps?q=ZONA%20FRANCA%20INTERNACIONAL%20DE%20PEREIRA%20USUARIO%20OPERADOR,%20PEREIRA,%20Risaralda"
                        style="text-decoration: none; color:inherit;font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Dirección
                        Controlcoser</a>

                </p>
            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-calendar fs-5"></i>
                <p style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Horario</p>

                <ul class="text-center " style="list-style-type: none; padding-left: 0!important;">
                    <li style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);">
                        Lunes-Sabado: 8 am - 4 pm
                    </li>
                    <li style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);">
                        Domingo: 8 am - 2pm
                    </li>
                    <p> *<span style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);"> Los horarios pueden variar</span></p>
                </ul>

            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-whatsapp mx-2"
                    onclick="window.location.href='https://wa.me/3128616610?text=Hola, quiero solicitar más información acerca de tus servicios'"></i>
                <i class="bi bi-facebook mx-2" onclick="window.location.href='https://www.facebook.com'"></i>
                <i class="bi bi-instagram mx-2" onclick="window.location.href='https://www.instagram.com'"></i>
            </div>
            <div data-mdb-input-init class="form-outline">

                <div class="nombreArea" id="nombreAreaDiv">
                    <input type="text" style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);"  id="nombreArea" name="nombreArea" max="20" class="form-control"
                        placeholder="Tu nombre">
                </div>
                <textarea class="form-control mt-1" id="comentarios" placeholder="Escribe tu petición o sugerencia" rows="4"
                    maxlength="500" name="comentarios" style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);"></textarea>
                <button id="comentariosBtn" style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);"
                    class="btn btn-success mt-1" onclick="<?php if ($logedIn) {
                    echo "comments();";
                } else {
                    echo "comment_w_login();";
                } ?>">Enviar</button>
            </div>

            <div class="text-center mt-5" style="font-family: var(--fuente);">
                <i class="bi bi-c-circle fs-5"></i>
                <span style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);"> 2025 Name company all rights reserved</span>
            </div>

        </div>
        <!--fin footer-->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <base href="/">
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (logedIn) {
            document.getElementById('nombreAreaDiv').style.display = "none";
        } else {
            document.getElementById('nombreAreaDiv').style.display = "block";
        }
    })

    function comments() {
        if (logedIn) {
            sendComments();
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'Necesitas estar logeado para enviar un comentario'
            })
        }
    }

    function comment_w_login() {
        const comentarios = document.getElementById('comentarios').value;
        const nombre = document.getElementById('nombreArea').value;
        const btnComments = document.getElementById('comentariosBtn');
        console.log(nombre)
        if (comentarios.trim() === '') {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'Campo comentarios vacío'
            })
        } else if (nombre === '') {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'Campo nombre vacío'
            })
        } else {
            var data = {
                nameUser: nombre,
                comentarios: comentarios
            }
            fetch(`<?php echo $BASE_URL ?>api/comment-w-login`, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                })
                .then(result => {
                    if (result.ok) {
                        Toastify({
                            text: 'Enviado',
                            duration: '3000',
                            close: true,
                            gravity: 'bottom',
                            position: 'center',
                            style: {
                                color: "#333333",
                                background: "#6BCB77",
                            }
                        }).showToast();
                        btnComments.setAttribute('disabled', 'disabled');
                        return result.json();
                    } else if (result.status === 400) {
                        Swal.fire({
                            icon: "info",
                            title: "Info",
                            text: "Hubo un error en el registro, intenta de nuevo"
                        })
                    } else if (result.status === 404) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'No hay nada en el campo de comentarios'
                        })
                    }
                })
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }

    function sendComments() {
        const comentarios = document.getElementById('comentarios').value;
        const btnComments = document.getElementById('comentariosBtn');

        if (comentarios === '') {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'No hay nada en la bandeja de comentarios'
            })
            return;
        }
        var data = {
            nameUser: "<?php echo $_SESSION['user'] ?>",
            comentarios: comentarios
        }
        fetch(`<?php echo $BASE_URL ?>api/insert-comment`, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })
            .then(result => {
                if (result.ok) {
                    Toastify({
                        text: 'Enviado',
                        duration: 3000,
                        close: true,
                        gravity: 'bottom',
                        position: 'center',
                        style: {
                            color: "#333333",
                            background: "#6BCB77",
                        }
                    }).showToast();
                    btnComments.setAttribute('disabled', 'disabled');
                    return result.json();

                } else if (result.status === 400) {
                    Swal.fire({
                        icon: "info",
                        title: "Info",
                        text: "Hubo un error en el registro, intenta de nuevo"
                    })
                } else if (result.status === 404) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'No hay nada en el campo de comentarios'
                    })
                }
            })
            .then(data => {
                console.log(data)

            })
            .catch(error => console.error("Error:", error))
    }

    function eliminarCajas() {

        fetch(`<?php echo $BASE_URL ?>api/no-cajas`, {
                headers: {
                    "Content-Type": "application/json"
                },
                method: "get"
            })
            .then(result => {

                return result.json()
            })
            .then(data => {
                console.log(data);
            })
        const cajitas = document.getElementById("cajaLight");
        cajitas.innerHTML = "";
        location.reload();
    }

    let cuenta = 1;
    let contadorAlterno = 0;

    fetch(`<?php echo $BASE_URL ?>api/obtener-cajas`, {
            headers: {
                "Content-Type": "application/json"
            },
            method: "get"
        })
        .then(result => {
            return result.json()
        })
        .then(data => {

            cuenta = data.nroCajas;
            console.log(cuenta);
            console.log(data)

            while (cuenta - 1 >= 0) {
                contadorAlterno++;
                const caja = document.getElementById("cajaLight");
                const crearDivL = document.createElement("div");
                const crearImg = document.createElement("img");

                crearImg.src = `<?php echo $BASE_URL ?>uploads/imagen-${contadorAlterno}-li.png`;
                crearImg.loading = "lazy";
                crearImg.dataset.imageHd = `<?php echo $BASE_URL ?>uploads/imagen-${contadorAlterno}-li.png`;
                // crearImg.alt = `imagen-${contadorAlterno}-ofertas`;
                crearImg.id = `contador-${contadorAlterno}`;
                crearDivL.classList = `cajita `;

                if (jefe) {
                    const crearButtonMod = document.createElement("button");
                    crearButtonMod.type = "button";
                    crearButtonMod.classList = `btn btn-success botonEditText  `;
                    crearButtonMod.textContent = "Editar";
                    crearButtonMod.setAttribute("data-bs-toggle", "modal");
                    crearButtonMod.setAttribute("data-bs-target", "#modalText");

                    (function(currentIndex) {
                        crearButtonMod.onclick = function() {
                            if (currentIndex > 0) {
                                document.getElementById('guardarAlt').dataset.contadorAlterno =
                                    currentIndex;
                            }
                        };
                    })(contadorAlterno)
                    crearDivL.appendChild(crearButtonMod);
                }
                crearDivL.appendChild(crearImg);
                caja.appendChild(crearDivL);
                cuenta--;
            }
        })

    document.getElementById("guardarAlt").addEventListener('click', function() {
        let index = 0;
        console.log(this.dataset);
        index = this.dataset.contadorAlterno;
        console.log(index)
        const nuevoAlt = document.getElementById("inputAlt").value;
        const img = document.getElementById(`contador-${index}`);
        if (img) img.alt = nuevoAlt;

        const modal = bootstrap.Modal.getInstance(document.getElementById('modalText'));
        modal.hide();
    });

    function traerAlt() {

    }


    let varia = contadorAlterno + 1 ?? 1;

    var contadorClicksAdd = varia ?? 1;
    document.getElementById("btnAdd").addEventListener("click", function() {
        crearCajas(contadorClicksAdd);
        fech();
        contadorClicksAdd++;
    });

    function crearCajas(contadorClicksAdd) {
        const numeroCajas = document.querySelectorAll(".cajita");
        const arrayCajas = Array.from(numeroCajas);
        contadorClicksAdd = arrayCajas.length + 1;

        const caja = document.getElementById("cajaLight");
        const crearDivL = document.createElement("div");
        const crearImg = document.createElement("img");

        crearImg.src = `<?php echo $BASE_URL ?>uploads/imagen-${contadorClicksAdd}-li.png`;
        crearImg.loading = "lazy";
        crearImg.dataset.imageHd = `<?php echo $BASE_URL ?>uploads/imagen-${contadorClicksAdd}-li.png`;
        // crearImg.alt = `imagen-${contadorClicksAdd}-ofertas`;
        crearImg.id = `contador-${contadorAlterno}`;

        crearDivL.classList = `cajita `;

        if (jefe) {
            const crearButtonMod = document.createElement("button");
            crearButtonMod.type = "button";
            crearButtonMod.classList = `btn btn-success botonEditText `;
            crearButtonMod.textContent = "Editar";
            crearButtonMod.dataset.bsToggle = "modal";
            crearButtonMod.setAttribute("data-bs-target", "#modalText");
            // crearButtonMod.onclick = function () {
            //     modTextLight(contadorAlterno)
            // };
            crearDivL.appendChild(crearButtonMod);
        }
        crearDivL.appendChild(crearImg);
        caja.appendChild(crearDivL);
    }

    function fech() {
        fetch(`<?php echo $BASE_URL ?>api/guardar-cajas?cajas=${contadorClicksAdd + contadorAlterno}`, {
            headers: {
                "Content-Type": "application/json"
            },
            method: "get"

        })
        fetch(`<?php echo $BASE_URL ?>api/obtener-cajas`, {
                headers: {
                    "Content-Type": "application/json"
                },
                method: "get"
            })
            .then(result => {
                return result.json()
            })
            .then(data => {
                varia = data.nroCajas;

                console.log(varia);
                console.log(data)
            })
    }

    // Create a lightbox
    $(function() {

        var $lightbox = $("<div class='lightbox'></div>");
        var $img = $("<img class='rounded'>");
        var $caption = $("<p class='caption'></p>");

        // Add image and caption to lightbox
        $lightbox
            .append($img)
            .append($caption);

        // Add lightbox to document
        $('body').append($lightbox);

        $(document).on('click', '.lightbox-gallery img', function(e) {
            e.preventDefault();
            traerAlt()
            // Obtener el enlace de la imagen y la descripción
            var src = $(this).attr("data-image-hd");
            var cap = $(this).attr("alt");

            // Agregar datos al lightbox
            $img.attr('src', src);
            $caption.text(cap);

            // Mostrar el lightbox
            $lightbox.fadeIn('fast');
        });

        $lightbox.click(function() {
            $lightbox.fadeOut('fast');
        });
    }());

    document.addEventListener('DOMContentLoaded', function() {
        const clipboard = new ClipboardJS('[data-clipboard-text]');

        clipboard.on('success', function(e) {
            console.log('copiado')
            Toastify({
                text: "Copiado",
                duration: 2000,
                close: true,
                gravity: "bottom", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    color: "#333333",
                    background: "#6BCB77",
                }
            }).showToast();
        });

        clipboard.on('error', function(e) {
            console.error('Error al copiar:', e);
            alert('No se pudo copiar el texto');
        });
    });

    if (logedIn) {
        document.getElementById('inicioSesion').style.visibility = "hidden";
        document.getElementById('closeS').style.visibility = "visible";
        document.getElementById('closeR').style.visibility = "hidden";
    } else {
        document.getElementById('inicioSesion').style.display = "visible";
        document.getElementById('closeS').style.visibility = "hidden";
        document.getElementById('closeR').style.visibility = "visible";
    }

    function cerrarSesion() {
        fetch(`<?php echo $BASE_URL ?>api/logout`, {
                method: 'GET',
                header: {
                    "Content-Type": "application/json"
                }
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


    document.getElementById('irArriba').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

    function deshabilitaRetroceso() {
        window.location.hash = "no-back-button";
        window.location.hash = "Again-No-back-button" //chrome
        window.onhashchange = function() {
            window.location.hash = "";
        }
    }


    $(document).ready(function() {
        $('.goup').hide();
        $('.goup').click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, 0)
        });
        $(window).scroll(function() {
            if ($(this).scrollTop() > 200) {
                $('.goup').fadeIn();
            } else {
                $('.goup').fadeOut();
            }
        });
    });
    </script>

</body>

</html>