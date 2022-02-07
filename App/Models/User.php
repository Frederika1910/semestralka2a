<?php

namespace  App\Models;

class User extends \App\Core\Model
{

    public function __construct(
        public ?string $login = null,
        public int $id = 0,
        public ?string $password = null,
        public ?string $name = null,
        public ?string $surname = null,
        public ?string $admin = "false"
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'login', 'password', 'name', 'surname', 'admin'];
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

    /**
     * @return bool
     */
    public function getAdmin(): ?string
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     */
    public function setAdmin(string $admin)
    {
        $this->admin = $admin;
    }


}