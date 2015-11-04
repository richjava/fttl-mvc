<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightBookingMapper
 *
 * @author richard_lovell
 */
class FlightBookingMapper {
    
    public static function map(FlightBooking $flightBooking, array $properties){
        if(array_key_exists('id', $properties)){
            $flightBooking->setId($properties['id']);
        }
        if(array_key_exists('first_name', $properties)){
            $flightBooking->setFirstName($properties['first_name']);
        }
        if(array_key_exists('no_of_passengers', $properties)){
            $flightBooking->setNoOfPassengers($properties['no_of_passengers']);
        }
    }
}
