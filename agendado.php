<?php
    require 'cn/database.php';
    //require 'logica.php';
    $meses = [
        'Jan'=> 'Enero',
        'Feb'=> 'Febrero',
        'Mar'=> 'Marzo',
        'Apr'=> 'Abril',
        'May'=> 'Mayo',
        'Jun'=> 'Junio',
        'Jul'=> 'Julio',
        'Aug'=> 'Agosto',
        'Sep'=> 'Septiembre',
        'Oct'=> 'Octubre',
        'Nov'=> 'Noviembre',
        'Dec'=> 'Diciembre',
    ];
    $dias = [
        'Mon'=> 'Lunes',
        'Tue'=> 'Martes',
        'Wed'=> 'Miércoles',
        'Thu'=> 'Jueves',
        'Fri'=> 'Viernes',
        'Sat'=> 'Sábado',
        'Sun'=> 'Domingo',
    ];

    if('login'=='login'){
        if(true){
            try {
                echo '<script> alert("Reservación validada"); </script>';
                $sql = 'select reservado, fecha, horario from reservacion where correo=?';
                $correo = 'sgalvan@sictel.com';
                $comando = Database::getInstance()->getDb() -> prepare($sql);
                $comando -> execute(array($correo));
                $row = $comando -> fetch(PDO::FETCH_ASSOC);
                if($row){
                    $date = strtotime($row["fecha"]); 
                    echo'Usted ha reservado su mantenimiento para el día: '.$dias[date('D', $date)].' '.date('d', $date).' de '.$meses[date('M', $date)].' en el horario de las: '.$row["horario"].' hrs';
                }
                else{
                    header('Location: inicio.php');
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }else{
            if(isset($_COOKIE["fechajs"]) && isset($_COOKIE["horariojs"])){
                //echo '<script> alert("fecha: '.$_COOKIE["fechajs"].'\nhorario: '.$_COOKIE["horariojs"].'"); </script>';
                try {
                    $sql = 'insert into reservacion (correo, nombre, fecha, horario, reservado) values (?, ?, ?, ?, 1)';
                    $correo = "prueba6@sictel.com";
                    $nombre = "Prueba Rodriguez";
                    $fecha = $_COOKIE["fechajs"];
                    $date = strtotime($fecha);
                    $fecha = date('Y-m-d', $date);
                    $horario = $_COOKIE["horariojs"];
                    $comando = Database::getInstance()->getDb() -> prepare($sql);
                    $comando -> execute(array($correo, $nombre, $fecha, $horario));
                    $result = $comando -> fetch(PDO::FETCH_ASSOC);
                    echo'Usted ha reservado su mantenimiento para el día: '.$dias[date('D', $date)].' '.date('d', $date).' de '.$meses[date('M', $date)].' en el horario de las: '.$horario.'hrs';
                } catch (PDOException $e) {
                    echo ''.$e->getMessage().'';
                }
                unset($_COOKIE['fechajs']);
                unset($_COOKIE['horariojs']);  
            }
        }
    }else{
        header('Location: login.php');
    }
?>