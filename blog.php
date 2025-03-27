<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My blog</title>
    <link rel="shortcut icon" type="image/svg+xml" href="/app_duv/favicon.svg">
    
  <!--fuente-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <!--bootstrap y sweetalert-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--video play-->
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>

    <style>
        :root{
            --fuente: "Winky Sans", sans-serif;
        }
        .text-justify{
            text-align: justify;
            text-align-last: center;
            
        }
        .line-container {
            cursor: pointer;
            width: 50%;
            height: 40px;
            background-color: yellow;
            position: relative;
            left: 25%;
            overflow: hidden;
        }

        .line {

            width: 100%;
            /* Tamaño de la línea negra */
            height: 5px;
            background-color: black;
            position: absolute;
            top: 35px;
            left: 0;
            transition: transform 1s ease-in-out;
            border-radius: 5px;
        }

        .line-container:hover .line {
            transform: translateX(100%);
            /* Se mueve a la derecha */
        }

        .line-container:not(:hover) .line {
            transform: translateX(0);
            /* Se regresa suavemente */
        }

        #my-video {
            width: 100%;
            height: 80vh;
        }

        @media(max-width: 768px) {
            #my-video {
                height: 50vh;
            }

            ;
        }

        @media(min-width: 576px) {
            .fijar-left {
                position: fixed;
                top: 18%;

            }

        }
    </style>
</head>



<body>


    <div class="container-fluid" style="overflow: hidden;">
        <div class="row">
            <!-- nav -->
            <div class="col-sm-auto bg-dark ">
                <div class="d-flex flex-sm-column flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                    <a href="/" class="d-block  text-white text-decoration-none" title="" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-original-title="Icon-only">
                        <i class="bi bi-c-circle fs-1"></i>
                    </a>
                    <ul
                        class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                        <li class="nav-item">
                            <a href="/app_duv/" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Home">
                                <i class="bi-house fs-3"></i>
                            </a>
                        </li>
                        
                       

                        
                    </ul>
                    <div class="">
                        <a href="/app_duv/perfilPersona"
                            class="d-flex text-white align-items-center justify-content-center p-3  text-decoration-none "
                            aria-expanded="false">
                            <i class="bi-person-circle h2"></i>
                        </a>
                      
                    </div>
                </div>
            </div>
            <!-- fin nav -->
            <!-- cuerpo -->
            <div class=" col-sm m-0 p-0 min-vh-100 bg-black">
                <div class="text-center sticky-top" style="background-color: yellow;">

                    <div class="line-container">
                        <a href="/app_duv/news" style="text-decoration: none;">
                            <p class="text-black pt-1" style="font-family: var(--fuente);">Check the news</p>
                            <div class="line">

                            </div>
                        </a>
                    </div>

                </div>
                <div class="">
                    <video id="my-video" src="./uploads/video.mp4" type="video/mp4" class="video-js vjs-theme-city"
                        controls="true"></video>
                </div>
                <div class="bg-black text-center text-white" style="padding-top: 5%;padding-bottom: 5%;">
                    <p class="fs-1" style="font-family: var(--fuente);">Acerca de mi</p>
                    <p class="fs-3 text-justify mx-5" style="font-family: var(--fuente);">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente similique laborum nulla cumque, hic velit, distinctio, dolor autem ea recusandae nobis. Eveniet ratione repellendus eius corporis magnam rerum quae cum!</p>
                </div>
                <div class="row flex-row ">

                    <img src="./uploads/1-img-blg.png" loading="lazy" class="col-md-4" alt="primer-imagen-blog">

                    <img src="./uploads/2-img-blg.png" loading="lazy" class="col-md-4" alt="segunda-imagen-blog">

                    <img src="./uploads/3-img-blg.png" loading="lazy" class="col-md-4" alt="tercera-imagen-blog">

                </div>
                <div class="bg-black text-center text-white" style="padding-top: 5%;padding-bottom: 5%;">
                    <p class="fs-2 text-center" style="font-family: var(--fuente);">DESCRIPCIÓN</p>
                </div>
                <div class="row">
                    <img src="./uploads/4-img-blg.png" loading="lazy" alt="cuarta-imagen-blog">
                </div>
                <div class="bg-black text-center text-white" style="padding-top: 5%;padding-bottom: 5%;">
                    <p class="fs-2 text-center" style="font-family: var(--fuente);">DESCRIPCIÓN</p>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <img src="./uploads/5-img-blg.png" loading="lazy" class="rounded" alt="quinta-imagen-blog" width="100%">
                        <p class="text-white fs-3" style="font-family: var(--fuente);">Descripción</p>
                    </div>
                    <div class="col-md-6">
                        <img src="./uploads/6-img-blg.png" loading="lazy" class="rounded" alt="sexta-imagen-blog" width="100%">
                        <p class="text-white fs-3" style="font-family: var(--fuente);">Descripción</p>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>



            <!-- fin cuerpo -->
        </div>
    </div>
    <script>
        var player = videojs('my-video');
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function volver() {
            window.location.href = '/app_duv/';
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