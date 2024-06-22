<?php
require_once "Connect.php";
class User extends Connect
{
    protected $name;

    protected $lastname;

    protected $email;

    protected $password;

    protected $role;

    public $check_email; //для проверки для регистрации и авторизации

    private $error_valid = false;

    private $error_valid_text = [];
    //регистрация пользователя, принимает параметры пришедшие с формы
    public function signup($name, $lastname, $email, $password, $role)
    {
        $result = mysqli_query($this->connection, "SELECT * FROM `user` WHERE `email` = '$email'");
        if (mysqli_num_rows($result) == 0) {
            $sql = mysqli_query($this->connection, "  
            INSERT INTO `user`( `name`, `lastname`, `email`, `password`)
            VALUES ('$name','$lastname','$email','$password')");
            return $this->check_email = true;
        } else {
            return $this->check_email = false;
        }
    }

    //функция для вывод всей информации о пользователе по id (личный кабинет и мед карта)
    public function selectDataUser($id_user)
    {
        $user = mysqli_fetch_assoc(mysqli_query($this->connection, "SELECT * FROM `user` WHERE `id_user`= $id_user"));
        return $user;
    }
    // ДЛЯ авторизации пользователя

    public function signin($email, $password)
    {
        $user = mysqli_fetch_assoc(mysqli_query($this->connection, "SELECT * FROM user WHERE email='$email'"));
        if ($user) {
            if ($password == $user["password"] && $email == $user["email"]) {

                $_SESSION["id_user"] = $user["id_user"];
                $_SESSION["name"] = $user["name"];
                $_SESSION["role"] = $user["role"];
                $this->check_email = null;
            } else {
                $this->check_email = true; // Верните false, если введены неверные данные 
            }
        } else {
            $this->check_email = false; // Верните false, если пользователь не найден 
        }
    }


    // функция для вывода мастеров
    public function getMasters()
    {
        $query = mysqli_fetch_all(mysqli_query($this->connection, "SELECT 
        master.id_master,
        master.id_user,
        user.name AS master_name,
        user.lastname AS master_lastname,
        user.email AS master_email,
        master.id_category,
        category.name_category,
        master.photo
    FROM master
    INNER JOIN user ON master.id_user = user.id_user
    INNER JOIN category ON master.id_category = category.id_category"));
        return $query;
    }

    // пагинация мастеров

    public function getNailMastersWithPagination($limit, $offset)
    {
        $result = mysqli_query($this->connection, "SELECT 
    master.id_master,
    master.id_user,
    user.name AS master_name,
    user.lastname AS master_lastname,
    user.email AS master_email,
    master.id_category,
    category.name_category,
    master.photo
FROM master
INNER JOIN user ON master.id_user = user.id_user
INNER JOIN category ON master.id_category = category.id_category WHERE master.id_category = 1 LIMIT $limit OFFSET $offset");
        return mysqli_fetch_all($result);
    }

    public function getMakeupMastersWithPagination($limit, $offset)
    {
        $result = mysqli_query($this->connection, "SELECT 
        master.id_master,
        master.id_user,
        user.name AS master_name,
        user.lastname AS master_lastname,
        user.email AS master_email,
        master.id_category,
        category.name_category,
        master.photo
    FROM master
    INNER JOIN user ON master.id_user = user.id_user
    INNER JOIN category ON master.id_category = category.id_category WHERE master.id_category = 2 LIMIT $limit OFFSET $offset");
        return mysqli_fetch_all($result);
    }

    public function getTotalNailMasters()
    {
        $result = mysqli_query($this->connection, "SELECT COUNT(*) FROM `master` WHERE `id_category` = 1");
        return mysqli_fetch_array($result)[0];
    }

    public function getTotalMakeupMasters()
    {
        $result = mysqli_query($this->connection, "SELECT COUNT(*) FROM `master` WHERE `id_category` = 2");
        return mysqli_fetch_array($result)[0];
    }


    // функция для вывода мастеров ногтевого сервиса
    public function getNailMasters()
    {
        $query = mysqli_fetch_all(mysqli_query($this->connection, "SELECT 
        master.id_master,
        master.id_user,
        user.name AS master_name,
        user.lastname AS master_lastname,
        user.email AS master_email,
        master.id_category,
        category.name_category,
        master.photo
    FROM master
    INNER JOIN user ON master.id_user = user.id_user
    INNER JOIN category ON master.id_category = category.id_category WHERE master.id_category = 1;"));
        return $query;
    }

    // функция для вывода мастеров стилистов визажистов
    public function getMakeupMasters()
    {
        $query = mysqli_fetch_all(mysqli_query($this->connection, "SELECT 
            master.id_master,
            master.id_user,
            user.name AS master_name,
            user.lastname AS master_lastname,
            user.email AS master_email,
            master.id_category,
            category.name_category,
            master.photo
        FROM master
        INNER JOIN user ON master.id_user = user.id_user
        INNER JOIN category ON master.id_category = category.id_category WHERE master.id_category = 2;"));
        return $query;
    }

    // функция для вывода услуг ногтевого сервиса
    public function getService()
    {
        $query = mysqli_fetch_assoc(mysqli_query($this->connection, "SELECT * FROM `service` "));
        return $query;
    }

    // функция для вывода услуг ногтевого сервиса
    public function getNailService()
    {
        $query = mysqli_fetch_all(mysqli_query($this->connection, "SELECT * FROM `service` WHERE id_category = 1;"));
        return $query;
    }

    // функция для вывода услуг стилистов визажистов
    public function getMakeupService()
    {
        $query = mysqli_fetch_all(mysqli_query($this->connection, "SELECT * FROM `service` WHERE id_category = 2;"));
        return $query;
    }
}
?>