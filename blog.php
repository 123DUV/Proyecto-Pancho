<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My blog</title>
    <link rel="icon" type="image/png" href="./img/icono-form.jpg">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.scss">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>

    <style>
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
                    <a href="/" class="d-block p-3 text-white text-decoration-none" title="" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-original-title="Icon-only">
                        <i class="bi-bootstrap fs-1"></i>
                    </a>
                    <ul
                        class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                        <li class="nav-item">
                            <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Home">
                                <i class="bi-house fs-3"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Dashboard">
                                <i class="bi-speedometer2 fs-3"></i>
                            </a>
                        </li>
                        <li>
                            <a href="./index.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Orders">
                                <i class="bi bi-arrow-left fs-3"></i>
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
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- fin nav -->
            <!-- cuerpo -->
            <div class=" col-sm m-0 p-0 min-vh-100 bg-black">
                <div class="text-center sticky-top" style="background-color: yellow;">

                    <div class="line-container">
                        <a href="./news.php" style="text-decoration: none;">
                            <p class="text-black pt-1">Check the news</p>
                            <div class="line">

                            </div>
                        </a>
                    </div>

                </div>
                <div class="">
                    <video id="my-video" src="./img/video.mp4" type="video/mp4" class="video-js vjs-theme-city"
                        controls="true"></video>
                </div>
                <div class="bg-black text-center text-white" style="padding-top: 5%;padding-bottom: 5%;">
                    <p class="fs-1">DESCRIPCIÓN</p>
                    <p class="fs-3"><mark style="background-color: yellow; border-radius: 4px;">descripción</mark></p>
                </div>
                <div class="row flex-row ">

                    <img src="./img/OIP.jpeg" loading="lazy" class="col-md-4" alt="imagen">

                    <img src="./img/OIP.jpeg" loading="lazy" class="col-md-4" alt="imagen">

                    <img src="./img/OIP.jpeg" loading="lazy" class="col-md-4" alt="imagen">

                </div>
                <div class="bg-black text-center text-white" style="padding-top: 5%;padding-bottom: 5%;">
                    <p class="fs-2 text-center"><mark style="background-color: yellow;border-radius: 4px;">DESCRIPCIÓN</mark></p>
                </div>
                <div class="row">
                    <img src="./img/OIP.jpeg" loading="lazy" alt="imagen">
                </div>
                <div class="bg-black text-center text-white" style="padding-top: 5%;padding-bottom: 5%;">
                    <p class="fs-2 text-center"><mark style="background-color: yellow;border-radius: 4px;">DESCRIPCIÓN</mark></p>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <img src="./img/OIP.jpeg" loading="lazy" class="rounded" alt="imagen">
                        <p class="text-white fs-3">Descripción</p>
                    </div>
                    <div class="col-md-6">
                        <img src="./img/OIP.jpeg" loading="lazy" class="rounded" alt="imagen">
                        <p class="text-white fs-3">Descripción</p>
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
            window.location.href = 'index.php';
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