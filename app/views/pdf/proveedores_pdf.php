<!DOCTYPE html>
<html lang="es">

<head>


    <meta charset="UTF-8">

    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 30px;
            color: #2B2B2B;
            background-color: #FFFFFF;
        }

        /* Encabezado */
        .header {
            display: block;
            margin-bottom: 25px;
        }

        .header img {
            width: 120px;
        }

        h1 {
            font-family: 'Raleway', sans-serif;
            color: #2D4059;
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        p {
            font-family: 'Lato', sans-serif;
            color: #2B2B2B;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 15px;
            border: 1px solid #E0E0E0;
        }

        table th {
            background-color: #F8F9FA;
            padding: 8px;
            color: #2D4059;
            border: 1px solid #E0E0E0;
            text-align: left;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
        }

        table td {
            padding: 8px;
            border: 1px solid #E0E0E0;
            font-family: 'Lato', sans-serif;
            color: #2B2B2B;
        }

        .foto {
            width: 45px;
            height: auto;
            border-radius: 6px;
            border: 1px solid #E0E0E0;
        }

        /* Footer */
        footer {
            position: fixed;
            bottom: 15px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: #2D4059;
            font-family: 'Lato', sans-serif;
        }
    </style>

</head>

<body>

    <!-- Encabezado -->
    <img src="<?= BASE_URL ?>/public/assets/estilos_globales/img/LOGO-FINAL.png" alt="" width="120px">
    <title>Reporte de Proveedores - Aventura Go</title>


    <h1>Reporte de Proveedores Inscritos</h1>

    <hr>

    <p>
        El presente documento contiene el registro consolidado de los proveedores inscritos en Aventura Go. Este reporte
        permite evaluar la participación de prestadores turísticos, analizar el crecimiento de la plataforma y mantener
        actualizada la información relevante para la gestión administrativa.
    </p>

    <!-- Tabla de Proveedores -->
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Empresa</th>
                <th>Representante</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($proveedores)) : ?>
                <?php foreach ($proveedores as $proveedor) : ?>
                    <tr>
                        <td>
                            <img class="foto"
                                src="<?= BASE_URL ?>/public/uploads/proveedor_turistico/<?= $proveedor['foto'] ?>">
                        </td>

                        <td><?= $proveedor['nombre_empresa'] ?></td>
                        <td><?= $proveedor['nombre_representante'] ?></td>
                        <td><?= $proveedor['email'] ?></td>
                        <td><?= $proveedor['telefono'] ?></td>
                        <td><?= $proveedor['ciudad'] ?></td>
                        <td>Activo</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No hay proveedores registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Footer -->
    <footer>
        © Aventura Go 2025 - Todos los derechos reservados
    </footer>

</body>

</html>