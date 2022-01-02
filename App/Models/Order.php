<?php

namespace App\Models;

class Order extends \App\Core\Model
{

    public function __construct(
        public int $id = 0,
        public int $user_id=0,
        public ?string $street = null,
        public int $house_number = 0,
        public ?string $psc = null,
        public ?string $city = null,
        public ?string $country = null,
        public int $mobile_number = 0
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id','user_id', 'street', 'house_number', 'psc', 'city', 'country','mobile_number'];
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

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return int
     */
    public function getHouseNumber(): int
    {
        return $this->house_number;
    }

    /**
     * @param int $house_number
     */
    public function setHouseNumber(int $house_number): void
    {
        $this->house_number = $house_number;
    }

    /**
     * @return string|null
     */
    public function getPsc(): ?string
    {
        return $this->psc;
    }

    /**
     * @param string|null $psc
     */
    public function setPsc(?string $psc): void
    {
        $this->psc = $psc;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return int
     */
    public function getMobileNumber(): int
    {
        return $this->mobile_number;
    }

    /**
     * @param int $mobile_number
     */
    public function setMobileNumber(int $mobile_number): void
    {
        $this->mobile_number = $mobile_number;
    }

}