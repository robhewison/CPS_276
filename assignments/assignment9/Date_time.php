<?php
require_once "Pdo_methods.php";

class Date_time {
    private $pdo;

    public function __construct() {
        $this->pdo = new PdoMethods();
    }

    public function checkSubmit() {
        if (isset($_POST['addNote'])) {
            return $this->addNote();
        } elseif (isset($_POST['getNotes'])) {
            return $this->getNotes();
        }
    }

    private function addNote() {
        if (empty($_POST['dateTime']) || empty($_POST['note'])) {
            return '<p>Please enter a date, time, and note.</p>';
        }

        $dateTime = strtotime($_POST['dateTime']);
        $note = htmlspecialchars($_POST['note']);
        $sql = "INSERT INTO notes (date_time, note) VALUES (:dateTime, :note)";
        $bindings = [
            [':dateTime', $dateTime, 'int'],
            [':note', $note, 'str']
        ];

        $result = $this->pdo->otherBinded($sql, $bindings);

        if ($result === 'noerror') {
            return '<p>Note added successfully!</p>';
        } else {
            return '<p>There was an error adding the note.</p>';
        }
    }

    private function getNotes() {
        if (empty($_POST['begDate']) || empty($_POST['endDate'])) {
            return '<p>Please select a beginning and ending date.</p>';
        }

        $begDate = strtotime($_POST['begDate']);
        $endDate = strtotime($_POST['endDate']) + 86400; //86400 is added to include the entire day of the selected date
        $sql = "SELECT date_time, note FROM notes WHERE date_time BETWEEN :begDate AND :endDate ORDER BY date_time DESC";
        $bindings = [
            [':begDate', $begDate, 'int'],
            [':endDate', $endDate, 'int']
        ];

        $result = $this->pdo->selectBinded($sql, $bindings);

        if ($result === 'error') {
            return '<p>There was an error retrieving the notes.</p>';
        }

        if (count($result) === 0) {
            return '<p>No notes found for the selected date range.</p>';
        }

        $output = '<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date and Time</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($result as $row) {
            $output .= '<tr>
                <td>' . date('m/d/Y h:i A', $row['date_time']) . '</td>
                <td>' . htmlspecialchars($row['note']) . '</td>
            </tr>';
        }

        $output .= '</tbody></table>';

        return $output;
    }
}