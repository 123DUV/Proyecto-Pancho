<!DOCTYPE html>
<html lang="es">
<?php
include_once '../headers.php';
?>

<head>

    <style>
        body {
            position: relative;
            background-color: #9eecff;

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
            --fuente: "Press Start 2P", serif;
            --color-letra: black;
        }

        .imagen-news {
            margin-top: 2%;
            width: 15%;
            height: 15%;
        }

        h1 {
            text-align: center;
        }

        #carrusel-caja {
            -moz-animation: automatizacion 15s infinite linear;
            -o-animation: automatizacion 15s infinite linear;
            -webkit-animation: automatizacion 15s infinite linear;
            animation: automatizacion 15s infinite linear;
            -webkit-transition: all 0.75s ease;
            -moz-transition: all 0.75s ease;
            -ms-transition: all 0.75s ease;
            -o-transition: all 0.75s ease;
            transition: all 0.75s ease;
            height: auto;
            width: 300%;
        }

        #carrusel-contenido {
            margin: 0 auto;
            overflow: hidden;
            text-align: center;
        }

        .imagenes {
            border-radius: 5px;
            height: auto;
            width: 80%;
        }

        .carrusel-elemento {
            float: left;
            width: 33.333%;
        }

        .text-justify {
            text-align: justify;
        }

        @-moz-keyframes automatizacion {
            0% {
                margin-left: 0;
            }

            30% {
                margin-left: 0;
            }

            35% {
                margin-left: -100%;
            }

            65% {
                margin-left: -100%;
            }

            70% {
                margin-left: -200%;
            }

            95% {
                margin-left: -200%;
            }

            100% {
                margin-left: 0;
            }
        }

        @-webkit-keyframes automatizacion {
            0% {
                margin-left: 0;
            }

            30% {
                margin-left: 0;
            }

            35% {
                margin-left: -100%;
            }

            65% {
                margin-left: -100%;
            }

            70% {
                margin-left: -200%;
            }

            95% {
                margin-left: -200%;
            }

            100% {
                margin-left: 0;
            }
        }

        @keyframes automatizacion {
            0% {
                margin-left: 0;
            }

            30% {
                margin-left: 0;
            }

            35% {
                margin-left: -100%;
            }

            65% {
                margin-left: -100%;
            }

            70% {
                margin-left: -200%;
            }

            95% {
                margin-left: -200%;
            }

            100% {
                margin-left: 0;
            }

        }

        html {
            box-sizing: border-box;
            height: 100%;
        }

        *,
        *::before,
        *::after {
            box-sizing: inherit;
            margin: 0;
            padding: 0;
        }

        .contenedor-slides {
            display: flex;
            justify-content: center;
        }

        .thumbnails {
            display: flex;
            flex-direction: column;
            line-height: 0;
            list-style-type: none;

            li {
                flex: auto;
                list-style-type: none;
            }

            a {
                display: block;
            }

            img {
                width: 30vmin;
                height: 20vmin;
                object-fit: cover;
                object-position: top;
            }
        }

        .slides {
            overflow: hidden;
            width: 50vmin;
            height: 100vmin;
            list-style-type: none;

            li {
                width: 50vmin;
                height: 100vmin;
                position: absolute;
                z-index: 1;

            }

            img {
                width: 50vmin;
                height: 100vmin;
                object-fit: cover;
                object-position: top;

            }
        }

        .slides li:target {
            z-index: 3;
            animation: slide 1s 1;
        }

        .slides li:not(:target) {
            animation: hidden 1s 1;
        }

        @keyframes slide {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0%);
            }
        }

        @keyframes hidden {
            0% {
                z-index: 2;
            }

            100% {
                z-index: 2;
            }
        }

        .contenedor-lo-demas {
            overflow: hidden;
        }

        .text-justify {
            text-align: justify;
            text-align-last: center;
        }
    </style>

</head>

<body>
    <button class="goup btn btn-light rounded"><i class="bi bi-arrow-up"></i></button>

    <div class="row">
            <div class=" bg-dark ">
                <div class="d-flex  flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                    <a href="/pages/news" class="d-block p-3 text-white text-decoration-none" title=""
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

    <div class="contenedor-lo-demas">
        <div>
            <div class="contenedor-slides">
                <ul class="slides">
                    <li id="slide1"><img src="../uploads/imgsDefecto/coming.png" alt="" /></li>
                    <li id="slide2"><img src="../uploads/imgsDefecto/coming.png" alt="" /></li>
                    <li id="slide3"><img src="../uploads/imgsDefecto/coming.png" alt="" /></li>
                    <li id="slide4"><img src="../uploads/imgsDefecto/coming.png" alt="" /></li>
                    <li id="slide5"><img src="../uploads/imgsDefecto/coming.png" alt="" /></li>
                </ul>

                <ul class="thumbnails">
                    <li>
                        <a href="#slide1"><img src="../uploads/imgsDefecto/coming.png" /></a>
                    </li>
                    <li>
                        <a href="#slide2"><img src="../uploads/imgsDefecto/coming.png" /></a>
                    </li>
                    <li>
                        <a href="#slide3"><img src="../uploads/imgsDefecto/coming.png" /></a>
                    </li>
                    <li>
                        <a href="#slide4"><img src="../uploads/imgsDefecto/coming.png" /></a>
                    </li>
                    <li>
                        <a href="#slide5"><img src="../uploads/imgsDefecto/coming.png" /></a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-md-12 ">
            <div class="col-md-6 text-center px-4 pt-4 bg-warning rounded"
                style="margin: 0 auto; font-family: var(--fuente);">
                <p class="fs-5 pb-4">Lo ultimo!!</p>
            </div>

        </div>
        <div class="col-md-12">
            <div class="text-justify col-md-6 p-4 " style="font-family: 'Space Mono', monospace;margin: 0 auto;">
                <p class="fs-5">

                </p>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-6 ">
                <img src="../uploads/desc-1-nws.png" loading="lazy" class="rounded img-fluid"
                    alt="imagen descripición news uno">
                <div class="text-black m-3" style="font-family: 'Space Mono', monospace;;">
                    <p class="fs-4">Muy pronto artículos nuevos</p>
                </div>

            </div>
            <div class="col-md-6 ">
                <img src="../uploads/desc-1-nws.png" loading="lazy" class="rounded img-fluid"
                    alt="imagen descripción news dos">
                <div class="text-black m-3" style="font-family: 'Space Mono', monospace;">
                    <p class="fs-4">Muy pronto artículos nuevos</p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function volver() {
            window.location.href = '/';
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