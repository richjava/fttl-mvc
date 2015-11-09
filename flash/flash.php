<?php

/**
 * Description of Flash
 *
 * @author richard_lovell
 */
class Flash {

    const FLASHES_KEY = '_flashes';

    private static $flashes = null;

    private static function init() {
        if(self::$flashes !== null){
            return;
        }
        if(!array_key_exists(self::FLASHES_KEY, $_SESSION)){
            $_SESSION[self::FLASHES_KEY]=array();
        }
        self::$flashes=&$_SESSION[self::FLASHES_KEY];
    }
    
    public static function hasFlashes(){
        self::init();
        return count(self::$flashes > 0);
    }

    public static function getFlashes(){
        self::init();
        $copy = self::$flashes;
        self::$flashes = array();
        return $copy;
    }
    
    public static function addFlash($message){
        if(!strlen(trim($message))){
            throw new Exception('Cannot insert empty flash message!');
        }
        self::init();
        self::$flashes[]=$message;
    }
}
