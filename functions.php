<?php
    require 'cn/database.php';
    function validarReservado(){
        try{
            
            $sql = 'select reservado from reservacion where correo=?';
                    $correo = 'sgalvan@sictel.com';
                    $comando = Database::getInstance()->getDb() -> prepare($sql);
                    $comando -> execute(array($correo));
                    $row = $comando -> fetch(PDO::FETCH_ASSOC);
                    echo '<script> alert("se obtuvo el valor"); </script>';
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

?>