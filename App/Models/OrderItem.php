<?php

namespace App\Models;

class OrderItem extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public ?string $product_name = null,
        public int $order_id = 0
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id','product_name', 'order_id'];
    }

    static public function setTableName()
    {
        return "order_item";
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
    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    /**
     * @param string|null $productName
     */
    public function setProductName(?string $productName): void
    {
        $this->product_name = $productName;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @param int $orderId
     */
    public function setOrderId(int $orderId): void
    {
        $this->order_id = $orderId;
    }
}