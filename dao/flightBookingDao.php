<?php

/**
 * Description of FlightBookingDao
 *
 * @author richard_lovell
 */
class FlightBookingDao {

    private $db = null;

    public function __destruct() {
        $this->db = null;
    }

    function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig('db');
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (Exception $ex) {
            throw new Exception('DB connection error:' . $ex->getMessage());
        }
        return $this->db;
    }

    public function insert(FlightBooking $flightBooking) {
        //needs changing
        //$now = new DateTime();
        $flightBooking->setId(null);
        //$flightBooking->setCreatedOn($now);
        //$flightBooking->setLastModifiedOn($now);
        $flightBooking->setStatus(FlightBooking::PENDING);
        $sql = '
            INSERT INTO flight_bookings (id, first_name, no_of_passengers, status)
                VALUES (:id, :first_name, :no_of_passengers, :status)';
        return $this->execute($sql, $flightBooking);
    }

    /**
     * @return Todo
     * @throws Exception
     */
    private function update(FlightBooking $flightBooking) {
        //$todo->setLastModifiedOn(new DateTime());
        $sql = '
            UPDATE flight_bookings SET
                first_name = :first_name,
                no_of_passengers = :no_of_passengers,
                status = :status
            WHERE
                id = :id';
        return $this->execute($sql, $flightBooking);
    }

    public function save(FlightBooking $flightBooking) {
        if ($flightBooking->getId() !== null) {
            $this->update($flightBooking);
        } else {
            $this->insert($flightBooking);
        }
    }

    /**
     * Find {@link Todo} by identifier.
     * @return Todo Todo or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM flight_bookings WHERE id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $flightBooking = new FlightBooking();
        FlightBookingMapper::map($flightBooking, $row);
        return $flightBooking;
    }

    /**
     * Find all {@link FlightBooking}s by search criteria.
     * @return array array of {@link FlightBooking}s
     */
    public function find($status = null) {
        $result = array();
        $sql = 'SELECT id, first_name, no_of_passengers FROM flight_bookings WHERE '
                . 'status = "'.$status.'";';
        foreach ($this->query($sql) as $row) {
            $flightBooking = new FlightBooking();
            FlightBookingMapper::map($flightBooking, $row);
            $result[$flightBooking->getId()] = $flightBooking;
        }
        return $result;
    }

    /**
     * @return PDOStatement
     */
    private function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        if ($statement === false) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
    }

    /**
     * @return FlightBooking
     * @throws Exception
     */
    private function execute($sql, FlightBooking $flightBooking) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($flightBooking));
        if (!$flightBooking->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('TODO with ID "' . $flightBooking->getId() . '" does not exist.');
        }
        return $flightBooking;
    }

    private function getParams(FlightBooking $flightBooking) {
        $params = array(
            ':id' => $flightBooking->getId(),
            ':first_name' => $flightBooking->getFirstName(),
            ':no_of_passengers' => $flightBooking->getNoOfPassengers(),
            ':status' => $flightBooking->getStatus()
        );
//        if ($flightBooking->getId()) {
//            // unset created date, this one is never updated
//            unset($params[':created_on']);
//        }
        return $params;
    }

    private function executeStatement(PDOStatement $statement, array $params) {
        if (!$statement->execute($params)) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }

    private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

}
