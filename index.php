<?php
session_start();

// echo session_id();
// echo $_SESSION['user'];
// var_dump($_SESSION);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

if (isset($_SESSION['user'])) {
    $logedIn = true;
} else {
    $logedIn = false;
}

$nameGlobal = $_SESSION['user'];
$saludo;
date_default_timezone_set("America/Bogota");
$fecha = date('Y-m-d H:i:s');
$fechaComparacion = date('Y-m-d 12:00:00');

if (empty($nameGlobal) || $nameGlobal === null) {
    if ($fecha < $fechaComparacion) {
        $saludo = 'Buen dia';
    } else {
        $saludo = 'Buena tarde';
    }
} else {
    $saludo = 'Bienvenido/a ' . $_SESSION['user'];
}

//   session_destroy();
?>
<!DOCTYPE html>
<html lang="es1">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="sewing machine services and information">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="MACHINE,SERVICES,INFORMATION, SEWING MACHINE">
    <meta name="author" content="Duvan Bedoya">
    <meta name="robots" content="index, follow">
    <title>App</title>
    <link rel="icon" type="image/x-icon" href="./img/icono-form.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/queryloader2/3.3.2/queryloader2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/queryloader2/3.3.2/queryloader2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        @media (prefers-color-scheme: light) {
            :root {
                --body-bg: #FFFFFF;
                --body-color: #000000;
                --fuente: "Press Start 2P", serif;
            }
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --body-bg: #000000;
                --body-color: #FFFFFF;
                --fuente: "Press Start 2P", serif;
            }
        }



        .full-lados {
            margin: 0 !important;
            padding: 0 !important;
            width: 100vw !important;
            display: block;
        }

        .gradient {
            background: rgb(163, 160, 163);
            background: radial-gradient(circle, rgba(163, 160, 163, 1) 28%, rgba(255, 255, 255, 1) 69%);
        }

        .gradient-abajo {
            background: rgb(65, 65, 65);
            background: linear-gradient(0deg, rgba(65, 65, 65, 1) 0%, rgba(249, 248, 246, 1) 65%);
        }

        .gradient-arriba {
            background: rgb(249, 248, 246);
            background: linear-gradient(0deg, rgba(249, 248, 246, 1) 19%, rgba(65, 65, 65, 1) 95%);
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

<body>
    <script>
        var logedIn = <?php echo json_encode($logedIn); ?>;
    </script>
    <div class="container-fluid ">
        <button class="goup btn btn-light"><i class="bi bi-arrow-up"></i></button>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-scroll shadow-0 rounded" data-mdb-navbar-init>
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
                                <a class="nav-link " id="hide" href="/login">Iniciar sesión</a>
                            </div>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#oferts">Ofertas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#contact">Contactame</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/news">Noticias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/subirImagenes">subirImagenes</a>
                        </li>
                        <div id="perfil">
                        <li class="nav-item">
                            <a class="nav-link" href="/perfilPersona">Perfil</a>
                        </li>
                        </div>
                        
                        <li>
                            <div id="closeR">
                            <a class="nav-link rounded " href="/registro" style="background-color: #c2c2c2; "
                            class="text-center ">Registrate</a>
                            </div>
                    
                        </li>
                        <button type="button" id="closeS" class="btn btn-light" onclick="cerrarSesion();">Cerrar sesión</button>

                    </ul>
                </div>
            </div>
        </nav>

        <!-- Navbar -->
        <div class="row d-flex  gradient-abajo ">
            <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center text-center"
                style="margin-top: 5%; margin-bottom: 5%;">
                <h4 style="font-family: var(--fuente);">Pagina</h4>
                <p style="font-family: var(--fuente);">Descripción</p>
                <!-- <img src="./img/OIP.jpeg" loading="lazy" alt="imagen"  class="sin-bordes"> -->
            </div>


            <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                <img src="./img/OIP.jpeg" loading="lazy" alt="imagen-principal" class="rounded" width="100%">
            </div>
        </div>
        <div class="row d-flex text-center pt-5  gradient-arriba" style="font-family: var(--fuente);">
            <div class="col-md-4 align-self-center block">
                <i class="bi bi-0-circle-fill" onclick="window.location.href='https://www.facebook.com'"
                    style="font-size: 10vw;"></i>
                <p><a href="https://www.facebook.com" style="text-decoration: none; color:inherit;">Descripción</a></p>
            </div>
            <div class="col-md-4 align-self-start block">
                <i class="bi bi-1-circle-fill"
                    onclick="window.location.href='https://wa.me/1234567890?text=Hola,%20quiero%solicitar%20esto'"
                    style="font-size: 10vw; text-decoration: inherit;"></i>
                <p><a href="https://wa.me/1234567890" style="text-decoration: none; color:inherit;">Descripción</a></p>
            </div>
            <div class="col-md-4 align-self-center block">
                <i class="bi bi-2-circle-fill" onclick="window.location.href='https://www.instagram.com'"
                    style="font-size: 10vw;"></i>
                <p><a href="https://www.instagram.com" style="text-decoration: none; color:inherit;">Descripción</a></p>
            </div>
        </div>
        <div class="row inline-block reverse-order  bg-black gradient-abajo pt-5 ">
            <div class="col-md-6 col-sm-12 d-flex justify-content-center ">
                <img src="./img/OIP.jpeg" loading="lazy" alt="imagen" class="rounded" width="100%">
            </div>
            <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-center text-center"
                style="margin-top: 5%; margin-bottom: 5%;">
                <h4 style="font-family: var(--fuente);">Pagina</h4>
                <p style="font-family: var(--fuente);">Descripción</p>
                <!-- <img src="./img/OIP.jpeg" alt="imagen"  class="sin-bordes"> -->
            </div>



        </div>
        <div class="row gradient-arriba pt-5 " id="oferts">
            <div class="contenedor-lightbox">
                <h2 class="text-center" style="font-family: var(--fuente);">Titulo</h2>
                <div class="lightbox-gallery">
                    <div><img src="./img/OIP.jpeg" loading="lazy" data-image-hd="./img/OIP.jpeg" alt="imagen">
                    </div>
                    <div><img src="./img/OIP.jpeg" loading="lazy" data-image-hd="./img/OIP.jpeg" alt="imagen">
                    </div>
                    <div><img src="./img/OIP.jpeg" loading="lazy" data-image-hd="./img/OIP.jpeg" alt="imagen">
                    </div>
                    <div><img src="./img/OIP.jpeg" loading="lazy" data-image-hd="./img/OIP.jpeg" alt="imagen"></div>
                    <div><img src="./img/OIP.jpeg" loading="lazy" data-image-hd="./img/OIP.jpeg" alt="imagen">
                    </div>
                    <div><img src="./img/OIP.jpeg" loading="lazy" data-image-hd="./img/OIP.jpeg" alt="imagen">
                    </div>
                </div>
            </div>
        </div>
        <div class="row gradient-abajo pt-5" style="background-image: url('./img/R.jpeg');" id="contact">
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-telephone fs-5"></i>
                <p>3123123123</p>
            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-envelope-at fs-5"></i>
                <p><a href="mailto:correo@gmail.com?subject=Asunto%20del%20correo&body=si%20es%20necesario"
                        style="text-decoration: none; color:inherit;">Correo@gmail.com</a></p>
            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-geo-alt fs-5"></i>
                <p><a href="https://www.google.com/maps?q=Av.%20Siempre%20Viva%2042,%20Springfield"
                        style="text-decoration: none; color:inherit;">Dirección #10-26</a> </p>
            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-calendar fs-5"></i>
                <p>Horario</p>
            </div>
            <div class="text-center mt-2" style="font-family: var(--fuente);">
                <i class="bi bi-whatsapp"
                    onclick="window.location.href='https://wa.me/1234567890?text=Hola,%20quiero%solicitar%20esto'"></i>
                <i class="bi bi-facebook" onclick="window.location.href='https://www.facebook.com'"></i>
                <i class="bi bi-instagram" onclick="window.location.href='https://www.instagram.com'"></i>
            </div>

            <div class="text-center mt-5" style="font-family: var(--fuente);">
                <i class="bi bi-c-circle fs-5"></i>
                <span> 2025 Name company all rights reserved</span>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<base href="/">
    <script>
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
        }else{
            document.getElementById('inicioSesion').style.display = "visible";
            document.getElementById('closeS').style.visibility = "hidden";
            document.getElementById('closeR').style.visibility = "visible";
        }
        function cerrarSesion() {
            fetch(`http://localhost/api.php/logout`, {
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
        function deshabilitaRetroceso(){
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash="";}
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