<?php

namespace App\Models;

class Cart extends \App\Core\Model
{

    public function __construct(
        public int $id = 0,
        public int $order_id = 0,
        public int $quantity = 0,
        public int $product_id = 222,
        public ?string $productName = null,
        public int $item_price = 0,
        public int $quantityPrice = 0
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'order_id', 'quantity', 'product_id', 'productName', 'item_price', 'quantityPrice'];
    }

    static public function setTableName()
    {
        return "shopping_cart";
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
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @param int $order_id
     */
    public function setOrderId(int $order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return string|null
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    /**
     * @param string|null $productName
     */
    public function setProductName(?string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return int
     */
    public function getItemPrice(): int
    {
        return $this->item_price;
    }

    /**
     * @param int $itemPrice
     */
    public function setItemPrice(int $itemPrice): void
    {
        $this->item_price = $itemPrice;
    }

    /**
     * @return int
     */
    public function getQuantityPrice(): int
    {
        return $this->quantityPrice;
    }

    /**
     * @param int $quantityPrice
     */
    public function setQuantityPrice(int $quantityPrice): void
    {
        $this->quantityPrice = $quantityPrice;
    }
}