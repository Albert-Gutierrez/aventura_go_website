<?php
//index.php - Router principal en larabel se tiene un archivo por cada carpeta de views

require_once __DIR__ . '/config/config.php';

//OBTENER LA URI ACTUAL (por ejemplo: aventura_go/login)
$requestUri = $_SERVER['REQUEST_URI'];

//Quitar el prefijo de la carpeta del proyecto
$request = str_replace('/aventura_go', '', $requestUri);

//Quitar parametros tipo ?id=123
$request = strtok($request, '?');

//Quitar la barra final (si existe)
$request = rtrim($request, '/');

//si la ruta queda vacia, se interpreta como "/"
if ($request === '') $request = '/';

//enrutamiento basico
switch ($request) {
    case '/':
        require BASE_PATH . '/app/views/website/index.html'; //redirige a la pagina de inicio
        break;

    //........................inicio rutas login
    case '/login':
        require BASE_PATH . '/app/views/auth/login.php'; //redirige a el login 
        break;
    case '/iniciar-sesion':
        require BASE_PATH . '/app/controllers/loginController.php'; //redirige al inicio de sesion
        break;

    case '/recoverpw':
        require BASE_PATH . '/app/views/auth/resetPassword.php';
        break;

    case '/generar-clave':
        require BASE_PATH . '/app/controllers/paswordController.php';
        break;

    //::::::::::::::::::::::fin rutas login



    //........................inicio rutas administrador
    case '/administrador/dashboard':
        require BASE_PATH . '/app/views/dashboard/administrador/administrador.php';  //redirige al panel de administrador
        break;

    case '/administrador/registrar-proveedor':
        require BASE_PATH . '/app/views/dashboard/administrador/registrar_proveedor.php';  //redirige al perfil de usuario de administrador
        break;

    case '/administrador/guardar-proveedor':
        require BASE_PATH . '/app/controllers/administrador/proveedor.php';  //redirige a guardar proveedor
        break;

    case '/administrador/consultar-proveedor':
        require BASE_PATH . '/app/views/dashboard/administrador/consultar_proveedor.php';  //redirige a la tabla
        break;

    case '/administrador/editar-proveedor':
        require BASE_PATH . '/app/views/dashboard/administrador/editar_proveedor.php';  //redirige a editar proveedor
        break;

    case '/administrador/actualizar-proveedor':
        require BASE_PATH . '/app/controllers/administrador/proveedor.php';  //redirige a actualizar proveedor
        break;

    case '/administrador/eliminar-proveedor':
        require BASE_PATH . '/app/controllers/administrador/proveedor.php';  //redirige a editar proveedor
        break;

    case '/administrador/perfil':
        require BASE_PATH . '/app/views/dashboard/administrador/perfil_usuario.php';  //redirige a editar proveedor
        break;

    //:::::::::::::::::::::::::fin rutas administrador



    //........................INICIO RUTAS PROVEEDOR TURISTICO
    case '/proveedor/dashboard':
        require BASE_PATH . '/app/views/dashboard/administrador/proveedor.php';  //redirige al panel de proveedor
        break;

    //........................FIN RUTAS PROVEEDOR TURISTICO



    //........................INICIO RUTAS PROVEEDOR HOTELERO
    case '/proveedor_hotelero/dashboard':
        require BASE_PATH . '/app/views/dashboard/administrador/proveedor.php';  //redirige al panel de proveedor
        break;


    //........................FIN RUTAS PROVEEDOR HOTELERO


    //........................INICIO RUTAS TURISTA (USUARIO)
    case '/turista/dashboard':
        require BASE_PATH . '/app/views/dashboard/administrador/proveedor.php';  //redirige al panel de proveedor
        break;

    //........................FIN RUTAS TURISTA (USUARIO)




    default:
        require BASE_PATH . '/app/views/auth/error404.html';
        break;
}
