<?php

/**
 * Description of Error
 *
 * @author richard_lovell
 */
class Error {
    private $source;
    private $message;
    
    function __construct($source, $message) {
        $this->source = $source;
        $this->message = $message;
    }

    function getSource() {
        return $this->source;
    }

    function getMessage() {
        return $this->message;
    }
}
