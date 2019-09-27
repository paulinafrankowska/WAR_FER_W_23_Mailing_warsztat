<?php
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    sleep(2);

    $name       = $_POST['name'];
    $email      = $_POST['email'];

    //sprawdzam błędy
    $errors     = Array();
    $return     = Array();
    if ( empty( $name ) ) {
        array_push( $errors, 'name' );
    }
    if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        array_push( $errors, 'email' );
    }

    if ( empty( $errors ) ) {
        //wysylam maila
        //mail wymaga ustawienia podstawowych nagłówków i treści
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . $email . "\r\n";
        $headers .= 'Reply-to: ' . $email;
        $message = '





        ';

        if ( mail( $email, 'Wiadomość ze strony - ' . date( "d-m-Y" ), $message, $headers ) ) {
            $return['status'] = 'ok';
        } else {
            $return['status'] = 'error';
        }

    } else {
        $return['errors'] = $errors;
    }

    header( 'Content-Type: application/json' );
    echo json_encode( $return );
}