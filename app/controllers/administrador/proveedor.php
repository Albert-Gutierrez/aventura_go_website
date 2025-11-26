<?php

//impotamos las dependencias
require_once __DIR__ . '/../../helpers/alert_helper.php';
require_once __DIR__ . '/../../models/proveedor.php';


//capturamos en ua variable el metodo o solicitud hecha  al servidor
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'POST':
        $accion = $_POST['accion'] ?? '';
        if ($accion === 'actualizar') {
            actualizarProveedor();
        } else {
            registrarProveedor();
        }
        break;

    case 'GET':
        $accion = $_GET['accion'] ?? '';
        //esta variable viene desde la vista y trae la acion eliminar
        if ($accion === 'eliminar') {
            //esta funcion elimina el proveedor por su id enviado por metodo GET
            eliminarProveedor($_GET['id']);
        }

        if (isset($_GET['id'])) {
            //esta funcion llena el formulario de editar con un solo proveedor
            listarProveedorId($_GET['id']);
        } else {
            //esta funcion llena toda la tabla de proveedores
            listarProveedores();
        }
        break;


    // case 'PUT':
    //     actualizarProveedor();
    //     break;

    // case 'DELETE':
    //     eliminarProveedor();
    //     break;

    default:
        http_response_code(405);
        echo "❌ Método no permitido";
        break;
}

//FUNCIONES CRUD
// registrar proveedor__________________________________________________________________________________
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
    if (is_array($actividades)) {
        $actividades = implode(",", $actividades);
    }

    //LOGICA PARA CARGAR IMAGENES____________________________
    $ruta_img = null;

    //VALIDAMOS SI SE ENVIO O NO LA FOTO DESDE EL FORMULARIO
    //***si el proveedor no registro una foto, dejar una imagen por defecto
    if (!empty($_FILES['foto']['name'])) {

        $file = $_FILES['foto'];

        //obtenemos la extencion del archivo en la variable ext
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        //definimos en un arreglo las extenciones permitidas
        $permitidas = ['png', 'jpg', 'jpeg'];

        //validamos que la extencion de la imagen cargada este dentro de las permitidas
        if (!in_array($ext, $permitidas)) {
            mostrarSweetAlert('error', 'Error extencion no permitida', 'cargue una extencion permitida (png, jpg, jpeg).');
            exit();
        }

        //validamos el tamaño o peso de la imagen
        if ($file['size'] > 2 * 1024 * 1024) {
            mostrarSweetAlert('error', 'Error al cargar la foto', 'El peso de la foto es superior al permitido (2 mb)');
            exit();
        }
        //definimos el nombre del archivo y le concatenamos la extencion
        $ruta_img = uniqid('proveedor_') . '.' . $ext;
        //definimos el destino donde moveremos el archivo
        $destino = BASE_PATH . "/public/uploads/proveedor_turistico/" . $ruta_img;
        //movemos el archivo al destino

        move_uploaded_file($file['tmp_name'], $destino);
    } else {
        //agregar la logica de la imagen por DEFAULT
        $ruta_img = "foto_default.png";
    }

    $objProveedor = new Proveedor();
    $data = [
        'nombre_empresa'       => $nombre_empresa,
        'nit_rut'              => $nit_rut,
        'nombre_representante' => $nombre_representante,
        'email'                => $email,
        'telefono'             => $telefono,
        'actividades'          => $actividades,
        'foto'                 => $ruta_img,
        'descripcion'          => $descripcion,
        'departamento'         => $departamento,
        'ciudad'               => $ciudad,
        'direccion'            => $direccion

    ];

    $resultado = $objProveedor->registrar($data);

    if ($resultado === true) {
        mostrarSweetAlert('success', 'Registro exitoso', 'Proveedor registrado.', '/aventura_go/administrador/registrar-proveedor-turistico');
    } else {
        mostrarSweetAlert('error', 'Error al registrar', 'No se pudo registrar el proveedor.');
    }
}




// CONSULTAR PROVEEDOR________________________________________________________________________________________
//aca consultamos todos los proveedores existentes
function listarProveedores()
{

    // session_start();

    $resultado = new proveedor();
    $proveedores = $resultado->consultar();

    return $proveedores;
}
//aca solo consultamos un proveedorr nada mas
function listarProveedorId($id)
{

    $objProveedor = new Proveedor();
    $proveedor = $objProveedor->listarProveedor($id);

    return $proveedor;
}



// EDITAR PROVEEDOR____________________________________________________________________________________
function actualizarProveedor()
{

    $id_proveedor          = $_POST['id_proveedor'] ?? '';
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
    if (is_array($actividades)) {
        $actividades = implode(",", $actividades);
    }

    $objProveedor = new Proveedor();

    $data = [
        'id_proveedor'         => $id_proveedor,
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

    $resultado = $objProveedor->actualizar($data);

    if ($resultado === true) {
        mostrarSweetAlert('success', 'Actualizacion exitoso', 'Proveedor Actualizado.', '/aventura_go/administrador/consultar-proveedor-turistico');
    } else {
        mostrarSweetAlert('error', 'Error al Actualizar', 'No se pudo registrar el proveedor.');
    }
}



// ELIMINAR PROVEEDOR_______________________________________________________________________________________
function eliminarProveedor($id)
{
    $objProveedor = new proveedor();
    $resultado = $objProveedor->eliminarProveedor($id);

    if ($resultado === true) {
        mostrarSweetAlert('success', 'Eliminacion exitosa', 'Proveedor eliminado.', '/aventura_go/administrador/consultar-proveedor-turistico');
    } else {
        mostrarSweetAlert('error', 'Error al eliminar', 'No se pudo eliminar el proveedor.');
    }
}
