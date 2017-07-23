<?php
include_once("../model/RoomModel.php");
include_once("../model/HospitalModel.php");

class RoomController {
	private $hospital;
	private $room;
	
	public function __construct()  
    {  
    	$this->room = new RoomModel();
        $this->hospital = new HospitalModel();
    }

    //Recibe los parametros para crear una habitación
    public function create($number = false, $size = false, $id_hospital = false)
    {
		return $this->room->create($number, $size, $id_hospital);
    }

    //Obtiene los hospitales para cargar en la lista
    public function getHospitalList()
    {
    	return $this->hospital->getHospitalList();
    } 

}

?>