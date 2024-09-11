<?php

    session_start();

    require "vendor/autoload.php";
    //use CalendarSictel\Microsoft\Auth;
    
    $tenant = "4b2793dc-049e-418a-a69c-ca2ad7309551";
    $client_id = "b20432f1-a47e-4311-8b9b-6a75d43ed4d8";
    $client_secret = "";
    $callback = "http://localhost/calendarsictel/inicio.php";
    $scopes = ["User.Read"];

    //https://www.youtube.com/watch?v=GLV8XtUWVjk&t=2s
    //$microsoft = new Auth($tenant, $client_id, $client_secret, $callback, $scopes);

?>