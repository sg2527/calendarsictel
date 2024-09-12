<?php


$appid = "b20432f1-a47e-4311-8b9b-6a75d43ed4d8";

$tennantid = "4b2793dc-049e-418a-a69c-ca2ad7309551";

$secret = "7b4c3ccf-55f3-43d1-8226-8cc36460154";

$login_url ="https://login.microsoftonline.com/".$tennantid."/oauth2/v2.0/authorize";
error_reporting(E_ERROR | E_PARSE);

session_start ();

if (isset ($_GET['action'])) {

}else{
    $GET['action'] = '';
}

$_SESSION['state']=session_id();

echo "<h1>Sistema de reservación de Mantenimiento Preventivo </h1><br>";


if (isset ($_SESSION['msatg'])){

   echo "<h2>Bienvenido/a  ".$_SESSION["uname"]." será redirigido en un momento </h2><br> ";
   
   header( "refresh:1;url=inicio.php" );

} //end if session

else   echo '<h2><p><a href="?action=login">Inicia sesión</a></p></h2>';


if ($_GET['action'] == 'login'){

   $params = array ('client_id' =>$appid,

      'redirect_uri' =>'http://localhost/calendarsictel/login.php',

      'response_type' =>'token',

      'scope' =>'https://graph.microsoft.com/User.Read',

      'state' =>$_SESSION['state']);

   header ('Location: '.$login_url.'?'.http_build_query ($params));

}


echo '

<script> url = window.location.href;

i=url.indexOf("#");

if(i>0) {

 url=url.replace("#","?");

 window.location.href=url;}

</script>

';


if (array_key_exists ('access_token', $_GET))

 {

   $_SESSION['t'] = $_GET['access_token'];

   $t = $_SESSION['t'];

$ch = curl_init ();

curl_setopt ($ch, CURLOPT_HTTPHEADER, array ('Authorization: Bearer '.$t,

                                            'Conent-type: application/json'));

curl_setopt ($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me/");

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

$rez = json_decode (curl_exec ($ch), 1);

if (array_key_exists ('error', $rez)){  

 var_dump ($rez['error']);    

 die();

}

else  {

$_SESSION['msatg'] = 1;  //auth and verified

$_SESSION['uname'] = $rez["displayName"];
$_SESSION['mail'] = $rez["mail"];

$_SESSION['id'] = $rez["id"];


}

curl_close ($ch);

   header ('Location: http://localhost/calendarsictel/login.php');

}


if ($_GET['action'] == 'logout'){

   unset ($_SESSION['msatg']);

   header ('Location: http://localhost/calendarsictel/login.php');

}



?>