<h1>Make a booking</h1>

<?php if (!empty($errors)): ?>
<ul class="errors">
    <?php foreach ($errors as $error): ?>
        <?php /* @var $error Error */ ?>
        <li><?php echo $error->getMessage(); ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<form action="#" method="post">
    <fieldset>
        <div class="field">
            <label>First name:</label>
            <input type="text" name="flight_booking[first_name]" value="<?php 
            echo Utils::escape($flightBooking->getFirstName()); ?>"/>
        </div>
        <div class="field">
            <label>Date:</label>
            <input type="date" name="flight_booking[date]" value="<?php 
            echo Utils::escape($flightBooking->getDate()->format('Y-m-d'));?>"/>
        </div>
        <div class="field">
            <label>No of passengers:</label>
            <select name="flight_booking[no_of_passengers]">
            <?php for ($i = 1; $i < 6; ++$i): ?>
                <option value="<?php echo $i; ?>"
                        <?php if ($i == $flightBooking->getNoOfPassengers()): ?>
                            selected="selected"
                        <?php endif; ?>
                        ><?php echo $i; ?></option>
            <?php endfor; ?>
            </select>            
        </div>
        <div class="wrapper">
            <input type="submit" name="cancel" value="CANCEL" class="submit" />
            <input type="submit" name="save" value="<?php echo $edit ? 'EDIT' : 'ADD'; ?>" class="submit" />
        </div>
    </fieldset>
</form>

