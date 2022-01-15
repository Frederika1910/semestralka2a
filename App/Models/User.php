<?php

namespace  App\Models;

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

    public static function validateEmail(string $email) : ?string
    {
        if($email == "") {
            return "Nezadali ste e-mailovú adresu.";
        } else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/", $email)) {
            return "Zadaná e-mailová adresa je v nesprávnom formáte.";
        }

        return null;
    }

    public static function validatePassword($password, $passwordControl) : ?string
    {
        if($password == "") {
            return "Nezadali ste heslo.";
        } elseif(strlen($password)<5){
            return "Heslo musí mať aspoň 5 znakov.";
        } else if (!preg_match("/[a-z]/", $password)) {
            return "Heslo nesmie obsahovať špeciálne znaky.";
        } else if (!preg_match("/[A-Z]/", $password)) {
            return "Heslo musí obsahovať aspoň 1 veľké písmeno.";
        } else if (!preg_match("/[0-9]/", $password)) {
            return "Heslo musí obsahovať aspoň 1 číslicu.";
        } else if ($passwordControl != null && strcmp($password, $passwordControl) != 0) {
            return "Heslá sa nezhodujú.";
        }

        return null;
    }

    public static function validateName(string $inp): ?string
    {
        if($inp == ""){
            return "Nezadali ste meno.";
        } else if (preg_match("/[0-9]/", $inp)) {
            return "Meno nesmie obsahovať číslice.";
        }

        return null;
    }

    public static function validateSurname(string $inp): ?string
    {
        if($inp == ""){
            return "Nezadali ste priezvisko.";
        } else if (preg_match("/[0-9]/", $inp)) {
            return "Priezvisko nesmie obsahovať číslice.";
        }

        return null;
    }

}