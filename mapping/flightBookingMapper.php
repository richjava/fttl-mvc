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

    public static function map(FlightBooking $flightBooking, array $properties) {
        if (array_key_exists('id', $properties)) {
            $flightBooking->setId($properties['id']);
        }
        if (array_key_exists('first_name', $properties)) {
            $flightBooking->setFirstName($properties['first_name']);
        }
        if (array_key_exists('no_of_passengers', $properties)) {
            $flightBooking->setNoOfPassengers($properties['no_of_passengers']);
        }
        if (array_key_exists('date', $properties)) {
            $formattedDate = $properties['date'];
            $date = self::createDateTime($formattedDate);
            if ($date) {
                $flightBooking->setDate($date);
            }
        }
    }

    private static function createDateTime($input) {
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
//        $date = explode('-', $input);
//        $time = mktime(0, 0, 0, $date[2], $date[1], $date[0]);
//        $mysqldate = date('Y-m-d H:i:s', $time);
//        return $mysqldate;
        //return date('d/m/Y', strtotime($input));
        //return new DateTime($input);//date('Y-m-d H:i:s', strtotime($input));
    }

}
