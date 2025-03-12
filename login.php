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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
.divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}

</style>

<body>

<section class="h-auto">
  <div class="container py-5 h-auto">
    <div class="row d-flex align-items-center justify-content-center h-auto">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="./img/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form>
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" id="form1Example13" class="form-control form-control-lg" />
            <label class="form-label" for="form1Example13">Nombre usuario</label>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="password" id="form1Example23" class="form-control form-control-lg" autocomplete="new-password"/>
            <label class="form-label" for="form1Example23" >Contraseña</label>
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
              <label class="form-check-label" for="form1Example3"> Recordarme</label>
            </div>
            <a href="#!">Olvide mi contraseña?</a>
            <a href="./registro.php">Registrarse</a>
          </div>

          <!-- Submit button -->
           <div class="d-flex justify-content-evenly align-items-center ">
           <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" >Iniciar</button>
           <button type="button" class="btn btn-dark btn-lg btn-block " onclick="volver();">Salir</button>
           </div>
         
          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-muted">O</p>
          </div>
  <div class="d-flex justify-content-center align-items-center">
  <a data-mdb-ripple-init class="btn btn-primary btn-sm btn-block" style="background-color: #3b5998" href="#!"
            role="button">
            <i class="fab fa-facebook-f me-2"></i>Continua con Facebook
          </a>
          <a data-mdb-ripple-init class="btn btn-primary btn-sm btn-block" style="background-color: #55acee" href="#!"
            role="button">
            <i class="fab fa-twitter me-2"></i>Continua con Twitter</a>

  </div>
         
        </form>
      </div>
    </div>
  </div>
</section>

  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

  <script>

    function volver() {
      window.location.href = './index.php'
    }

    function obtenerDatos() {

    }

  </script>
</body>

</html>