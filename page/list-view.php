<?php require 'partials/flashes.php'?>
<h1><?php echo $title; ?></h1>

<?php if (empty($flightBookings)): ?>
    <p>No flight bookings found.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>First name</th>
                <th>No of passengers</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flightBookings as $flightBooking): ?>
                <tr>
                    <td><?php echo $flightBooking->getFirstName(); ?></td>
                    <td><?php echo $flightBooking->getNoOfPassengers(); ?></td>
                    <td><?php echo Utils::escape(Utils::formatDateTime($flightBooking->getDate())); ?></td>
                    <td><a href="index.php?page=add-edit&id=<?php 
                    echo $flightBooking->getId(); ?>">Edit</a> | 
                        <a href="index.php?page=change-status&id=<?php 
                    echo $flightBooking->getId(); ?>&cmd=<?php 
                    echo FlightBooking::VOIDED; ?>&status=<?php 
                    echo $flightBooking->getStatus(); ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
