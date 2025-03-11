<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: rgb(255, 255, 255);
            margin: 0
        }

        .form {
            width: 90%;
            max-width: 340px;
            height: auto;
            min-height: 440px;
            background: #e6e6e6;
            border-radius: 8px;
            box-shadow: 0 0 40px -10px #000;
            margin: 10vh auto;
            padding: 20px;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
            position: relative;
        }

        /* 📱 Ajuste para pantallas pequeñas */
        @media (max-width: 480px) {
            .form {
                width: 95%;
                padding: 15px;
                box-shadow: 0 0 20px -5px #000;
            }
        }


        .titulo {
            margin: 10px 0;
            padding-bottom: 10px;
            width: 180px;
            color: #78788c;
            border-bottom: 3px solid #78788c
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background: none;
            outline: none;
            resize: none;
            border: 0;
            font-family: 'Montserrat', sans-serif;
            transition: all .3s;
            border-bottom: 2px solid #bebed2
        }

        input:focus {
            border-bottom: 2px solid #78788c
        }

        p:before {
            content: attr(type);
            display: block;
            margin: 28px 0 0;
            font-size: 14px;
            color: #5a5a5a
        }



        #botonEnvio:hover {
            background: #78788c;
            color: #fff
        }

        .input[type='radio'] {
            accent-color: #232323;
        }

        .input[type='radio']:checked:after {
            background-color: orange;
        }

        /* 
        section {
            height: 100%;
            width: 100%;
            position: absolute;
            background: radial-gradient(#333, #000);
        }

        .leaf {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .leaf div {
            position: absolute;
            display: block;
        }

        .leaf div:nth-child(1) {
            left: 20%;
            animation: fall 15s linear infinite;
            animation-delay: -2s;

        }

        .leaf div:nth-child(2) {
            left: 70%;
            animation: fall 15s linear infinite;
            animation-delay: -4s;
        }

        .leaf div:nth-child(3) {
            left: 10%;
            animation: fall 20s linear infinite;
            animation-delay: -7s;

        }

        .leaf div:nth-child(4) {
            left: 50%;
            animation: fall 18s linear infinite;
            animation-delay: -5s;
        }

        .leaf div:nth-child(5) {
            left: 85%;
            animation: fall 14s linear infinite;
            animation-delay: -5s;
        }

        .leaf div:nth-child(6) {
            left: 15%;
            animation: fall 16s linear infinite;
            animation-delay: -10s;
        }

        .leaf div:nth-child(7) {
            left: 90%;
            animation: fall 15s linear infinite;
            animation-delay: -4s;
        }

        @keyframes fall {
            0% {
                opacity: 1;
                top: -10%;
                transform: translateX (20px) rotate(0deg);
            }

            20% {
                opacity: 0.8;
                transform: translateX (-20px) rotate(45deg);
            }

            40% {

                transform: translateX (-20px) rotate(90deg);
            }

            60% {

                transform: translateX (-20px) rotate(135deg);
            }

            80% {

                transform: translateX (-20px) rotate(180deg);
            }

            100% {

                top: 110%;
                transform: translateX (-20px) rotate(225deg);
            }
        }

        .leaf1 {
            transform: rotateX(180deg);
        }

        h2 {
            position: absolute;
            top: 40%;
            width: 100%;
            font-family: 'Courgette', cursive;
            font-size: 4em;
            text-align: center;
            transform: translate;
            color: #fff;
            transform: translateY (-50%);
        } */
    </style>
</head>

