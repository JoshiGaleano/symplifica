<?php

class DBManager {

    var $Connect;
    var $Database;
    var $Server;
    var $User;
    var $Password;

    public function __construct()  
    {  
        $this->Server = "localhost";
        $this->Database = "symplifica";
        $this->User = "root";
        $this->Password = "root";
    }

    function connection() {
        $this->Connect = new mysqli( $this->Server,  $this->User,  $this->Password,  $this->Database) or die("Unable to connect");

        /* comprobar la conexión */
        if ($Connect->connect_errno) {
            printf("Falló la conexión %s\n", $mysqli->connect_error);
            exit();
        }

        return true;
    }

}
?>