<?php
require("../includes/config/MySQL_ConexionDB.php");
function showTickets($supervisor) {
    global $db_con;
    $tickets = [];

    try {
        $query = "SELECT c.id, c.date, c.description, c.status as statusTicket, c.employee FROM complaints as c INNER JOIN employee as e ON c.employee = e.code WHERE e.supervisorId = :supervisor";
        $stm = $db_con->prepare($query);
        $stm->bindParam(':supervisor', $supervisor, PDO::PARAM_STR); 
        
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $tickets[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }


    return $tickets;
}

function getInfoPromotion($id) {
    global $db_con;

    try {
        $query = "SELECT name FROM promotion WHERE code = :id";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR); 
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $row['name'];
}

function getInfovacations($supervisor) {
    global $db_con;
    $users = [];

    try {
        $query = "SELECT v.id, v.startDate, v.endDate, v.status as VStatus, v.employee FROM vacations as v INNER JOIN employee as e on v.employee = e.code WHERE e.supervisorId = :supervisor";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':supervisor', $supervisor, PDO::PARAM_STR); 
        
        // Ejecutar la consulta
        $stmt->execute();

        // Obtener todas las filas de resultados
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $users;
}

function getInfoAbsences($supervisor) {
    global $db_con;
    $users = [];

    try {
        $query = "SELECT a.id, a.startDate, a.endDate, a.status, a.type, a.description, e.code as employee
                  FROM absence AS a
                  INNER JOIN employee AS e ON a.employee = e.code
                  WHERE e.supervisorId = :supervisor";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':supervisor', $supervisor, PDO::PARAM_STR); 
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $users;
}



function getInfoEmploy($supervisor) {
    global $db_con;
    $users = [];

    try {
        $query = "SELECT * FROM employee WHERE supervisorId = :supervisor";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':supervisor', $supervisor, PDO::PARAM_STR); 
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $users;
}

function getAttendance($supervisor) {
    global $db_con;
    $attendance = [];

    try {
        $query = "SELECT * FROM attendance as a INNER JOIN employee as e on a.employee = e.code WHERE e.supervisorId = :supervisor";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':supervisor', $supervisor, PDO::PARAM_STR); 
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $attendance[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $attendance;
}

function showIncidents(){
    global $db_con;
    $incidents = [];

    try {
        $query = "SELECT * FROM incident";
        $stm = $db_con->prepare($query);
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $incidents[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $incidents;
}

function showIncidentsID($id){
    global $db_con;
    $incidents = [];

    try {
        $query = "SELECT * FROM incident WHERE id = :id";
        $stm = $db_con->prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT); 
        
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $incidents[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $incidents;
}

function showPromotion(){
    global $db_con;
    $promotions = [];

    try {
        $query = "SELECT * FROM promotion";
        $stm = $db_con->prepare($query);
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $promotions[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $promotions;
}

function showApplication($supervisor){
    global $db_con;
    $applications = [];

    try {
        $query = "SELECT a.id, a.publicationDate, a.status as statusA, a.employee, a.promotion FROM application as a INNER JOIN employee as e ON a.employee = e.code WHERE e.supervisorId = :supervisor";
        $stm = $db_con->prepare($query);
        $stm->bindParam(':supervisor', $supervisor, PDO::PARAM_STR);
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $applications[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $applications;
}

function listWorkstation(){
    global $db_con;
    $workspace = [];

    try {
        $query = "SELECT * FROM position";
        $stm = $db_con->prepare($query);
        $stm->execute();
    
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $workspace[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }
    return $workspace;
}    

function showAttandance(){
    global $db_con;
    $attandance = [];

    try {
        $query = "SELECT * FROM ";
        $stm = $db_con->prepare($query);
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $attandance[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $attandance;
}

function showRatings($supervisor){
    global $db_con;
    $rating = [];

    try {
        $query = "SELECT p.code as id, p.score, p.evaluationDate, p.comments, p.employee FROM performance as p INNER JOIN employee as e ON e.code = p.employee WHERE e.supervisorId = :supervisor";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':supervisor', $supervisor, PDO::PARAM_STR); 
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rating[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $rating;
}

function showRatingID($id){
    global $db_con;
    $rating = [];

    try {
        $query = "SELECT * FROM performance WHERE code = :id";
        $stm = $db_con->prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_STR); 
        
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $rating[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $rating;
}

function showTicketsID($id){
    global $db_con;
    $ticket = [];

    try {
        $query = "SELECT * FROM complaints WHERE id = :id";
        $stm = $db_con->prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT); 
        
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $ticket[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $ticket;
}

function showBenefieID($id){
    global $db_con;
    $benefie = [];

    try {
        $query = "SELECT * FROM benefits WHERE code = :id";
        $stm = $db_con->prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_STR); 
        
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $benefie[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $benefie;
}

function showPromotionID($id){
    global $db_con;
    $promotion = [];

    try {
        $query = "SELECT * FROM promotion WHERE code = :id";
        $stm = $db_con->prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_STR); 
        
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $promotion[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $promotion;
}


function showAplicationID($id){
    global $db_con;
    $aplication = [];

    try {
        $query = "SELECT * FROM application WHERE id = :id";
        $stm = $db_con->prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_STR); 
        
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $aplication[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $aplication;
}














//                                                      Funciones de recursos humanos

function showDepartment(){
    global $db_con;
    $department = [];

    try {
        $query = "SELECT * FROM department";
        $stm = $db_con->prepare($query);
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $department[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $department;
}

function stadisticDepartment(){
    global $db_con;
    $stadisticas = [];
    try {
        $query = "SELECT d.name AS Department, AVG(p.score) AS Score FROM employee e JOIN performance p ON e.code = p.employee JOIN position pos ON e.positionCode = pos.code JOIN department d ON pos.departmentCode = d.code GROUP BY d.code, d.name ORDER BY Score DESC;";

        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stadisticas[] = [
                'department' => $row['Department'],
                'average_score' => floatval($row['Score'])
            ];
        }
        
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return json_encode($stadisticas);
}


function getAbsences() {
    global $db_con;
    $absences = [];

    try {
        $query = "SELECT a.id, a.startDate, a.endDate, a.status, a.type, a.description, e.code as employee
                  FROM absence AS a
                  INNER JOIN employee AS e ON a.employee = e.code";
        $stmt = $db_con->prepare($query);
       
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $absences[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $absences;
}

function getAttendanceAll() {
    global $db_con;
    $attendance = [];

    try {
        $query = "SELECT * FROM attendance as a INNER JOIN employee as e on a.employee = e.code";
        $stmt = $db_con->prepare($query);
        
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $attendance[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $attendance;
}

function showPosition(){
    global $db_con;
    $position = [];

    try {
        $query = "SELECT * FROM position ORDER BY departmentCode";
        $stm = $db_con->prepare($query);
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $position[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $position;
}

function getDepartmentName($id) {
    global $db_con;

    try {
        $query = "SELECT name FROM department WHERE code = :id";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR); 
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $row['name'];
}

function getInfoEmployees() {
    global $db_con;
    $users = [];

    try {
        $query = "SELECT * FROM employee";
        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $users;
}

function getInfoRating() {
    global $db_con;
    $rating = [];

    try {
        $query = "SELECT * FROM performance";
        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rating[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $rating;
}

function supervisor() {
    global $db_con; 
    $supervisores = [];

    try {
        $query = "SELECT CONCAT(firstname, ' ', lastname, ' ', middlename) AS nombre, code 
                  FROM employee 
                  WHERE supervisorId IS NULL";
        $stm = $db_con->prepare($query);
        $stm->execute();

        
        $supervisores = $stm->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $supervisores;
}

function supervisorDep($code) {
    global $db_con; 
    $supervisores = [];

    try {
        $query = "SELECT CONCAT(e.firstname, ' ', e.lastname, ' ', e.middlename) AS nombre, e.code 
                  FROM employee AS e
                  INNER JOIN position AS p ON e.positionCode = p.code
                  INNER JOIN department AS d ON p.departmentCode = d.code
                  WHERE supervisorId IS NULL AND d.code = :department";
        $stm = $db_con->prepare($query);
        $stm->bindParam(':department', $code, PDO::PARAM_STR); 
        $stm->execute();

        
        $supervisores = $stm->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $supervisores;
}

function showEmployeeID($id) {
    global $db_con;
    $users = [];

    try {
        $query = "SELECT * FROM employee where code = :id";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR); 
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $users;
}

function getInfoAplication() {
    global $db_con;
    $aplication = [];

    try {
        $query = "SELECT a.id, a.publicationDate, a.status as statusA, a.employee, a.promotion FROM application as a INNER JOIN employee as e ON a.employee = e.code ";
        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $aplication[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $aplication;
}

function getVacations() {
    global $db_con;
    $vacations = [];

    try {
        $query = "SELECT * FROM vacations";
        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vacations[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $vacations;
}

function showTicketsAll() {
    global $db_con;
    $tickets = [];

    try {
        $query = "SELECT c.id, c.date, c.description, c.status as statusTicket, c.employee FROM complaints as c INNER JOIN employee as e ON c.employee = e.code";
        $stm = $db_con->prepare($query);
        
        $stm->execute();

        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            $tickets[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }


    return $tickets;
}

function getAplicationDel() {
    global $db_con;
    $del = [];

    try {
        $query = "SELECT * FROM MD_aplications";
        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $del[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $del;
}

function getIncidentDel() {
    global $db_con;
    $del = [];

    try {
        $query = "SELECT * FROM MD_incident";
        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $del[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $del;
}

function getPromotionDel() {
    global $db_con;
    $del = [];

    try {
        $query = "SELECT * FROM MD_promotions";
        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $del[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $del;
}

function getBenefirDel() {
    global $db_con;
    $del = [];

    try {
        $query = "SELECT * FROM MD_benefies";
        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $del[] = $row;
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $del;
}

function getYearsWork($id){
    global $db_con;

    try {
        $query = "SELECT TIMESTAMPDIFF(YEAR, contractDate, NOW()) AS YEARS FROM employee where code = :id";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR); 
        $stmt->execute();

        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $row['YEARS'];
}

function getDaysVacations($id){
    global $db_con;

    try {
        $query = "SELECT SUM(TIMESTAMPDIFF(DAY, startDate, endDate)) AS days from vacations where employee = :id AND status = 'Approved'";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR); 
        $stmt->execute();

        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return $row['days'];
}


function DepEmploys() {
    global $db_con;
    $dep = [];
    try {
        $query = "SELECT d.name AS Department, count(e.code) AS Employees, sum(e.gender='F') AS Women, sum(e.gender='M') AS Men FROM employee AS e INNER JOIN position AS p ON e.positionCode = p.code INNER JOIN department AS d ON d.code = p.departmentCode WHERE e.status = 'Active' GROUP BY d.code;";

        $stmt = $db_con->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dep[] = [
                'department' => $row['Department'],
                'employees' => intval($row['Employees']),
                'women' => intval($row['Women']),
                'men' => intval($row['Men']),
            ];
        }
    } catch (PDOException $e) {
        exit("Error en la consulta: " . $e->getMessage());
    }

    return json_encode($dep);
}
?>