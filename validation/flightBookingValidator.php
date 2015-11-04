<?php

/**
 * A class for validating the Flight bookings.
 * @author Richard Lovell
 */
class FlightBookingValidator{
    
    public static function validate(FlightBooking $flightBooking){
        $errors = array();
        if(!trim($flightBooking->getTitle())){
            $errors[] = new Error('title', 'Title cannot be empty.');
        }
        return $errors;
    }
    
    /**
     * Validate the given status.
     * @param string $status status to be validated
     * @throws Exception if the status is not known
     */
    public static function validateStatus($status) {
        if (!self::isValidStatus($status)) {
            throw new NotFoundException('Unknown status: ' . $status);
        }
    }
    
    private static function isValidStatus($status) {
        return in_array($status, Todo::allStatuses());
    }
}

