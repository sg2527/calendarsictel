<?php
    require 'cn/database.php';

    
    function validarReservado(){
        try{
            
            $sql = 'select reservado from reservacion where correo=?';
                    $correo = 'sgalsvan@sictel.com';
                    $comando = Database::getInstance()->getDb() -> prepare($sql);
                    $comando -> execute(array($correo));
                    $row = $comando -> fetch(PDO::FETCH_ASSOC);
                    if($row['reservado'] == '1'){
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
        //libxml_use_internal_errors(true);
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
                //$horasdiff = array_diff($horas, $row[0]['horario']);

                foreach($row as $hora){
                    $result[]=$hora['horario'];
                    /*foreach($horas as $hor){
                        
                        if($hora['horario'] == $hor){
                            unset($horas[$i]);
                            echo '<script> alert("'.$hor.'\n vuelta: '.$i.'");</script>';
                        }
                        $i++;
                    }
                    $i=0;*/
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

?>