<?php

class Util {


    public static function filter_message( $data, $template_path ) {

        ob_start();
        include $template_path;
        $result = ob_get_clean();

        foreach( $data as $key => $value ) {
            if( is_string( $value ) ) {
                $result = str_replace( '['.$key.']', nl2br( $value ), $result );
            }
        }

        return $result;

    }

    public static function validate_cpf( $cpf ) {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
        if( strlen($cpf) != 11) {
            return false;
        }

        if( preg_match('/(\d)\1{10}/', $cpf ) ) {
            return false;
        }
    
        for($t = 9; $t < 11; $t++) {
            for($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public static function validate_date( $date, $format = 'Y-m-d' ) {
        $d = DateTime::createFromFormat( $format, $date );
        return $d && $d->format($format) === $date;
    }

}