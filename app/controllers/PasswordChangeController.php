<?php

require_once __DIR__ . '/../helpers/alert_helper.php';
require_once __DIR__ . '/../models/login.php';

class PasswordChangeController
{
    public function cambiarClave()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            mostrarSweetAlert('error', 'No autorizado', 'Debes iniciar sesión.', '/aventura_go/login');
            exit();
        }

        $clave_actual = $_POST['clave_actual'] ?? '';
        $clave_nueva  = $_POST['clave_nueva'] ?? '';
        $confirmar    = $_POST['confirmar'] ?? '';

        if (empty($clave_actual) || empty($clave_nueva) || empty($confirmar)) {
            mostrarSweetAlert('error', 'Campos vacíos', 'Completa todos los campos.');
            exit();
        }

        if ($clave_nueva !== $confirmar) {
            mostrarSweetAlert('error', 'Error', 'Las contraseñas no coinciden.');
            exit();
        }

        // Obtener usuario
        $login = new login();
        $usuario = $login->buscarPorId($_SESSION['user']['id']);  // Debemos crear este método si no existe

        // Verificar clave actual
        if (!password_verify($clave_actual, $usuario['contrasena'])) {
            mostrarSweetAlert('error', 'Error', 'La contraseña actual es incorrecta.');
            exit();
        }

        // Actualizar contraseña
        $nueva_hash = password_hash($clave_nueva, PASSWORD_DEFAULT);
        $resultado = $login->actualizarClave($_SESSION['user']['id'], $nueva_hash);

        if ($resultado) {
            mostrarSweetAlert('success', 'Listo', 'Contraseña actualizada correctamente.', '/aventura_go/login');
        } else {
            mostrarSweetAlert('error', 'Error', 'No se pudo actualizar la contraseña.');
        }

        exit();
    }
}
