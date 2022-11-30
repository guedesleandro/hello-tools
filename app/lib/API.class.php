<?php

class API {

    protected $client;
    protected $params = array();

    protected function add_param( $param, $value = null ) {

        if( is_array( $param ) ) {
            foreach( $param as $index => $value ) {
                $this->add_param( $index, $value );
            }
        }
        else {
            $this->params[$param] = $value;
        }

    }

    protected function call( $name, $result_name = null ) {

        $result = array();
        try {
            $xml_result = $this->client->__soapCall( $name, $this->params );
            $string = simplexml_load_string( $xml_result->$result_name );
            $result = json_encode( $string );
            error_log( print_r( $this->params, true ) );
            error_log( print_r( $result, true ) );
            return $result;
        }
        catch( \Throwable $error ) {
            error_log( print_r( $this->params, true ) );
            error_log( print_r( $error, true ) );
            $result = array( 
                'error' => true,
                'message' => $error->getMessage()
            );
            return (object) $result;
        }

    }

}

?>