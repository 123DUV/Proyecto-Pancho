<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="icon" type="image/png" href="./img/icono-form.jpg">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
  


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
        .text-justify{
            text-align: justify;
            text-align-last: center;
        }
    </style>

</head>

<body>
    <button class="goup btn btn-light rounded"><i class="bi bi-arrow-up"></i></button>

    <nav class="navbar navbar-expand-lg navbar-scroll shadow-0 rounded" data-mdb-navbar-init style="background: rgb(158,236,255);
        background: linear-gradient(0deg, rgba(158,236,255,1) 25%, rgba(33,116,236,1) 67%);">
        <div class="container" id="top">
            <img src="./img/news1.png" class="imagen-news" alt="">
            <a class="navbar-brand" href="#!"></a>
            <button class="navbar-toggler" type="button" data-mdb-collapse-init data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-person-lines-fill"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#oferts">Oferts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Contact me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="news.php">News</a>
                    </li> -->
                    <li>
                        <button class="btn btn-secondary" onclick="volver();"><i class="bi bi-arrow-left"></i>
                            Volver</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="contenedor-lo-demas">
        <div>
            <div class="contenedor-slides">
                <ul class="slides">
                    <li id="slide1"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw1.jpg" alt="" /></li>
                    <li id="slide2"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw2.jpg" alt="" /></li>
                    <li id="slide3"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw3.jpg" alt="" /></li>
                    <li id="slide4"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw4.jpg" alt="" /></li>
                    <li id="slide5"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw5.jpg" alt="" /></li>
                </ul>

                <ul class="thumbnails">
                    <li>
                        <a href="#slide1"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw1.jpg" /></a>
                    </li>
                    <li>
                        <a href="#slide2"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw2.jpg" /></a>
                    </li>
                    <li>
                        <a href="#slide3"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw3.jpg" /></a>
                    </li>
                    <li>
                        <a href="#slide4"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw4.jpg" /></a>
                    </li>
                    <li>
                        <a href="#slide5"><img src="https://cdn.rawgit.com/huijing/filerepo/gh-pages/lw5.jpg" /></a>
                    </li>
                </ul>
            </div> 

        </div>
        <div class="col-md-12 ">
            <div class="col-md-6 text-center px-4 pt-4 bg-primary rounded" style="margin: 0 auto; font-family: var(--fuente);">
            <p class="fs-5 pb-4">Important News</p>
            </div>
       
            
        </div>
        <div class="col-md-12">
               <div class="text-justify col-md-6 p-4 " style="font-family: 'Space Mono', monospace;margin: 0 auto;">
               <p class="fs-5">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur qui odio, nisi explicabo facere aliquid non. Enim inventore molestiae alias, vitae optio quibusdam atque commodi qui accusantium incidunt fugiat harum?
               
               </div>
            </div>

            <div class="row text-center">
                    <div class="col-md-6 ">
                        <img src="./img/OIP.jpeg" loading="lazy" class="rounded img-fluid" alt="imagen">
                        <div class="text-black " style="font-family: 'Space Mono', monospace;;">
                             <p class="fs-4">Descripción</p>
                        </div>
                        
                    </div>
                    <div class="col-md-6 ">
                        <img src="./img/OIP.jpeg" loading="lazy" class="rounded img-fluid" alt="imagen">
                        <div class="text-black" style="font-family: 'Space Mono', monospace;">
                        <p class="fs-4">Descripción</p>
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