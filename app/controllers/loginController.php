<?php
//impotamos las dependencias
require_once __DIR__ . '/../helpers/alert_helper.php';
require_once __DIR__ . '/../models/login.php';


// $clave = '123';
// echo password_hash($clave, PASSWORD_DEFAULT);

//ejeciutar segun la solicitud al servisor "POST"
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    //capturamos en variables los valores enviados a travez de los name del formulario y el method POST
    $correo = $_POST['email'] ?? '';
    $clave = $_POST['contrasena'] ?? '';

    //validamos que los campos/variables no esten vacios
    if (empty($correo) || empty($clave)){
        mostrarSweetAlert('error', 'campos vacios', 'por favor completar todos los campos');
        exit();
    }
    //POO -INSTANCIAMOS LA CLASE DEL MODELO, PARA ACCEDER A UN METHOD (FUNCION) EN ESPECIFICO
    $login = new login();
    $resultado = $login->autenticar($correo, $clave);

    //verificar si el modelo devolvio un error
    if (isset($resultado['error'])) {
        mostrarSweetAlert('Error', 'Error de autenticacion', $resultado['error']);
        exit();
    }

    //si pasa esta linea el ususario es valido
    session_start();
    $_SESSION['user'] = [
        'id' => $resultado['id_usuario'],
        'nombre' => $resultado['nombre'],
        'rol' => $resultado['rol']
    ];

    mostrarSweetAlert('success', 'Bienvenido', 'inicio de sesion exitoso. Redirigiendo...', '/aventura_go/administrador/dashboard');
    exit();

} else{
    http_response_code(405);
    echo "Metodo no permitido";
    exit();
}


?>