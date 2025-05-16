<?php
session_start();
include_once('../config.php');
// if (!empty($_SESSION['user'])) {
//     header("Location: $BASE_URL");
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once('../headers.php');
    ?>
</head>
<style>
    body {
        overflow: hidden;
    }

    .password-container {
        position: relative;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
        outline: none;
        text-align: center;
        padding: 10px 10px 10px 10px;
    }
</style>

<body>
    <div class="row">
        <div class=" bg-dark ">
            <div class="d-flex  flex-row flex-nowrap bg-dark align-items-center sticky-top fijar-left">
                <a href="<?php echo $RUTA_PAGES ?>recuperarContra" class="d-block p-3 text-white text-decoration-none"
                    title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                    <i class="bi bi-c-circle fs-1"></i>
                </a>
                <ul class="nav flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                    <li class="nav-item">
                        <a href="#" onclick="history.go(-1)" class="nav-link py-3 px-2" title=""
                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                            <i class="bi-arrow-left fs-3"></i>
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

                        <li><a class="dropdown-item" href="<?php echo $RUTA_PAGES ?>settings">Configuración</a></li>
                        <li><a class="dropdown-item" href="<?php echo $BASE_URL ?>">Inicio</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid w-75" style="margin-top: clamp(10%, 20%, 50%);">
        <div class="d-flex justify-content-center text-center w-100" style="margin-top: 20%;">

            <div class="w-100 input-group-lg" id="nombreDiv">
                <span style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Ingresa tu usuario.</span>
                <input type="text" class="form-control text-center mt-2" max="15" id="nombre" placeholder="Usuario"
                    autocomplete="new-password">
                <button class="btn btn-light mt-2 w-100" type="button" id="buscar">Buscar</button>
            </div>

            <div class="w-100" id="contraDiv">
                <span style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Ingresa tu contraseña actual.</span>
                <div class="d-flex justify-content-center text-center mt-2">
                    <input type="password" id="contra" class="password-container w-75" placeholder="Antigua contraseña">
                    <button class="btn btn-outline-secondary " onclick="mostrarContra(this.previousElementSibling.id)"
                        style="width:clamp(30%,50%,40%)" type="button" id="watch"><i class="bi bi-eye"
                            id="icono"></i></button>
                </div>

                <button class="btn btn-light w-75 mt-2" id="enviar">Enviar</button>
            </div>

            <div class="w-100" id="confirmDiv">
                <span style="font-size: clamp(0.8rem, 2.5vw, 1.5rem);">Ingresa tu nueva contraseña.</span>
                <div class="d-flex justify-content-center text-center mt-2">
                    <input type="password" id="confContra" class="password-container w-75"
                        placeholder="Nueva contraseña" autocomplete="new-password">
                    <button class="btn btn-outline-secondary " onclick="mostrarContra(this.previousElementSibling.id)"
                        style="width:clamp(30%,50%,40%)" type="button" id="watch"><i class="bi bi-eye"
                            id="icono"></i></button>
                </div>
                <button class="btn btn-light w-75 mt-2" id="cambiar">Cambiar</button>
            </div>

        </div>

    </div>

    </div>

</body>

</html>

<script>
    let estado = 'buscar';
    const divBuscar = document.getElementById('nombreDiv');
    const divEnviar = document.getElementById('contraDiv');
    const divCrear = document.getElementById('confirmDiv');
    const name = document.getElementById('nombre').value;
    const regexContra = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;
    divBuscar.style.display = "none";
    divEnviar.style.display = "none";
    divCrear.style.display = "none";
    mostrarEsconder(estado);


    document.getElementById('buscar').addEventListener('click', function () {
        const name = document.getElementById('nombre').value;
        validarNombre(name);
    })

    document.getElementById('enviar').addEventListener('click', function () {
        const name = document.getElementById('nombre').value;
        const contra = document.getElementById('contra').value;
        validarContra(name, contra);
    })

    document.getElementById('cambiar').addEventListener('click', function () {
        const name = document.getElementById('nombre').value;
        const contraNueva = document.getElementById('confContra').value;

        cambiarContra(name, contraNueva);
    })

    function mostrarContra(id) {
        const botonMostrarC = document.getElementById(`${id}`);
        const icono = botonMostrarC.nextElementSibling.querySelector('i'); // Selecciona el ícono dentro del botón clickeado
        console.log(botonMostrarC)
        if (botonMostrarC.type === "password") {
            botonMostrarC.type = "text";

        } else {
            botonMostrarC.type = "password"
        }

        icono.classList.toggle('bi-eye');
        icono.classList.toggle('bi-eye-slash')



    }


    function validarNombre(name) {
        fetch(`<?php echo $BASE_URL ?>api/get-user?user=${name}`, {
            method: 'get',
            headers: {
                "Content-Type": "application/json"
            }
        })
            .then(result => {
                if (result.status !== 200) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'No se encontró el usuario'
                    })
                } else {
                    estado = 'enviar';
                    mostrarEsconder(estado)
                }
                return result.json();
            })
            .then(data => {
                console.log(data)

            })
    }
    function validarContra(name, pass) {


        fetch('<?php echo $BASE_URL ?>api/validar', {
            method: 'post',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                nameUser: name,
                password: pass
            })
        })
            .then(result => {
                if (result.status !== 200) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'Contraseña actual incorrecta'
                    })
                } else {
                    estado = 'crear';
                    mostrarEsconder(estado);
                }
                return result.json();
            })
            .then(data => {

                console.log(data);

            })
    }

    function verificarCorreo() {

    }

    function cambiarContra(name, contraNueva) {
        if (!regexContra.test(contraNueva)) {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'La contraseña no cumple con los requisitos'
            })
        } else {
            fetch('<?php echo $BASE_URL ?>api/change-pass', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ nameUser: name, password: contraNueva })
            })
                .then(result => {
                    if (result.status !== 200) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'No se cambió la contraseña, intente de nuevo'
                        })

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Listo',
                            text: 'Contraseña cambiada exitosamente'
                        })
                        setTimeout(() => {
                            window.location.href = "<?php echo $BASE_URL ?>";
                        }, 2500);
                    }
                    return result.json();
                })
                .then(data => {
                    console.log(data);
                })
        }
    }

    function mostrarEsconder(estado) {

        switch (estado) {
            case 'buscar':
                divEnviar.style.display = "none";
                divBuscar.style.display = "block";
                break;
            case 'enviar':
                divEnviar.style.display = "block";
                divBuscar.style.display = "none";
                break;
            case 'crear':
                divCrear.style.display = "block";
                divEnviar.style.display = "none";
                divBuscar.style.display = "none";
                break;
        }
    }


</script>