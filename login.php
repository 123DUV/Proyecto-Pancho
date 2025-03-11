<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- <link rel="stylesheet" href="./styles.css"> -->
  <title>Login</title>
  <link rel="icon" type="image/png" href="./img/icono-form.jpg">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="bower_components/sweetalert2/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
  html,
  body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }

  @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap");

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Quicksand", sans-serif;
  }

  body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: grey;
    width: 100%;
    overflow: hidden;
  }

  .ring {
    position: relative;
    width: 500px;
    height: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .ring i {
    position: absolute;
    inset: 0;
    border: 2px solid #fff;
    transition: 0.5s;
  }

  .ring i:nth-child(1) {
    border-radius: 38% 62% 63% 37% / 41% 44% 56% 59%;
    animation: animate 6s linear infinite;
  }

  .ring i:nth-child(2) {
    border-radius: 41% 44% 56% 59%/38% 62% 63% 37%;
    animation: animate 4s linear infinite;
  }

  .ring i:nth-child(3) {
    border-radius: 41% 44% 56% 59%/38% 62% 63% 37%;
    animation: animate2 10s linear infinite;
  }

  .ring:hover i {
    border: 6px solid var(--clr);
    filter: drop-shadow(0 0 20px var(--clr));
  }

  @keyframes animate {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  @keyframes animate2 {
    0% {
      transform: rotate(360deg);
    }

    100% {
      transform: rotate(0deg);
    }
  }

  .login {
    position: absolute;
    width: 300px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 20px;
  }

  .login h2 {
    font-size: 2em;
    color: #fff;
  }

  .login .inputBx {
    position: relative;
    width: 100%;
  }

  .login .inputBx input {
    position: relative;
    width: 100%;
    padding: 12px 20px;
    background: transparent;
    border: 2px solid #fff;
    border-radius: 40px;
    font-size: 1.2em;
    color: #fff;
    box-shadow: none;
    outline: none;
  }

  .login .inputBx input[type="submit"] {
    width: 100%;
    background: #0078ff;
    background: white;
    border: none;
    cursor: pointer;
    color: black;
  }
  .login .inputBx input[type="submit"]:hover{
    background-color: lightgrey;
    
  }

  .boton {
    position: relative;
    width: 100%;
    padding: 12px 20px;


    border-radius: 40px;
    font-size: 1.2em;
    color: black;
    box-shadow: none;
    outline: none;

    background: #0078ff;
    background: white;
    border: none;
    cursor: pointer;
    text-align: center;
  }
  .boton:hover{
    background-color: lightgray;
  }

  .login .inputBx input::placeholder {
    color: rgba(255, 255, 255, 0.75);
  }

  .login .links {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
  }

  .login .links a {
    color: #fff;
    text-decoration: none;
  }
  
</style>

<body>
  <?php
  $hostname = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'app-duv';
  $tablaPrincipal = 'datos';

  $con = mysqli_connect($hostname, $username, $password, $dbname);
  if (!$con) {
    die("fallo" . mysqli_connect_error());
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuarioIngresado = $_POST["nameUser"];
    $password = $_POST["pass"];
    // $ticket = $_POST['ticket'];
    // ticket 
    $validacionUser = "SELECT nameUser, contra,from datos where nameUser = ?";
    $stmtUser = mysqli_prepare($con, $validacionUser);
    mysqli_stmt_bind_param($stmtUser, "s", $usuarioIngresado);
    mysqli_stmt_execute($stmtUser);
    $resultadoUser = mysqli_stmt_get_result($stmtUser);
    if ($fila = mysqli_fetch_assoc($resultadoUser)) {
      if (password_verify($password, $fila['contra']) ) {
        // && password_verify($ticket, $fila['ticket'])
        echo "
     
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Bienvenido',
                text: 'Inicio de sesión exitoso',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'subirImagenes.php';
                }
            });
        </script>";
        exit();


      } 
    //   else if(!password_verify($ticket, $fila['ticket'])){
    //     echo "<script>
    //     Swal.fire({
    //         icon: 'error',
    //         title: 'Error',
    //         text: 'Ticket incorrecto'
            
    //     }).then((result)=>{
    //     if(result.isConfirmed){
    //       window.location.href= window.location.pathname;
    //       }
    //     });
    // </script>";
        
    //   }
      else if(!password_verify($password, $fila['contra'])){
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Contraseña incorrecta'
            
        }).then((result)=>{
        if(result.isConfirmed){
          window.location.href= window.location.pathname;
          }
        });
    </script>";
      }
    } 
  } 
  ?>

  <div class="ring">
    <i style="--clr:#666666;"></i>
    <i style="--clr:#fff;"></i>
    <i style="--clr:#BADFFF;"></i>

    <div class="login">
      
      <h2>Login</h2>
      <form action="login.php" method="post" enctype="multipart/form-data">
        <div class="inputBx">
          <input type="text" placeholder="Username" name="nameUser" autocomplete="new-password">
        </div>
        <div class="inputBx">
          <input type="password" placeholder="Password" name="pass" autocomplete="new-password">
        </div>
        <!-- <div class="inputBx">
          <input type="password" placeholder="Ticket" name="ticket" autocomplete="new-password">
        </div> -->
        <div class="inputBx">
          <input type="submit" value="Sign in">

        </div>
        </form>
        <div>
          <a href="./index.php"> <button class="boton" type="button" onclick="volver();">
               Volver</button></a>

        </div>

        <div class="links">
          <a href="#">Forget Password</a>
          <a href="./registro.php">Sign up</a>
        </div>
    </div>

  </div>

  <!--ring div ends here-->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $("#switch").click(function () {
      if ($("#fullpage").hasClass("night")) {
        $("#fullpage").removeClass("night");
        $("#switch").removeClass("switched");
      }
      else {
        $("#fullpage").addClass("night");
        $("#switch").addClass("switched");

      }
    });



    function volver() {
      window.location.href = 'index.php';
    }
    
  </script>
</body>

</html>