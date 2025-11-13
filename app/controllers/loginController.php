<?php
//impotamos las dependencias
require_once __DIR__ . '/../helpers/alert_helper.php';
require_once __DIR__ . '/../models/login.php';


// $clave = '789';
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

    //REDIRECCION SEGUN EL ROL
    $redirectUrl = '/aventura_go/login';
    $mensaje = 'Rol inexistente. redirigiendo al inicio de sesion...';

    switch ($resultado['rol']) {
        case 'administrador':
            $redirectUrl = '/aventura_go/administrador/dashboard';
            $mensaje = 'Bienvenido Administrador';
            break;
        case 'proveedor':
            $redirectUrl = '/aventura_go';
            $mensaje = 'Bienvenido proveedor turistico';
            break;

        case 'proveedor_hotelero':
            $redirectUrl = '/aventura_go';
            $mensaje = 'Bienvenido proveedor hotelero';
            break;
        
        case 'turista':
            $redirectUrl = '/aventura_go/';
            $mensaje = 'Bienvenido';
            break;
        
    }
    mostrarSweetAlert('success', 'ingreso exitoso', $mensaje, $redirectUrl);
    exit();

} 
else{
    http_response_code(405);
    echo "Metodo no permitido";
    exit();
}







?>