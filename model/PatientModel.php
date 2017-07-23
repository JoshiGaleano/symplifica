<?php

include_once("../config/connection.php");

class PatientModel {
	private $connection;

	public function __construct()  
    {  
    	$this->connection = new DBManager;
    }

    //Obtiene los pacientes
	public function getPatientList()
	{
		$patients = array();
		if($this->connection->connection() == true)
		{	
			if (!$result = $this->connection->Connect->query("SELECT cedula, nombre FROM paciente")) 
			{
				$message  = 'Consulta no válida: ' . mysql_error() . "\n";
			    die($message);
			}

		    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$patients[] = $row;
			}

		    $result->close();

			$this->connection->Connect->close();

			return $patients;
		}
	}	
	
}

?>