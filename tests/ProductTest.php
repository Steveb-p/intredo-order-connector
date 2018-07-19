<?php

namespace Intredo\OrderConnector;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    public function testJsonSerialize()
    {
        $product = new Product('SLR');
        $this->assertSame('{"code":"SLR","qty":1}' ,json_encode($product));
    }
}
