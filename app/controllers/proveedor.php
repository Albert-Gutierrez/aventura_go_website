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
    $nombre_empresa        = $_POST['nombre_empresa'] ?? '';
    $nit_rut               = $_POST['nit_rut'] ?? '';
    $nombre_representante  = $_POST['nombre_representante'] ?? '';
    $email                 = $_POST['email'] ?? '';
    $telefono              = $_POST['telefono'] ?? '';
    $actividades           = $_POST['actividades'] ?? [];
    $descripcion           = $_POST['descripcion'] ?? '';
    $departamento          = $_POST['departamento'] ?? '';
    $ciudad                = $_POST['ciudad'] ?? '';
    $direccion             = $_POST['direccion'] ?? '';

    if (
        empty($nombre_empresa) || empty($nit_rut) || empty($nombre_representante) ||
        empty($email) || empty($telefono) || empty($actividades) ||
        empty($descripcion) || empty($departamento) || empty($ciudad) || empty($direccion)
    ) {
        mostrarSweetAlert('error', 'Campos vacíos', 'Por favor completa todos los campos');
        exit();
    }

    // Convertir array de actividades en string
    if(is_array($actividades)){
        $actividades = implode(",", $actividades);
    }

    $objProveedor = new Proveedor();

    $data = [
        'nombre_empresa'       => $nombre_empresa,
        'nit_rut'              => $nit_rut,
        'nombre_representante' => $nombre_representante,
        'email'                => $email,
        'telefono'             => $telefono,
        'actividades'          => $actividades,
        'descripcion'          => $descripcion,
        'departamento'         => $departamento,
        'ciudad'               => $ciudad,
        'direccion'            => $direccion
    ];

    $resultado = $objProveedor->registrar($data);

    if ($resultado === true) {
        mostrarSweetAlert('success', 'Registro exitoso', 'Proveedor registrado.', '/aventura_go/administrador/dashboard');
    } else {
        mostrarSweetAlert('error', 'Error al registrar', 'No se pudo registrar el proveedor.');
    }
}





function listarProveedores() {

    // session_start();

    $resultado = new proveedor();
    $proveedores = $resultado->consultar();

    return $proveedores;

}



function actualizarProveedor() {}

function eliminarProveedor() {}

?>
