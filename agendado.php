<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Reservación de Mantenimiento</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/img/favicon.png"
    />
    <!-- Place favicon.ico in the root directory -->

    <!-- ======== CSS here ======== -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ======== preloader start ======== -->
    <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- preloader end -->

    

    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
      <div class="container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1 class="wow fadeInUp" data-wow-delay=".4s">
<?php
    //require 'cn/database.php';
    require 'functions.php';
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
        if(validarReservado()){
            try {
                
                $sql = 'select reservado, fecha, horario from reservacion where correo=?';
                $correo = 'sgalvan@sictel.com';
                $comando = Database::getInstance()->getDb() -> prepare($sql);
                $comando -> execute(array($correo));
                $row = $comando -> fetch(PDO::FETCH_ASSOC);
                if($row){
                    $date = strtotime($row["fecha"]); 
                    echo'<h1>Usted ha reservado su mantenimiento para el día: '.$dias[date('D', $date)].' '.date('d', $date).' de '.$meses[date('M', $date)].' en el horario de las: '.$row["horario"].' hrs </h1>';
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
                    $correo = "prueba10@sictel.com";
                    $nombre = "Prueba Rodriguez";
                    $fecha = $_COOKIE["fechajs"];
                    $date = strtotime($fecha);
                    $fecha = date('Y-m-d', $date);
                    $horario = $_COOKIE["horariojs"];
                    $comando = Database::getInstance()->getDb() -> prepare($sql);
                    $comando -> execute(array($correo, $nombre, $fecha, $horario));
                    $result = $comando -> fetch(PDO::FETCH_ASSOC);
                    echo'<h1>Usted ha reservado su mantenimiento para el día: '.$dias[date('D', $date)].' '.date('d', $date).' de '.$meses[date('M', $date)].' en el horario de las: '.$horario.'hrs</h1>';
                } catch (PDOException $e) {
                    echo ''.$e->getMessage().'';
                }
                unset($_COOKIE['fechajs']);
                unset($_COOKIE['horariojs']);  
            }else{
                header('Location: inicio.php');
            }
        }
    }else{
        header('Location: login.php');
    }
?>
 </h1>
              
              </div>
            </div>
            <div class="col-lg-6">
              <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                <img src="assets/sictel.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ======== hero-section end ======== -->
  
      <!-- ======== JS here ======== -->
      <script src="assets/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/wow.min.js"></script>
      <script src="assets/js/main.js"></script>
    </body>
  </html>
  