<?php
session_start();

use function PHPSTORM_META\type;

header("Access-Control-Allow-Origin: http://localhost");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

$hostname = 'sql10.freesqldatabase.com';
$username = 'sql10768775';
$password = 'C5sPIR9Bbv';
$dbname = 'sql10768775';
$tablaPrincipal = 'datos';

$con = mysqli_connect($hostname, $username, $password, $dbname);
if (!$con) {
    die("fallo" . mysqli_connect_error());
}

//obtener ruta despues de api.php
$respuesta = str_replace("/api/", "", $_SERVER['REQUEST_URI']);

$respuesta = explode("?", $respuesta)[0];
error_log("ruta: " . $respuesta);
$metodo = $_SERVER['REQUEST_METHOD'];

//obtener todos los usuarios


if ($respuesta === 'get-all-user' && $metodo === 'GET') {
    $stmt = $con->prepare("SELECT * FROM datos");
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado) {
        foreach ($resultado as $row) {
            $resultadoImprimir[] = $row;
        }
        echo json_encode($resultadoImprimir);
    } else {
        http_response_code(400);
        $respuestaError = [
            "Error" => "no se recibieron datos",
            "datosRecibidos" => []
        ];
        echo json_encode($respuestaError);
    }
}
//validar contra
if ($respuesta === 'validar' && $metodo === 'POST') {
    $datosLogin = json_decode(file_get_contents("php://input"), true) ?? $_POST;

    if ($datosLogin === null && json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["error" => "Error validando contraseña"]);
        exit;
    }
    $nameUser = $datosLogin['nameUser'];

    $password = $datosLogin['password'];

    $stmtContra = $con->prepare("SELECT contra FROM datos WHERE nameUser='$nameUser'");
    $stmtContra->execute();
    $resultadoContra = $stmtContra->get_result();

    if ($resultadoContra) {

        $row = $resultadoContra->fetch_assoc();
        if ($row) {


            $contrahash = $row['contra'];

            if (password_verify($password, $contrahash)) {
                http_response_code(200);
                $_SESSION['user'] = $nameUser;
                $mostrart = [
                    "Success" => "validación correcta"
                ];
                echo json_encode($mostrart);

            } else {
                http_response_code(400);
                $mostrart = [
                    "Error" => "validación incorrecta"
                ];
                echo json_encode($mostrart);
            }

        } else {
            http_response_code(404);
            $respuestaErrorContra = [
                "Error" => "usuario no encontrado",
            ];
            echo json_encode($respuestaErrorContra);
        }
    } else {
        http_response_code(500);
        $respuestaErrorContra = [
            "Error" => "error validacion contraseña"
        ];
        echo json_encode($respuestaErrorContra);
    }
}


//obtener info por nombre de usuario

if ($respuesta === 'get-user' && $metodo === 'GET') {
    if (isset($_GET['user'])) {
        $nameUser = $_GET['user'];
        error_log("Nombre de usuario recibido: " . $nameUser);

        // Preparar la consulta
        $stmt = $con->prepare("SELECT * FROM datos WHERE nameUser = ?");
        $stmt->bind_param("s", $nameUser);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado) {

            $datos = $resultado->fetch_all(MYSQLI_ASSOC);
            if (count($datos) > 0) {
                echo json_encode($datos);
            } else {
                http_response_code(400);
                $response = [
                    "Error" => "Usuario no encontrado",

                ];
                echo json_encode($response);
            }


        } else {
            http_response_code(400);
            $responsee = [
                "Error" => "Error en resultado",
                "datosRecibidos" => []
            ];
            echo json_encode($responsee);
        }
    } else {
        http_response_code(400);
        $response = [
            "error" => "Parámetro 'nameUser' no proporcionado"
        ];
        echo json_encode($response);
    }
}

//guardar usuario

if ($respuesta === 'save-user' && $metodo === 'POST') {
    $datosRecibidos = json_decode(file_get_contents("php://input"), true) ?? $_POST;

    if ($datosRecibidos === null && json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["error" => "Error decoding JSON: " . json_last_error_msg()]);
        exit;
    }

    $nameUser = $datosRecibidos['nameUser'];
    $telefono = $datosRecibidos['telefono'];
    $contra = $datosRecibidos['contra'];
    $imagenPerfil = $datosRecibidos['imagenPerfil'];

    if(empty($imagenPerfil)){
        $imagenPerfil="./uploads./imgsDefecto./imgPerfilDefecto.jpg";
    }

    $contraCod = password_hash($contra, PASSWORD_BCRYPT);
    $nombreTraidoBd = 'SELECT COUNT(*) from datos where nameUser = ?';
    $stmtName = mysqli_prepare($con, $nombreTraidoBd);
    mysqli_stmt_bind_param($stmtName, 's', $nameUser);
    $ejecutadoName = mysqli_stmt_execute($stmtName);

    if ($ejecutadoName === false) {
        http_response_code(400);
        $response = [
            "error" => "Error mirando nombre de usuario",
            "datosRecibidos" => $datosRecibidos
        ];
        echo json_encode($response);
        exit;
    }
    $resultadoName = mysqli_stmt_get_result($stmtName);
    $nameUserCount = mysqli_fetch_row($resultadoName)[0];

    if ($nameUserCount > 0) {
        http_response_code(409);
        $response = [
            "error" => "El Nombre de usuario ya está en uso",
            "usuario ya en uso" => $datosRecibidos['nameUser']
        ];
        echo json_encode($response);
        exit;
    } else {
        
    $captcha =$datosRecibidos['g-recaptcha-response']?? $_POST['g-recaptcha-response'];
    $secretKey = '6Lfe8voqAAAAABNEit1YMLQ_PWLgtuLm6WSVsWa5';
    $urlApi = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $captcha;

    $response = file_get_contents($urlApi);

    $responseTwo = json_decode($response);

    if ($responseTwo->success == true) {
        http_response_code(200);
        $insertarDatos = 'INSERT INTO datos(nameUser, telefono, contra, imgPerfil) values(?,?,?,?)';
        $stmt = mysqli_prepare($con, $insertarDatos);
        mysqli_stmt_bind_param($stmt, 'siss', $nameUser, $telefono, $contraCod, $imagenPerfil);
        $ejecutado = mysqli_stmt_execute($stmt);
        if ($ejecutado === true) {
            http_response_code(200);
            $response = [
                "mensaje" => "Usuario agregado correctamente",
                "datosRecibidos" => $datosRecibidos
            ];
            echo json_encode($response);
        } else {
            http_response_code(400);
            $response = [
                "error" => "Error al registrar al usuario",
                "datosRecibidos" => $datosRecibidos
            ];
            echo json_encode($response);
        }

    } else {
        http_response_code(400);
        $mensaje = [
            "Error" => "error en la validación del captcha"
        ];
        echo json_encode($mensaje);
    }
       
    }


}

//cerrar sesión 

if ($respuesta === 'logout' && $metodo === 'GET') {


    session_destroy();
    http_response_code(200);
    $sendResponse = [
        "Success" => "Log out succesful"
    ];
    echo json_encode($sendResponse);

}


?>