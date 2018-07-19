<?php

namespace Intredo\OrderConnector;

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testShouldProduceValidJson()
    {
        $order = new Order();
        $this->assertJson(json_encode($order));
    }
}
