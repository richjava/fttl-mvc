<?php
$status = Utils::getUrlParam('status');
//TodoValidator::validateStatus($status);
//
$dao = new FlightBookingDao();

// data for template
$title = ucfirst($status) . ' bookings';
$flightBookings = $dao->find($status);

