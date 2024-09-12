<?php
    require 'cn/database.php';
<<<<<<< HEAD
    $horas = ["10:00:00", "11:00:00", "12:00:00", "13:00:00", "15:00:00", "16:00:00"];
    $disponiblesSep = [
        '17' => $horas,
        '18' => $horas,
        '19' => $horas,
        '20' => $horas,
        '21' => $horas,
        '22' => $horas,
        '23' => $horas,
        '24' => $horas,
        '25' => $horas,
        '26' => $horas,
        '27' => $horas,
        '28' => $horas,
        '29' => $horas,
        '30' => $horas,
    ];
=======
    session_start();
    
>>>>>>> refs/remotes/origin/main
    function validarReservado(){
        try{
            
            $sql = 'select reservado from reservacion where correo=?';
                    $correo = $_SESSION["mail"];
                    $comando = Database::getInstance()->getDb() -> prepare($sql);
                    $comando -> execute(array($correo));
                    $row = $comando -> fetch(PDO::FETCH_ASSOC);
                    
                    if($row){
                        return true;
                    }
                    else{
                        return false;
                    }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function validarDias($fecha){ 
        $dochtml = new DOMDocument();
        $dochtml->loadHTMLFile("inicio.php");
        $dochtml->validateOnParse = true; 
        $div = $dochtml->getElementById("fecha-select")->textContent;
        echo 'valor div: '.$div;
        $horas = ["10:00:00", "11:00:00", "12:00:00", "13:00:00", "15:00:00", "16:00:00"];
        $i = 0;
        $date = strtotime($fecha);
        $fecha = date('Y-m-d', $date);
        try{
            $sql = 'select horario from reservacion where fecha=?';
            $result = [];
            $comando = Database::getInstance()->getDb() -> prepare($sql);
            $comando -> execute(array($fecha));
            $row = $comando -> fetchAll(PDO::FETCH_ASSOC);
            if($row){

                foreach($row as $hora){
                    $result[]=$hora['horario'];
                    
                }
                $horasdiff = array_diff($horas, $result);
                return var_dump($horasdiff);
            }
            else{
                return var_dump($horas);
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    $disponiblesSep = [
        '17' => $horas,
        '18' => $horas,
        '19' => $horas,
        '20' => $horas,
        '21' => $horas,
        '22' => $horas,
        '23' => $horas,
        '24' => $horas,
        '25' => $horas,
        '26' => $horas,
        '27' => $horas,
        '28' => $horas,
        '29' => $horas,
        '30' => $horas,
    ];

    function getAllDays(){
        try{
            $sql = "SELECT fecha, horario, reservado FROM `reservacion` WHERE fecha between '2024-09-17' and '2024-11-30'";
            
            $comando = Database::getInstance()->getDb() -> prepare($sql);
            $comando -> execute();
            $row = $comando -> fetchAll(PDO::FETCH_ASSOC);
            var_dump($GLOBALS['disponiblesSep']);
            if($row){
                foreach($row as $hora){
                
                }
                
            }
        }catch(PDOException $e){   
            echo $e->getMessage();
        }
    }

?>