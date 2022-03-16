<?php

if ($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $visitor_message = "";

    if (isset($_POST['name'])) {
        $visitor_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
    }

    if (isset($_POST['message'])) {
        $visitor_message = htmlspecialchars($_POST['message']);
    }

    // if ($concerned_department == "billing") {
    //     $recipient = "billing@domain.com";
    // } else if ($concerned_department == "marketing") {
    //     $recipient = "marketing@domain.com";
    // } else if ($concerned_department == "technical support") {
    //     $recipient = "tech.support@domain.com";
    // } else {
    //     $recipient = "contact@domain.com";
    // }

    $recipient = "ilham.maulana.07.0698@gmail.com";

    $headers = 'MIME-Version: 1.0' . "\r\n"
        . 'Content-type: text/html; charset=utf-8' . "\r\n"
        . 'From: ' . $visitor_email . "\r\n";

    if (mail($recipient, $visitor_message, $headers)) {
        echo "<script type='text/javascript'>alert('Thank you for contacting us, $visitor_name. You will get a reply within 24 hours.');</script>";
        header('Location: ' . $_SERVER["HTTP_REFERER"]);
        exit;
    } else {
        echo "<script type='text/javascript'>alert('We are sorry but the email did not go through.');</script>";
        header('Location: ' . $_SERVER["HTTP_REFERER"]);
        exit;
    }

    // echo "<script type='text/javascript'>alert('Thank you for contacting us, $visitor_name. You will get a reply within 24 hours.');</script>";


} else {
    echo "<script type='text/javascript'>alert('Something went wrong');</script>";
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit;
}