<body>
    <?php

    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'app-duv';
    $tablaPrincipal = 'datos';

    $fecha = date('Y-m-d');
    $datosArr = [];

    $con = mysqli_connect($hostname, $username, $password, $dbname);
    if (!$con) {
        die("fallo" . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = htmlspecialchars($_POST["nombre"]);
        $nameUser = htmlspecialchars($_POST["nameUser"]);
        $telefono = htmlspecialchars($_POST["telefono"]);
        $pass = $_POST["pass"];
        $confirmPass = $_POST["confPass"];
        $typeUser = htmlspecialchars($_POST["user"]);
        // $ticket = $_POST['ticket'];
        // $ticketCod = password_hash($ticket, PASSWORD_DEFAULT);
        $passCod = password_hash($pass, PASSWORD_DEFAULT);

        $datosArr = [
            "nombre" => $nombre,
            "nameUser" => $nameUser,
            "telefono" => $telefono,
            "passcod" => $passCod,
            "typeUser" => $typeUser,
            // "ticketCod"=> $ticketCod
        ];

        // $jsonDatos=json_encode($datosArr);
        // $urlApi='https://api.jsonbin.io/v3/b/';
        // $apiKey='$2a$10$m26Xo0u5gTupmGDfrO5Z1.iQo7kkQu4QHD.0UahflYgnWLyvLW2/i';
    
        // $options = [
        //     CURLOPT_URL => $urlApi,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_HTTPHEADER=>[
        //         "X-master-key: $apiKey",
        //         "Content-Type: application/json"
        //     ],
        //     CURLOPT_POSTFIELDS => json_encode($datosArr),
        // ];
        // $ch = curl_init();
        // curl_setopt_array($ch, $options);
        // $result = curl_exec($ch);
        // echo"resultado: ". $result;
    

        $validacionTel = "SELECT nameUser from datos where nameUser = ?";
        $stmt = mysqli_prepare($con, $validacionTel);
        mysqli_stmt_bind_param($stmt, "s", $nameUser);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($resultado) > 0) {
            var_dump($nameUser);

            echo "<script>
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: 'Ya estas registrado'
                }).then((result)=>{if(result.isConfirmed){
        window.location.href=window.location.pathname;
    }});
            </script>";
        } else if ($pass != $confirmPass) {
            echo "<script>
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'Las contraseñas no coinciden'
            });
        </script>";
        } else {
            $enviar = "insert into datos(fecha, nombre, nameUser, telefono, contra, typeUser) values(?,?,?,?,?,?)";
            $stmt = mysqli_prepare($con, $enviar);
            // , $ticketCod
            mysqli_stmt_bind_param($stmt, "ssssss", $fecha, $nombre, $nameUser, $telefono, $passCod, $typeUser);
            $ejecucion = mysqli_stmt_execute($stmt);
            if ($ejecucion === true) {
                echo "<script>
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: 'Registrado correctamente'
                }).then((result)=>{if(result.isConfirmed){
        window.location.href='index.php'
    }});
            </script>";
            } else {
                echo 'Error: ' . mysqli_error($con);
            }
        }
    }
    ?>

    <form class="form" action="registro.php" id="formCorreo" onsubmit="return enviarForm();" method="post">
        <h2 class="titulo">Registrate</h2>
        <p type="Name:"><input placeholder="Name" name="nombre" id="nombre"></input></p>
        <p type="Alias:"><input placeholder="Alias" name="nameUser" id="nameUser"></input></p>

        <p type="Phone:"><input placeholder="Phone" type="number" name="telefono" id="telefono"></input></p>
        <p type="Password: "><input placeholder="Password" type="password" name="pass" id="password"
                autocomplete="new-password"></input></p>
        <p type="Confirm Password: "><input placeholder="Confirm password" type="password" name="confPass"
                id="ConfPassword" autocomplete="new-password"></input></p>

        <!-- <div id="divEscondido">
            <p type="Ticket:"><input placeholder="Ticket" type="password" name="ticket" id="ticket"
                    autocomplete="new-password"></input></p>
        </div> -->
<!-- 
        <div class="form-check " style="color: #5a5a5a;">
            <input class="form-check-input" type="radio" name="user" id="input1" value="admin" <?php echo ($typeUser = 'admin') ? 'checked' : ''; ?>>
            <label class="form-check-label mx-2" for="flexRadioDefault1">
                admin
            </label>
        </div>
        <div class="form-check mb-3" style="color: #5a5a5a;">
            <input class="form-check-input" type="radio" name="user" id="input2" value="user" <?php echo ($typeUser = 'user') ? 'checked' : ''; ?>>
            <label class="form-check-label mx-2" for="flexRadioDefault2">
                user
            </label>
        </div> -->


        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-dark mx-2 text-center" onclick="history.go(-1);"><i
                    class="bi bi-arrow-left"></i> Volver</button>
            <button type="submit" class="btn btn-dark"  id="botonEnvio">Send Message</button>

        </div>



    </form>

    <div>

    </div>


    <script>
        const nombre = document.getElementById('nombre');
        const nameUser = document.getElementById('nameUser');
        const telefono = document.getElementById('telefono');
        const contra = document.getElementById('password');
        const confPassword = document.getElementById('confPassword');
        const divE = document.getElementById('divEscondido');
        // const inputAdmin = document.getElementById('input1');
        // const inputUser = document.getElementById('input2');
        // const ticket = document.getElementById('ticket');

        // const regexCorreo = /[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}/

        function volver() {
            window.location.href = 'index.php';
        }

        function enviarForm() {
            if (nombre.value.trim() === '' || nombre.value.length < 3) {
                swal.fire('Info', 'Campo nombre vacio', 'info');
                return false;
            } else if (nameUser.value.trim() === '') {
                Swal.fire({
                    title: "Info",
                    text: "Campo alias incompleto",
                    icon: "info"
                });
                return false;
            } else if (telefono.value.trim() === '' || telefono.value.length <= 6) {
                Swal.fire({
                    title: "Info",
                    text: "Campo telefono incompleto",
                    icon: "info"
                });
                return false;
            } else if (contra.value.trim() === '' || contra.value.length <= 6) {
                Swal.fire({
                    title: "Info",
                    text: "La contraseña debe tener minimo 6 caracteres",
                    icon: "info"
                });
                return false;
            } else if (confPassword.value.trim() === '' || confPassword.value.length <= 6) {
                Swal.fire({
                    title: "Info",
                    text: "Campo confirmar contraseña incompleto",
                    icon: "info"
                });
                return false;
            } else{
                return true;
            }


            // else if (!document.querySelector('input[name="user"]:checked')) {
            //     swal.fire('Info', 'Campo Rol vacio', 'info');
            //     return false;
            // } else if(inputAdmin.checked && ticket.value.trim() === '' ){
            //     swal.fire('Info', 'Campo ticket vacio', 'info');
            //     return false;
            // }
        }
        divE.style.display = 'none';

        function mostrar(){
            if (inputAdmin.checked) {
                ticket.required = true;
                divE.style.display = 'block';
            }else if(inputUser.checked){
                divE.style.display = 'none';
                ticket.required = false;
            }
        
        };
        setInterval(mostrar,200);
            

    </script>


</body>

</html>