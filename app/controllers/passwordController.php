<?php
require_once __DIR__ . '/../helpers/alert_helper.php';
require_once __DIR__ . '/../models/recoveryPass.php';

//atterizamos los valores enviados desde los name de los campos del formulario
$email = $_POST['email'] ?? '';

if (empty($email)) {
    mostrarSweetAlert('error', 'campos vacios', 'por favor completar todos los campos');
    exit();
}

$objModelo = new recoveryPass();
$resultado = $objModelo->recuperarClave($email);

//AGREGAR SWET ALERT DE ENVIO O NO ENVIO DEL CORREO
if ($resultado === true) {
    mostrarSweetAlert('success', 'Nueva clave generada', 'Se a enviado una nueva contraseña a tu correo electronico', '/aventura_go/login');
} else {
    mostrarSweetAlert('error', 'Usuario no encontrado', 'Verifique su email e intente nuevamente');
}
exit();
