<?php

$api_token = htmlspecialchars($_GET['token']);
$workstation_name = htmlspecialchars($_GET['workstation_name']);
$workstation_lan = htmlspecialchars($_GET['workstation_lan']);
$workstation_macaddr = htmlspecialchars($_GET['workstation_macaddr']);
$workstation_wan = htmlspecialchars($_GET['workstation_wan']);
$serial_number = htmlspecialchars($_GET['serial_number']);
$client_message = htmlspecialchars($_GET['client_message']);
$emailTo = 'example@mailbox.com';

if ($client_message == null or $client_message == ''){
    $client_message = 'No client message was supplied.';
}

if (!$api_token == null && !$workstation_name == null && !$workstation_lan == null && !$workstation_macaddr == null && !$workstation_wan == null && !$serial_number == null) {


    if (!$api_token == 'LONG_TOKEN_STRING_HERE'){
        http_response_code(403);  
        echo 'BAD REQUEST - 403';
        exit;
    }

    


    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Quick Support <example@mailbox.com>' . "\r\n";

    $message  = 'Workstation Name: ' . htmlspecialchars($workstation_name) . "<br/>";
    $message .= 'Internal IP: ' . htmlspecialchars($workstation_lan) . "<br/>";
    $message .= 'Mac Address: ' . htmlspecialchars($workstation_macaddr) . "<br/>";
    $message .= 'Wan Address: ' . htmlspecialchars($workstation_wan) . "<br/>";
    
    $message .= 'Message: ' . htmlspecialchars($client_message) . "<br/>";

    $subject = "Support Request from Workstation - " . htmlspecialchars($workstation_name);

        if (@mail($emailTo, $subject, $message, $headers, "-r".$emailTo)) {
            http_response_code(200);  // OK
            echo 'RECEIVED';
        } else {
            http_response_code(500);  // Internal Server Error
            echo 'FAILED - 500';
        }


} else {
    http_response_code(403);  // Forbidden
    echo 'BAD REQUEST - 403';
}
?>
