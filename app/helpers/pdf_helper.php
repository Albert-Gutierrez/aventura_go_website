<?php
//configuración de Dompdf PARA GENERAR PDF
require_once __DIR__ . '/../../vendor/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

function generarPDF($html, $filename = "documento.pdf", $download = false)
{
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true); // permite imágenes externas

    $dompdf = new Dompdf($options);

    // Cargar el HTML recibido
    $dompdf->loadHtml($html);

    // Opcional: tamaño y orientación
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar
    $dompdf->render();

    // Descargar o mostrar
    $dompdf->stream($filename, [
        "Attachment" => $download ? 1 : 0
    ]);
}
