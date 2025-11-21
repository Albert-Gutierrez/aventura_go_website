<?php
// Incluye la configuración de la base de datos
require_once __DIR__ . '/../../config/database.php';

// Definición de la clase login
class Proveedor
{
    private $conexion; // Propiedad para almacenar la conexión a la base de datos

    // Constructor: se ejecuta automáticamente cuando se crea el objeto
    public function __construct()
    {
        $db = new conexion(); // Crea una nueva instancia de la clase conexion (config/database.php)
        $this->conexion = $db->getConexion(); // Obtiene la conexión PDO y la guarda en $this->conexion
    }

    // Función para autenticar usuario (recibe el correo y la clave escrita por el usuario)________________________________________
    // FUNCION REGISTRAR____________________________________________________________________________________
    public function registrar($data)
    {

        try {
            $insertar = "INSERT INTO proveedor(
            /*se escriben como este en la base de datos*/
            nombre_empresa,
            nit_rut,
            nombre_representante,
            email,
            telefono,
            actividades,
            foto,
            descripcion,
            departamento,
            ciudad,
            direccion,
            validado
        ) VALUES (
            :nombre_empresa,
            :nit_rut,
            :nombre_representante,
            :email,
            :telefono,
            :actividades,
            :foto,
            :descripcion,
            :departamento,
            :ciudad,
            :direccion,
            'activo'
            )";

            $resultado = $this->conexion->prepare($insertar);
            $resultado->bindParam(':nombre_empresa', $data['nombre_empresa']);
            $resultado->bindParam(':nit_rut', $data['nit_rut']);
            $resultado->bindParam(':nombre_representante', $data['nombre_representante']);
            $resultado->bindParam(':email', $data['email']);
            $resultado->bindParam(':telefono', $data['telefono']);
            $resultado->bindParam(':actividades', $data['actividades']);
            $resultado->bindParam(':foto', $data['foto']);
            $resultado->bindParam(':descripcion', $data['descripcion']);
            $resultado->bindParam(':departamento', $data['departamento']);
            $resultado->bindParam(':ciudad', $data['ciudad']);
            $resultado->bindParam(':direccion', $data['direccion']);

            return $resultado->execute();
        } catch (PDOException $e) {
            error_log("Error en proveedor::registrar->" . $e->getMessage());
            return false;
        }
    }


    // function consultar______________________________________________________________________________________________________
    //consulta de todos los proveedores 
    public function consultar()
    {
        //variable que almacena la sentencia sql a ejecutar
        try {
            $consultar = "SELECT * FROM proveedor ORDER BY id_proveedor DESC";

            // PREPARAR LO NECESARIO PARA EJECUTAR LA FUNCION
            $resultado = $this->conexion->prepare($consultar);
            $resultado->execute();

            return $resultado->fetchAll();
        } catch (PDOException $e) {
            error_log("Error en proveedor::consultar->" . $e->getMessage());
            return [];
        }
    }
    //solo un proveedor
    public function listarProveedor($id)
    {
        try {
            $consultar = 'SELECT * FROM proveedor WHERE id_proveedor = :id LIMIT 1';

            // PREPARAR LO NECESARIO PARA EJECUTAR LA FUNCION
            $resultado = $this->conexion->prepare($consultar);
            $resultado->bindParam(':id', $id);

            $resultado->execute();

            return $resultado->fetch();
        } catch (PDOException $e) {
            //throw $th;
        }
    }

    // FUNCION ACTUALIZAR____________________________________________________________________________________
    public function actualizar($data)
    {

        try {
            $actualizar = "UPDATE proveedor SET
                nombre_empresa = :nombre_empresa,
                nit_rut = :nit_rut,
                nombre_representante = :nombre_representante,
                email = :email,
                telefono = :telefono,
                actividades = :actividades,
                descripcion = :descripcion,
                departamento = :departamento,
                ciudad = :ciudad,
                direccion = :direccion

            WHERE id_proveedor = :id_proveedor";

            $resultado = $this->conexion->prepare($actualizar);

            $resultado->bindParam(':id_proveedor', $data['id_proveedor']);
            $resultado->bindParam(':nombre_empresa', $data['nombre_empresa']);
            $resultado->bindParam(':nit_rut', $data['nit_rut']);
            $resultado->bindParam(':nombre_representante', $data['nombre_representante']);
            $resultado->bindParam(':email', $data['email']);
            $resultado->bindParam(':telefono', $data['telefono']);
            $resultado->bindParam(':actividades', $data['actividades']);
            $resultado->bindParam(':descripcion', $data['descripcion']);
            $resultado->bindParam(':departamento', $data['departamento']);
            $resultado->bindParam(':ciudad', $data['ciudad']);
            $resultado->bindParam(':direccion', $data['direccion']);

            return $resultado->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar proveedor::actualizar->" . $e->getMessage());
            return false;
        }
    }


    public function eliminarProveedor($id)
    {

        try {
            $eliminar = 'DELETE FROM proveedor where id_proveedor = :id_proveedor';

            // PREPARAR LO NECESARIO PARA EJECUTAR LA FUNCION
            $resultado = $this->conexion->prepare($eliminar);
            $resultado->bindParam(':id_proveedor', $id);

            return $resultado->execute();
        } catch (PDOException $e) {
            error_log("Error en  eliminar proveedor::eliminar->" . $e->getMessage());
            return;
        }
    }
}
