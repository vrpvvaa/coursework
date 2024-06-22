<?php

require_once "..\Connect.php";
session_start();

class Admin extends Connect
{
    protected $name;

    protected $lastname;

    protected $email;

    protected $password;

    protected $role;

    public $check_email; //для проверки для регистрации и авторизации

    private $error_valid = false;

    private $error_valid_text = [];

    public function getIdCategory()
    {
        $query = mysqli_fetch_all(mysqli_query($this->connection, "SELECT * FROM category"));
        return $query;
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

   public function signupMaster($name, $lastname, $email, $images, $id_category, $password, $role)
{
    $result = mysqli_query($this->connection, "SELECT * FROM `user` WHERE `email` = '$email'");

    // Проверьте структуру массива $images для отладки
    var_dump($images);

    if (isset($images['photo'])) {
        $photo_tmp_name = $images['photo']['tmp_name'];
        $photo_name = $images['photo']['name'];

        // Перемещаем загруженный файл
        if (move_uploaded_file($photo_tmp_name, "../../img/master/" . $photo_name)) {
            echo "Файл успешно загружен.";
        } else {
            echo "Ошибка при загрузке файла.";
        }

        // Отладка имени файла
        var_dump($photo_name);

        if (mysqli_num_rows($result) == 0) {
            $sql = mysqli_query($this->connection, "  
            INSERT INTO `user`( `name`, `lastname`, `email`, `password`, `role`)
            VALUES ('$name','$lastname','$email','$password', '2')");
            $id = $this->connection->insert_id;
            $query = mysqli_query($this->connection, "INSERT INTO `master`( `id_user`, `id_category`, `photo`) 
            VALUES ('$id', '$id_category', '$photo_name')");
            var_dump($query);

            return $this->check_email = true;
        } else {
            return $this->check_email = false;
        }
    } else {
        echo "Ключ 'photo' не найден в массиве \$images.";
        return false;
    }
}

    // функция для вывода мастеров ногтевого сервиса
//     public function getNailMastersService()
//     {
//         $query = mysqli_fetch_all(mysqli_query($this->connection, "SELECT 
//         booking.id_book,
//         master.id_master,
//         u2.name AS master_name,
//         u2.lastname AS master_lastname,
//         u2.email AS master_email,
//         category.name_category,
//         master.photo,
//         service.name_service,
//         service.descr,
//         service.sallary,
//         u1.name AS client_name,
//         u1.lastname AS client_lastname,
//         booking.status,
//         booking.date,
//         booking.time
//     FROM 
//          master
//     INNER JOIN user AS u2 ON master.id_user = u2.id_user
//     INNER JOIN category ON master.id_category = category.id_category
//     INNER JOIN booking ON master.id_master = booking.id_master
//     INNER JOIN service ON booking.id_service = service.id_service
//     INNER JOIN user AS u1 ON booking.id_user = u1.id_user
//     WHERE category.id_category = 1
// ORDER BY 
// booking.date ASC, booking.time ASC
// LIMIT 1;"));
//         return $query;
//     }

    // функция для вывода мастеров ногтевого сервиса
    // public function getMastersService()
    // {
    //     $query = mysqli_fetch_all(mysqli_query($this->connection, "SELECT 
    //     sorted_booking.id_book,
    //     sorted_booking.date,
    //     sorted_booking.time,
    //     service.name_service,
    //     service.sallary,
    //         u2.email AS master_email,
    //     u2.name AS master_name,
    //     u2.lastname AS master_lastname,
    //     category.name_category,
    //     sorted_booking.status,
    //     u1.name AS client_name,
    //     u1.lastname AS client_lastname,
    //     master.photo
    // FROM (
    //     SELECT 
    //         booking.id_book,
    //         booking.id_master,
    //         booking.id_user,
    //         booking.id_service,
    //         booking.date,
    //         booking.time,
    //         booking.status,
    //         ROW_NUMBER() OVER (PARTITION BY booking.id_master ORDER BY booking.date ASC, booking.time ASC) AS rn
    //     FROM 
    //         booking
    // ) AS sorted_booking
    // INNER JOIN 
    //     master ON sorted_booking.id_master = master.id_master
    // INNER JOIN 
    //     user AS u2 ON master.id_user = u2.id_user
    // INNER JOIN 
    //     category ON master.id_category = category.id_category
    // INNER JOIN 
    //     service ON sorted_booking.id_service = service.id_service
    // INNER JOIN 
    //     user AS u1 ON sorted_booking.id_user = u1.id_user
    // WHERE 
    //     sorted_booking.rn = 1
    // ORDER BY 
    //     sorted_booking.date ASC, sorted_booking.time ASC;    
    // "));
    //     return $query;
    // }


}