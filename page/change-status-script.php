<?php
//status of list
$status = Utils::getUrlParam('status');
//command
$cmd = Utils::getUrlParam('cmd');
$flightBooking = Utils::getFlightBookingByGetId();
$flightBooking->setStatus($cmd);
//if (array_key_exists('comment', $_POST)) {
//    $todo->setComment($_POST['comment']);
//}

$dao = new FlightBookingDao();
$dao->save($flightBooking);
$msg = '';
if($cmd === FlightBooking::VOIDED){
    $msg = 'Flight booking deleted successfully.';
}else{
    $msg = 'Flight booking status changed successfully.';
}
Flash::addFlash($msg);

Utils::redirect('list', array('status' => $status));

