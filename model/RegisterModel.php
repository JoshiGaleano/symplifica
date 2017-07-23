<?php

include_once("../config/connection.php");

class RegisterModel {
	private $connection;

	public function __construct()  
    {  
    	$this->connection = new DBManager;
    }

    //Guardar el registro de un paciente en una habitación
	public function saveRegister($idPatient = false, $idRoom = false)
	{
		if($idPatient == false || $idRoom == false)
		{
			return json_encode(array("status" => "BAD", "msj" => "Todos los campos son obligatorios"));
		}
		else
		{
			if($this->connection->connection()==true)
			{
				$dateNow = date("Y-m-d H:i:s");

				//Validar si el paciente ya está registrado en una habitación
				$query = "SELECT id FROM registro WHERE cc_paciente = $idPatient AND fecha_salida = NULL LIMIT 1";
				if (!$result0 = $this->connection->Connect->query($query)) 
				{
					$message  = 'Consulta no válida: ' . mysql_error() . "\n";
				    die($message);
				}

				if($result0->num_rows > 0)
				{
					$result0->close();
					$this->connection->Connect->close();

					return json_encode(array("status" => "BAD", "msj" => "El paciente ya se encuentra registrado en otra habitación"));
				}

				$result0->close();

				//Guardar el registro en la base de datos
				$sql = "INSERT INTO registro (cc_paciente, id_habitacion, fecha_entrada) VALUES ($idPatient, $idRoom, $dateNow)";

				if (!$result = $this->connection->Connect->query($sql)) 
				{
					$mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
				    die($mensaje);
				}

				//Obtener la capacidad de la habitación
				$sql2 = "SELECT capacidad FROM habitacion WHERE id = $idRoom LIMIT 1";

				if (!$result2 = $this->connection->Connect->query($sql2)) 
				{
					$message  = 'Consulta no válida: ' . mysql_error() . "\n";
				    die($message);
				}

				$row = $result2->fetch_array(MYSQLI_ASSOC);

				$result2->close();

				//Sumar la cantidad de pacientes registrados en una habitación
				$sql3 = "SELECT id FROM registro WHERE id_habitacion = $idRoom AND fecha_salida = NULL";

				if (!$result3 = $this->connection->Connect->query($sql3)) 
				{
					$message  = 'Consulta no válida: ' . mysql_error() . "\n";
				    die($message);
				}

				$row_cnt = $result3->num_rows;

				$result3->close();

				//Cambiar el estado de disponibilidad de la habitación
				if($row_cnt == $row["capacidad"])
				{
					$sql4 = "UPDATE habitación SET disponible = 1 WHERE id = $idRoom";

					if (!$result4 = $this->connection->Connect->query($sql4)) 
					{
						$mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
					    die($mensaje);
					}
				}

				$this->connection->Connect->close();

				return json_encode(array("status" => "OK", "msj" => "El paciente fue registrado en la habitación con éxito"));
			}
		}
	}	
	
}

?>