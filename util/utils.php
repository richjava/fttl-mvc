<?php

class Utils {

    public static function createLink($page, array $params = array()) {
        $mergedParams = array_merge(array('page' => $page), $params);
        return 'index.php?' . http_build_query($mergedParams);
    }

    public static function redirect($page, array $params = array()) {
        header('Location: ' . self::createLink($page, $params));
        die();
    }

    public static function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES . ENT_QUOTES);
    }

    public static function getUrlParam($name) {
        if (!array_key_exists($name, $_GET)) {
            throw new NotFoundException('URL parameter ' . $name . ' not found.');
        }
        return $_GET[$name];
    }

    /**
     * Get {@link FlightBooking} by the identifier 'id' found in the URL.
     * @return FlightBooking {@link FlightBooking} instance
     * @throws NotFoundException if the param or {@link FlightBooking} instance is not found
     */
    public static function getFlightBookingByGetId() {
        $id = null;
        try {
            $id = self::getUrlParam('id');
        } catch (Exception $ex) {
            throw new NotFoundException('No FlightBooking identifier provided.');
        }
        if (!is_numeric($id)) {
            throw new NotFoundException('Invalid FlightBooking identifier provided.');
        }
        $dao = new FlightBookingDao();
        $flightBooking = $dao->findById($id);
        if ($flightBooking === null) {
            throw new NotFoundException('Unknown FlightBooking identifier provided.');
        }
        return $flightBooking;
    }

    /**
     * Capitalize the first letter of the given string
     * @param string $string string to be capitalized
     * @return string capitalized string
     */
    public static function capitalize($string) {
        return ucfirst(mb_strtolower($string));
    }

    /**
     * Format date and time.
     * @param DateTime $date date to be formatted
     * @return string formatted date and time
     */
    public static function formatDateTime(DateTime $date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('m/d/Y H:i');
    }

}
