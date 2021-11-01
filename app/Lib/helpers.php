<?php

if ( ! function_exists('AlertMessage'))
{

    function AlertMessage($message, $alert_type) {
        return array(
            'message' => $message,
            'alert-type' => $alert_type,
        );
    }
}

?>