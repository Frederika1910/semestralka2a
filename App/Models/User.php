<?php

namespace  App\Models;
use App\Core\Model;
use App\Core\DB\Connection;
class User extends \App\Core\Model
{

    public function __construct(
        public ?string $login = null,
        public int $id = 0,
        public ?string $password = null,
        public ?string $name = null,
        public ?string $surname = null
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'login', 'password', 'name', 'surname'];
    }

    static public function setTableName()
    {
        return "users";
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string|null $login
     */
    public function setLogin(?string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public static function findUser($login)
    {
        $statement = Connection::connect()->prepare("SELECT * FROM users WHERE login = ?");
        $statement->execute([$login]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Models\User::class);
        $user = $statement->fetch();
    }

    /**
    public static function validateEmail(string $email)
    {
        if($email == "" || !preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
            return false;
        }

        return true;
    }

    public static function validatePassword($password)
    {
        if($password == "") {
            return false;
        } //elseif(strlen($password)<5){
           // return false;
        //}

        return true;
    }

    public static function validateName(string $name): ?string
    {
        if($name == ""){
            return "Nie praznde";
        }

        return null;
    }

    public static function validateSurname(string $surname)
    {
        if($surname == ""){
            return false;
        }

        return true;
    }
    **/

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

}