<?php

namespace App\Models;

class Product extends \App\Core\Model
{
    public function __construct(
        public ?string $name = null,
        public int $id = 0,
        public ?string $image = null,
        public int $price = 0,
        public int $inCart = 0
    )
    {
    }

    static public function setDbColumns()
    {
        return ['name','id', 'image', 'price', 'inCart'];
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
     * @return int
     */
    public function getInCart(): int
    {
        return $this->inCart;
    }

    /**
     * @param int $inCart
     */
    public function setInCart(int $inCart): void
    {
        $this->inCart = $inCart;
    }
}