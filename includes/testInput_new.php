<?php
    function test_input($data, $type) {

        $data = trim($data);
        $data = filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $tmp_val_type = 'error';

        switch ($type) {
            case 'boolean':
                $tmp_val_type = FILTER_VALIDATE_BOOLEAN;break;
            case 'email':
                $data = filter_var($data, FILTER_SANITIZE_EMAIL);
                $tmp_val_type = FILTER_VALIDATE_EMAIL;break;
            case 'domain':
                $data = filter_var($data, FILTER_SANITIZE_URL);
                $tmp_val_type = FILTER_VALIDATE_DOMAIN;break;
            case 'float':
                $data = floatval(filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT));
                if($data == 0){
                    $tmp_val_type = 'nullnumber';break;
                } else {
                    $tmp_val_type = FILTER_VALIDATE_FLOAT;break;
                }
            case 'double':
                $data = floatval(filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT));
                if($data == 0){
                    $tmp_val_type = 'nullnumber';break;
                } else {
                    $tmp_val_type = FILTER_VALIDATE_FLOAT;break;
                }
            case 'integer':
                $data = intval(filter_var($data, FILTER_SANITIZE_NUMBER_INT));
                if($data == 0){
                    $tmp_val_type = 'nullnumber';break;
                } else {
                    $tmp_val_type = FILTER_VALIDATE_INT;break;
                }
            case 'string':
                $data = filter_var($data, FILTER_SANITIZE_STRING);
                $tmp_val_type = 'teststring';break;
            default:
                die('false');
        }

        if($tmp_val_type == 'teststring' && gettype($data) == 'string'){
            return $data;
        } else if($tmp_val_type == 'nullnumber' && gettype($data) == 'integer' || gettype($data) == 'double'){
            return $data;
        } else if(!filter_var($data, $tmp_val_type)){
            die();
        } else {
            return $data;
        }

    }

?>
