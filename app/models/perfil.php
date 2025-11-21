<?php 
// Incluye la configuración de la base de datos
require_once __DIR__ . '/../../config/database.php';

// Definición de la clase login
class Perfil
{
    private $conexion; // Propiedad para almacenar la conexión a la base de datos

    // Constructor: se ejecuta automáticamente cuando se crea el objeto
    public function __construct()
    {
        $db = new conexion(); // Crea una nueva instancia de la clase conexion (config/database.php)
        $this->conexion = $db->getConexion(); // Obtiene la conexión PDO y la guarda en $this->conexion
    }

    // ESTA FUNCION SE DUPLICA POR CADA ROL (admin, prov tusristico, prove hotelero, turista)____________________________________________________________________________________
    public function mostrarPerfilAdmin($id)
    {
        try {
            $consultar = 'SELECT * FROM usuario WHERE id_usuario = :id LIMIT 1';

            // PREPARAR LO NECESARIO PARA EJECUTAR LA FUNCION
            $resultado = $this->conexion->prepare($consultar);
            $resultado->bindParam(':id', $id);

            $resultado->execute();

            return $resultado->fetch();
        } catch (PDOException $e) {
            //throw $th;
        }
    }



}
?>