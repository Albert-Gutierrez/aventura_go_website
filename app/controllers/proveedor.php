<?php

//impotamos las dependencias
require_once __DIR__ . '/../helpers/alert_helper.php';
require_once __DIR__ . '/../models/proveedor.php';


//capturamos en ua variable el metodo o solicitud hecha  al servidor
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'POST':
        registrarProveedor();
        break;

    case 'GET':
        listarProveedores();
        break;

    case 'PUT':
        actualizarProveedor();
        break;

    case 'DELETE':
        eliminarProveedor();
        break;

    default:
        http_response_code(405);
        echo "❌ Método no permitido";
        break;
}

//FUNCIONES CRUD
function registrarProveedor()
{
    //capturamos en variables los datos enviados desde el formularioa travez del method POST y los name de los campos

    //Captura de datos  OJO TOCA CAMBIAR ESTO CON EL NUEVO FORMULARIO
    $nombre_empresa        = $_POST['nombre_empresa'] ?? '';
    $nit_rut            = $_POST['nit_rut'] ?? '';
    $nombre_representante  = $_POST['nombre_representante'] ?? '';
    $email          = $_POST['email'] ?? '';
    $telefono            = $_POST['telefono'] ?? '';
    $actividades      = $_POST['actividades'] ?? [];
    $descripcion    = $_POST['descripcion'] ?? '';
    $departamento   = $_POST['departamento'] ?? '';
    $ciudad         = $_POST['ciudad'] ?? '';
    $direccion      = $_POST['direccion'] ?? '';


    //VALIDAR WUE LOS CAMPOS SEAN OBLIGATORIOS
    if (empty($nombre_empresa) || empty($nit_rut) || empty($nombre_representante) || empty($email) || empty($telefono) || empty($actividades) || empty($descripcion) || empty($departamento) || empty($ciudad) || empty($direccion)) {
        mostrarSweetAlert(
            'error',
            'campos vacios',
            'por favor completa todos los campos'
        );
        exit();
    }
    //CAPTURAMOS EL ID DEL USUSARIO QUE INICIA SESION PARA GUARDARLO (SOLO SI ES NECESARIO) requerir el id de la persona que realiza el registro
    // session_start();
    // $id_administrador = $_SESSION['user']['id'];

    //PROGRAMACION ORINTADA A OBJETOS - INSTAMNCIAMOS LA CLASE
    $objProveedor = new Proveedor();
    $data = [
        'empresa' =>  $nombre_empresa,
        'nit' => $nit_rut ,
        'representante' =>  $nombre_representante,
        'email' => $email,
        'tel' => $telefono,
        'actividades' => $actividades,
        'descripcion' => $descripcion,
        'departamento' => $departamento,
        'ciudad' => $ciudad,
        'direccion' => $direccion
    ];
    //ENVIAMOS LA DATA (todos los datos enviados antes) AL METODO "registrar" DE LA CLASE INSTANCIADA ANTERIORMENTE "proveedor"
    // Y ESPERAMOS UNA RESPUESTA DEL BOOLEANA DEL MODELO EN RESULTADO
    $resultado = $objProveedor->registrar($data);


    //si la respiesta del modelo es verdadera confirmamos el registro y direccionamos
    //si es falsa modificamos y redireccionamos
    if ($resultado === true) {
        mostrarSweetAlert('success', 'Registro de proveedor exitoso', 'se a creado un nuevo proveedor.', '/aventura_go/administrador/dashboard');
    } else {
        mostrarSweetAlert('error', 'error al registrar', 'Nose pudo registrar el proveedor. Intenta nuevamente');
    }
    exit();
}





function listarProveedores() {}

function actualizarProveedor() {}

function eliminarProveedor() {}




?>
































// controlador para registrar proveedor

// Solo aceptar POST
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// // Captura de datos
// $empresa = $_POST['nombre_empresa'] ?? null;
// $nit = $_POST['nit_rut'] ?? null;
// $representante = $_POST['nombre_representante'] ?? null;
// $email = $_POST['email'] ?? null;
// $tel = $_POST['telefono'] ?? null;
// $experiencia = $_POST['anos_experiencia'] ?? null;
// $servicios = $_POST['actividades'] ?? [];
// $capacidad = $_POST['capacidad'] ?? null;
// $descripcion = $_POST['descripcion'] ?? null;
// $departamento = $_POST['departamento'] ?? null;
// $ciudad = $_POST['ciudad'] ?? null;
// $direccion = $_POST['direccion'] ?? null;
// $cobertura = $_POST['cobertura'] ?? null;

// // En un MVC real aquí llamarías al modelo para guardar en BD
// // Ej: $proveedorModel->registrar(...)

// // ✅ Por ahora: comprobar datos recibidos
// echo "<h2>Proveedor Registrado Correctamente ✅</h2>";
// echo "
<pre>";
//     print_r($_POST);
//     echo "</pre>";
// } else {
// echo "❌ Método no permitido";
// }