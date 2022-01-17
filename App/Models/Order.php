<?php

namespace App\Models;

class Order extends \App\Core\Model
{

    public function __construct(
        public int     $id = 0,
        public int     $user_id = 0,
        public ?string $street = null,
        public int     $house_number = 0,
        public ?string $psc = null,
        public ?string $city = null,
        public ?string $country = null,
        public ?string     $mobile_number = null,
        public int     $totalPrice = 0,
        public int     $numberOfProducts = 0,
        public ?string $date = null,
        public int $state = 0
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'user_id', 'street', 'house_number', 'psc', 'city', 'country', 'mobile_number', 'totalPrice', 'numberOfProducts', 'date', 'state'];
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
    public function getMobileNumber(): ?string
    {
        return $this->mobile_number;
    }

    /**
     * @param int $mobile_number
     */
    public function setMobileNumber(string $mobile_number): void
    {
        $this->mobile_number = $mobile_number;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * @param int $totalPrice
     */
    public function setTotalPrice(int $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return int
     */
    public function getNumberOfProducts(): int
    {
        return $this->numberOfProducts;
    }

    /**
     * @param int $numberOfProducts
     */
    public function setNumberOfProducts(int $numberOfProducts): void
    {
        $this->numberOfProducts = $numberOfProducts;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    public static function validateStreet(string $street): ?string
    {
        if ($street == "") {
            return "Nezadali ste ulicu.";
        } else if (!preg_match("/^[a-zA-Z\x{00C0}-\x{017F}\ ]+$/u", $street)) {
            return "Ulica smie obsahovať len znaky.";
        }

        return null;
    }

    public static function validateHouseNumber(string $houseNumber): ?string
    {
        if ($houseNumber == "") {
            return "Nezadali ste číslo domu.";
        } else if (!preg_match("/[0-9\/]$/", $houseNumber)) {
            return "Číslo domu smie obsahovať číslice a znak '/'.";
        }

        return null;
    }

    public static function validateCity(string $city): ?string
    {
        if ($city == "") {
            return "Nezadali ste obec.";
        } else if (!preg_match("/^[a-zA-Z\x{00C0}-\x{017F}\ ]+$/u", $city)) {
            return "Obec smie obsahovať len znaky.";
        }

        return null;
    }

    public static function validateCountry(string $country): ?string
    {
        if ($country == "") {
            return "Nezadali ste štát.";
        } else if (!preg_match("/^[a-zA-Z\x{00C0}-\x{017F}\ ]+$/u", $country)) {
            return "Štát smie obsahovať len znaky.";
        }

        return null;
    }

    public static function validateMobileNumber(string $mobileNumber): ?string
    {
        if ($mobileNumber == "") {
            return "Nezadali ste telefónne číslo.";
        } else if (!preg_match("/[0-9\+]$/", $mobileNumber)) {
            return "Telefónne číslo smie obsahovať číslice a znak '+'.";
        } else if (strcmp(substr($mobileNumber,0,4), '+421') == 0) {
            return "Telefónne číslo musí začínať +421.";
        }if (strlen($mobileNumber) < 13 || strlen($mobileNumber) > 13) {
            return "Telefónne číslo musí mať presne 13 znakov.";
    }

        return null;
    }

    public static function validatePsc(string $psc): ?string
    {
        if ($psc == "") {
            return "Nezadali ste PSČ.";
        } else if (!preg_match("/[0-9]$/", $psc)) {
            return "PSČ smie obsahovať len číslice.";
        } elseif (strlen($psc) < 5 || strlen($psc) > 5) {
            return "PSČ musí mať presne 5 znakov.";
        }

        return null;
    }

    public static function validateCardNumber(string $cardNumber): ?string
    {
        if ($cardNumber == "") {
            return "Číslo karty nesmie byť prázdne.";
        } else if (!preg_match("/[0-9]$/", $cardNumber)){
            return "Číslo karty nesmie obsahovať znaky.";
        } if (strlen($cardNumber) < 16 || strlen($cardNumber) > 16) {
            return "Číslo karty musí mať presne 16 znakov.";
        }

        return null;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param int $state
     */
    public function setState(int $state): void
    {
        $this->state = $state;
    }

}