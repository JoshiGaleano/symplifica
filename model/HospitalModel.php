<?php

include_once("../config/connection.php");

class HospitalModel {
	private $connection;

	public function __construct()  
    {  
    	$this->connection = new DBManager;
    }

    //Obtiene los hospitales
	public function getHospitalList()
	{
		$hospitals = array();
		if($this->connection->connection() == true)
		{	
			if (!$result = $this->connection->Connect->query("SELECT * FROM hospital")) 
			{
				$message  = 'Consulta no válida: ' . mysql_error() . "\n";
			    die($message);
			}

		    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$hospitals[] = $row;
			}

		    $result->close();

			$this->connection->Connect->close();

			return $hospitals;
		}
	}	
	
}

?>