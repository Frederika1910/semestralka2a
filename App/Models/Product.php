<?php

namespace App\Models;

class Product extends \App\Core\Model
{
    public function __construct(
        public ?string $name = null,
        public int $id = 0,
        public ?string $image = null,
        public int $price = 0,
        public int $category_id = 0,
        public ?string $size = null,
        public ?string $gender = null
    )
    {
    }

    static public function setDbColumns()
    {
        return ['name','id', 'image', 'price', 'category_id', 'size', 'gender'];
    }

    static public function setTableName()
    {
        return "products";
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
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     */
    public function setSize(?string $size): void
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    public static function validateSize(string $size): ?string
    {
        if ($size == "") {
            return "Nezadali ste veľkosť.";
        } else if (!preg_match("/[0-9\a-zA-Z]$/", $size)) {
            return "Veľkosť smie obsahovať len znaky.";
        }

        return null;
    }

    public static function validateGender(string $gender): ?string
    {
        if ($gender == "") {
            return "Nezadali ste pre koho.";
        } else if (!preg_match("/[a-zA-Z]$/", $gender)) {
            return "Pre koho smie obsahovať len znaky.";
        }

        return null;
    }

    public static function validatePrice(string $price): ?string
    {
        if ($price == "") {
            return "Nezadali ste cenu.";
        } else if (!preg_match("/^[0-9]\d*(,\d+)?$/", $price)) {
            return "Cena smie obsahovať len číslice.";
        }

        return null;
    }

    public static function validateCategory(string $catId): ?string
    {
        if ($catId != "1" && $catId != "2" && $catId != "3" && $catId != "4") {
            return "Nevybrali ste kategóriu produktu.";
        }

        return null;
    }

    public static function validateImage(string $image): ?string
    {
        if ($image == null) {
            return "Nenahrali ste obrázok.";
        }

        return null;
    }
}