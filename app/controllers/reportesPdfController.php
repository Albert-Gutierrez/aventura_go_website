<?php
//impotamos las dependencias
require_once BASE_PATH . '/app/helpers/pdf_helper.php';
require_once BASE_PATH . '/app/controllers/administrador/proveedor.php';
require_once BASE_PATH . '/app/controllers/administrador/hotelero.php';


//esta funcion se encarga de validar el tipo de reporte y gestionar la funcion correspondiente
function reportesPdfController()
{
    //capturamos el tipo de reporte enviado desde la vista
    $tipo = $_GET['tipo'];
    //segun el tipo de reporte llamamos la funcion correspondiente
    switch ($tipo) {
        case 'proveedores':
            reporteProveedoresPDF();
            break;

        case 'proveedor_hotelero':
            reporteProveedorHoteleroPDF();
            break;

        //otros tipos de reportes pueden ser agregados aqui
        default:
            exit();
            break;
    }
}



//capturamos en ua variable el metodo o solicitud hecha  al servidor
function reporteProveedoresPDF()
{
    //CARGAR LA VISTA Y OBTENER COMO HTML
    ob_start();
    //asignamos los datos de la funcion en el controlador enlazado a una variable qie podamos manipular en la vista del pdf
    $proveedores = listarProveedores();

    //archivo que tiene la interfaz diseñada en html para el pdf
    require_once BASE_PATH . '/app/views/pdf/proveedores_pdf.php';
    $html = ob_get_clean();

    generarPDF($html, "reporte_proveedores.pdf", false);
}


//otras funciones de reportes pueden ser agregadas aqui//capturamos en ua variable el metodo o solicitud hecha  al servidor
function reporteProveedorHoteleroPDF()
{
    //CARGAR LA VISTA Y OBTENER COMO HTML
    ob_start();
    //asignamos los datos de la funcion en el controlador enlazado a una variable qie podamos manipular en la vista del pdf
    $proveedor_hotelero = listarHoteles();

    //archivo que tiene la interfaz diseñada en html para el pdf
    require_once BASE_PATH . '/app/views/pdf/proveedor_hotelero_pdf.php';
    $html = ob_get_clean();

    generarPDF($html, "reporte_proveedores.pdf", false);
}
