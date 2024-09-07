<?php
    require 'cn/database.php';

    if(1==1){
        $sql = 'select reservado, fecha, horario from reservacion where correo=?';
        $correo = 'sgalvan@sictel.com';
        try {
            $comando = Database::getInstance()->getDb() -> prepare($sql);
            $comando -> execute(array($correo));
            $row = $comando -> fetch(PDO::FETCH_ASSOC);
            if($row){
                $time_input = strtotime($row["fecha"]); 
                $date_input = getDate($time_input); 
                print_r($date_input["weekday"]); 
                echo var_dump($row);
                echo'Usted ya ha reservado para el día';
            }
            else{
                header('Location: inicio.php');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



?>