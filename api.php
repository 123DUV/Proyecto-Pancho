<?php
session_start();
use function PHPSTORM_META\type;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once('config.php');
if(isset($DB_HOST, $DB_USERNAME, $DB_PASS, $DB_NAME)){
    $con = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASS, $DB_NAME);
    if (!$con) {
        die("fallo" . mysqli_connect_error());
    }
}else{
    http_response_code(400);
    echo json_encode(["Error"=>"No llegan las variables de conexión con la bd"]);
}

//obtener ruta despues de api.php
$respuesta = trim(str_replace("api/", "", $_SERVER['REQUEST_URI']), "/");

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

//guardar numero cajas
if ($respuesta === 'guardar-cajas' && $metodo === 'GET') {

    $nroCajas = $_GET['cajas'];
    $enviarCajas = "UPDATE datos set nroCajas = ? WHERE nameUser = 'admin'";
    $stmt = mysqli_prepare($con, $enviarCajas);
    mysqli_stmt_bind_param($stmt, 'i', $nroCajas);
    $ejecutado = mysqli_stmt_execute($stmt);
    if ($ejecutado === false) {
        http_response_code(400);
        $response = [
            "error" => "Error subiendo numero cajas",

        ];
        echo json_encode($response);
        exit;
    } else {

        http_response_code(200);
        $response = [
            "success" => "Numero cajas subido",

        ];
        echo json_encode($response);
    }

}

//obtener numero cajas
if ($respuesta === 'obtener-cajas' && $metodo === 'GET') {

    $stmt = $con->prepare("SELECT nroCajas FROM datos WHERE nameUser = 'admin'");
    $stmt->execute();
    $respuesta = $stmt->get_result();

    if ($respuesta) {
        foreach ($respuesta as $row) {
            $resultadoImprimir = $row;
        }
        echo json_encode($resultadoImprimir);


    } else {
        http_response_code(400);
        $response = [
            "error" => "no se pudo obtener el numero de cajas"
        ];
        echo json_encode($response);
    }

}

//eliminar cajas
if ($respuesta === 'no-cajas' && $metodo === 'GET') {
    $stmt = $con->prepare("UPDATE datos SET nroCajas = 0 WHERE nameUser = 'admin'");
    $respuesta = $stmt->execute();


    if ($respuesta) {

        http_response_code(400);
        $response = [
            "success" => "Eliminado correctamente"
        ];
        echo json_encode($response);


    } else {
        http_response_code(400);
        $response = [
            "error" => "no se pudo eliminar"
        ];
        echo json_encode($response);
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
                http_response_code(200);
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

    if (empty($imagenPerfil)) {
        $imagenPerfil = "./uploads./imgsDefecto./imgPerfilDefecto.jpg";
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

        // falta archivo para manejar datos secretos como este captcha y su id
        $captcha = $datosRecibidos['g-recaptcha-response'] ?? $_POST['g-recaptcha-response'];
        $secretKey = '6LdJffgqAAAAACRGFpdopqIryS-sECsf_6Aor1pN';
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

//actualizar imagen de perfil
if ($respuesta === 'act-img' && $metodo === 'POST') {
    $datosRecibidos = json_decode(file_get_contents("php://input"), true) ?? $_POST;

    if ($datosRecibidos === null && json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["error" => "Error decoding JSON: " . json_last_error_msg()]);
        exit;
    }
    // $img=$_FILES['file']['name'];
    $img = $datosRecibidos['image'];
    $nombreUser = $_SESSION['user'];
    if (!empty($img)) {
        http_response_code(200);
        $actImg = "UPDATE datos SET imgPerfil = ? WHERE nameUser = ?";
        $stmt = mysqli_prepare($con, $actImg);
        mysqli_stmt_bind_param($stmt, 'ss', $img, $nombreUser);
        $ejecutado = mysqli_stmt_execute($stmt);
        if ($ejecutado === true) {
            http_response_code(200);
            $response = [
                "mensaje" => "Imagen de perfil actualizada correctamente",
                "datosRecibidos" => $datosRecibidos
            ];
            echo json_encode($response);
        } else {
            http_response_code(400);
            $response = [
                "error" => "Error al actualizar foto de perfil usuario",
                "datosRecibidos" => $datosRecibidos
            ];
            echo json_encode($response);
        }
    }else{
        http_response_code(400);
        $response = [
            "error" => "Imagen vacia",
            "datosRecibidos" => $datosRecibidos
        ];
        echo json_encode($response);
    }
}

//cerrar sesión 

if ($respuesta === 'logout' && $metodo === 'GET') {


    session_destroy();
    setcookie("PHPSESSID", "", time() - 3600, "/");
    http_response_code(200);
    $sendResponse = [
        "Success" => "Log out succesful"
    ];
    echo json_encode($sendResponse);
    header("refresh: 2; url=/");

}


?>