<?php
$lifetime = 60 * 60 * 24 * 30;
session_set_cookie_params($lifetime);
ini_set("session.gc_maxlifetime", $lifetime);
ini_set("session.cookie_lifetime", $lifetime);
session_start();

include_once 'config.php';
include_once './headers.php';

$mostrarSubir = false;
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if ($_SESSION['user'] === "admin") {
    $mostrarSubir = true;
} else {
    $mostrarSubir = false;
}

if (isset($_SESSION['user'])) {
    $logedIn = true;
} else {
    $logedIn = false;
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
<html lang="es1">

<head>

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


        :root {
            --body-bg: #FFFFFF;
            --body-color: #000000;
            --fuente: "Winky Sans", sans-serif;
        }

        .full-lados {
            margin: 0 !important;
            padding: 0 !important;
            width: 100vw !important;
            display: block;
        }

        .gradient {
            background: rgb(210, 247, 255);
            background: linear-gradient(0deg, rgba(210, 247, 255, 1) 25%, rgba(142, 227, 250, 1) 100%);
        }

        .gradient-nav {
            background: rgb(210, 247, 255);
            background: linear-gradient(0deg, rgba(210, 247, 255, 1) 25%, rgba(113, 224, 254, 1) 100%);
        }

        /* .gradient-arriba {
            background: rgb(249, 248, 246);
            background: linear-gradient(0deg, rgba(249, 248, 246, 1) 19%, rgba(65, 65, 65, 1) 95%);
        }  */

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
            padding-top: 30px;
            box-sizing: border-box;
        }

        .lightbox img {
            display: block;
            margin: auto;
        }

        .lightbox .caption {
            margin: 15px auto;
            width: 50%;
            text-align: center;
            font-size: 1em;
            line-height: 1.5;
            font-weight: 700;
            color: #eee;
        }
    </style>

</head>

