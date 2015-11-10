<?php

/**
 * Description of FlightBooking
 *
 * @author richard_lovell
 */
class FlightBooking {

    private $id;
    private $firstName;
    private $noOfPassengers;
    private $date;
    private $status = self::PENDING;

    const PENDING = 'pending';
    const ACTIVE = 'active';
    const VOIDED = 'voided';

    function getFirstName() {
        return $this->firstName;
    }

    function getNoOfPassengers() {
        return $this->noOfPassengers;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setNoOfPassengers($noOfPassengers) {
        $this->noOfPassengers = $noOfPassengers;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    public static function allStatuses() {
        return array(
            self::PENDING,
            self::ACTIVE,
            self::VOIDED
        );
    }
    function getDate() {
        return $this->date;
    }

    function setDate($date) {
        $this->date = $date;
    }
}
