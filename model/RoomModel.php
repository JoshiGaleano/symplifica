<?php

include_once("../config/connection.php");

class RoomModel {
	private $connection;

	public function __construct()  
    {  
    	$this->connection = new DBManager;
    } 

    //Crear una habitación
	public function create($number=false, $size=false, $id_hospital=false)
	{
		if($number == false || $size == false || $id_hospital == false)
		{
			return json_encode(array("status" => "BAD", "msj" => "Todos los campos son obligatorios"));
		}
		else
		{
			if($this->connection->connection()==true)
			{
				$sql = "INSERT INTO habitacion (numero, capacidad, id_hospital) VALUES ($number, $size, $id_hospital)";
				if (!$result = $this->connection->Connect->query($sql)) 
				{
					$mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
				    die($mensaje);
				}

				$this->connection->Connect->close();

				return json_encode(array("status" => "OK", "msj" => "Habitación creada con éxito"));
			}
		}
	}

	//Obtener una habitación con el id del hospital que este disponible
	public function getRoom($idHospital)
	{
		if($this->connection->connection() == true)
		{	
			if (!$result = $this->connection->Connect->query("SELECT id, numero FROM habitacion WHERE disponible = 0 AND id_hospital = $idHospital LIMIT 1")) 
			{
				$message  = 'Consulta no válida: ' . mysql_error() . "\n";
			    die($message);
			}

			$row = $result->fetch_array(MYSQLI_ASSOC);

		    $result->close();

			$this->connection->Connect->close();

			return $row;
		}
	}
	
}

?>