<?php

require_once "Connect.php";
session_start();

class Application extends Connect
{
    private $error_valid = false;

    private $error_valid_text = [];

    public function create($date, $time, $id_service, $master)
    {
        if (!$this->error_valid) {
            $id = $_SESSION['id_user'];
            $query = "INSERT INTO `booking`(`id_user`, `date`, `time`, `id_service`, `id_master`, `status`) 
            VALUES ('$id','$date','$time', $id_service,'$master','0')";
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
        return [
            "error_valid" => $this->error_valid,
            "error_valid_text" => $this->error_valid_text
        ];
    }

    public function create_service($name, $sallary, $id_category, $descr)
    {
        if (!$this->error_valid) {
            $id = $_SESSION['id_user'];
            $query = "INSERT INTO `service`(`name_service`, `sallary`, `id_category`, `descr`) 
            VALUES ('$name','$sallary','$id_category','$descr')";
            $result = mysqli_query($this->connection, $query);
            return $result;
        }
        return [
            "error_valid" => $this->error_valid,
            "error_valid_text" => $this->error_valid_text
        ];
    }

    public function getIdCategory()
    {
        $query = mysqli_fetch_all(mysqli_query($this->connection, "SELECT * FROM category"));
        return $query;
    }
    private function validate_us($car_number, $descr)
    {
        $this->checkEmpty($car_number, 'car_number', 'Введите гос.номер автомобиля');
        $this->checkEmpty($descr, 'descr', 'Введите описание');
    }

    private function checkEmpty($value, $field, $message)
    {
        if (empty($value)) {
            $this->error_valid = true;
            $this->error_valid_text[$field] = $message;
        }
    }
    public function get_applications_user()
    {
        $id = $_SESSION['id_user'];
        $query = "SELECT
        booking.id_book,
        booking.date,
        booking.time,
        service.id_service,
        service.name_service,
        service.sallary,
        u2.name AS master_name,
        u2.lastname as master_lastname,
        category.name_category,
        booking.status
    FROM booking INNER JOIN USER AS u1 ON
    booking.id_user = u1.id_user
    INNER JOIN service ON booking.id_service = service.id_service
    INNER JOIN MASTER ON booking.id_master = MASTER.id_master
    INNER JOIN USER AS u2
    ON MASTER
    .id_user = u2.id_user -- Второе соединение с таблицей пользователей для получения имени мастера
    INNER JOIN category ON service.id_category = category.id_category
    WHERE u1.id_user = $id ";
        $appls = mysqli_fetch_all(mysqli_query($this->connection, $query));
        return $appls;
    }
// Пагинация
// public function get_applications_user_Pag($limit, $offset) {
//     $id = $_SESSION['id_user'];
//     $query = "SELECT
//         booking.id_book,
//         booking.date,
//         booking.time,
//         service.id_service,
//         service.name_service,
//         service.sallary,
//         u2.name AS master_name,
//         u2.lastname AS master_lastname,
//         category.name_category,
//         booking.status
//     FROM booking
//     INNER JOIN USER AS u1 ON booking.id_user = u1.id_user
//     INNER JOIN service ON booking.id_service = service.id_service
//     INNER JOIN MASTER ON booking.id_master = MASTER.id_master
//     INNER JOIN USER AS u2 ON MASTER.id_user = u2.id_user
//     INNER JOIN category ON service.id_category = category.id_category
//     WHERE u1.id_user = $id
//     LIMIT $limit OFFSET $offset";
//     $result = mysqli_query($this->connection, $query);
//     return mysqli_fetch_all($result, MYSQLI_ASSOC);
// }

// public function getapplications_user_Pag() {
//     $id = $_SESSION['id_user'];
//     $result = mysqli_query($this->connection, "SELECT COUNT(*) as total FROM booking WHERE id_user = $id");
//     return mysqli_fetch_assoc($result)['total'];
// }

    public function get_applications_master()
    {
        $id = $_SESSION['id_user'];
        $query = "SELECT
        booking.id_book,
        booking.date,
        booking.time,
        service.name_service,
        service.sallary,
        u2.name AS master_name,
        u2.lastname AS master_lastname,
        category.name_category,
        booking.status,
        u1.name AS user_name,      -- Имя пользователя
        u1.lastname AS user_lastname  -- Фамилия пользователя
    FROM 
        booking
    INNER JOIN 
        USER AS u1 ON booking.id_user = u1.id_user
    INNER JOIN 
        service ON booking.id_service = service.id_service
    INNER JOIN 
        MASTER ON booking.id_master = MASTER.id_master
    INNER JOIN 
        USER AS u2 ON MASTER.id_user = u2.id_user  -- Второе соединение с таблицей пользователей для получения имени мастера
    INNER JOIN 
        category ON service.id_category = category.id_category
    WHERE 
        MASTER.id_user = $id";
        $appls = mysqli_fetch_all(mysqli_query($this->connection, $query));
        return $appls;
    }

    



}