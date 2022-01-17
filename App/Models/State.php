<?php

namespace App\Models;

class State extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public ?string $nameState = null
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id','nameState'];
    }

    static public function setTableName()
    {
        return "states";
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
    public function getNameState(): ?string
    {
        return $this->nameState;
    }

    /**
     * @param string|null $nameState
     */
    public function setNameState(?string $nameState): void
    {
        $this->nameState = $nameState;
    }
}