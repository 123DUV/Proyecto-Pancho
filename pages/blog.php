<?php
session_start();


?>

<!DOCTYPE html>
<html lang="es">
<?php
    include_once './headers.php';
?>
<head>


    <style>
        :root {
            --fuente: "Winky Sans", sans-serif;
        }

        .text-justify {
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
        .tamano_fuente_sm{
                font-size: 1.5vw;
            }

        @media(max-width: 768px) {
            #my-video {
                height: 50vh;
            }
            .tamano_fuente_sm{
                font-size: 2.5vw;
            }

            ;
        }

        @media(min-width: 576px) {
            .fijar-left {
                position: fixed;
                top: 18%;

            }
            .tamano_fuente_sm{
                font-size: 2.5vw;
            }
        }
    </style>
</head>



<body>


    <div class="container-fluid" style="overflow: hidden;">
        <div class="row">
            <!-- nav -->
            <div class="col-sm-auto bg-dark ">
                <div
                    class="d-flex flex-sm-column flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                    <a href="/pages/blog" class="d-block  text-white text-decoration-none" title=""
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                        <i class="bi bi-c-circle fs-1"></i>
                    </a>
                    <ul
                        class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                        <li class="nav-item">
                            <a href="#" onclick="history.go(-1);" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Home">
                                <i class="bi-arrow-left fs-3" ></i>
                            </a>
                        </li>
                    </ul>
                    <div class="">
                        <a href="/pages/perfilPersona"
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
                        <a href="/pages/news" style="text-decoration: none;">
                            <p class="text-black pt-1" style="font-family: var(--fuente);">Mira lo nuevo</p>
                            <div class="line">
                            </div>
                        </a>
                    </div>

                </div>
                <div class="">
                    <video id="my-video" src="../uploads/video.mp4" type="video/mp4" class="video-js vjs-theme-city"
                        controls="true"></video>
                </div>
                <div class="bg-black text-center text-white" style="padding-top: 5%;padding-bottom: 5%;">
                    <p class="fs-1" style="font-family: var(--fuente);">Acerca de:<br>
                        <strong>Fabio Bedoya</strong>
                    </p>
                    <p class="tamano_fuente_sm text-justify mx-5" style="font-family: var(--fuente);">
                        Nacido en Medellín, Mi interés por las maquinas de coser apareció en mi juventud
                        y desde entonces he querido aprender y mejorar cuanto pueda en este ámbito,
                        estudié un técnico en reparación de maquinas de coser y desde entonces he implementado mis
                        conocimientos
                        como trabajador independiente.<br>
                        Dentro de un corto plazo quisiera hacer crecer mi negocio ampliándome a nuevas zonas y a nuevos
                        desafíos.
                    </p>
                </div>
                <div class="row flex-row ">

                    <img src="../uploads/1-img-blg.png" loading="lazy" class="col-md-4" alt="primer-imagen-blog">

                    <img src="../uploads/2-img-blg.png" loading="lazy" class="col-md-4" alt="segunda-imagen-blog">

                    <img src="../uploads/3-img-blg.png" loading="lazy" class="col-md-4" alt="tercera-imagen-blog">

                </div>
                <div class="row">
                    <h2 class="text-center mt-3 text-white">
                        Coming soon...
                    </h2>
                </div>
                <!-- <div class="bg-black text-center text-white" style="padding-top: 5%;padding-bottom: 5%;">
                    <p class="fs-2 text-center" style="font-family: var(--fuente);">DESCRIPCIÓN</p>
                </div>
                <div class="row">
                    <img src="../uploads/4-img-blg.png" loading="lazy" alt="cuarta-imagen-blog">
                </div>
                <div class="bg-black text-center text-white" style="padding-top: 5%;padding-bottom: 5%;">
                    <p class="fs-2 text-center" style="font-family: var(--fuente);">DESCRIPCIÓN</p>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <img src="../uploads/5-img-blg.png" loading="lazy" class="rounded" alt="quinta-imagen-blog"
                            width="100%">
                        <p class="text-white fs-3" style="font-family: var(--fuente);">Descripción</p>
                    </div>
                    <div class="col-md-6">
                        <img src="../uploads/6-img-blg.png" loading="lazy" class="rounded" alt="sexta-imagen-blog"
                            width="100%">
                        <p class="text-white fs-3" style="font-family: var(--fuente);">Descripción</p>
                    </div>
                </div>
                <div class="row">

                </div> -->
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