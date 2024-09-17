
<?php

// Include the main TCPDF library.
require_once('tcpdf_include.php');

// Verificar que los datos necesarios estén disponibles
if (!isset($_GET['id_factura'])) {
    die('No se ha proporcionado un ID de factura.');
}

// Obtener el ID de la factura (puedes cambiar la lógica para extraer datos según tu sistema)
$id_factura = $_GET['id_factura'];

// Aquí deberías implementar la lógica para obtener los detalles de la factura desde la base de datos usando el $id_factura
// Ejemplo de datos simulados:
$numeroFactura = 'INV-0001';
$fechaFactura = '2024-09-14';
$nombreCliente = 'Juan Pérez';
$productos = [
    ['descripcion' => 'Producto 1', 'cantidad' => 2, 'precio_unitario' => 50.00],
    ['descripcion' => 'Producto 2', 'cantidad' => 1, 'precio_unitario' => 75.00],
    ['descripcion' => 'Servicio 1', 'cantidad' => 3, 'precio_unitario' => 30.00]
];
$impuestoPorcentaje = 15; // Impuesto del 15%

// Calcular subtotales y totales
$subtotal = 0;
foreach ($productos as $producto) {
    $subtotal += $producto['cantidad'] * $producto['precio_unitario'];
}
$impuesto = $subtotal * ($impuestoPorcentaje / 100);
$total = $subtotal + $impuesto;

// Crear nuevo documento PDF para el ticket (configuración de ticket con formato más pequeño)
$pdf = new TCPDF('P', 'mm', array(80, 130), true, 'UTF-8', false);

// Configuraciones del ticket
$pdf->SetMargins(5, 5, 5);
$pdf->SetAutoPageBreak(TRUE, 10);

// Set default font
$pdf->SetFont('dejavusans', '', 9);

// Añadir una página
$pdf->AddPage();

// Generar contenido del ticket
$html = <<<EOF
<h2 style="text-align:center;">Tienda XYZ</h2>
<p style="text-align:center;">
<strong>Factura N°:</strong> $numeroFactura<br>
<strong>Fecha:</strong> $fechaFactura<br>
<strong>Cliente:</strong> $nombreCliente
</p>

<hr>

<table border="0" cellpadding="2" cellspacing="0">
    <thead>
        <tr style="background-color:#f2f2f2;">
            <th style="text-align:left;">Descripción</th>
            <th style="text-align:right;">Cant</th>
            <th style="text-align:right;">P. Unit</th>
            <th style="text-align:right;">Total</th>
        </tr>
    </thead>
    <tbody>
EOF;

// Agregar productos al ticket
foreach ($productos as $producto) {
    $descripcion = $producto['descripcion'];
    $cantidad = $producto['cantidad'];
    $precioUnitario = number_format($producto['precio_unitario'], 2);
    $totalProducto = number_format($producto['cantidad'] * $producto['precio_unitario'], 2);

    $html .= <<<EOF
        <tr>
            <td style="text-align:left;">$descripcion</td>
            <td style="text-align:right;">$cantidad</td>
            <td style="text-align:right;">\$$precioUnitario</td>
            <td style="text-align:right;">\$$totalProducto</td>
        </tr>
EOF;
}

$html .= <<<EOF
    </tbody>
</table>

<hr>

<h3>Resumen</h3>
<table border="0" cellpadding="2" cellspacing="0">
    <tr>
        <td style="text-align:left;"><strong>Subtotal:</strong></td>
        <td style="text-align:right;">\$${subtotal}</td>
    </tr>
    <tr>
        <td style="text-align:left;"><strong>Impuesto ($impuestoPorcentaje%):</strong></td>
        <td style="text-align:right;">\$${impuesto}</td>
    </tr>
    <tr>
        <td style="text-align:left;"><strong>Total:</strong></td>
        <td style="text-align:right;"><strong>\$${total}</strong></td>
    </tr>
</table>

<p style="text-align:center;">Gracias por su compra</p>
EOF;

// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y generar el PDF
$pdf->Output('ticket_' . $id_factura . '.pdf', 'I');

?>
