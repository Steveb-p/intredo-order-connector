<?php

namespace Intredo\OrderConnector;

class Package implements \JsonSerializable
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var int
     */
    private $quantity = 1;

    /**
     * @var string
     */
    private $income;

    /**
     * @var array
     */
    private $products = [];

    public function __construct($code, $quantity = 1)
    {
        $this->code = $code;
        $this->quantity = $quantity;
    }

    /**
     * @param string $income
     * @return Package
     */
    public function setIncome($income)
    {
        $this->income = $income;
        return $this;
    }

    /**
     * @param Product $product
     * @return Package
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'qty' => $this->quantity,
            'cost' => $this->income,
            'products' => $this->products,
        ];
    }
}
