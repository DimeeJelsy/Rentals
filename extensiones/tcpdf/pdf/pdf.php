<?php

// Include the main TCPDF library.
require_once('tcpdf_include.php');

// Verificar que los datos necesarios estén disponibles (puedes cambiar esto para adaptarlo a tu sistema)
if (!isset($_GET['id_factura'])) {
    die('No se ha proporcionado un ID de factura.');
}

// Obtener el ID de la factura (puedes cambiar la lógica para extraer datos según tu sistema)
$id_factura = $_GET['id_factura'];

// Aquí deberías implementar la lógica para obtener los detalles de la factura desde la base de datos usando el $id_factura
// Supongamos que ya has obtenido los siguientes detalles:
$numeroFactura = 'INV-0001';
$fechaFactura = '2024-09-14';
$nombreCliente = 'Juan Pérez';
$direccionCliente = 'Av. Principal 123, Ciudad, País';
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

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set margins
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 10);

// Set default font
$pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
$pdf->AddPage();

// Set text shadow effect (opcional)
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Generar contenido HTML para la factura
$html = <<<EOF
<h1 style="text-align:center;">Factura</h1>
<h2 style="text-align:right;">N° de Factura: $numeroFactura</h2>
<p style="text-align:right;">Fecha: $fechaFactura</p>

<hr>

<h3>Detalles del Cliente</h3>
<p>
<strong>Nombre:</strong> $nombreCliente<br>
<strong>Dirección:</strong> $direccionCliente<br>
</p>

<hr>

<h3>Detalles de la Factura</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr style="background-color:#f2f2f2;">
            <th width="50%">Descripción</th>
            <th width="15%">Cantidad</th>
            <th width="15%">Precio Unitario</th>
            <th width="20%">Total</th>
        </tr>
    </thead>
    <tbody>
EOF;

// Agregar productos a la tabla
foreach ($productos as $producto) {
    $descripcion = $producto['descripcion'];
    $cantidad = $producto['cantidad'];
    $precioUnitario = number_format($producto['precio_unitario'], 2);
    $totalProducto = number_format($producto['cantidad'] * $producto['precio_unitario'], 2);
    
    $html .= <<<EOF
        <tr>
            <td>$descripcion</td>
            <td>$cantidad</td>
            <td>\$$precioUnitario</td>
            <td>\$$totalProducto</td>
        </tr>
EOF;
}

$html .= <<<EOF
    </tbody>
</table>

<hr>

<h3>Resumen</h3>
<table border="0" cellpadding="5">
    <tr>
        <td width="80%" style="text-align:right;"><strong>Subtotal:</strong></td>
        <td width="20%" style="text-align:right;">\$${subtotal}</td>
    </tr>
    <tr>
        <td width="80%" style="text-align:right;"><strong>Impuesto ($impuestoPorcentaje%):</strong></td>
        <td width="20%" style="text-align:right;">\$${impuesto}</td>
    </tr>
    <tr>
        <td width="80%" style="text-align:right;"><strong>Total:</strong></td>
        <td width="20%" style="text-align:right;"><strong>\$${total}</strong></td>
    </tr>
</table>

<p style="text-align:center;">Gracias por su compra!</p>
EOF;

// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y generar el PDF
$pdf->Output('factura_' . $id_factura . '.pdf', 'I');

?>
