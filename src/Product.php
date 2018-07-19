<?php

namespace Intredo\OrderConnector;

class Product implements \JsonSerializable
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var int
     */
    private $quantity = 1;

    public function __construct(string $code, int $quantity = 1)
    {
        $this->code = $code;
        $this->quantity = $quantity;
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
        ];
    }
}