<body class="gradient">
    <script>
        var logedIn = <?php echo json_encode($logedIn); ?>;
    </script>
    <div class="container-fluid ">
        <button class="goup btn btn-light"><i class="bi bi-arrow-up"></i></button>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-scroll shadow-0 rounded gradient-nav" data-mdb-navbar-init>
            <div class="container" id="top">

                <div class="d-flex justify-content-center align-items-center">
                    <i class="bi bi-cursor-fill fs-3" id="irArriba"></i>
                    <p class="m-3" style="color: black;"><?php echo $saludo ?></p>
                </div>
                <a class="navbar-brand" href="#!"></a>
                <button class="navbar-toggler" type="button" data-mdb-collapse-init data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-person-lines-fill"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <div id="inicioSesion">
                                <a class="nav-link " id="hide" href="pages/login">Iniciar sesión</a>
                            </div>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#oferts">Ofertas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contactame</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/news">Noticias</a>
                        </li>
                        <div class="<?php
                        if ($mostrarSubir === true) {
                            echo "d-block";
                        } else {
                            echo "d-none";
                        }
                        ?>">
                            <li class="nav-item">
                                <a class="nav-link" href="pages/subirImagenes">subirImagenes</a>
                            </li>
                        </div>

                        <div id="perfil">
                            <li class="nav-item">
                                <a class="nav-link" href="pages/perfilPersona">Perfil</a>
                            </li>
                        </div>

                        <li>
                            <div id="closeR">
                                <a class="nav-link rounded " href="pages/registro" style="background-color: #c2c2c2; "
                                    class="text-center ">Registrate</a>
                            </div>

                        </li>
                        <button type="button" id="closeS" class="btn btn-light" onclick="cerrarSesion();">Cerrar
                            sesión</button>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar -->
        <div class="row d-flex ">
            <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center text-center"
                style="margin-top: 5%; margin-bottom: 5%;">
                <h4 style="font-family: var(--fuente);">Controlcoser</h4>
                <p style="font-family: var(--fuente);">Adquiere o repara tu maquina de coser</p>
                <!-- <img src="./uploads/imagenPrincipal.png" loading="lazy" alt="imagen-principal" class="rounded"
                width="100%"> -->
            </div>


            <div class="col-md-6 col-sm-12 d-flex justify-content-center">

                <img src="./uploads/imagenPrincipal.pn" alt="imagen-principal" class="rounded" width="100%">
            </div>
        </div>
        <div class="row d-flex text-center pt-5 " style="font-family: var(--fuente);">
            <div class="col-md-4 align-self-center block">
                <i class="bi bi-facebook text-primary" onclick="window.location.href='https://www.facebook.com/controlcoser/'"
                    style="font-size: 10vw;"></i>
                <p><a href="https://www.facebook.com/controlcoser/" style="text-decoration: none; color:inherit;">Facebook</a></p>
            </div>
            <div class="col-md-4 align-self-start block">
                <i class="bi bi-whatsapp text-success"
                    onclick="window.location.href='https://wa.me/3128616610?text=Hola, quiero solicitar má información acerca de tus servicios'"
                    style="font-size: 10vw; text-decoration: inherit;"></i>
                <p><a href='https://wa.me/3128616610?text=Hola, quiero solicitar más información acerca de tus servicios'
                        style="text-decoration: none; color:inherit;">WhatsApp</a></p>
            </div>
            <div class="col-md-4 align-self-center block">
                <i class="bi bi-instagram text-danger" onclick="window.location.href='https://www.instagram.com/controlcoser?igsh=YzljYTk10Dg3Zg=='"
                    style="font-size: 10vw;"></i>
                <p><a href="https://www.instagram.com/controlcoser?igsh=YzljYTk10Dg3Zg==" style="text-decoration: none; color:inherit;">Instagram</a></p>
            </div>
        </div>
        <div class="row inline-block reverse-order pt-5 ">
            <div class="col-md-6 col-sm-12 d-flex justify-content-center ">
                <img src="./uploads/segundaInicio.pn" alt="segunda-imagen-principal" class="rounded" width="100%">
            </div>
            <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center text-center"
                style="margin-top: 5%; margin-bottom: 5%;">
                <h4 style="font-family: var(--fuente);">Calidad precio</h4>
                <p style="font-family: var(--fuente);">Maquinas que tienen una calidad y precio justo</p>

            </div>



        </div>
        <div class="row  pt-5 " id="oferts">
            <div class="contenedor-lightbox">
                <h2 class="text-center" style="font-family: var(--fuente);">Próximamente</h2>
                <div class="<?php if ($mostrarSubir) {
                    echo "d-block  flex-row justify-content-end ";
                } else {
                    echo "d-none ";
                } ?>" id="btnLight">
                    <button class="btn" style="background-color: #01E7F9;" id="btnAdd">+</button>

                    <button class="btn " onclick="eliminarCajas();" id="delete"
                        style="background-color:rgb(253, 67, 67);">-</button>

                </div>
                <div class="lightbox-gallery" id="cajaLight">

                </div>

            </div>
        </div>
        <!-- footer -->
        <div class="row  pt-5" style="background-image: url('./img/R.jpeg');" id="contact">
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-telephone fs-5"></i>
                <p>3128616610</p>
            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-envelope-at fs-5"></i>
                <p><a href="https://mail.google.com/mail/?view=cm&fs=1&to=bedoyafabio4@gmail.com&su=<?php echo $hora ?>&body="
                        style="text-decoration: none; color:inherit;">bedoyafabio4@gmail.com</a></p>
            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-geo-alt fs-5"></i>
                <p><a href="https://www.google.com/maps?q=ZONA%20FRANCA%20INTERNACIONAL%20DE%20PEREIRA%20USUARIO%20OPERADOR,%20PEREIRA,%20Risaralda"
                        style="text-decoration: none; color:inherit;">Dirección Zona franca internacional de pereira</a> </p>
            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-calendar fs-5"></i>
                <p>Horario</p>

                <ul class="text-center " style="list-style-type: none; padding-left: 0!important;">
                    <li>
                        Lunes-Sabado: 8 am - 4 pm
                    </li>
                    <li>
                        Domingo: 8 am - 2pm
                    </li>
                    <p> *<span> Los horarios pueden variar</span></p>
                </ul>

            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-whatsapp"
                    onclick="window.location.href='https://wa.me/3128616610?text=Hola, quiero solicitar más información acerca de tus servicios'"></i>
                <i class="bi bi-facebook" onclick="window.location.href='https://www.facebook.com'"></i>
                <i class="bi bi-instagram" onclick="window.location.href='https://www.instagram.com'"></i>
            </div>

            <div class="text-center mt-5" style="font-family: var(--fuente);">
                <i class="bi bi-c-circle fs-5"></i>
                <span> 2025 Name company all rights reserved</span>
            </div>

        </div>
        <!--fin footer-->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <base href="/">
    <script>
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
                    crearImg.src = `/uploads/imagen-${contadorAlterno}-li.png`;
                    crearImg.loading = "lazy";
                    crearImg.dataset.imageHd = `/uploads/imagen-${contadorAlterno}-li.png`;
                    crearImg.alt = `imagen-${contadorAlterno}-ofertas`;
                    crearDivL.classList = "cajita"
                    crearDivL.appendChild(crearImg);
                    caja.appendChild(crearDivL);
                    cuenta--;
                }

            })


        let varia = contadorAlterno + 1 ?? 1;



        var contadorClicksAdd = varia ?? 1;
        document.getElementById("btnAdd").addEventListener("click", function () {

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
            crearImg.src = `/uploads/imagen-${contadorClicksAdd}-li.png`;
            crearImg.loading = "lazy";
            crearImg.dataset.imageHd = `/uploads/imagen-${contadorClicksAdd}-li.png`;
            crearImg.alt = `imagen-${contadorClicksAdd}-ofertas`;
            crearDivL.classList = "cajita"
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
        (function () {
            var $lightbox = $("<div class='lightbox'></div>");
            var $img = $("<img class='rounded'>");
            var $caption = $("<p class='caption'></p>");

            // Add image and caption to lightbox
            $lightbox
                .append($img)
                .append($caption);

            // Add lightbox to document
            $('body').append($lightbox);

            $('.lightbox-gallery img').click(function (e) {
                e.preventDefault();

                // Get image link and description
                var src = $(this).attr("data-image-hd");
                var cap = $(this).attr("alt");

                // Add data to lightbox
                $img.attr('src', src);
                $caption.text(cap);

                // Show lightbox
                $lightbox.fadeIn('fast');
            });

            $lightbox.click(function () {
                $lightbox.fadeOut('fast');
            });
        }());
    </script>
    <script>

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


        document.getElementById('irArriba').addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
        function deshabilitaRetroceso() {
            window.location.hash = "no-back-button";
            window.location.hash = "Again-No-back-button" //chrome
            window.onhashchange = function () { window.location.hash = ""; }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.goup').hide();
            $('.goup').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 0)
            });
            $(window).scroll(function () {
                if ($(this).scrollTop() > 200) {
                    $('.goup').fadeIn();
                }
                else {
                    $('.goup').fadeOut();
                }
            });
        });
    </script>

</body>

</html>