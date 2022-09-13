<?php
require_once(MB_BASE_PATH."model/BaseModel.php");

class ReportModel extends BaseModel {


    public $isLoaded = false;
    public $clientType;
    public $clientID;
    public $startDate;
    public $endDate;
    public $fileType;

    public function generateReport($data) {
        $result = array();
        if($data) {
            $this->clientType = $data->client_type;
            $this->clientID = $data->client_id;
            $this->startDate  = new DateTime($data->start_date);
            $this->endDate    = new DateTime($data->end_date);
            $this->fileType   = $data->report_type;
        }
        
        switch($this->clientType) {
            //  Liste aller Mandanten jeweils mit der Gesamtzeit am System
            case "all_clients":
                $result = $this->getWarp()->getDatabase()->getAll("SELECT m.id, m.name, SUM(TIME_TO_SEC(TIMEDIFF(l.enddate, l.startdate))) as total FROM mandanten m JOIN benutzer u ON m.id = u.mandant JOIN logs l ON l.user_id = u.id WHERE m.active = 1 GROUP BY m.id"); 
            break;
            //  Liste aller Mandanten jeweils mit der Gesamtzeit am System, gefiltert für einen gewissen Zeitraum
            case "all_clients_with_time":
                $result = $this->getWarp()->getDatabase()->getAll("SELECT m.id, m.name, SUM(TIME_TO_SEC(TIMEDIFF(l.enddate, l.startdate))) as total FROM mandanten m
                                                                    JOIN benutzer u ON m.id = u.mandant
                                                                    JOIN logs l ON l.user_id = u.id
                                                                    WHERE (l.startdate >= ? AND l.enddate <= ?) AND m.active = 1
                                                                    GROUP BY m.id", array($this->startDate->format('Y-m-d H:i:s'), $this->endDate->format('Y-m-d H:i:s')));
            break;
            //  Liste aller Mandanten mit den dazugehörigen Benutzern
            case "all_clients_and_users":
                $result = $this->getWarp()->getDatabase()->getAll("SELECT m.id as mandant_id, m.name as mandant_name, u.id as benutzer_id, u.name as benutzer_name FROM benutzer u
                                                                    JOIN mandanten m ON m.id = u.mandant WHERE m.active = 1"); 
            break;
            //  Liste eines Mandanten mit der Nutzungszeit eines jeden Benutzers dieses Mandanten
            case "one_client":
                $result = $this->getWarp()->getDatabase()->getAll("SELECT m.id, m.name, u.name, SUM(TIME_TO_SEC(TIMEDIFF(l.enddate, l.startdate))) as total FROM mandanten m
                                                                    JOIN benutzer u ON m.id = u.mandant
                                                                    JOIN logs l ON l.user_id = u.id
                                                                    WHERE m.id = ? AND m.active = 1
                                                                    GROUP BY u.id", array($this->clientID));
            break;
            //  Liste eines Mandanten mit der Nutzungszeit eines jeden Benutzers dieses Mandanten, gefiltert für einen gewissen Zeitraum
            case "one_client_with_time":
                $result = $this->getWarp()->getDatabase()->getAll("SELECT m.id, m.name, u.name, SUM(TIME_TO_SEC(TIMEDIFF(l.enddate, l.startdate))) as total FROM mandanten m
                                                                    JOIN benutzer u ON m.id = u.mandant
                                                                    JOIN logs l ON l.user_id = u.id
                                                                    WHERE m.id = ? AND (l.startdate >= ? AND l.enddate <= ?) AND m.active = 0
                                                                    GROUP BY u.id", array($this->clientID, $this->startDate->format('Y-m-d H:i:s'), $this->endDate->format('Y-m-d H:i:s')));
            break;
        }
        
        
        switch($this->fileType) {
            case "csv":
                return $this->getWarp()->getUtils()->createCSV($result, $this->clientType, 'report.csv');
            break;
            case "html":
                return $this->getWarp()->getUtils()->createHtml($result, $this->clientType, 'report.html');
            break;
        }
        return $result;
    }

}
