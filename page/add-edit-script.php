<?php
$errors = array();
$flightBooking = null;

$edit = array_key_exists('id', $_GET);
if ($edit) {
    $flightBooking = Utils::getFlightBookingByGetId();
} else {
    // set defaults
    $flightBooking = new FlightBooking();
    //$flightBooking->setPriority(Todo::PRIORITY_MEDIUM);
    //$dueOn = new DateTime("+1 day");
    //$dueOn->setTime(0, 0, 0);
    //$flightBooking->setDueOn($dueOn);
}

if (array_key_exists('cancel', $_POST)) {
    // redirect
    //Utils::redirect('detail', array('id' => $flightBooking->getId()));
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    //pretending to have values in $_POST
    //$data = array('first_name' => 'Bob', 'no_of_passengers' => 2);
    $data = array(
        'first_name' => $_POST['flight_booking']['first_name'],
        'no_of_passengers' => $_POST['flight_booking']['no_of_passengers']
    );
    // map
    FlightBookingMapper::map($flightBooking, $data);
    // validate
    $errors = FlightBookingValidator::validate($flightBooking);

    if (empty($errors)) {
        // save
        $dao = new FlightBookingDao();
        $flightBooking = $dao->save($flightBooking);
        Flash::addFlash('Thank you for booking with us. We will be in touch shortly.');
        // redirect
        Utils::redirect('home');
    }
}
