<?php
session_start();

if(!empty($_SESSION['user'])){
  header("Location: /app_duv/");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de sesión</title>
  <!-- <link rel="stylesheet" href="./styles.css"> -->
  <title>Login</title>
  <link rel="icon" type="image/png" href="./img/icono-form.jpg">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bcryptjs/2.4.3/bcrypt.min.js"></script>
  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }
  </style>
</head>

<body>
  <section class="h-auto">
    <div class="container py-5 h-auto">
      <div class="row d-flex align-items-center justify-content-center h-auto">
        <h2 class="text-center mb-5 text-uppercase">Inicia sesión</h2>
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="./uploads/draw1.svg" class="img-fluid" alt="login-image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form method="post" action="api.php" id="myForm">
            <!-- User input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" id="nameUser" name="nameUser" class="form-control form-control-lg" />
              <label class="form-label" for="nameUser">Nombre usuario</label>
            </div>
            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <div class="input-group mb-1">
                <input type="password" id="contra" class="form-control form-control-lg" autocomplete="new-password"
                  aria-describedby="button-addon2">
                <button class="btn btn-secondary " type="button" id="button-addon2" onclick="mostrarContra();"><i
                    id="icono" class="bi bi-eye-slash-fill text-dark"></i></button>
              </div>
              <label for="contra" class="mx-1">Contraseña</label>
            </div>
            <div class="d-flex flex-column flex-sm-column flex-md-row justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check ">
                <input class="form-check-input" type="checkbox" value="" id="remember" name="remember" />
                <label class="form-check-label" for="form1Example3"> Recordarme</label>
              </div>
              <a href="#!">Olvide mi contraseña?</a>
              <a href="/app_duv/registro">Registrarse</a>
            </div>
            <!-- Submit button -->
            <div class="d-flex justify-content-evenly align-items-center ">
              <button type="submit" onclick="validarContra(event);" data-mdb-button-init data-mdb-ripple-init
                class="btn btn-primary btn-lg btn-block" id="botonEnviar">Iniciar</button>
              <button type="button" class="btn btn-dark btn-lg btn-block " onclick="volver();" id="salir">Salir</button>
            </div>
            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0 text-muted">O</p>
            </div>
            <div class="d-flex justify-content-center align-items-center">
              <a data-mdb-ripple-init class="btn btn-primary btn-sm btn-block" style="background-color: #3b5998"
                href="#!" role="button">
                <i class="fab fa-facebook-f me-2"></i>Continua con Facebook
              </a>
              <a data-mdb-ripple-init class="btn btn-primary btn-sm btn-block" style="background-color: #55acee"
                href="#!" role="button">
                <i class="fab fa-twitter me-2"></i>Continua con Twitter</a>

            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <script>
    const controller = new AbortController();
    const botonMostrarC = document.getElementById('contra');
    const iconoCambio = document.getElementById('icono');

    function recordar(){
      fetch(`http://localhost/app_duv/api.php/recordar`,{
        method: "get",
        headers:{
          "Content-Type": "application/json"
        }
      })
      .then(result=>{

      })
    }


    function validarContra(event) {
      event.preventDefault();
      const nameUser = document.getElementById('nameUser').value;
      const password = document.getElementById('contra').value;
      var data = {
        nameUser: nameUser,
        password: password
      }
      if (nameUser.trim() === '') {
        Swal.fire({
          icon: 'info',
          title: 'Info',
          text: 'Campo nombre usuario necesario'
        });
      } else if (password.length < 8) { Swal.fire({ icon: "info", title: 'Info', text: "El campo contraseña está incompleto" }) } else {
        fetch(`http://localhost/app_duv/api.php/validar`, {
          method: 'POST',
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(data)
        })
          .then(result => {
            if (result.ok) {
              document.getElementById("botonEnviar").disabled = true;
           
                  // document.getElementById('botonEnviar').addEventListener("click", function () {
                   
                  document.getElementById('myForm').submit();
                  
                  //   console.log("enviado");
                  // });
                  window.location.href = "/app_duv/"
                  return result.json();
               


            } else if(result.status===404){
              Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'Usuario no encontrado'
              });
            }else if(result.status===400){
              Swal.fire({
                icon: "info",
                title: "Info",
                text: "La contraseña es incorrecta"
              })
            }
          })
          .then(data => {
            console.log(data)

          })
          .catch(error => console.error("Error:", error))
      }
    }

    function mostrarContra() {
      if (botonMostrarC.type === "password") {
        botonMostrarC.type = "text";
      } else {
        botonMostrarC.type = "password"
      }
      icono.classList.toggle('bi-eye-fill');
      icono.classList.toggle('bi-eye-slash-fill');
    }

    function volver() {
      window.location.href = '/app_duv/';

    }



  </script>
</body>

</html>