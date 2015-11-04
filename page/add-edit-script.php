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

//if (array_key_exists('cancel', $_POST)) {
    // redirect
    //Utils::redirect('detail', array('id' => $flightBooking->getId()));
//} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    //pretending to have values in $_POST
    $data = array('first_name' => 'Bob', 'no_of_passengers' => 2);
//    $data = array(
//        'title' => $_POST['todo']['title'],
//        'due_on' => $_POST['todo']['due_on_date'] . ' ' . $_POST['todo']['due_on_hour'] . ':' . $_POST['todo']['due_on_minute'] . ':00',
//        'priority' => $_POST['todo']['priority'],
//        'description' => $_POST['todo']['description'],
//        'comment' => $_POST['todo']['comment'],
//    );
        ;
    // map
    FlightBookingMapper::map($flightBooking, $data);
    // validate
    //$errors = TodoValidator::validate($flightBooking);
    // validate
    //if (empty($errors)) {
        // save
        $dao = new FlightBookingDao();
        $flightBooking = $dao->save($flightBooking);
        //Flash::addFlash('TODO saved successfully.');
        // redirect
        //Utils::redirect('detail', array('id' => $flightBooking->getId()));
    //}
//}
