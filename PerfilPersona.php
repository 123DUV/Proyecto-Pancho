<?php 
session_start();
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

if(isset($_SESSION['user'])){
    $logeado = true;
    $user = $_SESSION['user'];
    $estadoCeIn = "Cerrar sesión";
}else{
    $logeado = false;
    $user = "Usuario";
    $estadoCeIn = "Iniciar sesión";
}

if($logeado){
    $stmt = $con->prepare("SELECT imgPerfil FROM datos WHERE nameUser = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $extraerImg =$resultado->fetch_assoc();
    $imgExtraida = $extraerImg['imgPerfil'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="icon" type="image/png" href="./img/icono-form.jpg">
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
            margin-top: 25%;
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
    <div class="container">


        <form action="">
            <div class="text-center ">
                <label for="inputModificado" class="inputFalso ">
                    <img src="<?php if(empty($imgExtraida)){
                        echo $imgDefectoPerfil;
                    }else{
                        echo $imgExtraida ;
                    } ?>" class="img-fluid" alt="imagen">
                </label>
                <input type="file" accept="image/*" multiple="true" name="image" class="" id="inputModificado"
                    required>
                    <div class="text-center mt-2 mb-2">
                        <h2>¡Hola, <?php echo $user ?>!</h2>
                    </div>
                <div class="text-center">
                    <button id="botonCrop" class="btn btn-lg border-bottom mt-2 mx-2">Editar foto perfil</button>
                    <button id="botonCeIn" class="btn btn-lg btn-danger mt-2" onclick="<?php 
                     
                    if($logeado===true){
                        echo "cerrarSesion()";
                    }else{
                        echo "irLogin()";
                    }?>"> <?php    echo $estadoCeIn;  ?></button>
                    <!-- <canvas id="previewCanvas"></canvas>  -->
                </div>
                <div id="vistaPrevia">
                </div>
            </div>


        </form>

        <script>
            function irLogin(){
                window.location.href = "/app_duv/login";
            }
            function volver(){
                window.location.href = "/app_duv/";
            }
            document.addEventListener('DOMContentLoaded', function(){
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