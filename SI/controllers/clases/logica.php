<?php

include_once (__DIR__ . '/../conexion.php');
include_once ('usuario.php');
include_once ('estudiante.php');

class Logica
{

    // Esta funcion busca saber que tipo de usuario es segun su correo
    // Teniendo en cuenta que el sistema no permite registrarse con correos de otras personas
    function identifyUser($email)
    {
        $objectStudent = new Student();
        $objectUser = new User();

        $typeUser = "";

        $result = $objectStudent->existsEmail($email);

        if ($result)
        {
            $typeUser = "Student";
            return $typeUser;
        }
        else
        {
            $result = $objectUser->existsEmail($email);
            if ($result)
            {
                $typeUser = "User";
                return $typeUser;
            }
        }
        
        return $typeUser;

    }

}