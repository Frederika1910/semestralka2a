<?php

namespace App\Models;

class Order extends \App\Core\Model
{

    public function __construct(
        public int $id = 0,
        public int $user_id=0,

    )
    {
    }

    static public function setDbColumns()
    {
        return ['id','user_id'];
    }

    static public function setTableName()
    {
        return "orders";
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

}