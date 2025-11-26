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

        /* Logo */
        .logo {
            width: 130px;
            margin-bottom: 10px;
        }

        /* Título */
        h1 {
            font-family: 'Raleway', sans-serif;
            color: #2D4059;
            font-size: 24px;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        /* Párrafo */
        p {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            color: #2B2B2B;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 10px;
            border: 1px solid #E0E0E0;
        }

        table th {
            background-color: #F8F9FA;
            color: #2D4059;
            border: 1px solid #E0E0E0;
            padding: 8px;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            text-align: left;
        }

        table td {
            border: 1px solid #E0E0E0;
            padding: 8px;
            color: #2B2B2B;
            font-family: 'Lato', sans-serif;
        }

        /* Footer */
        footer {
            position: fixed;
            bottom: 15px;
            left: 0;
            right: 0;
            font-size: 11px;
            text-align: center;
            color: #2D4059;
            font-family: 'Lato', sans-serif;
        }
    </style>
</head>

<body>

    <!-- LOGO -->
    <img class="logo" src="<?= BASE_URL ?>/public/assets/estilos_globales/img/LOGO-FINAL.png" alt="Logo Aventura Go">

    <!-- TÍTULO -->
    <h1>Reporte de Proveedores Hoteleros Inscritos</h1>

    <hr>

    <!-- DESCRIPCIÓN -->
    <p>
        Este reporte reúne la información actualizada de los proveedores hoteleros inscritos en Aventura Go.
        Su propósito es facilitar la gestión administrativa, evaluar la oferta de alojamiento disponible
        y analizar el crecimiento de los establecimientos registrados en la plataforma.
    </p>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th>Establecimiento</th>
                <th>Tipo</th>
                <th>Habitaciones</th>
                <th>Calificación</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($datos)) : ?>
                <?php foreach ($datos as $hotelero) : ?>
                    <tr>
                        <td><?= $hotelero['nombre_establecimiento'] ?></td>
                        <td><?= $hotelero['tipo_establecimiento'] ?></td>
                        <td><?= $hotelero['numero_habitaciones'] ?></td>
                        <td><?= $hotelero['calificacion_promedio'] ?></td>
                        <td>Activo</td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">No hay proveedores registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- FOOTER -->
    <footer>
        © Aventura Go 2025 - Todos los derechos reservados
    </footer>

</body>

</html>