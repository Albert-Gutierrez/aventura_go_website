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
    public function registrar($data){

        try {
            $insertar = "INSERT INTO proveedor(
                /*se escriben como este en la base de datos*/
            nombre_empresa,
            nit_rut,
            nombre_representante,
            email,
            telefono,
            actividades,
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
    public function consultar(){
        //variable que almacena lka sentencia sql a ejecutar
        try {
            $consultar = "SELECT * FROM proveedor ORDER BY id_proveedor DESC";

            // PREPARAR LO NECESARIO PARA EJECUTAR LA FUNCION
            $resultado = $this->conexion->prepare($consultar);

            $resultado->execute();

            return $resultado->fetchAll();

        
            }
        catch (PDOException $e) {
            error_log("Error en proveedor::consultar->" . $e->getMessage());
            return [];
    }

    }

}
        

?>