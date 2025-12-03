<?php

require_once BASE_PATH . '/app/helpers/session_administrador.php';
require_once BASE_PATH . '/app/controllers/administrador/proveedor.php';

$datos = listarProveedores();

require_once __DIR__ . '/../../layouts/header_administrador.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="<?= BASE_URL ?>/public/assets/dashboard/administrador/perfil_usuario/img/FAVICON.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- LIBRERIA AOS ANIMATE -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Icono de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/dashboard/administrador/consultar_proveedor/consultar_proveedor.css">

</head>

<body>
    <!-- Layout Principal -->
    <section id="admin-dashboard">

        <!-- Panel Lateral -->
        <?php
        require_once __DIR__ . '/../../layouts/panel_izq_administrador.php';
        ?>

        <!-- Contenido Principal -->
        <div class="info">

            <!-- Barra de Búsqueda Superior -->
            <?php
            require_once __DIR__ . '/../../layouts/buscador_administrador.php';
            ?>

            <!-- Título y Acciones -->
            <div class="header-section">
                <h1>Gestión de Proveedores turisticos</h1>
            </div>

            <a href="<?= BASE_URL ?>/administrador/reporte?tipo=proveedores"
                class="btn btn-danger"
                target="_blank"
                title="Generar PDF">
                <i class="bi bi-file-earmark-pdf-fill"></i> Generar PDF</a>
            <hr>

            <!-- Filtros Rápidos -->
            <div class="filtros-rapidos">
                <button class="filtro-btn active" data-filter="all">
                    <i class="bi bi-grid"></i> Todos
                </button>
                <button class="filtro-btn" data-filter="activo">
                    <i class="bi bi-check-circle"></i> Activos
                </button>
                <button class="filtro-btn" data-filter="inactivo">
                    <i class="bi bi-x-circle"></i> Inactivos
                </button>
                <button class="filtro-btn" data-filter="pendiente">
                    <i class="bi bi-clock"></i> Pendientes
                </button>
            </div>

            <!-- Tabla de Datos -->
            <div class="tabla-container">
                <table id="tablaAdmin" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Empresa</th>
                            <th>Representante</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($datos)) : ?>
                            <?php foreach ($datos as $proveedor) : ?>
                                <tr>
                                    <td><img src=" <?= BASE_URL  ?>/public/uploads/proveedor_turistico/<?= $proveedor['foto'] ?>" style="width: 40px"></td>
                                    <td><?= $proveedor['nombre_empresa'] ?></td>
                                    <td><?= $proveedor['nombre_representante'] ?></td>
                                    <td><?= $proveedor['email'] ?></td>
                                    <td><?= $proveedor['telefono'] ?></td>
                                    <td><?= $proveedor['ciudad'] ?></td>
                                    <td><span class="badge-activo">Activo</span></td>

                                    <!-- OJO para colocar el estado desde aca -->
                                    <!-- <td><select class="estado">
                                            <option>Activo</option>
                                            <option>Inactivo</option>
                                            <option>Pendiente</option>
                                        </select>
                                    </td> -->

                                    <td>
                                        <a class="btn-accion btn-ver" title="Ver Proveedor">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <!-- aca vemos un solo proveedor que aparece en la tabla -->
                                        <!-- <a href="<?= BASE_URL ?>/administrador/consultar-proveedor-turistico?id=<?= $proveedor['id_proveedor'] ?>" class="btn-accion btn-ver" title="Ver Proveedor">
                                            <i class="bi bi-eye"></i>
                                        </a> -->
                                        <!-- aca EDITAMOS un solo proveedor que aparece en la tabla -->
                                        <a href="<?= BASE_URL ?>/administrador/editar-proveedor?id=<?= $proveedor['id_proveedor'] ?>" class="btn-accion btn-editar" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- aca ELIMINAMOS UN SOLO PROVEEDOR -->
                                        <a href="<?= BASE_URL ?>/administrador/eliminar-proveedor?accion=eliminar&id=<?= $proveedor['id_proveedor'] ?>" class="btn-accion btn-eliminar" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td>no hay proveedores registrados</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal para ver todos los datos del proveedor -->
    <div class="modal fade" id="modalVerProveedor" tabindex="-1" aria-labelledby="modalVerProveedorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVerProveedorLabel">
                        <i class="bi bi-eye-fill me-2"></i> Información Completa del Proveedor
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Sección 1: Información Básica -->
                    <div class="section-card mb-4">
                        <h6 class="section-title">
                            <i class="bi bi-building me-2"></i> Información Básica
                        </h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-sm text-muted">Empresa:</label>
                                <p class="info-value" id="modal-empresa">-</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-sm text-muted">NIT/RUT:</label>
                                <p class="info-value" id="modal-nit">-</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-sm text-muted">Representante:</label>
                                <p class="info-value" id="modal-representante">-</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-sm text-muted">Email:</label>
                                <p class="info-value" id="modal-email">-</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-sm text-muted">Teléfono:</label>
                                <p class="info-value" id="modal-telefono">-</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-sm text-muted">Estado:</label>
                                <span class="badge-activo" id="modal-estado">Activo</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sección 2: Ubicación -->
                    <div class="section-card mb-4">
                        <h6 class="section-title">
                            <i class="bi bi-geo-alt me-2"></i> Ubicación
                        </h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-sm text-muted">Departamento:</label>
                                <p class="info-value" id="modal-departamento">-</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-sm text-muted">Ciudad:</label>
                                <p class="info-value" id="modal-ciudad">-</p>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label-sm text-muted">Dirección:</label>
                                <p class="info-value" id="modal-direccion">-</p>
                            </div>
                        </div>
                    </div>

                    <!-- Sección 3: Servicios -->
                    <div class="section-card mb-4">
                        <h6 class="section-title">
                            <i class="bi bi-list-check me-2"></i> Servicios Ofrecidos
                        </h6>
                        <div class="mb-3">
                            <label class="form-label-sm text-muted">Actividades:</label>
                            <div class="actividades-container" id="modal-actividades">
                                <span class="badge-servicio">Cargando actividades...</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-sm text-muted">Descripción:</label>
                            <div class="card descripcion-card">
                                <div class="card-body">
                                    <p class="card-text" id="modal-descripcion">Sin descripción disponible.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección 4: Foto/Imagen -->
                    <div class="section-card">
                        <h6 class="section-title">
                            <i class="bi bi-image me-2"></i> Fotografía
                        </h6>
                        <div class="text-center">
                            <div class="foto-proveedor-container" id="foto-container">
                                <img id="modal-foto" src="<?= BASE_URL ?>/assets/img/default-proveedor.jpg"
                                    alt="Foto del proveedor" class="foto-proveedor">
                            </div>
                            <p class="text-muted small mt-2">Imagen registrada del proveedor</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <?php
    require_once __DIR__ . '/../../layouts/footer_administrador.php';

    ?>



</body>

</html>