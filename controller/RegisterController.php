<?php
include_once("../model/RegisterModel.php");
include_once("../model/HospitalModel.php");
include_once("../model/PatientModel.php");
include_once("../model/RoomModel.php");

class RegisterController {
	private $hospital;
	private $register;
    private $patient;
    private $room;
	
	public function __construct()  
    {  
    	$this->register = new RegisterModel();
        $this->hospital = new HospitalModel();
        $this->patient = new PatientModel();
        $this->room = new RoomModel();
    }

    //Obtiene los hospitales para cargar en la lista
    public function getHospitalList()
    {
    	return $this->hospital->getHospitalList();
    }

    //Obtiene los pacientes para cargar en la lista
    public function getPatientList()
    {
        return $this->patient->getPatientList();
    }

    //Obtiene una habitación disponible de acuerdo al hospital seleccionado
    public function getRoom($idHospital = 1)
    {
        return $this->room->getRoom($idHospital);
    }

    //Registrar paciente en una habitacion
    public function saveRegister($idPatient = false, $idRoom = false)
    {
        return $this->register->saveRegister($idPatient, $idRoom);
    }

}

?>